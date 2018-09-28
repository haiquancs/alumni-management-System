<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_jobs', function (Blueprint $table) {
            $table->increments('id')->length(8)->unsigned();
            $table->string('roll')->length(255)->comment('Exp:  Tập sự, Quản lý cấp bộ phận ,...');
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
        Schema::dropIfExists('roll_jobs');
    }
}
