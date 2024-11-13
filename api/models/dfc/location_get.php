<?php
// location
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
$fair = IdentifyFair();


function Location()
{
    global $fair, $con;

    $sql = "SELECT * FROM location WHERE fai_id = '$fair'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $image = base64_encode($row['loc_image']);
            $data = [
                'location_title' => $row['loc_title'],
                'location_text' => $row['loc_text'],
                'location_image' => $image
            ];
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
