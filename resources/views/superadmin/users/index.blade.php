@extends('layouts.app') {{-- สมมติว่าคุณมี layout หลักชื่อ app.blade.php --}}

@section('content')
<div class="container">
    <h1>จัดการผู้ใช้</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อ</th>
                <th>อีเมล</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->type === 2)
                            SuperAdmin
                        @elseif ($user->type === 1)
                            Admin
                        @else
                            User
                        @endif
                    </td>
                    <td>
                        @if ($user->type === 0)
                            {{-- Promote to Admin --}}
                            <form action="{{ route('superadmin.users.promote', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">โปรโมทเป็น Admin</button>
                            </form>
                        @elseif ($user->type === 1)
                            {{-- Rollback to User --}}
                            <form action="{{ route('superadmin.users.rollback', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">ลดระดับเป็น User</button>
                            </form>
                        @endif

                        {{-- Delete User (ยกเว้นตัวเอง) --}}
                        @if ($user->id !== Auth::id())
                            <form action="{{ route('superadmin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE') {{-- ใช้ DELETE method --}}
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบผู้ใช้นี้?');">ลบ</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
