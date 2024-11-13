<?php
// identify fair

require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
$con = Connect_DB();

function IdentifyFair()
{
    global $con;

    $sql = "SELECT * FROM fair
            INNER JOIN view_ ON fair.vie_id = view_.vie_id";
    $query = mysqli_query($con, $sql);
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['vie_view'] === 'si') {
                return $row['fai_id'];
            };
        };
    } else {
        return ['error' => 'ApplicationError'];
    }
};