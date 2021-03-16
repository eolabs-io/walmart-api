<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateRefundChargesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('refund_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('refund_reason');
            $table->unsignedBigInteger('charge_id');
            $table->unsignedBigInteger('refund_id');
            $table->timestamps();

            $table->foreign('charge_id')->references('id')->on('charges');
            $table->foreign('refund_id')->references('id')->on('refunds');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('refund_charges');
    }
}
