<?php
$sql = "SELECT use_name, use_image FROM users WHERE use_id = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param('s', $user);
    if ($stmt->execute()) {
        $stmt->bind_result($name, $image);
        $stmt->fetch();
        $stmt->close(); 
    } else {
        echo "Error al ejecutar la consulta: " . $con->error;
        $stmt->close();
        $con->close();
        exit;
    }
} else {
    echo "Error al preparar la consulta: " . $con->error;
    $con->close();
    exit;
}
?>

<form class="container-profile" id="profile" method="post" action="../../php/utils/edit_user.php" enctype="multipart/form-data">
    <button type="reset" class="button-close-profile" id="close-profile">
        <img src="../../assets/img/close.png" class="image-profile" alt="">
    </button>
    <div class="container-image-profile">
        <img src="data:image/jpg;base64, <?php echo base64_encode($image); ?>" alt="" class="image-profile">
        <label for="" class="label-image-profile">
            <input type="file" name="image" id="" class="input-image-profile">
        </label>
    </div>

    <input type="hidden" name="id" value="<?php echo $user ?>">

    <div class="group-form">
        <input type="text" id="" name="name" value="<?php echo htmlspecialchars($name); ?>" placeholder="" class="input-form">
        <label for="" class="label-form">Nombre</label>
    </div>

    <button class="submit-from" name="submit">Editar</button>
</form>
