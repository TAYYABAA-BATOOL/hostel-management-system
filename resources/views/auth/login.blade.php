<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
  
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-4xl w-full flex">
    <!-- Left Column -->

    <div class="hidden md:flex md:w-1/2 bg-indigo-700 text-white items-center justify-center p-10 relative">
    <img src="{{ asset('images\hostel-dormitory-beds-arranged-room-260nw-696168130.jpg') }}" alt="Hostel" class="absolute inset-0 w-full h-full object-cover opacity-30">
    <div class="relative z-10 text-center">
        <img src="{{ asset('images\hostel logo.png') }}" alt="Logo" class="mx-auto mb-4 w-24">
        <h2 class="text-4xl font-bold mb-2">Welcome to Travelers’ Hub</h2>
        <p>Log in to access your dashboard</p>
    </div>
</div>

    <!-- <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-indigo-500 to-purple-600 text-white items-center justify-center p-10">
        <div>
            <h2 class="text-4xl font-bold mb-4">Welcome Back!</h2>
            <p class="text-lg">Log in to access your dashboard</p>
        </div>
    </div> -->

    <!-- Right Column -->
    <div class="w-full md:w-1/2 p-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required autofocus
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       value="{{ old('email') }}">
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember -->
            <div class="flex items-center mb-4">
                <input id="remember_me" name="remember" type="checkbox"
                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                    Remember me
                </label>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Log in
            </button>

            @if (Route::has('password.request'))
                <div class="text-center mt-4">
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                        Forgot your password?
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>



</body>
</html>
