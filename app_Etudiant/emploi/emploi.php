<?php 

    // $session_id = uniqid();
    
    // if (isset($_COOKIE['user_id'])
    session_start();
    require('../../Auth/access.php');
    if (isset($_SESSION['user_id'])){
        if (is_user()) {
            $username = $_SESSION['username'];
            $id = $_SESSION['user_id'];
            $users = json_decode(file_get_contents("http://localhost/BE_TWF/API/etudiants/".$id));
            if (!$users) {
                http_response_code(404);
                include('../../Erreur_serveur/erreur_404.html');
                exit();
            }

            if (isset($_GET['parcours']) && !empty($_GET['parcours'])){
                $offres = json_decode(@file_get_contents("http://localhost/BE_TWF/API/offres/parcours_".$_GET['parcours']));
                if (!$offres) {
                    http_response_code(404);
                    include('../../Erreur_serveur/erreur_404.html');
                    exit();
                }
                $tailleOffre = count($offres);
            }elseif (isset($_GET['contrat']) && !empty($_GET['contrat'])) {
                $offres = json_decode(@file_get_contents("http://localhost/BE_TWF/API/offres/contrat_".$_GET['contrat']));
            
                if (!$offres) {
                    http_response_code(404);
                    include('../../Erreur_serveur/erreur_404.html');
                    exit();
                }
                $tailleOffre = count($offres);
            }elseif (isset($_GET['lieu']) && !empty($_GET['lieu'])) {
                $offres = json_decode(@file_get_contents("http://localhost/BE_TWF/API/offres/lieu_".$_GET['lieu']));
                
            
                if (!$offres) {
                    http_response_code(404);
                    include('../../Erreur_serveur/erreur_404.html');
                    exit();
                }
                $tailleOffre = count($offres);
            }
            else {
                $offres = json_decode(file_get_contents("http://localhost/BE_TWF/API/offres"));
                if (!$offres) {
                    http_response_code(404);
                    include('../../Erreur_serveur/erreur_404.html');
                    exit();
                }
                $tailleOffre = count($offres);
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
                    <?php echo($taille);?>
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



    <section class="section">
        <div class="container">
            <!-- Title -->
            <div class="card z-depth-3">
                <div class="row">
                    <div class="col-md-6 ">
                        <p class="m-0"><strong><?php echo $tailleOffre?> offres d'emplois</strong></p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end "> 
                            <p class="mr-1 mb-0 ">
                                <strong>
                                Filtrer par <i class="fa fa-filter" style = "color:#f3c443; margin-right:5px;"></i>: 
                                </strong>
                            </p>
                            <select id="selectid"  style = "border: 1px solid black; border-radius: 1px 8px 8px 8px;">
                                <option value="">Filtrez</option>
                                <option value="tout">Tout</option>
                                <option value="type1">Lieu</option>
                                <option value="type2">Contrat</option>
                                <option value="type3">Parcours</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <br><br>
            <!-- end title -->
            <!-- form -->
            <form action="emploi.php" method="GET" class="career-form mb-60">
                <div class="row">
                    <div class="col-md-6 col-lg-3 my-3">
                        <div class="input-group position-relative">
                            <input type="text" class="form-control" name="lieu" placeholder="Enter un lieu" id="keywords" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 my-3">
                        <div class="select-container">
                            <select class="custom-select" id="selectContrat" name="contrat" required>
                                <option selected="">Select Type</option>
                                <option value="cdi">CDI</option>
                                <option value="cdd">CDD</option>
                                <option value="stage">STAGE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 my-3">
                        <div class="select-container">
                            <select class="custom-select" id="selectParcours" name="parcours" required>
                                <option selected="">Select parcours</option>
                                <option value="art_numerique">Art numerique</option>
                                <option value="data_science">Data Science</option>
                                <option value="developpement_web">Development web</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 my-3">
                        <button type="submit" class="btn btn-lg btn-block btn-light btn-custom" id="contact-submit">
                            Search
                        </button>
                    </div>
                </div>
            </form>
            <!-- end form -->
            <br><br>
            
            <div class="row">
                
                <!-- job -->
                <div class="col-lg-12">
                    <div class="card z-depth-3">
                        <?php
                            if (isset($_SESSION['error_message'])) {
                                echo '<div id = "message" class="alert alert-danger">'.$_SESSION['error_message'].'</div>';
                                unset($_SESSION['error_message']);
                            }
                        ?>
                        <div class="row">
                            <?php foreach ($offres as $offre) : ?>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card border-0 bg-light rounded shadow m-2">
                                    
                                    <div class="card-body p-4">
                                        
                                        <div class="row">
                                            <div class="col-md-12  text-end ">
                                                <span class="badge rounded-pill bg-primary "><?= $offre ->typeTravail ?></span>
                                                <span class="badge rounded-pill bg-primary "><?= $offre ->modeTravail ?></span>
                                                <span class="badge rounded-pill bg-primary "><?= $offre ->typePoste ?></span>
                                            </div>
                                        </div>
                                        <br>
                                        <h5><strong><?= $offre ->titreOffre ?></strong></h5>
                                        <div class="mt-3">
                                            <span class="text-muted d-block"><i class="fa fa-home" aria-hidden="true"></i> <a href="#" target="_blank" class="text-muted"> <?= $offre ->nomStructure ?></a></span>
                                            <span class="text-muted d-block"><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $offre ->lieu ?></span>
                                        </div>
                                        <br>
                                        <div class="row ">
                                            <div class="col-md-4 mt-2">
                                                <i class="fa fa-calendar" aria-hidden="true"> 
                                                    <?php 
                                                        $datePublication = $offre ->dateSauvegarde;
                                                        // Convertir la date de publication en timestamp Unix
                                                        $timestampPublication = strtotime($datePublication);
                                                        // Calculer la différence entre la date de publication et la date actuelle
                                                        $diff = time() - $timestampPublication;
                                                        // Formater la différence en une chaîne de temps facile à lire
                                                        if ($diff < 60) {
                                                            $temps = "moins d'une minute";
                                                        } elseif ($diff < 3600) {
                                                            $temps = round($diff / 60) . " minutes";
                                                        } elseif ($diff < 86400) {
                                                            $temps = round($diff / 3600) . " heures";
                                                        } else {
                                                            $temps = round($diff / 86400) . " jours";
                                                        }
                                                        echo $temps;
                                                    ?>
                                                    
                                                </i> 
                                            </div>
                                            <div class="col-md-8 text-end">
                                                <?php $id = $offre->id; ?>
                                                <a href="detailEmploi.php?id=<?= $id ?>" class="btn btn-primary">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <?php endforeach; ?>

                            <div class="col-12 mt-4 pt-2 d-block d-md-none text-center">
                                <a href="#" class="btn btn-primary">View more Jobs <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right fea icon-sm"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                </div>
                <!-- end job -->

            </div>
        </div>
        
        <br><br><br><br><br><br><br><br><br>
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
    
    <script>
        setTimeout(function() {
            document.getElementById("message").style.display = "none";
        }, 10000);
    </script>
</html>