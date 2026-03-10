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
                <div x-data="{ pageName: `Bodaboda Group > Wallet` }">
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
                            <!-- Metric Item Start -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    Total Balance
                                </p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div x-data="walletStats()" x-init="init()">
                                        <h4 class="text-xl font-bold text-gray-500 dark:text-white/90">
                                            <span x-show="!isLoading" x-text="totalBalance">KES 0.00</span>
                                            <span x-show="isLoading" class="text-sm">Loading...</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->

                            <!-- Metric Item Start -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]" x-data="{ balance: 'KES 0.00' }"
                                    x-init="fetch('/contributions/balance/total')
                                    .then(res => res.json())
                                    .then(data => { if(data.success) balance = data.formatted; })">

                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    Contributions Wallet
                                </p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div>
                                        <h4 class="text-xl font-semibold text-gray-500 dark:text-white/90" x-text="balance">KES 0.00</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->

                        <!-- Metric Item Start - Contributions Wallet -->
                        <div x-data="savingsStats" class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">

                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Savings Wallet</p>

                            <div class="mt-3 flex items-end justify-between">
                                <div>
                                    <h4 class="text-xl font-semibold text-gray-500 dark:text-white/90">
                                        <span x-show="!isLoading">KES <span x-text="formatMoney(totalBalance)"></span></span>
                                        <span x-show="isLoading">Loading...</span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <!-- Metric Item End -->

                        <!-- Metric Item Start -->
                        <div x-data="savingsStats" class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">This Week's Contributions</p>

                            <div class="mt-3 flex items-end justify-between">
                                <div x-data="walletStats()" x-init="init()">
                                    <h4 class="text-xl font-semibold text-gray-500 dark:text-white/90">
                                        <span x-show="!isLoading" x-text="weeklyContribution">KES 0.00</span>
                                        <span x-show="isLoading" class="text-sm">Loading...</span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <!-- Metric Item End -->

                    </div>
                    <!-- Metric Group Two -->
                </div>

                    <!-- Tabbed Management -->
                    <div class="rounded-xl border border-gray-200 p-6 bg-white dark:border-gray-800 dark:bg-white/[0.03]" x-data="{ activeTab: 'contributions' }">
                        <div class="border-b border-gray-200 dark:border-gray-800">
                            <nav class="-mb-px flex space-x-2 overflow-x-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-200 dark:[&::-webkit-scrollbar-thumb]:bg-gray-600 dark:[&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar]:h-1.5">
                                                <!-- Contributions -->
                                                <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                                                        x-bind:class="activeTab === 'contributions' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                                        x-on:click="activeTab = 'contributions'">
                                                    <svg class="fill-current" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13768 5.60156C7.92435 5.60156 6.94074 6.58517 6.94074 7.79851C6.94074 9.01185 7.92435 9.99545 9.13768 9.99545C10.351 9.99545 11.3346 9.01185 11.3346 7.79851C11.3346 6.58517 10.351 5.60156 9.13768 5.60156ZM5.44074 7.79851C5.44074 5.75674 7.09592 4.10156 9.13768 4.10156C11.1795 4.10156 12.8346 5.75674 12.8346 7.79851C12.8346 9.84027 11.1795 11.4955 9.13768 11.4955C7.09592 11.4955 5.44074 9.84027 5.44074 7.79851ZM5.19577 15.3208C4.42094 16.0881 4.03702 17.0608 3.8503 17.8611C3.81709 18.0034 3.85435 18.1175 3.94037 18.2112C4.03486 18.3141 4.19984 18.3987 4.40916 18.3987H13.7582C13.9675 18.3987 14.1325 18.3141 14.227 18.2112C14.313 18.1175 14.3503 18.0034 14.317 17.8611C14.1303 17.0608 13.7464 16.0881 12.9716 15.3208C12.2153 14.572 11.0231 13.955 9.08367 13.955C7.14421 13.955 5.95202 14.572 5.19577 15.3208ZM4.14036 14.2549C5.20488 13.2009 6.78928 12.455 9.08367 12.455C11.3781 12.455 12.9625 13.2009 14.027 14.2549C15.0729 15.2906 15.554 16.5607 15.7778 17.5202C16.0991 18.8971 14.9404 19.8987 13.7582 19.8987H4.40916C3.22695 19.8987 2.06829 18.8971 2.38953 17.5202C2.6134 16.5607 3.09442 15.2906 4.14036 14.2549ZM15.6375 11.4955C14.8034 11.4955 14.0339 11.2193 13.4153 10.7533C13.7074 10.3314 13.9387 9.86419 14.0964 9.36432C14.493 9.75463 15.0371 9.99545 15.6375 9.99545C16.8508 9.99545 17.8344 9.01185 17.8344 7.79851C17.8344 6.58517 16.8508 5.60156 15.6375 5.60156C15.0371 5.60156 14.493 5.84239 14.0964 6.23271C13.9387 5.73284 13.7074 5.26561 13.4153 4.84371C14.0338 4.37777 14.8034 4.10156 15.6375 4.10156C17.6792 4.10156 19.3344 5.75674 19.3344 7.79851C19.3344 9.84027 17.6792 11.4955 15.6375 11.4955ZM20.2581 19.8987H16.7233C17.0347 19.4736 17.2492 18.969 17.3159 18.3987H20.2581C20.4674 18.3987 20.6323 18.3141 20.7268 18.2112C20.8129 18.1175 20.8501 18.0034 20.8169 17.861C20.6302 17.0607 20.2463 16.088 19.4714 15.3208C18.7379 14.5945 17.5942 13.9921 15.7563 13.9566C15.5565 13.6945 15.3328 13.437 15.0824 13.1891C14.8476 12.9566 14.5952 12.7384 14.3249 12.5362C14.7185 12.4831 15.1376 12.4549 15.5835 12.4549C17.8779 12.4549 19.4623 13.2008 20.5269 14.2549C21.5728 15.2906 22.0538 16.5607 22.2777 17.5202C22.5989 18.8971 21.4403 19.8987 20.2581 19.8987Z" fill=""></path>
                                                    </svg>
                                                    Contributions
                                                </button>

                                                <!-- Savings -->
                                                <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                                                        x-bind:class="activeTab === 'savings' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                                        x-on:click="activeTab = 'savings'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M3 21l18 0"></path>
                                                    <path d="M9 8l1 0"></path>
                                                    <path d="M9 12l1 0"></path>
                                                    <path d="M9 16l1 0"></path>
                                                    <path d="M14 8l1 0"></path>
                                                    <path d="M14 12l1 0"></path>
                                                    <path d="M14 16l1 0"></path>
                                                    <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16"></path>
                                                    </svg>
                                                    Savings
                                                </button>

                            </nav>
                        </div>

                        <div class="pt-4 dark:border-gray-800" x-data="memberTableFull()">

                                <div class="" x-show="activeTab === 'contributions'" x-data="contributionsTable()">
                                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                        <!-- Contributions content here -->
                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                                    Bodaboda Contributions
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Review contributions performance
                                                </p>
                                            </div>

                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                    <!-- Membership Filter -->
                                                    <div class="hidden lg:block">
                                                        <select x-model="membershipFilter"
                                                                @change="performFilter()"
                                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                            <option value="All">All Members</option>
                                                            <option value="Member">Members</option>
                                                            <option value="Non-Member">Non-members</option>
                                                        </select>
                                                    </div>

                                                    <!-- Frequency Filter -->
                                                    <div class="hidden lg:block">
                                                        <select x-model="frequencyFilter"
                                                                @change="performFilter()"
                                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                            <option value="Daily">Daily</option>
                                                            <option value="Weekly">Weekly</option>
                                                            <option value="Monthly">Monthly</option>
                                                            <option value="Yearly">Yearly</option>
                                                        </select>
                                                    </div>

                                                    <!-- Payment Type Filter -->
                                                    <div class="hidden lg:block">
                                                        <select x-model="paymentFilter"
                                                                @change="performFilter()"
                                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                            <option value="All">All Payment Types</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="MPesa">MPesa</option>
                                                            <option value="Bank">Bank</option>
                                                        </select>
                                                    </div>

                                                    <!-- Print Button -->
                                                    <div>
                                                        <button @click="printContributionsReport()"
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
                                        <!-- Contributions table Table -->
                                        <div x-init="init()">
                                            <div class="custom-scrollbar overflow-x-auto">
                                                <table class="w-full table-auto">
                                                    <thead>
                                                        <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400"">
                                                                #Transaction Code
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Member
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Membership
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Amount
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Date
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Type
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Mode
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Status
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <!-- Message if no contribution data found -->
                                                    <template x-if="contributions.length === 0">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="10" class="px-4 py-12 text-center">
                                                                    <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                        <!-- Documents Outline SVG Icon -->
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                                                        </svg>
                                                                        <div class="space-y-2">
                                                                            <h2 class="text-xl font-semibold text-gray-700">No contribution records found</h2>
                                                                            <p class="text-gray-500">Do some transactions to view contribution performance</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </template>

                                                    <!-- If there are Contribution records display in table -->
                                                    <template x-if="contributions.length > 0">
                                                        <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                            <template x-for="contribution in paginatedContributions" :key="contribution.transactionCode">
                                                                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="group flex items-center gap-3">
                                                                            <p class="text-theme-xs font-medium text-gray-700 group-hover:underline dark:text-gray-400"
                                                                                    x-text="contribution.transactionCode">
                                                                                </p>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div>
                                                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                                                x-text="contribution.memberName">
                                                                            </span>
                                                                            <p class="text-xs text-gray-500 dark:text-gray-400" x-text="row.memberEmail"></p>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.membership"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.amount"></p>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.date"></p>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.type"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.mode"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                                            :class="{
                                                                                'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': contribution.status === 'Confirmed',
                                                                                'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400': contribution.status === 'Pending',
                                                                                'bg-error-100 text-error-600 dark:bg-error-900/30 dark:text-error-400': contribution.status === 'Cancelled' || contribution.status === 'Reversed'
                                                                            }"
                                                                            x-text="contribution.status">
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                    </template>
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
                                                        <span class="text-gray-800 dark:text-white/90" x-text="contributions.length"></span>
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
                                                            <span class="text-gray-800 dark:text-white/90" x-text="contributions.length"></span>
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

                                <div x-show="activeTab === 'savings'" style="display: none;">
                                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                        <!-- Contributions content here -->
                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                                    Bodaboda Contributions
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Review contributions performance
                                                </p>
                                            </div>

                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                    <!-- Membership Filter -->
                                                    <div class="hidden lg:block">
                                                        <select x-model="membershipFilter"
                                                                @change="performFilter()"
                                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                            <option value="All">All Members</option>
                                                            <option value="Member">Members</option>
                                                            <option value="Non-Member">Non-members</option>
                                                        </select>
                                                    </div>

                                                    <!-- Frequency Filter -->
                                                    <div class="hidden lg:block">
                                                        <select x-model="frequencyFilter"
                                                                @change="performFilter()"
                                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                            <option value="Daily">Daily</option>
                                                            <option value="Weekly">Weekly</option>
                                                            <option value="Monthly">Monthly</option>
                                                            <option value="Yearly">Yearly</option>
                                                        </select>
                                                    </div>

                                                    <!-- Payment Type Filter -->
                                                    <div class="hidden lg:block">
                                                        <select x-model="paymentFilter"
                                                                @change="performFilter()"
                                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                            <option value="All">All Payment Types</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="MPesa">MPesa</option>
                                                            <option value="Bank">Bank</option>
                                                        </select>
                                                    </div>

                                                    <!-- Print Button -->
                                                    <div>
                                                        <button @click="printContributionsReport()"
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
                                        <!-- Contributions table Table -->
                                        <div x-init="init()">
                                            <div class="custom-scrollbar overflow-x-auto">
                                                <table class="w-full table-auto">
                                                    <thead>
                                                        <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400"">
                                                                #Transaction Code
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Member
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Membership
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Amount
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Date
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Type
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Mode
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Status
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <!-- Message if no contribution data found -->
                                                    <template x-if="contributions.length === 0">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="10" class="px-4 py-12 text-center">
                                                                    <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                        <!-- Documents Outline SVG Icon -->
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                                                        </svg>
                                                                        <div class="space-y-2">
                                                                            <h2 class="text-xl font-semibold text-gray-700">No contribution records found</h2>
                                                                            <p class="text-gray-500">Do some transactions to view contribution performance</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </template>

                                                    <!-- If there are Contribution records display in table -->
                                                    <template x-if="contributions.length > 0">
                                                        <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                            <template x-for="contribution in paginatedContributions" :key="contribution.transactionCode">
                                                                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="group flex items-center gap-3">
                                                                            <p class="text-theme-xs font-medium text-gray-700 group-hover:underline dark:text-gray-400"
                                                                                    x-text="contribution.transactionCode">
                                                                                </p>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div>
                                                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                                                x-text="contribution.memberName">
                                                                            </span>
                                                                            <p class="text-xs text-gray-500 dark:text-gray-400" x-text="row.memberEmail"></p>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.membership"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.amount"></p>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.date"></p>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.type"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.mode"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                                            :class="{
                                                                                'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': contribution.status === 'Confirmed',
                                                                                'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400': contribution.status === 'Pending',
                                                                                'bg-error-100 text-error-600 dark:bg-error-900/30 dark:text-error-400': contribution.status === 'Cancelled' || contribution.status === 'Reversed'
                                                                            }"
                                                                            x-text="contribution.status">
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                    </template>
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
                                                        <span class="text-gray-800 dark:text-white/90" x-text="contributions.length"></span>
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
                                                            <span class="text-gray-800 dark:text-white/90" x-text="contributions.length"></span>
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


        </main>
        <!-- ===== Main Content End ===== -->
        </div>
            <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->

    <!-- ===== Custom JS ===== -->
    <script defer src="{{ asset('assets/bundle.js') }}"></script>
    <!-- ===== Data Tables ===== -->

    <!-- Balance Stats ------------------------- -->
    <script>
        // Wallet Stats Component
        function walletStats() {
            return {
                totalBalance: 'KES 0.00',
                weeklyContribution: 'KES 0.00',
                isLoading: true,
                weekRange: '',

                async init() {
                    await this.loadTotalBalance();
                    await this.loadWeeklyContribution();
                },

                async loadTotalBalance() {
                    try {
                        const response = await fetch('/wallet/balance/total');
                        const data = await response.json();

                        if (data.success) {
                            this.totalBalance = data.formatted || 'KES 0.00';
                        }
                    } catch (error) {
                        console.error('Error loading total balance:', error);
                        this.totalBalance = 'KES 0.00';
                    }
                },

                async loadWeeklyContribution() {
                    try {
                        const response = await fetch('/wallet/contributions/weekly');
                        const data = await response.json();

                        if (data.success) {
                            this.weeklyContribution = data.formatted || 'KES 0.00';
                            if (data.week_start && data.week_end) {
                                const start = new Date(data.week_start).toLocaleDateString('en-GB', {
                                    day: '2-digit',
                                    month: 'short'
                                });
                                const end = new Date(data.week_end).toLocaleDateString('en-GB', {
                                    day: '2-digit',
                                    month: 'short',
                                    year: 'numeric'
                                });
                                this.weekRange = `${start} - ${end}`;
                            }
                        }
                    } catch (error) {
                        console.error('Error loading weekly contribution:', error);
                        this.weeklyContribution = 'KES 0.00';
                    } finally {
                        this.isLoading = false;
                    }
                }
            };
        }

        // Register the component
        document.addEventListener('alpine:init', () => {
            Alpine.data('walletStats', walletStats);
        });

    </script>

    <!-- Savings Stats ------------------------------------------------------------------------- -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('savingsStats', () => ({
                totalBalance: 0,
                isLoading: true,

                init() {
                    this.loadTotalBalance();
                },

                loadTotalBalance() {
                    fetch('/savings/all-balance')
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.totalBalance = data.total_balance;
                            }
                            this.isLoading = false;
                        })
                        .catch(error => {
                            console.error('Error loading total savings balance:', error);
                            this.isLoading = false;
                        });
                },

                formatMoney(amount) {
                    return amount.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                }
            }));
        });
    </script>

    <!-- Contributions Alpine ------------------------------------------------------------------ -->
    <script>
        // contributionsTable.js - Data binding and pagination functionality for contributions
        function contributionsTable() {
            return {
                // Contributions data - loaded from Laravel backend
                contributions: [],
                page: 1,
                itemsPerPage: 10,

                // NEW: Filter properties
                membershipFilter: 'All',
                frequencyFilter: 'Daily',
                paymentFilter: 'All',

                // Initialize function - loads data from Laravel
                async init() {
                    console.log('Contributions table initialized');
                    await this.loadContributions();
                },

                // Load contributions from Laravel backend
                async loadContributions() {
                    try {
                        const response = await fetch('/contributions/all');
                        const data = await response.json();

                        if (data && data.data) {
                            // Transform Laravel data for frontend display - ONLY Paid-In, Confirmed transactions
                            this.contributions = data.data.map(item => ({
                                transactionCode: item.transactionCode || 'Loading ...',
                                memberName: item.full_name || 'N/A',
                                membership: item.membership || 'N/A',
                                amount: 'KES ' + (parseFloat(item.transactionAmount || 0).toLocaleString()),
                                date: new Date(item.transactionDate || Date.now()).toLocaleDateString('en-GB', {
                                    day: '2-digit',
                                    month: 'short',
                                    year: 'numeric'
                                }),
                                type: item.transactionType || 'N/A',
                                mode: item.transactionMode || 'N/A',
                                status: item.transactionStatus || 'N/A',
                                // Add raw date for frequency filtering
                                rawDate: item.transactionDate ? new Date(item.transactionDate) : new Date()
                            }));
                        }
                    } catch (error) {
                        console.error('Error loading contributions:', error);
                        this.contributions = [];
                    }
                },

                // NEW: Filtered contributions based on membership, frequency, and payment type
                get filteredContributions() {
                    let filtered = this.contributions;

                    // Apply membership filter (Member/Non-Member)
                    if (this.membershipFilter !== 'All') {
                        filtered = filtered.filter(c => c.membership === this.membershipFilter);
                    }

                    // Apply payment type filter
                    if (this.paymentFilter !== 'All') {
                        filtered = filtered.filter(c => c.mode === this.paymentFilter);
                    }

                    // Apply frequency filter based on transaction date
                    if (this.frequencyFilter !== 'Daily') {
                        const now = new Date();
                        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

                        filtered = filtered.filter(c => {
                            const transDate = new Date(c.rawDate);

                            switch(this.frequencyFilter) {
                                case 'Daily':
                                    // Today's transactions
                                    const txDate = new Date(transDate.getFullYear(), transDate.getMonth(), transDate.getDate());
                                    return txDate.getTime() === today.getTime();

                                case 'Weekly':
                                    // Last 7 days
                                    const weekAgo = new Date(today);
                                    weekAgo.setDate(weekAgo.getDate() - 7);
                                    return transDate >= weekAgo;

                                case 'Monthly':
                                    // Last 30 days
                                    const monthAgo = new Date(today);
                                    monthAgo.setDate(monthAgo.getDate() - 30);
                                    return transDate >= monthAgo;

                                case 'Yearly':
                                    // Last 365 days
                                    const yearAgo = new Date(today);
                                    yearAgo.setDate(yearAgo.getDate() - 365);
                                    return transDate >= yearAgo;

                                default:
                                    return true;
                            }
                        });
                    }

                    return filtered;
                },

                // Computed properties for pagination - MODIFIED to use filteredContributions
                get totalPages() {
                    return Math.ceil(this.filteredContributions.length / this.itemsPerPage);
                },

                get paginatedContributions() {
                    const start = (this.page - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.filteredContributions.slice(start, end);
                },

                get startEntry() {
                    return (this.page - 1) * this.itemsPerPage + 1;
                },

                get endEntry() {
                    const end = this.page * this.itemsPerPage;
                    return end > this.filteredContributions.length ? this.filteredContributions.length : end;
                },

                // NEW: Filter method
                performFilter() {
                    this.page = 1; // Reset to first page when filtering
                },

                // NEW: Print function for contributions report
                printContributionsReport() {
                    // Create a new window for printing
                    const printWindow = window.open('', '_blank');

                    // Get current filtered and paginated data
                    const currentData = this.paginatedContributions;

                    // Generate table rows HTML
                    const tableRows = currentData.map(contribution => `
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${contribution.transactionCode || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">
                                <div><strong>${contribution.memberName || 'N/A'}</strong></div>
                                <div style="font-size: 12px; color: #6b7280;">${contribution.membership || 'N/A'}</div>
                            </td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${contribution.amount || 'KES 0'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${contribution.date || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${contribution.type || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${contribution.mode || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">
                                <span style="display: inline-block; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500;
                                    ${contribution.status === 'Confirmed' ? 'background-color: #d1fae5; color: #065f46;' :
                                    contribution.status === 'Pending' ? 'background-color: #fed7aa; color: #92400e;' :
                                    contribution.status === 'Cancelled' ? 'background-color: #fee2e2; color: #991b1b;' :
                                    contribution.status === 'Reversed' ? 'background-color: #e5e7eb; color: #1f2937;' :
                                    'background-color: #f3f4f6; color: #1f2937;'}">
                                    ${contribution.status || 'N/A'}
                                </span>
                            </td>
                        </tr>
                    `).join('');

                    // Write the print document
                    printWindow.document.write(`
                        <html>
                        <head>
                            <title>Contributions Report</title>
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
                            <h1>Contributions Report</h1>
                            <div class="header">
                                <div>Generated on: ${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}</div>
                                <div>Filters:
                                    Membership - ${this.membershipFilter === 'All' ? 'All Members' : this.membershipFilter},
                                    Frequency - ${this.frequencyFilter === 'Daily' ? 'Today' : this.frequencyFilter},
                                    Payment Type - ${this.paymentFilter === 'All' ? 'All Types' : this.paymentFilter}
                                </div>
                                <div>Showing ${this.startEntry} to ${this.endEntry} of ${this.filteredContributions.length} contributions</div>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Transaction Code</th>
                                        <th>Member</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Mode</th>
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

                // Pagination methods (unchanged)
                prevPage() {
                    if (this.page > 1) this.page--;
                },

                nextPage() {
                    if (this.page < this.totalPages) this.page++;
                },

                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) this.page = page;
                },

                // Original computed properties kept for reference but not used directly
                // (they are overridden by the filtered versions above)
                get originalTotalPages() {
                    return Math.ceil(this.contributions.length / this.itemsPerPage);
                },

                get originalPaginatedContributions() {
                    const start = (this.page - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.contributions.slice(start, end);
                }
            };
        }

        // Initialize Alpine components
        document.addEventListener('alpine:init', () => {
            // Register the contributionsTable component
            Alpine.data('contributionsTable', contributionsTable);
        });
    </script>

</body>

</html>
