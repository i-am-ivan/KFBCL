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
                <div x-data="{ pageName: `Bodaboda Group > Members` }">
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
                                    All Members
                                </p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div x-data="memberTableFull()" x-init="fetchTotalMembers()">
                                        <h4 class="text-xl font-bold text-gray-500 dark:text-white/90">
                                            <span x-text="totalMembers">0</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->

                            <!-- Active Members Card -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]"
                                x-data="memberTableFull()"
                                x-init="fetchActiveMembers()">
                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Active Members</p>
                                <div class="mt-3">
                                    <h4 class="text-xl font-bold text-gray-500 dark:text-white/90" x-text="activeMembers">0</h4>
                                </div>
                            </div>

                            <!-- Pending Members Card -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]"
                                x-data="memberTableFull()"
                                x-init="fetchPendingMembers()">
                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Pending Members</p>
                                <div class="mt-3">
                                    <h4 class="text-xl font-bold text-gray-500 dark:text-white/90" x-text="pendingMembers">0</h4>
                                </div>
                            </div>

                            <!-- Suspended Members Card -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]"
                                x-data="memberTableFull()"
                                x-init="fetchSuspendedMembers()">
                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Suspended Members</p>
                                <div class="mt-3">
                                    <h4 class="text-xl font-bold text-gray-500 dark:text-white/90" x-text="suspendedMembers">0</h4>
                                </div>
                            </div>

                    </div>
                    <!-- Metric Group Two -->
                </div>

                    <!-- Tabbed Management -->
                    <div class="rounded-xl border border-gray-200 p-6 bg-white dark:border-gray-800 dark:bg-white/[0.03]" x-data="{ activeTab: 'members' }">
                        <div class="border-b border-gray-200 dark:border-gray-800">
                            <nav class="-mb-px flex space-x-2 overflow-x-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-200 dark:[&::-webkit-scrollbar-thumb]:bg-gray-600 dark:[&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar]:h-1.5">
                                                <!-- Members -->
                                                <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                                                        x-bind:class="activeTab === 'members' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                                        x-on:click="activeTab = 'members'">
                                                    <svg class="fill-current" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13768 5.60156C7.92435 5.60156 6.94074 6.58517 6.94074 7.79851C6.94074 9.01185 7.92435 9.99545 9.13768 9.99545C10.351 9.99545 11.3346 9.01185 11.3346 7.79851C11.3346 6.58517 10.351 5.60156 9.13768 5.60156ZM5.44074 7.79851C5.44074 5.75674 7.09592 4.10156 9.13768 4.10156C11.1795 4.10156 12.8346 5.75674 12.8346 7.79851C12.8346 9.84027 11.1795 11.4955 9.13768 11.4955C7.09592 11.4955 5.44074 9.84027 5.44074 7.79851ZM5.19577 15.3208C4.42094 16.0881 4.03702 17.0608 3.8503 17.8611C3.81709 18.0034 3.85435 18.1175 3.94037 18.2112C4.03486 18.3141 4.19984 18.3987 4.40916 18.3987H13.7582C13.9675 18.3987 14.1325 18.3141 14.227 18.2112C14.313 18.1175 14.3503 18.0034 14.317 17.8611C14.1303 17.0608 13.7464 16.0881 12.9716 15.3208C12.2153 14.572 11.0231 13.955 9.08367 13.955C7.14421 13.955 5.95202 14.572 5.19577 15.3208ZM4.14036 14.2549C5.20488 13.2009 6.78928 12.455 9.08367 12.455C11.3781 12.455 12.9625 13.2009 14.027 14.2549C15.0729 15.2906 15.554 16.5607 15.7778 17.5202C16.0991 18.8971 14.9404 19.8987 13.7582 19.8987H4.40916C3.22695 19.8987 2.06829 18.8971 2.38953 17.5202C2.6134 16.5607 3.09442 15.2906 4.14036 14.2549ZM15.6375 11.4955C14.8034 11.4955 14.0339 11.2193 13.4153 10.7533C13.7074 10.3314 13.9387 9.86419 14.0964 9.36432C14.493 9.75463 15.0371 9.99545 15.6375 9.99545C16.8508 9.99545 17.8344 9.01185 17.8344 7.79851C17.8344 6.58517 16.8508 5.60156 15.6375 5.60156C15.0371 5.60156 14.493 5.84239 14.0964 6.23271C13.9387 5.73284 13.7074 5.26561 13.4153 4.84371C14.0338 4.37777 14.8034 4.10156 15.6375 4.10156C17.6792 4.10156 19.3344 5.75674 19.3344 7.79851C19.3344 9.84027 17.6792 11.4955 15.6375 11.4955ZM20.2581 19.8987H16.7233C17.0347 19.4736 17.2492 18.969 17.3159 18.3987H20.2581C20.4674 18.3987 20.6323 18.3141 20.7268 18.2112C20.8129 18.1175 20.8501 18.0034 20.8169 17.861C20.6302 17.0607 20.2463 16.088 19.4714 15.3208C18.7379 14.5945 17.5942 13.9921 15.7563 13.9566C15.5565 13.6945 15.3328 13.437 15.0824 13.1891C14.8476 12.9566 14.5952 12.7384 14.3249 12.5362C14.7185 12.4831 15.1376 12.4549 15.5835 12.4549C17.8779 12.4549 19.4623 13.2008 20.5269 14.2549C21.5728 15.2906 22.0538 16.5607 22.2777 17.5202C22.5989 18.8971 21.4403 19.8987 20.2581 19.8987Z" fill=""></path>
                                                    </svg>
                                                    Members
                                                </button>

                                                <!-- Membership -->
                                                <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                                                        x-bind:class="activeTab === 'membership' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                                        x-on:click="activeTab = 'membership'">
                                                    <svg class="size-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2C7.79086 2 6 3.79086 6 6C6 8.20914 7.79086 10 10 10C12.2091 10 14 8.20914 14 6C14 3.79086 12.2091 2 10 2ZM8 6C8 4.89543 8.89543 4 10 4C11.1046 4 12 4.89543 12 6C12 7.10457 11.1046 8 10 8C8.89543 8 8 7.10457 8 6Z" fill="currentColor"/>
                                                        <path d="M15 12C15.5523 12 16 12.4477 16 13V14H17C17.5523 14 18 14.4477 18 15C18 15.5523 17.5523 16 17 16H16V17C16 17.5523 15.5523 18 15 18C14.4477 18 14 17.5523 14 17V16H13C12.4477 16 12 15.5523 12 15C12 14.4477 12.4477 14 13 14H14V13C14 12.4477 14.4477 12 15 12Z" fill="currentColor"/>
                                                        <path d="M5 13C5 11.8954 5.89543 11 7 11H9.25C9.66421 11 10 11.3358 10 11.75C10 12.1642 9.66421 12.5 9.25 12.5H7C6.72386 12.5 6.5 12.7239 6.5 13V13.5C6.5 14.0523 6.94772 14.5 7.5 14.5H9.25C9.66421 14.5 10 14.8358 10 15.25C10 15.6642 9.66421 16 9.25 16H7.5C5.98122 16 4.75 14.7688 4.75 13.25V13C4.75 12.0054 5.25415 11.1289 6.01505 10.6329C5.4141 10.2841 5 9.64748 5 8.9375V8.5C5 7.5335 5.7835 6.75 6.75 6.75H7.5C7.91421 6.75 8.25 7.08579 8.25 7.5C8.25 7.91421 7.91421 8.25 7.5 8.25H6.75C6.61193 8.25 6.5 8.36193 6.5 8.5V8.9375C6.5 9.21364 6.72386 9.4375 7 9.4375H8.25C8.66421 9.4375 9 9.77329 9 10.1875C9 10.6017 8.66421 10.9375 8.25 10.9375H7C6.72386 10.9375 6.5 11.1614 6.5 11.4375V11.5C6.5 11.6381 6.61193 11.75 6.75 11.75H7.5C7.91421 11.75 8.25 12.0858 8.25 12.5C8.25 12.9142 7.91421 13.25 7.5 13.25H6.75C5.7835 13.25 5 12.4665 5 11.5V11.4375C5 10.7442 5.41083 10.1469 6 9.88656C5.41083 9.62618 5 9.0289 5 8.33562V8C5 7.0335 5.7835 6.25 6.75 6.25H7.5C7.91421 6.25 8.25 5.91421 8.25 5.5C8.25 5.08579 7.91421 4.75 7.5 4.75H6.75C4.95507 4.75 3.5 6.20507 3.5 8V8.33562C3.5 9.13062 3.94083 9.84437 4.65345 10.2095C3.94083 10.5746 3.5 11.2884 3.5 12.0834V12.5C3.5 14.5711 5.17893 16.25 7.25 16.25H9.25C9.66421 16.25 10 15.9142 10 15.5C10 15.0858 9.66421 14.75 9.25 14.75H7.25C6.97386 14.75 6.75 14.5261 6.75 14.25V13.75C6.75 13.0596 7.30964 12.5 8 12.5H8.5C8.91421 12.5 9.25 12.1642 9.25 11.75C9.25 11.3358 8.91421 11 8.5 11H7.25C6.97386 11 6.75 10.7761 6.75 10.5V10.4375C6.75 9.74711 7.30964 9.1875 8 9.1875H8.5C8.91421 9.1875 9.25 8.85171 9.25 8.4375C9.25 8.02329 8.91421 7.6875 8.5 7.6875H8C7.72386 7.6875 7.5 7.46364 7.5 7.1875V7C7.5 6.72386 7.72386 6.5 8 6.5H9C10.3807 6.5 11.5 7.61929 11.5 9V10.1875C11.5 10.6017 11.1642 10.9375 10.75 10.9375C10.3358 10.9375 10 10.6017 10 10.1875V9C10 8.44772 9.55228 8 9 8H8.75C8.61193 8 8.5 8.11193 8.5 8.25V8.4375C8.5 8.57557 8.61193 8.6875 8.75 8.6875H9.5C10.7426 8.6875 11.75 9.69486 11.75 10.9375C11.75 12.1801 10.7426 13.1875 9.5 13.1875H8.75C8.61193 13.1875 8.5 13.2994 8.5 13.4375V13.5C8.5 13.6381 8.61193 13.75 8.75 13.75H10.25C10.6642 13.75 11 14.0858 11 14.5C11 14.9142 10.6642 15.25 10.25 15.25H8.75C7.5794 15.25 6.625 14.2956 6.625 13.125C6.625 12.7108 6.28921 12.375 5.875 12.375H5.5C5.22386 12.375 5 12.1511 5 11.875V11.4375C5 11.1614 5.22386 10.9375 5.5 10.9375H6C6.41421 10.9375 6.75 10.6017 6.75 10.1875V9.4375C6.75 8.471 5.9665 7.6875 5 7.6875C5 8.654 5.7835 9.4375 6.75 9.4375V8.6875C6.33579 8.6875 6 8.35171 6 7.9375V7.5C6 7.36193 6.11193 7.25 6.25 7.25H6.5C6.77614 7.25 7 7.02614 7 6.75C7 6.47386 6.77614 6.25 6.5 6.25H5.5C4.94772 6.25 4.5 6.69772 4.5 7.25V7.6875C4.5 8.23228 4.94772 8.68 5.5 8.68V9.4375C4.5335 9.4375 3.75 8.654 3.75 7.6875V7.25C3.75 5.7835 4.7835 4.75 6.25 4.75H7.5C7.91421 4.75 8.25 4.41421 8.25 4C8.25 3.58579 7.91421 3.25 7.5 3.25H6.25C4.0225 3.25 2.25 5.0225 2.25 7.25V7.6875C2.25 8.5925 2.71083 9.4025 3.42083 9.875C2.71083 10.3475 2.25 11.1575 2.25 12.0625V12.5C2.25 14.7275 4.0225 16.5 6.25 16.5H7.5C7.91421 16.5 8.25 16.1642 8.25 15.75C8.25 15.3358 7.91421 15 7.5 15H6.25C4.84375 15 3.75 13.9062 3.75 12.5V12.0625C3.75 11.1562 4.15625 10.3438 4.84375 9.875C4.15625 9.40625 3.75 8.59375 3.75 7.6875V7.25C3.75 5.84375 4.84375 4.75 6.25 4.75H7.5C7.91421 4.75 8.25 4.41421 8.25 4C8.25 3.58579 7.91421 3.25 7.5 3.25H6.25C4.0225 3.25 2.25 5.0225 2.25 7.25V7.6875C2.25 8.5925 2.71083 9.4025 3.42083 9.875C2.71083 10.3475 2.25 11.1575 2.25 12.0625V12.5C2.25 14.7275 4.0225 16.5 6.25 16.5H7.5C7.91421 16.5 8.25 16.1642 8.25 15.75C8.25 15.3358 7.91421 15 7.5 15H6.25C4.84375 15 3.75 13.9062 3.75 12.5V12.0625C3.75 11.1562 4.15625 10.3438 4.84375 9.875Z" fill="currentColor"/>
                                                    </svg>
                                                    Membership
                                                </button>

                            </nav>
                        </div>

                        <div class="pt-4 dark:border-gray-800" x-data="memberTableFull()">
                                <!-- Members Tab Content -->
                                <div x-show="activeTab === 'members'" style="display: none;">

                                    <!-- Members table -->
                                                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                                        <!-- Members content here -->
                                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                                            <div>
                                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                                                    Bodaboda Members
                                                                </h3>
                                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                                    List of all bodaboda members
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
                                                                    placeholder="Search"
                                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden sm:w-[300px] sm:min-w-[300px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                            </div>

                                                            <!-- Membership Filter (Member/Non-Member) -->
                                                            <div class="hidden lg:block">
                                                                <select x-model="membershipFilter"
                                                                        @change="performFilter()"
                                                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                    <option value="All">All Members</option>
                                                                    <option value="Member">Members</option>
                                                                    <option value="Non-Member">Non-members</option>
                                                                </select>
                                                            </div>

                                                            <!-- Status Filter (Active/Suspended/Blacklisted) -->
                                                            <div class="hidden lg:block">
                                                                <select x-model="statusFilter"
                                                                        @change="performFilter()"
                                                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                    <option value="All">All Status</option>
                                                                    <option value="Active">Active Members</option>
                                                                    <option value="Suspended">Suspended Members</option>
                                                                    <option value="Blacklisted">Blacklisted Members</option>
                                                                </select>
                                                            </div>

                                                            <!-- Print Button -->
                                                            <div>
                                                                <button @click="printMembersReport()"
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
                                                                                #MemberID
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Member
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Phone
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Last Contribution
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Joined
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Membership
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                DL Type
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Status
                                                                            </th>
                                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <!-- Message  if no members data found -->
                                                                        <template x-if="rows.length === 0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="10" class="px-4 py-12 text-center">
                                                                                        <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                            <!-- Users Outline SVG Icon -->
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                                                            </svg>
                                                                                            <div class="space-y-2">
                                                                                                <h1 class="text-xl font-semibold text-gray-700">No Bodaboda members found.</h1>
                                                                                                <p class="text-gray-500">Add new members to manage here.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </template>

                                                                        <template x-if="rows.length > 0">
                                                                            <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                                                <!-- Else if there is data display -->
                                                                                <template x-for="row in paginatedRows" :key="row.id">
                                                                                    <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                                        <!-- #MemberID -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <div class="group flex items-center gap-3">
                                                                                                <a href="view-member.php"
                                                                                                    class="text-theme-xs font-medium text-gray-700 group-hover:underline dark:text-gray-400"
                                                                                                    x-text="row.memberId"></a>
                                                                                            </div>
                                                                                        </td>

                                                                                        <!-- Member Name & Email -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <div>
                                                                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                                                                    x-text="row.member"></span>
                                                                                                <p class="text-xs text-gray-500 dark:text-gray-400" x-text="row.memberEmail"></p>
                                                                                            </div>
                                                                                        </td>

                                                                                        <!-- Phone -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <p class="text-sm text-gray-700 dark:text-gray-400 truncate max-w-[200px]"
                                                                                            x-text="row.phone"
                                                                                            :title="row.phone"></p>
                                                                                        </td>

                                                                                        <!-- Last Contribution -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <div>
                                                                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                                                                    x-text="row.lastContribution"></p>
                                                                                                <p class="text-xs text-gray-500 dark:text-gray-400" x-text="row.lastContributionDate"></p>
                                                                                            </div>
                                                                                        </td>

                                                                                        <!-- Joined -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <p class="text-sm text-gray-700 dark:text-gray-400 truncate max-w-[200px]"
                                                                                            x-text="row.joined"
                                                                                            :title="row.joined"></p>
                                                                                        </td>

                                                                                        <!-- Membership -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <span class="text-sm text-gray-700 dark:text-gray-400" x-text="row.membership"></span>
                                                                                        </td>

                                                                                        <!-- DL Type -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <span class="text-sm text-gray-700 dark:text-gray-400" x-text="row.dlType"></span>
                                                                                        </td>

                                                                                        <!-- Status -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                                                                :class="{
                                                                                                    'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': row.status === 'Active',
                                                                                                    'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400': row.status === 'Suspended',
                                                                                                    'bg-error-100 text-error-600 dark:bg-error-900/30 dark:text-error-400': row.status === 'Blacklisted',
                                                                                                    'bg-gray-100 text-gray-600 dark:bg-gray-900/30 dark:text-gray-400': !['Active', 'Suspended', 'Blacklisted'].includes(row.status)
                                                                                                }"
                                                                                                x-text="row.status.charAt(0).toUpperCase() + row.status.slice(1)">
                                                                                            </span>
                                                                                        </td>

                                                                                        <!-- Action -->
                                                                                        <td class="p-4 whitespace-nowrap">
                                                                                            <button @click="window.location.href = `/treasurer/bodaboda/member/${row.memberId}`"
                                                                                                class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                                                <svg class="w-[22px] h-[22px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                                    <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="1.1" d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z"></path>
                                                                                                </svg>
                                                                                            </button>
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
                                                                        <span class="text-gray-800 dark:text-white/90" x-text="rows.length"></span>
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
                                                                            <span class="text-gray-800 dark:text-white/90" x-text="rows.length"></span>
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

                                <div x-show="activeTab === 'membership'" style="display: none;">
                                    <!-- New Members content here -->
                                                    <div class="rounded-xl p-6 dark:border-gray-800" x-data="{ activeTab: 'new-members' }">
                                                        <div class="grid grid-cols-12 gap-4 md:gap-6" x-data="newMemberForm">
                                                            <!-- New member registration -->
                                                            <div class="relative col-span-12 xl:col-span-7">
                                                                <div class="relative justify-between p-4 border-b">
                                                                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                                                                        New member
                                                                    </h3>
                                                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                                        Use the form wizard to add a new bodaboda member.
                                                                    </p>
                                                                </div>
                                                                <div class="flex flex-col justify-between p-4">
                                                                    <form action="" method="POST">
                                                                        <!-- Membership Type -->
                                                                        <div class="mb-6 border p-4">
                                                                            <label class="block text-xl font-semibold text-gray-700 dark:text-gray-400 mb-2">
                                                                                Membership Type
                                                                            </label>
                                                                            <div class="flex gap-4">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-600 dark:text-gray-400">
                                                                                    <input type="radio" name="member_type" id="member_type" value="Member" x-model="memberType" class="mr-2">
                                                                                    <span>Member</span>
                                                                                </label>
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-600 dark:text-gray-400">
                                                                                    <input type="radio" name="member_type" id="member_type" value="Non-Member" x-model="memberType" class="mr-2">
                                                                                    <span>Non-Member</span>
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Progress Bar -->
                                                                        <div class="mb-8">
                                                                            <div class="flex items-center justify-between mb-2">
                                                                                <div class="text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    Step <span x-text="currentStep">1</span> of 3
                                                                                </div>
                                                                                <div class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="getStepTitle()"></div>
                                                                            </div>
                                                                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                                                <div class="bg-brand-500 h-2.5 rounded-full transition-all duration-300"
                                                                                    :style="'width: ' + ((currentStep / 3) * 100) + '%'"></div>
                                                                            </div>
                                                                            <div class="flex justify-between mt-2">
                                                                                <div class="text-sm font-medium" :class="currentStep >= 1 ? 'text-brand-500' : 'text-gray-400'">
                                                                                    Personal Info
                                                                                </div>
                                                                                <div class="text-sm font-medium" :class="currentStep >= 2 ? 'text-brand-500' : 'text-gray-400'">
                                                                                    Next of Kin
                                                                                </div>
                                                                                <div class="text-sm font-medium" :class="currentStep >= 3 ? 'text-brand-500' : 'text-gray-400'">
                                                                                    Identification
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Step 1: Personal Info -->
                                                                        <div x-show="currentStep === 1" class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                                                                            <div class="w-full px-2.5">
                                                                                <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                                                                                    Personal Info
                                                                                </h4>
                                                                            </div>
                                                                            <!-- First Name -->
                                                                            <div class="w-full px-2.5 xl:w-1/2">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    First Name
                                                                                </label>
                                                                                <input type="text" id="personal_first_name" name="personal_first_name" x-model="formData.personal.firstName" @input="clearError('personal.firstName')" @blur="validateField('personal.firstName')" :class="errors.personal?.firstName ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                            </div>

                                                                            <!-- Last Name -->
                                                                            <div class="w-full px-2.5 xl:w-1/2">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    Last Name
                                                                                </label>
                                                                                <input type="text" id="personal_last_name" name="personal_last_name" x-model="formData.personal.lastName" @input="clearError('personal.lastName')" @blur="validateField('personal.lastName')" :class="errors.personal?.lastName ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                            </div>

                                                                            <!-- Email -->
                                                                            <div class="w-full px-2.5">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    Email
                                                                                </label>
                                                                                <input type="email" id="personal_email" name="personal_email" x-model="formData.personal.email" @input="clearError('personal.email')" @blur="validateField('personal.email')" :class="errors.personal?.email ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                            </div>

                                                                            <!-- Primary Phone -->
                                                                            <div class="w-full px-2.5 xl:w-1/2">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    Primary Phone
                                                                                </label>
                                                                                <div class="relative">
                                                                                    <input type="text" id="personal_primary_phone" name="personal_primary_phone" x-model="formData.personal.primaryPhone" @input="clearError('personal.primaryPhone')" @blur="validateField('personal.primaryPhone')" :class="errors.personal?.primaryPhone ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                </div>
                                                                            </div>

                                                                            <!-- Secondary Phone -->
                                                                            <div class="w-full px-2.5 xl:w-1/2">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    Secondary Phone
                                                                                </label>
                                                                                <div class="relative">
                                                                                    <input type="text" id="personal_secondary_phone" name="personal_secondary_phone" x-model="formData.personal.secondaryPhone" @input="clearError('personal.secondaryPhone')" @blur="validateField('personal.secondaryPhone')" :class="errors.personal?.secondaryPhone ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                </div>
                                                                            </div>

                                                                            <!-- Gender -->
                                                                            <div class="w-full px-2.5 xl:w-1/2">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    Gender
                                                                                </label>
                                                                                <div class="relative z-20 bg-transparent">
                                                                                    <select id="personal_gender" name="personal_gender" x-model="formData.personal.gender" @change="clearError('personal.gender')" @blur="validateField('personal.gender')" :class="errors.personal?.gender ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                        <option value="">Select Gender</option>
                                                                                        <option value="Male">Male</option>
                                                                                        <option value="Female">Female</option>
                                                                                    </select>
                                                                                    <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <!-- DoB -->
                                                                            <div class="w-full px-2.5 xl:w-1/2">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    Date of Birth
                                                                                </label>
                                                                                <input type="text" id="personal_dob" name="personal_dob" x-model="formData.personal.dob" @input="clearError('personal.dob')" @blur="validateField('personal.dob')" :class="errors.personal?.dob ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Step 2: Next of Kin -->
                                                                        <div x-show="currentStep === 2" class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                                                                            <div class="w-full px-2.5">
                                                                                <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                                                                                    Next of Kin
                                                                                </h4>
                                                                            </div>
                                                                            <!-- First Name -->
                                                                            <div class="w-full px-2.5 xl:w-1/2">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    First Name
                                                                                </label>
                                                                                <input type="text" id="kin_first_name" name="kin_first_name" x-model="formData.kin.firstName" @input="clearError('kin.firstName')" @blur="validateField('kin.firstName')" :class="errors.kin?.firstName ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                            </div>

                                                                            <!-- Last Name -->
                                                                            <div class="w-full px-2.5 xl:w-1/2">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    Last Name
                                                                                </label>
                                                                                <input type="text" id="kin_last_name" name="kin_last_name" x-model="formData.kin.lastName" @input="clearError('kin.lastName')" @blur="validateField('kin.lastName')" :class="errors.kin?.lastName ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                            </div>

                                                                            <!-- Email -->
                                                                            <div class="w-full px-2.5">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    Email
                                                                                </label>
                                                                                <input type="email" id="kin_email" name="kin_email" x-model="formData.kin.email" @input="clearError('kin.email')" @blur="validateField('kin.email')" :class="errors.kin?.email ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                            </div>

                                                                            <!-- Phone -->
                                                                            <div class="w-full px-2.5 xl:w-1/2">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    Phone
                                                                                </label>
                                                                                <div class="relative">
                                                                                    <input type="text" id="kin_phone" name="kin_phone" x-model="formData.kin.phone" @input="clearError('kin.phone')" @blur="validateField('kin.phone')" :class="errors.kin?.phone ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                </div>
                                                                            </div>

                                                                            <!-- Relationship -->
                                                                            <div class="w-full px-2.5 xl:w-1/2">
                                                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                    Relation
                                                                                </label>
                                                                                <div class="relative z-20 bg-transparent">
                                                                                    <select id="kin_relation" name="kin_relation" x-model="formData.kin.relation" @change="clearError('kin.relation')" @blur="validateField('kin.relation')" :class="errors.kin?.relation ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                        <option value="">Relationship</option>
                                                                                        <option value="Aunt">Aunt</option>
                                                                                        <option value="Brother">Brother</option>
                                                                                        <option value="Cousin">Cousin</option>
                                                                                        <option value="Daughter">Daughter</option>
                                                                                        <option value="Father">Father</option>
                                                                                        <option value="Husband">Husband</option>
                                                                                        <option value="Mother">Mother</option>
                                                                                        <option value="Nephew">Nephew</option>
                                                                                        <option value="Sister">Sister</option>
                                                                                        <option value="Son">Son</option>
                                                                                        <option value="Wife">Wife</option>
                                                                                    </select>
                                                                                    <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Step 3: Identification -->
                                                                        <div x-show="currentStep === 3" class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                                                                            <div class="w-full px-2.5">
                                                                                <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                                                                                    Identification
                                                                                </h4>
                                                                            </div>

                                                                            <!-- Upload ID -->
                                                                            <div class="w-full px-2.5">
                                                                                <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                                                                                    <!-- National Id number -->
                                                                                    <div class="w-full px-2.5">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            National Id number
                                                                                        </label>
                                                                                        <input type="text" id="national_id" name="national_id" x-model="formData.identification.nationalId" @input="clearError('identification.nationalId')" @blur="validateField('identification.nationalId')" :class="errors.identification?.nationalId ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                    </div>
                                                                                    <!-- National ID Front  -->
                                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            National ID Front
                                                                                        </label>
                                                                                        <div class="relative">
                                                                                            <input type="file" id="id_front" name="id_front" class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
                                                                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG or WebP (Max 5MB)</p>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- National ID Back -->
                                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            National ID Back
                                                                                        </label>
                                                                                        <div class="relative">
                                                                                            <input type="file" id="id_back" name="id_back" class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
                                                                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG or WebP (Max 5MB)</p>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Driving License Number -->
                                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            Driving License Number
                                                                                        </label>
                                                                                        <div class="relative">
                                                                                            <input type="text" id="driving_license" name="driving_license" x-model="formData.identification.drivingLicense" @input="clearError('identification.drivingLicense')" @blur="validateField('identification.drivingLicense')" :class="errors.identification?.drivingLicense ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Driving License Type -->
                                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            Driving License Type
                                                                                        </label>
                                                                                        <div class="relative z-20 bg-transparent">
                                                                                            <select id="license_type" name="license_type" x-model="formData.identification.licenseType" @change="clearError('identification.licenseType')" @blur="validateField('identification.licenseType')" :class="errors.identification?.licenseType ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                                <option value="">Driving License Type</option>
                                                                                                <option value="Category A">Category A: Motorcycles and three-wheelers</option>
                                                                                                <option value="Category B">Category B: Light vehicles</option>
                                                                                                <option value="Category C">Category C: For light trucks</option>
                                                                                                <option value="Category D">Category D: PSV</option>
                                                                                            </select>
                                                                                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Navigation Buttons for the form wizard -->
                                                                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-between">
                                                                            <div>
                                                                                <button type="button" x-show="currentStep > 1" @click="prevStep()" class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                                                                    Previous
                                                                                </button>
                                                                            </div>
                                                                            <div class="flex gap-3">
                                                                                <button type="button" x-show="currentStep < 3" @click="nextStep()" class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                                                                                    Next
                                                                                </button>
                                                                                <button type="submit" x-show="currentStep === 3" @click="validateAndSubmit($event)" class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                                                                                    Add Member
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- Member Details Preview -->
                                                            <div class="col-span-12 xl:col-span-5">
                                                                <!-- Preview Header -->
                                                                <div class="relative justify-between p-4 border-b border-gray-200 dark:border-gray-800">
                                                                    <div>
                                                                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white/90">
                                                                            Preview
                                                                        </h3>
                                                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                                            Generated on <span id="current-date">[Current Date]</span>
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <!-- Preview Content Container -->
                                                                <div class="p-4 space-y-8">

                                                                    <!-- Personal Info Section -->
                                                                    <div class="w-full">
                                                                        <div class="flex justify-between items-start border-b border-gray-200 dark:border-gray-800 pb-3">
                                                                            <h4 class="text-base font-medium text-gray-800 dark:text-white/90">
                                                                                Personal Info
                                                                            </h4>
                                                                            <div class="text-right">
                                                                                <div class="text-xs text-gray-500 dark:text-gray-400" x-text="getMembershipType()">MEMBERSHIP: [Type]</div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Personal information Preview -->
                                                                        <div class="mt-4 space-y-4">
                                                                            <!-- Full name and Email tagline -->
                                                                            <div>
                                                                                <h4 class="mb-2 text-center text-medium font-semibold text-gray-600 xl:text-left dark:text-white/90" x-text="getFullName()">
                                                                                    [Full Name]
                                                                                </h4>
                                                                                <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                                                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formData.identification.nationalId || '[National ID number]'">[National ID number]</p>
                                                                                    <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                                                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formData.personal.email || '[Email]'">[Email]</p>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Phone -->
                                                                            <div>
                                                                                <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                                                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formData.personal.primaryPhone || '[Phone 1]'">[Phone 1]</p>
                                                                                    <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                                                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formData.personal.secondaryPhone || '[Phone 2]'">[Phone 2]</p>
                                                                                </div>
                                                                            </div>

                                                                            <!-- DoB Gender -->
                                                                            <div>
                                                                                <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                                                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formData.personal.gender || '[Gender]'">[Gender]</p>
                                                                                    <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                                                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formData.personal.dob || '[Born DoB]'">[Born DoB]</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Next of Kin Section -->
                                                                    <div class="w-full">
                                                                        <div class="flex justify-between items-start border-b border-gray-200 dark:border-gray-800 pb-3">
                                                                            <h4 class="text-base font-medium text-gray-800 dark:text-white/90">
                                                                                Next of Kin
                                                                            </h4>
                                                                        </div>

                                                                        <!-- Next of Kin Preview -->
                                                                        <div class="mt-4 space-y-4">
                                                                            <!-- Full name and Email tagline -->
                                                                            <div>
                                                                                <h4 class="mb-2 text-center text-medium font-semibold text-gray-600 xl:text-left dark:text-white/90" x-text="getKinFullName()">
                                                                                    [Full Name]
                                                                                </h4>
                                                                                <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                                                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formData.kin.phone || '[Phone]'">[Phone]</p>
                                                                                    <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                                                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formData.kin.email || '[Email]'">[Email]</p>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Relation -->
                                                                            <div>
                                                                                <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                                                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formData.kin.relation || '[Relation]'">[Relation]</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Identification Section -->
                                                                    <div class="w-full">
                                                                        <div class="flex justify-between items-start border-b border-gray-200 dark:border-gray-800 pb-3">
                                                                            <h4 class="text-base font-medium text-gray-800 dark:text-white/90">
                                                                                Identification
                                                                            </h4>
                                                                        </div>

                                                                        <!-- Driving License -->
                                                                        <div class="mt-4 space-y-4">
                                                                            <!-- Driving License and Type -->
                                                                            <div>
                                                                                <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                                                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formData.identification.drivingLicense || '[Driving License]'">[Driving License]</p>
                                                                                    <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                                                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formData.identification.licenseType || '[DL Type]'">[DL Type]</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- National ID -->
                                                                        <div class="mt-4">
                                                                            <!-- National ID front back -->
                                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                                <div class="border border-gray-200 dark:border-gray-700 rounded p-4">
                                                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">National ID Front</p>
                                                                                    <div class="flex items-center justify-between mt-2">
                                                                                        <span class="text-sm text-gray-700 dark:text-gray-300">Status:</span>
                                                                                        <span class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                                                                                            [Pending Upload]
                                                                                        </span>
                                                                                    </div>
                                                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Format: PNG, JPG, WebP (Max 5MB)</p>
                                                                                </div>
                                                                                <div class="border border-gray-200 dark:border-gray-700 rounded p-4">
                                                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">National ID Back</p>
                                                                                    <div class="flex items-center justify-between mt-2">
                                                                                        <span class="text-sm text-gray-700 dark:text-gray-300">Status:</span>
                                                                                        <span class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                                                                                            [Pending Upload]
                                                                                        </span>
                                                                                    </div>
                                                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Format: PNG, JPG, WebP (Max 5MB)</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <!-- Footer Section -->
                                                                <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-6">
                                                                    <div class="flex justify-between items-center px-4">
                                                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                                                            <p>This is a system-generated preview report.</p>
                                                                            <p class="mt-1">All information is subject to verification and approval.</p>
                                                                        </div>
                                                                        <div class="text-right">
                                                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                                                Page 1 of 1
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

    <!-- Members Alpine ------------------------------------------------------------------------ -->
    <script>

        function memberTableFull() {
            return {
                rows: [],
                selected: [],
                selectAll: false,
                sort: { key: "joined", asc: true },
                page: 1,
                perPage: 10,
                isLoading: true,
                hasError: false,
                totalMembers: 0,

                // New stats properties
                activeMembers: 0,
                pendingMembers: 0,
                suspendedMembers: 0,
                isLoadingStats: true,

                // Filter variables
                searchQuery: "",
                membershipFilter: "All",  // Separate for Member/Non-Member
                statusFilter: "All",       // Separate for Active/Suspended/Blacklisted

                init() {
                    this.loadMembers();
                    this.fetchTotalMembers();
                    this.fetchMemberStats();
                },

                loadMembers() {
                    this.isLoading = true;
                    this.hasError = false;

                    fetch('/members/all')
                        .then(response => response.json())
                        .then(data => {
                            if (data.data) {
                                this.rows = data.data.map(member => ({
                                    id: member.memberId || member.id,
                                    memberId: member.memberId,
                                    member: `${member.firstname || ''} ${member.lastname || ''}`.trim(),
                                    memberEmail: member.email || '',
                                    phone: member.phone1 || '',
                                    lastContribution: member.last_contribution_amount ?
                                        `KES ${parseFloat(member.last_contribution_amount).toFixed(2)}` : 'KES 0.00',
                                    lastContributionDate: member.last_contribution_date ?
                                        new Date(member.last_contribution_date).toLocaleDateString('en-US', {
                                            day: '2-digit',
                                            month: 'short',
                                            year: 'numeric'
                                        }) : '',
                                    lastContributionTime: member.last_contribution_date ?
                                        new Date(member.last_contribution_date).toLocaleTimeString('en-US', {
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        }) : '',
                                    joined: member.created_on || member.created_at ?
                                        new Date(member.created_on || member.created_at).toLocaleDateString('en-US', {
                                            day: '2-digit',
                                            month: 'short',
                                            year: 'numeric',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        }) : '',
                                    membership: member.membership || 'Non-Member',
                                    dlType: member.identification?.driving_license_type || 'N/A',
                                    status: member.status || 'Active'
                                }));
                            }
                            this.isLoading = false;
                        })
                        .catch(error => {
                            console.error('Error loading members:', error);
                            this.hasError = true;
                            this.isLoading = false;
                        });
                },

                async fetchTotalMembers() {
                    try {
                        const response = await fetch('/members/count');
                        const data = await response.json();
                        this.totalMembers = data.count || 0;
                    } catch (error) {
                        console.error('Error fetching member count:', error);
                        this.totalMembers = 0;
                    }
                },

                // New method to fetch all member stats at once
                async fetchMemberStats() {
                    this.isLoadingStats = true;
                    try {
                        const response = await fetch('/members/counts/all');
                        const data = await response.json();
                        this.activeMembers = data.active || 0;
                        this.pendingMembers = data.pending || 0;
                        this.suspendedMembers = data.suspended || 0;
                        this.totalMembers = data.total || 0; // Update total as well
                    } catch (error) {
                        console.error('Error fetching member stats:', error);
                        this.activeMembers = 0;
                        this.pendingMembers = 0;
                        this.suspendedMembers = 0;
                    } finally {
                        this.isLoadingStats = false;
                    }
                },

                // Individual fetch methods if needed
                async fetchActiveMembers() {
                    try {
                        const response = await fetch('/members/count/active');
                        const data = await response.json();
                        this.activeMembers = data.count || 0;
                    } catch (error) {
                        console.error('Error fetching active members:', error);
                        this.activeMembers = 0;
                    }
                },

                async fetchPendingMembers() {
                    try {
                        const response = await fetch('/members/count/pending');
                        const data = await response.json();
                        this.pendingMembers = data.count || 0;
                    } catch (error) {
                        console.error('Error fetching pending members:', error);
                        this.pendingMembers = 0;
                    }
                },

                async fetchSuspendedMembers() {
                    try {
                        const response = await fetch('/members/count/suspended');
                        const data = await response.json();
                        this.suspendedMembers = data.count || 0;
                    } catch (error) {
                        console.error('Error fetching suspended members:', error);
                        this.suspendedMembers = 0;
                    }
                },

                // Filtered rows based on search, membership, AND status
                get filteredRows() {
                    let filtered = this.rows;

                    // Apply membership filter (Member/Non-Member)
                    if (this.membershipFilter !== "All") {
                        filtered = filtered.filter(row => row.membership === this.membershipFilter);
                    }

                    // Apply status filter (Active/Suspended/Blacklisted)
                    if (this.statusFilter !== "All") {
                        filtered = filtered.filter(row => row.status === this.statusFilter);
                    }

                    // Apply search filter
                    if (this.searchQuery.trim()) {
                        const query = this.searchQuery.toLowerCase().trim();
                        filtered = filtered.filter(row => {
                            // Search in member name
                            if (row.member.toLowerCase().includes(query)) {
                                return true;
                            }
                            // Search in memberId
                            if (row.memberId && row.memberId.toString().toLowerCase().includes(query)) {
                                return true;
                            }
                            // Search in phone
                            const phoneCleaned = row.phone.replace(/[\s+]/g, '').toLowerCase();
                            const queryCleaned = query.replace(/[\s+]/g, '');
                            if (phoneCleaned.includes(queryCleaned)) {
                                return true;
                            }
                            // Search in email
                            if (row.memberEmail.toLowerCase().includes(query)) {
                                return true;
                            }
                            return false;
                        });
                    }

                    return filtered;
                },

                get totalPages() {
                    return Math.ceil(this.filteredRows.length / this.perPage) || 1;
                },

                get paginatedRows() {
                    return this.sortedRows.slice(
                        (this.page - 1) * this.perPage,
                        this.page * this.perPage
                    );
                },

                get sortedRows() {
                    return this.filteredRows.slice().sort((a, b) => {
                        let valA = a[this.sort.key];
                        let valB = b[this.sort.key];
                        if (typeof valA === "string") valA = valA.toLowerCase();
                        if (typeof valB === "string") valB = valB.toLowerCase();
                        if (valA < valB) return this.sort.asc ? -1 : 1;
                        if (valA > valB) return this.sort.asc ? 1 : -1;
                        return 0;
                    });
                },

                performSearch() {
                    this.page = 1; // Reset to first page when searching
                },

                performFilter() {
                    this.page = 1; // Reset to first page when filtering
                },

                sortBy(key) {
                    if (this.sort.key === key) {
                        this.sort.asc = !this.sort.asc;
                    } else {
                        this.sort.key = key;
                        this.sort.asc = true;
                    }
                    this.page = 1;
                },

                toggleSelectAll() {
                    if (this.selectAll) {
                        this.selected = this.paginatedRows.map((t) => t.id);
                    } else {
                        this.selected = [];
                    }
                },

                updateSelectAll() {
                    this.selectAll = this.paginatedRows.every((row) =>
                        this.selected.includes(row.id)
                    );
                },

                get startEntry() {
                    return this.filteredRows.length === 0 ? 0 : (this.page - 1) * this.perPage + 1;
                },

                get endEntry() {
                    let end = this.page * this.perPage;
                    return end > this.filteredRows.length ? this.filteredRows.length : end;
                },

                goToPage(n) {
                    if (n >= 1 && n <= this.totalPages) this.page = n;
                },

                dropdown() {
                    return {
                        open: false,
                        toggle() {
                            this.open = !this.open;
                        }
                    };
                },

                // NEW: Print function for members report
                printMembersReport() {
                    // Create a new window for printing
                    const printWindow = window.open('', '_blank');

                    // Get current filtered and paginated data
                    const currentData = this.paginatedRows;

                    // Generate table rows HTML
                    const tableRows = currentData.map(row => `
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${row.memberId || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">
                                <div><strong>${row.member || 'N/A'}</strong></div>
                                <div style="font-size: 12px; color: #6b7280;">${row.memberEmail || 'N/A'}</div>
                            </td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${row.phone || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${row.membership || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">
                                <div><strong>${row.lastContribution || 'KES 0.00'}</strong></div>
                                <div style="font-size: 12px; color: #6b7280;">${row.lastContributionDate || ''} ${row.lastContributionTime || ''}</div>
                            </td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${row.dlType || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">
                                <span style="display: inline-block; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500;
                                    ${row.status === 'Active' ? 'background-color: #d1fae5; color: #065f46;' :
                                    row.status === 'Suspended' ? 'background-color: #fed7aa; color: #92400e;' :
                                    row.status === 'Blacklisted' ? 'background-color: #fee2e2; color: #991b1b;' :
                                    'background-color: #f3f4f6; color: #1f2937;'}">
                                    ${row.status || 'N/A'}
                                </span>
                            </td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${row.joined || 'N/A'}</td>
                        </tr>
                    `).join('');

                    // Write the print document
                    printWindow.document.write(`
                        <html>
                        <head>
                            <title>Members Report</title>
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
                            <h1>Members Report</h1>
                            <div class="header">
                                <div>Generated on: ${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}</div>
                                <div>Filters: Membership - ${this.membershipFilter}, Status - ${this.statusFilter}</div>
                                <div>Showing ${this.startEntry} to ${this.endEntry} of ${this.filteredRows.length} members</div>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Member</th>
                                        <th>Phone</th>
                                        <th>Membership</th>
                                        <th>Last Contribution</th>
                                        <th>DL Type</th>
                                        <th>Status</th>
                                        <th>Joined</th>
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

    </script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('newMemberForm', () => ({
                // Existing properties
                currentStep: 1,
                memberType: '',
                formData: {
                    personal: {
                        firstName: '',
                        lastName: '',
                        email: '',
                        primaryPhone: '',
                        secondaryPhone: '',
                        gender: '',
                        dob: ''
                    },
                    kin: {
                        firstName: '',
                        lastName: '',
                        email: '',
                        phone: '',
                        relation: ''
                    },
                    identification: {
                        nationalId: '',
                        drivingLicense: '',
                        licenseType: ''
                    }
                },
                errors: {},

                // Existing methods
                getStepTitle() {
                    const titles = {
                        1: 'Personal Info',
                        2: 'Next of Kin',
                        3: 'Identification'
                    };
                    return titles[this.currentStep];
                },

                nextStep() {
                    // Validate current step before proceeding
                    if (this.currentStep === 1) {
                        if (!this.validatePersonalInfo()) {
                            return false;
                        }
                    } else if (this.currentStep === 2) {
                        if (!this.validateNextOfKin()) {
                            return false;
                        }
                    }

                    if (this.currentStep < 3) {
                        this.currentStep++;
                    }
                    return true;
                },

                prevStep() {
                    if (this.currentStep > 1) {
                        this.currentStep--;
                    }
                },

                // NEW VALIDATION METHODS
                // Phone validation for Kenya numbers
                validatePhone(phone) {
                    if (!phone) return false;

                    // Remove spaces and special characters
                    const cleanPhone = phone.replace(/[\s\-+]/g, '');

                    // Validate Kenya phone formats:
                    // 07XX xxxxxx or 2547XX xxxxxx or +2547XX xxxxxx (for 7 series)
                    // 01XX xxxxxx or 2541XX xxxxxx or +2541XX xxxxxx (for 1 series)
                    const phoneRegex = /^(07[0-9]{8}|2547[0-9]{8}|\+2547[0-9]{8}|01[0-9]{8}|2541[0-9]{8}|\+2541[0-9]{8})$/;
                    return phoneRegex.test(cleanPhone);
                },

                // Email validation
                validateEmail(email) {
                    if (!email) return false;
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailRegex.test(email);
                },

                // Date of Birth validation (D-mm-yyyy)
                validateDOB(dob) {
                    if (!dob) return false;
                    const dobRegex = /^\d{1,2}-\d{2}-\d{4}$/;
                    if (!dobRegex.test(dob)) return false;

                    // Additional date validation
                    const parts = dob.split('-');
                    const day = parseInt(parts[0], 10);
                    const month = parseInt(parts[1], 10) - 1; // Months are 0-indexed
                    const year = parseInt(parts[2], 10);

                    const date = new Date(year, month, day);
                    return date.getFullYear() === year &&
                        date.getMonth() === month &&
                        date.getDate() === day &&
                        date <= new Date(); // Date should not be in future
                },

                // Personal Info validation
                validatePersonalInfo() {
                    const personal = this.formData.personal;
                    let errorMessage = '';

                    // Check required fields
                    if (!personal.firstName?.trim()) {
                        errorMessage += '• First Name is required\n';
                    }
                    if (!personal.lastName?.trim()) {
                        errorMessage += '• Last Name is required\n';
                    }
                    if (!personal.email?.trim()) {
                        errorMessage += '• Email is required\n';
                    } else if (!this.validateEmail(personal.email)) {
                        errorMessage += '• Please enter a valid email address\n';
                    }
                    if (!personal.primaryPhone?.trim()) {
                        errorMessage += '• Primary Phone is required\n';
                    } else if (!this.validatePhone(personal.primaryPhone)) {
                        errorMessage += '• Primary Phone must be a valid Kenya number (format: 07XX xxxxxx, 2547XX xxxxxx, +2547XX xxxxxx, 01XX xxxxxx, 2541XX xxxxxx, or +2541XX xxxxxx)\n';
                    }
                    if (personal.secondaryPhone?.trim() && !this.validatePhone(personal.secondaryPhone)) {
                        errorMessage += '• Secondary Phone must be a valid Kenya number (format: 07XX xxxxxx, 2547XX xxxxxx, +2547XX xxxxxx, 01XX xxxxxx, 2541XX xxxxxx, or +2541XX xxxxxx)\n';
                    }
                    if (!personal.gender) {
                        errorMessage += '• Gender is required\n';
                    }
                    if (!personal.dob?.trim()) {
                        errorMessage += '• Date of Birth is required\n';
                    } else if (!this.validateDOB(personal.dob)) {
                        errorMessage += '• Date of Birth must be in format D-mm-yyyy and be a valid date\n';
                    }

                    if (errorMessage) {
                        alert('Please fix the following errors in Personal Info:\n\n' + errorMessage);
                        return false;
                    }
                    return true;
                },

                // Next of Kin validation
                validateNextOfKin() {
                    const kin = this.formData.kin;
                    let errorMessage = '';

                    if (!kin.firstName?.trim()) {
                        errorMessage += '• First Name is required\n';
                    }
                    if (!kin.lastName?.trim()) {
                        errorMessage += '• Last Name is required\n';
                    }
                    if (!kin.email?.trim()) {
                        errorMessage += '• Email is required\n';
                    } else if (!this.validateEmail(kin.email)) {
                        errorMessage += '• Please enter a valid email address\n';
                    }
                    if (!kin.phone?.trim()) {
                        errorMessage += '• Phone is required\n';
                    } else if (!this.validatePhone(kin.phone)) {
                        errorMessage += '• Phone must be a valid Kenya number (format: 07XX xxxxxx, 2547XX xxxxxx, +2547XX xxxxxx, 01XX xxxxxx, 2541XX xxxxxx, or +2541XX xxxxxx)\n';
                    }
                    if (!kin.relation) {
                        errorMessage += '• Relationship is required\n';
                    }

                    if (errorMessage) {
                        alert('Please fix the following errors in Next of Kin:\n\n' + errorMessage);
                        return false;
                    }
                    return true;
                },

                // Identification validation
                validateIdentification() {
                    const identification = this.formData.identification;
                    let errorMessage = '';

                    // Check if member type is selected
                    if (!this.memberType) {
                        alert('Please select Membership Type (Member or Non-Member)');
                        return false;
                    }

                    // Validate identification fields
                    if (!identification.nationalId?.trim()) {
                        errorMessage += '• National ID number is required\n';
                    }
                    if (!identification.drivingLicense?.trim()) {
                        errorMessage += '• Driving License Number is required\n';
                    }
                    if (!identification.licenseType) {
                        errorMessage += '• Driving License Type is required\n';
                    }

                    if (errorMessage) {
                        alert('Please fix the following errors in Identification:\n\n' + errorMessage);
                        return false;
                    }
                    return true;
                },

                // Field validation for individual fields
                validateField(fieldPath) {
                    // This can be expanded for real-time validation if needed
                    // For now, we'll just clear errors on blur
                    this.clearError(fieldPath);
                },

                clearError(fieldPath) {
                    // Remove error from the errors object
                    const pathParts = fieldPath.split('.');
                    if (pathParts.length === 2) {
                        const [section, field] = pathParts;
                        if (this.errors[section] && this.errors[section][field]) {
                            delete this.errors[section][field];
                        }
                    }
                },

                // Form submission validation and handling with file uploads
                async validateAndSubmit(event) {
                    event.preventDefault();

                    // Validate all steps
                    if (!this.validatePersonalInfo()) {
                        this.currentStep = 1;
                        return false;
                    }

                    if (!this.validateNextOfKin()) {
                        this.currentStep = 2;
                        return false;
                    }

                    if (!this.validateIdentification()) {
                        this.currentStep = 3;
                        return false;
                    }

                    // Get form files
                    const idFrontFile = document.getElementById('id_front').files[0];
                    const idBackFile = document.getElementById('id_back').files[0];

                    // Validate files
                    if (!idFrontFile) {
                        alert('Please upload National ID Front image');
                        return false;
                    }
                    if (!idBackFile) {
                        alert('Please upload National ID Back image');
                        return false;
                    }

                    // Validate file types and size
                    const validTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
                    const maxSize = 5 * 1024 * 1024; // 5MB

                    if (!validTypes.includes(idFrontFile.type)) {
                        alert('National ID Front must be PNG, JPG, or WebP format');
                        return false;
                    }
                    if (idFrontFile.size > maxSize) {
                        alert('National ID Front must be less than 5MB');
                        return false;
                    }

                    if (!validTypes.includes(idBackFile.type)) {
                        alert('National ID Back must be PNG, JPG, or WebP format');
                        return false;
                    }
                    if (idBackFile.size > maxSize) {
                        alert('National ID Back must be less than 5MB');
                        return false;
                    }

                    // Get the submit button - FIXED: Use event.currentTarget instead of querySelector
                    const submitBtn = event.currentTarget; // This is the button itself
                    const originalText = submitBtn.textContent;

                    // Change button text to show loading state IMMEDIATELY
                    submitBtn.textContent = 'Adding Member...';
                    submitBtn.disabled = true;

                    try {
                        // Create FormData for file uploads
                        const formData = new FormData();

                        // Get the form element
                        const formElement = submitBtn.closest('form');

                        // Add form data
                        formData.append('personal[firstName]', this.formData.personal.firstName);
                        formData.append('personal[lastName]', this.formData.personal.lastName);
                        formData.append('personal[email]', this.formData.personal.email);
                        formData.append('personal[primaryPhone]', this.formData.personal.primaryPhone);
                        formData.append('personal[secondaryPhone]', this.formData.personal.secondaryPhone || '');
                        formData.append('personal[gender]', this.formData.personal.gender);
                        formData.append('personal[dob]', this.formData.personal.dob);

                        formData.append('kin[firstName]', this.formData.kin.firstName);
                        formData.append('kin[lastName]', this.formData.kin.lastName);
                        formData.append('kin[email]', this.formData.kin.email);
                        formData.append('kin[phone]', this.formData.kin.phone);
                        formData.append('kin[relation]', this.formData.kin.relation);

                        formData.append('identification[nationalId]', this.formData.identification.nationalId);
                        formData.append('identification[drivingLicense]', this.formData.identification.drivingLicense);
                        formData.append('identification[licenseType]', this.formData.identification.licenseType);

                        formData.append('memberType', this.memberType);

                        // Add files
                        formData.append('id_front', idFrontFile);
                        formData.append('id_back', idBackFile);

                        // Get CSRF token
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        // Send data to server
                        const response = await fetch('{{ route("treasurer.bodaboda.addMember") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        // WAIT FOR 0.75 SECONDS - Button already shows "Adding Member..." at this point
                        await new Promise(resolve => setTimeout(resolve, 750));

                        const result = await response.json();

                        // Show alert with response message
                        alert(result.message);

                        // Redirect on success
                        if (result.success) {
                            window.location.href = result.redirect;
                        } else {
                            // Show validation errors if any
                            if (result.errors) {
                                let errorMessages = 'Please fix the following errors:\n\n';
                                Object.keys(result.errors).forEach(key => {
                                    if (typeof result.errors[key] === 'object') {
                                        Object.keys(result.errors[key]).forEach(nestedKey => {
                                            errorMessages += `• ${result.errors[key][nestedKey].join(', ')}\n`;
                                        });
                                    } else {
                                        errorMessages += `• ${result.errors[key].join(', ')}\n`;
                                    }
                                });
                                alert(errorMessages);
                            }
                        }

                    } catch (error) {
                        console.error('Error:', error);
                        alert('Network error: Failed to add member. Please try again.');

                    } finally {
                        // Restore button state (only if not redirecting)
                        if (!window.location.href.includes('redirect')) {
                            submitBtn.textContent = originalText;
                            submitBtn.disabled = false;
                        }
                    }
                },

                // Get formatted membership type
                getMembershipType() {
                    if (!this.memberType) return 'MEMBERSHIP: [Not Selected]';
                    return `MEMBERSHIP: ${this.memberType === 'member' ? 'Member' : 'Non-Member'}`;
                },

                // Get full name for personal info
                getFullName() {
                    const firstName = this.formData.personal.firstName || '';
                    const lastName = this.formData.personal.lastName || '';

                    if (!firstName && !lastName) return '[Full Name]';
                    return `${firstName} ${lastName}`.trim();
                },

                // Get full name for next of kin
                getKinFullName() {
                    const firstName = this.formData.kin.firstName || '';
                    const lastName = this.formData.kin.lastName || '';

                    if (!firstName && !lastName) return '[Full Name]';
                    return `${firstName} ${lastName}`.trim();
                },

                // Optional: Add current date display (if you want to show real date)
                getCurrentDate() {
                    const now = new Date();
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    return now.toLocaleDateString('en-US', options);
                },

            }));
        });
    </script>

</body>

</html>
