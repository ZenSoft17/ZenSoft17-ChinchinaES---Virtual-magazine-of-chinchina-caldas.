<?php

$fair_id = $_SESSION['fair_id'];

if (isset($_SESSION['error_projects'])) {
    $error = $_SESSION['error_projects'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_projects']);
};

?>

<div class="section-zone">
    <h1 class="title">Solicitudes de proyectos</h1>
    <div class="container-project">
        <?php
        $sql = "SELECT * FROM project_registrations";
        $query = mysqli_query($con, $sql);
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
        ?>
                <div class="item-project">
                    <img src="data:image/jpg;base64, <?php echo base64_encode($row['prj_project_image']); ?>" class="image-project" alt="Imagen del proyecto">
                    <div class="info-project">
                        <h6 class="title-project"><?php echo $row['prj_project_name']; ?></h6>
                        <p class="text-project"><?php echo $row['prj_project_description']; ?></p>
                        <p class="author-project">Autor : <?php echo $row['prj_project_leader'] ?></p>
                        <div class="container-option-project">
                            <a href="../../php/admin/accept_project_request.php?pro_id=<?php echo $row['prj_id'] ?>&fai_id=<?php echo $fair_id ?>" class="button-project accept-project">Aceptar</a>
                            <a href="../../php/admin/delete_project_request.php?id=<?php echo $row['prj_id'] ?>" class="button-project delete-project">Eliminar</a>
                            <a href="../../php/admin/download_project_request.php?id=<?php echo $row['prj_id'] ?>" class="button-project upload-project">Descargar</a>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>