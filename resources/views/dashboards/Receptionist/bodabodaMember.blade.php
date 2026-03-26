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

<body x-data="{ page: 'profile', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'loanTypeModal' : false, 'personalInformationModal': false , 'sidebarToggle': false, 'scrollTop': false, 'identificationDocumentsModal': false, 'nextKinModal': false, 'vehiclesModal': false, 'contributionsModal': false, 'savingsModal': false, 'loansModal': false, 'finesPenaltiesModal': false, 'deleteMemberAccount': false, 'editNextKinModal': false, 'editMemberVehiclesModal': false, 'assignMemberVehicle': false, 'reassignMemberVehicle': false, 'withdrawContribution':false, 'withdrawSavingsModal': false, 'payLoan': false, 'withdrawContributionModal': false, 'editContributionModal': false, 'awardBonusModal': false, 'repayLoanModal': false, 'editLoanModal': false}"
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
        @include(Auth::user()->getAsideView())
        <!-- ===== Sidebar End ===== -->

    <!-- ===== Content Area Start ===== -->
    <div class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
        <!-- Small Device Overlay Start -->
        <div :class="sidebarToggle ? 'block xl:hidden' : 'hidden'"
            class="fixed z-50 h-screen w-full bg-gray-900/50">
        </div>
        <!-- Small Device Overlay End -->

        <!-- ===== Header Start ===== -->
        @include('Layouts.General.header')
        <!-- ===== Header End ===== -->

        <!-- ===== Main Content Start ===== -->
        <main>

        <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
            <!-- Breadcrumb Start -->
            <div x-data="{ pageName: `Bodaboda Member Profile`}">
              <div class="flex flex-wrap items-center justify-between gap-3 pb-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
                <nav>
                  <ol class="flex items-center gap-1.5">
                    <li>
                      <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="{{ route('treasurer.bodaboda.members') }}">Bodaboda List
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
                        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between" x-data="memberInfo">

                                <div class="flex w-full flex-col items-center gap-6 xl:flex-row">
                                    <div class="h-[78px] w-[78px] overflow-hidden rounded-full border border-gray-200 bg-gray-100 flex items-center justify-center dark:border-gray-800 dark:bg-gray-800">
                                        <svg class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="order-3 xl:order-2">
                                        <h4 class="mb-2 text-center text-lg font-semibold text-gray-800 xl:text-left dark:text-white/90" x-text="memberData?.member?.firstname + ' ' + memberData?.member?.lastname">
                                                James Mwangi
                                        </h4>
                                        <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Membership: <span x-text="memberData?.member?.membership">Member</span></p>
                                            <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                Member since <span x-text="formatDate(memberData?.member?.created_on)">December 09, 2025 15:24</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-3 sm:flex-row">

                                    <div>
                                        <p class="text-xl text-gray-500 dark:text-gray-400">
                                            <span class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 text-medium font-semibold">
                                                <span x-text="memberData?.member?.status">Active</span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- Metric Item End -->
                </div>
            </div>

            <!-- Tabbed Section -->
            <div class="rounded-xl border border-gray-200 p-6 bg-white dark:border-gray-800 dark:bg-white/[0.03]" x-data="{ activeTab: 'personal' }">
                @php
                    if(!isset($Member)) {
                        $Member = new \App\Models\Member();
                        $Member->status = 'Active'; // or whatever default
                    }
                @endphp
                <!-- Content Area -->
                @if($Member->isProfileActive())
                    <!-- Profile Active -->
                    @include('Layouts.General.activeContent')
                @else
                    <!-- Profile Not Active -->
                    @include('Layouts.General.activateMember')
                @endif

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

                <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4" x-show="assignMemberVehicle">

                    <!-- Search Section with Dropdown -->
                    <div class="w-full px-2.5">
                        <div class="flex flex-wrap shadow-xs rounded-base -space-x-0.5 relative">
                            <input type="search"
                                id="search-dropdown"
                                x-model="vehicleSearchTerm"
                                @input.debounce.300ms="searchVehicles()"
                                @focus="loadInitialVehicles()"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-3 pr-[84px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                placeholder="Search Number Plate or Vehicle Code"
                                autocomplete="off">

                            <!-- Dropdown Results -->
                            <div x-show="searchResults.length > 0 && vehicleSearchTerm.length > 0"
                                @click.away="searchResults = []"
                                class="absolute top-full left-0 right-0 mt-1 z-50 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg max-h-64 overflow-y-auto">
                                <template x-for="vehicle in searchResults" :key="vehicle.vehicleId">
                                    <div @click="selectVehicle(vehicle)"
                                        class="p-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer border-b border-gray-100 dark:border-gray-700 last:border-b-0">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white" x-text="vehicle.type + ': ' + vehicle.brand + ' (' + vehicle.yom + ') ' + vehicle.make + ' ' + vehicle.model + ' - ' + vehicle.CC"></p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400" x-text="vehicle.vehicle_code + ' - ' + vehicle.plate_number"></p>
                                            </div>
                                            <span :class="vehicle.availability === 'Available' ? 'text-green-600' : 'text-red-600'"
                                                class="text-xs font-medium px-2 py-1 rounded-full"
                                                :class="vehicle.availability === 'Available' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700'"
                                                x-text="vehicle.availability">
                                            </span>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Loading indicator -->
                            <div x-show="isSearching" class="absolute right-3 top-2.5">
                                <svg class="animate-spin h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Details Section - Shows when vehicle is selected -->
                    <div class="w-full px-2.5" x-show="selectedVehicle">
                        <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                            Vehicle Details
                        </h4>
                    </div>

                    <div class="w-full px-2.5 border-b border-gray-200" x-show="selectedVehicle">
                        <div class="min-w-[500px]">
                            <div class="flex flex-col gap-2">
                                <div class="flex cursor-pointer items-center gap-9 rounded-lg p-3 bg-gray-50 dark:bg-white/[0.03]">
                                    <div class="flex items-start gap-3">
                                        <div>
                                            <span class="mb-0.5 block text-theme-xs text-gray-500 dark:text-gray-400">
                                                Vehicle Code
                                            </span>
                                            <span class="text-theme-sm font-medium text-gray-700 dark:text-gray-400" x-text="selectedVehicle.vehicle_code || 'N/A'"></span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="mb-1 block text-theme-sm font-medium text-gray-700 dark:text-gray-400" x-text="selectedVehicle.vehicle_display || 'N/A'"></span>
                                        <span class="text-theme-xs text-gray-500 dark:text-gray-400" x-text="selectedVehicle.plate_number"></span>
                                    </div>
                                    <div>
                                        <span class="mb-1 block text-theme-sm font-medium"
                                            :class="selectedVehicle.availability === 'Available' ? 'text-green-600' : 'text-red-600'"
                                            x-text="selectedVehicle.availability || 'N/A'"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden input for vehicle_id -->
                    <input type="hidden" name="assign_vehicle_id" x-model="selectedVehicleId" value="" id="" name=""/>

                    <!-- Status -->
                    <div class="w-full px-2.5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Status
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="assign_status"
                                    name="status"
                                    x-model="assignStatus"
                                    @change="clearError('assign_status')"
                                    :class="errors.assign_status ? 'border-error-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Select Status</option>
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
                            :disabled="!selectedVehicle || isSubmitting">
                        <span x-show="!isSubmitting">Assign Vehicle</span>
                        <span x-show="isSubmitting">Assigning ...</span>
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
                                    `${$store.vehicleData.currentVehicle.type || 'Loading ... '} - ${$store.vehicleData.currentVehicle.plate_number || 'Loading ... '}` :
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
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Enter the amount you wish to save.</p>
        </div>

            <form class="flex flex-col" id="addSavingsForm" x-data="savingsTable" @submit.prevent="addSavings">
                @csrf
                <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                    <!-- Amount -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Amount
                        </label>
                        <input type="number" step="0.01"
                            id="savings_Amount"
                            name="savings_Amount"
                            @input="clearError('savings_Amount')"
                            @blur="validateField('savings_Amount', $event.target.value)"
                            :class="errors.savings_Amount ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <span x-show="errors.savings_Amount" x-text="errors.savings_Amount" class="text-xs text-error-500 mt-1"></span>
                    </div>

                    <!-- Payment Mode -->
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

                    <!-- Transaction Code -->
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
                            :disabled="$store.savingData?.isAdding">
                        <span x-show="!$store.savingData?.isAdding">Save</span>
                        <span x-show="$store.savingData?.isAdding">Transacting ...</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- withdrawSavingsModal -->
    <div x-show="withdrawSavingsModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="withdrawSavingsModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="withdrawSavingsModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Withdraw</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Enter the amount you wish to withdraw.</p>
        </div>

            <form class="flex flex-col" id="withdrawSavingsForm" x-data="savingsTable" @submit.prevent="withdrawSavings">
                @csrf
                <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                    <!-- Amount -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Amount
                        </label>
                        <input type="number" step="0.01"
                            id="savings_Amount"
                            name="savings_Amount"
                            @input="clearError('savings_Amount')"
                            @blur="validateField('savings_Amount', $event.target.value)"
                            :class="errors.savings_Amount ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        <span x-show="errors.savings_Amount" x-text="errors.savings_Amount" class="text-xs text-error-500 mt-1"></span>
                    </div>

                    <!-- Payment Mode -->
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

                    <!-- Transaction Code -->
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
                    <button @click="withdrawSavingsModal = false" type="button"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                            :disabled="$store.savingData?.isAdding">
                        <span x-show="!$store.savingData?.isAdding">Withdraw</span>
                        <span x-show="$store.savingData?.isAdding">Withdrawing ...</span>
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
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Enter the amount you wish to assign to member.</p>
        </div>

        <form class="flex flex-col" method="POST" x-data="loansTable" @submit.prevent="assignLoan">
            @csrf

            <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                <!-- Loan Type Dropdown -->
                <div class="w-full px-2.5">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Loan Type
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="loan_type_id"
                                name="loan_type_id"
                                x-model="$store.loanData.selectedLoanTypeId"
                                @change="Alpine.store('loanData').updateLoanDetails($event.target.value); clearError('loan_type')"
                                @blur="validateField('loan_type', $event.target.value)"
                                :class="errors.loan_type ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Loan Type</option>
                            <template x-for="loanType in $store.loanData.loanTypes" :key="loanType.loanId">
                                <option :value="loanType.loanId"
                                        x-text="loanType.loan_type_name + ' @ ' + loanType.interest_rate + '%'"></option>
                            </template>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.loan_type" x-text="errors.loan_type" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Min Borrowable (Read-only) -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Min Borrowable
                    </label>
                    <input readonly type="text"
                        id="min_borrowable"
                        name="min_borrowable"
                        :value="$store.loanData.currentLoanType ? 'KES ' + Number($store.loanData.currentLoanType.min_amount).toLocaleString() : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                </div>

                <!-- Max Borrowable (Read-only) -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Max Borrowable
                    </label>
                    <input readonly type="text"
                        id="max_borrowable"
                        name="max_borrowable"
                        :value="$store.loanData.currentLoanType ? 'KES ' + Number($store.loanData.currentLoanType.max_amount).toLocaleString() : ''"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                </div>

                <!-- Amount -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Loan Amount
                    </label>
                    <div class="relative">
                        <input type="number"
                            id="assign_amount"
                            name="amount"
                            step="0.01"
                            min="1"
                            placeholder="Amount to Borrow"
                            x-model="loanAmount"
                            @input="clearError('amount'); calculateAndUpdateTotal()"
                            @blur="validateField('amount', $event.target.value)"
                            :class="errors.amount ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                    <span x-show="errors.amount" x-text="errors.amount" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Period (Months) -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Period (Months)
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="loan_period"
                                name="loan_period"
                                x-model="loanPeriod"
                                @change="$store.loanData.calculateDates($event.target.value); clearError('loan_period'); calculateAndUpdateTotal()"
                                @blur="validateField('loan_period', $event.target.value)"
                                :class="errors.loan_period ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Period</option>
                            <option value="1">1 Month (30 Days)</option>
                            <option value="3">3 Months</option>
                            <option value="6">6 Months</option>
                            <option value="12">12 Months</option>
                            <option value="24">24 Months</option>
                            <option value="36">36 Months</option>
                            <option value="48">48 Months</option>
                            <option value="60">60 Months</option>
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.loan_period" x-text="errors.loan_period" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Start Date (Read-only) -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Start Date
                    </label>
                    <input type="text"
                        id="start_date"
                        name="start_date"
                        readonly
                        :value="$store.loanData.startDate"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                </div>

                <!-- End Date (Read-only) -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        End Date
                    </label>
                    <input type="text"
                        id="end_date"
                        name="end_date"
                        readonly
                        :value="$store.loanData.endDate"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                </div>

                <!-- Payment Mode -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Payment Mode
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="assign_payment_mode"
                                name="payment_mode"
                                x-model="paymentMode"
                                @change="handlePaymentModeChange($event.target.value, 'assign_'); clearError('payment_mode'); generateTransactionCode()"
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
                    <div class="relative">
                        <input type="text"
                            id="assign_transaction_code"
                            name="transaction_code"
                            x-model="transactionCode"
                            x-bind:readonly="paymentMode === 'Cash'"
                            @input="clearError('transaction_code')"
                            @blur="validateField('transaction_code', $event.target.value)"
                            :class="errors.transaction_code ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                    <span x-show="errors.transaction_code" x-text="errors.transaction_code" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Total Repayment Amount -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Total Repayment
                    </label>
                    <div class="relative">
                        <input type="text"
                            id="total_repayment"
                            name="total_repayment"
                            readonly
                            x-model="totalRepayment"
                            placeholder="Total Payable"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                    </div>
                </div>

                <!-- Loan Status -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Loan Status
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="assign_loan_status"
                                name="status"
                                x-model="loanStatus"
                                @change="clearError('loan_status')"
                                @blur="validateField('loan_status', $event.target.value)"
                                :class="errors.loan_status ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Status</option>
                            <option value="Approved">Approved</option>
                            <option value="Under Review">Under Review</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.loan_status" x-text="errors.loan_status" class="text-xs text-error-500 mt-1"></span>
                </div>
            </div>

            <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                <button @click="$store.loanData.assignLoanModal = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                    Cancel
                </button>
                <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                        :disabled="$store.loanData.isAssigning">
                    <span x-show="!$store.loanData.isAssigning">Assign Loan</span>
                    <span x-show="$store.loanData.isAssigning">Assigning...</span>
                </button>
            </div>
        </form>

        </div>
    </div>

    <!-- editLoansModal -->
    <div x-show="$store.loanData.editLoanModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="$store.loanData.editLoanModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
            <!-- close btn -->
            <button @click="$store.loanData.editLoanModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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

            <form class="flex flex-col" method="POST" x-data="loansTable" @submit.prevent="editLoan">
                @csrf
                <!-- Hidden field for loan ID when editing -->
                <input type="hidden" id="edit_loan_id" name="loan_id" x-model="$store.loanData.currentLoan.transactionId">

                <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                    <!-- Loan Type Dropdown -->
                    <div class="w-full px-2.5">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Loan Type
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="edit_loan_type_id"
                                    name="loan_type_id"
                                    x-model="$store.loanData.currentLoan.loanTypeId"
                                    @change="Alpine.store('loanData').updateLoanDetails($event.target.value); clearError('loan_type')"
                                    @blur="validateField('loan_type', $event.target.value)"
                                    :class="errors.loan_type ? 'border-red-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Select Loan Type</option>
                                <template x-for="loanType in $store.loanData.loanTypes" :key="loanType.loanId">
                                    <option :value="loanType.loanId"
                                            x-text="loanType.loan_type_name + ' @ ' + loanType.interest_rate + '%'"
                                            :selected="loanType.loanId == $store.loanData.currentLoan?.loanTypeId"></option>
                                </template>
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <span x-show="errors.loan_type" x-text="errors.loan_type" class="text-xs text-error-500 mt-1"></span>
                    </div>

                    <!-- Interest Rate (Read-only) -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Interest Rate
                        </label>
                        <input readonly type="text"
                            id="edit_interest_rate"
                            name="interest_rate"
                            x-bind:value="$store.loanData.currentLoanType ? $store.loanData.currentLoanType.interest_rate + '%' : ($store.loanData.currentLoan?.interestRate ? $store.loanData.currentLoan.interestRate + '%' : ($store.loanData.currentLoan?.loanTypeName ? $store.loanData.currentLoan.loanTypeName.split('@')[1]?.trim() || '' : ''))"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                    </div>

                    <!-- Max Borrowable (Read-only) -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Max Borrowable
                        </label>
                        <input readonly type="text"
                            id="edit_max_borrowable"
                            name="max_borrowable"
                            x-bind:value="$store.loanData.currentLoanType ? 'KES ' + Number($store.loanData.currentLoanType.max_amount).toLocaleString() : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                    </div>

                    <!-- Period (Months) -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Period (Months)
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="edit_loan_period"
                                    name="loan_period"
                                    x-model="$store.loanData.currentLoan.loanPeriod"
                                    @change="$store.loanData.calculateDates($event.target.value); clearError('loan_period')"
                                    @blur="validateField('loan_period', $event.target.value)"
                                    :class="errors.loan_period ? 'border-red-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Select Period</option>
                                <option value="1" :selected="$store.loanData.currentLoan?.loanPeriod == 1">1 Month (30 Days)</option>
                                <option value="3" :selected="$store.loanData.currentLoan?.loanPeriod == 3">3 Months</option>
                                <option value="6" :selected="$store.loanData.currentLoan?.loanPeriod == 6">6 Months</option>
                                <option value="12" :selected="$store.loanData.currentLoan?.loanPeriod == 12">12 Months</option>
                                <option value="24" :selected="$store.loanData.currentLoan?.loanPeriod == 24">24 Months</option>
                                <option value="36" :selected="$store.loanData.currentLoan?.loanPeriod == 36">36 Months</option>
                            </select>
                            <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <span x-show="errors.loan_period" x-text="errors.loan_period" class="text-xs text-error-500 mt-1"></span>
                    </div>

                    <!-- Payment Mode -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Payment Mode
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="edit_payment_mode"
                                    name="payment_mode"
                                    x-model="$store.loanData.currentLoan.transactionMode"
                                    @change="handlePaymentModeChange($event.target.value, 'edit_'); clearError('payment_mode')"
                                    @blur="validateField('payment_mode', $event.target.value)"
                                    :class="errors.payment_mode ? 'border-red-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Select Payment Mode</option>
                                <option value="Cash" :selected="$store.loanData.currentLoan?.transactionMode == 'Cash'">Cash</option>
                                <option value="MPesa" :selected="$store.loanData.currentLoan?.transactionMode == 'MPesa'">MPesa</option>
                                <option value="Bank" :selected="$store.loanData.currentLoan?.transactionMode == 'Bank'">Bank</option>
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <span x-show="errors.payment_mode" x-text="errors.payment_mode" class="text-xs text-error-500 mt-1"></span>
                    </div>

                    <!-- Amount -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Amount
                        </label>
                        <div class="relative">
                            <input type="number"
                                id="edit_amount"
                                name="amount"
                                step="0.01"
                                min="1"
                                x-model="$store.loanData.currentLoan.transactionLoanAmount"
                                @input="clearError('amount')"
                                @blur="validateField('amount', $event.target.value)"
                                :class="errors.amount ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        </div>
                        <span x-show="errors.amount" x-text="errors.amount" class="text-xs text-error-500 mt-1"></span>
                    </div>

                    <!-- Transaction Code -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Transaction Code
                        </label>
                        <div class="relative">
                            <input type="text"
                                id="edit_transaction_code"
                                name="transaction_code"
                                x-model="$store.loanData.currentLoan.transactionCode"
                                x-bind:readonly="$store.loanData.currentLoan?.transactionMode === 'Cash'"
                                @input="clearError('transaction_code')"
                                @blur="validateField('transaction_code', $event.target.value)"
                                :class="errors.transaction_code ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                        </div>
                        <span x-show="errors.transaction_code" x-text="errors.transaction_code" class="text-xs text-error-500 mt-1"></span>
                    </div>

                    <!-- Start Date (Read-only) -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Start Date
                        </label>
                        <input type="text"
                            id="edit_start_date"
                            name="start_date"
                            readonly
                            x-bind:value="formatDate($store.loanData.currentLoan?.startDate)"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                    </div>

                    <!-- End Date (Read-only) -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            End Date
                        </label>
                        <input type="text"
                            id="edit_end_date"
                            name="end_date"
                            readonly
                            x-bind:value="formatDate($store.loanData.currentLoan?.endDate) || calculateEndDate($store.loanData.currentLoan?.startDate, $store.loanData.currentLoan?.loanPeriod)"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                    </div>

                    <!-- Assigned Date (Read-only for edit) -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Assigned On
                        </label>
                        <input type="text"
                            id="edit_assigned_date"
                            name="assigned_date"
                            readonly
                            x-bind:value="formatDateTime($store.loanData.currentLoan?.transactionCreated)"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                    </div>

                    <!-- Loan Status -->
                    <div class="w-full px-2.5 xl:w-1/2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Loan Status
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select id="edit_loan_status"
                                    name="status"
                                    x-model="$store.loanData.currentLoan.transactionStatus"
                                    @change="clearError('loan_status')"
                                    @blur="validateField('loan_status', $event.target.value)"
                                    :class="errors.loan_status ? 'border-red-500' : ''"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                <option value="">Select Status</option>
                                <option value="Active" :selected="$store.loanData.currentLoan?.transactionStatus == 'Active'">Active</option>
                                <option value="Approved" :selected="$store.loanData.currentLoan?.transactionStatus == 'Approved'">Approved</option>
                                <option value="Under Review" :selected="$store.loanData.currentLoan?.transactionStatus == 'Under Review'">Under Review</option>
                                <option value="Pending" :selected="$store.loanData.currentLoan?.transactionStatus == 'Pending'">Pending</option>
                                <option value="Repaid" :selected="$store.loanData.currentLoan?.transactionStatus == 'Repaid'">Repaid</option>
                                <option value="Defaulted" :selected="$store.loanData.currentLoan?.transactionStatus == 'Defaulted'">Defaulted</option>
                                <option value="Cancelled" :selected="$store.loanData.currentLoan?.transactionStatus == 'Cancelled'">Cancelled</option>
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <span x-show="errors.loan_status" x-text="errors.loan_status" class="text-xs text-error-500 mt-1"></span>
                    </div>
                </div>

                <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                    <button @click="$store.loanData.editLoanModal = false" type="button"
                            class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                            :disabled="$store.loanData.isUpdating">
                        <span x-show="!$store.loanData.isUpdating">Update Loan</span>
                        <span x-show="$store.loanData.isUpdating">Updating ...</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- repayLoanModal -->
    <div x-show="repayLoanModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
        <div @click.outside="repayLoanModal = false" class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="repayLoanModal = false" class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
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
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">Repay Loan</h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">Enter the amount you wish to pay.</p>
        </div>

        <form class="flex flex-col" method="POST" x-data="loansTable" @submit.prevent="repayLoan">
            @csrf

            <div class="-mx-2.5 flex flex-wrap gap-y-5 p-4">
                <!-- Select Loan to Repay -->
                <div class="w-full px-2.5">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Select Loan to Repay
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="repay_loan_id"
                                name="loan_id"
                                @change="clearError('repay_loan')"
                                @blur="validateField('repay_loan', $event.target.value)"
                                :class="errors.repay_loan ? 'border-red-500' : ''"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            <option value="">Select Loan</option>
                            <template x-for="loan in loans" :key="loan.transactionId">
                                <option :value="loan.transactionId"
                                        x-text="loan.loan_type_name + ' - KES ' + Number(loan.transactionLoanAmount).toLocaleString() + ' (' + loan.transactionLoanStatus + ')'"></option>
                            </template>
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span x-show="errors.repay_loan" x-text="errors.repay_loan" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Borrowed (Read-only) -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Borrowed
                    </label>
                    <input readonly type="text"
                        id="borrowed_amount"
                        name="borrowed_amount"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                </div>

                <!-- Period (Months) (Read-only) -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Period (Months)
                    </label>
                    <input readonly type="text"
                        id="loan_period_display"
                        name="loan_period_display"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                </div>

                <!-- Start Date (Read-only) -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Start Date
                    </label>
                    <input type="text"
                        id="loan_start_date"
                        name="loan_start_date"
                        readonly
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                </div>

                <!-- End Date (Read-only) -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        End Date
                    </label>
                    <input type="text"
                        id="loan_end_date"
                        name="loan_end_date"
                        readonly
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 bg-gray-50">
                </div>

                <div class="w-full px-2.5 border-b border-gray-200 dark:border-gray-700 my-2"></div>

                <!-- Amount to Pay -->
                <div class="w-full px-2.5">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Amount
                    </label>
                    <div class="relative">
                        <input type="number"
                            id="repay_amount"
                            name="amount"
                            step="0.01"
                            min="1"
                            @input="clearError('amount')"
                            @blur="validateField('amount', $event.target.value)"
                            :class="errors.amount ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                    <span x-show="errors.amount" x-text="errors.amount" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Payment Mode -->
                <div class="w-full px-2.5 xl:w-1/2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Payment Mode
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="repay_payment_mode"
                                name="payment_mode"
                                @change="handlePaymentModeChange($event.target.value, 'repay_'); clearError('payment_mode')"
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
                    <div class="relative">
                        <input type="text"
                            id="repay_transaction_code"
                            name="transaction_code"
                            readonly
                            @input="clearError('transaction_code')"
                            @blur="validateField('transaction_code', $event.target.value)"
                            :class="errors.transaction_code ? 'border-red-500' : ''"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                    <span x-show="errors.transaction_code" x-text="errors.transaction_code" class="text-xs text-error-500 mt-1"></span>
                </div>

                <!-- Status -->
                <div class="w-full px-2.5">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>
                    <div class="relative z-20 bg-transparent">
                        <select id="repay_status"
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
                <button @click="repayLoanModal = false" type="button"
                        class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-error-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                    Cancel
                </button>
                <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto"
                        :disabled="$store.loanData.isRepaying">
                    <span x-show="!$store.loanData.isRepaying">Pay Loan</span>
                    <span x-show="$store.loanData.isRepaying">Paying...</span>
                </button>
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

                    <!-- De-Activate Account Component -->
                    <div x-data="accountDeactivation">
                        <h4 class="sm:text-title-sm mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                            Confirm Account De-Activation
                        </h4>
                        <p class="text-sm leading-6 text-gray-500 dark:text-gray-400">
                            Are you sure you want to De-Activate this member's account?.
                        </p>

                        <!-- Error display -->
                        <template x-if="errors.general">
                            <div class="mt-4 rounded-lg bg-error-50 p-4 text-sm text-error-700 dark:bg-error-500/15 dark:text-error-500">
                                <p x-text="errors.general"></p>
                            </div>
                        </template>

                        <div class="mt-8 flex w-full items-center justify-center gap-3">
                            <button
                                @click="closeDeactivationModal"
                                type="button"
                                class="shadow-theme-xs flex justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                No, Cancel
                            </button>
                            <button
                                @click="deactivateAccount"
                                :disabled="isDeactivating"
                                type="button"
                                class="shadow-theme-xs flex justify-center rounded-lg bg-red-500 px-4 py-3 text-sm font-medium text-white hover:bg-red-600 disabled:opacity-70 disabled:cursor-not-allowed">
                                <span x-show="!isDeactivating">Yes, Deactivate Account</span>
                                <span x-show="isDeactivating" class="flex items-center">
                                    Deactivating...
                                </span>
                            </button>
                        </div>
                    </div>

                </div>

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

                // Search Assign Vehicle
                vehicleSearchTerm: '',
                searchResults: [],
                isSearching: false,
                selectedVehicle: null,
                selectedVehicleId: null,
                assignStatus: '',
                isSubmitting: false,

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
                    // Get the member ID from the URL path
                    let memberId = window.location.pathname.split('/').pop();
                    let url = '/treasurer/bodaboda-member/' + memberId + '/vehicles/nonmember/details';
                    console.log('Fetching:', url);

                    fetch(url)
                        .then(res => res.json())
                        .then(data => {
                            console.log('Non-member vehicles response:', data);
                            if (data.success) {
                                this.nonMemberVehicles = [...(data.vehicles || [])];
                                console.log('Non-member vehicles set:', this.nonMemberVehicles);

                                // Find the currently assigned vehicle (availability = 'Assigned')
                                const currentVehicle = this.nonMemberVehicles.find(v => v.availability === 'Assigned');
                                if (currentVehicle) {
                                    Alpine.store('vehicleData').currentVehicle = currentVehicle;
                                } else {
                                    Alpine.store('vehicleData').currentVehicle = null;
                                }

                                this.pageNonMember = 1;
                            }
                        })
                        .catch(error => console.error('Error loading non-member vehicles:', error));
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

                async loadInitialVehicles() {
                    if (this.vehicleSearchTerm.length === 0) {
                        this.isSearching = true;
                        try {
                            const response = await fetch(`/vehicles/search?limit=5`);
                            const data = await response.json();
                            if (data.success) {
                                this.searchResults = data.vehicles;
                            }
                        } catch (error) {
                            console.error('Error loading vehicles:', error);
                        } finally {
                            this.isSearching = false;
                        }
                    }
                },

                async searchVehicles() {
                    if (this.vehicleSearchTerm.length < 1) {
                        this.searchResults = [];
                        return;
                    }

                    this.isSearching = true;

                    try {
                        const response = await fetch(`/vehicles/search?q=${encodeURIComponent(this.vehicleSearchTerm)}`);
                        const data = await response.json();

                        if (data.success) {
                            this.searchResults = data.vehicles;
                        }
                    } catch (error) {
                        console.error('Search error:', error);
                    } finally {
                        this.isSearching = false;
                    }
                },

                selectVehicle(vehicle) {
                    this.selectedVehicle = vehicle;
                    this.selectedVehicleId = vehicle.vehicleId;
                    this.vehicleSearchTerm = vehicle.plate_number;
                    this.searchResults = [];
                },

                async assignVehicle() {
                    if (!this.selectedVehicle) {
                        alert('Please select a vehicle first');
                        return;
                    }

                    if (!this.assignStatus) {
                        alert('Please select a status');
                        return;
                    }

                    this.isSubmitting = true;

                    try {
                        const formData = {
                            vehicle_id: this.selectedVehicleId,
                            status: this.assignStatus,
                            _token: document.querySelector('input[name="_token"]')?.value
                        };

                        const response = await fetch('/bodaboda-member/' + this.memberId + '/vehicle/assign', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value
                            },
                            body: JSON.stringify(formData)
                        });

                        const data = await response.json();

                        if (data.success) {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    } catch (error) {
                        alert('Error assigning vehicle. Please try again.');
                        console.error('Error:', error);
                    } finally {
                        this.isSubmitting = false;
                        this.assignMemberVehicle = false;
                    }
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
                memberBalance: 0,
                memberBalanceFormatted: 'KES 0.00',
                lastTransaction: null // Add this to store the last transaction for printing
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
                            this.applyFilters();
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
                                    return transDate >= today;
                                case 'Weekly':
                                    const weekAgo = new Date(today);
                                    weekAgo.setDate(weekAgo.getDate() - 7);
                                    return transDate >= weekAgo;
                                case 'Monthly':
                                    const monthAgo = new Date(today);
                                    monthAgo.setDate(monthAgo.getDate() - 30);
                                    return transDate >= monthAgo;
                                case 'Yearly':
                                    const yearAgo = new Date(today);
                                    yearAgo.setDate(yearAgo.getDate() - 365);
                                    return transDate >= yearAgo;
                                default:
                                    return true;
                            }
                        });
                    }

                    this.contributions = filtered;
                    this.page = 1;
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

                // UPDATED contribute() method with receipt printing
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
                                // Store the transaction data for receipt
                                Alpine.store('contributionData').lastTransaction = data.transaction;

                                // Show success message with print prompt
                                const printReceipt = confirm(
                                    '✅ Contribution saved successfully!\n\nTransaction Code: ' +
                                    (data.transaction?.transaction_code || 'N/A') +
                                    '\nAmount: KES ' + parseFloat(formData.amount).toFixed(2) +
                                    '\n\nWould you like to print the receipt?'
                                );

                                if (printReceipt) {
                                    // User wants to print - use hidden iframe approach
                                    this.printReceipt(data.transaction || formData);
                                } else {
                                    // User doesn't want to print, just reload
                                    window.location.reload();
                                }
                            } else {
                                alert('Error: ' + data.message);
                                window.location.reload();
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

                // NEW: Print receipt method
                printReceipt(transaction) {
                    // Create receipt HTML
                    const receiptHTML = this.generateReceiptHTML(transaction);

                    // Create filename: HH_mm_ss_dd_mm_Contribution_Receipt.pdf
                    const now = new Date();
                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const seconds = String(now.getSeconds()).padStart(2, '0');
                    const day = String(now.getDate()).padStart(2, '0');
                    const month = String(now.getMonth() + 1).padStart(2, '0');
                    const filename = `${hours}_${minutes}_${seconds}_${day}_${month}_Contribution_Receipt.pdf`;

                    // Create hidden iframe
                    const iframe = document.createElement('iframe');
                    iframe.style.position = 'absolute';
                    iframe.style.width = '0';
                    iframe.style.height = '0';
                    iframe.style.border = 'none';
                    iframe.style.opacity = '0';
                    iframe.style.pointerEvents = 'none';

                    document.body.appendChild(iframe);

                    // Write receipt to iframe with compact styling
                    const iframeDoc = iframe.contentWindow.document;
                    iframeDoc.open();
                    iframeDoc.write(`
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>Contribution Receipt</title>
                            <style>
                                @media print {
                                    @page {
                                        size: 80mm auto; /* 80mm ≈ 3.15 inches */
                                        margin: 2mm;
                                    }
                                    body {
                                        font-family: 'Courier New', monospace;
                                        font-size: 10pt;
                                        line-height: 1.2;
                                        max-width: 72mm;
                                        margin: 0 auto;
                                        padding: 0;
                                    }
                                    .receipt {
                                        white-space: pre-wrap;
                                        padding: 2mm;
                                    }
                                    .receipt-header {
                                        text-align: center;
                                        margin-bottom: 1mm;
                                    }
                                    .receipt-header img {
                                        max-width: 15mm;
                                        margin: 0 auto;
                                    }
                                    .receipt-header h2 {
                                        margin: 1mm 0;
                                        font-size: 12pt;
                                        font-weight: bold;
                                    }
                                    .receipt-header small {
                                        font-size: 8pt;
                                        display: block;
                                    }
                                    .receipt-line {
                                        border-top: 1px dashed #000;
                                        margin: 1mm 0;
                                    }
                                    .receipt-row {
                                        margin: 1.5mm 0;
                                        font-size: 9pt;
                                    }
                                    .receipt-footer {
                                        text-align: center;
                                        margin: 0.5mm 0;
                                        font-size: 8pt;
                                    }
                                    .text-bold {
                                        font-weight: bold;
                                    }
                                    .amount {
                                        font-size: 11pt;
                                        font-weight: bold;
                                    }
                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                    }
                                    td {
                                        padding: 0.5mm 0;
                                        font-size: 9pt;
                                    }
                                    .label {
                                        width: 40%;
                                    }
                                    .value {
                                        width: 60%;
                                        font-weight: bold;
                                    }
                                }
                            </style>
                        </head>
                        <body>
                            <div class="receipt">
                                ${receiptHTML}
                            </div>
                            <script>
                                window.onload = function() {
                                    // Set PDF filename in print dialog if browser supports it
                                    const style = document.createElement('style');
                                    style.innerHTML = \`
                                        @page {
                                            size: 80mm auto;
                                            margin: 2mm;
                                            @bottom-center {
                                                content: "Page " counter(page);
                                                font-size: 7pt;
                                            }
                                        }
                                    \`;
                                    document.head.appendChild(style);

                                    setTimeout(() => {
                                        window.print();
                                    }, 100);

                                    window.onafterprint = function() {
                                        window.parent.location.reload();
                                    };

                                    setTimeout(() => {
                                        window.parent.location.reload();
                                    }, 5000);
                                }
                            <\/script>
                        </body>
                        </html>
                    `);
                    iframeDoc.close();
                },

                // NEW: Generate compact receipt HTML
                generateReceiptHTML(transaction) {
                    // Format date: Mar 03, 2026 18:40
                    const date = new Date();
                    const formattedDate = date.toLocaleString('en-US', {
                        month: 'short',
                        day: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    }).replace(',', '');

                    const memberId = '{{ $memberId }}';
                    const amount = parseFloat(transaction.amount || 0).toFixed(2);
                    const paymentMode = transaction.payment_mode || 'N/A';
                    const transactionCode = transaction.transaction_code || 'N/A';
                    const status = transaction.status || 'Completed';

                    // Get auth ID from meta tag or use placeholder
                    const authId = '{{ Auth::id() }}';

                    return `
                        <div class="receipt-header">
                            <img src="{{ asset('company_logo.png') }}" alt="Logo" style="max-width: 15mm;" />
                            <h2>KFBCL</h2>
                            <small>Growing together</small>
                        </div>

                        <div class="receipt-line"></div>

                        <table>
                            <tr>
                                <td class="label">Type:</td>
                                <td class="value">Contribution</td>
                            </tr>
                            <tr>
                                <td class="label">Member:</td>
                                <td class="value">${memberId}</td>
                            </tr>
                            <tr>
                                <td class="label">By:</td>
                                <td class="value">${authId}</td>
                            </tr>
                        </table>

                        <div class="receipt-line"></div>

                        <table>
                            <tr>
                                <td class="label">Amount:</td>
                                <td class="value amount">KES ${amount}</td>
                            </tr>
                            <tr>
                                <td class="label">Mode:</td>
                                <td class="value">${paymentMode}</td>
                            </tr>
                            <tr>
                                <td class="label">Code:</td>
                                <td class="value">${transactionCode}</td>
                            </tr>
                            <tr>
                                <td class="label">Status:</td>
                                <td class="value">${status}</td>
                            </tr>
                            <tr>
                                <td class="label">Date:</td>
                                <td class="value">${formattedDate}</td>
                            </tr>
                        </table>

                        <div class="receipt-line"></div>

                        <div class="receipt-footer">
                            Thank you<br>
                            &copy; KFBCL<br>
                            Growing together
                        </div>

                        <div class="receipt-line"></div>

                    `;
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
            // Initialize the store first
            Alpine.store('savingData', {
                editSavingModal: false,
                currentSaving: null,
                isAdding: false,
                isUpdating: false,
                lastTransaction: null // Add this to store the last transaction for printing
            });

            Alpine.data('savingsTable', () => ({
                savings: [],
                page: 1,
                itemsPerPage: 10,
                savingsBalance: 0,
                errors: {},
                savingsModal: false,
                withdrawSavingsModal: false,

                init() {
                    console.log('Savings Table Initialized'); // Debug
                    this.loadSavings();
                    this.loadBalance();
                },

                loadSavings() {
                    fetch('/bodaboda-member/{{ $memberId }}/savings')
                        .then(res => res.json())
                        .then(data => {
                            this.savings = data;
                        })
                        .catch(error => console.error('Error loading savings:', error));
                },

                loadBalance() {
                    fetch('/bodaboda-member/{{ $memberId }}/savings-balance')
                        .then(res => res.json())
                        .then(data => {
                            this.savingsBalance = data.balance;
                        })
                        .catch(error => console.error('Error loading balance:', error));
                },

                validateField(field, value) {
                    if (!value || value === '') {
                        this.errors[field] = 'This field is required';
                    } else if (field === 'savings_Amount' && (value <= 0 || isNaN(value))) {
                        this.errors[field] = 'Amount must be greater than 0';
                    } else {
                        delete this.errors[field];
                    }
                },

                clearError(field) {
                    if (this.errors[field]) {
                        delete this.errors[field];
                    }
                },

                validateForm(data) {
                    this.errors = {};

                    if (!data.savings_Amount || data.savings_Amount <= 0) {
                        this.errors.savings_Amount = 'Amount must be greater than 0';
                    }
                    if (!data.payment_mode) {
                        this.errors.payment_mode = 'Please select payment mode';
                    }
                    if (!data.Status) {
                        this.errors.Status = 'Please select status';
                    }

                    // Validate transaction code for non-cash payments
                    if (data.payment_mode !== 'Cash' && (!data.transaction_code || data.transaction_code === '')) {
                        this.errors.transaction_code = 'Transaction code is required for non-cash payments';
                    }

                    return Object.keys(this.errors).length === 0;
                },

                // UPDATED addSavings() method with receipt printing
                addSavings() {
                    console.log('Add Savings clicked'); // Debug
                    const form = document.getElementById('addSavingsForm');
                    const formData = new FormData(form);
                    const data = Object.fromEntries(formData.entries());

                    if (!this.validateForm(data)) {
                        return;
                    }

                    // Set loading state
                    Alpine.store('savingData').isAdding = true;

                    fetch('/bodaboda-member/{{ $memberId }}/savings/add', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Store transaction data for receipt
                            Alpine.store('savingData').lastTransaction = data.transaction;

                            this.savingsModal = false;
                            this.loadSavings();
                            this.loadBalance();
                            form.reset();
                            this.errors = {};

                            // Show success message with print prompt
                            const printReceipt = confirm(
                                '✅ Savings added successfully!\n\nTransaction Code: ' +
                                (data.transaction?.transaction_code || 'N/A') +
                                '\nAmount: KES ' + parseFloat(data.savings_Amount || 0).toFixed(2) +
                                '\n\nWould you like to print the receipt?'
                            );

                            if (printReceipt) {
                                // User wants to print - use hidden iframe approach
                                this.printReceipt(data.transaction || {
                                    amount: data.savings_Amount,
                                    payment_mode: data.payment_mode,
                                    transaction_code: data.transaction_code,
                                    status: data.Status
                                });
                            } else {
                                // User doesn't want to print, just reload
                                window.location.reload();
                            }
                        } else {
                            alert(data.message);
                            Alpine.store('savingData').isAdding = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error adding savings: ' + error.message);
                        Alpine.store('savingData').isAdding = false;
                    });
                },

                // UPDATED withdrawSavings() method with receipt printing
                withdrawSavings() {
                    console.log('Withdraw Savings clicked'); // Debug
                    const form = document.getElementById('withdrawSavingsForm');
                    const formData = new FormData(form);
                    const data = Object.fromEntries(formData.entries());

                    if (!this.validateForm(data)) {
                        return;
                    }

                    Alpine.store('savingData').isAdding = true;

                    fetch('/bodaboda-member/{{ $memberId }}/savings/withdraw', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Store transaction data for receipt
                            Alpine.store('savingData').lastTransaction = data.transaction;

                            this.withdrawSavingsModal = false;
                            this.loadSavings();
                            this.loadBalance();
                            form.reset();
                            this.errors = {};

                            // Show success message with print prompt
                            const printReceipt = confirm(
                                '✅ Withdrawal successful!\n\nTransaction Code: ' +
                                (data.transaction?.transaction_code || 'N/A') +
                                '\nAmount: KES ' + parseFloat(data.savings_Amount || 0).toFixed(2) +
                                '\n\nWould you like to print the receipt?'
                            );

                            if (printReceipt) {
                                // User wants to print - use hidden iframe approach
                                this.printReceipt(data.transaction || {
                                    amount: data.savings_Amount,
                                    payment_mode: data.payment_mode,
                                    transaction_code: data.transaction_code,
                                    status: data.Status,
                                    transaction_type: 'Withdrawal'
                                });
                            } else {
                                // User doesn't want to print, just reload
                                window.location.reload();
                            }
                        } else {
                            alert(data.message);
                            Alpine.store('savingData').isAdding = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error processing withdrawal: ' + error.message);
                        Alpine.store('savingData').isAdding = false;
                    });
                },

                // NEW: Print receipt method (adapted from contributions)
                printReceipt(transaction) {
                    // Determine transaction type for filename
                    const transactionType = transaction.transaction_type === 'Withdrawal' ? 'Withdrawal' : 'Savings';

                    // Create receipt HTML
                    const receiptHTML = this.generateReceiptHTML(transaction, transactionType);

                    // Create filename: HH_mm_ss_dd_mm_Savings_Receipt.pdf
                    const now = new Date();
                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const seconds = String(now.getSeconds()).padStart(2, '0');
                    const day = String(now.getDate()).padStart(2, '0');
                    const month = String(now.getMonth() + 1).padStart(2, '0');
                    const filename = `${hours}_${minutes}_${seconds}_${day}_${month}_${transactionType}_Receipt.pdf`;

                    // Create hidden iframe
                    const iframe = document.createElement('iframe');
                    iframe.style.position = 'absolute';
                    iframe.style.width = '0';
                    iframe.style.height = '0';
                    iframe.style.border = 'none';
                    iframe.style.opacity = '0';
                    iframe.style.pointerEvents = 'none';

                    document.body.appendChild(iframe);

                    // Write receipt to iframe with compact styling
                    const iframeDoc = iframe.contentWindow.document;
                    iframeDoc.open();
                    iframeDoc.write(`
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>${transactionType} Receipt</title>
                            <style>
                                @media print {
                                    @page {
                                        size: 80mm auto; /* 80mm ≈ 3.15 inches */
                                        margin: 2mm;
                                    }
                                    body {
                                        font-family: 'Courier New', monospace;
                                        font-size: 10pt;
                                        line-height: 1.2;
                                        max-width: 72mm;
                                        margin: 0 auto;
                                        padding: 0;
                                    }
                                    .receipt {
                                        white-space: pre-wrap;
                                        padding: 2mm;
                                    }
                                    .receipt-header {
                                        text-align: center;
                                        margin-bottom: 1mm;
                                    }
                                    .receipt-header img {
                                        max-width: 15mm;
                                        margin: 0 auto;
                                    }
                                    .receipt-header h2 {
                                        margin: 1mm 0;
                                        font-size: 12pt;
                                        font-weight: bold;
                                    }
                                    .receipt-header small {
                                        font-size: 8pt;
                                        display: block;
                                    }
                                    .receipt-line {
                                        border-top: 1px dashed #000;
                                        margin: 1mm 0;
                                    }
                                    .receipt-row {
                                        margin: 1.5mm 0;
                                        font-size: 9pt;
                                    }
                                    .receipt-footer {
                                        text-align: center;
                                        margin: 0.5mm 0;
                                        font-size: 8pt;
                                    }
                                    .text-bold {
                                        font-weight: bold;
                                    }
                                    .amount {
                                        font-size: 11pt;
                                        font-weight: bold;
                                    }
                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                    }
                                    td {
                                        padding: 0.5mm 0;
                                        font-size: 9pt;
                                    }
                                    .label {
                                        width: 40%;
                                    }
                                    .value {
                                        width: 60%;
                                        font-weight: bold;
                                    }
                                }
                            </style>
                        </head>
                        <body>
                            <div class="receipt">
                                ${receiptHTML}
                            </div>
                            <script>
                                window.onload = function() {
                                    // Set PDF filename in print dialog if browser supports it
                                    const style = document.createElement('style');
                                    style.innerHTML = \`
                                        @page {
                                            size: 80mm auto;
                                            margin: 2mm;
                                            @bottom-center {
                                                content: "Page " counter(page);
                                                font-size: 7pt;
                                            }
                                        }
                                    \`;
                                    document.head.appendChild(style);

                                    setTimeout(() => {
                                        window.print();
                                    }, 100);

                                    window.onafterprint = function() {
                                        window.parent.location.reload();
                                    };

                                    setTimeout(() => {
                                        window.parent.location.reload();
                                    }, 5000);
                                }
                            <\/script>
                        </body>
                        </html>
                    `);
                    iframeDoc.close();
                },

                // NEW: Generate compact receipt HTML for savings
                generateReceiptHTML(transaction, transactionType = 'Savings') {
                    // Format date: Mar 03, 2026 18:40
                    const date = new Date();
                    const formattedDate = date.toLocaleString('en-US', {
                        month: 'short',
                        day: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    }).replace(',', '');

                    const memberId = '{{ $memberId }}';
                    const amount = parseFloat(transaction.amount || transaction.savings_Amount || 0).toFixed(2);
                    const paymentMode = transaction.payment_mode || 'N/A';
                    const transactionCode = transaction.transaction_code || 'N/A';
                    const status = transaction.status || 'Completed';

                    // Get auth ID from meta tag or use placeholder
                    const authId = '{{ Auth::id() }}';

                    return `
                        <div class="receipt-header">
                            <img src="{{ asset('company_logo.png') }}" alt="Logo" style="max-width: 15mm;" />
                            <h2>KFBCL</h2>
                            <small>Growing together</small>
                        </div>

                        <div class="receipt-line"></div>

                        <table>
                            <tr>
                                <td class="label">Type:</td>
                                <td class="value">${transactionType}</td>
                            </tr>
                            <tr>
                                <td class="label">Member:</td>
                                <td class="value">${memberId}</td>
                            </tr>
                            <tr>
                                <td class="label">By:</td>
                                <td class="value">${authId}</td>
                            </tr>
                        </table>

                        <div class="receipt-line"></div>

                        <table>
                            <tr>
                                <td class="label">Amount:</td>
                                <td class="value amount">KES ${amount}</td>
                            </tr>
                            <tr>
                                <td class="label">Mode:</td>
                                <td class="value">${paymentMode}</td>
                            </tr>
                            <tr>
                                <td class="label">Code:</td>
                                <td class="value">${transactionCode}</td>
                            </tr>
                            <tr>
                                <td class="label">Status:</td>
                                <td class="value">${status}</td>
                            </tr>
                            <tr>
                                <td class="label">Date:</td>
                                <td class="value">${formattedDate}</td>
                            </tr>
                        </table>

                        <div class="receipt-line"></div>

                        <div class="receipt-footer">
                            Thank you<br>
                            &copy; KFBCL<br>
                            Growing together
                        </div>

                        <div class="receipt-line"></div>
                    `;
                },

                updateSavings() {
                    console.log('Update Savings clicked'); // Debug
                    const form = document.getElementById('editSavingsForm');
                    const formData = new FormData(form);
                    const data = Object.fromEntries(formData.entries());
                    const transactionId = document.getElementById('edit_transaction_id').value;

                    if (!this.validateForm(data)) {
                        return;
                    }

                    Alpine.store('savingData').isUpdating = true;

                    fetch(`/bodaboda-member/{{ $memberId }}/savings/${transactionId}/edit`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Alpine.store('savingData').editSavingModal = false;
                            this.loadSavings();
                            this.loadBalance();
                            form.reset();
                            this.errors = {};
                            alert('Savings transaction updated successfully!');
                            location.reload();
                        } else {
                            alert(data.message);
                            Alpine.store('savingData').isUpdating = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error updating savings: ' + error.message);
                        Alpine.store('savingData').isUpdating = false;
                    });
                },

                // Pagination methods
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
                    Alpine.store('savingData').currentSaving = saving;
                    Alpine.store('savingData').editSavingModal = true;

                    // Populate the edit form
                    setTimeout(() => {
                        document.getElementById('edit_savings_Amount').value = saving.transactionAmount;
                        document.getElementById('edit_payment_mode').value = saving.transactionMode;
                        document.getElementById('edit_transaction_code').value = saving.transactionCode;
                        document.getElementById('edit_Status').value = saving.transactionStatus;
                        document.getElementById('edit_transaction_id').value = saving.transactionId;
                    }, 100);
                }
            }));
        });
    </script>

    <!-- Member Loans -->
    <script>

        document.addEventListener('alpine:init', () => {
            // Store for loan data and modal states
            Alpine.store('loanData', {
                currentLoan: null,
                currentLoanType: null,
                currentTransaction: null,
                editLoanModal: false,
                repayLoanModal: false,
                assignLoanModal: false,
                loanTypes: [],
                isAssigning: false,
                isRepaying: false,
                isUpdating: false,

                // Auto-calculated fields
                startDate: '',
                endDate: '',

                // Initialize loan types
                init() {
                    this.loadLoanTypes();
                },

                loadLoanTypes() {
                    fetch('/loans/all-data')
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                this.loanTypes = data.loanTypes;
                            }
                        });
                },

                updateLoanDetails(loanTypeId) {
                    const selected = this.loanTypes.find(lt => lt.loanId == loanTypeId);
                    if (selected) {
                        this.currentLoanType = selected;

                        // Also update the current loan's loanTypeId if it exists
                        if (this.currentLoan) {
                            this.currentLoan.loanTypeId = loanTypeId;
                        }
                    }
                },

                calculateDates(periodMonths) {
                    if (!periodMonths) return;

                    const today = new Date();
                    const start = new Date(today);
                    start.setDate(start.getDate() + 30);

                    const end = new Date(start);
                    end.setDate(end.getDate() + (parseInt(periodMonths) * 30));

                    this.startDate = start.toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    });

                    this.endDate = end.toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    });
                }
            });

            Alpine.data('loansTable', () => ({
                loans: [],
                page: 1,
                itemsPerPage: 10,
                errors: {},
                memberActiveLoans: 0,

                // New properties for assign form
                loanAmount: '',
                loanPeriod: '',
                paymentMode: '',
                transactionCode: '',
                loanStatus: '',
                totalRepayment: '',

                // Date formatting functions
                formatDate(dateString) {
                    if (!dateString) return '';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('en-US', {
                        month: 'short',
                        day: '2-digit',
                        year: 'numeric'
                    });
                },

                formatDateTime(dateTimeString) {
                    if (!dateTimeString) return '';
                    const date = new Date(dateTimeString);
                    return date.toLocaleDateString('en-US', {
                        month: 'short',
                        day: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    }).replace(',', '');
                },

                calculateEndDate(startDate, periodMonths) {
                    if (!startDate || !periodMonths) return '';
                    const date = new Date(startDate);
                    date.setDate(date.getDate() + (parseInt(periodMonths) * 30));
                    return date.toLocaleDateString('en-US', {
                        month: 'short',
                        day: '2-digit',
                        year: 'numeric'
                    });
                },

                // Calculate total loan repayment using formula: A = P * (r(1+r)^n) / ((1+r)^n - 1)
                calculateTotalLoan(amount, interestRate, periodMonths) {
                    if (!amount || !interestRate || !periodMonths || amount <= 0 || interestRate <= 0 || periodMonths <= 0) {
                        return 0;
                    }

                    // Convert annual interest rate to monthly (divide by 12) and percentage to decimal (divide by 100)
                    const monthlyRate = (parseFloat(interestRate) / 100) / 12;
                    const principal = parseFloat(amount);
                    const months = parseInt(periodMonths);

                    // Formula: P * (r * (1 + r)^n) / ((1 + r)^n - 1)
                    const onePlusR = 1 + monthlyRate;
                    const powerN = Math.pow(onePlusR, months);

                    // Monthly payment
                    const monthlyPayment = principal * (monthlyRate * powerN) / (powerN - 1);

                    // Total repayment amount
                    const totalLoan = monthlyPayment * months;

                    return Math.round(totalLoan * 100) / 100; // Round to 2 decimal places
                },

                // Normalize loan data to handle different property names
                normalizeLoanData(loan) {
                    return {
                        id: loan.transactionId || loan.id || '',
                        transactionId: loan.transactionId || loan.id || '',
                        loanTypeId: loan.loan_type_id || loan.loanTypeId || '',
                        loanTypeName: loan.loan_type_name || loan.loanTypeName || '',
                        transactionLoanAmount: loan.transactionLoanAmount || loan.amount || '',
                        transactionMode: loan.transactionMode || loan.payment_mode || loan.transaction_mode || '',
                        transactionCode: loan.transactionCode || loan.transaction_code || '',
                        loanPeriod: loan.transactionLoanPeriod || loan.loanPeriod || loan.period_months || '',
                        transactionStatus: loan.transactionLoanStatus || loan.transactionStatus || loan.status || '',
                        startDate: loan.transactionLoanStartDate || loan.startDate || loan.start_date || '',
                        endDate: loan.endDate || loan.end_date || '',
                        transactionCreated: loan.transactionCreated || loan.created_at || loan.assignedDate || loan.assigned_date || '',
                        interestRate: loan.interest_rate || loan.interestRate || '',
                        outstandingBalance: loan.outstanding_balance || 0,
                        lastRepayment: loan.last_repayment || null
                    };
                },

                init() {
                    // Load member-specific loans data
                    fetch('/bodaboda-member/{{ $memberId }}/loans/current')
                        .then(res => res.json())
                        .then(data => {
                            console.log('Loans data received:', data); // Debug log
                            if (data.success) {
                                this.loans = data.loans;
                                console.log('Loans set:', this.loans); // Debug log
                            } else {
                                console.error('Failed to load loans:', data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error loading loans:', error);
                        });

                    // Load loan types for dropdown
                    fetch('/loans/all-data')
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Alpine.store('loanData').loanTypes = data.loanTypes;
                            }
                        });

                    // Load member active loans count
                    this.loadMemberActiveLoans();

                    // Listen for edit events
                    window.addEventListener('open-edit-loan-modal', (event) => {
                        const rawLoan = event.detail.loan;

                        // Debug: Log the raw loan data
                        console.log('Raw loan data received:', rawLoan);

                        // Normalize the loan data
                        const normalizedLoan = this.normalizeLoanData(rawLoan);
                        console.log('Normalized loan data:', normalizedLoan);
                        console.log('Transaction Created:', normalizedLoan.transactionCreated);

                        // Store the normalized loan data
                        Alpine.store('loanData').currentLoan = normalizedLoan;

                        // Open the modal
                        Alpine.store('loanData').editLoanModal = true;

                        // Clear any previous errors
                        this.errors = {};

                        // Find and set the current loan type
                        if (normalizedLoan.loanTypeId && Alpine.store('loanData').loanTypes.length > 0) {
                            const selectedType = Alpine.store('loanData').loanTypes.find(lt => lt.loanId == normalizedLoan.loanTypeId);
                            if (selectedType) {
                                Alpine.store('loanData').currentLoanType = selectedType;
                            }
                        }

                        // Direct DOM manipulation as fallback
                        setTimeout(() => {
                            // Hidden loan ID
                            const loanIdField = document.getElementById('edit_loan_id');
                            if (loanIdField) loanIdField.value = normalizedLoan.transactionId;

                            // Loan Type
                            const loanTypeField = document.getElementById('edit_loan_type_id');
                            if (loanTypeField && normalizedLoan.loanTypeId) {
                                loanTypeField.value = normalizedLoan.loanTypeId;
                                loanTypeField.dispatchEvent(new Event('change', { bubbles: true }));
                            }

                            // Amount
                            const amountField = document.getElementById('edit_amount');
                            if (amountField && normalizedLoan.transactionLoanAmount) {
                                amountField.value = normalizedLoan.transactionLoanAmount;
                            }

                            // Payment Mode
                            const paymentModeField = document.getElementById('edit_payment_mode');
                            if (paymentModeField && normalizedLoan.transactionMode) {
                                paymentModeField.value = normalizedLoan.transactionMode;
                                paymentModeField.dispatchEvent(new Event('change', { bubbles: true }));
                            }

                            // Transaction Code
                            const transactionCodeField = document.getElementById('edit_transaction_code');
                            if (transactionCodeField && normalizedLoan.transactionCode) {
                                transactionCodeField.value = normalizedLoan.transactionCode;
                            }

                            // Period
                            const periodField = document.getElementById('edit_loan_period');
                            if (periodField && normalizedLoan.loanPeriod) {
                                periodField.value = normalizedLoan.loanPeriod;
                                periodField.dispatchEvent(new Event('change', { bubbles: true }));
                            }

                            // Status
                            const statusField = document.getElementById('edit_loan_status');
                            if (statusField && normalizedLoan.transactionStatus) {
                                statusField.value = normalizedLoan.transactionStatus;
                            }

                            // Start Date
                            const startDateField = document.getElementById('edit_start_date');
                            if (startDateField && normalizedLoan.startDate) {
                                startDateField.value = this.formatDate(normalizedLoan.startDate);
                            }

                            // End Date
                            const endDateField = document.getElementById('edit_end_date');
                            if (endDateField) {
                                if (normalizedLoan.endDate) {
                                    endDateField.value = this.formatDate(normalizedLoan.endDate);
                                } else if (normalizedLoan.startDate && normalizedLoan.loanPeriod) {
                                    endDateField.value = this.calculateEndDate(normalizedLoan.startDate, normalizedLoan.loanPeriod);
                                }
                            }

                            // Assigned Date
                            const assignedDateField = document.getElementById('edit_assigned_date');
                            if (assignedDateField) {
                                if (normalizedLoan.transactionCreated) {
                                    assignedDateField.value = this.formatDateTime(normalizedLoan.transactionCreated);
                                    console.log('Setting assigned date to:', this.formatDateTime(normalizedLoan.transactionCreated));
                                } else {
                                    console.log('No transactionCreated found in normalized loan');
                                }
                            }

                            // Interest Rate
                            const interestRateField = document.getElementById('edit_interest_rate');
                            if (interestRateField) {
                                if (Alpine.store('loanData').currentLoanType) {
                                    interestRateField.value = Alpine.store('loanData').currentLoanType.interest_rate + '%';
                                } else if (normalizedLoan.interestRate) {
                                    interestRateField.value = normalizedLoan.interestRate + '%';
                                }
                            }
                        }, 100);
                    });
                },

                // Load member active loans count
                loadMemberActiveLoans() {
                    fetch('/bodaboda-member/{{ $memberId }}/loans/active/count')
                        .then(res => res.json())
                        .then(data => {
                            this.memberActiveLoans = data.active_loans_count || 0;
                        })
                        .catch(error => {
                            console.error('Error loading member active loans:', error);
                            this.memberActiveLoans = 0;
                        });
                },

                // Validation methods
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

                handlePaymentModeChange(mode, prefix = 'edit_') {
                    const codeField = document.getElementById(prefix + 'transaction_code');
                    if (codeField) {
                        if (mode === 'Cash') {
                            codeField.readOnly = true;
                            codeField.value = '';
                        } else {
                            codeField.readOnly = false;
                        }
                    }
                },

                validateEditForm() {
                    this.errors = {};
                    let isValid = true;

                    const loanType = document.getElementById('edit_loan_type_id')?.value;
                    const amount = document.getElementById('edit_amount')?.value;
                    const period = document.getElementById('edit_loan_period')?.value;
                    const paymentMode = document.getElementById('edit_payment_mode')?.value;
                    const status = document.getElementById('edit_loan_status')?.value;

                    if (!loanType || loanType === '') {
                        this.errors.loan_type = 'Please select a loan type';
                        isValid = false;
                    }

                    if (!this.validateField('amount', amount)) isValid = false;

                    if (!period || period === '') {
                        this.errors.loan_period = 'Please select repayment period';
                        isValid = false;
                    }

                    if (!paymentMode || paymentMode === '') {
                        this.errors.payment_mode = 'Please select payment mode';
                        isValid = false;
                    }

                    if (!status || status === '') {
                        this.errors.loan_status = 'Please select loan status';
                        isValid = false;
                    }

                    // If payment mode is not Cash, transaction code is required
                    const transactionCode = document.getElementById('edit_transaction_code')?.value;
                    if (paymentMode !== 'Cash' && (!transactionCode || transactionCode === '')) {
                        this.errors.transaction_code = 'Transaction code is required for non-cash payments';
                        isValid = false;
                    }

                    return isValid;
                },

                validateAssignForm() {
                    this.errors = {};
                    let isValid = true;

                    const loanType = document.getElementById('loan_type_id')?.value;
                    const amount = document.getElementById('assign_amount')?.value;
                    const period = document.getElementById('loan_period')?.value;
                    const paymentMode = document.getElementById('assign_payment_mode')?.value;
                    const status = document.getElementById('assign_loan_status')?.value;

                    if (!loanType || loanType === '') {
                        this.errors.loan_type = 'Please select a loan type';
                        isValid = false;
                    }

                    if (!this.validateField('amount', amount)) isValid = false;

                    if (!period || period === '') {
                        this.errors.loan_period = 'Please select repayment period';
                        isValid = false;
                    }

                    if (!paymentMode || paymentMode === '') {
                        this.errors.payment_mode = 'Please select payment mode';
                        isValid = false;
                    }

                    if (!status || status === '') {
                        this.errors.loan_status = 'Please select loan status';
                        isValid = false;
                    }

                    // If payment mode is not Cash, transaction code is required
                    const transactionCode = document.getElementById('assign_transaction_code')?.value;
                    if (paymentMode !== 'Cash' && (!transactionCode || transactionCode === '')) {
                        this.errors.transaction_code = 'Transaction code is required for non-cash payments';
                        isValid = false;
                    }

                    return isValid;
                },

                validateRepayForm() {
                    this.errors = {};
                    let isValid = true;

                    const loanSelect = document.getElementById('repay_loan_id')?.value;
                    const amount = document.getElementById('repay_amount')?.value;
                    const paymentMode = document.getElementById('repay_payment_mode')?.value;
                    const status = document.getElementById('repay_status')?.value;

                    if (!loanSelect || loanSelect === '') {
                        this.errors.repay_loan = 'Please select a loan to repay';
                        isValid = false;
                    }

                    if (!this.validateField('amount', amount)) isValid = false;

                    if (!paymentMode || paymentMode === '') {
                        this.errors.payment_mode = 'Please select payment mode';
                        isValid = false;
                    }

                    if (!status || status === '') {
                        this.errors.status = 'Please select status';
                        isValid = false;
                    }

                    const transactionCode = document.getElementById('repay_transaction_code')?.value;
                    if (paymentMode !== 'Cash' && (!transactionCode || transactionCode === '')) {
                        this.errors.transaction_code = 'Transaction code is required for non-cash payments';
                        isValid = false;
                    }

                    return isValid;
                },

                editLoan() {
                    if (!this.validateEditForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    Alpine.store('loanData').isUpdating = true;

                    const formData = {
                        loan_id: document.getElementById('edit_loan_id')?.value,
                        loan_type_id: document.getElementById('edit_loan_type_id')?.value,
                        amount: document.getElementById('edit_amount')?.value,
                        period_months: document.getElementById('edit_loan_period')?.value,
                        payment_mode: document.getElementById('edit_payment_mode')?.value,
                        transaction_code: document.getElementById('edit_transaction_code')?.value || '',
                        status: document.getElementById('edit_loan_status')?.value,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    console.log('Submitting edit form:', formData);

                    fetch('/bodaboda-member/{{ $memberId }}/loan/update', {
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
                            Alpine.store('loanData').isUpdating = false;

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
                            Alpine.store('loanData').isUpdating = false;
                            alert('Error updating loan. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                assignLoan() {
                    if (!this.validateAssignForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    Alpine.store('loanData').isAssigning = true;

                    // Parse total repayment to get numeric value
                    let totalRepaymentValue = 0;
                    if (this.totalRepayment) {
                        const match = this.totalRepayment.match(/KES ([\d,]+\.\d{2})/);
                        if (match) {
                            totalRepaymentValue = parseFloat(match[1].replace(/,/g, ''));
                        }
                    }

                    const formData = {
                        loan_type_id: document.getElementById('loan_type_id')?.value,
                        amount: this.loanAmount,
                        total_repayment: totalRepaymentValue,
                        period_months: this.loanPeriod,
                        payment_mode: this.paymentMode,
                        transaction_code: this.transactionCode || '',
                        status: this.loanStatus,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    console.log('Submitting assign form:', formData);

                    fetch('/bodaboda-member/{{ $memberId }}/loan/assign', {
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
                            Alpine.store('loanData').isAssigning = false;

                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert('Error: ' + data.message);
                                if (data.errors) {
                                    console.error('Validation errors:', data.errors);
                                }
                            }
                        }, 750);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            Alpine.store('loanData').isAssigning = false;
                            alert('Error assigning loan. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                repayLoan() {
                    if (!this.validateRepayForm()) {
                        alert('Please fix the errors in the form before submitting.');
                        return;
                    }

                    Alpine.store('loanData').isRepaying = true;

                    const formData = {
                        loan_id: document.getElementById('repay_loan_id')?.value,
                        amount: document.getElementById('repay_amount')?.value,
                        payment_mode: document.getElementById('repay_payment_mode')?.value,
                        transaction_code: document.getElementById('repay_transaction_code')?.value || '',
                        status: document.getElementById('repay_status')?.value,
                        _token: document.querySelector('input[name="_token"]')?.value
                    };

                    fetch('/bodaboda-member/{{ $memberId }}/loan/repay', {
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
                            Alpine.store('loanData').isRepaying = false;

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
                            Alpine.store('loanData').isRepaying = false;
                            alert('Error processing repayment. Please try again.');
                            console.error('Error:', error);
                        }, 750);
                    });
                },

                // Calculate and update total repayment
                calculateAndUpdateTotal() {
                    if (!this.loanAmount || !this.loanPeriod || !Alpine.store('loanData').currentLoanType) {
                        this.totalRepayment = '';
                        return;
                    }

                    const interestRate = Alpine.store('loanData').currentLoanType.interest_rate;
                    const total = this.calculateTotalLoan(this.loanAmount, interestRate, this.loanPeriod);

                    if (total > 0) {
                        this.totalRepayment = 'KES ' + total.toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    } else {
                        this.totalRepayment = '';
                    }
                },

                // Generate transaction code based on payment mode
                generateTransactionCode() {
                    if (this.paymentMode === 'Cash') {
                        // For cash, generate a cash receipt number
                        const date = new Date();
                        const year = date.getFullYear().toString().slice(-2);
                        const month = (date.getMonth() + 1).toString().padStart(2, '0');
                        const day = date.getDate().toString().padStart(2, '0');
                        const random = Math.floor(Math.random() * 10000).toString().padStart(4, '0');
                        this.transactionCode = `CASH-${year}${month}${day}-${random}`;
                    } else {
                        // For non-cash, make it editable and clear any auto-generated code
                        this.transactionCode = '';
                    }
                },

                // Override handlePaymentModeChange for assign form
                handlePaymentModeChange(mode, prefix = 'assign_') {
                    const codeField = document.getElementById(prefix + 'transaction_code');
                    if (codeField) {
                        if (mode === 'Cash') {
                            codeField.readOnly = true;
                            this.generateTransactionCode();
                        } else {
                            codeField.readOnly = false;
                            this.transactionCode = '';
                        }
                    }
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
