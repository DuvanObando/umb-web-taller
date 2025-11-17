<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

require_once __DIR__ . '/controlador.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $tareas = listarTareas();
        echo json_encode($tareas);
        break;
    case 'POST':
        $datos = json_decode(file_get_contents('php://input'), true) ?: [];
        if (!isset($datos['titulo']) || trim($datos['titulo']) === '') {
            http_response_code(400);
            echo json_encode(['error' => 'El titulo es obligatorio']);
            break;
        }
        crearNuevaTarea($datos['titulo'], isset($datos['completada']) ? (bool) $datos['completada'] : false);
        echo json_encode(['mensaje' => 'Tarea creada']);
        break;
    case 'PUT':
        $datos = json_decode(file_get_contents('php://input'), true) ?: [];
        if (!isset($datos['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID requerido']);
            break;
        }
        $titulo = $datos['titulo'] ?? null;
        $estado = array_key_exists('completada', $datos) ? (bool) $datos['completada'] : null;
        editarTarea((int) $datos['id'], $titulo, $estado);
        echo json_encode(['mensaje' => 'Tarea actualizada']);
        break;
    case 'DELETE':
        $datos = json_decode(file_get_contents('php://input'), true) ?: [];
        if (!isset($datos['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID requerido']);
            break;
        }
        borrarTarea((int) $datos['id']);
        echo json_encode(['mensaje' => 'Tarea eliminada']);
        break;
    default:
        http_response_code(405);
        echo json_encode(['mensaje' => 'Metodo no permitido']);
        break;
}
