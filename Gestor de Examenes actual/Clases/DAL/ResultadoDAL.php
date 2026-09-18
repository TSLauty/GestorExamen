<?php
require_once __DIR__ . "/../Resultado.php";
require_once __DIR__ . '/../../Pagina Web/conexion.php';

class ResultadoDAL {

    private $conexion;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function insertResultado($resultado) {
        $consulta = sprintf(
            "INSERT INTO resultados (fechaResultado, calificacion, cantidadErrores, cantidadAciertos, idExamen) VALUES('%s', '%s', '%s', '%s', '%s')",
            $this->conexion->real_escape_string($resultado->getFechaResultado()),
            $this->conexion->real_escape_string($resultado->getCalificacion()),
            $this->conexion->real_escape_string($resultado->getCantidadErrores()),
            $this->conexion->real_escape_string($resultado->getCantidadAciertos()),
            $this->conexion->real_escape_string($resultado->getIdExamen())
        );

        if (!$this->conexion->query($consulta)) {
            die("Error al insertar resultado: " . $this->conexion->error);
        }

        $idResultado = $this->conexion->insert_id;
        $resultado->setIdResultado($idResultado);
    }

    public function getResultados(): array {
        $consulta = "SELECT * FROM resultados";
        $resultado = $this->conexion->query($consulta);
        $registros = array();

        while ($registro = $resultado->fetch_assoc()) {
            $resultado = new Resultado(
                $registro["idResultado"],
                $registro["fechaResultado"],
                $registro["calificacion"],
                $registro["cantidadErrores"],
                $registro["cantidadAciertos"],
                $registro["idExamen"]
            );

            $registros[] = $resultado;
        }

        return $registros;
    }
}
?>
