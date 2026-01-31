<div>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payroll System Documentation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 text-gray-800">
    
    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-white shadow-lg rounded-xl p-8">
            <h1 class="text-3xl font-bold mb-4">Payroll System Documentation</h1>
            <p class="mb-6 text-gray-600">This document serves as a full guide to understanding and using the Payroll Management System.</p>

            <h2 class="text-2xl font-semibold mt-6 mb-3">1. Introduction</h2>
            <p>The Payroll System is designed to help employers automate and manage employee salary processing. It ensures accuracy and prevents unauthorized changes by restricting editing access to administrators only.</p>

            <h2 class="text-2xl font-semibold mt-6 mb-3">2. System Purpose</h2>
            <p>The purpose of the system is to simplify and secure payroll operations. It manages salary components, deductions, allowances, employee information, and payment methods.</p>

            <h2 class="text-2xl font-semibold mt-6 mb-3">3. Key Features</h2>
            <ul class="list-disc ml-6 space-y-1">
                <li>Manage employee personal and financial details</li>
                <li>Generate monthly payroll</li>
                <li>Support for Mobile Money and bank accounts</li>
                <li>Admin-only editing access</li>
                <li>Employee read-only dashboard</li>
                <li>Automatic salary calculation</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-6 mb-3">4. System Components</h2>
            <h3 class="text-xl font-medium mt-4 mb-2">Migrations</h3>
            <p>Database migrations define the structure of tables such as <strong>employees</strong> and <strong>payrolls</strong>.</p>

            <h3 class="text-xl font-medium mt-4 mb-2">Models</h3>
            <ul class="list-disc ml-6">
                <li><strong>Employee Model:</strong> Stores personal data and links to payrolls.</li>
                <li><strong>Payroll Model:</strong> Manages salary structure, deductions, and totals.</li>
            </ul>

            <h3 class="text-xl font-medium mt-4 mb-2">Livewire Components</h3>
            <p>Used for building dynamic interfaces for creating and editing payrolls.</p>

            <h3 class="text-xl font-medium mt-4 mb-2">Blade Views</h3>
            <p>User-interface templates for admin and employee dashboards.</p>

            <h2 class="text-2xl font-semibold mt-6 mb-3">5. Payroll Workflow</h2>
            <ol class="list-decimal ml-6 space-y-1">
                <li>Admin logs into the system.</li>
                <li>Admin creates or edits employee profiles.</li>
                <li>Admin generates payroll for a selected month.</li>
                <li>System calculates salary details.</li>
                <li>Payroll is stored in the database.</li>
                <li>Employees log in to view their salary information.</li>
            </ol>

            <h2 class="text-2xl font-semibold mt-6 mb-3">6. Security</h2>
            <ul class="list-disc ml-6 space-y-1">
                <li>Admin-exclusive editing rights</li>
                <li>Employees can only view their payroll</li>
                <li>Foreign key constraints maintain data integrity</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-6 mb-3">7. Future Expansions</h2>
            <ul class="list-disc ml-6 space-y-1">
                <li>Export payroll to PDF</li>
                <li>API integration for HR systems</li>
                <li>Analytics dashboard</li>
                <li>Email notifications</li>
            </ul>

            <p class="mt-10 text-center text-gray-500 text-sm">© 2025 Payroll System Documentation</p>
        </div>
    </div>
</body>
</html>

</div>
