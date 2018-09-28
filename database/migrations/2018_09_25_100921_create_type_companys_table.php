<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeCompanysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_companys', function (Blueprint $table) {
            $table->increments('id')->unsigned()->unsigned();
            $table->string('type')->length(10)->comment('Exp: nhà nước, cơ quan/doanh nghiệp,..');
            $table->string('type_detail')->length(10)->comment('Exp: trung ương, tổng công ty,...');
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
        Schema::dropIfExists('type_companys');
    }
}
