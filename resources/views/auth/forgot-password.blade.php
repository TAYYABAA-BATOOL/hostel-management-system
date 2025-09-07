<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Forgot Password</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-4xl w-full flex">

<!-- Left -->
<div class="hidden md:flex md:w-1/2 bg-indigo-700 text-white items-center justify-center p-10 relative">
<img src="{{ asset('images\hostel-dormitory-beds-arranged-room-260nw-696168130.jpg') }}" alt="Hostel" class="absolute inset-0 w-full h-full object-cover opacity-30">
<div class="relative z-10 text-center">
<img src="{{ asset('images/hostel logo.png') }}" alt="Logo" class="mx-auto mb-4 w-24">
<h2 class="text-4xl font-bold mb-2">Travelers’ Hub</h2>
<p>Recover your account</p>
</div>
</div>

<!-- Right -->
<div class="w-full md:w-1/2 p-8">
<h2 class="text-2xl font-bold mb-6 text-center">Forgot Password</h2>

@if (session('status'))
<div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
{{ session('status') }}
</div>
@endif

<form method="POST" action="{{ route('password.email') }}">
@csrf

<div class="mb-4">
<label for="email" class="block text-sm font-medium text-gray-700">Email</label>
<input id="email" name="email" type="email" required value="{{ old('email') }}"
class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
@error('email')
<p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
</div>

<button type="submit"
class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
Send Reset Link
</button>

<div class="text-center mt-4">
<a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
Back to Login
</a>
</div>

</form>
</div>
</div>
</body>
</html>
