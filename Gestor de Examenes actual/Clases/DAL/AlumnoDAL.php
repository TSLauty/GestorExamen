<?php
require_once __DIR__ . "/../Alumno.php";
require_once __DIR__ . '/../../Pagina Web/conexion.php';

class AlumnoDAL {

    private $conexion;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function insertAlumno($alumno) {
        $consulta = sprintf(
            "INSERT INTO alumnos (idUsuario) VALUES('%s')",
            $this->conexion->real_escape_string($alumno->getIdUsuario())
        );

        if (!$this->conexion->query($consulta)) {
            die("Error al insertar alumno: " . $this->conexion->error);
        }

        $idAlumno = $this->conexion->insert_id;
        $alumno->setIdAlumno($idAlumno);
    }

    public function getAlumnos(): array {
        $consulta = "SELECT * FROM alumnos";
        $resultado = $this->conexion->query($consulta);
        $registros = array();

        while ($registro = $resultado->fetch_assoc()) {
            $alumno = new Alumno($registro["idAlumno"], $registro["idUsuario"]);
            $registros[] = $alumno;
        }

        return $registros;
    }
}
?>
