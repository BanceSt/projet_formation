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
        Schema::create('engagemts', function (Blueprint $table) {
            $table->unsignedBigInteger("author_id");
            $table->foreign("author_id")->references("id")->on("authors");

            $table->unsignedBigInteger("story_id");
            $table->foreign("story_id")->references("id")->on("stories");

            $table->boolean("follow");
            $table->boolean("favorite");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engagemts');
    }
};
