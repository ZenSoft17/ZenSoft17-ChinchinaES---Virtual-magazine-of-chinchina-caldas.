<?php
// cartifications
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
$fair = IdentifyFair();


function Certs()
{
    global $fair, $con;

    $sql = "SELECT * FROM certifications WHERE fai_id = '$fair'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = [
                    'cert_title' => $row['cer_title'],
                    'cert_text' => $row['cer_text'],
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
