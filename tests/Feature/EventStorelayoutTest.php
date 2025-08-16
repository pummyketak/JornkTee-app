<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Storelayout;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventStorelayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_has_storelayouts()
    {
        $event = Event::factory()->create(); // สร้าง Event
        $storelayout = Storelayout::factory()->create(['event_id' => $event->id]); // สร้าง Storelayout ที่เชื่อมโยงกับ Event

        $this->assertTrue($event->storelayouts->contains($storelayout)); // ตรวจสอบความสัมพันธ์
    }

    public function test_storelayout_belongs_to_event()
    {
        $event = Event::factory()->create(); // สร้าง Event
        $storelayout = Storelayout::factory()->create(['event_id' => $event->id]); // สร้าง Storelayout ที่เชื่อมโยงกับ Event

        $this->assertEquals($event->id, $storelayout->event->id); // ตรวจสอบความสัมพันธ์
    }

    public function test_event_without_storelayouts()
    {
        $event = Event::factory()->create(); // สร้าง Event โดยไม่มี Storelayout

        $this->assertCount(0, $event->storelayouts); // ตรวจสอบว่าไม่มี Storelayout
    }

    public function test_deleting_event_deletes_storelayouts()
    {
        $event = Event::factory()->create();
        $storelayout = Storelayout::factory()->create(['event_id' => $event->id]);

        $event->delete(); // ลบ Event

        $this->assertDatabaseMissing('storelayouts', ['id' => $storelayout->id]); // ตรวจสอบว่า Storelayout ถูกลบ
    }

    public function test_deleting_storelayout_does_not_delete_event()
    {
        $event = Event::factory()->create();
        $storelayout = Storelayout::factory()->create(['event_id' => $event->id]);

        $storelayout->delete(); // ลบ Storelayout

        $this->assertDatabaseHas('events', ['id' => $event->id]); // ตรวจสอบว่า Event ยังคงอยู่
    }
}
