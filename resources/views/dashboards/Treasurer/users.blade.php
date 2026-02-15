<!DOCTYPE html>

<html lang="en">

  <meta http-equiv="content-type" content="text/html;charset=utf-8" />

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>{{ Auth::user()->role }} | KFBCL - User Management</title>

    <link rel="icon" href="{{ asset('assets/favicon.ico') }}">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
  </head>

  <body x-data="{ page: 'users', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false, 'editUserRoleModal': false, 'newUserRoleModal': false,  'newUserModal': false, 'editUserModal': false, 'isProfileAddressModal': false }">
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
             class="fixed z-50 h-screen w-full bg-gray-900/50"></div>
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
            <!-- Content Start -->
            <div x-data="{ pageName: `Users` }">
              <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName">Users</h2>
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
                    <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName">User Management</li>
                  </ol>
                </nav>
              </div>
            </div>

            <div class="space-y-6">

              <!-- Replace the entire Users Quick Stats section with this: -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- All Users -->
                <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90">
                        <svg class="size-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33633 4.79297C6.39425 4.79297 5.63054 5.55668 5.63054 6.49876C5.63054 7.44084 6.39425 8.20454 7.33633 8.20454C8.27841 8.20454 9.04212 7.44084 9.04212 6.49876C9.04212 5.55668 8.27841 4.79297 7.33633 4.79297ZM4.13054 6.49876C4.13054 4.72825 5.56582 3.29297 7.33633 3.29297C9.10684 3.29297 10.5421 4.72825 10.5421 6.49876C10.5421 8.26926 9.10684 9.70454 7.33633 9.70454C5.56582 9.70454 4.13054 8.26926 4.13054 6.49876ZM4.24036 12.7602C3.61952 13.3265 3.28381 14.0575 3.10504 14.704C3.06902 14.8343 3.09994 14.9356 3.17904 15.0229C3.26864 15.1218 3.4319 15.2073 3.64159 15.2073H10.9411C11.1507 15.2073 11.314 15.1218 11.4036 15.0229C11.4827 14.9356 11.5136 14.8343 11.4776 14.704C11.2988 14.0575 10.9631 13.3265 10.3423 12.7602C9.73639 12.2075 8.7967 11.7541 7.29132 11.7541C5.78595 11.7541 4.84626 12.2075 4.24036 12.7602ZM3.22949 11.652C4.14157 10.82 5.4544 10.2541 7.29132 10.2541C9.12825 10.2541 10.4411 10.82 11.3532 11.652C12.2503 12.4703 12.698 13.4893 12.9234 14.3042C13.1054 14.9627 12.9158 15.5879 12.5152 16.03C12.1251 16.4605 11.5496 16.7073 10.9411 16.7073H3.64159C3.03301 16.7073 2.45751 16.4605 2.06745 16.03C1.66689 15.5879 1.47723 14.9627 1.65929 14.3042C1.88464 13.4893 2.33237 12.4703 3.22949 11.652ZM12.7529 9.70454C12.1654 9.70454 11.6148 9.54648 11.1412 9.27055C11.4358 8.86714 11.6676 8.4151 11.8226 7.92873C12.0902 8.10317 12.4097 8.20454 12.7529 8.20454C13.695 8.20454 14.4587 7.44084 14.4587 6.49876C14.4587 5.55668 13.695 4.79297 12.7529 4.79297C12.4097 4.79297 12.0901 4.89435 11.8226 5.0688C11.6676 4.58243 11.4357 4.13039 11.1412 3.72698C11.6147 3.45104 12.1654 3.29297 12.7529 3.29297C14.5235 3.29297 15.9587 4.72825 15.9587 6.49876C15.9587 8.26926 14.5235 9.70454 12.7529 9.70454ZM16.3577 16.7072H13.8902C14.1962 16.2705 14.4012 15.7579 14.4688 15.2072H16.3577C16.5674 15.2072 16.7307 15.1217 16.8203 15.0228C16.8994 14.9355 16.9303 14.8342 16.8943 14.704C16.7155 14.0574 16.3798 13.3264 15.759 12.7601C15.2556 12.301 14.5219 11.9104 13.425 11.7914C13.1434 11.3621 12.7952 10.9369 12.3641 10.5437C12.2642 10.4526 12.1611 10.3643 12.0548 10.2791C12.2648 10.2626 12.4824 10.2541 12.708 10.2541C14.5449 10.2541 15.8577 10.82 16.7698 11.6519C17.6669 12.4702 18.1147 13.4892 18.34 14.3042C18.5221 14.9626 18.3324 15.5879 17.9319 16.03C17.5418 16.4605 16.9663 16.7072 16.3577 16.7072Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90" x-text="$store.userStats.totalUsers">
                            0
                        </h3>
                        <p class="flex items-center gap-3 text-sm text-gray-400 dark:text-gray-400">
                            All System Users
                            <span class="bg-success-50 text-sm text-success-600 dark:bg-success-500/15 dark:text-success-500 inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-0.5 text-sm font-medium">+20%</span>
                            From last Month
                        </p>
                    </div>
                </article>

                <!-- Active Users -->
                <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90">
                        <svg class="size-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 9C11.933 9 13.5 7.433 13.5 5.5C13.5 3.567 11.933 2 10 2C8.067 2 6.5 3.567 6.5 5.5C6.5 7.433 8.067 9 10 9Z" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M15.5 18C15.5 15.2386 13.0376 13 10 13C6.96243 13 4.5 15.2386 4.5 18" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M16.5 7.5L14.75 9.25L13 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90"
                            x-text="$store.userStats.activeUsers">
                            0
                        </h3>
                        <p class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                            Active System Users
                        </p>
                    </div>
                </article>

                <!-- User Roles -->
                <article class="flex items-center gap-5 rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/3">
                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white/90" x-text="$store.userStats.totalRoles">
                            0
                        </h3>
                        <p class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                            User Roles
                        </p>
                    </div>
                </article>
            </div>

              <!-- Tabbed navigation -->
              <div class="rounded-xl border border-gray-200 p-6 bg-white dark:border-gray-800 dark:bg-white/[0.03]" x-data="{ activeTab: 'system-user' }">
                <div class="border-b border-gray-200 dark:border-gray-800">
                  <nav class="-mb-px flex space-x-2 overflow-x-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-200 dark:[&::-webkit-scrollbar-thumb]:bg-gray-600 dark:[&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar]:h-1.5">
                    <!-- System User Tab -->
                    <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                            x-bind:class="activeTab === 'system-user' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                            x-on:click="activeTab = 'system-user'">
                      <svg class="size-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33633 4.79297C6.39425 4.79297 5.63054 5.55668 5.63054 6.49876C5.63054 7.44084 6.39425 8.20454 7.33633 8.20454C8.27841 8.20454 9.04212 7.44084 9.04212 6.49876C9.04212 5.55668 8.27841 4.79297 7.33633 4.79297ZM4.13054 6.49876C4.13054 4.72825 5.56582 3.29297 7.33633 3.29297C9.10684 3.29297 10.5421 4.72825 10.5421 6.49876C10.5421 8.26926 9.10684 9.70454 7.33633 9.70454C5.56582 9.70454 4.13054 8.26926 4.13054 6.49876ZM4.24036 12.7602C3.61952 13.3265 3.28381 14.0575 3.10504 14.704C3.06902 14.8343 3.09994 14.9356 3.17904 15.0229C3.26864 15.1218 3.4319 15.2073 3.64159 15.2073H10.9411C11.1507 15.2073 11.314 15.1218 11.4036 15.0229C11.4827 14.9356 11.5136 14.8343 11.4776 14.704C11.2988 14.0575 10.9631 13.3265 10.3423 12.7602C9.73639 12.2075 8.7967 11.7541 7.29132 11.7541C5.78595 11.7541 4.84626 12.2075 4.24036 12.7602ZM3.22949 11.652C4.14157 10.82 5.4544 10.2541 7.29132 10.2541C9.12825 10.2541 10.4411 10.82 11.3532 11.652C12.2503 12.4703 12.698 13.4893 12.9234 14.3042C13.1054 14.9627 12.9158 15.5879 12.5152 16.03C12.1251 16.4605 11.5496 16.7073 10.9411 16.7073H3.64159C3.03301 16.7073 2.45751 16.4605 2.06745 16.03C1.66689 15.5879 1.47723 14.9627 1.65929 14.3042C1.88464 13.4893 2.33237 12.4703 3.22949 11.652ZM12.7529 9.70454C12.1654 9.70454 11.6148 9.54648 11.1412 9.27055C11.4358 8.86714 11.6676 8.4151 11.8226 7.92873C12.0902 8.10317 12.4097 8.20454 12.7529 8.20454C13.695 8.20454 14.4587 7.44084 14.4587 6.49876C14.4587 5.55668 13.695 4.79297 12.7529 4.79297C12.4097 4.79297 12.0901 4.89435 11.8226 5.0688C11.6676 4.58243 11.4357 4.13039 11.1412 3.72698C11.6147 3.45104 12.1654 3.29297 12.7529 3.29297C14.5235 3.29297 15.9587 4.72825 15.9587 6.49876C15.9587 8.26926 14.5235 9.70454 12.7529 9.70454ZM16.3577 16.7072H13.8902C14.1962 16.2705 14.4012 15.7579 14.4688 15.2072H16.3577C16.5674 15.2072 16.7307 15.1217 16.8203 15.0228C16.8994 14.9355 16.9303 14.8342 16.8943 14.704C16.7155 14.0574 16.3798 13.3264 15.759 12.7601C15.2556 12.301 14.5219 11.9104 13.425 11.7914C13.1434 11.3621 12.7952 10.9369 12.3641 10.5437C12.2642 10.4526 12.1611 10.3643 12.0548 10.2791C12.2648 10.2626 12.4824 10.2541 12.708 10.2541C14.5449 10.2541 15.8577 10.82 16.7698 11.6519C17.6669 12.4702 18.1147 13.4892 18.34 14.3042C18.5221 14.9626 18.3324 15.5879 17.9319 16.03C17.5418 16.4605 16.9663 16.7072 16.3577 16.7072Z" fill="currentColor"></path>
                      </svg>
                      System User
                    </button>

                    <!-- User Roles Tab -->
                    <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out"
                            x-bind:class="activeTab === 'user-roles' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                            x-on:click="activeTab = 'user-roles'">
                      <svg class="size-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.83203 2.5835C3.58939 2.5835 2.58203 3.59085 2.58203 4.83349V7.25015C2.58203 8.49279 3.58939 9.50015 4.83203 9.50015H7.2487C8.49134 9.50015 9.4987 8.49279 9.4987 7.25015V4.8335C9.4987 3.59086 8.49134 2.5835 7.2487 2.5835H4.83203ZM4.08203 4.83349C4.08203 4.41928 4.41782 4.0835 4.83203 4.0835H7.2487C7.66291 4.0835 7.9987 4.41928 7.9987 4.8335V7.25015C7.9987 7.66436 7.66291 8.00015 7.2487 8.00015H4.83203C4.41782 8.00015 4.08203 7.66436 4.08203 7.25015V4.83349ZM4.83203 10.5002C3.58939 10.5002 2.58203 11.5075 2.58203 12.7502V15.1668C2.58203 16.4095 3.58939 17.4168 4.83203 17.4168H7.2487C8.49134 17.4168 9.4987 16.4095 9.4987 15.1668V12.7502C9.4987 11.5075 8.49134 10.5002 7.2487 10.5002H4.83203ZM4.08203 12.7502C4.08203 12.336 4.41782 12.0002 4.83203 12.0002H7.2487C7.66291 12.0002 7.9987 12.336 7.9987 12.7502V15.1668C7.9987 15.5811 7.66291 15.9168 7.2487 15.9168H4.83203C4.41782 15.9168 4.08203 15.5811 4.08203 15.1668V12.7502ZM10.4987 4.83349C10.4987 3.59085 11.5061 2.5835 12.7487 2.5835H15.1654C16.408 2.5835 17.4154 3.59086 17.4154 4.8335V7.25015C17.4154 8.49279 16.408 9.50015 15.1654 9.50015H12.7487C11.5061 9.50015 10.4987 8.49279 10.4987 7.25015V4.83349ZM12.7487 4.0835C12.3345 4.0835 11.9987 4.41928 11.9987 4.83349V7.25015C11.9987 7.66436 12.3345 8.00015 12.7487 8.00015H15.1654C15.5796 8.00015 15.9154 7.66436 15.9154 7.25015V4.8335C15.9154 4.41928 15.5796 4.0835 15.1654 4.0835H12.7487ZM12.7487 10.5002C11.5061 10.5002 10.4987 11.5075 10.4987 12.7502V15.1668C10.4987 16.4095 11.5061 17.4168 12.7487 17.4168H15.1654C16.408 17.4168 17.4154 16.4095 17.4154 15.1668V12.7502C17.4154 11.5075 16.408 10.5002 15.1654 10.5002H12.7487ZM11.9987 12.7502C11.9987 12.336 12.3345 12.0002 12.7487 12.0002H15.1654C15.5796 12.0002 15.9154 12.336 15.9154 12.7502V15.1668C15.9154 15.5811 15.5796 15.9168 15.1654 15.9168H12.7487C12.3345 15.9168 11.9987 15.5811 11.9987 15.1668V12.7502Z" fill="currentColor"></path>
                      </svg>
                      User Roles
                    </button>
                  </nav>
                </div>

                <div class="pt-4 dark:border-gray-800">
                    <!-- System User Content -->
                    <div x-show="activeTab === 'system-user'">
                        <!-- Users table -->
                        <div class="col-span-12 xl:col-span-8" x-data="usersTableFull()" x-init="init()">
                            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                            <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                    Users
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    All system users
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
                                    <button class="hover:text-dark-900 shadow-theme-xs relative flex h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
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
                                <div>
                                    <button type="button" @click="newUserModal = true"
                                            class="flex w-full justify-center items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                    <svg class="stroke-current" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H6C4.93913 15 3.92172 15.4214 3.17157 16.1716C2.42143 16.9217 2 17.9391 2 19V21"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                        <circle cx="9" cy="7" r="4"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        <line x1="19" y1="8" x2="19" y2="14"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"/>
                                        <line x1="22" y1="11" x2="16" y2="11"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"/>
                                    </svg>
                                    Add User
                                    </button>
                                </div>
                                </div>
                            </div>
                            <!-- Users Table -->
                            <div>
                                <div class="custom-scrollbar overflow-x-auto">
                                    <table class="w-full table-auto">
                                        <thead>
                                            <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                <!-- #User ID Column with filter -->
                                                <th class="p-4 whitespace-nowrap">
                                                <div class="flex w-full items-center gap-3">
                                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                    #User ID
                                                    </p>
                                                </div>
                                                </th>

                                                <!-- User Column (no filter, no sort) -->
                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                    User
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
                                                    Member Since
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

                                                <!-- Actions Column (no filter, no sort) -->
                                                <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                Action
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                            <template x-for="row in paginatedRows" :key="row.id">
                                                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                <!-- #User ID -->
                                                <td class="p-4 whitespace-nowrap">
                                                    <div class="group flex items-center gap-3">
                                                    <h4 class="text-theme-xs font-medium text-gray-700 group-hover:underline dark:text-gray-400"
                                                        x-text="row.userId"></h4>
                                                    </div>
                                                </td>

                                                <!-- User: Fullname, [User Role | Gender | Status] -->
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

                                                <!-- Documentation: ID Number, [DoB: 09-Jan-2024] -->
                                                <td class="p-4 whitespace-nowrap">
                                                    <div>
                                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-400"
                                                        x-text="'ID: ' + row.nationalId"></p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400"
                                                        x-text="'DoB: ' + new Date(row.dob).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })"></p>
                                                    </div>
                                                </td>

                                                <!-- Joined On: 09-Jan-2021 13:30 -->
                                                <td class="p-4 whitespace-nowrap">
                                                    <span class="text-sm text-gray-700 dark:text-gray-400" x-text="row.joinedOn"></span>
                                                </td>

                                                <!-- Role -->
                                                <td class="p-4 whitespace-nowrap">
                                                    <span class="text-sm text-gray-700 dark:text-gray-400" x-text="row.userRole"></span>
                                                </td>

                                                <!-- Last Login: 09-Jan-2024 13:30 -->
                                                <td class="p-4 whitespace-nowrap">
                                                    <p class="text-sm text-gray-700 dark:text-gray-400 truncate max-w-[200px]">
                                                    <span :class="getStatusClass(row.userStatus)"
                                                            class="rounded-full px-2 py-0.5 text-xs font-medium ml-1"
                                                            x-text="row.userStatus">
                                                        </span>
                                                    </p>
                                                </td>

                                                <!-- Actions (unchanged) -->
                                                <td class="p-4 whitespace-nowrap">
                                                    <button @click="$store.userModal.editUserModal = true;
                                                            $store.userModal.currentUser = row;
                                                            $store.userModal.editForm = {
                                                            firstName: row.firstName,
                                                            lastName: row.lastName,
                                                            gender: row.gender,
                                                            email: row.email,
                                                            phone: row.phone,
                                                            nationalId: row.nationalId,
                                                            dob: new Date(row.dob).toLocaleDateString('en-GB', {
                                                                day: '2-digit',
                                                                month: 'short',
                                                                year: 'numeric'
                                                            }).replace(/ /g, '-'),
                                                            userRole: row.userRole,
                                                            userStatus: row.userStatus
                                                            }"
                                                            class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                    <svg class="w-[22px] h-[22px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="1.1" d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z"/>
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

                    <!-- User Roles Content -->
                    <div x-show="activeTab === 'user-roles'" style="display: none;">
                        <div class="col-span-12 xl:col-span-8">
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                            <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-600 dark:text-white/90">
                                    User Roles
                                </h3>
                                <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                    Manage your system user roles
                                </p>
                            </div>
                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                <button @click="newUserRoleModal = true"
                                        class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    New Role
                                </button>
                            </div>
                            </div>
                            <!-- User Roles Table -->
                            <div>
                                <!-- User Roles Table -->
                                <div x-data="userRolesTable">
                                    <div class="custom-scrollbar overflow-x-auto">
                                        <!-- Loading state -->
                                        <div x-show="isLoading" class="p-8 text-center">
                                            <p class="text-gray-500">
                                                <span class="animate-spin stroke-brand-500 text-gray-200 dark:text-gray-800">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="10" cy="10" r="8.75" stroke="currentColor" stroke-width="2.5"></circle>
                                                        <mask id="path-2-inside-1_3755_26477" fill="white">
                                                            <path d="M18.2372 12.9506C18.8873 13.1835 19.6113 12.846 19.7613 12.1719C20.0138 11.0369 20.0672 9.86319 19.9156 8.70384C19.7099 7.12996 19.1325 5.62766 18.2311 4.32117C17.3297 3.01467 16.1303 1.94151 14.7319 1.19042C13.7019 0.637155 12.5858 0.270357 11.435 0.103491C10.7516 0.00440265 10.179 0.561473 10.1659 1.25187C10.1528 1.94226 10.7059 2.50202 11.3845 2.6295C12.1384 2.77112 12.8686 3.02803 13.5487 3.39333C14.5973 3.95661 15.4968 4.76141 16.1728 5.74121C16.8488 6.721 17.2819 7.84764 17.4361 9.02796C17.5362 9.79345 17.5172 10.5673 17.3819 11.3223C17.2602 12.002 17.5871 12.7178 18.2372 12.9506Z"></path>
                                                        </mask>
                                                        <path d="M18.2372 12.9506C18.8873 13.1835 19.6113 12.846 19.7613 12.1719C20.0138 11.0369 20.0672 9.86319 19.9156 8.70384C19.7099 7.12996 19.1325 5.62766 18.2311 4.32117C17.3297 3.01467 16.1303 1.94151 14.7319 1.19042C13.7019 0.637155 12.5858 0.270357 11.435 0.103491C10.7516 0.00440265 10.179 0.561473 10.1659 1.25187C10.1528 1.94226 10.7059 2.50202 11.3845 2.6295C12.1384 2.77112 12.8686 3.02803 13.5487 3.39333C14.5973 3.95661 15.4968 4.76141 16.1728 5.74121C16.8488 6.721 17.2819 7.84764 17.4361 9.02796C17.5362 9.79345 17.5172 10.5673 17.3819 11.3223C17.2602 12.002 17.5871 12.7178 18.2372 12.9506Z" stroke="currentStroke" stroke-width="4" mask="url(#path-2-inside-1_3755_26477)"></path>
                                                    </svg>
                                                </span>
                                                Loading user roles...
                                            </p>
                                        </div>

                                        <!-- Empty state -->
                                        <div x-show="!isLoading && userRoles.length === 0" class="p-8 text-center">
                                            <div class="rounded-xl border border-blue-light-500 bg-blue-light-50 p-4 dark:border-blue-light-500/30 dark:bg-blue-light-500/15">
                                                <div class="flex items-start gap-3">
                                                    <div class="-mt-0.5 text-blue-light-500">
                                                        <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.6501 11.9996C3.6501 7.38803 7.38852 3.64961 12.0001 3.64961C16.6117 3.64961 20.3501 7.38803 20.3501 11.9996C20.3501 16.6112 16.6117 20.3496 12.0001 20.3496C7.38852 20.3496 3.6501 16.6112 3.6501 11.9996ZM12.0001 1.84961C6.39441 1.84961 1.8501 6.39392 1.8501 11.9996C1.8501 17.6053 6.39441 22.1496 12.0001 22.1496C17.6058 22.1496 22.1501 17.6053 22.1501 11.9996C22.1501 6.39392 17.6058 1.84961 12.0001 1.84961ZM10.9992 7.52468C10.9992 8.07697 11.4469 8.52468 11.9992 8.52468H12.0002C12.5525 8.52468 13.0002 8.07697 13.0002 7.52468C13.0002 6.9724 12.5525 6.52468 12.0002 6.52468H11.9992C11.4469 6.52468 10.9992 6.9724 10.9992 7.52468ZM12.0002 17.371C11.586 17.371 11.2502 17.0352 11.2502 16.621V10.9445C11.2502 10.5303 11.586 10.1945 12.0002 10.1945C12.4144 10.1945 12.7502 10.5303 12.7502 10.9445V16.621C12.7502 17.0352 12.4144 17.371 12.0002 17.371Z" fill=""></path>
                                                        </svg>
                                                    </div>

                                                    <div>
                                                        <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                                            No User Roles found
                                                        </h4>

                                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                                            Create your first role to manage!
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Table with data -->
                                        <div x-show="!isLoading && userRoles.length > 0">
                                            <table class="w-full table-auto">
                                                <!-- table header start -->
                                                <thead class="border-gray-100 border-y bg-gray-50 dark:border-gray-800 dark:bg-gray-900">
                                                    <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                        <th class="p-4 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                    Role #ID
                                                                </p>
                                                            </div>
                                                        </th>
                                                        <th class="p-4 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                    Role
                                                                </p>
                                                            </div>
                                                        </th>
                                                        <th class="p-4 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                    Created On
                                                                </p>
                                                            </div>
                                                        </th>
                                                        <th class="p-4 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                    Created By
                                                                </p>
                                                            </div>
                                                        </th>
                                                        <th class="p-4 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                    privileges
                                                                </p>
                                                            </div>
                                                        </th>
                                                        <th class="p-4 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                    Status
                                                                </p>
                                                            </div>
                                                        </th>
                                                        <th class="p-4 whitespace-nowrap">
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
                                                    <template x-for="role in paginatedRoles" :key="role.UserRoleID">
                                                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                            <!-- #UserRole ID -->
                                                            <td class="p-4 whitespace-nowrap">
                                                                <div class="group flex items-center gap-3">
                                                                    <h4 class="text-theme-xs font-medium text-gray-700 group-hover:underline dark:text-gray-400"
                                                                        x-text="role.UserRoleID || 'N/A'">
                                                                    </h4>
                                                                </div>
                                                            </td>
                                                            <!-- #Role Name -->
                                                            <td class="p-4 whitespace-nowrap">
                                                                <div class="flex items-center col-span-2">
                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400"
                                                                        x-text="role.userRole || 'N/A'">
                                                                    </p>
                                                                </div>
                                                            </td>
                                                            <!-- #Created on-->
                                                            <td class="p-4 whitespace-nowrap">
                                                                <div class="flex items-center col-span-2">
                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400"
                                                                        x-text="role.user_role_created_on ? formatDate(role.user_role_created_on) : 'N/A'">
                                                                    </p>
                                                                </div>
                                                            </td>
                                                            <!-- #Created By -->
                                                            <td class="p-4 whitespace-nowrap">
                                                                <div class="flex items-center col-span-2">
                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400"
                                                                        x-text="role.creator_name || 'System'">
                                                                    </p>
                                                                </div>
                                                            </td>
                                                            <!-- #Privileges -->
                                                            <td class="p-4 whitespace-nowrap">
                                                                <ul class="divide-y divide-gray-100 dark:divide-gray-800">
                                                                    <!-- Bodaboda Privileges -->
                                                                    <li class="flex items-center gap-5 py-2.5">
                                                                        <span class="w-1/2 text-sm text-gray-500 sm:w-1/3 dark:text-gray-400">Bodaboda</span>
                                                                        <span class="w-1/2 text-sm font-medium text-gray-700 sm:w-2/3 dark:text-gray-400">
                                                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                                <!-- Create -->
                                                                                <template x-if="role.user_role_bodaboda_create">
                                                                                    <span class="text-green-600">Create</span>
                                                                                </template>
                                                                                <template x-if="role.user_role_bodaboda_create && (role.user_role_bodaboda_read || role.user_role_bodaboda_update || role.user_role_bodaboda_delete)">
                                                                                    <span class="text-gray-400"> | </span>
                                                                                </template>

                                                                                <!-- Read -->
                                                                                <template x-if="role.user_role_bodaboda_read">
                                                                                    <span class="text-blue-600">Read</span>
                                                                                </template>
                                                                                <template x-if="role.user_role_bodaboda_read && (role.user_role_bodaboda_update || role.user_role_bodaboda_delete)">
                                                                                    <span class="text-gray-400"> | </span>
                                                                                </template>

                                                                                <!-- Update -->
                                                                                <template x-if="role.user_role_bodaboda_update">
                                                                                    <span class="text-yellow-600">Update</span>
                                                                                </template>
                                                                                <template x-if="role.user_role_bodaboda_update && role.user_role_bodaboda_delete">
                                                                                    <span class="text-gray-400"> | </span>
                                                                                </template>

                                                                                <!-- Delete -->
                                                                                <template x-if="role.user_role_bodaboda_delete">
                                                                                    <span class="text-red-600">Delete</span>
                                                                                </template>

                                                                                <!-- No privileges message -->
                                                                                <template x-if="!role.user_role_bodaboda_create && !role.user_role_bodaboda_read && !role.user_role_bodaboda_update && !role.user_role_bodaboda_delete">
                                                                                    <span class="text-gray-400">No permissions</span>
                                                                                </template>
                                                                            </p>
                                                                        </span>
                                                                    </li>

                                                                    <!-- Loans Privileges -->
                                                                    <li class="flex items-center gap-5 py-2.5">
                                                                        <span class="w-1/2 text-sm text-gray-500 sm:w-1/3 dark:text-gray-400">Loans</span>
                                                                        <span class="w-1/2 text-sm font-medium text-gray-700 sm:w-2/3 dark:text-gray-400">
                                                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                                <!-- Create -->
                                                                                <template x-if="role.user_role_loans_create">
                                                                                    <span class="text-green-600">Create</span>
                                                                                </template>
                                                                                <template x-if="role.user_role_loans_create && (role.user_role_loans_read || role.user_role_loans_update || role.user_role_loans_delete)">
                                                                                    <span class="text-gray-400"> | </span>
                                                                                </template>

                                                                                <!-- Read -->
                                                                                <template x-if="role.user_role_loans_read">
                                                                                    <span class="text-blue-600">Read</span>
                                                                                </template>
                                                                                <template x-if="role.user_role_loans_read && (role.user_role_loans_update || role.user_role_loans_delete)">
                                                                                    <span class="text-gray-400"> | </span>
                                                                                </template>

                                                                                <!-- Update -->
                                                                                <template x-if="role.user_role_loans_update">
                                                                                    <span class="text-yellow-600">Update</span>
                                                                                </template>
                                                                                <template x-if="role.user_role_loans_update && role.user_role_loans_delete">
                                                                                    <span class="text-gray-400"> | </span>
                                                                                </template>

                                                                                <!-- Delete -->
                                                                                <template x-if="role.user_role_loans_delete">
                                                                                    <span class="text-red-600">Delete</span>
                                                                                </template>

                                                                                <!-- No privileges message -->
                                                                                <template x-if="!role.user_role_loans_create && !role.user_role_loans_read && !role.user_role_loans_update && !role.user_role_loans_delete">
                                                                                    <span class="text-gray-400">No permissions</span>
                                                                                </template>
                                                                            </p>
                                                                        </span>
                                                                    </li>

                                                                    <!-- Real Estate Privileges -->
                                                                    <li class="flex items-center gap-5 py-2.5">
                                                                        <span class="w-1/2 text-sm text-gray-500 sm:w-1/3 dark:text-gray-400">Real Estate</span>
                                                                        <span class="w-1/2 text-sm font-medium text-gray-700 sm:w-2/3 dark:text-gray-400">
                                                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                                <!-- Create -->
                                                                                <template x-if="role.user_role_lands_create">
                                                                                    <span class="text-green-600">Create</span>
                                                                                </template>
                                                                                <template x-if="role.user_role_lands_create && (role.user_role_lands_read || role.user_role_lands_update || role.user_role_lands_delete)">
                                                                                    <span class="text-gray-400"> | </span>
                                                                                </template>

                                                                                <!-- Read -->
                                                                                <template x-if="role.user_role_lands_read">
                                                                                    <span class="text-blue-600">Read</span>
                                                                                </template>
                                                                                <template x-if="role.user_role_lands_read && (role.user_role_lands_update || role.user_role_lands_delete)">
                                                                                    <span class="text-gray-400"> | </span>
                                                                                </template>

                                                                                <!-- Update -->
                                                                                <template x-if="role.user_role_lands_update">
                                                                                    <span class="text-yellow-600">Update</span>
                                                                                </template>
                                                                                <template x-if="role.user_role_lands_update && role.user_role_lands_delete">
                                                                                    <span class="text-gray-400"> | </span>
                                                                                </template>

                                                                                <!-- Delete -->
                                                                                <template x-if="role.user_role_lands_delete">
                                                                                    <span class="text-red-600">Delete</span>
                                                                                </template>

                                                                                <!-- No privileges message -->
                                                                                <template x-if="!role.user_role_lands_create && !role.user_role_lands_read && !role.user_role_lands_update && !role.user_role_lands_delete">
                                                                                    <span class="text-gray-400">No permissions</span>
                                                                                </template>
                                                                            </p>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            <!-- #Status -->
                                                            <td class="p-4 whitespace-nowrap">
                                                                <div class="flex items-center col-span-2">
                                                                    <!-- Active -->
                                                                    <template x-if="role.Status === 'Active'">
                                                                        <p class="bg-success-50 text-theme-xs text-success-700 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">
                                                                            Active
                                                                        </p>
                                                                    </template>
                                                                    <!-- Pending -->
                                                                    <template x-if="role.Status === 'Pending'">
                                                                        <p class="bg-warning-50 text-theme-xs text-warning-700 dark:bg-warning-500/15 dark:text-warning-500 rounded-full px-2 py-0.5 font-medium">
                                                                            Pending
                                                                        </p>
                                                                    </template>
                                                                    <!-- Suspended -->
                                                                    <template x-if="role.Status === 'Suspended'">
                                                                        <p class="bg-error-50 text-theme-xs text-error-700 dark:bg-error-500/15 dark:text-error-500 rounded-full px-2 py-0.5 font-medium">
                                                                            Suspended
                                                                        </p>
                                                                    </template>
                                                                    <!-- No status -->
                                                                    <template x-if="!role.Status">
                                                                        <p class="bg-gray-50 text-theme-xs text-gray-700 dark:bg-gray-500/15 dark:text-gray-500 rounded-full px-2 py-0.5 font-medium">
                                                                            N/A
                                                                        </p>
                                                                    </template>
                                                                </div>
                                                            </td>
                                                            <!-- #Actions -->
                                                            <td class="p-4 whitespace-nowrap">
                                                                <div class="flex items-center col-span-2">
                                                                    <button @click="openEditModal(role)"
                                                                            class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                        <svg class="w-[22px] h-[22px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                            <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="1.1" d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                                <!-- table body end -->
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Pagination -->
                                    <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                                        <div class="flex justify-center pb-4 sm:hidden">
                                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                Showing
                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntry"></span>
                                                to
                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntry"></span>
                                                of
                                                <span class="text-gray-800 dark:text-white/90" x-text="userRoles.length"></span>
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
                                                    <span class="text-gray-800 dark:text-white/90" x-text="userRoles.length"></span>
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
                                                                d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 9.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z"
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
    <!-- New User Modal -->
    <div x-show="newUserModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999" >
      <div @click="newUserModal = false" class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
      <div @click.outside="newUserModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="newUserModal = false"
                class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
          <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill=""/>
          </svg>
        </button>

        <div class="px-2 pr-14">
          <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
            New User
          </h4>
          <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
            Create a new system user.
          </p>
        </div>

        <div class="flex flex-col h-full px-2 pr-14">
            <form action="/users/create" method="POST" x-data="createUserForm" @submit.prevent="submitForm()">
                @csrf
                <div class="-mx-2.5 flex flex-wrap gap-y-5">
                    <!-- First Name -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            First Name
                        </label>
                        <input type="text" id="first_name" name="first_name"
                            x-model="firstName"
                            @input="clearError('firstName')"
                            @blur="validateField('firstName')"
                            :class="errors.firstName ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>

                    <!-- Last Name -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Last Name
                        </label>
                        <input type="text" id="last_name" name="last_name"
                            x-model="lastName"
                            @input="clearError('lastName')"
                            @blur="validateField('lastName')"
                            :class="errors.lastName ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>

                    <!-- Gender -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Gender
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="gender" name="gender"
                                    x-model="gender"
                                    @change="clearError('gender')"
                                    @blur="validateField('gender')"
                                    :class="errors.gender ? 'border-red-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
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

                    <!-- Date of Birth -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Date of Birth
                        </label>
                        <div class="relative">
                            <input type="text" id="dob" name="dob"
                                x-model="dateOfBirth"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 flatpickr-input">
                            <span class="absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z" fill=""></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="w-full px-2.5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Email
                        </label>
                        <input type="email" id="email" name="email"
                            x-model="email"
                            @input="clearError('email')"
                            @blur="validateField('email')"
                            :class="errors.email ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>

                    <!-- National ID -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            National ID
                        </label>
                        <input type="text" id="national_id" name="national_id"
                            x-model="nationalId"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>

                    <!-- Phone -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Phone
                        </label>
                        <input type="text" id="phone" name="phone"
                            x-model="phone"
                            @input="clearError('phone')"
                            @blur="validateField('phone')"
                            :class="errors.phone ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>

                    <!-- User Role -->
                    <div class="w-full px-2.5">
                        <h3 class="text-normal font-semibold text-gray-500 dark:text-white/90 mb-2">User Role</h3>
                        <div class="relative z-20 bg-transparent">
                            <select id="user_role" name="user_role"
                                    x-model="userRole"
                                    @change="clearError('userRole')"
                                    @blur="validateField('userRole')"
                                    :class="errors.userRole ? 'border-red-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Assign Role</option>
                                <option value="Chairman">Chairman</option>
                                <option value="Secretary General">Secretary General</option>
                                <option value="Treasurer">Treasurer</option>
                                <option value="Stage Manager">Stage Manager</option>
                                <option value="Secretary">Secretary</option>
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Password
                        </label>
                        <div x-data="{ showPassword: false }" class="relative">
                            <input :type="showPassword ? 'text' : 'password'"
                                id="password" name="password"
                                x-model="password"
                                @input="clearError('password')"
                                @blur="validateField('password')"
                                :class="errors.password ? 'border-red-500' : ''"
                                placeholder="Create Password" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                                <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"></path>
                                </svg>
                                <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Confirm Password
                        </label>
                        <div x-data="{ showPassword: false }" class="relative">
                            <input :type="showPassword ? 'text' : 'password'"
                                id="password_confirmation" name="password_confirmation"
                                x-model="confirmPassword"
                                @input="clearError('confirmPassword')"
                                @blur="validateField('confirmPassword')"
                                :class="errors.confirmPassword ? 'border-red-500' : ''"
                                placeholder="Confirm Password" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                                <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"></path>
                                </svg>
                                <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Cancel and Update buttons at bottom right -->
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                    <button type="button" @click="newUserModal = false"
                            class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                        Cancel
                    </button>
                    <button type="submit" :disabled="isSubmitting" :class="isSubmitting ? 'opacity-70 cursor-not-allowed' : ''" class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                        <span x-show="!isSubmitting">Add User</span>
                        <span x-show="isSubmitting" class="flex items-center">
                            Creating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
      </div>
    </div>
    <!-- Edit User Modal -->
    <div x-show="$store.userModal.editUserModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div @click="$store.userModal.editUserModal = false" class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>

        <div @click.outside="editUserModal = false" class="relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="$store.userModal.editUserModal = false"
                    class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill=""></path>
                    </svg>
            </button>

            <div class="px-2 pr-14">
                <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                    User Account
                </h4>
                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
                    Update user details
                </p>
            </div>

            <div class="rounded-xl border border-gray-200 p-6 dark:border-gray-800" x-data="{ activeTab: 'user-details' }">
                <div class="border-b border-gray-200 dark:border-gray-800">
                    <nav class="-mb-px flex space-x-2 overflow-x-auto [&amp;::-webkit-scrollbar-thumb]:rounded-full [&amp;::-webkit-scrollbar-thumb]:bg-gray-200 dark:[&amp;::-webkit-scrollbar-thumb]:bg-gray-600 dark:[&amp;::-webkit-scrollbar-track]:bg-transparent [&amp;::-webkit-scrollbar]:h-1.5">
                        <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400"
                            x-bind:class="activeTab === 'user-details' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                            x-on:click="activeTab = 'user-details'">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-5">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z" fill="currentColor"></path>
                            </svg>
                            User Details
                        </button>
                        <button class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400"
                            x-bind:class="activeTab === 'user-security' ? ' text-brand-500 border-brand-500  dark:border-brand-400  dark:text-brand-400' : 'bg-transparent text-gray-500 border-transparent  hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                            x-on:click="activeTab = 'user-security'">
                            <svg class="size-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.7487 2.29248C10.7487 1.87827 10.4129 1.54248 9.9987 1.54248C9.58448 1.54248 9.2487 1.87827 9.2487 2.29248V2.83613C6.08132 3.20733 3.6237 5.9004 3.6237 9.16748V14.4591H3.33203C2.91782 14.4591 2.58203 14.7949 2.58203 15.2091C2.58203 15.6234 2.91782 15.9591 3.33203 15.9591H4.3737H15.6237H16.6654C17.0796 15.9591 17.4154 15.6234 17.4154 15.2091C17.4154 14.7949 17.0796 14.4591 16.6654 14.4591H16.3737V9.16748C16.3737 5.9004 13.9161 3.20733 10.7487 2.83613V2.29248ZM14.8737 14.4591V9.16748C14.8737 6.47509 12.6911 4.29248 9.9987 4.29248C7.30631 4.29248 5.1237 6.47509 5.1237 9.16748V14.4591H14.8737ZM7.9987 17.7085C7.9987 18.1228 8.33448 18.4585 8.7487 18.4585H11.2487C11.6629 18.4585 11.9987 18.1228 11.9987 17.7085C11.9987 17.2943 11.6629 16.9585 11.2487 16.9585H8.7487C8.33448 16.9585 7.9987 17.2943 7.9987 17.7085Z" fill="currentColor"></path>
                            </svg>
                            Account Security
                        </button>
                    </nav>
                </div>

                <div class="pt-4 dark:border-gray-800">
                    <div x-show="activeTab === 'user-details'">
                        <h3 class="mb-1 text-xl font-medium text-gray-600 dark:text-white/90">
                            User Settings
                        </h3>
                        <div class="flex flex-col h-full px-2 pr-14">
                            <form action="" method="POST" x-data="editUserForm()" @submit.prevent="submitProfileUpdate">
                                @csrf
                                <div class="-mx-2.5 flex flex-wrap gap-y-5">

                                    <!-- Hidden user id component -->
                                    <input type="hidden" name="user_id" x-model="userId">
                                    <!-- First Name -->
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        First Name
                                        </label>
                                        <input type="text" id="u_first_name" name="u_first_name"
                                            x-model="$store.userModal.editForm.firstName"
                                            placeholder="Enter first name"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    </div>

                                    <!-- Last Name -->
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Last Name
                                        </label>
                                        <input type="text" id="u_last_name" name="u_last_name"
                                            x-model="$store.userModal.editForm.lastName"
                                            placeholder="Enter last name"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    </div>

                                    <!-- Gender -->
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Gender
                                        </label>
                                        <div class="relative z-20 bg-transparent">
                                            <select x-model="$store.userModal.editForm.gender" id="u_gender" name="u_gender"
                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
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

                                    <!-- Date of Birth -->
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Date of Birth
                                        </label>
                                        <div class="relative">
                                            <input type="text" id="u_dob" name="u_dob"
                                                    x-model="$store.userModal.editForm.dob"
                                                    placeholder="YYYY-MM-DD"
                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 flatpickr-input">
                                            <span class="absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z" fill=""></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="w-full px-2.5">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Email
                                        </label>
                                        <input type="email" id="u_email" name="u_email"
                                            x-model="$store.userModal.editForm.email"
                                            placeholder="Enter email address"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    </div>

                                    <!-- National ID -->
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        National ID
                                        </label>
                                        <input type="text" id="u_national_id" name="u_national_id"
                                            x-model="$store.userModal.editForm.nationalId"
                                            placeholder="Enter national ID"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    </div>

                                    <!-- Phone -->
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Phone
                                        </label>
                                        <input type="text" id="u_phone" name="u_phone"
                                            x-model="$store.userModal.editForm.phone"
                                            placeholder="Enter phone number"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    </div>

                                    <!-- User role Section -->
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <h3 class="text-normal font-semibold text-gray-500 dark:text-white/90 mb-2">User Role</h3>
                                        <div class="relative z-20 bg-transparent">
                                        <select x-model="$store.userModal.editForm.userRole" id="u_role" name="u_role"
                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                            <option value="">Assign Role</option>
                                            <option value="Chairman">Chairman</option>
                                            <option value="Secretary General">Secretary General</option>
                                            <option value="Treasurer">Treasurer</option>
                                            <option value="Stage Manager">Stage Manager</option>
                                            <option value="Secretary">Secretary</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Coordinator">Coordinator</option>
                                        </select>
                                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                        </div>
                                    </div>

                                    <!-- User status Section -->
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <h3 class="text-normal font-semibold text-gray-500 dark:text-white/90 mb-2">Account Status</h3>
                                        <div class="relative z-20 bg-transparent">
                                            <select x-model="$store.userModal.editForm.userStatus" id="u_status" name="u_status"
                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                <option value="">Status</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">In-Active</option>
                                                <option value="Suspended">Suspended</option>
                                                <option value="Removed">Removed</option>
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
                                    <button type="button" @click="$store.userModal.editUserModal = false"  id="" name=""
                                            class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                        Cancel
                                    </button>
                                    <button type="button" @click="deleteUser()" :disbled="isDeleteing"
                                            class="rounded-lg border border-error-300 bg-white px-5 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                        <span x-show="!isDeleting">Delete</span>
                                        <span x-show="isDeleting">Deleting ... </span>
                                    </button>
                                    <button type="submit" :disabled="isUpdating"
                                            class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                                        <span x-show="!isUpdating">Update</span>
                                        <span x-show="isUpdating">Updating...</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div x-show="activeTab === 'user-security'" style="display: none;">
                        <h3 class="mb-1 text-xl font-medium text-gray-800 dark:text-white/90">
                            Account Security
                        </h3>
                        <div class="flex flex-col h-full px-2 pr-14">
                            <form action="" method="POST" x-data="passwordResetForm()" @submit.prevent="submitPasswordReset">
                                @csrf
                                <div class="-mx-2.5 flex flex-wrap gap-y-5">

                                    <!-- Hidden user id component -->
                                    <input type="hidden" name="user_id" x-model="userId">

                                    <!-- Password -->
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Password
                                        </label>
                                        <div x-data="{ showPassword: false }" class="relative">
                                            <input :type="showPassword ? 'text' : 'password'"
                                                id="u_password" name="u_password"
                                                x-model="password"
                                                @input="validatePassword()"
                                                @blur="validatePassword()"
                                                :class="errors.password ? 'border-red-500' : ''"
                                                placeholder="Create Password" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                            <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                                                <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"></path>
                                                </svg>
                                                <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Confirm Password
                                        </label>
                                        <div x-data="{ showPassword: false }" class="relative">
                                            <input :type="showPassword ? 'text' : 'password'"
                                                id="u_password_confirmation" name="u_password_confirmation"
                                                x-model="confirmPassword"
                                                @input="validateMatch()"
                                                @blur="validateMatch()"
                                                :class="errors.confirmPassword ? 'border-red-500' : ''"
                                                placeholder="Confirm Password" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                            <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                                                <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"></path>
                                                </svg>
                                                <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h4 class="mb-2 text-medium font-semibold text-gray-600 dark:text-white/90">
                                        Password Requirements
                                    </h4>

                                    <!-- Vertical list - no columns, no grid, just stacked items -->
                                    <div class="space-y-2">
                                        <!-- Minimum 8 characters -->
                                        <p :class="requirements.minLength ? 'text-success-500' : 'text-error-700'"
                                        class="flex items-center gap-2 text-sm">
                                            <template x-if="requirements.minLength">
                                                <svg class="text-success-500" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M13.4017 4.35986L6.12166 11.6399L2.59833 8.11657"></path>
                                                </svg>
                                            </template>
                                            <template x-if="!requirements.minLength">
                                                <svg class="text-error-700" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M4 4L12 12M12 4L4 12"></path>
                                                </svg>
                                            </template>
                                            Minimum 8 characters
                                        </p>

                                        <!-- Special character -->
                                        <p :class="requirements.specialChar ? 'text-success-500' : 'text-error-700'"
                                        class="flex items-center gap-2 text-sm">
                                            <template x-if="requirements.specialChar">
                                                <svg class="text-success-500" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M13.4017 4.35986L6.12166 11.6399L2.59833 8.11657"></path>
                                                </svg>
                                            </template>
                                            <template x-if="!requirements.specialChar">
                                                <svg class="text-error-700" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M4 4L12 12M12 4L4 12"></path>
                                                </svg>
                                            </template>
                                            Special character
                                        </p>

                                        <!-- Capital letter -->
                                        <p :class="requirements.capitalLetter ? 'text-success-500' : 'text-error-700'"
                                        class="flex items-center gap-2 text-sm">
                                            <template x-if="requirements.capitalLetter">
                                                <svg class="text-success-500" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M13.4017 4.35986L6.12166 11.6399L2.59833 8.11657"></path>
                                                </svg>
                                            </template>
                                            <template x-if="!requirements.capitalLetter">
                                                <svg class="text-error-700" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M4 4L12 12M12 4L4 12"></path>
                                                </svg>
                                            </template>
                                            A capital letter
                                        </p>

                                        <!-- A lower Case letter -->
                                        <p :class="requirements.lowerCase ? 'text-success-500' : 'text-error-700'"
                                        class="flex items-center gap-2 text-sm">
                                            <template x-if="requirements.lowerCase">
                                                <svg class="text-success-500" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M13.4017 4.35986L6.12166 11.6399L2.59833 8.11657"></path>
                                                </svg>
                                            </template>
                                            <template x-if="!requirements.lowerCase">
                                                <svg class="text-error-700" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M4 4L12 12M12 4L4 12"></path>
                                                </svg>
                                            </template>
                                            A lower Case letter
                                        </p>

                                        <!-- A number -->
                                        <p :class="requirements.numbers ? 'text-success-500' : 'text-error-700'"
                                        class="flex items-center gap-2 text-sm">
                                            <template x-if="requirements.numbers">
                                                <svg class="text-success-500" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M13.4017 4.35986L6.12166 11.6399L2.59833 8.11657"></path>
                                                </svg>
                                            </template>
                                            <template x-if="!requirements.numbers">
                                                <svg class="text-error-700" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M4 4L12 12M12 4L4 12"></path>
                                                </svg>
                                            </template>
                                            A number
                                        </p>

                                        <!-- Match Password -->
                                        <p :class="requirements.matchPassword ? 'text-success-500' : 'text-error-700'"
                                        class="flex items-center gap-2 text-sm">
                                            <template x-if="requirements.matchPassword">
                                                <svg class="text-success-500" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M13.4017 4.35986L6.12166 11.6399L2.59833 8.11657"></path>
                                                </svg>
                                            </template>
                                            <template x-if="!requirements.matchPassword">
                                                <svg class="text-error-700" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M4 4L12 12M12 4L4 12"></path>
                                                </svg>
                                            </template>
                                            Match Password
                                        </p>
                                    </div>
                                </div>

                                <!-- Cancel and Update buttons at bottom right -->
                                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                                    <button type="button" @click="$store.userModal.editUserModal = false"
                                            class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                            :disabled="isResettingPassword"
                                            class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                                        <span x-show="!isResettingPassword">Reset Password</span>
                                        <span x-show="isResettingPassword">Resetting...</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- New Role -->
    <div x-show="newUserRoleModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
      <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
      <div @click.outside="newUserRoleModal = false"
           class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="newUserRoleModal = false"
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
        <!-- Create User role form - ONLY ADDED ATTRIBUTES -->
        <form method="POST" action="{{ route('user-roles.create') }}" x-data="newRoleForm()" @submit="submitForm($event)">
            @csrf
          <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
          Create new role
          </h4>


          <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

            <div class="col-span-1">
              <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                User Role
              </label>
              <!-- ADDED: name="role_name" -->
              <input type="text" id="role_name" name="role_name" placeholder="Enter new user role name" class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
            </div>

            <div class="col-span-1">
              <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Status
              </label>
              <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                <!-- ADDED: name="status" -->
                <select name="status" id="status" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'" @change="isOptionSelected = true">
                  <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                    Change Role Status
                  </option>
                  <option value="Active" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                    Active
                  </option>
                    <option value="Pending" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                    Pending
                  </option>
                  <option value="Suspended" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                    Suspended
                  </option>
                </select>
                <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                          <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                        </span>
              </div>
            </div>

            <div class="col-span-1 sm:col-span-2">
              <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Privileges
              </label>
              <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full">
                  <!-- table header start -->
                  <thead>
                  <tr>
                    <th class="px-6 py-3 whitespace-nowrap first:pl-0">
                      <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                          MODULE
                        </p>
                      </div>
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                      <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                          Create
                        </p>
                      </div>
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                      <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                          Read
                        </p>
                      </div>
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                      <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                          Update
                        </p>
                      </div>
                    </th>
                    <th class="px-6 py-3 whitespace-nowrap">
                      <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                          Delete
                        </p>
                      </div>
                    </th>
                  </tr>
                  </thead>
                  <!-- table header end -->

                  <!-- table body start -->
                  <tbody class="py-3 divide-y divide-gray-100 dark:divide-gray-800">
                    <!-- Bodaboda Module -->
                    <tr>
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <div class="flex items-center col-span-2">
                          <div class="flex items-center gap-3">
                            <div>
                              <p class="text-xs font-sm text-gray-700 dark:text-gray-400">
                                Bodaboda
                              </p>
                            </div>
                          </div>
                        </div>
                      </td>

                      <!-- Create -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="bodaboda_create" value="1" -->
                        <input type="checkbox" name="bodaboda_create" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="create-boda">
                      </td>
                      <!-- Read -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="bodaboda_read" value="1" -->
                        <input type="checkbox" name="bodaboda_read" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="read-boda">
                      </td>
                      <!-- Update -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="bodaboda_update" value="1" -->
                        <input type="checkbox" name="bodaboda_update" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="update-boda">
                      </td>
                      <!-- Delete -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="bodaboda_delete" value="1" -->
                        <input type="checkbox" name="bodaboda_delete" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="delete-boda">
                      </td>
                    </tr>
                    <!-- Loans Module -->
                    <tr>
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <div class="flex items-center col-span-4">
                          <div class="flex items-center gap-3">
                            <div>
                              <p class="text-xs font-sm text-gray-700 dark:text-gray-400">
                                Loans
                              </p>
                            </div>
                          </div>
                        </div>
                      </td>
                      <!-- Create -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="loans_create" value="1" -->
                        <input type="checkbox" name="loans_create" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="create-loans">
                      </td>
                      <!-- Read -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="loans_read" value="1" -->
                        <input type="checkbox" name="loans_read" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="read-loans">
                      </td>
                      <!-- Update -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="loans_update" value="1" -->
                        <input type="checkbox" name="loans_update" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="update-loans">
                      </td>
                      <!-- Delete -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="loans_delete" value="1" -->
                        <input type="checkbox" name="loans_delete" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="delete-loans">
                      </td>
                    </tr>
                    <!-- Real Estate Module -->
                    <tr>
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <div class="flex items-center col-span-4">
                          <div class="flex items-center gap-3">
                            <div>
                              <p class="text-xs font-sm text-gray-700 dark:text-gray-400">
                                Real Estate
                              </p>
                            </div>
                          </div>
                        </div>
                      </td>
                      <!-- Create -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="lands_create" value="1" -->
                        <input type="checkbox" name="lands_create" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="create-lands">
                      </td>
                      <!-- Read -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="lands_read" value="1" -->
                        <input type="checkbox" name="lands_read" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="read-lands">
                      </td>
                      <!-- Update -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="lands_update" value="1" -->
                        <input type="checkbox" name="lands_update" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="update-lands">
                      </td>
                      <!-- Delete -->
                      <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                        <!-- ADDED: name="lands_delete" value="1" -->
                        <input type="checkbox" name="lands_delete" value="1" class="h-5 w-5 rounded border-gray-300 text-brand-500" id="delete-lands">
                      </td>
                    </tr>
                  </tbody>

                  <!-- table body end -->
                </table>
              </div>
            </div>

          </div>

          <div class="flex items-center justify-end w-full gap-3 mt-6">
            <button @click="newUserRoleModal = false" type="button" class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:w-auto">
              Cancel
            </button>
            <!-- ADDED: type="submit" name="create_role" -->
            <button type="submit" name="create_role" class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                <span x-show="!isSubmitting">Create Role</span>
                <span x-show="isSubmitting">Creating Role...</span>
            </button>
          </div>
        </form>
      </div>
    </div>
    <!-- Edit Role Modal -->
    <div x-show="$store.userRoleModal.editUserRoleModal"
        x-cloak
        class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
      <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
      <div @click.outside="$store.userRoleModal.editUserRoleModal = false" class="relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="$store.userRoleModal.editUserRoleModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
          <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" fill=""/>
          </svg>
        </button>
        <div class="px-2 pr-14">
          <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
            Edit Role
          </h4>
          <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
            Review and edit the <span x-text="$store.userRoleModal.currentRole?.userRole || ''" class="text-brand-500"></span> role as you please.
          </p>
        </div>
        <!-- Edit User role form -->
        <form @submit="submitForm($event)" action="" method="POST" x-data="editRoleForm()">
            @csrf

                <div>
                    <input type="text" value="$store.userRoleModal.currentRole?.UserRoleID" name="e_role_id" id="e_role_id" readonly hidden/>
                </div>

            <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
                <span x-text="'USRL ' + $store.userRoleModal.currentRole?.UserRoleID || ''" class="text-brand-500"></span>
            </h4>

            <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                <div class="col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        User Role
                    </label>
                    <input type="text"
                            x-model="$store.userRoleModal.editForm.userRole"
                            name="user_role" id="user_role"
                            placeholder="Enter new user role name"
                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                </div>

                <div class="col-span-1">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Status
                </label>
                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                    <select x-model="$store.userRoleModal.editForm.status"
                            @change="isOptionSelected = true"
                            name="status" id="status"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            :class="isOptionSelected && 'text-gray-800 dark:text-white/90'">
                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                        Change Role Status
                    </option>
                    <option value="Active" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                        Active
                    </option>
                    <option value="Pending" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                        Pending
                    </option>
                    <option value="Suspended" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                        Suspended
                    </option>
                    </select>
                    <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    </span>
                </div>
                </div>

                <div class="col-span-1 sm:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Privileges
                </label>
                <div class="max-w-full overflow-x-auto custom-scrollbar">
                    <table class="w-full">
                    <!-- table header start -->
                    <thead>
                        <tr>
                        <th class="px-6 py-3 whitespace-nowrap first:pl-0">
                            <div class="flex items-center">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                MODULE
                            </p>
                            </div>
                        </th>
                        <th class="px-6 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Create
                            </p>
                            </div>
                        </th>
                        <th class="px-6 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Read
                            </p>
                            </div>
                        </th>
                        <th class="px-6 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Update
                            </p>
                            </div>
                        </th>
                        <th class="px-6 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Delete
                            </p>
                            </div>
                        </th>
                        </tr>
                    </thead>
                    <!-- table header end -->

                    <!-- table body start -->
                    <tbody class="py-3 divide-y divide-gray-100 dark:divide-gray-800">
                        <!-- Bodaboda Module -->
                        <tr>
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <div class="flex items-center col-span-2">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400">
                                                Bodaboda
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Create -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_bodaboda_create"
                                    id="e-create-boda"
                                    :checked="$store.userRoleModal.currentRole?.user_role_bodaboda_create || false"
                                    @change="$store.userRoleModal.currentRole.user_role_bodaboda_create = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                            <!-- Read -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_bodaboda_read"
                                    id="e-read-boda"
                                    :checked="$store.userRoleModal.currentRole?.user_role_bodaboda_read || false"
                                    @change="$store.userRoleModal.currentRole.user_role_bodaboda_read = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                            <!-- Update -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_bodaboda_update"
                                    id="e-update-boda"
                                    :checked="$store.userRoleModal.currentRole?.user_role_bodaboda_update || false"
                                    @change="$store.userRoleModal.currentRole.user_role_bodaboda_update = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                            <!-- Delete -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_bodaboda_delete"
                                    id="e-delete-boda"
                                    :checked="$store.userRoleModal.currentRole?.user_role_bodaboda_delete || false"
                                    @change="$store.userRoleModal.currentRole.user_role_bodaboda_delete = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                        </tr>

                        <!-- Loans Module -->
                        <tr>
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <div class="flex items-center col-span-4">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400">
                                                Loans
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <!-- Create -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_loans_create"
                                    id="e-create-loans"
                                    :checked="$store.userRoleModal.currentRole?.user_role_loans_create || false"
                                    @change="$store.userRoleModal.currentRole.user_role_loans_create = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                            <!-- Read -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_loans_read"
                                    id="e-read-loans"
                                    :checked="$store.userRoleModal.currentRole?.user_role_loans_read || false"
                                    @change="$store.userRoleModal.currentRole.user_role_loans_read = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                            <!-- Update -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_loans_update"
                                    id="e-update-loans"
                                    :checked="$store.userRoleModal.currentRole?.user_role_loans_update || false"
                                    @change="$store.userRoleModal.currentRole.user_role_loans_update = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                            <!-- Delete -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_loans_delete"
                                    id="e-delete-loans"
                                    :checked="$store.userRoleModal.currentRole?.user_role_loans_delete || false"
                                    @change="$store.userRoleModal.currentRole.user_role_loans_delete = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                        </tr>

                        <!-- Real Estate Module -->
                        <tr>
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <div class="flex items-center col-span-4">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400">
                                                Real Estate
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <!-- Create -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_lands_create"
                                    id="e-create-lands"
                                    :checked="$store.userRoleModal.currentRole?.user_role_lands_create || false"
                                    @change="$store.userRoleModal.currentRole.user_role_lands_create = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                            <!-- Read -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_lands_read"
                                    id="e-read-lands"
                                    :checked="$store.userRoleModal.currentRole?.user_role_lands_read || false"
                                    @change="$store.userRoleModal.currentRole.user_role_lands_read = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                            <!-- Update -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_lands_update"
                                    id="e-update-lands"
                                    :checked="$store.userRoleModal.currentRole?.user_role_lands_update || false"
                                    @change="$store.userRoleModal.currentRole.user_role_lands_update = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                            <!-- Delete -->
                            <td class="px-6 py-3 whitespace-nowrap first:pl-0">
                                <input type="checkbox"
                                    name="user_role_lands_delete"
                                    id="e-delete-lands"
                                    :checked="$store.userRoleModal.currentRole?.user_role_lands_delete || false"
                                    @change="$store.userRoleModal.currentRole.user_role_lands_delete = $event.target.checked"
                                    class="h-5 w-5 rounded border-gray-300 text-brand-500">
                            </td>
                        </tr>

                    </tbody>
                    <!-- table body end -->
                    </table>
                </div>
                </div>
            </div>

            <div class="flex items-center justify-end w-full gap-3 mt-6">
                <button @click="$store.userRoleModal.editUserRoleModal = false"
                        type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:w-auto">
                Cancel
                </button>
                <button type="button"
                    @click="deleteRole()"
                    :disabled="isDeleting"
                    class="rounded-lg border border-error-300 bg-white px-5 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    <span x-show="!isDeleting">Delete</span>
                    <span x-show="isDeleting">Deleting...</span>
                </button>
                <!-- Update Button -->
                <button
                    type="submit"
                    :disabled="isSubmitting"
                    class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                    <span x-show="!isSubmitting">Update</span>
                    <span x-show="isSubmitting">Updating...</span>
                </button>
            </div>
        </form>

      </div>
    </div>

    <!-- =========== Alert Modals ============ -->
    <!-- Success Modal -->
    <div x-show="$store.userRoleModal.showSuccessModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
      <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm mx-4">
        <div class="text-center">
          <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
            <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Success!</h3>
          <p class="mt-2 text-sm text-gray-500 dark:text-gray-400" x-text="$store.userRoleModal.successMessage"></p>
          <div class="mt-6">
            <button @click="$store.userRoleModal.showSuccessModal = false"
                    class="inline-flex justify-center rounded-lg border border-transparent bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none">
              OK
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- END MODALS -->


    <script defer src="{{ asset('assets/bundle.js') }}"></script>
    <!-- Scripts -->
    <script>
        document.addEventListener('alpine:init', () => {
            // 0. Load user roles to drop downs:
            Alpine.store('userRolesStore', {
                roles: [],

                async loadRoles() {
                    try {
                        const response = await fetch('/user-roles/all');
                        const data = await response.json();

                        if (data.userRoles && Array.isArray(data.userRoles)) {
                            this.roles = data.userRoles.map(role => role.user_role);
                        }
                    } catch (error) {
                        console.error('Error loading user roles:', error);
                    }
                }
            });

            // Load roles immediately
            Alpine.store('userRolesStore').loadRoles();

            // 1. SIMPLE STATS STORE - One fetch, update store
            Alpine.store('userStats', {
                totalUsers: 0,
                activeUsers: 0,
                totalRoles: 0,

                async loadStats() {
                    try {
                        const response = await fetch('/users/dashboard-stats');
                        const data = await response.json();

                        if (data.success) {
                            this.totalUsers = data.data.total_users || 0;
                            this.activeUsers = data.data.active_users || 0;
                            this.totalRoles = data.data.total_roles || 0;
                        }

                    } catch (error) {
                        console.error('Error loading user stats:', error);
                    }
                }
            });

            // Load stats immediately
            Alpine.store('userStats').loadStats();

            // 2. USERS TABLE - Keep existing logic, just clean up
            Alpine.data('usersTableFull', () => ({
                allRows: [],
                page: 1,
                perPage: 10,
                selectedRole: 'All Users',
                isLoading: true,

                init() {
                    this.fetchUsersData();
                },

                async fetchUsersData() {
                    try {
                        const response = await fetch('/users/all');
                        const data = await response.json();

                        if (data.users && Array.isArray(data.users)) {
                            this.allRows = data.users.map(user => ({
                                id: user.id,
                                userId: "usr" + user.id.toString().padStart(6, '0'),
                                firstName: user.first_name,
                                lastName: user.last_name,
                                email: user.email,
                                gender: user.gender,
                                phone: user.phone,
                                nationalId: user.national_id,
                                dob: user.date_of_birth,
                                userRole: user.role,
                                userStatus: user.status,
                                joinedOn: user.created_at ? new Date(user.created_at).toLocaleDateString('en-US', {
                                    day: '2-digit',
                                    month: 'short',
                                    year: '2-digit',
                                    hour: '2-digit',
                                    minute: '2-digit'
                                }).replace(',', '') : 'N/A',
                                lastLogin: 'N/A'
                            }));
                        }

                        this.isLoading = false;

                    } catch (error) {
                        console.error('Error fetching users:', error);
                        this.isLoading = false;
                    }
                },

                // KEEP ALL EXISTING TABLE METHODS - DON'T CHANGE
                get filteredRows() {
                    if (this.selectedRole === 'All Users') {
                        return this.allRows;
                    }
                    return this.allRows.filter(row => row.userRole === this.selectedRole);
                },

                get userRoles() {
                    const roles = this.allRows.map(row => row.userRole);
                    return ['All Users', ...new Set(roles)];
                },

                filterByRole(role) {
                    this.selectedRole = role;
                    this.page = 1;
                },

                get totalPages() {
                    return Math.ceil(this.filteredRows.length / this.perPage) || 1;
                },

                get paginatedRows() {
                    const start = (this.page - 1) * this.perPage;
                    const end = start + this.perPage;
                    return this.filteredRows.slice(start, end);
                },

                get startEntry() {
                    return this.filteredRows.length === 0 ? 0 : (this.page - 1) * this.perPage + 1;
                },

                get endEntry() {
                    let end = this.page * this.perPage;
                    return end > this.filteredRows.length ? this.filteredRows.length : end;
                },

                get rows() {
                    return this.filteredRows;
                },

                goToPage(n) {
                    if (n >= 1 && n <= this.totalPages) {
                        this.page = n;
                    }
                },

                getStatusClass(status) {
                    switch(status) {
                        case 'Active':
                            return 'bg-success-50 text-success-700 dark:bg-success-500/15 dark:text-success-500';
                        case 'Suspended':
                            return 'bg-warning-50 text-warning-700 dark:bg-warning-500/15 dark:text-warning-500';
                        case 'Inactive':
                            return 'bg-error-50 text-error-700 dark:bg-error-500/15 dark:text-error-500';
                        case 'Removed':
                            return 'bg-gray-50 text-gray-700 dark:bg-gray-500/15 dark:text-gray-500';
                        default:
                            return 'bg-gray-50 text-gray-700 dark:bg-gray-500/15 dark:text-gray-500';
                    }
                },

                updateUser() {
                    const store = Alpine.store('userModal');
                    if (store.currentUser) {
                        const index = this.allRows.findIndex(r => r.id === store.currentUser.id);
                        if (index !== -1) {
                            this.allRows[index] = {
                                ...this.allRows[index],
                                firstName: store.editForm.firstName,
                                lastName: store.editForm.lastName,
                                gender: store.editForm.gender,
                                email: store.editForm.email,
                                phone: store.editForm.phone,
                                nationalId: store.editForm.nationalId,
                                dob: store.editForm.dob,
                                userRole: store.editForm.userRole
                            };
                        }
                        store.editUserModal = false;
                    }
                },

                openEditModal(user) {
                    Alpine.store('userModal').openEditModal(user);
                }
            }));

            // 3. USER ROLES TABLE - Keep existing logic
            Alpine.data('userRolesTable', () => ({
                userRoles: [],
                page: 1,
                perPage: 10,
                isLoading: true,

                init() {
                    this.fetchUserRolesData();
                },

                async fetchUserRolesData() {
                    try {
                        const response = await fetch('/user-roles/all');
                        const data = await response.json();

                        if (data.userRoles && Array.isArray(data.userRoles)) {
                            this.userRoles = data.userRoles.map(role => ({
                                UserRoleID: role.user_role_id,
                                userRole: role.user_role,
                                Status: role.user_role_status,
                                user_role_created_on: role.user_role_created_on,
                                creator_name: role.creator_name,
                                user_role_bodaboda_create: role.user_role_bodaboda_create,
                                user_role_bodaboda_read: role.user_role_bodaboda_read,
                                user_role_bodaboda_update: role.user_role_bodaboda_update,
                                user_role_bodaboda_delete: role.user_role_bodaboda_delete,
                                user_role_loans_create: role.user_role_loans_create,
                                user_role_loans_read: role.user_role_loans_read,
                                user_role_loans_update: role.user_role_loans_update,
                                user_role_loans_delete: role.user_role_loans_delete,
                                user_role_lands_create: role.user_role_lands_create,
                                user_role_lands_read: role.user_role_lands_read,
                                user_role_lands_update: role.user_role_lands_update,
                                user_role_lands_delete: role.user_role_lands_delete
                            }));
                        }

                        this.isLoading = false;

                    } catch (error) {
                        console.error('Error fetching user roles:', error);
                        this.isLoading = false;
                    }
                },

                // KEEP ALL EXISTING TABLE METHODS - DON'T CHANGE
                get totalPages() {
                    return Math.ceil(this.userRoles.length / this.perPage) || 1;
                },

                get paginatedRoles() {
                    const start = (this.page - 1) * this.perPage;
                    const end = start + this.perPage;
                    return this.userRoles.slice(start, end);
                },

                get startEntry() {
                    return this.userRoles.length === 0 ? 0 : (this.page - 1) * this.perPage + 1;
                },

                get endEntry() {
                    let end = this.page * this.perPage;
                    return end > this.userRoles.length ? this.userRoles.length : end;
                },

                goToPage(n) {
                    if (n >= 1 && n <= this.totalPages) {
                        this.page = n;
                    }
                },

                updateRole() {
                    const store = Alpine.store('userRoleModal');
                    if (store.currentRole) {
                        const index = this.userRoles.findIndex(r => r.UserRoleID === store.currentRole.UserRoleID);
                        if (index !== -1) {
                            this.userRoles[index] = {
                                ...this.userRoles[index],
                                userRole: store.editForm.userRole,
                                Status: store.editForm.status
                            };
                        }
                        store.editUserRoleModal = false;
                    }
                },

                openEditModal(role) {
                    Alpine.store('userRoleModal').openEditModal(role);
                },

                formatDate(dateString) {
                    if (!dateString) return 'N/A';
                    try {
                        const date = new Date(dateString);
                        return date.toLocaleDateString('en-US', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    } catch (e) {
                        return dateString;
                    }
                }
            }));

            // 4. GLOBAL STORES - Keep existing modal stores
            Alpine.store('userModal', {
                editUserModal: false,
                currentUser: null,
                editForm: {
                    userId: '',
                    firstName: '',
                    lastName: '',
                    gender: '',
                    email: '',
                    phone: '',
                    nationalId: '',
                    dob: '',
                    userRole: '',
                    userStatus: '',
                },
                updateUser() {
                    const tableComponent = Alpine.$data(document.querySelector('[x-data="usersTableFull"]'));
                    if (tableComponent && tableComponent.updateUser) {
                        tableComponent.updateUser();
                    }
                },
                openEditModal(user) {
                    this.currentUser = user;
                    this.editForm.userId = user.userId;
                    this.editForm.firstName = user.firstName;
                    this.editForm.lastName = user.lastName;
                    this.editForm.gender = user.gender;
                    this.editForm.email = user.email;
                    this.editForm.phone = user.phone;
                    this.editForm.nationalId = user.nationalId;
                    this.editForm.dob = user.dob;
                    this.editForm.userRole = user.userRole;
                    this.editForm.userStatus = user.userStatus;
                    this.editUserModal = true;
                }
            });

            // 5. SIMPLE FORM HANDLING
            Alpine.data('newRoleForm', () => ({
                isSubmitting: false,

                async submitForm(event) {
                    event.preventDefault();

                    // Change button text
                    this.isSubmitting = true;

                    try {
                        // Get form data
                        const form = event.target;
                        const formData = new FormData(form);

                        // Submit to backend
                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData
                        });

                        const data = await response.json();

                        // Show alert with message from Laravel
                        if (data.success) {
                            alert('Success: ' + data.message);
                        } else {
                            alert('Error: ' + data.message);
                        }

                    } catch (error) {
                        alert('Error: Failed to create role. Please try again.');
                    } finally {
                        // Wait 1.5 seconds then redirect
                        setTimeout(() => {
                            window.location.href = "{{ route('treasurer.users') }}";
                        }, 1500);
                    }
                }
            }));

            // 6. SIMPLE CREATE USER HANDLING
            Alpine.data('createUserForm', () => ({
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                gender: '',
                dateOfBirth: '',
                nationalId: '',
                userRole: '',
                password: '',
                confirmPassword: '',
                errors: {},
                isSubmitting: false,

                validateField(field) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    const phoneRegex = /^\+?[\d\s\-\(\)]+$/;

                    switch(field) {
                        case 'firstName':
                            if (!this.firstName.trim()) {
                                this.errors.firstName = 'First name is required';
                            } else if (this.firstName.trim().length < 2) {
                                this.errors.firstName = 'First name must be at least 2 characters';
                            } else {
                                this.errors.firstName = '';
                            }
                            break;

                        case 'lastName':
                            if (!this.lastName.trim()) {
                                this.errors.lastName = 'Last name is required';
                            } else if (this.lastName.trim().length < 2) {
                                this.errors.lastName = 'Last name must be at least 2 characters';
                            } else {
                                this.errors.lastName = '';
                            }
                            break;

                        case 'email':
                            if (!this.email.trim()) {
                                this.errors.email = 'Email is required';
                            } else if (!emailRegex.test(this.email)) {
                                this.errors.email = 'Please enter a valid email address';
                            } else {
                                this.errors.email = '';
                            }
                            break;

                        case 'phone':
                            if (!this.phone.trim()) {
                                this.errors.phone = 'Phone number is required';
                            } else if (!phoneRegex.test(this.phone)) {
                                this.errors.phone = 'Please enter a valid phone number';
                            } else if (this.phone.replace(/\D/g, '').length < 9) {
                                this.errors.phone = 'Phone number is too short';
                            } else {
                                this.errors.phone = '';
                            }
                            break;

                        case 'gender':
                            if (!this.gender) {
                                this.errors.gender = 'Gender is required';
                            } else {
                                this.errors.gender = '';
                            }
                            break;

                        case 'userRole':
                            if (!this.userRole) {
                                this.errors.userRole = 'User role is required';
                            } else {
                                this.errors.userRole = '';
                            }
                            break;

                        case 'password':
                            if (!this.password) {
                                this.errors.password = 'Password is required';
                            } else if (this.password.length < 8) {
                                this.errors.password = 'Password must be at least 8 characters';
                            } else {
                                this.errors.password = '';
                            }
                            this.validatePasswordMatch();
                            break;

                        case 'confirmPassword':
                            this.validatePasswordMatch();
                            break;
                    }
                },

                validatePasswordMatch() {
                    if (this.confirmPassword && this.password !== this.confirmPassword) {
                        this.errors.confirmPassword = 'Passwords do not match';
                    } else if (this.confirmPassword) {
                        this.errors.confirmPassword = '';
                    }
                },

                clearError(field) {
                    if (this.errors[field]) {
                        this.errors[field] = '';
                    }
                },

                validateAll() {
                    this.validateField('firstName');
                    this.validateField('lastName');
                    this.validateField('email');
                    this.validateField('phone');
                    this.validateField('gender');
                    this.validateField('userRole');
                    this.validateField('password');
                    this.validateField('confirmPassword');

                    return !Object.values(this.errors).some(error => error !== '');
                },

                async submitForm() {
                    if (!this.validateAll()) {
                        const firstError = Object.values(this.errors).find(error => error !== '');
                        if (firstError) {
                            alert('Error: ' + firstError);
                        }
                        return;
                    }

                    this.isSubmitting = true;

                    try {
                        // Get the actual form element
                        const form = document.querySelector('form[x-data="createUserForm"]');

                        // Fill the hidden form fields with Alpine data
                        const hiddenFields = form.querySelectorAll('input[type="hidden"]');

                        // Submit the actual form
                        const response = await fetch('/users/create', {
                            method: 'POST',
                            body: new FormData(form),
                            headers: {
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            alert('Success: ' + data.message);

                            // Clear form
                            this.firstName = '';
                            this.lastName = '';
                            this.email = '';
                            this.phone = '';
                            this.gender = '';
                            this.dateOfBirth = '';
                            this.nationalId = '';
                            this.userRole = '';
                            this.password = '';
                            this.confirmPassword = '';

                            // Close modal if it exists
                            if (typeof this.newUserModal !== 'undefined') {
                                this.newUserModal = false;
                            }

                            // Redirect after 1 second
                            setTimeout(() => {
                                window.location.href = "{{ route('treasurer.users') }}";
                            }, 1000);
                        } else {
                            if (data.errors) {
                                const firstError = Object.values(data.errors)[0][0];
                                alert('Error: ' + firstError);
                            } else if (data.message) {
                                alert('Error: ' + data.message);
                            } else {
                                alert('Error: Failed to create user');
                            }
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error: Failed to connect to server');
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            }));

            Alpine.store('userRoleModal', {
                editUserRoleModal: false,
                currentRole: null,
                editForm: {
                    userRole: '',
                    status: ''
                },
                updateRole() {
                    const tableComponent = Alpine.$data(document.querySelector('[x-data="userRolesTable"]'));
                    if (tableComponent && tableComponent.updateRole) {
                        tableComponent.updateRole();
                    }
                },
                openEditModal(role) {
                    this.currentRole = role;
                    this.editForm.userRole = role.userRole;
                    this.editForm.status = role.Status;
                    this.editUserRoleModal = true;
                }
            });

            Alpine.data('editRoleForm', () => ({
                isSubmitting: false,
                isDeleting: false,

                async submitForm(event) {
                    event.preventDefault();

                    this.isSubmitting = true;

                    try {
                        const form = event.target;
                        const formData = new FormData(form);
                        // Get ID from Alpine store
                        const roleId = Alpine.store('userRoleModal').currentRole?.UserRoleID;

                        const response = await fetch(`/user-roles/${roleId}/update`, {
                            method: 'POST', // Changed from PUT to POST
                            body: formData
                        });

                        const data = await response.json();

                        if (data.success) {
                            alert('Success: ' + data.message);
                        } else {
                            alert('Error: ' + data.message);
                        }

                    } catch (error) {
                        alert('Error: Failed to update role. Please try again.');
                    } finally {
                        this.isSubmitting = false;

                        setTimeout(() => {
                            window.location.href = "{{ route('treasurer.users') }}";
                        }, 1500);
                    }
                },

                async deleteRole() {
                    this.isDeleting = true;

                    const roleId = Alpine.store('userRoleModal').currentRole?.UserRoleID;

                    if (!confirm('Are you sure you want to delete this role?')) {
                        this.isDeleting = false;
                        return;
                    }

                    try {
                        // Get CSRF token from the form
                        const csrfToken = document.querySelector('input[name="_token"]').value;

                        const response = await fetch(`/user-roles/${roleId}/delete`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            alert('Success: ' + data.message);
                        } else {
                            alert('Error: ' + data.message);
                        }

                    } catch (error) {
                        alert('Error: Failed to delete role. Please try again.');
                    } finally {
                        setTimeout(() => {
                            this.isDeleting = false;

                            setTimeout(() => {
                                window.location.href = "{{ route('treasurer.users') }}";
                            }, 1500);
                        }, 1200);
                    }
                }

            }));

            // User form validation
            Alpine.data('passwordResetForm', () => ({
                password: '',
                confirmPassword: '',
                userId: '',
                requirements: {
                    minLength: false,
                    specialChar: false,
                    capitalLetter: false,
                    lowerCase: false,
                    numbers: false,
                    matchPassword: false
                },
                errors: {},
                isResettingPassword: false,

                init() {
                    // initialize userId from store and watch for changes
                    this.userId = Alpine.store('userModal').currentUser?.id || '';
                    this.$watch(() => Alpine.store('userModal').currentUser, (v) => {
                        this.userId = v?.id || '';
                    });
                },

                validatePassword() {
                    const pwd = this.password || '';

                    this.requirements.minLength = pwd.length >= 8;
                    this.requirements.specialChar = /[!@#\$%\^&\*\(\)\-_\+\=\[\]\{\}\\\/~`|:;"'<>,\.\?]/.test(pwd);
                    this.requirements.capitalLetter = /[A-Z]/.test(pwd);
                    this.requirements.lowerCase = /[a-z]/.test(pwd);
                    this.requirements.numbers = /[0-9]/.test(pwd);

                    // update match flag as well
                    this.requirements.matchPassword = this.confirmPassword ? (pwd === this.confirmPassword) : false;
                },

                validateMatch() {
                    this.requirements.matchPassword = this.password === this.confirmPassword && this.confirmPassword !== '';
                },

                async submitPasswordReset() {
                    if (!this.requirements.minLength || !this.requirements.specialChar || !this.requirements.capitalLetter || !this.requirements.lowerCase || !this.requirements.numbers) {
                        alert('Password does not meet requirements.');
                        return;
                    }
                    if (!this.requirements.matchPassword) {
                        alert('Passwords do not match.');
                        return;
                    }

                    this.isResettingPassword = true;

                    try {
                        const formEl = this.$el;
                        const formData = new FormData(formEl);

                        const response = await fetch('/users/reset-password', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            alert(data.message);
                            Alpine.store('userModal').editUserModal = false;
                            window.location.href = "{{ route('treasurer.users') }}";
                        } else {
                            alert(data.message);
                        }
                    } catch (e) {
                        console.error(e);
                        alert('Error: Failed to update password.');
                    } finally {
                        this.isResettingPassword = false;
                    }
                }
            }));

            // 11. Manage deleting and updaing system user data
            Alpine.data('editUserForm', () => ({
                isUpdating: false,
                isDeleting: false,
                userId: '',

                init() {
                    // Initialize userId from the store
                    this.userId = Alpine.store('userModal').currentUser?.id || '';
                    // Watch for changes to currentUser
                    this.$watch(() => Alpine.store('userModal').currentUser, (v) => {
                        this.userId = v?.id || '';
                    });
                },

                async submitProfileUpdate() {
                    this.isUpdating = true;

                    try {
                        const formEl = this.$el;

                        if (!this.userId) {
                            alert('Error: User ID not found.');
                            this.isUpdating = false;
                            return;
                        }

                        const formData = new FormData(formEl);
                        formData.set('user_id', this.userId);

                        const response = await fetch('/users/update-user', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            alert(data.message);
                            Alpine.store('userModal').editUserModal = false;
                            window.location.href = "{{ route('treasurer.users') }}";
                        } else {
                            alert(data.message || 'Failed to update user.');
                        }
                    } catch (e) {
                        console.error(e);
                        alert('Error: ' + (e.message || 'Failed to update user.'));
                    } finally {
                        this.isUpdating = false;
                    }
                },

                async deleteUser() {
                    if (!this.userId) {
                        alert('Error: User ID not found.');
                        return;
                    }

                    // Show confirmation dialog
                    if (!confirm('Are you sure you want to delete this system user? This action cannot be undone.')) {
                        return;
                    }

                    this.isDeleting = true;

                    try {
                        const formData = new FormData();
                        formData.append('user_id', this.userId);

                        const response = await fetch('/users/delete-user', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            alert(data.message);
                            Alpine.store('userModal').editUserModal = false;
                            window.location.href = "{{ route('treasurer.users') }}";
                        } else {
                            alert(data.message || 'Failed to delete user.');
                            this.isDeleting = false;
                        }
                    } catch (e) {
                        console.error(e);
                        alert('Error: ' + (e.message || 'Failed to delete user.'));
                        this.isDeleting = false;
                    }
                }
            }));

        });
    </script>

  </body>

</html>
