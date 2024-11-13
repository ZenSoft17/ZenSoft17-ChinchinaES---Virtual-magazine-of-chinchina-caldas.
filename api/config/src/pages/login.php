<?php
//bufer
ob_start();

// session 
session_start();

// error
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>

    <div class="container-login">
        <div class="sub-container-login">
            <form class="form-form" method="POST" action="<?php if (!isset($_SESSION['login_status'])) { echo "../php/login/login-script.php"; } if (isset($_SESSION['login_status'])) { echo "../php/login/code-script.php"; } ?>">
                <?php if (!isset($_SESSION['login_status'])) { ?>
                    <h2 class="title-form">Ingresa</h2>

                    <div class="group-form">
                        <input type="email" id="email" name="email" placeholder="Correo" class="input-form" required>
                        <label for="email" class="label-form">Correo</label>
                    </div>

                    <div class="group-form">
                        <input type="password" id="password" name="password" placeholder="Contraseña" class="input-form" required>
                        <label for="password" class="label-form">Contraseña</label>
                    </div>

                    <button type="submit" class="submit-from" name="submit">Ingresar</button>
                <?php } ?>

                <?php if (isset($_SESSION['login_status'])) { ?>
                    <h2 class="title-form">Confirma tu identidad</h2>

                    <div class="group-form">
                        <input type="number" id="code" name="code" placeholder="Código" class="input-form" required>
                        <label for="code" class="label-form">Código</label>
                    </div>

                    <button type="submit" class="submit-from" name="submit">Confirmar</button>
                <?php } ?>
            </form>
        </div>
    </div>

    <script src="../js/index.js"></script>
    <script src="../js/login.js"></script>
</body>

</html>

<?php
// end bufer
ob_end_flush();
?>