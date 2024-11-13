<?php 

// fair select
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
$con = Connect_DB();

function Fair(){
    global $con;

    $sql = "SELECT * FROM fair
            INNER JOIN view_ ON fair.vie_id = view_.vie_id
            WHERE fair.vie_id = '1'";
    $query = mysqli_query($con, $sql);
    if ($query) {
        if($query->num_rows > 0){
            $con->close();
            $query->close();
            return ['fair' => true];
        } else {
            $con->close();
            $query->close();
            return ['fair' => false];
        }
    } else {
        $con->close();
        return ['error' => 'ApplicationError'];
    }
};