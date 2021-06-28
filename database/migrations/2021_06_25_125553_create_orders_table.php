<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('invoice_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->text('cart');
            $table->string('name');
            $table->string('email');
            $table->string('mobile_number');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->text('address');
            $table->double('total_amount');
            $table->double('offer_amount');
            $table->double('discount')->nullable();
            $table->double('discount_amount')->nullable();
            $table->double('tax_amount')->nullable();
            $table->double('tax_percent')->nullable();
            $table->enum('payment_method', ['cod', 'stripe', 'upi', 'paypal', 'card', 'wallet', 'cash', 'cheque', 'bank-transfer', 'pos'])->nullable();
            $table->enum('delivery_type', ['pick-up', 'home-delivery'])->nullable();
            $table->enum('status', ['Pending', 'Confirmed', 'Processing', 'Delivered', 'Cancelled'])->default('Pending');
            $table->text('device_info')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
