<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KFBCL - Reset Password</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-200">
        <!-- Success Modal -->
        <div x-data="{ showSuccess: false, successMessage: '' }" x-show="showSuccess" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-xl shadow-2xl p-6 sm:p-8 max-w-md mx-4 transform transition-all">
                <div class="text-center">
                    <!-- Success Icon -->
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                        <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Password Reset!</h3>
                    <p x-text="successMessage" class="text-gray-600 mb-6"></p>

                    <button @click="window.location.href = '/'" class="w-full bg-[#c5480e] hover:bg-[#E62A1C] text-white font-medium py-3 px-4 rounded-lg transition">
                        Go to Sign In
                    </button>
                </div>
            </div>
        </div>

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
                            Create New Password
                        </h1>
                        <p class="text-sm text-gray-600">
                            Enter your new password below
                        </p>
                    </div>

                    <!-- Form -->
                    <form x-data="resetPasswordForm()" @submit.prevent="submitForm">
                        <div class="space-y-5">
                            <!-- New Password -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">
                                    New Password <span class="text-red-500">*</span>
                                </label>
                                <div x-data="{ showPassword: false }" class="relative">
                                    <input
                                        :type="showPassword ? 'text' : 'password'"
                                        x-model="newPassword"
                                        @blur="validateField('newPassword')"
                                        @input="clearError('newPassword'); validatePasswordMatch()"
                                        placeholder="Enter new password"
                                        :class="errors.newPassword ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10' : 'border-gray-300 focus:border-[#FF2D20] focus:ring-[#FF2D20]/10'"
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
                                <p x-show="errors.newPassword" x-text="errors.newPassword" class="mt-2 text-sm text-red-600"></p>
                            </div>

                            <!-- Confirm New Password -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">
                                    Confirm New Password <span class="text-red-500">*</span>
                                </label>
                                <div x-data="{ showConfirmPassword: false }" class="relative">
                                    <input
                                        :type="showConfirmPassword ? 'text' : 'password'"
                                        x-model="confirmPassword"
                                        @blur="validateField('confirmPassword')"
                                        @input="clearError('confirmPassword'); validatePasswordMatch()"
                                        placeholder="Confirm new password"
                                        :class="errors.confirmPassword ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10' : 'border-gray-300 focus:border-[#FF2D20] focus:ring-[#FF2D20]/10'"
                                        class="h-11 w-full rounded-lg border bg-transparent py-2.5 pr-11 pl-4 text-sm text-gray-900 placeholder:text-gray-500 focus:ring-2 focus:outline-none transition"
                                    >
                                    <span @click="showConfirmPassword = !showConfirmPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer text-gray-500">
                                        <svg x-show="!showConfirmPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z" fill="#98A2B3"></path>
                                        </svg>
                                        <svg x-show="showConfirmPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z" fill="#98A2B3"></path>
                                        </svg>
                                    </span>
                                </div>
                                <p x-show="errors.confirmPassword" x-text="errors.confirmPassword" class="mt-2 text-sm text-red-600"></p>
                            </div>

                            <!-- Password Requirements -->
                            <div class="bg-gray-50 rounded-lg p-4 text-sm text-gray-600">
                                <p class="font-medium mb-2">Password must contain:</p>
                                <ul class="space-y-1">
                                    <li class="flex items-center">
                                        <span x-bind:class="passwordRequirements.length ? 'text-green-600' : 'text-gray-400'" class="mr-2">✓</span>
                                        At least 8 characters
                                    </li>
                                    <li class="flex items-center">
                                        <span x-bind:class="passwordRequirements.letter ? 'text-green-600' : 'text-gray-400'" class="mr-2">✓</span>
                                        At least one letter (a-z, A-Z)
                                    </li>
                                    <li class="flex items-center">
                                        <span x-bind:class="passwordRequirements.number ? 'text-green-600' : 'text-gray-400'" class="mr-2">✓</span>
                                        At least one number (0-9)
                                    </li>
                                    <li class="flex items-center">
                                        <span x-bind:class="passwordRequirements.special ? 'text-green-600' : 'text-gray-400'" class="mr-2">✓</span>
                                        At least one special character (!@#$%^&*)
                                    </li>
                                </ul>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button
                                    type="submit"
                                    :disabled="isSubmitting"
                                    class="w-full bg-[#c5480e] hover:bg-[#E62A1C] disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-medium py-3 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-[#FF2D20]/50 focus:ring-offset-2"
                                >
                                    <span x-show="!isSubmitting">Reset Password</span>
                                    <span x-show="isSubmitting" class="flex items-center justify-center">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Resetting...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Back to Sign In -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="text-center text-sm text-gray-600">
                            Remember your password?
                            <a href="/" class="font-medium text-[#c5480e] hover:text-[#E62A1C]">Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alpine.js for interactivity -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            function resetPasswordForm() {
                return {
                    newPassword: '',
                    confirmPassword: '',
                    errors: {
                        newPassword: '',
                        confirmPassword: ''
                    },
                    passwordRequirements: {
                        length: false,
                        letter: false,
                        number: false,
                        special: false
                    },
                    isSubmitting: false,

                    validateField(field) {
                        switch(field) {
                            case 'newPassword':
                                this.validatePasswordStrength();
                                if (!this.newPassword) {
                                    this.errors.newPassword = 'New password is required';
                                } else if (!this.isPasswordValid()) {
                                    this.errors.newPassword = 'Password does not meet requirements';
                                } else {
                                    this.errors.newPassword = '';
                                }
                                this.validatePasswordMatch();
                                break;

                            case 'confirmPassword':
                                this.validatePasswordMatch();
                                break;
                        }
                    },

                    validatePasswordStrength() {
                        if (!this.newPassword) {
                            this.passwordRequirements = { length: false, letter: false, number: false, special: false };
                            return;
                        }

                        this.passwordRequirements = {
                            length: this.newPassword.length >= 8,
                            letter: /[a-zA-Z]/.test(this.newPassword),
                            number: /[0-9]/.test(this.newPassword),
                            special: /[!@#$%^&*]/.test(this.newPassword)
                        };
                    },

                    isPasswordValid() {
                        return Object.values(this.passwordRequirements).every(req => req === true);
                    },

                    validatePasswordMatch() {
                        if (this.confirmPassword && this.newPassword !== this.confirmPassword) {
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
                        this.validateField('newPassword');
                        this.validateField('confirmPassword');

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

                            // Show success modal
                            const modalElement = document.querySelector('[x-data="{ showSuccess: false, successMessage: \'\' }"]');
                            const modalComponent = Alpine.$data(modalElement);

                            modalComponent.successMessage = 'Your password has been reset successfully!';
                            modalComponent.showSuccess = true;

                            // Clear form
                            this.newPassword = '';
                            this.confirmPassword = '';
                            this.passwordRequirements = { length: false, letter: false, number: false, special: false };
                            Object.keys(this.errors).forEach(key => this.errors[key] = '');
                        }, 1500);
                    }
                }
            }
        </script>
    </body>
</html>
