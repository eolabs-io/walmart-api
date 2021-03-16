<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateOrderSubTotalsTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('order_sub_totals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sub_total_type');
            $table->unsignedBigInteger('total_amount_id');
            $table->unsignedBigInteger('order_summary_id');
            $table->timestamps();

            $table->foreign('total_amount_id')->references('id')->on('currencies');
            $table->foreign('order_summary_id')->references('id')->on('order_summaries');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('order_sub_totals');
    }
}
