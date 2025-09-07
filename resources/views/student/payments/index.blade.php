@extends('layouts.master') <!-- or your base layout -->

@section('title', 'My Payments')

@section('content')
<main class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Classy Indigo Heading -->
<div class="flex items-center justify-between flex-wrap gap-4 mt-6">
    <div class="flex items-center gap-3">
        <i class="fas fa-wallet text-indigo-600 text-2xl"></i>
        <h1 class="text-3xl font-extrabold  text-indigo-700 tracking-tight">My Payments</h1>
    </div>
</div>

      <!-- Ultra-Classy Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <!-- Total Paid -->
    <div class="relative bg-gradient-to-tr from-green-50 via-white to-green-100 border border-green-200 rounded-2xl p-6 shadow-2xl transition-transform hover:scale-[1.03] duration-300">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm tracking-wider text-green-700 font-bold uppercase">Total Paid</h3>
                <p class="mt-2 text-3xl font-black text-green-900">Rs. {{ number_format($totalPaid, 2) }}</p>
            </div>
            <div class="relative">
                <div class="w-14 h-14 flex items-center justify-center bg-white/60 backdrop-blur-md rounded-full shadow-lg ring-2 ring-white hover:shadow-green-400/50 transition">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending -->
    <div class="relative bg-gradient-to-tr from-yellow-50 via-white to-yellow-100 border border-yellow-200 rounded-2xl p-6 shadow-2xl transition-transform hover:scale-[1.03] duration-300">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm tracking-wider text-yellow-700 font-bold uppercase">Pending</h3>
                <p class="mt-2 text-3xl font-black text-yellow-900">Rs. {{ number_format($totalPending, 2) }}</p>
            </div>
            <div class="relative">
                <div class="w-14 h-14 flex items-center justify-center bg-white/60 backdrop-blur-md rounded-full shadow-lg ring-2 ring-white hover:shadow-yellow-400/50 transition">
                    <i class="fas fa-hourglass-half text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Rejected / Due -->
    <div class="relative bg-gradient-to-tr from-red-50 via-white to-red-100 border border-red-200 rounded-2xl p-6 shadow-2xl transition-transform hover:scale-[1.03] duration-300">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm tracking-wider text-red-700 font-bold uppercase">Rejected / Due</h3>
                <p class="mt-2 text-3xl font-black text-red-900">Rs. {{ number_format($totalDue, 2) }}</p>
            </div>
            <div class="relative">
                <div class="w-14 h-14 flex items-center justify-center bg-white/60 backdrop-blur-md rounded-full shadow-lg ring-2 ring-white hover:shadow-red-400/50 transition">
                    <i class="fas fa-times-circle text-red-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<form method="GET" class="backdrop-blur-md bg-white/60 border border-gray-200 shadow-lg rounded-2xl p-6 grid grid-cols-1 md:grid-cols-4 gap-4">
    
    <!-- Status Filter -->
    <div class="relative">
        <i class="fas fa-info-circle absolute left-3 top-3.5 text-gray-400"></i>
        <select name="status" class="w-full pl-10 pr-3 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-700">
            <option value="">All Stutuses</option>
            <option value="Paid" {{ request('status') == 'Paid' ? 'selected' : '' }}>Paid</option>
            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
    </div>

    <!-- Month Filter -->
    <div class="relative">
        <i class="fas fa-calendar-alt absolute left-3 top-3.5 text-gray-400"></i>
        <select name="month" class="w-full pl-10 pr-3 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-700">
            <option value="">All Months</option>
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $m, 10)) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Year Filter -->
    <div class="relative">
        <i class="fas fa-calendar-check absolute left-3 top-3.5 text-gray-400"></i>
        <select name="year" class="w-full pl-10 pr-3 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-700">
            <option value="">All Years</option>
            @for ($y = now()->year; $y >= 2020; $y--)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
    </div>

    <!-- Submit Button -->
    <div class="flex items-center">
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-xl shadow transition">
           Apply Filter
        </button>
    </div>
</form>


        <!-- Payment Table -->
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-indigo-600 text-white uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Method</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Receipt</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($payments as $index => $payment)
                        <tr>
                            <td class="px-4 py-3">{{ $payments->firstItem() + $index }}</td>
                            <td class="px-4 py-3 font-medium">Rs. {{ number_format($payment->amount, 2) }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td>
                            <td class="px-4 py-3">{{ $payment->method }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $color = match($payment->status) {
                                        'Paid' => 'green',
                                        'Pending' => 'yellow',
                                        'Rejected' => 'red',
                                        default => 'gray'
                                    };
                                @endphp
                                <span class="inline-block px-2 py-1 text-xs font-semibold text-{{ $color }}-800 bg-{{ $color }}-100 rounded-full">
                                    {{ $payment->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if ($payment->status === 'Paid' && $payment->receipt)
                                    <a href="{{ route('student.payments.download', $payment->id) }}" class="text-blue-600 hover:underline font-medium">
                                        Download
                                    </a>
                                @else
                                    <span class="text-gray-400">__________</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 px-4 py-6">No payments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $payments->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</main>
@endsection
