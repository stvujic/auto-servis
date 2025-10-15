<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    use HasFactory;
    protected $fillable = [
        'workshop_id','day_of_week','open_at','close_at','break_start','break_end'
    ];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
}
