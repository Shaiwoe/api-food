<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreignId('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->boolean('status')->default(0);

            $table->string('name');
            $table->string('code_meli');
            $table->string('phone');
            $table->string('email');
            $table->string('phone_home');
            $table->text('address');

            $table->string('name_shop');
            $table->string('type_shop');
            $table->string('phone_shop');
            $table->string('city_shop');
            $table->text('address_shop');

            $table->text('maps');
            $table->text('image_data');

            $table->string('banks');
            $table->string('shaba');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
