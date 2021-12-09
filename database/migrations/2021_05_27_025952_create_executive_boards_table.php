<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExecutiveBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executive_boards', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('image')->nullable();
            $table->bigInteger('job_category_id')->nullable();
            $table->bigInteger('position_id')->nullable();
            $table->bigInteger('branch_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->text('default_image')->nullable();
            $table->timestamps();
        });
        Schema::create('executive_board_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('executive_board_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('locale')->index();
            $table->unique(['executive_board_id','locale']);
            $table->foreign('executive_board_id')->references('id')->on('executive_boards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('executive_boards');
    }
}
