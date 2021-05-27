<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateImagesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->unsignedBigInteger('item_variant_id');
            $table->timestamps();

            $table->foreign('item_variant_id')->references('id')->on('item_variants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('images');
    }
}
