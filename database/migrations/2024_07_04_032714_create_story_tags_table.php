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
        Schema::create('story_tags', function (Blueprint $table) {
            $table->unsignedBigInteger("story_id");
            $table->foreign("story_id")->references("id")->on("stories");

            $table->unsignedBigInteger("tag_id");
            $table->foreign("tag_id")->references("id")->on("tags");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_tags');
    }
};
