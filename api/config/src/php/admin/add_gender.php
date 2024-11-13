<?php
// add gender

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $gender = $_POST['gender'];

    $sql = "INSERT INTO gender(gen_id, gen_gender) VALUES(?,?)";
    $stmt = $con->prepare($sql);
    if($stmt){
        $stmt->bind_param("is", $id, $gender);
        if($stmt->execute()){
            header("Location: ../../pages/admin/admin.php?p=collection&p2=genders");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_genders'] = "Error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=collection&p2=genders");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_genders'] = "Error en la consulta";
        header("Location: ../../pages/admin/admin.php?p=collection&p2=genders");
        exit;
    }

}