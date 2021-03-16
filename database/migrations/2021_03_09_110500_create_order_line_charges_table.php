<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateOrderLineChargesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('order_line_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('charge_category');
            $table->string('charge_name');
            $table->unsignedBigInteger('charge_per_unit_id');
            $table->boolean('is_discount');
            $table->boolean('is_billable');
            $table->unsignedBigInteger('excess_charge_id');
            $table->timestamps();

            $table->foreign('charge_per_unit_id')->references('id')->on('currencies');
            $table->foreign('excess_charge_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('order_line_charges');
    }
}
