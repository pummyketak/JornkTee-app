<?php

use App\Models\event;
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
            $table->id();
            $table->foreignId('storemap_id')->constrained('events')->onDelete('cascade');
            $table->string('areanumber');
            $table->integer('price');
            $table->boolean('status')->default(true);
            $table->text('comment')->nullable();
            $table->integer('useridbooking');
            $table->string('nameuserbooking');
            $table->text('storedetail');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('confirmbooking')->default(true);
            $table->string('image_path')->nullable();
            $table->timestamps();
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
