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

        Schema::create('pertemuan_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            // unique code for qr
            $table->string('code')->unique();

            $table->foreignId('materi_id')->constrained('materis')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pertemuan_students', function (Blueprint $table) {
            $table->id();
            $table->time('jam_masuk')->nullable();

            $table->foreignId('pertemuan_status_id')->constrained('pertemuan_statuses')->onDelete('cascade');
            $table->foreignId('pertemuan_id')->constrained('pertemuans')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuan_statuses');
        Schema::dropIfExists('pertemuans');
        Schema::dropIfExists('pertemuan_students');
    }
};
