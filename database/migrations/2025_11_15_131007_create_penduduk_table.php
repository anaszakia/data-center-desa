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
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique()->comment('Nomor Induk Kependudukan');
            $table->string('no_kk', 16)->nullable()->comment('Nomor Kartu Keluarga');
            $table->string('nama', 100)->comment('Nama Lengkap');
            $table->enum('jenis_kelamin', ['L', 'P'])->comment('L=Laki-laki, P=Perempuan');
            $table->string('tempat_lahir', 100)->comment('Tempat Lahir');
            $table->date('tanggal_lahir')->comment('Tanggal Lahir');
            $table->string('rt', 3)->nullable()->comment('RT');
            $table->string('rw', 3)->nullable()->comment('RW');
            $table->string('dukuh', 100)->nullable()->comment('Nama Dukuh/Dusun');
            $table->string('desa', 100)->comment('Nama Desa');
            $table->string('kecamatan', 100)->comment('Nama Kecamatan');
            $table->text('alamat_lengkap')->comment('Alamat Lengkap');
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'])->comment('Status Perkawinan');
            $table->string('nama_ayah', 100)->nullable()->comment('Nama Ayah');
            $table->string('nama_ibu', 100)->nullable()->comment('Nama Ibu');
            $table->string('no_hp', 15)->nullable()->comment('Nomor HP/WhatsApp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
