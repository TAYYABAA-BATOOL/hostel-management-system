@extends('layouts.master')

@section('title', 'Edit Payment')

@section('content')
<main class="py-10 px-4 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white border border-gray-200 rounded-3xl shadow-xl p-8 md:p-10">
        <h1 class="text-3xl font-bold text-indigo-700 mb-10 flex items-center justify-center gap-2">
            <i class="fas fa-edit"></i>
            Edit Payment
        </h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-6 shadow">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.payments.update', $payment) }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <!-- Student -->
            <div>
                <label for="student_id" class="block text-sm font-semibold text-gray-700 mb-1">Student</label>
                <select name="student_id" id="student_id" class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ $student->id == $payment->student_id ? 'selected' : '' }}>
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Amount -->
            <div>
                <label for="amount" class="block text-sm font-semibold text-gray-700 mb-1">Amount (PKR)</label>
                <input type="number" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}"
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
            </div>

            <!-- Payment Date -->
            <div>
                <label for="payment_date" class="block text-sm font-semibold text-gray-700 mb-1">Payment Date</label>
                <input type="date" name="payment_date" id="payment_date" value="{{ old('payment_date', $payment->payment_date) }}"
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
            </div>

            <!-- Method -->
            <div>
                <label for="method" class="block text-sm font-semibold text-gray-700 mb-1">Payment Method</label>
                <select name="method" id="method" class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach(['Cash', 'Card', 'Bank Transfer', 'Other'] as $method)
                        <option value="{{ $method }}" {{ $method == $payment->method ? 'selected' : '' }}>{{ $method }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Payment Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach(['Paid', 'Pending'] as $status)
                        <option value="{{ $status }}" {{ $payment->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2 flex justify-end pt-6">
                <button type="submit" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition-all transform hover:scale-105">
                    <i class="fas fa-save"></i>
                    Update Payment
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
