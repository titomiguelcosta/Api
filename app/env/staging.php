<?php

use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../bootstrap.php.cache';

require_once __DIR__.'/../AppKernel.php';

$kernel = new AppKernel('staging', false);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);