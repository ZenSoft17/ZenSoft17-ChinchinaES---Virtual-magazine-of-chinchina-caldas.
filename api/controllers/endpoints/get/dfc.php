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
    if (isset($request['method'])) {
        // Manejar la lógica basada en el método 'get'
        if ($request['method'] === 'get') {
            if (isset($request['key'])) {
                // Seleccionar la acción según el valor de 'key'
                switch ($request['key']) {
                    case 'fair':
                        include("../../../models/dfc/fair_get.php");
                        $response = Fair();
                        break;
                    case 'introduction_information':
                        include("../../../models/dfc/introduction_information_get.php");
                        $response = IntroductionInformation();
                        break;
                    case 'event_information':
                        include("../../../models/dfc/event_information_get.php");
                        $response = EventInformation();
                        break;
                    case 'projects_information':
                        include("../../../models/dfc/projects_information.php");
                        $response = ProjectsInformation();
                        break;
                    case 'inscriptions_information':
                        include("../../../models/dfc/inscriptions_information_get.php");
                        $response = InscriptionsInformation();
                        break;
                    case 'stripe_information':
                        include("../../../models/dfc/stripe_information_get.php");
                        $response = StripeInformation();
                        break;
                    case 'cast_hours':
                        include("../../../models/dfc/cast_hours_get.php");
                        $response = CastHours();
                        break;
                    case 'invited':
                        include("../../../models/dfc/invited_get.php");
                        $response = Invited();
                        break;
                    case 'themes':
                        include("../../../models/dfc/themes_get.php");
                        $response = themes();
                        break;
                    case 'view':
                        include("../../../models/dfc/view_get.php");
                        $response = View();
                        break;
                    case 'modalities':
                        include("../../../models/dfc/modalities_get.php");
                        $response = Modalities();
                        break;
                    case 'location':
                        include("../../../models/dfc/location_get.php");
                        $response = Location();
                        break;
                    case 'asist_hours':
                        include("../../../models/dfc/asist_hour_get.php");
                        $response = AsistHours();
                        break;
                    case 'calendar_activities':
                        include("../../../models/dfc/calendar_activities_get.php");
                        $response = CalendarActivities();
                        break;
                    case 'certs':
                        include("../../../models/dfc/certs_get.php");
                        $response = Certs();
                        break;
                    case 'projects':
                        include("../../../models/dfc/projects_get.php");
                        $response = Projects();
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
        }
        // Método no soportado
        else {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'InvalidMethod']);
            exit;
        }
    }
    // Método 'method' no especificado
    else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'MissingMethod']);
        exit;
    }


    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Content-Type: application/json');
    echo json_encode(['error' => 'MethodError']);
}
