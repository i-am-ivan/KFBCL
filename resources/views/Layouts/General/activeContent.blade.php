{{-- Active Member Status Content --}}

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

                        <button @click="activeTab = 'vehicles'"
                                :class="activeTab === 'vehicles' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M19 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M7.5 14h5l4 -4h-10.5m1.5 4l4 -4"></path>
                                <path d="M13 6h2l1.5 3l2 4"></path>
                            </svg>
                            Vehicles
                        </button>

                        <button @click="activeTab = 'contributions'"
                                :class="activeTab === 'contributions' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg width="20" height="20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="size-5" :class="activeTab === 'contributions' ? 'text-brand-600 dark:text-brand-400' : 'text-gray-700 dark:text-gray-300'">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="1" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"></path>
                            </svg>
                            Contributions
                        </button>

                        <button @click="activeTab = 'savings'"
                                :class="activeTab === 'savings' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-5" >
                                <path d="M15.3086 2C15.7228 2 16.0586 2.33579 16.0586 2.75V2.91898C16.807 3.10815 17.3609 3.78601 17.3609 4.59323C17.3609 5.00744 17.0251 5.34323 16.6109 5.34323C16.1967 5.34323 15.8609 5.00744 15.8609 4.59323C15.8609 4.46796 15.7594 4.36641 15.6341 4.36641H15.2391C14.9724 4.36641 14.7563 4.58257 14.7563 4.84921C14.7563 5.05046 14.8811 5.2306 15.0695 5.30127L16.0744 5.67811C16.8482 5.96833 17.3609 6.70814 17.3609 7.53464C17.3609 8.39065 16.8185 9.11996 16.0586 9.39759V9.63372C16.0586 10.0479 15.7228 10.3837 15.3086 10.3837C14.8944 10.3837 14.5586 10.0479 14.5586 9.63372V9.46488C13.8101 9.2757 13.2563 8.59785 13.2563 7.79062C13.2563 7.37641 13.5921 7.04062 14.0063 7.04062C14.4205 7.04062 14.7563 7.37641 14.7563 7.79062C14.7563 7.91589 14.8578 8.01744 14.9831 8.01744H15.3781C15.6448 8.01744 15.8609 7.80129 15.8609 7.53464C15.8609 7.3334 15.7361 7.15326 15.5477 7.08259L14.5428 6.70575C13.7689 6.41552 13.2563 5.67571 13.2563 4.84921C13.2563 3.99321 13.7987 3.2639 14.5586 2.98626V2.75C14.5586 2.33579 14.8944 2 15.3086 2Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.4266 11.0844C20.0839 10.5513 21.0447 10.6316 21.6044 11.2664C22.1114 11.8415 22.1317 12.6979 21.6525 13.2964L17.7859 18.125C17.4104 18.5938 16.8423 18.8667 16.2417 18.8667H10.0685C9.8825 18.8667 9.70317 18.9358 9.56527 19.0606L9.04042 19.5355C9.14503 19.864 9.01125 20.2324 8.7004 20.4119L6.1238 21.8995C5.76508 22.1066 5.30638 21.9837 5.09928 21.625L2.10061 16.4311C1.8935 16.0724 2.01641 15.6137 2.37513 15.4066L4.95173 13.919C5.18986 13.7815 5.47206 13.7895 5.69546 13.9153L7.38764 12.5626C7.94114 12.1201 8.64057 11.8151 9.41278 11.8116C10.2262 11.8079 11.5119 11.8799 12.6754 12.3045H15.2732C15.9345 12.3045 16.512 12.6637 16.8212 13.1975L19.4266 11.0844ZM8.55886 17.9483L8.2864 18.1948L6.53627 15.1635L8.32425 13.7342C8.66549 13.4614 9.04628 13.3133 9.41955 13.3116C10.1887 13.3081 11.296 13.3834 12.222 13.7363C12.3365 13.7799 12.4613 13.8045 12.5912 13.8045H15.2732C15.432 13.8045 15.5608 13.9333 15.5608 14.0922C15.5608 14.1589 15.5381 14.2203 15.5 14.2691L15.4269 14.3284C15.4184 14.3352 15.4102 14.3422 15.4021 14.3494C15.3633 14.3688 15.3195 14.3798 15.2732 14.3798H12.5383C12.1241 14.3798 11.7883 14.7156 11.7883 15.1298C11.7883 15.544 12.1241 15.8798 12.5383 15.8798H15.2732C15.7583 15.8798 16.1984 15.6865 16.5205 15.3728L20.3715 12.2494C20.404 12.223 20.4515 12.227 20.4792 12.2584C20.5043 12.2868 20.5053 12.3292 20.4816 12.3588L16.615 17.1874C16.5242 17.3007 16.3869 17.3667 16.2417 17.3667H10.0685C9.51056 17.3667 8.97255 17.574 8.55886 17.9483ZM3.77464 16.3307L6.02332 20.2255L7.30088 19.4879L5.05221 15.5931L3.77464 16.3307Z" fill="currentColor"></path>
                            </svg>
                            Savings
                        </button>

                        <button @click="activeTab = 'loans'"
                                :class="activeTab === 'loans' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg class="size-5" :class="activeTab === 'loans' ? 'text-brand-600 dark:text-brand-400' : 'text-gray-700 dark:text-gray-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Loans
                        </button>

                        <button @click="activeTab = 'fines'"
                                :class="activeTab === 'fines' ? 'text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400' : 'text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                class="inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out text-brand-500 border-brand-500 dark:text-brand-400 dark:border-brand-400">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-5" :class="activeTab === 'fines' ? 'text-brand-600 dark:text-brand-400' : 'text-gray-700 dark:text-gray-300'">
                            <path d="M17.8076 2C18.2218 2 18.5576 2.33579 18.5576 2.75V2.91898C19.3061 3.10815 19.8599 3.78601 19.8599 4.59323C19.8599 5.00744 19.5242 5.34323 19.1099 5.34323C18.6957 5.34323 18.3599 5.00744 18.3599 4.59323C18.3599 4.46796 18.2584 4.36641 18.1331 4.36641H17.7381C17.4714 4.36641 17.2553 4.58257 17.2553 4.84921C17.2553 5.05046 17.3801 5.2306 17.5686 5.30127L18.5734 5.67811C19.3473 5.96833 19.8599 6.70814 19.8599 7.53464C19.8599 8.39065 19.3175 9.11996 18.5576 9.39759V9.63372C18.5576 10.0479 18.2218 10.3837 17.8076 10.3837C17.3934 10.3837 17.0576 10.0479 17.0576 9.63372V9.46488C16.3092 9.2757 15.7553 8.59785 15.7553 7.79062C15.7553 7.37641 16.0911 7.04062 16.5053 7.04062C16.9195 7.04062 17.2553 7.37641 17.2553 7.79062C17.2553 7.91589 17.3568 8.01744 17.4821 8.01744H17.8771C18.1438 8.01744 18.3599 7.80129 18.3599 7.53464C18.3599 7.3334 18.2351 7.15326 18.0467 7.08259L17.0418 6.70575C16.268 6.41552 15.7553 5.67571 15.7553 4.84921C15.7553 3.99321 16.2977 3.2639 17.0576 2.98626V2.75C17.0576 2.33579 17.3934 2 17.8076 2Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 3.25045C4.25736 3.25045 3.25 4.25781 3.25 5.50045V18.5005C3.25 19.7431 4.25736 20.7505 5.5 20.7505H5.83333C7.07597 20.7505 8.08333 19.7431 8.08333 18.5005V5.50045C8.08333 4.25781 7.07598 3.25045 5.83333 3.25045H5.5ZM4.75 5.50045C4.75 5.08624 5.08579 4.75045 5.5 4.75045H5.83333C6.24755 4.75045 6.58333 5.08624 6.58333 5.50045V18.5005C6.58333 18.9147 6.24755 19.2505 5.83333 19.2505H5.5C5.08579 19.2505 4.75 18.9147 4.75 18.5005V5.50045Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.833 9.63424C10.5904 9.63424 9.58301 10.6416 9.58301 11.8842V18.5005C9.58301 19.7432 10.5904 20.7505 11.833 20.7505H12.1663C13.409 20.7505 14.4163 19.7432 14.4163 18.5005V11.8842C14.4163 10.6416 13.409 9.63424 12.1663 9.63424H11.833ZM11.083 11.8842C11.083 11.47 11.4188 11.1342 11.833 11.1342H12.1663C12.5806 11.1342 12.9163 11.47 12.9163 11.8842V18.5005C12.9163 18.9147 12.5806 19.2505 12.1663 19.2505H11.833C11.4188 19.2505 11.083 18.9147 11.083 18.5005V11.8842Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.916 14.9223C15.916 13.6797 16.9234 12.6723 18.166 12.6723H18.4993C19.742 12.6723 20.7493 13.6797 20.7493 14.9223V18.5005C20.7493 19.7432 19.742 20.7505 18.4993 20.7505H18.166C16.9234 20.7505 15.916 19.7432 15.916 18.5005V14.9223ZM18.166 14.1723C17.7518 14.1723 17.416 14.5081 17.416 14.9223V18.5005C17.416 18.9147 17.7518 19.2505 18.166 19.2505H18.4993C18.9136 19.2505 19.2493 18.9147 19.2493 18.5005V14.9223C19.2493 14.5081 18.9136 14.1723 18.4993 14.1723H18.166Z" fill="currentColor"></path>
                            </svg>
                            Bonuses & Fines
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
                <div class="pt-4 dark:border-gray-800 mb-8 gap-4 md:gap-6 p-6">
                    <!-- Personal Information -->
                    <div x-show="activeTab === 'personal'" class="border-b" x-data="memberInfo">
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

                    <!-- Addresses -->
                    <div x-show="activeTab === 'documents'" x-data="memberInfo">
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
                                <div class="mt-4 space-y-4 p-6">
                                                                            <!-- Driving License and Type -->
                                    <div>
                                        <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left p-4">
                                            <p class="text-sm text-gray-500 dark:text-gray-400"  x-text="memberData?.identification?.national_id || 'Not provided'">[ National ID number ]</p>

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

                    <!-- Contact Information -->
                    <div x-show="activeTab === 'savings'">
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                                            <div>
                                                                    <h3 class="text-lg font-semibold text-gray-600 dark:text-white/90">
                                                                        Savings
                                                                    </h3>
                                                                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                                                        Manage all member savings here.
                                                                    </p>
                                                            </div>

                                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                                <!-- Filter by Frequency -->
                                                                <div class="hidden lg:block">
                                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                        <option value="All">Frequency</option>
                                                                        <option value="Daily">Daily</option>
                                                                        <option value="Weekly">Weekly</option>
                                                                        <option value="Monthly">Monthly</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Filter by Frequency -->
                                                                <div class="hidden lg:block">
                                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                        <option value="All">Status</option>
                                                                        <option value="Daily">Confirmed</option>
                                                                        <option value="Weekly">Under Review</option>
                                                                        <option value="Monthly">Cancelled</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Print Button -->
                                                                <div>
                                                                    <button @click="printMembersReport()"
                                                                        class="hover:text-dark-900 shadow-theme-xs relative flex h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                                                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                                            <rect x="7" y="13" width="10" height="8" rx="2"></rect>
                                                                        </svg>
                                                                        Print
                                                                    </button>
                                                                </div>

                                                                <div>
                                                                    <button @click="withdrawSavingsModal = true"
                                                                        class="hover:text-dark-900 shadow-theme-xs relative flex inline-flex h-11 items-center justify-center  gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 text-sm font-medium transition-colors hover:bg-gray-100 hover:text-gray-700 hover:bg-gray-600 sm:w-auto">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        </svg>
                                                                        Withdraw
                                                                    </button>
                                                                </div>

                                                                <!-- Create new loan type button -->
                                                                <div>
                                                                    <button @click="savingsModal = true"
                                                                            class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg border border-gray-500 bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        </svg>
                                                                        Add Savings
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <!-- Savings Table -->
                                                        <div>
                                                            <!-- Savings Table -->
                                                            <div x-data="savingsTable()" x-init="init()">
                                                                <div class="custom-scrollbar overflow-x-auto">
                                                                        <table class="w-full">
                                                                            <!-- table header start -->
                                                                            <thead>
                                                                                <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                                                    <th class="p-4 whitespace-nowrap">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Transaction ID
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Amount
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Transaction Date
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Mode
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>

                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Status
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Actions
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <!-- table header end -->

                                                                            <!-- Message if no savings data found -->
                                                                            <template x-if="savings.length === 0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td colspan="10" class="px-4 py-12 text-center">
                                                                                            <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                                <!-- Documents Outline SVG Icon -->
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                                                                </svg>
                                                                                                <div class="space-y-2">
                                                                                                    <h2 class="text-xl font-semibold text-gray-700">No savings records found</h2>
                                                                                                    <p class="text-gray-500">Do some transactions to view savings performance</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </template>

                                                                            <!-- If there is data  display the table -->
                                                                            <template x-if="savings.length > 0">
                                                                                <!-- table body start -->
                                                                                <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                                                    <template x-for="saving in paginatedSavings" :key="saving.transactionId">
                                                                                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                                            <!-- LoanTypeID -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <div class="flex items-center gap-3">
                                                                                                        <div>
                                                                                                            <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="saving.transactionCode || 'N/A'"></p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Type -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="'Ksh ' + (saving.transactionAmount ? saving.transactionAmount.toLocaleString() : '0')"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Repayment Type -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="saving.transactionDate ? new Date(saving.transactionDate).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : 'N/A'"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Created On -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="saving.transactionMode || 'N/A'"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Status -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <p :class="saving.transactionStatus === 'Confirmed' || saving.transactionStatus === 'Approved' ? 'bg-success-50 text-theme-xs text-success-700 dark:bg-success-500/15 dark:text-success-500' :
                                                                                                            saving.transactionStatus === 'Pending' ? 'bg-warning-50 text-theme-xs text-warning-700 dark:bg-warning-500/15 dark:text-warning-500' :
                                                                                                            'bg-error-50 text-theme-xs text-error-600 dark:bg-error-500/15 dark:text-error-500'"
                                                                                                    class="rounded-full px-2 py-0.5 font-medium"
                                                                                                    x-text="saving.transactionStatus || 'N/A'"></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <!-- Actions -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div class="flex items-center col-span-2">
                                                                                                    <button @click="editSavingModal(saving)" class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                                                        <svg class="w-[28px] h-[28px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
                                                                                                        </svg>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </template>
                                                                                </tbody>
                                                                                <!-- table body end -->
                                                                            </template>

                                                                        </table>
                                                                </div>
                                                                    <!-- Table Navigations -->
                                                                <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                                                                        <div class="flex justify-center pb-4 sm:hidden">
                                                                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                Showing
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                                                to
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                                                of
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="savings.length">1</span>
                                                                            </span>
                                                                        </div>

                                                                        <div class="flex items-center justify-between">
                                                                            <div class="hidden sm:block">
                                                                                <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                Showing
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                                                to
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                                                of
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="savings.length">1</span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === 1" @click="goToPage(page - 1)" disabled="disabled">
                                                                                <span>
                                                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 8.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                                    </svg>
                                                                                </span>
                                                                                </button>

                                                                                <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                                                Page <span x-text="page">1</span> of <span x-text="totalPages">1</span>
                                                                                </span>

                                                                                <ul class="hidden items-center gap-0.5 sm:flex">
                                                                                <template x-for="n in totalPages" :key="n">
                                                                                    <li>
                                                                                    <a href="#" @click.prevent="goToPage(n)" :class="page === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                                        <span x-text="n"></span>
                                                                                    </a>
                                                                                    </li>
                                                                                </template>
                                                                                </ul>

                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === totalPages" @click="goToPage(page + 1)" disabled="disabled">
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

                    <!-- Vehicles Table (already complete) -->
                    <div x-show="activeTab === 'vehicles'" x-data="memberInfo">
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

                            <div>
                                <!-- Your existing Alpine code that works -->
                                <div x-show="memberData?.membership === 'Non-Member'">
                                    @include('Layouts.General.nonMemberVehicles')
                                </div>
                                <div x-show="memberData?.membership !== 'Non-Member'">
                                    @include('Layouts.General.memberVehicles')
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Contributions Table -->
                    <div x-show="activeTab === 'contributions'">
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]" x-data="contributionsTable()" x-init="init()">
                                        <!-- Contributions content here -->
                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                                    Contributions
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Review contributions performance
                                                </p>
                                            </div>

                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">

                                                <div class="hidden lg:block">
                                                    <select x-model="frequencyFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="Daily">Daily</option>
                                                        <option value="Weekly">Weekly</option>
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Yearly">Yearly</option>
                                                    </select>
                                                </div>

                                                <div class="hidden lg:block">
                                                    <select x-model="transactionFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="All">All Transactions</option>
                                                        <option value="Paid-In">Paid-In</option>
                                                        <option value="Paid-Out">Paid-Out</option>
                                                    </select>
                                                </div>

                                                <div class="hidden lg:block">
                                                    <select x-model="paymentFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="All">All Payment Types</option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="MPesa">MPesa</option>
                                                        <option value="Bank">Bank</option>
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

                                                <div>
                                                    <button @click="withdrawContributionModal = true"
                                                        class="hover:text-dark-900 shadow-theme-xs relative flex inline-flex h-11 items-center justify-center  gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 text-sm font-medium transition-colors hover:bg-gray-100 hover:text-gray-700 hover:bg-gray-600 sm:w-auto">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        Withdraw
                                                    </button>
                                                </div>

                                                <!-- Create New Fine Type button -->
                                                <div>

                                                        <button @click="contributionsModal = true" class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                            Make Contribution
                                                        </button>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Contributions table Table -->
                                        <div>
                                            <div class="custom-scrollbar overflow-x-auto">
                                                <table class="w-full table-auto">
                                                    <thead>
                                                        <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                #Transaction Code
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Amount
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Mode
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Transaction Code
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Transaction Date
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Status
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <!-- Message if no contributions data found -->
                                                    <template x-if="contributions.length === 0">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="10" class="px-4 py-12 text-center">
                                                                    <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                        <!-- Documents Outline SVG Icon -->
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                                        </svg>
                                                                        <div class="space-y-2">
                                                                            <h2 class="text-xl font-semibold text-gray-700">No Contribution records found</h2>
                                                                            <p class="text-gray-500">Do some transactions to view Contribution performance</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </template>

                                                    <!-- If records found display in table -->
                                                    <template x-if="contributions.length > 0">
                                                        <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                            <template x-for="contribution in paginatedContributions" :key="contribution.transactionId">
                                                                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="group flex items-center gap-3">
                                                                            <span class="text-theme-xs font-medium text-gray-700 dark:text-gray-400" x-text="contribution.transactionCode || 'N/A'"></span>
                                                                        </div>
                                                                    </td>
                                                                    <!-- Amount -->
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div>
                                                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="'Ksh ' + (contribution.transactionAmount ? contribution.transactionAmount.toLocaleString() : '0')"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div>
                                                                            <span class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.transactionMode || 'N/A'"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                         <span class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.transactionType || 'N/A'"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400" x-text="contribution.transactionDate ? new Date(contribution.transactionDate).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : 'N/A'"></p>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" :class="{
                                                                                'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': contribution.transactionStatus === 'Confirmed' || contribution.transactionStatus === 'Approved',
                                                                                'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400': contribution.transactionStatus === 'Pending',
                                                                                'bg-error-100 text-error-600 dark:bg-error-900/30 dark:text-error-400': contribution.transactionStatus === 'Cancelled' || contribution.transactionStatus === 'Reversed'
                                                                            }" x-text="contribution.transactionStatus || 'N/A'">
                                                                        </span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <button @click="$dispatch('open-edit-contribution-modal', { contribution: contribution })"
                                                                            class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                            <svg class="w-[22px] h-[22px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="1.1" d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z"></path>
                                                                            </svg>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                    </template>

                                                </table>
                                            </div>

                                            <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                                                <div class="flex justify-center pb-4 sm:hidden">
                                                    <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                        Showing
                                                        <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                        to
                                                        <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                        of
                                                        <span class="text-gray-800 dark:text-white/90" x-text="contributions.length">1</span>
                                                    </span>
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    <div class="hidden sm:block">
                                                        <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                            Showing
                                                            <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                            to
                                                            <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                            of
                                                            <span class="text-gray-800 dark:text-white/90" x-text="contributions.length">1</span>
                                                        </span>
                                                    </div>
                                                    <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === 1" @click="goToPage(page - 1)" disabled="disabled">
                                                                <span>
                                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 9.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                    </svg>
                                                                </span>
                                                    </button>

                                                    <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                            Page <span x-text="page">1</span> of <span x-text="totalPages">1</span>
                                                        </span>

                                                    <ul class="hidden items-center gap-0.5 sm:flex">
                                                        <template x-for="n in totalPages" :key="n">
                                                            <li>
                                                                <a href="#" @click.prevent="goToPage(n)" :class="page === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                <span x-text="n"></span>
                                                                </a>
                                                            </li>
                                                        </template>
                                                    </ul>

                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === totalPages" @click="goToPage(page + 1)" disabled="disabled">
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

                    <!-- Loans Table -->
                    <div x-show="activeTab === 'loans'" x-data="loansTable()">

                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                                            <div>
                                                                    <h3 class="text-lg font-semibold text-gray-600 dark:text-white/90">
                                                                        Loan
                                                                    </h3>
                                                                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                                                        Manage member loans
                                                                    </p>
                                                            </div>

                                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                                <!-- Filter by Frequency -->
                                                                <div class="hidden lg:block">
                                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                        <option value="All">Frequency</option>
                                                                        <option value="Daily">Daily</option>
                                                                        <option value="Weekly">Weekly</option>
                                                                        <option value="Monthly">Monthly</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Print Button -->
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

                                                                <div>
                                                                    <button @click="repayLoanModal = true"
                                                                        class="hover:text-dark-900 shadow-theme-xs relative flex inline-flex h-11 items-center justify-center  gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 whitespace-nowrap text-gray-700 text-sm font-medium transition-colors hover:bg-gray-100 hover:text-gray-700 hover:bg-gray-600 sm:w-auto">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                                <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            Repay Loan
                                                                    </button>
                                                                </div>

                                                                <!-- Create new loan type button -->
                                                                <div>
                                                                        <button @click="loansModal = true" class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            Assign Loan
                                                                        </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <!-- Loan Table -->
                                                        <div>
                                                            <!-- Loan Table -->
                                                            <div x-init="init()">
                                                                <div class="custom-scrollbar overflow-x-auto">
                                                                        <table class="w-full">
                                                                            <!-- table header start -->
                                                                            <thead>
                                                                                <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                                                    <th class="p-4 whitespace-nowrap">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Transaction Code
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Loan/Interest
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Period (Months)
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Borrowed
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Total
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Last Repayment (Amount/Date)
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Start Date
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                End Date
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Status
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Actions
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <!-- table header end -->

                                                                            <!-- Message if no loans data found -->
                                                                            <template x-if="loans.length === 0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td colspan="10" class="px-4 py-12 text-center">
                                                                                            <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                                <!-- Documents Outline SVG Icon -->
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                                                                </svg>
                                                                                                <div class="space-y-2">
                                                                                                    <h2 class="text-xl font-semibold text-gray-700">No loans records found</h2>
                                                                                                    <p class="text-gray-500">Do some transactions to view loans performance</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </template>

                                                                            <!-- If there is data display the table -->
                                                                            <template x-if="loans.length > 0">
                                                                                <!-- table body start -->
                                                                                <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                                                    <template x-for="loan in paginatedLoans" :key="loan.transactionId">
                                                                                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                                            <!-- Loan # (Transaction ID) -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="loan.transactionId || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Loan/Interest (Loan Type Name + Interest Rate) -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <div>
                                                                                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="loan.loan_type_name || loan.loanTypeName || 'N/A'"></span>
                                                                                                    <p class="text-xs text-gray-500 dark:text-gray-400" x-text="'Interest: ' + (loan.interest_rate || loan.interestRate || '0') + '%'"></p>
                                                                                                </div>
                                                                                            </td>

                                                                                            <!-- Period (Months) -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="(loan.transactionLoanPeriod || loan.loanPeriod || '0') + ' months'"></p>
                                                                                            </td>

                                                                                            <!-- Borrowed -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="'KES ' + Number(loan.transactionLoanAmount || loan.amount || 0).toLocaleString()"></p>
                                                                                                <p class="text-xs text-gray-500 dark:text-gray-400" x-text="'Outstanding: KES ' + Number(loan.outstanding_balance || loan.remaining_balance || 0).toLocaleString()"></p>
                                                                                            </td>

                                                                                            <!-- Total Loan -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="'KES ' + Number(loan.transactionTotalLoan || loan.totalLoan || loan.transactionLoanAmount || 0).toLocaleString()"></p>
                                                                                                <p class="text-xs text-gray-500 dark:text-gray-400" x-text="'Interest: KES ' + Number((loan.transactionTotalLoan || 0) - (loan.transactionLoanAmount || 0)).toLocaleString()"></p>
                                                                                            </td>

                                                                                            <!-- Last Repayment (Amount/Date) -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <template x-if="loan.last_repayment">
                                                                                                    <div>
                                                                                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="'KES ' + Number(loan.last_repayment.amount || 0).toLocaleString()"></p>
                                                                                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="loan.last_repayment.date ? new Date(loan.last_repayment.date).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : 'N/A'"></p>
                                                                                                    </div>
                                                                                                </template>
                                                                                                <template x-if="!loan.last_repayment">
                                                                                                    <span class="text-sm text-gray-400">No repayments yet</span>
                                                                                                </template>
                                                                                            </td>

                                                                                            <!-- Start Date -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="loan.transactionLoanStartDate ? new Date(loan.transactionLoanStartDate).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- End Date (Calculate from start date + period) -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="loan.transactionLoanEndDate ? new Date(loan.transactionLoanEndDate).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : (loan.transactionLoanStartDate ? new Date(new Date(loan.transactionLoanStartDate).setDate(new Date(loan.transactionLoanStartDate).getDate() + ((loan.transactionLoanPeriod || 0) * 30))).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : 'N/A')"></p>
                                                                                            </td>

                                                                                            <!-- Status -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full"
                                                                                                    :class="{
                                                                                                        'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': loan.transactionLoanStatus === 'Active' || loan.transactionLoanStatus === 'Approved',
                                                                                                        'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400': loan.transactionLoanStatus === 'Under Review' || loan.transactionLoanStatus === 'Pending',
                                                                                                        'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400': loan.transactionLoanStatus === 'Repaid',
                                                                                                        'bg-error-100 text-error-600 dark:bg-error-900/30 dark:text-error-400': loan.transactionLoanStatus === 'Defaulted' || loan.transactionLoanStatus === 'Stopped' || loan.transactionLoanStatus === 'Cancelled'
                                                                                                    }"
                                                                                                    x-text="loan.transactionLoanStatus || loan.transactionStatus || 'N/A'">
                                                                                                </span>
                                                                                            </td>

                                                                                            <!-- Actions -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <button @click="$dispatch('open-edit-loan-modal', { loan: loan })"
                                                                                                    class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                                                    <svg class="w-[22px] h-[22px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                                        <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="1.1" d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z"></path>
                                                                                                    </svg>
                                                                                                </button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </template>
                                                                                </tbody>
                                                                                <!-- table body end -->
                                                                            </template>

                                                                        </table>
                                                                </div>
                                                                    <!-- Table Navigations -->
                                                                <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                                                                        <div class="flex justify-center pb-4 sm:hidden">
                                                                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                Showing
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                                                to
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                                                of
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="loans.length">1</span>
                                                                            </span>
                                                                        </div>

                                                                        <div class="flex items-center justify-between">
                                                                            <div class="hidden sm:block">
                                                                                <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                Showing
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                                                to
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                                                of
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="loans.length">1</span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === 1" @click="goToPage(page - 1)" disabled="disabled">
                                                                                <span>
                                                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 8.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                                    </svg>
                                                                                </span>
                                                                                </button>

                                                                                <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                                                Page <span x-text="page">1</span> of <span x-text="totalPages">1</span>
                                                                                </span>

                                                                                <ul class="hidden items-center gap-0.5 sm:flex">
                                                                                <template x-for="n in totalPages" :key="n">
                                                                                    <li>
                                                                                        <a href="#" @click.prevent="goToPage(n)" :class="page === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                                            <span x-text="n"></span>
                                                                                        </a>
                                                                                    </li>
                                                                                </template>


                                                                                </ul>

                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === totalPages" @click="goToPage(page + 1)" disabled="disabled">
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

                    <!-- Fines Table -->
                    <div x-show="activeTab === 'fines'">
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                        <!-- Contributions content here -->
                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                                    Fines & Penalties
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Review Fines & Penalties performance
                                                </p>
                                            </div>

                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">

                                                <div class="hidden lg:block">
                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="Daily">Frequency</option>
                                                        <option value="Daily">Daily</option>
                                                        <option value="Weekly">Weekly</option>
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Yearly">Yearly</option>
                                                    </select>
                                                </div>

                                                <div class="hidden lg:block">
                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                        <option value="All">Payment Type</option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="MPesa">MPesa</option>
                                                        <option value="Bank">Bank</option>
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

                                            </div>
                                        </div>
                                        <!-- Contributions table Table -->
                                        <div x-data="finesTable()" x-init="init()">
                                            <div class="custom-scrollbar overflow-x-auto">
                                                <table class="w-full table-auto">
                                                    <thead>
                                                        <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                #Code
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Type
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Percentage
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Total Fines
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Total Issued
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Created On
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Status
                                                            </th>
                                                            <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <!-- Message if no fines data found -->
                                                    <template x-if="fines.length === 0">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="10" class="px-4 py-12 text-center">
                                                                    <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                        <!-- Documents Outline SVG Icon -->
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                                        </svg>
                                                                        <div class="space-y-2">
                                                                            <h2 class="text-xl font-semibold text-gray-700">No fines records found</h2>
                                                                            <p class="text-gray-500">Do some transactions to view fines performance</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </template>

                                                    <!-- If records found display in table -->
                                                    <template x-if="fines.length > 0">
                                                        <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                            <template x-for="fine in paginatedFines" :key="fine.FineID">
                                                                <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div class="group flex items-center gap-3">
                                                                        <a href="view-member.php" class="text-theme-xs font-medium text-gray-700 group-hover:underline dark:text-gray-400" x-text="fine.FineID"></a>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <div>
                                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="fine.Type"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="fine.Percentage"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="text-sm text-gray-700 dark:text-gray-400" x-text="fine.TotalFineAmount"></span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400 truncate max-w-[200px]" x-text="fine.TotalFinesIssued + ' issued'" :title="fine.TotalFinesIssued + ' issued'"></p>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <p class="text-sm text-gray-700 dark:text-gray-400 truncate max-w-[200px]" x-text="fine.CreatedOn"></p>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" :class="{
                                                                                'bg-success-100 text-success-600 dark:bg-success-900/30 dark:text-success-400': fine.Status === 'Active',
                                                                                'bg-warning-100 text-warning-600 dark:bg-warning-900/30 dark:text-warning-400': fine.Status === 'Suspended' || fine.Status === 'In-Active',
                                                                                'bg-error-100 text-error-600 dark:bg-error-900/30 dark:text-error-400': fine.Status === 'Blacklisted' || fine.Status === 'Under Review'
                                                                            }" x-text="fine.Status">
                                                                        </span>
                                                                    </td>
                                                                    <td class="p-4 whitespace-nowrap">
                                                                        <button @click="$store.fineTypeData.editFine(fine)" class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                                                            <svg class="w-[22px] h-[22px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                                <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="1.1" d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z"></path>
                                                                            </svg>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </template>
                                                        </tbody>
                                                    </template>

                                                </table>
                                            </div>

                                            <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                                                <div class="flex justify-center pb-4 sm:hidden">
                                                    <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                        Showing
                                                        <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                        to
                                                        <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                        of
                                                        <span class="text-gray-800 dark:text-white/90" x-text="fines.length">1</span>
                                                    </span>
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    <div class="hidden sm:block">
                                                        <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                            Showing
                                                            <span class="text-gray-800 dark:text-white/90" x-text="startEntry">1</span>
                                                            to
                                                            <span class="text-gray-800 dark:text-white/90" x-text="endEntry">1</span>
                                                            of
                                                            <span class="text-gray-800 dark:text-white/90" x-text="fines.length">1</span>
                                                        </span>
                                                    </div>
                                                    <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === 1" @click="goToPage(page - 1)" disabled="disabled">
                                                                <span>
                                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 9.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                    </svg>
                                                                </span>
                                                    </button>

                                                    <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                            Page <span x-text="page">1</span> of <span x-text="totalPages">1</span>
                                                        </span>

                                                    <ul class="hidden items-center gap-0.5 sm:flex">
                                                        <template x-for="n in totalPages" :key="n">
                                                        <li>
                                                            <a href="#" @click.prevent="goToPage(n)" :class="page === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'" class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                            <span x-text="n"></span>
                                                            </a>
                                                        </li>
                                                        </template>
                                                    </ul>

                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200" :disabled="page === totalPages" @click="goToPage(page + 1)" disabled="disabled">
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
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 p-5 dark:border-gray-800">
                                <div class="flex gap-3">
                                <div class="order-3 xl:order-2">
                                    <h4 class="mb-2 text-center text-medium font-semibold text-gray-600 xl:text-left dark:text-white/90">
                                    Account Status
                                    </h4>
                                    <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Member #KBSTK202601</p>
                                    <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Role: Rider</p>
                                    <div class="hidden h-3.5 w-px bg-gray-300 xl:block dark:bg-gray-700"></div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400"><span class="bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 text-xs font-medium">Active</span> since December 09, 2025 15:24</p>
                                    </div>
                                </div>
                                </div>
                                <div x-data="{ switcherToggle: false }">
                                <button @click="deleteMemberAccount = true"
                                        class="shadow-theme-xs inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-while-700 ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-error-700 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                                    De-Activate Account
                                </button>
                                </div>
                            </div>
                            </article>
                        </div>

                    </div>

                </div>
