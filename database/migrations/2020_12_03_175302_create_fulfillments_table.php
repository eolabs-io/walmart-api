<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateFulfillmentsTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('fulfillments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fulfillment_option');
            $table->string('ship_method');
            $table->string('store_id')->nullable();
            $table->string('pick_up_date_time')->nullable();
            $table->string('pick_up_by')->nullable();
            $table->string('shipping_program_type')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('fulfillments');
    }
}
