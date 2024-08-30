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

        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('full_name')->nullable();

            $table->integer('jumlah_siswa')->default(0);
            $table->integer('limit_siswa');

            $table->foreignId('cabang_id')->constrained('cabangs')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->onDelete('cascade');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('class_room_students', function (Blueprint $table) {
            $table->id();


            $table->foreignId('class_room_id')->constrained('class_rooms')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');

            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->onDelete('cascade');

            $table->unique(['student_id', 'tahun_ajaran_id']);


            $table->timestamps();
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('cascade');
            $table->foreignId('class_room_id')->constrained('class_rooms')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('student_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        // create table for nilai siswa each materi
        Schema::create('student_materi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')->constrained('materis')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->timestamps();
        });

        // create table for indikator
        Schema::create('indikators', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name');
            $table->foreignId('materi_id')->constrained('materis')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        // create table for nilai siswa each indikator
        Schema::create('student_indikator', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai')->nullable();

            $table->foreignId('indikator_id')->constrained('indikators')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_rooms');
        Schema::dropIfExists('class_room_students');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('student_subjects');
        Schema::dropIfExists('materis');
        Schema::dropIfExists('student_materi');
        Schema::dropIfExists('indikators');
        Schema::dropIfExists('student_indikator');
    }
};
