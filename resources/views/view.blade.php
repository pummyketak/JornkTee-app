@extends('layouts.adminapp')
@section('title','ผู้ดูแลพื้นที่')
@section('brand','หน้าหลักผู้ให้เช่าพื้นที่')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" style="font-size: 25px;">{{ __('ผังงาน') }}</div>
                 {{-- <div class="text-center">
                    <h4>รูปแผนผัง</h4>
                    @foreach ($Image as $item)
                        <img src="{{ asset($item->image_path) }}" alt="Image" style="max-width: 70%; height: auto;">
                    @endforeach
                </div> --}}
                {{-- <table class="table table-bordered" style="font-size: 18px;"> --}}
                    {{-- <thead>
                        <tr>
                            <th scope="col">หมายเลขล็อค</th>
                            <th scope="col">เวลาจัดงาน</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">รายละเอียด</th>
                            <th scope="col">สถานะล็อค</th>
                            <th scope="col">ผู้จองและรายละเอียด</th>
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
                                    @else
                                        @if($item->confirmbooking==true)
                                            <a class="btn btn-warning">ถูกจอง</a>
                                        @else
                                            <a class="btn btn-primary">จองสำเร็จ</a>
                                        @endif
                                    @endif
                                </td>
                                <td>ชื่อร้าน:{{$item->nameuserbooking}}<br>ขาย:{{$item->storedetail}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="text-center" style="font-size: 18px;">
                    <th>บัญชีธนาคาร</th>
                    <table class="table table-bordered">
                        <tr>
                            @foreach ($Bankaccount as $item)
                            <td>ข้อมูลบัญชี : {{ $item->bankaccount}}</td>
                            @endforeach
                        </tr>
                    </table>
                </div> --}}
                <div>
                    <table class="table table-bordered" style="font-size: 18px;">
                        <thead>
                            <tr>
                                <th>รหัสผังงาน</th>
                                <th>วันที่เริ่มต้น-วันที่สิ้นสุด</th>
                                <th>รายละเอียด</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->plan_number }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($event->eventstart_date)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($event->eventend_date)->format('d/m/Y') }}
                                    </td>
                                    <td>{{ $event->detail }}</td>
                                    <td>
                                        <a href="{{route('create')}}" class="btn btn-warning">ดูรายละเอียด</a>
                                        {{-- <a href="" class="btn btn-danger" onclick="return confirm('คุณต้องการลบผังงานนี้หรือไม่?')">ลบ</a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
