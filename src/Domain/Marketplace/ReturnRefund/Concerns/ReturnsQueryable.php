<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Concerns;

use Illuminate\Support\Carbon;

trait ReturnsQueryable
{

    /** @var array */
    private $returnsQueryableParameters = [
        'returnOrderId' => null,
        'customerOrderId' => null,
        'status' => null,
        'replacementInfo' => null,
        'returnType' => null,
        'returnCreationStartDate' => null,
        'returnCreationEndDate' => null,
        'returnLastModifiedStartDate' => null,
        'returnLastModifiedEndDate' => null,
        'limit' => 10,
    ];


    public function withReturnOrderId($returnOrderId = null): self
    {
        $this->returnsQueryableParameters['returnOrderId'] = $returnOrderId;

        return $this;
    }

    public function withCustomerOrderId($customerOrderId = null): self
    {
        $this->returnsQueryableParameters['customerOrderId'] = $customerOrderId;

        return $this;
    }

    public function withStatusInitiated(): self
    {
        $this->returnsQueryableParameters['status'] = 'INITIATED';

        return $this;
    }

    public function withStatusDelivered(): self
    {
        $this->returnsQueryableParameters['status'] = 'DELIVERED';

        return $this;
    }

    public function withStatusCompleted(): self
    {
        $this->returnsQueryableParameters['status'] = 'COMPLETED';

        return $this;
    }

    public function withoutStatus(): self
    {
        $this->returnsQueryableParameters['status'] = null;

        return $this;
    }

    public function withReplacementInfo(): self
    {
        $this->returnsQueryableParameters['replacementInfo'] = true;

        return $this;
    }

    public function withoutReplacementInfo(): self
    {
        $this->returnsQueryableParameters['replacementInfo'] = true;

        return $this;
    }

    public function withReturnTypeReplacement(): self
    {
        $this->returnsQueryableParameters['returnType'] = 'REPLACEMENT';

        return $this;
    }

    public function withReturnTypeRefund(): self
    {
        $this->returnsQueryableParameters['returnType'] = 'REFUND';

        return $this;
    }

    public function withoutReturnType(): self
    {
        $this->returnsQueryableParameters['returnType'] = null;

        return $this;
    }

    public function withReturnCreationStartDate(Carbon $date = null): self
    {
        $this->ordersQueryableParameters['returnCreationStartDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withReturnCreationEndDate(Carbon $date = null): self
    {
        $this->ordersQueryableParameters['returnCreationEndDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withReturnLastModifiedStartDate(Carbon $date = null): self
    {
        $this->ordersQueryableParameters['returnLastModifiedStartDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withReturnLastModifiedEndDate(Carbon $date = null): self
    {
        $this->ordersQueryableParameters['returnLastModifiedEndDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withLimit($limit = null): self
    {
        $this->returnsQueryableParameters['limit'] = $limit;

        return $this;
    }

    public function getReturnsQueryParameters(): array
    {
        return $this->returnsQueryableParameters;
    }
}
