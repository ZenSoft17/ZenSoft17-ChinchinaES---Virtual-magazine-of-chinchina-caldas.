<?php
// edit themes

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $theme = $_POST['theme'];    

    $sql = "UPDATE themes SET the_theme = ? WHERE the_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ss', $theme, $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=themes");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_themes'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=themes-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_themes'] = "error en la preparación de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=themes-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=themes");
    exit;
};
