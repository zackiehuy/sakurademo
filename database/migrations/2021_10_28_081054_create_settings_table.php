<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('founded_date')->nullable();
            $table->string('charter_capital')->nullable();
            $table->string('cost')->nullable();
            $table->string('legal_representative')->nullable();
            $table->longText('main_business_activities')->nullable();
            $table->string('mail_username');
            $table->string('mail_password');
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->string('mail_manager')->nullable();
            $table->string('phone_manager')->nullable();
            $table->string('name_manager')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
