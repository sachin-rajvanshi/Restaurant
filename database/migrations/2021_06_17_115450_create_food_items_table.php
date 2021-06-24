<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')->on('categories');
            $table->string('name');
            $table->string('slug');
            $table->string('remark')->nullable();
            $table->string('meta_title');
            $table->text('keyword');
            $table->longText('description');
            $table->enum('stock', ['Yes', 'No'])->default('Yes');
            $table->enum('inventory', ['Yes', 'No'])->default('Yes');
            $table->enum('cod', ['Yes', 'No'])->default('Yes');
            $table->enum('home_delivery', ['Yes', 'No'])->default('Yes');
            $table->enum('takeaway', ['Yes', 'No'])->default('Yes');
            $table->enum('status', ['Yes', 'No'])->default('Yes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_items');
    }
}
