@extends('layouts.master')

@section('title', isset($user) ? 'Edit User' : 'Add User')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
    <div class="px-6 py-8 md:px-10">
        <h2 class="text-3xl font-bold text-indigo-700 mb-8">
            {{ isset($user) ? 'Edit User' : 'Add New User' }}
        </h2>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" novalidate>
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-800 mb-1">Full Name</label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name', $user->name ?? '') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                        placeholder="e.g. Ayesha Siddiqi" required>
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-800 mb-1">Email Address</label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email', $user->email ?? '') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                        placeholder="e.g. ayesha@example.com" required>
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password (only for Create) -->
                @if(!isset($user))
                <div class="md:col-span-2">
                    <label for="password" class="block text-sm font-medium text-gray-800 mb-1">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror"
                        placeholder="Enter a strong password" required>
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @endif

                <!-- Role -->
                <div class="md:col-span-2">
                    <label for="role" class="block text-sm font-medium text-gray-800 mb-1">Select Role</label>
                    <select name="role" id="role"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('role') border-red-500 @enderror" required>
                        <option value="">-- Select Role --</option>
                        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="staff" {{ old('role', $user->role ?? '') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="student" {{ old('role', $user->role ?? '') == 'student' ? 'selected' : '' }}>Student</option>
                    </select>
                    @error('role')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-10 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl shadow-sm transition-all duration-300">
                    <i data-lucide="{{ isset($user) ? 'save' : 'user-plus' }}" class="w-4 h-4"></i>
                    {{ isset($user) ? 'Update User' : 'Save User' }}
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
