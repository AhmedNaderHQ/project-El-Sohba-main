<?php
    session_start(); //Start The Session
    unset($_SESSION['user']); //Unset The Data
    session_destroy(); //Destroy The Session
    header('Location:./');
    exit();
?>