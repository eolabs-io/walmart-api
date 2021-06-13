<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateWmPropertiesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('variant_items_num')->nullable();
            $table->string('num_reviews')->nullable();
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->boolean('next_day_eligible')->nullable();
            $table->timestamps();

            $table->foreign('variant_id')->references('id')->on('variants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('properties');
    }
}
