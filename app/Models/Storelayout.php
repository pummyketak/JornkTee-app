<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Storelayout extends Model
{
    //
    use HasFactory;

    protected $table = 'storelayouts'; // ระบุชื่อตาราง
    protected $fillable = [
        'areanumber',
        'price',
        'status',
        'comment',
        'useridbooking',
        'nameuserbooking',
        'storedetail',
        'start_date',
        'end_date',
        'confirmbooking',
        'image_path',
        'event_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
