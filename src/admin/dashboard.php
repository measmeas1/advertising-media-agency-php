<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

</head>

<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-900 text-white p-5">
        <h1 class="text-2xl font-bold mb-8">LOGO</h1>

        <nav class="space-y-4">
            <a href="dashboard.php" class="block bg-blue-800 p-3 rounded">Dashboard</a>
             <a href="products/index.php" class="block hover:bg-blue-800 p-3 rounded">Products</a>
            <a href="categories/index.php" class="block hover:bg-blue-800 p-3 rounded">Categories</a>
            <a href="bookings/index.php" class="block hover:bg-blue-800 p-3 rounded">Bookings</a>
        </nav>

        <div class="mt-10 bg-blue-800 p-4 rounded text-center">
            <p class="mb-3">Want More Tools?</p>
            <button class="bg-blue-500 px-4 py-2 rounded">Upgrade To Pro</button>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6">

        <!-- TOP BAR -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Dashboard</h2>
            <div class="space-x-4">
                <button>
                <a href="logout.php"
                  class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                  Logout
                </a>
                </button>
            </div>
        </div>

        <!-- STATS CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-blue-500 text-white p-5 rounded">
                <p>Weekly Sales</p>
                <h3 class="text-2xl font-bold">$15,342</h3>
                <p>↑ 17.08%</p>
            </div>
            <div class="bg-yellow-400 text-white p-5 rounded">
                <p>Weekly Sales</p>
                <h3 class="text-2xl font-bold">$15,342</h3>
                <p>↑ 17.08%</p>
            </div>
            <div class="bg-red-400 text-white p-5 rounded">
                <p>Weekly Sales</p>
                <h3 class="text-2xl font-bold">$15,342</h3>
                <p>↑ 17.08%</p>
            </div>
            <div class="bg-green-400 text-white p-5 rounded">
                <p>Weekly Sales</p>
                <h3 class="text-2xl font-bold">$15,342</h3>
                <p>↑ 17.08%</p>
            </div>
        </div>



        <!-- TABLE -->
        <div class="bg-white p-6 rounded shadow">
            <h3 class="font-semibold mb-4">User List</h3>
            <table class="w-full text-left">
                <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="p-2">Name</th>
                    <th class="p-2">Age</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Date</th>
                    <th class="p-2">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b">
                    <td class="p-2">Raditya</td>
                    <td class="p-2">18</td>
                    <td class="p-2">raditya@gmail.com</td>
                    <td class="p-2">18 June 2023</td>
                    <td class="p-2 text-green-600">Done</td>
                </tr>
                <tr class="border-b">
                    <td class="p-2">Imam</td>
                    <td class="p-2">17</td>
                    <td class="p-2">imam@gmail.com</td>
                    <td class="p-2">18 June 2023</td>
                    <td class="p-2 text-red-600">Failed</td>
                </tr>
                </tbody>
            </table>
        </div>

    </main>
</div>

<!-- CHART JS SCRIPT -->
<script>
    // Line Chart
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
            datasets: [{
                label: 'Visitors',
                data: [12, 19, 8, 15, 22, 18, 25],
                borderColor: '#22c55e',
                fill: true,
                backgroundColor: 'rgba(34,197,94,0.2)'
            }]
        }
    });

    // Pie Chart
    new Chart(document.getElementById('pieChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pie Chart', 'Pie Chart'],
            datasets: [{
                data: [67, 33],
                backgroundColor: ['#3b82f6', '#bfdbfe']
            }]
        }
    });

    
</script>


</body>
</html>
