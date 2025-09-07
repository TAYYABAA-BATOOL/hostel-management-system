@extends('layouts.master')

@section('title', isset($room) ? 'Edit Room' : 'Add Room')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
    <div class="px-6 py-8 md:px-10">
        <h2 class="text-3xl font-bold text-indigo-700 mb-8">
            {{ isset($room) ? 'Edit Room' : 'Add New Room' }}
        </h2>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ isset($room) ? route('admin.rooms.update', $room) : route('admin.rooms.store') }}" novalidate>
            @csrf
            @if(isset($room))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Room No -->
                <div>
                    <label for="room_no" class="block text-sm font-medium text-gray-800 mb-1">Room Number</label>
                    <input type="text" name="room_no" id="room_no"
                        value="{{ old('room_no', $room->room_no ?? '') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('room_no') border-red-500 @enderror"
                        placeholder="e.g. 102" required>
                    @error('room_no')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Room Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-800 mb-1">Room Type</label>
                    <select name="type" id="type"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('type') border-red-500 @enderror" required>
                        <option value="">-- Select Type --</option>
                        <option value="Single" {{ old('type', $room->type ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Double" {{ old('type', $room->type ?? '') == 'Double' ? 'selected' : '' }}>Double</option>
                        <option value="Triple" {{ old('type', $room->type ?? '') == 'Triple' ? 'selected' : '' }}>Triple</option>
                        <option value="Suite" {{ old('type', $room->type ?? '') == 'Suite' ? 'selected' : '' }}>Suite</option>
                    </select>
                    @error('type')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Capacity -->
                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-800 mb-1">Capacity</label>
                    <input type="number" name="capacity" id="capacity"
                        value="{{ old('capacity', $room->capacity ?? '') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('capacity') border-red-500 @enderror"
                        placeholder="e.g. 3" required>
                    @error('capacity')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Occupied -->
                <div>
                    <label for="occupied" class="block text-sm font-medium text-gray-800 mb-1">Occupied</label>
                    <input type="number" name="occupied" id="occupied"
                        value="{{ old('occupied', $room->occupied ?? '') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('occupied') border-red-500 @enderror"
                        placeholder="e.g. 2" required>
                    @error('occupied')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="md:col-span-2">
                    <label for="status" class="block text-sm font-medium text-gray-800 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('status') border-red-500 @enderror" required>
                        <option value="">-- Select Status --</option>
                        <option value="Available" {{ old('status', $room->status ?? '') == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Occupied" {{ old('status', $room->status ?? '') == 'Occupied' ? 'selected' : '' }}>Occupied</option>
                        <option value="Partial" {{ old('status', $room->status ?? '') == 'Partial' ? 'selected' : '' }}>Partial</option>
                    </select>
                    @error('status')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-10 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl shadow-sm transition-all duration-300">
                    <i data-lucide="{{ isset($room) ? 'save' : 'plus-circle' }}" class="w-4 h-4"></i>
                    {{ isset($room) ? 'Update Room' : 'Save Room' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
@endsection
