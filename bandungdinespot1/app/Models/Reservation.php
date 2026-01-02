<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'date',
        'time',
        'pax',
        'name',
        'phone',
        'notes',
        'status',
    ];

    /**
     * Relasi: Reservasi milik satu User (Pemesan).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Reservasi milik satu Restoran.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
