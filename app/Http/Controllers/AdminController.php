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
        $storelayout=Storelayout::orderBy('areanumber')->get();
        $Bankaccount=Bankaccount::get();
        $events = event::all();
        $Image=Image::get();
        return view('view',compact('storelayout','Bankaccount','events','Image'));
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
        Storelayout::find($id)->delete();
        return redirect()->back();
    }

    public function change($id)
    {
        $status=Storelayout::find($id);
        $data=[
            'status'=>!$status->status,
            'confirmbooking'=> true,
            'useridbooking'=> 0,
            'nameuserbooking'=> '',
            'storedetail'=> '',
            'image_path' => null,
        ];
        Storelayout::find($id)->update($data);
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

    public function addbankaccount(REquest $request)
    {
        $request->validate(
            [
                'addbankaccount'=>'required',
            ],
            [
                'addbankaccount.required'=>'***กรุณาใส่หมายเลขบัญชี',
            ]
        );
        $data=[
            'bankaccount'=>$request->addbankaccount,
        ];
        Bankaccount::insert($data);
        return redirect('/admin/create');
    }

    public function deletebank($id)
    {
        Bankaccount::find($id)->delete();
        return redirect()->back();
    }

    public function confirmbooking($id)
    {
        $status=Storelayout::find($id);
        $data=[
            'confirmbooking'=>!$status->confirmbooking,
        ];
        Storelayout::find($id)->update($data);
        return redirect('/admin/create');
    }

    public function adminuploadimage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // ตรวจสอบข้อกำหนดของไฟล์ภาพ
        ]);

        if (Image::exists()) {
            return back()->with('error', 'มีรูปอยู่แล้ว ไม่สามารถอัปโหลดรูปได้');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension(); // สร้างชื่อไฟล์ใหม่โดยใช้ timestamp
            $image->move(public_path('images'), $imageName); // ย้ายไฟล์ภาพไปยังโฟลเดอร์ public/images

            // บันทึกที่อยู่ของไฟล์ภาพลงในฐานข้อมูล
            Image::create(['image_path' => 'images/'.$imageName]);
            return back()->with('success','อัปโหลดรูปภาพสำเร็จ');
        }
    }

    public function admindeleteimage($id)
    {
        $image = Image::find($id);
        if (!$image) {
            return back()->with('error', 'ไม่พบรูปภาพที่ต้องการลบ');
        }

        // ตรวจสอบว่าไฟล์ภาพมีอยู่ในโฟลเดอร์หรือไม่
        $imagePath = public_path($image->image_path);
        if (file_exists($imagePath)) {
            // ลบไฟล์ภาพ
            unlink($imagePath);
        }

        // ลบข้อมูลของภาพจากฐานข้อมูล
        $image->delete();
        return redirect()->back()->with('success', 'ลบรูปภาพสำเร็จ');
    }

    public function myEvents()
    {
        $events = Auth::user()->events; // Assuming a many-to-many relationship between User and Event
        return view('admin.events', compact('events'));

    }

}
