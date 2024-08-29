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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_procurement');
            $table->string('nomor_aset');
            $table->date('tanggal_pengajuan');
            $table->string('doc');
            $table->integer('status')->default(0);
            // 0 : - Proposal harga sedang ditinjau
            // 1 : - HOD telat menyetujui proposal harga
            // 2 : - PH ditolak oleh HOD
            // 3 : - CGM telah menyetujui PH
            // 4 : - PH ditolak oleh CGM
            $table->string('reason_reject')->nullable();
            $table->integer('process_hod_id')->nullable();
            $table->integer('process_cgm_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
