<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateChargesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('charge_type');
            $table->string('charge_name');
            $table->unsignedBigInteger('charge_amount_id');
            $table->unsignedBigInteger('tax_id')->nullable();
            $table->timestamps();

            $table->foreign('charge_amount_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('charges');
    }
}
