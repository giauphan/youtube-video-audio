<?php

use App\Enums\VideoStatus;
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
        Schema::table('youtube_videos', function (Blueprint $table) {
            $table->string('status')->default(VideoStatus::Active)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('youtube_videos', function (Blueprint $table) {
            //
        });
    }
};
