<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form method="POST" action="/quiz1">
    @csrf
    Number of star :
    <input type="number" name="number" required class="border">

    <button type="submit"
        class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700 transition">
        Generate
    </button>
    </form>
    <pre>{{ $triangle ?? '' }}</pre>

     <!-- ปุ่มกลับ -->
     <form action="{{ route('selectquiz') }}" method="GET" class="inline ml-4">
        <button type="submit"
            class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700 transition">
            กลับไปยังหน้าเลือกQuiz
        </button>
    </form>
</body>
</html>

