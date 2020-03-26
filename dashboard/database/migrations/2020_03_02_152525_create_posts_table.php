<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('title');
            $table->text('content');
            $table->integer('views')->unsigned()->nullable();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
           
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table){
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
