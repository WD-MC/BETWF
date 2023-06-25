<?php

    require('../include/dbcon.php') ;

    
    
    function validatePhoneNumber($phone){
        // Vérifier si le numéro de téléphone est composé de 9 chiffres
        if (preg_match('/^\d{9}$/', $phone)) {
            // Vérifier si le premier chiffre est 6 et le deuxième chiffre est 5, 7, 8 ou 9
            if (preg_match('/^6[5-9]\d{7}$/', $phone)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


            ####################################################---- Gestion des Authentifications ----################################################################
    
    
    function error422($message){
        
        $data =[
            'status' => 422,
            'message' => $message,
        ];
        header("HTTP/1.0 422  Unprocessable Entity");
        echo json_encode($data);
        exit();
    }
    
    // gerer l'authentification des utilisateurs
    function connectUser($userInput){
        session_start();
        global $connect;
        $username = mysqli_real_escape_string($connect, $userInput['username']);
        $password = mysqli_real_escape_string($connect, $userInput['password']);

        $password = md5($password);
        // Récupérer l'utilisateur de la base de données
        $sql = "SELECT * FROM users WHERE username='$username' && mdpasse = '$password' ";
        $result = $connect->query($sql);
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // // Connexion réussie, enregistrer les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['imgProfile'] = $user['imgProfile'];
            $_SESSION['adresse'] = $user['adresse'];
            $_SESSION['rol'] = $user['rol'];

            // setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); // expire dans 30 jours
            // setcookie('username', $user['username'], time() + (86400 * 30), "/"); // expire dans 30 jours
            // setcookie('nom', $user['nom'], time() + (86400 * 30), "/"); // expire dans 30 jours

            header('Location: ../../app_Etudiant/index.php');
            
        } else {
            $_SESSION['error_message'] = "Nom d'utilisateur ou mot de passe incorrect!";
            header('Location:../../Auth/connexion.php');
            exit;
            
            // $message = "Cet utilisateur n'existe pas.";
            // Passer le message à la page HTML
            // header('Location: ../../Auth/connexion.php?message=' . urlencode($message));
            // echo 'Cet utilisateur n\'existe pas.';
        }
        // Fermer la connexion à la base de données
        $connect->close();

    }

    // gerer l'authentification des administrateurs
    function connectAdmin($userInput){
        
        session_start();
        global $connect;
        $username = mysqli_real_escape_string($connect, $userInput['username']);
        $password = mysqli_real_escape_string($connect, $userInput['password']);
        $password = md5($password);
        // Récupérer l'utilisateur de la base de données
        $sql = "SELECT * FROM users WHERE username='$username' && mdpasse = '$password' ";
        $result = $connect->query($sql);
        
        if ($result->num_rows > 0) {
            $resulta = mysqli_query($connect,"SELECT rol FROM users WHERE username='$username'");
            $row0 = mysqli_fetch_row($resulta);
            $rol=$row0[0];

            if ($rol == "0") {
                $_SESSION['error_message'] = "Accès refusé !";
                echo $_SESSION['error_message'];
                header('Location:../../app_Administrator/signin.php');
                exit;
            }else {
                if ($_POST["superadmin"] === "1") {
                    if ($rol == "2") {
                        $user_superAdmin = $result->fetch_assoc();
                        // Connexion réussie, enregistrer les informations de l'utilisateur dans la session
                        $_SESSION['user_id'] = $user_superAdmin['id'];
                        $_SESSION['username'] = $user_superAdmin['username'];
                        $_SESSION['nom'] = $user_superAdmin['nom'];
                        $_SESSION['rol'] = $user_superAdmin['rol'];
                        header('Location: ../../app_superAdmin/accueil.php');
                        exit;
                    }else {
                        $_SESSION['error_message'] = "Accès refusé !";
                        echo $_SESSION['error_message'];
                        header('Location:../../app_Administrator/signin.php');
                        exit;
                    }
                }else {
                    $user_admin = $result->fetch_assoc();
                    // // Connexion réussie, enregistrer les informations de l'utilisateur dans la session
                    $_SESSION['user_id'] = $user_admin['id'];
                    $_SESSION['username'] = $user_admin['username'];
                    $_SESSION['nom'] = $user_admin['nom'];
                    $_SESSION['rol'] = $user_admin['rol'];

                    // setcookie('user_id_admin', $user_admin['id'], time() + (86400 * 30), "/");
                    // setcookie('username_admin', $user_admin['username'], time() + (86400 * 30), "/");
                    // setcookie('nom_admin', $user_admin['nom'], time() + (86400 * 30), "/");
                    
                    header('Location: ../../app_Administrator/accueil_admin.php');
                    exist;
                }
            }

            
        } else {
            $_SESSION['error_message'] = "Nom d'utilisateur ou mot de passe incorrect!";
            header('Location:../../app_Administrator/signin.php');
            exit;
        }
        // Fermer la connexion à la base de données
        $connect->close();
    }

            ####################################################---- Gestion des Authentifications ----################################################################


            ####################################################---- Gestion des requêtes POST ----################################################################
    
    
    // Save new user
    function saveUser($userInput){
        session_start();
        global $connect;

        $name = mysqli_real_escape_string($connect, $userInput['name']);
        $username = mysqli_real_escape_string($connect, $userInput['username']);
        $email = mysqli_real_escape_string($connect, $userInput['email']);
        $phone = mysqli_real_escape_string($connect, $userInput['phone']);
        $password = mysqli_real_escape_string($connect, $userInput['password']);
        $Vpassword = mysqli_real_escape_string($connect, $userInput['Vpassword']);

        // if (empty(trim($name))) {
        //     $_SESSION['error_message'] = "entrer votre nom!";
        //     header('Location:../../Auth/inscription.php');
        //     exit;
        // }
        if (trim($password) == trim($Vpassword)) {

            $password = md5($password);
            session_start();
            $reg = mysqli_query($connect,"SELECT * FROM users WHERE username='$username' || email ='$email'");
            $rows = mysqli_num_rows($reg);
            
            if($rows==0){

            #insere les donnees dans la base de donnee
                $query = "INSERT INTO users (noms, usernames,emails, phones, mdpasses) VALUES ('$name','$username','$email','$phone','$password')";
                $result = mysqli_query($connect,$query);
                header("Location: ../../Auth/connexion.php"); // Redirige vers la page de connexion
                exit();
            }else {
                $_SESSION['error_message'] = "Ce nom d'utilisateur ou email existe déjà!";
                header('Location:../../Auth/inscription.php');
                exit;
            }

            // if ($result) {
            //     $data =[
            //         'status' => 201,
            //         'message' => 'User created successfully',
            //     ];
            //     header("HTTP/1.0 201  Created");
            //     header("Location: ../../Auth/connexion.php"); // Redirige vers la page de connexion
            //     exit();
                
            // }else {
            //     $data =[
            //         'status' => 500,
            //         'message' => 'Internal Server Error',
            //     ];
            //     header("HTTP/1.0 500  Internal Server Error");
            //     echo json_encode($data);
            // }
        }else {
            $_SESSION['error_message'] = "Les mots de passe ne correspondent pas!";
            header('Location:../../Auth/inscription.php');
            exit;
        }
    }

    // Update user data 
    function updateUser($userInput){
        session_start();
        global $connect;

        $userId = $_SESSION['user_id'];
        $name = mysqli_real_escape_string($connect, $userInput['name']);
        $prenom =mysqli_real_escape_string($connect, $userInput['prenom']); 
        $username = mysqli_real_escape_string($connect, $userInput['username']);
        $email = mysqli_real_escape_string($connect, $userInput['email']);
        $phone = mysqli_real_escape_string($connect, $userInput['phone']);
        $adresse = mysqli_real_escape_string($connect, $userInput['adresse']);

        if(validatePhoneNumber($phone)){
            // Mettre à jour le lien de l'image dans la table users
            $query = "UPDATE users SET  username = '$username', nom = '$name', prenom = '$prenom', email = '$email', phone = '$phone', adresse = '$adresse' WHERE id='$userId'";
            $result = mysqli_query($connect, $query);
            header('Location:../../app_Etudiant/profil/profil.php');
            exit();
        } else {
            $_SESSION['error_message'] = "Le numéro de téléphone est invalide";
            header('Location:../../app_Etudiant/profil/profil.php');
            exit();
        }

        if(!$result){
            $_SESSION['error_message'] = "Erreur lors de la mise à jour de la base de données.";
            header('Location:../../app_Etudiant/profil/profil.php');
            exit();
        }
    }

    // change the user password
    function updatePassword($userInput){

        session_start();
        global $connect;

        $userId = $_SESSION['user_id'];
        $aPassword = mysqli_real_escape_string($connect, $userInput['oldPassword']);
        $nPassword = mysqli_real_escape_string($connect, $userInput['newPassword']);
        $confPassword = mysqli_real_escape_string($connect, $userInput['confPassword']);

        $aPassword = md5($aPassword);
        $nPassword = md5($nPassword);
        $confPassword = md5($confPassword);

        // Vérifier si le mot de passe est correct
        $userQuery = "SELECT * FROM users WHERE id = $userId";
        $userExistsResult = mysqli_query($connect, $userQuery);
        $user = mysqli_fetch_assoc($userExistsResult);
        $mdpasse = $user['mdpasse'];
        if ($aPassword == $mdpasse) {
            if ($nPassword == $confPassword) {
                // Mettre à jour le mot de passe dans la table users
                $query = "UPDATE users SET  mdpasse = '$nPassword'  WHERE id='$userId'";
                $result = mysqli_query($connect, $query);
                header('Location:../../app_Etudiant/profil/profil.php');
                exit;
            }
            else {
                $_SESSION['error_message'] = "Les mots de passe ne correspondent pas!";
                header('Location:../../app_Etudiant/profil/profil.php');
                exit;
            }
        }else {
            $_SESSION['error_message'] = "L'ancien mot de passe est incorrect";
            header('Location:../../app_Etudiant/profil/profil.php');
            exit;
        }
        
    }

    //change user profile picture
    function updateImgProfil($userInput){
        session_start();
        global $connect;

        $userId = $_SESSION['user_id'];
        $new_file_name = "";

        // // Vérifier si un fichier a été envoyé
        if(isset($_FILES['image'])){
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

            $extensions = array("jpeg","jpg","png");

            // Vérifier si l'extension de fichier est autorisée
            if(in_array($file_ext, $extensions) === true){
                
                // Vérifier la taille du fichier
                if($file_size < 3145728){
                    
                    $new_file_name = $userId . "_" . $file_name;
                    if (!empty($file_tmp )) {
                        $destination = "../../API/documents/profil/".$new_file_name; 
                        //Déplacer le fichier téléchargé vers le dossier images/profil
                        move_uploaded_file($file_tmp , $destination);
                        $img = imagecreatefromjpeg($destination);
                        $new_img = imagecreatetruecolor(315, 315);
                        imagecopyresampled($new_img, $img, 0, 0, 0, 0, 320, 315, imagesx($img), imagesy($img));
                        imagejpeg($new_img, $destination);
                        
                    }else{
                        $_SESSION['error_message'] = "Le chemin vers le fichier est absent";
                        header('Location:../../app_Etudiant/profil/profil.php');
                        exit;
                    }
                }else {
                    
                    $_SESSION['error_message'] = "Le fichier est trop volumineux. Veuillez sélectionner un fichier de moins de 5 Mo.";
                    header('Location:../../app_Etudiant/profil/profil.php');
                    exit;
                }
            }else {
                $_SESSION['error_message'] = "Extension non autorisée. Veuillez sélectionner un fichier JPG ou PNG.";
                header('Location:../../app_Etudiant/profil/profil.php');
                exit;
            }

        }
        $image_link = "http://localhost/BE_TWF/API/documents/profil/" . $new_file_name;
        // Mettre à jour le lien de l'image dans la table users
        $query = "UPDATE users SET imgProfile='$image_link' WHERE id='$userId'";
        $result = mysqli_query($connect, $query);
        header('Location:../../app_Etudiant/profil/profil.php');
        exit;

    }

    // add the user CV
    function addCV($userInput){
        session_start();
        global $connect;

        $userId = $_SESSION['user_id'];
        $parcours = mysqli_real_escape_string($connect, $userInput['parcours']);
        $DE =mysqli_real_escape_string($connect, $userInput['DE']); 
        $DE_autre = mysqli_real_escape_string($connect, $userInput['DE_autre']);
        $DR = mysqli_real_escape_string($connect, $userInput['DR']);
        $DR_autre = mysqli_real_escape_string($connect, $userInput['DR_autre']);
        $ville = mysqli_real_escape_string($connect, $userInput['ville']);
        $langue = mysqli_real_escape_string($connect, $userInput['langue']);
        // $cv =$_FILES['cv']['name']; 
        $url1 = mysqli_real_escape_string($connect, $userInput['url1']);
        $url2 = mysqli_real_escape_string($connect, $userInput['url2']);
        $url3 = mysqli_real_escape_string($connect, $userInput['url3']);
        // $cvAutre = $_FILES['cvAutre']['name'];
        $userStatus = mysqli_real_escape_string($connect, $userInput['userStatus']);

        $statusText = "";

        if ($userStatus === "users-status-active") {
            $statusText = "Occupé";
        } elseif ($userStatus === "users-status-disabled") {
            $statusText = "Ouvert à l'emploi";
        }

        if ($DE == "autre") {
            $DE = $DE_autre;
        }
        if ($DR == "autre") {
            $DR = $DR_autre;
        }

        if(isset($_FILES['cv'])){
            $cv_name = $_FILES['cv']['name'];
            $cv_size = $_FILES['cv']['size'];
            $cv_tmp = $_FILES['cv']['tmp_name'];
            $cv_type = $_FILES['cv']['type'];
            $cv_ext = strtolower(end(explode('.', $_FILES['cv']['name'])));

            $extensions = array("pdf");

            // Vérifier si l'extension de fichier est autorisée
            if(in_array($cv_ext, $extensions) === true){

                // Vérifier la taille du fichier
                if($file_size < 3145728){
                    $new_cv_name = $userId . "_" . $cv_name;
                    if (!empty($cv_tmp )) {
                        $destination = "../../API/documents/cv/".$new_cv_name;
                        //Déplacer le fichier téléchargé vers le dossier images/profil
                        move_uploaded_file($cv_tmp , $destination);
                        echo($new_cv_name);
                        
                    }else{
                        $_SESSION['error_message'] = "Le chemin vers le fichier est absent";
                        header('Location:../../app_Etudiant/profil/publicInfos.php');
                        exit;
                    }
                    // echo ($cv_name. $cv_size.  $cv_tmp. $cv_type. $cv_ext);
                }
                else {
                    $_SESSION['error_message'] = "Le fichier est trop volumineux. Veuillez sélectionner un fichier de moins de 5 Mo.";
                    header('Location:../../app_Etudiant/profil/publicInfos.php');
                    exit;
                }
                
            }
            else {
                $_SESSION['error_message'] = "Extension non autorisée. Veuillez sélectionner un fichier pdf";
                header('Location:../../app_Etudiant/profil/publicInfos.php');
                exit;
            }

        }

        if(isset($_FILES['cvAutre'])){
            $cvAutre_name = $_FILES['cvAutre']['name'];
            $cvAutre_size = $_FILES['cvAutre']['size'];
            $cvAutre_tmp = $_FILES['cvAutre']['tmp_name'];
            $cvAutre_type = $_FILES['cvAutre']['type'];
            $cvAutre_ext = strtolower(end(explode('.', $_FILES['cvAutre']['name'])));

            $extensions = array("pdf" , "docx", "mp3", "mp4", "jpeg","jpg","png");

            // Vérifier si l'extension de fichier est autorisée
            if(in_array($cvAutre_ext, $extensions) === true){

                // Vérifier la taille du fichier
                if($file_size < 10485760){
                    $new_cvAutre_name = $userId . "_" . $cvAutre_name;
                    if (!empty($cvAutre_tmp )) {
                        $destination = "../../API/documents/cv/".$new_cvAutre_name;
                        //Déplacer le fichier téléchargé vers le dossier images/profil
                        move_uploaded_file($cvAutre_tmp , $destination);
                        echo($new_cvAutre_name);
                        
                    }else{
                        $_SESSION['error_message'] = "Le chemin vers le fichier est absent";
                        header('Location:../../app_Etudiant/profil/publicInfos.php');
                        exit;
                    }
                    // echo ($cv_name. $cv_size.  $cv_tmp. $cv_type. $cv_ext);
                }
                else {
                    $_SESSION['error_message'] = "Le fichier est trop volumineux. Veuillez sélectionner un fichier de moins de 5 Mo.";
                    header('Location:../../app_Etudiant/profil/publicInfos.php');
                    exit;
                }
                
            }
            else {
                $_SESSION['error_message'] = "Votre autre fichier a une extension non autorisée. Veuillez choisir un fichier pdf, docx, mp3, mp4, jpeg, jpg, png";
                header('Location:../../app_Etudiant/profil/publicInfos.php');
                exit;
            }

        }
        $cv_link =  "http://localhost/BE_TWF/API/images/profil/" . $new_cv_name;
        $cvAutre_link =  "http://localhost/BE_TWF/API/images/profil/" . $new_cvAutre_name;
        // echo($cv_link. " ".$cvAutre_link );

        #insere les donnees dans la base de donnee
        $query = "INSERT INTO cv (parcours, domaineExpertise,domaineRecherche, ville, langue, cv_porfolio, url1, url2, url3, autreFichier, userSatus) VALUES 
        ('$parcours','$DE','$DR','$ville','$langue','$cv_link', '$url1', '$url2', '$url3','$cvAutre_link', '$userStatus')";
        $result = mysqli_query($connect,$query);
        header("Location: ../../app_Etudiant/profil/publicinfos.php"); 
        
        
        if(!$result){
            $_SESSION['error_message'] = "Erreur lors de l'insertion des données.";
            header('Location:../../app_Etudiant/profil/publicinfos.php');
            exit;
        }

        
    }

    // add offre
    function addOffre($userInput){

    }

    // postuler à une offre
    function postuler($userInput){

        session_start();
        global $connect;

        $userId = $_SESSION['user_id'];
        $idOffre = mysqli_real_escape_string($connect, $userInput['idOffre']);

        $reg = mysqli_query($connect,"SELECT * FROM souscriptions WHERE id_offre='$idOffre' && id_etudiant ='$userId'");
        $rows = mysqli_num_rows($reg);
            
        if($rows==0){

            #insere les donnees dans la base de donnee
            $query = "INSERT INTO souscriptions (id_offre, id_etudiant) VALUES 
            ('$idOffre','$userId')";
            $result = mysqli_query($connect,$query);
            header("Location: ../../app_Etudiant/profil/offres.php"); 
            if(!$result){
                $_SESSION['error_message'] = "Erreur lors de l'insertion des données.";
                header('Location:../../app_Etudiant/emploi/emploi.php');
                exit;
            }else {
                $_SESSION['error_message'] = "Vous avez postuler avec succès.";
                header('Location:../../app_Etudiant/profil/offres.php');
                exit;
            }
        }else {
            $_SESSION['error_message'] = "Vous avez déjà postuler à cette offre";
            header('Location:../../app_Etudiant/emploi/emploi.php');
            exit;
        }

        #insere les donnees dans la base de donnee
        // $query = "INSERT INTO souscriptions (id_offre, id_etudiant) VALUES 
        // ('$idOffre','$userId')";
        // $result = mysqli_query($connect,$query);
        // header("Location: ../../app_Etudiant/profil/offres.php"); 
        
    }
            ####################################################---- Gestion des requêtes POST ----################################################################





            ####################################################---- Gestion des requêtes GET ----################################################################

    // obtenir la liste de tous les utilisateurs
    function getCustomerList(){

        global $connect;

        $query = "SELECT * FROM users";
        $result = mysqli_query($connect, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $data =[
                    'status' => 200,
                    'message' => 'utilisateur trouvé avec succès',
                    'data' => $res,
                ];
                header("HTTP/1.0 200  utilisateur trouvé avec succès");
                return json_encode($data);
            }else {
                $data =[
                    'status' => 404,
                    'message' => 'Aucun utilisateur trouvé',
                ];
                header("HTTP/1.0 404  Aucun utilisateur trouvé");
                return json_encode($data);
            }
        }else {
            $data =[
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500  Internal Server Error");
            return json_encode($data);
        }
    }


    // obtenir la liste de tous les offres
    function getOffre(){

        global $connect;

        $query = "SELECT * FROM offres";
        $result = mysqli_query($connect, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
                // $data =[
                //     'status' => 200,
                //     'message' => 'utilisateur trouvé avec succès',
                //     'data' => $res,
                // ];
                // header("HTTP/1.0 200  utilisateur trouvé avec succès");
                return json_encode($res, JSON_UNESCAPED_UNICODE);
            }else {
                $data =[
                    'status' => 404,
                    'message' => 'Aucun utilisateur trouvé',
                ];
                header("HTTP/1.0 404  Aucun utilisateur trouvé");
                return json_encode($data);
            }
        }else {
            $data =[
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500  Internal Server Error");
            return json_encode($data);
        }
    }

    function getOffreByParcours($parcours){
        global $connect;

        $query = "SELECT * FROM offres WHERE parcours='$parcours'" ;
        $result = mysqli_query($connect, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
                // $data =[
                //     'status' => 200,
                //     'message' => 'utilisateur trouvé avec succès',
                //     'data' => $res,
                // ];
                // header("HTTP/1.0 200  utilisateur trouvé avec succès");
                return json_encode($res, JSON_UNESCAPED_UNICODE);
            }else {
                $data =[
                    'status' => 404,
                    'message' => 'Aucun utilisateur trouvé',
                ];
                header("HTTP/1.0 404  Aucun utilisateur trouvé");
                return json_encode($data);
            }
        }else {
            $data =[
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500  Internal Server Error");
            return json_encode($data);
        }
    }

            ####################################################---- Gestion des requêtes GET ----################################################################
?>