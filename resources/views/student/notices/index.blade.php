@extends('layouts.master')

@section('title', 'My Notices')

@section('content')
<div class="max-w-7xl mx-auto p-4 md:p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between flex-wrap gap-4 mb-8">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 flex items-center justify-center rounded-full 
                        bg-gradient-to-br from-indigo-600 to-purple-600 text-white shadow-lg">
                <i class="fas fa-bell text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800">My Notices</h1>
                <p class="text-gray-500 text-sm mt-1">All recent updates and announcements</p>
            </div>
        </div>
    </div>

    {{-- Empty State --}}
    @if ($notices->isEmpty())
        <div class="bg-yellow-50 text-yellow-700 px-8 py-8 rounded-2xl border border-yellow-200 shadow text-center">
            <i class="fas fa-info-circle text-4xl mb-3"></i>
            <p class="text-lg font-semibold">No active notices at the moment</p>
            <p class="text-sm text-yellow-600 mt-1">Stay tuned for new updates.</p>
        </div>
    @else
        {{-- Sleek Notices Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($notices as $notice)
                <div class="flex flex-col bg-white rounded-xl overflow-hidden border border-gray-100 
                            shadow-sm hover:shadow-lg hover:-translate-y-1 transition duration-300 group">

                    {{-- Gradient Top Bar --}}
                    <div class="flex items-center justify-between px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600">
                        <div class="flex items-center gap-2 text-white font-medium text-sm">
                            <span class="w-6 h-6 flex items-center justify-center rounded-full bg-white/20">
                                <i class="fas fa-file-alt text-xs"></i>
                            </span>
                            Notice
                        </div>
                        <span class="text-xs text-white/80">{{ $notice->created_at->format('d M, Y') }}</span>
                    </div>

                    {{-- Content --}}
                    <div class="p-4 flex flex-col h-full">
                        <h2 class="text-base font-semibold text-gray-800 mb-1 group-hover:text-indigo-600 transition">
                            {{ $notice->title }}
                        </h2>
                        <p class="text-xs text-gray-600 leading-relaxed line-clamp-3 mb-3">
                            {{ $notice->description }}
                        </p>

                        {{-- Footer --}}
                        <div class="mt-auto flex items-center justify-between border-t pt-2">
                            @if($notice->attachment)
                                <a href="{{ asset('storage/'.$notice->attachment) }}" target="_blank"
                                   class="text-[11px] font-medium text-indigo-600 hover:text-indigo-800 flex items-center gap-1 transition">
                                    <i class="fas fa-paperclip"></i> Attachment
                                </a>
                            @else
                                <span class="text-[11px] text-gray-400 italic">No attachment</span>
                            @endif

                            <a href="{{ route('student.notices.index', $notice->id) }}"
                               class="text-[11px] font-medium text-blue-600 hover:text-blue-800 flex items-center gap-1 transition">
                                Read More <i class="fas fa-arrow-right text-[9px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            {{ $notices->links() }}
        </div>
    @endif

</div>
@endsection
