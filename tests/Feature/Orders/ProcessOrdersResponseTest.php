<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Orders;

use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Support\Facades\Orders;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\WalmartApi\Tests\Factories\OrdersRequestFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Order;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Jobs\ProcessOrdersResponse;

class ProcessOrdersResponseTest extends TestCase
{
    use RefreshDatabase;

    public $results;

    protected function setUp(): void
    {
        parent::setUp();

        OrdersRequestFactory::new()->fakeOrdersResponse();

        $this->results = Orders::fetch();

        (new ProcessOrdersResponse($this->results))->handle();
    }

    /** @test */
    public function it_can_process_orders_response()
    {
        $order = $this->getOrder()->first();

        $this->assertOrder($order);
        $this->assertDatabaseCount('orders', 10);
    }

    /** @test */
    public function it_can_process_same_orders_without_duplication_response()
    {
        $this->assertOrdersDataBaseState();

        // Same repsonse as before processed a second time
        (new ProcessOrdersResponse($this->results))->handle();

        $this->assertOrdersDataBaseState();
    }

    //// Helpers ////

    public function getOrder()
    {
        return Order::with([
            'shippingInfo.postalAddress',
            'orderLines.item.weight',
            'orderLines.charges.chargeAmount',
            'orderLines.charges.tax.taxAmount',
            'orderLines.orderLineQuantity',
            'orderLines.orderLineStatuses.statusQuantity',
            'orderLines.orderLineStatuses.trackingInfo.carrierName',
            'orderLines.orderLineStatuses.returnCenterAddress',
            'orderLines.refund.refundCharges.charge.chargeAmount',
            'orderLines.refund.refundCharges.charge.tax.taxAmount',
            'orderLines.fulfillment',
            'orderSummary.totalAmount',
            'orderSummary.orderSubTotals.totalAmount',
            'pickupPeople.name',
            'pickupPeople.phone',
            'shipNode',
        ]);
    }

    public function assertOrder($order)
    {
        $this->assertEquals('1796277083022', $order->purchase_order_id);
        $this->assertEquals('5281956426648', $order->customer_order_id);
        $this->assertEquals('3A31739D8B0A45A1B23F7F8C81C8747F@relay.walmart.com', $order->customer_email_id);
        $this->assertEquals('2019-09-14 13:09:31', $order->order_date);

        $this->assertNull($order->buyer_id);
        $this->assertNull($order->mart);
        $this->assertNull($order->is_guest);
        $this->assertNull($order->payment_types);


        $this->assertShippingInfo($order->shippingInfo);
        $this->assertOrderLine($order->orderLines->first());
        $this->assertOrderSummary($order->orderSummary);
        $this->assertPickupPerson($order->pickupPeople->first());
        $this->assertShipNode($order->shipNode);
    }

    public function assertShippingInfo($shippingInfo)
    {
        $this->assertEquals('3155598681', $shippingInfo->phone);
        $this->assertEquals('2019-09-25 19:00:00', $shippingInfo->estimated_delivery_date);
        $this->assertEquals('2019-09-17 06:00:00', $shippingInfo->estimated_ship_date);
        $this->assertEquals('Kathryn Cole', $shippingInfo->postalAddress->name);
    }

