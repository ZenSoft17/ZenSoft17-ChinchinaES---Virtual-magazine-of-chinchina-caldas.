<?php

if (isset($_SESSION['error_collection'])) {
    $error = $_SESSION['error_collection'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_collection']);
};

?>


<?php if ($_GET['p2'] === 'collection') { ?>
    <!-- collection -->
    <h1 class="title">Coleccion de corposer</h1>
    <br />
    <a href="./admin.php?p=collection&p2=collection-add" class="add-table" aria-label="Agregar nueva feria">+</a>
    <div class="container-nav-colletion">
        <form action="" method="post" class="container-search">
            <input type="text" name="search" class="input-search" id="" placeholder="buscar..." />
            <button type="submit" class="submit-search">
                <img
                    src="../../assets/img/search.png"
                    class="image-search"
                    alt="" />
            </button>
        </form>
        <form action="" method="post" class="form-select-gender">
            <select name="filter-gender" id="" class="select-gender">
                <?php
                $sql_gender = "SELECT * FROM gender";
                $query_gender = mysqli_query($con, $sql_gender);
                if ($query_gender) {
                    while ($row = mysqli_fetch_assoc($query_gender)) {
                ?>
                        <option value="<?php echo $row['gen_id'] ?>"><?php echo $row['gen_gender'] ?></option>
                <?php       }
                } ?>
            </select>
            <button type="submit" class="submit-gender">Filtrar</button>
        </form>
    </div>
    <br>
    <div class="content-colletion">
        <?php
        if (isset($_POST['search'])) {
            $search_data = $_POST['search'];
            $search =  '%' . $search_data . '%';
            $sql_collection_search = "SELECT * FROM collection WHERE (col_title LIKE '$search' OR col_year LIKE '$search' OR col_author LIKE '$search' OR col_synopsis LIKE '$search')";
            $query_collection_search = mysqli_query($con, $sql_collection_search);
            if ($query_collection_search) {
                while ($row_collection_search = mysqli_fetch_assoc($query_collection_search)) {
        ?>
                    <div class="container-element">
                        <a href="./admin.php?p=collection&p2=collection-edit&id=<?php echo $row_collection_search['col_id'] ?>" class="edit-element-colletion"><img
                                src="../../assets/img/edit.png"
                                class="image-colletion"
                                alt="" /></a>
                        <a href="?id=<?php echo $row_collection_search['col_id'] ?>" class="delete-element-colletion"><img src="../../assets/img/delete.png" class="image-colletion" alt="" /></a>
                        <a href="./admin.php?p=collection&p2=collection-select-gender?collection=<?php echo $row_collection_search['col_id'] ?>" class="book-element-colletion"><img src="../../assets/img/book.png" class="image-colletion" alt="" /></a>
                        <img src="data:image/jpg;base64, <?php echo base64_encode($row_collection_search['col_front']); ?>" class="image-element-colletion" alt="" />
                        <div class="container-shadow"></div>
                    </div>
                    <?php
                }
            }
        } else if (isset($_POST['filter-gender'])) {
            $filter = $_POST['filter-gender'];
            $sql_collection_gender = "SELECT * FROM collection_genders WHERE gen_id = '$filter'";
            $query_collection_gender = mysqli_query($con, $sql);
            if ($query_collection_gender) {
                while ($row_collection_gender = mysqli_fetch_assoc($query_collection_gender)) {
                    $collection_filter = $row_collection_gender['col_id'];
                    $sql_collection = "SELECT * FROM collection WHERE col_id = '$collection_filter'";
                    $query_collection = mysqli_query($con, $sql);
                    if ($query_collection) {
                        while ($row_collection = mysqli_fetch_assoc($query_collection)) {
                    ?>
                            <div class="container-element">
                                <a href="./admin.php?p=collection&p2=collection-edit&id=<?php echo $row_collection['col_id'] ?>" class="edit-element-colletion"><img
                                        src="../../assets/img/edit.png"
                                        class="image-colletion"
                                        alt="" /></a>
                                <a href="?id=<?php echo $row_collection['col_id'] ?>" class="delete-element-colletion"><img src="../../assets/img/delete.png" class="image-colletion" alt="" /></a>
                                <a href="./admin.php?p=collection&p2=collection-select-gender?collection=<?php echo $row_collection['col_id'] ?>" class="book-element-colletion"><img src="../../assets/img/book.png" class="image-colletion" alt="" /></a>
                                <img src="data:image/jpg;base64, <?php echo base64_encode($row_collection['col_front']); ?>" class="image-element-colletion" alt="" />
                                <div class="container-shadow"></div>
                            </div>
                    <?php
                        }
                    }
                }
            }
        } else {
            $sql = "SELECT * FROM collection";
            $query = mysqli_query($con, $sql);
            if ($query) {
                while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <div class="container-element">
                        <a href="./admin.php?p=collection&p2=collection-edit&id=<?php echo $row['col_id'] ?>" class="edit-element-colletion"><img
                                src="../../assets/img/edit.png"
                                class="image-colletion"
                                alt="" /></a>
                        <a href="?id=<?php echo $row['col_id'] ?>" class="delete-element-colletion"><img src="../../assets/img/delete.png" class="image-colletion" alt="" /></a>
                        <a href="./admin.php?p=collection&p2=collection-select-gender?collection=<?php echo $row['col_id'] ?>" class="book-element-colletion"><img src="../../assets/img/book.png" class="image-colletion" alt="" /></a>
                        <img src="data:image/jpg;base64, <?php echo base64_encode($row['col_front']); ?>" class="image-element-colletion" alt="" />
                        <div class="container-shadow"></div>
                    </div>
        <?php             }
            }
        } ?>
    </div>
    <!-- collection -->
<?php } ?>

