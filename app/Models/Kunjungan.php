<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $appends = [
        'counter',
    ];

    public function getCounterAttribute()
    {
        $item = Kunjungan::where('pasien_id', $this->pasien_id)->whereDate('tgl_masuk', '<=', $this->tgl_masuk)->count();
        return $item;
    }


    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
