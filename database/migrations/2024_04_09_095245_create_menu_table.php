<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('menu_name', 100);
            $table->string('menu_description', 255);
            $table->decimal('menu_price', 6, 2);
            $table->string('menu_image', 255);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('menu_category');
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
        Schema::dropIfExists('menu');
    }
}
