<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{

    public function selectquiz() {
        return view('selectquiz');
    }

    public function quiz1() {
        return view('quiz1');
    }

    public function generateTriangle(Request $request) {
        $number = (int) $request->input('number'); // รับค่าจากฟอร์ม
        $triangle = ''; // สร้างตัวแปรสำหรับเก็บรูปแบบของดาว
        // ตรวจสอบว่าค่าที่กรอกมาเป็นเลขคู่หรือเลขคี่
        // ถ้าเป็นเลขคู่ให้แสดงรูปแบบจาก 1 ถึง n
        // ถ้าเป็นเลขคี่ให้แสดงรูปแบบจาก n ถึง 1
        if ($number % 2 == 0) {
            for ($i = 1; $i <= $number; $i++) {
                $triangle .= str_repeat('*', $i) . "\n";
            }
        } else {
            for ($i = $number; $i > 0; $i--) {
                $triangle .= str_repeat('*', $i) . "\n";
            }
        }
        // ส่งค่ากลับไปยัง view
        return view('quiz1', compact('triangle'));
    }

    public function quiz2() {
        return view('quiz2');
    }

    public function calculateRatios(Request $request) {
        // ตรวจสอบว่ากดปุ่ม "Clear"
        if ($request->input('action') === 'clear') {
            // เคลียร์ค่า – กลับไปหน้าแบบไม่มีค่า
            return redirect()->back()->with([
                'results' => [],
            ]);
        }
        $inputs = $request->only(['v100', 'v7', 'v107', 'v3', 'v104']); // รับค่าจากฟอร์ม
        $inputKey = null; // ตัวแปรสำหรับเก็บชื่อช่องที่กรอกค่า
        $inputValue = null; // ตัวแปรสำหรับเก็บค่าที่กรอกมา

        // หาช่องที่ผู้ใช้กรอกมา
        foreach ($inputs as $key => $value) {
            if (!empty($value)) {   // ตรวจสอบว่ามีการกรอกค่าหรือไม่ ถ้ามีการกรอกค่าให้เก็บชื่อช่องและค่าที่กรอกมา
                $inputKey = $key; // ชื่อช่องที่กรอกค่า
                $inputValue = floatval($value); // ค่าที่กรอกมา
                break; // หยุดเมื่อเจอช่องแรกที่มีค่า
            }
        }

        // หากไม่มีการกรอกค่าเลย
        if (!$inputKey) {
            return back()->with('error', 'กรุณากรอกค่าหนึ่งช่อง');
        }

        // สร้างตาราง mapping กับเปอร์เซ็นต์
        $percentMap = [
            'v100' => 1.00,
            'v7'   => 0.07,
            'v107' => 1.07,
            'v3'   => 0.03,
            'v104' => 1.04,
        ];

        $results = []; // สร้างตัวแปรสำหรับเก็บผลลัพธ์
        // คำนวณค่าตามเปอร์เซ็นต์ที่กำหนด
        foreach ($percentMap as $key => $percent) {
            $results[$key] = number_format($inputValue * ($percent / $percentMap[$inputKey]), 2); // คำนวณค่า
        }

        return view('quiz2', ['results' => $results]); // ส่งค่าผลลัพธ์กลับไปยัง view
    }

    public function quiz3() {
        return view('quiz3');
    }

    public function arrayMapping() {
        // ตารางที่ 1: ID → Name
        $table1 = [
            ['id' => 101, 'name' => 'AAA'],
            ['id' => 102, 'name' => 'BBB'],
            ['id' => 103, 'name' => 'CCC'],
        ];

        // ตารางที่ 2: ID → City
        $table2 = [
            ['id' => 103, 'city' => 'Singapore'],
            ['id' => 102, 'city' => 'Tokyo'],
            ['id' => 101, 'city' => 'Bangkok'],
        ];

        // แปลงตารางที่ 2 ให้ง่ายต่อการ lookup โดยใช้ id เป็น key
        $cityMap = collect($table2)->keyBy('id');

        // สร้างตารางที่ 3
        $result = [];
        // ทำการ map ข้อมูลจากตารางที่ 1 และตารางที่ 2 โดยใช้ id เป็น key ในการเชื่อมโยงข้อมูล และเก็บข้อมูลในรูปแบบที่ต้องการโดยใช้ id, name และ city
        foreach ($table1 as $row) {
            $id = $row['id'];
            $name = $row['name'];
            $city = $cityMap[$id]['city'] ?? 'N/A';

            $result[] = [
                'id' => $id,
                'name' => $name,
                'city' => $city,
            ];
        }

        // เรียงลำดับจาก id น้อย → มาก
        $sortedResult = collect($result)->sortBy('id')->values()->all();

        return view('quiz3', ['table3' => $sortedResult,'table1' => $table1, 'table2' => $table2]); // ส่งค่าผลลัพธ์กลับไปยัง view
    }

    public function quiz4() {
        return view('quiz4');
    }

}
