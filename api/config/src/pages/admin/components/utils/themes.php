<?php

$fair_id = $_SESSION['fair_id'];

if (isset($_SESSION['error_themes'])) {
    $error = $_SESSION['error_themes'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_themes']);
};

?>


<div class="section-zone">

    <?php if ($_GET['p2'] === 'themes') { ?>
        <h2 class="subtitle">Temáticas</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Temática</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM themes WHERE fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo $row['the_id'] ?></td>
                                <td><?php echo $row['the_theme'] ?></td>
                                <td>
                                    <a href="./admin.php?p=fair&p2=themes-edit&id=<?php echo $row['the_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table"></a>
                                    <a href="../../php/admin/delete_themes.php?id=<?php echo $row['the_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table"></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }  ?>
                </tbody>
            </table>
        </div>
        <a href="./admin.php?p=fair&p2=themes-add" class="add-table" aria-label="Agregar">+</a>
    <?php } ?>

    <?php if ($_GET['p2'] === 'themes-add') { ?>
        <form class="form-form" method="POST" action="../../php/admin/add_themes.php">
            <h2 class="title-form">Agregar Temática</h2>
            <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">
            <div class="group-form">
                <input type="text" id="tematica" name="theme" placeholder="Ingrese la temática" class="input-form" required>
                <label for="tematica" class="label-form">Temática</label>
            </div>
            <button class="submit-from" name="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php if ($_GET['p2'] === 'themes-edit') { 
         if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM themes WHERE the_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc();
        ?>
        <form class="form-form" method="POST" action="../../php/admin/edit_themes.php">
            <h2 class="title-form">Editar Temática</h2>
            <input type="hidden" name="id" value="<?php echo $row['the_id'] ?>">
            <div class="group-form">
                <input type="text" id="tematica" name="theme" value="<?php echo $row['the_theme'] ?>" placeholder="Ingrese la temática" class="input-form" required>
                <label for="tematica" class="label-form">Temática</label>
            </div>
            <button class="submit-from" name="submit">Editar</button>
        </form>
    <?php }}} ?>

</div>