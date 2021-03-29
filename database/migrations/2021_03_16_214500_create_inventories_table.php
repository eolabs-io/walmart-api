<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateInventoriesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku');
            $table->unsignedBigInteger('inventory_quantity_id');
            $table->timestamps();

            $table->foreign('inventory_quantity_id')->references('id')->on('inventory_quantities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('inventories');
    }
}
