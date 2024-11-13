<?php
function HourFormated($fecha)
{

    $date = DateTime::createFromFormat('Y-m-d', $fecha);

    if ($date === false) {
        return null; 
    }

    $meses = [
        1 => 'enero',
        'febrero',
        'marzo',
        'abril',
        'mayo',
        'junio',
        'julio',
        'agosto',
        'septiembre',
        'octubre',
        'noviembre',
        'diciembre'
    ];

    $dia = $date->format('d');
    $mes = $meses[(int)$date->format('m')];
    $anio = $date->format('Y');

    return "$dia de $mes, $anio";
}
