<?php
// introduction information
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
$fair = IdentifyFair();

function StripeInformation()
{
    global $con, $fair;

    $sql = "SELECT * FROM stripe_dfc WHERE fai_id = '$fair'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $data = [
                'stripe_title' => $row['stp_title'],
                'stripe_description' => $row['stp_description'],
                'stripe_live' => $row['stp_live'],
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
