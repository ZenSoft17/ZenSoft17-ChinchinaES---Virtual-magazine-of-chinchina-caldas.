<?php
// themes

require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
$fair = IdentifyFair();

function themes()
{
    global $fair, $con;

    $sql = "SELECT * FROM themes
            WHERE fai_id = '$fair'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = [
                    'theme' => $row['the_theme'],
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
