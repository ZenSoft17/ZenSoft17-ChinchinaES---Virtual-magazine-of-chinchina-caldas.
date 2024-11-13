<?php 
// invited

require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/models/dfc/utils/identify_fair.php';
$fair = IdentifyFair();


function Invited()
{
    global $fair, $con;

    $sql = "SELECT * FROM invited
            INNER JOIN modalities ON invited.mod_id = modalities.mod_id
            WHERE modalities.fai_id = '$fair'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $data = [
                'invited_name' => $row['inv_name'],
                'invited_profession' => $row['inv_profession'],
                'invited_modality' => $row['mod_modality']
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