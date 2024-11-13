<?php
// search

require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/hour_formated.php';
$con = Connect_DB();

function Search($search)
{
    global $con;

    $view = 1;
    $search = '%' . $search . '%';
    $sql = "SELECT * FROM publications 
            INNER JOIN categories ON publications.cat_id = categories.cat_id
            INNER JOIN users ON publications.use_id = users.use_id 
            WHERE publications.vie_id = ? 
            AND (users.use_name LIKE ? OR publications.pub_category_other LIKE ? OR publications.pub_name LIKE ? OR publications.pub_date LIKE ?)";

    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('issss', $view, $search, $search, $search, $search);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $date = HourFormated($row['pub_date']);
                $image = base64_encode($row['pub_image']);
                $data[] = [
                    'publication_id' => $row['pub_id'],
                    'publication_name' => $row['pub_name'],
                    'publication_date' => $date,
                    'publication_image' => $image,
                    'category' => $row['cat_category'],
                    'category_others' => $row['pub_category_other']
                ];
            }
            $result->free();  
            $stmt->close(); 
            $con->close();
            return [
                'data' => $data,
                'count' => count($data)
            ];
        } else {
            $con->close();
            $stmt->close();
            return ['error' => 'DontExistData'];
        }
    } else {
        $con->close();
        return ['error' => 'ApplicationError'];
    }
}