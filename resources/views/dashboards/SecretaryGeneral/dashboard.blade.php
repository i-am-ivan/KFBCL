
<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Auth::user()->role }} | KFBCL Dashboard</title>

    <link rel="icon" href="{{ asset('assets/favicon.ico') }}">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

  <body x-data="{ page: 'saas', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}">
    <!-- ===== Preloader Start ===== -->
    <div x-show="loaded"
      x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
      class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
      <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent"></div>
    </div>
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">

        <!-- ===== Sidebar Start ===== -->
        @include(Auth::user()->getAsideView())
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
            <!-- Small Device Overlay Start -->
            <div :class="sidebarToggle ? 'block xl:hidden' : 'hidden'" class="fixed z-50 h-screen w-full bg-gray-900/50">
            </div>
            <!-- Small Device Overlay End -->

            <!-- ===== Main Content Start ===== -->
            <main>
                <!-- ===== Header Start ===== -->
                @include('Layouts.General.header')
                <!-- ===== Header End ===== -->

                <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
                    <div class="space-y-6">
                    <!-- Greeting card Start -->
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
                        <div class="flex w-full flex-col items-center gap-6 xl:flex-row">
                            <div class="h-[78px] w-[78px] overflow-hidden rounded-full border border-gray-200 bg-gray-100 flex items-center justify-center dark:border-gray-800 dark:bg-gray-800">
                            <svg class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            </div>
                            <div class="order-3 xl:order-2">
                            <h4 class="mb-2 text-center text-lg font-semibold text-gray-800 xl:text-left dark:text-white/90">
                                Welcome back! {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}.
                            </h4>
                            <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->role }}
                                </p>
                                <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                Since {{ Auth::user()->created_at->format('M d, Y H:i') }}.
                                </p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Greeting card End -->

                        <div class="col-span-12">
                            <!-- Metric Group Two -->
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 xl:grid-cols-4"
                                x-data x-init="$store.stats.init()">

                                <!-- Members Metric -->
                                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                                    <p class="text-theme-sm text-gray-500 dark:text-gray-400">Members</p>
                                    <div class="mt-3 flex items-end justify-between">
                                        <div class="items-center justify-between">
                                            <div>
                                                <div class="mt-5 flex items-center gap-2">
                                                    <div class="flex items-center justify-center gap-6">
                                                        <div>
                                                            <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90"
                                                            x-text="$store.stats.allMembers">0</p>
                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">All Members</p>
                                                        </div>
                                                        <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>
                                                        <div>
                                                            <p class="text-lg font-semibold text-center text-success-700 dark:text-white/90"
                                                            x-text="$store.stats.members">0</p>
                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">Member</p>
                                                        </div>
                                                        <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>
                                                        <div>
                                                            <p class="text-lg font-semibold text-center text-warning-700 dark:text-white/90"
                                                            x-text="$store.stats.nonMembers">0</p>
                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">Non-Members</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vehicles Metric -->
                                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                                    <p class="text-theme-sm text-gray-500 dark:text-gray-400">Vehicles</p>
                                    <div class="mt-3 flex items-end justify-between">
                                        <div class="items-center justify-between">
                                            <div>
                                                <div class="mt-5 flex items-center gap-2">
                                                    <div class="flex items-center justify-center gap-6">
                                                        <div>
                                                            <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90"
                                                            x-text="$store.stats.allVehicles">0</p>
                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">Total Vehicles</p>
                                                        </div>
                                                        <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>
                                                        <div>
                                                            <p class="text-lg font-semibold text-center text-success-700 dark:text-white/90"
                                                            x-text="$store.stats.motorcycles">0</p>
                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">Motorcycles</p>
                                                        </div>
                                                        <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>
                                                        <div>
                                                            <p class="text-lg font-semibold text-center text-warning-700 dark:text-white/90"
                                                            x-text="$store.stats.tukTuks">0</p>
                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">Tuk Tuk</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Loans Metric -->
                                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                                    <p class="text-theme-sm text-gray-500 dark:text-gray-400">Loans</p>
                                    <div class="mt-3 flex items-end justify-between">
                                        <div class="items-center justify-between">
                                            <div>
                                                <div class="mt-5 flex items-center gap-2">
                                                    <div class="flex items-center justify-center gap-6">
                                                        <div>
                                                            <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90"
                                                            x-text="$store.stats.allLoans">0</p>
                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">Total Loans</p>
                                                        </div>
                                                        <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>
                                                        <div>
                                                            <p class="text-lg font-semibold text-center text-success-700 dark:text-white/90"
                                                            x-text="$store.stats.activeLoans">0</p>
                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">Active</p>
                                                        </div>
                                                        <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>
                                                        <div>
                                                            <p class="text-lg font-semibold text-center text-warning-700 dark:text-white/90"
                                                            x-text="$store.stats.badLoans">0</p>
                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">Defaulted/Stopped</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contributions Wallet Metric (already had binding) -->
                                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                                    <p class="text-theme-sm text-gray-500 dark:text-gray-400">Contributions Wallet</p>
                                    <div class="mt-3 flex items-end justify-between">
                                        <div>
                                            <h4 class="text-xl font-semibold text-gray-500 dark:text-white/90"
                                                x-text="$store.stats.contributionBalance">KES 0.00</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Analytics Start -->
                        <div class="col-span-12">
                            <!-- Charts Grid -->
                            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                                <!-- Contributions Chart -->
                                <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">

                                    <div class="flex items-center justify-between gap-5">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                            Contributions Statistics
                                            </h3>
                                            <p class="dark:text-gray-40 text-sm text-gray-500">
                                            Contributions Performance analysis.
                                            </p>
                                        </div>
                                        <div>
                                            <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                                <select class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'" @change="isOptionSelected = true">
                                                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                    Monthly
                                                    </option>

                                                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                    Yearly
                                                    </option>
                                                </select>
                                                <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center gap-5 pt-5">

                                            <div class="flex items-center gap-1.5">
                                                <div class="bg-brand-500 h-2.5 w-2.5 rounded-full"></div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Paid-In
                                                </p>
                                            </div>

                                            <div class="flex items-center gap-1.5">
                                                <div class="bg-brand-200 h-2.5 w-2.5 rounded-full"></div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Paid-Out
                                                </p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="h-[256px] w-full" style="min-height: 320px;">
                                        <canvas id="contributionChart" class="apexcharts-canvas apexchartsdsp79uk4k apexcharts-theme-" style="width: 617px; height: 256px;"></canvas>
                                    </div>

                                </div>

                                <!-- Loans Performance Chart -->
                                <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">

                                    <div class="flex items-center justify-between gap-5">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                            Loans Statistics
                                            </h3>
                                            <p class="dark:text-gray-40 text-sm text-gray-500">
                                            Loans Performance Analytics.
                                            </p>
                                        </div>
                                        <div>
                                            <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                                <select class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'" @change="isOptionSelected = true">
                                                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                    Monthly
                                                    </option>

                                                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                    Yearly
                                                    </option>
                                                </select>
                                                <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center gap-5 pt-5">

                                            <div class="flex items-center gap-1.5">
                                                <div class="bg-brand-500 h-2.5 w-2.5 rounded-full"></div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Disbursed
                                                </p>
                                            </div>

                                            <div class="flex items-center gap-1.5">
                                                <div class="bg-success-500 h-2.5 w-2.5 rounded-full"></div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Repaid
                                                </p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="h-[256px] w-full" style="min-height: 320px;">
                                        <canvas id="loansChart" style="width: 617px; height: 256px;"></canvas>
                                    </div>

                                    <!-- Loan Status Mini Chart -->
                                    <div class="mt-6 border-t border-gray-200 pt-6 dark:border-gray-800">
                                        <div class="mb-3 flex items-center justify-between">
                                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-400">
                                                Loan Status Distribution
                                            </h4>
                                            <div class="flex items-center gap-3">
                                                <div class="flex items-center gap-2">
                                                    <span class="h-3 w-3 rounded-full bg-brand-500"></span>
                                                    <span class="text-xs text-gray-600 dark:text-gray-400">Active</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span class="h-3 w-3 rounded-full bg-success-500"></span>
                                                    <span class="text-xs text-gray-600 dark:text-gray-400">Repaid</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span class="h-3 w-3 rounded-full bg-error-500"></span>
                                                    <span class="text-xs text-gray-600 dark:text-gray-400">Defaulted</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="h-40 w-full">
                                            <canvas id="loanStatusChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Analytics End -->

                    <!-- Appointment Table -->
                            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row sm:items-center dark:border-gray-800">
                                    <div>
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                        Today's Upcoming Appointments
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        All your conformed appointments for today
                                    </p>
                                    </div>
                                    <div class="flex gap-3">
                                        <div x-data="{openDropDown: false}" class="relative h-fit">
                                            <button @click="openDropDown = !openDropDown" :class="openDropDown ? 'text-gray-700 dark:text-white' : 'text-gray-400 hover:text-gray-700 dark:hover:text-white'" class="text-gray-400 hover:text-gray-700 dark:hover:text-white">
                                                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2441 6C10.2441 5.0335 11.0276 4.25 11.9941 4.25H12.0041C12.9706 4.25 13.7541 5.0335 13.7541 6C13.7541 6.9665 12.9706 7.75 12.0041 7.75H11.9941C11.0276 7.75 10.2441 6.9665 10.2441 6ZM10.2441 18C10.2441 17.0335 11.0276 16.25 11.9941 16.25H12.0041C12.9706 16.25 13.7541 17.0335 13.7541 18C13.7541 18.9665 12.9706 19.75 12.0041 19.75H11.9941C11.0276 19.75 10.2441 18.9665 10.2441 18ZM11.9941 10.25C11.0276 10.25 10.2441 11.0335 10.2441 12C10.2441 12.9665 11.0276 13.75 11.9941 13.75H12.0041C12.9706 13.75 13.7541 12.9665 13.7541 12C13.7541 11.0335 12.9706 10.25 12.0041 10.25H11.9941Z" fill=""></path>
                                                </svg>
                                            </button>
                                            <div x-show="openDropDown" @click.outside="openDropDown = false" class="shadow-theme-lg dark:bg-gray-dark absolute top-full right-0 z-40 w-40 space-y-1 rounded-2xl border border-gray-200 bg-white p-2 dark:border-gray-800" style="display: none;">
                                                <button @click="window.location.href='{{ route('treasurer.appointments') }}'" class="text-theme-xs flex w-full rounded-lg px-3 py-2 text-left font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                                    View More
                                                </button>
                                            </div>
                                            </div>
                                    </div>
                                </div>

                                <div class="custom-scrollbar overflow-x-auto" x-data="todayConfirmedTop10()" x-init="init()">
                                    <table class="w-full table-auto">
                                        <thead>
                                            <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                <th class="p-4 whitespace-nowrap">
                                                <div class="flex w-full items-center gap-3">
                                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                    #Appointment ID
                                                    </p>
                                                </div>
                                                </th>
                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                <div class="flex cursor-pointer items-center gap-3" @click="sortBy('applicantName')">
                                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                    Applicant
                                                    </p>
                                                    <span class="flex flex-col gap-0.5">
                                                    <svg :class="sort.key === 'applicantName' && sort.asc ? 'text-gray-800 dark:text-gray-400' : 'text-gray-300'"
                                                        width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                        d="M4.40962 0.585167C4.21057 0.300808 3.78943 0.300807 3.59038 0.585166L1.05071 4.21327C0.81874 4.54466 1.05582 5 1.46033 5H6.53967C6.94418 5 7.18126 4.54466 6.94929 4.21327L4.40962 0.585167Z"
                                                        fill="currentColor" />
                                                    </svg>
                                                    <svg :class="sort.key === 'applicantName' && !sort.asc ? 'text-gray-800 dark:text-gray-400' : 'text-gray-300'"
                                                        width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                        d="M4.40962 4.41483C4.21057 4.69919 3.78943 4.69919 3.59038 4.41483L1.05071 0.786732C0.81874 0.455343 1.05582 0 1.46033 0H6.53967C6.94418 0 7.18126 0.455342 6.94929 0.786731L4.40962 4.41483Z"
                                                        fill="currentColor" />
                                                    </svg>
                                                    </span>
                                                </div>
                                                </th>
                                                <!-- New Phone Column Header -->
                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                Phone
                                                </th>
                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                <div class="flex cursor-pointer items-center gap-3" @click="sortBy('appointmentType')">
                                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                    Type
                                                    </p>
                                                    <span class="flex flex-col gap-0.5">
                                                    <svg :class="sort.key === 'appointmentType' && sort.asc ? 'text-gray-800 dark:text-gray-400' : 'text-gray-300'"
                                                        width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                        d="M4.40962 0.585167C4.21057 0.300808 3.78943 0.300807 3.59038 0.585166L1.05071 4.21327C0.81874 4.54466 1.05582 5 1.46033 5H6.53967C6.94418 5 7.18126 4.54466 6.94929 4.21327L4.40962 0.585167Z"
                                                        fill="currentColor" />
                                                    </svg>
                                                    <svg :class="sort.key === 'appointmentType' && !sort.asc ? 'text-gray-800 dark:text-gray-400' : 'text-gray-300'"
                                                        width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                        d="M4.40962 4.41483C4.21057 4.69919 3.78943 4.69919 3.59038 4.41483L1.05071 0.786732C0.81874 0.455343 1.05582 0 1.46033 0H6.53967C6.94418 0 7.18126 0.455342 6.94929 0.786731L4.40962 4.41483Z"
                                                        fill="currentColor" />
                                                    </svg>
                                                    </span>
                                                </div>
                                                </th>
                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                <div class="flex cursor-pointer items-center gap-3" @click="sortBy('appointmentDate')">
                                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                    Date & Time
                                                    </p>
                                                    <span class="flex flex-col gap-0.5">
                                                    <svg :class="sort.key === 'appointmentDate' && sort.asc ? 'text-gray-800 dark:text-gray-400' : 'text-gray-300'"
                                                        width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                        d="M4.40962 0.585167C4.21057 0.300808 3.78943 0.300807 3.59038 0.585166L1.05071 4.21327C0.81874 4.54466 1.05582 5 1.46033 5H6.53967C6.94418 5 7.18126 4.54466 6.94929 4.21327L4.40962 0.585167Z"
                                                        fill="currentColor" />
                                                    </svg>
                                                    <svg :class="sort.key === 'appointmentDate' && !sort.asc ? 'text-gray-800 dark:text-gray-400' : 'text-gray-300'"
                                                        width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                        d="M4.40962 4.41483C4.21057 4.69919 3.78943 4.69919 3.59038 4.41483L1.05071 0.786732C0.81874 0.455343 1.05582 0 1.46033 0H6.53967C6.94418 0 7.18126 0.455342 6.94929 0.786731L4.40962 4.41483Z"
                                                        fill="currentColor" />
                                                    </svg>
                                                    </span>
                                                </div>
                                                </th>
                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                Company Name
                                                </th>
                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                Priority
                                                </th>
                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                            <!-- Empty state -->
                                            <template x-if="sortedRows.length === 0">
                                                <tr>
                                                    <td colspan="8" class="p-8 text-center">
                                                        <div class="flex flex-col items-center justify-center">
                                                            <!-- Icon -->
                                                            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                            </svg>
                                                            <!-- Message -->
                                                            <h3 class="text-gray-500 dark:text-gray-400">No Appointments scheduled for today</h3>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>

                                            <template x-for="row in sortedRows" :key="row.id">
                                                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                <td class="p-4 whitespace-nowrap">
                                                    <div class="group flex items-center gap-3">
                                                    <a @click="rescheduleModal = true"
                                                        class="text-theme-xs font-medium text-gray-700 group-hover:underline dark:text-gray-400"
                                                        x-text="row.referenceId"></a>
                                                    </div>
                                                </td>
                                                <td class="p-4 whitespace-nowrap">
                                                    <div>
                                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                        x-text="row.applicantName"></span>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400" x-text="row.applicantEmail"></p>
                                                    </div>
                                                </td>
                                                <!-- New Phone Column Data -->
                                                <td class="p-4 whitespace-nowrap">
                                                    <span class="text-sm text-gray-700 dark:text-gray-400" x-text="row.applicantPhone"></span>
                                                </td>
                                                <td class="p-4 whitespace-nowrap">
                                                    <span class="text-sm text-gray-700 dark:text-gray-400" x-text="row.appointmentType"></span>
                                                </td>
                                                <td class="p-4 whitespace-nowrap">
                                                    <div>
                                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                        x-text="row.appointmentDate"></p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400" x-text="row.appointmentTime"></p>
                                                    </div>
                                                </td>
                                                <td class="p-4 whitespace-nowrap">
                                                    <p class="text-sm text-gray-700 dark:text-gray-400 truncate max-w-[200px]" x-text="row.subject"
                                                    :title="row.subject"></p>
                                                </td>
                                                <td class="p-4 whitespace-nowrap">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                    :class="{
                                                        'bg-success-100 text-success-800 dark:bg-success-900/30 dark:text-success-400': row.priority === 'low',
                                                        'bg-brand-100 text-brand-800 dark:bg-brand-900/30 dark:text-brand-400': row.priority === 'normal',
                                                        'bg-warning-100 text-warning-800 dark:bg-warning-900/30 dark:text-warning-400': row.priority === 'high',
                                                        'bg-error-100 text-error-800 dark:bg-error-900/30 dark:text-error-400': row.priority === 'urgent'
                                                    }"
                                                    x-text="row.priority.charAt(0).toUpperCase() + row.priority.slice(1)">
                                                    </span>
                                                </td>
                                                <td class="p-4 whitespace-nowrap">
                                                    <span class="bg-success-50 dark:bg-success-500/15 text-success-700 dark:text-success-500 text-theme-xs rounded-full px-2 py-0.5 font-medium"
                                                    x-show="row.status === 'Confirmed'">Confirmed</span>
                                                </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    <!-- Metrics Start -->
                    </div>
                </div>

            </main>
            <!-- ===== Main Content End ===== -->
        </div>
      <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->

    <script defer src="{{ asset('assets/bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Appointments -->
    <script>
        function todayConfirmedTop10() {
            return {
                originalRows: [],
                sort: { key: "appointmentDate", asc: true },

                init() {
                    this.fetchTodayConfirmedTop10();
                },

                async fetchTodayConfirmedTop10() {
                    try {
                        const response = await fetch('/appointments/my-today-confirmed-top10');
                        const result = await response.json();

                        if (result.success) {
                            this.originalRows = result.data;
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                },

                get sortedRows() {
                    return this.originalRows.slice().sort((a, b) => {
                        let valA = a[this.sort.key];
                        let valB = b[this.sort.key];
                        if (typeof valA === "string") valA = valA.toLowerCase();
                        if (typeof valB === "string") valB = valB.toLowerCase();
                        if (valA < valB) return this.sort.asc ? -1 : 1;
                        if (valA > valB) return this.sort.asc ? 1 : -1;
                        return 0;
                    });
                },

                sortBy(key) {
                    if (this.sort.key === key) {
                        this.sort.asc = !this.sort.asc;
                    } else {
                        this.sort.key = key;
                        this.sort.asc = true;
                    }
                }
            };
        }
    </script>

    <!-- Stats and Charts Alpine JS -->
    <script>

        document.addEventListener('alpine:init', () => {
            // Stats Store
            Alpine.store('stats', {
                // Member stats
                allMembers: 0,
                members: 0,
                nonMembers: 0,

                // Vehicle stats
                allVehicles: 0,
                motorcycles: 0,
                tukTuks: 0,

                // Loan stats
                allLoans: 0,
                activeLoans: 0,
                badLoans: 0,

                // Contribution wallet
                contributionBalance: 'KES 0.00',

                // Chart data
                monthlyContributions: [],
                monthlyLoans: [],
                loanStatus: { active: 0, repaid: 0, defaulted: 0 },

                // Initialize all stats
                init() {
                    this.loadMemberStats();
                    this.loadVehicleStats();
                    this.loadLoanStats();
                    this.loadContributionBalance();
                    this.loadChartData();
                },

                loadMemberStats() {
                    // All members
                    fetch('/members/count')
                        .then(res => res.json())
                        .then(data => this.allMembers = data.count);

                    // Members
                    fetch('/stats/members/member')
                        .then(res => res.json())
                        .then(data => this.members = data.count);

                    // Non-members
                    fetch('/stats/members/non-member')
                        .then(res => res.json())
                        .then(data => this.nonMembers = data.count);
                },

                loadVehicleStats() {
                    // All vehicles
                    fetch('/stats/vehicles/all')
                        .then(res => res.json())
                        .then(data => this.allVehicles = data.count);

                    // Motorcycles
                    fetch('/stats/vehicles/motorcycles')
                        .then(res => res.json())
                        .then(data => this.motorcycles = data.count);

                    // Tuk Tuks
                    fetch('/stats/vehicles/tuktuk')
                        .then(res => res.json())
                        .then(data => this.tukTuks = data.count);
                },

                loadLoanStats() {
                    // All loans
                    fetch('/stats/loans/all')
                        .then(res => res.json())
                        .then(data => this.allLoans = data.count);

                    // Active loans
                    fetch('/stats/loans/active')
                        .then(res => res.json())
                        .then(data => this.activeLoans = data.count);

                    // Bad loans (Defaulted/Stopped)
                    fetch('/stats/loans/bad')
                        .then(res => res.json())
                        .then(data => this.badLoans = data.count);
                },

                loadContributionBalance() {
                    fetch('/contributions/balance/total')
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) this.contributionBalance = data.formatted;
                        });
                },

                loadChartData() {
                    // Monthly contributions
                    fetch('/stats/contributions/monthly')
                        .then(res => res.json())
                        .then(data => {
                            this.monthlyContributions = data.data;
                            this.initContributionChart();
                        });

                    // Monthly loans
                    fetch('/stats/loans/monthly')
                        .then(res => res.json())
                        .then(data => {
                            this.monthlyLoans = data.data;
                            this.initLoansChart();
                        });

                    // Loan status distribution
                    fetch('/stats/loans/status')
                        .then(res => res.json())
                        .then(data => {
                            this.loanStatus = data;
                            this.initLoanStatusChart();
                        });
                },

                initContributionChart() {
                    const ctx = document.getElementById('contributionChart');
                    if (!ctx) return;

                    const months = this.monthlyContributions.map(d => d.month);
                    const paidIn = this.monthlyContributions.map(d => d.paid_in / 1000); // Convert to thousands
                    const paidOut = this.monthlyContributions.map(d => d.paid_out / 1000);

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: months,
                            datasets: [
                                {
                                    label: 'Paid-In (Ksh 000.00)',
                                    data: paidIn,
                                    backgroundColor: '#CC561E',
                                    borderRadius: 4
                                },
                                {
                                    label: 'Paid-Out (Ksh 000.00)',
                                    data: paidOut,
                                    backgroundColor: '#e2b085',
                                    borderRadius: 4
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'bottom'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        display: true,
                                        color: 'rgba(0,0,0,0.05)'
                                    }
                                }
                            }
                        }
                    });
                },

                initLoansChart() {
                    const ctx = document.getElementById('loansChart');
                    if (!ctx) return;

                    const months = this.monthlyLoans.map(d => d.month);
                    const disbursed = this.monthlyLoans.map(d => d.disbursed / 1000);
                    const repaid = this.monthlyLoans.map(d => d.repaid / 1000);

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: months,
                            datasets: [
                                {
                                    label: 'Disbursed (Ksh 000.00)',
                                    data: disbursed,
                                    borderColor: '#c5480e',
                                    backgroundColor: 'rgba(59,130,246,0.1)',
                                    tension: 0.5,
                                    fill: false
                                },
                                {
                                    label: 'Repaid (Ksh 000.00)',
                                    data: repaid,
                                    borderColor: '#6ce9a6',
                                    backgroundColor: 'rgba(16,185,129,0.1)',
                                    tension: 0.5,
                                    fill: false
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'bottom'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        display: true,
                                        color: 'rgba(0,0,0,0.05)'
                                    }
                                }
                            }
                        }
                    });
                },

                initLoanStatusChart() {
                    const ctx = document.getElementById('loanStatusChart');
                    if (!ctx) return;

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Active', 'Repaid', 'Defaulted/Stopped'],
                            datasets: [{
                                data: [this.loanStatus.active, this.loanStatus.repaid, this.loanStatus.defaulted],
                                backgroundColor: ['#e2b085', '#10b981', '#FF6500'],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'bottom'
                                }
                            },
                            cutout: '60%'
                        }
                    });
                }
            });

        });

    </script>

  </body>

</html>
