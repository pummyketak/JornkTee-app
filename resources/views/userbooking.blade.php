@extends('layouts.userapp')
@section('title','ผู้ใช้ระบบ')
@section('brand','หน้าล็อคที่จองพื้นที่')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ตารางแผนผัง') }}</div>
                <div class="text-center">
                    <h4>รูปแผนผัง</h4>
                    @foreach ($Image as $item)
                        <img src="{{ asset($item->image_path) }}" alt="Image" style="max-width: 70%; height: auto;">
                    @endforeach
                </div>
                <hr>
                <div class="text-center">
                    <h4>ล็อคที่คุณจอง</h4>
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
                            <th scope="col">หลักฐานการชำระเงิน<br>***ผู้ให้จองสามารถยกเลิกการจองได้หากไม่อัปโหลดหลักฐานการโอนเงิน</th>
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
                                            <a class="btn btn-warning">คุณจอง</a>
                                            <a href="{{route('cancelbooking',$item->id)}}" class="btn btn-danger" onclick="return confirm('คุณต้องการยกเลิกจองล็อค{{$item->areanumber}}ใช่หรือไม่ ?')">ยกเลิก</a>
                                        @else
                                            <a class="btn btn-success">จองสำเร็จ</a>
                                            <a href="{{route('cancelbooking',$item->id)}}" class="btn btn-danger" onclick="return confirm('คุณต้องการยกเลิกจองล็อค{{$item->areanumber}}ใช่หรือไม่ ?')">ยกเลิก</a>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $item->storedetail}}</td>
                                <td>
                                    <form action="{{ route('uploadimage',$item->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="image">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </form>
                                    @if ($item->confirmbooking==true)
                                        @if ($item->image_path)
                                            <img src="{{ asset($item->image_path) }}" alt="Image" style="max-width: 100%; height: 50%;">
                                            <a href="{{route('deleteimage',$item->id)}}" class="btn btn-danger" onclick="return confirm('คุณต้องการลบรูปนี้ใช่หรือไม่ ?')">ลบรูป</a>
                                        @endif
                                    @else
                                        <img src="{{ asset($item->image_path) }}" alt="Image" style="max-width: 100%; height: 50%;">
                                    @endif
                                </td>
                                <td>
                                    @if($item->confirmbooking==true)
                                        <a class="btn btn-warning">รอการยืนยัน</a>
                                    @else
                                        <a class="btn btn-success">ยืนยันสำเร็จ</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <div class="text-center">
                            <h4>บัญชีธนาคารในการโอนเงิน</h4>
                            </div>
                            @foreach ($Bankaccount as $item)
                            <h5>ชื่อธนาคารและเลขที่บัญชี : {{ $item->bankaccount}}</h5>
                            @endforeach
                        </tr>
                    </table>
                </div>
                {{-- @if(Auth::check())
                <p>UserID: {{ Auth::user()->id }}</p>
                @endif --}}
            </div>
        </div>
    </div>
</div>

@endsection
