<?php
require_once __DIR__ . "/../Usuario.php";
require_once __DIR__ . '/../../Pagina Web/conexion.php';

class UsuarioDAL {

    private $conexion;

    public function __construct() {
        global $conexion;   // trae la conexión definida en conexion.php
        $this->conexion = $conexion;
    }

    public function insertUsuario($usuario) {
        $consulta = sprintf(
            "INSERT INTO usuarios (nombre, apellido, email, contrasena) VALUES('%s', '%s', '%s', '%s')",
            $this->conexion->real_escape_string($usuario->getNombre()),
            $this->conexion->real_escape_string($usuario->getApellido()),
            $this->conexion->real_escape_string($usuario->getEmail()),
            $this->conexion->real_escape_string($usuario->getContrasena())
        );

        if (!$this->conexion->query($consulta)) {
            die("Error al insertar: " . $this->conexion->error);
        }

        $idUsuario = $this->conexion->insert_id;
        $usuario->setIdUsuario($idUsuario);
    }

    public function getUsuarios(): array {
        $consulta = "SELECT * FROM usuarios";
        $resultado = $this->conexion->query($consulta);
        $registros = array();

        while ($registro = $resultado->fetch_assoc()) {
            $usuario = new Usuario(
                $registro["idUsuario"],
                $registro["nombre"],
                $registro["apellido"],
                $registro["email"],
                $registro["contrasena"]
            );
            $registros[] = $usuario;
        }

        return $registros;
    }
}
?>
