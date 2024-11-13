<?php
if (isset($_SESSION['pub_id'])) {
    $pub_id = $_SESSION['pub_id'];
?>
    <div class="section-zone">
        <form class="form-form" method="post" action="../../php/layout/add_text.php">
            <h2 class="title-form">Agregar Texto</h2>

            <input type="hidden" name="pub_id" value="<?php echo $pub_id ?>">
            <div class="group-form">
                <textarea name="text" id="text" placeholder="Ingrese el texto" class="input-form" required maxlength="5000"></textarea>
                <label for="text" class="label-form">Texto</label>
            </div>

            <button type="submit" class="submit-from" name="submit">Agregar</button>
        </form>
    </div>
<?php } ?>