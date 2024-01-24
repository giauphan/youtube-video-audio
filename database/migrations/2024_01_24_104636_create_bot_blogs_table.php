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
        Schema::create('bot_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('bot_name');
            $table->string('post_url')->unique();
            $table->string('category_post');
            $table->string('lang');
            $table->integer('limit_blog');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_blogs');
    }
};
