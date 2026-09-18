<?php
require_once __DIR__ . "/../Profesor.php";
require_once __DIR__ . '/../../Pagina Web/conexion.php';

class ProfesorDAL {

    private $conexion;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function insertProfesor($profesor) {
        $consulta = sprintf(
            "INSERT INTO profesores (idUsuario) VALUES('%s')",
            $this->conexion->real_escape_string($profesor->getIdUsuario())
        );

        if (!$this->conexion->query($consulta)) {
            die("Error al insertar profesor: " . $this->conexion->error);
        }

        $idProfesor = $this->conexion->insert_id;
        $profesor->setIdProfesor($idProfesor);
    }

    public function getProfesores(): array {
        $consulta = "SELECT * FROM profesores";
        $resultado = $this->conexion->query($consulta);
        $registros = array();

        while ($registro = $resultado->fetch_assoc()) {
            $profesor = new Profesor($registro["idProfesor"], $registro["idUsuario"]);
            $registros[] = $profesor;
        }

        return $registros;
    }
}
?>
