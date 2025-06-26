@extends('layouts.app')

@section('content')
<div class="container">
    <h1>แดชบอร์ด Admin</h1>
    <h2>แผนผังที่คุณดูแล:</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($storeMaps->isEmpty())
        <p>คุณยังไม่ได้ดูแลแผนผังใดๆ</p>
    @else
        <div class="row">
            @foreach ($storeMaps as $storeMap)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $storeMap->name }}</h5>
                            <p class="card-text">{{ $storeMap->description ?? 'ไม่มีคำอธิบาย' }}</p>
                            <a href="{{ route('admin.show.layouts', $storeMap->id) }}" class="btn btn-primary">จัดการ Storelayouts</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ตัวอย่าง: การจัดการบัญชีธนาคาร (ถ้าคุณต้องการหน้าแยก) --}}
    {{-- <h3>จัดการบัญชีธนาคาร (ส่วนกลาง)</h3>
    <form action="{{ route('admin.add.bankaccount') }}" method="POST" class="mb-3">
        @csrf
        <div class="input-group">
            <input type="text" name="bankaccount" class="form-control" placeholder="เพิ่มเลขบัญชีธนาคาร">
            <button type="submit" class="btn btn-success">เพิ่ม</button>
        </div>
    </form>
    @if (!empty($Bankaccount) && $Bankaccount->isNotEmpty())
        <ul class="list-group">
            @foreach ($Bankaccount as $bank)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $bank->bankaccount }}
                    <form action="{{ route('admin.delete.bank', $bank->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">ลบ</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>ยังไม่มีบัญชีธนาคาร</p>
    @endif --}}

    {{-- ตัวอย่าง: การจัดการรูปภาพ (ถ้าคุณต้องการหน้าแยก) --}}
    {{-- <h3>จัดการรูปภาพ (ส่วนกลาง)</h3>
    <form action="{{ route('admin.upload.image') }}" method="POST" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="input-group">
            <input type="file" name="image" class="form-control">
            <button type="submit" class="btn btn-success">อัปโหลด</button>
        </div>
        @error('image') <div class="text-danger">{{ $message }}</div> @enderror
    </form>
    @if (!empty($Image) && $Image->isNotEmpty())
        <div class="row">
            @foreach ($Image as $img)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="{{ asset($img->image_path) }}" class="card-img-top" alt="Image" style="height: 150px; object-fit: cover;">
                        <div class="card-body text-center">
                            <form action="{{ route('admin.delete.image', $img->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">ลบ</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>ยังไม่มีรูปภาพ</p>
    @endif --}}
</div>
@endsection
