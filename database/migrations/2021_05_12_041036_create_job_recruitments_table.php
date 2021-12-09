<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_recruitments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_id')->unsigned();
            $table->string('salary_expectation')->nullable();
            $table->date('work_date')->nullable();
            $table->integer('work_place_expectation')->nullable();
            $table->string('name');
            $table->boolean('is_married')->nullable();
            $table->boolean('is_male')->nullable();
            $table->string('cv');
            $table->string('image')->nullable();
            $table->date('DOB')->nullable();
            $table->string('POB')->nullable();
            $table->string('email');
            $table->string('phone', 11);
            $table->string('identity_card', 9)->nullable();
            $table->date('date_of_issue')->nullable();
            $table->string('place_of_issue')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('current_address')->nullable();
            $table->integer('height')->nullable();
            $table->double('weight')->nullable();
            $table->longText('education')->nullable();
            $table->longText('ex_job')->nullable();
            $table->integer('status_recruitment_id')->default('1');
            $table->dateTime('read_at')->nullable();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
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
        Schema::dropIfExists('job_recruitments');
    }
}
