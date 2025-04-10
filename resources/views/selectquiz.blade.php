<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกข้อquiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="text-center">
        <h1 class="text-2xl font-bold mb-4">เลือกข้อquiz</h1>

        <a href="{{ route('quiz1') }}"
            class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
            เข้าสู่ quiz1
        </a>

        <a href="{{ route('quiz2') }}"
            class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
            เข้าสู่ quiz2
        </a>
        <a href="{{ route('quiz3') }}"
            class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
            เข้าสู่ quiz3
        </a>
        <a href="{{ route('quiz4') }}"
            class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
            เข้าสู่ quiz4
        </a>
        <!-- ปุ่มกลับ -->
        <a href="/"
            class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
            กลับไปยังหน้าแรก
        </a>
        </form>
    </div>
</body>
</html>
