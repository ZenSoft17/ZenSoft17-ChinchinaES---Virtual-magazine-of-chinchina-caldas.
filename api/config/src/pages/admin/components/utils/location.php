<?php

$fair_id = $_SESSION['fair_id'];

if (isset($_SESSION['error_location'])) {
    $error = $_SESSION['error_location'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_location']);
};

?>


<div class="section-zone">

    <?php if ($_GET['p2'] === 'location') { ?>
        <h2 class="subtitle">Sede del Evento</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM location WHERE fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo $row['loc_id'] ?></td>
                                <td><?php echo $row['loc_title'] ?></td>
                                <td><?php echo $row['loc_text'] ?></td>
                                <td><img src="data:image/jpg;base64, <?php echo base64_encode($row['loc_image']); ?>" alt="Logo" class="image-rounded-table" loading="lazy"></td>
                                <td>
                                    <a href="./admin.php?p=fair&p2=location-edit&id=<?php echo $row['loc_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table" loading="lazy"></a>
                                    <a href="../../php/admin/delete_location.php?id=<?php echo $row['loc_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" loading="lazy"></a>
                                </td>
                            </tr>
                    <?php                         }
                    } ?>
                </tbody>
            </table>
        </div>
        <a href="./admin.php?p=fair&p2=location-add" class="add-table" aria-label="Agregar">+</a>
    <?php } ?>

    <?php if ($_GET['p2'] === 'location-add') { ?>
        <form class="form-form" method="POST" action="../../php/admin/add_location.php" enctype="multipart/form-data">
            <h2 class="title-form">Agregar Sede</h2>
            <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">
            <div class="group-form">
                <input type="text" id="titulo" name="title" placeholder="Ingrese el título" class="input-form" required>
                <label for="titulo" class="label-form">Título</label>
            </div>

            <div class="group-form">
                <textarea rows="5" id="descripcion" name="description" placeholder="Ingrese la descripción" class="input-form" required></textarea>
                <label for="descripcion" class="label-form">Descripción</label>
            </div>

            <div class="group-form">
                <input type="file" id="imagen" name="image" class="input-form" required>
                <label for="imagen" class="label-form">Imagen</label>
            </div>

            <button class="submit-from" name="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php if ($_GET['p2'] === 'location-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM location WHERE loc_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc();
    ?>
                <form class="form-form" method="POST" action="../../php/admin/edit_location.php" enctype="multipart/form-data">
                    <h2 class="title-form">Editar Sede</h2>
                    <input type="hidden" name="id" value="<?php echo $row['loc_id'] ?>">
                    <div class="group-form">
                        <input type="text" id="titulo" name="title" value="<?php echo $row['loc_title'] ?>" placeholder="Ingrese el título" class="input-form" required>
                        <label for="titulo" class="label-form">Título</label>
                    </div>

                    <div class="group-form">
                        <textarea rows="5" id="descripcion" name="description" placeholder="Ingrese la descripción" class="input-form" required><?php echo $row['loc_text'] ?></textarea>
                        <label for="descripcion" class="label-form">Descripción</label>
                    </div>

                    <div class="group-form">
                        <input type="file" id="imagen" name="image" class="input-form" >
                        <label for="imagen" class="label-form">Imagen</label>
                    </div>

                    <button class="submit-from" name="submit">Editar</button>
                </form>
    <?php }
        }
    } ?>

</div>