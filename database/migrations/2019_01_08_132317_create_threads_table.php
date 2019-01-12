<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->tinyInteger('sticky')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('allowed_comment')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
