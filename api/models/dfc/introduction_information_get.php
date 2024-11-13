<?php
// introduction information
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
$fair = IdentifyFair();

function IntroductionInformation()
{
    global $con, $fair;

    $sql = "SELECT * FROM info_dfc WHERE fai_id = '$fair'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $data = [
                'introduction_title' => $row['inf_title'],
                'introduction_description' => $row['inf_description'],
                'introduction_general_objective' => $row['inf_general_objective'],
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
}
