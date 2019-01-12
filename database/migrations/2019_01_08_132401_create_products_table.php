<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('storefront_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->integer('price')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('weight')->default(0);
            $table->integer('dimensi')->default(0);
            $table->text('description');
            $table->tinyInteger('sticky')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('allowed_comment')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('storefront_id')->references('id')->on('storefronts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
