<?php
// close session
session_start();
session_destroy();
header("Location: ../../pages/login.php");
exit;
