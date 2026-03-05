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

            <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
                <!-- Sidebar Menu -->
                <nav x-data="{selected: $persist('Dashboard')}">
                    <!-- MENU Group -->
                    <div>
                        <h3 class="mb-4 text-xs leading-[20px] text-gray-400 uppercase">
                            <span class="menu-group-title" :class="sidebarToggle ? 'xl:hidden' : ''">MENU</span>
                            <svg :class="sidebarToggle ? 'xl:block hidden' : 'hidden'"
                                class="menu-group-icon mx-auto fill-current"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                    fill="currentColor"/>
                            </svg>
                        </h3>

                        <ul class="mb-6 flex flex-col gap-1">
                            <!-- Menu Item Dashboard -->
                            <li>
                                <a href="{{ route('treasurer.dashboard') }}"
                                @click="selected = 'Dashboard'"
                                class="menu-item group"
                                :class="selected === 'Dashboard' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg :class="selected === 'Dashboard' ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                            fill="currentColor"/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Dashboard</span>
                                </a>
                            </li>

                            <!-- Menu Item Appointments -->
                            <li>
                                <a href="{{ route('treasurer.appointments') }}"
                                @click="selected = 'Appointments'"
                                class="menu-item group"
                                :class="selected === 'Appointments' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                        <path d="M16 3l0 4" />
                                        <path d="M8 3l0 4" />
                                        <path d="M4 11l16 0" />
                                        <path d="M8 15h2v2h-2z" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Appointments</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- MANAGE Group -->
                    <div>
                        <h3 class="mb-4 text-xs leading-[20px] text-gray-400 uppercase">
                            <span class="menu-group-title" :class="sidebarToggle ? 'xl:hidden' : ''">MANAGE</span>
                            <svg :class="sidebarToggle ? 'xl:block hidden' : 'hidden'"
                                class="menu-group-icon mx-auto fill-current"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                    fill="currentColor"/>
                            </svg>
                        </h3>

                        <ul class="mb-6 flex flex-col gap-1">
                            <!-- Menu Item Users -->
                            <li>
                                <a href="{{ route('treasurer.users') }}"
                                @click="selected = 'Users'"
                                class="menu-item group"
                                :class="selected === 'Users' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- BODABODA GROUP -->
                    <div>
                        <h3 class="mb-4 text-xs leading-[20px] text-gray-400 uppercase">
                            <span class="menu-group-title" :class="sidebarToggle ? 'xl:hidden' : ''">BODABODA GROUP</span>
                            <svg :class="sidebarToggle ? 'xl:block hidden' : 'hidden'"
                                class="menu-group-icon mx-auto fill-current"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                    fill="currentColor"/>
                            </svg>
                        </h3>

                        <ul class="mb-6 flex flex-col gap-1">
                            <!-- Overview (bodaboda.blade.php) -->
                            <li>
                                <a href="{{ route('treasurer.bodaboda.overview') }}"
                                @click="selected = 'BodabodaOverview'"
                                class="menu-item group"
                                :class="selected === 'BodabodaOverview' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chart-infographic">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M7 3v4h4" />
                                        <path d="M9 17l0 4" />
                                        <path d="M17 14l0 7" />
                                        <path d="M13 13l0 8" />
                                        <path d="M21 12l0 9" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Overview</span>
                                </a>
                            </li>

                            <!-- Members -->
                            <li>
                                <a href="{{ route('treasurer.members') }}"
                                @click="selected = 'Members'"
                                class="menu-item group"
                                :class="selected === 'Members' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Members</span>
                                </a>
                            </li>

                            <!-- Vehicles -->
                            <li>
                                <a href="{{ route('treasurer.vehicles') }}"
                                @click="selected = 'Vehicles'"
                                class="menu-item group"
                                :class="selected === 'Vehicles' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-motorbike">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M19 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M7.5 14h5l4 -4h-10.5m1.5 4l4 -4" />
                                        <path d="M13 6h2l1.5 3l2 4" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Vehicles</span>
                                </a>
                            </li>

                            <!-- Stages -->
                            <li>
                                <a href="{{ route('treasurer.stages') }}"
                                @click="selected = 'Stages'"
                                class="menu-item group"
                                :class="selected === 'Stages' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Stages</span>
                                </a>
                            </li>

                            <!-- Loans (bodabodaloans.blade.php) -->
                            <li>
                                <a href="{{ route('treasurer.bodaboda.loans') }}"
                                @click="selected = 'BodabodaLoans'"
                                class="menu-item group"
                                :class="selected === 'BodabodaLoans' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                        <path d="M3 10l18 0" />
                                        <path d="M7 15l.01 0" />
                                        <path d="M11 15l2 0" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Loans</span>
                                </a>
                            </li>

                            <!-- Bonuses & Fines (bodabodabf.blade.php) -->
                            <li>
                                <a href="{{ route('treasurer.bodaboda.bf') }}"
                                @click="selected = 'BodabodaBF'"
                                class="menu-item group"
                                :class="selected === 'BodabodaBF' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-gift">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 8m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                                        <path d="M12 8l0 13" />
                                        <path d="M19 12v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-7" />
                                        <path d="M7.5 8a2.5 2.5 0 0 1 0 -5a4.8 8 0 0 1 4.5 5a4.8 8 0 0 1 4.5 -5a2.5 2.5 0 0 1 0 5" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Bonuses & Fines</span>
                                </a>
                            </li>

                            <!-- Contributions and Savings (contributions.blade.php) -->
                            <li>
                                <a href="{{ route('treasurer.bodaboda.cs') }}"
                                @click="selected = 'BodabodaCS'"
                                class="menu-item group"
                                :class="selected === 'BodabodaCS' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pig-money">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M15 11v.01" />
                                        <path d="M5.173 8.378a3 3 0 1 1 4.656 -1.377" />
                                        <path d="M16 4v3.803a6.019 6.019 0 0 1 2.658 3.197h1.341a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-1.342c-.336 .95 -.907 1.8 -1.658 2.473v2.027a1.5 1.5 0 0 1 -3 0v-.583a6.04 6.04 0 0 1 -1 .083h-4a6.04 6.04 0 0 1 -1 -.083v.583a1.5 1.5 0 0 1 -3 0v-2l0 -.027a6 6 0 0 1 4 -10.473h2.5l4.5 -3h0z" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Contributions & Savings</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- MICROFINANCE GROUP -->
                    <div>
                        <h3 class="mb-4 text-xs leading-[20px] text-gray-400 uppercase">
                            <span class="menu-group-title" :class="sidebarToggle ? 'xl:hidden' : ''">MICROFINANCE GROUP</span>
                            <svg :class="sidebarToggle ? 'xl:block hidden' : 'hidden'"
                                class="menu-group-icon mx-auto fill-current"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                    fill="currentColor"/>
                            </svg>
                        </h3>

                        <ul class="mb-6 flex flex-col gap-1">
                            <!-- Overview -->
                            <li>
                                <a href="{{ route('treasurer.microfinance.overview') }}"
                                @click="selected = 'MicroOverview'"
                                class="menu-item group"
                                :class="selected === 'MicroOverview' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chart-pie">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M10 3.2a9 9 0 1 0 10.8 10.8a1 1 0 0 0 -1 -1h-6.8a2 2 0 0 1 -2 -2v-7a.9 .9 0 0 0 -1 -.8" />
                                        <path d="M15 3.5a9 9 0 0 1 5.5 5.5h-4.5a1 1 0 0 1 -1 -1v-4.5" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Overview</span>
                                </a>
                            </li>

                            <!-- Loan Types -->
                            <li>
                                <a href="{{ route('treasurer.loan.types') }}"
                                @click="selected = 'LoanTypes'"
                                class="menu-item group"
                                :class="selected === 'LoanTypes' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-category">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 4h6v6h-6z" />
                                        <path d="M14 4h6v6h-6z" />
                                        <path d="M4 14h6v6h-6z" />
                                        <path d="M14 14h6v6h-6z" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Loan Types</span>
                                </a>
                            </li>

                            <!-- Clients -->
                            <li>
                                <a href="{{ route('treasurer.microfinance.clients') }}"
                                @click="selected = 'MicroClients'"
                                class="menu-item group"
                                :class="selected === 'MicroClients' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Clients</span>
                                </a>
                            </li>

                            <!-- Fines & Penalties -->
                            <li>
                                <a href="{{ route('treasurer.microfinance.fines') }}"
                                @click="selected = 'MicroFines'"
                                class="menu-item group"
                                :class="selected === 'MicroFines' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-octagon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12.802 2.165l5.575 2.389c.48 .206 .863 .589 1.07 1.07l2.388 5.574c.22 .512 .22 1.092 0 1.604l-2.389 5.575c-.206 .48 -.589 .863 -1.07 1.07l-5.574 2.388c-.512 .22 -1.092 .22 -1.604 0l-5.575 -2.389a2.036 2.036 0 0 1 -1.07 -1.07l-2.388 -5.574a2.036 2.036 0 0 1 0 -1.604l2.389 -5.575c.206 -.48 .589 -.863 1.07 -1.07l5.574 -2.388a2.036 2.036 0 0 1 1.604 0z" />
                                        <path d="M12 8v4" />
                                        <path d="M12 16h.01" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Fines & Penalties</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- REAL-ESTATE GROUP -->
                    <div>
                        <h3 class="mb-4 text-xs leading-[20px] text-gray-400 uppercase">
                            <span class="menu-group-title" :class="sidebarToggle ? 'xl:hidden' : ''">REAL-ESTATE GROUP</span>
                            <svg :class="sidebarToggle ? 'xl:block hidden' : 'hidden'"
                                class="menu-group-icon mx-auto fill-current"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                    fill="currentColor"/>
                            </svg>
                        </h3>

                        <ul class="mb-6 flex flex-col gap-1">
                            <!-- Overview -->
                            <li>
                                <a href="{{ route('treasurer.realestate.overview') }}"
                                @click="selected = 'RealOverview'"
                                class="menu-item group"
                                :class="selected === 'RealOverview' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-community">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" />
                                        <path d="M13 7l0 .01" />
                                        <path d="M17 7l0 .01" />
                                        <path d="M17 11l0 .01" />
                                        <path d="M17 15l0 .01" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Overview</span>
                                </a>
                            </li>

                            <!-- Real-Estate Listings -->
                            <li>
                                <a href="{{ route('treasurer.realestate.listings') }}"
                                @click="selected = 'Listings'"
                                class="menu-item group"
                                :class="selected === 'Listings' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-estate">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 21h18" />
                                        <path d="M19 21v-4" />
                                        <path d="M19 17h2v-2a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v2z" />
                                        <path d="M14 21v-4" />
                                        <path d="M14 17h2v-2a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v2z" />
                                        <path d="M9 21v-4" />
                                        <path d="M9 17h2v-2a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v2z" />
                                        <path d="M4 21v-4" />
                                        <path d="M4 17h2v-2a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v2z" />
                                        <path d="M5 13v-5h14l2 5" />
                                        <path d="M9 8v-2h6v2" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Real-Estate Listings</span>
                                </a>
                            </li>

                            <!-- Clients -->
                            <li>
                                <a href="{{ route('treasurer.realestate.clients') }}"
                                @click="selected = 'RealClients'"
                                class="menu-item group"
                                :class="selected === 'RealClients' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Clients</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- SETTINGS Group -->
                    <div>
                        <h3 class="mb-4 text-xs leading-[20px] text-gray-400 uppercase">
                            <span class="menu-group-title" :class="sidebarToggle ? 'xl:hidden' : ''">SETTINGS</span>
                            <svg :class="sidebarToggle ? 'xl:block hidden' : 'hidden'"
                                class="menu-group-icon mx-auto fill-current"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                    fill="currentColor"/>
                            </svg>
                        </h3>

                        <ul class="mb-6 flex flex-col gap-1">
                            <!-- Menu Item Profile -->
                            <li>
                                <a href="{{ route('profile') }}"
                                @click="selected = 'Profile'"
                                class="menu-item group"
                                :class="selected === 'Profile' ? 'menu-item-active' : 'menu-item-inactive'">
                                    <svg :class="selected === 'Profile' ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z"
                                            fill="currentColor"/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'xl:hidden' : ''">Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Logout Item -->
                    <div class="mt-auto">
                        <ul class="flex flex-col gap-1">
                            <li>
                                <form action="{{ route('signout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            @click="selected = 'Logout'"
                                            class="menu-item group menu-item-inactive flex items-center w-full text-left"
                                            :class="selected === 'Logout' ? 'menu-item-active' : 'menu-item-inactive'">
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
            </div>
        </aside>
        <!-- ===== Sidebar End ===== -->
