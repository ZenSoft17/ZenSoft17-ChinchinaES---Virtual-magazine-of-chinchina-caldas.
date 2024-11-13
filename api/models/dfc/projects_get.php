<?php
// projects

require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
$fair = IdentifyFair();

function Projects()
{
    global $fair, $con;

    $view = 1;
    $sql = "SELECT * FROM projects
            INNER JOIN modalities ON projects.mod_id = modalities.mod_id
            INNER JOIN status ON projects.sta_id = status.sta_id
            WHERE projects.fai_id = '$fair' AND vie_id = '$view'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            while ($row =  mysqli_fetch_assoc($query)) {
                $image = base64_encode($row['pro_image']);
                $data[] = [
                    'project_modality' => $row['mod_modality'],
                    'project_status' => $row['sta_status'],
                    'project_title' => $row['pro_title'],
                    'project_author' => $row['pro_author'],
                    'project_image' => $image
                ];
            }
            $con->close();
            $query->close();
            return $data;
        } else {
            $con->close();
            $query->close();
            return ['error' => 'DontExistData'];
        }
    } else {
        $con->close();
        return ['error' => 'ApplicationError'];
    }
};