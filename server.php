<?php

define('APPLICATION_ENV', 'development');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = urldecode($uri);

$requested = __DIR__ . '/public' . $uri;

if ($uri !== '/' and file_exists($requested)) {
    return false;
}

require_once __DIR__ . '/public/index.php';
