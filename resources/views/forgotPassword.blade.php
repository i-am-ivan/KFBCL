<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KFBCL - Forgot Password</title>
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

                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Email Sent!</h3>
                    <p x-text="successMessage" class="text-gray-600 mb-6"></p>

                    <button @click="window.location.href = '/'" class="w-full bg-[#c5480e] hover:bg-[#E62A1C] text-white font-medium py-3 px-4 rounded-lg transition">
                        Go to Homepage
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
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4 p-3">
                            <img src="{{ asset('company_logo.png') }}" alt="Company Logo" class="w-full h-full object-contain rounded-full">
                        </div>
                    </div>

                    <!-- Header -->
                    <div class="mb-6 sm:mb-8 text-center">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-700 mb-2">
                            Reset Password
                        </h1>
                        <p class="text-sm text-gray-600">
                            Enter your email to receive a password reset link
                        </p>
                    </div>

                    <!-- Form -->
                    <form x-data="forgotPasswordForm()" @submit.prevent="submitForm" x-ref="form">
                        <div class="space-y-5">
                            <!-- Email with validation -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">
                                    Email<span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    x-model="email"
                                    @blur="validateEmail"
                                    @input="clearError"
                                    placeholder="info@gmail.com"
                                    :class="error ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10' : 'border-gray-300 focus:border-[#FF2D20] focus:ring-[#FF2D20]/10'"
                                    class="h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-900 placeholder:text-gray-500 focus:ring-2 focus:outline-none transition"
                                >
                                <!-- Error message -->
                                <p x-show="error" x-text="error" class="mt-2 text-sm text-red-600"></p>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button
                                    type="submit"
                                    :disabled="isSubmitting"
                                    class="w-full bg-[#c5480e] hover:bg-[#E62A1C] disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-medium py-3 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-[#FF2D20]/50 focus:ring-offset-2"
                                >
                                    <span x-show="!isSubmitting">Send Reset Link</span>
                                    <span x-show="isSubmitting" class="flex items-center justify-center">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Sending...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Sign In Link -->
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
                            Remembered your password?
                            <a href="/" class="font-medium text-[#c5480e] hover:text-[#E62A1C]">Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alpine.js for interactivity -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script>
            function forgotPasswordForm() {
                return {
                    email: '',
                    error: '',
                    isSubmitting: false,

                    validateEmail() {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                        if (!this.email.trim()) {
                            this.error = 'Email is required';
                            return false;
                        }

                        if (!emailRegex.test(this.email)) {
                            this.error = 'Please enter a valid email address';
                            return false;
                        }

                        this.error = '';
                        return true;
                    },

                    clearError() {
                        if (this.error) {
                            this.error = '';
                        }
                    },

                    submitForm() {
                        if (!this.validateEmail()) {
                            return;
                        }

                        this.isSubmitting = true;

                        // Simulate API call
                        setTimeout(() => {
                            this.isSubmitting = false;

                            // Get the modal's Alpine data directly
                            const modalElement = document.querySelector('[x-data="{ showSuccess: false, successMessage: \'\' }"]');
                            const modalComponent = Alpine.$data(modalElement);

                            // Show success modal
                            modalComponent.successMessage = 'Password reset link sent to ' + this.email;
                            modalComponent.showSuccess = true;

                            // Clear form
                            this.email = '';
                        }, 1500);
                    }
                }
            }
        </script>
    </body>
</html>
