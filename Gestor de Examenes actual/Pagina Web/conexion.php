<?php
$usuario = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'root';
$contrasena = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? '';
$servidor = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'localhost';
$basededatos = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'gestor_examenes';
$charset = 'utf8mb4';

$conexion = new mysqli($servidor, $usuario, $contrasena, $basededatos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");

?>
