<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->string('title');
            $table->string('tag_one');
            $table->string('tag_two');
            $table->string('section_one_image');
            $table->longText('section_one_description');
            $table->string('section_two_image');
            $table->longText('section_two_description');
            $table->string('food_items');
            $table->string('clients_daily');
            $table->string('years_of_experience');
            $table->string('fresh_halal');
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
        Schema::dropIfExists('abouts');
    }
}
