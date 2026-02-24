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
        <aside :class="sidebarToggle ? 'translate-x-0 xl:w-[90px]' : '-translate-x-full'"
                        class="sidebar fixed top-0 left-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-auto border-r border-gray-200 bg-white px-5 transition-all duration-300 xl:static xl:translate-x-0 dark:border-gray-800 dark:bg-black"
                        @click.outside="sidebarToggle = false">

                        <!-- SIDEBAR HEADER -->
                        <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
                            class="sidebar-header flex items-center gap-2 pt-8 pb-7">
                            <a href="{{ route('treasurer.dashboard') }}" class="flex items-center">
                                <!-- Small Circular Logo with Border -->
                                <div class="h-10 w-10 rounded-full bg-gray-100 border-2 border-dark-brown flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('company_logo.png') }}" alt="KFBCL Logo" class="h-full w-full object-cover">
                                </div>

                                <!-- Company Name and Tagline (Hidden when sidebar collapsed on desktop) -->
                                <div class="ml-3" :class="sidebarToggle ? 'hidden xl:block' : 'block'">
                                    <h2 class="text-lg font-bold text-dark-brown">KFBCL</h2>
                                    <p class="text-xs text-gray-500">Growing together</p>
                                </div>
                            </a>
                        </div>
                        <!-- SIDEBAR HEADER -->

                        <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
                        <!-- Sidebar Menu -->
                        <nav x-data="{selected: $persist('Dashboard')}">
                            <!-- Menu Group -->
                            <div>
                                <h3 class="mb-4 text-xs leading-[20px] text-gray-400 uppercase">
                                    <span class="menu-group-title"
                                        :class="sidebarToggle ? 'xl:hidden' : ''">
                                    MENU
                                    </span>
                                    <svg
                                            :class="sidebarToggle ? 'xl:block hidden' : 'hidden'"
                                            class="menu-group-icon mx-auto fill-current"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                    <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                            fill="currentColor"
                                    />
                                    </svg>
                                </h3>

                                <ul class="mb-6 flex flex-col gap-1">
                                    <!-- Menu Item Dashboard -->
                                    <li>
                                        <a href="{{ route('treasurer.dashboard') }}" @click="selected = (selected === 'Dashboard' ? '':'Dashboard')" class="menu-item group"
                                            :class=" (selected === 'Dashboard') || (page === 'dashboard') ? 'menu-item-active' : 'menu-item-inactive'">
                                            <svg :class="(selected === 'Dashboard') || (page === 'dashboard') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                                    fill="currentColor"/>
                                            </svg>
                                            <span class="menu-item-text"
                                                :class="sidebarToggle ? 'xl:hidden' : ''">Dashboard</span>
                                        </a>
                                    </li>

                                    <!-- Menu Item Appointments -->
                                    <li>
                                        <a href="{{ route('treasurer.appointments') }}" @click="selected = (selected === 'Appointments' ? '':'Appointments')" class="menu-item group"
                                            :class="(selected === 'Appointments') || (page === 'appointments') ? 'menu-item-active' : 'menu-item-inactive'">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                            <path d="M16 3l0 4" />
                                            <path d="M8 3l0 4" />
                                            <path d="M4 11l16 0" />
                                            <path d="M8 15h2v2h-2z" />
                                            </svg>
                                            <span class="menu-item-text"
                                                :class="sidebarToggle ? 'xl:hidden' : ''">Appointments</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Manage Group -->
                            <div>
                                <h3 class="mb-4 text-xs leading-[20px] text-gray-400 uppercase">
                                <span class="menu-group-title"
                                        :class="sidebarToggle ? 'xl:hidden' : ''">MANAGE</span>
                                    <svg
                                            :class="sidebarToggle ? 'xl:block hidden' : 'hidden'"
                                            class="menu-group-icon mx-auto fill-current"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                    <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                            fill="currentColor"
                                    />
                                    </svg>
                                </h3>

                                <ul class="mb-6 flex flex-col gap-1">
                                    <!-- Menu Item Users -->
                                    <li>
                                        <a href="{{ route('treasurer.users') }}" @click="selected = (selected === 'Users' ? '':'Users')" class="menu-item group"
                                            :class=" (selected === 'Users') || (page === 'users') ? 'menu-item-active' : 'menu-item-inactive'">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                            </svg>
                                            <span class="menu-item-text"
                                                :class="sidebarToggle ? 'xl:hidden' : ''">Users</span>
                                        </a>
                                    </li>

                                    <!-- Menu Item Bodaboda Group -->
                                    <li>
                                        <a href="{{ route('treasurer.bodaboda') }}" @click="selected = (selected === 'Bodaboda Group' ? '':'Bodaboda Group')" class="menu-item group"
                                            :class=" (selected === 'Bodaboda Group') || (page === 'bodaboda') ? 'menu-item-active' : 'menu-item-inactive'">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-motorbike">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                            <path d="M19 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                            <path d="M7.5 14h5l4 -4h-10.5m1.5 4l4 -4" />
                                            <path d="M13 6h2l1.5 3l2 4" />
                                            </svg>
                                            <span class="menu-item-text"
                                                :class="sidebarToggle ? 'xl:hidden' : ''">Bodaboda Group</span>
                                        </a>
                                    </li>

                                    <!-- Menu Item Loans -->
                                    <li>
                                        <a href="{{ route('treasurer.loans') }}" @click="selected = (selected === 'Loans' ? '':'Loans')" class="menu-item group"
                                            :class="(selected === 'Loans') || (page === 'loans') ? 'menu-item-active' : 'menu-item-inactive'">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card"
                                            >
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                            <path d="M3 10l18 0" />
                                            <path d="M7 15l.01 0" />
                                            <path d="M11 15l2 0" />
                                            </svg>
                                            <span class="menu-item-text"
                                                :class="sidebarToggle ? 'xl:hidden' : ''">Loans</span>
                                        </a>
                                    </li>

                                    <!-- Menu Item Real-Estate -->
                                    <li>
                                        <a href="{{ route('treasurer.real.estate') }}" @click="selected = (selected === 'Real Estate' ? '':'Real Estate')" class="menu-item group"
                                            :class="(selected === 'Real Estate') || (page === 'real estate') ? 'menu-item-active' : 'menu-item-inactive'">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 21l18 0" />
                                            <path d="M9 8l1 0" />
                                            <path d="M9 12l1 0" />
                                            <path d="M9 16l1 0" />
                                            <path d="M14 8l1 0" />
                                            <path d="M14 12l1 0" />
                                            <path d="M14 16l1 0" />
                                            <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
                                            </svg>
                                            <span class="menu-item-text"
                                                :class="sidebarToggle ? 'xl:hidden' : ''">Real Estate</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Settings Group -->
                            <div>
                            <h3 class="mb-4 text-xs leading-[20px] text-gray-400 uppercase">
                            <span class="menu-group-title"
                            :class="sidebarToggle ? 'xl:hidden' : ''">SETTINGS</span>
                                <svg
                                        :class="sidebarToggle ? 'xl:block hidden' : 'hidden'"
                                        class="menu-group-icon mx-auto fill-current"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                >
                                <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                        fill="currentColor"
                                />
                                </svg>
                            </h3>

                            <ul class="mb-6 flex flex-col gap-1">
                                <!-- Menu Item Profile -->
                                <li>
                                    <a href="{{ route('profile') }}" @click="selected = (selected === 'Profile' ? '':'Profile')"
                                        class="menu-item group"
                                        :class=" (selected === 'Profile') && (page === 'profile') ? 'menu-item-active' : 'menu-item-inactive'">
                                        <svg
                                                :class="(selected === 'Profile') && (page === 'profile') ?  'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z"
                                                fill="currentColor"
                                        />
                                        </svg>
                                        <span class="menu-item-text"
                                            :class="sidebarToggle ? 'xl:hidden' : ''">Profile</span>
                                    </a>
                                </li>
                            </ul>
                            </div>

                            <!-- Logout Item -->
                            <div class="mt-auto">
                                <ul class="flex flex-col gap-1">
                                    <li>
                                    <form action="{{ route('signout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" @click="selected = (selected === 'Logout' ? '':'Logout')" class="menu-item group menu-item-inactive flex items-center w-full text-left" :class="(selected === 'Logout') ? 'menu-item-active' : 'menu-item-inactive'">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2"></path>
                                            <path d="M15 12h-12l3 -3"></path>
                                            <path d="M6 15l-3 -3"></path>
                                            </svg>
                                            <span class="menu-item-text ml-3" :class="sidebarToggle ? 'xl:hidden' : ''">Logout</span>
                                        </button>
                                    </form>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <!-- Sidebar Menu -->
                        </div>

        </aside>
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
                <header x-data="{menuToggle: false}"
                        class="sticky top-0 z-99999 flex w-full border-gray-200 bg-white xl:border-b dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex grow flex-col items-center justify-between xl:flex-row xl:px-6">
                    <div class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:py-4 xl:justify-normal xl:border-b-0 xl:px-0 dark:border-gray-800">
                        <!-- Hamburger Toggle BTN -->
                        <button :class="sidebarToggle ? 'xl:bg-transparent dark:xl:bg-transparent bg-gray-100 dark:bg-gray-800' : ''"
                                class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg border-gray-200 text-gray-500 xl:h-11 xl:w-11 xl:border dark:border-gray-800 dark:text-gray-400"
                                @click.stop="sidebarToggle = !sidebarToggle">
                        <svg
                                class="hidden fill-current xl:block"
                                width="16"
                                height="12"
                                viewBox="0 0 16 12"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M0.583252 1C0.583252 0.585788 0.919038 0.25 1.33325 0.25H14.6666C15.0808 0.25 15.4166 0.585786 15.4166 1C15.4166 1.41421 15.0808 1.75 14.6666 1.75L1.33325 1.75C0.919038 1.75 0.583252 1.41422 0.583252 1ZM0.583252 11C0.583252 10.5858 0.919038 10.25 1.33325 10.25L14.6666 10.25C15.0808 10.25 15.4166 10.5858 15.4166 11C15.4166 11.4142 15.0808 11.75 14.6666 11.75L1.33325 11.75C0.919038 11.75 0.583252 11.4142 0.583252 11ZM1.33325 5.25C0.919038 5.25 0.583252 5.58579 0.583252 6C0.583252 6.41421 0.919038 6.75 1.33325 6.75L7.99992 6.75C8.41413 6.75 8.74992 6.41421 8.74992 6C8.74992 5.58579 8.41413 5.25 7.99992 5.25L1.33325 5.25Z"
                                    fill=""
                            />
                        </svg>

                        <svg
                                :class="sidebarToggle ? 'hidden' : 'block xl:hidden'"
                                class="fill-current xl:hidden"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M3.25 6C3.25 5.58579 3.58579 5.25 4 5.25L20 5.25C20.4142 5.25 20.75 5.58579 20.75 6C20.75 6.41421 20.4142 6.75 20 6.75L4 6.75C3.58579 6.75 3.25 6.41422 3.25 6ZM3.25 18C3.25 17.5858 3.58579 17.25 4 17.25L20 17.25C20.4142 17.25 20.75 17.5858 20.75 18C20.75 18.4142 20.4142 18.75 20 18.75L4 18.75C3.58579 18.75 3.25 18.4142 3.25 18ZM4 11.25C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75L12 12.75C12.4142 12.75 12.75 12.4142 12.75 12C12.75 11.5858 12.4142 11.25 12 11.25L4 11.25Z"
                                    fill=""
                            />
                        </svg>

                        <!-- cross icon -->
                        <svg
                                :class="sidebarToggle ? 'block xl:hidden' : 'hidden'"
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
                                    d="M6.21967 7.28131C5.92678 6.98841 5.92678 6.51354 6.21967 6.22065C6.51256 5.92775 6.98744 5.92775 7.28033 6.22065L11.999 10.9393L16.7176 6.22078C17.0105 5.92789 17.4854 5.92788 17.7782 6.22078C18.0711 6.51367 18.0711 6.98855 17.7782 7.28144L13.0597 12L17.7782 16.7186C18.0711 17.0115 18.0711 17.4863 17.7782 17.7792C17.4854 18.0721 17.0105 18.0721 16.7176 17.7792L11.999 13.0607L7.28033 17.7794C6.98744 18.0722 6.51256 18.0722 6.21967 17.7794C5.92678 17.4865 5.92678 17.0116 6.21967 16.7187L10.9384 12L6.21967 7.28131Z"
                                    fill=""
                            />
                        </svg>
                        </button>
                        <!-- Hamburger Toggle BTN -->

                        <a href="{{ route('treasurer.dashboard') }}" class="xl:hidden">
                        <img class="dark:hidden" src="{{ asset('company_logo.png') }}" alt="Logo" />
                        <img
                                class="hidden dark:block"
                                src="{{ asset('company_logo.png') }}"
                                alt="Logo"
                        />
                        </a>

                        <!-- Application nav menu button -->
                        <button class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 hover:bg-gray-100 xl:hidden dark:text-gray-400 dark:hover:bg-gray-800"
                                :class="menuToggle ? 'bg-gray-100 dark:bg-gray-800' : ''"
                                @click.stop="menuToggle = !menuToggle">
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
                                    d="M5.99902 10.4951C6.82745 10.4951 7.49902 11.1667 7.49902 11.9951V12.0051C7.49902 12.8335 6.82745 13.5051 5.99902 13.5051C5.1706 13.5051 4.49902 12.8335 4.49902 12.0051V11.9951C4.49902 11.1667 5.1706 10.4951 5.99902 10.4951ZM17.999 10.4951C18.8275 10.4951 19.499 11.1667 19.499 11.9951V12.0051C19.499 12.8335 18.8275 13.5051 17.999 13.5051C17.1706 13.5051 16.499 12.8335 16.499 12.0051V11.9951C16.499 11.1667 17.1706 10.4951 17.999 10.4951ZM13.499 11.9951C13.499 11.1667 12.8275 10.4951 11.999 10.4951C11.1706 10.4951 10.499 11.1667 10.499 11.9951V12.0051C10.499 12.8335 11.1706 13.5051 11.999 13.5051C12.8275 13.5051 13.499 12.8335 13.499 12.0051V11.9951Z"
                                    fill=""
                            />
                        </svg>
                        </button>
                        <!-- Application nav menu button -->

                    </div>

                    <div :class="menuToggle ? 'flex' : 'hidden'"
                        class="shadow-theme-md w-full items-center justify-between gap-4 px-5 py-4 xl:flex xl:justify-end xl:px-0 xl:shadow-none">
                        <div class="2xsm:gap-3 flex items-center gap-2">
                        </div>

                        <!-- User Area -->
                        <div
                                class="relative"
                                x-data="{ dropdownOpen: false }"
                                @click.outside="dropdownOpen = false"
                        >
                        <a
                                class="flex items-center text-gray-700 dark:text-gray-400"
                                href="#"
                                @click.prevent="dropdownOpen = ! dropdownOpen"
                        >


                            <span class="text-theme-sm mr-1 block font-medium"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </span>

                            <svg
                                    :class="dropdownOpen && 'rotate-180'"
                                    class="stroke-gray-500 dark:stroke-gray-400"
                                    width="18"
                                    height="20"
                                    viewBox="0 0 18 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                                    d="M4.3125 8.65625L9 13.3437L13.6875 8.65625"
                                    stroke=""
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                            />
                            </svg>
                        </a>

                        <!-- Dropdown Start -->
                        <div x-show="dropdownOpen"
                            class="shadow-theme-lg dark:bg-gray-dark absolute right-0 mt-[17px] flex w-[260px] flex-col rounded-2xl border border-gray-200 bg-white p-3 dark:border-gray-800">
                            <div>
                            <span
                                    class="text-theme-sm block font-medium text-gray-700 dark:text-gray-400"
                            >
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                            </span>
                            <span
                                    class="text-theme-xs mt-0.5 block text-gray-500 dark:text-gray-400"
                            >
                                <p>{{ Auth::user()->email }} </p>
                            </span>
                            </div>

                            <ul
                                    class="flex flex-col gap-1 border-b border-gray-200 pt-4 pb-3 dark:border-gray-800"
                            >
                            <li>
                                <a
                                        href="profile.php"
                                        class="group text-theme-sm flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300"
                                >
                                <svg
                                        class="fill-gray-500 group-hover:fill-gray-700 dark:fill-gray-400 dark:group-hover:fill-gray-300"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z"
                                            fill=""
                                    />
                                </svg>
                                Profile
                                </a>
                            </li>
                            </ul>
                            <a href="{{ route('signout') }}"
                                    class="group text-theme-sm mt-3 flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300"
                            >
                            <svg
                                    class="fill-gray-500 group-hover:fill-gray-700 dark:group-hover:fill-gray-300"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M15.1007 19.247C14.6865 19.247 14.3507 18.9112 14.3507 18.497L14.3507 14.245H12.8507V18.497C12.8507 19.7396 13.8581 20.747 15.1007 20.747H18.5007C19.7434 20.747 20.7507 19.7396 20.7507 18.497L20.7507 5.49609C20.7507 4.25345 19.7433 3.24609 18.5007 3.24609H15.1007C13.8581 3.24609 12.8507 4.25345 12.8507 5.49609V9.74501L14.3507 9.74501V5.49609C14.3507 5.08188 14.6865 4.74609 15.1007 4.74609L18.5007 4.74609C18.9149 4.74609 19.2507 5.08188 19.2507 5.49609L19.2507 18.497C19.2507 18.9112 18.9149 19.247 18.5007 19.247H15.1007ZM3.25073 11.9984C3.25073 12.2144 3.34204 12.4091 3.48817 12.546L8.09483 17.1556C8.38763 17.4485 8.86251 17.4487 9.15549 17.1559C9.44848 16.8631 9.44863 16.3882 9.15583 16.0952L5.81116 12.7484L16.0007 12.7484C16.4149 12.7484 16.7507 12.4127 16.7507 11.9984C16.7507 11.5842 16.4149 11.2484 16.0007 11.2484L5.81528 11.2484L9.15585 7.90554C9.44864 7.61255 9.44847 7.13767 9.15547 6.84488C8.86248 6.55209 8.3876 6.55226 8.09481 6.84525L3.52309 11.4202C3.35673 11.5577 3.25073 11.7657 3.25073 11.9984Z"
                                        fill=""
                                />
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
                <!-- ===== Header End ===== -->

            <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
                <!-- Breadcrumb Start -->
                <div x-data="{ pageName: `Bodaboda Self-Help Group` }">
                        <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
                            <nav>
                                <ol class="flex items-center gap-1.5">
                                <li>
                                    <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="index.php">
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

                            <!-- Metric Item Start -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    Active Loans
                                </p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div x-data>
                                        <h4 class="text-xl font-bold text-gray-500 dark:text-white/90"
                                            x-text="$store.loanStats.activeLoans">
                                            0
                                        </h4>
                                    </div>

                                    <div class="flex items-center gap-1">
                                        <span class="flex items-center gap-1 rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                            0%
                                        </span>

                                        <span class="text-theme-xs text-gray-500 dark:text-gray-400">
                                            Vs last month
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->

                        <!-- Metric Item Start - Contributions Wallet -->
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]"
                            x-data="{ balance: 'KES 0.00' }"
                            x-init="fetch('/contributions/balance/total')
                                    .then(res => res.json())
                                    .then(data => { if(data.success) balance = data.formatted; })">

                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Contributions Wallet</p>

                            <div class="mt-3 flex items-end justify-between">
                                <div>
                                    <h4 class="text-xl font-semibold text-gray-500 dark:text-white/90" x-text="balance">KES 0.00</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Metric Item End -->

                        <!-- Metric Item Start -->
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Savings Wallet</p>

                            <div class="mt-3 flex items-end justify-between">
                                <div>
                                <h4 class="text-xl font-semibold text-gray-500 dark:text-white/90">
                                    KES 0.00
                                </h4>
                                </div>
                            </div>
                        </div>
                        <!-- Metric Item End -->
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

                                                <!-- Stages -->
                                                <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                                                        x-bind:class="activeTab === 'stages' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                                        x-on:click="activeTab = 'stages'">
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
                                                    Stages
                                                </button>

                                                <!-- Loans -->
                                                <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                                                        x-bind:class="activeTab === 'loans' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                                        x-on:click="activeTab = 'loans'">
                                                    <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    Loans
                                                </button>

                                                <!-- Contributions -->
                                                <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                                                        x-bind:class="activeTab === 'contributions' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                                        x-on:click="activeTab = 'contributions'">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M17.8076 2C18.2218 2 18.5576 2.33579 18.5576 2.75V2.91898C19.3061 3.10815 19.8599 3.78601 19.8599 4.59323C19.8599 5.00744 19.5242 5.34323 19.1099 5.34323C18.6957 5.34323 18.3599 5.00744 18.3599 4.59323C18.3599 4.46796 18.2584 4.36641 18.1331 4.36641H17.7381C17.4714 4.36641 17.2553 4.58257 17.2553 4.84921C17.2553 5.05046 17.3801 5.2306 17.5686 5.30127L18.5734 5.67811C19.3473 5.96833 19.8599 6.70814 19.8599 7.53464C19.8599 8.39065 19.3175 9.11996 18.5576 9.39759V9.63372C18.5576 10.0479 18.2218 10.3837 17.8076 10.3837C17.3934 10.3837 17.0576 10.0479 17.0576 9.63372V9.46488C16.3092 9.2757 15.7553 8.59785 15.7553 7.79062C15.7553 7.37641 16.0911 7.04062 16.5053 7.04062C16.9195 7.04062 17.2553 7.37641 17.2553 7.79062C17.2553 7.91589 17.3568 8.01744 17.4821 8.01744H17.8771C18.1438 8.01744 18.3599 7.80129 18.3599 7.53464C18.3599 7.3334 18.2351 7.15326 18.0467 7.08259L17.0418 6.70575C16.268 6.41552 15.7553 5.67571 15.7553 4.84921C15.7553 3.99321 16.2977 3.2639 17.0576 2.98626V2.75C17.0576 2.33579 17.3934 2 17.8076 2Z" fill="#323544"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 3.25045C4.25736 3.25045 3.25 4.25781 3.25 5.50045V18.5005C3.25 19.7431 4.25736 20.7505 5.5 20.7505H5.83333C7.07597 20.7505 8.08333 19.7431 8.08333 18.5005V5.50045C8.08333 4.25781 7.07598 3.25045 5.83333 3.25045H5.5ZM4.75 5.50045C4.75 5.08624 5.08579 4.75045 5.5 4.75045H5.83333C6.24755 4.75045 6.58333 5.08624 6.58333 5.50045V18.5005C6.58333 18.9147 6.24755 19.2505 5.83333 19.2505H5.5C5.08579 19.2505 4.75 18.9147 4.75 18.5005V5.50045Z" fill="#323544"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.833 9.63424C10.5904 9.63424 9.58301 10.6416 9.58301 11.8842V18.5005C9.58301 19.7432 10.5904 20.7505 11.833 20.7505H12.1663C13.409 20.7505 14.4163 19.7432 14.4163 18.5005V11.8842C14.4163 10.6416 13.409 9.63424 12.1663 9.63424H11.833ZM11.083 11.8842C11.083 11.47 11.4188 11.1342 11.833 11.1342H12.1663C12.5806 11.1342 12.9163 11.47 12.9163 11.8842V18.5005C12.9163 18.9147 12.5806 19.2505 12.1663 19.2505H11.833C11.4188 19.2505 11.083 18.9147 11.083 18.5005V11.8842Z" fill="#323544"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.916 14.9223C15.916 13.6797 16.9234 12.6723 18.166 12.6723H18.4993C19.742 12.6723 20.7493 13.6797 20.7493 14.9223V18.5005C20.7493 19.7432 19.742 20.7505 18.4993 20.7505H18.166C16.9234 20.7505 15.916 19.7432 15.916 18.5005V14.9223ZM18.166 14.1723C17.7518 14.1723 17.416 14.5081 17.416 14.9223V18.5005C17.416 18.9147 17.7518 19.2505 18.166 19.2505H18.4993C18.9136 19.2505 19.2493 18.9147 19.2493 18.5005V14.9223C19.2493 14.5081 18.9136 14.1723 18.4993 14.1723H18.166Z" fill="#323544"></path>
                                                    </svg>
                                                    Contributions
                                                </button>

                                                <!-- Bonuses -->
                                                <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                                                        x-bind:class="activeTab === 'bonuses' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                                        x-on:click="activeTab = 'bonuses'">
                                                    <svg class="w-[28px] h-[28px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="1" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"></path>
                                                    </svg>
                                                    Bonuses
                                                </button>

                                                <!-- Fines -->
                                                <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                                                        x-bind:class="activeTab === 'fines' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                                        x-on:click="activeTab = 'fines'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cash-off">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"/>
                                                    <path d="M3 6m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"/>
                                                    <path d="M3 3l18 18"/>
                                                    </svg>
                                                    Fines
                                                </button>


                            </nav>
                        </div>

                        <div class="pt-4 dark:border-gray-800">
                                <!-- Members Tab Content -->
                                <div x-show="activeTab === 'members'" style="display: none;" x-data="memberTableFull()">
                                    <!-- Members Management-->
                                    <!-- Tabbed content -->
                                        <div class="rounded-xl p-6 dark:border-gray-800 border" x-data="{ activeTab: 'loans-type' }">
                                            <div class="border-b border-gray-200 dark:border-gray-800">
                                                <nav class="-mb-px flex space-x-2 overflow-x-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-200 dark:[&::-webkit-scrollbar-thumb]:bg-gray-600 dark:[&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar]:h-1.5">
                                                    <button
                                                        class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out focus:outline-hidden focus:ring-2 focus:ring-offset-1 focus:ring-brand-500/20"
                                                        :class="activeTab === 'loans-type'
                                                        ? 'border-brand-500 text-brand-500 dark:border-brand-400 dark:text-brand-400'
                                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-700'"
                                                        @click="activeTab = 'loans-type'"
                                                    >
                                                        <!-- Bar Chart Icon -->
                                                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        Members
                                                    </button>

                                                    <button
                                                        class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out focus:outline-hidden focus:ring-2 focus:ring-offset-1 focus:ring-brand-500/20"
                                                        :class="activeTab === 'calculator'
                                                        ? 'border-brand-500 text-brand-500 dark:border-brand-400 dark:text-brand-400'
                                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-700'"
                                                        @click="activeTab = 'calculator'"
                                                    >
                                                        <!-- Calculator Icon -->
                                                        <svg class="size-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5 2C3.34315 2 2 3.34315 2 5V15C2 16.6569 3.34315 18 5 18H15C16.6569 18 18 16.6569 18 15V5C18 3.34315 16.6569 2 15 2H5ZM4 6V5C4 4.44772 4.44772 4 5 4H15C15.5523 4 16 4.44772 16 5V15C16 15.5523 15.5523 16 15 16H5C4.44772 16 4 15.5523 4 15V6ZM6 7C5.44772 7 5 7.44772 5 8V13C5 13.5523 5.44772 14 6 14H14C14.5523 14 15 13.5523 15 13V8C15 7.44772 14.5523 7 14 7H6ZM7 9H9V11H7V9ZM11 9H13V11H11V9ZM7 12H9V13H7V12ZM11 12H13V13H11V12Z" fill="currentColor"/>
                                                        </svg>
                                                        Membership
                                                    </button>
                                                </nav>
                                            </div>

                                            <div class="pt-4 dark:border-gray-800">
                                                <div x-show="activeTab === 'loans-type'">
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
                                                                                            <button @click="window.location.href = `/treasurer/bodaboda-member/${row.memberId}`"
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

                                                <div x-show="activeTab === 'calculator'" style="display: none;">
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

                                <div x-show="activeTab === 'stages'" style="display: none;" x-data="stageTable()">
                                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                        <!-- Stages table -->
                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                            <div>
                                                    <h3 class="text-lg font-semibold text-gray-600 dark:text-white/90">
                                                        Stages
                                                    </h3>
                                                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                                        Manage all your stageslocations
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
                                                                            Stage Manager
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

                                <div x-show="activeTab === 'loans'" x-data="loanTypesTable()">
                                    <!-- Loan Settings Content -->
                                    <div class="relative ">
                                        <!-- Tabbed content -->
                                        <div class="rounded-xl p-6 dark:border-gray-800 border" x-data="{ activeTab: 'loans-type' }">
                                            <div class="border-b border-gray-200 dark:border-gray-800">
                                                <nav class="-mb-px flex space-x-2 overflow-x-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-200 dark:[&::-webkit-scrollbar-thumb]:bg-gray-600 dark:[&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar]:h-1.5">
                                                    <button
                                                        class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out focus:outline-hidden focus:ring-2 focus:ring-offset-1 focus:ring-brand-500/20"
                                                        :class="activeTab === 'loans-type'
                                                        ? 'border-brand-500 text-brand-500 dark:border-brand-400 dark:text-brand-400'
                                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-700'"
                                                        @click="activeTab = 'loans-type'"
                                                    >
                                                        <!-- Bar Chart Icon -->
                                                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        Loans Management
                                                    </button>

                                                    <button
                                                        class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out focus:outline-hidden focus:ring-2 focus:ring-offset-1 focus:ring-brand-500/20"
                                                        :class="activeTab === 'calculator'
                                                        ? 'border-brand-500 text-brand-500 dark:border-brand-400 dark:text-brand-400'
                                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-700'"
                                                        @click="activeTab = 'calculator'"
                                                    >
                                                        <!-- Calculator Icon -->
                                                        <svg class="size-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5 2C3.34315 2 2 3.34315 2 5V15C2 16.6569 3.34315 18 5 18H15C16.6569 18 18 16.6569 18 15V5C18 3.34315 16.6569 2 15 2H5ZM4 6V5C4 4.44772 4.44772 4 5 4H15C15.5523 4 16 4.44772 16 5V15C16 15.5523 15.5523 16 15 16H5C4.44772 16 4 15.5523 4 15V6ZM6 7C5.44772 7 5 7.44772 5 8V13C5 13.5523 5.44772 14 6 14H14C14.5523 14 15 13.5523 15 13V8C15 7.44772 14.5523 7 14 7H6ZM7 9H9V11H7V9ZM11 9H13V11H11V9ZM7 12H9V13H7V12ZM11 12H13V13H11V12Z" fill="currentColor"/>
                                                        </svg>
                                                        Loan Calculator
                                                    </button>
                                                </nav>
                                            </div>

                                            <div class="pt-4 dark:border-gray-800">
                                                <div x-show="activeTab === 'loans-type'">
                                                    <!-- Loan types table -->
                                                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

                                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                                            <div>
                                                                    <h3 class="text-lg font-semibold text-gray-600 dark:text-white/90">
                                                                        Loan Types
                                                                    </h3>
                                                                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                                                        Manage your system loan types
                                                                    </p>
                                                            </div>

                                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                                <!-- Filter by Frequency -->
                                                                    <div class="hidden lg:block">
                                                                        <select x-model="frequencyFilter"
                                                                                @change="performFilter()"
                                                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                            <option value="All">All Time</option>
                                                                            <option value="Daily">Daily</option>
                                                                            <option value="Weekly">Weekly</option>
                                                                            <option value="Monthly">Monthly</option>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Filter by Status -->
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
                                                                        <button @click="printLoansReport()"
                                                                                class="hover:text-dark-900 shadow-theme-xs relative flex h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                                                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                                                <rect x="7" y="13" width="10" height="8" rx="2"></rect>
                                                                            </svg>
                                                                            Print
                                                                        </button>
                                                                    </div>

                                                                <!-- Create new loan type button -->
                                                                <div>
                                                                        <button @click="loanTypeModal = true"
                                                                                class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            New Loan Type
                                                                        </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <!-- Loan Types Table -->
                                                        <div>
                                                            <!-- Loan Types Table -->
                                                            <div x-init="init()">
                                                                <div class="custom-scrollbar overflow-x-auto">
                                                                        <table class="w-full">
                                                                            <!-- table header start -->
                                                                            <thead>
                                                                                <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                                                    <th class="p-4 whitespace-nowrap">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                LoanTypeID
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Type
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Interest Rate
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Repayment Type
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Total Loaned
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Active Loans
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Created On
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
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Actions
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <!-- table header end -->

                                                                            <!-- Message if no loans data found -->
                                                                            <template x-if="loanTypes.length === 0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td colspan="10" class="px-4 py-12 text-center">
                                                                                            <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                                <!-- Documents Outline SVG Icon -->
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                                                                                </svg>
                                                                                                <div class="space-y-2">
                                                                                                    <h2 class="text-xl font-semibold text-gray-700">No loans records found</h2>
                                                                                                    <p class="text-gray-500">Do some transactions to view loans performance</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </template>

                                                                            <!-- If there is data  display the table -->
                                                                            <template x-if="loanTypes.length > 0">
                                                                                <!-- table body start -->
                                                                                <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                                                    <template x-for="loanType in paginatedLoans" :key="loanType.LoanTypeID">
                                                                                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                                            <!-- LoanTypeID -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <div class="flex items-center gap-3">
                                                                                                        <div>
                                                                                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loanType.LoanTypeID"></p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Type -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loanType.Type"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Interest Rate -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loanType.InterestRate"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Repayment Type -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loanType.Repayment"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Total Loaned -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loanType.TotalLoaned"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Active Loans -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loanType.ActiveLoans"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Created On -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loanType.CreatedOn"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Status -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p :class="loanType.Status === 'Active' ? 'bg-success-50 text-theme-xs text-success-700 dark:bg-success-500/15 dark:text-success-500' : 'bg-error-50 text-theme-xs text-error-600 dark:bg-error-500/15 dark:text-error-500'"
                                                                                                    class="rounded-full px-2 py-0.5 font-medium" x-text="loanType.Status"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Actions -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <button @click="editLoanTypeModal(loanType)"
                                                                                                            class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                                                        <svg class="w-[28px] h-[28px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                                                                                        </svg>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </template>
                                                                                </tbody>
                                                                                <!-- table body end -->
                                                                            </template>

                                                                        </table>
                                                                </div>
                                                                    <!-- Table Navigations -->
                                                                <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                                                                        <div class="flex justify-center pb-4 sm:hidden">
                                                                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                Showing
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntry"></span>
                                                                                to
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntry"></span>
                                                                                of
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="loanTypes.length"></span>
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
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="loanTypes.length"></span>
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
                                                                                            d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 8.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z"
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

                                                <div x-show="activeTab === 'calculator'" style="display: none;">
                                                    <div class="mb-8">
                                                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                                                        Loan Calculator
                                                        </h3>
                                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                        Loan Calculator simulation
                                                        </p>
                                                    </div>

                                                    <!-- Loan Calculator -->
                                                    <div class="space-y-8">
                                                        <div class="grid grid-cols-12 gap-4 md:gap-6">
                                                        <div class="col-span-12 xl:col-span-5">
                                                            <!-- ====== Map One Start -->
                                                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
                                                            <div class="flex justify-between">
                                                                <div>
                                                                <h3 class="text-lg font-semibold text-gray-700 dark:text-white/90">
                                                                    Loan Calculator
                                                                </h3>
                                                                <p class="mt-1 text-theme-sm text-gray-500 dark:text-gray-400">
                                                                    Check loan repayment simulation automation.
                                                                </p>
                                                                </div>
                                                            </div>
                                                            <div class="space-y-5">
                                                                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                                                                <form x-data="loanCalculator()">
                                                                    <div class="-mx-2.5 flex flex-wrap gap-y-5">
                                                                    <div class="w-full px-2.5">
                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                        Loan Type
                                                                        </label>
                                                                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                                                        <select x-model="loanType" @change="calculateLoan()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'">
                                                                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Select Loan Type</option>
                                                                            <option value="personal" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Personal Loan</option>
                                                                            <option value="business" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Business Loan</option>
                                                                            <option value="emergency" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Emergency Loan</option>
                                                                            <option value="education" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Education Loan</option>
                                                                            <option value="vehicle" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Vehicle Loan</option>
                                                                        </select>
                                                                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                        </span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                        Loan Amount
                                                                        </label>
                                                                        <div class="relative">
                                                                        <input x-model="loanAmount" @input="calculateLoan()" type="number" min="1000" step="1000" placeholder="Enter loan amount"
                                                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-[62px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                        <span class="absolute top-1/2 left-0 flex h-11 w-[46px] -translate-y-1/2 items-center justify-center border-r border-gray-200 dark:border-gray-800">
                                                                            <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="1.1" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"></path>
                                                                            </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                        Repayment Period
                                                                        </label>
                                                                        <div class="relative z-20 bg-transparent">
                                                                        <select x-model="repaymentPeriod" @change="calculateLoan()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Loan Duration</option>
                                                                            <option value="1" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">1 Month</option>
                                                                            <option value="3" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">3 Months</option>
                                                                            <option value="6" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">6 Months</option>
                                                                            <option value="9" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">9 Months</option>
                                                                            <option value="12" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">12 Months</option>
                                                                            <option value="24" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">24 Months</option>
                                                                            <option value="36" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">36 Months</option>
                                                                        </select>
                                                                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                        </span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                        Interest Rate
                                                                        </label>
                                                                        <div class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="interestRate + '%'">0.00%</div>
                                                                    </div>

                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                        Repayment Frequency
                                                                        </label>
                                                                        <div class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="repaymentFrequency">Monthly</div>
                                                                    </div>

                                                                    <div class="w-full px-2.5">
                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                        Estimated monthly payment
                                                                        </label>
                                                                        <div class="relative z-20 bg-transparent bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
                                                                        <div class="flex items-center gap-6">
                                                                            <div>
                                                                            <p class="text-lg font-semibold text-center text-gray-800 dark:text-white/90" x-text="'KES ' + formatCurrency(monthlyPayment)">KES 0.00</p>
                                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                                                                Monthly payment
                                                                            </p>
                                                                            </div>

                                                                            <div class="w-px bg-gray-300 h-11 dark:bg-gray-700"></div>

                                                                            <div>
                                                                            <p class="text-lg font-semibold text-center text-gray-800 dark:text-white/90" x-text="'KES ' + formatCurrency(totalInterest)">KES 0.00</p>
                                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                                                                Total interest paid
                                                                            </p>
                                                                            </div>

                                                                            <div class="w-px bg-gray-300 h-11 dark:bg-gray-700"></div>

                                                                            <div>
                                                                            <p class="text-lg font-semibold text-center text-gray-800 dark:text-white/90" x-text="'KES ' + formatCurrency(totalLoanAmount)">KES 0.00</p>
                                                                            <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                                                                Total cost of loan
                                                                            </p>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Additional Calculation Details -->
                                                                    <div class="w-full px-2.5">
                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                        Payment Schedule Details
                                                                        </label>
                                                                        <div class="relative z-20 bg-transparent bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                                                                        <div class="grid grid-cols-2 gap-4">
                                                                            <div>
                                                                            <p class="text-sm text-gray-500 dark:text-gray-400">First Payment Date</p>
                                                                            <p class="text-base font-semibold text-gray-800 dark:text-white/90" x-text="firstPaymentDate">-</p>
                                                                            </div>
                                                                            <div>
                                                                            <p class="text-sm text-gray-500 dark:text-gray-400">Last Payment Date</p>
                                                                            <p class="text-base font-semibold text-gray-800 dark:text-white/90" x-text="lastPaymentDate">-</p>
                                                                            </div>
                                                                            <div>
                                                                            <p class="text-sm text-gray-500 dark:text-gray-400">Number of Payments</p>
                                                                            <p class="text-base font-semibold text-gray-800 dark:text-white/90" x-text="numberOfPayments">0</p>
                                                                            </div>
                                                                            <div>
                                                                            <p class="text-sm text-gray-500 dark:text-gray-400">Payment Day</p>
                                                                            <p class="text-base font-semibold text-gray-800 dark:text-white/90">5th of every month</p>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Action Buttons -->
                                                                    <div class="w-full px-2.5 pt-4">
                                                                        <div class="flex justify-end items-center gap-3">
                                                                        <button @click="resetCalculator()" type="button"
                                                                            class="h-11 rounded-lg border border-gray-300 bg-transparent px-6 text-sm font-semibold text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 disabled:pointer-events-none disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-300">
                                                                            Clear
                                                                        </button>
                                                                        <button @click="simulateAutomation()" type="button"
                                                                            class="h-11 rounded-lg border border-brand-500 bg-brand-500 px-6 text-sm font-semibold text-white shadow-theme-xs hover:bg-brand-600 disabled:pointer-events-none disabled:opacity-50">
                                                                            Simulate Automation
                                                                        </button>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </form>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <!-- ====== Map One End -->
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-7">
                                                            <!-- Automated Repayment Schedule Start -->
                                                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
                                                            <div class="flex justify-between">
                                                                <div>
                                                                <h3 class="text-lg font-semibold text-gray-700 dark:text-white/90">
                                                                    Automated Repayment Schedule
                                                                </h3>
                                                                <p class="mt-1 text-theme-sm text-gray-500 dark:text-gray-400">
                                                                    Detailed View of the Repayment Schedule
                                                                </p>
                                                                </div>
                                                                <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                                                <div class="flex items-center gap-1">
                                                                    <div class="h-2 w-2 rounded-full bg-brand-500"></div>
                                                                    <span>First Payment: </span>
                                                                    <span class="font-medium text-gray-700 dark:text-white/90" x-text="firstPaymentDate || '-'"></span>
                                                                </div>
                                                                <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
                                                                <div class="flex items-center gap-1">
                                                                    <div class="h-2 w-2 rounded-full bg-gray-400"></div>
                                                                    <span>Last Payment: </span>
                                                                    <span class="font-medium text-gray-700 dark:text-white/90" x-text="lastPaymentDate || '-'"></span>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="space-y-5 mt-6">
                                                                <div class="max-w-full overflow-x-auto custom-scrollbar">
                                                                <table class="w-full" id="repaymentScheduleTable">
                                                                    <thead>
                                                                    <tr class="border-t border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50">
                                                                    <th class="px-6 py-3 text-left">
                                                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                        Date
                                                                        </p>
                                                                    </th>
                                                                    <th class="px-6 py-3 text-left">
                                                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                        Repayment
                                                                        </p>
                                                                    </th>
                                                                    <th class="px-6 py-3 text-left">
                                                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                        Principal Paid
                                                                        </p>
                                                                    </th>
                                                                    <th class="px-6 py-3 text-left">
                                                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                        Interest Paid
                                                                        </p>
                                                                    </th>
                                                                    <th class="px-6 py-3 text-left">
                                                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                        Total Interest paid
                                                                        </p>
                                                                    </th>
                                                                    <th class="px-6 py-3 text-left">
                                                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                        Balance
                                                                        </p>
                                                                    </th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="repaymentScheduleBody">
                                                                    <!-- Empty state - will be replaced by JavaScript -->
                                                                    <tr class="border-t border-gray-100 dark:border-gray-800" id="emptyStateRow">
                                                                    <td colspan="6" class="px-6 py-12 text-center">
                                                                        <div class="flex flex-col items-center justify-center">
                                                                        <svg class="h-12 w-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                                        </svg>
                                                                        <p class="text-gray-500 dark:text-gray-400 text-sm">
                                                                            Enter loan details to generate repayment schedule
                                                                        </p>
                                                                        </div>
                                                                    </td>
                                                                    </tr>
                                                                    <!-- Payment rows will be inserted here by JavaScript -->
                                                                    </tbody>
                                                                </table>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <!-- Automated Repayment Schedule End -->
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

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

                                <div class="" x-show="activeTab === 'bonuses'">
                                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                        <!-- Bonuses content here -->
                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                                    Bodaboda Bonuses
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Review contributions performance
                                                </p>
                                            </div>

                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">

                                                <div class="hidden lg:block">
                                                    <select x-model="statusFilter"
                                                            @change="performFilter()"
                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="Daily">Frequency</option>
                                                        <option value="Daily">Daily</option>
                                                        <option value="Weekly">Weekly</option>
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Yearly">Yearly</option>
                                                    </select>
                                                </div>

                                                <div class="hidden lg:block">
                                                    <select x-model="statusFilter"
                                                            @change="performFilter()"
                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="All">Payment Type</option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="MPesa">MPesa</option>
                                                        <option value="Bank">Bank</option>
                                                    </select>
                                                </div>

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

                                                <!-- Create New Bonus Type button -->
                                                    <div>
                                                        <button @click="newBonusModal = true"
                                                                                class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                            New Bonus Type
                                                        </button>
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- Bonuses table Table -->
                                        <div x-data="bonusesTable()" x-init="init()">
                                            <div class="custom-scrollbar overflow-x-auto">
                                                <table class="w-full table-auto">
                                                    <thead>
                                                        <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Bonus Code
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Type
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Percentage
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Max Amount
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Amount
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Created On
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Status
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Actions
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <!-- Message if no bonuses data found -->
                                                    <template x-if="bonuses.length === 0">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="10" class="px-4 py-12 text-center">
                                                                    <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                        <!-- Documents Outline SVG Icon -->
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                                                        </svg>
                                                                        <div class="space-y-2">
                                                                            <h2 class="text-xl font-semibold text-gray-700">No bonuses records found</h2>
                                                                            <p class="text-gray-500">Do some transactions to view bonuses performance</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </template>

                                                    <!-- Bonus records found display table -->
                                                    <template x-if="bonuses.length > 0">
                                                        <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                            <template x-for="bonus in paginatedBonuses" :key="bonus.BonusID">
                                                                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                    <!-- Bonus ID -->
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="group flex items-center gap-3">
                                                                            <a href="#"
                                                                                class="text-theme-xs font-medium text-gray-700 group-hover:underline dark:text-gray-400"
                                                                                x-text="bonus.BonusID"></a>
                                                                        </div>
                                                                    </td>
                                                                    <!-- Bonus Name -->
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="bonus.Type"></p>
                                                                    </td>
                                                                    <!-- Bonus Percentage -->
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="bonus.Percentage"></span>
                                                                    </td>
                                                                    <!-- Bonus Max Amount -->
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="bonus.TotalBonusAmount"></span>
                                                                    </td>
                                                                    <!-- Bonus Total Amount Given -->
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400 truncate max-w-[200px]"
                                                                        x-text="bonus.TotalBonusesGiven + ' given'"
                                                                        :title="bonus.TotalBonusesGiven + ' given'"></p>
                                                                    </td>
                                                                    <!-- Bonus Created On -->
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="bonus.CreatedOn"></p>
                                                                    </td>
                                                                    <!-- Bonus Status -->
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                                            :class="{
                                                                                'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': bonus.Status === 'Active',
                                                                                'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400': bonus.Status === 'Suspended' || bonus.Status === 'In-Active',
                                                                                'bg-error-100 text-error-600 dark:bg-error-900/30 dark:text-error-400': bonus.Status === 'Blacklisted' || bonus.Status === 'Under Review'
                                                                            }"
                                                                                x-text="bonus.Status">
                                                                        </span>
                                                                    </td>
                                                                    <!-- Actions -->
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <button @click="$store.bonusTypeData.editBonus(bonus)"
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
                                                        <span class="text-gray-800 dark:text-white/90" x-text="bonuses.length"></span>
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
                                                            <span class="text-gray-800 dark:text-white/90" x-text="bonuses.length"></span>
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

                                <div class="" x-show="activeTab === 'fines'">
                                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                        <!-- Contributions content here -->
                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                                    Bodaboda Fines
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Review contributions performance
                                                </p>
                                            </div>

                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">

                                                <div class="hidden lg:block">
                                                    <select x-model="statusFilter"
                                                            @change="performFilter()"
                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="Daily">Frequency</option>
                                                        <option value="Daily">Daily</option>
                                                        <option value="Weekly">Weekly</option>
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Yearly">Yearly</option>
                                                    </select>
                                                </div>

                                                <div class="hidden lg:block">
                                                    <select x-model="statusFilter"
                                                            @change="performFilter()"
                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="All">Payment Type</option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="MPesa">MPesa</option>
                                                        <option value="Bank">Bank</option>
                                                    </select>
                                                </div>

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

                                                <!-- Create New Fine Type button -->
                                                    <div>
                                                        <button @click="newFineModal = true"
                                                                                class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                            New Fine Type
                                                        </button>
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- Contributions table Table -->
                                        <div x-data="finesTable()" x-init="init()">
                                            <div class="custom-scrollbar overflow-x-auto">
                                                <table class="w-full table-auto">
                                                    <thead>
                                                        <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                #Code
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Type
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Percentage
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Total Fines
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Total Issued
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Created On
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Status
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <!-- Message if no fines data found -->
                                                    <template x-if="fines.length === 0">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="10" class="px-4 py-12 text-center">
                                                                    <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                        <!-- Documents Outline SVG Icon -->
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                                                        </svg>
                                                                        <div class="space-y-2">
                                                                            <h2 class="text-xl font-semibold text-gray-700">No fines records found</h2>
                                                                            <p class="text-gray-500">Do some transactions to view fines performance</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </template>

                                                    <!-- If records found display in table -->
                                                    <template x-if="fines.length > 0">
                                                        <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                            <template x-for="fine in paginatedFines" :key="fine.FineID">
                                                                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="group flex items-center gap-3">
                                                                        <a href="view-member.php"
                                                                            class="text-theme-xs font-medium text-gray-700 group-hover:underline dark:text-gray-400"
                                                                            x-text="fine.FineID"></a>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div>
                                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                                            x-text="fine.Type"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="fine.Percentage"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="fine.TotalFineAmount"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400 truncate max-w-[200px]" x-text="fine.TotalFinesIssued + ' issued'" :title="fine.TotalFinesIssued + ' issued'"></p>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400 truncate max-w-[200px]" x-text="fine.CreatedOn"></p></div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                                            :class="{
                                                                                'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': fine.Status === 'Active',
                                                                                'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400': fine.Status === 'Suspended' || fine.Status === 'In-Active',
                                                                                'bg-error-100 text-error-600 dark:bg-error-900/30 dark:text-error-400': fine.Status === 'Blacklisted' || fine.Status === 'Under Review'
                                                                            }"
                                                                                x-text="fine.Status">
                                                                        </span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <button @click="$store.fineTypeData.editFine(fine)"
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
                                                        <span class="text-gray-800 dark:text-white/90" x-text="fines.length"></span>
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
                                                            <span class="text-gray-800 dark:text-white/90" x-text="fines.length"></span>
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

    <!-- ===== Modals Start ===== -->
    <!-- BEGIN MODALS -->
    <!-- Fines ------------------------------------------------------------------------------------------------------------------------------------------------ -->
    <div x-show="newFineModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="newFineModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="newFineModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
        <div class="px-2 pr-14">
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Create New Fine Type</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Define a new fine type that will be applied system wide to bodaboda.</p>
        </div>

            <form class="flex flex-col" action="" method="POST" @submit.prevent="validateFineForm()">
                @csrf
                <div class="custom-scrollbar h-[450px] overflow-y-auto px-2">
                    <div class="mt-7">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-1">
                            <div class="col-span-2 lg:col-span-1">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Fine Type</label>
                                <input type="text" placeholder="Enter fine type name ..." id="newFineType" name="newFineType"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                            </div>

                            <div class="col-span-2 lg:col-span-1">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                                <textarea placeholder="Enter a description..." id="fineDescription" name="fineDescription" type="text" rows="6" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-7">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                            <div class="col-span-2 lg:col-span-1">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Percentage (%)</label>
                                <input type="number" placeholder="Percentage ..." id="newFinePercentage" name="newFinePercentage" step="0.01" min="0"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                            </div>

                            <div class="col-span-2 lg:col-span-1">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="newFineStatus" name="newFineStatus" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'">
                                        <option class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Status</option>
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
                    </div>
                </div>
                <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                    <button @click="newFineModal = false" type="button"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        @click="Alpine.store('fineFormData').submitFineForm($event)"
                        class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                        Create Fine
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="$store.fineTypeData.editFineTypeModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="$store.fineTypeData.editFineTypeModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="$store.fineTypeData.editFineTypeModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
        <div class="px-2 pr-14">
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Fine Type</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Review fine type details that will be applied system wide to bodaboda.</p>
        </div>
            <form class="flex flex-col" method="POST">
                @csrf
                <div class="custom-scrollbar h-[450px] overflow-y-auto px-2">

                    <input type="number" id="fine_id" name="fine_id" hidden readonly x-model="$store.fineTypeData.currentFine?.FineID"/>

                    <div class="mt-7">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-1">
                            <div class="col-span-2 lg:col-span-1">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Fine Type</label>
                                <input type="text" placeholder="Enter fine type name ..." id="uFineType" name="uFineType" x-model="$store.fineTypeData.currentFine?.Type"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                            </div>

                            <div class="col-span-2 lg:col-span-1">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                                <textarea placeholder="Enter a description..." id="uFineDescription" name="uFineDescription" x-model="$store.fineTypeData.currentFine?.Description" type="text" rows="6" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-7">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                            <div class="col-span-2 lg:col-span-1">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Percentage (%)</label>
                                <input type="number" placeholder="Percentage ..." id="uFinePercentage" name="uFinePercentage" step="0.01" min="0"  x-model="$store.fineTypeData.currentFine?.PercentageNumber"
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                            </div>

                            <div class="col-span-2 lg:col-span-1">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="uStatus" name="uStatus" x-model="$store.fineTypeData.currentFine?.Status" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'">
                                        <option class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Status</option>
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
                    </div>
                </div>
                <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                    <button @click="$store.fineTypeData.editFineTypeModal = false" type="button"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Cancel
                    </button>
                    <button type="button" id="deleteFineTypeBtn"
                            @click="$store.fineTypeData.deleteFineType($store.fineTypeData.currentFine?.FineID, $store.fineTypeData.currentFine?.Type)"
                            class="rounded-lg border border-error-300 bg-white px-5 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            Delete
                    </button>
                    <button
                            type="button" id="updateFineTypeBtn"
                            @click="$store.fineTypeData.updateFineType()"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                            Update Fine
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- New Bonus type --------------------------------------------------------------------------------------------------------------------------------------- -->
    <div x-show="newBonusModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>

        <div @click.outside="newBonusModal = false"
            class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="newBonusModal = false"
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

            <div class="px-2 pr-14">
                <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Bonus</h4>
                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Review bonus type details that will be applied system wide to bodaboda.</p>
            </div>
                <form class="flex flex-col" action="" method="POST" @submit.prevent="Alpine.store('bonusFormData').validateBonusForm()">
                    @csrf
                    <div class="custom-scrollbar h-[450px] overflow-y-auto px-2">
                        <div class="mt-7">
                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-1">
                                <div class="col-span-2 lg:col-span-1">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Bonus Type</label>
                                    <input type="text" placeholder="Enter bonus type name ..." id="newBonusType" name="newBonusType"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                                </div>

                                <div class="col-span-2 lg:col-span-1">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                                    <textarea placeholder="Enter a description..." id="bonusDescription" name="bonusDescription" type="text" rows="6" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-7">
                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                                <div class="col-span-2 lg:col-span-1">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Percentage (%)</label>
                                    <input type="number" placeholder="Percentage ..." id="newBonusPercentage" name="newBonusPercentage" step="0.01" min="0"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                                </div>

                                <div class="col-span-2 lg:col-span-1">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                                    <div class="relative z-20 bg-transparent">
                                        <select id="newBonusStatus" name="newBonusStatus" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'">
                                            <option class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Status</option>
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
                        </div>
                    </div>
                    <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                        <button @click="newFineModal = false" type="button"
                                class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                            Cancel
                        </button>
                        <button
                            type="submit"
                            @click="Alpine.store('bonusFormData').submitBonusForm($event)"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                            Create Bonus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Bonus type -->
    <div x-show="$store.bonusTypeData.editBonusTypeModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="$store.bonusTypeData.editBonusTypeModal = false" class=" relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="$store.bonusTypeData.editBonusTypeModal = false"
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

            <div class="px-2 pr-14">
                <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Update Bonus</h4>
                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Review bonus type details that will be applied system wide to bodaboda.</p>
            </div>
                <form class="flex flex-col" method="POST">
                    @csrf
                    <div class="custom-scrollbar h-[450px] overflow-y-auto px-2">

                        <input type="number" id="bonus_id" name="bonus_id" x-model="$store.bonusTypeData.currentBonus?.BonusID" hidden readonly/>

                        <div class="mt-7">
                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-1">
                                <div class="col-span-2 lg:col-span-1">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Bonus Type</label>
                                    <input type="text" placeholder="Enter bonus type name ..." id="uBonusType" name="uBonusType" x-model="$store.bonusTypeData.currentBonus?.Type"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                                </div>

                                <div class="col-span-2 lg:col-span-1">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                                    <textarea placeholder="Enter a description..." id="uBonusDescription" name="uBonusDescription" x-model="$store.bonusTypeData.currentBonus?.CalculationMethod" type="text" rows="6" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-7">
                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                                <div class="col-span-2 lg:col-span-1">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Percentage (%)</label>
                                    <input type="number" placeholder="Percentage ..." id="uBonusPercentage" name="uBonusPercentage" step="0.01" min="0" x-model="$store.bonusTypeData.currentBonus?.PercentageNumber"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                                </div>

                                <div class="col-span-2 lg:col-span-1">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                                    <div class="relative z-20 bg-transparent">
                                        <select id="uBonusStatus" name="uBonusStatus" x-model="$store.bonusTypeData.currentBonus?.Status" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'">
                                            <option class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Status</option>
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
                        </div>
                    </div>
                    <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                        <button @click="$store.bonusTypeData.editBonusTypeModal = false" type="button"
                                class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                            Cancel
                        </button>
                        <button type="button" id="deleteBonusTypeBtn"
                            @click="$store.bonusTypeData.deleteBonusType($store.bonusTypeData.currentBonus?.BonusID, $store.bonusTypeData.currentBonus?.Type)"
                            class="rounded-lg border border-error-300 bg-white px-5 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            Delete
                        </button>
                        <button
                            type="button" id="updateBonusTypeBtn"
                             @click="$store.bonusTypeData.updateBonusType()"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                            Update Bonus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

    <!-- Loan Types ------------------------------------------------------------------------------------------------------------------------------------------ -->
    <div x-show="loanTypeModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="loanTypeModal = false" class="flex no-scrollbar relative w-full max-w-[700px] flex-col overflow-y-auto rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="loanTypeModal = false"
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

            <div class="px-2 pr-14">
                <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Loan Type
                </h4>
                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
                    Specify new loan type details.
                </p>
            </div>

            <form class="flex flex-col" action="" method="POST" @submit.prevent="Alpine.store('loanTypeData').validateLoanForm()">
                @csrf
                <div class="custom-scrollbar flex-1 overflow-y-auto px-6">
                    <!-- Change Appointment Details Section -->
                    <div class="space-y-6 mt-8">
                        <!-- Amount -->
                        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
                            <!-- Amount -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Loan Type
                                </label>
                                <div class="relative">
                                    <input type="Text" placeholder="New Loan type name" id="newLoanType" name="newLoanType" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-[62px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    <span class="absolute top-1/2 left-0 flex h-11 w-[46px] -translate-y-1/2 items-center justify-center border-r border-gray-200 dark:border-gray-800">
                                        <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.1" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Max Amount and Percentage -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                            <!-- Interest Rate -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Interest Rate (%)
                                </label>
                                <div class="relative">
                                    <input type="number"
                                        id="loanInterestRate"
                                        name="loanInterestRate"
                                        placeholder="Interest Rate"
                                        step="0.01"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-[62px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    <span class="absolute top-1/2 left-0 flex h-11 w-[46px] -translate-y-1/2 items-center justify-center border-r border-gray-200 dark:border-gray-800">
                                        <span class="text-gray-800 dark:text-white font-medium text-sm">%</span>
                                    </span>
                                </div>
                            </div>
                            <!-- Max Amount -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Max Amount
                                </label>
                                <div class="relative">
                                    <input type="number"
                                        id="loanMaxAmount"
                                        name="loanMaxAmount"
                                        placeholder="Max borrowable"
                                        step="0.01"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-[62px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    <span class="absolute top-1/2 left-0 flex h-11 w-[46px] -translate-y-1/2 items-center justify-center border-r border-gray-200 dark:border-gray-800">
                                        <span class="text-gray-800 dark:text-white font-medium text-sm">KES</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Status and Repayment Periods -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                            <!-- Interest Rate -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Repayment Period
                                </label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="loanRepaymentPeriod" name="loanRepaymentPeriod" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'">
                                        <option value="All" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Repayment</option>
                                        <option value="1" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">30 Days</option>
                                        <option value="12" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">12 Months</option>
                                        <option value="24" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">24 Months</option>
                                        <option value="36" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">36 Months</option>
                                        <option value="48" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">48 Months</option>
                                        <option value="60" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">60 Months</option>
                                    </select>
                                    <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    </span>
                                </div>
                            </div>
                            <!-- Status Type -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Status
                                </label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="newLoanStatus" name="newLoanStatus" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'">
                                        <option class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Status</option>
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

                    </div>

                    <!-- Action Buttons - Bottom Right -->
                    <div class="flex justify-end items-center gap-3 pt-6 border-t border-gray-200 dark:border-gray-700 mt-8">
                        <button @click="loanTypeModal = false" type="button"
                            class="h-11 rounded-lg border border-gray-300 bg-transparent px-6 text-sm font-semibold text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 disabled:pointer-events-none disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-300">
                            Cancel
                        </button>
                        <button type="submit"
                                @click="Alpine.store('loanTypeData').submitLoanForm($event)"
                                class="h-11 rounded-lg border border-brand-500 bg-brand-500 px-6 text-sm font-semibold text-white shadow-theme-xs hover:bg-brand-600 disabled:pointer-events-none disabled:opacity-50">
                            Create Loan Type
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Edit Loan Type Modal -->
    <div x-show="$store.loanTypeData.editLoanTypeModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="$store.loanTypeData.editLoanTypeModal = false" class="flex no-scrollbar relative w-full max-w-[700px] flex-col overflow-y-auto rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="$store.loanTypeData.editLoanTypeModal = false"
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

            <div class="px-2 pr-14">
                <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                Edit Loan Type
                </h4>
                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
                Editing: <span x-text="$store.loanTypeData.currentLoanType?.Type || ''" class="font-semibold"></span>
                </p>
            </div>

            <form class="flex flex-col" method="POST">
                @csrf
                <div class="custom-scrollbar flex-1 overflow-y-auto px-6">
                    <!-- Change Appointment Details Section -->
                    <div class="space-y-6 mt-8">
                        <!-- Loan Type ID (Display only, not editable) -->
                        <input type="hidden"
                            name="loan_type_id"
                            x-model="$store.loanTypeData.currentLoanType?.LoanTypeID"
                            id="loan_type_id_input" />


                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6 border-b p-2">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Code
                                </label>
                                <div class="relative">
                                <input type="text"
                                        x-model="$store.loanTypeData.currentLoanType?.LoanTypeID"
                                        readonly
                                        disabled
                                        id="loan_type_id" name="loan_type_id"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-gray-100 bg-none px-4 py-2.5 pl-[62px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 dark:placeholder:text-white/30">
                                <span class="absolute top-1/2 left-0 flex h-11 w-[46px] -translate-y-1/2 items-center justify-center border-r border-gray-200 dark:border-gray-800">
                                    <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.1" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                    </svg>
                                </span>
                                </div>
                            </div>

                            <!-- Created On (Display only) -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Created On
                                </label>
                                <div class="relative">
                                <input type="text"
                                        x-model="$store.loanTypeData.currentLoanType?.CreatedOn"
                                        readonly
                                        disabled
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-gray-100 bg-none px-4 py-2.5 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-800 dark:text-white/90 dark:placeholder:text-white/30">
                                </div>
                            </div>
                        </div>

                        <!-- Loan Type Name -->
                        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Loan Type Name
                                </label>
                                <div class="relative">
                                <input type="text"
                                        id="loan_type_name" name="loan_type_name"
                                        x-model="$store.loanTypeData.currentLoanType?.Type"
                                        placeholder="Loan Type Name"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                </div>
                            </div>
                        </div>

                        <!-- Interest Rate and Repayment Type -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                            <!-- Interest Rate -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Interest Rate (%)
                                </label>
                                <div class="relative">
                                    <input type="number"
                                            x-model="$store.loanTypeData.currentLoanType?.InterestRateNumber"
                                            placeholder="Interest Rate"
                                            step="0.01"
                                            min="0"
                                            id="interest_rate"
                                            name="interest_rate"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                </div>
                            </div>

                            <!--Max Amount -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Max Borrowable
                                </label>
                                <div class="relative">
                                <input type="number"
                                            x-model="$store.loanTypeData.currentLoanType?.TotalLoanedNumber"
                                            placeholder="Maximum Borrowable ..."
                                            step="0.01"
                                            min="0"
                                            id="max_amount"
                                            name="max_amount"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                            <!-- Repayment Type -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Repayment Scheme
                                </label>
                                <div class="relative z-20 bg-transparent">
                                    <select x-model="$store.loanTypeData.currentLoanType?.RepaymentNumber" id="repayment_period_months" name="repayment_period_months"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                        <option class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Repayment</option>
                                        <option value="1" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">30 Days</option>
                                        <option value="12" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">12 Months</option>
                                        <option value="24" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">24 Months</option>
                                        <option value="36" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">36 Months</option>
                                        <option value="48" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">48 Months</option>
                                        <option value="60" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">60 Months</option>
                                    </select>
                                    <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Status
                                </label>
                                <div class="relative z-20 bg-transparent">
                                    <select x-model="$store.loanTypeData.currentLoanType?.Status" id="status" name="status"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                        <option value="Active" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Active</option>
                                        <option value="In-Active" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">In-Active</option>
                                        <option value="Under Review" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Under Review</option>
                                        <option value="Removed" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Removed</option>
                                    </select>
                                    <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Action Buttons - Bottom Right -->
                    <div class="flex justify-end items-center gap-3 pt-6 border-t border-gray-200 dark:border-gray-700 mt-8">
                        <button @click="$store.loanTypeData.editLoanTypeModal = false" type="button"
                        class="h-11 rounded-lg border border-gray-300 bg-transparent px-6 text-sm font-semibold text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 disabled:pointer-events-none disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-300">
                        Cancel
                        </button>
                        <button type="button" id="deleteLoanTypeBtn"
                                @click="$store.loanTypeData.deleteLoanType($store.loanTypeData.currentLoanType?.LoanTypeID, $store.loanTypeData.currentLoanType?.Type)"
                                class="rounded-lg border border-error-300 bg-white px-5 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                        Delete
                        </button>
                        <button type="button"id="updateLoanTypeBtn"
                                @click="$store.loanTypeData.updateLoanType()"
                                class="h-11 rounded-lg border border-brand-500 bg-brand-500 px-6 text-sm font-semibold text-white shadow-theme-xs hover:bg-brand-600 disabled:pointer-events-none disabled:opacity-50">
                        Update Loan Type
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->

    <!-- END MODALS -->


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

                // Filter variables
                searchQuery: "",
                membershipFilter: "All",  // Separate for Member/Non-Member
                statusFilter: "All",       // Separate for Active/Suspended/Blacklisted

                init() {
                    this.loadMembers();
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

        // Initialize Alpine components
        document.addEventListener('alpine:init', () => {
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

            // Register the stageTable component
            Alpine.data('stageTable', stageTable);

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
        });
    </script>

    <!-- Loans Alpine -------------------------------------------------------------------------- -->
    <script>
        // loanTypesTable.js - Data binding and pagination functionality for loan types
        function loanTypesTable() {
            return {
                // Loan types data - loaded from Laravel backend
                loanTypes: [],
                page: 1,
                itemsPerPage: 10,

                // NEW: Filter properties
                frequencyFilter: 'All',
                statusFilter: 'All',

                // Initialize function - loads data from Laravel
                async init() {
                    console.log('Loan types table initialized');
                    await this.loadLoanTypes();
                },

                // Load loan types from Laravel backend
                async loadLoanTypes() {
                    try {
                        const response = await fetch('/loans/summary');
                        const data = await response.json();

                        if (data && data.data) {
                            // Transform Laravel data to match existing frontend structure
                            this.loanTypes = data.data.map(item => ({
                                LoanTypeID: item.loanId || '',
                                Type: item.loan_type_name || '',
                                InterestRate: `${item.interest_rate || 0} %`,
                                Repayment: `${item.repayment_period_months || 0} months`,
                                TotalLoaned: `Ksh ${parseFloat(item.total_loaned || 0).toLocaleString()}`,
                                ActiveLoans: item.total_loans || 0,
                                MaxAmount: item.max_amount,
                                CreatedOn: new Date(item.created_on || Date.now()).toLocaleTimeString('en-GB', {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                }) + ' ' + new Date(item.created_on || Date.now()).toLocaleDateString('en-GB', {
                                    day: '2-digit',
                                    month: 'short',
                                    year: '2-digit'
                                }).replace(',', ''),
                                Status: item.status || 'Active',
                                // Add created date for frequency filtering
                                createdDate: item.created_on ? new Date(item.created_on) : new Date()
                            }));
                        }
                    } catch (error) {
                        console.error('Error loading loan types:', error);
                        // Keep empty array if error
                        this.loanTypes = [];
                    }
                },

                // NEW: Filtered loan types based on frequency and status
                get filteredLoanTypes() {
                    let filtered = this.loanTypes;

                    // Apply status filter
                    if (this.statusFilter !== 'All') {
                        filtered = filtered.filter(loan => loan.Status === this.statusFilter);
                    }

                    // Apply frequency filter based on created date
                    if (this.frequencyFilter !== 'All') {
                        const now = new Date();
                        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

                        filtered = filtered.filter(loan => {
                            const createdDate = new Date(loan.createdDate);

                            switch(this.frequencyFilter) {
                                case 'Daily':
                                    // Today's loans
                                    const loanDate = new Date(createdDate.getFullYear(), createdDate.getMonth(), createdDate.getDate());
                                    return loanDate.getTime() === today.getTime();

                                case 'Weekly':
                                    // Last 7 days
                                    const weekAgo = new Date(today);
                                    weekAgo.setDate(weekAgo.getDate() - 7);
                                    return createdDate >= weekAgo;

                                case 'Monthly':
                                    // Last 30 days
                                    const monthAgo = new Date(today);
                                    monthAgo.setDate(monthAgo.getDate() - 30);
                                    return createdDate >= monthAgo;

                                default:
                                    return true;
                            }
                        });
                    }

                    return filtered;
                },

                // Computed properties for pagination - MODIFIED to use filteredLoanTypes
                get totalPages() {
                    return Math.ceil(this.filteredLoanTypes.length / this.itemsPerPage);
                },

                get paginatedLoans() {
                    const start = (this.page - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.filteredLoanTypes.slice(start, end);
                },

                get startEntry() {
                    return (this.page - 1) * this.itemsPerPage + 1;
                },

                get endEntry() {
                    const end = this.page * this.itemsPerPage;
                    return end > this.filteredLoanTypes.length ? this.filteredLoanTypes.length : end;
                },

                // NEW: Filter method
                performFilter() {
                    this.page = 1; // Reset to first page when filtering
                },

                // NEW: Print function for loans report
                printLoansReport() {
                    // Create a new window for printing
                    const printWindow = window.open('', '_blank');

                    // Get current filtered and paginated data
                    const currentData = this.paginatedLoans;

                    // Generate table rows HTML
                    const tableRows = currentData.map(loan => `
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${loan.LoanTypeID || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">
                                <div><strong>${loan.Type || 'N/A'}</strong></div>
                                <div style="font-size: 12px; color: #6b7280;">Interest: ${loan.InterestRate || '0%'}</div>
                            </td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${loan.Repayment || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${loan.TotalLoaned || 'Ksh 0'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${loan.ActiveLoans || 0}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">${loan.CreatedOn || 'N/A'}</td>
                            <td style="padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb;">
                                <span style="display: inline-block; padding: 4px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500;
                                    ${loan.Status === 'Active' ? 'background-color: #d1fae5; color: #065f46;' :
                                    loan.Status === 'In-Active' ? 'background-color: #fed7aa; color: #92400e;' :
                                    loan.Status === 'Under Review' ? 'background-color: #fef3c7; color: #92400e;' :
                                    'background-color: #f3f4f6; color: #1f2937;'}">
                                    ${loan.Status || 'N/A'}
                                </span>
                            </td>
                        </tr>
                    `).join('');

                    // Write the print document
                    printWindow.document.write(`
                        <html>
                        <head>
                            <title>Loan Types Report</title>
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
                            <h1>Loan Types Report</h1>
                            <div class="header">
                                <div>Generated on: ${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}</div>
                                <div>Filters: Frequency - ${this.frequencyFilter === 'All' ? 'All Time' : this.frequencyFilter}, Status - ${this.statusFilter === 'All' ? 'All Status' : this.statusFilter}</div>
                                <div>Showing ${this.startEntry} to ${this.endEntry} of ${this.filteredLoanTypes.length} loan types</div>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Loan ID</th>
                                        <th>Loan Type / Interest</th>
                                        <th>Repayment</th>
                                        <th>Total Loaned</th>
                                        <th>Active Loans</th>
                                        <th>Created On</th>
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
                    if (page >= 1 && page <= this.totalPages) {
                        this.page = page;
                    }
                },

                // Edit loan type modal function - UPDATED
                editLoanTypeModal(loanType) {
                    console.log('1. Raw loanType received:', loanType);
                    console.log('2. MaxAmount value:', loanType.MaxAmount);
                    // Create a copy of the loan type data for editing
                    const loanTypeCopy = {
                        // Keep original properties
                        LoanTypeID: loanType.LoanTypeID,
                        Type: loanType.Type,
                        InterestRate: loanType.InterestRate,
                        TotalLoaned: loanType.TotalLoaned,
                        MaxAmount: loanType.MaxAmount,
                        Repayment: loanType.Repayment,
                        Status: loanType.Status,
                        CreatedOn: loanType.CreatedOn,

                        // Add numeric versions for form binding
                        InterestRateNumber: 0,
                        TotalLoanedNumber: 0,
                        RepaymentNumber: 0
                    };

                    // Extract just the number from InterestRate (remove " %")
                    if (loanType.InterestRate && typeof loanType.InterestRate === 'string') {
                        loanTypeCopy.InterestRateNumber = parseFloat(loanType.InterestRate.replace(' %', ''));
                        console.log('InterestRate parsed:', loanType.InterestRate, '->', loanTypeCopy.InterestRateNumber);
                    }

                    // Extract just the number from TotalLoaned (remove "Ksh " and commas)
                    if (loanType.TotalLoaned && typeof loanType.TotalLoaned === 'string') {
                        const cleanAmount = loanType.TotalLoaned
                            .replace('Ksh ', '')
                            .replace(/,/g, '');
                        loanTypeCopy.TotalLoanedNumber = Number(loanType.MaxAmount);
                        console.log('TotalLoaned parsed:', loanType.TotalLoaned, '->', loanTypeCopy.TotalLoanedNumber);
                    }

                    // Extract just the number from Repayment (remove " months")
                    if (loanType.Repayment && typeof loanType.Repayment === 'string') {
                        loanTypeCopy.RepaymentNumber = parseInt(loanType.Repayment.replace(' months', '')) || 0;
                        console.log('Repayment parsed:', loanType.Repayment, '->', loanTypeCopy.RepaymentNumber);
                    }

                    console.log('Final loanTypeCopy:', loanTypeCopy);

                    // Store the current loan type for editing
                    if (Alpine.store('loanTypeData')) {
                        Alpine.store('loanTypeData').currentLoanType = loanTypeCopy;
                        Alpine.store('loanTypeData').editLoanTypeModal = true;
                    }
                },
            };
        }

        // Store for loan type data and modal state
        function loanTypeStore() {
            return {
                // Modal states
                loanTypeModal: false,
                editLoanTypeModal: false,

                // Current loan type for editing
                currentLoanType: null,

                // Methods
                openNewLoanTypeModal() {
                    this.loanTypeModal = true;
                },

                openEditLoanTypeModal(loanType) {
                    this.currentLoanType = loanType;
                    this.editLoanTypeModal = true;
                },

                // Update loans type
                updateLoanType() {
                    // Get current values directly from the form inputs
                    const loanTypeId = document.querySelector('input[name="loan_type_id"]').value;
                    const loanTypeName = document.querySelector('input[name="loan_type_name"]').value;
                    const interestRate = document.querySelector('input[name="interest_rate"]').value;
                    const maxAmount = document.querySelector('input[name="max_amount"]').value;
                    const repaymentPeriod = document.querySelector('select[name="repayment_period_months"]').value;
                    const status = document.querySelector('select[name="status"]').value;

                    // Validate fields are not empty
                    if (!loanTypeName || loanTypeName.trim() === '') {
                        alert('Error: Loan Type Name cannot be empty');
                        return;
                    }
                    if (!interestRate && interestRate !== '0') {
                        alert('Error: Interest Rate cannot be empty');
                        return;
                    }
                    if (!maxAmount && maxAmount !== '0') {
                        alert('Error: Max Borrowable cannot be empty');
                        return;
                    }
                    if (!repaymentPeriod || repaymentPeriod === 'Repayment') {
                        alert('Error: Please select a Repayment Scheme');
                        return;
                    }
                    if (!status || status === 'Status') {
                        alert('Error: Please select a Status');
                        return;
                    }

                    // Change button text to Updating...
                    const updateBtn = document.querySelector('#updateLoanTypeBtn');
                    if (updateBtn) {
                        updateBtn.disabled = true;
                        updateBtn.innerHTML = 'Updating...';
                    }

                    // Wait 0.75 seconds
                    setTimeout(() => {
                        // Get CSRF token from meta tag
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                        if (!token) {
                            alert('Error: CSRF token not found');
                            if (updateBtn) {
                                updateBtn.disabled = false;
                                updateBtn.innerHTML = 'Update Loan Type';
                            }
                            return;
                        }

                        // Log what we're sending
                        console.log('Sending to server:', {
                            loan_type_id: loanTypeId,
                            loan_type_name: loanTypeName,
                            interest_rate: interestRate,
                            max_amount: maxAmount,
                            repayment_period_months: repaymentPeriod,
                            status: status
                        });

                        // Send as JSON
                        fetch('/treasurer/bodaboda/loan-types/update', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                loan_type_id: loanTypeId,
                                loan_type_name: loanTypeName,
                                interest_rate: interestRate,
                                max_amount: maxAmount,
                                repayment_period_months: repaymentPeriod,
                                status: status
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    throw new Error(err.message || `HTTP error ${response.status}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            alert(data.message);
                            if (data.success) {
                                window.location.href = '/treasurer/bodaboda';
                            } else {
                                if (updateBtn) {
                                    updateBtn.disabled = false;
                                    updateBtn.innerHTML = 'Update Loan Type';
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            alert('Network error: ' + error.message);
                            if (updateBtn) {
                                updateBtn.disabled = false;
                                updateBtn.innerHTML = 'Update Loan Type';
                            }
                        });
                    }, 750);
                },

                // Delete loans type
                deleteLoanType(loanTypeId, loanTypeName) {
                    const deleteBtn = document.querySelector('#deleteLoanTypeBtn');
                    if (deleteBtn) {
                        deleteBtn.disabled = true;
                        deleteBtn.innerHTML = 'Deleting...';
                    }

                    setTimeout(() => {
                        if (confirm(`Are you sure you want to delete Loan Type: ${loanTypeId} - ${loanTypeName}?`)) {
                            const formData = new FormData();

                            // FIXED: Get CSRF token from the form input
                            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                            formData.append('_token', csrfToken);
                            formData.append('loan_type_id', loanTypeId);

                            fetch('/treasurer/bodaboda/loan-types/delete', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    window.location.href = '/treasurer/bodaboda';
                                } else {
                                    alert('Error: ' + data.message);
                                    if (deleteBtn) {
                                        deleteBtn.disabled = false;
                                        deleteBtn.innerHTML = 'Delete';
                                    }
                                }
                            })
                            .catch(error => {
                                alert('Error: Could not connect to server');
                                if (deleteBtn) {
                                    deleteBtn.disabled = false;
                                    deleteBtn.innerHTML = 'Delete';
                                }
                            });
                        } else {
                            if (deleteBtn) {
                                deleteBtn.disabled = false;
                                deleteBtn.innerHTML = 'Delete';
                            }
                        }
                    }, 750);
                },

                // Form validation function
                validateLoanForm(event) {
                    // Prevent default form submission
                    if (event) event.preventDefault();

                    // Get form values
                    const loanType = document.getElementById('newLoanType').value.trim();
                    const interestRate = document.getElementById('loanInterestRate').value.trim();
                    const maxAmount = document.getElementById('loanMaxAmount').value.trim();
                    const repaymentPeriod = document.getElementById('loanRepaymentPeriod').value;
                    const status = document.getElementById('newLoanStatus').value;

                    // Check if required fields are empty
                    if (!loanType) {
                        alert('Loan Type is required');
                        return false;
                    }
                    if (!interestRate) {
                        alert('Interest Rate is required');
                        return false;
                    }
                    if (!maxAmount) {
                        alert('Max Amount is required');
                        return false;
                    }
                    if (!repaymentPeriod || repaymentPeriod === 'All') {
                        alert('Repayment Period is required');
                        return false;
                    }
                    if (!status || status === 'Status') {
                        alert('Status is required');
                        return false;
                    }

                    // If all validations pass
                    return true;
                },

                // Add to your existing loanTypeStore() function
                submitLoanForm(event) {
                    if (event) event.preventDefault();

                    // First validate
                    if (!this.validateLoanForm(event)) {
                        return false;
                    }

                    const button = event.target;
                    const originalText = button.textContent;
                    button.textContent = 'Creating Loan Type...';
                    button.disabled = true;

                    // Collect form data
                    const formData = new FormData();
                    formData.append('newLoanType', document.getElementById('newLoanType').value);
                    formData.append('loanInterestRate', document.getElementById('loanInterestRate').value);
                    formData.append('loanMaxAmount', document.getElementById('loanMaxAmount').value);
                    formData.append('loanRepaymentPeriod', document.getElementById('loanRepaymentPeriod').value);
                    formData.append('newLoanStatus', document.getElementById('newLoanStatus').value);

                    // Send to Laravel
                    fetch('/loans/create', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        setTimeout(() => {
                            alert(data.message);
                            button.textContent = originalText;
                            button.disabled = false;
                            if (data.success) {
                                window.location.href = "{{ route('treasurer.bodaboda') }}";
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            alert('Error: ' + error.message);
                            button.textContent = originalText;
                            button.disabled = false;
                        }, 750);
                    });

                    return false;
                },
            };
        }

        // Initialize Alpine components
        document.addEventListener('alpine:init', () => {
            // Register the loanTypesTable component
            Alpine.data('loanTypesTable', loanTypesTable);

            // Register the loanType store
            Alpine.store('loanTypeData', loanTypeStore());

            // Add to your existing Alpine.store or create a new one
            Alpine.store('loanStats', {
                activeLoans: 0,

                init() {
                    this.loadActiveLoans();
                },

                loadActiveLoans() {
                    fetch('/stats/loans/active')
                        .then(res => res.json())
                        .then(data => {
                            this.activeLoans = data.count || 0;
                        })
                        .catch(error => {
                            console.error('Error loading active loans:', error);
                            this.activeLoans = 0;
                        });
                }
            });

            // Initialize on page load
            document.addEventListener('alpine:initialized', () => {
                if (Alpine.store('loanStats')) {
                    Alpine.store('loanStats').init();
                }
            });
        });
    </script>

    <script>
            // loan-calculator.js - Loan Calculator Functionality
        function loanCalculator() {
            return {
                // Form fields
                loanType: '',
                loanAmount: 10000,
                repaymentPeriod: '12',

                // Calculation results
                interestRate: 0.00,
                repaymentFrequency: 'Monthly',
                monthlyPayment: 0.00,
                totalInterest: 0.00,
                totalLoanAmount: 0.00,

                // Payment schedule
                firstPaymentDate: '-',
                lastPaymentDate: '-',
                numberOfPayments: 0,

                // Initialize function
                init() {
                this.calculateLoan(); // Calculate initial values
                },

                // Format currency helper
                formatCurrency(amount) {
                return parseFloat(amount).toLocaleString('en-KE', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                },

                // Calculate first payment date (always 5th of next month)
                calculateFirstPaymentDate() {
                const now = new Date();
                let firstPayment = new Date(now.getFullYear(), now.getMonth() + 1, 5);

                // If today is after the 5th of the current month, show next month's 5th
                // If today is before or on the 5th, show this month's 5th (if still upcoming)
                if (now.getDate() <= 5) {
                    // If today is on or before the 5th, check if this month's 5th has passed
                    const currentMonthFifth = new Date(now.getFullYear(), now.getMonth(), 5);
                    if (currentMonthFifth >= now) {
                    firstPayment = currentMonthFifth;
                    }
                }

                return firstPayment.toLocaleDateString('en-US', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });
                },

                // Calculate last payment date based on repayment period
                calculateLastPaymentDate() {
                const now = new Date();
                const monthsToAdd = parseInt(this.repaymentPeriod) || 0;
                const firstPaymentDate = new Date();

                // Set to 5th of next month as base
                firstPaymentDate.setMonth(firstPaymentDate.getMonth() + 1);
                firstPaymentDate.setDate(5);

                // Calculate last payment date
                const lastPayment = new Date(firstPaymentDate);
                lastPayment.setMonth(lastPayment.getMonth() + monthsToAdd - 1);

                return lastPayment.toLocaleDateString('en-US', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });
                },

                // Calculate interest rate based on loan type
                getInterestRateByType() {
                const rates = {
                    'personal': 15.0,
                    'business': 18.0,
                    'emergency': 12.0,
                    'education': 10.0,
                    'vehicle': 14.0
                };

                return this.loanType ? (rates[this.loanType] || 12.0) : 12.0;
                },

                // Main calculation function
                calculateLoan() {
                // Get values
                const amount = parseFloat(this.loanAmount) || 0;
                const period = parseInt(this.repaymentPeriod) || 0;

                // Set interest rate based on loan type
                this.interestRate = this.getInterestRateByType();

                // Set repayment frequency (always monthly for now)
                this.repaymentFrequency = 'Monthly';
                this.numberOfPayments = period;

                // Calculate monthly interest rate
                const monthlyInterestRate = (this.interestRate / 100) / 12;

                // Calculate monthly payment using loan formula
                if (amount > 0 && period > 0 && monthlyInterestRate > 0) {
                    // Formula: M = P * (r(1+r)^n) / ((1+r)^n - 1)
                    const numerator = monthlyInterestRate * Math.pow(1 + monthlyInterestRate, period);
                    const denominator = Math.pow(1 + monthlyInterestRate, period) - 1;

                    this.monthlyPayment = amount * (numerator / denominator);
                    this.totalLoanAmount = this.monthlyPayment * period;
                    this.totalInterest = this.totalLoanAmount - amount;
                } else {
                    // Simple interest calculation if no valid period
                    this.monthlyPayment = amount / period;
                    this.totalLoanAmount = amount;
                    this.totalInterest = 0;
                }

                // Update payment dates
                this.firstPaymentDate = this.calculateFirstPaymentDate();
                this.lastPaymentDate = this.calculateLastPaymentDate();
                },

                // Reset calculator
                resetCalculator() {
                this.loanType = '';
                this.loanAmount = 10000;
                this.repaymentPeriod = '12';
                this.calculateLoan(); // Recalculate with reset values
                },

                // Simulate automation (placeholder for future functionality)
                simulateAutomation() {
                console.log('Simulate Automation clicked with data:', {
                    loanType: this.loanType,
                    loanAmount: this.loanAmount,
                    repaymentPeriod: this.repaymentPeriod,
                    interestRate: this.interestRate,
                    monthlyPayment: this.monthlyPayment,
                    totalInterest: this.totalInterest,
                    totalLoanAmount: this.totalLoanAmount
                });

                // Show a success message
                alert('Loan simulation would be processed here. This feature will be implemented later.');

                // You can add more functionality here later
                // For example: API call, generating a payment schedule, etc.
                }
            };
        }

        // Initialize Alpine component
        document.addEventListener('alpine:init', () => {
        Alpine.data('loanCalculator', loanCalculator);
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
                                transactionCode: item.transactionCode || 'N/A',
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

    <!-- Bonuses Alpine ------------------------------------------------------------------------ -->
    <script>
        // bonusesTable.js - Data binding and pagination functionality for bonuses
        function bonusesTable() {
            return {
                // Bonuses data - loaded from Laravel backend
                bonuses: [],
                page: 1,
                itemsPerPage: 10,

                // Initialize function - loads data from Laravel
                async init() {
                    console.log('Bonuses table initialized');
                    await this.loadBonuses();
                },

                // Load bonuses from Laravel backend
                async loadBonuses() {
                    try {
                        const response = await fetch('/bonus-types/summary');
                        const data = await response.json();

                        if (data && data.data) {
                            // Transform Laravel data for frontend display
                            this.bonuses = data.data.map(bonus => ({
                                BonusID: bonus.bonusId || '',
                                Type: bonus.bonus_name || '',
                                CalculationMethod: bonus.calculation_method || '',
                                Percentage: `${bonus.percentage || 0}%`,
                                TotalBonusAmount: `Ksh ${parseFloat(bonus.total_bonus_amount || 0).toLocaleString()}`,
                                TotalBonusesGiven: bonus.total_bonuses_given || 0,
                                CreatedOn: new Date(bonus.created_on || Date.now()).toLocaleDateString('en-GB', {
                                    day: '2-digit',
                                    month: 'short',
                                    year: 'numeric'
                                }),
                                Status: bonus.status || 'Active'
                            }));
                        }
                    } catch (error) {
                        console.error('Error loading bonuses:', error);
                        // Keep empty array if error
                        this.bonuses = [];
                    }
                },

                // Computed properties for pagination
                get totalPages() {
                    return Math.ceil(this.bonuses.length / this.itemsPerPage);
                },

                get paginatedBonuses() {
                    const start = (this.page - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.bonuses.slice(start, end);
                },

                get startEntry() {
                    return (this.page - 1) * this.itemsPerPage + 1;
                },

                get endEntry() {
                    const end = this.page * this.itemsPerPage;
                    return end > this.bonuses.length ? this.bonuses.length : end;
                },

                get rows() {
                    return this.bonuses;
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
                    if (page >= 1 && page <= this.totalPages) {
                        this.page = page;
                    }
                },
            };
        }

        // Initialize Alpine components for bonuses
        document.addEventListener('alpine:init', () => {
            // Register the bonusesTable component
            Alpine.data('bonusesTable', bonusesTable);

            // Form validation
            Alpine.store('bonusFormData', {

                validateBonusForm(event) {
                    if (event) event.preventDefault();

                    const bonusType = document.getElementById('newBonusType')?.value.trim();
                    const percentage = document.getElementById('newBonusPercentage')?.value.trim();
                    const status = document.getElementById('newBonusStatus')?.value;

                    if (!bonusType) {
                        alert('Bonus Type is required');
                        return false;
                    }
                    if (!percentage) {
                        alert('Percentage is required');
                        return false;
                    }
                    if (!status || status === 'Status') {
                        alert('Status is required');
                        return false;
                    }

                    return true;
                },

                submitBonusForm(event) {
                    if (event) event.preventDefault();

                    // First validate
                    if (!this.validateBonusForm(event)) {
                        return false;
                    }

                    const button = event.target;
                    const originalText = button.textContent;
                    button.textContent = 'Creating Bonus...';
                    button.disabled = true;

                    // Collect form data
                    const formData = new FormData();
                    formData.append('newBonusType', document.getElementById('newBonusType').value);
                    formData.append('bonusDescription', document.getElementById('bonusDescription').value);
                    formData.append('newBonusPercentage', document.getElementById('newBonusPercentage').value);
                    formData.append('newBonusStatus', document.getElementById('newBonusStatus').value);

                    // Send to Laravel
                    fetch('/bonuses/create', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        setTimeout(() => {
                            alert(data.message);
                            button.textContent = originalText;
                            button.disabled = false;
                            if (data.success) {
                                window.location.href = "{{ route('treasurer.bodaboda') }}";
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            alert('Error: ' + error.message);
                            button.textContent = originalText;
                            button.disabled = false;
                        }, 750);
                    });

                    return false;
                },
            });

           // Bonus modal store - UPDATED
            Alpine.store('bonusTypeData', {
                editBonusTypeModal: false,
                currentBonus: null,

                // Add this method
                editBonus(bonus) {
                    // Create a copy of the bonus data for editing
                    const bonusCopy = { ...bonus };

                    // Extract just the number from Percentage (remove "%")
                    if (bonusCopy.Percentage && typeof bonusCopy.Percentage === 'string') {
                        bonusCopy.PercentageNumber = parseFloat(bonusCopy.Percentage.replace('%', ''));
                    } else {
                        bonusCopy.PercentageNumber = 0;
                    }

                    // Store the current bonus for editing
                    this.currentBonus = bonusCopy;
                    this.editBonusTypeModal = true;
                },

                // Update bonus type
                updateBonusType() {
                    // Get values directly from form inputs (NOT from x-model bindings)
                    const bonusId = document.querySelector('input[name="bonus_id"]').value;
                    const bonusName = document.querySelector('input[name="uBonusType"]').value;
                    const description = document.querySelector('textarea[name="uBonusDescription"]').value;
                    const percentage = document.querySelector('input[name="uBonusPercentage"]').value;
                    const status = document.querySelector('select[name="uBonusStatus"]').value;

                    // Log what we're getting
                    console.log('Bonus ID:', bonusId);
                    console.log('Bonus Name:', bonusName);
                    console.log('Description:', description);
                    console.log('Percentage:', percentage);
                    console.log('Status:', status);

                    // Validate fields are not empty
                    if (!bonusName || bonusName.trim() === '') {
                        alert('Error: Bonus Type Name cannot be empty');
                        return;
                    }
                    if (!description || description.trim() === '') {
                        alert('Error: Description cannot be empty');
                        return;
                    }
                    if (!percentage && percentage !== '0') {
                        alert('Error: Percentage cannot be empty');
                        return;
                    }
                    if (!status || status === 'Status') {
                        alert('Error: Please select a Status');
                        return;
                    }

                    // Change button text to Updating...
                    const updateBtn = document.querySelector('#updateBonusTypeBtn');
                    if (updateBtn) {
                        updateBtn.disabled = true;
                        updateBtn.innerHTML = 'Updating...';
                    }

                    // Wait 0.75 seconds
                    setTimeout(() => {
                        // Get CSRF token from meta tag
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                        if (!token) {
                            alert('Error: CSRF token not found');
                            if (updateBtn) {
                                updateBtn.disabled = false;
                                updateBtn.innerHTML = 'Update Bonus';
                            }
                            return;
                        }

                        // Log what we're sending
                        console.log('Sending to server:', {
                            bonus_id: bonusId,
                            bonus_name: bonusName,
                            description: description,
                            percentage: percentage,
                            status: status
                        });

                        // Send as JSON
                        fetch('/treasurer/bodaboda/bonus-types/update', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                bonus_id: bonusId,
                                bonus_name: bonusName,
                                description: description,
                                percentage: percentage,
                                status: status
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    throw new Error(err.message || `HTTP error ${response.status}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            alert(data.message);
                            if (data.success) {
                                window.location.href = '/treasurer/bodaboda';
                            } else {
                                if (updateBtn) {
                                    updateBtn.disabled = false;
                                    updateBtn.innerHTML = 'Update Bonus';
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            alert('Network error: ' + error.message);
                            if (updateBtn) {
                                updateBtn.disabled = false;
                                updateBtn.innerHTML = 'Update Bonus';
                            }
                        });
                    }, 750);
                },

                deleteBonusType(bonusId, bonusName) {
                    // Change button text to Deleting...
                    const deleteBtn = document.querySelector('#deleteBonusTypeBtn');
                    if (deleteBtn) {
                        deleteBtn.disabled = true;
                        deleteBtn.innerHTML = 'Deleting...';
                    }

                    // Wait 0.75 seconds
                    setTimeout(() => {
                        // Confirm delete with ID + Name
                        if (confirm(`Are you sure you want to delete Bonus Type: ${bonusId} - ${bonusName}?`)) {
                            // Prepare form data
                            const formData = new FormData();
                            formData.append('_token', document.querySelector('input[name="_token"]').value);
                            formData.append('bonus_id', bonusId);

                            // Send to Laravel backend
                            fetch('/treasurer/bodaboda/bonus-types/delete', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    window.location.href = '/treasurer/bodaboda';
                                } else {
                                    alert('Error: ' + data.message);
                                    // Reset button
                                    if (deleteBtn) {
                                        deleteBtn.disabled = false;
                                        deleteBtn.innerHTML = 'Delete';
                                    }
                                }
                            })
                            .catch(error => {
                                alert('Error: Could not connect to server');
                                // Reset button
                                if (deleteBtn) {
                                    deleteBtn.disabled = false;
                                    deleteBtn.innerHTML = 'Delete';
                                }
                            });
                        } else {
                            // Reset button if user cancels
                            if (deleteBtn) {
                                deleteBtn.disabled = false;
                                deleteBtn.innerHTML = 'Delete';
                            }
                        }
                    }, 750);
                }

            });

        });
    </script>

    <!-- Fines Alpine -------------------------------------------------------------------------- -->
    <script>
        // finesTable.js - Data binding and pagination functionality for fines
        function finesTable() {
            return {
                // Fines data - loaded from Laravel backend
                fines: [],
                page: 1,
                itemsPerPage: 10,

                // Initialize function - loads data from Laravel
                async init() {
                    console.log('Fines table initialized');
                    await this.loadFines();
                },

                // Load fines from Laravel backend
                async loadFines() {
                    try {
                        const response = await fetch('/fine-types/summary');
                        const data = await response.json();

                        if (data && data.data) {
                            // Transform Laravel data for frontend display
                            this.fines = data.data.map(item => ({
                                FineID: item.fineId || '',
                                Type: item.fine_name || '',
                                Description: item.description || '',
                                Percentage: `${item.percentage || 0}%`,
                                IsPercentage: item.is_percentage ? 'Yes' : 'No',
                                TotalFineAmount: `Ksh ${parseFloat(item.total_fine_amount || 0).toLocaleString()}`,
                                TotalFinesIssued: item.total_fines_issued || 0,
                                CreatedOn: new Date(item.created_on || Date.now()).toLocaleDateString('en-GB', {
                                    day: '2-digit',
                                    month: 'short',
                                    year: 'numeric'
                                }),
                                Status: item.status || 'Active'
                            }));
                        }
                    } catch (error) {
                        console.error('Error loading fines:', error);
                        // Keep empty array if error
                        this.fines = [];
                    }
                },

                // Computed properties for pagination
                get totalPages() {
                    return Math.ceil(this.fines.length / this.itemsPerPage);
                },

                get paginatedFines() {
                    const start = (this.page - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.fines.slice(start, end);
                },

                get startEntry() {
                    return (this.page - 1) * this.itemsPerPage + 1;
                },

                get endEntry() {
                    const end = this.page * this.itemsPerPage;
                    return end > this.fines.length ? this.fines.length : end;
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
                    if (page >= 1 && page <= this.totalPages) {
                        this.page = page;
                    }
                }
            };
        }

        // Initialize Alpine components for fines
        document.addEventListener('alpine:init', () => {
            // Register the finesTable component
            Alpine.data('finesTable', finesTable);

            // Add this store for fines form
            Alpine.store('fineFormData', {
                validateFineForm(event) {
                    if (event) event.preventDefault();

                    const fineType = document.getElementById('newFineType')?.value.trim();
                    const percentage = document.getElementById('newFinePercentage')?.value.trim();
                    const status = document.getElementById('newFineStatus')?.value;

                    if (!fineType) {
                        alert('Fine Type is required');
                        return false;
                    }
                    if (!percentage) {
                        alert('Percentage is required');
                        return false;
                    }
                    if (!status || status === 'Status') {
                        alert('Status is required');
                        return false;
                    }

                    return true;
                },

                // Add to your existing fineFormStore() function
                submitFineForm(event) {
                    if (event) event.preventDefault();

                    // First validate
                    if (!this.validateFineForm(event)) {
                        return false;
                    }

                    const button = event.target;
                    const originalText = button.textContent;
                    button.textContent = 'Creating Fine...';
                    button.disabled = true;

                    // Collect form data
                    const formData = new FormData();
                    formData.append('newFineType', document.getElementById('newFineType').value);
                    formData.append('fineDescription', document.getElementById('fineDescription').value);
                    formData.append('newFinePercentage', document.getElementById('newFinePercentage').value);
                    formData.append('newFineStatus', document.getElementById('newFineStatus').value);

                    // Send to Laravel
                    fetch('/fines/create', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        setTimeout(() => {
                            alert(data.message);
                            button.textContent = originalText;
                            button.disabled = false;
                            if (data.success) {
                                window.location.href = "{{ route('treasurer.bodaboda') }}";
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            alert('Error: ' + error.message);
                            button.textContent = originalText;
                            button.disabled = false;
                        }, 750);
                    });

                    return false;
                },

            });

            // ⭐⭐ Add fine modal store ⭐⭐
            Alpine.store('fineTypeData', {
                editFineTypeModal: false,
                currentFine: null,

                // Method to edit fine
                editFine(fine) {
                    // Create a copy of the fine data for editing
                    const fineCopy = { ...fine };

                    // Extract just the number from Percentage (remove "%")
                    if (fineCopy.Percentage && typeof fineCopy.Percentage === 'string') {
                        fineCopy.PercentageNumber = parseFloat(fineCopy.Percentage.replace('%', ''));
                    } else {
                        fineCopy.PercentageNumber = 0;
                    }

                    // Store the current fine for editing
                    this.currentFine = fineCopy;
                    this.editFineTypeModal = true;
                },

                // Method to update fine
                updateFineType() {
                    // Get values directly from form inputs
                    const fineId = document.querySelector('input[name="fine_id"]').value;
                    const fineName = document.querySelector('input[name="uFineType"]').value;
                    const description = document.querySelector('textarea[name="uFineDescription"]').value;
                    const percentage = document.querySelector('input[name="uFinePercentage"]').value;
                    const status = document.querySelector('select[name="uStatus"]').value;

                    // Log what we're getting
                    console.log('Fine ID:', fineId);
                    console.log('Fine Name:', fineName);
                    console.log('Description:', description);
                    console.log('Percentage:', percentage);
                    console.log('Status:', status);

                    // Validate fields are not empty
                    if (!fineName || fineName.trim() === '') {
                        alert('Error: Fine Type Name cannot be empty');
                        return;
                    }
                    if (!description || description.trim() === '') {
                        alert('Error: Description cannot be empty');
                        return;
                    }
                    if (!percentage && percentage !== '0') {
                        alert('Error: Percentage cannot be empty');
                        return;
                    }
                    if (!status || status === 'Status') {
                        alert('Error: Please select a Status');
                        return;
                    }

                    // Change button text to Updating...
                    const updateBtn = document.querySelector('#updateFineTypeBtn');
                    if (updateBtn) {
                        updateBtn.disabled = true;
                        updateBtn.innerHTML = 'Updating...';
                    }

                    // Wait 0.75 seconds
                    setTimeout(() => {
                        // Get CSRF token from meta tag
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                        if (!token) {
                            alert('Error: CSRF token not found');
                            if (updateBtn) {
                                updateBtn.disabled = false;
                                updateBtn.innerHTML = 'Update Fine';
                            }
                            return;
                        }

                        // Log what we're sending
                        console.log('Sending to server:', {
                            fine_id: fineId,
                            fine_name: fineName,
                            description: description,
                            percentage: percentage,
                            is_percentage: 1,
                            status: status
                        });

                        // Send as JSON
                        fetch('/treasurer/bodaboda/fine-types/update', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                fine_id: fineId,
                                fine_name: fineName,
                                description: description,
                                percentage: percentage,
                                is_percentage: 1,
                                status: status
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    throw new Error(err.message || `HTTP error ${response.status}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            alert(data.message);
                            if (data.success) {
                                window.location.href = '/treasurer/bodaboda';
                            } else {
                                if (updateBtn) {
                                    updateBtn.disabled = false;
                                    updateBtn.innerHTML = 'Update Fine';
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            alert('Network error: ' + error.message);
                            if (updateBtn) {
                                updateBtn.disabled = false;
                                updateBtn.innerHTML = 'Update Fine';
                            }
                        });
                    }, 750);
                },

                deleteFineType(fineId, fineName) {
                    // Change button text to Deleting...
                    const deleteBtn = document.querySelector('#deleteFineTypeBtn');
                    if (deleteBtn) {
                        deleteBtn.disabled = true;
                        deleteBtn.innerHTML = 'Deleting...';
                    }

                    // Wait 0.75 seconds
                    setTimeout(() => {
                        // Confirm delete with ID + Name
                        if (confirm(`Are you sure you want to delete Fine Type: ${fineId} - ${fineName}?`)) {
                            // Prepare form data
                            const formData = new FormData();
                            formData.append('_token', document.querySelector('input[name="_token"]').value);
                            formData.append('fine_id', fineId);

                            // Send to Laravel backend
                            fetch('/treasurer/bodaboda/fine-types/delete', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    window.location.href = '/treasurer/bodaboda';
                                } else {
                                    alert('Error: ' + data.message);
                                    // Reset button
                                    if (deleteBtn) {
                                        deleteBtn.disabled = false;
                                        deleteBtn.innerHTML = 'Delete';
                                    }
                                }
                            })
                            .catch(error => {
                                alert('Error: Could not connect to server');
                                // Reset button
                                if (deleteBtn) {
                                    deleteBtn.disabled = false;
                                    deleteBtn.innerHTML = 'Delete';
                                }
                            });
                        } else {
                            // Reset button if user cancels
                            if (deleteBtn) {
                                deleteBtn.disabled = false;
                                deleteBtn.innerHTML = 'Delete';
                            }
                        }
                    }, 750);
                }

            });

        });

    </script>

</body>

</html>
