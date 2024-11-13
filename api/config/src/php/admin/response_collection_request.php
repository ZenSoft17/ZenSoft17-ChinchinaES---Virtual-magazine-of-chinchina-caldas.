<?php
// response collection

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/mailer.php';
    $con = Connect_DB();
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $suject = "Hola $name, desde el equipo de producion de esfera y cafe te repondemos tu solicitud de libro";
    $response = $_POST['response'];

    if (Mailer($mail, $name, $subject, $response)) {
        header("Location: ../../pages/admin/admin.php?p=collection&p2=collection-request");
        $stmt->close();
        $con->close();
        exit;
    } else {
        session_start();
        $_SESSION['error_collection'] = "El correo no se pudo enviar con exito!";
        header("Location: ../../pages/admin/admin.php?p=collection&p2=collection-request");
        exit;
    }
}
