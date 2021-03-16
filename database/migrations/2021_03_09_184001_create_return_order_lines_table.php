<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateReturnOrderLinesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('return_order_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('return_order_line_number');
            $table->bigInteger('sales_order_line_number');
            $table->string('seller_order_id');
            $table->string('return_reason');
            $table->string('purchase_order_id');
            $table->bigInteger('purchase_order_line_number');
            $table->string('exception_item_type')->nullable();
            $table->boolean('is_return_for_exception')->nullable();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('unit_price_id');
            $table->bigInteger('cancellable_qty');
            $table->unsignedBigInteger('quantity_id');
            $table->boolean('return_expected_flag');
            $table->boolean('is_fast_replacement');
            $table->boolean('is_keep_it');
            $table->boolean('last_item');
            $table->double('refunded_qty');
            $table->double('rechargeable_qty');
            $table->string('refund_channel');
            $table->string('status');
            $table->dateTime('status_time');
            $table->string('current_delivery_status');
            $table->string('current_refund_status');
            $table->unsignedBigInteger('return_order_id');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('return_order_line_items');
            $table->foreign('unit_price_id')->references('id')->on('currencies');
            $table->foreign('quantity_id')->references('id')->on('quantities');
            $table->foreign('return_order_id')->references('id')->on('return_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('return_order_lines');
    }
}
