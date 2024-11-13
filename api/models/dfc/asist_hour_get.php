<?php
// asist hour
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
$fair = IdentifyFair();


function AsistHours()
{
    global $fair, $con;

    $sql = "SELECT * FROM schedules WHERE fai_id = '$fair'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $data = [];
            while ($row =  mysqli_fetch_assoc($query)) {
                $data[] = [
                    'schedules_init' => $row['sch_date_init'],
                    'schedules_end' => $row['sch_date_end'],
                    'schedules_text' => $row['sch_text']
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
