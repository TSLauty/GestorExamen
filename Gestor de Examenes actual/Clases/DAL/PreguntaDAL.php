<?php
require_once __DIR__ . "/../Pregunta.php";
require_once __DIR__ . '/../../Pagina Web/conexion.php';

class PreguntaDAL {

    private $conexion;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function insertPregunta(Pregunta $pregunta): void {
        $respuestas = is_array($pregunta->getRespuestas())
            ? json_encode($pregunta->getRespuestas())
            : $pregunta->getRespuestas();

        $consulta = sprintf(
            "INSERT INTO preguntas (tema, subtema, dificultad, textoPregunta, respuestas, respuestaCorrecta, apariciones) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
            $this->conexion->real_escape_string($pregunta->getTema()),
            $this->conexion->real_escape_string($pregunta->getSubtema()),
            $this->conexion->real_escape_string($pregunta->getDificultad()),
            $this->conexion->real_escape_string($pregunta->getTextoPregunta()),
            $this->conexion->real_escape_string($respuestas),
            $this->conexion->real_escape_string($pregunta->getRespuestaCorrecta()),
            $this->conexion->real_escape_string($pregunta->getApariciones())
        );

        if (!$this->conexion->query($consulta)) {
            die("Error al insertar pregunta: " . $this->conexion->error);
        }

        $pregunta->setIdPregunta($this->conexion->insert_id);
    }

    public function getPreguntas(): array {
        $resultado = $this->conexion->query("SELECT * FROM preguntas");
        $registros = [];

        while ($registro = $resultado->fetch_assoc()) {
            $pregunta = new Pregunta(
                $registro["idPregunta"],
                $registro["materia"] ?? '',
                $registro["tema"],
                $registro["subtema"],
                $registro["dificultad"],
                $registro["textoPregunta"],
                $registro["respuestas"],
                $registro["respuestaCorrecta"],
                $registro["apariciones"]
            );

            $registros[] = $pregunta;
        }

        return $registros;
    }

    public function obtenerPorTemaSubtemaDificultad(string $tema, string $subtema, string $dificultad, int $cantidad): array {
        $consulta = "SELECT * FROM preguntas WHERE tema = ? AND subtema = ? AND dificultad = ? ORDER BY apariciones ASC, RAND() LIMIT ?";
        $stmt = $this->conexion->prepare($consulta);

        if ($stmt === false) {
            return [];
        }

        $stmt->bind_param('sssi', $tema, $subtema, $dificultad, $cantidad);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $registros = [];
        while ($registro = $resultado->fetch_assoc()) {
            $pregunta = new Pregunta(
                $registro["idPregunta"],
                $registro["materia"] ?? '',
                $registro["tema"],
                $registro["subtema"],
                $registro["dificultad"],
                $registro["textoPregunta"],
                $registro["respuestas"],
                $registro["respuestaCorrecta"],
                $registro["apariciones"]
            );

            $registros[] = $pregunta;
        }

        $stmt->close();
        return $registros;
    }
}
?>
