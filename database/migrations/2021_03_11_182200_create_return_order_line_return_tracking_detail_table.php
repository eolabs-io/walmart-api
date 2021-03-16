<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateReturnOrderLineReturnTrackingDetailTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('return_order_line_return_tracking_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('return_tracking_detail_id');
            $table->unsignedBigInteger('return_order_line_id');
            $table->timestamps();

            $table->foreign('return_tracking_detail_id', 'rolrtd_rtdi_foreig')->references('id')->on('return_tracking_details')->onDelete('cascade');
            $table->foreign('return_order_line_id', 'rolrtd_roli_foreig')->references('id')->on('return_order_lines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('return_order_line_return_tracking_detail');
    }
}
