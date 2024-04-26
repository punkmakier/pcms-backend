<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deceased extends Model
{
    use HasFactory;
    protected $table = 'deceases';
    protected $fillable = [
        'fullname',
        'born',
        'died',
        'cemetery_location',
        'latitude',
        'longitude',
        'tax_fullname',
        'tax_contact',
        'address',
        'niche',
        'constructions',
        'excavation',
        'lapida_image',
        'date_of_permit',
    ];

}
