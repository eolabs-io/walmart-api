<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateOrderLineChargeReferenceTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('order_line_charge_reference', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_line_charge_id');
            $table->unsignedBigInteger('reference_id');
            $table->timestamps();

            $table->foreign('order_line_charge_id')->references('id')->on('order_line_charges');
            $table->foreign('reference_id')->references('id')->on('references');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('order_line_charge_reference');
    }
}
