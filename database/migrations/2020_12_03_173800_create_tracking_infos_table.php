<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateTrackingInfosTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('tracking_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ship_date_time');
            $table->unsignedBigInteger('carrier_name_id')->nullable();
            $table->string('method_code');
            $table->integer('carrier_method_code')->nullable();
            $table->string('tracking_number');
            $table->string('tracking_url')->nullable();
            $table->timestamps();

            $table->foreign('carrier_name_id')->references('id')->on('carrier_names');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('tracking_infos');
    }
}
