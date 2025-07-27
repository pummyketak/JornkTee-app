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
            return redirect()->route('superadminview');
        }
        return Auth::user()->type == 1
            ? redirect()->route('view')
            : redirect()->route('userview');
    }
    return redirect()->route('login');
});

//Route สำหรับ Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/create', [AdminController::class,'create'])->name('create');
    Route::get('/view', [AdminController::class,'view'])->name('view');
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

//Route สำหรับ User
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
    Route::post('/promote-to-admin/{id}', [SuperAdminController::class, 'promoteToAdmin'])->name('promoteToAdmin');
    Route::post('/rollback-to-user/{id}', [SuperAdminController::class, 'rollbackToUser'])->name('rollbackToUser');
    Route::get('/delete-to-user/{id}', [SuperAdminController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/manage_area',[SuperAdminController::class,'manage_area'])->name('manage_area');
    Route::post('/create_event', [SuperAdminController::class, 'createEvent'])->name('createEvent');
    Route::get('/delete_event/{id}',[SuperAdminController::class,'deleteEvent'])->name('deleteEvent');
    Route::get('/edit_event/{id}',[SuperAdminController::class,'editEvent'])->name('editEvent');
    Route::post('/update_event/{id}',[SuperAdminController::class,'updateEvent'])->name('updateEvent');
    Route::get('/eventpage/{id}', [SuperAdminController::class, 'eventpage'])->name('eventpage');
});
// Auth::routes();

require __DIR__.'/auth.php';
