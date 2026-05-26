<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'taskorganizer_db');

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';

$dir = dirname($scriptName);
$dir = str_replace('\\', '/', $dir);

if (basename($scriptName) === 'index.php') {
}
if ($dir === '/' || $dir === '\\') {
    $dir = '';
} else {
    $dir = rtrim($dir, '/');
}

define('BASE_URL', $protocol . $domainName . $dir);
define('APP_NAME', 'TaskOrganizer');
