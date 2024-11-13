<?php
if (isset($_GET['p']) && isset($_SESSION['pub_id'])) {
    if ($_GET['p'] === 'publication') {
        $pub_id = $_SESSION['pub_id'];
        $sql_publication = "SELECT * FROM publications WHERE pub_id = '$pub_id'";
        $query_publication = mysqli_query($con, $sql_publication);
        if ($query_publication) {
            $row_publication = $query_publication->fetch_assoc();
            $date = HourFormated($row_publication['pub_date']);
?>
            <form class="container-image-publication-layout" action="../../php/layout/edit_publication.php" enctype="multipart/form-data" method="post">
                <img src="data:image/jpg;base64,<?php echo base64_encode($row_publication['pub_image']); ?>" class="image-publication-layout" alt="Publicación" loading="lazy">

                <input type="hidden" name="id" value="<?php echo $pub_id ?>">

                <label for="title" class="sr-only">Título de la publicación</label>
                <input type="text" name="title" id="title" class="input-title-publication-layout" value="<?php echo $row_publication['pub_name']; ?>">

                <hr class="hr-title-publicacion">

                <p class="date-image-publication-layout"><?php echo $date; ?></p>

                <label for="image" class="label-file-publication-layout">
                    <input type="file" name="image" id="image" class="input-file-publication-layout">
                </label>

                <button class="submit-imagen-publication-layout" type="submit" name="submit">
                    <img src="../../assets/img/save.png" alt="Guardar" class="image-layout" loading="lazy">
                </button>
            </form>
        <?php
        }
        ?>

        <div class="content-publication-layout">
            <?php
            $sql_element = "SELECT * 
                            FROM elements 
                            INNER JOIN types ON elements.typ_id = types.typ_id
                            WHERE pub_id = '$pub_id'
                            ORDER BY ele_datetime ASC;
                            ";
            $query_element = mysqli_query($con, $sql_element);
            if ($query_element) {
                while ($row_element = mysqli_fetch_assoc($query_element)) {
            ?>
                    <?php if ($row_element['typ_type'] === 'title') { ?>
                        <form class="container-multidata-layout" action="../../php/layout/edit_element.php" method="post">
                            <a href="../../php/layout/delete_element.php?id=<?php echo $row_element['ele_id'] ?>" class="delete-multidata-layout">
                                <img src="../../assets/img/delete.png" alt="Eliminar" class="image-layout" loading="lazy">
                            </a>
                            <input type="hidden" name="id" value="<?php echo $row_element['ele_id']; ?>">

                            <input type="hidden" name="type" value="<?php echo $row_element['typ_type']; ?>">
                            <label for="title_<?php echo $row_element['ele_id']; ?>" class="sr-only">Título</label>
                            <input type="text" id="title_<?php echo $row_element['ele_id']; ?>" name="text" value="<?php echo $row_element['ele_text']; ?>" class="input-form-layout">
                            <label for="title_<?php echo $row_element['ele_id']; ?>" class="label-form-layout">Titulo</label>

                            <button type="submit" class="submit-multidata-layout" name="submit">
                                <img src="../../assets/img/save.png" alt="Guardar" class="image-layout" loading="lazy">
                            </button>
                        </form>
                    <?php } ?>

                    <?php if ($row_element['typ_type'] === 'subtitle') { ?>
                        <form class="container-multidata-layout" action="../../php/layout/edit_element.php" method="post">
                            <a href="../../php/layout/delete_element.php?id=<?php echo $row_element['ele_id'] ?>" class="delete-multidata-layout">
                                <img src="../../assets/img/delete.png" alt="Eliminar" class="image-layout" loading="lazy">
                            </a>
                            <input type="hidden" name="id" value="<?php echo $row_element['ele_id']; ?>">
                            <input type="hidden" name="type" value="<?php echo $row_element['typ_type']; ?>">
                            <label for="subtitle_<?php echo $row_element['ele_id']; ?>" class="sr-only">Subtítulo</label>
                            <input type="text" id="subtitle_<?php echo $row_element['ele_id']; ?>" name="text" value="<?php echo $row_element['ele_text']; ?>" class="input-form-layout">
                            <label for="subtitle_<?php echo $row_element['ele_id']; ?>" class="label-form-layout">Subtitulo</label>

                            <button type="submit" class="submit-multidata-layout" name="submit">
                                <img src="../../assets/img/save.png" alt="Guardar" class="image-layout" loading="lazy">
                            </button>
                        </form>
                    <?php } ?>

                    <?php if ($row_element['typ_type'] === 'text') { ?>
                        <form class="container-multidata-layout" action="../../php/layout/edit_element.php" method="post">
                            <a href="../../php/layout/delete_element.php?id=<?php echo $row_element['ele_id'] ?>" class="delete-multidata-layout">
                                <img src="../../assets/img/delete.png" alt="Eliminar" class="image-layout" loading="lazy">
                            </a>
                            <input type="hidden" name="id" value="<?php echo $row_element['ele_id']; ?>">
                            <input type="hidden" name="type" value="<?php echo $row_element['typ_type']; ?>">
                            <label for="text_<?php echo $row_element['ele_id']; ?>" class="sr-only">Texto</label>
                            <textarea name="text" id="text_<?php echo $row_element['ele_id']; ?>" class="input-form-layout" rows="5"><?php echo $row_element['ele_text']; ?></textarea>
                            <label for="text_<?php echo $row_element['ele_id']; ?>" class="label-form-layout">Texto</label>

                            <button type="submit" class="submit-multidata-layout" name="submit">
                                <img src="../../assets/img/save.png" alt="Guardar" class="image-layout" loading="lazy">
                            </button>
                        </form>
                    <?php } ?>

                    <?php if ($row_element['typ_type'] === 'hr') { ?>
                        <div class="container-multidata-layout">
                            <a href="../../php/layout/delete_element.php?id=<?php echo $row_element['ele_id'] ?>" class="delete-multidata-layout">
                                <img src="../../assets/img/delete.png" alt="Eliminar" class="image-layout" loading="lazy">
                            </a>
                            <hr class="hr-publication">
                        </div>
                    <?php } ?>

                    <?php if ($row_element['typ_type'] === 'imagen') { ?>
                        <form class="container-multidata-layout" action="../../php/layout/edit_element.php" method="post" enctype="multipart/form-data">
                            <a href="../../php/layout/delete_element.php?id=<?php echo $row_element['ele_id'] ?>" class="delete-multidata-layout">
                                <img src="../../assets/img/delete.png" alt="Eliminar" class="image-layout" loading="lazy">
                            </a>
                            <input type="hidden" name="id" value="<?php echo $row_element['ele_id']; ?>">
                            <input type="hidden" name="type" value="<?php echo $row_element['typ_type']; ?>">
                            <img src="data:image/jpg;base64,<?php echo base64_encode($row_element['ele_image']); ?>" alt="Imagen" class="multidata-layout" loading="lazy">
                            <label for="image_<?php echo $row_element['ele_id']; ?>" class="label-file-publication-layout">
                                <input type="file" name="image" id="image_<?php echo $row_element['ele_id']; ?>" class="input-file-publication-layout">
                            </label>
                            <button class="submit-imagen-publication-layout" type="submit" name="submit">
                                <img src="../../assets/img/save.png" alt="Guardar" class="image-layout" loading="lazy">
                            </button>
                        </form>
                    <?php } ?>

                    <?php if ($row_element['typ_type'] === 'video') { ?>
                        <form class="container-multidata-layout" action="../../php/layout/edit_element.php" method="post" enctype="multipart/form-data">
                            <a href="../../php/layout/delete_element.php?id=<?php echo $row_element['ele_id'] ?>" class="delete-multidata-layout">
                                <img src="../../assets/img/delete.png" alt="Eliminar" class="image-layout" loading="lazy">
                            </a>
                            <input type="hidden" name="id" value="<?php echo $row_element['ele_id']; ?>">
                            <input type="hidden" name="type" value="<?php echo $row_element['typ_type']; ?>">
                            <video controls class="multidata-layout" loading="lazy">
                                <source src="data:video/mp4;base64,<?php echo $row_element['ele_video']; ?>" type="video/mp4">
                            </video>
                            <label for="video_<?php echo $row_element['ele_id']; ?>" class="label-file-publication-layout">
                                <input type="file" name="video" id="video_<?php echo $row_element['ele_id']; ?>" class="input-file-publication-layout">
                            </label>
                            <button class="submit-imagen-publication-layout" type="submit" name="submit">
                                <img src="../../assets/img/save.png" alt="Guardar" class="image-layout" loading="lazy">
                            </button>
                        </form>
                    <?php } ?>
            <?php
                }
            }
            ?>
        </div>
<?php
    }
}
?>