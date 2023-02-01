<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = [
        'counter',
        'no_rm',
        'status_assesmen_perawat',
    ];
    public function getNoRmAttribute()
    {
        $pasien = Pasien::find($this->pasien_id);
        return $pasien->no_rm;
    }
    public function getCounterAttribute()
    {
        $item = Kunjungan::where('pasien_id', $this->pasien_id)->whereDate('tgl_masuk', '<=', $this->tgl_masuk)->count();
        return $item;
    }
    public function getStatusAssesmenDoktertAttribute()
    {
        $assesmen = AssesmenDokter::find($this->id);
        if (isset($assesmen)) {
            $status_assdok = $assesmen->status;
        } else {
            $status_assdok = null;
        }
        return  $status_assdok;
    }
    public function getStatusAssesmenPerawatAttribute()
    {
        $assesmen = AssesmenPerawat::find($this->id);
        if (isset($assesmen)) {
            $status = $assesmen->status;
        } else {
            $status = null;
        }
        return  $status;
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    public function assesmenperawat()
    {
        return $this->hasOne(AssesmenPerawat::class, 'id_kunjungan', 'id');
    }
    public function assesmendokter()
    {
        return $this->hasOne(AssesmenDokter::class, 'id_kunjungan', 'id');
    }
}
