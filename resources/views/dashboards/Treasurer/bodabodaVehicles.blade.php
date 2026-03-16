<!DOCTYPE html>
<html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ Auth::user()->role }} | KFBCL Bodaboda Management </title>

        <link rel="icon" href="{{ asset('assets/favicon.ico') }}">
        <link href="{{ asset('assets/style.css') }}" rel="stylesheet">

        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    </head>

<body x-data="{ page: 'profile', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'loanTypeModal' : false, 'editLoanTypeModal': false , 'sidebarToggle': false, 'scrollTop': false, 'newFineModal': false, 'editFineModal': false, 'newBonusModal': false, 'editBonusTypeModal': false,  'editStageModal': false}"
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
        @include('Layouts.Treasurer.aside')
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
        <!-- Small Device Overlay Start -->
        <div :class="sidebarToggle ? 'block xl:hidden' : 'hidden'"
            class="fixed z-50 h-screen w-full bg-gray-900/50">
        </div>
        <!-- Small Device Overlay End -->

        <!-- ===== Main Content Start ===== -->
        <main>

                <!-- ===== Header Start ===== -->
                @include('Layouts.General.header')
                <!-- ===== Header End ===== -->

            <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
                <!-- Breadcrumb Start -->
                <div x-data="{ pageName: `Bodaboda Group > Vehicles` }">
                        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
                            <nav>
                                <ol class="flex items-center gap-1.5">
                                <li>
                                    <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('treasurer.dashboard') }}">
                                    Home
                                    <svg
                                            class="stroke-current"
                                            width="17"
                                            height="16"
                                            viewBox="0 0 17 16"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                                d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
                                                stroke=""
                                                stroke-width="1.2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                        />
                                    </svg>
                                    </a>
                                </li>
                                <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>
                                </ol>
                            </nav>
                        </div>
                </div>

                <div class="space-y-6">
                    <!-- Quick Stats -->
                    <div class="col-span-12">
                        <!-- Metric Group Two -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 xl:grid-cols-4" x-data="vehiclesTable()" x-init="init()">
                            <!-- Metric Item Start -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    All Vehicles
                                </p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div x-data="memberTableFull()" x-init="fetchTotalMembers()">
                                        <h4 class="text-xl font-bold text-gray-500 dark:text-white/90">
                                            <span x-text="totalVehicles">0</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->

                            <!-- Metric Item Start -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    Motorcycles
                                </p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div class="flex items-center justify-center gap-6">
                                        <div>
                                            <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90" x-text="motorcycleAvailable">
                                                0
                                            </p>
                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                                Available
                                            </p>
                                            </div>

                                            <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>

                                            <div>
                                            <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90" x-text="motorcycleAssigned">
                                                0
                                            </p>
                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                                Assigned
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Metric Item End -->

                            <!-- Metric Item Start - Contributions Wallet -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">

                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Tuk Tuk</p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div class="flex items-center justify-center gap-6">
                                        <div>
                                        <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90" x-text="tuktukAvailable">
                                            0
                                        </p>
                                        <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                            Available
                                        </p>
                                        </div>

                                        <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>

                                        <div>
                                        <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90" x-text="tuktukAssigned">
                                            0
                                        </p>
                                        <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                            Assigned
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->

                            <!-- Metric Item Start -->
                            <div x-data="savingsStats" class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Availability</p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div class="flex items-center justify-center gap-6">
                                        <div>
                                        <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90" x-text="availableVehicles">
                                            0
                                        </p>
                                        <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                            Available
                                        </p>
                                        </div>

                                        <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>

                                        <div>
                                        <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90" x-text="assignedVehicles">
                                            0
                                        </p>
                                        <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                            Assigned
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->

                        </div>
                        <!-- Metric Group Two -->
                    </div>

                    <!-- Tabbed Management -->
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]" x-data="vehiclesTable()" x-init="init()">
                                                        <!-- Members content here -->
                                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                                            <div>
                                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                                                    Vehicles
                                                                </h3>
                                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                                    List of all bodaboda members Vehicles.
                                                                </p>
                                                            </div>

                                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                                <!-- Search -->
                                                                <div class="relative flex-1 sm:flex-auto">
                                                                    <span class="absolute top-1/2 left-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37363C3.04199 5.87693 5.87735 3.04199 9.37533 3.04199C12.8733 3.04199 15.7087 5.87693 15.7087 9.37363C15.7087 12.8703 12.8733 15.7053 9.37533 15.7053C5.87735 15.7053 3.04199 12.8703 3.04199 9.37363ZM9.37533 1.54199C5.04926 1.54199 1.54199 5.04817 1.54199 9.37363C1.54199 13.6991 5.04926 17.2053 9.37533 17.2053C11.2676 17.2053 13.0032 16.5344 14.3572 15.4176L17.1773 18.238C17.4702 18.5309 17.945 18.5309 18.2379 18.238C18.5308 17.9451 18.5309 17.4703 18.238 17.1773L15.4182 14.3573C16.5367 13.0033 17.2087 11.2669 17.2087 9.37363C17.2087 5.04817 13.7014 1.54199 9.37533 1.54199Z" fill=""></path>
                                                                        </svg>
                                                                    </span>
                                                                    <input type="text"
                                                                        x-model="searchQuery"
                                                                        @input="performSearch()"
                                                                        placeholder="Search Plate Number ... "
                                                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden sm:w-[300px] sm:min-w-[300px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                </div>

                                                                <!-- Membership Filter (Member/Non-Member) -->
                                                                <div class="hidden lg:block">
                                                                    <select x-model="vehicleTypeFilter"
                                                                            @change="performFilter()"
                                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                        <option value="All">All Vehicles</option>
                                                                        <option value="Motorcycle">Motorcycle</option>
                                                                        <option value="Tuk Tuk">Tuk Tuk</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Status Filter (Active/Suspended/Blacklisted) -->
                                                                <div class="hidden lg:block">
                                                                    <select x-model="availabilityFilter"
                                                                            @change="performFilter()"
                                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                        <option value="Availability">Availability</option>
                                                                        <option value="Available">Available</option>
                                                                        <option value="Assigned">Assigned</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Print Button -->
                                                                <div>
                                                                    <button @click="printVehiclesReport()"
                                                                            class="hover:text-dark-900 shadow-theme-xs relative flex h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                                                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                                                            <rect x="7" y="13" width="10" height="8" rx="2" />
                                                                        </svg>
                                                                        Print
                                                                    </button>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <!-- Members Table -->
                                                        <div>
                                                            <div class="custom-scrollbar overflow-x-auto">

                                                                <table class="w-full table-auto">
                                                                    <thead>
                                                                        <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                #Vehicle No.
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Vehicle
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Owner
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                NTSA Compliant
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Insurance
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Availability
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Status
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Registered On
                                                                            </th>
                                                                        </tr>
                                                                    </thead>

                                                                    <!-- Vehicle Data Rows -->
                                                                    <template x-if="!isLoading">
                                                                        <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                                            <!-- Show message if no vehicles at all -->
                                                                            <template x-if="vehicles.length === 0">
                                                                                <tr>
                                                                                    <td colspan="7" class="px-4 py-12 text-center">
                                                                                        <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                                                                            </svg>
                                                                                            <div class="space-y-2">
                                                                                                <h1 class="text-xl font-semibold text-gray-700">No Bodaboda vehicles found.</h1>
                                                                                                <p class="text-gray-500">Add new vehicles to manage here.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </template>

                                                                            <!-- Show message if no filtered results -->
                                                                            <template x-if="vehicles.length > 0 && filteredVehicles.length === 0">
                                                                                <tr>
                                                                                    <td colspan="7" class="px-4 py-12 text-center">
                                                                                        <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h8M12 8v8" />
                                                                                            </svg>
                                                                                            <div class="space-y-2">
                                                                                                <h1 class="text-xl font-semibold text-gray-700">No matching vehicles found.</h1>
                                                                                                <p class="text-gray-500">Try adjusting your filters to see more results.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </template>

                                                                            <!-- Show data rows when we have filtered vehicles -->
                                                                            <template x-if="filteredVehicles.length > 0">
                                                                                <template x-for="row in paginatedRows" :key="row.id">
                                                                                    <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                                        <!-- #Vehicle No. -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <div class="group flex items-center gap-3">
                                                                                                <span class="text-theme-xs font-medium text-gray-700 dark:text-gray-400"
                                                                                                    x-text="row.vehicleId"></span>
                                                                                            </div>
                                                                                        </td>

                                                                                        <!-- Vehicle -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <div>
                                                                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                                                                    x-text="row.type + ': ' + row.make + ' ' + row.brand  + ' ' + row.model + ' - ' + row.cc + ' CC'"></span>
                                                                                                <p class="text-xs text-gray-500 dark:text-gray-400" x-text="row.plateNumber"></p>
                                                                                            </div>
                                                                                        </td>

                                                                                        <!-- Owner -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <div>
                                                                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                                                                    x-text="row.owner"></span>
                                                                                                <p class="text-xs text-gray-500 dark:text-gray-400" x-text="row.ownerPhone"></p>
                                                                                            </div>
                                                                                        </td>

                                                                                        <!-- NTSA Compliant -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                                                                :class="{
                                                                                                    'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': row.ntsaCompliant === 'Yes',
                                                                                                    'bg-error-100 text-error-600 dark:bg-error-900/30 dark:text-error-400': row.ntsaCompliant === 'No'
                                                                                                }"
                                                                                                x-text="row.ntsaCompliant">
                                                                                            </span>
                                                                                        </td>

                                                                                        <!-- Insurance -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <span class="text-sm text-gray-700 dark:text-gray-400" x-text="row.insurance"></span>
                                                                                        </td>

                                                                                        <!-- Availability -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <span class="text-sm text-gray-700 dark:text-gray-400" x-text="row.availability"></span>
                                                                                        </td>

                                                                                        <!-- Status -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <span :class="getStatusClass(row.status)"
                                                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                                                                x-text="row.status">
                                                                                            </span>
                                                                                        </td>

                                                                                        <!-- Registered On -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <span
                                                                                                class="text-sm text-gray-700 dark:text-gray-400 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                                                                x-text="row.created_on">
                                                                                            </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </template>
                                                                            </template>
                                                                        </tbody>
                                                                    </template>

                                                                    <!-- Loading State -->
                                                                    <template x-if="isLoading">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td colspan="7" class="px-4 py-12 text-center">
                                                                                    <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                        <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                                                        </svg>
                                                                                        <div class="space-y-2">
                                                                                            <h1 class="text-xl font-semibold text-gray-700">Loading vehicles...</h1>
                                                                                            <p class="text-gray-500">Please wait while we fetch the data.</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </template>

                                                                </table>

                                                            </div>

                                                            <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800" x-show="filteredVehicles.length > 0">
                                                                <div class="flex justify-center pb-4 sm:hidden">
                                                                    <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                        Showing
                                                                        <span class="text-gray-800 dark:text-white/90" x-text="startEntry"></span>
                                                                        to
                                                                        <span class="text-gray-800 dark:text-white/90" x-text="endEntry"></span>
                                                                        of
                                                                        <span class="text-gray-800 dark:text-white/90" x-text="filteredVehicles.length"></span>
                                                                    </span>
                                                                </div>

                                                                <div class="flex items-center justify-between">
                                                                    <div class="hidden sm:block">
                                                                        <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                            Showing
                                                                            <span class="text-gray-800 dark:text-white/90" x-text="startEntry"></span>
                                                                            to
                                                                            <span class="text-gray-800 dark:text-white/90" x-text="endEntry"></span>
                                                                            of
                                                                            <span class="text-gray-800 dark:text-white/90" x-text="filteredVehicles.length"></span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                                        <button
                                                                            class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                            :disabled="page === 1"
                                                                            @click="goToPage(page - 1)">
                                                                            <span>
                                                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                        d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 9.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z"
                                                                                        fill="" />
                                                                                </svg>
                                                                            </span>
                                                                        </button>

                                                                        <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                                            Page <span x-text="page"></span> of <span x-text="totalPages"></span>
                                                                        </span>

                                                                        <ul class="hidden items-center gap-0.5 sm:flex">
                                                                            <template x-for="n in totalPages" :key="n">
                                                                                <li>
                                                                                    <a href="#" @click.prevent="goToPage(n)"
                                                                                    :class="page === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'"
                                                                                    class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                                        <span x-text="n"></span>
                                                                                    </a>
                                                                                </li>
                                                                            </template>
                                                                        </ul>

                                                                        <button
                                                                            class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                            :disabled="page === totalPages"
                                                                            @click="goToPage(page + 1)">
                                                                            <span>
                                                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                        d="M17.4165 9.9986C17.4168 10.1909 17.3437 10.3832 17.197 10.53L12.2004 15.5301C11.9076 15.8231 11.4327 15.8233 11.1397 15.5305C10.8467 15.2377 10.8465 14.7629 11.1393 14.4699L14.8594 10.7472L3.33203 10.7472C2.91782 10.7472 2.58203 10.4114 2.58203 9.99715C2.58203 9.58294 2.91782 9.24715 3.33203 9.24715L14.854 9.24715L11.1393 5.53016C10.8465 5.23717 10.8467 4.7623 11.1397 4.4695C11.4327 4.1767 11.9075 4.17685 12.2003 4.46984L17.1578 9.43049C17.3163 9.568 17.4165 9.77087 17.4165 9.99715C17.4165 9.99763 17.4165 9.99812 17.4165 9.9986Z"
                                                                                        fill="" />
                                                                                </svg>
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                    </div>

                </div>

            </div>


        </main>
        <!-- ===== Main Content End ===== -->
        </div>
            <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->

    <!-- ===== Custom JS ===== -->
    <script defer src="{{ asset('assets/bundle.js') }}"></script>
    <!-- ===== Data Tables ===== -->

    <!-- Vehicles Alpine ------------------------------------------------------------------------ -->
    <script>

        // Vehicles Table Component
        function vehiclesTable() {
            return {

                // Properties
                vehicles: [],
                filteredVehicles: [],
                page: 1,
                perPage: 10,
                searchQuery: '',
                vehicleTypeFilter: 'All',
                availabilityFilter: 'Availability',
                isLoading: true,

                // Stats
                totalVehicles: 0,
                motorcycleAvailable: 0,
                motorcycleAssigned: 0,
                tuktukAvailable: 0,
                tuktukAssigned: 0,
                availableVehicles: 0,
                assignedVehicles: 0,

                // Initialize
                async init() {
                    this.isLoading = true;
                    try {
                        // Fetch vehicles data
                        const vehiclesRes = await fetch('/vehicles/all');
                        const vehiclesData = await vehiclesRes.json();

                        console.log('Vehicles API Response:', vehiclesData); // Debug log

                        if (vehiclesData.success) {
                            this.vehicles = vehiclesData.data.map(vehicle => ({
                                id: vehicle.vehicleId,
                                vehicleId: 'VH' + String(vehicle.vehicleId).padStart(4, '0'),
                                plateNumber: vehicle.plate_number || 'N/A',
                                make: vehicle.make || 'N/A',
                                model: vehicle.model || 'N/A',
                                brand: vehicle.brand || 'N/A',
                                yom: vehicle.yom || 'N/A',
                                cc: vehicle.CC || 'N/A',
                                type: vehicle.type || 'Motorcycle',
                                owner: vehicle.Owner || 'N/A',
                                ownerPhone: vehicle.phone1 || 'N/A',
                                ownerEmail: vehicle.email || 'N/A',
                                ntsaCompliant: vehicle.NTSA_compliant ? 'Yes' : 'No',
                                insurance: vehicle.insurance || 'N/A',
                                availability: vehicle.assignment_status === 'Active' ? 'Assigned' : 'Available',
                                status: vehicle.status || 'Active',
                                assignedRider: vehicle.assigned_rider || null,
                                // Format created_on date as [16 Mar, 2026]
                                created_on: vehicle.created_on ?
                                    new Date(vehicle.created_on).toLocaleDateString('en-GB', {
                                        day: '2-digit',
                                        month: 'short',
                                        year: 'numeric'
                                    }).replace(/ /g, ' ') : 'Loading'
                            }));

                            this.filteredVehicles = [...this.vehicles];
                            console.log('Processed vehicles:', this.vehicles); // Debug log
                            console.log('Filtered vehicles:', this.filteredVehicles); // Debug log
                        }

                        // Fetch all stats
                        const statsRes = await fetch('/vehicles/stats');
                        const statsData = await statsRes.json();

                        console.log('Stats API Response:', statsData); // Debug log

                        if (statsData.success) {
                            this.totalVehicles = statsData.total || 0;
                            this.motorcycleAvailable = statsData.motorcycles?.available || 0;
                            this.motorcycleAssigned = statsData.motorcycles?.assigned || 0;
                            this.tuktukAvailable = statsData.tuktuk?.available || 0;
                            this.tuktukAssigned = statsData.tuktuk?.assigned || 0;
                            this.availableVehicles = statsData.availability?.available || 0;
                            this.assignedVehicles = statsData.availability?.assigned || 0;
                        }

                    } catch (error) {
                        console.error('Error fetching vehicles:', error);
                    } finally {
                        this.isLoading = false;
                        console.log('Loading complete, vehicles length:', this.vehicles.length); // Debug log
                    }
                },

                // Filter methods
                performSearch() {
                    this.filterVehicles();
                },

                performFilter() {
                    this.filterVehicles();
                },

                filterVehicles() {
                    let filtered = [...this.vehicles];

                    // Apply search
                    if (this.searchQuery) {
                        const query = this.searchQuery.toLowerCase();
                        filtered = filtered.filter(v =>
                            v.plateNumber.toLowerCase().includes(query) ||
                            v.owner.toLowerCase().includes(query) ||
                            v.make.toLowerCase().includes(query)
                        );
                    }

                    // Apply type filter
                    if (this.vehicleTypeFilter !== 'All') {
                        filtered = filtered.filter(v => v.type === this.vehicleTypeFilter);
                    }

                    // Apply availability filter
                    if (this.availabilityFilter !== 'Availability') {
                        filtered = filtered.filter(v => v.availability === this.availabilityFilter);
                    }

                    this.filteredVehicles = filtered;
                    this.page = 1;
                },

                // Pagination getters
                get paginatedRows() {
                    const start = (this.page - 1) * this.perPage;
                    const end = start + this.perPage;
                    return this.filteredVehicles.slice(start, end);
                },

                get totalPages() {
                    return Math.ceil(this.filteredVehicles.length / this.perPage);
                },

                get startEntry() {
                    if (this.filteredVehicles.length === 0) return 0;
                    return (this.page - 1) * this.perPage + 1;
                },

                get endEntry() {
                    if (this.filteredVehicles.length === 0) return 0;
                    const end = this.page * this.perPage;
                    return end > this.filteredVehicles.length ? this.filteredVehicles.length : end;
                },

                // Pagination methods
                prevPage() {
                    if (this.page > 1) this.page--;
                },

                nextPage() {
                    if (this.page < this.totalPages) this.page++;
                },

                goToPage(page) {
                    this.page = page;
                },

                // Get status class
                getStatusClass(status) {
                    const statusMap = {
                        'Active': 'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400',
                        'Inactive': 'bg-gray-100 text-gray-600 dark:bg-gray-900/30 dark:text-gray-400',
                        'Suspended': 'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400',
                        'Maintenance': 'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400'
                    };
                    return statusMap[status] || 'bg-gray-100 text-gray-600 dark:bg-gray-900/30 dark:text-gray-400';
                },

                // Print function
                printVehiclesReport() {
                    const printWindow = window.open('', '_blank');
                    const currentData = this.paginatedRows;

                    const tableRows = currentData.map(vehicle => `
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; text-align: left;">${vehicle.vehicleId}</td>
                            <td style="padding: 12px; text-align: left;">${vehicle.make} ${vehicle.model}<br><small>${vehicle.plateNumber}</small></td>
                            <td style="padding: 12px; text-align: left;">${vehicle.owner}<br><small>${vehicle.ownerPhone}</small></td>
                            <td style="padding: 12px; text-align: left;">
                                <span style="display: inline-block; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500;
                                    ${vehicle.ntsaCompliant === 'Yes' ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;'}">
                                    ${vehicle.ntsaCompliant}
                                </span>
                            </td>
                            <td style="padding: 12px; text-align: left;">${vehicle.insurance}</td>
                            <td style="padding: 12px; text-align: left;">${vehicle.availability}</td>
                            <td style="padding: 12px; text-align: left;">
                                <span style="display: inline-block; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500;
                                    ${vehicle.status === 'Active' ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #f3f4f6; color: #1f2937;'}">
                                    ${vehicle.status}
                                </span>
                            </td>
                        </tr>
                    `).join('');

                    printWindow.document.write(`
                        <html>
                        <head>
                            <title>Vehicles Report</title>
                            <style>
                                body { font-family: Arial, sans-serif; margin: 20px; }
                                h1 { color: #111827; font-size: 24px; margin-bottom: 10px; }
                                .header { margin-bottom: 20px; color: #6b7280; font-size: 14px; }
                                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                                th { background-color: #f9fafb; padding: 12px; text-align: left; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb; }
                                td { padding: 12px; border-bottom: 1px solid #e5e7eb; }
                                .footer { margin-top: 20px; text-align: right; color: #6b7280; font-size: 12px; }
                                @media print {
                                    body { margin: 0; }
                                    button { display: none; }
                                }
                            </style>
                        </head>
                        <body>
                            <h1>Vehicles Report</h1>
                            <div class="header">
                                <div>Generated on: ${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}</div>
                                <div>Filter: ${this.vehicleTypeFilter} | ${this.availabilityFilter}</div>
                                <div>Showing ${this.startEntry} to ${this.endEntry} of ${this.filteredVehicles.length} vehicles</div>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>#Vehicle No.</th>
                                        <th>Vehicle</th>
                                        <th>Owner</th>
                                        <th>NTSA Compliant</th>
                                        <th>Insurance</th>
                                        <th>Availability</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${tableRows}
                                </tbody>
                            </table>

                            <div class="footer">
                                <p>Report generated from Bodaboda Microfinance System</p>
                            </div>
                        </body>
                        </html>
                    `);

                    printWindow.document.close();
                    printWindow.focus();
                    printWindow.print();
                }
            };
        }

        // Register the component
        document.addEventListener('alpine:init', () => {
            Alpine.data('vehiclesTable', vehiclesTable);
        });

    </script>

</body>

</html>
