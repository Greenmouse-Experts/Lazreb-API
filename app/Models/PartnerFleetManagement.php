<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerFleetManagement extends Model
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
        'partnership_type',
        'vehicle_type',
        'no_of_vehicles',
        'nin',
        'company_name',
        'company_address',
        'cac_number',
        'agreement',
        'comment',
        'status'
    ];
}
