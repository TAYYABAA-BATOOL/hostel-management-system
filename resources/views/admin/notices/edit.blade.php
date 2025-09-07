@extends('layouts.master')

@section('title', isset($notice) ? 'Edit Notice' : 'Add Notice')

@section('content')
<main class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-50 py-10 px-4">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-gray-200 p-8">

        <h2 class="text-3xl font-bold text-indigo-700 mb-6 border-b pb-2">
            {{ isset($notice) ? 'Edit Notice' : 'Add New Notice' }}
        </h2>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg p-4 mb-6 space-y-1">
                @foreach($errors->all() as $error)
                    <div class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856C18.07 20 19 19.104 19 18V6c0-1.104-.93-2-2.082-2H7.082C5.93 4 5 4.896 5 6v12c0 1.104.93 2 2.082 2z"/>
                        </svg>
                        <span>{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <form method="POST"
              action="{{ isset($notice) ? route('admin.notices.update', $notice) : route('admin.notices.store') }}"
              class="space-y-6">
            @csrf
            @if(isset($notice)) @method('PUT') @endif

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $notice->title ?? '') }}"
                    placeholder="Notice title"
                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none transition"
                    required
                >
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Write the notice details..."
                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none transition resize-none"
                    required
                >{{ old('description', $notice->description ?? '') }}</textarea>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                <select
                    id="status"
                    name="status"
                    class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none transition"
                    required
                >
                    <option value="Active" {{ old('status', $notice->status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status', $notice->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm py-3 rounded-xl transition shadow-sm"
                >
                    {{ isset($notice) ? 'Update Notice' : 'Save Notice' }}
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
