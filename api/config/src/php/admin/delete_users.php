<?php
// delete users

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    // 1. Obtener las publicaciones del usuario
    $sql_publicacion = "SELECT pub_id FROM publications WHERE use_id = ?";
    $stmt_publicacion = $con->prepare($sql_publicacion);
    $stmt_publicacion->bind_param('s', $id);
    $stmt_publicacion->execute();
    $result_publicacion = $stmt_publicacion->get_result();

    // 2. Recorrer cada publicación para eliminar sus elementos relacionados
    while ($row_publicacion = $result_publicacion->fetch_assoc()) {
        $pub_id = $row_publicacion['pub_id'];

        // Obtener los elementos relacionados con la publicación
        $sql_elements = "SELECT ele_id FROM elements WHERE pub_id = ?";
        $stmt_elements = $con->prepare($sql_elements);
        $stmt_elements->bind_param('s', $pub_id);
        $stmt_elements->execute();
        $result_elements = $stmt_elements->get_result();

        // Eliminar cada elemento relacionado con la publicación
        $sql_delete_element = "DELETE FROM elements WHERE pub_id = ?";
        $stmt_delete_element = $con->prepare($sql_delete_element);
        $stmt_delete_element->bind_param('s', $pub_id);
        $stmt_delete_element->execute();
        $stmt_delete_element->close();
    }

    // Cerrar los statements después de su uso
    $stmt_publicacion->close();

    // 3. Eliminar las publicaciones del usuario
    $sql_delete_publicacion = "DELETE FROM publications WHERE use_id = ?";
    $stmt_delete_publicacion = $con->prepare($sql_delete_publicacion);
    $stmt_delete_publicacion->bind_param('s', $id);
    $stmt_delete_publicacion->execute();
    $stmt_delete_publicacion->close();

    // 4. Eliminar el usuario
    $sql = "DELETE FROM users WHERE use_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $id);
        if ($stmt->execute()) {
            header("Location: ../../pages/admin/admin.php?p=users");
            $stmt->close();
            $con->close();
            exit;
        } else {
            session_start();
            $_SESSION['error_users'] = "Error en la consulta";
            header("Location: ../../pages/admin/admin.php?p=users");
            exit;
        }
    } else {
        session_start();
        $_SESSION['error_users'] = "Error al preparar la consulta";
        header("Location: ../../pages/admin/admin.php?p=users");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=users");
    exit;
}
