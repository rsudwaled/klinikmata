<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    protected $appends = [
        'stok',
    ];
    public function getStokAttribute()
    {
        $stok_in = NotaPembelian::where('barang_id', $this->id)->get('jumlah')->sum('jumlah');
        $stok_out = NotaPenjualan::where('barang_id', $this->id)->get('jumlah')->sum('jumlah');
        $stok = $stok_in - $stok_out;
        return $stok;
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pic', 'id');
    }
}
