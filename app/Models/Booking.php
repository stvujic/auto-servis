<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public const STATUS = [
        'pending','approved','completed','rejected','canceled_by_user','no_show'
    ];
    protected $fillable = [
        'user_id','workshop_id','workshop_service_id',
        'scheduled_at','duration_minutes','status','notes'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
      'duration_minutes' => 'int',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function workshopService()
    {
        return $this->belongsTo(WorkshopService::class);
    }

}
