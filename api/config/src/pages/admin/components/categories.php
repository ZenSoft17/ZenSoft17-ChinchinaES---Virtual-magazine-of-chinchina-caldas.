<?php


if (isset($_SESSION['error_categories'])) {
    $error = $_SESSION['error_categories'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_categories']);
}

?>
<div class="section-zone">

    <?php if ($_GET['p'] === 'category') { ?>
        <h2 class="subtitle">Categorías</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Categorías</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM categories INNER JOIN types ON categories.typ_id = types.typ_id WHERE categories.typ_id = '2'";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo $row['cat_id'] ?></td>
                                <td><?php echo $row['cat_category'] ?></td>
                                <td>
                                    <a href="./admin.php?p=category-edit&id=<?php echo $row['cat_id'] ?>" role="button">
                                        <img src="../../assets/img/edit.png" alt="Editar" class="image-table" loading="lazy">
                                    </a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <?php if ($_GET['p'] === 'category-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM categories WHERE cat_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc(); ?>
                <form class="form-form" action="../../php/admin/edit_categories.php" method="post" role="form">
                    <h2 class="title-form">Editar Categoría</h2>

                    <input type="hidden" name="id" value="<?php echo $row['cat_id'] ?>">

                    <div class="group-form">
                        <input type="text" id="category-name" name="category_name" value="<?php echo $row['cat_category'] ?>" placeholder="Ingrese el nombre de la categoría" class="input-form" required>
                        <label for="category-name" class="label-form">Categoría</label>
                    </div>

                    <button type="submit" class="submit-from" name="submit">Editar</button>
                </form>
    <?php }
        }
    } ?>
</div>