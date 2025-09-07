@extends('layouts.master')

@section('title', 'Edit Complaint')

@section('content')
<main class="p-6 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-6">
        <div class="mb-6 border-b pb-4">
            <h2 class="text-2xl font-extrabold text-indigo-700">Update Complaint</h2>
            <p class="text-sm text-gray-500 mt-1">Modify the complaint details or add a staff reply.</p>
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Start --}}
        <form action="{{ route('staff.complaints.update', $complaint->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Complaint Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title"
                    value="{{ old('title', $complaint->title) }}"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                    placeholder="E.g. Room AC Not Cooling" required>
            </div>

            {{-- Complaint Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="5"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                    required>{{ old('description', $complaint->description) }}</textarea>
            </div>

            {{-- Staff Reply --}}
            <div>
                <label for="reply" class="block text-sm font-medium text-gray-700">Staff Reply</label>
                <textarea name="reply" id="reply" rows="4"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                    placeholder="Enter your reply here...">{{ old('reply', $complaint->reply) }}</textarea>
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    <option value="Pending" {{ old('status', $complaint->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ old('status', $complaint->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Resolved" {{ old('status', $complaint->status) == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="Rejected" {{ old('status', $complaint->status) == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            {{-- Submit Buttons --}}
            <div class="flex justify-between">
                <a href="{{ route('staff.complaints.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm rounded-md shadow-sm">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-md shadow">
                    Update Complaint
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
