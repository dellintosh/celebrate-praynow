<?php

use Symfony\Component\HttpFoundation\Request;

$loader = require __DIR__.'/../app/autoload.php';

$environment = getenv('SYMFONY_ENV');
$debug = (bool)getenv('SYMFONY_DEBUG');

if ($debug == true) {
    Symfony\Component\Debug\Debug::enable();
}

$app = new AppKernel($environment, $debug);

$app->loadClassCache();

$request = Request::createFromGlobals();
$response = $app->handle($request);
$response->send();

$app->terminate($request, $response);
