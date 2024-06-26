<?php
    require '../../../routes/controllers.php';
    require '../../../routes/views.php';

    session_start();
    session_destroy();
    header('Location: '. $login);
    exit();
?>