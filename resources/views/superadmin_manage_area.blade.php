@extends('layouts.superadminapp')
@section('title','ผู้ดูแลระบบ')
@section('brand','หน้าจัดการผังงาน')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table table-bordered">
                    <thead>
                        <form method="POST" action="">
                        @csrf
                        <div class="form-group">
                            <label for="plan_number"> รหัสผังงาน</label>
                            <input type="text" name="plan_number" class="form-control">
                        </div>
                        @error('plan_number')
                        <div>
                            <span class="text-danger">{{$message}}</span>
                        </div>
                        @enderror
                        <div>
                            <label for="start_date" style="font-size: 20px;">วันที่จัดงาน:</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        @error('start_date')
                        <div>
                            <span class="text-danger">{{$message}}</span>
                        </div>
                        @enderror
                        <div>
                            <label for="end_date" style="font-size: 20px;">วันสิ้นสุดงาน</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                        @error('end_date')
                        <div>
                            <span class="text-danger">{{$message}}</span>
                        </div>
                        @enderror
                        <div>
                            <label for="comment">สถานที่ผังงาน</label>
                            <textarea name="comment" class="form-control"> </textarea>
                        </div>

                        <input type="submit" value="บันทึก" class="btn btn-primary my-3 ">
                        </form>
                        <tr>
                            <th>รหัสผังงาน</th>
                            <th>สถานที่</th>
                            <th>ระยะเวลา</th>
                            <th>ผู้ดูแล</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
