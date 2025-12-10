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
        Schema::create('lenies', function (Blueprint $table) {
            $table->id();
            $table->string('nev');
            $table->text('leiras');
            $table->string('eredet')->nullable();
            $table->integer('ritka_sag_szint')->default(1); // 1-10 skála
            $table->boolean('aktiv')->default(true);
            $table->foreignId('kategoria_id')->constrained('kategorias')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lenies');
    }
};
