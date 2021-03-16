<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateCarrierInfoListLabelTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('carrier_info_list_label', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('carrier_info_list_id');
            $table->unsignedBigInteger('label_id');
            $table->timestamps();

            $table->foreign('carrier_info_list_id')->references('id')->on('carrier_info_lists');
            $table->foreign('label_id')->references('id')->on('labels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('carrier_info_list_label');
    }
}
