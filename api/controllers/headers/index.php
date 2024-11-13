<?php

// Lista de dominios permitidos
$allowed_origins = [
    "http://localhost:5173",
    "https://chinchinaes.com.co"
];

// Obtener el origen de la solicitud
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

// Verificar si el origen está en la lista de permitidos
if (in_array($origin, $allowed_origins)) {
    header("Access-Control-Allow-Origin: $origin");
} else {
    // Si el origen no está permitido, no establecer el encabezado
    header("HTTP/1.1 403 Forbidden");
    exit;
}

// Permitir los métodos HTTP necesarios
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Permitir los encabezados necesarios
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Manejo de solicitudes preflight (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    if (in_array($origin, $allowed_origins)) {
        header("Access-Control-Allow-Origin: $origin");
    }
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header('Access-Control-Max-Age: 86400');
    exit(0);
}
