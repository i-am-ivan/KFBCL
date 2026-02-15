
<!DOCTYPE html>
<html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ Auth::user()->role }} | KFBCL Appointments </title>

        <link rel="icon" href="{{ asset('assets/favicon.ico') }}">
        <link href="{{ asset('assets/style.css') }}" rel="stylesheet">

        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    </head>

    <body x-data="{ page: 'appointments', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false,  'newAppointmentModal': false, 'rescheduleModal': false, 'isProfileAddressModal': false }" x-init="
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

                    <a href="{{ route('treasurer.dashboard') }}" class="xl:hidden flex items-center">
                        <div class="relative w-8 h-8">
                            <!-- Outer circular orange/brown border with thin grayish margin -->
                            <div class="absolute inset-0 rounded-full border-2 border-amber-600/20 dark:border-amber-500/30"></div>

                            <!-- Inner circular orange/brown border with thin grayish margin -->
                            <div class="absolute inset-1 rounded-full border border-amber-600/30 dark:border-amber-500/40"></div>

                            <!-- Logo image -->
                            <div class="absolute inset-2 rounded-full overflow-hidden">
                                <img class="w-full h-full object-cover dark:hidden" src="{{ asset('company_logo.png') }}" alt="Logo" />
                                <img class="w-full h-full object-cover hidden dark:block" src="{{ asset('company_logo.png') }}" alt="Logo" />
                            </div>
                        </div>
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
            <!-- Content Start -->
            <div x-data="{ pageName: `Appointments` }">
              <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName">Appointments</h2>
                <nav>
                  <ol class="flex items-center gap-1.5">
                    <li>
                      <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="index.php">
                        Home
                        <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                      </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName">Appointments</li>
                  </ol>
                </nav>
              </div>
            </div>

            <div class="space-y-6">
              <!-- Appointments Quick Stats -->
              <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3" x-data="dashboardStats()" x-init="fetchStats()">
                <!-- All Appointments -->
                <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                  <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90">
                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                      <line x1="16" y1="2" x2="16" y2="6"></line>
                      <line x1="8" y1="2" x2="8" y2="6"></line>
                      <line x1="3" y1="10" x2="21" y2="10"></line>
                      <path d="M8 14h.01"></path>
                      <path d="M12 14h.01"></path>
                      <path d="M16 14h.01"></path>
                      <path d="M8 18h.01"></path>
                      <path d="M12 18h.01"></path>
                      <path d="M16 18h.01"></path>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90" x-text="stats.total_appointments || 0">
                        0
                    </h3>
                    <p class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                      All Appointments
                    </p>
                  </div>
                </article>

                <!-- Appointments Today -->
                <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                  <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90">
                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10"></circle>
                      <polyline points="12 6 12 12 16 14"></polyline>
                      <path d="M12 2a10 10 0 0 1 0 20"></path>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90"  x-text="stats.today_appointments || 0">
                      0
                    </h3>
                    <p class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                      Appointments Today
                    </p>
                  </div>
                </article>

                <!-- Pending Appointments -->
                <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                  <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90">
                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10"></circle>
                      <line x1="12" y1="8" x2="12" y2="12"></line>
                      <line x1="12" y1="16" x2="12.01" y2="16"></line>
                      <path d="M12 2a10 10 0 0 0-8.66 15"></path>
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90" x-text="stats.pending_appointments || 0">
                      0
                    </h3>
                    <p class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                      Appointments Pending
                    </p>
                  </div>
                </article>
              </div>
              <!-- Appointments Table -->
              <div class="grid grid-cols-12 gap-4 md:gap-6">
                <!-- Appointments Table -->
                <div class="col-span-12 xl:col-span-12">
                  <!-- Table -->
                  <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]" x-data="appointmentsTable()" x-init="init()">
                    <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                      <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                          Appointments
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                          All your appointments.
                        </p>
                      </div>
                      <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                        <!-- Search Input -->
                        <div class="relative">
                          <span class="pointer-events-none absolute top-1/2 left-4 -translate-y-1/2">
                            <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z" fill=""></path>
                            </svg>
                          </span>
                          <input
                            type="text"
                            id="searchInput"
                            placeholder="Search by name or email..."
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[300px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            x-model="searchQuery"
                            @input="handleSearch"
                          >
                        </div>

                            <!-- Status Filter Dropdown -->
                            <div class="hidden lg:block">
                                <select
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    x-model="statusFilter"
                                    @change="handleFilterChange"
                                >
                                    <option value="all">All Statuses</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <!-- Add other status options as needed -->
                                </select>
                            </div>

                            <!-- Date Filter Dropdown -->
                            <div class="hidden lg:block">
                                <select
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    x-model="dateFilter"
                                    @change="handleFilterChange"
                                >
                                    <option value="all">All Dates</option>
                                    <option value="Today">Today</option>
                                    <option value="Tomorrow">Tomorrow</option>
                                    <option value="This week">This week</option>
                                    <option value="This Month">This Month</option>
                                </select>
                            </div>

                        <div>
                          <button class="hover:text-dark-900 shadow-theme-xs relative flex h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              width="20"
                              height="20"
                              viewBox="0 0 20 20"
                              fill="none"
                            >
                              <path
                                d="M16.6661 13.3333V15.4166C16.6661 16.1069 16.1064 16.6666 15.4161 16.6666H4.58203C3.89168 16.6666 3.33203 16.1069 3.33203 15.4166V13.3333M10.0004 3.33325L10.0004 13.3333M6.14456 7.18708L9.9986 3.33549L13.8529 7.18708"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                            Print
                          </button>
                        </div>

                        <div>
                          <button type="button" @click="newAppointmentModal = true"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                            <svg
                              class="fill-current"
                              width="18"
                              height="18"
                              viewBox="0 0 18 18"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                                fill=""
                              />
                            </svg>
                            Schedule Appointment</button>
                        </div>
                      </div>
                    </div>
                    <!-- Appointment Table -->
                    <div>
                      <!-- Appointment Table -->
                      <div>
                        <div class="custom-scrollbar overflow-x-auto">
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
                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                  Action
                                </th>
                              </tr>
                            </thead>
                            <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                              <template x-for="row in paginatedRows" :key="row.id">
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
                                        'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400': row.priority === 'low',
                                        'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400': row.priority === 'normal',
                                        'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400': row.priority === 'high',
                                        'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400': row.priority === 'urgent'
                                      }"
                                      x-text="row.priority.charAt(0).toUpperCase() + row.priority.slice(1)">
                                    </span>
                                  </td>
                                  <td class="p-4 whitespace-nowrap">
                                    <span class="bg-success-50 dark:bg-success-500/15 text-success-700 dark:text-success-500 text-theme-xs rounded-full px-2 py-0.5 font-medium"
                                      x-show="row.status === 'Confirmed'">Confirmed</span>
                                    <span class="bg-warning-50 dark:bg-warning-500/15 text-warning-700 dark:text-warning-500 text-theme-xs rounded-full px-2 py-0.5 font-medium"
                                      x-show="row.status === 'Pending'">Pending</span>
                                    <span class="text-theme-xs rounded-full bg-red-50 px-2 py-0.5 font-medium text-red-700 dark:bg-red-500/15 dark:text-red-500"
                                      x-show="row.status === 'Cancelled'">Cancelled</span>
                                    <span class="text-theme-xs rounded-full bg-gray-100 px-2 py-0.5 font-medium text-gray-700 dark:bg-gray-800 dark:text-gray-400"
                                      x-show="row.status === 'Completed'">Completed</span>
                                  </td>
                                  <td class="p-4 whitespace-nowrap">
                                    <button @click="rescheduleModal = true; $dispatch('row-selected', row)"
                                      class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                      <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" d="m11.5 11.5 2.071 1.994M4 10h5m11 0h-1.5M12 7V4M7 7V4m10 3V4m-7 13H8v-2l5.227-5.292a1.46 1.46 0 0 1 2.065 2.065L10 17Zm-5 3h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                                      </svg>
                                    </button>
                                  </td>
                                </tr>
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
            <!-- Content End -->
          </div>
        </main>
        <!-- ===== Main Content End ===== -->
      </div>
      <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->

    <!-- BEGIN MODALS -->
    <!-- New Appointment -->
    <div x-show="newAppointmentModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" style="display: none;">
      <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
      <div @click.outside="newAppointmentModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="newAppointmentModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
          <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill=""></path>
          </svg>
        </button>
        <div class="px-2 pr-14">
          <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
            New Appointment
          </h4>
          <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
            Schedule and Review an appointment
          </p>
        </div>

        <!-- Create Appointment form -->
        <form action="{{ route('appointments.store') }}" method="POST" id="appointmentForm" name="appointmentForm">
            @csrf
            <div class="flex flex-col h-full" x-data="appointmentWizard()">
                <!-- Progress Bar -->
                <div class="mb-8 px-4 sm:px-6">
                    <div class="flex items-center justify-between mb-2">
                    <div class="flex-1">
                        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-brand-500 transition-all duration-300" :style="`width: ${(currentStep / 3) * 100}%`" style="width: 33.33333333333333%"></div>
                        </div>
                    </div>
                    </div>
                    <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
                    <span :class="{'text-brand-600 dark:text-brand-400 font-medium': currentStep &gt;= 1}" class="text-brand-600 dark:text-brand-400 font-medium">Applicant Information</span>
                    <span :class="{'text-brand-600 dark:text-brand-400 font-medium': currentStep &gt;= 2}">Appointment Details</span>
                    <span :class="{'text-brand-600 dark:text-brand-400 font-medium': currentStep &gt;= 3}">Preview &amp; Schedule</span>
                    </div>
                </div>

                <!-- Step Indicator -->
                <div class="px-6 pb-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                    Step <span x-text="currentStep">1</span> of 3
                    </p>
                </div>

                <div class="custom-scrollbar flex-1 overflow-y-auto px-6">
                    <!-- Step 1: Applicant Information -->
                    <div x-show="currentStep === 1" class="space-y-6">
                        <div>
                            <h5 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-6">Applicant Information</h5>
                            <!-- Applicant Form -->
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            First Name
                                        </label>
                                        <input type="text" placeholder="Enter full name" id="first_name" name="first_name" x-model="applicant.firstName" class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" required="">
                                    </div>

                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Last Name
                                        </label>
                                        <input type="text" placeholder="Enter full name" id="last_name" name="last_name" x-model="applicant.lastName" class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" required="">
                                    </div>

                                    <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Email Address
                                    </label>
                                    <input type="email" placeholder="Enter email" id="email" name="email" x-model="applicant.email" class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" required="">
                                    </div>

                                    <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Phone Number
                                    </label>
                                    <input type="tel" placeholder="+254 700 000 000" id="phone" name="phone"  x-model="applicant.phone" class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" required="">
                                    </div>

                                    <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Company / Organization
                                    </label>
                                    <input type="text" placeholder="Company name (optional)" id="company" name="company" x-model="applicant.company" class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Appointment Details -->
                    <div x-show="currentStep === 2" class="space-y-6" style="display: none;">
                        <div>
                            <h5 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-6">Appointment Details</h5>

                            <!-- Appointment Type Dropdown -->
                            <div class="mb-6">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Appointment Type
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select x-model="appointment.type" id="type" name="type" @change="isOptionSelected = true" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'" required="">
                                        <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Select Appointment Type</option>
                                        <option value="Consultation Meeting" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Consultation Meeting</option>
                                        <option value="Document Review" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Document Review</option>
                                        <option value="Document Signing" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Document Signing</option>
                                        <option value="Job Interview" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Job Interview</option>
                                        <option value="Training Session" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Training Session</option>
                                        <option value="Client Presentation" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Client Presentation</option>
                                        <option value="Follow-up Meeting" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Follow-up Meeting</option>
                                        <option value="Other" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Other</option>
                                    </select>
                                    <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                </span>
                                </div>
                            </div>

                            <!-- Date and Time Section -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                            <!-- Date Input -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Appointment Date
                                </label>
                                <div class="relative">
                                <div class="flatpickr-wrapper">
                                    <div class="flatpickr-wrapper">
                                        <input type="text" placeholder="Select date" id="date" name="date" x-model="appointment.date" class="dark:bg-dark-900 datepickerTwo shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 flatpickr-input" readonly="readonly" required=""><div class="flatpickr-calendar animate static null" tabindex="-1"><div class="flatpickr-months"><span class="flatpickr-prev-month"><svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.25 6L9 12.25L15.25 18.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span><div class="flatpickr-month"><div class="flatpickr-current-month"><span class="cur-month">January </span><div class="numInputWrapper"><input class="numInput cur-year" type="number" tabindex="-1" aria-label="Year"><span class="arrowUp"></span><span class="arrowDown"></span></div></div></div><span class="flatpickr-next-month"><svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="httpwww.w3.org/2000/svg"><path d="M8.75 19L15 12.75L8.75 6.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span></div><div class="flatpickr-innerContainer"><div class="flatpickr-rContainer"><div class="flatpickr-weekdays"><div class="flatpickr-weekdaycontainer">
                                        <span class="flatpickr-weekday">
                                            Sun</span><span class="flatpickr-weekday">Mon</span><span class="flatpickr-weekday">Tue</span><span class="flatpickr-weekday">Wed</span><span class="flatpickr-weekday">Thu</span><span class="flatpickr-weekday">Fri</span><span class="flatpickr-weekday">Sat
                                        </span>
                                        </div>
                                    </div>
                                    <div class="flatpickr-days" tabindex="-1">
                                        <div class="dayContainer">
                                            <span class="flatpickr-day prevMonthDay" aria-label="December 28, 2025" tabindex="-1">28</span><span class="flatpickr-day prevMonthDay" aria-label="December 29, 2025" tabindex="-1">29</span><span class="flatpickr-day prevMonthDay" aria-label="December 30, 2025" tabindex="-1">30</span><span class="flatpickr-day prevMonthDay" aria-label="December 31, 2025" tabindex="-1">31</span><span class="flatpickr-day" aria-label="January 1, 2026" tabindex="-1">1</span><span class="flatpickr-day" aria-label="January 2, 2026" tabindex="-1">2</span><span class="flatpickr-day" aria-label="January 3, 2026" tabindex="-1">3</span><span class="flatpickr-day" aria-label="January 4, 2026" tabindex="-1">4</span><span class="flatpickr-day" aria-label="January 5, 2026" tabindex="-1">5</span><span class="flatpickr-day" aria-label="January 6, 2026" tabindex="-1">6</span><span class="flatpickr-day" aria-label="January 7, 2026" tabindex="-1">7</span><span class="flatpickr-day" aria-label="January 8, 2026" tabindex="-1">8</span><span class="flatpickr-day" aria-label="January 9, 2026" tabindex="-1">9</span><span class="flatpickr-day" aria-label="January 10, 2026" tabindex="-1">10</span><span class="flatpickr-day" aria-label="January 11, 2026" tabindex="-1">11</span><span class="flatpickr-day" aria-label="January 12, 2026" tabindex="-1">12</span><span class="flatpickr-day" aria-label="January 13, 2026" tabindex="-1">13</span><span class="flatpickr-day" aria-label="January 14, 2026" tabindex="-1">14</span><span class="flatpickr-day" aria-label="January 15, 2026" tabindex="-1">15</span><span class="flatpickr-day" aria-label="January 16, 2026" tabindex="-1">16</span><span class="flatpickr-day" aria-label="January 17, 2026" tabindex="-1">17</span><span class="flatpickr-day" aria-label="January 18, 2026" tabindex="-1">18</span><span class="flatpickr-day" aria-label="January 19, 2026" tabindex="-1">19</span><span class="flatpickr-day" aria-label="January 20, 2026" tabindex="-1">20</span><span class="flatpickr-day" aria-label="January 21, 2026" tabindex="-1">21</span><span class="flatpickr-day" aria-label="January 22, 2026" tabindex="-1">22</span><span class="flatpickr-day" aria-label="January 23, 2026" tabindex="-1">23</span><span class="flatpickr-day" aria-label="January 24, 2026" tabindex="-1">24</span><span class="flatpickr-day" aria-label="January 25, 2026" tabindex="-1">25</span><span class="flatpickr-day today" aria-label="January 26, 2026" aria-current="date" tabindex="-1">26</span><span class="flatpickr-day" aria-label="January 27, 2026" tabindex="-1">27</span><span class="flatpickr-day" aria-label="January 28, 2026" tabindex="-1">28</span><span class="flatpickr-day" aria-label="January 29, 2026" tabindex="-1">29</span><span class="flatpickr-day" aria-label="January 30, 2026" tabindex="-1">30</span><span class="flatpickr-day" aria-label="January 31, 2026" tabindex="-1">31</span><span class="flatpickr-day nextMonthDay" aria-label="February 1, 2026" tabindex="-1">1</span><span class="flatpickr-day nextMonthDay" aria-label="February 2, 2026" tabindex="-1">2</span><span class="flatpickr-day nextMonthDay" aria-label="February 3, 2026" tabindex="-1">3</span><span class="flatpickr-day nextMonthDay" aria-label="February 4, 2026" tabindex="-1">4</span><span class="flatpickr-day nextMonthDay" aria-label="February 5, 2026" tabindex="-1">5</span><span class="flatpickr-day nextMonthDay" aria-label="February 6, 2026" tabindex="-1">6</span><span class="flatpickr-day nextMonthDay" aria-label="February 7, 2026" tabindex="-1">7</span></div></div></div></div></div></div>
                                </div>
                                <span class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z" fill=""></path>
                            </svg>
                            </span>
                                </div>
                            </div>

                            <!-- Time Input -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Appointment Time
                                </label>
                                <div class="relative">
                                    <input type="time" x-model="appointment.time" id="time" name="time" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" required="">
                                    <span class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2.5C6.13401 2.5 3 5.63401 3 9.5C3 13.366 6.13401 16.5 10 16.5C13.866 16.5 17 13.366 17 9.5C17 5.63401 13.866 2.5 10 2.5ZM1.5 9.5C1.5 4.80558 5.30558 1 10 1C14.6944 1 18.5 4.80558 18.5 9.5C18.5 14.1944 14.6944 18 10 18C5.30558 18 1.5 14.1944 1.5 9.5ZM10 4.5C10.2761 4.5 10.5 4.72386 10.5 5V9.5C10.5 9.77614 10.2761 10 10 10C9.72386 10 9.5 9.77614 9.5 9.5V5C9.5 4.72386 9.72386 4.5 10 4.5ZM14 9.5C14 9.22386 13.7761 9 13.5 9H10C9.72386 9 9.5 9.22386 9.5 9.5C9.5 9.77614 9.72386 10 10 10H13.5C13.7761 10 14 9.77614 14 9.5Z" fill=""></path>
                                    </svg>
                                    </span>
                                </div>
                            </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                            <!-- Priority -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Priority Level
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select x-model="appointment.priority" @change="isOptionSelected = true" id="priority" name="priority" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" >
                                        <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Select Priority</option>
                                        <option value="Low" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Low Priority</option>
                                        <option value="Normal" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Normal Priority</option>
                                        <option value="High" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">High Priority</option>
                                        <option value="Urgent" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Urgent</option>
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

                    <!-- Step 3: Preview & Submit -->
                    <div x-show="currentStep === 3" class="space-y-6" style="display: none;">
                        <div>
                            <!-- Appointment Report Card -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">

                            <!-- Applicant Information Section -->
                            <div class="mb-8">
                                <div class="mb-4 md:mb-0">
                                <h4 class="text-normal font-bold text-gray-600 dark:text-white/90 mb-2" x-text="applicant.name || 'Applicant Name'">Applicant Name</h4>
                                <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="applicant.email || 'email@example.com'">email@example.com</p>
                                    <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="applicant.phone || '+254 700 000 000'">+254 700 000 000</p>
                                </div>
                                </div>
                                <hr class="mt-6 border-gray-200 dark:border-gray-700">
                            </div>

                            <!-- Appointment Details Section -->
                            <div class="mb-8">
                                <div class="flex items-center gap-6">
                                <div>
                                    <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Appointment Type</p>
                                    <h3 class="font-medium text-gray-500 dark:text-white/90" x-text="getAppointmentTypeLabel(appointment.type)">Not specified</h3>
                                    </div>
                                </div>
                                <!-- Date & Time -->
                                <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>
                                <!-- Date & Time -->
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Scheduled for</p>
                                    <div class="flex items-center gap-2">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="font-medium text-gray-500 dark:text-white/90">
                                        <span x-text="appointment.date || 'Not selected'">Not selected</span>
                                        <span x-show="appointment.time" style="display: none;"> at <span x-text="appointment.time"></span></span>
                                    </p>
                                    </div>
                                </div>
                                <!-- Priority -->
                                <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Priority </p>
                                    <div class="flex items-center gap-3">
                                    <p class="font-medium text-gray-500 dark:text-white/90 bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400" :class="{
                                        'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400': appointment.priority === 'low',
                                        'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400': appointment.priority === 'normal',
                                        'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400': appointment.priority === 'high',
                                        'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400': appointment.priority === 'urgent',
                                        'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-400': !appointment.priority
                                        }" x-text="appointment.priority ? appointment.priority.charAt(0).toUpperCase() + appointment.priority.slice(1) : 'Normal'">Normal</p>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Company & Purpose (if available) -->
                            <template x-if="applicant.company || applicant.purpose">
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <template x-if="applicant.company">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Company / Organization</p>
                                        <p class="font-medium text-gray-500 dark:text-white/90" x-text="applicant.company">
                                        ABC Corporation
                                        </p>
                                    </div>
                                    </template>

                                    <template x-if="applicant.purpose">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Purpose of Appointment</p>
                                        <p class="text-gray-700 dark:text-gray-300" x-text="applicant.purpose">
                                        To discuss business expansion financing options
                                        </p>
                                    </div>
                                    </template>
                                </div>
                                </div>
                            </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons - FIXED LAYOUT -->
                <div class="flex items-center justify-between px-6 pt-4 pb-6 border-t border-gray-200 dark:border-gray-700">
                    <!-- Bottom Left: Previous Button (only visible when not on step 1) -->
                    <div>
                        <button type="button" x-show="currentStep &gt; 1" @click="previousStep()" class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]" style="display: none;">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Previous
                        </button>
                    </div>

                    <!-- Bottom Right: Cancel and Action Buttons -->
                    <div class="flex items-center gap-3">
                        <!-- Cancel Button (always visible) -->
                        <button type="button" @click="newAppointmentModal = false" class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            Cancel
                        </button>

                        <!-- Next Button (for steps 1-2) -->
                        <button type="button" x-show="currentStep &lt; 3" @click="nextStep()" class="flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                            Next
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <!-- Schedule Appointment Button (for step 3) -->
                        <button type="button" x-show="currentStep === 3" @click="submitForm()" class="rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-600" style="display: none;">
                            Schedule Appointment
                        </button>
                    </div>
                </div>
            </div>
        </form>

      </div>
    </div>
    <!-- Edit Application Details -->
    <div x-show="rescheduleModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" style="display: none;">
      <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
      <div @click.outside="rescheduleModal = false" class=" relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="rescheduleModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
          <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill=""></path>
          </svg>
        </button>
        <div class="px-2 pr-14">
          <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
            Re-Schedule Appointment
          </h4>
          <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
            Review the Relevant Office and datetime.
          </p>
        </div>
            <form class="flex flex-col" action="{{ route('appointments.update') }}" method="POST" x-data="appointmentForm()" @submit.prevent="submitUpdateForm">
                @csrf
                <div class="custom-scrollbar flex-1 overflow-y-auto px-6" x-data="{
                    selectedRow: {},
                    appointmentTimeFormatted() {
                        if (!this.selectedRow.appointmentTime) return '10:30';
                        const time = this.selectedRow.appointmentTime;
                        // Handle 12-hour format conversion
                        if (time.includes('PM')) {
                            const [hours, minutes] = time.replace(' PM', '').split(':');
                            const hour24 = parseInt(hours) === 12 ? 12 : parseInt(hours) + 12;
                            return hour24.toString().padStart(2, '0') + ':' + minutes;
                        } else if (time.includes('AM')) {
                            const [hours, minutes] = time.replace(' AM', '').split(':');
                            const hour24 = parseInt(hours) === 12 ? '00' : hours.padStart(2, '0');
                            return hour24 + ':' + minutes;
                        }
                        // If already in 24-hour format
                        return time;
                    }
                }" @row-selected.window="selectedRow = $event.detail" x-init="selectedRow = {}">
                    <!-- Preview Report View (unchanged design) -->
                    <div class="space-y-6">
                        <div>
                            <!-- Appointment Report Card -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
                                <!-- Applicant Information Section -->
                                <div class="mb-8">
                                    <div class="mb-4 md:mb-0">
                                        <div>
                                            <input type="hidden" :value="selectedRow.referenceId" id="appointmentID" name="appointmentID">
                                        </div>
                                        <h4 class="text-normal font-bold text-gray-600 dark:text-white/90 mb-2" x-text="selectedRow.applicantName || 'John Mwangi'">James Kariuki</h4>
                                        <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                            <p class="text-sm text-gray-500 dark:text-gray-400" x-text="selectedRow.applicantEmail || 'john@example.com'">james.k@example.com</p>
                                            <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400" x-text="selectedRow.applicantPhone || 'Consultation Meeting'">+254 790 123 456</p>
                                        </div>
                                    </div>
                                    <hr class="mt-6 border-gray-200 dark:border-gray-700">
                                </div>

                                <!-- Appointment Details Section -->
                                <div class="mb-8">
                                    <div class="flex items-center gap-6">
                                        <!-- Office -->
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Office</p>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600 dark:bg-gray-900/30 dark:text-gray-400">
                                                Treasurer
                                            </span>
                                        </div>
                                        <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>
                                        <!-- Appointment Type -->
                                        <div>
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Appointment Type</p>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600 dark:bg-gray-900/30 dark:text-gray-400" x-text="selectedRow.appointmentType || 'Consultation Meeting'">Follow-up Meeting</span>
                                            </div>
                                        </div>
                                        <!-- Date & Time -->
                                        <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>
                                        <!-- Priority -->
                                        <div>
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Priority</p>
                                                <p class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600 dark:bg-gray-900/30 dark:text-gray-400" x-text="(selectedRow.priority ? selectedRow.priority.charAt(0).toUpperCase() + selectedRow.priority.slice(1) : 'Normal')">Normal</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Section -->
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                    <div class="flex items-center gap-6">
                                        <!-- Date & Time -->
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Scheduled for </p>
                                            <div class="flex items-center gap-2">
                                                <p class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600 dark:bg-gray-900/30 dark:text-gray-400">
                                                    <span x-text="selectedRow.appointmentDate || ' 15 Dec, 2024'"> 23 Dec, 2024 </span>
                                                    <span> at <span x-text="selectedRow.appointmentTime || ' 10:30 AM'"> 11:30 AM</span></span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Current Status</p>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600 dark:bg-gray-900/30 dark:text-gray-400" :class="{
                                                'bg-green-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': selectedRow.status === 'Confirmed',
                                                'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400': selectedRow.status === 'Pending',
                                                'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400': selectedRow.status === 'Cancelled',
                                                'bg-gray-100 text-gray-600 dark:bg-gray-900/30 dark:text-gray-400': selectedRow.status === 'Completed',
                                                'bg-green-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': !selectedRow.status
                                            }" x-text="selectedRow.status || 'Confirmed'">Completed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Change Appointment Details Section -->
                    <div class="space-y-6 mt-8">
                        <h5 class="text-lg font-medium text-gray-800 dark:text-white/90 mb-6">Change Appointment Details</h5>

                        <!-- Date and Time (on same line) -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                            <!-- Date Input -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    New Date
                                </label>
                                <div class="relative">
                                    <div class="flatpickr-wrapper">
                                        <input type="text"
                                            :value="selectedRow.appointmentDate"
                                            placeholder="Select new date"
                                            id="newDate"
                                            name="newDate"
                                            class="dark:bg-dark-900 datepickerTwo shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 flatpickr-input"
                                            readonly="readonly">
                                    </div>
                                    <span class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z" fill=""></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <!-- Time Input -->
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    New Time
                                </label>
                                <div class="relative">
                                    <input type="time"
                                        id="newTime"
                                        name="newTime"
                                        :value="appointmentTimeFormatted()"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" value="10:30">
                                    <span class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2.5C6.13401 2.5 3 5.63401 3 9.5C3 13.366 6.13401 16.5 10 16.5C13.866 16.5 17 13.366 17 9.5C17 5.63401 13.866 2.5 10 2.5ZM1.5 9.5C1.5 4.80558 5.30558 1 10 1C14.6944 1 18.5 4.80558 18.5 9.5C18.5 14.1944 14.6944 18 10 18C5.30558 18 1.5 14.1944 1.5 9.5ZM10 4.5C10.2761 4.5 10.5 4.72386 10.5 5V9.5C10.5 9.77614 10.2761 10 10 10C9.72386 10 9.5 9.77614 9.5 9.5V5C9.5 4.72386 9.72386 4.5 10 4.5ZM14 9.5C14 9.22386 13.7761 9 13.5 9H10C9.72386 9 9.5 9.22386 9.5 9.5C9.5 9.77614 9.72386 10 10 10H13.5C13.7761 10 14 9.77614 14 9.5Z" fill=""></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Appointment Status -->
                        <div class="mb-6">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Appointment Status
                            </label>
                            <div class="relative z-20 bg-transparent">
                                <select x-model="selectedRow.status" id="newStatus" name="newStatus" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" @change="isOptionSelected = true">
                                    <option value="Confirmed" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400" selected="">Confirmed</option>
                                    <option value="Pending" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Pending</option>
                                    <option value="Cancelled" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">Cancelled</option>
                                </select>
                                <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons - Bottom Right -->
                    <div class="flex justify-end items-center gap-3 pt-6 border-t border-gray-200 dark:border-gray-700 mt-8">
                        <button class="h-11 rounded-lg border border-gray-300 bg-transparent px-6 text-sm font-semibold text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 disabled:pointer-events-none disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-300">
                            Close
                        </button>
                        <button @click="deleteAppointment(selectedRow)"
                                class="rounded-lg border border-error-300 bg-white px-5 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            Delete
                        </button>
                        <button type="submit" class="h-11 rounded-lg border border-brand-500 bg-brand-500 px-6 text-sm font-semibold text-white shadow-theme-xs hover:bg-brand-600 disabled:pointer-events-none disabled:opacity-50">
                            Reschedule Appointment
                        </button>
                    </div>
                </div>
            </form>
      </div>
    </div>

    <!-- Alerts -->


    <script defer src="{{ asset('assets/bundle.js') }}"></script>

    <script>
        // Appointment form handler
        function appointmentForm() {
            return {
                // Form submission handler
                async submitUpdateForm(event) {
                    event.preventDefault();

                    const form = this.$el;
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;

                    // Get form data
                    const formData = new FormData(form);

                    // Find the selected row from the inner Alpine component
                    const innerComponent = form.querySelector('[x-data]');
                    const selectedRow = innerComponent ? Alpine.$data(innerComponent).selectedRow : null;

                    if (!selectedRow || !selectedRow.referenceId) {
                        alert('Please select an appointment first');
                        return;
                    }

                    // Get date and time values
                    const dateInput = form.querySelector('#newDate');
                    const timeInput = form.querySelector('#newTime');

                    // Convert date from "04 Feb, 2026" to "2026-02-04"
                    if (dateInput && dateInput.value) {
                        const dateValue = dateInput.value.trim();

                        // Try to parse the date
                        const parsedDate = this.parseDisplayDateToISO(dateValue);
                        if (parsedDate) {
                            // Update the formData with the correct format
                            formData.set('newDate', parsedDate);
                        } else {
                            alert('Invalid date format. Please use the date picker to select a date.');
                            return;
                        }
                    }

                    // Ensure time is in HH:MM format (already is from time input)
                    if (timeInput && timeInput.value) {
                        // Time input already gives HH:MM format
                        // Just make sure it's properly formatted
                        const timeValue = timeInput.value;
                        if (!timeValue.match(/^\d{2}:\d{2}$/)) {
                            alert('Invalid time format. Please use HH:MM format.');
                            return;
                        }
                        formData.set('newTime', timeValue);
                    }

                    // Show loading
                    submitBtn.innerHTML = '<span class="flex items-center justify-center gap-2"><span class="animate-spin h-4 w-4 border-2 border-white border-t-transparent rounded-full"></span> Updating...</span>';
                    submitBtn.disabled = true;

                    // Wait 1 second before sending request
                    await new Promise(resolve => setTimeout(resolve, 1000));

                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            alert(data.message || 'Appointment updated successfully!');
                            window.location.href = '{{ route('treasurer.appointments') }}';
                        } else {
                            alert('Error: ' + (data.message || 'Failed to update appointment'));
                        }
                    } catch (error) {
                        console.error('Fetch error:', error);
                        alert('Network error. Please try again.');
                    } finally {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                },

                // Helper function to convert display date to ISO format
                parseDisplayDateToISO(dateString) {
                    try {
                        // Date picker format: "Jan 31, 2026" (Month Day, Year)
                        const match = dateString.match(/(\w{3})\s+(\d{1,2}),\s+(\d{4})/);

                        if (!match) {
                            // If it's already in YYYY-MM-DD format, return as is
                            if (dateString.match(/^\d{4}-\d{2}-\d{2}$/)) {
                                return dateString;
                            }
                            return null;
                        }

                        const [, month, day, year] = match; // Changed order: month, day, year
                        const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        const monthIndex = monthNames.indexOf(month);

                        if (monthIndex === -1) {
                            return null;
                        }

                        // Create date string in YYYY-MM-DD format directly
                        const paddedDay = day.padStart(2, '0');
                        const paddedMonth = String(monthIndex + 1).padStart(2, '0');

                        return `${year}-${paddedMonth}-${paddedDay}`;

                    } catch (error) {
                        console.error('Date parsing error:', error);
                        return null;
                    }
                },

                // Delete appointment handler
                async deleteAppointment(row) {
                    if (!row || !row.referenceId) {
                        alert('Please select an appointment to delete');
                        return;
                    }

                    if (!confirm('Are you sure you want to delete this appointment? This action cannot be undone.')) {
                        return;
                    }

                    const deleteBtn = event?.target?.closest('button') || event?.target;
                    const originalContent = deleteBtn?.innerHTML;

                    // Show loading if button exists
                    if (deleteBtn) {
                        deleteBtn.innerHTML = '<span class="animate-spin h-4 w-4 border-2 border-error-500 border-t-transparent rounded-full"></span>';
                        deleteBtn.disabled = true;
                    }

                    // Wait 1 second before sending request
                    await new Promise(resolve => setTimeout(resolve, 1000));

                    try {
                        const response = await fetch('/appointments/delete', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                appointmentID: row.referenceId
                            })
                        });

                        const result = await response.json();

                        if (result.success) {
                            alert('Appointment deleted successfully!');
                            window.location.href = '{{ route('treasurer.appointments') }}';
                        } else {
                            alert('Error: ' + (result.message || 'Failed to delete appointment'));
                        }
                    } catch (error) {
                        console.error('Delete error:', error);
                        alert('Network error. Please try again.');
                    } finally {
                        // Restore button if it exists
                        if (deleteBtn) {
                            deleteBtn.innerHTML = originalContent;
                            deleteBtn.disabled = false;
                        }
                    }
                }
            };
        }

        // Table component
        function appointmentsTable() {
            return {
                // Initialize with empty array, will be populated from DB
                originalRows: [],
                myTodayConfirmedRows: [],
                selected: [],
                selectAll: false,
                sort: { key: "appointmentDate", asc: true },
                page: 1,
                perPage: 10,
                searchQuery: "",
                statusFilter: "all",
                dateFilter: "all", // Added date filter property
                searchTimeout: null,

                // Initialize function to fetch data
                init() {
                    this.fetchAppointments();
                    this.fetchMyTodayConfirmedAppointments();

                    // Listen for refresh events
                    window.addEventListener('refresh-appointments', () => {
                        this.fetchAppointments();
                        this.fetchMyTodayConfirmedAppointments();
                    });
                },

                // Fetch appointments from Laravel backend
                async fetchAppointments() {
                    try {
                        console.log('Fetching appointments...');
                        const response = await fetch('/appointments/get-all');
                        const result = await response.json();

                        if (result.success) {
                            this.originalRows = result.data;
                            console.log('Appointments loaded:', this.originalRows.length);
                        } else {
                            console.error('Error fetching appointments:', result.message);
                            this.originalRows = [];
                        }
                    } catch (error) {
                        console.error('Error fetching appointments:', error);
                        this.originalRows = [];
                    }
                },

                async fetchMyTodayConfirmedAppointments() {
                    try {
                        const response = await fetch('/appointments/my-today-confirmed');
                        const result = await response.json();

                        if (result.success) {
                            this.myTodayConfirmedRows = result.data;
                            console.log('My today confirmed appointments:', this.myTodayConfirmedRows);
                        } else {
                            console.error('Error fetching today\'s confirmed appointments:', result.message);
                            this.myTodayConfirmedRows = [];
                        }
                    } catch (error) {
                        console.error('Error fetching today\'s confirmed appointments:', error);
                        this.myTodayConfirmedRows = [];
                    }
                },

                // Helper function to get date ranges
                getDateRanges() {
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    const tomorrow = new Date(today);
                    tomorrow.setDate(tomorrow.getDate() + 1);

                    const endOfWeek = new Date(today);
                    // Get end of week (Saturday)
                    endOfWeek.setDate(today.getDate() + (6 - today.getDay()));
                    endOfWeek.setHours(23, 59, 59, 999);

                    const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                    endOfMonth.setHours(23, 59, 59, 999);

                    const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

                    return {
                        today: {
                            start: today,
                            end: new Date(today.getFullYear(), today.getMonth(), today.getDate(), 23, 59, 59, 999)
                        },
                        tomorrow: {
                            start: tomorrow,
                            end: new Date(tomorrow.getFullYear(), tomorrow.getMonth(), tomorrow.getDate(), 23, 59, 59, 999)
                        },
                        thisWeek: {
                            start: today,
                            end: endOfWeek
                        },
                        thisMonth: {
                            start: startOfMonth,
                            end: endOfMonth
                        }
                    };
                },

                // Check if appointment date matches filter
                matchesDateFilter(appointmentDate) {
                    if (this.dateFilter === "all") return true;

                    const appointmentDateObj = new Date(appointmentDate);
                    const ranges = this.getDateRanges();

                    switch(this.dateFilter) {
                        case "Today":
                            return appointmentDateObj >= ranges.today.start &&
                                appointmentDateObj <= ranges.today.end;

                        case "Tomorrow":
                            return appointmentDateObj >= ranges.tomorrow.start &&
                                appointmentDateObj <= ranges.tomorrow.end;

                        case "This week":
                            return appointmentDateObj >= ranges.thisWeek.start &&
                                appointmentDateObj <= ranges.thisWeek.end;

                        case "This Month":
                            return appointmentDateObj >= ranges.thisMonth.start &&
                                appointmentDateObj <= ranges.thisMonth.end;

                        default:
                            return true;
                    }
                },

                // Get filtered rows based on search and filters
                get filteredRows() {
                    let filtered = this.originalRows;

                    // Apply search filter
                    if (this.searchQuery) {
                        const query = this.searchQuery.toLowerCase();
                        filtered = filtered.filter(row =>
                            row.applicantName.toLowerCase().includes(query) ||
                            row.applicantEmail.toLowerCase().includes(query) ||
                            (row.applicantPhone && row.applicantPhone.toLowerCase().includes(query))
                        );
                    }

                    // Apply status filter
                    if (this.statusFilter !== "all") {
                        filtered = filtered.filter(row => row.status === this.statusFilter);
                    }

                    // Apply date filter
                    if (this.dateFilter !== "all") {
                        filtered = filtered.filter(row => {
                            return this.matchesDateFilter(row.appointmentDate);
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
                        this.page * this.perPage,
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
                        this.selected.includes(row.id),
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

                // Handle search input
                handleSearch() {
                    clearTimeout(this.searchTimeout);
                    this.searchTimeout = setTimeout(() => {
                        this.page = 1;
                    }, 300);
                },

                // Handle filter change (for both status and date)
                handleFilterChange() {
                    this.page = 1;
                },

                // Row selection event for form
                selectRow(row) {
                    const event = new CustomEvent('row-selected', {
                        detail: row
                    });
                    window.dispatchEvent(event);
                },

                // Dropdown function
                dropdown() {
                    return {
                        open: false,
                        toggle() {
                            this.open = !this.open;
                        }
                    };
                }
            };
        }

    </script>

    <!-- Simplified JavaScript -->
    <script>
        function dashboardStats() {
            return {
                stats: {
                    total_appointments: 0,
                    today_confirmed: 0,
                    upcoming_pending: 0
                },

                async fetchStats() {
                    try {
                        const response = await fetch('/appointments/dashboard-stats');
                        const result = await response.json();

                        if (result.success) {
                            this.stats = result.data;
                        } else {
                            console.error('Error fetching stats:', result.message);
                        }
                    } catch (error) {
                        console.error('Error fetching stats:', error);
                    }
                }
            }
        }
    </script>

    <script>
        function appointmentWizard() {
            return {
                currentStep: 1,
                agreement: false,
                isOptionSelected: false,

                // Store selected appointment data for modal
                selectedAppointment: {
                    applicantName: '',
                    applicantEmail: '',
                    appointmentType: '',
                    appointmentDate: '',
                    appointmentTime: '',
                    subject: '',
                    priority: '',
                    status: ''
                },

                applicant: {
                    firstName: '',
                    lastName: '',
                    email: '',
                    phone: '',
                    company: '',
                    purpose: ''
                },

                appointment: {
                    type: '',
                    date: '',
                    time: '',
                    subject: '',
                    description: '',
                    duration: '',
                    priority: 'Normal'
                },

                get fullName() {
                    return `${this.applicant.firstName} ${this.applicant.lastName}`.trim();
                },

                // Method to handle row selection for rescheduling
                selectAppointmentForReschedule(row) {
                    this.selectedAppointment = {
                        applicantName: row.applicantName || '',
                        applicantEmail: row.applicantEmail || '',
                        appointmentType: row.appointmentType || '',
                        appointmentDate: row.appointmentDate || '',
                        appointmentTime: row.appointmentTime || '',
                        subject: row.subject || '',
                        priority: row.priority || 'normal',
                        status: row.status || 'Pending'
                    };

                    // Pre-fill the rescheduling form with this data
                    this.applicant.name = row.applicantName || '';
                    this.applicant.email = row.applicantEmail || '';
                    this.appointment.subject = row.subject || '';
                    this.appointment.type = row.appointmentType || '';
                    this.appointment.date = row.appointmentDate || '';
                    this.appointment.time = row.appointmentTime || '';
                    this.appointment.priority = row.priority || 'normal';
                },

                nextStep() {
                    if (this.validateCurrentStep()) {
                        this.currentStep++;
                    }
                },

                previousStep() {
                    if (this.currentStep > 1) {
                        this.currentStep--;
                    }
                },

                validateCurrentStep() {
                    if (this.currentStep === 1) {
                        if (!this.applicant.firstName || !this.applicant.lastName || !this.applicant.email || !this.applicant.phone) {
                            return false;
                        }

                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(this.applicant.email)) {
                            return false;
                        }
                    }

                    if (this.currentStep === 2) {
                        if (!this.appointment.type || !this.appointment.date || !this.appointment.time || !this.appointment.priority) {
                            return false;
                        }
                    }

                    return true;
                },

                getAppointmentTypeLabel(type) {
                    const types = {
                        'Consultation Meeting': 'Consultation Meeting',
                        'Document Review': 'Document Review',
                        'Document Signing': 'Document Signing',
                        'Job Interview': 'Job Interview',
                        'Training Session': 'Training Session',
                        'Client Presentation': 'Client Presentation',
                        'Follow-up Meeting': 'Follow-up Meeting',
                        'Other': 'Other'
                    };
                    return types[type] || 'Not specified';
                },

                submitForm() {
                    // Get form and submit button
                    const form = document.getElementById('appointmentForm');
                    const submitBtn = form.querySelector('button[type="button"][x-show="currentStep === 3"]');
                    const originalText = submitBtn.innerHTML;

                    // Show loading
                    submitBtn.innerHTML = 'Scheduling...';
                    submitBtn.disabled = true;

                    // Submit via fetch (AJAX)
                    fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Success alert
                            alert(data.message || 'Appointment scheduled successfully!');
                            // Close modal and redirect
                            window.location.href = '{{ route("treasurer.appointments") }}';
                        } else {
                            // Error alert
                            alert('Error: ' + (data.message || 'Failed to create appointment'));
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        alert('Network error. Please try again.');
                    })
                    .finally(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    });
                },

                generateReferenceId() {
                    const date = new Date();
                    const year = date.getFullYear();
                    const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
                    return `APT-${year}-${random}`;
                },

                formatPriority(priority) {
                    if (!priority) return 'Normal';
                    return priority.charAt(0).toUpperCase() + priority.slice(1);
                }
            };
        }

        // Simple event listener for reschedule button clicks
        document.addEventListener('DOMContentLoaded', function() {
        // Listen for clicks on reschedule buttons (if you have them)
        document.addEventListener('click', function(event) {
            if (event.target.closest('button') && event.target.closest('button').textContent.includes('Reschedule')) {
                const row = event.target.closest('tr');
                if (row) {
                    console.log('Reschedule clicked for row:', row);
                    // You can add reschedule logic here if needed
                }
            }
        });
    });
    </script>

    </body>

</html>
