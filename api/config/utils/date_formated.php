<?php
function DayAndMonth($fecha)
{
    // Convierte la fecha en un timestamp
    $timestamp = strtotime($fecha);

    // Obtiene el día como número
    $dia = date('d', $timestamp);

    // Obtiene el mes como número
    $mesNumero = date('m', $timestamp);

    // Arreglo con los nombres de los meses en español
    $meses = [
        '01' => 'enero',
        '02' => 'febrero',
        '03' => 'marzo',
        '04' => 'abril',
        '05' => 'mayo',
        '06' => 'junio',
        '07' => 'julio',
        '08' => 'agosto',
        '09' => 'septiembre',
        '10' => 'octubre',
        '11' => 'noviembre',
        '12' => 'diciembre'
    ];

    // Obtiene el nombre del mes correspondiente
    $mesNombre = $meses[$mesNumero];

    return ['dia' => $dia, 'mes' => $mesNombre];
}
