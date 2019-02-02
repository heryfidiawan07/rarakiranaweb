<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_invoice');
            $table->integer('address_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->string('pengirim');
            $table->string('resi');
            $table->integer('total_price');
            $table->integer('total_weight');
            $table->integer('total_qty');
            $table->string('note');
            $table->string('kurir');
            $table->string('services');
            $table->integer('ongkir');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
