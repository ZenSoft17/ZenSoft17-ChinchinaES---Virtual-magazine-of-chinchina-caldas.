<?php
if (isset($_SESSION['pub_id'])) {
    $pub_id = $_SESSION['pub_id'];
?>
    <div class="section-zone">
        <form class="form-form" method="post" action="../../php/layout/add_hr.php">
            <h2 class="title-form">Agregar Línea Horizontal</h2>

            <input type="hidden" name="pub_id" value="<?php echo $pub_id ?>">
            <div class="group-form">
                <select class="input-form" name="hr" id="hr">
                    <option value="6">hr</option>
                </select>
                <label for="hr" class="label-form">Línea Horizontal</label>
            </div>

            <button type="submit" class="submit-from" name="submit">Agregar</button>
        </form>
    </div>
<?php } ?>
