<?php

if (isset($_SESSION['error_fair'])) {
    $error = $_SESSION['error_fair'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_fair']);
}

?>

<?php
if (!isset($_GET['p2'])) {
?>
    <div class="section-zone">

        <?php
        if ($_GET['p'] === 'fair') {
        ?>
            <h2 class="subtitle">Ferias</h2>
            <div class="container-table">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Vista</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql  = "SELECT * FROM fair INNER JOIN view_ ON fair.vie_id = view_.vie_id";
                        $query = mysqli_query($con, $sql);
                        if ($query) {
                            while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['fai_id'] ?></td>
                                    <td><a href="./admin.php?p=fair&p2=introduction&fair_id=<?php echo $row['fai_id'] ?>"><?php echo $row['fai_fair'] ?></a></td>
                                    <td><?php echo $row['vie_view'] ?></td>
                                    <td>
                                        <a href="./admin.php?p=fair-edit&id=<?php echo $row['fai_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table" loading="lazy"></a>
                                        <a href="../../php/admin/delete_fair.php?id=<?php echo $row['fai_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" loading="lazy"></a>
                                    </td>
                                </tr>
                        <?php                           }
                        } ?>
                    </tbody>
                </table>
            </div>
            <a href="./admin.php?p=fair-add" class="add-table" aria-label="Agregar nueva feria">+</a>
        <?php
        }  ?>

        <?php
        if ($_GET['p'] === 'fair-add') {
        ?>
            <form class="form-form" method="post" action="../../php/admin/add_fair.php" enctype="multipart/form-data">
                <h2 class="title-form">Agregar Feria</h2>

                <div class="group-form">
                    <input type="text" id="fair_name" name="fair-name" placeholder="Nombre de la feria" class="input-form" required>
                    <label for="fair_name" class="label-form">Feria</label>
                </div>

                <div class="group-form">
                    <select name="fair-view" class="input-form" id="fair_view" required>
                        <option value="1">Sí</option>
                        <option value="2">No</option>
                    </select>
                    <label for="fair_view" class="label-form">Vista</label>
                </div>

                <button class="submit-from" type="submit" name="submit">Agregar</button>
            </form>
        <?php
        }  ?>

        <?php
        if ($_GET['p'] === 'fair-edit') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM fair INNER JOIN view_ ON fair.vie_id = view_.vie_id WHERE fai_id = '$id'";
                $query = mysqli_query($con, $sql);
                if ($query) {
                    $row = $query->fetch_assoc();
        ?>
                    <form class="form-form" method="post" action="../../php/admin/edit_fair.php" enctype="multipart/form-data">
                        <h2 class="title-form">Editar Feria</h2>

                        <input type="hidden" name="id" value="<?php echo $row['fai_id'] ?>">

                        <div class="group-form">
                            <input type="text" id="fair_name_edit" name="fair-name" value="<?php echo $row['fai_fair'] ?>" placeholder="Nombre de la feria" class="input-form" required>
                            <label for="fair_name_edit" class="label-form">Feria</label>
                        </div>

                        <div class="group-form">
                            <select name="fair-view" class="input-form" id="fair_view_edit" required>
                                <option value="<?php echo $row['vie_id'] ?>"><?php echo $row['vie_view'] ?></option>
                                <option value="1">Sí</option>
                                <option value="2">No</option>
                            </select>
                            <label for="fair_view_edit" class="label-form">Vista</label>
                        </div>

                        <button class="submit-from" type="submit" name="submit">Editar</button>
                    </form>
        <?php            }
            }
        }  ?>

    </div>
<?php
}
if (isset($_GET['p2'])) {
    include("./components/utils/fair.php");
}
?>