    public function assertOrderLine($orderLine)
    {
        // OrderLines
        $this->assertEquals(4, $orderLine->line_number);
        $this->assertEquals('2019-09-14 13:10:47', $orderLine->status_date);

        // Item
        $this->assertEquals('Beba Bean Pee-pee Teepee Airplane - Blue - Laundry Bag', $orderLine->item->product_name);
        $this->assertEquals(171, $orderLine->item->weight->value);

        // Charges
        $charge = $orderLine->charges->first();
        $this->assertEquals('PRODUCT', $charge->charge_type);
        $this->assertEquals('ItemPrice', $charge->charge_name);

        $this->assertEquals('USD', $charge->chargeAmount->currency);
        $this->assertEquals(10.0, $charge->chargeAmount->amount);

        $this->assertEquals('Tax1', $charge->tax->tax_name);
        $this->assertEquals('USD', $charge->tax->taxAmount->currency);
        $this->assertEquals(0.80, $charge->tax->taxAmount->amount);

        // OrderLineQuantity
        $orderLineQuantity = $orderLine->orderLineQuantity;
        $this->assertEquals('EACH', $orderLineQuantity->unit_of_measurement);
        $this->assertEquals(1, $orderLineQuantity->amount);

        // OrderLineStatuses
        $orderLineStatus = $orderLine->orderLineStatuses->first();
        $this->assertEquals('Created', $orderLineStatus->status);
        $this->assertNull($orderLineStatus->cancellation_reason);

        // statusQuantity
        $statusQuantity = $orderLineStatus->statusQuantity;
        $this->assertEquals('EACH', $statusQuantity->unit_of_measurement);
        $this->assertEquals(1, $statusQuantity->amount);

        // trackingInfo
        $trackingInfo = $orderLineStatus->trackingInfo;
        $this->assertEquals('2019-08-27 19:12:49', $trackingInfo->ship_date_time);
        $this->assertNull($trackingInfo->carrierName->carrier);
        $this->assertEquals('Value', $trackingInfo->method_code);
        $this->assertEquals('9400100000000000000000', $trackingInfo->tracking_number);
        $this->assertNull($trackingInfo->tracking_url);

        // returnCenterAddress
        $returnCenterAddress = $orderLineStatus->returnCenterAddress;
        $this->assertEquals('Name', $returnCenterAddress->name);
        $this->assertEquals('address1', $returnCenterAddress->address1);
        $this->assertEquals('Kansas City', $returnCenterAddress->city);
        $this->assertEquals('MO', $returnCenterAddress->state);
        $this->assertEquals('64113', $returnCenterAddress->postal_code);

        // Refund
        $refund = $orderLine->refund;
        $this->assertEquals('refundId', $refund->refund_id);
        $this->assertEquals('refund Comments', $refund->refund_comments);

        $refundCharge = $refund->refundCharges->first();
        $this->assertEquals('ITEM_NOT_AS_ADVERTISED', $refundCharge->refund_reason);
        $this->assertEquals('charge Type', $refundCharge->charge->charge_type);

        // Fulfillment
        $fulfillment = $orderLine->fulfillment;
        $this->assertEquals('S2H', $fulfillment->fulfillment_option);
        $this->assertEquals('VALUE', $fulfillment->ship_method);
        $this->assertNull($fulfillment->store_id);
        $this->assertEquals('2019-09-19 19:00:00', $fulfillment->pick_up_date_time);
    }

    public function assertOrderSummary($orderSummary)
    {
        $this->assertEquals('USD', $orderSummary->totalAmount->currency);
        $this->assertEquals(2.22, $orderSummary->totalAmount->amount);

        $orderSubTotal = $orderSummary->orderSubTotals->first();
        $this->assertEquals('type', $orderSubTotal->sub_total_type);
        $this->assertEquals(1.23, $orderSubTotal->totalAmount->amount);
        $this->assertEquals('USD', $orderSubTotal->totalAmount->currency);
    }

    public function assertPickupPerson($pickupPerson)
    {
        $this->assertEquals('John Galt', $pickupPerson->name->complete_name);
        $this->assertEquals('John', $pickupPerson->name->first_name);

        $this->assertEquals(816, $pickupPerson->phone->area_code);
        $this->assertEquals('MOBILE', $pickupPerson->phone->type);
    }

    public function assertShipNode($shipNode)
    {
        $this->assertEquals('3PLFulfilled', $shipNode->type);
        $this->assertEquals('NAME', $shipNode->name);
        $this->assertEquals('DSDSFJGDJL', $shipNode->ship_node_id);
    }

    public function assertOrdersDataBaseState()
    {
        $this->assertDatabaseCount('orders', 10);
        $this->assertDatabaseCount('shipping_infos', 10);
        $this->assertDatabaseCount('postal_addresses', 7);
        $this->assertDatabaseCount('order_lines', 10);
        $this->assertDatabaseCount('order_items', 10);
        $this->assertDatabaseCount('weights', 1);
        $this->assertDatabaseCount('charges', 11);
        $this->assertDatabaseCount('currencies', 22);
        $this->assertDatabaseCount('taxes', 9);
        $this->assertDatabaseCount('order_line_quantities', 10);
        $this->assertDatabaseCount('order_line_statuses', 10);
        $this->assertDatabaseCount('status_quantities', 1);
        $this->assertDatabaseCount('tracking_infos', 4);
        $this->assertDatabaseCount('carrier_names', 3);
        $this->assertDatabaseCount('return_center_addresses', 1);
        $this->assertDatabaseCount('refunds', 1);
        $this->assertDatabaseCount('refund_charges', 1);
        $this->assertDatabaseCount('fulfillments', 10);
        $this->assertDatabaseCount('order_sub_totals', 1);
        $this->assertDatabaseCount('pickup_people', 1);
        $this->assertDatabaseCount('names', 1);
        $this->assertDatabaseCount('phones', 1);
        $this->assertDatabaseCount('ship_nodes', 1);
    }
}
