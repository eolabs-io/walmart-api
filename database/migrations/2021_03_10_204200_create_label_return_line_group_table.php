<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateLabelReturnLineGroupTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('label_return_line_group', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('return_line_group_id');
            $table->unsignedBigInteger('label_id');
            $table->timestamps();

            $table->foreign('return_line_group_id')->references('id')->on('return_line_groups')->onDelete('cascade');
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('label_return_line_group');
    }
}
