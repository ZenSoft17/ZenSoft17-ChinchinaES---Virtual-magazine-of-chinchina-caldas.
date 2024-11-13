<?php
// views
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
$fair = IdentifyFair();

function View()
{
    global $con, $fair;

    $tables = [
        'info_dfc',
        'stripe_dfc',
        'registrations_dfc',
        'event_dfc',
        'projects_info'
    ];
    $data = [];

    foreach ($tables as $table) {
        $sql = "SELECT * FROM $table 
                INNER JOIN view_ ON $table.vie_id = view_.vie_id
                WHERE fai_id = '$fair'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) {
                    switch ($table) {
                        case 'info_dfc':
                            $data[] = [$table => $row['inf_id'], 'view' => $row['vie_view']];
                            break;
                        case 'projects_info':
                            $data[] = [$table => $row['pri_id'], 'view' => $row['vie_view']];
                            break;
                        case 'stripe_dfc':
                            $data[] = [$table => $row['stp_id'], 'view' => $row['vie_view']];
                            break;
                        case 'registrations_dfc':
                            $data[] = [$table => $row['reg_id'], 'view' => $row['vie_view']];
                            break;
                        case 'event_dfc':
                            $data[] = [$table => $row['eve_id'], 'view' => $row['vie_view']];
                            break;
                    }
                }
            } else {
                $con->close();
                $query->close();
                $data[] = ['error' => 'DontExistData', $table => 'DontExistData'];
            }
        } else {
            $con->close();
            $data[] = ['error' => 'DontExistData', $table => 'DontExistData'];
        }
    }

    $con->close();
    $query->close();
    return $data;
}
