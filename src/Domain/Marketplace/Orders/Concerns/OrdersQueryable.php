<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Concerns;

use Illuminate\Support\Carbon;

trait OrdersQueryable
{

    /** @var array */
    private $ordersQueryableParameters = [
        'sku' => null,
        'customerOrderId' => null,
        'purchaseOrderId' => null,
        'status' => null,
        'createdStartDate' => null,
        'createdEndDate' => null,
        'fromExpectedShipDate' => null,
        'toExpectedShipDate' => null,
        'lastModifiedStartDate' => null,
        'lastModifiedEndDate' => null,
        'limit' => 100,
        'productInfo' => false,
        'shipNodeType' => 'SellerFulfilled',
        'shippingProgramType' => null,
    ];


    public function withSku($sku = null): self
    {
        $this->ordersQueryableParameters['sku'] = $sku;

        return $this;
    }

    public function withCustomerOrderId($customerOrderId = null): self
    {
        $this->ordersQueryableParameters['customerOrderId'] = $customerOrderId;

        return $this;
    }

    public function withPurchaseOrderId($purchaseOrderId = null): self
    {
        $this->ordersQueryableParameters['purchaseOrderId'] = $purchaseOrderId;

        return $this;
    }

    public function getPurchaseOrderId(): ?string
    {
        return $this->ordersQueryableParameters['purchaseOrderId'];
    }

    public function hasPurchaseOrderId(): bool
    {
        return filled($this->ordersQueryableParameters['purchaseOrderId']);
    }

    public function withStatusCreated(): self
    {
        $this->ordersQueryableParameters['status'] = 'Created';

        return $this;
    }

    public function withStatusAcknowledged(): self
    {
        $this->ordersQueryableParameters['status'] = 'Acknowledged';

        return $this;
    }

    public function withStatusShipped(): self
    {
        $this->ordersQueryableParameters['status'] = 'Shipped';

        return $this;
    }

    public function withStatusCancelled(): self
    {
        $this->ordersQueryableParameters['status'] = 'Cancelled';

        return $this;
    }

    public function withCreatedStartDate(Carbon $date = null): self
    {
        $this->ordersQueryableParameters['createdStartDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withCreatedEndDate(Carbon $date = null): self
    {
        $this->ordersQueryableParameters['createdEndDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withFromExpectedShipDate(Carbon $date = null): self
    {
        $this->ordersQueryableParameters['fromExpectedShipDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withToExpectedShipDate(Carbon $date = null): self
    {
        $this->ordersQueryableParameters['toExpectedShipDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withLastModifiedStartDate(Carbon $date = null): self
    {
        $this->ordersQueryableParameters['lastModifiedStartDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withLastModifiedEndDate(Carbon $date = null): self
    {
        $this->ordersQueryableParameters['lastModifiedEndDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withlimit($limit = null): self
    {
        $this->ordersQueryableParameters['limit'] = $limit;

        return $this;
    }

    public function withProductInfo($productInfo = true): self
    {
        $this->ordersQueryableParameters['productInfo'] = $productInfo;

        return $this;
    }

    public function withoutProductInfo(): self
    {
        $this->withProductInfo(false);

        return $this;
    }

    public function withShipNodeTypeSellerFulfilled(): self
    {
        $this->ordersQueryableParameters['shipNodeType'] = 'SellerFulfilled';

        return $this;
    }

    public function withShipNodeTypeWFSFulfilled(): self
    {
        $this->ordersQueryableParameters['shipNodeType'] = 'WFSFulfilled';

        return $this;
    }

    public function withShipNodeType3PLFulfilled(): self
    {
        $this->ordersQueryableParameters['shipNodeType'] = '3PLFulfilled';

        return $this;
    }

    public function withoutShipNodeType(): self
    {
        $this->ordersQueryableParameters['shipNodeType'] = null;

        return $this;
    }

    public function withShippingProgramType(): self
    {
        $this->ordersQueryableParameters['shippingProgramType'] = 'TWO_DAY';

        return $this;
    }

    public function withoutShippingProgramType(): self
    {
        $this->ordersQueryableParameters['shippingProgramType'] = null;

        return $this;
    }

    public function getOrderQueryParameters(): array
    {
        $productInfo = $this->ordersQueryableParameters['productInfo'];

        return compact('productInfo');
    }

    public function getOrdersQueryParameters(): array
    {
        return $this->ordersQueryableParameters;
    }
}
