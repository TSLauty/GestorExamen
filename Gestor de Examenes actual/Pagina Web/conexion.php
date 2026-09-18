<?php
$host = getenv('mysql.railway.internal');
$user = getenv('root');
$pass = getenv('VVgMlWdUZAtstBHsaVtVODCXLExXlQUq');
$db   = 'railway';
$port = getenv('MYSQLPORT') ?: 48307;

$conexion = new mysqli($host, $user, $pass, $db, $port);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset('utf8mb4');
?>
