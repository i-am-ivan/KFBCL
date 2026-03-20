
                                                       <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">
                                                            <div>
                                                                    <h3 class="text-lg font-semibold text-gray-600 dark:text-white/90">
                                                                        Vehicle
                                                                    </h3>
                                                                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                                                        Manage Member Vehicles
                                                                    </p>
                                                            </div>

                                                            <div class="hidden flex-col gap-3 sm:flex sm:flex-row sm:items-center">
                                                                <!-- Filter by Frequency -->
                                                                <div class="hidden lg:block">
                                                                    <select x-model="statusFilter" @change="performFilter()" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                                                        <option value="All">Vehicle Type</option>
                                                                        <option value="Motorcycle">Motorcycle</option>
                                                                        <option value="Tuk Tuk">Tuk Tuk</option>
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

                                                                <!-- Member -->
                                                                <div>
                                                                        <button
                                                                            @click="vehiclesModal = true" class="shadow-theme-xs inline-flex flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                            <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            Add Vehicle
                                                                        </button>

                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- Vehicles Table -->
                                                        <div>
                                                            <!-- Vehicles Table -->
                                                            <!-- Members Vehicle Table -->
                                                            <div>

                                                                <div x-data="vehiclesTable" x-init="init()">
                                                                    <div class="custom-scrollbar overflow-x-auto">
                                                                            <table class="w-full">
                                                                                <!-- table header start -->
                                                                                <thead>
                                                                                    <tr class="border-b border-gray-200 dark:divide-gray-800 dark:border-gray-800">
                                                                                        <th class="p-4 whitespace-nowrap">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Vehicle Code
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Type/Plate Number
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Brand/Model
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Make/CC
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Insuarance
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    NTSA Compliant
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Year of Manufacture
                                                                                                </p>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                            <div class="flex items-center">
                                                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                    Availability
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
                                                                                <template x-if="memberVehicles.length === 0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="10" class="px-4 py-12 text-center">
                                                                                                <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                                    <!-- Documents Outline SVG Icon -->
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                                                                    </svg>
                                                                                                    <div class="space-y-2">
                                                                                                        <h2 class="text-xl font-semibold text-gray-700">No Vehicle records found</h2>
                                                                                                        <p class="text-gray-500">Add a new vehicle record to manage.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </template>

                                                                                <!-- If there is data  display the table -->
                                                                                <template x-if="memberVehicles.length > 0">
                                                                                    <!-- table body start -->
                                                                                    <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                                                        <template x-for="vehicle in paginatedMemberVehicles" :key="vehicle.vehicleId">
                                                                                            <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                                                <!-- LoanTypeID -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <div class="flex items-center gap-3">
                                                                                                            <div>
                                                                                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="vehicle.vehicleId || 'N/A'"></p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Type/Plate Number (stacked as requested) -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div>
                                                                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="vehicle.type || 'N/A'"></span>
                                                                                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="vehicle.plate_number || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Brand/Model -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div>
                                                                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="vehicle.brand || 'N/A'"> </span>
                                                                                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="vehicle.model || 'N/A'"> </p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Make/CC -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div>
                                                                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="vehicle.make || 'N/A'"></span>
                                                                                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="vehicle.CC || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Insurance -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="vehicle.insurance || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- NTSA Compliant -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="vehicle.NTSA_compliant || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Created On -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <p class="text-xs font-sm text-gray-700 dark:text-gray-400" x-text="vehicle.yom || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Availability -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <p :class="vehicle.availability === 'Available' ? 'bg-success-50 text-theme-xs text-success-700 dark:bg-success-500/15 dark:text-success-500' : 'bg-gray-50 text-theme-xs text-gray-600 dark:bg-gray-500/15 dark:text-error-500'" class="rounded-full px-2 py-0.5 font-medium" x-text="vehicle.availability || 'Loading ...'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Status -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <p :class="vehicle.status === 'Approved' || vehicle.status === 'Active' ? 'bg-success-50 text-theme-xs text-success-700 dark:bg-success-500/15 dark:text-success-500' : 'bg-error-50 text-theme-xs text-error-600 dark:bg-error-500/15 dark:text-error-500'" class="rounded-full px-2 py-0.5 font-medium" x-text="vehicle.status || 'N/A'"></p>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <!-- Actions -->
                                                                                                <td class="p-4 whitespace-nowrap">
                                                                                                    <div class="flex items-center col-span-2">
                                                                                                        <button @click="$dispatch('open-edit-vehicle-modal', { vehicle: vehicle })"
                                                                                                            class="shadow-theme-xs inline-flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 text-gray-500 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
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
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="startEntryMember">1</span>
                                                                                    to
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="endEntryMember">1</span>
                                                                                    of
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="memberVehicles.length">1</span>
                                                                                </span>
                                                                            </div>

                                                                            <div class="flex items-center justify-between">
                                                                                <div class="hidden sm:block">
                                                                                    <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                    Showing
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="startEntryMember">1</span>
                                                                                    to
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="endEntryMember">1</span>
                                                                                    of
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="memberVehicles.length">1</span>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                                        :disabled="pageMember === 1"
                                                                                        @click="prevPageMember"
                                                                                        disabled="disabled">
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
                                                                                        <template x-for="n in totalPagesMember" :key="n">
                                                                                            <li>
                                                                                                <a href="#" @click.prevent="goToPageMember(n)"
                                                                                                :class="pageMember === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'"
                                                                                                class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                                                    <span x-text="n"></span>
                                                                                                </a>
                                                                                            </li>
                                                                                        </template>
                                                                                    </ul>

                                                                                    <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                                        :disabled="pageMember === totalPagesMember"
                                                                                        @click="goToPage(page + 1)"
                                                                                        disabled="disabled">
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
