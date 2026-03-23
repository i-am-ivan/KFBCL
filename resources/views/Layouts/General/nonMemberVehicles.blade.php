                                                        <div class="flex flex-col justify-between gap-5 border-b border-gray-200 px-5 py-4 sm:flex-row lg:items-center dark:border-gray-800">

                                                            <!-- Assigned Vehicle Details -->

                                                            <div>
                                                                    <h3 class="text-lg font-semibold text-gray-600 dark:text-white/90">
                                                                        Vehicle
                                                                    </h3>
                                                                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                                                                        Vehicle assignment history
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

                                                            </div>

                                                        </div>

                                                        <!-- Assigned Vehicles Table -->
                                                        <div>

                                                            <!-- Non-Member Vehicles Table -->
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
                                                                                                Vehicle
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Owner
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Avaialbility
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Date Assigned
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Date Re-Assigned
                                                                                            </p>
                                                                                        </div>
                                                                                    </th>
                                                                                    <th class="p-4 text-left text-xs font-medium whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                                                        <div class="flex items-center">
                                                                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                                Duration
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

                                                                                </tr>
                                                                            </thead>
                                                                            <!-- table header end -->

                                                                            <!-- Message if no assigned vehicles found -->
                                                                            <template x-if="nonMemberVehicles.length === 0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td colspan="9" class="px-4 py-12 text-center">
                                                                                            <div class="inline-flex flex-col items-center justify-center space-y-4 p-4">
                                                                                                <!-- Documents Outline SVG Icon -->
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                                                                </svg>
                                                                                                <div class="space-y-2">
                                                                                                    <h2 class="text-xl font-semibold text-gray-700">No assigned vehicles found</h2>
                                                                                                    <p class="text-gray-500">This member has no vehicles assigned.</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </template>

                                                                            <!-- If there is data display the table -->
                                                                            <template x-if="nonMemberVehicles.length > 0">
                                                                                <tbody class="divide-x divide-y divide-gray-200 dark:divide-gray-800">
                                                                                    <template x-for="vehicle in paginatedNonMemberVehicles" :key="vehicle.assignedId">
                                                                                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900">
                                                                                            <!-- Vehicle Code -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-400" x-text="vehicle.vehicle_code || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Vehicle -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.vehicle || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Owner -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.owner || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Availability -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.availability || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Date Assigned -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.assigned_date || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Date Re-Assigned -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.reassigned_date || 'N/A'"></p>
                                                                                            </td>

                                                                                            <!-- Duration -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="vehicle.duration_days + ' days'"></p>
                                                                                            </td>

                                                                                            <!-- Status -->
                                                                                            <td class="p-4 whitespace-nowrap">
                                                                                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full"
                                                                                                    :class="vehicle.status === 'Approved' ? 'bg-success-50 text-success-700 dark:bg-success-500/15 dark:text-success-500' : 'bg-warning-50 text-warning-700 dark:bg-warning-500/15 dark:text-warning-500'"
                                                                                                    x-text="vehicle.status || 'N/A'">
                                                                                                </span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </template>
                                                                                </tbody>
                                                                            </template>

                                                                        </table>
                                                                    </div>

                                                                    <!-- Table Navigations -->
                                                                    <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                                                                        <div class="flex justify-center pb-4 sm:hidden">
                                                                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                Showing
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="startEntryNonMember">1</span>
                                                                                to
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="endEntryNonMember">1</span>
                                                                                of
                                                                                <span class="text-gray-800 dark:text-white/90" x-text="nonMemberVehicles.length">0</span>
                                                                            </span>
                                                                        </div>

                                                                        <div class="flex items-center justify-between">
                                                                            <div class="hidden sm:block">
                                                                                <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                                                                    Showing
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="startEntryNonMember">1</span>
                                                                                    to
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="endEntryNonMember">1</span>
                                                                                    of
                                                                                    <span class="text-gray-800 dark:text-white/90" x-text="nonMemberVehicles.length">0</span>
                                                                                </span>
                                                                            </div>

                                                                            <div class="flex w-full items-center justify-between gap-2 rounded-lg bg-gray-50 p-4 sm:w-auto sm:justify-normal sm:rounded-none sm:bg-transparent sm:p-0 dark:bg-gray-900 dark:sm:bg-transparent">
                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                                        :disabled="pageNonMember === 1"
                                                                                        @click="prevPageNonMember">
                                                                                    <span>
                                                                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58203 9.99868C2.58174 10.1909 2.6549 10.3833 2.80152 10.53L7.79818 15.5301C8.09097 15.8231 8.56584 15.8233 8.85883 15.5305C9.15183 15.2377 9.152 14.7629 8.85921 14.4699L5.13911 10.7472L16.6665 10.7472C17.0807 10.7472 17.4165 10.4114 17.4165 9.99715C17.4165 9.58294 17.0807 9.24715 16.6665 9.24715L5.14456 9.24715L8.85919 5.53016C9.15199 5.23717 9.15184 4.7623 8.85885 4.4695C8.56587 4.1767 8.09099 4.17685 7.79819 4.46984L2.84069 9.43049C2.68224 9.568 2.58203 9.77087 2.58203 9.99715C2.58203 9.99766 2.58203 9.99817 2.58203 9.99868Z" fill=""></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </button>

                                                                                <span class="block text-sm font-medium text-gray-700 sm:hidden dark:text-gray-400">
                                                                                    Page <span x-text="pageNonMember">1</span> of <span x-text="totalPagesNonMember">1</span>
                                                                                </span>

                                                                                <ul class="hidden items-center gap-0.5 sm:flex">
                                                                                        <template x-for="n in totalPagesNonMember" :key="n">
                                                                                            <li>
                                                                                                <a href="#" @click.prevent="goToPageNonMember(n)"
                                                                                                :class="pageNonMember === n ? 'bg-brand-500 text-white' : 'hover:bg-brand-500 text-gray-700 dark:text-gray-400 hover:text-white dark:hover:text-white'"
                                                                                                class="flex h-10 w-10 items-center justify-center rounded-lg text-sm font-medium">
                                                                                                    <span x-text="n"></span>
                                                                                                </a>
                                                                                            </li>
                                                                                        </template>
                                                                                    </ul>

                                                                                <button class="shadow-theme-xs flex items-center gap-2 rounded-lg border border-gray-300 bg-white p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed disabled:opacity-50 sm:p-2.5 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
                                                                                        :disabled="pageNonMember === totalPagesNonMember"
                                                                                        @click="nextPageNonMember">
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
