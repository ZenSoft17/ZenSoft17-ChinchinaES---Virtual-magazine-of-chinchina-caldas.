<?php 
// edit information

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $view = $_POST['view'];    

    $sql = "UPDATE projects_info SET pri_title = ?, pri_text = ?, vie_id = ? WHERE pri_id = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ssss',$title,$description,$view,$id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-information");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_projects-information'] = "error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-information-edit&id=$id");
            exit;
        };
    } else {
        session_start();
        $_SESSION['error_projects-information'] = "error en la preparacion de la consulta";
        header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-information-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair&p2=projects-information");
    exit;
};
