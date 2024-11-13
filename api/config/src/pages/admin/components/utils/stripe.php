<?php

$fair_id = $_SESSION['fair_id'];

if (isset($_SESSION['error_stripe'])) {
    $error = $_SESSION['error_stripe'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_stripe']);
};

?>


<div class="section-zone">
    <?php if ($_GET['p2'] === 'stripe') { ?>
        <h2 class="subtitle">Franja Información</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Directo</th>
                        <th>Vista</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM stripe_dfc INNER JOIN view_ ON stripe_dfc.vie_id = view_.vie_id WHERE stripe_dfc.fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query && $row = $query->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['stp_id'] ?></td>
                            <td><?php echo $row['stp_title'] ?></td>
                            <td><?php echo $row['stp_description'] ?></td>
                            <td><?php echo $row['stp_live'] ?></td>
                            <td><?php echo $row['vie_view'] ?></td>
                            <td>
                                <a href="./admin.php?p=fair&p2=stripe-edit&id=<?php echo $row['stp_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table"></a>
                                <a href="../../php/admin/delete_stripe.php?id=<?php echo $row['stp_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table"></a>
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
        <a href="./admin.php?p=fair&p2=stripe-add" class="add-table" aria-label="Agregar">+</a>
    <?php } ?>

    <?php if ($_GET['p2'] === 'stripe-add') { ?>
        <form class="form-form" method="POST" action="../../php/admin/add_stripe.php" enctype="multipart/form-data">
            <h2 class="title-form">Agregar Información (Franja Digital)</h2>
            <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">
            <div class="group-form">
                <input type="text" id="titulo" name="title" placeholder="Ingrese el título" class="input-form" required>
                <label for="titulo" class="label-form">Título</label>
            </div>
            <div class="group-form">
                <textarea name="description" rows="4" id="descripcion" class="input-form" placeholder="Ingrese la descripción" required></textarea>
                <label for="descripcion" class="label-form">Descripción</label>
            </div>
            <div class="group-form">
                <input type="url" id="directo" name="direct" placeholder="Ingrese el enlace directo" class="input-form" required>
                <label for="directo" class="label-form">Directo</label>
            </div>
            <div class="group-form">
                <select name="view" class="input-form" id="vista" required>
                    <option value="1">Sí</option>
                    <option value="2">No</option>
                </select>
                <label for="vista" class="label-form">Vista</label>
            </div>
            <button class="submit-from" name="submit" type="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php if ($_GET['p2'] === 'stripe-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM stripe_dfc INNER JOIN view_ ON stripe_dfc.vie_id = view_.vie_id WHERE stp_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc();
    ?>
                <form class="form-form" method="POST" action="../../php/admin/edit_stripe.php" enctype="multipart/form-data">
                    <h2 class="title-form">Editar Información (Franja Digital)</h2>

                    <input type="hidden" name="id" value="<?php echo $row['stp_id'] ?>">

                    <div class="group-form">
                        <input type="text" id="titulo" name="title" value="<?php echo $row['stp_title'] ?>" placeholder="Ingrese el título" class="input-form" required>
                        <label for="titulo" class="label-form">Título</label>
                    </div>
                    <div class="group-form">
                        <textarea name="description" rows="4" id="descripcion" class="input-form" placeholder="Ingrese la descripción" required><?php echo $row['stp_description'] ?></textarea>
                        <label for="descripcion" class="label-form">Descripción</label>
                    </div>
                    <div class="group-form">
                        <input type="url" id="directo" name="direct" value="<?php echo $row['stp_live'] ?>" placeholder="Ingrese el enlace directo" class="input-form" required>
                        <label for="directo" class="label-form">Directo</label>
                    </div>
                    <div class="group-form">
                        <select name="view" class="input-form" id="vista" required>
                            <option value="<?php echo $row['vie_id'] ?>"><?php echo $row['vie_view'] ?></option>
                            <option value="1">Sí</option>
                            <option value="2">No</option>
                        </select>
                        <label for="vista" class="label-form">Vista</label>
                    </div>
                    <button class="submit-from" type="submit" name="submit">Editar</button>
                </form>
    <?php }
        }
    } ?>
</div>

