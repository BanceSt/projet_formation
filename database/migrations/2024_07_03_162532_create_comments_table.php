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
            $table->id();

            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("story_id");
            $table->unsignedBigInteger("reply_to")->nullable();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("reply_to")->references("id")->on("comments");
            $table->foreign("story_id")->references("id")->on("stories");

            $table->text("content");
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
