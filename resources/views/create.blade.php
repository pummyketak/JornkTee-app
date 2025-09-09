@extends('layouts.adminapp')
@section('title','ผู้ดูแลพื้นที่')
@section('brand','หน้าสร้างแผนผังผู้ดูแลพื้นที่')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header" style="font-size: 25px;">{{ __('ตารางแผนผัง') }}</div>

                    <div class="text-center">
                        <h4>รูปแผนผัง</h4>
                    </div>
                    <div class="text-center mb-3">
                        <label> อัปโหลดรูป </label>
                    </div>
                    <div class="text-center">
                        <form action="{{ route('adminuploadimage', ['eventId' => $event->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    @foreach ($Image as $item)
                        {{-- <img src="{{ asset($item->image_path) }}" alt="Image" style="max-width: 50%; height: auto;"> --}}
                        @if ($item->image_path)
                            <img src="{{ asset($item->image_path) }}" alt="Image" style="max-width: 50%; height: 50%;">
                            <a href="{{route('admindeleteimage',$item->id)}}" class="btn btn-danger" onclick="return confirm('คุณต้องการลบรูปแผนผังนี้ใช่หรือไม่ ?')">ลบรูป</a>
                         @endif
                    @endforeach
                    </div>
                <hr>
                    <form method="POST" action="{{ route('insert',['eventId' => $event->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="areanumber" style="font-size: 25px;">หมายเลขล็อค</label>
                            <input type="text" name="areanumber" class="form-control">
                        </div>
                        @error('areanumber')
                        <div class="my -2">
                            <span class="text-danger">{{$message}}</span>
                        </div>
                        @enderror
                        <div>
                            <label for="start_date" style="font-size: 25px;">วันที่จัดงาน:</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        @error('start_date')
                        <div class="my -2">
                            <span class="text-danger">{{$message}}</span>
                        </div>
                        @enderror
                        <div>
                            <label for="end_date" style="font-size: 25px;">วันสิ้นสุดงาน</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                        @error('end_date')
                        <div class="my -2">
                            <span class="text-danger">{{$message}}</span>
                        </div>
                        @enderror
                        <div>
                            <label for="price" style="font-size: 25px;">ราคา</label>
                            <input type="number" name="price" class="form-control">
                        </div>
                        @error('price')
                        <div class="my -2">
                            <span class="text-danger">{{$message}}</span>
                        </div>
                        @enderror
                        <div>
                            <label for="comment" style="font-size: 25px;">รายละเอียดเพิ่มเติม</label>
                            <textarea name="comment" cols="30" row="5" class="form-control"></textarea>
                        </div>
                        <input type="submit" value="บันทึก" class="btn btn-primary my-3 ">
                    </form>
                <hr>
                    <form action="{{ route('addbankaccount', ['eventId' => $event->id]) }}" method="post">
                        @csrf
                        <div>
                            <label for="addbankaccount" style="font-size: 25px;">เลขที่บัญชีที่ให้ผู้จองโอนเงิน</label>
                            <textarea name="addbankaccount" cols="30" row="5" class="form-control"></textarea>
                        </div>
                        @error('addbankaccount')
                        <div class="my -2">
                            <span class="text-danger">{{$message}}</span>
                        </div>
                        @enderror
                        <input type="submit" value="เพิ่ม" class="btn btn-primary my-3 ">
                    </form>
                    <table class="table table-bordered">
                        <tr>
                            @foreach ($Bankaccount as $item)
                            <td style="font-size: 18px;">ข้อมูลบัญชี : {{ $item->bankaccount}} <a href="{{route('deletebank',$item->id)}}" class="btn btn-danger"> ลบ</a></td>
                            @endforeach
                        </tr>
                    </table>

                <hr>
                    <div class="text-center mb-3">
                            <h4> ล็อคที่สร้าง </h4>
                    </div>
                <div class="table-responsive">
                <table class="table table-bordered" style="font-size: 18px;">
                    <thead>
                        <tr>
                            <th scope="col">หมายเลขล็อค</th>
                            <th scope="col">ระยะเวลาจัดงาน</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">รายละเอียด</th>
                            <th scope="col">แก้ไขข้อมูล</th>
                            <th scope="col">สถานะล็อค</th>
                            <th scope="col">ผู้จอง</th>
                            <th scope="col">หลักฐานการจอง</th>
                            <th scope="col">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($storelayout->sortBy('areanumber') as $item)
                            <tr>
                                <td>{{ $item->areanumber}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y')}} ถึง {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</td>
                                <td>{{ $item->price}}</td>
                                <td>{{Str::limit($item->comment,50)}}</td>
                                <td>
                                    <a href="{{route('edit',$item->id)}}" class="btn btn-secondary">แก้ไขข้อมูล</a>
                                </td>
                                <td>@if ($item->status==true)
                                        <a href="{{route('change',$item->id)}}"class="btn btn-success">ว่าง</a>
                                    @else
                                        @if($item->confirmbooking==true)
                                        <a href="{{route('change',$item->id)}}"class="btn btn-warning">ถูกจอง</a>
                                        @else
                                        <a href="{{route('change',$item->id)}}"class="btn btn-primary">จองสำเร็จ</a>
                                        @endif
                                    @endif
                                </td>
                                <td>ชื่อร้าน:{{$item->nameuserbooking}}<br>ขาย:{{$item->storedetail}}</td>
                                <td>
                                    @if ($item->status==false)
                                        @if($item->confirmbooking==true)
                                            @if ($item->image_path)
                                                <img src="{{ asset($item->image_path) }}" alt="Image" style="max-width: 100%; height: 50%;"> <a href="{{route('confirmbooking',$item->id)}}"class="btn btn-success" onclick="return confirm('คุณต้องการยืนยันการจองล็อค{{$item->areanumber}}ใช่หรือไม่ ?')">ยืนยันการจอง</a>
                                            @else
                                            @endif
                                        @else
                                            <img src="{{ asset($item->image_path) }}" alt="Image" style="max-width: 100%; height: 50%;">
                                        @endif
                                    @else
                                    @endif
                                </td>
                                <td><a href="{{route('delete',$item->id)}}" class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลล็อค{{$item->areanumber}}ใช่หรือไม่ ?')">ลบ</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
    </div>
</div>
@endsection
