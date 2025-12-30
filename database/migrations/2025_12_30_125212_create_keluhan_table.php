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
        Schema::create('keluhan', function (Blueprint $table) {
            $table->char('id_keluhan', 36)->primary();
            $table->char('users_id', 36);
            $table->string('judul_keluhan', 100)->nullable();
            $table->text('keterangan_keluhan')->nullable();
            $table->enum('status_keluhan', ['belum_ditangani', 'sedang_ditangani', 'sudah_ditangani'])->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('users_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluhan');
    }
};
