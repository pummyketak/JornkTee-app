<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bankaccount extends Model
{
    //
    use HasFactory;
    protected $fillable=[
        'bankaccount',
    ];
}
