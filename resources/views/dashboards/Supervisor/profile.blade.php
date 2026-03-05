
<!doctype html>
<html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ Auth::user()->role }} | KFBCL </title>

        <link rel="icon" href="{{ asset('assets/favicon.ico') }}">
        <link href="{{ asset('assets/style.css') }}" rel="stylesheet">

        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>

    <body x-data="{ page: 'profile', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false, 'isProfileEditNextKinModal': false, 'isProfileInfoModal': false,  'isProfileContactModal': false, 'isProfileNextKinModal': false, 'isProfileAddressModal': false, 'isDeleteModalOpen': false }" x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value =&gt; localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark bg-gray-900': darkMode === true}">
        <!-- ===== Preloader Start ===== -->
        <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () =&gt; {setTimeout(() =&gt; loaded = false, 500)})" class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black" style="display: none;">
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
            <div :class="sidebarToggle ? 'block xl:hidden' : 'hidden'" class="fixed z-50 h-screen w-full bg-gray-900/50 hidden"></div>
            <!-- Small Device Overlay End -->

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

            <!-- ===== Main Content Start ===== -->
            <main>
            <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
                <!-- Breadcrumb Start -->
                <div x-data="{ pageName: `Profile`}">
                <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName">Profile</h2>
                    <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="index.php">Home
                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                        </li>
                        <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName">Profile</li>
                    </ol>
                    </nav>
                </div>
                </div>
                <!-- Breadcrumb End -->
                <!-- Profile Management -->
                <div class="rounded-2xl border border-gray-200 bg-white p-5 lg:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
                <h3 class="mb-5 text-lg font-semibold text-gray-800 lg:mb-7 dark:text-white/90">User: #USR{{ Auth::user()->id }}</h3>

                <div class="mb-6 rounded-2xl border border-gray-200 p-5 lg:p-6 dark:border-gray-800">
                    <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
                        <div class="flex w-full flex-col items-center gap-6 xl:flex-row">
                            <div class="h-[78px] w-[78px] overflow-hidden rounded-full border border-gray-200 bg-gray-100 flex items-center justify-center dark:border-gray-800 dark:bg-gray-800">
                            <svg class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            </div>
                            <div class="order-3 xl:order-2">
                            <h4 class="mb-2 text-center text-lg font-semibold text-gray-800 xl:text-left dark:text-white/90">
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                            </h4>
                            <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                <p class="text-sm text-gray-500 dark:text-gray-400"> {{ Auth::user()->role }} </p>
                                <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                <p class="text-sm text-gray-500 dark:text-gray-400"><span class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 text-xs font-medium">Active</span> since {{ Auth::user()->created_at->format('M d, Y H:i') }}.</p>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 p-6 dark:border-gray-800" x-data="{ activeTab: 'personal' }">
                    <div class="flex flex-col gap-6 sm:flex-row sm:gap-8">
                    <!-- Left Sidebar Menu -->
                    <div class="overflow-x-auto pb-2 sm:w-[280px] [&amp;::-webkit-scrollbar-thumb]:rounded-full [&amp;::-webkit-scrollbar-thumb]:bg-gray-100 dark:[&amp;::-webkit-scrollbar-thumb]:bg-gray-600 [&amp;::-webkit-scrollbar-track]:bg-white dark:[&amp;::-webkit-scrollbar-track]:bg-transparent [&amp;::-webkit-scrollbar]:h-1.5">
                        <nav class="flex w-full flex-row sm:flex-col sm:space-y-2">
                            <button @click="activeTab = 'personal'" :class="activeTab === 'personal' ? 'bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'" class="inline-flex items-center gap-3 whitespace-nowrap rounded-lg px-3 py-2.5 text-sm font-medium transition-colors duration-200 ease-in-out sm:p-3 bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400">
                                <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Personal Information
                            </button>

                            <button @click="activeTab = 'addresses'" :class="activeTab === 'addresses' ? 'bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'" class="inline-flex items-center gap-3 whitespace-nowrap rounded-lg px-3 py-2.5 text-sm font-medium transition-colors duration-200 ease-in-out sm:p-3 text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Addresses
                            </button>

                            <button @click="activeTab = 'contact'" :class="activeTab === 'contact' ? 'bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'" class="inline-flex items-center gap-3 whitespace-nowrap rounded-lg px-3 py-2.5 text-sm font-medium transition-colors duration-200 ease-in-out sm:p-3 text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Contact Information
                            </button>

                            <button @click="activeTab = 'next-of-kin'" :class="activeTab === 'next-of-kin' ? 'bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'" class="inline-flex items-center gap-3 whitespace-nowrap rounded-lg px-3 py-2.5 text-sm font-medium transition-colors duration-200 ease-in-out sm:p-3 text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Next of Kin
                            </button>

                            <button @click="activeTab = 'settings'" :class="activeTab === 'settings' ? 'bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'" class="inline-flex items-center gap-3 whitespace-nowrap rounded-lg px-3 py-2.5 text-sm font-medium transition-colors duration-200 ease-in-out sm:p-3 text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Settings
                            </button>
                        </nav>
                    </div>

                    <!-- Right Content Area -->
                    <div class="flex-1">
                        <!-- Personal Information -->
                        <div x-show="activeTab === 'personal'">
                        <!-- Header: Title Left + Edit Button Right -->
                        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.4107 6.35C16.4107 8.74 14.4707 10.69 12.0707 10.69L12.0607 10.68C9.6707 10.68 7.7207 8.73 7.7207 6.34C7.7207 3.95 9.6807 2 12.0707 2C14.4607 2 16.4107 3.96 16.4107 6.35ZM14.9107 6.34C14.9107 4.78 13.6407 3.5 12.0707 3.5C10.5107 3.5 9.2307 4.78 9.2307 6.34C9.2307 7.9 10.5107 9.18 12.0707 9.18C13.6307 9.18 14.9107 7.9 14.9107 6.34Z" fill="#323544"></path>
                            <path opacity="0.4" d="M12 12.1895C14.67 12.1895 16.76 12.9395 18.21 14.4195V14.4095C20.2567 16.4956 20.2504 19.2563 20.25 19.4344L20.25 19.4395C20.24 19.8495 19.91 20.1795 19.5 20.1795H19.49C19.07 20.1695 18.75 19.8295 18.75 19.4195C18.75 19.3695 18.75 17.0895 17.13 15.4495C15.97 14.2795 14.24 13.6795 12 13.6795C9.76002 13.6795 8.03002 14.2795 6.87002 15.4495C5.25002 17.0995 5.25002 19.3995 5.25002 19.4195C5.25002 19.8295 4.92002 20.1795 4.51002 20.1795C4.15002 20.1995 3.75002 19.8595 3.75002 19.4495L3.75002 19.4448C3.74962 19.2771 3.74302 16.506 5.79002 14.4195C7.24002 12.9395 9.33002 12.1895 12 12.1895Z" fill="#323544"></path>
                            </svg>
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            Personal Information
                            </h3>
                            <button @click="isProfileInfoModal = true" class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 sm:w-auto dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z" fill=""></path>
                            </svg>
                            Edit
                            </button>
                        </div>

                        <!-- Details Grid Below -->
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Full Name</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                            </div>
                            <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Date of Birth</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">20 Feb 1985</p>
                            </div>
                            <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Gender</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ Auth::user()->gender }}</p>
                            </div>
                            <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Role</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                        </div>

                        <!-- Addresses -->
                        <div x-show="activeTab === 'addresses'" style="display: none;">
                        <!-- Header: Title Left + Edit Button Right -->
                        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            Addresses
                            </h3>
                            <button @click="isProfileAddressModal = true" class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 sm:w-auto dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z" fill=""></path>
                            </svg>
                            Edit
                            </button>
                        </div>

                        <!-- Details Grid Below -->
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <div>
                            <p class="text-sm font-medium text-gray-700 dark:text-white/90">Plot 205, SSS 4, Makongeni</p>
                            <p class="text-sm font-medium text-gray-500 dark:text-white/90">P.O.Box 981-01000</p>
                            <p class="text-sm font-medium text-gray-500 dark:text-white/90">Thika, Kiambu County, Kenya</p>
                            </div>
                        </div>
                        </div>

                        <!-- Contact Information -->
                        <div x-show="activeTab === 'contact'" style="display: none;">
                        <!-- Header: Title Left + Edit Button Right -->
                        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            Contact Information
                            </h3>
                            <button @click="isProfileContactModal = true" class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 sm:w-auto dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z" fill=""></path>
                            </svg>
                            Edit
                            </button>
                        </div>

                        <!-- Details Grid Below -->
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-1">
                            <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Email</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">randomuser@pimjo.com</p>
                            </div>
                            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <div>
                                <span class="mb-1 text-xs text-gray-500 dark:text-gray-400">Primary Phone</span>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">+254 723 000 000</p>
                            </div>
                            <div>
                                <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Secondary Phone</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">+254 725 000 000</p>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Next of Kin Table -->
                        <div x-show="activeTab === 'next-of-kin'" style="display: none;">
                        <!-- Header: Title Left + Buttons Right -->
                        <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            Next of Kin
                            </h3>
                            <div class="flex flex-col gap-3 sm:flex-row">
                            <button @click="isProfileNextKinModal = true" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                                <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Next of Kin
                            </button>
                            </div>
                        </div>

                        <!-- Search + Tab Filter -->
                        <div class="flex flex-col gap-5 mb-6 sm:flex-row sm:justify-between">
                            <div class="w-full">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                My next of Kin
                            </h3>
                            <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                Manage your next of kin statistics easily
                            </p>
                            </div>
                        </div>

                        <!-- Table with Action Column -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Next of Kin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Address</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Phone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Relationship</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Tony Wamuthende</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">tony.wamuthende@gmail.com</p>
                                </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">Makongeni, Thika</td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">+254 785 000 200</td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">Brother</td>
                                <td class="px-6 py-4">
                                <span class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 text-xs font-medium">Active</span>
                                </td>
                                <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <button @click="isProfileEditNextKinModal = true" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                    <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    </button>
                                </div>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                            </tbody>
                            </table>
                        </div>

                        <!-- Pagination (Bottom Right) -->
                        <div class="mt-6 flex justify-end">
                            <nav class="flex items-center gap-2">
                            <button class="rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">
                                Previous
                            </button>
                            <button class="rounded-lg bg-brand-600 px-4 py-2 text-sm font-medium text-gray">1</button>
                            <button class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">Next</button>
                            </nav>
                        </div>
                        </div>

                        <!-- Settings (Notification toggles & preferences) -->
                        <div x-show="activeTab === 'settings'" style="display: none;">
                        <h3 class="mb-4 text-xl font-medium text-gray-800 dark:text-white/90">Settings</h3>
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-1 xl:grid-cols-1">

                            <article class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3">
                            <div class="relative p-5 pb-9">
                                <h3 class="mb-3 text-lg font-semibold text-gray-600 dark:text-white/90">
                                Change Password
                                </h3>
                                <p class="text-sm  text-gray-500 dark:text-gray-400">
                                NOTE! To change the password, enter the current password, and ensure they meet the password criteria.
                                </p>
                            </div>

                            <div class="flex items-center justify-between border-t border-gray-200 p-5 dark:border-gray-800">
                                <form class="flex flex-col" x-data="passwordForm()" @submit.prevent="handleSubmit">
                                <div class="px-2 overflow-y-auto custom-scrollbar">
                                    <div class="relative">
                                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-3">
                                        <!-- Current Password -->
                                        <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Current Password
                                        </label>
                                        <div class="relative" x-data="{ showPassword: false }">
                                            <input type="password" placeholder="Current Password" x-model="form.currentPassword" @input="clearError('currentPassword')" :class="errors.currentPassword ? 'border-error-500 focus:border-error-500 focus:ring-error-500/10' : 'border-gray-300 dark:border-gray-700'" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                            <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                                                <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"></path>
                                                </svg>

                                                <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <p x-show="errors.currentPassword" x-text="errors.currentPassword" class="text-theme-xs text-error-500 mt-1.5" style="display: none;"></p>
                                        </div>

                                        <!-- New Password -->
                                        <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            New Password
                                        </label>
                                        <div class="relative" x-data="{ showPassword: false }">
                                            <input type="password" placeholder="New Password" x-model="form.newPassword" @input="validateNewPassword(); clearError('newPassword')" :class="errors.newPassword ? 'border-error-500 focus:border-error-500 focus:ring-error-500/10' : 'border-gray-300 dark:border-gray-700'" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                            <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                                                <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"></path>
                                                </svg>

                                                <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <p x-show="errors.newPassword" x-text="errors.newPassword" class="text-theme-xs text-error-500 mt-1.5" style="display: none;"></p>
                                        </div>

                                        <!-- Re-enter New Password -->
                                        <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Re-enter New Password
                                        </label>
                                        <div class="relative" x-data="{ showPassword: false }">
                                            <input type="password" placeholder="Re-enter New Password" x-model="form.confirmPassword" @input="validateConfirmPassword(); clearError('confirmPassword')" :class="errors.confirmPassword ? 'border-error-500 focus:border-error-500 focus:ring-error-500/10' : 'border-gray-300 dark:border-gray-700'" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                            <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                                            <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"></path>
                                            </svg>

                                            <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"></path>
                                            </svg>
                                            </span>
                                        </div>
                                        <p x-show="errors.confirmPassword" x-text="errors.confirmPassword" class="mt-1 text-sm text-error-500" style="display: none;"></p>
                                        </div>


                                    </div>
                                    </div>
                                </div>

                                <!-- Password Requirements Section -->
                                <div class="flex relative items-center justify-between border-t border-gray-200 p-5 dark:border-gray-800">
                                    <div class="flex gap-3">
                                    <div class="order-3 xl:order-2">
                                        <h4 class="mb-2 text-center text-medium font-semibold text-gray-600 xl:text-left dark:text-white/90">
                                        Password Requirements
                                        </h4>
                                        <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                        <!-- Minimum 8 characters -->
                                        <p :class="requirements.minLength ? 'text-success-500' : 'flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400'" class="text-sm flex items-center gap-2 text-gray-500 dark:text-gray-400">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.4017 4.35986L6.12166 11.6399L2.59833 8.11657" stroke="#abadac" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            Minimum 8 characters
                                        </p>
                                        <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>

                                        <!-- Special character -->
                                        <p :class="requirements.specialChar ? 'text-success-500' : 'flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400'" class="text-sm flex items-center gap-2 text-gray-500 dark:text-gray-400">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.4017 4.35986L6.12166 11.6399L2.59833 8.11657" stroke="#abadac" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            Special character
                                        </p>
                                        <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>

                                        <!-- Number (2 recommended) -->
                                        <p :class="requirements.numbers ? 'text-success-500' : 'flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400'" class="text-sm flex items-center gap-2 text-gray-500 dark:text-gray-400">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.4017 4.35986L6.12166 11.6399L2.59833 8.11657" stroke="#abadac" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            Number (2 recommended)
                                        </p>
                                        <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>

                                        <!-- Conform Password -->
                                        <p :class="requirements.matchPassword ? 'text-success-500' : 'flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400'" class="text-sm flex items-center gap-2 text-gray-500 dark:text-gray-400">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.4017 4.35986L6.12166 11.6399L2.59833 8.11657" stroke="#abadac" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            Match Password
                                        </p>
                                        <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>

                                        <div>
                                            <button type="submit" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                                                Change Password
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                </div>
                                </form>
                            </div>
                            </article>

                            <article class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3">
                            <div class="relative p-5 pb-9">
                                <h3 class="mb-3 text-lg font-semibold text-gray-800 dark:text-white/90">
                                Delete Account
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                Once you delete your account, there is no going back. Please be certain.
                                </p>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 p-5 dark:border-gray-800">
                                <div class="flex gap-3">
                                <div class="order-3 xl:order-2">
                                    <h4 class="mb-2 text-center text-medium font-semibold text-gray-600 xl:text-left dark:text-white/90">
                                    Account Status
                                    </h4>
                                    <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Role: Treasurer</p>
                                    <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400"><span class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 text-xs font-medium">Active</span> since December 09, 2025 15:24</p>
                                    </div>
                                </div>
                                </div>
                                <div x-data="{ switcherToggle: false }">
                                <button @click="isDeleteModalOpen = true" class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-error-700 ring-1 ring-error-300 transition hover:bg-gray-50 dark:bg-error-700 dark:text-error-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                                    Delete Account
                                </button>
                                </div>
                            </div>
                            </article>

                        </div>
                        </div>
                    </div>
                    </div>

                </div>

                </div>
                <!-- Profile Management end -->
            </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
        </div>
        <!-- ===== Page Wrapper End ===== -->

        <!-- BEGIN MODAL -->
        <div x-show="isProfileInfoModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" style="display: none;">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="isProfileInfoModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="isProfileInfoModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill=""></path>
            </svg>
            </button>
            <div class="px-2 pr-14">
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                Edit Personal Information
            </h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
                Update your details to keep your profile up-to-date.
            </p>
            </div>
            <form class="flex flex-col">
            <div class="custom-scrollbar h-[450px] overflow-y-auto px-2">
                <div class="mt-7">
                <h5 class="mb-5 text-lg font-medium text-gray-800 dark:text-white/90 lg:mb-6">Personal Information</h5>

                <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                    <div class="col-span-2 lg:col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">First Name</label>
                    <input type="text" value="Kamau" class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>

                    <div class="col-span-2 lg:col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Last Name
                    </label>
                    <input type="text" value="Njunge" class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>

                    <div class="col-span-2 lg:col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Gender</label>
                    <input type="text" value="Kamau" class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>

                    <div class="col-span-2 lg:col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Date of Birth
                    </label>
                    <div class="relative">
                        <div class="flatpickr-wrapper">
                        <div class="flatpickr-wrapper"><input type="text" placeholder="Select date" class="dark:bg-dark-900 datepickerTwo shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 flatpickr-input" readonly="readonly"><div class="flatpickr-calendar animate static null" tabindex="-1"><div class="flatpickr-months"><span class="flatpickr-prev-month"><svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.25 6L9 12.25L15.25 18.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span><div class="flatpickr-month"><div class="flatpickr-current-month"><span class="cur-month">January </span><div class="numInputWrapper"><input class="numInput cur-year" type="number" tabindex="-1" aria-label="Year"><span class="arrowUp"></span><span class="arrowDown"></span></div></div></div><span class="flatpickr-next-month"><svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="httpwww.w3.org/2000/svg"><path d="M8.75 19L15 12.75L8.75 6.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span></div><div class="flatpickr-innerContainer"><div class="flatpickr-rContainer"><div class="flatpickr-weekdays"><div class="flatpickr-weekdaycontainer">
        <span class="flatpickr-weekday">
            Sun</span><span class="flatpickr-weekday">Mon</span><span class="flatpickr-weekday">Tue</span><span class="flatpickr-weekday">Wed</span><span class="flatpickr-weekday">Thu</span><span class="flatpickr-weekday">Fri</span><span class="flatpickr-weekday">Sat
        </span>
        </div></div><div class="flatpickr-days" tabindex="-1"><div class="dayContainer"><span class="flatpickr-day prevMonthDay" aria-label="December 28, 2025" tabindex="-1">28</span><span class="flatpickr-day prevMonthDay" aria-label="December 29, 2025" tabindex="-1">29</span><span class="flatpickr-day prevMonthDay" aria-label="December 30, 2025" tabindex="-1">30</span><span class="flatpickr-day prevMonthDay" aria-label="December 31, 2025" tabindex="-1">31</span><span class="flatpickr-day" aria-label="January 1, 2026" tabindex="-1">1</span><span class="flatpickr-day" aria-label="January 2, 2026" tabindex="-1">2</span><span class="flatpickr-day" aria-label="January 3, 2026" tabindex="-1">3</span><span class="flatpickr-day" aria-label="January 4, 2026" tabindex="-1">4</span><span class="flatpickr-day" aria-label="January 5, 2026" tabindex="-1">5</span><span class="flatpickr-day" aria-label="January 6, 2026" tabindex="-1">6</span><span class="flatpickr-day" aria-label="January 7, 2026" tabindex="-1">7</span><span class="flatpickr-day" aria-label="January 8, 2026" tabindex="-1">8</span><span class="flatpickr-day" aria-label="January 9, 2026" tabindex="-1">9</span><span class="flatpickr-day" aria-label="January 10, 2026" tabindex="-1">10</span><span class="flatpickr-day" aria-label="January 11, 2026" tabindex="-1">11</span><span class="flatpickr-day" aria-label="January 12, 2026" tabindex="-1">12</span><span class="flatpickr-day" aria-label="January 13, 2026" tabindex="-1">13</span><span class="flatpickr-day" aria-label="January 14, 2026" tabindex="-1">14</span><span class="flatpickr-day" aria-label="January 15, 2026" tabindex="-1">15</span><span class="flatpickr-day" aria-label="January 16, 2026" tabindex="-1">16</span><span class="flatpickr-day" aria-label="January 17, 2026" tabindex="-1">17</span><span class="flatpickr-day" aria-label="January 18, 2026" tabindex="-1">18</span><span class="flatpickr-day" aria-label="January 19, 2026" tabindex="-1">19</span><span class="flatpickr-day" aria-label="January 20, 2026" tabindex="-1">20</span><span class="flatpickr-day" aria-label="January 21, 2026" tabindex="-1">21</span><span class="flatpickr-day" aria-label="January 22, 2026" tabindex="-1">22</span><span class="flatpickr-day" aria-label="January 23, 2026" tabindex="-1">23</span><span class="flatpickr-day" aria-label="January 24, 2026" tabindex="-1">24</span><span class="flatpickr-day" aria-label="January 25, 2026" tabindex="-1">25</span><span class="flatpickr-day today" aria-label="January 26, 2026" aria-current="date" tabindex="-1">26</span><span class="flatpickr-day" aria-label="January 27, 2026" tabindex="-1">27</span><span class="flatpickr-day" aria-label="January 28, 2026" tabindex="-1">28</span><span class="flatpickr-day" aria-label="January 29, 2026" tabindex="-1">29</span><span class="flatpickr-day" aria-label="January 30, 2026" tabindex="-1">30</span><span class="flatpickr-day" aria-label="January 31, 2026" tabindex="-1">31</span><span class="flatpickr-day nextMonthDay" aria-label="February 1, 2026" tabindex="-1">1</span><span class="flatpickr-day nextMonthDay" aria-label="February 2, 2026" tabindex="-1">2</span><span class="flatpickr-day nextMonthDay" aria-label="February 3, 2026" tabindex="-1">3</span><span class="flatpickr-day nextMonthDay" aria-label="February 4, 2026" tabindex="-1">4</span><span class="flatpickr-day nextMonthDay" aria-label="February 5, 2026" tabindex="-1">5</span><span class="flatpickr-day nextMonthDay" aria-label="February 6, 2026" tabindex="-1">6</span><span class="flatpickr-day nextMonthDay" aria-label="February 7, 2026" tabindex="-1">7</span></div></div></div></div></div></div>
                        <div class="flatpickr-calendar animate static null arrowTop arrowLeft" tabindex="-1">
                            <div class="flatpickr-months">
                            <span class="flatpickr-prev-month">
                                <svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.25 6L9 12.25L15.25 18.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <div class="flatpickr-month">
                                <div class="flatpickr-current-month">
                                <span class="cur-month"></span>
                                <div class="numInputWrapper">
                                    <input class="numInput cur-year" type="number" tabindex="-1" aria-label="Year">
                                    <span class="arrowUp"></span>
                                    <span class="arrowDown"></span>
                                </div>
                                </div>
                            </div>
                            <span class="flatpickr-next-month">
                                <svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.75 19L15 12.75L8.75 6.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            </div>
                        </div>
                        </div>
                        <span class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z" fill=""></path>
                        </svg>
                        </span>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                <button @click="isProfileInfoModal = false" type="button" class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                Close
                </button>
                <button type="button" class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                Save Changes
                </button>
            </div>
            </form>
        </div>
        </div>

        <div x-show="isProfileContactModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" style="display: none;">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="isProfileContactModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="isProfileContactModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill=""></path>
            </svg>
            </button>
            <div class="px-2 pr-14">
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Edit Contact Information</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Update Member Contact details to keep profile up-to-date.</p>
            </div>
            <form>
            <div class="-mx-2.5 flex flex-wrap gap-y-5">
                <!-- Member Email -->
                <div class="w-full px-2.5">
                <div class="relative">
                                <span class="absolute top-1/2 left-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.0415 7.06206V14.375C3.0415 14.6511 3.26536 14.875 3.5415 14.875H16.4582C16.7343 14.875 16.9582 14.6511 16.9582 14.375V7.06245L11.1441 11.1168C10.4568 11.5961 9.54348 11.5961 8.85614 11.1168L3.0415 7.06206ZM16.9582 5.19262C16.9582 5.19341 16.9582 5.1942 16.9582 5.19498V5.20026C16.957 5.22216 16.9458 5.24239 16.9277 5.25501L10.2861 9.88638C10.1143 10.0062 9.88596 10.0062 9.71412 9.88638L3.0723 5.25485C3.05318 5.24151 3.04178 5.21967 3.04177 5.19636C3.04176 5.15695 3.0737 5.125 3.1131 5.125H16.8869C16.925 5.125 16.9562 5.15494 16.9582 5.19262ZM18.4582 5.21428V14.375C18.4582 15.4796 17.5627 16.375 16.4582 16.375H3.5415C2.43693 16.375 1.5415 15.4796 1.5415 14.375V5.19498C1.5415 5.1852 1.54169 5.17546 1.54206 5.16577C1.55834 4.31209 2.25546 3.625 3.1131 3.625H16.8869C17.7546 3.625 18.4582 4.32843 18.4583 5.19622C18.4583 5.20225 18.4582 5.20826 18.4582 5.21428Z" fill=""></path>
                                </svg>
                                </span>
                    <input type="email" placeholder="Email address" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-3 pl-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>
                </div>
                <!-- Primary Phone -->
                <div class="w-full px-2.5 xl:w-1/2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Primary Phone
                </label>
                <input type="text" placeholder="Enter first name" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>
                <!-- Primary Phone -->
                <div class="w-full px-2.5 xl:w-1/2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Secondary Phone
                </label>
                <input type="text" placeholder="Enter last name" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>
            </div>
            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                <button @click="isProfileContactModal = false" type="button" class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                Close</button>
                <button type="button" class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">Save Changes</button>
            </div>
            </form>
        </div>
        </div>

        <div x-show="isProfileNextKinModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" style="display: none;">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="isProfileNextKinModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="isProfileNextKinModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill=""></path>
            </svg>
            </button>
            <div class="px-2 pr-14">
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                Next of Kin Details
            </h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
                Enter member next of kin details that are upto date.
            </p>
            </div>

            <!-- Next of Kin form -->
            <div class="flex flex-col h-full px-2 pr-14">
            <form>
                <div class="-mx-2.5 flex flex-wrap gap-y-5">
                <!-- First Name -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    First Name
                    </label>
                    <input type="text" x-model="newUserForm.firstName" placeholder="Enter first name" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <!-- Last Name -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Last Name
                    </label>
                    <input type="text" x-model="newUserForm.lastName" placeholder="Enter last name" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <!-- Email -->
                <div class="w-full px-2.5">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Email
                    </label>
                    <input type="email" x-model="newUserForm.email" placeholder="Enter email address" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <!-- National ID -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    National ID
                    </label>
                    <input type="text" x-model="newUserForm.nationalId" placeholder="Enter national ID" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <!-- Phone -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Phone
                    </label>
                    <input type="text" x-model="newUserForm.phone" placeholder="Enter phone number" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <!-- Relationship -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <h3 class="text-normal font-semibold text-gray-500 dark:text-white/90 mb-2">Relationship</h3>
                    <div class="relative z-20 bg-transparent">
                    <select x-model="newUserForm.role" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <option value="">Relationship</option>
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Sibling">Sibling</option>
                        <option value="Employer">Employer</option>
                    </select>
                    <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                    </div>
                </div>

                <!-- Status -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <h3 class="text-normal font-semibold text-gray-500 dark:text-white/90 mb-2">Status</h3>
                    <div class="relative z-20 bg-transparent">
                    <select x-model="newUserForm.role" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <option value="">Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                    </div>
                </div>
                </div>

                <!-- Cancel and Update buttons at bottom right -->
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                <button type="button" @click="newUserModal = false" class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    Cancel
                </button>
                <button type="submit" class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                    Add Kin
                </button>
                </div>
            </form>
            </div>

        </div>
        </div>

        <div x-show="isProfileEditNextKinModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" style="display: none;">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="isProfileEditNextKinModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="isProfileEditNextKinModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill=""></path>
            </svg>
            </button>
            <div class="px-2 pr-14">
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                Next of Kin Details
            </h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
                Enter member next of kin details that are upto date.
            </p>
            </div>

            <!-- Next of Kin form -->
            <div class="flex flex-col h-full px-2 pr-14">
            <form>
                <div class="-mx-2.5 flex flex-wrap gap-y-5">
                <!-- First Name -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    First Name
                    </label>
                    <input type="text" x-model="newUserForm.firstName" placeholder="Enter first name" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <!-- Last Name -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Last Name
                    </label>
                    <input type="text" x-model="newUserForm.lastName" placeholder="Enter last name" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <!-- Email -->
                <div class="w-full px-2.5">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Email
                    </label>
                    <input type="email" x-model="newUserForm.email" placeholder="Enter email address" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <!-- National ID -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    National ID
                    </label>
                    <input type="text" x-model="newUserForm.nationalId" placeholder="Enter national ID" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <!-- Phone -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Phone
                    </label>
                    <input type="text" x-model="newUserForm.phone" placeholder="Enter phone number" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>

                <!-- Relationship -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <h3 class="text-normal font-semibold text-gray-500 dark:text-white/90 mb-2">Relationship</h3>
                    <div class="relative z-20 bg-transparent">
                    <select x-model="newUserForm.role" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <option value="">Relationship</option>
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Sibling">Sibling</option>
                        <option value="Employer">Employer</option>
                    </select>
                    <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                    </div>
                </div>

                <!-- Status -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <h3 class="text-normal font-semibold text-gray-500 dark:text-white/90 mb-2">Status</h3>
                    <div class="relative z-20 bg-transparent">
                    <select x-model="newUserForm.role" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <option value="">Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                    </div>
                </div>
                </div>

                <!-- Cancel and Update buttons at bottom right -->
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                <button type="button" @click="isProfileEditNextKinModal = false" class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    Cancel
                </button>
                <button type="submit" class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                    Update
                </button>
                </div>
            </form>
            </div>

        </div>
        </div>

        <div x-show="isProfileAddressModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" style="display: none;">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="isProfileAddressModal = false" class="no-scrollbar relative flex w-full max-w-[700px] flex-col overflow-y-auto rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="isProfileAddressModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill=""></path>
            </svg>
            </button>

            <div class="px-2 pr-14">
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                Edit Address
            </h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
                Update member Address details to keep profile up-to-date.
            </p>
            </div>
            <form>
            <div class="-mx-2.5 flex flex-wrap gap-y-5">
                <div class="w-full px-2.5">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Street
                </label>
                <input type="text" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>
                <div class="w-full px-2.5 xl:w-1/2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    City
                </label>
                <input type="text" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>
                <div class="w-full px-2.5 xl:w-1/2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    State
                </label>
                <input type="text" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>
                <div class="w-full px-2.5 xl:w-1/2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Post Code
                </label>
                <input type="text" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                </div>
                <div class="w-full px-2.5 xl:w-1/2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Country
                </label>
                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                    <select class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-500 dark:text-gray-400'" @change="isOptionSelected = true">
                    <option value="" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                        -- Select County --
                    </option>
                    <option value="" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                        USA
                    </option>
                    <option value="" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                        Canada
                    </option>
                    </select>
                    <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                </span>
                </div>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-6 lg:justify-end">
                <button @click="isProfileAddressModal = false" type="button" class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                Close
                </button>
                <button type="button" class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                Save Changes
                </button>
            </div>
            </form>
        </div>
        </div>

        <div x-show="isModalOpen" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999" style="display: none;">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="isModalOpen = false" class="relative w-full max-w-[600px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
            <!-- close btn -->
            <button @click="isModalOpen = false" class="absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z" fill="currentColor"></path>
            </svg>
            </button>

            <div class="text-center">
            <div class="relative flex items-center justify-center z-1 mb-7">
                <svg class="fill-success-50 dark:fill-success-500/15" width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M34.364 6.85053C38.6205 -2.28351 51.3795 -2.28351 55.636 6.85053C58.0129 11.951 63.5594 14.6722 68.9556 13.3853C78.6192 11.0807 86.5743 21.2433 82.2185 30.3287C79.7862 35.402 81.1561 41.5165 85.5082 45.0122C93.3019 51.2725 90.4628 63.9451 80.7747 66.1403C75.3648 67.3661 71.5265 72.2695 71.5572 77.9156C71.6123 88.0265 60.1169 93.6664 52.3918 87.3184C48.0781 83.7737 41.9219 83.7737 37.6082 87.3184C29.8831 93.6664 18.3877 88.0266 18.4428 77.9156C18.4735 72.2695 14.6352 67.3661 9.22531 66.1403C-0.462787 63.9451 -3.30193 51.2725 4.49185 45.0122C8.84391 41.5165 10.2138 35.402 7.78151 30.3287C3.42572 21.2433 11.3808 11.0807 21.0444 13.3853C26.4406 14.6722 31.9871 11.951 34.364 6.85053Z" fill="" fill-opacity=""></path>
                </svg>

                <span class="absolute -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2">
                <svg class="fill-success-600 dark:fill-success-500" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.9375 19.0004C5.9375 11.7854 11.7864 5.93652 19.0014 5.93652C26.2164 5.93652 32.0653 11.7854 32.0653 19.0004C32.0653 26.2154 26.2164 32.0643 19.0014 32.0643C11.7864 32.0643 5.9375 26.2154 5.9375 19.0004ZM19.0014 2.93652C10.1296 2.93652 2.9375 10.1286 2.9375 19.0004C2.9375 27.8723 10.1296 35.0643 19.0014 35.0643C27.8733 35.0643 35.0653 27.8723 35.0653 19.0004C35.0653 10.1286 27.8733 2.93652 19.0014 2.93652ZM24.7855 17.0575C25.3713 16.4717 25.3713 15.522 24.7855 14.9362C24.1997 14.3504 23.25 14.3504 22.6642 14.9362L17.7177 19.8827L15.3387 17.5037C14.7529 16.9179 13.8031 16.9179 13.2173 17.5037C12.6316 18.0894 12.6316 19.0392 13.2173 19.625L16.657 23.0647C16.9383 23.346 17.3199 23.504 17.7177 23.504C18.1155 23.504 18.4971 23.346 18.7784 23.0647L24.7855 17.0575Z" fill=""></path>
                </svg>
            </span>
            </div>

            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90 sm:text-title-sm">
                Deposit Successful!
            </h4>
            <p class="text-sm leading-6 text-gray-500 dark:text-gray-400">
                Lorem ipsum dolor sit amet consectetur. Feugiat ipsum libero tempor
                felis risus nisi non. Quisque eu ut tempor curabitur.
            </p>

            <div class="flex items-center justify-center w-full gap-3 mt-7">
                <button @click="isModalOpen = false" type="button" class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600 sm:w-auto">
                Ok
                </button>
            </div>
            </div>
        </div>
        </div>

        <div x-show="deactivateAccountModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999" style="display: none;">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="deactivateAccountModal = false" class="relative w-full max-w-[600px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
            <!-- close btn -->
            <button @click="deactivateAccountModal = false" class="absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z" fill="currentColor"></path>
            </svg>
            </button>

            <div class="text-center">
            <div class="relative flex items-center justify-center z-1 mb-7">
                <svg class="fill-success-50 dark:fill-success-500/15" width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M34.364 6.85053C38.6205 -2.28351 51.3795 -2.28351 55.636 6.85053C58.0129 11.951 63.5594 14.6722 68.9556 13.3853C78.6192 11.0807 86.5743 21.2433 82.2185 30.3287C79.7862 35.402 81.1561 41.5165 85.5082 45.0122C93.3019 51.2725 90.4628 63.9451 80.7747 66.1403C75.3648 67.3661 71.5265 72.2695 71.5572 77.9156C71.6123 88.0265 60.1169 93.6664 52.3918 87.3184C48.0781 83.7737 41.9219 83.7737 37.6082 87.3184C29.8831 93.6664 18.3877 88.0266 18.4428 77.9156C18.4735 72.2695 14.6352 67.3661 9.22531 66.1403C-0.462787 63.9451 -3.30193 51.2725 4.49185 45.0122C8.84391 41.5165 10.2138 35.402 7.78151 30.3287C3.42572 21.2433 11.3808 11.0807 21.0444 13.3853C26.4406 14.6722 31.9871 11.951 34.364 6.85053Z" fill="" fill-opacity=""></path>
                </svg>

                <span class="absolute -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2">
                <svg class="fill-success-600 dark:fill-success-500" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.9375 19.0004C5.9375 11.7854 11.7864 5.93652 19.0014 5.93652C26.2164 5.93652 32.0653 11.7854 32.0653 19.0004C32.0653 26.2154 26.2164 32.0643 19.0014 32.0643C11.7864 32.0643 5.9375 26.2154 5.9375 19.0004ZM19.0014 2.93652C10.1296 2.93652 2.9375 10.1286 2.9375 19.0004C2.9375 27.8723 10.1296 35.0643 19.0014 35.0643C27.8733 35.0643 35.0653 27.8723 35.0653 19.0004C35.0653 10.1286 27.8733 2.93652 19.0014 2.93652ZM24.7855 17.0575C25.3713 16.4717 25.3713 15.522 24.7855 14.9362C24.1997 14.3504 23.25 14.3504 22.6642 14.9362L17.7177 19.8827L15.3387 17.5037C14.7529 16.9179 13.8031 16.9179 13.2173 17.5037C12.6316 18.0894 12.6316 19.0392 13.2173 19.625L16.657 23.0647C16.9383 23.346 17.3199 23.504 17.7177 23.504C18.1155 23.504 18.4971 23.346 18.7784 23.0647L24.7855 17.0575Z" fill=""></path>
                </svg>
            </span>
            </div>

            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90 sm:text-title-sm">
                Bodaboda member account deactivated
            </h4>

            <div class="flex items-center justify-center w-full gap-3 mt-7">
                <button onclick="window.location.href='view-member.php'" type="button" class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600 sm:w-auto">
                Ok
                </button>
            </div>
            </div>
        </div>
        </div>

        <div x-show="isDeleteModalOpen" class="modal fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-5" style="display: none;">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="isDeleteModalOpen = false" class="relative w-full max-w-[580px] rounded-3xl bg-white p-6 lg:p-10 dark:bg-gray-900">
            <!-- close btn -->
            <button @click="isDeleteModalOpen = false" class="absolute top-3 right-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 sm:top-6 sm:right-6 sm:h-11 sm:w-11 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z" fill=""></path>
            </svg>
            </button>

            <div class="text-center">
            <div class="relative z-1 mb-7 flex items-center justify-center">
                <svg class="fill-error-50 dark:fill-error-500/15" width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M34.364 6.85053C38.6205 -2.28351 51.3795 -2.28351 55.636 6.85053C58.0129 11.951 63.5594 14.6722 68.9556 13.3853C78.6192 11.0807 86.5743 21.2433 82.2185 30.3287C79.7862 35.402 81.1561 41.5165 85.5082 45.0122C93.3019 51.2725 90.4628 63.9451 80.7747 66.1403C75.3648 67.3661 71.5265 72.2695 71.5572 77.9156C71.6123 88.0265 60.1169 93.6664 52.3918 87.3184C48.0781 83.7737 41.9219 83.7737 37.6082 87.3184C29.8831 93.6664 18.3877 88.0266 18.4428 77.9156C18.4735 72.2695 14.6352 67.3661 9.22531 66.1403C-0.462787 63.9451 -3.30193 51.2725 4.49185 45.0122C8.84391 41.5165 10.2138 35.402 7.78151 30.3287C3.42572 21.2433 11.3808 11.0807 21.0444 13.3853C26.4406 14.6722 31.9871 11.951 34.364 6.85053Z" fill="" fill-opacity=""></path>
                </svg>

                <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <svg class="fill-error-600 dark:fill-error-500" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.62684 11.7496C9.04105 11.1638 9.04105 10.2141 9.62684 9.6283C10.2126 9.04252 11.1624 9.04252 11.7482 9.6283L18.9985 16.8786L26.2485 9.62851C26.8343 9.04273 27.7841 9.04273 28.3699 9.62851C28.9556 10.2143 28.9556 11.164 28.3699 11.7498L21.1198 18.9999L28.3699 26.25C28.9556 26.8358 28.9556 27.7855 28.3699 28.3713C27.7841 28.9571 26.8343 28.9571 26.2485 28.3713L18.9985 21.1212L11.7482 28.3715C11.1624 28.9573 10.2126 28.9573 9.62684 28.3715C9.04105 27.7857 9.04105 26.836 9.62684 26.2502L16.8771 18.9999L9.62684 11.7496Z" fill=""></path>
                </svg>
                </span>
            </div>

            <h4 class="sm:text-title-sm mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                Confirm Account Deletion
            </h4>
            <p class="text-sm leading-6 text-gray-500 dark:text-gray-400">
                Are you sure you want to delete this account?
            </p>

            <div class="mt-8 flex w-full items-center justify-center gap-3">
                <button @click="isDeleteModalOpen = false" type="button" class="shadow-theme-xs flex justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                No, Cancel
                </button>
                <button @click="isDeleteModalOpen = false" type="button" class="shadow-theme-xs flex justify-center rounded-lg bg-red-500 px-4 py-3 text-sm font-medium text-white hover:bg-red-600">
                Yes, I'm sure
                </button>
            </div>
            </div>
        </div>
        </div>
        <!-- END MODAL -->


        <script defer src="{{ asset('assets/bundle.js') }}"></script>

        <script>
            function passwordForm() {
            return {
            form: {
                currentPassword: '',
                newPassword: '',
                confirmPassword: ''
            },
            errors: {
                currentPassword: '',
                newPassword: '',
                confirmPassword: ''
            },
            requirements: {
                minLength: false,
                specialChar: false,
                numbers: false
            },

            validateNewPassword() {
                const password = this.form.newPassword;
                this.errors.newPassword = '';

                // Reset requirements
                this.requirements.minLength = false;
                this.requirements.specialChar = false;
                this.requirements.numbers = false;

                if (!password) {
                return false;
                }

                // Check minimum length
                if (password.length >= 8) {
                this.requirements.minLength = true;
                }

                // Check for special character
                const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
                if (specialCharRegex.test(password)) {
                this.requirements.specialChar = true;
                }

                // Check for numbers (at least 2)
                const numberMatches = password.match(/\d/g);
                if (numberMatches && numberMatches.length >= 2) {
                this.requirements.numbers = true;
                }

                // Validate all requirements
                if (!this.requirements.minLength) {
                this.errors.newPassword = 'Password must be at least 8 characters';
                return false;
                }

                if (!this.requirements.specialChar) {
                this.errors.newPassword = 'Password must contain a special character';
                return false;
                }

                if (!this.requirements.numbers) {
                this.errors.newPassword = 'Password must contain at least 2 numbers';
                return false;
                }

                return true;
            },

            validateConfirmPassword() {
                this.errors.confirmPassword = '';

                if (!this.form.confirmPassword) {
                return false;
                }

                if (this.form.newPassword !== this.form.confirmPassword) {
                this.errors.confirmPassword = 'Passwords do not match';
                return false;
                }

                return true;
            },

            validateCurrentPassword() {
                this.errors.currentPassword = '';

                if (!this.form.currentPassword) {
                this.errors.currentPassword = 'Current password is required';
                return false;
                }

                return true;
            },

            clearError(field) {
                if (this.errors[field]) {
                this.errors[field] = '';
                }
            },

            validateForm() {
                const isCurrentValid = this.validateCurrentPassword();
                const isNewValid = this.validateNewPassword();
                const isConfirmValid = this.validateConfirmPassword();

                return isCurrentValid && isNewValid && isConfirmValid;
            },

            handleSubmit() {
                if (this.validateForm()) {
                // Form is valid, submit it
                console.log('Form submitted successfully');
                // You can add form submission logic here
                // this.$el.submit(); // Uncomment to submit the form normally
                }
            }
            }
        }
        </script>

    </body>

</html>
