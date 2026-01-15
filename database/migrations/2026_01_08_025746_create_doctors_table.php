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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poli_id')->constrained()->onDelete('cascade');
            $table->string('name'); // <--- Harus ada
            $table->string('schedule_day'); // <--- Harus ada
            $table->time('start_time'); // <--- Harus ada
            $table->time('end_time'); // <--- Harus ada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
