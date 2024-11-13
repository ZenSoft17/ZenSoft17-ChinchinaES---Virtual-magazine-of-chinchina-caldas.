<?php
// video bank
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
$con = Connect_DB();
function VideoBank()
{
    global $con;

    $sql = "SELECT * FROM video_bank";
    $query = mysqli_query($con, $sql);

    if ($query) {
        if ($query->num_rows > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = [
                    'video' => $row['vib_video'],
                    'video_size' => $row['vib_size'],
                    'video_type' => $row['vib_type'],
                    'video_extension' => $row['vib_extension'],
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
