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
        <title>Offres</title>
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
        <br><br><br>
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
                                    <a href="javascript:void()" class="btn-social btn-facebook waves-effect waves-light m-1"><i class="fa fa-facebook"></i></a>
                                    <a href="javascript:void()" class="btn-social btn-google-plus waves-effect waves-light m-1"><i class="fa fa-google-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end info -->
                
                <!-- edit info -->
                <div class="col-lg-8">
                    <div class="card z-depth-3">

                        <!-- edit offre -->
                        <div id="offres" class="card-body" >
                            <ul class="nav nav-pills nav-pills-primary nav-justified">
                                <li class="nav-item">
                                    <a href="profil.php" data-target="#paramètre" data-toggle="pill" class="nav-link" ><span class="hidden-xs">Paramètre</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="publicInfos.php" data-target="#public infos" data-toggle="pill" class="nav-link " ><i class="icon-envelope-open" ></i> <span class="hidden-xs">Infos Publique</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="offres.php" data-target="#offres" data-toggle="pill" class="nav-link active show" ><i class="icon-note"></i> <span class="hidden-xs">Mes offres</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="notification.php" data-target="#notifications" data-toggle="pill" class="nav-link " ><i class="icon-note"></i> <span class="hidden-xs">Notifications</span></a>
                                </li>
                            </ul>
                            <?php
                                if (isset($_SESSION['error_message'])) {
                                    echo '<div id = "message" class="alert alert-success">'.$_SESSION['error_message'].'</div>';
                                    unset($_SESSION['error_message']);
                                }
                            ?>
                            <div class="tab-content p-3">
                                <div class="tab-pane active show">
                                    <form action="" method="POST">
                                        <div class="e-tabs mb-3 px-3">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item"><a class="nav-link active">Offres postulées</a></li>
                                            </ul>
                                        </div>
                                        <?php
                                        if ($souscriptions) { 
                                            
                                            echo("<div class='e-table'>
                                                <div class='table-responsive table-lg mt-3'>
                                                    <table class='table table-bordered'>
                                                        <thead>
                                                            <tr>
                                                                <th>Photo</th>
                                                                <th class='max-width'>Titre de l'offre</th>
                                                                <th class='sortable'>Nom de la structure</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>");
                                                        foreach ($souscriptions as $souscription):
                                                        echo("<tbody>
                                                            <tr>
                                                                <td class='align-middle text-center'>");

                                                                    if ($souscription -> imageJob == "") {
                                                                        echo("
                                                                            <div class='bg-light d-inline-flex justify-content-center align-items-center align-top' style='width: 35px; height: 35px; border-radius: 3px;'>
                                                                                <i class='fa fa-fw fa-photo' style='opacity: 0.8;'></i>
                                                                            </div>
                                                                        ");
                                                                    } 
                                                                    else {
                                                                    
                                                                        echo("
                                                                            <img src=". $souscription -> imageJob ." alt=user avatar>
                                                                        ");
                                                                    }
                                                                echo ("</td>
                                                                <td class='text-nowrap align-middle'>".$souscription -> titreOffre ."</td>
                                                                <td class='text-nowrap align-middle'><span>".$souscription -> nomStructure. "</span></td>
                                                                <td class='text-start align-middle'>");
                                                                    
                                                                    if ($souscription -> responseMessage == "") {
                                                                        echo("
                                                                            <span>En cours de traitement...</span>
                                                                        ");
                                                                    } 
                                                                    else {
                                                                    
                                                                        echo("
                                                                            <span>Traité</span>
                                                                        ");
                                                                    }
                                                                echo("</td>
                                                            </tr>
                                                        </tbody>");
                                                        endforeach;
                                                    echo("</table>
                                                </div>
                                            </div>");     
                                        }else {?>
                                        
                                        <?php
                                            echo("<h4>Aucune souscription</h4>");
                                        } 
                                        ?>
                                    </form>   
                                </div>
                            </div>
                        </div>
                        <!-- end edit offre -->
                    </div>
                </div>
                <!-- end edit info -->
            </div>
        </div>
        <?php endforeach; ?>
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
        <script>
            setTimeout(function() {
                document.getElementById("message").style.display = "none";
            }, 6000);
        </script>
        
    </body>
    
</html>