<?php if ($_GET['p2'] === 'collection-add') { ?>
    <!-- add collection -->
    <form class="form-form" action="../../php/admin/add_collection.php" method="POST" enctype="multipart/form-data">
        <h2 class="title-form">Agregar coleccion</h2>

        <div class="group-form">
            <input type="text" id="title" name="title" placeholder="Ingrese el titulo" class="input-form" required />
            <label for="title" class="label-form">Titulo</label>
        </div>

        <div class="group-form">
            <input type="number" id="year" name="year" class="input-form" min="1900" value="2024" max="2100" required />
            <label for="year" class="label-form">Año</label>
        </div>

        <div class="group-form">
            <input type="text" id="author" name="author" placeholder="Ingrese el tauthor" class="input-form" required />
            <label for="author" class="label-form">Autor</label>
        </div>

        <div class="group-form">
            <textarea name="synopsis" rows="5" id="synopsis" class="input-form" placeholder="Ingrese la sinopsis" required></textarea>
            <label for="synopsis" class="label-form">Sinopsis</label>
        </div>

        <div class="group-form">
            <input type="file" id="front" name="front" class="input-form" required />
            <label for="front" class="label-form">Portada</label>
        </div>

        <div class="group-form">
            <input type="file" id="back" name="back" class="input-form" required />
            <label for="back" class="label-form">Contra portada</label>
        </div>

        <button type="submit" name="submit" class="submit-from">
            Agregar
        </button>
    </form>
    <!-- add collection -->
<?php } ?>


<?php if ($_GET['p2'] === 'collection-edit') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM collection WHERE col_id = '$id'";
        $query = mysqli_query($con, $sql);
        if ($query) {
            $row = $query->fetch_assoc();
?>
            <!-- edit collection -->
            <form class="form-form" action="../../php/admin/edit_collection.php" method="POST" enctype="multipart/form-data">
                <h2 class="title-form">Editar coleccion</h2>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="group-form">
                    <input type="text" id="title" name="title" placeholder="Ingrese el titulo" value="<?php echo $row['col_title'] ?>" class="input-form" required />
                    <label for="title" class="label-form">Titulo</label>
                </div>

                <div class="group-form">
                    <input type="number" id="year" name="year" class="input-form" value="<?php echo $row['col_year'] ?>" min="1900" max="2100" required />
                    <label for="year" class="label-form">Año</label>
                </div>

                <div class="group-form">
                    <input type="text" id="author" name="author" placeholder="Ingrese el tauthor" class="input-form" value="<?php echo $row['col_author'] ?>" required />
                    <label for="author" class="label-form">Autor</label>
                </div>

                <div class="group-form">
                    <textarea name="synopsis" rows="5" id="synopsis" class="input-form" placeholder="Ingrese la sinopsis" required><?php echo $row['col_synopsis'] ?></textarea>
                    <label for="synopsis" class="label-form">Sinopsis</label>
                </div>

                <div class="group-form">
                    <input type="file" id="front" name="front" class="input-form" />
                    <label for="front" class="label-form">Portada</label>
                </div>

                <div class="group-form">
                    <input type="file" id="back" name="back" class="input-form" />
                    <label for="back" class="label-form">Contra portada</label>
                </div>

                <button type="submit" name="submit" class="submit-from">
                    Editar
                </button>
            </form>
            <!-- edit collection -->
<?php }
    }
} ?>

<?php if ($_GET['p2'] === 'collection-select-gender') { ?>
    <!-- Genders collection  -->
    <br />
    <h2 class="subtitle">Generos de los libros</h2>
    <br />
    <div class="container-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Coleccion</th>
                    <th>Genero</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>harry potee</td>
                    <td>fantasia</td>
                    <td>
                        <a href=""><img src="../../assets/img/edit.png" alt="Editar" class="image-table" /></a>
                        <a href=""><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" /></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <a href="" class="add-table" aria-label="Agregar">+</a>
    <!-- Genders collection  -->
<?php } ?>

<?php if ($_GET['p2'] === 'collection-select-gender-add') { ?>
    <!-- Add genders collection  -->
    <form class="form-form" method="POST" action="">
        <h2 class="title-form">Agregar Genero a la coleccion</h2>
        <div class="group-form">
            <select name="gender" class="input-form" id="role">
                <option value="1">fantasia</option>
                <option value="2">terror</option>
            </select>
            <label for="role" class="label-form">Generos</label>
        </div>
        <button class="submit-from" name="submit">Agregar</button>
    </form>
    <!-- Add genders collection  -->
<?php } ?>

<?php if ($_GET['p2'] === 'collection-select-gender-edit') { ?>
    <!-- Edit genders collection  -->
    <form class="form-form" method="POST" action="">
        <h2 class="title-form">Editar Genero a la coleccion</h2>
        <div class="group-form">
            <select name="gender" class="input-form" id="role">
                <option value="1">fantasia</option>
                <option value="2">terror</option>
            </select>
            <label for="role" class="label-form">Generos</label>
        </div>
        <button class="submit-from" name="submit">Editar</button>
    </form>
    <!-- Edit genders collection  -->
<?php } ?>