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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // Menghubungkan pesanan dengan user yang login
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Menghubungkan pesanan dengan restoran yang dituju
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');

            // Data dari Form
            $table->date('date');          // Tanggal
            $table->string('time');        // Jam
            $table->string('pax');         // Jumlah Orang
            $table->string('name');        // Nama Pemesan
            $table->string('phone');       // Kontak
            $table->text('notes')->nullable(); // Catatan (Boleh kosong)

            // Status pesanan: pending (menunggu), confirmed (diterima), cancelled (batal)
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
