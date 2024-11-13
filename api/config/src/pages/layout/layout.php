<?php
// Iniciar buffer de salida
ob_start();

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['use_id'])) {
    header("Location: ../../php/login/close.php");
    exit;
}

if (isset($_SESSION['use_id'])) {
    $user = $_SESSION['use_id'];
    if ($_SESSION['role'] !== 'Autor') {
        header("Location: ../../php/login/close.php");
        exit;
    }
}

// Importar configuraciones y utilidades
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/hour_formated.php';

// Manejo de errores
if (isset($_SESSION['error_layout'])) {
    $error = $_SESSION['error_layout'];
    echo "<script type='text/javascript'>alert('$error');</script>";
    unset($_SESSION['error_layout']);
}

// Establecer conexión con la base de datos
$con = Connect_DB();

if (isset($_GET['id'])) {
    $_SESSION['pub_id'] = $_GET['id'];
    header("Location: ./layout.php?p=publication");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body class="container-layout">
    <header class="header-navbar">
        <nav class="navbar-layout">
            <ul class="list-layout">
                <li class="item-layout"> </li>
            </ul>
            <div class="navbar-layout">
                <button class="button-layout" id="add-profile">
                    <img src="../../assets/img/person.png" class="image-layout" alt="Perfil">
                </button>
                <a href="../../php/login/close.php" class="button-layout">
                    <img src="../../assets/img/close.png" class="image-layout" alt="Cerrar Sesión">
                </a>
                <button class="button-layout button-add-menu-publication" id="add-menu-publications">
                    <img src="../../assets/img/menu.png" class="image-layout" alt="Menú">
                </button>
            </div>
        </nav>
    </header>

    <?php include("../utils/profile.php"); ?>

    <main class="sub-container-layout" style="height: auto;">
        <div class="row-layout" id="menu-publication" >
            <button class="button-close-menu-layout" type="reset" id="close-menu-publication">
                <img src="../../assets/img/close.png" class="image-layout" alt="Cerrar">
            </button>
            <h6 class="subtitle">Publicaciones</h6>

            <?php
            $sql_select_publication = "SELECT * FROM publications
                                       INNER JOIN view_ ON publications.vie_id = view_.vie_id
                                       WHERE use_id = '$user'";
            $query_select_publication = mysqli_query($con, $sql_select_publication);

            if ($query_select_publication) {
                while ($row_select_publication = mysqli_fetch_assoc($query_select_publication)) {
            ?>
                    <div class="group-layout">
                        <span class="span-group-layout"><?php echo substr($row_select_publication['pub_name'], 0, 10); ?>...</span>
                        <a style="width: 3vh;" href="./layout.php?id=<?php echo $row_select_publication['pub_id']; ?>" class="options-group-layout">
                            <img src="../../assets/img/edit.png" class="image-layout" alt="Editar">
                        </a>
                        <a style="width: 3vh;" href="../../php/layout/delete_publication.php?id=<?php echo $row_select_publication['pub_id']; ?>" class="options-group-layout">
                            <img src="../../assets/img/delete.png" class="image-layout" alt="Eliminar">
                        </a>
                        <a style="width: 3vh;" href="../../php/layout/edit_view.php?id=<?php echo $row_select_publication['pub_id']; ?>" class="options-group-layout">
                            <img src="../../assets/img/<?php echo $row_select_publication['vie_view'] === 'si' ? 'eye.png' : 'eye-slash.png'; ?>" class="image-layout" alt="Visibilidad">
                        </a>
                    </div>
            <?php }
            } ?>
            <div class="container-add-publicacion">
                <a href="./layout.php?p=add" class="add-publication">+</a>
            </div>
        </div>
        <div class="row-layout">
            <?php
            if (isset($_GET['p'])) {
                switch ($_GET['p']) {
                    case 'add':
                        include("./components/publication-form.php");
                        break;
                    case 'publication':
                        include("./components/publications.php");
                        break;
                    case 'title-add':
                        include("./components/utils/title-form.php");
                        break;
                    case 'subtitle-add':
                        include("./components/utils/subtitle-form.php");
                        break;
                    case 'text-add':
                        include("./components/utils/text-form.php");
                        break;
                    case 'hr-add':
                        include("./components/utils/hr-form.php");
                        break;
                    case 'imagen-add':
                        include("./components/utils/imagen-form.php");
                        break;
                    case 'video-add':
                        include("./components/utils/video-form.php");
                        break;
                    default:
                        header("Location: ./layout.php?p=add");
                        break;
                }
            }
            ?>
        </div>
        <div class="row-layout">
            <a href="./layout.php?p=title-add" class="container-element-layout">T</a>
            <a href="./layout.php?p=subtitle-add" class="container-element-layout">S</a>
            <a href="./layout.php?p=text-add" class="container-element-layout">t</a>
            <a href="./layout.php?p=hr-add" class="container-element-layout">L</a>
            <a href="./layout.php?p=imagen-add" class="container-element-layout">I</a>
            <a href="./layout.php?p=video-add" class="container-element-layout">V</a>
        </div>
    </main>

    <footer class="footer-layout">
        <p class="text-by-layout"><img src="../../assets/img/EsferaCafe.png" alt="EsferaCafe" class="image-by-layout"> EsferaCafe</p>
        <p class="text-by-layout"><img src="../../assets/img/CorpoSer.png" alt="CorpoSer" class="image-by-layout"> CorpoSer</p>
        <p class="text-by-layout"><img src="../../assets/img/ChinchinaES.png" alt="ChinchinaES" class="image-by-layout"> ChinchinaES</p>
        <p class="text">Diseñador Autor - ChinchinaES</p>
    </footer>

    <script src="../../js/pages/layout.js"></script>
    <script src="../../js/profile.js"></script>
    <script src="../../js/index.js"></script>
</body>

</html>

<?php
// Finalizar buffer de salida
$con->close();
ob_end_flush();
?>