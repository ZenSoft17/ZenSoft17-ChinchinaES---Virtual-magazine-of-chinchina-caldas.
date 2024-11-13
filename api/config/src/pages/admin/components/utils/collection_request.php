<?php

if (isset($_SESSION['error_collection'])) {
    $error = $_SESSION['error_collection'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_collection']);
};

?>

<?php if ($_GET['p2'] === 'collection-request') { ?>
    <!-- request  -->
    <br />
    <h1 class="title">Solicitudes</h1>
    <br />
    <div class="content-colletion">
        <?php
        $sql = "SELECT * FROM collection_request INNER JOIN collection ON collection_request.col_id = collection.col_id";
        $query = mysqli_query($con, $sql);
        if ($query) {
            while ($row = mysqli_fetch_array($query)) {
        ?>
                <div class="container-element">
                    <a href="../../php/admin/delete_collection.php?id=<?php echo $row['cre_id'] ?>" class="delete-element-colletion"><img src="../../assets/img/delete.png" class="image-colletion" alt="" /></a>
                    <img src="data:image/jpg;base64, <?php echo base64_encode($row['col_front']); ?>" class="image-element-colletion" alt="" />
                    <div class="element-collection">
                        <h5 class="collection-title"><?php echo $row['col_title'] ?></h5>
                        <p class="collection-text">
                        <?php echo $row['cre_request'] ?>
                        </p>
                        <h6 class="collection-author"><?php echo $row['cre_name'] ?></h6>
                        <div class="container-option-project">
                            <a href="./admin.php?p=collection&p2=collection-request-response&id=<?php echo $row['cre_id'] ?>" class="button-project accept-project">Responder</a>
                        </div>
                    </div>
                    <div class="container-shadow"></div>
                </div>
        <?php }
        } ?>
    </div>
    <br />
    <!-- request -->
<?php } ?>


<?php if ($_GET['p2'] === 'collection-request-response') { 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM collection_request WHERE cre_id = '$id'";
        $query = mysqli_query($con, $sql);
        if($query){
            $row = $query->fetch_assoc();
    ?>
    <!-- request response -->
    <form class="form-form" method="POST" action=""></form>
    <h2 class="title-form">Responder peticion</h2>
    <div class="group-form">
        <input type="text" id="name" name="name" class="input-form" value="<?php echo $row['cre_name'] ?>" readonly />
        <label for="name" class="label-form">Nombre</label>
    </div>
    <div class="group-form">
        <input type="text" id="mail" name="mail" class="input-form" value="<?php echo $row['cre_mail'] ?>" readonly />
        <label for="mail" class="label-form">correo</label>
    </div>
    <div class="group-form">
        <textarea name="request" rows="5" id="request" class="input-form" placeholder="Ingrese la peticion" readonly><?php echo htmlspecialchars($row['cre_request']) ?></textarea>
        <label for="request" class="label-form">Peticion</label>
    </div>
    <h2 class="subtitle">Respuesta</h2>
    <div class="group-form">
        <textarea name="response" rows="8" id="response" class="input-form" placeholder="Ingrese la respuesta" required></textarea>
        <label for="response" class="label-form">La respuesta se enviara por email</label>
    </div>
    <button class="submit-from" name="submit">Responder</button>
    </form>
    <!-- request response -->
<?php } }}?>