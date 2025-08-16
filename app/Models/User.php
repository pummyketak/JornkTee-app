<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'areaid',
        'userstoredetail',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->type === 1; // ถ้า type เป็น 1 แสดงว่าเป็น Admin
    }

    public function isSuperAdmin()
    {
        return $this->type === 2; // เฉพาะ Super Admin เท่านั้น
    }

    public function managedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_admins', 'admin_id', 'event_id');
    }
    // public function scopeAdmins($query)
    // {
    //     return $query->where('type', 1); // Filter สำหรับผู้ใช้ที่เป็น Admin
    // }

    // public function scopeSuperAdmins($query)
    // {
    //     return $query->where('type', 2); // Filter สำหรับผู้ใช้ที่เป็น Super Admin
    // }

    // public function scopeRegularUsers($query)
    // {
    //     return $query->where('type', 0); // Filter สำหรับผู้ใช้ที่เป็น User ปกติ
    // }

    //  public function managedEvents()
    // {
    //     return $this->hasMany(Event::class, 'admin_id'); // Assuming 'admin_id' is the foreign key in the events table
    // }

}
