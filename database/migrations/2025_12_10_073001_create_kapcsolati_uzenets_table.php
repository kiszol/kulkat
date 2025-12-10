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
        Schema::create('kapcsolati_uzenets', function (Blueprint $table) {
            $table->id();
            $table->string('nev');
            $table->string('email');
            $table->string('targy');
            $table->text('uzenet');
            $table->boolean('elolvasva')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kapcsolati_uzenets');
    }
};
