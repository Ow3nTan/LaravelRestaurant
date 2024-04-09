<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacedOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placed_order', function (Blueprint $table) {
            $table->id('order_id');
            $table->timestamp('order_time');
            $table->unsignedBigInteger('client_id');
            $table->string('delivery_address', 255);
            $table->tinyInteger('delivered')->default(0);
            $table->tinyInteger('canceled')->default(0);
            $table->string('cancellation_reason')->nullable();
            $table->foreign('client_id')->references('client_id')->on('client');
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
        Schema::dropIfExists('placed_order');
    }
}
