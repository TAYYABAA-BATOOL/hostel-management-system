@extends('layouts.master')

@section('title', 'Complaint Details')

@section('content')
<div class="max-w-4xl mx-auto p-4 md:p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-indigo-700">Complaint Details</h1>
            <p class="text-gray-500 text-sm mt-1">Complete complaint info and student details</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('staff.complaints.edit', $complaint) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs md:text-sm font-medium rounded-lg shadow-sm transition">
               <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <a href="{{ route('staff.complaints.index') }}"
               class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs md:text-sm font-medium rounded-lg transition">
               <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
        
        {{-- Decorative Top Border --}}
        <div class="h-1 w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
        
        <div class="p-5 md:p-7 space-y-6">

            {{-- Student Info --}}
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                <h3 class="font-semibold text-gray-700 mb-3 text-sm uppercase tracking-wide">Student Info</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 gap-x-6 text-sm text-gray-600">
                    <div><i class="fas fa-user text-indigo-500 mr-1"></i> {{ $complaint->student->name }}</div>
                    <div><i class="fas fa-envelope text-indigo-500 mr-1"></i> {{ $complaint->student->email }}</div>
                    <div><i class="fas fa-phone text-indigo-500 mr-1"></i> {{ $complaint->student->phone ?? 'N/A' }}</div>
                    <div><i class="fas fa-bed text-indigo-500 mr-1"></i> Room: {{ $complaint->student->room ?? 'N/A' }}</div>
                </div>
            </div>

            {{-- Title + Status --}}
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 leading-tight">{{ $complaint->title }}</h2>
                <span class="px-3 py-1 text-xs font-semibold rounded-full shadow-sm
                    @if($complaint->status == 'Pending') bg-yellow-100 text-yellow-700
                    @elseif($complaint->status == 'Resolved') bg-green-100 text-green-700
                    @elseif($complaint->status == 'In Progress') bg-blue-100 text-blue-700
                    @else bg-red-100 text-red-700 @endif">
                    {{ $complaint->status }}
                </span>
            </div>

            {{-- Category + Date --}}
            <div class="flex flex-wrap justify-between items-center text-xs md:text-sm text-gray-500">
                <div class="flex items-center gap-2 mb-2 sm:mb-0">
                    <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-100 text-gray-500">
                        @if($complaint->category == 'Maintenance')
                            <i class="fas fa-tools"></i>
                        @elseif($complaint->category == 'Room Issue')
                            <i class="fas fa-bed"></i>
                        @elseif($complaint->category == 'Mess')
                            <i class="fas fa-utensils"></i>
                        @elseif($complaint->category == 'Security')
                            <i class="fas fa-shield-alt"></i>
                        @else
                            <i class="fas fa-info-circle"></i>
                        @endif
                    </span>
                    <span class="font-medium text-gray-700">{{ $complaint->category }}</span>
                </div>
                <span>{{ $complaint->created_at->format('d M Y h:i A') }}</span>
            </div>

            {{-- Description --}}
            <div>
                <h3 class="font-semibold text-gray-700 mb-2 text-sm uppercase tracking-wide">Description</h3>
                <p class="text-gray-700 text-sm md:text-base leading-relaxed whitespace-pre-line">
                    {{ $complaint->description }}
                </p>
            </div>

            {{-- Attachment --}}
            @if($complaint->attachment)
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2 text-sm uppercase tracking-wide">Attachment</h3>
                    @if(Str::endsWith($complaint->attachment, ['.jpg','.png','.jpeg','.gif']))
                        <img src="{{ asset('storage/'.$complaint->attachment) }}" 
                             alt="Attachment" class="max-h-60 rounded-lg shadow border mx-auto">
                    @else
                        <a href="{{ asset('storage/'.$complaint->attachment) }}" target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 
                                  text-white text-xs font-medium rounded-lg shadow-sm transition">
                           <i class="fas fa-download mr-2"></i> Download Attachment
                        </a>
                    @endif
                </div>
            @endif

            {{-- Staff Reply --}}
            @if($complaint->reply)
                <div class="bg-green-50 rounded-lg p-2 border border-green-200">
                    <h3 class="font-semibold text-green-700 mb-2 text-sm uppercase tracking-wide">Staff Reply</h3>
                    <p class="text-gray-700 text-sm md:text-base">{{ $complaint->reply }}</p>
                </div>
            @else
                <div class="bg-yellow-50 rounded-lg p-2 border border-yellow-200 flex items-center gap-2 text-yellow-700">
                    <i class="fas fa-clock text-sm"></i>
                    <span class="text-sm md:text-base">No reply yet.</span>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
