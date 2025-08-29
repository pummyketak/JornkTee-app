@extends('layouts.superadminapp')
@section('title','ผู้ดูแลระบบ')
@section('brand','แก้ไขผังงาน')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header" style="font-size: 25px;">{{ __('แก้ไขผังงาน') }}</div>
                <form method="POST" action="{{ route('updateEvent', $event->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="plan_number" style="font-size: 20px;">รหัสผังงาน</label>
                        <input type="text" name="plan_number" class="form-control" value="{{ $event->plan_number }}">
                    </div>
                    @error('plan_number')
                    <div class="my -2">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                    <div>
                        <label for="eventstart_date" style="font-size: 20px;">วันที่จัดงาน:</label>
                        <input type="date" name="eventstart_date" class="form-control" value="{{ $event->eventstart_date }}">
                    </div>
                    @error('eventstart_date')
                    <div class="my -2">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                    <div>
                        <label for="eventend_date" style="font-size: 20px;">วันสิ้นสุดงาน</label>
                        <input type="date" name="eventend_date" class="form-control" value="{{ $event->eventend_date }}">
                    </div>
                    @error('eventend_date')
                    <div class="my -2">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                    <div>
                        <label for="detail" style="font-size: 20px;">รายละเอียดผังงาน</label>
                        <textarea name="detail" class="form-control">{{ $event->detail }}</textarea>
                    </div>
                    <input type="submit" value="อัพเดท" class="btn btn-primary my-3">
                    <a href="{{ route('eventpage',$event->id) }}" class="btn btn-danger" onclick="return confirm('คุณต้องการยกเลิกการอัพเดทข้อมูลผังงานใช่หรือไม่ ?')">ยกเลิก</a>
                </form>
            </div>

            <div class="card mt-4">
                <div class="card-header" style="font-size: 25px;">{{ __('จัดการผู้ดูแล') }}</div>
                <div class="card-body">

                    <form method="POST" action="{{ route('addAdminToEvent', $event->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="admin_ids" style="font-size: 20px;">เลือก Admin ที่ดูแล</label>
                            <select name="admin_ids[]" id="admin_ids" class="form-control" multiple>
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('admin_ids')
                        <div class="my-2">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                        <input type="submit" value="เพิ่มผู้ดูแล" class="btn btn-success my-3">
                    </form>

                    <h5 style="font-size: 20px;">รายชื่อผู้ดูแลปัจจุบัน:</h5>
                    <ul>
                        @foreach ($event->admins as $admin)
                            <li>
                                {{ $admin->name }} ({{ $admin->email }})
                                <form method="POST" action="{{ route('removeAdminFromEvent', $event->id) }}" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="admin_id" value="{{ $admin->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบผู้ดูแลคนนี้หรือไม่?')">ลบ</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection
