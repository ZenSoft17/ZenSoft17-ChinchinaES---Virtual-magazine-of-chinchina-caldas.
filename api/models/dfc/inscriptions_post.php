<?php

require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
$con = Connect_DB();

function Inscriptions($data)
{
    global $con;

    $prj_id = str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $prj_email = $data['email'];
    $prj_project_leader = $data['author'];
    $prj_project_mentors = $data['teacher'];
    $prj_exhibitors_info = $data['exhibitors_info'];
    $prj_project_name = $data['project_name'];
    $prj_project_modality = isset($data['project_modality']) ? $data['project_modality'] : "robotica";
    $prj_project_description = $data['project_description'];
    $prj_project_phase = $data['project_phase'];
    $prj_project_design = $data['project_design'];
    $prj_project_development = $data['project_development'];
    $prj_project_image = $data['project_image'];
    $prj_project_implementation = $data['project_implementation'];
    $prj_project_evidences = $data['project_evidences'];
    $prj_institution_name = $data['institution_name'];
    $prj_foundation_date = $data['foundation_date'];
    $prj_institution_logo = $data['institution_logo'];
    $prj_technical_requirements = $data['technical_requirements'];
    $prj_comments = $data['comments'];

    // Prepare the insertion query
    $stmt = $con->prepare("INSERT INTO project_registrations (
        prj_id, prj_email, prj_project_leader, prj_project_mentors,
        prj_exhibitors_info, prj_project_name, prj_project_modality,
        prj_project_description, prj_project_phase, prj_project_design,
        prj_project_development, prj_project_image, prj_project_implementation,
        prj_project_evidences, prj_institution_name, prj_foundation_date,
        prj_institution_logo, prj_technical_requirements, prj_comments
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param(
        'sssssssssssssssssss', 
        $prj_id,
        $prj_email,
        $prj_project_leader,
        $prj_project_mentors,
        $prj_exhibitors_info,
        $prj_project_name,
        $prj_project_modality,
        $prj_project_description,
        $prj_project_phase,
        $prj_project_design,
        $prj_project_development,
        $prj_project_image,
        $prj_project_implementation,
        $prj_project_evidences,
        $prj_institution_name,
        $prj_foundation_date,
        $prj_institution_logo,
        $prj_technical_requirements,
        $prj_comments
    );

    // Execute the query
    if ($stmt->execute()) {
        $stmt->close();
        $con->close();
        return ["success" => true];
    } else {
        $stmt->close();
        $con->close();
        return ["error" => "ApplicationError"];
    }
}
