<?php 
// edit information

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $general_objective = $_POST['general_objective'];
    $view = $_POST['view'];    

    $sql = "UPDATE info_dfc SET inf_title = ?, inf_description = ?, inf_general_objective = ?, vie_id = ? WHERE inf_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('sssss',$title,$description,$general_objective,$view,$id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_information'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_information'] = "error en la preparacion de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=introduction");
    exit;
};
