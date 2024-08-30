<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'materi_id',
        'code',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_mulai' => 'datetime:H:i',
        'waktu_selesai' => 'datetime:H:i',
    ];

    public function getWaktuMulaiAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function getWaktuSelesaiAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    // Mutator
    public function setWaktuMulaiAttribute($value)
    {
        $this->attributes['waktu_mulai'] = \Carbon\Carbon::createFromFormat('H:i', $value)->format('H:i:s');
    }

    public function setWaktuSelesaiAttribute($value)
    {
        $this->attributes['waktu_selesai'] = \Carbon\Carbon::createFromFormat('H:i', $value)->format('H:i:s');
    }

    public static function generateCode(
        string $tanggal,
        string $waktuMulai,
        string $waktuSelesai,
        int $materiId
    ) {
        return md5($tanggal . $waktuMulai . $waktuSelesai . $materiId);
    }

    // public function verifyCode(string $code)
    // {
    //     return $this->code === $code;
    // }



    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id', 'id');
    }

    public function pertemuanStudents()
    {
        return $this->hasMany(PertemuanStudent::class);
    }
}
