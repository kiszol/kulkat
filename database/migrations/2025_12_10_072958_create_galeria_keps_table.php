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
        Schema::create('galeria_keps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leny_id')->constrained('lenies')->onDelete('cascade');
            $table->string('kep_url');
            $table->string('cim')->nullable();
            $table->text('leiras')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeria_keps');
    }
};
