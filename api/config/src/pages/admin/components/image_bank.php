<?php

if (isset($_SESSION['error_image_bank'])) {
    $error = $_SESSION['error_image_bank'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_image_bank']);
}

?>

<div class="section-zone">
    <?php if ($_GET['p'] === 'image-bank') { ?>
        <h1 class="title">Banco de Imágenes</h1>
        <div class="container-elements-bank">
            <?php
            $sql = "SELECT * FROM image_bank";
            $query = mysqli_query($con, $sql);
            if ($query) {
                while ($row = mysqli_fetch_assoc($query)) {
            ?>
                    <div class="container-item-bank">
                        <img src="data:image/jpg;base64, <?php echo base64_encode($row['imb_image']); ?>" alt="Imagen" class="image-bank" loading="lazy">
                        <a href="./admin.php?p=image-bank-edit&id=<?php echo $row['imb_id'] ?>" class="button-edit">
                            <img class="image-png-bank" src="../../assets/img/edit.png" alt="Editar" loading="lazy">
                        </a>
                        <a href="../../php/admin/delete_image.php?id=<?php echo $row['imb_id'] ?>" class="button-delete">
                            <img class="image-png-bank" src="../../assets/img/delete.png" alt="Eliminar" loading="lazy">
                        </a>
                    </div>
            <?php }
            } ?>
        </div>
        <a href="./admin.php?p=image-bank-add" class="add-table">+</a>
    <?php } ?>

    <div class="container-form-zone">
        <?php if ($_GET['p'] === 'image-bank-add') { ?>
            <form class="form-form" action="../../php/admin/add_image.php" method="POST" enctype="multipart/form-data">
                <h2 class="title-form">Agregar Imagen</h2>

                <div class="group-form">
                    <input type="file" id="image" name="image" class="input-form" required>
                    <label for="image" class="label-form">Imagen</label>
                </div>

                <button type="submit" class="submit-from" name="submit">Agregar</button>
            </form>
        <?php } ?>

        <?php if ($_GET['p'] === 'image-bank-edit') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM image_bank WHERE imb_id = '$id'";
                $query = mysqli_query($con, $sql);
                if ($query) {
                    $row = $query->fetch_assoc();
        ?>
                    <form class="form-form" action="../../php/admin/edit_image.php" method="POST" enctype="multipart/form-data">
                        <h2 class="title-form">Editar Imagen</h2>

                        <input type="hidden" value="<?php echo $row['imb_id'] ?>" name="id">

                        <div class="group-form">
                            <input type="file" id="image" name="image" class="input-form" required>
                            <label for="image" class="label-form">Imagen</label>
                        </div>

                        <button type="submit" class="submit-from" name="submit">Editar</button>
                    </form>
        <?php }
            }
        } ?>
    </div>
</div>