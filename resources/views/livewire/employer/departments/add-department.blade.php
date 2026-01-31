<div>
  <div class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 lg:py-5 mx-auto">
    <div class="mx-auto max-w-2xl">
      <div class="text-center">
        <h2 class="text-xl text-gray-800 font-bold sm:text-3xl dark:text-white">
          Add Department
        </h2>
      </div>

      <div class="mt-5 p-4 relative z-10 bg-white border border-gray-200 rounded-xl sm:mt-10 md:p-10 dark:bg-neutral-900 dark:border-neutral-700">
        <form wire:submit.prevent="save">
          <!-- First Name -->
          <div class="mb-4 sm:mb-8">
            <label for="name" class="block mb-2 text-sm font-medium dark:text-white">Department name</label>
            <input wire:model="name" type="text" id="name" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Department name">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Submit Button -->
          <div class="mt-6 grid">
            <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
              <div wire:loading class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
              </div>
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
