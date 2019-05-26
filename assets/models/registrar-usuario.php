<?php

$usuario = $_POST['usuario'];

// Importar la conexión
require_once '../functions/db_conn.php';

try {
    $stmt = $conn->prepare("INSERT INTO `users` (`email`) VALUES (?)");
    $stmt->bind_param('s', $usuario);
    $stmt->execute();    
    $respuesta = array(
        'mensaje' => $stmt->affected_rows
    );
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    $respuesta = array(
        'error' => $e->getMessage()
    );
}

echo json_encode($respuesta);