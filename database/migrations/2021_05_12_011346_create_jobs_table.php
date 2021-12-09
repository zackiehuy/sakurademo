<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('job_category_id');
            $table->integer('branch_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->date('end_date');
            $table->string('salary_from')->nullable();
            $table->string('salary_to')->nullable();
            $table->text('description');
            $table->text('criteria');
            $table->text('benefit');
            $table->integer('vacancies')->nullable();
            $table->string('recruitment_category_id')->nullable();
            $table->integer('hotline_id');
            $table->boolean('is_fulltime')->default(1);
            $table->string('image')->nullable();
            $table->integer('recruitment_address')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
