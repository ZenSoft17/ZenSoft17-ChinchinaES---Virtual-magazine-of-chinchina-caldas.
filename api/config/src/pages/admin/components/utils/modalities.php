<?php

$fair_id = $_SESSION['fair_id'];

if (isset($_SESSION['error_modality'])) {
    $error = $_SESSION['error_modality'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_modality']);
};

?>


<div class="section-zone">

    <?php if ($_GET['p2'] === 'modalities') { ?>
        <h2 class="subtitle">Modalidades</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Modalidades</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM modalities WHERE fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo $row['mod_id'] ?></td>
                                <td><?php echo $row['mod_modality'] ?></td>
                                <td>
                                    <a href="./admin.php?p=fair&p2=modalities-edit&id=<?php echo $row['mod_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table"></a>
                                    <a href="../../php/admin/delete_modalities.php?id=<?php echo $row['mod_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table"></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }  ?>
                </tbody>
            </table>
        </div>
        <a href="./admin.php?p=fair&p2=modalities-add" class="add-table" aria-label="Agregar">+</a>
    <?php } ?>

    <?php if ($_GET['p2'] === 'modalities-add') { ?>
        <form class="form-form" method="POST" action="../../php/admin/add_modalities.php">
            <h2 class="title-form">Agregar Modalidad</h2>
            <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">
            <div class="group-form">
                <input type="text" id="modalidad" name="modality" placeholder="Ingrese la modalidad" class="input-form" required>
                <label for="modalidad" class="label-form">Modalidad</label>
            </div>
            <button class="submit-from" name="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php if ($_GET['p2'] === 'modalities-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM modalities WHERE mod_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc();
    ?>
                <form class="form-form" method="POST" action="../../php/admin/edit_modalities.php">
                    <h2 class="title-form">Editar Modalidad</h2>
                    <input type="hidden" name="id" value="<?php echo $row['mod_id'] ?>">
                    <div class="group-form">
                        <input type="text" id="modalidad" name="modality" value="<?php echo $row['mod_modality'] ?>" placeholder="Ingrese la modalidad" class="input-form" required>
                        <label for="modalidad" class="label-form">Modalidad</label>
                    </div>
                    <button class="submit-from" name="submit">Editar</button>
                </form>
    <?php }
        }
    } ?>

</div>