<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanObat extends Model
{
    use HasFactory;

    public function obats()
    {
        return $this->hasMany(Obat::class);
    }
}
