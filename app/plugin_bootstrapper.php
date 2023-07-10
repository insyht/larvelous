<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists(__DIR__ . '/../storage/framework/maintenance.php')) {
    require_once __DIR__ . '/../storage/framework/maintenance.php';
}
require_once __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$response = tap($kernel->handle(
    $request = Request::capture()
));
$kernel->terminate($request, $response);
