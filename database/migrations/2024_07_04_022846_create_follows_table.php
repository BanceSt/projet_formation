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
        Schema::create('follows', function (Blueprint $table) {
            $table->unsignedBigInteger("follow_id");
            $table->foreign("follow_id")->references("id")->on("users");

            $table->unsignedBigInteger("follower_id");
            $table->foreign("follower_id")->references("id")->on("users");

            $table->primary(["follow_id", "follower_id"]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
