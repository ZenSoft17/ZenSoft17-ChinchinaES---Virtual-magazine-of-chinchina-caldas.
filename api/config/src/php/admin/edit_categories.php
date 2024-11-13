<?php
// edit categories

if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $con = Connect_DB();
    $id = $_POST['id'];
    $category_name = $_POST['category_name'];    
    $sql_select = "SELECT * FROM categories WHERE cat_id = '$id'";
    $query_select = mysqli_query($con, $sql_select);
    if ($query_select) {
        $row = $query_select->fetch_assoc();
        $category = $row['cat_category'];
        $others = 8;
        $sql_update = "UPDATE publications SET cat_id = ?, pub_category_other = ? WHERE cat_id = ?";
        $stmt_update = $con->prepare($sql_update);
        if ($stmt_update) {
            $stmt_update->bind_param('ssi', $others, $category, $id);
            if ($stmt_update->execute()) {
                $sql = "UPDATE categories SET cat_category = ? WHERE cat_id = ?";
                $stmt = $con->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('si', $category_name, $id);
                    if ($stmt->execute()) {
                        header("Location: ../../pages/admin/admin.php?p=category");
                        exit;
                    } else {
                        session_start();
                        $_SESSION['error_categories'] = "error en la consulta";
                        header("Location: ../../pages/admin/admin.php?p=category-edit&id=$id");
                        exit;
                    }
                } else {
                    session_start();
                    $_SESSION['error_categories'] = "error en la preparacion de la consulta";
                    header("Location: ../../pages/admin/admin.php?p=category-edit&id=$id");
                    exit;
                }
            } else {
                session_start();
                $_SESSION['error_categories'] = "error en la consulta";
                header("Location: ../../pages/admin/admin.php?p=category-edit&id=$id");
                exit;
            }
        } else {
            session_start();
            $_SESSION['error_categories'] = "error en la preparacion de la consulta";
            header("Location: ../../pages/admin/admin.php?p=category-edit&id=$id");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_categories'] = "error en la consulta";
        header("Location: ../../pages/admin/admin.php?p=category-edit&id=$id");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=category-edit&id=$id");
    exit;
}
