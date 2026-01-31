<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {
            // Insert columns next to similarly named fields for clarity
            $table->string('account_name')->nullable()->after('account_number');
            $table->string('momo_name')->nullable()->after('momo_number');
        });
    }

    public function down(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->dropColumn(['account_name', 'momo_name']);
        });
    }
};
