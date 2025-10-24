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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('species'); // gato, cachorro, etc
            $table->string('breed')->nullable(); // raça (opcional)
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->boolean('phone_accepts_calls')->default(true);
            $table->boolean('phone_accepts_whatsapp')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
