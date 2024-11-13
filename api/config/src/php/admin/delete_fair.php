<?php
// delete fair

if (isset($_GET['id'])) {
    require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
    $id = $_GET['id'];
    $con = Connect_DB();

    // Inicia una transacción
    $con->begin_transaction();

    try {

        // Elimina los registros en la tabla 'calendar_activities_days' que tienen la clave foránea 'cal_id'
        $sql = "DELETE FROM calendar_activities_days WHERE cal_id IN (SELECT cal_id FROM calendar_activities WHERE fai_id = ?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $stmt->close();
        } else {
            throw new Exception("Error al preparar la consulta para 'calendar_activities_days'");
        }

        // Elimina los registros en la tabla 'calendar_activities'
        $sql = "DELETE FROM calendar_activities WHERE fai_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $stmt->close();
        } else {
            throw new Exception("Error al preparar la consulta para 'calendar_activities'");
        }


        // Elimina los registros en las otras tablas relacionadas
        $tables = [
            'cast_time',
            'projects_info',
            'certifications',
            'info_dfc',
            'event_dfc',
            'invited',
            'location',
            'modalities',
            'registrations_dfc',
            'schedules',
            'stripe_dfc',
            'themes'
        ];

        foreach ($tables as $table) {
            $sql = "DELETE FROM $table WHERE fai_id = ?";
            $stmt = $con->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('s', $id);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Error al preparar la consulta para $table");
            }
        }

        // Finalmente, elimina el registro en la tabla principal 'fair'
        $sql = "DELETE FROM fair WHERE fai_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $id);
            if (!$stmt->execute()) {
                throw new Exception("Error al ejecutar la consulta para 'fair'");
            }
            $stmt->close();
        } else {
            throw new Exception("Error al preparar la consulta para 'fair'");
        }

        // Confirma la transacción
        $con->commit();
        $con->close();
        header("Location: ../../pages/admin/admin.php?p=fair");
        exit;
    } catch (Exception $e) {
        // Si ocurre un error, revierte la transacción
        $con->rollback();
        session_start();
        $_SESSION['error_fair'] = "error en eliminar";
        $con->close();
        header("Location: ../../pages/admin/admin.php?p=fair");
        exit;
    }
} else {
    header("Location: ../../pages/admin/admin.php?p=fair");
    exit;
}
