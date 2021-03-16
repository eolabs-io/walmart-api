<?php

namespace EolabsIo\WalmartApi\Tests\Feature\ReturnRefund;

use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Support\Facades\Returns;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\WalmartApi\Tests\Factories\ReturnsRequestFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrder;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Jobs\ProcessReturnsResponse;

class ProcessReturnsResponseTest extends TestCase
{
    use RefreshDatabase;

    public $results;

    protected function setUp(): void
    {
        parent::setUp();

        ReturnsRequestFactory::new()->fakeReturnsResponse();

        $this->results = Returns::fetch();

        (new ProcessReturnsResponse($this->results))->handle();
    }

    /** @test */
    public function it_can_process_returns_response()
    {
        $return = $this->getReturn()->first();

        $this->assertReturn($return);
        $this->assertDatabaseCount('return_orders', 1);
    }

    /** @test */
    public function it_can_process_same_orders_without_duplication_response()
    {
        $this->assertReturnOrdersDataBaseState();

        // Same repsonse as before processed a second time
        (new ProcessReturnsResponse($this->results))->handle();

        $this->assertReturnOrdersDataBaseState();
    }

    //// Helpers ////

    public function getReturn()
    {
        return ReturnOrder::with([
            'customerName',
            'totalRefundAmount',
            'returnLineGroups.returnLines',
            'returnLineGroups.labels.carrierInfoLists',
            'returnOrderLines.item.itemWeight',
            'returnOrderLines.charges.chargePerUnit',
            'returnOrderLines.charges.taxes.excessTax',
            'returnOrderLines.charges.taxes.taxPerUnit',
            'returnOrderLines.charges.excessCharge',
            'returnOrderLines.charges.references',
            'returnOrderLines.unitPrice',
            'returnOrderLines.itemReturnSettings',
            'returnOrderLines.chargeTotals.value',
            'returnOrderLines.quantity',
            'returnOrderLines.returnTrackingDetails.references',
            'returnChannel',
        ]);
    }

    public function assertReturn($return)
    {
        $this->assertEquals('103738048909818825', $return->return_order_id);
        $this->assertEquals('emailID123456@relay.walmart.com', $return->customer_email_id);
        $this->assertEquals('REPLACEMENT', $return->return_type);
        $this->assertEquals('1234567891234', $return->replacement_customer_order_id);
        $this->assertEquals('1234567891234', $return->customer_order_id);
        $this->assertEquals('2019-02-21 01:01:08', $return->return_order_date);
        $this->assertEquals('2019-03-23 01:01:06', $return->return_by_date);
        $this->assertEquals('POST_DELIVERY', $return->refund_mode);

        $this->assertCustomerName($return->customerName);
        $this->assertTotalRefundAmount($return->totalRefundAmount);
        $this->assertReturnLineGroups($return->returnLineGroups);
        $this->assertReturnOrderLines($return->returnOrderLines);
        $this->assertReturnChannel($return->returnChannel);
    }

    public function assertCustomerName($customerName)
    {
        $this->assertEquals('Jane', $customerName->first_name);
        $this->assertEquals('Doe', $customerName->last_name);
    }

    public function assertTotalRefundAmount($totalRefundAmount)
    {
        $this->assertEquals(127.45, $totalRefundAmount->amount);
        $this->assertEquals('USD', $totalRefundAmount->currency);
    }

    public function assertReturnLineGroups($returnLineGroups)
    {
        $returnLineGroup = $returnLineGroups->first();
        $this->assertEquals(1, $returnLineGroup->group_no);
        $this->assertTrue($returnLineGroup->return_expected_flag);

        // returnLines
        $returnLine = $returnLineGroup->returnLines->first();
        $this->assertEquals(1, $returnLine->return_order_line_number);

        // labels
        $label = $returnLineGroup->labels->first();
        $this->assertEquals('https://i5.walmartimages.com/asr/0a0c7462-7a85-4d3d-b7cf-91738b6883d4_1.c2c4f7b05e1cfe67910134779aa7c571.png', $label->label_image_url);

        // carrierInfoList
        $carrierInfoList = $label->carrierInfoLists->first();
        $this->assertEquals(11, $carrierInfoList->carrier_id);
        $this->assertEquals('FEDEX', $carrierInfoList->carrier_name);
        $this->assertEquals('FedEx Ground', $carrierInfoList->service_type);
        $this->assertEquals(785611449666, $carrierInfoList->tracking_no);
    }

