@extends('layouts.superadminapp')
@section('title','ผู้ดูแลระบบ')
@section('brand','หน้าจัดการผังงาน')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table table-bordered">
                        <form method="POST" action="{{ route('createEvent') }}">
                            @csrf
                            <div class="form-group">
                                <label for="plan_number"> รหัสผังงาน</label>
                                <input type="text" name="plan_number" class="form-control">
                            </div>
                            @error('plan_number')
                            <div>
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                            <div>
                                <label for="eventstart_date" style="font-size: 20px;">วันที่จัดงาน:</label>
                                <input type="date" name="eventstart_date" class="form-control">
                            </div>
                            @error('eventstart_date')
                            <div>
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                            <div>
                                <label for="eventend_date" style="font-size: 20px;">วันสิ้นสุดงาน</label>
                                <input type="date" name="eventend_date" class="form-control">
                            </div>
                            @error('eventend_date')
                            <div>
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                            <div>
                                <label for="detail">รายละเอียดผังงาน</label>
                                <textarea name="detail" class="form-control"> </textarea>
                            </div>
                            <div>
                                <label for="admin_ids">เลือก Admin ที่ดูแล</label>
                                <select name="admin_ids[]" class="form-control" multiple required>
                                    <option value="" disabled>-- เลือก Admin ดูแล Event --</option>
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}" {{ in_array($admin->id, old('admin_ids', [])) ? 'selected' : '' }}>
                                            {{ $admin->name }} ({{ $admin->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @error('admin_ids')
                        <div>
                            <span class="text-danger">{{$message}}</span>
                        </div>
                        @enderror

                            <input type="submit" value="บันทึก" class="btn btn-primary my-3 ">
                        </form>
                        <thead>
                            <tr>
                                <th>รหัสผังงาน</th>
                                <th>วันที่เริ่มต้น-วันที่สิ้นสุด</th>
                                <th>รายละเอียด</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->plan_number }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($event->eventstart_date)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($event->eventend_date)->format('d/m/Y') }}
                                    </td>
                                    <td>{{ $event->detail }}</td>
                                    <td>
                                        {{--Debug: แสดง URL ที่สร้างขึ้น--}}
                                        {{-- <p>URL: {{ route('eventpage', $event->id) }}</p>
                                        <p>Event ID: {{ $event->id }}</p> --}}
                                        <a href="{{route('eventpage', $event->id) }}" class="btn btn-warning">รายละเอียดผังงาน</a>
                                        {{-- <a href="{{route('editEvent', $event->id) }}" class="btn btn-warning">แก้ไข</a> --}}
                                        <a href="{{route('deleteEvent', $event->id) }}" class="btn btn-danger" onclick="return confirm('คุณต้องการลบผังงานนี้หรือไม่?')">ลบ</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
