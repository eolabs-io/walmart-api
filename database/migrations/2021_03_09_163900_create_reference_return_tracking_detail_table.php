<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateReferenceReturnTrackingDetailTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('reference_return_tracking_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('return_tracking_detail_id');
            $table->unsignedBigInteger('reference_id');
            $table->timestamps();

            $table->foreign('return_tracking_detail_id', 'rrtd_rtdi_foreign')->references('id')->on('return_tracking_details');
            $table->foreign('reference_id', 'rrtd_ri_foreign')->references('id')->on('references');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('reference_return_tracking_detail');
    }
}
