<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateShippingInfosTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('shipping_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone');
            $table->string('estimated_delivery_date');
            $table->string('estimated_ship_date');
            $table->string('method_code');
            $table->unsignedBigInteger('postal_address_id');
            $table->timestamps();

            $table->foreign('postal_address_id')->references('id')->on('postal_addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('shipping_infos');
    }
}
