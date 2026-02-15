<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KFBCL - Sign In</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- OR use manual links but not both -->
        <!--
        -->

        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>

    <body class="font-sans antialiased bg-gray-200">
        <!-- Centered container -->
        <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">
            <div class="w-full max-w-md">
                <!-- Card container -->
                <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
                    <!-- Logo -->
                    <div class="mb-8 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4 p-3">
                            <img src="{{ asset('company_logo.png') }}" alt="Company Logo" class="w-full h-full object-contain rounded-full">
                        </div>
                    </div>

                    <!-- Header -->
                    <div class="mb-6 sm:mb-8 text-center">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-700 mb-2">
                            Sign In
                        </h1>
                        <p class="text-sm text-gray-600">
                            Enter your email and password to sign in!
                        </p>
                    </div>

                    <!-- Form -->
                    <form x-data="signinForm()" @submit.prevent="submitForm" @keyup.enter="submitForm">

                        <!-- Alerts (Add this inside the form, after opening form tag) -->
                        <!-- Success Alert with Brand Colors -->
                        <div x-show="showSuccessAlert"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="mt-4 rounded-lg bg-green-50 p-4 border border-green-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-[#c5480e]" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800" x-text="alertMessage"></p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <button @click="hideAlerts()" type="button" class="text-gray-400 hover:text-gray-600">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Error Alert with Brand Colors -->
                        <div x-show="showErrorAlert"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="mt-4 rounded-lg bg-red-50 p-4 border border-red-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800" x-text="alertMessage"></p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <button @click="hideAlerts()" type="button" class="text-red-500 hover:text-red-700">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <!-- Email -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">
                                    Email<span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    x-model="email"
                                    @blur="validateField('email')"
                                    @input="clearError('email')"
                                    placeholder="info@gmail.com"
                                    :class="errors.email ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10' : 'border-gray-300 focus:border-[#FF2D20] focus:ring-[#FF2D20]/10'"
                                    class="h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-900 placeholder:text-gray-500 focus:ring-2 focus:outline-none transition"
                                >
                                <p x-show="errors.email" x-text="errors.email" class="mt-2 text-sm text-red-600"></p>
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">
                                    Password<span class="text-red-500">*</span>
                                </label>
                                <div x-data="{ showPassword: false }" class="relative">
                                    <input
                                        :type="showPassword ? 'text' : 'password'"
                                        x-model="password"
                                        @blur="validateField('password')"
                                        @input="clearError('password')"
                                        placeholder="Enter your password"
                                        :class="errors.password ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10' : 'border-gray-300 focus:border-[#FF2D20] focus:ring-[#FF2D20]/10'"
                                        class="h-11 w-full rounded-lg border bg-transparent py-2.5 pr-11 pl-4 text-sm text-gray-900 placeholder:text-gray-500 focus:ring-2 focus:outline-none transition"
                                    >
                                    <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer text-gray-500">
                                        <svg x-show="!showPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z" fill="#98A2B3"></path>
                                        </svg>
                                        <svg x-show="showPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z" fill="#98A2B3"></path>
                                        </svg>
                                    </span>
                                </div>
                                <p x-show="errors.password" x-text="errors.password" class="mt-2 text-sm text-red-600"></p>
                            </div>

                            <!-- Checkbox and Forgot Password -->
                            <div class="flex items-center justify-between">
                                <div x-data="{ checkboxToggle: false }">
                                    <label for="checkboxLabelOne" class="flex cursor-pointer items-center text-sm font-normal text-gray-700 select-none">
                                        <div class="relative">
                                            <input type="checkbox" id="checkboxLabelOne" class="sr-only" @change="checkboxToggle = !checkboxToggle">
                                            <div :class="checkboxToggle ? 'border-[#c5480e] bg-[#FF2D20]' : 'bg-transparent border-gray-300'" class="mr-3 flex h-5 w-5 items-center justify-center rounded border">
                                                <span :class="checkboxToggle ? '' : 'opacity-0'" class="opacity-0">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white" stroke-width="1.94437" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        Keep me logged in
                                    </label>
                                </div>
                                <a href="{{ '/forgotPassword' }}" class="text-sm text-[#c5480e] hover:text-[#E62A1C]">Forgot password?</a>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button
                                    type="submit"
                                    :disabled="isSubmitting"
                                    class="w-full bg-[#c5480e] hover:bg-[#E62A1C] disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-medium py-3 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-[#FF2D20]/50 focus:ring-offset-2"
                                >
                                    <span x-show="!isSubmitting">Sign In</span>
                                    <span x-show="isSubmitting" class="flex items-center justify-center">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Signing in...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Sign Up Link -->
                    <div class="mt-6 pt-6 border-gray-200">
                        <!-- Divider -->
                        <div class="relative mb-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="bg-white px-4 text-gray-500">Or </span>
                            </div>
                        </div>
                        <p class="text-center text-sm text-gray-600">
                            Don't have an account?
                            <a href="{{ url('/signup') }}" class="font-medium text-[#c5480e] hover:text-[#E62A1C]">Sign Up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alpine.js for interactivity -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script>
            function signinForm() {
                return {
                    email: '',
                    password: '',
                    keepLoggedIn: false,
                    errors: {
                        email: '',
                        password: ''
                    },
                    isSubmitting: false,
                    showSuccessAlert: false,
                    showErrorAlert: false,
                    alertMessage: '',
                    alertType: '', // 'success' or 'error'

                    // Show styled alert (matches your registration page styling)
                    showAlert(message, type) {
                        this.alertMessage = message;
                        this.alertType = type;

                        if (type === 'success') {
                            this.showSuccessAlert = true;
                            this.showErrorAlert = false;
                        } else {
                            this.showSuccessAlert = false;
                            this.showErrorAlert = true;
                        }

                        // Auto-hide alerts after 5 seconds
                        setTimeout(() => {
                            this.hideAlerts();
                        }, 5000);
                    },

                    // Hide all alerts
                    hideAlerts() {
                        this.showSuccessAlert = false;
                        this.showErrorAlert = false;
                        this.alertMessage = '';
                    },

                    validateField(field) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                        switch(field) {
                            case 'email':
                                if (!this.email.trim()) {
                                    this.errors.email = 'Email is required';
                                } else if (!emailRegex.test(this.email)) {
                                    this.errors.email = 'Please enter a valid email address';
                                } else {
                                    this.errors.email = '';
                                }
                                break;

                            case 'password':
                                if (!this.password) {
                                    this.errors.password = 'Password is required';
                                } else {
                                    this.errors.password = '';
                                }
                                break;
                        }
                    },

                    clearError(field) {
                        if (this.errors[field]) {
                            this.errors[field] = '';
                        }
                    },

                    validateAll() {
                        this.validateField('email');
                        this.validateField('password');

                        // Check if any errors exist
                        return !Object.values(this.errors).some(error => error !== '');
                    },

                    submitForm() {
                        if (!this.validateAll()) {
                            const firstError = Object.entries(this.errors).find(([key, value]) => value !== '');
                            if (firstError) {
                                this.showAlert(firstError[1], 'error');
                            }
                            return;
                        }

                        this.isSubmitting = true;
                        this.hideAlerts();

                        console.log('Submitting signin form...');

                        // POST to signin endpoint
                        fetch('/signin', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                email: this.email,
                                password: this.password,
                                remember: this.keepLoggedIn
                            })
                        })
                        .then(response => {
                            console.log('Response status:', response.status, response.statusText);

                            // Check if response is JSON
                            const contentType = response.headers.get('content-type');
                            if (contentType && contentType.includes('application/json')) {
                                return response.json().then(data => {
                                    return {
                                        status: response.status,
                                        ok: response.ok,
                                        data: data
                                    };
                                });
                            } else {
                                // Response is not JSON
                                return response.text().then(text => {
                                    console.error('Non-JSON response:', text);
                                    throw new Error('Server returned non-JSON response: ' + text.substring(0, 100));
                                });
                            }
                        })
                        .then(result => {
                            console.log('Response data:', result);
                            this.isSubmitting = false;

                            if (result.data.success) {
                                this.showAlert(result.data.message || 'Sign in successful!', 'success');

                                // Redirect after 1.5 seconds
                                setTimeout(() => {
                                    console.log('Redirecting to:', result.data.redirect || '/dashboard');
                                    window.location.href = result.data.redirect || '/dashboard';
                                }, 1500);
                            } else {
                                this.showAlert(result.data.message || 'Sign in failed', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            this.isSubmitting = false;
                            this.showAlert('Error: ' + error.message, 'error');
                        });
                    }
                }
            }
        </script>

    </body>
</html>
