<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bankaccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'bankaccount', // หากมีคอลัมน์อื่น เช่น 'bank_name', 'account_name', 'account_number' ควรเพิ่มที่นี่ด้วย
    ];
}
