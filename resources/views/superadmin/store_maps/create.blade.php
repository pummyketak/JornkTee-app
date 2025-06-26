@extends('layouts.app')

@section('content')
<div class="container">
    <h1>สร้างแผนผังใหม่</h1>

    <a href="{{ route('superadmin.manage.store_maps') }}" class="btn btn-secondary mb-3">กลับ</a>

    <form action="{{ route('superadmin.store.store_map') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อแผนผัง:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">คำอธิบาย:</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="admin_ids" class="form-label">มอบหมาย Admin (เลือกได้หลายคน):</label>
            <select class="form-control @error('admin_ids') is-invalid @enderror" id="admin_ids" name="admin_ids[]" multiple>
                @foreach ($admins as $admin)
                    <option value="{{ $admin->id }}" {{ in_array($admin->id, old('admin_ids', [])) ? 'selected' : '' }}>
                        {{ $admin->name }} ({{ $admin->email }})
                    </option>
                @endforeach
            </select>
            @error('admin_ids')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </form>
</div>
@endsection
