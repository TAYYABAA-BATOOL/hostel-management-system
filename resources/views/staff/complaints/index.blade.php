@extends('layouts.master')

@section('title', 'Manage Complaints')

@section('content')
<div class="max-w-7xl mx-auto p-4 md:p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-indigo-700 bg-clip-text">
                Manage Complaints
            </h1>
            <p class="text-gray-500 text-sm mt-1">Monitor and resolve all student complaints efficiently</p>
        </div>
        
        {{-- Search Form --}}
        <form method="GET" action="{{ route('staff.complaints.index') }}" class="flex w-full md:w-auto max-w-sm">
            <div class="relative flex-grow">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by title, student, or status..."
                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-l-lg shadow-sm 
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm" />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fas fa-search text-xs"></i>
                </div>
            </div>
            <button type="submit"
                class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 
                       text-white text-sm font-medium rounded-r-lg shadow transition">
                Search
            </button>
        </form>
    </div>

    {{-- Status Filter Chips --}}
    <div class="flex flex-wrap gap-2 mb-6">
        @php $statuses = ['All', 'Pending', 'In Progress', 'Resolved', 'Rejected']; @endphp
        @foreach($statuses as $status)
            <a href="{{ route('staff.complaints.index', ['status' => $status != 'All' ? $status : null, 'search' => request('search')]) }}"
               class="px-4 py-1.5 rounded-full text-xs font-medium border transition
                    @if(request('status') == $status || (!request('status') && $status=='All'))
                        bg-gradient-to-r from-indigo-600 to-purple-600 text-white border-indigo-600 shadow-sm
                    @else
                        bg-white text-gray-600 hover:bg-gray-50 border-gray-200
                    @endif">
                {{ $status }}
            </a>
        @endforeach
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 border border-green-200 rounded-lg text-sm shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Complaints Table --}}
   <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">
    <div class="overflow-x-auto">
        @if($complaints->count())
            <table class="table-auto w-full text-sm text-left text-gray-600">
                <thead class="bg-indigo-600 text-white text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 w-40">Student</th>
                        <th class="px-4 py-3 w-28">Category</th>
                        <th class="px-4 py-3 w-40">Title</th>
                        <th class="px-4 py-3 w-60">Description</th>
                        <th class="px-4 py-3 w-28">Status</th>
                        <th class="px-4 py-3 w-28">Date</th>
                        <th class="px-4 py-3 w-20 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                        <tr class="border-t hover:bg-gray-50 transition">
                            {{-- Student --}}
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $complaint->student->name ?? 'Unknown' }}
                                <div class="text-xs text-gray-500 truncate max-w-[140px]">
                                    {{ $complaint->student->email ?? '-' }}
                                </div>
                            </td>

                            {{-- Category --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-2 max-w-[120px] truncate">
                                    <span class="w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 flex-shrink-0">
                                        @switch($complaint->category)
                                            @case('Maintenance') <i class="fas fa-tools text-[11px]"></i> @break
                                            @case('Room Issue') <i class="fas fa-bed text-[11px]"></i> @break
                                            @case('Mess') <i class="fas fa-utensils text-[11px]"></i> @break
                                            @case('Security') <i class="fas fa-shield-alt text-[11px]"></i> @break
                                            @default <i class="fas fa-info-circle text-[11px]"></i>
                                        @endswitch
                                    </span>
                                    <span class="font-medium text-gray-800 truncate">{{ $complaint->category }}</span>
                                </div>
                            </td>

                            {{-- Title --}}
                            <td class="px-4 py-3 max-w-[160px] truncate" title="{{ $complaint->title }}">
                                {{ Str::limit($complaint->title, 35) }}
                            </td>

                            {{-- Description --}}
                            <td class="px-4 py-3 max-w-[200px] truncate" title="{{ $complaint->description }}">
                                {{ Str::limit($complaint->description, 40) }}
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($complaint->status == 'Pending') bg-yellow-100 text-yellow-700
                                    @elseif($complaint->status == 'Resolved') bg-green-100 text-green-700
                                    @elseif($complaint->status == 'In Progress') bg-blue-100 text-blue-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ $complaint->status }}
                                </span>
                            </td>

                            {{-- Date --}}
                            <td class="px-4 py-3 text-gray-500 whitespace-nowrap">
                                {{ $complaint->created_at->format('d M Y') }}
                            </td>

                            {{-- Actions --}}
                            <td class="px-4 py-3 text-center space-x-3 whitespace-nowrap">
                                <a href="{{ route('staff.complaints.show', $complaint) }}" 
                                   class="text-indigo-600 hover:text-indigo-800" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('staff.complaints.edit', $complaint) }}" 
                                   class="text-blue-600 hover:text-blue-800" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('staff.complaints.destroy', $complaint) }}" method="POST" 
                                      class="inline" onsubmit="return confirm('Delete this complaint?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            {{-- Empty State --}}
            <div class="py-16 text-center text-gray-500 text-sm">
                <i class="fas fa-folder-open text-5xl mb-3 text-gray-300"></i>
                <p class="text-lg font-medium">No complaints found</p>
                <p class="text-xs text-gray-400">Try changing the filters or check back later.</p>
            </div>
        @endif
    </div>
</div>


    {{-- Pagination --}}
    <div class="mt-6">
        {{ $complaints->links() }}
    </div>

</div>
@endsection
