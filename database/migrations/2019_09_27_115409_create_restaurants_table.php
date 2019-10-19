<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('kvk')->unique();
            $table->string('zipcode');
            $table->string('city');
            $table->string('phone')->unique();
            $table->string('avatar')->default('default.png');
            $table->string('email')->unique();
            $table->string('biography')->nullable();
            $table->string('user_id');
            $table->time('is_open')->nullable();
            $table->time('is_closed')->nullable();
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
        Schema::dropIfExists('restaurants');
    }
}
