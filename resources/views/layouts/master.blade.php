<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }" class="scroll-smooth" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Hostel Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="bg-gray-100 text-gray-900 ">


 

<div class="flex flex-col md:flex-row min-h-screen">

        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Panel -->
        <div class="flex-1 flex flex-col w-full">

            <!-- Header -->
            @include('partials.header')

            <!-- Page Content -->
             <div class="flex-1 bg-gray-100 p-4">
        @yield('content')
    </div>

            <!-- Footer -->
            @include('partials.footer')
        </div>
    </div>

    @yield('scripts')
</body>
</html>
