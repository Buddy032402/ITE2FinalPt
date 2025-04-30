<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }">
        <!-- Sidebar -->
        <div x-show="sidebarOpen" class="fixed inset-0 z-40 lg:hidden" x-description="Off-canvas menu backdrop" @click="sidebarOpen = false"></div>
        
        <div x-show="sidebarOpen" class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r lg:static lg:block">
            <nav class="mt-5 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                    <span class="ml-3">Products</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                    <span class="ml-3">Categories</span>
                </a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1">
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-gray-900">
                        @yield('header')
                    </h1>
                </div>
            </header>

            <main class="py-6">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>