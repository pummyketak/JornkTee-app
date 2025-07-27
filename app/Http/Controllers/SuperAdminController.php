<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function index()
    {
        // คำสั่งเพื่อดึงข้อมูลผู้ใช้ทั้งหมด
        $users = User::orderByDesc('type')->get();
        return view('superadminview', compact('users'));
    }

    public function view()
    {
        return $this->index();
    }

    public function promoteToAdmin($id)
    {
        $user = Auth::user();

        if ($user->type !== 2) {
            return redirect()->back()->with('error', 'คุณไม่มีสิทธิ์ดำเนินการนี้');
        }

        $targetUser = User::findOrFail($id);

        if ($targetUser->type !== 0) {
            return redirect()->back()->with('error', 'ผู้ใช้นี้ไม่สามารถอัปเกรดเป็น Admin ได้');
        }

        $targetUser->type = 1;
        $targetUser->save();

        return redirect()->back()->with('success', 'เปลี่ยนสถานะเป็น Admin สำเร็จ');
    }

    public function rollbackToUser($id)
    {
        $user = Auth::user();

        if ($user->type !== 2) {
            return redirect()->back()->with('error', 'คุณไม่มีสิทธิ์ดำเนินการนี้');
        }

        $targetUser = User::findOrFail($id);

        if ($targetUser->type !== 1) {
            return redirect()->back()->with('error', 'ผู้ใช้นี้ไม่สามารถเป็น User ได้');
        }

        $targetUser->type = 0;
        $targetUser->save();

        return redirect()->back()->with('success', 'เปลี่ยนสถานะเป็น User สำเร็จ');
    }

    public function deleteUser($id){
        $user = Auth::user();

        if ($user->type !== 2) {
            return redirect()->back()->with('error', 'คุณไม่มีสิทธิ์ดำเนินการนี้');
        }

        $targetUser = User::findOrFail($id);

        $targetUser->delete();

        return redirect()->back()->with('success', 'ลบผู้ใช้สำเร็จ');
    }

    public function manage_area(){
        $events = event::all();
        return view('superadmin_manage_area', compact('events'));
    }

    public function createEvent(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'plan_number' => 'required',
            'eventstart_date' => 'required|date',
            'eventend_date' => 'required|date|after_or_equal:eventstart_date',
            'detail' => 'nullable|string|max:255',
        ],
        [
            'plan_number.required' => '***กรุณาใส่หมายเลขผังงาน',
            'eventstart_date.required' => '***กรุณาใส่วันที่เริ่มต้น',
            'eventend_date.required' => '***กรุณาใส่วันที่สิ้นสุด',
            'eventend_date.after_or_equal' => '***วันที่สิ้นสุดต้องมากกว่าหรือเท่ากับวันที่เริ่มต้น',
            'detail.string' => '***รายละเอียดต้องเป็นข้อความ',
        ]);
        if ($validator->fails()) {
            return redirect('/superadmin/manage_area')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = [
            'plan_number' => $request->plan_number,
            'eventstart_date' => $request->eventstart_date,
            'eventend_date' => $request->eventend_date,
            'detail' => $request->detail ?? '',
        ];
        event::insert($data);
        return redirect('/superadmin/manage_area')->with('success', 'สร้างผังงานสำเร็จ');
    }

    public function deleteEvent($id)
    {   $user = Auth::user();
        if ($user->type !== 2) {
            return redirect()->back()->with('error', 'คุณไม่มีสิทธิ์ดำเนินการนี้');
        }

        $event = event::findOrFail($id);
        $event->delete();
        return redirect()->back()->with('success', 'ลบผังงานสำเร็จ');
    }

    public function editEvent($id)
    {
        $event = event::find($id);
        return view('superadmin_edit_area', compact('event'));
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate(
        [
            'plan_number' => 'required',
            'eventstart_date' => 'required|date',
            'eventend_date' => 'required|date|after_or_equal:eventstart_date',
            'detail' => 'nullable|string|max:255',
        ],
        [
            'plan_number.required' => '***กรุณาใส่หมายเลขผังงาน',
            'eventstart_date.required' => '***กรุณาใส่วันที่เริ่มต้น',
            'eventend_date.required' => '***กรุณาใส่วันที่สิ้นสุด',
            'eventend_date.after_or_equal' => '***วันที่สิ้นสุดต้องมากกว่าหรือเท่ากับวันที่เริ่มต้น',
            'detail.string' => '***รายละเอียดต้องเป็นข้อความ',
        ]
        );

        $data = [
            'plan_number' => $request->plan_number,
            'eventstart_date' => $request->eventstart_date,
            'eventend_date' => $request->eventend_date,
            'detail' => $request->detail ?? '',
        ];
        event::findOrFail($id)->update($data);
        return redirect()->route('eventpage', $id)->with('success', 'อัปเดตผังงานสำเร็จ');
    }

    public function eventpage($id){
        $event = event::find($id);
        return view('superadmin_event_page', compact('event'));
    }
}
