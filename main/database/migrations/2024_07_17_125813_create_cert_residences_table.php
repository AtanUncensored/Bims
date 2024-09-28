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
        Schema::create('cert_residences', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('gender');
            $table->string('residency_status');
            $table->string('barangay');
            $table->string('purok_number');
            $table->date('date');
            $table->string('punongbarangay');
            $table->string('secretary');
            $table->integer('OR_number');
            $table->string('treasurer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_residences');
    }
};
