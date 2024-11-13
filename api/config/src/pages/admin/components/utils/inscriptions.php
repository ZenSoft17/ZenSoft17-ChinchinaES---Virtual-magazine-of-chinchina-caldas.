<?php

$fair_id = $_SESSION['fair_id'];

if (isset($_SESSION['error_inscriptions'])) {
    $error = $_SESSION['error_inscriptions'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_inscriptions']);
};

?>


<div class="section-zone">
    <?php if ($_GET['p2'] === 'inscriptions') { ?>
        <h2 class="subtitle">Información de Inscripciones</h2>
        <div class="container-table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Información General</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Vista</th>
                    <th>Acciones</th>
                </tr>
                <?php
                $sql = "SELECT * FROM registrations_dfc INNER JOIN view_ ON registrations_dfc.vie_id = view_.vie_id WHERE registrations_dfc.fai_id = '$fair_id'";
                $query = mysqli_query($con, $sql);
                if ($query && $row = $query->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['reg_id'] ?></td>
                        <td><?php echo $row['reg_title'] ?></td>
                        <td><?php echo $row['reg_description'] ?></td>
                        <td><?php echo $row['reg_general_info'] ?></td>
                        <td><?php echo $row['reg_start_date'] ?></td>
                        <td><?php echo $row['reg_end_date'] ?></td>
                        <td><?php echo $row['vie_view'] ?></td>
                        <td>
                            <a href="./admin.php?p=fair&p2=inscriptions-edit&id=<?php echo $row['reg_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table" loading="lazy"></a>
                            <a href="../../php/admin/delete_inscriptions.php?id=<?php echo $row['reg_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" loading="lazy"></a>
                        </td>
                    </tr>
                <?php
                } else {
                    echo "<tr><td colspan='6'>No se encontraron resultados.</td></tr>";
                }
                ?>
            </table>
        </div>
        <a href="./admin.php?p=fair&p2=inscriptions-add" class="add-table">+</a>
    <?php } ?>

    <?php if ($_GET['p2'] === 'inscriptions-add') { ?>
        <form class="form-form" action="../../php/admin/add_inscriptions.php" method="POST" enctype="multipart/form-data">
            <h2 class="title-form">Agregar Información de Inscripciones</h2>

            <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">

            <div class="group-form">
                <input type="text" id="titulo" name="title" placeholder="Ingrese el título" class="input-form">
                <label for="titulo" class="label-form">Título</label>
            </div>

            <div class="group-form">
                <textarea name="description" rows="4" id="descripcion" class="input-form" placeholder="Ingrese la descripción"></textarea>
                <label for="descripcion" class="label-form">Descripción</label>
            </div>

            <div class="group-form">
                <textarea name="info-general" rows="4" id="info-general" class="input-form" placeholder="Ingrese la información general"></textarea>
                <label for="info-general" class="label-form">Información General</label>
            </div>

            <div class="group-form">
                <input type="date" id="start-date" name="start-date" class="input-form">
                <label for="fecha_inicio" class="label-form">Fecha de Inicio</label>
            </div>

            <div class="group-form">
                <input type="date" id="end-date" name="end-date" class="input-form">
                <label for="fecha_fin" class="label-form">Fecha de Fin</label>
            </div>

            <div class="group-form">
                <select name="view" class="input-form" id="vista">
                    <option value="1">Sí</option>
                    <option value="2">No</option>
                </select>
                <label for="vista" class="label-form">Vista</label>
            </div>

            <button class="submit-from" name="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php if ($_GET['p2'] === 'inscriptions-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM registrations_dfc INNER JOIN view_ ON registrations_dfc.vie_id = view_.vie_id WHERE reg_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc();
    ?>
                <form class="form-form" action="../../php/admin/edit_inscriptions.php" method="POST" enctype="multipart/form-data">
                    <h2 class="title-form">Editar Información de Inscripciones</h2>

                    <input type="hidden" name="id" value="<?php echo $row['reg_id'] ?>">
                    <div class="group-form">
                        <input type="text" id="titulo" name="title" value="<?php echo $row['reg_title'] ?>" placeholder="Ingrese el título" class="input-form">
                        <label for="titulo" class="label-form">Título</label>
                    </div>

                    <div class="group-form">
                        <textarea name="description" rows="4" id="descripcion" class="input-form" placeholder="Ingrese la descripción"><?php echo $row['reg_description'] ?></textarea>
                        <label for="descripcion" class="label-form">Descripción</label>
                    </div>

                    <div class="group-form">
                        <textarea name="info-general" rows="4" id="info_general" class="input-form" placeholder="Ingrese la información general"><?php echo $row['reg_general_info'] ?></textarea>
                        <label for="info_general" class="label-form">Información General</label>
                    </div>

                    <div class="group-form">
                        <input type="date" id="start-date" value="<?php echo $row['reg_start_date'] ?>" name="start-date" class="input-form">
                        <label for="fecha_inicio" class="label-form">Fecha de Inicio</label>
                    </div>

                    <div class="group-form">
                        <input type="date" id="end-date" value="<?php echo $row['reg_end_date'] ?>" name="end-date" class="input-form">
                        <label for="fecha_fin" class="label-form">Fecha de Fin</label>
                    </div>

                    <div class="group-form">
                        <select name="view" class="input-form" id="view">
                            <option value="<?php echo $row['vie_id'] ?>"><?php echo $row['vie_view'] ?></option>
                            <option value="1">Sí</option>
                            <option value="2">No</option>
                        </select>
                        <label for="vista" class="label-form">Vista</label>
                    </div>

                    <button class="submit-from" name="submit">Editar</button>
                </form>
    <?php }
        }
    } ?>
</div>