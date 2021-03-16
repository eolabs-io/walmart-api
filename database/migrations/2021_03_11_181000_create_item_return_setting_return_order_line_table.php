<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateItemReturnSettingReturnOrderLineTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('item_return_setting_return_order_line', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_return_setting_id');
            $table->unsignedBigInteger('return_order_line_id');
            $table->timestamps();

            $table->foreign('item_return_setting_id', 'irsrol_irsi_foreign')->references('id')->on('item_return_settings')->onDelete('cascade');
            $table->foreign('return_order_line_id', 'irsrol_roli_foreign')->references('id')->on('return_order_lines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('item_return_setting_return_order_line');
    }
}
