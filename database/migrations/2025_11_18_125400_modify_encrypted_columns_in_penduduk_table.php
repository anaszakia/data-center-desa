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
            $table->dropUnique(['nik']);
        });
        
        Schema::table('penduduk', function (Blueprint $table) {
            $table->text('nik')->change();
            $table->text('no_kk')->nullable()->change();
            $table->text('no_hp')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->string('nik', 16)->change();
            $table->string('no_kk', 16)->nullable()->change();
            $table->string('no_hp', 15)->nullable()->change();
        });
        
        Schema::table('penduduk', function (Blueprint $table) {
            $table->unique('nik');
        });
    }
};
