<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateCarrierInfoListsTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('carrier_info_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('carrier_id');
            $table->string('carrier_name');
            $table->string('service_type');
            $table->string('tracking_no');
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
        $this->schema->dropIfExists('carrier_info_lists');
    }
}
