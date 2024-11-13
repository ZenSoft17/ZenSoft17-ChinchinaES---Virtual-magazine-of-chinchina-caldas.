<?php
if (isset($_SESSION['pub_id'])) {
    $pub_id = $_SESSION['pub_id'];
?>
    <div class="section-zone">
        <form class="form-form" method="post" action="../../php/layout/add_title.php">
            <h2 class="title-form">Agregar Título</h2>

            <input type="hidden" name="pub_id" value="<?php echo $pub_id ?>">
            <div class="group-form">
                <input type="text" name="title" id="title" placeholder="Ingrese el título" class="input-form" required maxlength="255">
                <label for="title" class="label-form">Título</label>
            </div>

            <button type="submit" class="submit-from" name="submit">Agregar</button>
        </form>
    </div>
<?php } ?>