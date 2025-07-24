<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class event extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_number', 'eventstart_date', 'eventend_date', 'detail'
    ];

}
