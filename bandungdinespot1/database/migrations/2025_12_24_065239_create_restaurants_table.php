<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            // Relasi ke User (pemilik restoran)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            // Menambahkan jenis restoran (contoh: Sunda, Barat, Cafe)
            $table->string('type');
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            // Status verifikasi: pending, verified, rejected
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
};
