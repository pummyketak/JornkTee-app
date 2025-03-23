<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
}
