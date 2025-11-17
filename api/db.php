<?php
// Archivo: api/db.php
// Configura la conexión usando variables de entorno. En Codespaces crea un archivo .env con estos valores
// PLAN: DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT
$host = getenv('DB_HOST') ?: 'turntable.proxy.rlwy.net';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: 'CAMBIA_ESTA_CLAVE';
$database = getenv('DB_NAME') ?: 'railway';
$port = (int) (getenv('DB_PORT') ?: 17927);

$conexion = mysqli_connect($host, $user, $password, $database, $port);

if (mysqli_connect_errno()) {
    echo 'Error al conectar a MySQL: ' . mysqli_connect_error();
    exit();
}

// Nota: las funciones mysql_* están obsoletas; usa mysqli_* o PDO.
