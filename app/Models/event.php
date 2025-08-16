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

    public function storelayouts()
    {
        return $this->hasMany(Storelayout::class);
    }

    public function admins()
    {
        return $this->belongsToMany(User::class, 'event_admins', 'event_id', 'admin_id');
    }
}
