@extends('layouts.master')

@section('title', 'Settings')

@section('content')
<main class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-100">
        {{-- Tabs Navigation --}}
        <div class="flex border-b border-gray-200">
            <button id="tab-settings" class="tab-btn active-tab flex items-center gap-2 px-6 py-3 text-indigo-600 font-semibold border-b-2 border-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v4H3V4zM3 10h18v10a1 1 0 01-1 1H4a1 1 0 01-1-1V10z" />
                </svg>
                Update Settings
            </button>
            <button id="tab-info" class="tab-btn flex items-center gap-2 px-6 py-3 text-gray-500 hover:text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M12 4a8 8 0 100 16 8 8 0 000-16zm0 6v4m0 4h.01" />
                </svg>
                Current Info
            </button>
        </div>

        {{-- Tabs Content --}}
        <div class="p-8">
            {{-- Update Settings Tab --}}
            <div id="settings-panel" class="tab-content">
                <h2 class="text-2xl font-bold text-indigo-700 mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M5 13l4 4L19 7" />
                    </svg>
                    Update Hostel Settings
                </h2>

                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-4 rounded space-y-1">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.settings.index') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Hostel Name</label>
                        <input type="text" name="hostel_name" value="{{ old('hostel_name', $setting->hostel_name) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Contact Email</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $setting->contact_email) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Contact Phone</label>
                        <input type="text" name="contact_phone" value="{{ old('contact_phone', $setting->contact_phone) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Address</label>
                        <textarea name="hostel_address" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400"
                            placeholder="Enter hostel address">{{ old('hostel_address', $setting->hostel_address) }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-lg transition duration-200 shadow">
                        Save Settings
                    </button>
                </form>
            </div>

            {{-- Current Info Tab --}}
            <div id="info-panel" class="tab-content hidden">
                <h2 class="text-2xl font-bold text-indigo-700 mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
                    </svg>
                    Current Hostel Info
                </h2>

                <div class="space-y-5 text-gray-700">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Hostel Name</p>
                        <p class="text-lg">{{ $setting->hostel_name ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-600">Contact Email</p>
                        <p class="text-lg">{{ $setting->contact_email ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-600">Contact Phone</p>
                        <p class="text-lg">{{ $setting->contact_phone ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-600">Address</p>
                        <p class="text-lg">{{ $setting->hostel_address ?? 'House No. 17-B, H-Block, Johar Town, Lahore, Pakistan' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- Tab Script --}}
<script>
    const settingsTab = document.getElementById('tab-settings');
    const infoTab = document.getElementById('tab-info');
    const settingsPanel = document.getElementById('settings-panel');
    const infoPanel = document.getElementById('info-panel');

    settingsTab.addEventListener('click', () => {
        settingsTab.classList.add('active-tab', 'border-indigo-600', 'text-indigo-600');
        infoTab.classList.remove('active-tab', 'border-indigo-600', 'text-indigo-600');

        settingsPanel.classList.remove('hidden');
        infoPanel.classList.add('hidden');
    });

    infoTab.addEventListener('click', () => {
        infoTab.classList.add('active-tab', 'border-indigo-600', 'text-indigo-600');
        settingsTab.classList.remove('active-tab', 'border-indigo-600', 'text-indigo-600');

        infoPanel.classList.remove('hidden');
        settingsPanel.classList.add('hidden');
    });
</script>
@endsection
