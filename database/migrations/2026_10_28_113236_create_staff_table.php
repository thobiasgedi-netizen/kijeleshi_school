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
        Schema::create('staff', function (Blueprint $table) {
    $table->id();
    $table->string('name');          // Jina la mwalimu/kiongozi
    $table->string('position');      // Nafasi yake (Mf: Headmaster)
    $table->string('image')->nullable(); // Picha yake
    $table->text('description')->nullable(); // Maelezo mafupi
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
