<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseVehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'service_id',
        'name',
        'vehicle_type',
        'lease_duration',
        'purpose_of_use',
        'location_of_use',
        'agreement',
        'comment',
        'status'
    ];
}
