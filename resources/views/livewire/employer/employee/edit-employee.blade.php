<div>
  <div class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 lg:py-5 mx-auto">
    <div class="mx-auto max-w-2xl">
      <div class="text-center">
        <h2 class="text-xl text-gray-800 font-bold sm:text-3xl dark:text-white">
         Edit Employee
        </h2>
      </div>

      <div class="mt-5 p-4 relative z-10 bg-white border border-gray-200 rounded-xl sm:mt-10 md:p-10 dark:bg-neutral-900 dark:border-neutral-700">
        <form wire:submit.prevent="update">
          <!-- First Name -->
          <div class="mb-4 sm:mb-8">
            <label for="first_name" class="block mb-2 text-sm font-medium dark:text-white">First name</label>
            <input wire:model="first_name" type="text" id="first_name" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="First name">
            @error('first_name') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Last Name -->
          <div class="mb-4 sm:mb-8">
            <label for="last_name" class="block mb-2 text-sm font-medium dark:text-white">Last name</label>
            <input wire:model="last_name" type="text" id="last_name" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Last name">
            @error('last_name') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Age -->
          <div class="mb-4 sm:mb-8">
            <label for="age" class="block mb-2 text-sm font-medium dark:text-white">Age</label>
            <input wire:model="age" type="number" id="age" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Age">
            @error('age') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Email -->
          <div class="mb-4 sm:mb-8">
            <label for="email" class="block mb-2 text-sm font-medium dark:text-white">Email address</label>
            <input wire:model="email" type="email" id="email" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Email address">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Phone -->
          <div class="mb-4 sm:mb-8">
            <label for="phone" class="block mb-2 text-sm font-medium dark:text-white">Phone</label>
            <input wire:model="phone" type="text" id="phone" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Phone">
            @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Position -->
          <div class="mb-4 sm:mb-8">
            <label for="position" class="block mb-2 text-sm font-medium dark:text-white">Position</label>
            <input wire:model="position" type="text" id="position" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Position">
            @error('position') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Hire Date -->
          <div class="mb-4 sm:mb-8">
            <label for="hire_date" class="block mb-2 text-sm font-medium dark:text-white">Hire date</label>
            <input wire:model="hire_date" type="date" id="hire_date" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            @error('hire_date') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Department -->
          <div class="mb-4 sm:mb-8">
            <label for="department" class="block mb-2 text-sm font-medium dark:text-white">Department</label>
            <select wire:model="department" id="department" class="py-3 px-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400">
              <option value="">Select Department</option>
              @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
              @endforeach
            </select>
            @error('department') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Submit Button -->
          <div class="mt-6 grid">
            <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
              <div wire:loading class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
              </div>
              Confirm
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

