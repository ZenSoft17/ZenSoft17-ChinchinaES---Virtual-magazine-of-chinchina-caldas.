<div class="section-zone">

    <div class="container-options">
        <ul class="list-options">
            <li class="item-options">
                <a href="./admin.php?p=collection&p2=collection">Colleccion</a>
            </li>
            <li class="item-options">
                <a href="./admin.php?p=collection&p2=collection-request">Solicitudes de libros</a>
            </li>
            <li class="item-options">
                <a href="./admin.php?p=collection&p2=genders">Generos</a>
            </li>
        </ul>
    </div>

    <?php
    if (isset($_GET['p2'])) {
        switch ($_GET['p2']) {

            case 'collection':
            case 'collection-add':
            case 'collection-edit':
            case 'collection-select-gender':
            case 'collection-select-gender-add':
            case 'collection-select-gender-edit':
                include("./components/utils/collection.php");
                break;

            case 'collection-request':
            case 'collection-request-reponse':
                include('./components/utils/collection_request.php');
                break;

            case 'genders':
            case 'genders-add':
            case 'genders-edit':
                include('./components/utils/genders.php');
                break;

            default:
                header("Location: ../../admin.php?p=collection&p2=collection");
                break;
        }
    } else {
        header("Location: ./admin.php?p=collection&p2=collection");
    }
    ?>


</div>