<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mart')->nullable();
            $table->string('sku');
            $table->string('wpid')->nullable();
            $table->string('upc')->nullable();
            $table->string('gtin')->nullable();
            $table->string('product_name')->nullable();
            $table->string('shelf')->nullable();
            $table->string('product_type')->nullable();
            $table->string('published_status')->nullable();
            $table->string('lifecycle_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
