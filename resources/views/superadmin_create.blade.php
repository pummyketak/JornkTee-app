@extends('layouts.superadminapp')
@section('title','SuperAdmin')
@section('brand','หน้าสร้างแผนผัง')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header" style="font-size: 25px;">{{ __('ตารางแผนผัง') }}</div>

                                <form method="POST" action="{{ route('insert') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="areanumber" style="font-size: 20px;">รหัสผังงาน</label>
                                        <input type="text" name="plan_number" class="form-control">
                                    </div>
                                    @error('areanumber')
                                    <div class="my -2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                    <div>
                                        <label for="start_date" style="font-size: 20px;">วันที่จัดงาน:</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    @error('start_date')
                                    <div class="my -2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                    <div>
                                        <label for="end_date" style="font-size: 20px;">วันสิ้นสุดงาน</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                    @error('end_date')
                                    <div class="my -2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                    <div>
                                        <label for="comment" style="font-size: 20px;">สถานที่ผังงาน</label>
                                        <textarea name="comment" cols="30" row="5" class="form-control"></textarea>
                                    </div>
                                     <label for="admin_staff" style="font-size: 20px;">เลือกแอดมินดูแลผังงาน</label>
                                    <table class="table table-bordered" style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->type == 1)
                                                    <div class="btn btn-primary">Admin</div>
                                                    @elseif ($user->type == 2)
                                                    <div class="btn btn-warning">SuperAdmin</div>
                                                    @else
                                                    <div class="btn btn-success">User</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger" onclick="return confirm('คุณต้องการให้ {{$user->name}}ดูแลผังงานหรือไม่?')">เลือก</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <input type="submit" value="บันทึก" class="btn btn-primary my-3 ">
                                </form>
            </div>
        </div>
    </div>
</div>

@endsection
