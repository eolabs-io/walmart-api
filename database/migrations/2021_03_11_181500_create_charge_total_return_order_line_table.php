<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateChargeTotalReturnOrderLineTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('charge_total_return_order_line', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('charge_total_id');
            $table->unsignedBigInteger('return_order_line_id');
            $table->timestamps();

            $table->foreign('charge_total_id', 'ctrol_cti_foreign')->references('id')->on('charge_totals')->onDelete('cascade');
            $table->foreign('return_order_line_id', 'ctrol_roli_foreign')->references('id')->on('return_order_lines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('charge_total_return_order_line');
    }
}
