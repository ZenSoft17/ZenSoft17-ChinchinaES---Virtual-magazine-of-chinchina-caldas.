<?php

$fair_id = $_SESSION['fair_id'];

if (isset($_SESSION['error_projects-information'])) {
    $error = $_SESSION['error_projects-information'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_projects-information']);
};

?>

<div class="section-zone">
    <?php
    if ($_GET['p2'] === 'projects-information') {
    ?>
        <h2 class="subtitle">Proyectos (Información)</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Vista</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM projects_info INNER JOIN view_ ON projects_info.vie_id = view_.vie_id WHERE projects_info.fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query && $row = $query->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['pri_id']; ?></td>
                            <td><?php echo $row['pri_title']; ?></td>
                            <td><?php echo $row['pri_text']; ?></td>
                            <td><?php echo $row['vie_view']; ?></td>
                            <td>
                                <a href="./admin.php?p=fair&p2=projects-information-edit&id=<?php echo $row['pri_id']; ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table" loading="lazy"></a>
                                <a href="../../php/admin/delete_projects_information.php?id=<?php echo $row['pri_id']; ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" loading="lazy"></a>
                            </td>
                        </tr>
                    <?php
                    } else {
                        echo "<tr><td colspan='6'>No se encontraron resultados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="./admin.php?p=fair&p2=projects-information-add" class="add-table" aria-label="Agregar nueva información">+</a>
    <?php } ?>


    <?php
    if ($_GET['p2'] === 'projects-information-add') {
    ?>
        <form class="form-form" method="post" action="../../php/admin/add_projects_information.php" enctype="multipart/form-data">
            <h2 class="title-form">Agregar Proyectos (Información)</h2>

            <input type="hidden" name="fai_id" value="<?php echo $fair_id  ?>">

            <div class="group-form">
                <input type="text" id="title" name="title" placeholder="Título" class="input-form" required>
                <label for="title" class="label-form">Título</label>
            </div>

            <div class="group-form">
                <textarea name="description" class="input-form" id="description" placeholder="Descripción" required></textarea>
                <label for="description" class="label-form">Descripción</label>
            </div>

            <div class="group-form">
                <select name="view" class="input-form" id="view" required>
                    <option value="1">Sí</option>
                    <option value="2">No</option>
                </select>
                <label for="view" class="label-form">Vista</label>
            </div>

            <button class="submit-from" type="submit" name="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php
    if ($_GET['p2'] === 'projects-information-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM projects_info INNER JOIN view_ ON projects_info.vie_id = view_.vie_id WHERE pri_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc();
    ?>
                <form class="form-form" method="post" action="../../php/admin/edit_projects_information.php" enctype="multipart/form-data">
                    <h2 class="title-form">Editar Información</h2>

                    <input type="hidden" name="id" value="<?php echo $row['pri_id'] ?>">

                    <div class="group-form">
                        <input type="text" id="title_edit" name="title" placeholder="Título" value="<?php echo $row['pri_title'] ?>" class="input-form" required>
                        <label for="title_edit" class="label-form">Título</label>
                    </div>

                    <div class="group-form">
                        <textarea name="description" class="input-form" id="description_edit" placeholder="Descripción" required><?php echo $row['pri_text'] ?></textarea>
                        <label for="description_edit" class="label-form">Descripción</label>
                    </div>

                    <div class="group-form">
                        <select name="view" class="input-form" id="view_edit" required>
                            <option value="<?php echo $row['vie_id'] ?>"><?php echo $row['vie_view'] ?></option>
                            <option value="1">Sí</option>
                            <option value="2">No</option>
                        </select>
                        <label for="view_edit" class="label-form">Vista</label>
                    </div>

                    <button class="submit-from" type="submit" name="submit">Editar</button>
                </form>
    <?php }
        }
    } ?>
</div>

<div class="section-zone">

    <?php if ($_GET['p2'] === 'introduction') { ?>
        <h2 class="subtitle">Horarios de entrada</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Texto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM schedules WHERE fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo $row['sch_id'] ?></td>
                                <td><?php echo $row['sch_date_init'] ?></td>
                                <td><?php echo $row['sch_date_end'] ?></td>
                                <td><?php echo $row['sch_text'] ?></td>
                                <td>
                                    <a href="./admin.php?p=fair&p2=schedules-edit&id=<?php echo $row['sch_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table"></a>
                                    <a href="../../php/admin/delete_schedules.php?id=<?php echo $row['sch_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table"></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }  ?>
                </tbody>
            </table>
        </div>
        <a href="./admin.php?p=fair&p2=schedules-add" class="add-table" aria-label="Agregar">+</a>
    <?php } ?>

    <?php if ($_GET['p2'] === 'schedules-add') { ?>
        <form class="form-form" method="POST" action="../../php/admin/add_schedules.php">
            <h2 class="title-form">Agregar horario de entrada</h2>
            <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">
            <div class="group-form">
                <input type="time" id="date_init" name="init_date" placeholder="Ingrese la temática" class="input-form" required>
                <label for="date_init" class="label-form">Fecha de inicio</label>
            </div>
            <div class="group-form">
                <input type="time" id="date_end" name="end_date" placeholder="Ingrese la temática" class="input-form" required>
                <label for="date_end" class="label-form">Fecha de fin</label>
            </div>
            <div class="group-form">
                <textarea rows="5" id="text" name="text" placeholder="Ingrese la temática" class="input-form" required></textarea>
                <label for="text" class="label-form">Texto</label>
            </div>
            <button class="submit-from" name="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php if ($_GET['p2'] === 'schedules-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM schedules WHERE sch_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc();
    ?>
                <form class="form-form" method="POST" action="../../php/admin/edit_schedules.php">
                    <h2 class="title-form">Editar horario de entrada</h2>
                    <input type="hidden" name="id" value="<?php echo $row['sch_id'] ?>">
                    <div class="group-form">
                        <input type="time" id="date_init" name="init_date" placeholder="Ingrese la temática" value="<?php echo $row['sch_date_init'] ?>" class="input-form" required>
                        <label for="date_init" class="label-form">Fecha de inicio</label>
                    </div>
                    <div class="group-form">
                        <input type="time" id="date_end" name="end_date" placeholder="Ingrese la temática" value="<?php echo $row['sch_date_end'] ?>" class="input-form" required>
                        <label for="date_end" class="label-form">Fecha de fin</label>
                    </div>
                    <div class="group-form">
                        <textarea rows="5" id="text" name="text" placeholder="Ingrese la temática" class="input-form" required><?php echo $row['sch_text'] ?></textarea>
                        <label for="text" class="label-form">Texto</label>
                    </div>
                    <button class="submit-from" name="submit">Editar</button>
                </form>
    <?php }
        }
    } ?>

</div>