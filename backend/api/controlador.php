<?php
require_once __DIR__ . '/modelo.php';

function listarTareas(): array
{
    return obtenerTareas();
}

function crearNuevaTarea(string $titulo, bool $completada = false): void
{
    crearTarea($titulo, $completada);
}

function editarTarea(int $id, ?string $titulo = null, ?bool $completada = null): void
{
    actualizarTarea($id, $titulo, $completada);
}

function borrarTarea(int $id): void
{
    eliminarTarea($id);
}
