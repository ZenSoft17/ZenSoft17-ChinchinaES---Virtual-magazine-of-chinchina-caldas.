<?php
if (isset($_SESSION['pub_id'])) {
    $pub_id = $_SESSION['pub_id'];
?>
    <div class="section-zone">
        <form class="form-form" method="post" action="../../php/layout/add_image.php" enctype="multipart/form-data">
            <h2 class="title-form">Agregar Imagen</h2>

            <input type="hidden" name="pub_id" value="<?php echo $pub_id ?>">
            <div class="group-form">
                <input type="file" name="image" id="image" class="input-form" required accept="image/*">
                <label for="image" class="label-form">Imagen</label>
            </div>

            <button type="submit" class="submit-from" name="submit">Agregar</button>
        </form>
    </div>
<?php } ?>