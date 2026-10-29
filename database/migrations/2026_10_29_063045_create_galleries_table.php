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
        Schema::create('galleries', function (Blueprint $table) {
        $table->id();
        $table->string('title');             // Kichwa au jina la picha/tukio
        $table->string('image');             // Njia ya picha (Path)
        $table->text('description')->nullable(); // Maelezo ya ziada (Kama yapo)
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
