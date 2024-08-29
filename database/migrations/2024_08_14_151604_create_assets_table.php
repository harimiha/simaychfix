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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_name');
            $table->string('asset_number');
            $table->string('asset_description')->nullable();
            $table->string('invoice_number');
            $table->string('vendor_name');
            $table->string('resp_center')->nullable();
            $table->date('date_in_service');
            $table->string('depreciation_method');
            $table->integer('life');
            $table->double('cost');
            $table->double('residual')->nullable();
            $table->double('depreciation_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
