<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Quiz 3</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">ตาราง Mapping (VLOOKUP Style)</h1>

        <h2 class="text-2xl font-bold">ตารางที่1</h2>
        <table class="w-full table-auto border border-gray-300 text-center">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($table1 as $row)
                    <tr>
                        <td class="border px-4 py-2">{{ $row['id'] }}</td>
                        <td class="border px-4 py-2">{{ $row['name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h2 class="text-2xl font-bold">ตารางที่2</h2>
        <table class="w-full table-auto border border-gray-300 text-center">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">city</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($table2 as $row)
                    <tr>
                        <td class="border px-4 py-2">{{ $row['id'] }}</td>
                        <td class="border px-4 py-2">{{ $row['city'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="text-2xl font-bold">output</h2>
        <table class="w-full table-auto border border-gray-300 text-center">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">City</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($table3 as $row)
                    <tr>
                        <td class="border px-4 py-2">{{ $row['id'] }}</td>
                        <td class="border px-4 py-2">{{ $row['name'] }}</td>
                        <td class="border px-4 py-2">{{ $row['city'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- ปุ่มกลับ -->
        <form action="{{ route('selectquiz') }}" method="GET" class="inline ml-4">
            <button type="submit"
                class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700 transition">
                กลับไปยังหน้าเลือกQuiz
            </button>
        </form>
    </div>
</body>
</html>
