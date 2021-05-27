<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateVariantValuesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('variant_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('variant_data_id');
            $table->string('name');
            $table->string('value');
            $table->timestamps();

            $table->foreign('variant_data_id')->references('id')->on('variant_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('variant_values');
    }
}
