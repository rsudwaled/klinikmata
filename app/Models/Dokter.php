<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    protected $appends = [
        'user_entry',
    ];

    public function getUserEntryAttribute()
    {
        $item = User::find($this->pic);
        return  $item->name ?? '-';
    }
}
