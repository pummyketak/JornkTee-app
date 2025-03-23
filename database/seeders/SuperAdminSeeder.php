<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ตรวจสอบว่ามี SuperAdmin อยู่แล้วหรือไม่
        if (User::where('type', 2)->exists()) {
            return; // ถ้ามี SuperAdmin อยู่แล้วไม่ต้องสร้างใหม่
        }

         // สร้าง SuperAdmin
         User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('Superadmin321;'), // เปลี่ยนเป็นรหัสที่คุณต้องการ
            'type' => 2, // ระบุว่าเป็น SuperAdmin
        ]);
    }
}
