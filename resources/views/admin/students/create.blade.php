@extends('layouts.master')

@section('title', 'Add Student')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-2xl rounded-2xl overflow-hidden">
    <div class="px-6 py-6 md:px-10 md:py-8">
        <h2 class="text-3xl font-semibold text-indigo-700 mb-6 border-b pb-3">Add New Student</h2>

        <form method="POST" action="{{ route('admin.students.store') }}" novalidate>
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Full Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('name') border-red-500 @enderror"
                        placeholder="e.g. Ali Khan" required>
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Address --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('email') border-red-500 @enderror"
                        placeholder="e.g. ali@example.com" required>
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone Number --}}
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="phone" id="phone"
                        value="{{ old('phone') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('phone') border-red-500 @enderror"
                        placeholder="e.g. 03001234567">
                    @error('phone')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Room Number --}}
                <div>
                    <label for="room" class="block text-sm font-medium text-gray-700 mb-1">Room Number</label>
                    <input type="text" name="room" id="room"
                        value="{{ old('room') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('room') border-red-500 @enderror"
                        placeholder="e.g. 101">
                    @error('room')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="mt-8 flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition-all duration-300">
                    Save Student
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
