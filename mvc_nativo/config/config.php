<?php
// Configuración de la Base de Datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'taskorganizer_db');

// Autodetectar la URL Base
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
// Encontrar el directorio base
$dir = dirname($scriptName);
$dir = str_replace('\\', '/', $dir);

// Limpiar si el script name es index.php
if (basename($scriptName) === 'index.php') {
    // Si estamos en un subdirectorio public/, subir un nivel o mantener según corresponda.
    // La estructura tiene index.php en la raíz de mvc_nativo.
}
if ($dir === '/' || $dir === '\\') {
    $dir = '';
} else {
    $dir = rtrim($dir, '/');
}

define('BASE_URL', $protocol . $domainName . $dir);
define('APP_NAME', 'TaskOrganizer');
