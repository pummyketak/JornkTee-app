@extends('layouts.superadminapp')
@section('title','ผู้ดูแลระบบ')
@section('brand','หน้าหลักผู้ดูแลระบบ')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 25px;">{{ __('ตารางสมาชิก') }}</div>
                </div>
                <table class="table table-bordered" style="font-size: 18px;">
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
                                    @if ($user->type < 2)
                                        @if ($user->type == 0)
                                        <form action="{{ route('promoteToAdmin', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-info">ปรับเป็น Admin</button>
                                        </form>
                                        @elseif ($user->type == 1)
                                        <form action="{{ route('rollbackToUser', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-info">ปรับเป็น User</button>
                                        </form>
                                        @endif
                                        <a href="{{ route('deleteUser', $user->id) }}" class="btn btn-danger" onclick="return confirm('คุณต้องการลบผู้ใช้นี้ {{$user->name}}หรือไม่?')">Delete</a>
                                     @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
