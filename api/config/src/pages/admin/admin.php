<?php
// admin

//bufer
ob_start();

// session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['use_id'])) {
    header("Location: ../../php/login/close.php");
    exit;
}

if (isset($_SESSION['use_id'])) {
    $user = $_SESSION['use_id'];
    if ($_SESSION['role'] !== 'Administrador') {
        header("Location: ../../php/login/close.php");
        exit;
    }
}

// imports
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/db/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/chinchinaes/api/config/utils/hour_formated.php';

// connection
$con = Connect_DB();

if (!isset($_GET['p'])) {
    header("location: ./admin.php?p=users");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body class="container-admin">
    <header class="sub-container-admin">
        <nav class="left-menu-admin" id="menu">
            <button class="close-left-menu-admin" id="close"><img src="../../assets/img/close.png"
                    class="image-png-admin" alt=""></button>
            <div class="container-title-admin">
                <img src="../../assets/img/ChinchinaES.png" class="logo-png-admin" alt="">
                <h2 class="title-left-menu-admin">Dashboard</h2>
            </div>
            <ul class="list-left-menu-admin">
                <li class="item-left-menu-admin"><img class="image-png-item-admin" src="../../assets/img/person.png"
                        alt=""> <a href="./admin.php?p=users">usuarios</a></li>
                <li class="item-left-menu-admin"><img class="image-png-item-admin"
                        src="../../assets/img/advertinsing.png" alt=""> <a href="./admin.php?p=advertising">Publicidad</a></li>
                <li class="item-left-menu-admin"><img class="image-png-item-admin" src="../../assets/img/fair.png"
                        alt=""> <a href="./admin.php?p=fair">DFC</a></li>
                <li class="item-left-menu-admin"><img class="image-png-item-admin" src="../../assets/img/images.png"
                        alt=""> <a href="./admin.php?p=image-bank">Banco de imagenes</a></li>
                <li class="item-left-menu-admin"><img class="image-png-item-admin" src="../../assets/img/video.png"
                        alt=""> <a href="./admin.php?p=video-bank">Banco de videos</a></li>
                <li class="item-left-menu-admin"><img class="image-png-item-admin" src="../../assets/img/category.png"
                        alt=""> <a href="./admin.php?p=category">Categorias</a></li>
                <li class="item-left-menu-admin"><img class="image-png-item-admin"
                        src="../../assets/img/number-sign.png" alt=""> <a href="./admin.php?p=hashtag">Hastags</a></li>
                <li class="item-left-menu-admin"><img class="image-png-item-admin"
                        src="../../assets/img/collection.png" alt=""> <a href="./admin.php?p=collection">Colección</a></li>
            </ul>
            <div class="container-button-admin">
                <button class="button-admin" id="add-profile"><img src="../../assets/img/person.png"
                        class="image-png-admin" alt=""></button>
                <a href="../../php/login/close.php" class="button-admin"><img src="../../assets/img/close.png" class="image-png-admin"
                        alt=""></a>
            </div>
        </nav>
    </header>
    <main class="sub-container-admin">
        <nav class="navbar-admin">
            <button class="button-admin" id="add">
                <img src="../../assets/img/menu.png" class="image-png-admin" alt="">
            </button>
        </nav>

        <?php
        include("../utils/profile.php");
        ?>

        <?php
        if (isset($_GET['p'])) {
            switch ($_GET['p']) {
                case 'users':
                case 'users-add':
                case 'users-edit':
                    include("./components/users.php");
                    break;

                case 'advertising':
                case 'advertising-add':
                case 'advertising-edit':
                    include("./components/advertising.php");
                    break;

                case 'fair':
                case 'fair-add':
                case 'fair-edit':
                    include("./components/dfc.php");
                    break;

                case 'category':
                case 'category-add':
                case 'category-edit':
                    include("./components/categories.php");
                    break;

                case 'hashtag':
                case 'hashtag-add':
                case 'hashtag-edit':
                    include("./components/hashtag.php");
                    break;

                case 'collection':
                    include('./components/collection_routes.php');
                    break;

                case 'image-bank':
                case 'image-bank-add':
                case 'image-bank-edit':
                    include("./components/image_bank.php");
                    break;

                case 'video-bank':
                case 'video-bank-add':
                case 'video-bank-edit':
                    include("./components/video_bank.php");
                    break;

                default:
                    header("location: ./admin.php?p=users");
                    break;
            }
        }

        ?>
    </main>


    <script src="../../js/pages/admin.js"></script>
    <script src="../../js/index.js"></script>
    <script src="../../js/profile.js"></script>
</body>

</html>
<?php
// end bufer
ob_end_flush();
?>