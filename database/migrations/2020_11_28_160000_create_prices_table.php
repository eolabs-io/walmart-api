<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreatePricesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency');
            $table->float('amount');
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
        $this->schema->dropIfExists('prices');
    }
}
