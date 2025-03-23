@extends('layouts.userapp')
@section('title','ผู้ใช้ระบบ')
@section('brand','หน้าหลักฐานการจอง')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('หลักฐานการจอง') }}</div>
                <div class="text-center">
                    <h4>หลักฐานการจองของคุณ</h4>
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
                            <th scope="col">รายละเอียดร้านคุณ</th>
                            <th scope="col">หลักฐานการชำระเงิน</th>
                            <th scope="col">การยืนยันจากผู้ดูแล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($storelayout->sortBy('areanumber') as $item)
                            <tr>
                                <td>{{ $item->areanumber}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y')}} ถึง {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</td>
                                <td>{{ $item->price}}</td>
                                <td>{{Str::limit($item->comment,50)}}</td>
                                <td>@if ($item->status==false)
                                        @if($item->confirmbooking==true)
                                            <a href="#"class="btn btn-warning">คุณจอง</a>
                                            <a href="{{route('cancelbooking',$item->id)}}"class="btn btn-danger" onclick="return confirm('คุณต้องการยกเลิกจองล็อค{{$item->areanumber}}ใช่หรือไม่ ?')">ยกเลิก</a>
                                        @else
                                        <a href="#"class="btn btn-success">จองสำเร็จ</a>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $item->storedetail}}</td>
                                <td>
                                    <img src="{{ asset($item->image_path) }}" alt="Image" style="max-width: 100%; height: 50%;">
                                </td>
                                <td>
                                    @if($item->confirmbooking==true)
                                        <a href="#"class="btn btn-warning">รอการยืนยัน</a>
                                    @else
                                        <a href="#"class="btn btn-success">ยืนยันสำเร็จ</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                {{-- <hr>
                @if(Auth::check())
                <p>UserID: {{ Auth::user()->id }}</p>
                @endif --}}
            </div>
        </div>
    </div>
</div>

@endsection
