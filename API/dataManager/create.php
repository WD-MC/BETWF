<?php

    error_reporting(0); 
    
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: POST');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

    include('function.php');

    $requestMethod = $_SERVER["REQUEST_METHOD"];


    // traiter les requêtes POST
    if ($requestMethod == "POST") {

        $action = $_POST["action"];
        // $id = $_POST["id"];
        

        if ($action == "inscription") {
            // echo $action;
            $inputData = json_decode(file_get_contents("php://input"), true);
            if (empty($inputData)) {
                $saveUser = saveUser($_POST);
            }
            else {
                $saveUser = saveUser($inputData);
            }
            echo $saveUser;
        }
        if ($action == "connexion") {
            $inputData = json_decode(file_get_contents("php://input"), true);
            if (empty($inputData)) {
                $connectUser = connectUser($_POST);
            }
            else {
                $connectUser= connectUser($inputData);
            }
            echo $connectUser;
        }
        if ($action == "connexion_admin") {
            $inputData = json_decode(file_get_contents("php://input"), true);
            if (empty($inputData)) {
                $connectAdmin = connectAdmin($_POST);
            }
            else {
                $connectAdmin= connectAdmin($inputData);
            }
            echo $connectAdmin;
        }
        if ($action == "newOffre") {
            $inputData = json_decode(file_get_contents("php://input"), true);
            if (empty($inputData)) {
                $addOffre = addOffre($_POST);
            }
            else {
                $addOffre= addOffre($inputData);
            }
            echo $addOffre;
        }
        if ($action == "updateUser") {
            $inputData = json_decode(file_get_contents("php://input"), true);
            if (empty($inputData)) {
                $updateUser = updateUser($_POST);
            }
            else {
                $updateUser= updateUser($inputData);
            }
            echo $updateUser;
        }

        if ($action == "changePassword") {
            $inputData = json_decode(file_get_contents("php://input"), true);
            if (empty($inputData)) {
                $updatePassword = updatePassword($_POST);
            }
            else {
                $updatePassword= updatePassword($inputData);
            }
            echo $updatePassword;
        }
        if ($action == "changeImg") {
            $inputData = json_decode(file_get_contents("php://input"), true);
            if (empty($inputData)) {
                $updateImgProfil = updateImgProfil($_POST);
            }
            else {
                $updateImgProfil= updateImgProfil($inputData);
            }
            echo $updateImgProfil;
        }
        if ($action == "newCV") {
            $inputData = json_decode(file_get_contents("php://input"), true);
            if (empty($inputData)) {
                $addCV = addCV($_POST);
            }
            else {
                $addCV= addCV($inputData);
            }
            echo $addCV;
        }
        if ($action == "postulerOffre") {
            $inputData = json_decode(file_get_contents("php://input"), true);
            if (empty($inputData)) {
                $postuler = postuler($_POST);
            }
            else {
                $postuler= postuler($inputData);
            }
            echo $postuler;
        }
        

    }else {
        
        $data = [
            "status" => 405,
            'message' => $requestMethod. ' Method Not Allowed'
        ];
        header("HTPP/1.0 405 Method Not Allowed");
        echo  json_encode($data);
    }

?>