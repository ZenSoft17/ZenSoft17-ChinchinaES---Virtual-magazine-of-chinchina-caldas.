<?php

// select all elements

require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/hour_formated.php';
$con = Connect_DB();

function ElementsAll($id)
{

    global $con;

    $sql = "SELECT * FROM elements 
            INNER JOIN types ON elements.typ_id = types.typ_id
            WHERE pub_id = '$id'
            ORDER BY ele_datetime ASC;";
    $query = mysqli_query($con, $sql);
    if ($query) {
        if ($query->num_rows > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($query)) {

                $image = $row['ele_image'] !== null ? base64_encode($row['ele_image']) : '';
                $data[] = [
                    'element_id' => $row['ele_id'],
                    'element_type' => $row['typ_type'],
                    'element_text' => $row['ele_text'],
                    'element_image' => $image,
                    'element_video' => $row['ele_video']
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
