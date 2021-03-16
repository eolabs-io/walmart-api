<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateOrderLineChargeReturnOrderLineTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('order_line_charge_return_order_line', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_line_charge_id');
            $table->unsignedBigInteger('return_order_line_id');
            $table->timestamps();

            $table->foreign('order_line_charge_id', 'olcrol_olci_foreign')->references('id')->on('order_line_charges')->onDelete('cascade');
            $table->foreign('return_order_line_id', 'olcrol_roli_foreign')->references('id')->on('return_order_lines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('order_line_charge_return_order_line');
    }
}
