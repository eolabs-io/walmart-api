<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateOrderLinesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('order_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('line_number');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('order_line_quantity_id');
            $table->string('status_date');
            $table->unsignedBigInteger('refund_id')->nullable();
            $table->string('original_carrier_method')->nullable();
            $table->string('reference_line_id')->nullable();
            $table->unsignedBigInteger('fulfillment_id')->nullable();
            $table->string('intent_to_cancel')->nullable();
            $table->string('config_id')->nullable();
            $table->string('seller_order_id')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('order_items')->cascadeOnDelete();
            $table->foreign('order_line_quantity_id')->references('id')->on('order_line_quantities')->cascadeOnDelete();
            $table->foreign('refund_id')->references('id')->on('refunds')->cascadeOnDelete();
            $table->foreign('fulfillment_id')->references('id')->on('fulfillments')->cascadeOnDelete();
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('order_lines');
    }
}
