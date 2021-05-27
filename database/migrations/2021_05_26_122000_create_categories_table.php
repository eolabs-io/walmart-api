<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateCategoriesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('property_id');
            $table->timestamps();

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
        $this->schema->dropIfExists('categories');
    }
}
