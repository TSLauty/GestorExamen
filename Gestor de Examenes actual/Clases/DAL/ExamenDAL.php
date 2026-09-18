<?php
require_once __DIR__ . "/../Examen.php";
require_once __DIR__ . '/../../Pagina Web/conexion.php';

class ExamenDAL {

    private $conexion;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function insertExamen(Examen $examen): void {
        $consulta = sprintf(
            "INSERT INTO examenes (tema, fechaExamen, enlaceAcceso, idProfesor) VALUES('%s', '%s', '%s', '%s')",
            $this->conexion->real_escape_string($examen->getTema()),
            $this->conexion->real_escape_string($examen->getFechaExamen()->format('Y-m-d H:i:s')),
            $this->conexion->real_escape_string($examen->getEnlaceAcceso()),
            $this->conexion->real_escape_string($examen->getIdProfesor())
        );

        if (!$this->conexion->query($consulta)) {
            die("Error al insertar examen: " . $this->conexion->error);
        }

        $examen->setIdExamen($this->conexion->insert_id);
    }

    public function getExamenes(): array {
        $resultado = $this->conexion->query("SELECT * FROM examenes");
        $registros = [];

        while ($registro = $resultado->fetch_assoc()) {
            $examen = new Examen(
                $registro["idExamen"],
                $registro["tema"],
                new DateTime($registro["fechaExamen"]),
                $registro["enlaceAcceso"],
                $registro["idProfesor"]
            );

            $registros[] = $examen;
        }

        return $registros;
    }
}
?>
