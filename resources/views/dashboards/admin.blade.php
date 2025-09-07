@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<main class="flex-1 p-4 sm:p-6 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
    <!-- Welcome Card -->
    <div class="bg-white shadow-xl rounded-xl p-6 mb-6 border border-gray-200 hover:shadow-2xl transition">
        <h1 class="text-2xl sm:text-3xl font-bold text-indigo-700 mb-2">Welcome, Admin!</h1>
        <p class="text-gray-600 text-base sm:text-lg">Here’s a quick overview of your hostel. Manage everything seamlessly!</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $cards = [
                ['label' => 'Total Rooms', 'value' => '50', 'color' => 'indigo', 'icon' => 'fa-door-open'],
                ['label' => 'Occupied Rooms', 'value' => '35', 'color' => 'green', 'icon' => 'fa-bed'],
                ['label' => 'Vacant Rooms', 'value' => '15', 'color' => 'red', 'icon' => 'fa-door-open'],
                ['label' => 'Total Students', 'value' => '120', 'color' => 'purple', 'icon' => 'fa-user-graduate'],
                ['label' => 'Pending Complaints', 'value' => '8', 'color' => 'yellow', 'icon' => 'fa-exclamation-triangle'],
                ['label' => 'Monthly Income', 'value' => '$12,500', 'color' => 'blue', 'icon' => 'fa-dollar-sign'],
            ];
        @endphp

        @foreach($cards as $card)
            <div class="bg-gradient-to-r from-{{ $card['color'] }}-500 to-{{ $card['color'] }}-700 shadow-lg rounded-xl p-6 text-white flex justify-between items-center hover:scale-[1.03] transform transition duration-300">
                <div>
                    <h3 class="text-sm sm:text-base font-medium">{{ $card['label'] }}</h3>
                    <p class="text-2xl sm:text-3xl font-bold">{{ $card['value'] }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <i class="fas {{ $card['icon'] }} text-2xl sm:text-3xl"></i>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Charts & Graphs -->
    <div class="bg-white mt-8 p-6 rounded-xl shadow border border-gray-200">
        <h2 class="text-xl sm:text-2xl font-bold mb-4 text-indigo-700 flex items-center gap-2">
            <span>📊 Insights:</span>
            <span class="text-gray-600 text-sm sm:text-base">Monthly Income & Occupancy</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-gray-50 p-4 rounded shadow col-span-1 md:col-span-3">
                <canvas id="incomeChart" class="w-full h-64"></canvas>
            </div>

            <div class="bg-gray-50 p-4 rounded shadow col-span-1">
                <canvas id="occupancyChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </div>

    <!-- Trends -->
    <div class="bg-white mt-8 p-6 rounded-xl shadow border border-gray-200">
        <h2 class="text-xl font-bold mb-4">📈 Occupancy Trends Over Time</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 p-4 rounded shadow md:col-span-2">
                <canvas id="lineChart" class="w-full h-64"></canvas>
            </div>

            <div class="bg-gradient-to-br from-indigo-100 to-blue-50 p-4 rounded shadow flex flex-col justify-center">
                <h3 class="text-base sm:text-lg font-semibold text-indigo-700">📊 Insights</h3>
                <p class="text-gray-700 mt-2 text-sm sm:text-base">
                    This chart shows how the occupancy of rooms has changed over the past 6 months.
                </p>
                <div class="mt-4 text-center">
                    <span class="text-2xl sm:text-4xl font-bold text-indigo-600">+15%</span>
                    <p class="text-sm text-gray-600">Growth since last quarter</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const incomeCtx = document.getElementById('incomeChart')?.getContext('2d');
  const occupancyCtx = document.getElementById('occupancyChart')?.getContext('2d');
  const lineCtx = document.getElementById('lineChart')?.getContext('2d');

  if (incomeCtx) {
    new Chart(incomeCtx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
          label: 'Income ($)',
          data: [1200, 1500, 1700, 1300, 1600, 1900],
          backgroundColor: 'rgba(3, 6, 216, 0.66)',
          borderRadius: 4,
          barPercentage: 0.6,
        }]
      },
      options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
    });
  }

  if (occupancyCtx) {
    new Chart(occupancyCtx, {
      type: 'doughnut',
      data: {
        labels: ['Occupied', 'Vacant'],
        datasets: [{
          label: 'Rooms',
          data: [35, 15],
          backgroundColor: ['rgba(0, 146, 54, 0.9)', 'rgba(194, 2, 2, 1)'],
          borderRadius: 4,
          cutout: '65%'
        }]
      },
      options: { responsive: true, maintainAspectRatio: false }
    });
  }

  if (lineCtx) {
    new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
          label: 'Occupied Rooms',
          data: [20, 25, 30, 28, 35, 40],
          fill: true,
          backgroundColor: 'rgba(79, 70, 229, 0.1)',
          borderColor: '#4F46E5',
          tension: 0.3,
          pointBackgroundColor: '#4F46E5',
          pointRadius: 4
        }]
      },
      options: {
        responsive: true,
        animation: { duration: 1000, easing: 'easeOutQuart' },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 5 } } }
      }
    });
  }
});
</script>
@endsection
