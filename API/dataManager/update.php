<?php

    // error_reporting(0); 
    
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: PUT');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

    include('function.php');

    $requestMethod = $_SERVER["REQUEST_METHOD"];


    // traiter les requêtes POST
    if ($requestMethod == "PUT") {

        // $action = $_POST["action"];
        $inputData = json_decode(file_get_contents("php://input"), true);

        if (empty($inputData)) {
            $updateUser =  updateUser($_POST, $_GET);
        }
        else{
            $updateUser =  updateUser($inputData, $_GET);
        }
        echo $inputData;


    }else {
        
        $data = [
            "status" => 405,
            'message' => $requestMethod. ' Method Not Allowed'
        ];
        header("HTPP/1.0 405 Method Not Allowed");
        echo  json_encode($data);
    }

?>