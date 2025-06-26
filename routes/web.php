<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->type == 2) {
            // ถ้าเป็น SuperAdmin (type = 2) ให้ redirect ไปยัง route ของ SuperAdmin
            return redirect()->route('superadminview');
        }
        return Auth::user()->type == 1
            ? redirect()->route('view') // ✅ Admin → ไปที่ route ของ AdminController@index
            : redirect()->route('userview'); // ✅ User → ไปที่ route ของ UserController@index
    }
    return redirect()->route('login'); // ถ้ายังไม่ได้ Login ให้ไปหน้า Login
});

// 📌 Route สำหรับ Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/create', [AdminController::class,'create'])->name('create'); // ✅ เปลี่ยนชื่อ route
    Route::get('/view', [AdminController::class,'view'])->name('view'); // ✅ เปลี่ยนชื่อ route
    Route::post('/insert',[AdminController::class,'insert'])->name('insert');
    Route::get('/delete/{id}', [AdminController::class,'delete'])->name('delete');
    Route::get('/change/{id}', [AdminController::class,'change'])->name('change');
    Route::get('/edit/{id}', [AdminController::class,'edit'])->name('edit');
    Route::post('/update/{id}',[AdminController::class,'update'])->name('update');
    Route::post('/addbankaccount',[AdminController::class,'addbankaccount'])->name('addbankaccount');
    Route::get('/confirmbooking/{id}', [AdminController::class,'confirmbooking'])->name('confirmbooking');
    Route::get('/deletebank/{id}', [AdminController::class,'deletebank'])->name('deletebank');
    Route::post('/adminuploadimage', [AdminController::class,'adminuploadimage'])->name('adminuploadimage');
    Route::get('/admindeleteimage/{id}',[AdminController::class,'admindeleteimage'])->name('admindeleteimage');
});

// 📌 Route สำหรับ User
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/view', [UserController::class, 'userview'])->name('userview');
    Route::post('/booking/{id}', [UserController::class, 'booking'])->name('booking');
    Route::get('/cancelbooking/{id}', [UserController::class, 'cancelbooking'])->name('cancelbooking');
    Route::get('/viewbooking', [UserController::class, 'viewbooking'])->name('viewbooking');
    Route::get('/storedetail/{id}', [UserController::class, 'addStoredetail'])->name('storedetail');
    Route::get('/ticket', [UserController::class, 'userticket'])->name('userticket');
    Route::post('/uploadimage/{id}', [UserController::class, 'uploadimage'])->name('uploadimage');
    Route::get('/deleteimage/{id}', [UserController::class, 'deleteimage'])->name('deleteimage');
});

Route::middleware(['auth'])->prefix('superadmin')->group(function () {
    Route::get('/view', [SuperAdminController::class, 'view'])->name('superadminview');
    Route::post('/superadmin/promote-to-admin/{id}', [SuperAdminController::class, 'promoteToAdmin'])->name('promoteToAdmin');
    Route::post('/superadmin/rollback-to-user/{id}', [SuperAdminController::class, 'rollbackToUser'])->name('rollbackToUser');
    Route::get('/superadmin/delete-to-user/{id}', [SuperAdminController::class, 'deleteUser'])->name('deleteUser');
});

// Auth::routes();

require __DIR__.'/auth.php';
