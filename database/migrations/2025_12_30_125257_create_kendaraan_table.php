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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->char('id_kendaraan', 36)->primary();
            $table->char('users_id', 36);
            $table->string('nomor_polisi', 15)->nullable();
            $table->string('model_kendaraan', 50)->nullable();
            $table->string('warna_kendaraan', 30)->nullable();
            $table->text('url_foto_kendaraan')->nullable();
            $table->text('url_foto_stnk')->nullable()->comment('Nullable');
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
        Schema::dropIfExists('kendaraan');
    }
};
