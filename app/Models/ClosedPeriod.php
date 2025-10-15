<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosedPeriod extends Model
{
    use HasFactory;
    protected $fillable = ['workshop_id','starts_at','ends_at','reason'];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
}
