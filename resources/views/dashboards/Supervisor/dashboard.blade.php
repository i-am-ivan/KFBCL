<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KFBCL | {{ Auth::user()->role }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS via CDN (temporary) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#c5480e',
                        'primary-hover': '#ee5622',
                        'dark-brown': '#8B4513',  // Dark brown color
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom styles if needed */
        .sidebar-transition {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-100" x-data="{ dropdownOpen: false }">
    <!-- Simple Navbar with Tailwind -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-gray-100 border-2 border-primary flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('company_logo.png') }}" alt="KFBCL Logo" class="h-full w-full object-cover">
                        </div>
                        <div class="ml-3">
                            <h2 class="text-lg font-bold text-dark-brown">KFBCL</h2>
                            <p class="text-xs text-gray-500">Growing together</p>
                        </div>
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="flex items-center">
                    <div class="relative" @click.outside="dropdownOpen = false">
                        <!-- Dropdown Toggle Button -->
                        <button @click="dropdownOpen = !dropdownOpen"
                                class="flex items-center space-x-2 focus:outline-none">
                            <!-- User Circle Icon -->
                            <div class="h-9 w-9 rounded-full bg-gradient-to-r from-primary to-primary-hover flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow-sm">
                                <i class="fas fa-user text-sm"></i>
                            </div>

                            <!-- User Name (Hidden on mobile, visible on medium+) -->
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-bold text-dark-brown">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
                            </div>

                            <!-- Chevron Icon -->
                            <svg :class="dropdownOpen ? 'rotate-180' : ''"
                                 class="h-4 w-4 text-gray-500 transition-transform duration-200"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="dropdownOpen"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-64 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                             style="display: none;">

                            <!-- User Info Section -->
                            <div class="p-4 border-b border-gray-100">
                                <div class="flex items-center">
                                    <!-- User Circle Icon -->
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-primary to-primary-hover flex items-center justify-center text-white font-bold text-sm">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-bold text-dark-brown">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Divider -->
                            <div class="border-t border-gray-100"></div>

                            <!-- Profile Link -->
                            <a href="#"
                               class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-dark-brown">
                                <i class="far fa-user-circle mr-3 text-gray-400 w-4"></i>
                                <span>Profile</span>
                            </a>

                            <!-- Settings Link -->
                            <a href="#"
                               class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-dark-brown">
                                <i class="far fa-cog mr-3 text-gray-400 w-4"></i>
                                <span>Settings</span>
                            </a>

                            <!-- Divider -->
                            <div class="border-t border-gray-100"></div>

                            <!-- Sign Out Form -->
                            <form method="POST" action="{{ route('signout') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center w-full px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-dark-brown">
                                    <i class="fas fa-sign-out-alt mr-3 text-gray-400 w-4"></i>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Layout Container -->
    <div class="flex">
        <!-- Aside Section (Left Side) - Fixed height to stretch from navbar to bottom -->
        <aside class="w-64 min-h-[calc(100vh-64px)] bg-white border-r border-gray-200 shadow-sm">
            <div class="h-full flex flex-col">
                <!-- User Info Section -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-r from-primary to-primary-hover flex items-center justify-center text-white font-bold text-sm">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="ml-3">
                            <p class="font-bold text-dark-brown">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 truncate">{{ Auth::user()->email }}</p>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-4 overflow-y-auto">
                    <div class="space-y-1">
                        <div class="pt-2">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Dashboard</p>
                            <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 hover:text-dark-brown">
                                <i class="far fa-tachometer-alt mr-3 text-gray-400 w-4"></i>
                                Dashboard
                            </a>
                            <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 hover:text-dark-brown">
                                <i class="far fa-calendar-alt mr-3 text-gray-400 w-4"></i>
                                Appointments
                            </a>
                        </div>

                        <div class="pt-2">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Manage</p>
                            <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 hover:text-dark-brown">
                                <i class="far fa-motorcycle mr-3 text-gray-400 w-4"></i>
                                Bodaboda
                            </a>
                            <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 hover:text-dark-brown">
                                <i class="far fa-hand-holding-usd mr-3 text-gray-400 w-4"></i>
                                Microfinance
                            </a>
                            <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 hover:text-dark-brown">
                                <i class="far fa-building mr-3 text-gray-400 w-4"></i>
                                Real Estate
                            </a>
                        </div>

                        <div class="pt-2">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Settings</p>
                            <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 hover:text-dark-brown">
                                <i class="far fa-user-circle mr-3 text-gray-400 w-4"></i>
                                Profile
                            </a>
                            <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 hover:text-dark-brown">
                                <i class="far fa-cog mr-3 text-gray-400 w-4"></i>
                                Settings
                            </a>
                        </div>

                        <div class="pt-4 border-t border-gray-100">
                            <form method="POST" action="{{ route('signout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-100 hover:text-dark-brown">
                                    <i class="fas fa-sign-out-alt mr-3 text-gray-400 w-4"></i>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>

                <!-- Footer -->
                <div class="p-4 border-t border-gray-200 text-center">
                    <p class="text-xs text-gray-500">&copy; {{ date('Y') }} KFBCL</p>
                    <p class="text-xs text-gray-400">Powered by Jovicorp Studio</p>
                </div>
            </div>
        </aside>

        <!-- Right Content Section -->
        <main class="flex-1 min-h-[calc(100vh-64px)] overflow-y-auto p-6">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-primary to-primary-hover rounded-xl shadow-lg p-6 mb-8 text-white">
                <h1 class="text-2xl md:text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->first_name }}!</h1>
                <p>Welcome to your KFBCL {{ Auth::user()->role }} management dashboard.</p>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Dashboard Overview</h2>
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Total Members</p>
                                <p class="text-2xl font-bold text-gray-900">1,248</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center">
                                <i class="fas fa-users text-primary"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Active Loans</p>
                                <p class="text-2xl font-bold text-gray-900">342</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center">
                                <i class="fas fa-hand-holding-usd text-primary"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Pending Approvals</p>
                                <p class="text-2xl font-bold text-gray-900">18</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center">
                                <i class="fas fa-clock text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
