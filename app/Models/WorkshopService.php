<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopService extends Model
{
    use HasFactory;

    protected $fillable = ['workshop_id','service_type_id','duration_minutes','price'];

    protected $casts = [
      'duration_minutes' => 'int',
      'price' => 'decimal:2',
    ];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
