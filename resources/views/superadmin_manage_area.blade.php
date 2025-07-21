@extends('layouts.superadminapp')
@section('title','ผู้ดูแลระบบ')
@section('brand','หน้าจัดการผังงาน')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table table-bordered">
                        <form method="POST" action="{{ route('createEvent') }}">
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
                                <label for="eventstart_date" style="font-size: 20px;">วันที่จัดงาน:</label>
                                <input type="date" name="eventstart_date" class="form-control">
                            </div>
                            @error('evenstart_date')
                            <div>
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                            <div>
                                <label for="eventend_date" style="font-size: 20px;">วันสิ้นสุดงาน</label>
                                <input type="date" name="eventend_date" class="form-control">
                            </div>
                            @error('eventend_date')
                            <div>
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                            <div>
                                <label for="detail">รายละเอียดผังงาน</label>
                                <textarea name="detail" class="form-control"> </textarea>
                            </div>

                            <input type="submit" value="บันทึก" class="btn btn-primary my-3 ">
                        </form>

                </table>
            </div>
        </div>
    </div>
@endsection
