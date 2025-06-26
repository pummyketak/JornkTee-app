@extends('layouts.app')

@section('content')
<div class="container">
    <h1>จัดการแผนผัง (Store Maps)</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('superadmin.create.store_map.form') }}" class="btn btn-success mb-3">สร้างแผนผังใหม่</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อแผนผัง</th>
                <th>คำอธิบาย</th>
                <th>Admin ที่ดูแล</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($storeMaps as $storeMap)
                <tr>
                    <td>{{ $storeMap->id }}</td>
                    <td>{{ $storeMap->name }}</td>
                    <td>{{ $storeMap->description ?? '-' }}</td>
                    <td>
                        @forelse ($storeMap->admins as $admin)
                            {{ $admin->name }} ({{ $admin->email }})<br>
                        @empty
                            ไม่มี Admin ดูแล
                        @endforelse
                    </td>
                    <td>
                        <a href="{{ route('superadmin.edit.store_map.form', $storeMap->id) }}" class="btn btn-sm btn-info">แก้ไข</a>
                        <form action="{{ route('superadmin.delete.store_map', $storeMap->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบแผนผังนี้? การลบจะลบ Storelayout ทั้งหมดในแผนผังนี้ด้วย');">ลบ</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
