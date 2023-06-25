<?php


// function getConexion(){
//     try {
//         //session_start();
//         return new PDO('mysql:host=localhost; dbname=betwf_bd; port=3308; charset=utf8','root',''); 
//     } catch (Exception  $e) {
//         die('Il y a une erreur' . $e->getMessage());
//     }
// }

    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "betwf_bd";
    $db_port = "3308";

    #se connecter à la base de donnée
    $connect = mysqli_connect($host, $db_username, $db_password, $db_name, $db_port)or die('Error');

?>