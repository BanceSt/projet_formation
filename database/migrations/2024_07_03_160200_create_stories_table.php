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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string("title", 255);
            $table->text("accroche")->nullable();
            $table->text("illustration")->nullable();
            $table->longText("content");
            $table->timestamps();

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");

            // $table->foreignId("author_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
