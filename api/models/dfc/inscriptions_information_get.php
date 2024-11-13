<?php
// inscriptions information
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/date_formated.php';
$fair = IdentifyFair();

function InscriptionsInformation()
{
    global $con, $fair;

    $sql = "SELECT * FROM registrations_dfc WHERE fai_id = '$fair'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $date_init = DayAndMonth($row['reg_start_date']);
            $date_end = DayAndMonth($row['reg_end_date']);
            $data = [
                'incriptions_title' => $row['reg_title'],
                'incriptions_description' => $row['reg_description'],
                'incriptions_general_info' => $row['reg_general_info'],
                'incriptions_start_date_day' => $date_init['dia'],
                'incriptions_start_date_month' => $date_init['mes'],
                'incriptions_end_date_day' => $date_end['dia'],
                'incriptions_end_date_month' => $date_end['mes'],
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
