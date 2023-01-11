<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Baiviet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baiviet', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de')->unique;
            $table->string('gioi_thieu');
            $table->string('anh_gioi_thieu');
            $table->longText('noi_dung');
            $table->tinyInteger('trang_thai');
            $table->bigInteger('danhmuc_id')->unsigned();
            $table->foreign('danhmuc_id')->references('id')->on('danhmuc');
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
        Schema::dropIfExists('baiviet');
    }
}
