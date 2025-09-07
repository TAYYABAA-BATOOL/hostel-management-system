@extends('layouts.master')

@section('title', ucfirst($type) . ' Report')

@section('content')
<main class="p-6 bg-gradient-to-b from-gray-50 to-gray-100">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-indigo-700">{{ ucfirst($type) }} Report</h1>
            <p class="text-gray-500 text-sm">Showing records from <span class="font-semibold">{{ $start }}</span> to <span class="font-semibold">{{ $end }}</span></p>
        </div>
        <div>
            <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-700 rounded shadow text-sm font-medium">
                Total: {{ count($data) }}
            </span>
        </div>
    </div>

 <!-- Table -->
<div class="bg-white shadow-xl rounded-xl overflow-x-auto">
    @if(count($data) > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-indigo-600 to-indigo-700">
                <tr>
                    @if($type === 'payments')
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Student</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                    @else
                        @foreach(array_keys($data->first()->getAttributes()) as $key)
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ str_replace('_', ' ', ucfirst($key)) }}
                            </th>
                        @endforeach
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($data as $item)
                <tr class="hover:bg-gray-50 transition">
                    @if($type === 'payments')
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $item->student->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">Rs {{ number_format($item->amount) }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ \Carbon\Carbon::parse($item->date)->format('d M, Y') }}</td>
                        <td class="px-4 py-2 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                {{ $item->status === 'Paid' ? 'bg-green-100 text-green-700 px-5' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                    @else
                        @foreach($item->getAttributes() as $value)
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ $value }}
                            </td>
                        @endforeach
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="p-4 text-center text-red-600 font-medium">
            🚫 No data found for the selected period.
        </div>
    @endif
</div>


    <!-- Charts -->
    @if(count($data) > 0)
    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Doughnut -->
        <div class="bg-white rounded-xl shadow p-4">
            <h2 class="text-lg font-semibold mb-2 text-indigo-700">Summary (Doughnut)</h2>
            <canvas id="doughnutChart"></canvas>
        </div>

        <!-- Line -->
        <div class="bg-white rounded-xl shadow p-4 md:col-span-2">
            <h2 class="text-lg font-semibold mb-2 text-indigo-700">Trends Over Time (Line)</h2>
            <canvas id="lineChart"></canvas>
        </div>

        <!-- Bar -->
        <div class="bg-white rounded-xl shadow p-4 md:col-span-3">
            <h2 class="text-lg font-semibold mb-2 text-indigo-700">Category Comparison (Bars)</h2>
            <canvas id="barChart"></canvas>
        </div>

    </div>
    @endif

</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Dummy data - Replace this with actual PHP data if needed
    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    const dataset1 = [10, 20, 15, 25, 30, 22];
    const dataset2 = [5, 15, 10, 20, 25, 18];

    // Doughnut Chart
    const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Occupied', 'Available', 'Partial'],
            datasets: [{
                label: 'Rooms',
                data: [35, 15, 5],
                backgroundColor: [
                    'rgba(78, 70, 229, 0.9)',
                    'rgba(16, 185, 129, 0.88)',
                    'rgba(245, 159, 11, 0.87)'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            cutout: '65%',
        }
    });

    // Line Chart
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Dataset 1',
                    data: dataset1,
                    borderColor: '#4F46E5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    tension: 0.3,
                    fill: true,
                    pointRadius: 4
                },
                {
                    label: 'Dataset 2',
                    data: dataset2,
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.3,
                    fill: true,
                    pointRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });

    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    const gradient = barCtx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(79, 70, 229, 0.8)');
    gradient.addColorStop(1, 'rgba(79, 70, 229, 0.2)');

    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Dataset 1',
                    data: dataset1,
                    backgroundColor: gradient,
                    borderRadius: 5
                },
                {
                    label: 'Dataset 2',
                    data: dataset2,
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
</script>
@endsection



