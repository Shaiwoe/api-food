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
        Schema::create('advertising_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('advertising_id');
            $table->foreign('advertising_id')->references('id')->on('advertising_images')->onDelete('cascade');

            $table->string('image');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertising_images');
    }
};
