<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            
            // Link to employee table
            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->onDelete('cascade'); //If employee is deleted, payroll is deleted too 

            $table->string('bank_name')->nullable();
            //$table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            //$table->string('momo_name')->nullable();
            $table->string('momo_number')->nullable();
            $table->decimal('basic_salary', 10, 2)->default(0);
            $table->decimal('allowance', 10, 2)->default(0);
            $table->decimal('deduction', 10, 2)->default(0);
            
            $table->decimal('net_salary', 10, 2)->default(0);
            $table->date('pay_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};