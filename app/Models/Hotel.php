<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'link_gmaps',
        'city_id',
        'slug',
        'country_id',
        'address',
        'start_level',
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function photos() {
        return $this->hasMany(HotelPhoto::class);
    }

    public function rooms() {
        return $this->hasMany(HotelRoom::class);
    }

    public function getLowestRoom() {
        $minPrice = $this->rooms()->min('price');
        return $minPrice ?? 0;
    }
}
