{{-- resources/views/student/room/not-assigned.blade.php --}}
@extends('layouts.master')

@section('title', 'My Room Info')

@section('content')
<main class="p-6 min-h-screen bg-yellow-50">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-xl p-6 text-center">
        <i class="fas fa-exclamation-circle text-yellow-400 text-4xl mb-4"></i>
        <h2 class="text-xl font-bold text-gray-800 mb-2">No Room Assigned</h2>
        <p class="text-gray-600">You currently have no assigned room. Please contact the hostel warden or administrator for help.</p>
    </div>
</main>
@endsection
