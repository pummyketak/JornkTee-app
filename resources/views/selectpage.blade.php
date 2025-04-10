<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกทางเข้า</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="text-center">
        <h1 class="text-2xl font-bold mb-4">ยินดีต้อนรับ! กรุณาเลือกการเข้าสู่ระบบ</h1>

        <!-- ปุ่มเข้าสู่ JornkTeeApp -->
        {{-- <form action="{{ route('jornkteeapp') }}" method="GET" class="inline">
            <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                เข้าสู่ JornkTeeApp (ต้อง Login)
            </button>
        </form> --}}

        <!-- ปุ่มไปยังหน้า Quiz -->
        <form action="{{ route('selectquiz') }}" method="GET" class="inline ml-4">
            <button type="submit"
                class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700 transition">
                ไปยังหน้า Quiz (ไม่ต้อง Login)
            </button>
        </form>

    </div>
</body>
</html>
