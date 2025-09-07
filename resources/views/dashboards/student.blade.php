@extends('layouts.master')

@section('title', 'Student Dashboard')

@section('content')
  {{-- Paste here only the student dashboard content --}}
<main class="flex-1 p-4 sm:p-6 md:p-8 bg-gradient-to-b from-gray-50 to-gray-100">

  <!-- Welcome Card -->
  <div class="bg-white shadow-xl rounded-xl p-4 sm:p-6 mb-6 border border-gray-200 hover:shadow-2xl transition">
    <h1 class="text-2xl sm:text-3xl font-bold text-indigo-700 mb-2">Welcome, Student!</h1>
    <p class="text-gray-600 text-base sm:text-lg">Here’s your hostel information & activities.</p>
  </div>

  <!-- Summary Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6">
    <div class="bg-gradient-to-r from-green-500 to-green-700 shadow-lg rounded-xl p-4 sm:p-6 text-white flex justify-between items-center hover:scale-105 transform transition">
      <div>
        <h3 class="text-sm sm:text-lg font-medium">My Room</h3>
        <p class="text-xl sm:text-3xl font-bold">Room 204</p>
      </div>
      <div class="bg-white bg-opacity-20 rounded-full p-2 sm:p-3">
        <i class="fas fa-bed text-2xl sm:text-3xl"></i>
      </div>
    </div>

    <div class="bg-gradient-to-r from-blue-500 to-blue-700 shadow-lg rounded-xl p-4 sm:p-6 text-white flex justify-between items-center hover:scale-105 transform transition">
      <div>
        <h3 class="text-sm sm:text-lg font-medium">Pending Payments</h3>
        <p class="text-xl sm:text-3xl font-bold">$200</p>
      </div>
      <div class="bg-white bg-opacity-20 rounded-full p-2 sm:p-3">
        <i class="fas fa-dollar-sign text-2xl sm:text-3xl"></i>
      </div>
    </div>

    <div class="bg-gradient-to-r from-yellow-500 to-yellow-700 shadow-lg rounded-xl p-4 sm:p-6 text-white flex justify-between items-center hover:scale-105 transform transition">
      <div>
        <h3 class="text-sm sm:text-lg font-medium">Complaints</h3>
        <p class="text-xl sm:text-3xl font-bold">1</p>
      </div>
      <div class="bg-white bg-opacity-20 rounded-full p-2 sm:p-3">
        <i class="fas fa-exclamation-triangle text-2xl sm:text-3xl"></i>
      </div>
    </div>

    <div class="bg-gradient-to-r from-purple-500 to-purple-700 shadow-lg rounded-xl p-4 sm:p-6 text-white flex justify-between items-center hover:scale-105 transform transition">
      <div>
        <h3 class="text-sm sm:text-lg font-medium">Notices</h3>
        <p class="text-xl sm:text-3xl font-bold">3</p>
      </div>
      <div class="bg-white bg-opacity-20 rounded-full p-2 sm:p-3">
        <i class="fas fa-bullhorn text-2xl sm:text-3xl"></i>
      </div>
    </div>
  </div>

  <!-- Notices & Messages -->
  <div class="bg-white mt-6 p-4 sm:p-6 rounded-xl shadow-lg border border-gray-200">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2">
      <h2 class="text-xl sm:text-2xl font-bold text-indigo-700 flex items-center gap-2">
        <i class="fas fa-envelope-open-text"></i> My Notices & Messages
      </h2>
      <span class="bg-indigo-100 text-indigo-700 px-3 py-1 text-sm rounded-full shadow text-center w-max">
        Latest
      </span>
    </div>

    <p class="text-gray-600 mb-6 text-sm sm:text-base">
      Stay updated with important announcements & messages.
    </p>

    <!-- Notices -->
    <div class="space-y-4">
      <div class="p-4 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg shadow hover:scale-[1.02] hover:shadow-md transition">
        <h3 class="text-base sm:text-lg font-semibold text-indigo-700 flex items-center gap-2">
          <i class="fas fa-tools"></i> Hostel Maintenance
          <span class="bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded-full">Saturday</span>
        </h3>
        <p class="text-gray-700 text-sm mt-1">Please vacate rooms for cleaning between 10am–2pm.</p>
      </div>

      <div class="p-4 bg-gradient-to-r from-green-50 to-teal-50 rounded-lg shadow hover:scale-[1.02] hover:shadow-md transition">
        <h3 class="text-base sm:text-lg font-semibold text-green-700 flex items-center gap-2">
          <i class="fas fa-money-bill-wave"></i> Payment Deadline Extended
          <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">15th July</span>
        </h3>
        <p class="text-gray-700 text-sm mt-1">Last date to pay dues is now 15th July.</p>
      </div>

      <div class="p-4 bg-gradient-to-r from-pink-50 to-rose-50 rounded-lg shadow hover:scale-[1.02] hover:shadow-md transition">
        <h3 class="text-base sm:text-lg font-semibold text-pink-700 flex items-center gap-2">
          <i class="fas fa-glass-cheers"></i> Welcome Party
          <span class="bg-pink-100 text-pink-600 text-xs px-2 py-1 rounded-full">Friday</span>
        </h3>
        <p class="text-gray-700 text-sm mt-1">Join us on Friday evening in the common hall.</p>
      </div>
    </div>
  </div>
</main>
@endsection
