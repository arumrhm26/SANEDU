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

        Schema::create('tahun_ajarans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('mulai');
            $table->date('selesai');
            $table->boolean('aktif')->default(false);

            $table->unique(['name', 'mulai', 'selesai']);

            $table->softDeletes();
            $table->timestamps();
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun_ajarans');
    }
};