    public function assertReturnOrderLines($returnOrderLines)
    {
        $returnOrderLine = $returnOrderLines->first();
        $this->assertEquals(1, $returnOrderLine->return_order_line_number);
        $this->assertEquals(1, $returnOrderLine->sales_order_line_number);
        $this->assertEquals(4790210558890, $returnOrderLine->purchase_order_id);
        $this->assertEquals(1, $returnOrderLine->purchase_order_line_number);

        $this->assertReturnItem($returnOrderLine->item);
        $this->assertCharge($returnOrderLine->charges->first());
        $this->assertUnitPrice($returnOrderLine->unitPrice);
        $this->assertItemReturnSettings($returnOrderLine->itemReturnSettings->first());
        $this->assertChargeTotal($returnOrderLine->chargeTotals->first());
        $this->assertQuantity($returnOrderLine->quantity);
        $this->assertReturnTrackingDetail($returnOrderLine->returnTrackingDetails->first());
    }

    public function assertReturnItem($item)
    {
        $this->assertEquals('ANTL_GDL-0700', $item->sku);
        $this->assertEquals('Antlion Audio ModMic Wireless Attachable Boom Microphone', $item->product_name);

        // itemWeight
        $itemWeight = $item->itemWeight;
        $this->assertEquals(5, $itemWeight->value);
    }

    public function assertCharge($charge)
    {
        $this->assertEquals('PRODUCT', $charge->charge_category);
        $this->assertEquals('ItemPrice', $charge->charge_name);

        // chargePerUnit
        $chargePerUnit = $charge->chargePerUnit;
        $this->assertEquals(119.95, $chargePerUnit->amount);

        // tax
        $tax = $charge->taxes->first();
        $this->assertEquals('Tax1', $tax->tax_name);

        // excessTax
        $excessTax = $tax->excessTax;
        $this->assertEquals(0.0, $excessTax->amount);
        $this->assertEquals('USD', $excessTax->currency);

        // taxPerUnit
        $taxPerUnit = $tax->taxPerUnit;
        $this->assertEquals(7.5, $taxPerUnit->amount);
        $this->assertEquals('USD', $taxPerUnit->currency);

        // excessCharge
        $excessCharge = $charge->excessCharge;
        $this->assertEquals(0.0, $excessCharge->amount);
        $this->assertEquals('USD', $excessCharge->currency);

        // reference
        $reference = $charge->references->first();
        $this->assertEquals('isAdjustment', $reference->name);
        $this->assertEquals('false', $reference->value);
    }

    public function assertUnitPrice($unitPrice)
    {
        $this->assertEquals(119.95, $unitPrice->amount);
        $this->assertEquals('USD', $unitPrice->currency);
    }

    public function assertItemReturnSettings($itemReturnSettings)
    {
        $this->assertEquals('itemReturnSetting_name', $itemReturnSettings->name);
        $this->assertEquals('itemReturnSetting_value', $itemReturnSettings->value);
    }

    public function assertChargeTotal($chargeTotal)
    {
        $this->assertEquals('lineUnitPrice', $chargeTotal->name);
        $this->assertEquals(119.95, $chargeTotal->value->amount);
        $this->assertEquals('USD', $chargeTotal->value->currency);
    }

    public function assertQuantity($quantity)
    {
        $this->assertEquals('EACH', $quantity->unit_of_measure);
        $this->assertEquals(1.0, $quantity->measurement_value);
    }

    public function assertReturnTrackingDetail($returnTrackingDetail)
    {
        $this->assertEquals(1, $returnTrackingDetail->sequence_no);
        $this->assertEquals('RETURN_IN_TRANSIT', $returnTrackingDetail->event_tag);
        $this->assertEquals('A MARKET_PLACE Return in Transit', $returnTrackingDetail->event_description);
        $this->assertEquals('2019-02-23 00:46:11', $returnTrackingDetail->event_time);

        $reference = $returnTrackingDetail->references->first();
        $this->assertEquals('ReturnDate', $reference->name);
        $this->assertEquals('2019-02-21T01:01:08.000Z', $reference->value);
    }

    public function assertReturnChannel($returnChannel)
    {
        $this->assertEquals('IN_STORE', $returnChannel->channel_name);
    }

    public function assertReturnOrdersDataBaseState()
    {
        $this->assertDatabaseCount('return_orders', 1);
        $this->assertDatabaseCount('names', 1);
        $this->assertDatabaseCount('currencies', 11);
        $this->assertDatabaseCount('return_line_groups', 1);
        $this->assertDatabaseCount('return_lines', 1);
        $this->assertDatabaseCount('labels', 1);
        $this->assertDatabaseCount('carrier_info_lists', 1);
        $this->assertDatabaseCount('return_order_lines', 1);
        $this->assertDatabaseCount('return_order_line_items', 1);
        $this->assertDatabaseCount('weights', 1);
        $this->assertDatabaseCount('order_line_charges', 1);
        $this->assertDatabaseCount('charge_taxes', 1);
        $this->assertDatabaseCount('references', 5);
        $this->assertDatabaseCount('item_return_settings', 1);
        $this->assertDatabaseCount('charge_totals', 5);
        $this->assertDatabaseCount('quantities', 1);
        $this->assertDatabaseCount('return_tracking_details', 2);
        $this->assertDatabaseCount('return_channels', 1);
    }
}
