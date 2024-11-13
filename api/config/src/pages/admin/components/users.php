<?php

if (isset($_SESSION['error_users'])) {
    $error = $_SESSION['error_users'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_users']);
}

?>
<div class="section-zone">
    <?php
    if ($_GET['p'] === 'users') {
    ?>
        <h1 class="title">Usuarios</h1>
        <div class="container-table">
            <table>
                <tr>
                    <th>id</th>
                    <th>Rol</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
                <?php
                $sql = "SELECT * FROM users INNER JOIN roles ON users.rol_id = roles.rol_id";
                $query = mysqli_query($con, $sql);
                if ($query) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $date = HourFormated($row['use_date']);
                ?>
                        <tr>
                            <td><?php echo $row['use_id'] ?></td>
                            <td><?php echo $row['rol_role'] ?></td>
                            <td><?php echo $row['use_name'] ?></td>
                            <td><?php echo $row['use_email'] ?></td>
                            <td><?php echo $date ?></td>
                            <td><img src="data:image/jpg;base64, <?php echo base64_encode($row['use_image']); ?>" alt="Logo" class="image-rounded-table" loading="lazy"></td>
                            <td>
                                <a href="./admin.php?p=users-edit&id=<?php echo $row['use_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table" loading="lazy"></a>
                                <a href="../../php/admin/delete_users.php?id=<?php echo $row['use_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" loading="lazy"></a>
                            </td>
                        </tr>
                <?php }
                }
                $con->close();
                ?>
            </table>
        </div>
        <a href="./admin.php?p=users-add" class="add-table">+</a>
    <?php
    }
    ?>
    <div class="container-form-zone">
        <?php
        if ($_GET['p'] === 'users-add') {
        ?>
            <form class="form-form" action="../../php/admin/add_user.php" method="POST" enctype="multipart/form-data">
                <h2 class="title-form">Agregar Usuario</h2>

                <div class="group-form">
                    <input type="text" id="username" name="username" placeholder="Ingrese nombre" class="input-form" required>
                    <label for="username" class="label-form">Nombre</label>
                </div>

                <div class="group-form">
                    <select name="role" class="input-form" id="role" required>
                        <option value="1">Autor</option>
                        <option value="2">Administrador</option>
                    </select>
                    <label for="role" class="label-form">Rol</label>
                </div>

                <div class="group-form">
                    <input type="email" id="email" name="email" placeholder="Ingrese correo" class="input-form" required>
                    <label for="email" class="label-form">Correo</label>
                </div>

                <div class="group-form">
                    <input type="password" id="password" name="password" placeholder="Ingrese contraseña" class="input-form" required>
                    <label for="password" class="label-form">Contraseña</label>
                </div>

                <div class="group-form">
                    <input type="file" id="image" name="image" class="input-form">
                    <label for="image" class="label-form">Imagen</label>
                </div>

                <button type="submit" name="submit" class="submit-from">Agregar</button>
            </form>
        <?php
        } ?>

        <?php
        if ($_GET['p'] === 'users-edit') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM users INNER JOIN roles ON users.rol_id = roles.rol_id WHERE use_id = '$id'";
                $query = mysqli_query($con, $sql);
                if ($query) {
                    $row = $query->fetch_assoc();
        ?>
                    <form class="form-form" action="../../php/admin/edit_users.php" method="POST" enctype="multipart/form-data">
                        <h2 class="title-form">Editar Usuario</h2>

                        <input type="hidden" name="id" value="<?php echo $id ?>">

                        <div class="group-form">
                            <input type="text" id="username" name="username" value="<?php echo $row['use_name'] ?>" placeholder="Ingrese nombre" class="input-form" required>
                            <label for="username" class="label-form">Nombre</label>
                        </div>

                        <div class="group-form">
                            <select name="role" class="input-form" id="role" required>
                                <option value="<?php echo $row['rol_id'] ?>"><?php echo $row['rol_role'] ?></option>
                                <option value="1">Autor</option>
                                <option value="2">Administrador</option>
                            </select>
                            <label for="role" class="label-form">Rol</label>
                        </div>

                        <div class="group-form">
                            <input type="email" id="email" name="email" placeholder="Ingrese correo" value="<?php echo $row['use_email'] ?>" class="input-form" required>
                            <label for="email" class="label-form">Correo</label>
                        </div>

                        <div class="group-form">
                            <input type="file" id="image" name="image" class="input-form" required>
                            <label for="image" class="label-form">Imagen</label>
                        </div>

                        <button type="submit" class="submit-from" name="submit">Editar</button>
                    </form>
        <?php
                }
            }
        } ?>
    </div>
</div>