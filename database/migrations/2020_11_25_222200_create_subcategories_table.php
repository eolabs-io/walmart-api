<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateSubcategoriesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sub_category_name')->unique();
            $table->string('sub_category_id')->unique();
            $table->unsignedBigInteger('taxonomy_id');
            $table->timestamps();

            $table->foreign('taxonomy_id')->references('id')->on('taxonomies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('sub_categories');
    }
}
