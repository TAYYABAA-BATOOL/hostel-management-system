@extends('layouts.master')

@section('title', 'Manage Payments')

@section('content')
<div class="max-w-7xl mx-auto p-4">

    <div class="flex flex-col sm:flex-row items-center justify-between mb-6 gap-4">
        <h1 class="text-3xl font-bold text-indigo-700">Manage Payments</h1>
        <a href="{{ route('admin.payments.create') }}"
           class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg shadow-md transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="font-medium">Add Payment</span>
        </a>
    </div>

<div class="bg-white shadow-lg rounded-xl p-6 mb-8">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">

        {{-- 💰 Total Income --}}
        <div class="flex items-center text-indigo-700 text-lg font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.104 0-2 .896-2 2s.896 2 2 2m0 0v4m0-4c1.104 0 2-.896 2-2s-.896-2-2-2m0-4c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8z" />
            </svg>
            Total Income: <span class="ml-2 text-green-600">{{ number_format($totalIncome, 2) }}</span>
        </div>

        {{-- 🔍 Search Form --}}
        <form method="GET" action="{{ route('admin.payments.index') }}" class="w-full max-w-md">
            <div class="flex items-center border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500">
                <div class="relative flex-grow">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by student or method..."
                        class="w-full px-4 py-2 pl-10 text-sm text-gray-700 placeholder-gray-400 focus:outline-none"
                    />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1016.65 16.65z" />
                        </svg>
                    </div>
                </div>
                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold transition"
                >
                    Search
                </button>
            </div>
        </form>

    </div>
</div>


    {{-- ✅ Total --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-5 py-3 rounded-lg mb-4 text-sm shadow">
            {{ session('success') }}
        </div>
    @endif

   
    {{-- 📄 Payment Table --}}
    <div class="overflow-x-auto bg-white shadow-xl rounded-lg">
        @if($payments->count())
        <table class="min-w-full text-sm text-left">
            <thead class="bg-indigo-600 text-white uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3">Student</th>
                    <th class="px-6 py-3">Amount PKR</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Method</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($payments as $payment)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-900 font-medium">{{ $payment->student->name }}
                                                        <div class="text-xs text-gray-500">{{ $payment->student->email ?? '-' }}</div>

                    </td>
                    <td class="px-6 py-4">{{ number_format($payment->amount, 2) }}</td>
                    <td class="px-6 py-4">{{ $payment->payment_date }}</td>
                    <td class="px-6 py-4">{{ $payment->method }}</td>
                    <td class="px-6 py-4">
                        @if($payment->status === 'Paid')
                            <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-6 py-1 rounded-full">Paid</span>
                        @else
                            <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">Pending</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.payments.edit', $payment) }}"
                               class="text-indigo-600 hover:text-indigo-800 transition" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-10-1l9.5-9.5a2.121 2.121 0 113 3L14 13l-4 1 1-4z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST"
                                  onsubmit="return confirm('Delete this payment?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 00-2-2H9a2 2 0 00-2 2h10z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-6 text-center text-gray-500 text-sm">
            No payments found.
        </div>
        @endif
    </div>

    <div class="mt-6">
        {{ $payments->links('pagination::tailwind') }}
    </div>
</div>
@endsection
