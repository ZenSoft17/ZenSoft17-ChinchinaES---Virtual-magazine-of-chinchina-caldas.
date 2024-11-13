<div class="section-zone">
    <div class="container-form-zone">
        <form class="form-form" method="post" action="../../php/layout/add_publication.php" enctype="multipart/form-data">
            <h2 class="title-form">Agregar Publicación</h2>
            <input type="hidden" name="user_id" value="<?php echo $user ?>">

            <div class="group-form">
                <input type="text" id="title" name="title" placeholder="Ingrese el título" class="input-form" required maxlength="255">
                <label for="title" class="label-form">Título</label>
            </div>

            <div class="group-form">
                <select name="category" class="input-form" id="category" required>
                    <?php
                    $sql = "SELECT * FROM categories";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <option value="<?php echo $row['cat_id'] ?>"><?php echo $row['cat_category'] ?></option>
                    <?php }
                    } ?>
                </select>
                <label for="category" class="label-form">Categoría</label>
            </div>

            <div class="group-form">
                <input type="text" id="category_other" name="category_other" placeholder="Otra categoría" class="input-form" maxlength="255">
                <label for="category_other" class="label-form">Categoría (otra)</label>
            </div>

            <div class="group-form">
                <input type="file" id="image" name="image" class="input-form" accept="image/*" required>
                <label for="image" class="label-form">Imagen</label>
            </div>

            <div class="group-form">
                <select name="view" class="input-form" id="view" required>
                    <option value="1">Sí</option>
                    <option value="2">No</option>
                </select>
                <label for="view" class="label-form">Vista</label>
            </div>

            <button type="submit" class="submit-from" name="submit">Agregar</button>
        </form>
    </div>
</div>
