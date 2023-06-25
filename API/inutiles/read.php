<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: GET');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

    include('function.php');

    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if ($requestMethod == "GET") {
        $offre = getOffre();
        $offreByParcours = getOffreByParcours('developpement_web');

        echo $offre;
        echo $offreByParcours;

    }else {
        
        $data = [
            "status" => 405,
            'message' => $requestMethod. 'Method Not Allowed',
        ];
        header("HTPP/1.0 405 Method Not Allowed");
        echo  json_encode($data);
    }

?>