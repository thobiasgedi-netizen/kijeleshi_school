<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();    // Picha ya habari/tangazo
            $table->string('document')->nullable(); // Nyaraka (PDF, Word, n.k)
            $table->string('video')->nullable();    // Video ya tangazo
            $table->text('content');                // Maelezo kamili
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};