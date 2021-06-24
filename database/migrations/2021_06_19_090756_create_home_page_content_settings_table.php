<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageContentSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_content_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('slug', ['category', 'best_dish', 'popular_foods', '']);
            $table->string('heading')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('ids')->nullable();
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
        Schema::dropIfExists('home_page_content_settings');
    }
}
