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
        Schema::create('kepessegs', function (Blueprint $table) {
            $table->id();
            $table->string('nev');
            $table->text('leiras')->nullable();
            $table->enum('tipus', ['fizikai', 'magikus', 'mentalis', 'egyeb'])->default('egyeb');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepessegs');
    }
};
