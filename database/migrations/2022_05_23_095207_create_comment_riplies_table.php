<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentRipliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_riplies', function (Blueprint $table) {
            $table->id();
            
           
           
            $table->bigInteger('id_replie')->unsigned();
            $table->foreign('id_replie')->references('id')
             ->on('replies')->onDelete('cascade');
           
             $table->bigInteger('id_comment')->unsigned();
             $table->foreign('id_comment')->references('id')
             ->on('comments')->onDelete('cascade');
     
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
        Schema::dropIfExists('comment_riplies');
    }
}
