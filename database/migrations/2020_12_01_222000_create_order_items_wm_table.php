<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateOrderItemsWmTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->string('sku');
            $table->string('image_url')->nullable();
            $table->unsignedBigInteger('weight_id')->nullable();
            $table->timestamps();

            $table->foreign('weight_id')->references('id')->on('weights');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('order_items');
    }
}
