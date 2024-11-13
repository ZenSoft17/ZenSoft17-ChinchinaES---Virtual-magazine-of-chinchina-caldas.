<?php
if (isset($_SESSION['pub_id'])) {
    $pub_id = $_SESSION['pub_id'];
?>
    <div class="section-zone">
        <form class="form-form" method="post" action="../../php/layout/add_video.php" enctype="multipart/form-data">
            <h2 class="title-form">Agregar Video</h2>

            <input type="hidden" name="pub_id" value="<?php echo $pub_id ?>">
            <div class="group-form">
                <input type="file" name="video" id="video" class="input-form" required accept="video/*">
                <label for="video" class="label-form">Video</label>
            </div>

            <button type="submit" class="submit-from" name="submit">Agregar</button>
        </form>
    </div>
<?php } ?>
