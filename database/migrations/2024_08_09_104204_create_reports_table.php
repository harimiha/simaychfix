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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_pegawai');
            $table->string('nomor_aset');
            $table->date('tanggal_pengajuan');
            $table->text('deskripsi_kerusakan');
            $table->string('foto');
            $table->integer('status')->default(0);
            $table->string('reason_reject')->nullable();
            $table->integer('process_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
