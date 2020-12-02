<?php


// dont add a trailing / at the end
define('HTTP_SERVER', 'http://localhost');
// add slash / at the end
define('SITE_DIR', '/baulphp/simple-website/');

// database prefix if you use
define('DB_PREFIX', 'mp_');

define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_HOST_USERNAME', 'root');
define('DB_HOST_PASSWORD', 'eresmiaangel9');
define('DB_DATABASE', 'php_web');

define('SITE_NAME', 'ResCatAnDog');

// define database tables
define('TABLE_PAGES', DB_PREFIX.'pages');
define('TABLE_TAGLINE', DB_PREFIX.'tagline');
define('TABLE_ADOPTANTE', 'adoptante');
define('TABLE_CUIDADOR', 'cuidador');
define('TABLE_DIRECCION', 'direccion');
define('TABLE_MASCOTA', 'mascota');
define('TABLE_SOLICITUD', 'solicitud');
define('TABLE_USUARIO', 'usuario');
?>