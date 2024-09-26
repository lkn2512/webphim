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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id')->nullable(); // Khi phim không có phần
            $table->unsignedBigInteger('season_id')->nullable(); // Khi phim có phần
            $table->integer('episode_number');
            $table->string('episode_title');
            $table->text('episode_description')->nullable();
            $table->time('duration');
            $table->string('status')->default('active');
            $table->timestamps();

            // Tạo khóa ngoại liên kết với bảng movies
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');

            // Tạo khóa ngoại liên kết với bảng seasons
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
