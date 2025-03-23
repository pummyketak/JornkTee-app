@extends('layouts.userapp')
@section('title','ผู้ใช้ระบบ')
@section('brand','หน้าเพิ่มรายละเอียดร้าน')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('เพิ่มรายละเอียดล็อคของคุณ') }}</div>
                <div class="text-center">
                </div>
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th scope="col">หมายเลขล็อค</th>
                            <th scope="col">วันที่จัดงาน</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">รายละเอียดเพิ่มเติม</th>
                            <th scope="col">ข้อมูลร้านของคุณ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($storelayout->sortBy('areanumber') as $item)
                            <tr>
                                <td>{{ $item->areanumber}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y')}} ถึง {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</td>
                                <td>{{ $item->price}}</td>
                                <td>{{Str::limit($item->comment,50)}}</td>
                                </td>
                                <td>
                                        <form method="POST" action="{{route('booking',$item->id)}}">
                                        @csrf
                                            <div>
                                                <label for="storedetail">คุณขายอะไร</label>
                                                <textarea name="storedetail" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                        @error('storedetail')
                                        <div class="my -2">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
                                        <input type="submit" value="บันทึก และ จอง" class="btn btn-primary my-3 ">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <hr>
        </div>
    </div>
</div>

@endsection
