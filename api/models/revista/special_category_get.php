<?php

// select all special category

require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/hour_formated.php';
$con = Connect_DB();

function SpecialCategory()
{

    global $con;

    $category = 9;
    $sql = "SELECT * FROM categories WHERE cat_id = '$category'";
    $query = mysqli_query($con, $sql);
    if ($query) {
        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $data = ['special_category' => $row['cat_category']];
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
