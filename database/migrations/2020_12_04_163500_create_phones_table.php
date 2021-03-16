<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreatePhonesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('phones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone_id')->nullable();
            $table->string('area_code')->nullable();
            $table->string('extension')->nullable();
            $table->string('complete_number')->nullable();
            $table->string('type')->nullable();
            $table->string('subscriber_number')->nullable();
            $table->string('country_code')->nullable();
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
        $this->schema->dropIfExists('phones');
    }
}
