<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateReturnOrdersTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('return_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('return_order_id');
            $table->string('customer_email_id');
            $table->string('return_type')->nullable();
            $table->string('replacement_customer_order_id')->nullable();
            $table->unsignedBigInteger('customer_name_id');
            $table->string('customer_order_id');
            $table->dateTime('return_order_date');
            $table->dateTime('return_by_date');
            $table->string('refund_mode');
            $table->unsignedBigInteger('total_refund_amount_id');
            $table->unsignedBigInteger('return_channel_id');
            $table->timestamps();

            $table->foreign('customer_name_id')->references('id')->on('names');
            $table->foreign('total_refund_amount_id')->references('id')->on('currencies');
            $table->foreign('return_channel_id')->references('id')->on('return_channels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('return_orders');
    }
}
