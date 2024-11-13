<?php

$fair_id = $_SESSION['fair_id'];

if (isset($_SESSION['error_event'])) {
    $error = $_SESSION['error_event'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_event']);
};

?>

<div class="section-zone">

    <?php if ($_GET['p2'] === 'event'): ?>
        <h2 class="subtitle">Evento Información</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Fecha</th>
                        <th>Directo</th>
                        <th>Vista</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM event_dfc INNER JOIN view_ ON event_dfc.vie_id = view_.vie_id WHERE event_dfc.fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query && $row = $query->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['eve_id'] ?></td>
                            <td><?php echo $row['eve_title'] ?></td>
                            <td><?php echo $row['eve_date'] ?></td>
                            <td><?php echo $row['eve_live'] ?></td>
                            <td><?php echo $row['vie_view'] ?></td>
                            <td>
                                <a href="./admin.php?p=fair&p2=event-edit&id=<?php echo $row['eve_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table"></a>
                                <a href="../../php/admin/delete_event.php?&id=<?php echo $row['eve_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table"></a>
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
        <a href="./admin.php?p=fair&p2=event-add" class="add-table">+</a>
    <?php endif; ?>

    <?php if ($_GET['p2'] === 'event-add'): ?>
        <form class="form-form" method="post" action="../../php/admin/add_event.php" enctype="multipart/form-data">
            <h2 class="title-form">Agregar Información</h2>
            <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">
            <div class="group-form">
                <input type="text" name="title" placeholder="Título" class="input-form" required>
                <label for="title" class="label-form">Título</label>
            </div>
            <div class="group-form">
                <input type="datetime-local" name="date" placeholder="Fecha" class="input-form" required>
                <label for="date" class="label-form">Fecha</label>
            </div>
            <div class="group-form">
                <textarea name="direct" class="input-form" id="direct" placeholder="Directo" required></textarea>
                <label for="direct" class="label-form">Directo</label>
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
    <?php endif; ?>

    <?php if ($_GET['p2'] === 'event-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM event_dfc INNER JOIN view_ ON event_dfc.vie_id = view_.vie_id WHERE eve_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc();
    ?>
                <form class="form-form" method="post" action="../../php/admin/edit_event.php" enctype="multipart/form-data">
                    <h2 class="title-form">Editar Información</h2>
                    <input type="hidden" name="id" value="<?php echo $row['eve_id'] ?>">
                    <div class="group-form">
                        <input type="text" name="title" placeholder="Título" value="<?php echo $row['eve_title'] ?>" class="input-form" required>
                        <label for="title" class="label-form">Título</label>
                    </div>
                    <div class="group-form">
                        <input type="datetime-local" name="date" placeholder="Fecha" value="<?php echo $row['eve_date']; ?>" class="input-form" required>
                        <label for="date" class="label-form">Fecha</label>
                    </div>
                    <div class="group-form">
                        <textarea name="direct" class="input-form" id="direct" placeholder="Directo" required><?php echo $row['eve_live'] ?></textarea>
                        <label for="direct" class="label-form">Directo</label>
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
    }; ?>
</div>