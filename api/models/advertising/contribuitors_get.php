<?php
// contribitors advertisng select all 

require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
$con = Connect_DB();
function ContribuitorsAll()
{
    global $con;

    $type = 10;
    $sql = "SELECT * FROM contributors WHERE typ_id = '$type'";
    $query = mysqli_query($con, $sql);
    if ($query) {
        if ($query->num_rows > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($query)) {
                $image = base64_encode($row['con_image']);
                $data[] = [
                    'name' => $row['con_person_name'],
                    'nickname' => $row['con_nickname'],
                    'description' => $row['con_description'],
                    'image' => $image
                ];
            }
            return $data;
        } else {
            return ['error' => 'DontExistData'];
        }
    } else {
        return ['error' => 'ApplicationError'];
    }
}
