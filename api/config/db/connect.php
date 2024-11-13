<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Script for database connection
date_default_timezone_set('America/Bogota');

function Connect_DB()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "chinchinaesdb";
    $port = 3306;

    // $host = "localhost";
    // $user = "u972828740_clientdb";
    // $pass = "G7hP4kL9tQ@chinchina";
    // $db = "u972828740_chinchinaesdb";
    // $port = 3306;

    // Crear conexión
    $con = mysqli_connect(
        $host, 
        $user, 
        $pass, 
        $db, 
        $port
    );

    // Verificar conexión
    if (!$con) {
        die("ErrorDB - Error de conexión: " . mysqli_connect_error());
    }

    return $con;
}