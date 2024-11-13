<?php

$fair_id = $_SESSION['fair_id'];

if (isset($_SESSION['error_certs'])) {
    $error = $_SESSION['error_certs'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_certs']);
};

?>

<div class="section-zone">

    <?php if ($_GET['p2'] === 'certs') { ?>
        <h2 class="subtitle">Certificaciones</h2>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Texto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM certifications WHERE fai_id = '$fair_id'";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo $row['cer_id'] ?></td>
                                <td><?php echo $row['cer_title'] ?></td>
                                <td><?php echo $row['cer_text'] ?></td>
                                <td>
                                    <a href="./admin.php?p=fair&p2=certs-edit&id=<?php echo $row['cer_id'] ?>"><img src="../../assets/img/edit.png" alt="Editar" class="image-table" loading="lazy"></a>
                                    <a href="../../php/admin/delete_certs.php?id=<?php echo $row['cer_id'] ?>"><img src="../../assets/img/delete.png" alt="Eliminar" class="image-table" loading="lazy"></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }  ?>
                </tbody>
            </table>
        </div>
        <a href="./admin.php?p=fair&p2=certs-add" class="add-table" aria-label="Agregar">+</a>
    <?php } ?>

    <?php if ($_GET['p2'] === 'certs-add') { ?>
        <form class="form-form" method="POST" action="../../php/admin/add_certs.php" enctype="multipart/form-data">
            <h2 class="title-form">Agregar Certificación</h2>
            <input type="hidden" name="fai_id" value="<?php echo $fair_id ?>">
            <div class="group-form">
                <input type="text" id="titulo" name="title" placeholder="Ingrese el título" class="input-form" required>
                <label for="titulo" class="label-form">Título</label>
            </div>
            <div class="group-form">
                <textarea rows="5" id="texto" name="text" placeholder="Ingrese el texto" class="input-form" required></textarea>
                <label for="texto" class="label-form">Texto</label>
            </div>
            <button class="submit-from" name="submit">Agregar</button>
        </form>
    <?php } ?>

    <?php if ($_GET['p2'] === 'certs-edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM certifications WHERE cer_id = '$id'";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $row = $query->fetch_assoc();
    ?>
                <form class="form-form" method="POST" action="../../php/admin/edit_certs.php" enctype="multipart/form-data">
                    <h2 class="title-form">Editar Certificación</h2>
                    <input type="hidden" name="id" value="<?php echo $row['cer_id'] ?>">
                    <div class="group-form">
                        <input type="text" id="titulo" name="title" value="<?php echo $row['cer_title'] ?>" placeholder="Ingrese el título" class="input-form" required>
                        <label for="titulo" class="label-form">Título</label>
                    </div>
                    <div class="group-form">
                        <textarea rows="5" id="texto" name="text" placeholder="Ingrese el texto" class="input-form" required><?php echo $row['cer_text'] ?></textarea>
                        <label for="texto" class="label-form">Texto</label>
                    </div>
                    <button class="submit-from" name="submit">Editar</button>
                </form>
    <?php }
        }
    } ?>

</div>