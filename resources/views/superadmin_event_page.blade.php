@extends('layouts.superadminapp')
@section('title','ผู้ดูแลระบบ')
@section('brand','หน้าจัดการผังงาน')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>รหัสผังงาน</th>
                                <th>วันที่เริ่มต้น-วันที่สิ้นสุด</th>
                                <th>รายละเอียด</th>
                                <th>ผู้ดูแล</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($event))
                                <tr>
                                    <td>{{ $event->plan_number }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($event->eventstart_date)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($event->eventend_date)->format('d/m/Y') }}
                                    </td>
                                    <td>{{ $event->detail }}</td>
                                    <td>
                                        @foreach ($event->admins as $admin)
                                             <li>{{ $admin->name }} ({{ $admin->email }})</li>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('editEvent', $event->id) }}" class="btn btn-warning">แก้ไข</a>
                                        <a href="{{route('deleteEvent', $event->id) }}" class="btn btn-danger" onclick="return confirm('คุณต้องการลบผังงานนี้หรือไม่?')">ลบ</a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
