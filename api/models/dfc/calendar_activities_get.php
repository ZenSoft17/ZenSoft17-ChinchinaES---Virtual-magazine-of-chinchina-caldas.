<?php
// calendar
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
$fair = IdentifyFair();


function CalendarActivities()
{
    global $fair, $con;

    $sql = "SELECT * FROM calendar_activities 
            INNER JOIN calendar_activities_days ON calendar_activities_days.cal_id = calendar_activities.cal_id
            WHERE fai_id = '$fair'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $data = [];
            $data[] = ['calendar_title' => $row['cal_title'],];
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = [
                    'calendar_day_title' => $row['cald_title'],
                    'calendar_day_text' => $row['cald_text'],
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