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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('category_article')->onDelete('cascade');

            $table->string('type')->default(0);
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('body');
            $table->string('image');
            $table->string('video')->nullable();
            $table->string('voice')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('viewCount')->default(0);
            $table->integer('commentCount')->default(0);
            $table->integer('likeCount')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
