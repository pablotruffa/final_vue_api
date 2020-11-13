<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rs_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trace')->unsigned()->unique();
            $table->integer('status_id')->unsigned();
            $table->binary('cart');
            $table->timestamps();
            $table->softDeletes('deleted_at');
            $table->foreign('status_id')->references('id')->on('rs_order_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rs_orders');
    }
}
