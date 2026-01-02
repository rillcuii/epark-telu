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
        // Tabel Users (Disesuaikan dengan SQL epark)
        Schema::create('users', function (Blueprint $table) {
            $table->char('id_user', 36)->primary(); // Menggunakan UUID char(36)
            $table->string('nama_user', 100)->nullable();
            $table->string('nim', 20)->nullable()->comment('Nullable');
            $table->string('username', 50)->nullable()->unique()->comment('Nullable');
            $table->string('password', 255)->nullable()->comment('Nullable');
            $table->string('email', 100)->nullable();
            $table->enum('role', ['admin', 'mahasiswa', 'satpam'])->nullable();
            $table->timestamps(); // Ini akan membuat created_at dan updated_at
        });

        // Tabel Password Reset (Bisa tetap dibiarkan bawaan Laravel)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabel Sessions (Disesuaikan karena ID User kamu menggunakan char(36))
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            // Ubah user_id dari foreignId menjadi char(36) agar cocok dengan id_user
            $table->char('user_id', 36)->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
