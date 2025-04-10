<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Quiz 4</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">ข้อมูลจาก API ด้วย Chart.js</h1>

        <div class="mb-10">
            <canvas id="barChart"></canvas>
        </div>

        <div>
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $.getJSON("https://www.trcloud.co/test/api.php", function (data) {
                const labels = data.map(item => item.City);
                const values = data.map(item => parseInt(item.Population));

                // สร้างสีไม่ซ้ำกัน
                const colors = [
                    '#f87171', '#34d399', '#60a5fa', '#facc15', '#c084fc',
                    '#fb923c', '#a78bfa', '#4ade80', '#f472b6', '#38bdf8',
                    '#e879f9', '#fde047', '#a3e635', '#fcd34d', '#fca5a5',
                    '#86efac', '#93c5fd', '#f0abfc', '#7dd3fc', '#f97316'
                ];

                // ตัดให้พอจำนวนข้อมูล
                const chartColors = colors.slice(0, labels.length);

                // สร้าง Bar Chart
                new Chart(document.getElementById('barChart'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Population',
                            data: values,
                            backgroundColor: chartColors,
                        }]
                    },
                });

                // สร้าง Pie Chart
                new Chart(document.getElementById('pieChart'), {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: chartColors,
                        }]
                    },
                });
            });
        });
    </script>
    <!-- ปุ่มกลับ -->
        <form action="{{ route('selectquiz') }}" method="GET" class="inline ml-4">
            <button type="submit"
                class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700 transition">
                กลับไปยังหน้าเลือกQuiz
            </button>
        </form>
</body>
</html>
