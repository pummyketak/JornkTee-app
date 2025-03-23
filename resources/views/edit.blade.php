@extends('layouts.adminapp')
@section('title','ผู้ดูแลพื้นที่')
@section('brand','หน้าแก้ไขข้อมูลล็อค')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header" style="font-size: 25px;">{{ __('แก้ไขข้อมูลล็อค') }}</div>

                    <form method="POST" action="{{route('update',$edit->id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="areanumber" style="font-size: 25px;">หมายเลขล็อค</label>
                            <input type="text" name="areanumber" class="form-control" value="{{$edit->areanumber}}">
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
                            <input type="number" name="price" class="form-control" value="{{$edit->price}}">
                        </div>
                        @error('price')
                        <div class="my -2">
                            <span class="text-danger">{{$message}}</span>
                        </div>
                        @enderror
                        <div>
                            <label for="comment" style="font-size: 25px;">รายละเอียดเพิ่มเติม</label>
                            <textarea name="comment" cols="30" row="5" class="form-control">{{$edit->comment}}</textarea>
                        </div>
                        <input type="submit" value="อัพเดท" class="btn btn-primary my-3 ">
                        <a href="{{route('create')}}"class="btn btn-danger" onclick="return confirm('คุณต้องการยกเลิกการอัพเดทข้อมูลล็อคใช่หรือไม่ ?')">ยกเลิก</a>
                    </form>
                    <hr>

            </div>
    </div>
</div>
@endsection
