<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('ticket_category_id')->constrained('ticket_categories')->onDelete('cascade');
            $table->string('serial_number')->unique();
            $table->text('qr_code'); // String data transaksi terenkripsi
            $table->string('ticket_status')->default('active'); // active, used
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
