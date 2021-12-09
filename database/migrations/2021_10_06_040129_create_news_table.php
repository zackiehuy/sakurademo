<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('abstract')->nullable();
            $table->text('content')->nullable();
            $table->string('default_image')->nullable();
            $table->timestamps();
        });
        Schema::create('news_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('news_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('abstract')->nullable();
            $table->string('locale')->index();
            $table->unique(['news_id','locale']);
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
