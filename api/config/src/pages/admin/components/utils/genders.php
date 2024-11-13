<?php

if (isset($_SESSION['error_genders'])) {
    $error = $_SESSION['error_genders'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_genders']);
};

?>

<?php if ($_GET['p2'] === 'genders') { ?>
    <!-- Genders -->
    <br />
    <h2 class="title">Generos</h2>
    <br />
    <div class="container-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Genero</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM gender";
                $query = mysqli_query($con, $sql);
                if ($query) {
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>
                        <tr>
                            <td><?php echo $row['gen_id'] ?></td>
                            <td><?php echo $row['gen_gender'] ?></td>
                            <td>
                                <a href="./admin.php?p=collection&p2=genders-edit&id=<?php echo $row['gen_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table" /></a>
                                <a href="../../php/admin/delete_gender.php?id=<?php echo $row['gen_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" /></a>
                            </td>
                        </tr>
                <?php                     }
                } ?>
            </tbody>
        </table>
    </div>
    <a href="./admin.php?p=collection&p2=genders-add" class="add-table" aria-label="Agregar">+</a>
    <!-- Gender  -->
<?php } ?>

<?php if ($_GET['p2'] === 'genders-add') { ?>
    <!-- Add genders  -->
    <form class="form-form" method="POST" action="../../php/admin/add_gender.php">
        <h2 class="title-form">Agregar Genero </h2>
        <div class="group-form">
            <input type="text" id="gender" name="gender" placeholder="Ingrese el genero" class="input-form" required>
            <label for="gender" class="label-form">Genero</label>
        </div>
        <button class="submit-from" name="submit">Agregar</button>
    </form>
    <!-- Add genders collection  -->
<?php } ?>

<?php if ($_GET['p2'] === 'genders-edit') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM gender WHERE gen_id = '$id'";
        $query = mysqli_query($con, $sql);
        if($query){
            $row = $query->fetch_assoc();
?>
        <!-- Edit genders collection  -->
        <form class="form-form" method="POST" action="../../php/admin/edit_gender.php">
            <h2 class="title-form">Editar Genero </h2>
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <div class="group-form">
                <input type="text" id="gender" name="gender" placeholder="Ingrese el genero" value="<?php echo $row['gen_gender'] ?>" class="input-form" required>
                <label for="gender" class="label-form">Genero</label>
            </div>
            <button class="submit-from" name="submit">Editar</button>
        </form>
        <!-- Edit genders collection  -->
<?php }}
} ?>