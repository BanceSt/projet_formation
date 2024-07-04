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
        Schema::create('comments', function (Blueprint $table) {
            $table->unsignedBigInteger("author_id");
            $table->foreign("author_id")->references("id")->on("authors");

            $table->unsignedBigInteger("story_id");
            $table->foreign("story_id")->references("id")->on("stories");

            $table->text("content");
            $table->unsignedBigInteger("reply_to")->nullable();
            $table->foreign("reply_to")->references("id")->on("authors");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
