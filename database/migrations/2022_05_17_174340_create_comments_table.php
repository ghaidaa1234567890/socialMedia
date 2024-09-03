<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user_comment')->unsigned();
            $table->foreign('id_user_comment')->references('id')
            ->on('users')->onDelete('cascade');

            $table->bigInteger('id_post')->unsigned();
            $table->foreign('id_post')->references('id')
            ->on('posts')->onDelete('cascade');
            $table->longText('text');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('comments');
    }
}
