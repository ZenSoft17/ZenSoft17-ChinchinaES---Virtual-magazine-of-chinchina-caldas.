<?php

if (isset($_SESSION['error_hashtag'])) {
    $error = $_SESSION['error_hashtag'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_hashtag']);
}

?>
<div class="section-zone">
    <?php if ($_GET['p'] === 'hashtag') { ?>
        <h1 class="title">Hashtags</h1>
        <div class="container-table">
            <table>
                <tr>
                    <th>id</th>
                    <th>Hastag</th>
                    <th>Acciones</th>
                </tr>
                <?php
                $sql = "SELECT * FROM hashtags";
                $query = mysqli_query($con, $sql);
                if ($query) {
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>
                        <tr>
                            <td><?php echo $row['has_id'] ?></td>
                            <td><?php echo $row['has_hashtag'] ?></td>
                            <td>
                                <a href="./admin.php?p=hashtag-edit&id=<?php echo $row['has_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table" loading="lazy"></a>
                                <a href="../../php/admin/delete_hashtag.php?id=<?php echo $row['has_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" loading="lazy"></a>
                            </td>
                        </tr>
                <?php
                    }
                } ?>
            </table>
        </div>
        <a href="./admin.php?p=hashtag-add" class="add-table">+</a>
    <?php } ?>

    <div class="container-form-zone">
        <?php if ($_GET['p'] === 'hashtag-add') { ?>
            <form class="form-form" action="../../php/admin/add_hashtag.php" method="POST">
                <h2 class="title-form">Agregar Hastag</h2>

                <div class="group-form">
                    <input type="text" id="hashtag" name="hashtag" placeholder="" class="input-form" required>
                    <label for="hashtag" class="label-form">Hastag</label>
                </div>

                <button type="submit" class="submit-from" name="submit">Agregar</button>
            </form>
        <?php } ?>

        <?php if ($_GET['p'] === 'hashtag-edit') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM hashtags WHERE has_id = '$id'";
                $query = mysqli_query($con, $sql);
                if ($query) {
                    $row = $query->fetch_assoc();
        ?>
                    <form class="form-form" action="../../php/admin/edit_hashtag.php" method="POST">
                        <h2 class="title-form">Editar Hastag</h2>

                        <input type="hidden" value="<?php echo $row['has_id'] ?>" name="id">

                        <div class="group-form">
                            <input type="text" id="hashtag" name="hashtag" value="<?php echo $row['has_hashtag'] ?>" class="input-form" required>
                            <label for="hashtag" class="label-form">Hastag</label>
                        </div>

                        <button type="submit" class="submit-from" name="submit">Editar</button>
                    </form>
        <?php }
            }
        } ?>
    </div>
</div>