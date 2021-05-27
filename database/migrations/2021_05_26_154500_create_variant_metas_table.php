<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateVariantMetasTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('variant_metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('variant_id');
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
        $this->schema->dropIfExists('variant_metas');
    }
}
