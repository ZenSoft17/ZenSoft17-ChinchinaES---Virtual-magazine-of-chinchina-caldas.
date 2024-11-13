<?php
// event information
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
$fair = IdentifyFair();

function EventInformation()
{
    global $con, $fair;

    $sql = "SELECT * FROM event_dfc WHERE fai_id = '$fair'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $eventDate = $row['eve_date'];
            $liveUrl = $row['eve_live'];
            $eventTitle = $row['eve_title'];

            $eventTimestamp = strtotime($eventDate);
            $currentTimestamp = time();

            if ($eventTimestamp < $currentTimestamp) {
                $data = [
                    'event_title' => $eventTitle,
                    'event_element' => $liveUrl,
                    'event_type' => 'live'
                ];
            } else {
                $data = [
                    'event_title' => $eventTitle,
                    'event_element' => $eventDate,
                    'event_type' => 'date'
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
}
