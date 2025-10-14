<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $fillable = ['name','slug'];

    public function workshopServices()
    {
        return $this->hasMany(WorkshopService::class);
    }
}
