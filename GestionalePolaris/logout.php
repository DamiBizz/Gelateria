<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';
    
    session_start();
    session_unset();
    header("Location: $GLOBALS[domain_login]");
?>