<div class="section-zone">
    <?php if ($_GET['p2'] === 'stripe') { ?>
        <h2 class="subtitle">Horarios de Transmisión</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hora de Inicio</th>
                        <th>Hora de Finalización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM cast_time WHERE fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query && $row = $query->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['cas_id'] ?></td>
                            <td><?php echo $row['cas_hour_init'] ?></td>
                            <td><?php echo $row['cas_hour_end'] ?></td>
                            <td>
                                <a href="./admin.php?p=fair&p2=stripe-schedules-edit&id=<?php echo $row['cas_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table"></a>
                                <a href="../../php/admin/delete_hours.php?id=<?php echo $row['cas_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table"></a>
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
        <a href="./admin.php?p=fair&p2=stripe-schedules-add" class="add-table" aria-label="Agregar">+</a>
    <?php } ?>

    <?php if ($_GET['p2'] === 'stripe-schedules-add') { ?>
        <form class="form-form" method="POST" action="../../php/admin/add_hours.php">
            <h2 class="title-form">Agregar Horarios (Franja Digital)</h2>
            <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">
            <div class="group-form">
                <input type="time" id="inicio" name="init" class="input-form" required>
                <label for="inicio" class="label-form">Horario de Inicio</label>
            </div>
            <div class="group-form">
                <input type="time" id="fin" name="end" class="input-form" required>
                <label for="fin" class="label-form">Horario de Fin</label>
            </div>
            <button class="submit-from" type="submit" name="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php if ($_GET['p2'] === 'stripe-schedules-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM cast_time WHERE cas_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc(); ?>
                <form class="form-form" method="POST" action="../../php/admin/edit_hours.php">
                    <h2 class="title-form">Editar Horarios (Franja Digital)</h2>
                    <input type="hidden" name="id" value="<?php echo $row['cas_id'] ?>">
                    <div class="group-form">
                        <input type="time" id="inicio" name="init" value="<?php echo $row['cas_hour_init'] ?>" class="input-form" required>
                        <label for="inicio" class="label-form">Horario de Inicio</label>
                    </div>
                    <div class="group-form">
                        <input type="time" id="fin" name="end" value="<?php echo $row['cas_hour_end'] ?>" class="input-form" required>
                        <label for="fin" class="label-form">Horario de Fin</label>
                    </div>
                    <button class="submit-from" type="submit" name="submit">Editar</button>
                </form>
    <?php }
        }
    } ?>
</div>

<div class="section-zone">
    <?php if ($_GET['p2'] === 'stripe') { ?>
        <h2 class="subtitle">Invitado para el Evento</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Modalidad</th>
                        <th>Nombre</th>
                        <th>Profesión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM invited INNER JOIN modalities ON invited.mod_id = modalities.mod_id WHERE invited.fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query && $row = $query->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['inv_id'] ?></td>
                            <td><?php echo $row['mod_modality'] ?></td>
                            <td><?php echo $row['inv_name'] ?></td>
                            <td><?php echo $row['inv_profession'] ?></td>
                            <td>
                                <a href="./admin.php?p=fair&p2=stripe-invited-edit&id=<?php echo $row['inv_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table"></a>
                                <a href="../../php/admin/delete_invited.php?id=<?php echo $row['inv_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table"></a>
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
        <a href="./admin.php?p=fair&p2=stripe-invited-add" class="add-table" aria-label="Agregar">+</a>
    <?php } ?>

    <?php if ($_GET['p2'] === 'stripe-invited-add') { ?>
        <form class="form-form" method="POST" action="../../php/admin/add_invited.php">
            <h2 class="title-form">Agregar Invitado (Franja Digital)</h2>
            <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">
            <div class="group-form">
                <select name="modality" class="input-form" id="modalidad" required>
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
                <label for="modalidad" class="label-form">Modalidad</label>
            </div>
            <div class="group-form">
                <input type="text" id="nombre" name="name" placeholder="Ingrese el nombre" class="input-form" required>
                <label for="nombre" class="label-form">Nombre</label>
            </div>
            <div class="group-form">
                <input type="text" id="profesion" name="profession" placeholder="Ingrese la profesión" class="input-form" required>
                <label for="profesion" class="label-form">Profesión</label>
            </div>
            <button class="submit-from" type="submit" name="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php if ($_GET['p2'] === 'stripe-invited-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM invited 
            INNER JOIN modalities ON invited.mod_id = modalities.mod_id WHERE inv_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc();
    ?>
                <form class="form-form" method="POST" action="../../php/admin/edit_invited.php">
                    <h2 class="title-form">Editar Invitado (Franja Digital)</h2>
                    <input type="hidden" name="id" value="<?php echo $row['inv_id'] ?>">
                    <div class="group-form">
                        <select name="modality" class="input-form" id="modalidad" required>
                        <option value="<?php echo $row['mod_id'] ?>"><?php echo $row['mod_modality'] ?></option>
                            <?php
                            $sql_select = "SELECT * FROM modalities WHERE fai_id = '$fair_id'";
                            $query_select = mysqli_query($con, $sql_select);
                            if ($query_select) {
                                while ($row_select = mysqli_fetch_assoc($query_select)) {
                            ?>
                                    <option value="<?php echo $row_select['mod_id'] ?>"><?php echo $row_select['mod_modality'] ?></option>
                            <?php }
                            } ?>
                        </select>
                        <label for="modalidad" class="label-form">Modalidad</label>
                    </div>
                    <div class="group-form">
                        <input type="text" id="nombre" name="name" value="<?php echo $row['inv_name'] ?>" placeholder="Ingrese el nombre" class="input-form" required>
                        <label for="nombre" class="label-form">Nombre</label>
                    </div>
                    <div class="group-form">
                        <input type="text" id="profesion" name="profession" value="<?php echo $row['inv_profession'] ?>" placeholder="Ingrese la profesión" class="input-form" required>
                        <label for="profesion" class="label-form">Profesión</label>
                    </div>
                    <button class="submit-from" type="submit" name="submit">Editar</button>
                </form>
    <?php }
        }
    } ?>
</div>