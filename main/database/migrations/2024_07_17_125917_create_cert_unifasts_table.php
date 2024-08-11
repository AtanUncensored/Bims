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
        Schema::create('cert_unifasts', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->foreignId('request_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->string('address');
            $table->string('parent_name');
            $table->string('punong_barangay');
            $table->string('secretary');
            $table->string('treasurer');
            $table->string('purpose');
            $table->string('age');
            $table->string('purok_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_unifasts');
    }
};
