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
        Schema::create('advertisings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('category_advertisings')->onDelete('cascade');

            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->string('type')->nullable();
            $table->string('call')->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();

            $table->string('primary_image')->nullable();
            $table->string('image')->nullable();

            $table->string('instagram')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('rubika')->nullable();
            $table->string('telegram')->nullable();

            $table->boolean('approved')->default(0);
            $table->string('status')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisings');
    }
};
