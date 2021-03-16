<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Migrations\WalmartMigration;

class CreateReturnLinesTable extends WalmartMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('return_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('return_order_line_number');
            $table->unsignedBigInteger('return_line_group_id');
            $table->timestamps();

            $table->foreign('return_line_group_id')->references('id')->on('return_line_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('return_lines');
    }
}
