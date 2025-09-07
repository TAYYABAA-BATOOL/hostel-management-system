@extends('layouts.master')

@section('title', 'Reports')

@section('content')
<main class="p-6 bg-gradient-to-b from-gray-50 to-gray-100">
    <div class="bg-white shadow-xl rounded-xl p-6 w-full max-w-xl mx-auto">
        <h1 class="text-2xl font-bold text-indigo-700 mb-4">Generate Report</h1>

        <form method="POST" action="{{ route('admin.reports.generate') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Report Type</label>
                <select name="report_type" required class="w-full border px-3 py-2 rounded">
                    <option value="students">Students Report</option>
                    <option value="rooms">Rooms Report</option>
                    <option value="payments">Payments Report</option>
                </select>
            </div>

            <div>
                <label class="block font-medium">Start Date</label>
                <input type="date" name="start_date" required class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label class="block font-medium">End Date</label>
                <input type="date" name="end_date" required class="w-full border px-3 py-2 rounded">
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Generate</button>
        </form>
    </div>
</main>
@endsection
