<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ตรวจสอบว่ามี Admin อยู่แล้วหรือไม่
        if (User::where('type', 1)->exists()) {
            return; // ถ้ามี Admin อยู่แล้วไม่ต้องสร้างใหม่
        }

        // สร้าง Admin
        User::create([
            'name' => 'AdminSeeder',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Admin321;'), // เปลี่ยนเป็นรหัสที่คุณต้องการ
            'type' => 1, // ระบุว่าเป็น Admin
        ]);
    }
}
