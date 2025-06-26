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
