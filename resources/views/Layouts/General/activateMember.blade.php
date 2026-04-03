
    {{-- Activate Member Status Content --}}

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

                 <!-- Profile Active -->
                <div class="pt-4 dark:border-gray-800 mb-8 gap-4 md:gap-6 p-6" x-data="memberInfo">
                    <!-- Personal Information -->
                    <div x-show="activeTab === 'personal'" class="border-b">
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
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.firstname || 'Loading...'">+254 723 000 000</p>
                          </div>
                          <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Last Name</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.lastname || 'Loading...'">+254 725 000 000</p>
                          </div>
                        </div>
                        <div>
                          <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Email</p>
                          <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.email || 'Loading...'">randomuser@pimjo.com</p>
                        </div>
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                          <div>
                            <span class="mb-1 text-xs text-gray-500 dark:text-gray-400">Primary Phone</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.phone1 || 'Loading...'">+254 723 000 000</p>
                          </div>
                          <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Secondary Phone</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.phone2 || 'Loading...'">+254 725 000 000</p>
                          </div>
                          <div>
                            <span class="mb-1 text-xs text-gray-500 dark:text-gray-400">Gender</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.gender || 'Loading...'">+254 723 000 000</p>
                          </div>
                          <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Date of Birth</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.dob || 'Loading...'">+254 725 000 000</p>
                          </div>
                          <div>
                            <span class="mb-1 text-xs text-gray-500 dark:text-gray-400">Membership</span>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.membership">+254 723 000 000</p>
                          </div>
                          <div>
                            <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Membership Status</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="memberData?.member?.status || 'Loading...'">+254 725 000 000</p>
                          </div>
                        </div>
                      </div>

                    </div>

                    <!-- Documents -->
                    <div x-show="activeTab === 'documents'">
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
                                <div class="mt-4 space-y-4 p-2">
                                                                            <!-- Driving License and Type -->
                                    <div>
                                        <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left p-4">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                National Id/ Passport: <span x-text="memberData?.identification?.national_id || 'Loading ...'">[ National ID number ]></span>
                                            </p>
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
                                    <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center p-2">

                                        <div x-data="memberInfo" x-init="init()">

                                            <form @submit.prevent="updateMemberStatus" class="flex items-center gap-3">
                                                @csrf

                                                <input type="hidden" name="memberId" :value="memberData?.member?.memberId">

                                                <!-- Status Dropdown -->
                                                <div>
                                                    <select x-model="memberStatus"
                                                            @change="clearError('memberStatus')"
                                                            :class="errors.memberStatus ? 'border-error-500' : ''"
                                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-48 rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="">-- Member Status --</option>
                                                        <option value="Active">Active</option>
                                                        <option value="In-Active">In-Active</option>
                                                        <option value="Suspended">Suspended</option>
                                                    </select>
                                                    <span x-show="errors.memberStatus" x-text="errors.memberStatus" class="text-xs text-error-500 mt-1 block"></span>
                                                </div>

                                                <!-- Update Button -->
                                                <div>
                                                    <button type="submit"
                                                            :disabled="isUpdating"
                                                            class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                                        <span x-show="!isUpdating">Update Status</span>
                                                        <span x-show="isUpdating" class="flex items-center gap-2">
                                                            <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                            </svg>
                                                            Updating...
                                                        </span>
                                                    </button>
                                                </div>
                                            </form>

                                            <span x-show="errors.formError" x-text="errors.formError" class="text-xs text-error-500 mt-1 block"></span>

                                        </div>

                                    </div>

                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 p-5 dark:border-gray-800" x-data="memberInfo">
                                    <div class="flex gap-3">
                                    <div class="order-3 xl:order-2">
                                        <h4 class="mb-2 text-center text-medium font-semibold text-gray-600 xl:text-left dark:text-white/90">
                                        Account Status
                                        </h4>
                                        <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                            <p class="text-sm text-gray-500 dark:text-gray-400" x-text="memberData?.member?.memberId"></p>
                                        <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Membership: <span x-text="memberData?.member?.membership">Member</span></p>
                                        <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                <span class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 text-xs font-medium" x-text="memberData?.member?.status"></span>
                                                since <span x-text="formatDate(memberData?.member?.created_on)">December 09, 2025 15:24</span>
                                            </p>
                                        </div>
                                    </div>
                                    </div>
                                    <div x-data="{ switcherToggle: false }">
                                        @if(Auth::user()->canDeactivateAccount())
                                            <button @click="deleteMemberAccount = true"
                                                    class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-while-700 ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-error-700 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                                                De-Activate Account
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        </div>

                    </div>

                </div>
