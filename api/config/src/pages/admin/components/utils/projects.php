<?php
$fair_id = $_SESSION['fair_id'];

if (isset($_SESSION['error_projects'])) {
    $error = $_SESSION['error_projects'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_projects']);
}
?>

<div class="section-zone">

    <?php if ($_GET['p2'] === 'projects') { ?>
        <h1 class="title">Visualización de Proyectos</h1>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Modalidad</th>
                        <th>Vista</th>
                        <th>Estado</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM projects 
                            INNER JOIN modalities ON projects.mod_id = modalities.mod_id 
                            INNER JOIN status ON projects.sta_id = status.sta_id
                            INNER JOIN view_ ON projects.vie_id = view_.vie_id
                            WHERE projects.fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo $row['pro_id'] ?></td>
                                <td><?php echo $row['mod_modality'] ?></td>
                                <td><?php echo $row['vie_view'] ?></td>
                                <td>
                                    <?php
                                    if ($row['sta_status'] === 'red') {
                                    ?>
                                        <span class="status-red">.</span>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if ($row['sta_status'] === 'yellow') {
                                    ?>
                                        <span class="status-yellow">.</span>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if ($row['sta_status'] === 'green') {
                                    ?>
                                        <span class="status-green">.</span>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $row['pro_title'] ?></td>
                                <td><?php echo $row['pro_author'] ?></td>
                                <td><img src="data:image/jpg;base64, <?php echo base64_encode($row['pro_image']); ?>" alt="Imagen del proyecto" class="image-rounded-table"></td>
                                <td>
                                    <a href="./admin.php?p=fair&p2=projects-edit&id=<?php echo $row['pro_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table"></a>
                                    <a href="../../php/admin/delete_projects.php?id=<?php echo $row['pro_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table"></a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
        <a href="./admin.php?p=fair&p2=projects-add" class="add-table">+</a>
    <?php } ?>

    <div class="container-form-zone">

        <?php if ($_GET['p2'] === 'projects-add') { ?>
            <form class="form-form" method="POST" action="../../php/admin/add_projects.php" enctype="multipart/form-data">
                <h2 class="title-form">Agregar Proyecto</h2>
                <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">
                <div class="group-form">
                    <input type="text" id="title" name="title" placeholder="Ingrese el título" class="input-form" required>
                    <label for="title" class="label-form">Título</label>
                </div>

                <div class="group-form">
                    <input type="text" id="author" name="author" placeholder="Ingrese el nombre del autor" class="input-form" required>
                    <label for="author" class="label-form">Nombre del Autor</label>
                </div>

                <div class="group-form">
                    <input type="file" id="image" name="image" class="input-form" required>
                    <label for="image" class="label-form">Imagen</label>
                </div>

                <div class="group-form">
                    <select name="modality" class="input-form" id="modality" required>
                        <?php
                        $sql = "SELECT * FROM modalities WHERE fai_id = '$fair_id'";
                        $query = mysqli_query($con, $sql);
                        if ($query) {
                            while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                                <option value="<?php echo $row['mod_id'] ?>"><?php echo $row['mod_modality'] ?></option>
                        <?php }
                        } ?>
                    </select>
                    <label for="modality" class="label-form">Modalidad</label>
                </div>

                <div class="group-form">
                    <select name="status" class="input-form" id="status" required>
                        <option value="1">Verde</option>
                        <option value="2">Amarillo</option>
                        <option value="3">Rojo</option>
                    </select>
                    <label for="status" class="label-form">Estado</label>
                </div>

                <div class="group-form">
                    <select name="view" class="input-form" id="view" required>
                        <option value="1">Sí</option>
                        <option value="2">No</option>
                    </select>
                    <label for="view" class="label-form">Vista</label>
                </div>

                <button type="submit" class="submit-from" name="submit">Agregar</button>
            </form>
        <?php } ?>

        <?php if ($_GET['p2'] === 'projects-edit') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM projects 
                    INNER JOIN modalities ON projects.mod_id = modalities.mod_id 
                    INNER JOIN status ON projects.sta_id = status.sta_id
                    INNER JOIN view_ ON projects.vie_id = view_.vie_id 
                    WHERE projects.pro_id = '$id'";
                $query = mysqli_query($con, $sql);
                if ($query) {
                    $row = $query->fetch_assoc();
        ?>
                    <form class="form-form" method="POST" action="../../php/admin/edit_projects.php" enctype="multipart/form-data">
                        <h2 class="title-form">Editar Proyecto</h2>

                        <input type="hidden" name="id" value="<?php echo $row['pro_id']; ?>">

                        <div class="group-form">
                            <input type="text" id="title" name="title" value="<?php echo $row['pro_title'] ?>" placeholder="Ingrese el título" class="input-form" required>
                            <label for="title" class="label-form">Título</label>
                        </div>

                        <div class="group-form">
                            <input type="text" id="author" name="author" value="<?php echo $row['pro_author'] ?>" placeholder="Ingrese el nombre del autor" class="input-form" required>
                            <label for="author" class="label-form">Nombre del Autor</label>
                        </div>

                        <div class="group-form">
                            <input type="file" id="image" name="image" class="input-form">
                            <label for="image" class="label-form">Imagen</label>
                        </div>

                        <div class="group-form">
                            <select name="modality" class="input-form" id="modality" required>
                                <option value="<?php echo $row['mod_id'] ?>"><?php echo $row['mod_modality'] ?></option>
                                <?php
                                $sql_modality = "SELECT * FROM modalities WHERE fai_id = '$fair_id'";
                                $query_modality = mysqli_query($con, $sql_modality);
                                if ($query_modality) {
                                    while ($row_modality = mysqli_fetch_assoc($query_modality)) {
                                ?>
                                        <option value="<?php echo $row_modality['mod_id'] ?>"><?php echo $row_modality['mod_modality'] ?></option>
                                <?php }
                                } ?>
                            </select>
                            <label for="modality" class="label-form">Modalidad</label>
                        </div>

                        <div class="group-form">
                            <select name="status" class="input-form" id="status" required>
                                <option value="<?php echo $row['sta_id'] ?>">
                                    <?php

                                    if ($row['sta_status'] === 'red') {
                                        echo "rojo";
                                    }

                                    if ($row['sta_status'] === 'yellow') {
                                        echo "amarillo";
                                    }

                                    if ($row['sta_status'] === 'green') {
                                        echo "verde";
                                    }

                                    ?>
                                </option>
                                <option value="1">Verde</option>
                                <option value="2">Amarillo</option>
                                <option value="3">Rojo</option>
                            </select>
                            <label for="status" class="label-form">Estado</label>
                        </div>

                        <div class="group-form">
                            <select name="view" class="input-form" id="view" required>
                                <option value="<?php echo $row['vie_id'] ?>"><?php echo $row['vie_view'] ?></option>
                                <option value="1">Sí</option>
                                <option value="2">No</option>
                            </select>
                            <label for="view" class="label-form">Vista</label>
                        </div>

                        <button type="submit" class="submit-from" name="submit">Editar</button>
                    </form>
        <?php }
            }
        } ?>

    </div>
</div>