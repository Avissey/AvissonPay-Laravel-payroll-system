<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->string('increment_type')->default('flat')->after('salary_increment'); // 'flat' or 'percentage'
            $table->decimal('gross_salary', 10, 2)->default(0)->after('salary_increment');

            // Deduction rates and fixed deductions
            $table->decimal('ssnit_rate', 5, 2)->default(0)->after('gross_salary'); // percentage
            $table->decimal('paye_rate', 5, 2)->default(0)->after('ssnit_rate'); // percentage
            $table->decimal('loan', 10, 2)->default(0)->after('paye_rate');
            $table->decimal('welfare', 10, 2)->default(0)->after('loan');
        });
    }

    public function down(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->dropColumn(['increment_type','gross_salary','ssnit_rate','paye_rate','loan','welfare']);
        });
    }
};
