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
        Schema::create('regulation_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('regulation_id')->constrained('regulations')->onDelete('cascade');
            $table->string('name');
            $table->string('path'); // Lokasi penyimpanan file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regulation_attachments');
    }
};
