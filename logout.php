<?php
    /**
    * This page logs the user out of current session.
    */

    include('basicTemplate.php');

    session_start();
    $_SESSION['logged_in']=FALSE;
    session_unset();
    session_destroy();
    header('Location: index.php');
?>