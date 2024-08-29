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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_procurement');
            $table->string('nomor_po');
            $table->date('tanggal_po');
            $table->string('nama_vendor');
            $table->string('vendor_company')->nullable();
            $table->string('vendor_address')->nullable();
            $table->string('vendor_phone')->nullable();
            $table->string('vendor_email')->nullable();
            $table->double('sub_total')->default(0);
            $table->string('discount')->default(0);
            $table->double('total')->default(0);
            $table->text('catatan')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
