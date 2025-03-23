@extends('layouts.userapp')
@section('title','ผู้ใช้แลระบบ')
@section('brand','หน้าหลักผู้เช่าพื้นที่')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ตารางแผนผัง') }}</div>
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="text-center">
                    <h4>รูปแผนผัง</h4>
                    @foreach ($Image as $item)
                        <img src="{{ asset($item->image_path) }}" alt="Image" style="max-width: 70%; height: auto;">
                    @endforeach
                </div>
                <hr>
                <div class="text-center">
                    <h4>ล็อคที่จองได้</h4>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">หมายเลขล็อค</th>
                            <th scope="col">วันที่จัดงาน</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">รายละเอียดเพิ่มเติม</th>
                            <th scope="col">สถานะล็อค</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($storelayout->sortBy('areanumber') as $item)
                            <tr>
                                <td>{{ $item->areanumber}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y')}} ถึง {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</td>
                                <td>{{ $item->price}}</td>
                                <td>{{Str::limit($item->comment,50)}}</td>
                                <td>@if ($item->status==true)
                                        <a class="btn btn-success">ว่าง</a>
                                        <a href="{{route('storedetail',$item->id)}}"class="btn btn-warning" onclick="return confirm('คุณต้องการจองล็อค{{$item->areanumber}}ใช่หรือไม่ ?')">กดจอง</a>
                                    @else
                                        <a class="btn btn-warning">ถูกจอง</a>
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
