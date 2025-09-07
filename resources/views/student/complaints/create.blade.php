@extends('layouts.master')

@section('title', 'Submit Complaint')

@section('content')
<div class="max-w-4xl mx-auto p-4 md:p-6">

    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold bg-gradient-to-r from-indigo-600 to-purple-600 text-transparent bg-clip-text">
            Submit a New Complaint
        </h1>
        <p class="text-gray-500 text-sm mt-1">Describe your issue to hostel management for a quick resolution</p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white shadow-lg rounded-xl p-6 md:p-8">

        <form method="POST" action="{{ route('student.complaints.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Complaint Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('title') border-red-500 @enderror"
                       placeholder="Enter a short title like 'Water leakage in Room 101'">
                @error('title')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('category') border-red-500 @enderror">
                    <option value="">Select a category</option>
                    <option value="Maintenance" @selected(old('category')=='Maintenance')>Maintenance</option>
                    <option value="Room Issue" @selected(old('category')=='Room Issue')>Room Issue</option>
                    <option value="Mess" @selected(old('category')=='Mess')>Mess</option>
                    <option value="Security" @selected(old('category')=='Security')>Security</option>
                    <option value="Other" @selected(old('category')=='Other')>Other</option>
                </select>
                @error('category')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('description') border-red-500 @enderror"
                          placeholder="Explain the issue in detail...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Attachment --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Attachment (Optional)</label>
                <div class="flex items-center justify-center w-full">
                    <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-indigo-600 rounded-lg shadow-md border-2 border-dashed border-indigo-300 cursor-pointer hover:bg-indigo-50">
                        <i class="fas fa-cloud-upload-alt text-3xl mb-2"></i>
                        <span class="text-sm">Click to upload or drag & drop</span>
                        <input type="file" name="attachment" class="hidden" />
                    </label>
                </div>
                @error('attachment')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end">
                <a href="{{ route('student.complaints.index') }}" 
                   class="px-4 py-2 mr-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium text-sm rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    <i class="fas fa-paper-plane mr-2"></i> Submit Complaint
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
