<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateOrderLineStatusesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('order_line_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->unsignedBigInteger('status_quantity_id');
            $table->string('cancellation_reason')->nullable();
            $table->unsignedBigInteger('tracking_info_id')->nullable();
            $table->unsignedBigInteger('return_center_address_id')->nullable();
            $table->unsignedBigInteger('order_line_id');
            $table->timestamps();

            $table->foreign('status_quantity_id')->references('id')->on('status_quantities');
            $table->foreign('tracking_info_id')->references('id')->on('tracking_infos');
            $table->foreign('return_center_address_id')->references('id')->on('return_center_addresses');
            $table->foreign('order_line_id')->references('id')->on('order_lines')->cascadeOnDelete();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('order_line_statuses');
    }
}
