<?php


if (isset($_SESSION['error_advertising'])) {
    $error = $_SESSION['error_advertising'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_advertising']);
}
?>

<div class="section-zone">
    <?php if ($_GET['p'] === 'advertising') { ?>
        <h1 class="title">Colaboradores y Patrocinadores</h1>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Tipo</th>
                        <th>Persona</th>
                        <th>Nombre de usuario</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM contributors INNER JOIN types ON contributors.typ_id = types.typ_id";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['con_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['typ_type']); ?></td>
                                <td><?php echo htmlspecialchars($row['con_person_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['con_nickname']); ?></td>
                                <td><?php echo htmlspecialchars($row['con_description']); ?></td>
                                <td>
                                    <img src="data:image/jpg;base64,<?php echo base64_encode($row['con_image']); ?>" alt="Logo" class="image-rounded-table" loading="lazy">
                                </td>
                                <td>
                                    <a href="./admin.php?p=advertising-edit&id=<?php echo urlencode($row['con_id']); ?>" role="button">
                                        <img src="../../assets/img/edit.png" alt="Editar" class="image-table" loading="lazy">
                                    </a>
                                    <a href="../../php/admin/delete_advertising.php?id=<?php echo urlencode($row['con_id']); ?>" role="button">
                                        <img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" loading="lazy">
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    $con->close();
                    ?>
                </tbody>
            </table>
        </div>
        <a href="./admin.php?p=advertising-add" class="add-table" role="button">+</a>
    <?php } ?>

    <div class="container-form-zone">
        <?php if ($_GET['p'] === 'advertising-add') { ?>
            <form class="form-form" action="../../php/admin/add_advertising.php" method="POST" enctype="multipart/form-data" role="form">
                <h2 class="title-form">Agregar Patrocinador</h2>

                <div class="group-form">
                    <select name="type" class="input-form" id="type" required>
                        <option value="9">Marca</option>
                        <option value="10">Ayudante</option>
                    </select>
                    <label for="type" class="label-form">Tipo</label>
                </div>

                <div class="group-form">
                    <input type="text" id="name" name="name" placeholder="Ingrese el nombre del patrocinador" class="input-form" required>
                    <label for="name" class="label-form">Nombre</label>
                </div>

                <div class="group-form">
                    <input type="text" id="username" name="username" placeholder="Ingrese el nombre de usuario o correo" class="input-form" required>
                    <label for="username" class="label-form">Nombre de usuario o correo</label>
                </div>

                <div class="group-form">
                    <input type="text" id="description" name="description" placeholder="Ingrese una descripción" class="input-form" required>
                    <label for="description" class="label-form">Descripción</label>
                </div>

                <div class="group-form">
                    <input type="file" id="image" name="image" class="input-form" required>
                    <label for="image" class="label-form">Imagen</label>
                </div>

                <button type="submit" class="submit-from" name="submit">Agregar</button>
            </form>
        <?php } ?>

        <?php if ($_GET['p'] === 'advertising-edit') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM contributors INNER JOIN types ON contributors.typ_id = types.typ_id WHERE con_id = '$id'";
                $query = mysqli_query($con, $sql);
                if ($query) {
                    $row = $query->fetch_assoc();
        ?>
                    <form class="form-form" action="../../php/admin/edit_advertising.php" method="POST" enctype="multipart/form-data" role="form">
                        <h2 class="title-form">Editar Patrocinador</h2>

                        <input type="hidden" value="<?php echo htmlspecialchars($id); ?>" name="id">

                        <div class="group-form">
                            <select name="type" class="input-form" id="type" required>
                                <option value="<?php echo htmlspecialchars($row['typ_id']); ?>"><?php echo htmlspecialchars($row['typ_type']); ?></option>
                                <option value="9">Marca</option>
                                <option value="10">Ayudante</option>
                            </select>
                            <label for="type" class="label-form">Tipo</label>
                        </div>

                        <div class="group-form">
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['con_person_name']); ?>" class="input-form" required>
                            <label for="name" class="label-form">Nombre</label>
                        </div>

                        <div class="group-form">
                            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($row['con_nickname']); ?>" class="input-form" required>
                            <label for="username" class="label-form">Nombre de usuario o correo</label>
                        </div>

                        <div class="group-form">
                            <textarea id="description" name="description" class="input-form" rows="5" required><?php echo htmlspecialchars($row['con_description']); ?></textarea>
                            <label for="description" class="label-form">Descripción</label>
                        </div>

                        <div class="group-form">
                            <input type="file" id="image" name="image" class="input-form">
                            <label for="image" class="label-form">Imagen</label>
                        </div>

                        <button type="submit" class="submit-from" name="submit">Editar</button>
                    </form>
        <?php }
            }
        } ?>
    </div>
</div>