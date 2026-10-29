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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('title');                  // Jina au kichwa cha waraka (Mfano: Joining Instructions 2026)
            $table->string('file_path');              // Njia ya faili lililohifadhiwa (PDF, Docx, n.k)
            $table->string('category')->default('General'); // Kategoria ya waraka (Mfano: Exam, Joining, Circular)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
