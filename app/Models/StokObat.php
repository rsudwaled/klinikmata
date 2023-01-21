<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokObat extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    protected $appends = [
        'user_entry',
        'total_harga',
    ];
    public function getUserEntryAttribute()
    {
        $item = User::find($this->pic);
        return  $item->name ?? '-';
    }
    public function getTotalHargaAttribute()
    {
        $ppn = $this->harga_beli * $this->ppn / 100;
        $pph = $this->harga_beli * $this->pph / 100;
        $diskon = $this->harga_beli * $this->diskon / 100;
        $total = $this->harga_beli + $ppn + $pph - $diskon;
        return  $total;
    }


    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriObat::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
