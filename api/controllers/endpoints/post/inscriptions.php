<?php
// Importar configuraciones de encabezados (CORS, métodos permitidos, etc.)
require "../../headers/index.php";
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/imagen_filter.php';
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/file_filter.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió el campo 'method' en la solicitud
    if (isset($_POST['method']) && $_POST['method'] === 'post') {
        if (isset($_POST['type']) && $_POST['type'] === 'inscriptions-insert') {
            include("../../../models/dfc/inscriptions_post.php");
            
            // Recoger los datos de formulario
            $data = [
                'email' => $_POST['email'],
                'author' => $_POST['project_leader'],
                'teacher' => $_POST['project_mentors'],
                'exhibitors_info' => $_POST['exhibitors_info'],
                'project_name' => $_POST['project_name'],
                'project_modality' => $_POST['project_modality'],
                'project_description' => $_POST['project_description'],
                'project_phase' => $_POST['project_phase'],
                'project_design' => $_POST['project_design'],
                'project_development' => $_POST['project_development'],
                'project_implementation' => $_POST['project_implementation'],
                'institution_name' => $_POST['institution_name'],
                'foundation_date' => $_POST['foundation_date'],
                'technical_requirements' => $_POST['technical_requirements'],
                'comments' => $_POST['comments']
            ];

            // Manejar archivos
            $data['project_image'] = processImage($_FILES['project_image']);
            $data['project_evidences'] = proccessFile($_FILES['project_evidences']);
            $data['institution_logo'] = processImage($_FILES['institution_logo']);

           if(!empty($_POST['email']) && !empty($_POST['project_leader']) && !empty($_POST['project_mentors']) && !empty($_POST['exhibitors_info']) && !empty($_POST['project_name']) && !empty($_POST['project_description']) && !empty($_POST['project_phase']) && !empty($_POST['project_design']) && !empty($_POST['project_development']) && !empty($_POST['project_implementation']) && !empty($_POST['institution_name']) && !empty($_POST['foundation_date']) && !empty($_POST['technical_requirements']) && !empty($_POST['comments'])){
            if(processImage($_FILES['project_image']) &&  processImage($_FILES['institution_logo']) && proccessFile($_FILES['project_evidences'])){
                // Llamar a la función de inserción
                $response = Inscriptions($data);
    
                // Enviar la respuesta
                header('Content-Type: application/json');
                echo json_encode($response);
                } else {
                    echo json_encode(['error' => 'IncorrectValue']);
                }
           } else {
            echo json_encode(['error' => 'DontExistData']);
           }
        } else {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'InvalidType']);
            exit;
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'InvalidMethod']);
        exit;
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Content-Type: application/json');
    echo json_encode(['error' => 'MethodError']);
}
