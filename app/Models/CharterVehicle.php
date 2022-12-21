<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharterVehicle extends Model
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
        'pick_up_address',
        'drop_off_address',
        'start_date',
        'return_date',
        'start_time',
        'return_time',
        'vehicle_type',
        'charter_type',
        'purpose_of_use',
        'agreement',
        'comment',
        'status'
    ];
}
