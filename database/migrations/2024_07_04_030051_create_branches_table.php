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
        Schema::create('branches', function (Blueprint $table) {
            $table->unsignedBigInteger("story_from_id");
            $table->foreign("story_from_id")->references("id")->on("stories");

            $table->unsignedBigInteger("story_to_id");
            $table->foreign("story_to_id")->references("id")->on("stories");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
