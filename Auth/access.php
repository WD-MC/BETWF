<?php

    function is_user(){
        if ($_SESSION['rol'] == 0 || $_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
            return true;
        }
        else {
            return false;
        }
    }

    function is_admin(){
        if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
            return true;
        }
        else {
            return false;
        }
    }

    function is_superAdmin(){
        if ($_SESSION['rol'] == 2) {
            return true;
        }
        else {
            return false;
        }
    }



?>