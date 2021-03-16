<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateChargeTaxesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('charge_taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tax_name');
            $table->unsignedBigInteger('excess_tax_id');
            $table->unsignedBigInteger('tax_per_unit_id');
            $table->unsignedBigInteger('order_line_charge_id');
            $table->timestamps();

            $table->foreign('excess_tax_id')->references('id')->on('currencies');
            $table->foreign('tax_per_unit_id')->references('id')->on('currencies');
            $table->foreign('order_line_charge_id')->references('id')->on('order_line_charges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('charge_taxes');
    }
}
