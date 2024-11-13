<?php

$fair_id = $_SESSION['fair_id'];

if (!isset($_SESSION['cal_id'])) {
    header("Location: ./admin.php?p=fair&p2=calendar");
}

$cal_id = $_SESSION['cal_id'];

if (isset($_SESSION['error_calendar'])) {
    $error = $_SESSION['error_calendar'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_calendar']);
}

?>

<div class="section-zone">

    <?php
    if ($_GET['p2'] === 'calendar-days') {
    ?>
        <h2 class="subtitle">Calendario de actividades (Días)</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Texto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM calendar_activities_days WHERE cal_id = '$cal_id' ";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo $row['cald_id'] ?></td>
                                <td><?php echo $row['cald_title'] ?></td>
                                <td><?php echo $row['cald_text'] ?></td>
                                <td>
                                    <a href="./admin.php?p=fair&p2=calendar-days-edit&cal_id=<?php echo $row['cald_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table" loading="lazy"></a>
                                    <a href="../../php/admin/delete_calendar_day.php?id=<?php echo $row['cald_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" loading="lazy"></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }  ?>
                </tbody>
            </table>
        </div>
        <a href="./admin.php?p=fair&p2=calendar-days-add" class="add-table" aria-label="Agregar">+</a>
    <?php } ?>

    <?php
    if ($_GET['p2'] === 'calendar-days-add') {
    ?>
        <form class="form-form" method="POST" action="../../php/admin/add_calendar_day.php">
            <h2 class="title-form">Agregar Día</h2>
            <input type="hidden" name="cal_id" value="<?php echo $cal_id ?>">
            <div class="group-form">
                <input type="text" id="titulo" name="title" placeholder="Ingrese el título" class="input-form" required>
                <label for="titulo" class="label-form">Título</label>
            </div>

            <div class="group-form">
                <input type="text" id="texto" name="text" placeholder="Ingrese el texto" class="input-form" required>
                <label for="texto" class="label-form">Texto</label>
            </div>

            <button class="submit-from" name="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php
    if ($_GET['p2'] === 'calendar-days-edit') {
        $cal_id = $_GET['cal_id'];
        $sql = "SELECT * FROM calendar_activities_days WHERE cald_id = '$cal_id'";
        $query = mysqli_query($con, $sql);
        if ($query) {
            $row = $query->fetch_assoc();
    ?>
            <form class="form-form" method="POST" action="../../php/admin/edit_calendar_day.php">
                <h2 class="title-form">Editar Día</h2>
                <input type="hidden" name="cal_id" value="<?php echo $row['cald_id'] ?>">
                <div class="group-form">
                    <input type="text" id="titulo" name="title" value="<?php echo $row['cald_title'] ?>" placeholder="Ingrese el título" class="input-form" required>
                    <label for="titulo" class="label-form">Título</label>
                </div>

                <div class="group-form">
                    <input type="text" id="texto" name="text" value="<?php echo $row['cald_text'] ?>" placeholder="Ingrese el texto" class="input-form" required>
                    <label for="texto" class="label-form">Texto</label>
                </div>

                <button class="submit-from" name="submit">Editar</button>
            </form>
    <?php }
    } ?>

</div>