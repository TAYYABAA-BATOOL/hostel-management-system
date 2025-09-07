@extends('layouts.master')

@section('title', 'My Room')

@section('content')
<main class="p-6 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-sm shadow-2xl rounded-3xl overflow-hidden transition hover:scale-[1.02] hover:shadow-3xl duration-300">

        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-extrabold  text-white tracking-tight">My Room Information</h2>
                <p class="text-sm text-indigo-200 mt-1">Details of your currently assigned hostel room.</p>
            </div>
      

            @if(isset($room) && is_object($room))
    <div>
        <span
            class="inline-flex items-center gap-2 bg-white/20 text-white font-semibold text-sm px-4 py-2 rounded-full shadow-inner">
            Assigned Room
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-70" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 12H4" />
            </svg>
        </span>
    </div>
@endif

        </div>

        @if(isset($room) && is_object($room))
        <!-- Room Details -->
           <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
           <!-- Room Number -->
        <div class="rounded-2xl border border-indigo-100 bg-white/60 backdrop-blur-md p-6 shadow-md hover:shadow-xl transition duration-300 ease-in-out hover:scale-[1.03]">
            <p class="text-sm text-indigo-700 font-semibold flex items-center gap-2">
                <span class="inline-flex items-center justify-center bg-indigo-100/70 text-indigo-600 rounded-full w-8 h-8">
                    <i class="fas fa-door-open"></i>
                </span>
                Room Number
            </p>
            <p class="text-2xl font-bold text-indigo-900 mt-2 tracking-wide">{{ $room->room_no }}</p>
        </div>

        <!-- Type -->
        <div class="rounded-2xl border border-purple-100 bg-white/60 backdrop-blur-md p-6 shadow-md hover:shadow-xl transition duration-300 ease-in-out hover:scale-[1.03]">
            <p class="text-sm text-purple-700 font-semibold flex items-center gap-2">
                <span class="inline-flex items-center justify-center bg-purple-100/70 text-purple-600 rounded-full w-8 h-8">
                    <i class="fas fa-layer-group"></i>
                </span>
                Room Type
            </p>
            <p class="text-2xl font-bold text-purple-900 mt-2 capitalize tracking-wide">{{ $room->type }} Bed</p>
        </div>

        <!-- Capacity -->
        <div class="rounded-2xl border border-green-100 bg-white/60 backdrop-blur-md p-6 shadow-md hover:shadow-xl transition duration-300 ease-in-out hover:scale-[1.03]">
            <p class="text-sm text-green-700 font-semibold flex items-center gap-2">
                <span class="inline-flex items-center justify-center bg-green-100/70 text-green-600 rounded-full w-8 h-8">
                    <i class="fas fa-users"></i>
                </span>
                Capacity
            </p>
            <p class="text-2xl font-bold text-green-900 mt-2 tracking-wide">{{ $room->capacity }}</p>
        </div>

        <!-- Status -->
        <div class="rounded-2xl border border-yellow-100 bg-white/60 backdrop-blur-md p-6 shadow-md hover:shadow-xl transition duration-300 ease-in-out hover:scale-[1.03]">
            <p class="text-sm text-yellow-700 font-semibold flex items-center gap-2">
                <span class="inline-flex items-center justify-center bg-yellow-100/70 text-yellow-600 rounded-full w-8 h-8">
                    <i class="fas fa-info-circle"></i>
                </span>
                Status
            </p>
                @php
                    $badgeColor = match(strtolower($room->status)) {
                        'available' => 'bg-green-100 text-green-700',
                        'occupied' => 'bg-red-100 text-red-700',
                        default => 'bg-gray-100 text-gray-700',
                    };
                @endphp
                <span class="inline-block mt-2 px-4 py-1 rounded-full text-sm font-medium tracking-wide {{ $badgeColor }}">
                    {{ ucfirst($room->status) }}
                </span>
            </div>
        </div>
        @else
        <!-- No Room Assigned -->
        <div class="text-center py-16 px-6 text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.75 9.75h4.5m-4.5 4.5h4.5M3 6.75A2.25 2.25 0 015.25 4.5h13.5A2.25 2.25 0 0121 6.75v10.5a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 17.25V6.75z" />
            </svg>
            <p class="text-2xl font-semibold">You are not assigned to any room yet.</p>
        </div>
        @endif

        @if(isset($room))
    <div class="px-6 pb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Room Facilities</h3>
        <ul class="grid sm:grid-cols-2 gap-3 text-sm text-gray-600">
            <li class="flex items-center gap-2">
                <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Attached Bathroom
            </li>
            <li class="flex items-center gap-2">
                <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Study Table
            </li>
            <li class="flex items-center gap-2">
                <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Ceiling Fan
            </li>
            <li class="flex items-center gap-2">
                <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                WiFi Access
            </li>
        </ul>
    </div>
@endif






    </div>
<div class="absolute top-0 right-0 opacity-5 z-0">
    <svg width="200" height="200" fill="none" viewBox="0 0 200 200">
        <circle cx="100" cy="100" r="80" stroke="#4F46E5" stroke-width="40" />
    </svg>
</div> 
    
</main>
@endsection
