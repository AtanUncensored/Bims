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
        Schema::create('cert_unemployments', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->foreignId('request_id')->constrained()->onDelete('cascade');
            $table->string('address');
            $table->string('status');
            $table->string('parent_name');
            $table->date('date');
            $table->integer('age');
            $table->string('secretary');
            $table->string('treasurer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_unemployments');
    }
};
