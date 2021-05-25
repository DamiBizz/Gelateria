<?php
    require 'C:/xampp/htdocs/Elaborato/GestionalePolaris/config.php';


    if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }

    if (!isset($_SESSION['utente'])){ //se l'utente non si è loggato
        header("Location: $GLOBALS[domain_login]");
        exit;
    } 
        
    if (!isset($_SESSION['time'])){ //se il tempo non è stato settato
        header("Location: $GLOBALS[domain_login]");
        exit;
    }
        
?>