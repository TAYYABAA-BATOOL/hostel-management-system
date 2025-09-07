@extends('layouts.master')

@section('title', 'Create Complaint')

@section('content')
<main class="p-6 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-6">
        <div class="mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800">Submit a New Complaint</h2>
            <p class="text-sm text-gray-500 mt-1">Please fill out the details below to submit your complaint.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('staff.complaints.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Complaint Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                    placeholder="E.g. Room Light Not Working" required>
            </div>

            {{-- Complaint Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="5"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                    placeholder="Please describe the issue in detail..." required>{{ old('description') }}</textarea>
            </div>

            {{-- Status (Optional for Staff) --}}
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Resolved" {{ old('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                </select>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end">
                <a href="{{ route('staff.complaints.index') }}"
                    class="mr-3 inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm rounded-md shadow-sm">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-md shadow">
                    Submit Complaint
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
