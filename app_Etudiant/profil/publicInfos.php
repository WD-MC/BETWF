
<?php
    session_start();
    require('../../Auth/access.php');
    if (isset($_SESSION['user_id'])){
        if (is_user()) {
            $id = $_SESSION['user_id'];
            $users = json_decode(file_get_contents("http://localhost/BE_TWF/API/etudiants/".$id));
            if (!$users) {
                http_response_code(404);
                include('../../Erreur_serveur/erreur_404.html');
                exit();
            }
            $souscriptions = json_decode(file_get_contents("http://localhost/BE_TWF/API/souscriptions/".$id));
            $taille = 0;
            if ($souscriptions) {
                
                $notifications = json_decode(file_get_contents("http://localhost/BE_TWF/API/notifications/".$id));
                foreach ($notifications as $notification):
                if (!empty($notification->responseMessage)) {
                    $taille++;
                }
                endforeach;
            }
        }
        else {
            header('Location: ../../BE_TWF/app_Etudiant/index.php');
            exit();
        }
        
    }else {
      // Rediriger l'utilisateur vers la page de connexion
        header('Location: ../../app_Administrator/signin.php');
        exit();
    }
    

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Yinka Enoch Adedokun">
        <title>Infos</title>
        <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet">

        <link rel="stylesheet" href="../assets/css/profil.css">
        <link href="../assets/fonts/font-awesome.min.css" rel="stylesheet" />

        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="../assets/css/navbar.css">
    </head>
    <body>
    <div class="navbar">
            <div class="logo">
                <a href="../index.php" style="text-decoration: none;">
                    <img src="../assets/images/edu.png" alt="">
                    <em>BUREAU DES </em> ETUDIANTS
                </a>
            </div>
            
            
            <ul class="links">
                <li class="menu"><a href="../index.php">ACCUEIL</a></li>
                <li class="menu"><a href="../emploi/emploi.php">EMPLOI</a></li>
                <li class="menuPerson w-25" style="border-bottom: 2px solid #ffc600;">
                    
                    <?php foreach ($users as $user):?>
                    <?php 
                        if ($user -> imgProfile == "") {
                            echo("
                                <a href='profil.php'  class='user-box1'  style='text-decoration: none; border: none;' class='external'>
                                    <img src= 'http://localhost/BE_TWF/API/documents/profil/person.png' alt='user avatar'>
                                </a>
                            ");
                        } 
                        else {?>
                        <a href="profil.php"  class="user-box1"  style="text-decoration: none; border: none;" class="external">
                            <?php echo("
                                <img src=". $user -> imgProfile ." alt=user avatar>
                            ");
                        }?>
                        </a>
                </li>

                <a href="notification.php" class=" position-relative">
                    <i class="fa fa-envelope" style="font-size: 30px; color:white;" ></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                        <?php echo($taille); ?>
                    </span>
                </a>
            </ul>

            <div class="right">
                <a href="../../Auth/deconnexion.php">
                    <button>Déconnexion</button>
                </a>
            </div>
            
            <div class="toggle">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            
            
        </div>
        
        <br>
        <!-- Main Content -->
        <div class="container">
            <div class="row">
            
                <!-- info -->
                <div class="col-lg-4">
                    <div class="profile-card-4 z-depth-3">
                    <div class="card">
                            <div class="card-body text-center  rounded-top" style="background-color:#f3c443;">
                                <div class="user-box">
                                    <?php 
                                        if ($user -> imgProfile == "") {
                                            echo("<img src= 'http://localhost/BE_TWF/API/documents/profil/person.png' alt='user avatar'>");
                                        } else {
                                            echo("<img src=". $user -> imgProfile ." alt=user avatar>");
                                        }
                                    
                                    ?>
                                </div>
                                <h6 class="mb-1 text-white"> JPG ou PNG ne dépassant 3 MB</h6>
                                <form action="../../API/dataManager/create.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="changeImg">
                                    <input class="form-control" name = "image" type="file">
                                    <br>
                                    <div class="form-group row">
                                        <div class="col-lg-12 align-content-center">
                                            <input type="submit" class="btn btn-danger" value="Supprimer">
                                            <input type="submit" class="btn btn-outline-secondary"  value="Modifier" >
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <ul class="list-group shadow-none">
                                    
                                    <li class="list-group-item">
                                        <div class="list-icon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="list-details">
                                            <span><?= $user -> nom;?><?= " "?><?= $user -> prenom;?></span>
                                            <small>Nom et Prénom</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="list-icon">
                                            <i class="fa fa-phone-square"></i>
                                        </div>
                                        <div class="list-details">
                                            <span><?= $user -> phone;?></span>
                                            <small>Numéro de téléphone</small>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="list-icon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="list-details">
                                            <span><?= $user -> email;?></span>
                                            <small>Adresse email</small>
                                        </div>
                                    </li>
                                    </li>
                                        <li class="list-group-item">
                                        <div class="list-icon">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                        <div class="list-details">
                                            <span>Modifier mon mot de passe</span>
                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="" class="text-danger">
                                                changer
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                
                                <?php endforeach; ?>
                                <!-- Modal -->
                                <form action="../../API/dataManager/create.php" method="POST">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modifier votre mot de passe</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <br>
                                                <input type="hidden" name = "action" value="changePassword" >
                                                <div class="form-group row m-2">
                                                    <label class="col-lg-5 col-form-label form-control-label">Ancien mot de passe</label>
                                                    <div class="col-lg-7">
                                                        <input class="form-control" name = "oldPassword" type="password" value="11111122333" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row m-2">
                                                    <label class="col-lg-5 col-form-label form-control-label">Nouveau mot de passe</label>
                                                    <div class="col-lg-7">
                                                        <input class="form-control" name = "newPassword" type="password"  required>
                                                    </div>
                                                </div>
                                                <div class="form-group row m-2">
                                                    <label class="col-lg-5 col-form-label form-control-label">Confirmez le mot de passe</label>
                                                    <div class="col-lg-7">
                                                        <input class="form-control" name = "confPassword" type="password"  required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-outline-warning "  value="Enregistrer" >
                                                </div>   
                                            </div> 
                                        </div>
                                    </div>       
                                </form>
                                <!-- end Modal -->
                                <br>
                                <div class="card-footer text-center">
                                    <a href="#" class="btn-social btn-facebook waves-effect waves-light m-1"><i class="fa fa-facebook"  style="color:rgb(22, 34, 57);"></i></a>
                                    <a href="#" class="btn-social btn-google-plus waves-effect waves-light m-1"><i class="fa fa-linkedin"  style="color:rgb(22, 34, 57);"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end info -->
                
                <!-- edit info -->
                <div class="col-lg-8">
                    <div class="card z-depth-3">
                        <!-- edit public info -->
                        <div id="publicinfos" class="card-body">
                            <ul class="nav nav-pills nav-pills-primary nav-justified">
                                <li class="nav-item">
                                    <a href="profil.php" data-target="#paramètre" data-toggle="pill" class="nav-link" ><span class="hidden-xs">Paramètre</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="publicInfos.php"  data-target="#public infos" data-toggle="pill" class="nav-link active show"   ><i class="icon-envelope-open"></i> <span class="hidden-xs">Infos publique</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="offres.php" data-target="#offres" data-toggle="pill" class="nav-link"  ><i class="icon-note"></i> <span class="hidden-xs">Mes offres</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="notification.php" data-target="#notifications" data-toggle="pill" class="nav-link" ><i class="icon-note"></i> <span class="hidden-xs">Notifications</span></a>
                                </li>
                            </ul>
                            <br>   
                            <div class="tab-content p-3">
                                <div class="tab-pane active show">
                                    <?php
                                        if (isset($_SESSION['error_message'])) {
                                            echo '<div id = "message" class="alert alert-danger">'.$_SESSION['error_message'].'</div>';
                                            unset($_SESSION['error_message']);
                                        }
                                    ?>
                                    <form action="../../API/dataManager/create.php" method="POST" enctype="multipart/form-data" >

                                        <input type="hidden" name="action" value="newCV">

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Votre parcours</label>
                                            <div class="col-lg-9">
                                                <select id="parcours" name="parcours" class="form-control" required>
                                                    <option value="">Sélectionnez un parcours</option>
                                                    <option value="Art numérique">Art Numérique</option>
                                                    <option value="Data science">Data Science</option>
                                                    <option value="Développement web">Développement web</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Domaine Primaire</label>
                                            <div class="col-lg-9">
                                                <select id="DE" name="DE" class="form-control" required>
                                                    <option value="">Domaine exercée avant TWF</option>
                                                    <option value="sante">Santé</option>
                                                    <option value="tic">Technologie de l'information</option>
                                                    <option value="art et Culture">Art et Culture</option>
                                                    <option value="Tourisme">Tourisme</option>
                                                    <option value="Hotelerie">Hôtellerie</option>
                                                    <option value="Science Education">Science de l'Education</option>
                                                    <option value="Science Humaine et sociale">Science Humaine et Sociale</option>
                                                    <option value="BTP">Batiment, Travaux publics</option>
                                                    <option value="transport">Transport</option>
                                                    <option value="autre">Autres</option>
                                                </select>
                                                <input id="DomaineExerce" name="DE_autre" class="form-control" type="text" value=""  placeholder="Domaine exercée avant TWF">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Domaine d'expertise</label>
                                            <div class="col-lg-9">
                                                <select id="DR" name="DR" class="form-control" required>
                                                    <option value="">Domaine de recherche</option>
                                                    <option value="sante">Santé</option>
                                                    <option value="tic">Technologie de l'information</option>
                                                    <option value="art et Culture">Art et Culture</option>
                                                    <option value="Tourisme">Tourisme</option>
                                                    <option value="Hotelerie">Hôtellerie</option>
                                                    <option value="Science Education">Science de l'Education</option>
                                                    <option value="Science Humaine et sociale">Science Humaine et Sociale</option>
                                                    <option value="BTP">Batiment, Travaux publics</option>
                                                    <option value="transport">Transport</option>
                                                    <option value="autre">Autres</option>
                                                </select>
                                                <input id ="rechercheOffre" name="DR_autre" class="form-control" type="text" value="" placeholder="Domaine de recherche d'offre">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Ville</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" name="ville" type="text" value="" placeholder="Ville actuelle" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Langue</label>
                                            <div class="col-lg-9">
                                                <!-- <input class="form-control" type="tel" value="" placeholder="couremment parlée"> -->
                                                <select id="langue" name="langue" class="form-control" required>
                                                    <option value="">Couremment parlée</option>
                                                    <option value="Français">Français</option>
                                                    <option value="Anglais">Anglais</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Fichier_CV ou Porfolio ( 3Mo max)</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" name="cv" type="file" id="file-input" required>
                                                <progress id="progress-bar" value="0" max="100" style="width:590px;"></progress>
                                                <small id="file-error-message" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Reférence de vos travaux</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" name="url1" type="url" value="" placeholder="Url1" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                            <div class="col-lg-5">
                                                <input class="form-control" name="url2" type="url" value="" placeholder="Url2" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <input class="form-control" name="url3" type="url" value="" placeholder="Url3" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Autre Fichier (10 mo max)</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" name="cvAutre" type="file" id="file-input1" placeholder="Ex: une réalisation" required>
                                                <progress id="progress-bar1" value="0" max="100" style="width:590px;"></progress>
                                                <small id="file-error-message1" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <label class=" col-lg-4">Status:</label>
                                            <div class=" col-lg-4 px-2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="userStatus" id="users-status-disabled" value="users-status-disabled" required>
                                                    <label class="custom-control-label" for="users-status-disabled">Ouvert à l'emploi</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4  px-2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="userStatus" id="users-status-active" value="users-status-active" required>
                                                    <label class="custom-control-label" for="users-status-active">Occupé</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                            <div class="col-lg-9">
                                                <input type="reset" class="btn btn-secondary" value="Annuler">
                                                <input type="submit" class="btn btn-outline-warning" value="Sauvegarder">
                                            </div>
                                        </div>
                                    </form>   
                                </div>
                            </div>
                        </div>
                        <!-- end edit public info -->  
                    </div>
                </div>
                <!-- end edit info -->

            </div>
        </div>
        <br><br> 

        <footer class="bg-light text-center text-white">
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(22,34,57,0.95);">
                <div class="col-md-12">
                    <p style="font-weight: bolder;"><i class="fa fa-copyright"></i> Copyright 2022 Bureau des Etudiants  
                | Design: <a href="#" rel="sponsored" style="color: goldenrod; text-decoration: none;" target="_parent">Techwomen Factory</a> | by Caysti</p>
                </div>
            </div>
            <!-- Copyright -->
        </footer>
        
        <script src="../../app_Administrator/assets/js/bootstrap.bundle.min.js"></script>
        <script  src="../assets/js/navbar.js"></script>
        <script src="../assets/js/publicInfos.js"></script>
        <script>
            setTimeout(function() {
                document.getElementById("file-error-message").style.display = "none";
            }, 10000);
        </script>
        <script>
            setTimeout(function() {
                document.getElementById("message").style.display = "none";
            }, 10000);
        </script>
        
    </body>
    
</html>

