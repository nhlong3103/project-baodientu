<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->tinyInteger('reply_id')->default('0');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('baiviet_id')->unsigned();
            $table->tinyInteger('trang_thai')->default('0');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('baiviet_id')->references('id')->on('baiviet');
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
        Schema::dropIfExists('comment');
    }
}
