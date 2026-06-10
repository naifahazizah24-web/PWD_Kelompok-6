<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('total_price');
            $table->string('payment_status')->default('pending'); // pending, success, expired
            $table->timestamps(); // created_at akan menjadi acuan hitung mundur 10 menit
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};