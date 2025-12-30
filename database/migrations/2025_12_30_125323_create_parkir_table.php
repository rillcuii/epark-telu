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
        Schema::create('parkir', function (Blueprint $table) {
            $table->char('id_parkir', 36)->primary();
            $table->char('users_id', 36);
            $table->char('kendaraan_id', 36);
            $table->char('qrcode_id', 36)->nullable()->comment('Nullable');
            $table->dateTime('waktu_masuk')->nullable();
            $table->dateTime('waktu_keluar')->nullable()->comment('Nullable');
            $table->enum('status', ['masuk', 'keluar'])->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('users_id')->references('id_user')->on('users');
            $table->foreign('kendaraan_id')->references('id_kendaraan')->on('kendaraan');
            $table->foreign('qrcode_id')->references('id_qrcode')->on('qrcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkir');
    }
};
