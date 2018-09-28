<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->length(8)->unsigned();
            $table->integer('code')->length(10)->unique();
            $table->string('first_name')->length(100)->nullable();
            $table->string('last_name')->length(100)->nullable();
            $table->string('full_name')->length(255)->nullable();
            $table->tinyInteger('sex')->length(3)->unsigned()->nullable()->comment('Graduation sex: 1: Nam, 2: Nữ');
            $table->string('email')->length(100)->unique()->nullable();
            $table->string('phone')->length(15)->nullable();
            $table->integer('graduation_year')->length(8)->unsigned()->nullable();
            $table->tinyInteger('graduation_business')->length(3)->unsigned()->nullable()->comment('Graduation Business user: 1: Khoa học máy tính, 2: Công nghệ thông tin, ...');
            $table->integer('job_id')->length(8)->unsigned()->nullable();
            $table->tinyInteger('role')->length(3)->unsigned()->default(1)->comment('Role user: 1: Admin, 2: SV');
            $table->dateTime('last_access_at')->nullable();
            $table->string('remember_token')->length(64)->nullable();
            $table->string('password')->length(64)->nullable();
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
        chema::dropIfExists('users');
    }
}
