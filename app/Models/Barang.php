<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    protected $appends = [
        'user_entry',
        'stok',
    ];
    public function getUserEntryAttribute()
    {
        $item = User::find($this->pic);
        return  $item->name ?? '-';
    }
    public function getStokAttribute()
    {
        $stok_in = NotaPembelian::where('barang_id', $this->id)->get('jumlah')->sum('jumlah');
        // $stok_out = NotaPembelian::where('barang_id', $this->id)->get('jumlah')->sum('jumlah');
        $stok = $stok_in;
        return  $stok;
    }
}
