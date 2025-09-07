@extends('layouts.master')

@section('title', 'Add Payment')

@section('content')
<main class="py-10 px-4 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white border border-gray-200 rounded-3xl shadow-lg p-10">
        <h1 class="text-3xl font-extrabold text-indigo-700 mb-10 text-center">Add Payment</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-6 shadow-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.payments.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf

            <!-- Student -->
            <div>
                <label for="student_id" class="block text-sm font-semibold text-gray-600 mb-2">Select Student</label>
                <select name="student_id" id="student_id" class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Amount -->
            <div>
                <label for="amount" class="block text-sm font-semibold text-gray-600 mb-2">Amount (PKR)</label>
                <input type="number" name="amount" id="amount" value="{{ old('amount') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
            </div>

            <!-- Payment Date -->
            <div>
                <label for="payment_date" class="block text-sm font-semibold text-gray-600 mb-2">Payment Date</label>
                <input type="date" name="payment_date" id="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
            </div>

            <!-- Method -->
            <div>
                <label for="method" class="block text-sm font-semibold text-gray-600 mb-2">Payment Method</label>
                <select name="method" id="method" class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach(['Cash', 'Card', 'Bank Transfer', 'Other'] as $method)
                        <option value="{{ $method }}" {{ old('method') === $method ? 'selected' : '' }}>{{ $method }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-600 mb-2">Payment Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach(['Paid', 'Pending'] as $status)
                        <option value="{{ $status }}" {{ old('status') === $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit -->
            <div class="md:col-span-2 flex justify-end pt-4">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg transition transform hover:scale-105">
                    Save Payment
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
