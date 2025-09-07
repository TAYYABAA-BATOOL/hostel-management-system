@extends('layouts.master')

@section('title', 'My Complaints')

@section('content')
<div class="max-w-6xl mx-auto p-4 md:p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold bg-gradient-to-r from-indigo-600 to-purple-600 text-transparent bg-clip-text">
                My Complaints
            </h1>
            <p class="text-gray-500 text-sm mt-1">Track and manage all complaints you submitted</p>
        </div>
        <a href="{{ route('student.complaints.create') }}" 
           class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium text-sm rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-lg">
           <i class="fas fa-plus mr-2"></i> New Complaint
        </a>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-6 px-4 py-2.5 bg-green-100 text-green-700 rounded-lg shadow-sm font-medium text-sm border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- Quick Filter Chips --}}
    <div class="flex flex-wrap gap-2 mb-6">
        @php $statuses = ['All', 'Pending', 'In Progress', 'Resolved', 'Rejected']; @endphp
        @foreach($statuses as $status)
            <a href="{{ route('student.complaints.index', ['status' => $status != 'All' ? $status : null]) }}"
               class="px-4 py-1.5 rounded-full text-xs font-medium border transition
                    @if(request('status') == $status || (!request('status') && $status=='All'))
                        bg-indigo-600 text-white border-indigo-600 shadow-sm
                    @else
                        bg-white text-gray-600 hover:bg-gray-50 border-gray-200
                    @endif">
                {{ $status }}
            </a>
        @endforeach
    </div>

    {{-- Complaints Grid --}}
    <div class="grid md:grid-cols-2 gap-6">
        @forelse($complaints as $complaint)
            <div class="bg-white shadow-sm hover:shadow-xl transition-all duration-300 rounded-xl border border-gray-100 overflow-hidden group transform hover:-translate-y-1">
                
                {{-- Card Top Bar --}}
                <div class="flex justify-between items-center px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600">
                    <div class="flex items-center space-x-2 text-sm text-white font-medium">
                        {{-- Category Icon --}}
                        <span class="w-6 h-6 flex items-center justify-center rounded-full bg-white/20">
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
                        <span>{{ $complaint->category }}</span>
                    </div>
                    <span class="text-xs text-white/80">{{ $complaint->created_at->format('d M Y') }}</span>
                </div>

                {{-- Card Content --}}
                <div class="p-4">
                    {{-- Title --}}
                    <h2 class="text-base font-semibold text-gray-800 group-hover:text-indigo-600 transition">
                        {{ $complaint->title }}
                    </h2>

                    {{-- Description --}}
                    <p class="mt-2 text-gray-600 text-xs leading-relaxed line-clamp-2">
                        {{ Str::limit($complaint->description, 70) }}
                    </p>

                    {{-- Status + View --}}
                   <div class="mt-3 flex items-center justify-between">
                            <span class="px-3 py-1 text-[11px] font-semibold rounded-full shadow-md
                                @if($complaint->status == 'Pending') bg-gradient-to-r from-yellow-300 to-yellow-500 text-white
                                @elseif($complaint->status == 'Resolved') bg-gradient-to-r from-green-400 to-emerald-500 text-white
                                @elseif($complaint->status == 'In Progress') bg-gradient-to-r from-blue-400 to-indigo-500 text-white
                                @else bg-gradient-to-r from-red-400 to-pink-500 text-white @endif">
                                {{ $complaint->status }}
                            </span>

                            <a href="{{ route('student.complaints.show', $complaint) }}" 
                               class="text-indigo-600 hover:text-indigo-800 text-[11px] font-medium inline-flex items-center transition">
                                View <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="col-span-full text-center text-gray-500 py-14 bg-white rounded-xl shadow-sm border border-gray-100">
                <i class="fas fa-folder-open text-6xl mb-3 text-gray-300"></i>
                <p class="text-lg font-semibold">No complaints found</p>
                <p class="text-xs text-gray-400">Looks like you haven’t submitted any complaints yet.</p>
                <a href="{{ route('student.complaints.create') }}" 
                   class="mt-5 inline-block px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-xs font-medium rounded-lg shadow-sm transition-transform hover:scale-105">
                   Submit a Complaint
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $complaints->links() }}
    </div>

</div>
@endsection
