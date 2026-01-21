<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KFBCL - Sign Up</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-200">
        <!-- Centered container -->
        <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">
            <div class="w-full max-w-md">
                <!-- Card container -->
                <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
                    <!-- Logo -->
                    <div class="mb-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4 p-2">
                            <img src="{{ asset('company_logo.png') }}" alt="Company Logo" class="w-full h-full object-contain rounded-full">
                        </div>
                    </div>

                    <!-- Header -->
                    <div class="mb-6 sm:mb-8 text-center">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-700 mb-2">
                            Create Account
                        </h1>
                        <p class="text-sm text-gray-600">
                            Fill in your details to get started!
                        </p>
                    </div>

                    <!-- Form -->
                    <form x-data="signupForm()" @submit.prevent="submitForm">
                        <div class="space-y-5">
                            <!-- First Name & Last Name -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-gray-700">
                                        First Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="first_name" name="first_name" x-model="firstName" @blur="validateField('firstName')" @input="clearError('firstName')" placeholder="John" :class="errors.firstName ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10' : 'border-gray-300 focus:border-[#FF2D20] focus:ring-[#FF2D20]/10'" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-900 placeholder:text-gray-500 focus:border-[#FF2D20] focus:ring-2 focus:ring-[#FF2D20]/10 focus:outline-none transition">
                                    <p x-show="errors.firstName" x-text="errors.firstName" class="mt-2 text-sm text-red-600"></p>
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-gray-700">
                                        Last Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="last_name" name="last_name" placeholder="Doe" x-model="lastName" @blur="validateField('lastName')" @input="clearError('lastName')" :class="errors.lastName ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10' : 'border-gray-300 focus:border-[#FF2D20] focus:ring-[#FF2D20]/10'" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-900 placeholder:text-gray-500 focus:border-[#FF2D20] focus:ring-2 focus:ring-[#FF2D20]/10 focus:outline-none transition">
                                    <p x-show="errors.lastName" x-text="errors.lastName" class="mt-2 text-sm text-red-600"></p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" x-model="email" placeholder="info@gmail.com" @blur="validateField('email')" @input="clearError('email')" :class="errors.email ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10' : 'border-gray-300 focus:border-[#FF2D20] focus:ring-[#FF2D20]/10'" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-900 placeholder:text-gray-500 focus:border-[#FF2D20] focus:ring-2 focus:ring-[#FF2D20]/10 focus:outline-none transition">
                                <p x-show="errors.email" x-text="errors.email" class="mt-2 text-sm text-red-600"></p>
                            </div>

                            <!-- Phone & Gender -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-gray-700">
                                        Phone <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="phone" name="phone" placeholder="+254725000000" x-model="phone" @blur="validateField('phone')" @input="clearError('phone')" :class="errors.phone ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10' : 'border-gray-300 focus:border-[#FF2D20] focus:ring-[#FF2D20]/10'" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-900 placeholder:text-gray-500 focus:border-[#FF2D20] focus:ring-2 focus:ring-[#FF2D20]/10 focus:outline-none transition">
                                    <p x-show="errors.phone" x-text="errors.phone" class="mt-2 text-sm text-red-600"></p>
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-gray-700">
                                        Gender <span class="text-red-500">*</span>
                                    </label>
                                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                        <select id="gender" name="gender" class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-10 text-sm text-gray-900 placeholder:text-gray-500 focus:border-[#FF2D20] focus:ring-2 focus:ring-[#FF2D20]/10 focus:outline-none transition" :class="isOptionSelected && 'text-gray-900'" @change="isOptionSelected = true">
                                            <option value="" class="text-gray-500" disabled selected>Select Gender</option>
                                            <option value="male" class="text-gray-900">Male</option>
                                            <option value="female" class="text-gray-900">Female</option>
                                        </select>
                                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 pointer-events-none">
                                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <div x-data="{ showPassword: false }" class="relative">
                                    <input :type="showPassword ? 'text' : 'password'" placeholder="Enter your password" x-model="password" @blur="validateField('password')" @input="clearError('password'); validatePasswordMatch()" :class="errors.password ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10' : 'border-gray-300 focus:border-[#FF2D20] focus:ring-[#FF2D20]/10'" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-11 pl-4 text-sm text-gray-900 placeholder:text-gray-500 focus:border-[#FF2D20] focus:ring-2 focus:ring-[#FF2D20]/10 focus:outline-none transition">
                                    <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer text-gray-500">
                                        <svg x-show="!showPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z" fill="#98A2B3"></path>
                                        </svg>
                                        <svg x-show="showPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z" fill="#98A2B3"></path>
                                        </svg>
                                    </span>
                                </div>
                                <p x-show="errors.confirmPassword" x-text="errors.confirmPassword" class="mt-2 text-sm text-red-600"></p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">
                                    Confirm Password <span class="text-red-500">*</span>
                                </label>
                                <div x-data="{ showConfirmPassword: false }" class="relative">
                                    <input :type="showConfirmPassword ? 'text' : 'password'" placeholder="Confirm your password" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-11 pl-4 text-sm text-gray-900 placeholder:text-gray-500 focus:border-[#FF2D20] focus:ring-2 focus:ring-[#FF2D20]/10 focus:outline-none transition">
                                    <span @click="showConfirmPassword = !showConfirmPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer text-gray-500">
                                        <svg x-show="!showConfirmPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z" fill="#98A2B3"></path>
                                        </svg>
                                        <svg x-show="showConfirmPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z" fill="#98A2B3"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <!-- Create Account Button -->
                            <div>
                                <button type="button" :disabled="isSubmitting" class="w-full bg-[#c5480e] hover:bg-[#ee5622] text-white font-medium py-3 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-[#FF2D20]/50 focus:ring-offset-2">
                                    Create Account
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Sign In Link -->
                    <div class="mt-6 pt-6 border-t border-gray-200">

                        <p class="text-center text-sm text-gray-600">
                            Already have an account?
                            <a href="/" class="font-medium text-[#c5480e] hover:text-[#ee5622]">Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alpine.js for interactivity -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script>
            function signupForm() {
                return {
                    firstName: '',
                    lastName: '',
                    email: '',
                    phone: '',
                    gender: '',
                    password: '',
                    confirmPassword: '',
                    errors: {
                        firstName: '',
                        lastName: '',
                        email: '',
                        phone: '',
                        password: '',
                        confirmPassword: ''
                    },
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
                        this.validateField('password');
                        this.validateField('confirmPassword');

                        // Check if any errors exist
                        return !Object.values(this.errors).some(error => error !== '');
                    },

                    submitForm() {
                        if (!this.validateAll()) {
                            return;
                        }

                        this.isSubmitting = true;

                        // Simulate API call
                        setTimeout(() => {
                            this.isSubmitting = false;

                            // In a real app, you would submit to your backend here
                            alert('Account created successfully!');
                            // Reset form
                            this.firstName = '';
                            this.lastName = '';
                            this.email = '';
                            this.phone = '';
                            this.gender = '';
                            this.password = '';
                            this.confirmPassword = '';
                            Object.keys(this.errors).forEach(key => this.errors[key] = '');
                        }, 2000);
                    }
                }
            }
        </script>
    </body>
</html>
