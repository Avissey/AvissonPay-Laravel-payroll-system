<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Overview</h2>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

      <!-- Total Employees -->
      <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg rounded-2xl p-6 hover:scale-[1.02] transition-transform">
        <div class="flex items-center justify-between">
          <h3 class="text-sm uppercase font-medium opacity-90">Total Employees</h3>
          <svg class="w-6 h-6 opacity-80" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-3-3h-1M9 20H4v-2a3 3 0 013-3h1m0-4a4 4 0 118 0M12 12a4 4 0 110-8 4 4 0 010 8z" />
          </svg>
        </div>
        <p class="text-3xl font-semibold mt-4">{{ $totalEmployees }}</p>
        <p class="text-sm mt-1 text-green-100">Total registered employees</p>
      </div>

      <!-- Total Department -->
      <div class="bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg rounded-2xl p-6 hover:scale-[1.02] transition-transform">
        <div class="flex items-center justify-between">
          <h3 class="text-sm uppercase font-medium opacity-90">Total Departments</h3>
          <svg class="w-6 h-6 opacity-80" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V9a2 2 0 00-2-2h-3V5a2 2 0 00-2-2H7a2 2 0 00-2 2v2H2v4a2 2 0 002 2h16a2 2 0 002-2zM7 15v2a2 2 0 002 2h6a2 2 0 002-2v-2" />
          </svg>
        </div>
        <p class="text-3xl font-semibold mt-4">{{ $totalDepartments }}</p>
        <p class="text-sm mt-1 text-green-100">Active departments</p>
      </div>

      <!-- Payroll List -->
      <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg rounded-2xl p-6 hover:scale-[1.02] transition-transform">
        <div class="flex items-center justify-between">
          <h3 class="text-sm uppercase font-medium opacity-90">Payroll List</h3>
          <svg class="w-6 h-6 opacity-80" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l2-2 4 4m0 0l4-4m-4 4V4" />
          </svg>
        </div>
        <p class="text-3xl font-semibold mt-4">{{ $totalPayrolls }}</p>
        <p class="text-sm mt-1 text-purple-100">Total payroll records</p>
      </div>

      <!-- Attendance Rate -->
      <!-- <div class="bg-gradient-to-r from-orange-400 to-orange-500 text-white shadow-lg rounded-2xl p-6 hover:scale-[1.02] transition-transform">
        <div class="flex items-center justify-between">
          <h3 class="text-sm uppercase font-medium opacity-90">Attendance Rate</h3>
          <svg class="w-6 h-6 opacity-80" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 0A9 9 0 1112 3a9 9 0 019 9z" />
          </svg>
        </div>
        <p class="text-3xl font-semibold mt-4">{{ $attendanceRate }}%</p>
        <p class="text-sm mt-1 text-white/80">Average attendance this month</p>
      </div> -->

      <!-- Total Users -->
      <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white shadow-lg rounded-2xl p-6 hover:scale-[1.02] transition-transform">
        <div class="flex items-center justify-between">
          <h3 class="text-sm uppercase font-medium opacity-90">Total Users</h3>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
          </svg>
        </div>
        <p class="text-3xl font-semibold mt-4">{{ $totalUsers }}</p>
        <p class="text-sm mt-1 text-yellow-100">Active Users</p>
      </div>

    </div>
  </div>
</div>