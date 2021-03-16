<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Label;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnLine;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnLineGroup;

class ReturnLineGroupTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ReturnLineGroup::class;
    }

    /** @test */
    public function it_has_return_lines_relationship()
    {
        $returnLineGroup = ReturnLineGroup::factory()->create();
        $rReturnLines = ReturnLine::factory()->count(4)->create(['return_line_group_id' => $returnLineGroup->id]);
        $returnLines = ReturnLineGroup::with('returnLines')->first()->returnLines;

        $this->assertCount(4, $returnLines);
        $this->assertArraysEqual($rReturnLines->toArray(), $returnLines->toArray());
    }

    /** @test */
    public function it_has_labels_relationship()
    {
        $returnLabels = Label::factory()->count(4)->create();
        $returnLineGroup = ReturnLineGroup::factory()->create();

        $returnLineGroup->labels()->attach($returnLabels);

        $labels = ReturnLineGroup::with('labels')->first()->labels;

        $this->assertCount(4, $labels);
        $this->assertArraysEqual($returnLabels->toArray(), $labels->toArray());
    }
}
