<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaPenjualan extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'pic', 'id');
    }
}
