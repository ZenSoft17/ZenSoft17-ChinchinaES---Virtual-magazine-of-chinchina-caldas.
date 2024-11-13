<?php

$fair_id = $_SESSION['fair_id'];

if (isset($_SESSION['error_calendar'])) {
    $error = $_SESSION['error_calendar'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_calendar']);
};

if (isset($_GET['cal_id'])) {
    $_SESSION['cal_id'] =  $_GET['cal_id'];
    header("Location: ./admin.php?p=fair&p2=calendar-days");
    exit;
}

?>

<div class="section-zone">

    <?php
    if ($_GET['p2'] === 'calendar') {
    ?>
        <h2 class="subtitle">Calendario de actividades</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM calendar_activities WHERE fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo $row['cal_id'] ?></td>
                                <td><a href="./admin.php?p=fair&p2=calendar&cal_id=<?php echo $row['cal_id'] ?>"><?php echo $row['cal_title'] ?></a></td>
                                <td>
                                    <a href="./admin.php?p=fair&p2=calendar-edit&id=<?php echo $row['cal_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table" loading="lazy"></a>
                                    <a href="../../php/admin/delete_calendar.php?id=<?php echo $row['cal_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" loading="lazy"></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }  ?>
                </tbody>
            </table>
        </div>
        <a href="./admin.php?p=fair&p2=calendar-add" class="add-table" aria-label="Agregar">+</a>
    <?php } ?>

    <?php
    if ($_GET['p2'] === 'calendar-add') {
    ?>
        <form class="form-form" method="POST" action="../../php/admin/add_calendar.php">
            <h2 class="title-form">Agregar Calendario</h2>
            <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">
            <div class="group-form">
                <input type="text" id="titulo" name="title" placeholder="Ingrese el título" class="input-form" required>
                <label for="titulo" class="label-form">Título</label>
            </div>
            <button class="submit-from" name="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php
    if ($_GET['p2'] === 'calendar-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM calendar_activities WHERE cal_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc();
    ?>
                <form class="form-form" method="POST" action="../../php/admin/edit_calendar.php">
                    <h2 class="title-form">Editar Calendario</h2>
                    <input type="hidden" name="id" value="<?php echo $row['cal_id'] ?>">
                    <div class="group-form">
                        <input type="text" id="titulo" name="title" value="<?php echo $row['cal_title'] ?>" placeholder="Ingrese el título" class="input-form" required>
                        <label for="titulo" class="label-form">Título</label>
                    </div>
                    <button class="submit-from" name="submit">Editar</button>
                </form>
    <?php }
        }
    } ?>

</div>