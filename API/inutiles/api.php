<?php

    // define("URL", str_replace("route.php","",(isset($_SERVER['HTTPS'])? "https" : "http").
    // "://".$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"]));

    require('include/dbcon.php') ;

    
    function sendJSON($infos){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        echo json_encode($infos, JSON_UNESCAPED_UNICODE);
    } 


            ####################################################---- Gestion des Offres ----################################################################
    // recupère tous les offres
    function getOffre(){
        global $connect;

        $query = "SELECT * FROM offres";
        $result = mysqli_query($connect, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
                // print_r($res);
                sendJSON($res);
                // $data =[
                //     'status' => 200,
                //     'message' => 'utilisateur trouvé avec succès',
                //     'data' => $res,
                // ];
                // header("HTTP/1.0 200  utilisateur trouvé avec succès");
                // return json_encode($data);
            }else {
                $data =[
                    'status' => 404,
                    'message' => 'Aucun utilisateur trouvé',
                ];
                header("HTTP/1.0 404  Aucun utilisateur trouvé");
                sendJSON($data);
            }
        }else {
            $data =[
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500  Internal Server Error");
            sendJSON($data);;
        }
    }

    // recherche tous les offres par une valeur (offres/nomValeurARecherhé_nomValeur)
    function getOffreByValeur($parcours){
        global $connect;

         // extraction du type de la valeur passée en paramètre
        $underscore_pos = strpos($parcours, '_');
        $type = substr($parcours, 0, $underscore_pos);

        // traitement en fonction du type
        if ($type === 'parcours') {
            // recherche par parcours
            $parcours_value = substr($parcours, $underscore_pos + 1);
            $query = "SELECT * FROM offres WHERE parcours='$parcours_value'";
            $result = mysqli_query($connect, $query);
        } else if ($type === 'id') {
            // recherche par id d'une offre
            $id_value = substr($parcours, $underscore_pos + 1);
            $query = "SELECT * FROM offres WHERE id='$id_value'";
            $result = mysqli_query($connect, $query);
        }else if ($type === 'lieu') {
            // recherche par lieu
            $lieu_value = substr($parcours, $underscore_pos + 1);
            $query = "SELECT * FROM offres WHERE lieu='$lieu_value'";
            $result = mysqli_query($connect, $query);
        }else if ($type === 'contrat') {
            // recherche par type de poste
            $contrat_value = substr($parcours, $underscore_pos + 1);
            $query = "SELECT * FROM offres WHERE typePoste='$contrat_value'";
            $result = mysqli_query($connect, $query);
        }
        // $query = "SELECT * FROM offres WHERE parcours='$parcours'";
        // $result = mysqli_query($connect, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
                sendJSON($res);
            }else {
                $data =[
                    'status' => 404,
                    'message' => 'Aucune donnée trouvé',
                ];
                header("HTTP/1.0 404  Aucune donnée trouvé");
                sendJSON($data);
            }
        }else {
            $data =[
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500  Internal Server Error");
            sendJSON($data);
        }
    }

            ####################################################---- Gestion des Offres ----################################################################

            
            ####################################################---- Gestion des Utilisateurs ----################################################################
    // recupère tous les utilisateurs
    function getEtudiant(){
        global $connect;

        $query = "SELECT * FROM users";
        $result = mysqli_query($connect, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
                sendJSON($res);
                // $data =[
                //     'status' => 200,
                //     'message' => 'utilisateur trouvé avec succès',
                //     'data' => $res,
                // ];
                // header("HTTP/1.0 200  utilisateur trouvé avec succès");
                // return json_encode($data);
            }else {
                $data =[
                    'status' => 404,
                    'message' => 'Aucun utilisateurs trouvé',
                ];
                header("HTTP/1.0 404  Aucun utilisateurs trouvé");
                sendJSON($data);
                // return json_encode($data);
            }
        }else {
            $data =[
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500  Internal Server Error");
            sendJSON($data);
        }
    }


    function getEtudiantById($id){
        global $connect;

        $query = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($connect, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
                sendJSON($res);
            }else {
                $data =[
                    'status' => 404,
                    'message' => 'Aucun utilisateur trouvé',
                ];
                header("HTTP/1.0 404  Aucun utilisateur trouvé");
                sendJSON($data);
            }
        }else {
            $data =[
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500  Internal Server Error");
            sendJSON($data);
        }
    }

            ####################################################---- Gestion des utilisateurs ----################################################################

            
            ####################################################---- Gestion des Souscriptions ----################################################################

            ####################################################---- Gestion des Souscriptions ----################################################################

            
            ####################################################---- Gestion des profils Users ----################################################################

            ####################################################---- Gestion des profils Users ----################################################################
            
            
            ####################################################---- Gestion des Historisations ----################################################################

            ####################################################---- Gestion des Historisations ----################################################################

?>