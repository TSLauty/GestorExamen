<?php
require_once __DIR__ . "/../ExamenYPregunta.php";
require_once __DIR__ . '/../../Pagina Web/conexion.php';

class ExamenYPreguntaDAL {

    private $conexion;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function insertarRelacion($examenYPregunta) {
        $consulta = sprintf(
            "INSERT INTO examenesYPreguntas (idPregunta, idExamen) VALUES('%s', '%s')",
            $this->conexion->real_escape_string($examenYPregunta->getIdPregunta()),
            $this->conexion->real_escape_string($examenYPregunta->getIdExamen())
        );

        if (!$this->conexion->query($consulta)) {
            die("Error al insertar relación: " . $this->conexion->error);
        }

        $examenYPregunta->setIdExamenYPreguntas($this->conexion->insert_id);
    }

    public function getRelaciones(): array {
        $resultado = $this->conexion->query("SELECT * FROM examenesYPreguntas");
        $registros = [];

        while ($registro = $resultado->fetch_assoc()) {
            $rel = new ExamenYPregunta(
                $registro["idExamenYPreguntas"],
                $registro["idPregunta"],
                $registro["idExamen"]
            );
            $registros[] = $rel;
        }

        return $registros;
    }

    public function getPreguntasDeExamen($idExamen): array {
        $idExamen = (int) $idExamen;
        $resultado = $this->conexion->query(
            "SELECT p.* FROM preguntas p
             INNER JOIN examenesYPreguntas ep ON p.idPregunta = ep.idPregunta
             WHERE ep.idExamen = $idExamen"
        );

        $preguntas = [];
        while ($registro = $resultado->fetch_assoc()) {
            $preguntas[] = $registro;
        }
        return $preguntas;
    }
}
?>
