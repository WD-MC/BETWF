<?php

    // inutile
    function is_log(){
        session_start();
        if (!isset($_SESSION['user_id'])) {
            // Rediriger l'utilisateur vers la page de connexion
            header('Location: ../Auth/connexion.php');
            exit();
        }
        
    }

    function admin_is_log(){
        session_start();
        if (!isset($_SESSION['user_id'])) {
            // Rediriger l'utilisateur vers la page de connexion
            header('Location: ../app_Administrator/signin.php');
            exit();
        }
        
    }
?>
