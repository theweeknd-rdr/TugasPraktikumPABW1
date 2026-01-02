<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type', // Tambahkan jenis restoran
        'address',
        'description',
        'status',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
