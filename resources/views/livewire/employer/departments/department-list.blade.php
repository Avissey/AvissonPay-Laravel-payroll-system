<div>
  <!-- Table Section -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Card -->
    <div class="flex flex-col">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
            <!-- Header -->
            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
              <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                  Department
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                  List of all Department
                </p>
              </div>

              <div>
                <div class="inline-flex gap-x-2">
                  <!-- SearchBox -->
                  <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
                      <svg class="shrink-0 size-4 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                      </svg>
                    </div>

                    <!--Livewire search input -->
                    <input
                      wire:model.debounce.300ms="search"
                      type="text"
                      placeholder="Search department"
                      class="py-2.5 ps-10 pe-4 block w-full border-gray-200 rounded-lg sm:text-sm
                      focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900
                      dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500
                      dark:focus:ring-neutral-600" />
                  </div>
                  <!-- End SearchBox -->


                  <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="/department/create" wire:navigate>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M5 12h14" />
                      <path d="M12 5v14" />
                    </svg>
                    Add Department
                  </a>
                </div>
              </div>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
              <thead class="bg-gray-50 divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
                <tr>
                  <th scope="col" class="px-6 py-3 text-start border-s border-gray-200 dark:border-neutral-700">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                      Department Name
                    </span>
                    </th>
                  <th scope="col" class="px-6 py-3 text-start">
                    <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                      Action
                    </span>
                  </th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

                @foreach ($departments as $department)
                <tr wire:key="department-{{ $department->id }}">
                  <td class="h-px w-auto whitespace-nowrap">
                    <div class="px-6 py-2">
                      <span class="font-semibold text-sm text-gray-800 dark:text-neutral-200">
                        {{ $department->name }}
                      </span>
                    </div>
                  </td>


                  <td class="h-px w-auto whitespace-nowrap">
                    <div class="px-6 py-2 flex items-center gap-x-2">
                      <!-- Edit -->
                      <a href="{{ route('department.edit', $department->id) }}"
                        class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-md text-blue-600 hover:text-white bg-blue-400 hover:bg-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-1.5L7.5 16.5 6 18l1.5-1.5 9.232-9.232z" />
                        </svg>
                        Edit
                      </a>

                      <!-- Delete -->
                      <button
                        wire:click="deleteDepartment({{ $department->id }})"
                        class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-md text-red-600 hover:text-white bg-red-400 hover:bg-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Delete
                      </button>
                    </div>
                  </td>
                </tr>

                </tr>

                @endforeach
              </tbody>

            </table>
            <!-- End Table -->

            <!-- Footer -->
            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
              <div>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                  <span class="font-semibold text-gray-800 dark:text-neutral-200">{{ $totalDepartments }}</span> Department available on payroll
                </p>
              </div>

              <div>
                <div class="inline-flex gap-x-2">
                  {{ $departments->links() }}
                </div>
              </div>
            </div>
            <!-- End Footer -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Table Section -->
</div>