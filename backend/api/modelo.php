<?php
require_once __DIR__ . '/db.php';

function crearTarea(string $titulo, bool $completada = false): void
{
    global $conexion;
    $tituloSeguro = htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8');
    $estado = $completada ? 1 : 0;
    $sql = "INSERT INTO tareas (titulo, completada) VALUES ('$tituloSeguro', $estado)";
    mysqli_query($conexion, $sql);
}

function obtenerTareas(): array
{
    global $conexion;
    $sql = 'SELECT * FROM tareas ORDER BY id DESC';
    $resultado = mysqli_query($conexion, $sql);
    $tareas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $tareas[] = $fila;
    }
    return $tareas;
}

function obtenerTareaPorId(int $id): ?array
{
    global $conexion;
    $id = (int) $id;
    $sql = "SELECT * FROM tareas WHERE id = $id LIMIT 1";
    $resultado = mysqli_query($conexion, $sql);
    return mysqli_fetch_assoc($resultado) ?: null;
}

function actualizarTarea(int $id, ?string $titulo = null, ?bool $completada = null): void
{
    global $conexion;
    $campos = [];
    if ($titulo !== null) {
        $tituloSeguro = htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8');
        $campos[] = "titulo = '$tituloSeguro'";
    }
    if ($completada !== null) {
        $estado = $completada ? 1 : 0;
        $campos[] = "completada = $estado";
    }
    if (empty($campos)) {
        return;
    }
    $id = (int) $id;
    $sql = "UPDATE tareas SET " . implode(', ', $campos) . " WHERE id = $id";
    mysqli_query($conexion, $sql);
}

function eliminarTarea(int $id): void
{
    global $conexion;
    $id = (int) $id;
    $sql = "DELETE FROM tareas WHERE id = $id";
    mysqli_query($conexion, $sql);
}
