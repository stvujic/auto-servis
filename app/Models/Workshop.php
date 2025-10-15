<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id','name','city','address','phone','description','is_verified','avg_rating'
    ];

    protected $casts = [
      'is_verified' => 'boolean',
        'avg_rating' => 'decimal:2',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function services()
    {
        return $this->hasMany(WorkshopService::class);
    }
    public function workingHours()
    {
        return $this->hasMany(WorkingHour::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function closedPeriods()
    {
        return $this->hasMany(ClosedPeriod::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
