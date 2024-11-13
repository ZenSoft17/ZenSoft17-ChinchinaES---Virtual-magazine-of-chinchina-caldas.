<?php
//image bank
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
$con = Connect_DB();
function ImageBank()
{
    global $con;

    $sql = "SELECT * FROM image_bank";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($query)) {
                $image = base64_encode($row['imb_image']);
                $data[] = [
                    'image' => $image
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
