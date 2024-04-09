<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->timestamp('date_created');
            $table->unsignedBigInteger('client_id');
            $table->timestamp('selected_time');
            $table->integer('nbr_guests');
            $table->unsignedBigInteger('table_id');
            $table->tinyInteger('liberated')->default(0);
            $table->tinyInteger('canceled')->default(0);
            $table->string('cancellation_reason')->nullable();
            $table->foreign('client_id')->references('client_id')->on('client');
            $table->foreign('table_id')->references('table_id')->on('table');
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
        Schema::dropIfExists('reservation');
    }
}
