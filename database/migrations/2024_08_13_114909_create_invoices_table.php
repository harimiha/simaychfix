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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('purchase_order_id');
            $table->string('nama_procurement');
            $table->string('nomor_invoice');
            $table->date('tanggal_invoice');
            $table->string('file');
            $table->string('proof')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('status')->default(0)->comment('0: Menunggu Pembayaran 1: Invoice telah dibayar');
            $table->integer('finance_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
