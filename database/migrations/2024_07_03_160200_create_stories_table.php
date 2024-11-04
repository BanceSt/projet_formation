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
            $table->text("note")->nullable();
            $table->text("illustration")->nullable();
            $table->longText("content");
            $table->text("question");
            $table->text("reponse")->nullable();
            $table->boolean("start")->default(False);
            $table->boolean("end")->default(False);
            $table->timestamps();

            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");

            $table->unsignedBigInteger("father_id")->nullable();
            $table->foreign("father_id")->references("id")->on("stories");

            $table->unsignedBigInteger("root_id")->nullable();
            $table->foreign("root_id")->references("id")->on("stories");
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
