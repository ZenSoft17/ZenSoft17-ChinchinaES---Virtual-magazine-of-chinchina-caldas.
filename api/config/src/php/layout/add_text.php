<?php
// add text

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id =  str_pad(random_int(0, 99999999), 10, '0', STR_PAD_LEFT);
    $type = 5;
    $text = $_POST['text'];
    $pub_id = $_POST['pub_id'];    
    $datetime = date('Y-m-d H:i:s');

    $sql = "INSERT INTO elements(ele_id,pub_id,typ_id,ele_text,ele_datetime) VALUES(?,?,?,?,?)";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('sssss', $id, $pub_id, $type, $text, $datetime);
        if ($stmt->execute()) {
            header("Location: ../../pages/layout/layout.php?p=publication");
            exit;
        } else {
            session_start();
            $_SESSION['error_layout'] = "Error en la consulta";
            header("Location: ../../pages/layout/layout.php?p=text-add");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_layout'] = "Error en la consulta";
        header("Location: ../../pages/layout/layout.php?p=text-add");
        exit;
    }
} else {
    session_start();
    $_SESSION['error_layout'] = "no se envio el formulario";
    header("Location: ../../pages/layout/layout.php");
    exit;
}
