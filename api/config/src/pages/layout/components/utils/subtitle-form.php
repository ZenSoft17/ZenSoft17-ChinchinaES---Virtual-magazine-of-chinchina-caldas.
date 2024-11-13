<?php
if (isset($_SESSION['pub_id'])) {
    $pub_id = $_SESSION['pub_id'];
?>
    <div class="section-zone">
        <form class="form-form" method="post" action="../../php/layout/add_subtitle.php">
            <h2 class="title-form">Agregar Subtítulo</h2>

            <input type="hidden" name="pub_id" value="<?php echo $pub_id ?>">
            <div class="group-form">
                <input type="text" name="subtitle" id="subtitle" placeholder="Ingrese el subtítulo" class="input-form" required maxlength="255">
                <label for="subtitle" class="label-form">Subtítulo</label>
            </div>

            <button type="submit" class="submit-from" name="submit">Agregar</button>
        </form>
    </div>
<?php } ?>
