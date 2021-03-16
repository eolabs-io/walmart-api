<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateTaxesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tax_name');
            $table->unsignedBigInteger('tax_amount_id');
            $table->timestamps();

            $table->foreign('tax_amount_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('taxes');
    }
}
