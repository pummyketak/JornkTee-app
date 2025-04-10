<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz 2</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form method="POST" action="/quiz2">
    @csrf
    ผู้ใช้กรอกได้หนึ่งช่องเท่านั้น :
    <table class="table-auto border-gray-300 text-center inline ml-4">
            <tbody>
            <tr>
                <th class="border border-gray-800 "><b>100</b></th>
                <th class="border border-gray-800"><b>7</b></th>
                <th class="border border-gray-800 "><b>107</b></th>
                <th class="border border-gray-800 "><b>3</b></th>
                <th class="border border-gray-800 "><b>104</b></th>
            </tr>
            <tr>
                <td class="border border-gray-800 "><input type="text" name="v100" value="{{ $results['v100'] ?? '' }}"></td>
                <td class="border border-gray-800 "><input type="text" name="v7" value="{{ $results['v7'] ?? '' }}"></td>
                <td class="border border-gray-800 "><input type="text" name="v107" value="{{ $results['v107'] ?? '' }}"></td>
                <td class="border border-gray-800 "><input type="text" name="v3" value="{{ $results['v3'] ?? '' }}"></td>
                <td class="border border-gray-800 "><input type="text" name="v104" value="{{ $results['v104'] ?? '' }}"></td>
            </tr>
            </tbody>
        </table>
        @if(session('error'))
            <div class="text-red-600 font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <button type="submit" name="action" value="generate"
            class="bg-blue-500 text-white px-2 py-2 rounded-lg shadow-md hover:bg-green-700 transition inline ml-4">
            Generate
        </button>
        <button type="submit" name="action" value="clear"
            class="bg-red-500 text-white px-2 py-2 rounded-lg shadow-md hover:bg-red-700 transition inline ml-4">
            Clear
        </button>
    </form>

     <!-- ปุ่มกลับ -->
        <form action="{{ route('selectquiz') }}" method="GET" class="inline ml-4">
            <button type="submit"
                class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700 transition">
                กลับไปยังหน้าเลือกQuiz
            </button>
        </form>
</body>
</html>

