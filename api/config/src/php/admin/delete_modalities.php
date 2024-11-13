<?php
// delete modality

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    // Inicia una transacción
    $con->begin_transaction();

    try {
        // Elimina los registros en la tabla 'projects' que tienen la clave foránea 'mod_id'
        $sql = "DELETE FROM projects WHERE mod_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $stmt->close();
        } else {
            throw new Exception("Error al preparar la consulta para 'projects'");
        }

        // Elimina los registros en la tabla 'modalities'
        $sql = "DELETE FROM modalities WHERE mod_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $id);
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta para 'modalities'");
            }
            $stmt->close();
        } else {
            throw new Exception("Error al preparar la consulta para 'modalities'");
        }

        // Confirma la transacción
        $con->commit();
        $con->close();
        header("Location: ../../pages/admin/admin.php?p=modalities");
        exit;
    } catch (Exception $e) {
        // Si ocurre un error, revierte la transacción
        $con->rollback();
        session_start();
        $_SESSION['error_modality'] = $e->getMessage();
        $con->close();
        header("Location: ../../pages/admin/admin.php?p=modalities");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=modalities");
    exit;
}
