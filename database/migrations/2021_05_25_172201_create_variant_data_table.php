<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateVariantDataTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('variant_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('variant_id');
            $table->string('product_image_url');
            $table->string('item_id');
            $table->string('is_available');
            $table->string('title');
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
        $this->schema->dropIfExists('variant_data');
    }
}
