<?php
    session_start();
    require('../../Auth/access.php');
    if (isset($_SESSION['user_id'])){
        if (is_user()) {
            $username = $_SESSION['username'];
            $id = $_SESSION['user_id'];
            $offres = json_decode(@file_get_contents("http://localhost/BE_TWF/API/offres/id_".$_GET['id']));
            if (!$offres) {
                http_response_code(404);
                include('../../Erreur_serveur/erreur_404.html');
            }
            
            // var_dump($offres);
            $users = json_decode(file_get_contents("http://localhost/BE_TWF/API/etudiants/".$id));
            if (!$users) {
                http_response_code(404);
                include('../../Erreur_serveur/erreur_404.html');
                exit();
            }
        }
        else {
            header('Location: ../../BE_TWF/app_Etudiant/index.php');
        }

        
    }else {
      // Rediriger l'utilisateur vers la page de connexion
        header('Location: ../app_Administrator/signin.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="shortcut icon"
        href="../../app_Administrator/assets/images/favicon_twf.png"
        type="image/x-icon"
    />
    <title>Emplois</title>

    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/fonts/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/emp.css">
    
</head>
<body>
    
    <!--header-->
    <div class="navbar">
        <div class="logo">
            <a href="../index.php" style="text-decoration: none;">
                <img src="../assets/images/edu.png" alt="">
                <em>BUREAU DES </em> ETUDIANTS
            </a>
        </div>
        
        
        <ul class="links">
            <li class="menu"><a href="../index.php">ACCUEIL</a></li>
            <li class="menu" style="border-bottom: 2px solid #ffc600;"><a href="emploi.php">EMPLOI</a></li>
            <li class="menuPerson w-25">
            <?php foreach ($users as $user):?>
                <?php 
                    if ($user -> imgProfile == "") {
                        echo("
                            <a href='../profil/profil.php'  class='user-box1'  style='text-decoration: none; border: none;' class='external'>
                                <img src= 'http://localhost/BE_TWF/API/documents/profil/person.png' alt='user avatar'>
                            </a>
                        ");
                    } 
                    else {?>
                    <a href="../profil/profil.php"  class="user-box1"  style="text-decoration: none; border: none;" class="external">
                        <?php echo("
                            <img src=". $user -> imgProfile ." alt=user avatar>
                        ");
                    }?>
                </a>
            <?php endforeach; ?>
            </li>

            <a href="../profil/notification.php" class=" position-relative">
                <i class="fa fa-envelope" style="font-size: 30px; color:white;" ></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                    2
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


    <div class="section " style="overflow-x: hidden;">
        <div class="background-image" style="background-image: url('../assets/images/Jobs.png'); background-size: cover;  height: 590px;">
            <div class="row md-m-25px-b m-45px-b justify-content-center text-center" style="position: absolute; bottom: 200px; left: 0; width: 100%;">
                <div class="col-lg-8 text-center">   
                    <h1  style = "color:#f3c443;  font-weight: bolder;">TROUVEZ UN EMPLOI</h1>
                    <p class="m-0px font-2" style = "color:white;">Nous vous aidons à trouver des opportunités passionnantes dans le monde entier.</p>
                    
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- style="background-color: rgba(22, 34, 57, 0.623) rgb(22, 34, 57); -->


    <?php foreach ($offres as $offre) : ?>
    <section class="section">
        <div class="container">
            <!-- Title -->
            <div class="card z-depth-3">
                <h2 class="mr-1 mb-0 ">
                    <strong>
                    <?= $offre ->titreOffre ?>
                    </strong>
                </h2>
                <div class="mt-3">
                    <span class="text-muted d-block"><i class="fa fa-home" aria-hidden="true"></i> <a href="#" target="_blank" class="text-muted"> <?= $offre ->nomStructure ?></a></span>
                    <span class="text-muted d-block"><i class="fa fa-calendar" aria-hidden="true"></i><strong"> <?= $offre ->dateLimite ?></strong></span>
                </div>    
            </div>
            <br><br>
            
            <div class="row">
                
                <!-- job -->
                <div class="col-lg-12">
                    <div class="card z-depth-3">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-12">
                                <div class="card border-0 bg-light rounded shadow m-2">
                                    <div class="card-body p-4">
                                        <h4 class="mr-1 mb-0 ">
                                            <strong>
                                            Détails du poste
                                            </strong>
                                        </h4> 
                                        <hr>
                                        <div class="mt-3">
                                            <span class="text-muted d-block"><i class="fa fa-briefcase" aria-hidden="true"></i> <strong>Type de poste</strong> </span>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <span class="badge rounded-pill bg-primary "><?= $offre ->typeTravail ?></span>
                                                <span class="badge rounded-pill bg-primary "><?= $offre ->modeTravail ?></span>
                                                <span class="badge rounded-pill bg-primary "><?= $offre ->typePoste ?></span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <span class="text-muted d-block"><i class="fa fa-map-marker" aria-hidden="true"></i> <strong>Lieu</strong> </span>
                                            <span class="badge rounded-pill bg-primary "><?= $offre ->lieu ?></span>
                                        </div>
                                        <hr>
                                        <div class="mt-3">
                                            <span class="text-muted d-block"><i class="fa fa-edit" aria-hidden="true"></i> <strong>Précision du poste</strong> </span>
                                        </div> 
                                        <div class="mt-3">
                                            <p><?= $offre ->descriptions ?></p>
                                            <h6><strong> Compétences:</strong></h6>
                                            <p><?= $offre ->competences ?></p>
                                            <i><strong> Tu veux en savoir plus? Voici le fichier pdf:</strong></i>
                                            <span class="text-muted d-block"><i class="fa fa-file-pdf-o" aria-hidden="true"></i><a href="#" target="_blank" class="text-muted"> nom_fichier</a></span>
                                        </div>
                                        
                                        <form action="../../API/dataManager/create.php" method="POST">
                                            <div class="mt-3 text-end">
                                                <a href="emploi.php" class="btn btn-secondary">Retour</a>
                                                <?php $id = $offre->id; ?>
                                                <input type="hidden" name="action" value="postulerOffre">
                                                <input type="hidden"  name="idOffre"  value="<?php echo($id); ?>">
                                                <input type="submit" class="btn btn-primary" value="Postuler">
                                                <!-- <a href="detailEmploi.php?id=<?= $id ?>" class="btn btn-primary">Postuler</a> -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <?php endforeach; ?><!--end col-->
                        </div><!--end row-->
                    </div>
                </div>
                <!-- end job -->

            </div>
        </div>
        
        <br><br><br><br><br><br><br>
    </section>
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
</body>

    <script src="../assets/js/emploi.js"></script>
    <script  src="../assets/js/navbar.js"></script>
</html>