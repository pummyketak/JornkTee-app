<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('storelayouts', function (Blueprint $table) {
            $table->id(); // คอลัมน์ ID หลัก (Primary Key)
            $table->string('areanumber'); // หมายเลขพื้นที่
            $table->integer('price'); // ราคา
            $table->boolean('status')->default(true); // สถานะ (เปิด/ปิด)
            $table->text('comment')->nullable(); // หมายเหตุ
            $table->integer('useridbooking'); // ID ผู้ใช้ที่จอง
            $table->string('nameuserbooking'); // ชื่อผู้ใช้ที่จอง
            $table->text('storedetail'); // รายละเอียดร้านค้า
            $table->date('start_date'); // วันที่เริ่มจอง
            $table->date('end_date'); // วันที่สิ้นสุดการจอง
            $table->boolean('confirmbooking')->default(true); // ยืนยันการจอง
            $table->string('image_path')->nullable(); // ที่อยู่ของรูปภาพ (สามารถเป็น null ได้)
            $table->timestamps(); // คอลัมน์ created_at และ updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storelayouts');
    }
};
