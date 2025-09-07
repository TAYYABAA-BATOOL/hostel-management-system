@extends('layouts.master')

@section('title', 'Complaint Details')

@section('content')
<div class="max-w-5xl mx-auto p-4 md:p-6">

    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold bg-gradient-to-r from-indigo-600 to-purple-600 text-transparent bg-clip-text">
            Complaint Details
        </h1>
        <p class="text-gray-500 text-sm mt-1">View the complete details of your complaint</p>
    </div>

    {{-- Complaint Card --}}
    <div class="bg-white shadow-lg rounded-xl p-6 md:p-8 space-y-6 border-t-4
        @if($complaint->status=='Pending') border-yellow-400
        @elseif($complaint->status=='Resolved') border-green-500
        @elseif($complaint->status=='In Progress') border-blue-500
        @else border-red-500 @endif">

        {{-- Title + Status --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">{{ $complaint->title }}</h2>
            <span class="px-3 py-1 text-xs font-semibold rounded-full
                @if($complaint->status == 'Pending') bg-gradient-to-r from-yellow-200 to-yellow-400 text-yellow-900
                @elseif($complaint->status == 'Resolved') bg-gradient-to-r from-green-200 to-green-400 text-green-900
                @elseif($complaint->status == 'In Progress') bg-gradient-to-r from-blue-200 to-blue-400 text-blue-900
                @else bg-gradient-to-r from-red-200 to-red-400 text-red-900 @endif">
                {{ $complaint->status }}
            </span>
        </div>

        {{-- Category + Date --}}
        <div class="flex items-center justify-between text-sm text-gray-500">
            <div class="flex items-center space-x-2">
                {{-- Category Icon --}}
                <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-500">
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
                </div>
                <span>{{ $complaint->category }}</span>
            </div>
            <span>Submitted on {{ $complaint->created_at->format('d M Y h:i A') }}</span>
        </div>

        {{-- Description --}}
        <div>
            <h3 class="font-semibold text-gray-700 mb-1">Description:</h3>
            <p class="text-gray-800 leading-relaxed">{{ $complaint->description }}</p>
        </div>

        {{-- Attachment --}}
        @if($complaint->attachment)
            <div>
                <h3 class="font-semibold text-gray-700 mb-1">Attachment:</h3>
                @if(Str::endsWith($complaint->attachment, ['.jpg','.png','.jpeg','.gif']))
                    <img src="{{ asset('storage/'.$complaint->attachment) }}" 
                         alt="Attachment" class="max-h-64 rounded-lg shadow border">
                @else
                    <a href="{{ asset('storage/'.$complaint->attachment) }}" 
                       target="_blank" class="text-indigo-600 hover:underline text-sm font-medium">
                       <i class="fas fa-download mr-1"></i> Download Attachment
                    </a>
                @endif
            </div>
        @endif

        {{-- Staff/Admin Reply --}}
        @if($complaint->reply)
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 mt-4">
                <h3 class="font-semibold text-gray-700 mb-2">Staff Reply:</h3>
                <p class="text-gray-800">{{ $complaint->reply }}</p>
            </div>
        @else
            <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200 mt-4 flex items-center space-x-2 text-yellow-700">
                <i class="fas fa-clock"></i>
                <span>No reply yet. Please wait for the staff to respond.</span>
            </div>
        @endif

        {{-- Back Button --}}
        <div class="flex justify-end mt-6">
            <a href="{{ route('student.complaints.index') }}"
               class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-lg transition">
               <i class="fas fa-arrow-left mr-2"></i> Back to My Complaints
            </a>
        </div>

    </div>
</div>
@endsection
