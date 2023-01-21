<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    protected $appends = [
        'user_entry',
        'satuan_obat',
        'stok_current',
    ];
    public function getUserEntryAttribute()
    {
        $item = User::find($this->pic);
        return  $item->name ?? '-';
    }
    public function getStokCurrentAttribute()
    {
        $stok_in = StokObat::where('obat_id', $this->id)->get('stok_in')->sum('stok_in');
        $stok_out = StokObat::where('obat_id', $this->id)->get('stok_out')->sum('stok_out');
        $stok_current = $stok_in  -  $stok_out;
        return  $stok_current;
    }
    public function getSatuanObatAttribute()
    {
        $satuan = SatuanObat::find($this->id);
        if (isset($satuan)) {
            $satuan = $satuan->nama;
        }
        return  $satuan;
    }

    public function satuan()
    {
        return $this->belongsTo(SatuanObat::class);
    }
}
