<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateItemVariantsTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('item_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id')->unique();
            $table->string('upc')->nullable();
            $table->string('gtin')->nullable();
            $table->boolean('is_market_place_item');
            $table->float('customer_rating')->nullable();
            $table->boolean('free_shipping');
            $table->unsignedBigInteger('offer_count');
            $table->unsignedBigInteger('price_id');
            $table->text('description');
            $table->string('title');
            $table->string('brand')->nullable();
            $table->string('product_type');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->timestamps();

            $table->foreign('price_id')->references('id')->on('prices');
            $table->foreign('property_id')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('item_variants');
    }
}
