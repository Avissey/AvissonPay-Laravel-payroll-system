<div>
  <div class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 lg:py-5 mx-auto">
    <div class="mx-auto max-w-2xl">
      <div class="text-center">
        <h2 class="text-xl text-gray-800 font-bold sm:text-3xl dark:text-white">
          Add Employee To Payroll
        </h2>
      </div>

      <div class="mt-5 p-4 relative z-10 bg-white border border-gray-200 rounded-xl sm:mt-10 md:p-10 dark:bg-neutral-900 dark:border-neutral-700">
        <form wire:submit.prevent="save">
          <!-- Employee select -->
          <div class="mb-4 sm:mb-8">
            <label for="employee_id" class="block mb-2 text-sm font-medium dark:text-white">Employee</label>
            <select wire:model="employee_id" id="employee_id" class="py-3 px-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400">
              <option value="">Select Employee</option>
              @foreach ($employees as $emp)
                <option value="{{ $emp->id }}">{{ $emp->full_name ?? $emp->first_name.' '.$emp->last_name }}</option>
              @endforeach
            </select>
            @error('employee_id') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Bank Name -->
          <div class="mb-4 sm:mb-8">
            <label for="bank_name" class="block mb-2 text-sm font-medium dark:text-white">Bank name</label>
            <input wire:model="bank_name" type="text" id="bank_name" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Bank name">
            @error('bank_name') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Account Name -->
          <div class="mb-4 sm:mb-8">
            <label for="account_name" class="block mb-2 text-sm font-medium dark:text-white">Account name</label>
            <input wire:model="account_name" type="text" id="account_name" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Account name">
            @error('account_name') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Account Number -->
          <div class="mb-4 sm:mb-8">
            <label for="account_number" class="block mb-2 text-sm font-medium dark:text-white">Account number</label>
            <input wire:model="account_number" type="text" id="account_number" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Account number">
            @error('account_number') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

           <!-- Momo Name` -->
          <div class="mb-4 sm:mb-8">
            <label for="momo_name" class="block mb-2 text-sm font-medium dark:text-white">Momo name</label>
            <input wire:model="momo_name" type="text" id="momo_name" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Momo name">
            @error('momo_name') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Momo Number -->
          <div class="mb-4 sm:mb-8">
            <label for="momo_number" class="block mb-2 text-sm font-medium dark:text-white">Momo number</label>
            <input wire:model="momo_number" type="text" id="momo_number" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Momo number">
            @error('momo_number') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <!-- Basic Salary -->
            <div class="mb-4 sm:mb-8">
              <label for="basic_salary" class="block mb-2 text-sm font-medium dark:text-white">Basic salary</label>
              <input wire:model="basic_salary" type="number" step="0.01" id="basic_salary" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="0.00">
              @error('basic_salary') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Salary Increment -->
            <div class="mb-4 sm:mb-8">
              <label for="salary_increment" class="block mb-2 text-sm font-medium dark:text-white">Salary increment</label>
              <input wire:model="salary_increment" type="number" step="0.01" id="salary_increment" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="0.00">
              @error('salary_increment') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Increment Type -->
            <div class="mb-4 sm:mb-8">
              <label for="increment_type" class="block mb-2 text-sm font-medium dark:text-white">Increment type</label>
              <select wire:model="increment_type" id="increment_type" class="py-3 px-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400">
                <option value="flat">Flat</option>
                <option value="percentage">Percentage</option>
              </select>
              @error('increment_type') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Gross Salary (computed) -->
            <div class="mb-4 sm:mb-8">
              <label class="block mb-2 text-sm font-medium dark:text-white">Gross salary (computed)</label>
              <div class="py-2.5 sm:py-3 px-4 rounded-lg bg-gray-50 dark:bg-neutral-800 text-sm">
                ₵{{ number_format($gross_salary ?? 0, 2) }}
              </div>
            </div>
          </div>

            <!-- Allowance -->
            <div class="mb-4 sm:mb-8">
              <label for="allowance" class="block mb-2 text-sm font-medium dark:text-white">Allowance</label>
              <input wire:model="allowance" type="number" step="0.01" id="allowance" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="0.00">
              @error('allowance') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Deduction (other fixed deduction) -->
            <div class="mb-4 sm:mb-8">
              <label for="deduction" class="block mb-2 text-sm font-medium dark:text-white">Other deduction</label>
              <input wire:model="deduction" type="number" step="0.01" id="deduction" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="0.00">
              @error('deduction') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
              <!-- SSNIT rate -->
              <div class="mb-4 sm:mb-8">
                <label for="ssnit_rate" class="block mb-2 text-sm font-medium dark:text-white">SSNIT rate (%)</label>
                <input wire:model="ssnit_rate" type="number" step="0.01" id="ssnit_rate" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="0.00">
                @error('ssnit_rate') <span class="text-red-500">{{ $message }}</span> @enderror
              </div>

              <!-- PAYE rate -->
              <div class="mb-4 sm:mb-8">
                <label for="paye_rate" class="block mb-2 text-sm font-medium dark:text-white">PAYE rate (%)</label>
                <input wire:model="paye_rate" type="number" step="0.01" id="paye_rate" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="0.00">
                @error('paye_rate') <span class="text-red-500">{{ $message }}</span> @enderror
              </div>

              <!-- Loan (fixed) -->
              <div class="mb-4 sm:mb-8">
                <label for="loan" class="block mb-2 text-sm font-medium dark:text-white">Loan (fixed)</label>
                <input wire:model="loan" type="number" step="0.01" id="loan" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="0.00">
                @error('loan') <span class="text-red-500">{{ $message }}</span> @enderror
              </div>

              <!-- Welfare (fixed) -->
              <div class="mb-4 sm:mb-8">
                <label for="welfare" class="block mb-2 text-sm font-medium dark:text-white">Welfare (fixed)</label>
                <input wire:model="welfare" type="number" step="0.01" id="welfare" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="0.00">
                @error('welfare') <span class="text-red-500">{{ $message }}</span> @enderror
              </div>
            </div>

          <!-- Pay Date -->
          <div class="mb-4 sm:mb-8">
            <label for="pay_date" class="block mb-2 text-sm font-medium dark:text-white">Pay date</label>
            <input wire:model="pay_date" type="date" id="pay_date" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            @error('pay_date') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>

          <!-- Show computed Gross and Net Salary (read-only) -->
          <div class="mb-4 sm:mb-8">
            <label class="block mb-2 text-sm font-medium dark:text-white">Gross salary (computed)</label>
            <div class="py-2.5 sm:py-3 px-4 rounded-lg bg-gray-50 dark:bg-neutral-800 text-sm">
              ₵{{ number_format($gross_salary ?? 0, 2) }}
            </div>
          </div>

          <div class="mb-4 sm:mb-8">
            <label class="block mb-2 text-sm font-medium dark:text-white">Net salary (computed)</label>
            <div class="py-2.5 sm:py-3 px-4 rounded-lg bg-gray-50 dark:bg-neutral-800 text-sm">
              ₵{{ number_format($net_salary ?? 0, 2) }}
            </div>
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

