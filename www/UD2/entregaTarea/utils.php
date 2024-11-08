<?php
global $tareas;
$tareas = [
    ['id' => '1', 'descripcion' => 'Imprimir Apuntes', 'estado' => 'Pendiente'],
    ['id' => '2', 'descripcion' => 'Redaccion Ingles', 'estado' => 'En progreso'],
    ['id' => '3', 'descripcion' => 'Limpiar coche', 'estado' => 'Completada']
];

function guardarTarea($descripcion, $estado) {
    global $tareas;

    $descripcion = filtrarTexto($descripcion);
    $estado = filtrarTexto($estado);
    $idNuevaTarea = count($tareas) + 1;

    if (!esTextoValido($descripcion) || !in_array($estado, ['Pendiente', 'En progreso', 'Completada'])) {
        return false;
    }

    $tareas[] = [
        'id' => (string)$idNuevaTarea,
        'descripcion' => $descripcion,
        'estado' => $estado
    ];
    return true;
}

function obtenerTareas() {
    global $tareas;
    return $tareas;
}

function filtrarTexto($texto) {
    $texto = trim(preg_replace('/\s+/', ' ', $texto));
    $texto = preg_replace('/[@_\-,.]/', '', $texto);
    $texto = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    return $texto;
}

function esTextoValido($texto) {
    if (empty($texto) || strlen($texto) < 3) {
        return false;
    }
    return true;
}
?>