<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'booking_id','user_id','workshop_id','rating','comment','is_approved'
    ];

    protected $casts = [
      'is_approved' => 'boolean',
      'rating' => 'int'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
}
