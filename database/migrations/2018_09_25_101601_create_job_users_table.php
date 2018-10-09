<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_users', function (Blueprint $table) {
            $table->increments('id')->length(8)->unsigned();
            $table->tinyInteger('job')->length(1)->unsigned()->comment('1: Có việc 2: Chưa có việc');
            $table->string('name_job')->length(255)->nullable();
            $table->integer('roll_job_id')->length(8)->unsigned();
            $table->foreign('roll_job_id')->references('id')->on('roll_jobs');
            $table->integer('type_company_id')->length(8)->unsigned();
            $table->foreign('type_company_id')->references('id')->on('type_detail_companys');
            $table->string('traning')->length(255)->nullable();
            $table->tinyInteger('introduce_source')->length(3)->unsigned()->nullable()->comment('1: Quảng cáo, 2: Bạn bè/người thân');
            $table->integer('time_have_job')->length(4);
            $table->integer('salary_id')->length(8)->unsigned();
            $table->foreign('salary_id')->references('id')->on('salarys');
            $table->tinyInteger('job_business')->length(3)->unsigned()->comment('1: Đúng ngành 2: Sai ngành');
            $table->integer('created_id')->length(8)->nullable();
            $table->integer('updated_id')->length(8)->nullable();
            $table->integer('deleted_id')->length(8)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_users');
    }
}
