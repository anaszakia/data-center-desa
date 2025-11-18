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
        Schema::table('penduduk', function (Blueprint $table) {
            $table->string('agama', 50)->nullable()->after('status');
            $table->string('pendidikan_terakhir', 100)->nullable()->after('agama');
            $table->string('pekerjaan', 100)->nullable()->after('pendidikan_terakhir');
            $table->enum('status_dalam_keluarga', ['Kepala Keluarga', 'Istri', 'Anak', 'Lain-lain'])->nullable()->after('pekerjaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropColumn(['agama', 'pendidikan_terakhir', 'pekerjaan', 'status_dalam_keluarga']);
        });
    }
};
