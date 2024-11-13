<?php

// select apublication

require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/hour_formated.php';
$con = Connect_DB();

function PublicationAll($id)
{
    global $con;


    $view = 1;
    $sql = "SELECT * FROM publications 
            INNER JOIN categories ON publications.cat_id = categories.cat_id
            INNER JOIN users ON publications.use_id = users.use_id
            INNER JOIN roles ON users.rol_id = roles.rol_id
            WHERE publications.vie_id = '$view' AND publications.pub_id = '$id' ";
    $query = mysqli_query($con, $sql);
    if ($query) {
        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $date = HourFormated($row['pub_date']);
            $pub_image = base64_encode($row['pub_image']);
            $use_image = base64_encode($row['use_image']);
            $data = [
                'publication_id' => $row['pub_id'],
                'publication_name' => $row['pub_name'],
                'publication_date' => $date,
                'publication_image' => $pub_image,
                'category' => $row['cat_category'],
                'category_others' => $row['pub_category_other'],
                'author_id' => $row['use_id'],
                'author_name' => $row['use_name'],
                'author_image' => $use_image,
                'author_role' => $row['rol_role'],
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
