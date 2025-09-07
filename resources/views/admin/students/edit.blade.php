@extends('layouts.master')

@section('title', isset($student) ? 'Edit Student' : 'Add Student')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
    <div class="px-6 py-8 md:px-10">
        <h2 class="text-3xl font-bold text-indigo-700 mb-8">
            {{ isset($student) ? 'Edit Student' : 'Add New Student' }}
        </h2>

        <form method="POST" action="{{ isset($student) ? route('admin.students.update', $student) : route('admin.students.store') }}" novalidate>
            @csrf
            @if(isset($student))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-800 mb-1">Full Name</label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name', $student->name ?? '') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                        placeholder="e.g. Ali Khan" required>
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-800 mb-1">Email Address</label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email', $student->email ?? '') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                        placeholder="e.g. ali@example.com" required>
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-800 mb-1">Phone Number</label>
                    <input type="text" name="phone" id="phone"
                        value="{{ old('phone', $student->phone ?? '') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('phone') border-red-500 @enderror"
                        placeholder="e.g. 03001234567">
                    @error('phone')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Room -->
                <div>
                    <label for="room" class="block text-sm font-medium text-gray-800 mb-1">Room Number</label>
                    <input type="text" name="room" id="room"
                        value="{{ old('room', $student->room ?? '') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('room') border-red-500 @enderror"
                        placeholder="e.g. 101">
                    @error('room')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-10 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl shadow-sm transition-all duration-300">
                    <i data-lucide="{{ isset($student) ? 'save' : 'user-plus' }}" class="w-4 h-4"></i>
                    {{ isset($student) ? 'Update Student' : 'Save Student' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
@endsection
