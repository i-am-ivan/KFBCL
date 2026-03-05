<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KFBCL - Dashboard</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
        <!-- Fixed Header -->
        <header x-data="{menuToggle: false, dropdownOpen: false}" class="sticky top-0 z-50 flex w-full border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
            <div class="flex grow flex-col items-center justify-between xl:flex-row xl:px-6">
                <div class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:py-4 xl:justify-normal xl:border-b-0 xl:px-0 dark:border-gray-800">
                    <!-- Hamburger Toggle BTN -->
                    <button class="z-50 flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 bg-gray-100 text-gray-500 xl:h-11 xl:w-11 dark:border-gray-800 dark:bg-gray-800 dark:text-gray-400">
                        <svg class="fill-current" width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.583252 1C0.583252 0.585788 0.919038 0.25 1.33325 0.25H14.6666C15.0808 0.25 15.4166 0.585786 15.4166 1C15.4166 1.41421 15.0808 1.75 14.6666 1.75L1.33325 1.75C0.919038 1.75 0.583252 1.41422 0.583252 1ZM0.583252 11C0.583252 10.5858 0.919038 10.25 1.33325 10.25L14.6666 10.25C15.0808 10.25 15.4166 10.5858 15.4166 11C15.4166 11.4142 15.0808 11.75 14.6666 11.75L1.33325 11.75C0.919038 11.75 0.583252 11.4142 0.583252 11ZM1.33325 5.25C0.919038 5.25 0.583252 5.58579 0.583252 6C0.583252 6.41421 0.919038 6.75 1.33325 6.75L7.99992 6.75C8.41413 6.75 8.74992 6.41421 8.74992 6C8.74992 5.58579 8.41413 5.25 7.99992 5.25L1.33325 5.25Z" fill=""></path>
                        </svg>
                    </button>

                    <a href="/" class="xl:hidden">
                        <img src="{{ asset('company_logo.png') }}" alt="KFBCL Logo" class="h-8 w-auto">
                    </a>

                    <!-- Application nav menu button -->
                    <button class="z-50 flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 hover:bg-gray-100 xl:hidden dark:text-gray-400 dark:hover:bg-gray-800" @click="menuToggle = !menuToggle">
                        <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.99902 10.4951C6.82745 10.4951 7.49902 11.1667 7.49902 11.9951V12.0051C7.49902 12.8335 6.82745 13.5051 5.99902 13.5051C5.1706 13.5051 4.49902 12.8335 4.49902 12.0051V11.9951C4.49902 11.1667 5.1706 10.4951 5.99902 10.4951ZM17.999 10.4951C18.8275 10.4951 19.499 11.1667 19.499 11.9951V12.0051C19.499 12.8335 18.8275 13.5051 17.999 13.5051C17.1706 13.5051 16.499 12.8335 16.499 12.0051V11.9951C16.499 11.1667 17.1706 10.4951 17.999 10.4951ZM13.499 11.9951C13.499 11.1667 12.8275 10.4951 11.999 10.4951C11.1706 10.4951 10.499 11.1667 10.499 11.9951V12.0051C10.499 12.8335 11.1706 13.5051 11.999 13.5051C12.8275 13.5051 13.499 12.8335 13.499 12.0051V11.9951Z" fill=""></path>
                        </svg>
                    </button>
                </div>

                <div :class="menuToggle ? 'flex' : 'hidden'" class="shadow-md w-full items-center justify-between gap-4 px-5 py-4 xl:flex xl:justify-end xl:px-0 xl:shadow-none hidden">
                    <div class="flex items-center gap-2">
                        <!-- Search or other elements can go here -->
                    </div>

                    <!-- User Area -->
                    <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                        <a class="flex items-center text-gray-700 dark:text-gray-400" href="#" @click.prevent="dropdownOpen = !dropdownOpen">
                            <span class="mr-1 block text-sm font-medium">Kamau Njunge</span>
                            <svg :class="dropdownOpen && 'rotate-180'" class="stroke-gray-500 dark:stroke-gray-400" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.3125 8.65625L9 13.3437L13.6875 8.65625" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>

                        <!-- Dropdown Start -->
                        <div x-show="dropdownOpen" class="absolute right-0 mt-4 flex w-64 flex-col rounded-xl border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-800 dark:bg-gray-800" style="display: none;">
                            <div>
                                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Kamau Njunge
                                </span>
                                <span class="mt-0.5 block text-xs text-gray-500 dark:text-gray-400">
                                    kamau@kfbcl.com
                                </span>
                            </div>

                            <ul class="flex flex-col gap-1 border-b border-gray-200 py-3 dark:border-gray-700">
                                <li>
                                    <a href="#" class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                        <svg class="fill-gray-500 group-hover:fill-gray-700 dark:fill-gray-400 dark:group-hover:fill-gray-300" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z" fill=""></path>
                                        </svg>
                                        Profile
                                    </a>
                                </li>
                            </ul>
                            <a href="{{ route('signin') }}" class="group mt-3 flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                <svg class="fill-gray-500 group-hover:fill-gray-700 dark:group-hover:fill-gray-300" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1007 19.247C14.6865 19.247 14.3507 18.9112 14.3507 18.497L14.3507 14.245H12.8507V18.497C12.8507 19.7396 13.8581 20.747 15.1007 20.747H18.5007C19.7434 20.747 20.7507 19.7396 20.7507 18.497L20.7507 5.49609C20.7507 4.25345 19.7433 3.24609 18.5007 3.24609H15.1007C13.8581 3.24609 12.8507 4.25345 12.8507 5.49609V9.74501L14.3507 9.74501V5.49609C14.3507 5.08188 14.6865 4.74609 15.1007 4.74609L18.5007 4.74609C18.9149 4.74609 19.2507 5.08188 19.2507 5.49609L19.2507 18.497C19.2507 18.9112 18.9149 19.247 18.5007 19.247H15.1007ZM3.25073 11.9984C3.25073 12.2144 3.34204 12.4091 3.48817 12.546L8.09483 17.1556C8.38763 17.4485 8.86251 17.4487 9.15549 17.1559C9.44848 16.8631 9.44863 16.3882 9.15583 16.0952L5.81116 12.7484L16.0007 12.7484C16.4149 12.7484 16.7507 12.4127 16.7507 11.9984C16.7507 11.5842 16.4149 11.2484 16.0007 11.2484L5.81528 11.2484L9.15585 7.90554C9.44864 7.61255 9.44847 7.13767 9.15547 6.84488C8.86248 6.55209 8.3876 6.55226 8.09481 6.84525L3.52309 11.4202C3.35673 11.5577 3.25073 11.7657 3.25073 11.9984Z" fill=""></path>
                                </svg>
                                Logout
                            </a>
                        </div>
                        <!-- Dropdown End -->
                    </div>
                    <!-- User Area -->
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-4 md:p-6">
            <!-- Welcome Card -->
            <div class="mb-6 rounded-xl bg-white p-6 shadow-lg dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Welcome back, Kamau!</h1>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Here's what's happening with your account today.</p>
                    </div>
                    <div class="rounded-full bg-[#c5480e]/10 p-3">
                        <svg class="h-8 w-8 text-[#c5480e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Stat Card 1 -->
                <div class="rounded-xl bg-white p-6 shadow-lg dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Users</p>
                            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">1,248</p>
                        </div>
                        <div class="rounded-full bg-blue-100 p-3 dark:bg-blue-900/30">
                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="rounded-xl bg-white p-6 shadow-lg dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Pending Requests</p>
                            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">42</p>
                        </div>
                        <div class="rounded-full bg-yellow-100 p-3 dark:bg-yellow-900/30">
                            <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="rounded-xl bg-white p-6 shadow-lg dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Completed Tasks</p>
                            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">89</p>
                        </div>
                        <div class="rounded-full bg-green-100 p-3 dark:bg-green-900/30">
                            <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 4 -->
                <div class="rounded-xl bg-white p-6 shadow-lg dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Revenue</p>
                            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">$24,580</p>
                        </div>
                        <div class="rounded-full bg-purple-100 p-3 dark:bg-purple-900/30">
                            <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="rounded-xl bg-white shadow-lg dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Recent Activity</h2>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-400">User</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Activity</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Date</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-400">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-800 dark:text-white">John Doe</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">Created new account</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">2 hours ago</td>
                                    <td class="px-4 py-3">
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800 dark:bg-green-900/30 dark:text-green-400">Completed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-800 dark:text-white">Jane Smith</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">Updated profile</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">4 hours ago</td>
                                    <td class="px-4 py-3">
                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">In Progress</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <!-- Alpine.js for interactivity -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    </body>
</html>
