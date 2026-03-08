
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
        @include('Layouts.Treasurer.aside')
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
            <!-- Small Device Overlay Start -->
            <div :class="sidebarToggle ? 'block xl:hidden' : 'hidden'" class="fixed z-50 h-screen w-full bg-gray-900/50 hidden"></div>
            <!-- Small Device Overlay End -->

            <!-- ===== Header Start ===== -->
                @include('Layouts.General.header')
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

                    <!-- User Profile Section -->
                    <div class="grid grid-cols-12 gap-4 md:gap-6">
                        <!-- User Card -->
                        <div class="col-span-12 xl:col-span-4">
                            <!-- Profile Management -->
                            <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
                                <div class="flex flex-col items-center text-center">

                                    <div class="relative mb-5">
                                        <div class="flex h-24 w-24 items-center justify-center rounded-full border-2 border-gray-50 bg-gray-100 p-1 shadow-sm dark:border-gray-800 dark:bg-gray-800">
                                            <div class="flex h-full w-full items-center justify-center rounded-full bg-white dark:bg-gray-900">
                                                <svg class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="text-xl font-bold tracking-tight text-gray-600 dark:text-white">
                                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                        </h4>

                                        <div class="mt-2 flex items-center justify-center gap-2">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ Auth::user()->role }}
                                            </span>
                                            <span class="text-gray-300 dark:text-gray-700">|</span>
                                            <span class="flex items-center gap-1 rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                                {{ Auth::user()->status }}
                                            </span>
                                        </div>

                                        <div class="mt-5 flex flex-col items-center border-t border-gray-100 pt-4 dark:border-gray-800">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Member Since</span>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ Auth::user()->created_at->format('d M, Y') }}
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- User Details -->
                        <div class="col-span-12 xl:col-span-8">
                            <!-- User Personal Information -->
                            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                <div class="px-5 py-4 sm:px-6 sm:py-5">
                                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                        ACCOUNT
                                    </h3>
                                </div>
                                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                                    <!-- User Personal Info -->
                                    <form method="POST" x-data="userProfileForm()" @submit.prevent="submitForm()">
                                        @csrf

                                        <div class="-mx-2.5 flex flex-wrap gap-y-5">
                                            <div class="w-full px-2.5">
                                                <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                                                    User Information
                                                </h4>
                                            </div>

                                            <!-- First Name -->
                                            <div class="w-full px-2.5 xl:w-1/2">
                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    First Name
                                                </label>
                                                <input type="text" id="first_name" name="first_name"
                                                    x-model="firstName"
                                                    @input.debounce="clearError('firstName')"
                                                    @blur="validateField('firstName')"
                                                    :class="errors.firstName ? 'border-error-500' : 'border-gray-300'"
                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                <template x-if="errors.firstName">
                                                    <p class="mt-1 text-sm text-error-500" x-text="errors.firstName"></p>
                                                </template>
                                            </div>

                                            <!-- Last Name -->
                                            <div class="w-full px-2.5 xl:w-1/2">
                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    Last Name
                                                </label>
                                                <input type="text" id="last_name" name="last_name"
                                                    x-model="lastName"
                                                    @input.debounce="clearError('lastName')"
                                                    @blur="validateField('lastName')"
                                                    :class="errors.lastName ? 'border-error-500' : 'border-gray-300'"
                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                <template x-if="errors.lastName">
                                                    <p class="mt-1 text-sm text-error-500" x-text="errors.lastName"></p>
                                                </template>
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
                                                            :class="errors.gender ? 'border-error-500' : 'border-gray-300'"
                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
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
                                                <template x-if="errors.gender">
                                                    <p class="mt-1 text-sm text-error-500" x-text="errors.gender"></p>
                                                </template>
                                            </div>

                                            <!-- Date of Birth -->
                                            <div class="w-full px-2.5 xl:w-1/2">
                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    Date of Birth
                                                </label>
                                                <div class="relative">
                                                    <input type="text" id="dob" name="date_of_birth"
                                                        x-model="dateOfBirth"
                                                        @input.debounce="clearError('dateOfBirth')"
                                                        @blur="validateField('dateOfBirth')"
                                                        :class="errors.dateOfBirth ? 'border-error-500' : 'border-gray-300'"
                                                        placeholder="DD-MMM-YYYY (e.g., 11-Nov-1988)"
                                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                    <span class="absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z" fill=""></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <template x-if="errors.dateOfBirth">
                                                    <p class="mt-1 text-sm text-error-500" x-text="errors.dateOfBirth"></p>
                                                </template>
                                            </div>

                                            <!-- Email -->
                                            <div class="w-full px-2.5">
                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    Email
                                                </label>
                                                <input type="email" id="email" name="email"
                                                    x-model="email"
                                                    @input.debounce="clearError('email')"
                                                    @blur="validateField('email')"
                                                    :class="errors.email ? 'border-error-500' : 'border-gray-300'"
                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                <template x-if="errors.email">
                                                    <p class="mt-1 text-sm text-error-500" x-text="errors.email"></p>
                                                </template>
                                            </div>

                                            <!-- National ID -->
                                            <div class="w-full px-2.5 xl:w-1/2">
                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    National ID
                                                </label>
                                                <input type="text" id="national_id" name="national_id"
                                                    x-model="nationalId"
                                                    @input.debounce="clearError('nationalId')"
                                                    @blur="validateField('nationalId')"
                                                    :class="errors.nationalId ? 'border-error-500' : 'border-gray-300'"
                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                <template x-if="errors.nationalId">
                                                    <p class="mt-1 text-sm text-error-500" x-text="errors.nationalId"></p>
                                                </template>
                                            </div>

                                            <!-- Phone -->
                                            <div class="w-full px-2.5 xl:w-1/2">
                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    Phone
                                                </label>
                                                <input type="text" id="phone" name="phone"
                                                    x-model="phone"
                                                    @input.debounce="clearError('phone')"
                                                    @blur="validateField('phone')"
                                                    :class="errors.phone ? 'border-error-500' : 'border-gray-300'"
                                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                <template x-if="errors.phone">
                                                    <p class="mt-1 text-sm text-error-500" x-text="errors.phone"></p>
                                                </template>
                                            </div>

                                        </div>

                                        <!-- Save Changes button -->
                                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                                            <button type="submit"
                                                    :disabled="isSubmitting"
                                                    :class="isSubmitting ? 'opacity-70 cursor-not-allowed' : ''"
                                                    class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                                                <span x-show="!isSubmitting">Save Changes</span>
                                                <span x-show="isSubmitting" class="flex items-center">
                                                    Saving ...
                                                </span>
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Account Security -->
                                    <form action="" method="POST" x-data="accountSecurityForm" @submit.prevent="submitForm()">
                                        @csrf

                                        <div class="-mx-2.5 flex flex-wrap gap-y-5">
                                            <div class="w-full px-2.5">
                                                <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                                                    Account Security
                                                </h4>
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
                                                        @input="validatePassword(); clearError('password')"
                                                        @blur="validateField('password')"
                                                        :class="errors.password ? 'border-error-500' : 'border-gray-300'"
                                                        placeholder="Create Password"
                                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                    <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                                                        <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"></path>
                                                        </svg>
                                                        <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <template x-if="errors.password">
                                                    <p class="mt-1 text-sm text-error-500" x-text="errors.password"></p>
                                                </template>
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
                                                        @input="validateMatch(); clearError('confirmPassword')"
                                                        @blur="validateField('confirmPassword')"
                                                        :class="errors.confirmPassword ? 'border-error-500' : 'border-gray-300'"
                                                        placeholder="Confirm Password"
                                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                    <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                                                        <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z"></path>
                                                        </svg>
                                                        <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <template x-if="errors.confirmPassword">
                                                    <p class="mt-1 text-sm text-error-500" x-text="errors.confirmPassword"></p>
                                                </template>
                                            </div>

                                            <!-- Password Requirements -->
                                            <div class="mt-2 flex flex-wrap items-center justify-center gap-2 w-full px-2.5">
                                                <p :class="requirements.minLength ? 'text-success-500' : 'text-error-700'" class="flex items-center gap-2 text-sm">
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
                                                <span class="text-gray-300 dark:text-gray-700">|</span>

                                                <p :class="requirements.specialChar ? 'text-success-500' : 'text-error-700'" class="flex items-center gap-2 text-sm">
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
                                                <span class="text-gray-300 dark:text-gray-700">|</span>

                                                <p :class="requirements.capitalLetter ? 'text-success-500' : 'text-error-700'" class="flex items-center gap-2 text-sm">
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
                                                <span class="text-gray-300 dark:text-gray-700">|</span>

                                                <p :class="requirements.lowerCase ? 'text-success-500' : 'text-error-700'" class="flex items-center gap-2 text-sm">
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
                                                    A lower case letter
                                                </p>
                                                <span class="text-gray-300 dark:text-gray-700">|</span>

                                                <p :class="requirements.numbers ? 'text-success-500' : 'text-error-700'" class="flex items-center gap-2 text-sm">
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
                                                <span class="text-gray-300 dark:text-gray-700">|</span>

                                                <p :class="requirements.matchPassword ? 'text-success-500' : 'text-error-700'" class="flex items-center gap-2 text-sm">
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

                                        <!-- Update Password button -->
                                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                                            <button type="submit"
                                                    :disabled="isSubmitting"
                                                    :class="isSubmitting ? 'opacity-70 cursor-not-allowed' : ''"
                                                    class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                                                <span x-show="!isSubmitting">Update Password</span>
                                                <span x-show="isSubmitting" class="flex items-center">
                                                    Updating ...
                                                </span>
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Account Status -->
                                    <form action="" method="POST" x-data="" @submit.prevent="submitForm()">
                                        @csrf
                                        <div class="-mx-2.5 flex flex-wrap gap-y-5">
                                            <div class="w-full px-2.5">
                                                <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800 dark:border-gray-800 dark:text-white/90">
                                                    Account Status
                                                </h4>
                                            </div>

                                            <!-- Password -->
                                            <div class="w-full px-2.5 xl:w-1/2">
                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    User Role
                                                </label>
                                                <div x-data="{ showPassword: false }" class="relative">
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ Auth::user()->role }}
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="w-full px-2.5 xl:w-1/2">
                                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                    Account Status
                                                </label>
                                                <div x-data="{ showPassword: false }" class="relative">
                                                    <span class="flex items-center gap-1 rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                                        {{ Auth::user()->status }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Cancel and Update buttons at bottom right -->
                                        <div class="mt-8 pt-6 border-t border-error-200 dark:border-error-700 flex justify-end gap-3">
                                            <button id="" name=""
                                                @click="isDeleteModalOpen = true"
                                                class="flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-error-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                De-Activate Account
                                            </button>
                                        </div>
                                    </form>

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

                    <!-- De-Activate Account Component -->
                    <div x-data="accountDeactivation">
                        <h4 class="sm:text-title-sm mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
                            Confirm Account De-Activation
                        </h4>
                        <p class="text-sm leading-6 text-gray-500 dark:text-gray-400">
                            Are you sure you want to De-Activate this account? This will log you out immediately.
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
        <!-- END MODAL -->


        <script defer src="{{ asset('assets/bundle.js') }}"></script>

        <script>

            document.addEventListener('alpine:init', () => {

                // 01. User Profile Form Component
                Alpine.data('userProfileForm', () => ({
                    // Form fields
                    firstName: '{{ Auth::user()->first_name }}',
                    lastName: '{{ Auth::user()->last_name }}',
                    gender: '{{ Auth::user()->gender }}',
                    dateOfBirth: '{{ Auth::user()->date_of_birth ? \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format("d-M-Y") : "" }}',
                    email: '{{ Auth::user()->email }}',
                    nationalId: '{{ Auth::user()->national_id }}',
                    phone: '{{ Auth::user()->phone }}',

                    // Form state
                    errors: {},
                    isSubmitting: false,

                    // Initialize and format date if needed
                    init() {
                        console.log('UserProfileForm initialized');
                        // If date is in Y-m-d format, convert to d-M-Y
                        if (this.dateOfBirth && this.dateOfBirth.match(/^\d{4}-\d{2}-\d{2}$/)) {
                            try {
                                const date = new Date(this.dateOfBirth);
                                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                const day = date.getDate().toString().padStart(2, '0');
                                const month = months[date.getMonth()];
                                const year = date.getFullYear();
                                this.dateOfBirth = `${day}-${month}-${year}`;
                            } catch (e) {
                                console.error('Date formatting error:', e);
                            }
                        }
                    },

                    // Validate a single field
                    validateField(field) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        const phoneRegex = /^\+?[\d\s\-\(\)]+$/;

                        switch(field) {
                            case 'firstName':
                                if (!this.firstName?.trim()) {
                                    this.errors.firstName = 'First name is required';
                                } else if (this.firstName.trim().length < 2) {
                                    this.errors.firstName = 'First name must be at least 2 characters';
                                } else {
                                    delete this.errors.firstName;
                                }
                                break;

                            case 'lastName':
                                if (!this.lastName?.trim()) {
                                    this.errors.lastName = 'Last name is required';
                                } else if (this.lastName.trim().length < 2) {
                                    this.errors.lastName = 'Last name must be at least 2 characters';
                                } else {
                                    delete this.errors.lastName;
                                }
                                break;

                            case 'email':
                                if (!this.email?.trim()) {
                                    this.errors.email = 'Email is required';
                                } else if (!emailRegex.test(this.email)) {
                                    this.errors.email = 'Please enter a valid email address';
                                } else {
                                    delete this.errors.email;
                                }
                                break;

                            case 'phone':
                                if (!this.phone?.trim()) {
                                    this.errors.phone = 'Phone number is required';
                                } else if (!phoneRegex.test(this.phone)) {
                                    this.errors.phone = 'Please enter a valid phone number';
                                } else if (this.phone.replace(/\D/g, '').length < 9) {
                                    this.errors.phone = 'Phone number is too short';
                                } else {
                                    delete this.errors.phone;
                                }
                                break;

                            case 'gender':
                                if (!this.gender) {
                                    this.errors.gender = 'Gender is required';
                                } else {
                                    delete this.errors.gender;
                                }
                                break;

                            case 'nationalId':
                                if (!this.nationalId?.trim()) {
                                    this.errors.nationalId = 'National ID is required';
                                } else {
                                    delete this.errors.nationalId;
                                }
                                break;

                            case 'dateOfBirth':
                                if (!this.dateOfBirth?.trim()) {
                                    this.errors.dateOfBirth = 'Date of birth is required';
                                } else {
                                    // Validate d-M-Y format
                                    const dateRegex = /^\d{2}-(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)-\d{4}$/;
                                    if (!dateRegex.test(this.dateOfBirth)) {
                                        this.errors.dateOfBirth = 'Date must be in format: DD-MMM-YYYY (e.g., 11-Nov-1988)';
                                    } else {
                                        delete this.errors.dateOfBirth;
                                    }
                                }
                                break;
                        }
                    },

                    // Clear error for a field
                    clearError(field) {
                        if (this.errors[field]) {
                            delete this.errors[field];
                        }
                    },

                    // Validate all fields
                    validateAll() {
                        this.validateField('firstName');
                        this.validateField('lastName');
                        this.validateField('email');
                        this.validateField('phone');
                        this.validateField('gender');
                        this.validateField('nationalId');
                        this.validateField('dateOfBirth');

                        return Object.keys(this.errors).length === 0;
                    },

                    // Submit the form
                    async submitForm() {
                        if (!this.validateAll()) {
                            const firstError = Object.values(this.errors)[0];
                            if (firstError) {
                                alert('Error: ' + firstError);
                            }
                            return;
                        }

                        this.isSubmitting = true;

                        try {
                            const formData = new FormData();
                            formData.append('first_name', this.firstName);
                            formData.append('last_name', this.lastName);
                            formData.append('gender', this.gender);
                            formData.append('date_of_birth', this.dateOfBirth);
                            formData.append('email', this.email);
                            formData.append('national_id', this.nationalId);
                            formData.append('phone', this.phone);

                            const response = await fetch('/user/profile/update', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                }
                            });

                            const data = await response.json();

                            if (data.success) {
                                alert('Success: ' + data.message);
                                // Optionally redirect or update UI
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            } else {
                                if (data.errors) {
                                    // Handle validation errors from server
                                    this.errors = {};
                                    for (const [field, messages] of Object.entries(data.errors)) {
                                        const fieldMap = {
                                            'first_name': 'firstName',
                                            'last_name': 'lastName',
                                            'email': 'email',
                                            'phone': 'phone',
                                            'gender': 'gender',
                                            'national_id': 'nationalId',
                                            'date_of_birth': 'dateOfBirth'
                                        };
                                        const errorField = fieldMap[field] || field;
                                        this.errors[errorField] = messages[0];
                                    }
                                    const firstError = Object.values(this.errors)[0];
                                    alert('Error: ' + firstError);
                                } else {
                                    alert('Error: ' + (data.message || 'Failed to update profile.'));
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

                // 02. Password Validation and form management
                Alpine.data('accountSecurityForm', () => ({
                    // Form fields
                    password: '',
                    confirmPassword: '',

                    // Form state
                    errors: {},
                    isSubmitting: false,

                    // Password requirements tracking
                    requirements: {
                        minLength: false,
                        specialChar: false,
                        capitalLetter: false,
                        lowerCase: false,
                        numbers: false,
                        matchPassword: false
                    },

                    // Initialize with empty values
                    init() {
                        console.log('AccountSecurityForm initialized');
                    },

                    // Validate password and update requirements
                    validatePassword() {
                        const pwd = this.password || '';

                        this.requirements.minLength = pwd.length >= 8;
                        this.requirements.specialChar = /[!@#$%^&*()\-_+=\[\]{}~`|:;"'<>,.?]/.test(pwd);
                        this.requirements.capitalLetter = /[A-Z]/.test(pwd);
                        this.requirements.lowerCase = /[a-z]/.test(pwd);
                        this.requirements.numbers = /[0-9]/.test(pwd);

                        // Update match when password changes
                        this.validateMatch();

                        // Validate field for error display
                        this.validateField('password');
                    },

                    // Validate password match
                    validateMatch() {
                        this.requirements.matchPassword =
                            this.password !== '' &&
                            this.confirmPassword !== '' &&
                            this.password === this.confirmPassword;

                        // Validate confirm password field
                        this.validateField('confirmPassword');
                    },

                    // Validate a single field for errors
                    validateField(field) {
                        switch(field) {
                            case 'password':
                                if (!this.password?.trim()) {
                                    this.errors.password = 'Password is required';
                                } else if (!this.requirements.minLength ||
                                        !this.requirements.specialChar ||
                                        !this.requirements.capitalLetter ||
                                        !this.requirements.lowerCase ||
                                        !this.requirements.numbers) {
                                    this.errors.password = 'Password does not meet all requirements';
                                } else {
                                    delete this.errors.password;
                                }
                                break;

                            case 'confirmPassword':
                                if (!this.confirmPassword?.trim()) {
                                    this.errors.confirmPassword = 'Please confirm your password';
                                } else if (this.password !== this.confirmPassword) {
                                    this.errors.confirmPassword = 'Passwords do not match';
                                } else {
                                    delete this.errors.confirmPassword;
                                }
                                break;
                        }
                    },

                    // Clear error for a field
                    clearError(field) {
                        if (this.errors[field]) {
                            delete this.errors[field];
                        }
                    },

                    // Validate all fields
                    validateAll() {
                        this.validateField('password');
                        this.validateField('confirmPassword');

                        return Object.keys(this.errors).length === 0;
                    },

                    // Check if all requirements are met
                    allRequirementsMet() {
                        return this.requirements.minLength &&
                            this.requirements.specialChar &&
                            this.requirements.capitalLetter &&
                            this.requirements.lowerCase &&
                            this.requirements.numbers &&
                            this.requirements.matchPassword;
                    },

                    // Submit the form
                    async submitForm() {
                        // Validate all fields
                        if (!this.validateAll()) {
                            const firstError = Object.values(this.errors)[0];
                            if (firstError) {
                                alert('Error: ' + firstError);
                            }
                            return;
                        }

                        // Check if all requirements are met
                        if (!this.allRequirementsMet()) {
                            alert('Error: Please meet all password requirements');
                            return;
                        }

                        this.isSubmitting = true;

                        try {
                            const formData = new FormData();
                            formData.append('password', this.password);
                            formData.append('password_confirmation', this.confirmPassword);

                            const response = await fetch('/user/password/update', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                }
                            });

                            const data = await response.json();

                            if (data.success) {
                                alert('Success: ' + data.message);
                                // Clear form on success
                                this.password = '';
                                this.confirmPassword = '';
                                // Reset requirements
                                this.requirements = {
                                    minLength: false,
                                    specialChar: false,
                                    capitalLetter: false,
                                    lowerCase: false,
                                    numbers: false,
                                    matchPassword: false
                                };
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            } else {
                                if (data.errors) {
                                    // Handle validation errors from server
                                    this.errors = {};
                                    for (const [field, messages] of Object.entries(data.errors)) {
                                        const fieldMap = {
                                            'password': 'password',
                                            'password_confirmation': 'confirmPassword'
                                        };
                                        const errorField = fieldMap[field] || field;
                                        this.errors[errorField] = messages[0];
                                    }
                                    const firstError = Object.values(this.errors)[0];
                                    alert('Error: ' + firstError);
                                } else {
                                    alert('Error: ' + (data.message || 'Failed to update password.'));
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

                // 03. Account Deactivation Component
                Alpine.data('accountDeactivation', () => ({
                    isDeleteModalOpen: false,
                    isDeactivating: false,
                    errors: {},

                    init() {
                        console.log('AccountDeactivation initialized');
                    },

                    // Open confirmation modal
                    openDeactivationModal() {
                        this.isDeleteModalOpen = true;
                    },

                    // Close confirmation modal
                    closeDeactivationModal() {
                        this.isDeleteModalOpen = false;
                    },

                    // Deactivate account
                    async deactivateAccount() {
                        this.isDeactivating = true;
                        this.errors = {};

                        try {
                            const response = await fetch('/user/deactivate', {
                                method: 'POST',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                }
                            });

                            const data = await response.json();

                            if (data.success) {
                                alert('Success: ' + data.message);
                                // Redirect to signout route which handles logout
                                setTimeout(() => {
                                    window.location.href = data.redirect; // This will go to /signout
                                }, 1500);
                            } else {
                                this.errors.general = data.message || 'Failed to deactivate account';
                                alert('Error: ' + this.errors.general);
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            alert('Error: Failed to connect to server');
                        } finally {
                            this.isDeactivating = false;
                            this.isDeleteModalOpen = false;
                        }
                    }
                }));

            });

        </script>

    </body>

</html>
