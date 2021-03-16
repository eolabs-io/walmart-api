<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateOrdersMpTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('purchase_order_id');
            $table->string('customer_order_id');
            $table->string('customer_email_id');
            $table->dateTime('order_date');
            $table->string('buyer_id')->nullable();
            $table->string('mart')->nullable();
            $table->boolean('is_guest')->nullable();
            $table->unsignedBigInteger('shipping_info_id');
            $table->unsignedBigInteger('order_summary_id')->nullable();
            $table->unsignedBigInteger('ship_node_id')->nullable();
            $table->timestamps();

            $table->foreign('shipping_info_id')->references('id')->on('shipping_infos');
            $table->foreign('order_summary_id')->references('id')->on('order_summaries');
            $table->foreign('ship_node_id')->references('id')->on('ship_nodes');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('orders');
    }
}
