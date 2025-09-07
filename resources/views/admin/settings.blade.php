@extends('layouts.master')

@section('title', 'Settings')

@section('content')
<main class="p-6 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
    <div class="bg-white shadow-xl rounded-xl p-6 w-full max-w-lg mx-auto">
        <h1 class="text-3xl font-bold text-indigo-700 mb-4">⚙️ Hostel Settings</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium text-sm text-gray-700">🏠 Hostel Name</label>
                <input name="hostel_name" placeholder="Hostel Name"
                       value="{{ old('hostel_name', $setting->hostel_name) }}"
                       class="w-full border px-3 py-2 rounded focus:ring focus:ring-indigo-200">
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">📧 Contact Email</label>
                <input name="contact_email" placeholder="Contact Email"
                       value="{{ old('contact_email', $setting->contact_email) }}"
                       class="w-full border px-3 py-2 rounded focus:ring focus:ring-indigo-200">
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">📞 Contact Phone</label>
                <input name="contact_phone" placeholder="Contact Phone"
                       value="{{ old('contact_phone', $setting->contact_phone) }}"
                       class="w-full border px-3 py-2 rounded focus:ring focus:ring-indigo-200">
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">📍 Address</label>
                <textarea name="address" rows="3" placeholder="Address"
                          class="w-full border px-3 py-2 rounded focus:ring focus:ring-indigo-200">{{ old('address', $setting->address) }}</textarea>
            </div>

            <button
                class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                💾 Save Settings
            </button>
        </form>
    </div>
</main>
@endsection
