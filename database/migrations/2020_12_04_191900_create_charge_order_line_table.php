<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateChargeOrderLineTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('charge_order_line', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_line_id');
            $table->unsignedBigInteger('charge_id');
            $table->timestamps();

            $table->foreign('order_line_id')->references('id')->on('order_lines');
            $table->foreign('charge_id')->references('id')->on('charges');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('charge_order_line');
    }
}
