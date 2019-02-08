<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_order');
            $table->integer('address_id')->unsigned();
            $table->text('cart');
            $table->string('kurir_resi');
            $table->integer('total_price');
            $table->integer('total_weight');
            $table->integer('total_qty');
            $table->string('note');
            $table->string('kurir');
            $table->string('services');
            $table->integer('ongkir');
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
