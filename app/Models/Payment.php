<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'uid',
        'date_paid',
        'kind',
        'permit_no',
        'or_no',
        'tax_amount',
        'total',
        'tax_due_date',
        'tax_due_date_no',
    ];
}
