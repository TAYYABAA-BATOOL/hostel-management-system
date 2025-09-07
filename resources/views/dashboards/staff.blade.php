@extends('layouts.master')

@section('title', 'Staff Dashboard')

@section('content')
<main class="flex-1 p-4 sm:p-6 bg-gradient-to-b from-gray-50 to-gray-100">

  <!-- Welcome Card -->
  <div class="bg-white shadow-xl rounded-xl p-4 sm:p-6 mb-6 border border-gray-200 hover:shadow-2xl transition">
    <h1 class="text-2xl sm:text-3xl font-bold text-indigo-700 mb-2">Welcome, Staff!</h1>
    <p class="text-gray-600 text-base sm:text-lg">Here’s a quick overview of your tasks & responsibilities.</p>
  </div>

  <!-- Summary Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    <div class="bg-gradient-to-r from-indigo-500 to-indigo-700 shadow-lg rounded-xl p-4 sm:p-6 text-white flex justify-between items-center hover:scale-105 transform transition">
      <div>
        <h3 class="text-base sm:text-lg font-medium">Total Rooms</h3>
        <p class="text-2xl sm:text-3xl font-bold">50</p>
      </div>
      <div class="bg-white bg-opacity-20 rounded-full p-3">
        <i class="fas fa-door-open text-2xl sm:text-3xl"></i>
      </div>
    </div>

    <div class="bg-gradient-to-r from-green-500 to-green-700 shadow-lg rounded-xl p-4 sm:p-6 text-white flex justify-between items-center hover:scale-105 transform transition">
      <div>
        <h3 class="text-base sm:text-lg font-medium">Occupied Rooms</h3>
        <p class="text-2xl sm:text-3xl font-bold">35</p>
      </div>
      <div class="bg-white bg-opacity-20 rounded-full p-3">
        <i class="fas fa-bed text-2xl sm:text-3xl"></i>
      </div>
    </div>

    <div class="bg-gradient-to-r from-red-500 to-red-700 shadow-lg rounded-xl p-4 sm:p-6 text-white flex justify-between items-center hover:scale-105 transform transition">
      <div>
        <h3 class="text-base sm:text-lg font-medium">Vacant Rooms</h3>
        <p class="text-2xl sm:text-3xl font-bold">15</p>
      </div>
      <div class="bg-white bg-opacity-20 rounded-full p-3">
        <i class="fas fa-door-open text-2xl sm:text-3xl"></i>
      </div>
    </div>

    <div class="bg-gradient-to-r from-yellow-500 to-yellow-700 shadow-lg rounded-xl p-4 sm:p-6 text-white flex justify-between items-center hover:scale-105 transform transition">
      <div>
        <h3 class="text-base sm:text-lg font-medium">Complaints</h3>
        <p class="text-2xl sm:text-3xl font-bold">8</p>
      </div>
      <div class="bg-white bg-opacity-20 rounded-full p-3">
        <i class="fas fa-exclamation-triangle text-2xl sm:text-3xl"></i>
      </div>
    </div>
  </div>

  <!-- Today's Tasks -->
  <!-- <div class="bg-white mt-6 p-4 sm:p-6 rounded-xl shadow border border-gray-200">
    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-indigo-700 flex items-center gap-2">
      <i class="fas fa-calendar-alt text-indigo-600"></i> Today’s Tasks & Schedule
    </h2>
    <p class="text-gray-600 mb-6 text-sm sm:text-base">
      Keep track of what needs to be done today.
    </p>

    <div class="space-y-4 relative border-l-2 border-indigo-200 pl-4 sm:pl-6">
      <div class="flex gap-3 items-start">
        <div class="w-3 h-3 bg-indigo-600 rounded-full mt-1"></div>
        <div>
          <h3 class="text-sm sm:text-lg font-semibold text-indigo-700">Morning Meeting</h3>
          <p class="text-xs sm:text-sm text-gray-600">Discuss pending complaints and assign rooms. <span class="block sm:inline text-gray-400">(9:00 AM)</span></p>
        </div>
      </div>

      <div class="flex gap-3 items-start">
        <div class="w-3 h-3 bg-green-600 rounded-full mt-1"></div>
        <div>
          <h3 class="text-sm sm:text-lg font-semibold text-green-700">Check Room Status</h3>
          <p class="text-xs sm:text-sm text-gray-600">Inspect vacant rooms & report maintenance issues. <span class="block sm:inline text-gray-400">(11:00 AM)</span></p>
        </div>
      </div>

      <div class="flex gap-3 items-start">
        <div class="w-3 h-3 bg-yellow-600 rounded-full mt-1"></div>
        <div>
          <h3 class="text-sm sm:text-lg font-semibold text-yellow-700">Student Requests</h3>
          <p class="text-xs sm:text-sm text-gray-600">Respond to student queries & resolve complaints. <span class="block sm:inline text-gray-400">(2:00 PM)</span></p>
        </div>
      </div>

      <div class="flex gap-3 items-start">
        <div class="w-3 h-3 bg-purple-600 rounded-full mt-1"></div>
        <div>
          <h3 class="text-sm sm:text-lg font-semibold text-purple-700">Evening Wrap-up</h3>
          <p class="text-xs sm:text-sm text-gray-600">Update logs & prepare notices for tomorrow. <span class="block sm:inline text-gray-400">(5:00 PM)</span></p>
        </div>
      </div>
    </div>
  </div> -->

   <div class="bg-white mt-6 p-6 rounded-2xl shadow-lg border border-gray-100">
  <h2 class="text-2xl font-bold mb-2 text-indigo-700 flex items-center gap-2">
        <i class="fas fa-calendar-alt text-indigo-600"></i>  Today’s Tasks & Schedule
  </h2>
  <p class="text-gray-500 mb-6 text-sm">
    Stay on top of today’s important tasks & events.
  </p>

  <div class="space-y-6 relative border-l-4 border-gradient-to-b from-indigo-300 to-indigo-100 pl-6">
 
    <div class="relative group">
      <div class="absolute -left-3 top-1 w-6 h-6 bg-indigo-600 rounded-full flex items-center justify-center text-white text-xs shadow-lg">
        9
      </div>
      <div class="bg-indigo-50 p-4 rounded-lg shadow-sm group-hover:shadow-md transition">
        <h3 class="text-base font-semibold text-indigo-700 flex items-center gap-2">
          Morning Meeting
          <span class="text-xs bg-white text-indigo-600 px-2 py-0.5 rounded-full shadow">9:00 AM</span>
        </h3>
        <p class="text-gray-600 text-sm mt-1">Discuss pending complaints & assign rooms.</p>
      </div>
    </div>

    <div class="relative group">
      <div class="absolute -left-3 top-1 w-6 h-6 bg-green-600 rounded-full flex items-center justify-center text-white text-xs shadow-lg">
        11
      </div>
      <div class="bg-green-50 p-4 rounded-lg shadow-sm group-hover:shadow-md transition">
        <h3 class="text-base font-semibold text-green-700 flex items-center gap-2">
          Check Room Status
          <span class="text-xs bg-white text-green-600 px-2 py-0.5 rounded-full shadow">11:00 AM</span>
        </h3>
        <p class="text-gray-600 text-sm mt-1">Inspect vacant rooms & report maintenance issues.</p>
      </div>
    </div>

   
    <div class="relative group">
      <div class="absolute -left-3 top-1 w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-white text-xs shadow-lg">
        2
      </div>
      <div class="bg-yellow-50 p-4 rounded-lg shadow-sm group-hover:shadow-md transition">
        <h3 class="text-base font-semibold text-yellow-700 flex items-center gap-2">
          Student Requests
          <span class="text-xs bg-white text-yellow-600 px-2 py-0.5 rounded-full shadow">2:00 PM</span>
        </h3>
        <p class="text-gray-600 text-sm mt-1">Respond to student queries & resolve complaints.</p>
      </div>
    </div>

   
    <div class="relative group">
      <div class="absolute -left-3 top-1 w-6 h-6 bg-purple-600 rounded-full flex items-center justify-center text-white text-xs shadow-lg">
        5
      </div>
      <div class="bg-purple-50 p-4 rounded-lg shadow-sm group-hover:shadow-md transition">
        <h3 class="text-base font-semibold text-purple-700 flex items-center gap-2">
          Evening Wrap-up
          <span class="text-xs bg-white text-purple-600 px-2 py-0.5 rounded-full shadow">5:00 PM</span>
        </h3>
        <p class="text-gray-600 text-sm mt-1">Update logs & prepare notices for tomorrow.</p>
      </div>
    </div>
  </div>
</div> 
</main>
@endsection
