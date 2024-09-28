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
        Schema::create('cert_businesses', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->string('gender');
            $table->string('purok_num');
            $table->string('barangay_name');
            $table->string('business_name');
            $table->string('business_type');
            $table->string('or_number');
            $table->string('punongbarangay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_businesses');
    }
};
