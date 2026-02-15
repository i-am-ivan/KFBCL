
<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Auth::user()->role }} | KFBCL IT</title>

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
      <aside :class="sidebarToggle ? 'translate-x-0 xl:w-[90px]' : '-translate-x-full'"
             class="sidebar fixed top-0 left-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-auto border-r border-gray-200 bg-white px-5 transition-all duration-300 xl:static xl:translate-x-0 dark:border-gray-800 dark:bg-black"
             @click.outside="sidebarToggle = false">

            <!-- SIDEBAR HEADER -->
            <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
                class="sidebar-header flex items-center gap-2 pt-8 pb-7">
                <a href="{{ route('dashboard') }}" class="flex items-center">
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
                        <a href="index.php" @click="selected = (selected === 'Dashboard' ? '':'Dashboard')" class="menu-item group"
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
                        <a href="appointments.php" @click="selected = (selected === 'Appointments' ? '':'Appointments')" class="menu-item group"
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
                        <a href="users.php" @click="selected = (selected === 'Users' ? '':'Users')" class="menu-item group"
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
                        <a href="bodaboda.php" @click="selected = (selected === 'Bodaboda Group' ? '':'Bodaboda Group')" class="menu-item group"
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
                        <a href="loans.php" @click="selected = (selected === 'Loans' ? '':'Loans')" class="menu-item group"
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
                        <a href="real-estate.php" @click="selected = (selected === 'Real Estate' ? '':'Real Estate')" class="menu-item group"
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
                    <a href="profile.php" @click="selected = (selected === 'Profile' ? '':'Profile')"
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

                <a href="" class="xl:hidden">
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
                        {{ Auth::user()->email }}
                      </span>
                    </div>

                    <ul
                            class="flex flex-col gap-1 border-b border-gray-200 pt-4 pb-3 dark:border-gray-800"
                    >
                      <li>
                        <button class="group text-theme-sm flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
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
                        </button>
                      </li>
                    </ul>
                    <form action="{{ route('signout') }}" method="POST">
                            @csrf
                            <button type="submit" class="group text-theme-sm flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
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
                            </button>
                        </form>
                  </div>
                  <!-- Dropdown End -->
                </div>
                <!-- User Area -->
              </div>
            </div>
          </header>
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
              <!-- Analytics Start -->
              <div class="col-span-12">
                <!-- Metric Group Two -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 xl:grid-cols-3">
                  <!-- Metric Item Start -->
                  <div class="flex flex-col justify-between space-y-6 rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/3">
                    <div class="flex items-start justify-between">
                      <div class="items-center justify-center">
                        <p class="items-center justify-center text-lg font-semibold text-gray-500 dark:text-white/90">
                          Bodaboda group wallet
                        </p>
                        <h3 class="text-2xl font-semibold text-gray-600 dark:text-white/90">
                          KES 0.00
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                          <span class="text-success-600 font-medium">+3.85%</span>
                          than last Month
                        </p>
                      </div>
                      <div x-data="{openDropDown: false}" class="relative h-fit">
                      </div>
                    </div>
                    <div class="items-center justify-between">
                      <div>
                        <div class="mt-5 flex items-center gap-2">
                          <div class="flex items-center justify-center gap-6">
                            <div>
                              <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90">
                                827
                              </p>
                              <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                Total Members
                              </p>
                            </div>

                            <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>

                            <div>
                              <p class="text-lg font-semibold text-center text-success-700 dark:text-white/90">
                                199
                              </p>
                              <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                Active Loans
                              </p>
                            </div>

                            <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>

                            <div>
                              <p class="text-lg font-semibold text-center text-warning-700 dark:text-white/90">
                                101
                              </p>
                              <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                Pending Memberships
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Metric Item End -->

                  <!-- Metric Item Start -->
                  <div class="space-y5 rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/3">
                    <div class="flex items-start justify-between">
                      <div>
                        <h3 class="text-lg font-semibold text-gray-500 dark:text-white/90">
                          Loans
                        </h3>
                        <p class="dark:text-gray-40 text-sm text-gray-500">
                          Active Loans Balance
                        </p>
                      </div>
                    </div>
                    <div class="relative mt-5 flex justify-between">
                      <div>
                        <h3 class="mb-1 text-2xl font-bold text-gray-500 dark:text-white/90">
                          KES 350,000.00
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                          <span class="text-success-600 font-medium">+3.85%</span>
                          than last Month
                        </p>
                        <div class="mt-5 flex items-center gap-2">
                          <div class="flex items-center justify-center gap-6">
                            <div>
                              <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90">
                                1,224
                              </p>
                              <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                Borrowers
                              </p>
                            </div>

                            <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>

                            <div>
                              <p class="text-lg font-semibold text-center text-success-700 dark:text-white/90">
                                127
                              </p>
                              <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                Active Clients
                              </p>
                            </div>

                            <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>

                            <div>
                              <p class="text-lg font-semibold text-center text-warning-500 dark:text-white/90">
                                22
                              </p>
                              <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                Pending Loan Applications
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Metric Item End -->

                  <!-- Metric Item Start -->
                  <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="flex items-start justify-between">
                      <div>
                        <h3 class="text-lg font-semibold text-gray-500 dark:text-white/90">
                          Real Estate
                        </h3>
                        <p class="dark:text-gray-40 text-sm text-gray-500">
                          Wallet
                        </p>
                      </div>
                    </div>
                    <div class="relative mt-5 flex justify-between">
                      <div>
                        <h3 class="mb-1 text-2xl font-bold text-gray-500 dark:text-white/90">
                          KES 1,350,000.00
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                          <span class="text-success-600 font-medium">+3.85%</span>
                          than last Month
                        </p>
                        <div class="mt-5 flex items-center gap-2">
                          <div class="flex items-center justify-center gap-6">
                            <div>
                              <p class="text-lg font-semibold text-center text-gray-500 dark:text-white/90">
                                224
                              </p>
                              <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                Total Units
                              </p>
                            </div>

                            <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>

                            <div>
                              <p class="text-lg font-semibold text-center text-success-500 dark:text-white/90">
                                103
                              </p>
                              <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                Units Sold
                              </p>
                            </div>

                            <div class="w-px bg-gray-200 h-11 dark:bg-gray-800"></div>

                            <div>
                              <p class="text-lg font-semibold text-center text-warning-500 dark:text-white/90">
                                101
                              </p>
                              <p class="text-theme-xs mt-0.5 text-center text-gray-500 dark:text-gray-400">
                                Available Units
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Metric Item End -->
                </div>
                <!-- Metric Group Two -->
              </div>
              <!-- Analytics End -->
              <!-- Appointment Table -->
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
                      <div class="mb-6 flex justify-between">
                        <div>
                          <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Upcoming Appointments</h3>
                        </div>
                        <div x-data="{openDropDown: false}" class="relative h-fit">
                          <button @click="openDropDown = !openDropDown"
                                  :class="openDropDown ? 'text-gray-700 dark:text-white' : 'text-gray-400 hover:text-gray-700 dark:hover:text-white'">
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
                                      d="M10.2441 6C10.2441 5.0335 11.0276 4.25 11.9941 4.25H12.0041C12.9706 4.25 13.7541 5.0335 13.7541 6C13.7541 6.9665 12.9706 7.75 12.0041 7.75H11.9941C11.0276 7.75 10.2441 6.9665 10.2441 6ZM10.2441 18C10.2441 17.0335 11.0276 16.25 11.9941 16.25H12.0041C12.9706 16.25 13.7541 17.0335 13.7541 18C13.7541 18.9665 12.9706 19.75 12.0041 19.75H11.9941C11.0276 19.75 10.2441 18.9665 10.2441 18ZM11.9941 10.25C11.0276 10.25 10.2441 11.0335 10.2441 12C10.2441 12.9665 11.0276 13.75 11.9941 13.75H12.0041C12.9706 13.75 13.7541 12.9665 13.7541 12C13.7541 11.0335 12.9706 10.25 12.0041 10.25H11.9941Z"
                                      fill=""
                              />
                            </svg>
                          </button>
                          <div x-show="openDropDown"
                               @click.outside="openDropDown = false"
                               class="shadow-theme-lg dark:bg-gray-dark absolute top-full right-0 z-40 w-40 space-y-1 rounded-2xl border border-gray-200 bg-white p-2 dark:border-gray-800">
                            <button onclick="window.location.href='appointments.php'" class="text-theme-xs flex w-full rounded-lg px-3 py-2 text-left font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">View More</button>
                          </div>
                        </div>
                      </div>
                      <div class="custom-scrollbar overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                          <thead>
                            <tr class="bg-gray-50 dark:bg-gray-900">
                            <th class="px-6 py-4 text-left text-sm font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">Appointment ID</th>
                            <th class="px-6 py-4 text-left text-sm font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">DateTime</th>
                            <th class="px-6 py-4 text-left text-sm font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">Office</th>
                            <th class="px-6 py-4 text-left text-sm font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">Priority</th>
                            <th class="px-6 py-4 text-left text-sm font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">Status</th>
                          </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                            <tr>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">#APP0012025</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Dec 18, 2025 09:30</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Treasurer</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">High</td>
                              <td class="px-6 py-4 text-left">
                                <span class="bg-success-50 text-theme-xs text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">Confirmed</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">#APP0022025</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Dec 18, 2025 11:00</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">General</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Medium</td>
                              <td class="px-6 py-4 text-left">
                                <span class="bg-success-50 text-theme-xs text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">Confirmed</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">#APP0032025</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Dec 19, 2025 14:15</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Treasurer</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">High</td>
                              <td class="px-6 py-4 text-left">
                                <span class="bg-success-50 text-theme-xs text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">Confirmed</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">#APP0042025</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Dec 20, 2025 10:00</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Chairman</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Medium</td>
                              <td class="px-6 py-4 text-left">
                                <span class="bg-success-50 text-theme-xs text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">Confirmed</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">#APP0052025</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Dec 22, 2025 09:45</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Office</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Low</td>
                              <td class="px-6 py-4 text-left">
                                <span class="bg-success-50 text-theme-xs text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">Confirmed</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">#APP0022025</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Dec 18, 2025 11:00</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">General</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Medium</td>
                              <td class="px-6 py-4 text-left">
                                <span class="bg-success-50 text-theme-xs text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">Confirmed</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">#APP0032025</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Dec 19, 2025 14:15</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Treasurer</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">High</td>
                              <td class="px-6 py-4 text-left">
                                <span class="bg-success-50 text-theme-xs text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">Confirmed</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">#APP0042025</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Dec 20, 2025 10:00</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Chairman</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Medium</td>
                              <td class="px-6 py-4 text-left">
                                <span class="bg-success-50 text-theme-xs text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">Confirmed</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">#APP0052025</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Dec 22, 2025 09:45</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Office</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Low</td>
                              <td class="px-6 py-4 text-left">
                                <span class="bg-success-50 text-theme-xs text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">Confirmed</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">#APP0052025</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Dec 22, 2025 09:45</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Office</td>
                              <td class="px-6 py-4 text-left text-sm whitespace-nowrap text-gray-700 dark:text-gray-400">Low</td>
                              <td class="px-6 py-4 text-left">
                                <span class="bg-success-50 text-theme-xs text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">Confirmed</span>
                              </td>
                            </tr>
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
    <script data-cfasync="false" src="{{ asset('cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
    <script defer src="{{ asset('assets/bundle.js') }}"></script>

  </body>

</html>
