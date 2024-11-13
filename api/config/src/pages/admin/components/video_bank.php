<?php


if (isset($_SESSION['error_video_bank'])) {
    $error = $_SESSION['error_video_bank'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_video_bank']);
}

?>

<div class="section-zone">
    <?php if ($_GET['p'] === 'video-bank') { ?>
        <h1 class="title">Banco de Videos</h1>
        <div class="container-elements-bank">
            <?php
            $sql = "SELECT * FROM video_bank";
            $query = mysqli_query($con, $sql);

            if ($query) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $videoBase64 = $row['vib_video'];
            ?>
                    <div class="container-item-bank">
                        <video controls class="image-bank" loading="lazy">
                            <source src="data:video/mp4;base64,<?php echo $videoBase64; ?>" type="video/mp4" alt="Video de ejemplo">
                        </video>
                        <a href="./admin.php?p=video-bank-edit&id=<?php echo $row['vib_id']; ?>" class="button-edit">
                            <img class="image-png-bank" src="../../assets/img/edit.png" alt="Editar" loading="lazy">
                        </a>
                        <a href="../../php/admin/delete_video.php?id=<?php echo $row['vib_id']; ?>" class="button-delete">
                            <img class="image-png-bank" src="../../assets/img/delete.png" alt="Eliminar" loading="lazy">
                        </a>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <a href="./admin.php?p=video-bank-add" class="add-table">+</a>
    <?php } ?>

    <div class="container-form-zone">
        <?php if ($_GET['p'] === 'video-bank-add') { ?>
            <form class="form-form" action="../../php/admin/add_video.php" method="POST" enctype="multipart/form-data">
                <h2 class="title-form">Agregar Video</h2>

                <div class="group-form">
                    <input type="file" id="video" name="video" class="input-form" accept="video/*" required>
                    <label for="video" class="label-form">Video</label>
                </div>

                <button type="submit" class="submit-from" name="submit">Agregar</button>
            </form>
        <?php } ?>

        <?php if ($_GET['p'] === 'video-bank-edit') {
            if (isset($_GET['id'])) {

        ?>
                <form class="form-form" action="../../php/admin/edit_video.php" method="POST" enctype="multipart/form-data">
                    <h2 class="title-form">Editar Video</h2>

                    <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">

                    <div class="group-form">
                        <input type="file" id="video" name="video" class="input-form" accept="video/*" required>
                        <label for="video" class="label-form">Video</label>
                    </div>

                    <button type="submit" class="submit-from" name="submit">Editar</button>
                </form>
        <?php }
        } ?>
    </div>
</div>