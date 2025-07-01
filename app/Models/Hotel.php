<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'city', 'nit', 'max_rooms', 'city_id'];

    protected $casts = [
        'max_rooms' => 'integer',
    ];

    public function rooms()
    {
        return $this->hasMany(HotelRoom::class);
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }


}
