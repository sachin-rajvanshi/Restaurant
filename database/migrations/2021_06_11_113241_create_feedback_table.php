<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('mobile_number');
            $table->string('applications');
            $table->text('feedback');
            $table->enum('approve_status', ['Pending', 'Approved'])->default('Pending');
            $table->enum('added_by', ['Admin', 'Customer'])->nullable();
            $table->enum('status', ['Yes', 'No'])->default('No');
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
        Schema::dropIfExists('feedback');
    }
}
