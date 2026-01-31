<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

use Illuminate\Contracts\Console\Kernel;

$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    DB::table('sessions')->truncate();
    DB::table('users')->update(['remember_token' => null]);
    echo "Sessions truncated and remember_token cleared.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
