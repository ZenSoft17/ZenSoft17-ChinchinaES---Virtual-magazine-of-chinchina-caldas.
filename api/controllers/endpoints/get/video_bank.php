<?php
// Importar configuraciones de encabezados (CORS, métodos permitidos, etc.)
require "../../headers/index.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leer el contenido del cuerpo de la solicitud
    $dataEncode = file_get_contents('php://input');

    // Decodificar el JSON recibido en un array asociativo
    $request = json_decode($dataEncode, true);

    // Verificar si hubo un error en la decodificación del JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json');
        echo json_encode(['error' => 'JsonInvalid']);
        exit;
    }

    // Inicializar la variable de respuesta
    $response = null;

    // Verificar si se recibió el campo 'method' en la solicitud
    if (isset($request['method']) && $request['method'] === 'get') {
        // Verificar si se recibió el campo 'key' en la solicitud
        if (isset($request['key'])) {
            switch ($request['key']) {
                case 'video_bank':
                    include("../../../models/video-bank/video_bank_get.php");
                    $response = VideoBank();
                    break;
                default:
                    header('HTTP/1.1 400 Bad Request');
                    echo json_encode(['error' => 'DataTypeError']);
                    exit;
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'MissingKey']);
            exit;
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'DataTypeError']);
        exit;
    }

    // Enviar la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Método de solicitud no permitido
    header('HTTP/1.1 405 Method Not Allowed');
    header('Content-Type: application/json');
    echo json_encode(['error' => 'MethodError']);
    exit;
}
