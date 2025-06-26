@extends('layouts.app')

@section('content')
<div class="container">
    <h1>จัดการ Storelayouts ในแผนผัง: {{ $storeMap->name }}</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">กลับไปเลือกแผนผัง</a>
    <a href="{{ route('admin.create.layout', $storeMap->id) }}" class="btn btn-success mb-3">เพิ่ม Storelayout ใหม่</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>หมายเลขพื้นที่</th>
                <th>ราคา</th>
                <th>สถานะ</th>
                <th>ผู้จอง</th>
                <th>รายละเอียดร้าน</th>
                <th>ช่วงเวลา</th>
                <th>รูปภาพ</th>
                <th>ยืนยันการจอง</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($storelayouts as $layout)
                <tr>
                    <td>{{ $layout->id }}</td>
                    <td>{{ $layout->areanumber }}</td>
                    <td>{{ number_format($layout->price, 2) }}</td>
                    <td>
                        @if ($layout->status)
                            <span class="badge bg-success">ว่าง</span>
                        @else
                            <span class="badge bg-danger">ไม่ว่าง</span>
                        @endif
                    </td>
                    <td>
                        @if ($layout->user)
                            {{ $layout->user->name }} ({{ $layout->user->email }})
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $layout->storedetail ?? '-' }}</td>
                    <td>
                        @if ($layout->start_date && $layout->end_date)
                            {{ \Carbon\Carbon::parse($layout->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($layout->end_date)->format('d/m/Y') }}
                        @else
                            ไม่ระบุ
                        @endif
                    </td>
                    <td>
                        @if ($layout->image_path)
                            <a href="{{ asset($layout->image_path) }}" target="_blank">ดูรูปภาพ</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($layout->user_id && $layout->confirmbooking == false)
                            <span class="badge bg-warning">รอการยืนยัน</span>
                            <form action="{{ route('admin.confirm.booking', $layout->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">ยืนยัน</button>
                            </form>
                        @elseif ($layout->user_id && $layout->confirmbooking == true)
                            <span class="badge bg-success">ยืนยันแล้ว</span>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.edit.layout', $layout->id) }}" class="btn btn-sm btn-info">แก้ไข</a>

                        <form action="{{ route('admin.change.layout.status', $layout->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $layout->status ? 'btn-secondary' : 'btn-primary' }}"
                                onclick="return confirm('คุณแน่ใจหรือไม่ที่จะ{{ $layout->status ? 'เปลี่ยนเป็นว่าง' : 'ล้างข้อมูลการจองและทำให้ว่าง' }}?');">
                                {{ $layout->status ? 'ทำให้ว่าง' : 'ล้างการจอง' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.delete.layout', $layout->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบพื้นที่นี้?');">ลบ</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">ยังไม่มี Storelayout ในแผนผังนี้</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
