<?php

if (isset($_GET['fair_id'])) {
    $_SESSION['fair_id'] = $_GET['fair_id'];
}

if (!isset($_SESSION['fair_id'])) {
    header('Location: ./admin.php?p=fair');
}

if (!isset($_GET['p2'])) {
    header("Location: ./admin.php?p=fair&p2=introduction");
}

?>

<div class="container-options">
    <ul class="list-options">
        <li class="item-options"><a href="./admin.php?p=fair&p2=introduction">Introducción Información</a></li>
        <li class="item-options"><a href="./admin.php?p=fair&p2=event">Evento Información</a></li>
        <li class="item-options"><a href="./admin.php?p=fair&p2=inscriptions">Inscripciones Información</a></li>
        <li class="item-options"><a href="./admin.php?p=fair&p2=projects-information">Proyectos Información</a></li>
        <li class="item-options"><a href="./admin.php?p=fair&p2=stripe">Franja Virtual Información</a></li>
        <li class="item-options"><a href="./admin.php?p=fair&p2=certs">Certificaciones</a></li>
        <li class="item-options"><a href="./admin.php?p=fair&p2=calendar">Calendario de Actividades</a></li>
        <li class="item-options"><a href="./admin.php?p=fair&p2=location">Localización</a></li>
        <li class="item-options"><a href="./admin.php?p=fair&p2=modalities">Modalidades</a></li>
        <li class="item-options"><a href="./admin.php?p=fair&p2=projects-request">Solicitudes de Proyectos</a></li>
        <li class="item-options"><a href="./admin.php?p=fair&p2=projects">Proyectos</a></li>
        <li class="item-options"><a href="./admin.php?p=fair&p2=themes">Temáticas</a></li>
    </ul>

</div>

<?php
if (isset($_GET['p2'])) {
    switch ($_GET['p2']) {
        case 'introduction':
        case 'introduction-add':
        case 'introduction-edit':
        case 'schedules-add':
        case 'schedules-edit':
            include("./components/utils/information.php");
            break;

        case 'event':
        case 'event-add':
        case 'event-edit':
            include("./components/utils/event.php");
            break;

        case 'inscriptions':
        case 'inscriptions-add':
        case 'inscriptions-edit':
            include("./components/utils/inscriptions.php");
            break;

        case 'projects-information':
        case 'projects-information-add':
        case 'projects-information-edit':
            include("./components/utils/projects_information.php");
            break;

        case 'stripe':
        case 'stripe-add':
        case 'stripe-edit':
        case 'stripe-schedules-add':
        case 'stripe-schedules-edit':
        case 'stripe-invited-add':
        case 'stripe-invited-edit':
            include("./components/utils/stripe.php");
            break;

        case 'certs':
        case 'certs-add':
        case 'certs-edit':
            include("./components/utils/certifications.php");
            break;

        case 'calendar':
        case 'calendar-add':
        case 'calendar-edit':
            include("./components/utils/calendar.php");
            break;

        case 'calendar-days':
        case 'calendar-days-add':
        case 'calendar-days-edit':
            include("./components/utils/calendar_days.php");
            break;

        case 'location':
        case 'location-add':
        case 'location-edit':
            include("./components/utils/location.php");
            break;

        case 'modalities':
        case 'modalities-add':
        case 'modalities-edit':
            include("./components/utils/modalities.php");
            break;

        case 'projects-request':
            include("./components/utils/projects_request.php");
            break;

        case 'projects':
        case 'projects-add':
        case 'projects-edit':
            include("./components/utils/projects.php");
            break;

        case 'themes':
        case 'themes-add':
        case 'themes-edit':
            include("./components/utils/themes.php");
            break;

        default:
            header("Location: ../../admin.php?p=fair&p2=introduction");
            break;
    }
}

?>