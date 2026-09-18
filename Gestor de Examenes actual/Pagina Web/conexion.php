<?php
$host = getenv('MYSQLHOST') ?: 'mysql.railway.internal';
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQLPASSWORD');      // ← nombre de variable, no la contraseña
$db   = 'railway';
$port = getenv('MYSQLPORT') ?: 3306;

if ($pass === false || $pass === '') {
    die("Error: MYSQLPASSWORD no está definida en Railway.");
}

$conexion = new mysqli($host, $user, $pass, $db, $port);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset('utf8mb4');
?>
