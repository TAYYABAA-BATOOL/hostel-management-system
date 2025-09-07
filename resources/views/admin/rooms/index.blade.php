@extends('layouts.master')

@section('title', 'Manage Rooms')

@section('content')
<div class="max-w-7xl mx-auto p-4">
    <div class="flex flex-col sm:flex-row items-center justify-between mb-6 gap-4">
        <h1 class="text-3xl font-bold text-indigo-700">Manage Rooms</h1>
        <a href="{{ route('admin.rooms.create') }}"
           class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white px-5 py-2.5 rounded-lg shadow-md transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 4v16m8-8H4"/>
            </svg>
            <span class="font-medium">Add Room</span>
        </a>
    </div>


    <!-- Search Bar -->
<form method="GET" action="{{ route('admin.rooms.index') }}" class="w-full max-w-md mb-6">
    <div class="flex items-center">
        <div class="relative flex-grow">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by room number, type or status..."
                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-l-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm"
            />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1016.65 16.65z"/>
                </svg>
            </div>
        </div>

        <button
            type="submit"
            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-r-lg shadow transition"
        >
            Search
        </button>
    </div>
</form>



    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-sky-100 border border-sky-300 text-green-800 px-5 py-3 rounded-lg mb-4 text-sm shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto bg-white shadow-xl rounded-lg">
        @if($rooms->count())
        <table class="min-w-full text-sm text-left">
           <thead class="bg-indigo-600 text-white uppercase text-xs tracking-wider">
    <tr>
        <th class="px-6 py-3 text-left">Room No</th>
        <th class="px-6 py-3 text-left">Type</th>
        <th class="px-6 py-3 text-center">Capacity</th>
        <th class="px-6 py-3 text-center">Occupied</th>
        <th class="px-6 py-3 text-center">Status</th>
        <th class="px-6 py-3 text-left">Actions</th>
    </tr>
</thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($rooms as $room)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $room->room_no }}</td>
                    <td class="px-6 py-4">
                        @switch($room->type)
                            @case('Single') Single Bed @break
                            @case('Double') Double Bed @break
                            @case('Triple') Triple Bed @break
                            @case('Suite') Suite @break
                            @default {{ $room->type }}
                        @endswitch
                    </td>
                    <td class="px- py-4 text-center">{{ $room->capacity }}</td>
                    <td class="px-6 py-4 text-center">{{ $room->occupied }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($room->status == 'Available')
                            <span class="inline-block rounded-full bg-green-100 text-green-800 text-xs px-3 py-1">Available</span>
                        @elseif($room->status == 'Occupied')
                            <span class="inline-block rounded-full bg-red-100 text-red-800 text-xs px-3 py-1">Occupied</span>
                        @else
                            <span class="inline-block rounded-full bg-yellow-100 text-yellow-800 text-xs px-5 py-1">Partial</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.rooms.edit', $room) }}"
                               class="text-indigo-600 hover:text-indigo-800 transition"
                               title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-10-1l9.5-9.5a2.121 2.121 0 113 3L14 13l-4 1 1-4z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST"
                                  onsubmit="return confirm('Delete this room?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition"
                                        title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 00-2-2H9a2 2 0 00-2 2h10z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-6 text-center text-gray-500 text-sm">
            No rooms found.
        </div>
        @endif
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $rooms->links('pagination::tailwind') }}
    </div>
</div>
@endsection
