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
            $table->string('plan_number'); // ชื่อแผนผัง เช่น "แผนผังตลาดหน้ามอ"
            $table->date('eventstart_date'); // วันที่เริ่มจอง
            $table->date('eventend_date'); // วันที่สิ้นสุดการจอง
            $table->text('detail')->nullable(); // คำอธิบายเพิ่มเติม
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
