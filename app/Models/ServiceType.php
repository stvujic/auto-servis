<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug'];

    public function workshopServices()
    {
        return $this->hasMany(WorkshopService::class);
    }
}
