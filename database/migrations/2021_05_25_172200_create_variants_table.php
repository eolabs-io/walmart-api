<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateVariantsTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('variants', function (Blueprint $table) {
            $table->bigIncrements('id');
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
        $this->schema->dropIfExists('variants');
    }
}
