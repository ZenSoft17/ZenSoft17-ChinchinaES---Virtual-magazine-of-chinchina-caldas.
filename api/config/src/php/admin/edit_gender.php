<?php
// edit gender

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  $_POST['id'];
    $gender = $_POST['gender'];

    $sql = "UPDATE gender SET gen_gender = ? WHERE gen_id = ?";
    $stmt = $con->prepare($sql);
    if($stmt){
        $stmt->bind_param("si", $gender, $id);
        if($stmt->execute()){
            header("Location: ../../pages/admin/admin.php?p=collection&p2=genders");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_genders'] = "Error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=collection&p2=genders-edit&id=$id");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_genders'] = "Error en la consulta";
        header("Location: ../../pages/admin/admin.php?p=collection&p2=genders-edit&id=$id");
        exit;
    }

}