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
        Schema::create('story_variables', function (Blueprint $table) {
            $table->unsignedBigInteger("story_id");
            $table->foreign("story_id")->references("id")->on("stories");

            $table->unsignedBigInteger("variable_id");
            $table->foreign("variable_id")->references("id")->on("variables");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_variables');
    }
};
