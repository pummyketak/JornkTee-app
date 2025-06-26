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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ชื่อแผนผัง เช่น "แผนผังตลาดหน้ามอ"
            $table->text('description')->nullable(); // คำอธิบายเพิ่มเติม
            $table->string('image_path')->nullable(); // รูปภาพของแผนผัง
            $table->date('eventstart_date'); // วันที่เริ่มจอง
            $table->date('eventend_date'); // วันที่สิ้นสุดการจอง
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
