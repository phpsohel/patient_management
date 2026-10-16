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
        Schema::create('patients', function (Blueprint $table) {
             $table->id();
        $table->string('name');
        $table->string('phone', 20)->unique();
        $table->string('email')->nullable();
        $table->unsignedTinyInteger('age')->nullable();
        $table->enum('gender', ['male', 'female', 'other']);
        $table->text('address')->nullable();
        $table->foreignId('user_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
