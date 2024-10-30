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
        Schema::create('in_folders', function (Blueprint $table) {
            $table->unsignedBigInteger("folder_id");
            $table->foreign("folder_id")->references("id")->on("folders");

            $table->unsignedBigInteger("story_id");
            $table->foreign("story_id")->references("id")->on("stories");

            $table->primary(["folder_id", "story_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_folders');
    }
};
