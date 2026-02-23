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

<body x-data="{ page: 'profile', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'loanTypeModal' : false, 'personalInformationModal': false , 'sidebarToggle': false, 'scrollTop': false, 'identificationDocumentsModal': false, 'nextKinModal': false, 'vehiclesModal': false, 'contributionsModal': false, 'savingsModal': false, 'loansModal': false, 'finesPenaltiesModal': false, 'deleteMemberAccount': false, 'editNextKinModal': false, 'editMemberVehiclesModal': false, 'assignMemberVehicle': false, 'reassignMemberVehicle': false, 'withdrawContribution':false, 'withdrawSavings': false, 'payLoan': false, 'withdrawContributionModal': false, 'editContributionModal': false, 'awardBonusModal': false}"
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
            <div x-data="{ pageName: `Bodaboda Member`}">
              <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
                <nav>
                  <ol class="flex items-center gap-1.5">
                    <li>
                      <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('treasurer.bodaboda') }}">Bodaboda List
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
            <!-- Breadcrumb End -->

            <!-- Member Card -->
            <div class="col-span-12 mb-4">
                <!-- Metric Group Two -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:gap-6 xl:grid-cols-1">
                    <!-- Metric Item Start -->
                    <div class=" rounded-2xl border border-gray-200 bg-white p-5 lg:p-6 dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">

                                <div class="flex w-full flex-col items-center gap-6 xl:flex-row">
                                    <div class="h-[78px] w-[78px] overflow-hidden rounded-full border border-gray-200 bg-gray-100 flex items-center justify-center dark:border-gray-800 dark:bg-gray-800">
                                        <svg class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="order-3 xl:order-2" x-data="memberInfo">
                                        <h4 class="mb-2 text-center text-lg font-semibold text-gray-800 xl:text-left dark:text-white/90" x-text="memberData?.member?.firstname + ' ' + memberData?.member?.lastname">
                                                James Mwangi
                                        </h4>
                                        <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Membership: <span x-text="memberData?.member?.membership">Member</span></p>
                                            <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                <span class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 text-xs font-medium"><span x-text="memberData?.member?.status">Active</span></span>
                                                Member since <span x-text="formatDate(memberData?.member?.created_on)">December 09, 2025 15:24</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-3 sm:flex-row">
                                    <button @click="isProfileNextOfKinModal = true" class="flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                            </svg>
                                            Print
                                        </button>
                                </div>
                        </div>
                    </div>
                    <!-- Metric Item End -->
                </div>
            </div>

            <!-- Common Stats -->
            <div class="col-span-12 mb-4">
                <!-- Metric Group Two -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:gap-6 xl:grid-cols-4" x-data="memberInfo">
                            <!-- Metric Item Start -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    Vehicles
                                </p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-500 dark:text-white/90" >
                                            <!-- Member Vehicles Count -->
                                            <span x-data="{ memberCount: 0 }"
                                                x-show="memberData?.member?.membership === 'Member'"
                                                x-init="fetch('/bodaboda-member/{{ $memberId }}/vehicles/member/count')
                                                    .then(res => res.json())
                                                    .then(data => { if(data.success) memberCount = data.count })">
                                                <span x-text="memberCount"></span> Owned
                                            </span>

                                            <!-- Non-Member Vehicles Count -->
                                            <span x-data="{ nonMemberCount: 0 }"
                                                x-show="memberData?.member?.membership === 'Non-Member'"
                                                x-init="fetch('/bodaboda-member/{{ $memberId }}/vehicles/nonmember/count')
                                                    .then(res => res.json())
                                                    .then(data => { if(data.success) nonMemberCount = data.count })">
                                                <span x-text="nonMemberCount"></span> Assigned
                                            </span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Metric Item End -->

                            <!-- Metric Item Start - Member's Contribution Balance -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]"
                                x-data x-init="$store.contributionData.memberBalanceFormatted">

                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    Contributions
                                </p>

                                <div class="mt-3 flex items-end justify-between">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-500 dark:text-white/90"
                                            x-text="$store.contributionData.memberBalanceFormatted">
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

                        <!-- Metric Item Start -->
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Savings Wallet</p>

                            <div class="mt-3 flex items-end justify-between">
                                <div>
                                <h4 class="text-xl font-semibold text-gray-500 dark:text-white/90">KES 0.00</h4>
                                </div>

                                <div class="flex items-center gap-1">
                                <span class="flex items-center gap-1 rounded-full bg-error-50 px-2 py-0.5 text-theme-xs font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                                    0 %
                                </span>

                                <span class="text-theme-xs text-gray-500 dark:text-gray-400">
                                    Vs Last Month
                                </span>
                                </div>
                            </div>
                        </div>
                        <!-- Metric Item End -->

                        <!-- Metric Item Start -->
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Active Loans</p>

                            <div class="mt-3 flex items-end justify-between">
                                <div>
                                    <h4 class="text-xl font-semibold text-gray-500 dark:text-white/90" x-text="memberData?.loans?.filter(loan => loan.transactionLoanStatus === 'Active').length || 0">
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
                </div>
                <!-- Metric Group Two -->
            </div>


            <!-- Tabbed Section -->
            <div class="rounded-xl border border-gray-200 p-6 bg-white dark:border-gray-800 dark:bg-white/[0.03]" x-data="{ activeTab: 'personal' }">
                <!-- Top Navigation Menu -->
                <div class="border-b border-gray-200 dark:border-gray-800">
                    <nav class="-mb-px flex space-x-2 overflow-x-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-200 dark:[&::-webkit-scrollbar-thumb]:bg-gray-600 dark:[&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar]:h-1.5">
                        <button @click="activeTab = 'personal'"
                                :class="activeTab === 'personal' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg class="size-5"  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Personal Information
                        </button>

                        <button @click="activeTab = 'documents'"
                                :class="activeTab === 'documents' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="size-5" :class="activeTab === 'documents' ? 'text-brand-600 dark:text-brand-400' : 'text-gray-700 dark:text-gray-300'">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z"></path>
                            <path d="M3 10l18 0"></path>
                            <path d="M7 15l.01 0"></path>
                            <path d="M11 15l2 0"></path>
                            </svg>
                            Verification
                        </button>

                        <button @click="activeTab = 'next-of-kin'"
                                :class="activeTab === 'next-of-kin' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg class="size-5"  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Next of Kin
                        </button>

                        <button @click="activeTab = 'vehicles'"
                                :class="activeTab === 'vehicles' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M19 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M7.5 14h5l4 -4h-10.5m1.5 4l4 -4"></path>
                                <path d="M13 6h2l1.5 3l2 4"></path>
                            </svg>
                            Vehicles
                        </button>

                        <button @click="activeTab = 'contributions'"
                                :class="activeTab === 'contributions' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg width="20" height="20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="size-5" :class="activeTab === 'contributions' ? 'text-brand-600 dark:text-brand-400' : 'text-gray-700 dark:text-gray-300'">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="1" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"></path>
                            </svg>
                            Contributions
                        </button>

                        <button @click="activeTab = 'savings'"
                                :class="activeTab === 'savings' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-5" >
                                <path d="M15.3086 2C15.7228 2 16.0586 2.33579 16.0586 2.75V2.91898C16.807 3.10815 17.3609 3.78601 17.3609 4.59323C17.3609 5.00744 17.0251 5.34323 16.6109 5.34323C16.1967 5.34323 15.8609 5.00744 15.8609 4.59323C15.8609 4.46796 15.7594 4.36641 15.6341 4.36641H15.2391C14.9724 4.36641 14.7563 4.58257 14.7563 4.84921C14.7563 5.05046 14.8811 5.2306 15.0695 5.30127L16.0744 5.67811C16.8482 5.96833 17.3609 6.70814 17.3609 7.53464C17.3609 8.39065 16.8185 9.11996 16.0586 9.39759V9.63372C16.0586 10.0479 15.7228 10.3837 15.3086 10.3837C14.8944 10.3837 14.5586 10.0479 14.5586 9.63372V9.46488C13.8101 9.2757 13.2563 8.59785 13.2563 7.79062C13.2563 7.37641 13.5921 7.04062 14.0063 7.04062C14.4205 7.04062 14.7563 7.37641 14.7563 7.79062C14.7563 7.91589 14.8578 8.01744 14.9831 8.01744H15.3781C15.6448 8.01744 15.8609 7.80129 15.8609 7.53464C15.8609 7.3334 15.7361 7.15326 15.5477 7.08259L14.5428 6.70575C13.7689 6.41552 13.2563 5.67571 13.2563 4.84921C13.2563 3.99321 13.7987 3.2639 14.5586 2.98626V2.75C14.5586 2.33579 14.8944 2 15.3086 2Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.4266 11.0844C20.0839 10.5513 21.0447 10.6316 21.6044 11.2664C22.1114 11.8415 22.1317 12.6979 21.6525 13.2964L17.7859 18.125C17.4104 18.5938 16.8423 18.8667 16.2417 18.8667H10.0685C9.8825 18.8667 9.70317 18.9358 9.56527 19.0606L9.04042 19.5355C9.14503 19.864 9.01125 20.2324 8.7004 20.4119L6.1238 21.8995C5.76508 22.1066 5.30638 21.9837 5.09928 21.625L2.10061 16.4311C1.8935 16.0724 2.01641 15.6137 2.37513 15.4066L4.95173 13.919C5.18986 13.7815 5.47206 13.7895 5.69546 13.9153L7.38764 12.5626C7.94114 12.1201 8.64057 11.8151 9.41278 11.8116C10.2262 11.8079 11.5119 11.8799 12.6754 12.3045H15.2732C15.9345 12.3045 16.512 12.6637 16.8212 13.1975L19.4266 11.0844ZM8.55886 17.9483L8.2864 18.1948L6.53627 15.1635L8.32425 13.7342C8.66549 13.4614 9.04628 13.3133 9.41955 13.3116C10.1887 13.3081 11.296 13.3834 12.222 13.7363C12.3365 13.7799 12.4613 13.8045 12.5912 13.8045H15.2732C15.432 13.8045 15.5608 13.9333 15.5608 14.0922C15.5608 14.1589 15.5381 14.2203 15.5 14.2691L15.4269 14.3284C15.4184 14.3352 15.4102 14.3422 15.4021 14.3494C15.3633 14.3688 15.3195 14.3798 15.2732 14.3798H12.5383C12.1241 14.3798 11.7883 14.7156 11.7883 15.1298C11.7883 15.544 12.1241 15.8798 12.5383 15.8798H15.2732C15.7583 15.8798 16.1984 15.6865 16.5205 15.3728L20.3715 12.2494C20.404 12.223 20.4515 12.227 20.4792 12.2584C20.5043 12.2868 20.5053 12.3292 20.4816 12.3588L16.615 17.1874C16.5242 17.3007 16.3869 17.3667 16.2417 17.3667H10.0685C9.51056 17.3667 8.97255 17.574 8.55886 17.9483ZM3.77464 16.3307L6.02332 20.2255L7.30088 19.4879L5.05221 15.5931L3.77464 16.3307Z" fill="currentColor"></path>
                            </svg>
                            Savings
                        </button>

                        <button @click="activeTab = 'loans'"
                                :class="activeTab === 'loans' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg class="size-5" :class="activeTab === 'loans' ? 'text-brand-600 dark:text-brand-400' : 'text-gray-700 dark:text-gray-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Loans
                        </button>

                        <button @click="activeTab = 'fines'"
                                :class="activeTab === 'fines' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-5" :class="activeTab === 'fines' ? 'text-brand-600 dark:text-brand-400' : 'text-gray-700 dark:text-gray-300'">
                            <path d="M17.8076 2C18.2218 2 18.5576 2.33579 18.5576 2.75V2.91898C19.3061 3.10815 19.8599 3.78601 19.8599 4.59323C19.8599 5.00744 19.5242 5.34323 19.1099 5.34323C18.6957 5.34323 18.3599 5.00744 18.3599 4.59323C18.3599 4.46796 18.2584 4.36641 18.1331 4.36641H17.7381C17.4714 4.36641 17.2553 4.58257 17.2553 4.84921C17.2553 5.05046 17.3801 5.2306 17.5686 5.30127L18.5734 5.67811C19.3473 5.96833 19.8599 6.70814 19.8599 7.53464C19.8599 8.39065 19.3175 9.11996 18.5576 9.39759V9.63372C18.5576 10.0479 18.2218 10.3837 17.8076 10.3837C17.3934 10.3837 17.0576 10.0479 17.0576 9.63372V9.46488C16.3092 9.2757 15.7553 8.59785 15.7553 7.79062C15.7553 7.37641 16.0911 7.04062 16.5053 7.04062C16.9195 7.04062 17.2553 7.37641 17.2553 7.79062C17.2553 7.91589 17.3568 8.01744 17.4821 8.01744H17.8771C18.1438 8.01744 18.3599 7.80129 18.3599 7.53464C18.3599 7.3334 18.2351 7.15326 18.0467 7.08259L17.0418 6.70575C16.268 6.41552 15.7553 5.67571 15.7553 4.84921C15.7553 3.99321 16.2977 3.2639 17.0576 2.98626V2.75C17.0576 2.33579 17.3934 2 17.8076 2Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 3.25045C4.25736 3.25045 3.25 4.25781 3.25 5.50045V18.5005C3.25 19.7431 4.25736 20.7505 5.5 20.7505H5.83333C7.07597 20.7505 8.08333 19.7431 8.08333 18.5005V5.50045C8.08333 4.25781 7.07598 3.25045 5.83333 3.25045H5.5ZM4.75 5.50045C4.75 5.08624 5.08579 4.75045 5.5 4.75045H5.83333C6.24755 4.75045 6.58333 5.08624 6.58333 5.50045V18.5005C6.58333 18.9147 6.24755 19.2505 5.83333 19.2505H5.5C5.08579 19.2505 4.75 18.9147 4.75 18.5005V5.50045Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.833 9.63424C10.5904 9.63424 9.58301 10.6416 9.58301 11.8842V18.5005C9.58301 19.7432 10.5904 20.7505 11.833 20.7505H12.1663C13.409 20.7505 14.4163 19.7432 14.4163 18.5005V11.8842C14.4163 10.6416 13.409 9.63424 12.1663 9.63424H11.833ZM11.083 11.8842C11.083 11.47 11.4188 11.1342 11.833 11.1342H12.1663C12.5806 11.1342 12.9163 11.47 12.9163 11.8842V18.5005C12.9163 18.9147 12.5806 19.2505 12.1663 19.2505H11.833C11.4188 19.2505 11.083 18.9147 11.083 18.5005V11.8842Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.916 14.9223C15.916 13.6797 16.9234 12.6723 18.166 12.6723H18.4993C19.742 12.6723 20.7493 13.6797 20.7493 14.9223V18.5005C20.7493 19.7432 19.742 20.7505 18.4993 20.7505H18.166C16.9234 20.7505 15.916 19.7432 15.916 18.5005V14.9223ZM18.166 14.1723C17.7518 14.1723 17.416 14.5081 17.416 14.9223V18.5005C17.416 18.9147 17.7518 19.2505 18.166 19.2505H18.4993C18.9136 19.2505 19.2493 18.9147 19.2493 18.5005V14.9223C19.2493 14.5081 18.9136 14.1723 18.4993 14.1723H18.166Z" fill="currentColor"></path>
                            </svg>
                            Fines & Penalties
                        </button>

                        <button @click="activeTab = 'account'"
                                :class="activeTab === 'account' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg class="size-5" :class="activeTab === 'account' ? 'text-brand-600 dark:text-brand-400' : 'text-gray-700 dark:text-gray-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </button>
                    </nav>
                </div>

                <!-- Content Area - Your existing code continues here -->
                <div class="pt-4 dark:border-gray-800 mb-8 gap-4 md:gap-6 p-6">
                    <!-- Personal Information -->
                    <div x-show="activeTab === 'personal'" class="border-b" x-data="memberInfo">
                      <!-- Header: Title Left + Edit Button Right -->
                      <div class="relative mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white/90 border-b">
                          Personal Information
                        </h3>
                        <button @click="personalInformationModal = true"
                                class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 sm:w-auto dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                          <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z" fill=""></path>
                          </svg>
                          Edit
                        </button>
                      </div>

                      <div class="relative grid grid-cols-1 gap-6 lg:grid-cols-1">
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                          <div>
                            <span class="mb-1 text-xs text-gray-500 dark:text-gray-400">First Name</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.firstname || 'N/A'">+254 723 000 000</p>
                          </div>
                          <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Last Name</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.lastname || 'N/A'">+254 725 000 000</p>
                          </div>
                        </div>
                        <div>
                          <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Email</p>
                          <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.email || 'N/A'">randomuser@pimjo.com</p>
                        </div>
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                          <div>
                            <span class="mb-1 text-xs text-gray-500 dark:text-gray-400">Primary Phone</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.phone1 || 'N/A'">+254 723 000 000</p>
                          </div>
                          <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Secondary Phone</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.phone2 || 'N/A'">+254 725 000 000</p>
                          </div>
                          <div>
                            <span class="mb-1 text-xs text-gray-500 dark:text-gray-400">Gender</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.gender || 'N/A'">+254 723 000 000</p>
                          </div>
                          <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Date of Birth</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.dob || 'N/A'">+254 725 000 000</p>
                          </div>
                          <div>
                            <span class="mb-1 text-xs text-gray-500 dark:text-gray-400">Membership</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.membership">+254 723 000 000</p>
                          </div>
                          <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Membership Status</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.status || 'N/A'">+254 725 000 000</p>
                          </div>
                        </div>
                      </div>

                    </div>

                    <!-- Addresses -->
                    <div x-show="activeTab === 'documents'" x-data="memberInfo">
                        <!-- Header: Title Left + Edit Button Right -->
                        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                            Identification & Documents
                            </h3>
                            <button @click="identificationDocumentsModal = true"
                                    class="shadow-theme-xs flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 sm:w-auto dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z" fill=""></path>
                            </svg>
                            Edit
                            </button>
                        </div>

                        <!-- Details Grid Below -->
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-1">
                            <div class="w-full" x-data="memberInfo">
                                <div class="flex justify-between items-start border-b border-gray-200 dark:border-gray-800 pb-3">
                                                                            <h4 class="text-base font-medium text-gray-800 dark:text-white/90">
                                                                                Identification
                                                                            </h4>
                                </div>

                                                                        <!-- Driving License -->
                                <div class="mt-4 space-y-4 p-6">
                                                                            <!-- Driving License and Type -->
                                    <div>
                                        <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left p-4">
                                            <p class="text-sm text-gray-500 dark:text-gray-400"  x-text="memberData?.identification?.national_id || 'Not provided'">[ National ID number ]</p>

                                        </div>

                                        <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left p-4">
                                            <p class="text-sm text-gray-500 dark:text-gray-400" x-text="memberData?.identification?.driver_license || 'Not provided'">[Driving License]</p>
                                            <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400" x-text="memberData?.identification?.driving_license_type || 'Not provided'">[DL Type]</p>
                                            <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400" x-text="memberData?.identification?.ntsa_compliance || 'Not provided'">[NTSA Compliance]</p>
                                        </div>
                                    </div>
                                </div>

                                                                        <!-- National ID -->
                                <div class="mt-4 p-6">
                                                                            <!-- National ID front back -->
                                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-2">
                                                                                <div class="border border-gray-200 dark:border-gray-700 rounded p-4">
                                                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">National ID Front</p>
                                                                                    <div class="flex items-center justify-between mt-2">
                                                                                        <span class="text-sm text-gray-700 dark:text-gray-300">Status:</span>
                                                                                        <span class="text-xs px-2 py-1 rounded" :class="memberData?.identification?.national_id_front_path ? 'bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-400' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400'"></span>
                                                                                        <span class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400" -text="memberData?.identification?.national_id_front_path ? 'Uploaded' : 'Pending Upload'">
                                                                                            [Pending Upload]
                                                                                        </span>
                                                                                    </div>
                                                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Format: PNG, JPG, WebP (Max 5MB)</p>
                                                                                </div>
                                                                                <div class="border border-gray-200 dark:border-gray-700 rounded p-4">
                                                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">National ID Back</p>
                                                                                    <div class="flex items-center justify-between mt-2">
                                                                                        <span class="text-sm text-gray-700 dark:text-gray-300">Status:</span>
                                                                                        <span class="text-xs px-2 py-1 rounded" :class="memberData?.identification?.national_id_back_path ? 'bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-400' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400'"></span>
                                                                                        <span class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400" x-text="memberData?.identification?.national_id_back_path ? 'Uploaded' : 'Pending Upload'">
                                                                                            [Pending Upload]
                                                                                        </span>
                                                                                    </div>
                                                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Format: PNG, JPG, WebP (Max 5MB)</p>
                                                                                </div>
                                                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div x-show="activeTab === 'savings'">
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                                            <div>
                                                                    <h3 class="text-lg font-semibold text-gray-600 dark:text-white/90">
                                                                        Savings
                                                                    </h3>
                                                                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                                                        Manage all member savings here.
                                                                    </p>
                                                            </div>

                                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                                <!-- Filter by Frequency -->
                                                                <div class="hidden lg:block">
                                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                        <option value="All">Frequency</option>
                                                                        <option value="Daily">Daily</option>
                                                                        <option value="Weekly">Weekly</option>
                                                                        <option value="Monthly">Monthly</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Filter by Frequency -->
                                                                <div class="hidden lg:block">
                                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                        <option value="All">Status</option>
                                                                        <option value="Daily">Confirmed</option>
                                                                        <option value="Weekly">Under Review</option>
                                                                        <option value="Monthly">Cancelled</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Print Button -->
                                                                <div>
                                                                    <button @click="printMembersReport()"
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

                                                                <div>
                                                                    <button @click="withdrawContribution = true"
                                                                        class="hover:text-dark-900 shadow-theme-xs relative flex inline-flex h-11 items-center justify-center  gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 text-sm font-medium transition-colors hover:bg-gray-100 hover:text-gray-700 hover:bg-gray-600 sm:w-auto">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        </svg>
                                                                        Withdraw
                                                                    </button>
                                                                </div>

                                                                <!-- Create new loan type button -->
                                                                <div>
                                                                    <button @click="savingsModal = true"
                                                                            class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg border border-gray-500 bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        </svg>
                                                                        Add Savings
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <!-- Savings Table -->
                                                        <div>
                                                            <!-- Savings Table -->
                                                            <div x-data="savingsTable()" x-init="init()">
                                                                <div class="custom-scrollbar overflow-x-auto">
                                                                        <table class="w-full">
                                                                            <!-- table header start -->
                                                                            <thead>
                                                                                <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                                                    <th class="p-4 whitespace-nowrap">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Transaction ID
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Amount
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Transaction Date
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Mode
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

                                                                            <!-- Message if no savings data found -->
                                                                            <template x-if="savings.length === 0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td colspan="10" class="px-4 py-12 text-center">
                                                                                            <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                                <!-- Documents Outline SVG Icon -->
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                                                                </svg>
                                                                                                <div class="space-y-2">
                                                                                                    <h2 class="text-xl font-semibold text-gray-700">No savings records found</h2>
                                                                                                    <p class="text-gray-500">Do some transactions to view savings performance</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </template>

                                                                            <!-- If there is data  display the table -->
                                                                            <template x-if="savings.length > 0">
                                                                                <!-- table body start -->
                                                                                <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                                                    <template x-for="saving in paginatedSavings" :key="saving.transactionId">
                                                                                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                                            <!-- LoanTypeID -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <div class="flex items-center gap-3">
                                                                                                        <div>
                                                                                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="saving.transactionCode || 'N/A'"></p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Type -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="'Ksh ' + (saving.transactionAmount ? saving.transactionAmount.toLocaleString() : '0')"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Repayment Type -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="saving.transactionDate ? new Date(saving.transactionDate).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : 'N/A'"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Created On -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="saving.transactionMode || 'N/A'"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Status -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p :class="saving.transactionStatus === 'Confirmed' || saving.transactionStatus === 'Approved' ? 'bg-success-50 text-theme-xs text-success-700 dark:bg-success-500/15 dark:text-success-500' :
                                                                                                            saving.transactionStatus === 'Pending' ? 'bg-warning-50 text-theme-xs text-warning-700 dark:bg-warning-500/15 dark:text-warning-500' :
                                                                                                            'bg-error-50 text-theme-xs text-error-600 dark:bg-error-500/15 dark:text-error-500'"
                                                                                                    class="rounded-full px-2 py-0.5 font-medium"
                                                                                                    x-text="saving.transactionStatus || 'N/A'"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Actions -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <button @click="editSavingModal(saving)" class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                                                        <svg class="w-[28px] h-[28px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
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
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                                                to
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                                                of
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="savings.length">1</span>
                                                                            </span>
                                                                        </div>

                                                                        <div class="flex items-center justify-between">
                                                                            <div class="hidden sm:block">
                                                                                <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                Showing
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                                                to
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                                                of
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="savings.length">1</span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === 1" @click="goToPage(page - 1)" disabled="disabled">
                                                                                <span>
                                                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 8.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                                    </svg>
                                                                                </span>
                                                                                </button>

                                                                                <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                                                Page <span x-text="page">1</span> of <span x-text="totalPages">1</span>
                                                                                </span>

                                                                                <ul class="hidden items-center gap-0.5 sm:flex">
                                                                                <template x-for="n in totalPages" :key="n">
                                                                                    <li>
                                                                                    <a href="#" @click.prevent="goToPage(n)" :class="page === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                                        <span x-text="n"></span>
                                                                                    </a>
                                                                                    </li>
                                                                                </template>
                                                                                </ul>

                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === totalPages" @click="goToPage(page + 1)" disabled="disabled">
                                                                                <span>
                                                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4165 9.9986C17.4168 10.1909 17.3437 10.3832 17.197 10.53L12.2004 15.5301C11.9076 15.8231 11.4327 15.8233 11.1397 15.5305C10.8467 15.2377 10.8465 14.7629 11.1393 14.4699L14.8594 10.7472L3.33203 10.7472C2.91782 10.7472 2.58203 10.4114 2.58203 9.99715C2.58203 9.58294 2.91782 9.24715 3.33203 9.24715L14.854 9.24715L11.1393 5.53016C10.8465 5.23717 10.8467 4.7623 11.1397 4.4695C11.4327 4.1767 11.9075 4.17685 12.2003 4.46984L17.1578 9.43049C17.3163 9.568 17.4165 9.77087 17.4165 9.99715C17.4165 9.99763 17.4165 9.99812 17.4165 9.9986Z" fill=""></path>
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

                    <!-- Next of Kin Table -->
                    <div x-show="activeTab === 'next-of-kin'">
                      <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]" x-data="{ memberData: memberInfo().memberData }">
                                        <!-- Stages table -->
                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                            <div>
                                                    <h3 class="text-lg font-semibold text-gray-600 dark:text-white/90">
                                                        Next of Kin
                                                    </h3>
                                                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                                        Manage all member name next of kin list
                                                    </p>
                                            </div>

                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                    <div class="hidden lg:block">
                                                        <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                            <option value="All">Status</option>
                                                            <option value="Approved">Approved</option>
                                                            <option value="Blacklisted">Blacklisted</option>
                                                            <option value="Under Review">Under Review</option>
                                                        </select>
                                                    </div>

                                                    <div>
                                                        <button @click="printMembersReport()" class="hover:text-dark-900 shadow-theme-xs relative flex h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                            <rect x="7" y="13" width="10" height="8" rx="2"></rect>
                                                        </svg>
                                                        Print
                                                        </button>
                                                    </div>

                                                    <button @click="nextKinModal = true" class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                </svg>
                                                                Add Kin
                                                            </button>

                                            </div>
                                        </div>

                                        <div>
                                            <!-- Table Container -->
                                        <div class="custom-scrollbar overflow-x-auto" x-data="kinTable">
                                                <table class="w-full">
                                                    <!-- table header start -->
                                                    <thead>
                                                        <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                            <th class="p-4 whitespace-nowrap">
                                                                <div class="flex items-center">
                                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">#Kin ID</p>
                                                                </div>
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                <div class="flex items-center">
                                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Kin</p>
                                                                </div>
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                <div class="flex items-center">
                                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Relationship</p>
                                                                </div>
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                <div class="flex items-center">
                                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Phone Number</p>
                                                                </div>
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                <div class="flex items-center">
                                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Email</p>
                                                                </div>
                                                            </th>
                                                            <th class="pp-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                <div class="flex items-center">
                                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                                                                </div>
                                                            </th>
                                                            <th class="pp-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                <div class="flex items-center">
                                                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Actions</p>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <!-- table header end -->

                                                    <!-- table body start -->
                                                    <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                        <!-- Empty state message when no kin -->
                                                        <template x-if="kins.length === 0">
                                                            <tr class="transition">
                                                                <td colspan="7" class="p-8">
                                                                    <div class="flex flex-col items-center justify-center gap-4">
                                                                        <!-- outline documents svg icon -->
                                                                        <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6M9 17h6M7 7h6l2 2h4v8a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                                                                        </svg>

                                                                        <div class="text-center">
                                                                            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">No kin found.</h2>
                                                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">You can add a kins to manage</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </template>

                                                        <!-- Rows when there are kin -->
                                                        <template x-if="kins.length > 0">
                                                            <template x-for="kin in currentItems" :key="kin.kin_id">
                                                                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="flex items-center col-span-2">
                                                                            <div class="flex items-center gap-3">
                                                                                <div>
                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="kin.kin_id || 'N/A'"></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="flex items-center col-span-2">
                                                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="kin.firstname + ' ' + kin.lastname"></p>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="flex items-center col-span-2">
                                                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="kin.relation || 'N/A'"></p>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="flex items-center col-span-2">
                                                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="kin.phone || 'N/A'"></p>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="flex items-center col-span-2">
                                                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="kin.email || 'N/A'"></p>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="flex items-center col-span-2">
                                                                            <p :class="kin.status === 'Approved' ? 'bg-success-50 text-theme-xs text-success-700 dark:bg-success-500/15 dark:text-success-500' : 'bg-error-50 text-theme-xs text-error-600 dark:bg-error-500/15 dark:text-error-500'" class="rounded-full px-2 py-0.5 font-medium" x-text="kin.status || 'N/A'"></p>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="flex items-center col-span-2">
                                                                            <button @click="$dispatch('open-edit-modal', { kin: kin })" class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                                <svg class="w-[28px] h-[28px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
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
                                                            <span class="text-gray-800 dark:text-white/90" x-text="startIndex">0</span>
                                                            to
                                                            <span class="text-gray-800 dark:text-white/90" x-text="endIndex">0</span>
                                                            of
                                                            <span class="text-gray-800 dark:text-white/90" x-text="kins.length">0</span>
                                                        </span>
                                                    </div>

                                                    <div class="flex items-center justify-between">
                                                        <div class="hidden sm:block">
                                                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                Showing
                                                                <span class="text-gray-800 dark:text-white/90" x-text="startIndex">0</span>
                                                                to
                                                                <span class="text-gray-800 dark:text-white/90" x-text="endIndex">0</span>
                                                                of
                                                                <span class="text-gray-800 dark:text-white/90" x-text="kins.length">0</span>
                                                            </span>
                                                        </div>
                                                        <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                            <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="currentPage === 1" @click="prevPage()" disabled="disabled">
                                                                <span>
                                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 9.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                    </svg>
                                                                </span>
                                                            </button>

                                                            <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                                Page <span x-text="currentPage">1</span> of <span x-text="totalPages">0</span>
                                                            </span>

                                                            <ul class="hidden items-center gap-0.5 sm:flex">
                                                                <template x-for="n in totalPages" :key="n">
                                                                    <li>
                                                                        <a href="#" @click.prevent="goToPage(n)" :class="currentPage === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                            <span x-text="n"></span>
                                                                        </a>
                                                                    </li>
                                                                </template>
                                                            </ul>

                                                            <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="currentPage === totalPages" @click="nextPage()">
                                                                <span>
                                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4165 9.9986C17.4168 10.1909 17.3437 10.3832 17.197 10.53L12.2004 15.5301C11.9076 15.8231 11.4327 15.8233 11.1397 15.5305C10.8467 15.2377 10.8465 14.7629 11.1393 14.4699L14.8594 10.7472L3.33203 10.7472C2.91782 10.7472 2.58203 10.4114 2.58203 9.99715C2.58203 9.58294 2.91782 9.24715 3.33203 9.24715L14.854 9.24715L11.1393 5.53016C10.8465 5.23717 10.8467 4.7623 11.1397 4.4695C11.4327 4.1767 11.9075 4.17685 12.2003 4.46984L17.1578 9.43049C17.3163 9.568 17.4165 9.77087 17.4165 9.99715C17.4165 9.99763 17.4165 9.99812 17.4165 9.9986Z" fill=""></path>
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

                    <!-- Vehicles Table (already complete) -->
                    <div x-show="activeTab === 'vehicles'">
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                                            <div>
                                                                    <h3 class="text-lg font-semibold text-gray-600 dark:text-white/90">
                                                                        Vehicle
                                                                    </h3>
                                                                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                                                        Manage Member Vehicles
                                                                    </p>
                                                            </div>

                                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                                <!-- Filter by Frequency -->
                                                                <div class="hidden lg:block">
                                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                        <option value="All">Vehicle Type</option>
                                                                        <option value="Motorcycle">Motorcycle</option>
                                                                        <option value="Tuk Tuk">Tuk Tuk</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Print Button -->
                                                                <div>
                                                                    <button @click="printMembersReport()" class="hover:text-dark-900 shadow-theme-xs relative flex h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
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
                                                                <div x-data="memberInfo">
                                                                        <button
                                                                            x-show="memberData?.member?.membership === 'Member'"
                                                                            @click="vehiclesModal = true" class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            Add Vehicle
                                                                        </button>

                                                                        <button
                                                                            x-show="memberData?.member?.membership === 'Non-Member'"
                                                                            @click="assignMemberVehicle = true" class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            Assign Vehicle
                                                                        </button>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- Vehicles Table -->
                                                        <div x-data="memberInfo">
                                                            <!-- Vehicles Table -->
                                                            <!-- Members Vehicle Table -->
                                                            <div x-show="memberData?.member?.membership === 'Member'">

                                                                <div x-data="vehiclesTable" x-init="init()">
                                                                    <div class="custom-scrollbar overflow-x-auto">
                                                                            <table class="w-full">
                                                                                <!-- table header start -->
                                                                                <thead>
                                                                                    <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                                                        <th class="p-4 whitespace-nowrap">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Vehicle Code
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Type/Plate Number
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Brand/Model
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Make/CC
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Insuarance
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    NTSA Compliant
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Year of Manufacture
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
                                                                                <template x-if="memberVehicles.length === 0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="10" class="px-4 py-12 text-center">
                                                                                                <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                                    <!-- Documents Outline SVG Icon -->
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                                                                    </svg>
                                                                                                    <div class="space-y-2">
                                                                                                        <h2 class="text-xl font-semibold text-gray-700">No Vehicle records found</h2>
                                                                                                        <p class="text-gray-500">Add a new vehicle record to manage.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </template>

                                                                                <!-- If there is data  display the table -->
                                                                                <template x-if="memberVehicles.length > 0">
                                                                                    <!-- table body start -->
                                                                                    <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                                                        <template x-for="vehicle in paginatedMemberVehicles" :key="vehicle.vehicleId">
                                                                                            <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                                                <!-- LoanTypeID -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <div class="flex items-center gap-3">
                                                                                                            <div>
                                                                                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="vehicle.vehicleId || 'N/A'"></p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Type/Plate Number (stacked as requested) -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div>
                                                                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="vehicle.type || 'N/A'"></span>
                                                                                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="vehicle.plate_number || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Brand/Model -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div>
                                                                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="vehicle.brand || 'N/A'"> </span>
                                                                                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="vehicle.model || 'N/A'"> </p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Make/CC -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div>
                                                                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="vehicle.make || 'N/A'"></span>
                                                                                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="vehicle.CC || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Insurance -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="vehicle.insurance || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- NTSA Compliant -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="vehicle.NTSA_compliant || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Created On -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="vehicle.yom || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Status -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <p :class="vehicle.status === 'Approved' || vehicle.status === 'Active' ? 'bg-success-50 text-theme-xs text-success-700 dark:bg-success-500/15 dark:text-success-500' : 'bg-error-50 text-theme-xs text-error-600 dark:bg-error-500/15 dark:text-error-500'" class="rounded-full px-2 py-0.5 font-medium" x-text="vehicle.status || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Actions -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <button @click="$dispatch('open-edit-vehicle-modal', { vehicle: vehicle })"
                                                                                                            class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                                                            <svg class="w-[28px] h-[28px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
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
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="startEntryMember">1</span>
                                                                                    to
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="endEntryMember">1</span>
                                                                                    of
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="memberVehicles.length">1</span>
                                                                                </span>
                                                                            </div>

                                                                            <div class="flex items-center justify-between">
                                                                                <div class="hidden sm:block">
                                                                                    <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                    Showing
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="startEntryMember">1</span>
                                                                                    to
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="endEntryMember">1</span>
                                                                                    of
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="memberVehicles.length">1</span>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                                        :disabled="pageMember === 1"
                                                                                        @click="prevPageMember"
                                                                                        disabled="disabled">
                                                                                        <span>
                                                                                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 8.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </button>

                                                                                    <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                                                    Page <span x-text="page">1</span> of <span x-text="totalPages">1</span>
                                                                                    </span>

                                                                                    <ul class="hidden items-center gap-0.5 sm:flex">
                                                                                        <template x-for="n in totalPagesMember" :key="n">
                                                                                            <li>
                                                                                                <a href="#" @click.prevent="goToPageMember(n)"
                                                                                                :class="pageMember === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'"
                                                                                                class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                                                    <span x-text="n"></span>
                                                                                                </a>
                                                                                            </li>
                                                                                        </template>
                                                                                    </ul>

                                                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                                        :disabled="pageMember === totalPagesMember"
                                                                                        @click="goToPage(page + 1)"
                                                                                        disabled="disabled">
                                                                                        <span>
                                                                                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4165 9.9986C17.4168 10.1909 17.3437 10.3832 17.197 10.53L12.2004 15.5301C11.9076 15.8231 11.4327 15.8233 11.1397 15.5305C10.8467 15.2377 10.8465 14.7629 11.1393 14.4699L14.8594 10.7472L3.33203 10.7472C2.91782 10.7472 2.58203 10.4114 2.58203 9.99715C2.58203 9.58294 2.91782 9.24715 3.33203 9.24715L14.854 9.24715L11.1393 5.53016C10.8465 5.23717 10.8467 4.7623 11.1397 4.4695C11.4327 4.1767 11.9075 4.17685 12.2003 4.46984L17.1578 9.43049C17.3163 9.568 17.4165 9.77087 17.4165 9.99715C17.4165 9.99763 17.4165 9.99812 17.4165 9.9986Z" fill=""></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- Non-Member Vehicles Table -->
                                                            <div x-show="memberData?.member?.membership === 'Non-Member'">

                                                                <div x-data="vehiclesTable" x-init="init()">
                                                                    <div class="custom-scrollbar overflow-x-auto">
                                                                        <table class="w-full">
                                                                            <!-- table header start -->
                                                                            <thead>
                                                                                <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                                                    <th class="p-4 whitespace-nowrap">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Vehicle Code
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
                                                                                                Plate Number
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Brand
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Model
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Make
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Date Assigned
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

                                                                            <!-- Message if no assigned vehicles found -->
                                                                            <template x-if="nonMemberVehicles.length === 0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td colspan="9" class="px-4 py-12 text-center">
                                                                                            <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                                <!-- Documents Outline SVG Icon -->
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                                                                </svg>
                                                                                                <div class="space-y-2">
                                                                                                    <h2 class="text-xl font-semibold text-gray-700">No assigned vehicles found</h2>
                                                                                                    <p class="text-gray-500">This member has no vehicles assigned.</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </template>


                                                                            <!-- If there is data display the table -->
                                                                            <template x-if="nonMemberVehicles.length > 0">
                                                                                <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                                                    <template x-for="vehicle in paginatedNonMemberVehicles" :key="vehicle.assignedId">
                                                                                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                                            <!-- Vehicle Code -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="vehicle.assignedId || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Type -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.type || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Plate Number -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.plate_number || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Brand -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.brand || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Model -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.model || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Make -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.make || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Date Assigned - COMMENTED OUT because data not in response -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.assignedDate || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Status - FIXED: using vehicle.status not vehicle.vehicle_status -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full"
                                                                                                    :class="vehicle.status === 'Approved' ? 'bg-success-50 text-success-700 dark:bg-success-500/15 dark:text-success-500' : 'bg-warning-50 text-warning-700 dark:bg-warning-500/15 dark:text-warning-500'"
                                                                                                    x-text="vehicle.status || 'N/A'">
                                                                                                </span>
                                                                                            </td>

                                                                                            <!-- Actions - Reassign button -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <button @click="$dispatch('open-reassign-vehicle-modal', { vehicle: vehicle })"
                                                                                                    class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                                                    <svg class="w-[22px] h-[22px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 12h4m-2 2v-4M4 18v-4a2 2 0 0 1 2-2h6m0 0-2-2m2 2-2 2"></path>
                                                                                                    </svg>
                                                                                                </button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </template>
                                                                                </tbody>

                                                                            </template>

                                                                        </table>
                                                                    </div>

                                                                    <!-- Table Navigations -->
                                                                    <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                                                                        <div class="flex justify-center pb-4 sm:hidden">
                                                                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                Showing
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntryNonMember">1</span>
                                                                                to
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntryNonMember">1</span>
                                                                                of
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="nonMemberVehicles.length">0</span>
                                                                            </span>
                                                                        </div>

                                                                        <div class="flex items-center justify-between">
                                                                            <div class="hidden sm:block">
                                                                                <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                    Showing
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="startEntryNonMember">1</span>
                                                                                    to
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="endEntryNonMember">1</span>
                                                                                    of
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="nonMemberVehicles.length">0</span>
                                                                                </span>
                                                                            </div>

                                                                            <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                                        :disabled="pageNonMember === 1"
                                                                                        @click="prevPageNonMember">
                                                                                    <span>
                                                                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 9.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </button>

                                                                                <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                                                    Page <span x-text="pageNonMember">1</span> of <span x-text="totalPagesNonMember">1</span>
                                                                                </span>

                                                                                <ul class="hidden items-center gap-0.5 sm:flex">
                                                                                        <template x-for="n in totalPagesNonMember" :key="n">
                                                                                            <li>
                                                                                                <a href="#" @click.prevent="goToPageNonMember(n)"
                                                                                                :class="pageNonMember === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'"
                                                                                                class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                                                    <span x-text="n"></span>
                                                                                                </a>
                                                                                            </li>
                                                                                        </template>
                                                                                    </ul>

                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                                        :disabled="pageNonMember === totalPagesNonMember"
                                                                                        @click="nextPageNonMember">
                                                                                    <span>
                                                                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4165 9.9986C17.4168 10.1909 17.3437 10.3832 17.197 10.53L12.2004 15.5301C11.9076 15.8231 11.4327 15.8233 11.1397 15.5305C10.8467 15.2377 10.8465 14.7629 11.1393 14.4699L14.8594 10.7472L3.33203 10.7472C2.91782 10.7472 2.58203 10.4114 2.58203 9.99715C2.58203 9.58294 2.91782 9.24715 3.33203 9.24715L14.854 9.24715L11.1393 5.53016C10.8465 5.23717 10.8467 4.7623 11.1397 4.4695C11.4327 4.1767 11.9075 4.17685 12.2003 4.46984L17.1578 9.43049C17.3163 9.568 17.4165 9.77087 17.4165 9.99715C17.4165 9.99763 17.4165 9.99812 17.4165 9.9986Z" fill=""></path>
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

                    <!-- Contributions Table -->
                    <div x-show="activeTab === 'contributions'">
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]" x-data="contributionsTable()" x-init="init()">
                                        <!-- Contributions content here -->
                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                                    Contributions
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Review contributions performance
                                                </p>
                                            </div>

                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">

                                                <div class="hidden lg:block">
                                                    <select x-model="frequencyFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="Daily">Daily</option>
                                                        <option value="Weekly">Weekly</option>
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Yearly">Yearly</option>
                                                    </select>
                                                </div>

                                                <div class="hidden lg:block">
                                                    <select x-model="transactionFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="All">All Transactions</option>
                                                        <option value="Paid-In">Paid-In</option>
                                                        <option value="Paid-Out">Paid-Out</option>
                                                    </select>
                                                </div>

                                                <div class="hidden lg:block">
                                                    <select x-model="paymentFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="All">All Payment Types</option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="MPesa">MPesa</option>
                                                        <option value="Bank">Bank</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <button @click="printMembersReport()" class="hover:text-dark-900 shadow-theme-xs relative flex h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                            <rect x="7" y="13" width="10" height="8" rx="2"></rect>
                                                        </svg>
                                                        Print
                                                    </button>
                                                </div>

                                                <div>
                                                    <button @click="withdrawContributionModal = true"
                                                        class="hover:text-dark-900 shadow-theme-xs relative flex inline-flex h-11 items-center justify-center  gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 text-sm font-medium transition-colors hover:bg-gray-100 hover:text-gray-700 hover:bg-gray-600 sm:w-auto">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        Withdraw
                                                    </button>
                                                </div>

                                                <!-- Create New Fine Type button -->
                                                <div>

                                                        <button @click="contributionsModal = true" class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                            Make Contribution
                                                        </button>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Contributions table Table -->
                                        <div>
                                            <div class="custom-scrollbar overflow-x-auto">
                                                <table class="w-full table-auto">
                                                    <thead>
                                                        <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                #Transaction Code
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Amount
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Mode
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Transaction Code
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Transaction Date
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Status
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <!-- Message if no contributions data found -->
                                                    <template x-if="contributions.length === 0">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="10" class="px-4 py-12 text-center">
                                                                    <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                        <!-- Documents Outline SVG Icon -->
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                                        </svg>
                                                                        <div class="space-y-2">
                                                                            <h2 class="text-xl font-semibold text-gray-700">No Contribution records found</h2>
                                                                            <p class="text-gray-500">Do some transactions to view Contribution performance</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </template>

                                                    <!-- If records found display in table -->
                                                    <template x-if="contributions.length > 0">
                                                        <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                            <template x-for="contribution in paginatedContributions" :key="contribution.transactionId">
                                                                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="group flex items-center gap-3">
                                                                            <span class="text-theme-xs font-medium text-gray-700 dark:text-gray-400" x-text="contribution.transactionCode || 'N/A'"></span>
                                                                        </div>
                                                                    </td>
                                                                    <!-- Amount -->
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div>
                                                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="'Ksh ' + (contribution.transactionAmount ? contribution.transactionAmount.toLocaleString() : '0')"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div>
                                                                            <span class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.transactionMode || 'N/A'"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                         <span class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.transactionType || 'N/A'"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.transactionDate ? new Date(contribution.transactionDate).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : 'N/A'"></p>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" :class="{
                                                                                'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': contribution.transactionStatus === 'Confirmed' || contribution.transactionStatus === 'Approved',
                                                                                'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400': contribution.transactionStatus === 'Pending',
                                                                                'bg-error-100 text-error-600 dark:bg-error-900/30 dark:text-error-400': contribution.transactionStatus === 'Cancelled' || contribution.transactionStatus === 'Reversed'
                                                                            }" x-text="contribution.transactionStatus || 'N/A'">
                                                                        </span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <button @click="$dispatch('open-edit-contribution-modal', { contribution: contribution })"
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
                                                        <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                        to
                                                        <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                        of
                                                        <span class="text-gray-800 dark:text-white/90" x-text="contributions.length">1</span>
                                                    </span>
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    <div class="hidden sm:block">
                                                        <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                            Showing
                                                            <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                            to
                                                            <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                            of
                                                            <span class="text-gray-800 dark:text-white/90" x-text="contributions.length">1</span>
                                                        </span>
                                                    </div>
                                                    <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === 1" @click="goToPage(page - 1)" disabled="disabled">
                                                                <span>
                                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 9.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                    </svg>
                                                                </span>
                                                    </button>

                                                    <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                            Page <span x-text="page">1</span> of <span x-text="totalPages">1</span>
                                                        </span>

                                                    <ul class="hidden items-center gap-0.5 sm:flex">
                                                        <template x-for="n in totalPages" :key="n">
                                                            <li>
                                                                <a href="#" @click.prevent="goToPage(n)" :class="page === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                <span x-text="n"></span>
                                                                </a>
                                                            </li>
                                                        </template>
                                                    </ul>

                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === totalPages" @click="goToPage(page + 1)" disabled="disabled">
                                                            <span>
                                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4165 9.9986C17.4168 10.1909 17.3437 10.3832 17.197 10.53L12.2004 15.5301C11.9076 15.8231 11.4327 15.8233 11.1397 15.5305C10.8467 15.2377 10.8465 14.7629 11.1393 14.4699L14.8594 10.7472L3.33203 10.7472C2.91782 10.7472 2.58203 10.4114 2.58203 9.99715C2.58203 9.58294 2.91782 9.24715 3.33203 9.24715L14.854 9.24715L11.1393 5.53016C10.8465 5.23717 10.8467 4.7623 11.1397 4.4695C11.4327 4.1767 11.9075 4.17685 12.2003 4.46984L17.1578 9.43049C17.3163 9.568 17.4165 9.77087 17.4165 9.99715C17.4165 9.99763 17.4165 9.99812 17.4165 9.9986Z" fill=""></path>
                                                                </svg>
                                                            </span>
                                                    </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                    </div>

                    <!-- Loans Table -->
                    <div x-show="activeTab === 'loans'">

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
                                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                        <option value="All">Frequency</option>
                                                                        <option value="Daily">Daily</option>
                                                                        <option value="Weekly">Weekly</option>
                                                                        <option value="Monthly">Monthly</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Print Button -->
                                                                <div>
                                                                    <button @click="printMembersReport()" class="hover:text-dark-900 shadow-theme-xs relative flex h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                                                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                                            <rect x="7" y="13" width="10" height="8" rx="2"></rect>
                                                                        </svg>
                                                                        Print
                                                                    </button>
                                                                </div>

                                                                <div>
                                                                    <button @click="loanTypeModal = true"
                                                                        class="hover:text-dark-900 shadow-theme-xs relative flex inline-flex h-11 items-center justify-center  gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 text-sm font-medium transition-colors hover:bg-gray-100 hover:text-gray-700 hover:bg-gray-600 sm:w-auto">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                                <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            Repay Loan
                                                                    </button>
                                                                </div>

                                                                <!-- Create new loan type button -->
                                                                <div>
                                                                        <button @click="loansModal = true" class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            Assign Loan
                                                                        </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <!-- Loan Types Table -->
                                                        <div>
                                                            <!-- Loan Types Table -->
                                                            <div x-data="loansTable()" x-init="init()">
                                                                <div class="custom-scrollbar overflow-x-auto">
                                                                        <table class="w-full">
                                                                            <!-- table header start -->
                                                                            <thead>
                                                                                <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                                                    <th class="p-4 whitespace-nowrap">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Transaction Code
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Loan/Interest
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Period (Months)
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Amount
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Start Date
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                End Date
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Last Repayment (Amount/Date)
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
                                                                            <template x-if="loans.length === 0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td colspan="10" class="px-4 py-12 text-center">
                                                                                            <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                                <!-- Documents Outline SVG Icon -->
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
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
                                                                            <template x-if="loans.length > 0">
                                                                                <!-- table body start -->
                                                                                <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                                                    <template x-for="loan in paginatedLoans" :key="loans.LoanTypeID">
                                                                                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                                            <!-- LoanTypeID -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <div class="flex items-center gap-3">
                                                                                                        <div>
                                                                                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loans.LoanTypeID"></p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Type -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loans.Type"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Interest Rate -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loans.InterestRate"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Repayment Type -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loans.Repayment"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Total Loaned -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loans.TotalLoaned"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Active Loans -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loans.ActiveLoans"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Created On -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="loans.CreatedOn"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Status -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p :class="loans.Status === 'Active' ? 'bg-success-50 text-theme-xs text-success-700 dark:bg-success-500/15 dark:text-success-500' : 'bg-error-50 text-theme-xs text-error-600 dark:bg-error-500/15 dark:text-error-500'" class="rounded-full px-2 py-0.5 font-medium" x-text="loanType.Status"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Actions -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <button @click="editLoansModal(loans)" class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                                                        <svg class="w-[28px] h-[28px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
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
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                                                to
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                                                of
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="loans.length">1</span>
                                                                            </span>
                                                                        </div>

                                                                        <div class="flex items-center justify-between">
                                                                            <div class="hidden sm:block">
                                                                                <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                Showing
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                                                to
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                                                of
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="loans.length">1</span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === 1" @click="goToPage(page - 1)" disabled="disabled">
                                                                                <span>
                                                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 8.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                                    </svg>
                                                                                </span>
                                                                                </button>

                                                                                <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                                                Page <span x-text="page">1</span> of <span x-text="totalPages">1</span>
                                                                                </span>

                                                                                <ul class="hidden items-center gap-0.5 sm:flex">
                                                                                <template x-for="n in totalPages" :key="n">
                                                                                    <li>
                                                                                        <a href="#" @click.prevent="goToPage(n)" :class="page === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                                            <span x-text="n"></span>
                                                                                        </a>
                                                                                    </li>
                                                                                </template>


                                                                                </ul>

                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === totalPages" @click="goToPage(page + 1)" disabled="disabled">
                                                                                    <span>
                                                                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4165 9.9986C17.4168 10.1909 17.3437 10.3832 17.197 10.53L12.2004 15.5301C11.9076 15.8231 11.4327 15.8233 11.1397 15.5305C10.8467 15.2377 10.8465 14.7629 11.1393 14.4699L14.8594 10.7472L3.33203 10.7472C2.91782 10.7472 2.58203 10.4114 2.58203 9.99715C2.58203 9.58294 2.91782 9.24715 3.33203 9.24715L14.854 9.24715L11.1393 5.53016C10.8465 5.23717 10.8467 4.7623 11.1397 4.4695C11.4327 4.1767 11.9075 4.17685 12.2003 4.46984L17.1578 9.43049C17.3163 9.568 17.4165 9.77087 17.4165 9.99715C17.4165 9.99763 17.4165 9.99812 17.4165 9.9986Z" fill=""></path>
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

                    <!-- Fines Table -->
                    <div x-show="activeTab === 'fines'">
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                        <!-- Contributions content here -->
                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                                    Fines & Penalties
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Review Fines & Penalties performance
                                                </p>
                                            </div>

                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">

                                                <div class="hidden lg:block">
                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="Daily">Frequency</option>
                                                        <option value="Daily">Daily</option>
                                                        <option value="Weekly">Weekly</option>
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Yearly">Yearly</option>
                                                    </select>
                                                </div>

                                                <div class="hidden lg:block">
                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="All">Payment Type</option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="MPesa">MPesa</option>
                                                        <option value="Bank">Bank</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <button @click="printMembersReport()" class="hover:text-dark-900 shadow-theme-xs relative flex h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                        <rect x="7" y="13" width="10" height="8" rx="2"></rect>
                                                    </svg>
                                                    Print
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
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
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
                                                                        <a href="view-member.php" class="text-theme-xs font-medium text-gray-700 group-hover:underline dark:text-gray-400" x-text="fine.FineID"></a>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div>
                                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="fine.Type"></span>
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
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400 truncate max-w-[200px]" x-text="fine.CreatedOn"></p>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" :class="{
                                                                                'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': fine.Status === 'Active',
                                                                                'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400': fine.Status === 'Suspended' || fine.Status === 'In-Active',
                                                                                'bg-error-100 text-error-600 dark:bg-error-900/30 dark:text-error-400': fine.Status === 'Blacklisted' || fine.Status === 'Under Review'
                                                                            }" x-text="fine.Status">
                                                                        </span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <button @click="$store.fineTypeData.editFine(fine)" class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
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
                                                        <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                        to
                                                        <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                        of
                                                        <span class="text-gray-800 dark:text-white/90" x-text="fines.length">1</span>
                                                    </span>
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    <div class="hidden sm:block">
                                                        <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                            Showing
                                                            <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                            to
                                                            <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                            of
                                                            <span class="text-gray-800 dark:text-white/90" x-text="fines.length">1</span>
                                                        </span>
                                                    </div>
                                                    <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === 1" @click="goToPage(page - 1)" disabled="disabled">
                                                                <span>
                                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 9.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                    </svg>
                                                                </span>
                                                    </button>

                                                    <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                            Page <span x-text="page">1</span> of <span x-text="totalPages">1</span>
                                                        </span>

                                                    <ul class="hidden items-center gap-0.5 sm:flex">
                                                        <template x-for="n in totalPages" :key="n">
                                                        <li>
                                                            <a href="#" @click.prevent="goToPage(n)" :class="page === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                            <span x-text="n"></span>
                                                            </a>
                                                        </li>
                                                        </template>
                                                    </ul>

                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === totalPages" @click="goToPage(page + 1)" disabled="disabled">
                                                            <span>
                                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4165 9.9986C17.4168 10.1909 17.3437 10.3832 17.197 10.53L12.2004 15.5301C11.9076 15.8231 11.4327 15.8233 11.1397 15.5305C10.8467 15.2377 10.8465 14.7629 11.1393 14.4699L14.8594 10.7472L3.33203 10.7472C2.91782 10.7472 2.58203 10.4114 2.58203 9.99715C2.58203 9.58294 2.91782 9.24715 3.33203 9.24715L14.854 9.24715L11.1393 5.53016C10.8465 5.23717 10.8467 4.7623 11.1397 4.4695C11.4327 4.1767 11.9075 4.17685 12.2003 4.46984L17.1578 9.43049C17.3163 9.568 17.4165 9.77087 17.4165 9.99715C17.4165 9.99763 17.4165 9.99812 17.4165 9.9986Z" fill=""></path>
                                                                </svg>
                                                            </span>
                                                    </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                    </div>

                    <!-- Settings (Notification toggles & preferences) -->
                    <div x-show="activeTab === 'account'">
                      <h3 class="mb-4 text-xl font-medium text-gray-800 dark:text-white/90">Settings</h3>
                      <div class="grid grid-cols-1 gap-5 sm:grid-cols-1 xl:grid-cols-1">
                        <article class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3">
                          <div class="relative p-5 pb-9">
                            <h3 class="mb-3 text-lg font-semibold text-gray-800 dark:text-white/90">
                              Membership Settings
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                              Manage Bodaboda member account.
                            </p>
                          </div>
                          <div class="flex items-center justify-between border-t border-gray-200 p-5 dark:border-gray-800">
                            <div class="flex gap-3">
                              <div class="order-3 xl:order-2">
                                <h4 class="mb-2 text-center text-medium font-semibold text-gray-600 xl:text-left dark:text-white/90">
                                  Account Status
                                </h4>
                                <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                  <p class="text-sm text-gray-500 dark:text-gray-400">Member #KBSTK202601</p>
                                  <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                  <p class="text-sm text-gray-500 dark:text-gray-400">Role: Rider</p>
                                  <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                  <p class="text-sm text-gray-500 dark:text-gray-400"><span class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 text-xs font-medium">Active</span> since December 09, 2025 15:24</p>
                                </div>
                              </div>
                            </div>
                            <div x-data="{ switcherToggle: false }">
                              <button @click="deleteMemberAccount = true"
                                      class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-while-700 ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-error-700 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                                De-Activate Account
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
        </main>
        <!-- ===== Main Content End ===== -->
    </div>
        <!-- ===== Content Area End ===== -->
  </div>
  <!-- ===== Page Wrapper End ===== -->

    <!-- ===== Modals Start ===== -->
    <!-- personalInformationModal -->
    <div x-show="personalInformationModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="personalInformationModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11" x-data="memberInfo">
            <!-- close btn -->
            <button @click="personalInformationModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
                <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Personal Information</h4>
                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Eidt Bodaboda member personal information</p>
            </div>

            <form class="flex flex-col" method="POST" x-data="memberInfo" @submit.prevent="updatePersonalInfo">
                @csrf

                <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
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
                                                                                        <input type="text"
                                                                                            id="personal_first_name"
                                                                                            name="personal_first_name"
                                                                                            :value="memberData?.member?.firstname || ''"
                                                                                            @input="clearError('first_name')"
                                                                                            @blur="validateField('first_name', $event.target.value)"
                                                                                            :class="errors.first_name ? 'border-red-500' : ''"
                                                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">

                                                                                            <span x-show="errors.first_name" x-text="errors.first_name" class="text-xs text-red-500 mt-1"></span>
                                                                                    </div>

                                                                                    <!-- Last Name -->
                                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            Last Name
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            id="personal_last_name"
                                                                                            name="personal_last_name"
                                                                                            :value="memberData?.member?.lastname || ''"
                                                                                            @input="clearError('last_name')"
                                                                                            @blur="validateField('last_name', $event.target.value)"
                                                                                            :class="errors.last_name ? 'border-red-500' : ''"
                                                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                        <span x-show="errors.last_name" x-text="errors.last_name" class="text-xs text-red-500 mt-1"></span>
                                                                                    </div>

                                                                                    <!-- Email -->
                                                                                    <div class="w-full px-2.5">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            Email
                                                                                        </label>
                                                                                        <input type="email"
                                                                                            id="personal_email"
                                                                                            name="personal_email"
                                                                                            :value="memberData?.member?.email || ''"
                                                                                            @input="clearError('email')"
                                                                                            @blur="validateField('email', $event.target.value)"
                                                                                            :class="errors.email ? 'border-red-500' : ''"
                                                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                        <span x-show="errors.email" x-text="errors.email" class="text-xs text-red-500 mt-1"></span>
                                                                                    </div>

                                                                                    <!-- Primary Phone -->
                                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            Primary Phone
                                                                                        </label>
                                                                                        <div class="relative">
                                                                                            <input type="text"
                                                                                                        id="personal_primary_phone"
                                                                                                        name="personal_primary_phone"
                                                                                                        :value="memberData?.member?.phone1 || ''"
                                                                                                        @input="clearError('primary_phone')"
                                                                                                        @blur="validateField('primary_phone', $event.target.value)"
                                                                                                        :class="errors.primary_phone ? 'border-red-500' : ''"
                                                                                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                        </div>
                                                                                        <span x-show="errors.primary_phone" x-text="errors.primary_phone" class="text-xs text-red-500 mt-1"></span>
                                                                                    </div>

                                                                                    <!-- Secondary Phone -->
                                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            Secondary Phone
                                                                                        </label>
                                                                                        <div class="relative">
                                                                                            <input type="text"
                                                                                                id="personal_secondary_phone"
                                                                                                name="personal_secondary_phone"
                                                                                                :value="memberData?.member?.phone2 || ''"
                                                                                                @input="clearError('secondary_phone')"
                                                                                                @blur="validateField('secondary_phone', $event.target.value)"
                                                                                                :class="errors.secondary_phone ? 'border-red-500' : ''"
                                                                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                        </div>
                                                                                        <span x-show="errors.secondary_phone" x-text="errors.secondary_phone" class="text-xs text-red-500 mt-1"></span>

                                                                                    </div>

                                                                                    <!-- Gender -->
                                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            Gender
                                                                                        </label>
                                                                                        <div class="relative z-20 bg-transparent">
                                                                                            <select id="personal_gender"
                                                                                                    name="personal_gender"
                                                                                                    x-ref="genderSelect"
                                                                                                    @change="clearError('gender')"
                                                                                                    @blur="validateField('gender', $event.target.value)"
                                                                                                    :class="errors.gender ? 'border-red-500' : ''"
                                                                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                                <option value="" :selected="!memberData?.member?.gender">Select Gender</option>
                                                                                                <option value="Male" :selected="memberData?.member?.gender === 'Male'">Male</option>
                                                                                                <option value="Female" :selected="memberData?.member?.gender === 'Female'">Female</option>
                                                                                            </select>
                                                                                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        </div>
                                                                                        <span x-show="errors.gender" x-text="errors.gender" class="text-xs text-red-500 mt-1"></span>
                                                                                    </div>

                                                                                    <!-- DoB -->
                                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            Date of Birth
                                                                                        </label>
                                                                                        <input type="date"
                                                                                            id="personal_dob"
                                                                                            name="personal_dob"
                                                                                            :value="memberData?.member?.dob ? memberData.member.dob.split(' ')[0] : ''"
                                                                                            @input="clearError('dob')"
                                                                                            @blur="validateField('dob', $event.target.value)"
                                                                                            :class="errors.dob ? 'border-red-500' : ''"
                                                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                        <span x-show="errors.dob" x-text="errors.dob" class="text-xs text-red-500 mt-1"></span>
                                                                                    </div>
                                                                                    <!-- Membership -->
                                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            Membership
                                                                                        </label>
                                                                                        <div class="relative z-20 bg-transparent">
                                                                                            <select id="personal_membership"
                                                                                                    name="personal_membership"
                                                                                                    @change="clearError('membership')"
                                                                                                    @blur="validateField('membership', $event.target.value)"
                                                                                                    :class="errors.membership ? 'border-red-500' : ''"
                                                                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                                <option value="" :selected="!memberData?.member?.membership">Select Membership</option>
                                                                                                <option value="Member" :selected="memberData?.member?.membership === 'Member'">Member</option>
                                                                                                <option value="Non-Member" :selected="memberData?.member?.membership === 'Non-Member'">Non-Member</option>
                                                                                            </select>
                                                                                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        </div>
                                                                                        <span x-show="errors.membership" x-text="errors.membership" class="text-xs text-red-500 mt-1"></span>
                                                                                    </div>

                                                                                    <!-- Status -->
                                                                                    <div class="w-full px-2.5 xl:w-1/2">
                                                                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                            Members Status
                                                                                        </label>
                                                                                        <div class="relative z-20 bg-transparent">
                                                                                            <select id="personal_status"
                                                                                                    name="personal_status"
                                                                                                    @change="clearError('status')"
                                                                                                    @blur="validateField('status', $event.target.value)"
                                                                                                    :class="errors.status ? 'border-red-500' : ''"
                                                                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                                <option value="" :selected="!memberData?.member?.status">Select Status</option>
                                                                                                <option value="Active" :selected="memberData?.member?.status === 'Active'">Active</option>
                                                                                                <option value="In-Active" :selected="memberData?.member?.status === 'In-Active'">In-Active</option>
                                                                                                <option value="Suspended" :selected="memberData?.member?.status === 'Suspended'">Suspended</option>
                                                                                                <option value="Blacklisted" :selected="memberData?.member?.status === 'Blacklisted'">Blacklisted</option>
                                                                                            </select>
                                                                                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        </div>
                                                                                        <span x-show="errors.status" x-text="errors.status" class="text-xs text-red-500 mt-1"></span>
                                                                                    </div>
                </div>

                <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">

                    <button @click="personalInformationModal = false" type="button"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                            Cancel
                    </button>

                    <button type="submit" :disabled="isUpdating"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                            <span x-show="!isUpdating">Update</span>
                            <span x-show="isUpdating">Updating...</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- identificationDocumentsModal -->
    <div x-show="identificationDocumentsModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="identificationDocumentsModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11" x-data="memberInfo">
        <!-- close btn -->
        <button @click="identificationDocumentsModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Identification & Documents</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Edit Member identification and documents</p>
        </div>

            <form class="flex flex-col" x-data="memberInfo" method="POST" enctype="multipart/form-data" @submit.prevent="updateIdentificationDocuments">
                @csrf

                <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                    <div class="w-full px-2.5">
                        <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                            Identification
                        </h4>
                    </div>

                    <!-- Details -->
                    <div class="w-full px-2.5">
                        <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                            <!-- National Id number -->
                            <div class="w-full px-2.5">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    National ID Number
                                </label>
                                <input type="text"
                                    id="identification_national_id"
                                    name="national_id"
                                    :value="memberData?.identification?.national_id || ''"
                                    @input="clearError('identification.national_id')"
                                    @blur="validateField('identification.national_id', $event.target.value)"
                                    :class="errors['identification.national_id'] ? 'border-red-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <span x-show="errors['identification.national_id']" x-text="errors['identification.national_id']" class="text-xs text-red-500 mt-1"></span>
                            </div>

                            <!-- National ID Front -->
                            <div class="w-full px-2.5 xl:w-1/2">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    National ID Front
                                </label>
                                <div class="mb-2">
                                    <template x-if="memberData?.identification?.national_id_front_path">
                                        <a :href="'/storage/' + memberData.identification.national_id_front_path"
                                        target="_blank"
                                        class="text-sm text-brand-500 hover:underline">
                                            View Current ID Front
                                        </a>
                                    </template>
                                    <template x-if="!memberData?.identification?.national_id_front_path">
                                        <span class="text-sm text-gray-400">No image uploaded</span>
                                    </template>
                                </div>
                                <div class="relative">
                                    <input type="file"
                                        id="identification_id_front"
                                        name="id_front"
                                        accept="image/png,image/jpeg,image/webp"
                                        @change="validateFile('identification.id_front', $event)"
                                        :class="errors['identification.id_front'] ? 'border-red-500' : ''"
                                        class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG or WebP (Max 5MB)</p>
                                <span x-show="errors['identification.id_front']" x-text="errors['identification.id_front']" class="text-xs text-red-500 mt-1"></span>
                            </div>

                            <!-- National ID Back -->
                            <div class="w-full px-2.5 xl:w-1/2">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    National ID Back
                                </label>
                                <div class="mb-2">
                                    <template x-if="memberData?.identification?.national_id_back_path">
                                        <a :href="'/storage/' + memberData.identification.national_id_back_path"
                                        target="_blank"
                                        class="text-sm text-brand-500 hover:underline">
                                            View Current ID Back
                                        </a>
                                    </template>
                                    <template x-if="!memberData?.identification?.national_id_back_path">
                                        <span class="text-sm text-gray-400">No image uploaded</span>
                                    </template>
                                </div>
                                <div class="relative">
                                    <input type="file"
                                        id="identification_id_back"
                                        name="id_back"
                                        accept="image/png,image/jpeg,image/webp"
                                        @change="validateFile('identification.id_back', $event)"
                                        :class="errors['identification.id_back'] ? 'border-red-500' : ''"
                                        class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG or WebP (Max 5MB)</p>
                                <span x-show="errors['identification.id_back']" x-text="errors['identification.id_back']" class="text-xs text-red-500 mt-1"></span>
                            </div>

                            <!-- Driving License Number -->
                            <div class="w-full px-2.5 xl:w-1/2">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Driving License Number
                                </label>
                                <div class="relative">
                                    <input type="text"
                                        id="identification_driving_license"
                                        name="driving_license"
                                        :value="memberData?.identification?.driver_license || ''"
                                        @input="clearError('identification.driver_license')"
                                        @blur="validateField('identification.driver_license', $event.target.value)"
                                        :class="errors['identification.driver_license'] ? 'border-red-500' : ''"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                </div>
                                <span x-show="errors['identification.driver_license']" x-text="errors['identification.driver_license']" class="text-xs text-red-500 mt-1"></span>
                            </div>

                            <!-- Driving License Type -->
                            <div class="w-full px-2.5 xl:w-1/2">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Driving License Type
                                </label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="identification_license_type"
                                            name="license_type"
                                            @change="clearError('identification.license_type')"
                                            @blur="validateField('identification.license_type', $event.target.value)"
                                            :class="errors['identification.license_type'] ? 'border-red-500' : ''"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                        <option value="" :selected="!memberData?.identification?.driving_license_type">Select License Type</option>
                                        <option value="Category A" :selected="memberData?.identification?.driving_license_type === 'Category A'">Category A: Motorcycles and three-wheelers</option>
                                        <option value="Category B" :selected="memberData?.identification?.driving_license_type === 'Category B'">Category B: Light vehicles</option>
                                        <option value="Category C" :selected="memberData?.identification?.driving_license_type === 'Category C'">Category C: For light trucks</option>
                                        <option value="Category D" :selected="memberData?.identification?.driving_license_type === 'Category D'">Category D: PSV</option>
                                    </select>
                                    <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>
                                <span x-show="errors['identification.license_type']" x-text="errors['identification.license_type']" class="text-xs text-red-500 mt-1"></span>
                            </div>

                            <!-- NTSA Compliant -->
                            <div class="w-full px-2.5 xl:w-1/2">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    NTSA Compliance
                                </label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="identification_ntsa_compliant"
                                            name="ntsa_compliant"
                                            @change="clearError('identification.ntsa_compliant')"
                                            @blur="validateField('identification.ntsa_compliant', $event.target.value)"
                                            :class="errors['identification.ntsa_compliant'] ? 'border-red-500' : ''"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                        <option value="" :selected="!memberData?.identification?.ntsa_compliance">Select NTSA Compliance</option>
                                        <option value="Approved" :selected="memberData?.identification?.ntsa_compliance === 'Approved'">Approved</option>
                                        <option value="Pending" :selected="memberData?.identification?.ntsa_compliance === 'Pending'">Pending</option>
                                        <option value="None" :selected="memberData?.identification?.ntsa_compliance === 'None'">None</option>
                                    </select>
                                    <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>
                                <span x-show="errors['identification.ntsa_compliant']" x-text="errors['identification.ntsa_compliant']" class="text-xs text-red-500 mt-1"></span>
                            </div>

                            <!-- Documents Status -->
                            <div class="w-full px-2.5 xl:w-1/2">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Verification Status
                                </label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="identification_status"
                                            name="status"
                                            @change="clearError('identification.status')"
                                            @blur="validateField('identification.status', $event.target.value)"
                                            :class="errors['identification.status'] ? 'border-red-500' : ''"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                        <option value="" :selected="!memberData?.identification?.status">Select Verification Status</option>
                                        <option value="Approved" :selected="memberData?.identification?.status === 'Approved'">Approved</option>
                                        <option value="Flagged" :selected="memberData?.identification?.status === 'Flagged'">Flagged</option>
                                        <option value="Pending" :selected="memberData?.identification?.status === 'Pending'">Pending</option>
                                    </select>
                                    <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>
                                <span x-show="errors['identification.status']" x-text="errors['identification.status']" class="text-xs text-red-500 mt-1"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                    <button @click="identificationDocumentsModal = false"
                            type="button"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                            :disabled="isUpdating">
                        <span x-show="!isUpdating">Update</span>
                        <span x-show="isUpdating">Updating...</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- nextKinModal -->
    <div x-show="nextKinModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="nextKinModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="nextKinModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Next of Kin</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Add bodaboda member next of kin</p>
        </div>

        <form class="flex flex-col" x-data="kinTable" @submit.prevent="addKin">

            @csrf

            <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
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
                    <input type="text"
                        id="kin_first_name"
                        name="first_name"
                        @input="clearError('first_name')"
                        @blur="validateField('first_name', $event.target.value)"
                        :class="errors.first_name ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.first_name" x-text="errors.first_name" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Last Name -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Last Name
                    </label>
                    <input type="text"
                        id="kin_last_name"
                        name="last_name"
                        @input="clearError('last_name')"
                        @blur="validateField('last_name', $event.target.value)"
                        :class="errors.last_name ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.last_name" x-text="errors.last_name" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Email -->
                <div class="w-full px-2.5">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Email
                    </label>
                    <input type="email"
                        id="kin_email"
                        name="email"
                        @input="clearError('email')"
                        @blur="validateField('email', $event.target.value)"
                        :class="errors.email ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.email" x-text="errors.email" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Phone -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Phone
                    </label>
                    <div class="relative">
                        <input type="text"
                            id="kin_phone"
                            name="phone"
                            @input="clearError('phone')"
                            @blur="validateField('phone', $event.target.value)"
                            :class="errors.phone ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                    <span x-show="errors.phone" x-text="errors.phone" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Relationship -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Relation
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="kin_relation"
                                name="relation"
                                @change="clearError('relation')"
                                @blur="validateField('relation', $event.target.value)"
                                :class="errors.relation ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
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
                    <span x-show="errors.relation" x-text="errors.relation" class="text-xs text-red-500 mt-1"></span>
                </div>

                 <!-- Status -->
                <div class="w-full px-2.5">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="kin_status"
                                name="kin_status"
                                @change="clearError('status')"
                                @blur="validateField('relstatusation', $event.target.value)"
                                :class="errors.status ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Status</option>
                            <option value="Approved">Approved</option>
                            <option value="Pending">Pending</option>
                            <option value="In-Active">In-Active</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.status" x-text="errors.status" class="text-xs text-error-500 mt-1"></span>
                </div>
            </div>

            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                <button @click="nextKinModal = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                    Cancel
                </button>
                <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                        :disabled="$store.kinData.isAdding">
                    <span x-show="!$store.kinData.isAdding">Add Kin</span>
                    <span x-show="$store.kinData.isAdding">Adding Kin...</span>
                </button>
            </div>

        </form>

        </div>
    </div>

    <!-- editNextKinModal -->
    <div x-show="$store.kinData.editNextKinModal" x-data="kinTable" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="$store.kinData.editNextKinModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="$store.kinData.editNextKinModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
                <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Next of Kin</h4>
                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Edit bodaboda member next of kin</p>
            </div>

            <form class="flex flex-col w-full max-w-2xl bg-white dark:bg-gray-900 rounded-xl" @submit.prevent="updateKin">

                @csrf

                <input type="hidden" id="edit_kin_id" name="kin_id">

                <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                    <div class="w-full px-2.5">
                        <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                            Edit Next of Kin
                        </h4>
                    </div>

                    <!-- First Name -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            First Name
                        </label>
                        <input type="text"
                            id="edit_kin_first_name"
                            name="first_name"
                            @input="clearError('first_name')"
                            @blur="validateField('first_name', $event.target.value)"
                            :class="errors.first_name ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <span x-show="errors.first_name" x-text="errors.first_name" class="text-xs text-red-500 mt-1"></span>
                    </div>

                    <!-- Last Name -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Last Name
                        </label>
                        <input type="text"
                            id="edit_kin_last_name"
                            name="last_name"
                            @input="clearError('last_name')"
                            @blur="validateField('last_name', $event.target.value)"
                            :class="errors.last_name ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <span x-show="errors.last_name" x-text="errors.last_name" class="text-xs text-red-500 mt-1"></span>
                    </div>

                    <!-- Email -->
                    <div class="w-full px-2.5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Email
                        </label>
                        <input type="email"
                            id="edit_kin_email"
                            name="email"
                            @input="clearError('email')"
                            @blur="validateField('email', $event.target.value)"
                            :class="errors.email ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <span x-show="errors.email" x-text="errors.email" class="text-xs text-red-500 mt-1"></span>
                    </div>

                    <!-- Phone -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Phone
                        </label>
                        <div class="relative">
                            <input type="text"
                                id="edit_kin_phone"
                                name="phone"
                                @input="clearError('phone')"
                                @blur="validateField('phone', $event.target.value)"
                                :class="errors.phone ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        </div>
                        <span x-show="errors.phone" x-text="errors.phone" class="text-xs text-red-500 mt-1"></span>
                    </div>

                    <!-- Relationship -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Relation
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="edit_kin_relation"
                                    name="relation"
                                    @change="clearError('relation')"
                                    @blur="validateField('relation', $event.target.value)"
                                    :class="errors.relation ? 'border-red-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
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
                        <span x-show="errors.relation" x-text="errors.relation" class="text-xs text-red-500 mt-1"></span>
                    </div>

                    <!-- Status -->
                    <div class="w-full px-2.5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Status
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="edit_kin_status"
                                    name="edit_kin_status"
                                    @change="clearError('status')"
                                    @blur="validateField('status', $event.target.value)"
                                    :class="errors.status ? 'border-red-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Status</option>
                                <option value="Approved">Approved</option>
                                <option value="Pending">Pending</option>
                                <option value="In-Active">In-Active</option>
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <span x-show="errors.status" x-text="errors.status" class="text-xs text-red-500 mt-1"></span>
                    </div>

                </div>

                <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                    <button @click="$store.kinData.editNextKinModal = false"
                            type="button"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Cancel
                    </button>

                    <button type="button"
                            id="deleteMemberKin"
                            @click="deleteKin"
                            class="rounded-lg border border-error-300 bg-white px-5 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]"
                            :disabled="$store.kinData.isDeleting">
                        <span x-show="!$store.kinData.isDeleting">Delete</span>
                        <span x-show="$store.kinData.isDeleting">Deleting...</span>
                    </button>

                    <button type="submit"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                            :disabled="$store.kinData.isUpdating">
                        <span x-show="!$store.kinData.isUpdating">Update</span>
                        <span x-show="$store.kinData.isUpdating">Updating...</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- vehiclesModal -->
    <div x-show="vehiclesModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="vehiclesModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="vehiclesModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Vehicle </h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Add a new vehicle entry </p>
        </div>


        <form class="flex flex-col" method="POST" x-data="vehiclesTable" @submit.prevent="addVehicle">
            @csrf

            <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                <div class="w-full px-2.5">
                    <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                        Vehicle Details
                    </h4>
                </div>

                <!-- Type -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Type
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="vehicle_type"
                                name="type"
                                @change="clearError('vehicle_type')"
                                @blur="validateField('vehicle_type', $event.target.value)"
                                :class="errors.vehicle_type ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Type</option>
                            <option value="Motocycle">Motocycle</option>
                            <option value="Tuk Tuk">Tuk Tuk</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.vehicle_type" x-text="errors.vehicle_type" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Plate Number -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Plate Number
                    </label>
                    <input type="text"
                        id="plate_number"
                        name="plate_number"
                        @input="clearError('plate_number')"
                        @blur="validateField('plate_number', $event.target.value)"
                        :class="errors.plate_number ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.plate_number" x-text="errors.plate_number" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Brand -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Brand
                    </label>
                    <input type="text"
                        id="brand"
                        name="brand"
                        @input="clearError('brand')"
                        @blur="validateField('brand', $event.target.value)"
                        :class="errors.brand ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.brand" x-text="errors.brand" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Model -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Model
                    </label>
                    <input type="text"
                        id="model"
                        name="model"
                        @input="clearError('model')"
                        @blur="validateField('model', $event.target.value)"
                        :class="errors.model ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.model" x-text="errors.model" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Make -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Make
                    </label>
                    <div class="relative">
                        <input type="text"
                            id="make"
                            name="make"
                            @input="clearError('make')"
                            @blur="validateField('make', $event.target.value)"
                            :class="errors.make ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                    <span x-show="errors.make" x-text="errors.make" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- CC -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        CC
                    </label>
                    <div class="relative">
                        <input type="text"
                            id="cc"
                            name="cc"
                            @input="clearError('cc')"
                            @blur="validateField('cc', $event.target.value)"
                            :class="errors.cc ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                    <span x-show="errors.cc" x-text="errors.cc" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Insurance -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Insurance
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="insurance"
                                name="insurance"
                                @change="clearError('insurance')"
                                @blur="validateField('insurance', $event.target.value)"
                                :class="errors.insurance ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Insurance Type</option>
                            <option value="Comprehesive">Comprehensive</option>
                            <option value="Third-Party">Third-Party</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.insurance" x-text="errors.insurance" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Year of Manufacture -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Year of Manufacture
                    </label>
                    <input type="number"
                        id="yom"
                        name="yom"
                        min="1900"
                        max="2099"
                        step="1"
                        @input="clearError('yom')"
                        @blur="validateField('yom', $event.target.value)"
                        :class="errors.yom ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.yom" x-text="errors.yom" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- NTSA Compliant -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        NTSA Compliant
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="ntsa_compliant"
                                name="ntsa_compliant"
                                @change="clearError('ntsa_compliant')"
                                @blur="validateField('ntsa_compliant', $event.target.value)"
                                :class="errors.ntsa_compliant ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">NTSA Compliant</option>
                            <option value="Approved">Approved</option>
                            <option value="Suspended">Suspended</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.ntsa_compliant" x-text="errors.ntsa_compliant" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Status -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="vehicle_status"
                                name="status"
                                @change="clearError('vehicle_status')"
                                @blur="validateField('vehicle_status', $event.target.value)"
                                :class="errors.vehicle_status ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Status</option>
                            <option value="Approved">Approved</option>
                            <option value="Suspended">Suspended</option>
                            <option value="Under Review">Under Review</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.vehicle_status" x-text="errors.vehicle_status" class="text-xs text-red-500 mt-1"></span>
                </div>
            </div>

            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                <button @click="addVehicleModal = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                    Cancel
                </button>
                <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                        :disabled="$store.vehicleData.isAdding">
                    <span x-show="!$store.vehicleData.isAdding">Add Vehicle</span>
                    <span x-show="$store.vehicleData.isAdding">Adding Vehicle...</span>
                </button>
            </div>
        </form>

        </div>
    </div>

    <!-- editMemberVehiclesModal -->
    <div x-show="$store.vehicleData.editMemberVehiclesModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" x-data="vehiclesTable">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="$store.vehicleData.editMemberVehiclesModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="$store.vehicleData.editMemberVehiclesModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Vehicle </h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Add a new vehicle entry </p>
        </div>


        <form class="flex flex-col" method="POST" @submit.prevent="updateVehicle">
            @csrf
            <input type="hidden" id="edit_vehicle_id" name="vehicle_id">

            <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                <div class="w-full px-2.5">
                    <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                        Edit Vehicle Details
                    </h4>
                </div>

                <!-- Type -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Type
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="edit_vehicle_type"
                                name="type"
                                @change="clearError('type')"
                                @blur="validateField('type', $event.target.value)"
                                :class="errors.vehicle_type ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Type</option>
                            <option value="Motorcycle">Motorcycle</option>
                            <option value="Tuk Tuk">Tuk Tuk</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.type" x-text="errors.type" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Plate Number -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Plate Number
                    </label>
                    <input type="text"
                           id="edit_plate_number"
                           name="plate_number"
                           @input="clearError('plate_number')"
                           @blur="validateField('plate_number', $event.target.value)"
                           :class="errors.plate_number ? 'border-red-500' : ''"
                           class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.plate_number" x-text="errors.plate_number" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Brand -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Brand
                    </label>
                    <input type="text"
                           id="edit_brand"
                           name="brand"
                           @input="clearError('brand')"
                           @blur="validateField('brand', $event.target.value)"
                           :class="errors.brand ? 'border-red-500' : ''"
                           class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.brand" x-text="errors.brand" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Model -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Model
                    </label>
                    <input type="text"
                           id="edit_model"
                           name="model"
                           @input="clearError('model')"
                           @blur="validateField('model', $event.target.value)"
                           :class="errors.model ? 'border-red-500' : ''"
                           class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.model" x-text="errors.model" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Make -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Make
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="edit_make"
                               name="make"
                               @input="clearError('make')"
                               @blur="validateField('make', $event.target.value)"
                               :class="errors.make ? 'border-red-500' : ''"
                               class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                    <span x-show="errors.make" x-text="errors.make" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- CC -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        CC
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="edit_cc"
                               name="cc"
                               @input="clearError('cc')"
                               @blur="validateField('cc', $event.target.value)"
                               :class="errors.cc ? 'border-red-500' : ''"
                               class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                    <span x-show="errors.cc" x-text="errors.cc" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Insurance -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Insurance
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="edit_insurance"
                                name="insurance"
                                @change="clearError('insurance')"
                                @blur="validateField('insurance', $event.target.value)"
                                :class="errors.insurance ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Insurance Type</option>
                            <option value="Comprehesive">Comprehensive</option>
                            <option value="Third-Party">Third-Party</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.insurance" x-text="errors.insurance" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Year of Manufacture -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Year of Manufacture
                    </label>
                    <input type="number"
                           id="edit_yom"
                           name="yom"
                           min="1900"
                           max="2099"
                           step="1"
                           @input="clearError('yom')"
                           @blur="validateField('yom', $event.target.value)"
                           :class="errors.yom ? 'border-red-500' : ''"
                           class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.yom" x-text="errors.yom" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- NTSA Compliant -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        NTSA Compliant
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="edit_ntsa_compliant"
                                name="ntsa_compliant"
                                @change="clearError('ntsa_compliant')"
                                @blur="validateField('ntsa_compliant', $event.target.value)"
                                :class="errors.ntsa_compliant ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">NTSA Compliant</option>
                            <option value="Approved">Approved</option>
                            <option value="Suspended">Suspended</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.ntsa_compliant" x-text="errors.ntsa_compliant" class="text-xs text-red-500 mt-1"></span>
                </div>

                <!-- Status -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="edit_vehicle_status"
                                name="status"
                                @change="clearError('vehicle_status')"
                                @blur="validateField('vehicle_status', $event.target.value)"
                                :class="errors.vehicle_status ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Status</option>
                            <option value="Approved">Approved</option>
                            <option value="Suspended">Suspended</option>
                            <option value="Under Review">Under Review</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.vehicle_status" x-text="errors.vehicle_status" class="text-xs text-red-500 mt-1"></span>
                </div>
            </div>

            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                <button @click="$store.vehicleData.editMemberVehiclesModal = false"
                        type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                    Cancel
                </button>

                <button type="button"
                        @click="deleteVehicle"
                        class="rounded-lg border border-error-300 bg-white px-5 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]"
                        :disabled="$store.vehicleData.isDeleting">
                    <span x-show="!$store.vehicleData.isDeleting">Delete</span>
                    <span x-show="$store.vehicleData.isDeleting">Deleting...</span>
                </button>

                <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                        :disabled="$store.vehicleData.isUpdating">
                    <span x-show="!$store.vehicleData.isUpdating">Update</span>
                    <span x-show="$store.vehicleData.isUpdating">Updating...</span>
                </button>
            </div>
        </form>

        </div>
    </div>

    <!-- assignMemberVehicle -->
    <div x-show="assignMemberVehicle" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" x-data="vehiclesTable">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="assignMemberVehicle = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="assignMemberVehicle = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Assign Vehicle</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Assign an Available vehicle to the Non-Member.</p>
        </div>

            <form class="flex flex-col" @submit.prevent="assignVehicle">

                @csrf

                <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                    <div class="w-full px-2.5">
                        <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                            Assign Vehcicle
                        </h4>
                    </div>

                    <!-- Vehicle Type -->
                    <div class="w-full px-2.5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Vehicle Type
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="assign_vehicle_type"
                                    name="vehicle_type"
                                    @change="loadAvailableVehicles($event.target.value); clearError('assign_vehicle_type')"
                                    @blur="validateField('assign_vehicle_type', $event.target.value)"
                                  :class="errors.assign_vehicle_type ? 'border-error-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Vehicle Type</option>
                                <option value="Motorcycle">Motorcycle</option>
                                <option value="Tuk Tuk">Tuk Tuk</option>
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <span x-show="errors.assign_vehicle_type" x-text="errors.assign_vehicle_type" class="text-xs text-error-500 mt-1"></span>
                    </div>

                    <!-- Vehicle -->
                    <div class="w-full px-2.5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Select Vehicle
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="assign_vehicle_select"
                                    name="vehicle"
                                    @change="clearError('assign_vehicle')"
                                    @blur="validateField('assign_vehicle', $event.target.value)"
                                    :class="errors.assign_vehicle ? 'border-error-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Find Vehicle</option>
                                <template x-for="vehicle in $store.vehicleData.availableVehicles" :key="vehicle.vehicleId">
                                    <option
                                        :value="vehicle.vehicleId + '|' + vehicle.type + '|' + vehicle.brand + ' ' + vehicle.model + '|' + vehicle.plate_number"
                                        x-text="vehicle.type + ': ' + vehicle.brand + ' ' + vehicle.model + ' - ' + vehicle.plate_number"
                                        >
                                    </option>
                                </template>
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <span x-show="errors.assign_vehicle_select" x-text="errors.assign_vehicle_select" class="text-xs text-error-500 mt-1"></span>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Type to search by Plate number ...</p>
                    </div>

                    <!-- Status -->
                    <div class="w-full px-2.5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Status
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="assign_status"
                                    name="status"
                                    @change="clearError('assign_status')"
                                    @blur="validateField('assign_status', $event.target.value)"
                                    :class="errors.Status ? 'border-error-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Status</option>
                                <option value="Approved">Approved</option>
                                <option value="Pending">Pending</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <span x-show="errors.assign_status" x-text="errors.assign_status" class="text-xs text-error-500 mt-1"></span>
                    </div>
                </div>

                <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                    <button @click="assignMemberVehicle = false" type="button"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                            :disabled="$store.vehicleData.isAssigning">
                        <span x-show="!$store.vehicleData.isAssigning">Assign Vehicle</span>
                        <span x-show="$store.vehicleData.isAssigning">Assigning ...</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- reAssignMemberVehicleModal -->
    <div x-show="$store.vehicleData.reAssignMemberVehicleModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" x-data="vehiclesTable">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="$store.vehicleData.reAssignMemberVehicleModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="$store.vehicleData.reAssignMemberVehicleModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Re-Assign Vehicle</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">This will make the vehicle available for other members.</p>
        </div>

            <form class="flex flex-col" @submit.prevent="reassignVehicle">

                @csrf

                <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                    <!-- Hidden Vehicle ID -->
                    <input type="hidden"
                        id="reassign_vehicle_id"
                        name="vehicle_id"
                        :value="$store.vehicleData.currentVehicle?.vehicleId || ''"
                        readonly>

                    <!-- Vehicle Type - Plate Number (Availability) -->
                    <div class="w-full px-2.5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Vehicle Type
                        </label>
                        <input type="text"
                            id="vehicle_type"
                            name="vehicle_type"
                            readonly
                            :value="$store.vehicleData.currentVehicle ?
                                    `${$store.vehicleData.currentVehicle.type || 'N/A'} - ${$store.vehicleData.currentVehicle.plate_number || 'N/A'}` :
                                    ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>

                    <!-- Brand: Make Model YoM - CC -->
                    <div class="w-full px-2.5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Brand: Make Model YoM - CC
                        </label>
                        <input type="text"
                            id="brand"
                            name="brand"
                            readonly
                            :value="$store.vehicleData.currentVehicle ?
                                    `${$store.vehicleData.currentVehicle.brand || 'N/A'}: ${$store.vehicleData.currentVehicle.make || 'N/A'} ${$store.vehicleData.currentVehicle.model || 'N/A'} ${$store.vehicleData.currentVehicle.yom || 'N/A'} - ${$store.vehicleData.currentVehicle.CC || 'N/A'}` :
                                    ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>

                    <!-- Date Assigned -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Date Assigned
                        </label>
                        <input type="text"
                            id="assignedDate"
                            name="assignedDate"
                            readonly
                            :value="$store.vehicleData.currentVehicle?.assignedDate ?
                                    new Date($store.vehicleData.currentVehicle.assignedDate).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) :
                                    'N/A'"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>

                    <!-- Status -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Status
                        </label>
                        <input type="text"
                            id="status"
                            name="status"
                            readonly
                            :value="$store.vehicleData.currentVehicle?.status || 'N/A'"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                </div>

                <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                    <button @click="$store.vehicleData.reAssignMemberVehicleModal = false" type="button"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                            :disabled="$store.vehicleData.isReassigning">
                        <span x-show="!$store.vehicleData.isReassigning">Re-Assign Vehicle</span>
                        <span x-show="$store.vehicleData.isReassigning">Re-Assigning ...</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- contributionsModal -->
    <div x-show="contributionsModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="contributionsModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="contributionsModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Make Contribution</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Enter the amount you wish to contribute.</p>
        </div>

        <form class="flex flex-col" x-data="contributionsTable" @submit.prevent="contribute">
            @csrf

            <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                <!-- Amount -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Amount
                    </label>
                    <input type="number" step="0.01" min="0.01"
                        id="contribute_amount"
                        name="amount"
                        @input="clearError('amount')"
                        @blur="validateField('amount', $event.target.value)"
                        :class="errors.amount ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.amount" x-text="errors.amount" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Payment Mode -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Payment Mode
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="contribute_payment_mode"
                                name="payment_mode"
                                @change="handlePaymentModeChange($event.target.value, 'contribute'); clearError('payment_mode')"
                                @blur="validateField('payment_mode', $event.target.value)"
                                :class="errors.payment_mode ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Payment Mode</option>
                            <option value="Cash">Cash</option>
                            <option value="MPesa">MPesa</option>
                            <option value="Bank">Bank</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.payment_mode" x-text="errors.payment_mode" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Transaction Code -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Transaction Code
                    </label>
                    <input type="text"
                        id="contribute_transaction_code"
                        name="transaction_code"
                        readonly
                        @input="clearError('transaction_code')"
                        @blur="validateField('transaction_code', $event.target.value)"
                        :class="errors.transaction_code ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.transaction_code" x-text="errors.transaction_code" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Status -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="contribute_status"
                                name="status"
                                @change="clearError('status')"
                                @blur="validateField('status', $event.target.value)"
                                :class="errors.status ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Status</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Pending">Pending</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.status" x-text="errors.status" class="text-xs text-error-500 mt-1"></span>
                </div>
            </div>

            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                <button @click="contributionsModal = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                    Cancel
                </button>
                <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                        :disabled="$store.contributionData.isContributing">
                    <span x-show="!$store.contributionData.isContributing">Contribute</span>
                    <span x-show="$store.contributionData.isContributing">Contributing ...</span>
                </button>
            </div>
        </form>

        </div>
    </div>

    <!-- withdrawContributionModal -->
    <div x-show="withdrawContributionModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="withdrawContributionModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="withdrawContributionModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Withraw Contribution</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Enter the amount you wish to withdraw.</p>
        </div>

            <form class="flex flex-col" x-data="contributionsTable" @submit.prevent="withdraw">
            @csrf

            <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                <!-- Amount -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Amount
                    </label>
                    <input type="number" step="0.01" min="0.01"
                        id="withdraw_amount"
                        name="amount"
                        @input="clearError('amount')"
                        @blur="validateField('amount', $event.target.value)"
                        :class="errors.amount ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.amount" x-text="errors.amount" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Payment Mode -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Payment Mode
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="withdraw_payment_mode"
                                name="payment_mode"
                                @change="handlePaymentModeChange($event.target.value, 'withdraw'); clearError('payment_mode')"
                                @blur="validateField('payment_mode', $event.target.value)"
                                :class="errors.payment_mode ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Payment Mode</option>
                            <option value="Cash">Cash</option>
                            <option value="MPesa">MPesa</option>
                            <option value="Bank">Bank</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.payment_mode" x-text="errors.payment_mode" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Transaction Code -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Transaction Code
                    </label>
                    <input type="text"
                        id="withdraw_transaction_code"
                        name="transaction_code"
                        readonly
                        @input="clearError('transaction_code')"
                        @blur="validateField('transaction_code', $event.target.value)"
                        :class="errors.transaction_code ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.transaction_code" x-text="errors.transaction_code" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Status -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="withdraw_status"
                                name="status"
                                @change="clearError('status')"
                                @blur="validateField('status', $event.target.value)"
                                :class="errors.status ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Status</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Pending">Pending</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.status" x-text="errors.status" class="text-xs text-error-500 mt-1"></span>
                </div>
            </div>

            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                <button @click="withdrawContributionModal = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                    Cancel
                </button>
                <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                        :disabled="$store.contributionData.isWithdrawing">
                    <span x-show="!$store.contributionData.isWithdrawing">Withdraw</span>
                    <span x-show="$store.contributionData.isWithdrawing">Withdrawing ...</span>
                </button>
            </div>
        </form>

        </div>
    </div>

    <!-- editContributionModal -->
    <div x-show="$store.contributionData.editContributionModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="$store.contributionData.editContributionModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="$store.contributionData.editContributionModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Update Contribution</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Enter the details you wish to update.</p>
        </div>

        <form class="flex flex-col" x-data="contributionsTable" @submit.prevent="updateContribution">
            @csrf

            <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                <!-- Hidden Transaction ID -->
                <input type="hidden" id="edit_transaction_id" name="transaction_id" :value="$store.contributionData.currentContribution?.transactionId">

                <!-- Amount -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Amount
                    </label>
                    <input type="number" step="0.01" min="0.01"
                        id="edit_contribution_Amount"
                        name="amount"
                        :value="$store.contributionData.currentContribution?.transactionAmount"
                        @input="clearError('amount')"
                        @blur="validateField('amount', $event.target.value)"
                        :class="errors.amount ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.amount" x-text="errors.amount" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Payment Mode -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Payment Mode
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="edit_payment_mode"
                                name="payment_mode"
                                @change="handlePaymentModeChange($event.target.value, 'edit'); clearError('payment_mode')"
                                @blur="validateField('payment_mode', $event.target.value)"
                                :class="errors.payment_mode ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Payment Mode</option>
                            <option value="Cash" :selected="$store.contributionData.currentContribution?.transactionMode === 'Cash'">Cash</option>
                            <option value="MPesa" :selected="$store.contributionData.currentContribution?.transactionMode === 'MPesa'">MPesa</option>
                            <option value="Bank" :selected="$store.contributionData.currentContribution?.transactionMode === 'Bank'">Bank</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.payment_mode" x-text="errors.payment_mode" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Transaction Code -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Transaction Code
                    </label>
                    <input type="text"
                        id="edit_transaction_code"
                        name="transaction_code"
                        :value="$store.contributionData.currentContribution?.transactionCode"
                        :readonly="$store.contributionData.currentContribution?.transactionMode === 'Cash'"
                        @input="clearError('transaction_code')"
                        @blur="validateField('transaction_code', $event.target.value)"
                        :class="errors.transaction_code ? 'border-red-500' : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    <span x-show="errors.transaction_code" x-text="errors.transaction_code" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Status -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="edit_status"
                                name="status"
                                @change="clearError('status')"
                                @blur="validateField('status', $event.target.value)"
                                :class="errors.status ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Status</option>
                            <option value="Confirmed" :selected="$store.contributionData.currentContribution?.transactionStatus === 'Confirmed'">Confirmed</option>
                            <option value="Pending" :selected="$store.contributionData.currentContribution?.transactionStatus === 'Pending'">Pending</option>
                            <option value="Cancelled" :selected="$store.contributionData.currentContribution?.transactionStatus === 'Cancelled'">Cancelled</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.status" x-text="errors.status" class="text-xs text-error-500 mt-1"></span>
                </div>
            </div>

            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                <button @click="$store.contributionData.editContributionModal = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                    Cancel
                </button>
                <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                        :disabled="$store.contributionData.isUpdating">
                    <span x-show="!$store.contributionData.isUpdating">Update</span>
                    <span x-show="$store.contributionData.isUpdating">Updating ...</span>
                </button>
            </div>
        </form>

        </div>
    </div>

    <!-- savingsModal -->
    <div x-show="savingsModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="savingsModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="savingsModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Savings</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Enter the amount you wish to withdraw.</p>
        </div>

        <form class="flex flex-col" x-data="kinTable" @submit.prevent="addKin">

                @csrf

                <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">

                    <!-- First Name -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Amount
                        </label>
                        <input type="number"
                            id="savings_Amount"
                            name="savings_Amount"
                            @input="clearError('savings_Amount')"
                            @blur="validateField('savings_Amount', $event.target.value)"
                            :class="errors.savings_Amount ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <span x-show="errors.savings_Amount" x-text="errors.savings_Amount" class="text-xs text-error-500 mt-1"></span>
                    </div>

                    <!-- Last Name -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Payment Mode
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="payment_mode"
                                    name="payment_mode"
                                    @change="clearError('payment_mode')"
                                    @blur="validateField('payment_mode', $event.target.value)"
                                    :class="errors.payment_mode ? 'border-red-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Payment Mode</option>
                                <option value="Cash">Cash</option>
                                <option value="MPesa">MPesa</option>
                                <option value="Bank">Bank</option>
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <span x-show="errors.payment_mode" x-text="errors.payment_mode" class="text-xs text-error-500 mt-1"></span>
                    </div>

                    <!-- Email -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Transaction Code
                        </label>
                        <input type="text"
                            id="transaction_code"
                            name="transaction_code"
                            @input="clearError('transaction_code')"
                            @blur="validateField('transaction_code', $event.target.value)"
                            :class="errors.transaction_code ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <span x-show="errors.transaction_code" x-text="errors.transaction_code" class="text-xs text-error-500 mt-1"></span>
                    </div>

                    <!-- Status -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Status
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="Status"
                                    name="Status"
                                    @change="clearError('Status')"
                                    @blur="validateField('Status', $event.target.value)"
                                    :class="errors.Status ? 'border-red-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Status</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Pending">Pending</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <span x-show="errors.Status" x-text="errors.Status" class="text-xs text-error-500 mt-1"></span>
                    </div>
                </div>

                <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                    <button @click="savingsModal = false" type="button"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                            :disabled="$store.kinData.isAdding">
                        <span x-show="!$store.kinData.isAdding">Save</span>
                        <span x-show="$store.kinData.isAdding">Transacting ...</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- loansModal -->
    <div x-show="loansModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="loansModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="loansModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Assign Loan</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Enter the amount you wish to withdraw.</p>
        </div>

        <form class="flex flex-col" method="POST">

            @csrf

            <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">

                <input type="hidden" id="" name=""/>

                    <div class="w-full px-2.5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                        Loan Type
                                                                                    </label>
                                                                                    <div class="relative z-20 bg-transparent">
                                                                                        <select id="personal_gender" name="personal_gender" x-model="formData.personal.gender" @change="clearError('personal.gender')" @blur="validateField('personal.gender')" :class="errors.personal?.gender ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                            <option value="">Loan Type</option>
                                                                                            <option value="Motocycle">Motocycle</option>
                                                                                            <option value="Tuk Tuk">Tuk Tuk</option>
                                                                                        </select>
                                                                                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </div>
                    </div>

                                                                                <!-- Plate Number -->
                                                                                <div class="w-full px-2.5 xl:w-1/2">
                                                                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                        Interest Rate
                                                                                    </label>
                                                                                    <input readonly type="text" id="personal_first_name" name="personal_first_name" x-model="formData.personal.firstName" @input="clearError('personal.firstName')" @blur="validateField('personal.firstName')" :class="errors.personal?.firstName ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                </div>

                                                                                <!-- Brand -->
                                                                                <div class="w-full px-2.5 xl:w-1/2">
                                                                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                        Max Borrowable
                                                                                    </label>
                                                                                    <input readonly type="text" id="personal_last_name" name="personal_last_name" x-model="formData.personal.lastName" @input="clearError('personal.lastName')" @blur="validateField('personal.lastName')" :class="errors.personal?.lastName ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                </div>

                                                                                <!-- Model -->
                                                                                <div class="w-full px-2.5 xl:w-1/2">
                                                                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                        Period (Months)
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

                                                                                <!-- Make -->
                                                                                <div class="w-full px-2.5 xl:w-1/2">
                                                                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                        Payment Mode
                                                                                    </label>
                                                                                    <div class="relative z-20 bg-transparent">
                                                                                        <select id="payment_mode"
                                                                                                name="payment_mode"
                                                                                                @change="clearError('payment_mode')"
                                                                                                @blur="validateField('payment_mode', $event.target.value)"
                                                                                                :class="errors.payment_mode ? 'border-red-500' : ''"
                                                                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                            <option value="">Payment Mode</option>
                                                                                            <option value="Cash">Cash</option>
                                                                                            <option value="MPesa">MPesa</option>
                                                                                            <option value="Bank">Bank</option>
                                                                                        </select>
                                                                                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- SCC -->
                                                                                <div class="w-full px-2.5 xl:w-1/2">
                                                                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                        Amount
                                                                                    </label>
                                                                                <div class="relative">
                                                                                    <input type="number" id="personal_secondary_phone" name="personal_secondary_phone" x-model="formData.personal.secondaryPhone" @input="clearError('personal.secondaryPhone')" @blur="validateField('personal.secondaryPhone')" :class="errors.personal?.secondaryPhone ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Insuarance -->
                                                                            <div class="w-full px-2.5 xl:w-1/2">
                                                                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                        Transaction Code
                                                                                    </label>
                                                                                    <div class="relative">
                                                                                            <input type="text" readonly id="personal_secondary_phone" name="personal_secondary_phone" x-model="formData.personal.secondaryPhone" @input="clearError('personal.secondaryPhone')" @blur="validateField('personal.secondaryPhone')" :class="errors.personal?.secondaryPhone ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                        </div>
                                                                                </div>

                                                                                <!-- DoB -->
                                                                                <div class="w-full px-2.5 xl:w-1/2">
                                                                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                        Start Date
                                                                                    </label>
                                                                                    <input type="text" id="personal_dob" readonly name="personal_dob" x-model="formData.personal.dob" @input="clearError('personal.dob')" @blur="validateField('personal.dob')" :class="errors.personal?.dob ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                </div>
                <!-- Membership -->
                                                                                <div class="w-full px-2.5 xl:w-1/2">
                                                                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                        End Date
                                                                                    </label>
                                                                                    <div class="relative">
                                                                                        <input type="text" id="personal_dob" readonly name="personal_dob" x-model="formData.personal.dob" @input="clearError('personal.dob')" @blur="validateField('personal.dob')" :class="errors.personal?.dob ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Status -->
                                                                                <div class="w-full px-2.5">
                                                                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                                                        Status
                                                                                    </label>
                                                                                    <div class="relative z-20 bg-transparent">
                                                                                        <select id="personal_gender" name="personal_gender" x-model="formData.personal.gender" @change="clearError('personal.gender')" @blur="validateField('personal.gender')" :class="errors.personal?.gender ? 'border-red-500' : ''" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                                            <option value="">Loan Status</option>
                                                                                            <option value="Approved">Approved</option>
                                                                                            <option value="Cancelled">Cancelled</option>
                                                                                            <option value="Suspended">Suspended</option>
                                                                                            <option value="Under Review">Under Review</option>
                                                                                        </select>
                                                                                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                                                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
            </div>

            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                <button @click="loansModal = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                    Cancel</button>
                <button type="button" class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">Assign Loan</button>
            </div>

        </form>

        </div>
    </div>

    <!-- finesPenaltiesModal -->
    <div x-show="finesPenaltiesModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="finesPenaltiesModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="finesPenaltiesModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Withdraw from Wallet</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Enter the amount you wish to withdraw.</p>
        </div>
        <form class="flex flex-col">
            <div class="custom-scrollbar h-[450px] overflow-y-auto px-2">
            <div class="mt-7">
                <h5 class="mb-5 text-lg font-medium text-gray-800 dark:text-white/90 lg:mb-6">Withdraw</h5>

                <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                <div class="col-span-2 lg:col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Amount</label>
                    <input type="text" placeholder="Enter Amount ..."
                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                </div>

                <div class="col-span-2 lg:col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Confirm Password</label>
                    <input type="password" placeholder="Confirm Password"
                        class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                </div>
                </div>
            </div>
            </div>
            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
            <button @click="finesPenaltiesModal = false" type="button"
                    class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                Cancel</button>
            <button type="button" class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">Withdraw</button>
            </div>
        </form>
        </div>
    </div>

    <!-- deleteMemberAccount -->
    <div x-show="deleteMemberAccount" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="deleteMemberAccount = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="deleteMemberAccount = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Withdraw from Wallet</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Enter the amount you wish to withdraw.</p>
        </div>
        <form class="flex flex-col">
            <div class="custom-scrollbar h-[450px] overflow-y-auto px-2">
            <div class="mt-7">
                <h5 class="mb-5 text-lg font-medium text-gray-800 dark:text-white/90 lg:mb-6">Withdraw</h5>

                <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                <div class="col-span-2 lg:col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Amount</label>
                    <input type="text" placeholder="Enter Amount ..."
                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                </div>

                <div class="col-span-2 lg:col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Confirm Password</label>
                    <input type="password" placeholder="Confirm Password"
                        class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"/>
                </div>
                </div>
            </div>
            </div>
            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
            <button @click="deleteMemberAccount = false" type="button"
                    class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                Cancel</button>
            <button type="button" class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">Withdraw</button>
            </div>
        </form>
        </div>
    </div>

    <!-- END MODALS -->

    <!-- ===== Custom JS ===== -->
    <script defer src="{{ asset('assets/bundle.js') }}"></script>

    <!-- ======================================================== Custom Scripts ======================================================== -->

    <!-- Member -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('memberInfo', () => ({
                memberData: null,
                errors: {},
                isUpdating: false,

                init() {
                    fetch('/treasurer/bodaboda-member/{{ $memberId }}/data')
                        .then(res => res.json())
                        .then(data => {
                            this.memberData = data;
                        });
                },

                formatDate(dateString) {
                    if (!dateString) return '';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('en-US', {
                        month: 'long',
                        day: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                },

                // Phone validation for Kenyan numbers
                validatePhone(phone) {
                    if (!phone || phone === 'N/A') return true; // Optional field

                    // Remove all spaces and common separators
                    const cleanPhone = phone.replace(/[\s\-\(\)]/g, '');

                    // Kenyan phone patterns:
                    // 07XX XXXXXX, 01XX XXXXXX
                    // 2547XX XXXXXX, 2541XX XXXXXX
                    // +2547XX XXXXXX, +2541XX XXXXXX
                    // +254 20 XXX XXXX, 20 XXX XXXX (landline)
                    const patterns = [
                        /^07\d{8}$/,           // 0712345678
                        /^01\d{8}$/,           // 0112345678
                        /^2547\d{8}$/,          // 254712345678
                        /^2541\d{8}$/,          // 254112345678
                        /^\+2547\d{8}$/,        // +254712345678
                        /^\+2541\d{8}$/,        // +254112345678
                        /^20\d{7}$/,            // 201234567 (landline)
                        /^\+25420\d{7}$/,       // +254201234567 (landline)
                        /^\d{9}$/               // Generic 9-digit (for other formats)
                    ];

                    return patterns.some(pattern => pattern.test(cleanPhone));
                },

                validateEmail(email) {
                    if (!email || email === 'N/A') return false;
                    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return re.test(email);
                },

                validateFile(field, event) {
                    const file = event.target.files[0];
                    if (!file) {
                        delete this.errors[field];
                        return true;
                    }

                    // Check file size (5MB max)
                    if (file.size > 5 * 1024 * 1024) {
                        this.errors[field] = 'File size must not exceed 5MB';
                        return false;
                    }

                    // Check file type
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                    if (!allowedTypes.includes(file.type)) {
                        this.errors[field] = 'File must be PNG, JPG, or WebP';
                        return false;
                    }

                    delete this.errors[field];
                    return true;
                },

                validateField(field, value) {
                    // Clear previous error for this field
                    if (!value || value === 'N/A' || value === '' || value === null) {
                        this.errors[field] = 'This field is required';
                        return false;
                    }

                    if (field === 'email' && !this.validateEmail(value)) {
                        this.errors[field] = 'Please enter a valid email address';
                        return false;
                    }

                    if ((field === 'primary_phone' || field === 'secondary_phone') && value !== 'N/A' && value !== '') {
                        if (!this.validatePhone(value)) {
                            this.errors[field] = 'Please enter a valid Kenyan phone number';
                            return false;
                        }
                    }

                    // Clear error if validation passes
                    delete this.errors[field];
                    return true;
                },

                clearError(field) {
                    if (this.errors[field]) {
                        delete this.errors[field];
                    }
                },

                validatePersonalForm() {
                    this.errors = {};
                    let isValid = true;

                    // Get form values
                    const firstName = document.getElementById('personal_first_name')?.value;
                    const lastName = document.getElementById('personal_last_name')?.value;
                    const email = document.getElementById('personal_email')?.value;
                    const primaryPhone = document.getElementById('personal_primary_phone')?.value;
                    const secondaryPhone = document.getElementById('personal_secondary_phone')?.value;
                    const gender = document.getElementById('personal_gender')?.value;
                    const dob = document.getElementById('personal_dob')?.value;
                    const membership = document.getElementById('personal_membership')?.value;
                    const status = document.getElementById('personal_status')?.value;

                    // Validate each field
                    if (!this.validateField('first_name', firstName)) isValid = false;
                    if (!this.validateField('last_name', lastName)) isValid = false;
                    if (!this.validateField('email', email)) isValid = false;
                    if (!this.validateField('primary_phone', primaryPhone)) isValid = false;
                    if (secondaryPhone && secondaryPhone !== 'N/A' && secondaryPhone !== '') {
                        if (!this.validateField('secondary_phone', secondaryPhone)) isValid = false;
                    }
                    if (!gender || gender === '') {
                        this.errors.gender = 'Please select a gender';
                        isValid = false;
                    }
                    if (!dob || dob === 'N/A' || dob === '') {
                        this.errors.dob = 'Date of birth is required';
                        isValid = false;
                    }
                    if (!membership || membership === '') {
                        this.errors.membership = 'Please select membership type';
                        isValid = false;
                    }
                    if (!status || status === '') {
                        this.errors.status = 'Please select status';
                        isValid = false;
                    }

                    return isValid;
                },

                updatePersonalInfo() {
                    if (!this.validatePersonalForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    // Change button text
                    this.isUpdating = true;

                    // Get form values
                    const formData = {
                        first_name: document.getElementById('personal_first_name')?.value,
                        last_name: document.getElementById('personal_last_name')?.value,
                        email: document.getElementById('personal_email')?.value,
                        primary_phone: document.getElementById('personal_primary_phone')?.value,
                        secondary_phone: document.getElementById('personal_secondary_phone')?.value || '',
                        gender: document.getElementById('personal_gender')?.value,
                        dob: document.getElementById('personal_dob')?.value,
                        membership: document.getElementById('personal_membership')?.value,
                        status: document.getElementById('personal_status')?.value,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    // Send to backend
                    fetch('/bodaboda-member/{{ $memberId }}/update-personal', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            this.isUpdating = false;

                            if (data.success) {
                                alert(data.message);
                                // Reload the current page
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750); // 0.75 second delay
                    })
                    .catch(error => {
                        setTimeout(() => {
                            this.isUpdating = false;
                            alert('Error updating member information. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                validateIdentificationForm() {
                    this.errors = {};
                    let isValid = true;

                    // Get form values
                    const nationalId = document.getElementById('identification_national_id')?.value;
                    const drivingLicense = document.getElementById('identification_driving_license')?.value;
                    const licenseType = document.getElementById('identification_license_type')?.value;
                    const ntsaCompliant = document.getElementById('identification_ntsa_compliant')?.value;
                    const status = document.getElementById('identification_status')?.value;

                    // Validate required fields
                    if (!nationalId || nationalId === '') {
                        this.errors['identification.national_id'] = 'National ID number is required';
                        isValid = false;
                    }

                    if (!status || status === '') {
                        this.errors['identification.status'] = 'Verification status is required';
                        isValid = false;
                    }

                    // Check file validation errors (they would have been set during file change)
                    if (this.errors['identification.id_front'] || this.errors['identification.id_back']) {
                        isValid = false;
                    }

                    return isValid;
                },

                updateIdentificationDocuments() {
                    if (!this.validateIdentificationForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    // Change button text
                    this.isUpdating = true;

                    // Create FormData object for file upload
                    const formData = new FormData();

                    // Add all form fields
                    formData.append('national_id', document.getElementById('identification_national_id')?.value || '');
                    formData.append('driving_license', document.getElementById('identification_driving_license')?.value || '');
                    formData.append('license_type', document.getElementById('identification_license_type')?.value || '');
                    formData.append('ntsa_compliant', document.getElementById('identification_ntsa_compliant')?.value || '');
                    formData.append('status', document.getElementById('identification_status')?.value || '');

                    // Add files if selected
                    const idFront = document.getElementById('identification_id_front')?.files[0];
                    if (idFront) {
                        formData.append('id_front', idFront);
                    }

                    const idBack = document.getElementById('identification_id_back')?.files[0];
                    if (idBack) {
                        formData.append('id_back', idBack);
                    }

                    // Add CSRF token
                    formData.append('_token', document.querySelector('input[name="_token"]')?.value);

                    // Send to backend
                    fetch('/bodaboda-member/{{ $memberId }}/update-identification', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            this.isUpdating = false;

                            if (data.success) {
                                alert(data.message);
                                // Reload the current page
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            this.isUpdating = false;
                            alert('Error updating identification documents. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                }
            }));
        });
    </script>

    <!-- Member Kin -->
    <script>

        document.addEventListener('alpine:init', () => {
            // Store for kin data and modal states
            Alpine.store('kinData', {
                currentKin: null,
                editNextKinModal: false,
                isAdding: false,
                isUpdating: false,
                isDeleting: false
            });

            Alpine.data('kinTable', () => ({
                kins: [],
                currentPage: 1,
                itemsPerPage: 10,
                errors: {},

                init() {
                    fetch('/bodaboda-member/{{ $memberId }}/kins')
                        .then(res => res.json())
                        .then(data => {
                            this.kins = data;
                        });

                    // Listen for edit event from table
                    window.addEventListener('open-edit-modal', (event) => {
                        const kin = event.detail.kin;
                        Alpine.store('kinData').currentKin = kin;
                        Alpine.store('kinData').editNextKinModal = true;

                        // Populate form fields after modal opens
                        setTimeout(() => {
                            document.getElementById('edit_kin_id') && (document.getElementById('edit_kin_id').value = kin.kin_id || '');
                            document.getElementById('edit_kin_first_name') && (document.getElementById('edit_kin_first_name').value = kin.firstname || '');
                            document.getElementById('edit_kin_last_name') && (document.getElementById('edit_kin_last_name').value = kin.lastname || '');
                            document.getElementById('edit_kin_email') && (document.getElementById('edit_kin_email').value = kin.email || '');
                            document.getElementById('edit_kin_phone') && (document.getElementById('edit_kin_phone').value = kin.phone || '');
                            document.getElementById('edit_kin_relation') && (document.getElementById('edit_kin_relation').value = kin.relation || '');
                            document.getElementById('edit_kin_status') && (document.getElementById('edit_kin_status').value = kin.status || '');
                        }, 100);
                    });
                },

                // Phone validation (reusing from personal info)
                validatePhone(phone) {
                    if (!phone) return false;
                    const cleanPhone = phone.replace(/[\s\-\(\)]/g, '');
                    const patterns = [
                        /^07\d{8}$/, /^01\d{8}$/, /^2547\d{8}$/, /^2541\d{8}$/,
                        /^\+2547\d{8}$/, /^\+2541\d{8}$/, /^20\d{7}$/,
                        /^\+25420\d{7}$/, /^\d{9}$/
                    ];
                    return patterns.some(pattern => pattern.test(cleanPhone));
                },

                validateEmail(email) {
                    if (!email) return false;
                    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return re.test(email);
                },

                validateField(field, value) {
                    if (!value || value === '') {
                        this.errors[field] = 'This field is required';
                        return false;
                    }

                    if (field === 'email' && !this.validateEmail(value)) {
                        this.errors[field] = 'Please enter a valid email address';
                        return false;
                    }

                    if (field === 'phone' && !this.validatePhone(value)) {
                        this.errors[field] = 'Please enter a valid Kenyan phone number';
                        return false;
                    }

                    delete this.errors[field];
                    return true;
                },

                clearError(field) {
                    if (this.errors[field]) {
                        delete this.errors[field];
                    }
                },

                validateAddForm() {
                    this.errors = {};
                    let isValid = true;

                    const firstName = document.getElementById('kin_first_name')?.value;
                    const lastName = document.getElementById('kin_last_name')?.value;
                    const email = document.getElementById('kin_email')?.value;
                    const phone = document.getElementById('kin_phone')?.value;
                    const relation = document.getElementById('kin_relation')?.value;
                    const status = document.getElementById('kin_status')?.value; // Fixed: was relation = document.getElementById('kin_status')

                    if (!this.validateField('first_name', firstName)) isValid = false;
                    if (!this.validateField('last_name', lastName)) isValid = false;
                    if (!this.validateField('email', email)) isValid = false;
                    if (!this.validateField('phone', phone)) isValid = false;
                    if (!relation || relation === '') {
                        this.errors.relation = 'Please specify relationship';
                        isValid = false;
                    }
                    if (!status || status === '') {
                        this.errors.status = 'Please specify status'; // Fixed: was relation
                        isValid = false;
                    }

                    return isValid;
                },

                validateEditForm() {
                    this.errors = {};
                    let isValid = true;

                    const firstName = document.getElementById('edit_kin_first_name')?.value;
                    const lastName = document.getElementById('edit_kin_last_name')?.value;
                    const email = document.getElementById('edit_kin_email')?.value;
                    const phone = document.getElementById('edit_kin_phone')?.value;
                    const relation = document.getElementById('edit_kin_relation')?.value;
                    const status = document.getElementById('edit_kin_status')?.value; // Fixed: was relation = document.getElementById('kin_status')

                    if (!this.validateField('first_name', firstName)) isValid = false;
                    if (!this.validateField('last_name', lastName)) isValid = false;
                    if (!this.validateField('email', email)) isValid = false;
                    if (!this.validateField('phone', phone)) isValid = false;
                    if (!relation || relation === '') {
                        this.errors.relation = 'Please specify relationship';
                        isValid = false;
                    }
                    if (!status || status === '') {
                        this.errors.status = 'Please specify status'; // Fixed: was relation
                        isValid = false;
                    }

                    return isValid;
                },

                addKin() {
                    if (!this.validateAddForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    Alpine.store('kinData').isAdding = true;

                    const formData = {
                        first_name: document.getElementById('kin_first_name')?.value,
                        last_name: document.getElementById('kin_last_name')?.value,
                        email: document.getElementById('kin_email')?.value,
                        phone: document.getElementById('kin_phone')?.value,
                        relation: document.getElementById('kin_relation')?.value,
                        status: document.getElementById('kin_status')?.value,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    fetch('/bodaboda-member/{{ $memberId }}/kin/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            Alpine.store('kinData').isAdding = false;

                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('kinData').isAdding = false;
                            alert('Error adding next of kin. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                updateKin() {
                    if (!this.validateEditForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    Alpine.store('kinData').isUpdating = true;

                    const kinId = document.getElementById('edit_kin_id')?.value;
                    const formData = {
                        first_name: document.getElementById('edit_kin_first_name')?.value,
                        last_name: document.getElementById('edit_kin_last_name')?.value,
                        email: document.getElementById('edit_kin_email')?.value,
                        phone: document.getElementById('edit_kin_phone')?.value,
                        relation: document.getElementById('edit_kin_relation')?.value,
                        status: document.getElementById('edit_kin_status')?.value, // Fixed: was document.getElementById('kin_status')
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    fetch(`/bodaboda-member/{{ $memberId }}/kin/${kinId}/update`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            Alpine.store('kinData').isUpdating = false;

                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('kinData').isUpdating = false;
                            alert('Error updating next of kin. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                deleteKin() {
                    const kin = Alpine.store('kinData').currentKin;
                    if (!kin) return;

                    const kinName = kin.firstname + ' ' + kin.lastname;

                    if (!confirm(`Do you want to remove ${kinName} from the list?`)) {
                        return;
                    }

                    Alpine.store('kinData').isDeleting = true;

                    const kinId = kin.kin_id;

                    fetch(`/bodaboda-member/{{ $memberId }}/kin/${kinId}/delete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify({ _token: document.querySelector('input[name="_token"]')?.value })
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            Alpine.store('kinData').isDeleting = false;

                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('kinData').isDeleting = false;
                            alert('Error deleting next of kin. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                // Pagination methods
                prevPage() {
                    if (this.currentPage > 1) this.currentPage--;
                },

                nextPage() {
                    if (this.currentPage < this.totalPages) this.currentPage++;
                },

                goToPage(page) {
                    this.currentPage = page;
                },

                get totalPages() {
                    return Math.ceil(this.kins.length / this.itemsPerPage);
                },

                get currentItems() {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.kins.slice(start, end);
                },

                get startIndex() {
                    return (this.currentPage - 1) * this.itemsPerPage + 1;
                },

                get endIndex() {
                    const end = this.currentPage * this.itemsPerPage;
                    return end > this.kins.length ? this.kins.length : end;
                }
            }));
        });

    </script>

    <!-- Member Vehicle -->
    <script>

        document.addEventListener('alpine:init', () => {
            // Create the vehicleData store
            Alpine.store('vehicleData', {
                currentVehicle: null,
                reAssignMemberVehicleModal: false,
                isReassigning: false
            });

            Alpine.data('vehiclesTable', () => ({
                // Member vehicles
                memberVehicles: [],
                memberCount: 0,
                pageMember: 1,

                // Non-member vehicles
                nonMemberVehicles: [],
                nonMemberCount: 0,
                pageNonMember: 1,

                // Shared properties
                itemsPerPage: 10,
                errors: {},
                searchDropdown: null,
                isLoading: true,

                init() {
                    console.log('vehiclesTable initializing...');
                    let memberId = window.location.pathname.split('/').pop();
                    this.memberId = memberId;
                    this.loadMemberVehicleData();
                    this.loadNonMemberVehicleData();
                    this.setupEventListeners();
                },

                loadMemberVehicleData() {
                    console.log('Loading member vehicle data...');
                    let url = '/bodaboda-member/' + this.memberId + '/vehicles/member/all';
                    console.log('Fetching:', url);

                    fetch(url)
                        .then(res => res.json())
                        .then(data => {
                            console.log('Member vehicles response:', data);
                            if (data.success) {
                                this.memberVehicles = data.vehicles || [];
                                console.log('Member vehicles set:', this.memberVehicles);
                            }
                        })
                        .catch(error => console.error('Error loading member vehicles:', error));

                    // Get member count
                    fetch('/bodaboda-member/' + this.memberId + '/vehicles/member/count')
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.memberCount = data.count || 0;
                            }
                        })
                        .catch(error => console.error('Error loading member count:', error));
                },

                loadNonMemberVehicleData() {
                    console.log('Loading non-member vehicle data...');
                    let url = '/bodaboda-member/' + this.memberId + '/vehicles/nonmember/all';
                    console.log('Fetching:', url);

                    fetch(url)
                        .then(res => res.json())
                        .then(data => {
                            console.log('Non-member vehicles response:', data);
                            if (data.success) {
                                // Force a new array reference
                                this.nonMemberVehicles = [...(data.vehicles || [])];
                                console.log('Non-member vehicles set:', this.nonMemberVehicles);

                                // Reset page to trigger re-evaluation
                                this.pageNonMember = 1;
                            }
                        })
                        .catch(error => console.error('Error loading non-member vehicles:', error));

                    // Get non-member count
                    fetch('/bodaboda-member/' + this.memberId + '/vehicles/nonmember/count')
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.nonMemberCount = data.count || 0;
                            }
                        })
                        .catch(error => console.error('Error loading non-member count:', error))
                        .finally(() => {
                            this.isLoading = false;
                        });
                },

                setupEventListeners() {
                    window.addEventListener('open-edit-vehicle-modal', (event) => {
                        const vehicle = event.detail.vehicle;
                        Alpine.store('vehicleData').currentVehicle = vehicle;
                        Alpine.store('vehicleData').editMemberVehiclesModal = true;

                        setTimeout(() => {
                            document.getElementById('edit_vehicle_id') && (document.getElementById('edit_vehicle_id').value = vehicle.vehicleId || '');
                            document.getElementById('edit_vehicle_type') && (document.getElementById('edit_vehicle_type').value = vehicle.type || '');
                            document.getElementById('edit_plate_number') && (document.getElementById('edit_plate_number').value = vehicle.plate_number || '');
                            document.getElementById('edit_brand') && (document.getElementById('edit_brand').value = vehicle.brand || '');
                            document.getElementById('edit_model') && (document.getElementById('edit_model').value = vehicle.model || '');
                            document.getElementById('edit_make') && (document.getElementById('edit_make').value = vehicle.make || '');
                            document.getElementById('edit_cc') && (document.getElementById('edit_cc').value = vehicle.CC || '');
                            document.getElementById('edit_insurance') && (document.getElementById('edit_insurance').value = vehicle.insurance || '');
                            document.getElementById('edit_yom') && (document.getElementById('edit_yom').value = vehicle.yom || '');
                            const ntsaValue = vehicle.NTSA_compliant == 1 ? 'Approved' : 'Suspended';
                            document.getElementById('edit_ntsa_compliant') && (document.getElementById('edit_ntsa_compliant').value = ntsaValue);
                            document.getElementById('edit_vehicle_status') && (document.getElementById('edit_vehicle_status').value = vehicle.status || '');
                        }, 100);
                    });

                    window.addEventListener('open-reassign-vehicle-modal', (event) => {
                        const vehicle = event.detail.vehicle;
                        Alpine.store('vehicleData').currentVehicle = vehicle;
                        Alpine.store('vehicleData').reAssignMemberVehicleModal = true;

                        setTimeout(() => {
                            document.getElementById('reassign_vehicle_id') && (document.getElementById('reassign_vehicle_id').value = vehicle.vehicleId || '');
                            const vehicleDisplay = `${vehicle.type}: ${vehicle.brand} ${vehicle.model} - ${vehicle.plate_number}`;
                            document.getElementById('reassign_vehicle_display') && (document.getElementById('reassign_vehicle_display').value = vehicleDisplay);
                        }, 100);
                    });
                },

                // Pagination methods for member vehicles
                prevPageMember() {
                    if (this.pageMember > 1) this.pageMember--;
                },

                nextPageMember() {
                    if (this.pageMember < this.totalPagesMember) this.pageMember++;
                },

                goToPageMember(page) {
                    if (page >= 1 && page <= this.totalPagesMember) this.pageMember = page;
                },

                get totalPagesMember() {
                    return Math.ceil(this.memberVehicles.length / this.itemsPerPage);
                },

                get paginatedMemberVehicles() {
                    const start = (this.pageMember - 1) * this.itemsPerPage;
                    return this.memberVehicles.slice(start, start + this.itemsPerPage);
                },

                // Pagination methods for non-member vehicles
                prevPageNonMember() {
                    if (this.pageNonMember > 1) this.pageNonMember--;
                },

                nextPageNonMember() {
                    if (this.pageNonMember < this.totalPagesNonMember) this.pageNonMember++;
                },

                goToPageNonMember(page) {
                    if (page >= 1 && page <= this.totalPagesNonMember) this.pageNonMember = page;
                },

                get totalPagesNonMember() {
                    return Math.ceil(this.nonMemberVehicles.length / this.itemsPerPage);
                },

                get paginatedNonMemberVehicles() {
                    const start = (this.pageNonMember - 1) * this.itemsPerPage;
                    return this.nonMemberVehicles.slice(start, start + this.itemsPerPage);
                },

                // Keep all your existing validation and CRUD methods exactly as they were
                validateField(field, value) {
                    if (!value || value === '') {
                        this.errors[field] = 'This field is required';
                        return false;
                    }
                    if (field === 'yom') {
                        const year = parseInt(value);
                        const currentYear = new Date().getFullYear();
                        if (isNaN(year) || year < 1900 || year > currentYear + 1) {
                            this.errors[field] = `Please enter a valid year (1900-${currentYear + 1})`;
                            return false;
                        }
                    }
                    delete this.errors[field];
                    return true;
                },

                clearError(field) {
                    if (this.errors[field]) {
                        delete this.errors[field];
                    }
                },

                validateAssignForm() {
                    this.errors = {};
                    let isValid = true;
                    const vehicleType = document.getElementById('assign_vehicle_type')?.value;
                    const vehicleSelect = document.getElementById('assign_vehicle_select')?.value;
                    const status = document.getElementById('assign_status')?.value;

                    if (!vehicleType || vehicleType === '') {
                        this.errors.assign_vehicle_type = 'Please select vehicle type';
                        isValid = false;
                    }
                    if (!vehicleSelect || vehicleSelect === '') {
                        this.errors.assign_vehicle = 'Please select a vehicle';
                        isValid = false;
                    }
                    if (!status || status === '') {
                        this.errors.assign_status = 'Please select status';
                        isValid = false;
                    }
                    return isValid;
                },

                validateReassignForm() {
                    this.errors = {};
                    let isValid = true;
                    const vehicleDisplay = document.getElementById('reassign_vehicle_display')?.value;
                    if (!vehicleDisplay || vehicleDisplay === '') {
                        this.errors.reassign_vehicle = 'No vehicle selected for reassignment';
                        isValid = false;
                    }
                    return isValid;
                },

                assignVehicle() {
                    if (!this.validateAssignForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    Alpine.store('vehicleData').isAssigning = true;
                    const vehicleSelect = document.getElementById('assign_vehicle_select')?.value;
                    const vehicleId = vehicleSelect ? vehicleSelect.split('|')[0] : '';
                    const formData = {
                        vehicle_id: vehicleId,
                        status: document.getElementById('assign_status')?.value,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    fetch('/bodaboda-member/' + this.memberId + '/vehicle/assign', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            Alpine.store('vehicleData').isAssigning = false;
                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('vehicleData').isAssigning = false;
                            alert('Error assigning vehicle. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                reassignVehicle() {
                    Alpine.store('vehicleData').isReassigning = true;
                    const vehicleId = document.getElementById('reassign_vehicle_id')?.value;
                    const formData = {
                        vehicle_id: vehicleId,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    fetch('/bodaboda-member/' + this.memberId + '/vehicle/reassign', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            Alpine.store('vehicleData').isReassigning = false;
                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('vehicleData').isReassigning = false;
                            alert('Error reassigning vehicle. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                addVehicle() {
                    if (!this.validateAddForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    Alpine.store('vehicleData').isAdding = true;
                    const formData = {
                        type: document.getElementById('vehicle_type')?.value,
                        plate_number: document.getElementById('plate_number')?.value,
                        brand: document.getElementById('brand')?.value,
                        model: document.getElementById('model')?.value,
                        make: document.getElementById('make')?.value,
                        cc: document.getElementById('cc')?.value,
                        insurance: document.getElementById('insurance')?.value,
                        yom: document.getElementById('yom')?.value,
                        ntsa_compliant: document.getElementById('ntsa_compliant')?.value,
                        status: document.getElementById('vehicle_status')?.value,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    fetch('/bodaboda-member/' + this.memberId + '/vehicle/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            Alpine.store('vehicleData').isAdding = false;
                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('vehicleData').isAdding = false;
                            alert('Error adding vehicle. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                updateVehicle() {
                    if (!this.validateEditForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    Alpine.store('vehicleData').isUpdating = true;
                    const vehicleId = document.getElementById('edit_vehicle_id')?.value;
                    const formData = {
                        type: document.getElementById('edit_vehicle_type')?.value,
                        plate_number: document.getElementById('edit_plate_number')?.value,
                        brand: document.getElementById('edit_brand')?.value,
                        model: document.getElementById('edit_model')?.value,
                        make: document.getElementById('edit_make')?.value,
                        cc: document.getElementById('edit_cc')?.value,
                        insurance: document.getElementById('edit_insurance')?.value,
                        yom: document.getElementById('edit_yom')?.value,
                        ntsa_compliant: document.getElementById('edit_ntsa_compliant')?.value,
                        status: document.getElementById('edit_vehicle_status')?.value,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    fetch(`/bodaboda-member/` + this.memberId + `/vehicle/${vehicleId}/update`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            Alpine.store('vehicleData').isUpdating = false;
                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('vehicleData').isUpdating = false;
                            alert('Error updating vehicle. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                deleteVehicle() {
                    const vehicle = Alpine.store('vehicleData').currentVehicle;
                    if (!vehicle) return;

                    const vehicleDetails = `${vehicle.model || ''} ${vehicle.make || ''} ${vehicle.plate_number || ''}`.trim();
                    if (!confirm(`Do you want to remove ${vehicleDetails || 'this vehicle'} from the list?`)) {
                        return;
                    }

                    Alpine.store('vehicleData').isDeleting = true;
                    const vehicleId = vehicle.vehicleId;

                    fetch(`/bodaboda-member/` + this.memberId + `/vehicle/${vehicleId}/delete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify({ _token: document.querySelector('input[name="_token"]')?.value })
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            Alpine.store('vehicleData').isDeleting = false;
                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('vehicleData').isDeleting = false;
                            alert('Error deleting vehicle. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                validateAddForm() {
                    this.errors = {};
                    let isValid = true;
                    const fields = [
                        'vehicle_type', 'plate_number', 'brand', 'model', 'make',
                        'cc', 'insurance', 'yom', 'ntsa_compliant', 'vehicle_status'
                    ];
                    fields.forEach(field => {
                        const value = document.getElementById(field)?.value;
                        if (!this.validateField(field, value)) isValid = false;
                    });
                    return isValid;
                },

                validateEditForm() {
                    this.errors = {};
                    let isValid = true;
                    const fields = [
                        'edit_vehicle_type', 'edit_plate_number', 'edit_brand', 'edit_model', 'edit_make',
                        'edit_cc', 'edit_insurance', 'edit_yom', 'edit_ntsa_compliant', 'edit_vehicle_status'
                    ];
                    fields.forEach(field => {
                        const value = document.getElementById(field)?.value;
                        const errorField = field.replace('edit_', '');
                        if (!this.validateField(errorField, value)) isValid = false;
                    });
                    return isValid;
                },

                // Pagination getters
                get startEntryMember() {
                    return (this.pageMember - 1) * this.itemsPerPage + 1;
                },

                get endEntryMember() {
                    const end = this.pageMember * this.itemsPerPage;
                    return end > this.memberVehicles.length ? this.memberVehicles.length : end;
                },

                get startEntryNonMember() {
                    return (this.pageNonMember - 1) * this.itemsPerPage + 1;
                },

                get endEntryNonMember() {
                    const end = this.pageNonMember * this.itemsPerPage;
                    return end > this.nonMemberVehicles.length ? this.nonMemberVehicles.length : end;
                }
            }));
        });

    </script>

    <!-- Member Contributions -->
    <script>

        document.addEventListener('alpine:init', () => {
            // Store for contribution data and modal states
            Alpine.store('contributionData', {
                currentContribution: null,
                editContributionModal: false,
                isContributing: false,
                isWithdrawing: false,
                isUpdating: false,
                memberBalance: 0, // Added for member balance
                memberBalanceFormatted: 'KES 0.00' // Added formatted balance
            });

            Alpine.data('contributionsTable', () => ({
                // Original data
                allContributions: [],
                // Filtered data (what gets displayed)
                contributions: [],
                // Filter states
                frequencyFilter: 'Daily',
                transactionFilter: 'All',
                paymentFilter: 'All',
                page: 1,
                itemsPerPage: 10,
                errors: {},

                init() {
                    // Load all contributions
                    fetch('/bodaboda-member/{{ $memberId }}/contributions')
                        .then(res => res.json())
                        .then(data => {
                            this.allContributions = data;
                            this.applyFilters(); // Apply filters after data loads
                        });

                    // Load member contribution balance
                    fetch('/contributions/balance/member/{{ $memberId }}')
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Alpine.store('contributionData').memberBalance = data.balance;
                                Alpine.store('contributionData').memberBalanceFormatted = data.formatted;
                            }
                        })
                        .catch(error => {
                            console.error('Error loading member balance:', error);
                        });

                    // Listen for edit event from table
                    window.addEventListener('open-edit-contribution-modal', (event) => {
                        const contribution = event.detail.contribution;
                        Alpine.store('contributionData').currentContribution = contribution;
                        Alpine.store('contributionData').editContributionModal = true;

                        // Populate form fields after modal opens
                        setTimeout(() => {
                            document.getElementById('edit_transaction_id') && (document.getElementById('edit_transaction_id').value = contribution.transactionId || '');
                            document.getElementById('edit_contribution_Amount') && (document.getElementById('edit_contribution_Amount').value = contribution.transactionAmount || '');
                            document.getElementById('edit_payment_mode') && (document.getElementById('edit_payment_mode').value = contribution.transactionMode || '');
                            document.getElementById('edit_transaction_code') && (document.getElementById('edit_transaction_code').value = contribution.transactionCode || '');
                            document.getElementById('edit_status') && (document.getElementById('edit_status').value = contribution.transactionStatus || '');
                        }, 100);
                    });
                },

                // Filter methods
                applyFilters() {
                    let filtered = [...this.allContributions];

                    // Apply transaction type filter (Paid-In/Paid-Out)
                    if (this.transactionFilter !== 'All') {
                        filtered = filtered.filter(c => c.transactionType === this.transactionFilter);
                    }

                    // Apply payment mode filter (Cash/MPesa/Bank)
                    if (this.paymentFilter !== 'All') {
                        filtered = filtered.filter(c => c.transactionMode === this.paymentFilter);
                    }

                    // Apply frequency filter based on transaction date
                    if (this.frequencyFilter !== 'Daily') {
                        const now = new Date();
                        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

                        filtered = filtered.filter(c => {
                            if (!c.transactionDate) return false;
                            const transDate = new Date(c.transactionDate);

                            switch(this.frequencyFilter) {
                                case 'Daily':
                                    // Daily shows today's transactions
                                    return transDate >= today;

                                case 'Weekly':
                                    // Weekly shows last 7 days
                                    const weekAgo = new Date(today);
                                    weekAgo.setDate(weekAgo.getDate() - 7);
                                    return transDate >= weekAgo;

                                case 'Monthly':
                                    // Monthly shows last 30 days
                                    const monthAgo = new Date(today);
                                    monthAgo.setDate(monthAgo.getDate() - 30);
                                    return transDate >= monthAgo;

                                case 'Yearly':
                                    // Yearly shows last 365 days
                                    const yearAgo = new Date(today);
                                    yearAgo.setDate(yearAgo.getDate() - 365);
                                    return transDate >= yearAgo;

                                default:
                                    return true;
                            }
                        });
                    }

                    this.contributions = filtered;
                    this.page = 1; // Reset to first page after filtering
                },

                performFilter() {
                    this.applyFilters();
                },

                // Validation methods (keep all existing validation methods)
                validateField(field, value) {
                    if (!value || value === '' || value === null) {
                        this.errors[field] = 'This field is required';
                        return false;
                    }

                    if (field === 'amount' && (isNaN(value) || parseFloat(value) <= 0)) {
                        this.errors[field] = 'Please enter a valid amount greater than 0';
                        return false;
                    }

                    delete this.errors[field];
                    return true;
                },

                clearError(field) {
                    if (this.errors[field]) {
                        delete this.errors[field];
                    }
                },

                validateContributeForm() {
                    this.errors = {};
                    let isValid = true;

                    const amount = document.getElementById('contribute_amount')?.value;
                    const paymentMode = document.getElementById('contribute_payment_mode')?.value;
                    const status = document.getElementById('contribute_status')?.value;

                    if (!this.validateField('amount', amount)) isValid = false;
                    if (!paymentMode || paymentMode === '') {
                        this.errors.payment_mode = 'Please select payment mode';
                        isValid = false;
                    }
                    if (!status || status === '') {
                        this.errors.status = 'Please select status';
                        isValid = false;
                    }

                    const transactionCode = document.getElementById('contribute_transaction_code')?.value;
                    if (paymentMode !== 'Cash' && (!transactionCode || transactionCode === '')) {
                        this.errors.transaction_code = 'Transaction code is required for non-cash payments';
                        isValid = false;
                    }

                    return isValid;
                },

                validateWithdrawForm() {
                    this.errors = {};
                    let isValid = true;

                    const amount = document.getElementById('withdraw_amount')?.value;
                    const paymentMode = document.getElementById('withdraw_payment_mode')?.value;
                    const status = document.getElementById('withdraw_status')?.value;

                    if (!this.validateField('amount', amount)) isValid = false;
                    if (!paymentMode || paymentMode === '') {
                        this.errors.payment_mode = 'Please select payment mode';
                        isValid = false;
                    }
                    if (!status || status === '') {
                        this.errors.status = 'Please select status';
                        isValid = false;
                    }

                    const transactionCode = document.getElementById('withdraw_transaction_code')?.value;
                    if (paymentMode !== 'Cash' && (!transactionCode || transactionCode === '')) {
                        this.errors.transaction_code = 'Transaction code is required for non-cash payments';
                        isValid = false;
                    }

                    return isValid;
                },

                validateUpdateForm() {
                    this.errors = {};
                    let isValid = true;

                    const amount = document.getElementById('edit_contribution_Amount')?.value;
                    const paymentMode = document.getElementById('edit_payment_mode')?.value;
                    const status = document.getElementById('edit_status')?.value;

                    if (!this.validateField('amount', amount)) isValid = false;
                    if (!paymentMode || paymentMode === '') {
                        this.errors.payment_mode = 'Please select payment mode';
                        isValid = false;
                    }
                    if (!status || status === '') {
                        this.errors.status = 'Please select status';
                        isValid = false;
                    }

                    const transactionCode = document.getElementById('edit_transaction_code')?.value;
                    if (paymentMode !== 'Cash' && (!transactionCode || transactionCode === '')) {
                        this.errors.transaction_code = 'Transaction code is required for non-cash payments';
                        isValid = false;
                    }

                    return isValid;
                },

                handlePaymentModeChange(mode, type) {
                    const codeField = type === 'contribute' ? document.getElementById('contribute_transaction_code') :
                                    type === 'withdraw' ? document.getElementById('withdraw_transaction_code') :
                                    document.getElementById('edit_transaction_code');

                    if (codeField) {
                        if (mode === 'Cash') {
                            codeField.readOnly = true;
                            codeField.value = '';
                        } else {
                            codeField.readOnly = false;
                        }
                    }
                },

                contribute() {
                    if (!this.validateContributeForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    Alpine.store('contributionData').isContributing = true;

                    const formData = {
                        amount: document.getElementById('contribute_amount')?.value,
                        payment_mode: document.getElementById('contribute_payment_mode')?.value,
                        transaction_code: document.getElementById('contribute_transaction_code')?.value || '',
                        status: document.getElementById('contribute_status')?.value,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    fetch('/bodaboda-member/{{ $memberId }}/contribute', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            Alpine.store('contributionData').isContributing = false;

                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('contributionData').isContributing = false;
                            alert('Error processing contribution. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                withdraw() {
                    if (!this.validateWithdrawForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    Alpine.store('contributionData').isWithdrawing = true;

                    const formData = {
                        amount: document.getElementById('withdraw_amount')?.value,
                        payment_mode: document.getElementById('withdraw_payment_mode')?.value,
                        transaction_code: document.getElementById('withdraw_transaction_code')?.value || '',
                        status: document.getElementById('withdraw_status')?.value,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    fetch('/bodaboda-member/{{ $memberId }}/withdraw', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            Alpine.store('contributionData').isWithdrawing = false;

                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('contributionData').isWithdrawing = false;
                            alert('Error processing withdrawal. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                updateContribution() {
                    if (!this.validateUpdateForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    Alpine.store('contributionData').isUpdating = true;

                    const transactionId = document.getElementById('edit_transaction_id')?.value;
                    const formData = {
                        amount: document.getElementById('edit_contribution_Amount')?.value,
                        payment_mode: document.getElementById('edit_payment_mode')?.value,
                        transaction_code: document.getElementById('edit_transaction_code')?.value || '',
                        status: document.getElementById('edit_status')?.value,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    fetch(`/bodaboda-member/{{ $memberId }}/contribution/${transactionId}/update`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            Alpine.store('contributionData').isUpdating = false;

                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('contributionData').isUpdating = false;
                            alert('Error updating transaction. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                // Pagination methods
                prevPage() {
                    if (this.page > 1) this.page--;
                },

                nextPage() {
                    if (this.page < this.totalPages) this.page++;
                },

                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) this.page = page;
                },

                get totalPages() {
                    return Math.ceil(this.contributions.length / this.itemsPerPage);
                },

                get paginatedContributions() {
                    const start = (this.page - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.contributions.slice(start, end);
                },

                get startEntry() {
                    return (this.page - 1) * this.itemsPerPage + 1;
                },

                get endEntry() {
                    const end = this.page * this.itemsPerPage;
                    return end > this.contributions.length ? this.contributions.length : end;
                }
            }));
        });

    </script>

    <!-- Member Savings -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('savingsTable', () => ({
                savings: [],
                page: 1,
                itemsPerPage: 10,

                init() {
                    fetch('/bodaboda-member/{{ $memberId }}/savings')
                        .then(res => res.json())
                        .then(data => {
                            this.savings = data;
                        });
                },

                get totalPages() {
                    return Math.ceil(this.savings.length / this.itemsPerPage);
                },

                get paginatedSavings() {
                    const start = (this.page - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.savings.slice(start, end);
                },

                get startEntry() {
                    return (this.page - 1) * this.itemsPerPage + 1;
                },

                get endEntry() {
                    const end = this.page * this.itemsPerPage;
                    return end > this.savings.length ? this.savings.length : end;
                },

                prevPage() {
                    if (this.page > 1) this.page--;
                },

                nextPage() {
                    if (this.page < this.totalPages) this.page++;
                },

                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) this.page = page;
                },

                editSavingModal(saving) {
                    if (Alpine.store('savingData')) {
                        Alpine.store('savingData').currentSaving = saving;
                        Alpine.store('savingData').editSavingModal = true;
                    }
                }
            }));

            Alpine.store('savingData', () => ({
                editSavingModal: false,
                currentSaving: null
            }));
        });
    </script>

    <!-- Member Loans -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('loansTable', () => ({
                loans: [],
                page: 1,
                itemsPerPage: 10,

                init() {
                    fetch('/bodaboda-member/{{ $memberId }}/loans')
                        .then(res => res.json())
                        .then(data => {
                            this.loans = data;
                        });
                },

                get totalPages() {
                    return Math.ceil(this.loans.length / this.itemsPerPage);
                },

                get paginatedLoans() {
                    const start = (this.page - 1) * this.itemsPerPage;
                    const end = start + this.itemsPerPage;
                    return this.loans.slice(start, end);
                },

                get startEntry() {
                    return (this.page - 1) * this.itemsPerPage + 1;
                },

                get endEntry() {
                    const end = this.page * this.itemsPerPage;
                    return end > this.loans.length ? this.loans.length : end;
                },

                prevPage() {
                    if (this.page > 1) this.page--;
                },

                nextPage() {
                    if (this.page < this.totalPages) this.page++;
                },

                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) this.page = page;
                },

                editLoanModal(loan) {
                    if (Alpine.store('loanData')) {
                        Alpine.store('loanData').currentLoan = loan;
                        Alpine.store('loanData').editLoanModal = true;
                    }
                }
            }));

            Alpine.store('loanData', () => ({
                editLoanModal: false,
                currentLoan: null
            }));
        });
    </script>

    <!-- Member Fines -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('finesTable', () => ({
                fines: [],
                page: 1,
                itemsPerPage: 10,

                init() {
                    fetch('/bodaboda-member/{{ $memberId }}/fines')
                        .then(res => res.json())
                        .then(data => {
                            this.fines = data;
                        });
                },

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

                prevPage() {
                    if (this.page > 1) this.page--;
                },

                nextPage() {
                    if (this.page < this.totalPages) this.page++;
                },

                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) this.page = page;
                },

                editFineModal(fine) {
                    if (Alpine.store('fineData')) {
                        Alpine.store('fineData').currentFine = fine;
                        Alpine.store('fineData').editFineModal = true;
                    }
                }
            }));

            Alpine.store('fineData', () => ({
                editFineModal: false,
                currentFine: null
            }));
        });
    </script>

    <!-- Member Settings -->


</body>

</html>
