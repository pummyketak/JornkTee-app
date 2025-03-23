<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Storelayout;
use App\Models\Bankaccount;
use App\Models\Image;

class UserController extends Controller
{
    // แสดงหน้าหลักของผู้ใช้
    public function index()
    {
        $storelayout = Storelayout::where('status', true)->orderBy('areanumber')->get();
        $Image = Image::all();
        return view('userview', compact('storelayout', 'Image'));
    }

    // แสดงหน้า userview
    public function userview()
    {
        return $this->index();
    }

    // จองพื้นที่
    public function booking(Request $request, $id)
    {
        $storelayout = Storelayout::findOrFail($id);

        if ($storelayout->status == false) {
            return redirect()->route('userview')->with('error', 'ล็อคนี้ถูกจองแล้ว');
        }

        $request->validate([
            'storedetail' => 'required',
        ], [
            'storedetail.required' => '***กรุณาใส่รายละเอียดร้าน',
        ]);

        $storelayout->update([
            'status' => false,
            'useridbooking' => Auth::id(),
            'storedetail' => $request->storedetail,
            'nameuserbooking' => Auth::user()->name,
        ]);

        return redirect()->route('viewbooking')->with('success', 'จองสำเร็จ!');
    }

    // ยกเลิกการจอง
    public function cancelbooking($id)
    {
        Storelayout::findOrFail($id)->update([
            'status' => true,
            'useridbooking' => null,
            'storedetail' => '',
            'nameuserbooking' => '',
            'confirmbooking' => true,
            'image_path' => null,
        ]);
        return redirect()->back()->with('success', 'ยกเลิกการจองเรียบร้อย');
    }

    // แสดงล็อคที่จอง
    public function viewbooking()
    {
        $userId = Auth::id();
        $storelayout = Storelayout::where('status', false)->where('useridbooking', $userId)->orderBy('areanumber')->get();
        $Image = Image::all();
        $Bankaccount = Bankaccount::all();
        return view('userbooking', compact('storelayout', 'Bankaccount', 'Image'));
    }

    // แสดงตั๋วของผู้ใช้
    public function userticket()
    {
        $userId = Auth::id();
        $storelayout = Storelayout::where('status', false)->where('useridbooking', $userId)->where('confirmbooking', false)->orderBy('areanumber')->get();
        $Image = Image::all();
        return view('userticket', compact('storelayout', 'Image'));
    }

    // เพิ่มรายละเอียดร้านค้า
    public function addStoredetail($id)
    {
        $storelayout = Storelayout::where('status', true)->orderBy('areanumber')->get();
        return view('userstoredetail', compact('storelayout'));
    }

    // อัปโหลดรูปภาพ
    public function uploadimage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $storelayout = Storelayout::where('id', $id)->whereNull('image_path')->first();
        if (!$storelayout) {
            return back()->with('error', 'มีรูปอยู่แล้ว ไม่สามารถอัปโหลดได้');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $storelayout->update(['image_path' => 'images/' . $imageName]);
            return back()->with('success', 'อัปโหลดรูปภาพสำเร็จ');
        }
    }

    // ลบรูปภาพ
    public function deleteimage($id)
    {
        $storelayout = Storelayout::findOrFail($id);
        $storelayout->update(['image_path' => null]);
        return redirect()->route('viewbooking')->with('success', 'ลบรูปภาพเรียบร้อย');
    }
}
