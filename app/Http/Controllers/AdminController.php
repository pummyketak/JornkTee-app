<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storelayout;
use App\Models\User;
use App\Models\Bankaccount;
use App\Models\Image;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $storelayout=Storelayout::orderBy('areanumber')->get();
        $Bankaccount=Bankaccount::get();
        $Image=Image::get();
        return view('view',compact('storelayout','Bankaccount','Image'));
    }

    public function create()
    {   $storelayout = Storelayout::orderBy('areanumber')->get();
        $Bankaccount=Bankaccount::get();
        $Image=Image::get();
        return view('create',compact('storelayout','Bankaccount','Image'));
    }

    public function view()
    {
        $events = Auth::user()->managedEvents ?? [];
        return view('view',compact('events'));
    }

    public function insert(REquest $request, $eventId)
    {
        $event = Auth::user()->manageEvents()->find($eventId);
        if (!$event) {
            return redirect()->back()->with('error', 'คุณไม่มีสิทธิ์จัดการ Event นี้');
        }
        $validator = Validator::make($request->all(),
            [
                'areanumber'=>'required',
                'price'=>'required',
                'start_date'=>'required|date',
                'end_date'=>'required|date|after_or_equal:start_date',
                'comment'
            ],
            [
                'areanumber.required'=>'***กรุณาใส่หมายเลขล็อค',
                'start_date.required'=>'***กรุณาใส่ระยะเวลาการจัดงาน',
                'end_date.required'=>'***กรุณาใส่ระยะเวลาการจัดงาน',
                'end_date.after_or_equal' => '***วันที่สิ้นสุดงานต้องมากกว่าหรือเท่ากับวันที่เริ่มจัดงาน',
                'price.required'=>'***กรุณาใส่ราคา',
            ]
        );
        if ($validator->fails()) {
            return redirect('/admin/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // สร้าง Storelayout พร้อมเชื่อมโยงกับ Event
        $data=[
            'areanumber'=>$request->areanumber,
            'price'=>$request->price,
            'comment'=>$request->comment,
            'useridbooking'=> 0,
            'nameuserbooking'=> '',
            'storedetail'=> '',
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'event_id' => $eventId,
        ];
        Storelayout::insert($data);
        return redirect('/admin/create')->with('success', 'ข้อมูลล็อคถูกเพิ่มเรียบร้อยแล้ว');
    }

    public function delete($id)
    {
        $storelayout = Storelayout::where('id', $id)->whereHas('event', function ($query) {
            $query->whereIn('id', Auth::user()->manageEvents()->pluck('id'));
        })->first();

        if (!$storelayout) {
            return redirect()->back()->with('error', 'คุณไม่มีสิทธิ์ลบข้อมูลล็อคนี้');
        }
        $storelayout->delete();
        return redirect()->back()->with('success', 'ข้อมูลล็อคถูกลบเรียบร้อยแล้ว');
    }

    public function change($id)
    {
        $storelayout = Storelayout::where('id', $id)->whereHas('event', function ($query) {
            $query->whereIn('id', Auth::user()->manageEvents()->pluck('id'));
        })->first();

        if (!$storelayout) {
            return redirect()->back()->with('error', 'คุณไม่มีสิทธิ์เปลี่ยนสถานะล็อคนี้');
        }
        $storelayout->update([
            'status' => !$storelayout->status,
            'confirmbooking' => true,
            'useridbooking' => 0,
            'nameuserbooking' => '',
            'storedetail' => '',
            'image_path' => null,
        ]);
        return redirect('/admin/create');
    }

    public function edit($id)
    {
        $edit=Storelayout::find($id);
        return view('edit',compact('edit'));
    }

    public function update(REquest $request,$id)
    {
        $request->validate(
            [
                'areanumber'=>'required',
                'price'=>'required',
                'start_date'=>'required|date',
                'end_date'=>'required|date|after_or_equal:start_date',
                'comment'
            ],
            [
                'areanumber.required'=>'***กรุณาใส่หมายเลขล็อค',
                'start_date.required'=>'***กรุณาใส่ระยะเวลาการจัดงาน',
                'end_date.required'=>'***กรุณาใส่ระยะเวลาการจัดงาน',
                'end_date.after_or_equal' => '***วันที่สิ้นสุดงานต้องมากกว่าหรือเท่ากับวันที่เริ่มจัดงาน',
                'price.required'=>'***กรุณาใส่ราคา',
            ]
        );
        $data=[
            'areanumber'=>$request->areanumber,
            'price'=>$request->price,
            'comment'=>$request->comment,
            'useridbooking'=> 0,
            'nameuserbooking'=> '',
            'storedetail'=> '',
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'image_path' => null,
        ];
        Storelayout::find($id)->update($data);
        return redirect('/admin/create');

    }

    public function addbankaccount(Request $request, $eventId)
    {
        $event = Auth::user()->manageEvents()->find($eventId);
        if (!$event) {
            return redirect()->back()->with('error', 'คุณไม่มีสิทธิ์เพิ่มบัญชีธนาคารสำหรับ Event นี้');
        }

        $request->validate(
            [
                'addbankaccount' => 'required',
            ],
            [
                'addbankaccount.required' => '***กรุณาใส่หมายเลขบัญชี',
            ]
        );

        $data = [
            'bankaccount' => $request->addbankaccount,
            'event_id' => $eventId, // เชื่อมโยงกับ event
        ];
        Bankaccount::insert($data);
        return redirect('/admin/create');
    }

    public function deletebank($id)
    {
        $bankaccount = Bankaccount::where('id', $id)->whereHas('event', function ($query) {
            $query->whereIn('id', Auth::user()->manageEvents()->pluck('id'));
        })->first();

        if (!$bankaccount) {
            return redirect()->back()->with('error', 'คุณไม่มีสิทธิ์ลบบัญชีธนาคารนี้');
        }
        $bankaccount->delete();
        return redirect()->back()->with('success', 'ลบข้อมูลบัญชีธนาคารของ Event: ' . $bankaccount->event->name . ' สำเร็จ');
    }

    public function confirmbooking($id)
    {
        $status=Storelayout::find($id);
        if (!$status) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลล็อคที่ต้องการยืนยันการจอง');
        }
        $data=[
            'confirmbooking'=>!$status->confirmbooking,
        ];
        Storelayout::find($id)->update($data);
        return redirect('/admin/create');
    }

    public function adminuploadimage(Request $request, $eventId)
    {
        $event = Auth::user()->manageEvents()->find($eventId);
        if (!$event) {
            return back()->with('error', 'คุณไม่มีสิทธิ์อัปโหลดรูปภาพสำหรับ Event นี้');
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // ตรวจสอบข้อกำหนดของไฟล์ภาพ
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);

            Image::create([
                'image_path' => 'images/' . $imageName,
                'event_id' => $eventId,
            ]);
            return back()->with('success', 'อัปโหลดรูปภาพสำเร็จ');
        }
    }

    public function admindeleteimage($id)
    {
        $image = Image::where('id', $id)->whereHas('event', function ($query) {
            $query->whereIn('id', Auth::user()->manageEvents()->pluck('id'));
        })->first();

        if (!$image) {
            return back()->with('error', 'คุณไม่มีสิทธิ์ลบรูปภาพนี้');
        }

        // ตรวจสอบว่าไฟล์ภาพมีอยู่ในโฟลเดอร์หรือไม่
        $imagePath = public_path($image->image_path);
        if (file_exists($imagePath)) {
            // ลบไฟล์ภาพ
            unlink($imagePath);
        }

        // ลบข้อมูลของภาพจากฐานข้อมูล
        $image->delete();
        return redirect()->back()->with('success', 'ลบข้อมูลรูปภาพของ Event: ' . $image->event->name . ' สำเร็จ');
    }

    // public function myEvents()
    // {
    //     $events = Auth::user()->events; // Assuming a many-to-many relationship between User and Event
    //     return view('admin.events', compact('events'));

    // }

}
