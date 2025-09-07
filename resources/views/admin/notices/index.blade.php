@extends('layouts.master')

@section('title', 'Manage Notices')

@section('content')
<main class="p-6 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-indigo-700">Manage Notices</h1>
        <a href="{{ route('admin.notices.create') }}" class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add Notice
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md shadow mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('admin.notices.index') }}" class="max-w-md mb-6 w-full">
        <div class="relative shadow-sm rounded-lg flex">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1016.65 16.65z"/>
                </svg>
            </div>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by title or description..."
                class="pl-10 pr-4 py-2 w-full text-sm border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-r-lg">
                Search
            </button>
        </div>
    </form>

    {{-- Notices Table --}}
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full text-sm text-left min-w-[600px]">
            <thead class="bg-indigo-600 text-white uppercase font-semibold border-b">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y text-gray-700">
                @forelse($notices as $notice)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800 ">{{ $notice->title }}</td>
                        <td class="px-4 py-3">{{ Str::limit($notice->description, 60) }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $notice->status === 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $notice->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="{{ route('admin.notices.edit', $notice) }}"
                                   class="text-blue-600 hover:text-blue-800 transition duration-150">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11 5H6a2 2 0 00-2 2v11.5A1.5 1.5 0 005.5 20H17a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.notices.destroy', $notice) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this notice?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m4-4h2a1 1 0 011 1v1H8V4a1 1 0 011-1z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 px-4 py-6">No notices found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($notices instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-6">
            {{ $notices->links('pagination::tailwind') }}
        </div>
    @endif
</main>
@endsection
