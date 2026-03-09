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
                <div x-data="{ pageName: `Bodaboda Group > Stages` }">
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
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 xl:grid-cols-4">
                            <!-- Metric Item Start - All Stages -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]"
                                x-data="{ totalStages: 0 }"
                                x-init="fetch('/stages/count')
                                        .then(res => res.json())
                                        .then(data => { totalStages = data.total || 0; })">
                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    All Stages
                                </p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-500 dark:text-white/90" x-text="totalStages">
                                            0
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->

                            <!-- Metric Item Start - Stage Supervisors (Active) -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]"
                                x-data="{ activeSupervisors: 0, previousMonthSupervisors: 0, percentageChange: 0 }"
                                x-init="Promise.all([
                                            fetch('/stages/supervisors/count/active').then(res => res.json()),
                                            fetch('/stages/supervisors/all?month=previous').catch(() => ({ count: 0 }))
                                        ]).then(([current, previous]) => {
                                            activeSupervisors = current.count || 0;
                                            previousMonthSupervisors = previous.count || 0;

                                            // Calculate percentage change
                                            if (previousMonthSupervisors > 0) {
                                                percentageChange = ((activeSupervisors - previousMonthSupervisors) / previousMonthSupervisors * 100).toFixed(1);
                                            } else if (activeSupervisors > 0) {
                                                percentageChange = 100;
                                            } else {
                                                percentageChange = 0;
                                            }
                                        })">

                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    Stage Supervisors
                                </p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-500 dark:text-white/90" x-text="activeSupervisors">
                                            0
                                        </h4>
                                    </div>

                                    <div class="flex items-center gap-1">
                                        <span class="flex items-center gap-1 rounded-full px-2 py-0.5 text-theme-xs font-medium"
                                            :class="percentageChange >= 0 ? 'bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500' : 'bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500'">
                                            <span x-text="(percentageChange >= 0 ? '+' : '') + percentageChange + '%'"></span>
                                        </span>

                                        <span class="text-theme-xs text-gray-500 dark:text-gray-400">
                                            Vs last month
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->

                            <!-- Metric Item Start - Total Supervisors (All) -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]"
                                x-data="{ totalSupervisors: 0 }"
                                x-init="fetch('/stages/supervisors/all')
                                        .then(res => res.json())
                                        .then(data => { totalSupervisors = data.count || 0; })">

                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Total Supervisors</p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div>
                                        <h4 class="text-xl font-semibold text-gray-500 dark:text-white/90" x-text="totalSupervisors">0</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->

                            <!-- Metric Item Start - Active Stages -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]"
                                x-data="{ activeStages: 0 }"
                                x-init="fetch('/stages/all')
                                        .then(res => res.json())
                                        .then(data => {
                                            if(data.data) {
                                                activeStages = data.data.filter(stage => stage.status === 'Active').length;
                                            }
                                        })">

                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Active Stages</p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div>
                                        <h4 class="text-xl font-semibold text-gray-500 dark:text-white/90" x-text="activeStages">0</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->
                        </div>
                        <!-- Metric Group Two -->
                    </div>

                    <!-- Tabbed Management -->
                    <div class="rounded-xl border border-gray-200 p-6 bg-white dark:border-gray-800 dark:bg-white/[0.03]" x-data="{ activeTab: 'stages' }">
                        <div class="border-b border-gray-200 dark:border-gray-800">
                            <nav class="-mb-px flex space-x-2 overflow-x-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-200 dark:[&::-webkit-scrollbar-thumb]:bg-gray-600 dark:[&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar]:h-1.5">
                                                <!-- Stages -->
                                                <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                                                        x-bind:class="activeTab === 'stages' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                                        x-on:click="activeTab = 'stages'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                                                    </svg>
                                                    Stages
                                                </button>

                                                <!-- Stage Manager -->
                                                <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                                                        x-bind:class="activeTab === 'supervisors' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                                        x-on:click="activeTab = 'supervisors'">
                                                    <svg class="fill-current" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13768 5.60156C7.92435 5.60156 6.94074 6.58517 6.94074 7.79851C6.94074 9.01185 7.92435 9.99545 9.13768 9.99545C10.351 9.99545 11.3346 9.01185 11.3346 7.79851C11.3346 6.58517 10.351 5.60156 9.13768 5.60156ZM5.44074 7.79851C5.44074 5.75674 7.09592 4.10156 9.13768 4.10156C11.1795 4.10156 12.8346 5.75674 12.8346 7.79851C12.8346 9.84027 11.1795 11.4955 9.13768 11.4955C7.09592 11.4955 5.44074 9.84027 5.44074 7.79851ZM5.19577 15.3208C4.42094 16.0881 4.03702 17.0608 3.8503 17.8611C3.81709 18.0034 3.85435 18.1175 3.94037 18.2112C4.03486 18.3141 4.19984 18.3987 4.40916 18.3987H13.7582C13.9675 18.3987 14.1325 18.3141 14.227 18.2112C14.313 18.1175 14.3503 18.0034 14.317 17.8611C14.1303 17.0608 13.7464 16.0881 12.9716 15.3208C12.2153 14.572 11.0231 13.955 9.08367 13.955C7.14421 13.955 5.95202 14.572 5.19577 15.3208ZM4.14036 14.2549C5.20488 13.2009 6.78928 12.455 9.08367 12.455C11.3781 12.455 12.9625 13.2009 14.027 14.2549C15.0729 15.2906 15.554 16.5607 15.7778 17.5202C16.0991 18.8971 14.9404 19.8987 13.7582 19.8987H4.40916C3.22695 19.8987 2.06829 18.8971 2.38953 17.5202C2.6134 16.5607 3.09442 15.2906 4.14036 14.2549ZM15.6375 11.4955C14.8034 11.4955 14.0339 11.2193 13.4153 10.7533C13.7074 10.3314 13.9387 9.86419 14.0964 9.36432C14.493 9.75463 15.0371 9.99545 15.6375 9.99545C16.8508 9.99545 17.8344 9.01185 17.8344 7.79851C17.8344 6.58517 16.8508 5.60156 15.6375 5.60156C15.0371 5.60156 14.493 5.84239 14.0964 6.23271C13.9387 5.73284 13.7074 5.26561 13.4153 4.84371C14.0338 4.37777 14.8034 4.10156 15.6375 4.10156C17.6792 4.10156 19.3344 5.75674 19.3344 7.79851C19.3344 9.84027 17.6792 11.4955 15.6375 11.4955ZM20.2581 19.8987H16.7233C17.0347 19.4736 17.2492 18.969 17.3159 18.3987H20.2581C20.4674 18.3987 20.6323 18.3141 20.7268 18.2112C20.8129 18.1175 20.8501 18.0034 20.8169 17.861C20.6302 17.0607 20.2463 16.088 19.4714 15.3208C18.7379 14.5945 17.5942 13.9921 15.7563 13.9566C15.5565 13.6945 15.3328 13.437 15.0824 13.1891C14.8476 12.9566 14.5952 12.7384 14.3249 12.5362C14.7185 12.4831 15.1376 12.4549 15.5835 12.4549C17.8779 12.4549 19.4623 13.2008 20.5269 14.2549C21.5728 15.2906 22.0538 16.5607 22.2777 17.5202C22.5989 18.8971 21.4403 19.8987 20.2581 19.8987Z" fill=""></path>
                                                    </svg>
                                                    Stage Managers
                                                </button>

                            </nav>
                        </div>

                        <div class="pt-4 dark:border-gray-800">
                                <!-- stages Tab Content -->
                                <div x-show="activeTab === 'stages'" style="display: none;" x-data="stageTable()">

                                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                        <!-- Stages table -->
                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                            <div>
                                                    <h3 class="text-lg font-semibold text-gray-600 dark:text-white/90">
                                                        Stages
                                                    </h3>
                                                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                                        Manage all your stages locations.
                                                    </p>
                                            </div>

                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                <!-- Status Filter Dropdown -->
                                                <div class="hidden lg:block">
                                                    <select x-model="statusFilter"
                                                            @change="performFilter()"
                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="All">All Status</option>
                                                        <option value="Active">Active</option>
                                                        <option value="In-Active">In-Active</option>
                                                        <option value="Under Review">Under Review</option>
                                                    </select>
                                                </div>

                                                <!-- Print Button -->
                                                <div>
                                                    <button @click="printStagesReport()"
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

                                                <!-- New Stage Button -->
                                                <button @click="$dispatch('open-new-stage-modal')"
                                                        class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                        <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    New Stage
                                                </button>
                                            </div>

                                        </div>

                                        <div>
                                            <!-- Table Container -->
                                            <div class="custom-scrollbar overflow-x-auto">
                                                    <table class="w-full">
                                                            <!-- table header start -->
                                                            <thead>
                                                                <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                                    <th class="p-4 whitespace-nowrap">
                                                                        <div class="flex items-center">
                                                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                            #StageID
                                                                        </p>
                                                                        </div>
                                                                    </th>
                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                        <div class="flex items-center">
                                                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                            Location
                                                                        </p>
                                                                        </div>
                                                                    </th>
                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                        <div class="flex items-center">
                                                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                            Established
                                                                        </p>
                                                                        </div>
                                                                    </th>
                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                        <div class="flex items-center">
                                                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                            Status
                                                                        </p>
                                                                        </div>
                                                                    </th>
                                                                    <th class="pp-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                        <div class="flex items-center">
                                                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                            Actions
                                                                        </p>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <!-- table header end -->

                                                            <!-- table body start -->
                                                            <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">

                                                                <!-- Empty state message when no stages -->
                                                                <template x-if="stages.length === 0">
                                                                    <tr class="transition">
                                                                        <td colspan="6" class="p-8">
                                                                            <div class="flex flex-col items-center justify-center gap-4">
                                                                                <!-- outline documents svg icon -->
                                                                                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6M9 17h6M7 7h6l2 2h4v8a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"/>
                                                                                </svg>

                                                                                <div class="text-center">
                                                                                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">There are no stage locations added.</h2>
                                                                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">You can add a new stage location to manage</p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </template>

                                                                <!-- Rows when there are stages -->
                                                                <template x-if="stages.length > 0">
                                                                    <template x-for="stage in currentItems" :key="stage.id">
                                                                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                            <td class="p-4 whitespace-nowrap">
                                                                                <div class="flex items-center col-span-2">
                                                                                    <div class="flex items-center gap-3">
                                                                                        <div>
                                                                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="stage.stageId"></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="p-4 whitespace-nowrap">
                                                                                <div class="flex items-center col-span-2">
                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="stage.location"></p>
                                                                                </div>
                                                                            </td>
                                                                            <td class="p-4 whitespace-nowrap">
                                                                                <div class="flex items-center col-span-2">
                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="stage.established"></p>
                                                                                </div>
                                                                            </td>
                                                                            <td class="p-4 whitespace-nowrap">
                                                                                <div class="flex items-center col-span-2">
                                                                                    <p :class="stage.status === 'Active' ? 'bg-success-50 text-theme-xs text-success-700 dark:bg-success-500/15 dark:text-success-500' : 'bg-error-50 text-theme-xs text-error-600 dark:bg-error-500/15 dark:text-error-500'"
                                                                                    class="rounded-full px-2 py-0.5 font-medium" x-text="stage.status"></p>
                                                                                </div>
                                                                            </td>
                                                                            <td class="p-4 whitespace-nowrap">
                                                                                <div class="flex items-center col-span-2">
                                                                                    <button @click="$dispatch('open-edit-modal', { stage: stage })"
                                                                                            class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                                        <svg class="w-[28px] h-[28px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                                                                        </svg>
                                                                                    </button>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </template>
                                                                </template>
                                                            </tbody>
                                                            <!-- table body end -->
                                                    </table>

                                                    <!-- Pagination -->
                                                <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                                                    <div class="flex justify-center pb-4 sm:hidden">
                                                        <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                            Showing
                                                            <span class="text-gray-800 dark:text-white/90" x-text="startIndex"></span>
                                                            to
                                                            <span class="text-gray-800 dark:text-white/90" x-text="endIndex"></span>
                                                            of
                                                            <span class="text-gray-800 dark:text-white/90" x-text="stages.length"></span>
                                                        </span>
                                                    </div>

                                                    <div class="flex items-center justify-between">
                                                        <div class="hidden sm:block">
                                                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                Showing
                                                                <span class="text-gray-800 dark:text-white/90" x-text="startIndex"></span>
                                                                to
                                                                <span class="text-gray-800 dark:text-white/90" x-text="endIndex"></span>
                                                                of
                                                                <span class="text-gray-800 dark:text-white/90" x-text="stages.length"></span>
                                                            </span>
                                                        </div>
                                                        <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                            <button
                                                                class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                :disabled="currentPage === 1"
                                                                @click="prevPage()">
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
                                                                Page <span x-text="currentPage"></span> of <span x-text="totalPages"></span>
                                                            </span>

                                                            <ul class="hidden items-center gap-0.5 sm:flex">
                                                                <template x-for="n in totalPages" :key="n">
                                                                    <li>
                                                                        <a href="#" @click.prevent="goToPage(n)"
                                                                            :class="currentPage === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'"
                                                                            class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                            <span x-text="n"></span>
                                                                        </a>
                                                                    </li>
                                                                </template>
                                                            </ul>

                                                            <button
                                                                class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                :disabled="currentPage === totalPages"
                                                                @click="nextPage()">
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

                                <div x-show="activeTab === 'supervisors'" style="display: none;">
                                    <!-- Stage Managers table -->
                                    <div class="col-span-12 xl:col-span-8" x-data="stageManagersTable()" x-init="init()">

                                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

                                            <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                                <div>
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                                    Stage Managers
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    All Stage Managers
                                                </p>
                                                </div>
                                                <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                <div class="hidden lg:block">
                                                    <select x-model="selectedRole"
                                                            @change="filterByRole(selectedRole)"
                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                    <template x-for="role in userRoles" :key="role">
                                                        <option x-text="role" :value="role" :selected="selectedRole === role"></option>
                                                    </template>
                                                    </select>
                                                </div>
                                                <div>
                                                    <button @click="printManagersReport()" class="hover:text-dark-900 shadow-theme-xs relative flex h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="M16.6661 13.3333V15.4166C16.6661 16.1069 16.1064 16.6666 15.4161 16.6666H4.58203C3.89168 16.6666 3.33203 16.1069 3.33203 15.4166V13.3333M10.0004 3.33325L10.0004 13.3333M6.14456 7.18708L9.9986 3.33549L13.8529 7.18708"
                                                                stroke="currentColor"
                                                                stroke-width="1.5"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"/>
                                                        </svg>
                                                        Print
                                                    </button>
                                                </div>

                                                </div>
                                            </div>
                                            <!-- Stage Managers Table -->
                                            <div>
                                                <div class="custom-scrollbar overflow-x-auto">
                                                    <table class="w-full table-auto">
                                                        <thead>
                                                            <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                                <!-- #User ID Column with filter -->
                                                                <th class="p-4 whitespace-nowrap">
                                                                <div class="flex w-full items-center gap-3">
                                                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                                    #Stage Manager ID
                                                                    </p>
                                                                </div>
                                                                </th>

                                                                <!-- User Column (no filter, no sort) -->
                                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                                    Stage Manager
                                                                </p>
                                                                </th>

                                                                <!-- Joined On Column (no filter, no sort) -->
                                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                                    Contact
                                                                </p>
                                                                </th>

                                                                <!-- Contacts Column (no filter, no sort) -->
                                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                                    Identification
                                                                </p>
                                                                </th>

                                                                <!-- Documentation Column (no filter, no sort) -->
                                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                                    Since
                                                                </p>
                                                                </th>

                                                                <!-- Role Column (no filter, no sort) -->
                                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                                    Role
                                                                </p>
                                                                </th>

                                                                <!-- Last Login Column (no filter, no sort) -->
                                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                                        Status
                                                                    </p>
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                            <!-- Show empty state when no managers -->
                                                            <template x-if="managers.length === 0">
                                                                <tr class="transition">
                                                                    <td colspan="7" class="p-8"> <!-- colspan="7" for 7 columns -->
                                                                        <div class="flex flex-col items-center justify-center gap-4">
                                                                            <!-- outline documents svg icon -->
                                                                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6M9 17h6M7 7h6l2 2h4v8a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"/>
                                                                            </svg>

                                                                            <div class="text-center">
                                                                                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">No Stage Manager Records.</h2>
                                                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add a stage manager to view the list.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </template>

                                                            <!-- Show loading state while fetching -->
                                                            <template x-if="isLoading && managers.length === 0">
                                                                <tr class="transition">
                                                                    <td colspan="7" class="p-8">
                                                                        <div class="flex flex-col items-center justify-center gap-4">
                                                                            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                                            </svg>
                                                                            <div class="text-center">
                                                                                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Loading Stage Managers...</h2>
                                                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Please wait while we fetch the data.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </template>

                                                            <!-- Show filtered empty state when no results after filtering -->
                                                            <template x-if="!isLoading && managers.length > 0 && filteredManagers.length === 0">
                                                                <tr class="transition">
                                                                    <td colspan="7" class="p-8">
                                                                        <div class="flex flex-col items-center justify-center gap-4">
                                                                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h8M12 8v8" />
                                                                            </svg>
                                                                            <div class="text-center">
                                                                                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">No matching records found.</h2>
                                                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your filter to see more results.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </template>

                                                            <!-- Show data rows -->
                                                            <template x-if="!isLoading && paginatedRows.length > 0">
                                                                <template x-for="row in paginatedRows" :key="row.id">
                                                                    <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                        <!-- #User ID -->
                                                                        <td class="p-4 whitespace-nowrap">
                                                                            <div class="group flex items-center gap-3">
                                                                                <h4 class="text-theme-xs font-medium text-gray-700 group-hover:underline dark:text-gray-400"
                                                                                    x-text="row.userId"></h4>
                                                                            </div>
                                                                        </td>

                                                                        <!-- User: Fullname, [Gender] -->
                                                                        <td class="p-4 whitespace-nowrap">
                                                                            <div>
                                                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                                                    x-text="row.firstName + ' ' + row.lastName"></span>
                                                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                                    <span x-text="row.gender"></span>
                                                                                </p>
                                                                            </div>
                                                                        </td>

                                                                        <!-- Contacts: Email, [Phone] -->
                                                                        <td class="p-4 whitespace-nowrap">
                                                                            <div>
                                                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                                                x-text="row.email"></p>
                                                                                <p class="text-xs text-gray-500 dark:text-gray-400" x-text="row.phone"></p>
                                                                            </div>
                                                                        </td>

                                                                        <!-- Documentation: ID Number, [DoB] -->
                                                                        <td class="p-4 whitespace-nowrap">
                                                                            <div>
                                                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                                                x-text="'ID: ' + row.nationalId"></p>
                                                                                <p class="text-xs text-gray-500 dark:text-gray-400"
                                                                                x-text="'DoB: ' + new Date(row.dob).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })"></p>
                                                                            </div>
                                                                        </td>

                                                                        <!-- Joined On -->
                                                                        <td class="p-4 whitespace-nowrap">
                                                                            <span class="text-sm text-gray-700 dark:text-gray-400" x-text="row.joinedOn"></span>
                                                                        </td>

                                                                        <!-- Role -->
                                                                        <td class="p-4 whitespace-nowrap">
                                                                            <span class="text-sm text-gray-700 dark:text-gray-400" x-text="row.userRole"></span>
                                                                        </td>

                                                                        <!-- Status -->
                                                                        <td class="p-4 whitespace-nowrap">
                                                                            <p class="text-sm text-gray-700 dark:text-gray-400 truncate max-w-[200px]">
                                                                                <span :class="getStatusClass(row.userStatus)"
                                                                                    class="rounded-full px-2 py-0.5 text-xs font-medium ml-1"
                                                                                    x-text="row.userStatus">
                                                                                </span>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </template>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                                                <div class="flex justify-center pb-4 sm:hidden">
                                                    <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                    Showing
                                                    <span class="text-gray-800 dark:text-white/90" x-text="startEntry"></span>
                                                    to
                                                    <span class="text-gray-800 dark:text-white/90" x-text="endEntry"></span>
                                                    of
                                                    <span class="text-gray-800 dark:text-white/90" x-text="filteredRows.length"></span>
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
                                                        <span class="text-gray-800 dark:text-white/90" x-text="filteredRows.length"></span>
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


    <!-- New Stage Location ---------------------------------------------------------------------------------------------------------------------------------- -->
    <div x-data="{ newStageModal: false }"
        @open-new-stage-modal.window="newStageModal = true"
        x-show="newStageModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="newStageModal = false"
            class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="newStageModal = false"
                    class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
                <svg
                        class="fill-current"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
                        fill=""
                />
                </svg>
            </button>
            <!-- Add Stage Location form -->
            <form @submit="submitStageForm($event)" x-data="stageFormHandler()">
                @csrf
                <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
                    Add New Stage
                </h4>

                <div class="-mx-2.5 flex flex-wrap gap-y-5">

                <div class="w-full px-2.5">
                    <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                        Stage Location details
                    </h4>
                </div>

                <div class="w-full px-2.5 xl:w-3/4">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Stage Location
                    </label>
                    <input type="text" id="newStageLocation" name="newStageLocation" placeholder="Stage location ..." class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <div class="w-full px-2.5 xl:w-1/4">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                    <select id="newStageStatus" name="newStageStatus" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected && 'text-gray-800 dark:text-white/90'" @change="isOptionSelected = true">
                        <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Status</option>
                        <option value="Active" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Active</option>
                        <option value="In-Active" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">In-Active</option>
                        <option value="Under Review" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Under Review</option>
                    </select>
                    <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                </span>
                    </div>
                </div>

                </div>

                <div class="flex items-center justify-end w-full gap-3 mt-6">
                <button @click="newStageModal = false" type="button" class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:w-auto">
                    Cancel
                </button>
                <button type="submit" :disabled="isSubmitting"
                        class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 disabled:opacity-50 disabled:cursor-not-allowed sm:w-auto">
                    <span x-show="!isSubmitting">Add Stage Location</span>
                    <span x-show="isSubmitting">Adding new Stage Location ...</span>
                </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Stage Location Modal - FIXED -->
    <div x-data="{ editStageModal: false, currentStage: {} }"
        @open-edit-modal.window="currentStage = $event.detail.stage; editStageModal = true"
        x-show="editStageModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">

        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>

        <div @click.outside="editStageModal = false" class=" relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">

            <!-- close btn -->
            <button @click="editStageModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill=""/>
                </svg>
            </button>

            <div class="px-2 pr-14">
                <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                Edit Stage <span class="text-gray-500" x-text="currentStage.stageId"></span>
                </h4>
                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
                Review and change the stage details
                </p>
            </div>

            <!-- Edit Stage Location form -->
            <!-- ONLY CHANGE: Removed x-data from this form -->
            <form @submit.prevent>
                @csrf
                <div class="-mx-2.5 flex flex-wrap gap-y-5">

                    <input type="hidden" id="stageId" name="stageId" x-model="currentStage.stageId">

                    <div class="w-full px-2.5 xl:w-3/5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Stage Location
                        </label>
                        <input type="text" placeholder="Stage location ..." x-model="currentStage.location" id="updateStageLocation" name="updateStageLocation"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>

                    <div class="w-full px-2.5 xl:w-2/5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                        </label>
                        <div x-data="{ isOptionSelected: true }" class="relative z-20 bg-transparent">
                            <select x-model="currentStage.status"  id="updateStageStatus" name="updateStageStatus"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true">
                                <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Status</option>
                                    <option value="Active" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Active</option>
                                    <option value="In-Active" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">In-Active</option>
                                    <option value="Under Review" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Under Review</option>
                            </select>
                            <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                </div>

                <div class="flex items-center justify-end w-full gap-3 mt-6">
                    <button @click="editStageModal = false" type="button" class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:w-auto">
                        Cancel
                    </button>
                    <button type="button" @click="$store.editStage.deleteStage(currentStage)" :disabled="$store.editStage.isDeleting" class="rounded-lg border border-error-300 bg-white px-5 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                        <span x-show="!$store.editStage.isDeleting">Delete</span>
                        <span x-show="$store.editStage.isDeleting">Deleting ...</span>
                    </button>
                    <button type="button"
                            @click="$store.editStage.updateStage(currentStage)" :disabled="$store.editStage.isUpdating"
                            class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 sm:w-auto disabled:opacity-50 disabled:cursor-not-allowed">
                        <span x-show="!$store.editStage.isUpdating">Update</span>
                        <span x-show="$store.editStage.isUpdating">Updating ...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
    <!-- END MODALS -->


    <!-- ===== Custom JS ===== -->
    <script defer src="{{ asset('assets/bundle.js') }}"></script>
    <!-- ===== Data Tables ===== -->


    <!-- Stages Alpine.js - YOUR ORIGINAL + Global Store + FILTER & PRINT -->
    <script>
        // stages.js - Data binding and pagination functionality
        function stageTable() {
            return {
                // Original properties
                stages: [],
                currentPage: 1,
                itemsPerPage: 10,

                // NEW: Filter property
                statusFilter: 'All',

                // Initialize and fetch data
                async init() {
                    try {
                        const response = await fetch('{{ route("get.all.stages") }}');
                        const result = await response.json();

                        if (result.success) {
                            this.stages = result.data.map(stage => ({
                                id: stage.stageId,
                                stageId: stage.stageId,
                                location: stage.location,
                                established: stage.established,
                                status: stage.status
                            }));
                            // ensure currentPage is valid
                            if (this.currentPage > this.totalPages && this.totalPages > 0) {
                                this.currentPage = this.totalPages;
                            }
                        }
                    } catch (error) {
                        console.error('Error fetching stages:', error);
                    }
                },

                // NEW: Filtered stages based on status
                get filteredStages() {
                    if (this.statusFilter === 'All') {
                        return this.stages;
                    }
                    return this.stages.filter(stage => stage.status === this.statusFilter);
                },

                // MODIFIED: Use filteredStages instead of stages for pagination
                get totalPages() {
                    return Math.ceil(this.filteredStages.length / this.itemsPerPage);
                },

                // MODIFIED: Use filteredStages for current items
                get currentItems() {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.filteredStages.slice(start, end);
                },

                get startIndex() {
                    if (this.filteredStages.length === 0) return 0;
                    return (this.currentPage - 1) * this.itemsPerPage + 1;
                },

                get endIndex() {
                    if (this.filteredStages.length === 0) return 0;
                    const end = this.currentPage * this.itemsPerPage;
                    return end > this.filteredStages.length ? this.filteredStages.length : end;
                },

                // NEW: Filter method
                performFilter() {
                    this.currentPage = 1; // Reset to first page when filtering
                },

                // NEW: Print function for stages report
                printStagesReport() {
                    // Create a new window for printing
                    const printWindow = window.open('', '_blank');

                    // Get current filtered and paginated data
                    const currentData = this.currentItems;

                    // Generate table rows HTML
                    const tableRows = currentData.map(stage => `
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${stage.stageId || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${stage.location || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${stage.established || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">
                                <span style="display: inline-block; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500;
                                    ${stage.status === 'Active' ? 'background-color: #d1fae5; color: #065f46;' :
                                    stage.status === 'In-Active' ? 'background-color: #fed7aa; color: #92400e;' :
                                    stage.status === 'Under Review' ? 'background-color: #fef3c7; color: #92400e;' :
                                    'background-color: #f3f4f6; color: #1f2937;'}">
                                    ${stage.status || 'N/A'}
                                </span>
                            </td>
                        </tr>
                    `).join('');

                    // Write the print document
                    printWindow.document.write(`
                        <html>
                        <head>
                            <title>Stages Report</title>
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
                            <h1>Stages Report</h1>
                            <div class="header">
                                <div>Generated on: ${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}</div>
                                <div>Filter: Status - ${this.statusFilter === 'All' ? 'All Stages' : this.statusFilter}</div>
                                <div>Showing ${this.startIndex} to ${this.endIndex} of ${this.filteredStages.length} stages</div>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Stage ID</th>
                                        <th>Location</th>
                                        <th>Established</th>
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
                },

                // Original pagination methods (unchanged)
                prevPage() {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                    }
                },

                nextPage() {
                    if (this.currentPage < this.totalPages) {
                        this.currentPage++;
                    }
                },

                goToPage(page) {
                    this.currentPage = page;
                }
            };
        }

        // Global function for modal (if needed)
        function editStageModal() {
            return {
                editStageModal: false,
                currentStage: {},

                updateStage() {
                    // Add your update logic here
                    console.log('Updating stage:', this.currentStage);
                    this.editStageModal = false;
                    alert('Stage updated successfully!');
                }
            };
        }

        // Stage Managers Table Component
        function stageManagersTable() {
                return {
                    // Properties
                    managers: [],
                    filteredManagers: [],
                    page: 1,
                    perPage: 10,
                    selectedRole: 'All',
                    userRoles: ['All', 'Supervisor', 'Stage Manager'],
                    isLoading: true,

                    // Initialize and fetch data
                    async init() {
                        this.isLoading = true;
                        try {
                            const response = await fetch('/stages/supervisors/all');
                            const result = await response.json();

                            if (result.success) {
                                this.managers = result.data.map(manager => ({
                                    id: manager.id,
                                    userId: 'USR' + String(manager.id).padStart(4, '0'),
                                    firstName: manager.name ? manager.name.split(' ')[0] : '',
                                    lastName: manager.name ? manager.name.split(' ').slice(1).join(' ') : '',
                                    email: manager.email || '',
                                    phone: manager.phone || '',
                                    nationalId: manager.national_id || 'N/A',
                                    dob: manager.dob || new Date(),
                                    gender: manager.gender || 'N/A',
                                    joinedOn: manager.created_at ? new Date(manager.created_at).toLocaleDateString('en-GB', {
                                        day: '2-digit',
                                        month: 'short',
                                        year: 'numeric',
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    }) : 'N/A',
                                    userRole: manager.role || 'N/A',
                                    userStatus: manager.status || 'Active'
                                }));
                                this.filterByRole(this.selectedRole);
                            }
                        } catch (error) {
                            console.error('Error fetching stage managers:', error);
                        } finally {
                            this.isLoading = false;
                        }
                    },

                    // Filter by role
                    filterByRole(role) {
                        this.selectedRole = role;
                        if (role === 'All') {
                            this.filteredManagers = [...this.managers];
                        } else {
                            this.filteredManagers = this.managers.filter(m => m.userRole === role);
                        }
                        this.page = 1; // Reset to first page
                    },

                    // Get status class for styling
                    getStatusClass(status) {
                        const statusMap = {
                            'Active': 'bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500',
                            'Inactive': 'bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500',
                            'Suspended': 'bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-warning-500',
                            'Pending': 'bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-warning-500'
                        };
                        return statusMap[status] || 'bg-gray-50 text-gray-600 dark:bg-gray-500/15 dark:text-gray-500';
                    },

                    // Pagination getters
                    get paginatedRows() {
                        const start = (this.page - 1) * this.perPage;
                        const end = start + this.perPage;
                        return this.filteredManagers.slice(start, end);
                    },

                    get totalPages() {
                        return Math.ceil(this.filteredManagers.length / this.perPage);
                    },

                    get startEntry() {
                        if (this.filteredManagers.length === 0) return 0;
                        return (this.page - 1) * this.perPage + 1;
                    },

                    get endEntry() {
                        if (this.filteredManagers.length === 0) return 0;
                        const end = this.page * this.perPage;
                        return end > this.filteredManagers.length ? this.filteredManagers.length : end;
                    },

                    // Pagination methods
                    prevPage() {
                        if (this.page > 1) {
                            this.page--;
                        }
                    },

                    nextPage() {
                        if (this.page < this.totalPages) {
                            this.page++;
                        }
                    },

                    goToPage(page) {
                        this.page = page;
                    },

                    // Print function
                    printManagersReport() {
                        const printWindow = window.open('', '_blank');
                        const currentData = this.paginatedRows;

                        const tableRows = currentData.map(manager => `
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 12px; text-align: left;">${manager.userId}</td>
                                <td style="padding: 12px; text-align: left;">${manager.firstName} ${manager.lastName}<br><small>${manager.gender}</small></td>
                                <td style="padding: 12px; text-align: left;">${manager.email}<br><small>${manager.phone}</small></td>
                                <td style="padding: 12px; text-align: left;">ID: ${manager.nationalId}<br><small>DoB: ${new Date(manager.dob).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })}</small></td>
                                <td style="padding: 12px; text-align: left;">${manager.joinedOn}</td>
                                <td style="padding: 12px; text-align: left;">${manager.userRole}</td>
                                <td style="padding: 12px; text-align: left;">
                                    <span style="display: inline-block; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500;
                                        ${manager.userStatus === 'Active' ? 'background-color: #d1fae5; color: #065f46;' :
                                        manager.userStatus === 'Inactive' ? 'background-color: #fee2e2; color: #991b1b;' :
                                        'background-color: #f3f4f6; color: #1f2937;'}">
                                        ${manager.userStatus}
                                    </span>
                                </td>
                            </tr>
                        `).join('');

                        printWindow.document.write(`
                            <html>
                            <head>
                                <title>Stage Managers Report</title>
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
                                <h1>Stage Managers Report</h1>
                                <div class="header">
                                    <div>Generated on: ${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}</div>
                                    <div>Filter: ${this.selectedRole === 'All' ? 'All Roles' : this.selectedRole}</div>
                                    <div>Showing ${this.startEntry} to ${this.endEntry} of ${this.filteredManagers.length} managers</div>
                                </div>

                                <table>
                                    <thead>
                                        <tr>
                                            <th>#Stage Manager ID</th>
                                            <th>Stage Manager</th>
                                            <th>Contact</th>
                                            <th>Identification</th>
                                            <th>Since</th>
                                            <th>Role</th>
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

        // Initialize Alpine components
        document.addEventListener('alpine:init', () => {

            // Register the stageManagersTable component
            Alpine.data('stageManagersTable', stageManagersTable);

            // Register the stageTable component
            Alpine.data('stageTable', stageTable);

            // ADD THIS: Global store for edit stage functions
            Alpine.store('editStage', {
                isUpdating: false,
                isDeleting: false,

                async updateStage(stage) {
                    this.isUpdating = true;

                    try {
                        const response = await fetch('{{ route("treasurer.bodaboda.update") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                stageId: stage.stageId,
                                updateStageLocation: stage.location,
                                updateStageStatus: stage.status
                            })
                        });

                        const data = await response.json();
                        alert(data.message);

                        if (data.success) {
                            window.location.href = data.redirect;
                        }
                    } catch (error) {
                        alert('Network error: ' + error.message);
                    } finally {
                        this.isUpdating = false;
                    }
                },

                async deleteStage(stage) {
                    const confirmed = confirm('Are you sure you want to permanently remove this stage location?');
                    if (!confirmed) return;

                    this.isDeleting = true;

                    try {
                        const response = await fetch('{{ route("treasurer.bodaboda.delete") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                stageId: stage.stageId
                            })
                        });

                        const data = await response.json();
                        alert(data.message);

                        if (data.success) {
                            window.location.href = data.redirect;
                        }
                    } catch (error) {
                        alert('Network error: ' + error.message);
                    } finally {
                        this.isDeleting = false;
                    }
                }
            });

            // Register the editStageModal component
            Alpine.data('editStageModal', editStageModal);

            // Create new stage location handling
            Alpine.data('stageFormHandler', () => ({
                isSubmitting: false,

                async submitStageForm(event) {
                    event.preventDefault();

                    // Get form values
                    const location = document.getElementById('newStageLocation').value.trim();
                    const status = document.getElementById('newStageStatus').value.trim();

                    // Validation
                    if (!location || !status) {
                        let errorMsg = '';
                        if (!location) errorMsg += 'Stage location cannot be empty\n';
                        if (!status) errorMsg += 'Stage status cannot be empty';

                        alert(errorMsg);
                        return;
                    }

                    // Set submitting state
                    this.isSubmitting = true;

                    try {
                        // Send POST request to Laravel backend
                        const response = await fetch('{{ route("treasurer.bodaboda.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                newStageLocation: location,
                                newStageStatus: status
                            })
                        });

                        const data = await response.json();

                        // Show response message
                        alert(data.message);

                        // Redirect on success
                        if (data.success) {
                            window.location.href = data.redirect;
                        }

                    } catch (error) {
                        alert('Network error: ' + error.message);
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            }));

            // Stage Stats Store
            Alpine.store('stageStats', {
                totalStages: 0,
                activeSupervisors: 0,
                totalSupervisors: 0,
                activeStages: 0,
                isLoading: false,

                async fetchAllStats() {
                    this.isLoading = true;
                    try {
                        // Fetch all stats in parallel
                        const [stagesRes, supervisorsActiveRes, supervisorsAllRes, stagesAllRes] = await Promise.all([
                            fetch('/stages/count'),
                            fetch('/stages/supervisors/count/active'),
                            fetch('/stages/supervisors/all'),
                            fetch('/stages/all')
                        ]);

                        const stagesData = await stagesRes.json();
                        const supervisorsActiveData = await supervisorsActiveRes.json();
                        const supervisorsAllData = await supervisorsAllRes.json();
                        const stagesAllData = await stagesAllRes.json();

                        this.totalStages = stagesData.total || 0;
                        this.activeSupervisors = supervisorsActiveData.count || 0;
                        this.totalSupervisors = supervisorsAllData.count || 0;

                        if (stagesAllData.data) {
                            this.activeStages = stagesAllData.data.filter(stage => stage.status === 'Active').length;
                        }
                    } catch (error) {
                        console.error('Error fetching stage stats:', error);
                    } finally {
                        this.isLoading = false;
                    }
                }
            });



        });

    </script>


</body>

</html>
