<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateReturnLineGroupsTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('return_line_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('group_no');
            $table->boolean('return_expected_flag');
            $table->unsignedBigInteger('return_order_id');
            $table->timestamps();

            $table->foreign('return_order_id')->references('id')->on('return_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('return_line_groups');
    }
}
