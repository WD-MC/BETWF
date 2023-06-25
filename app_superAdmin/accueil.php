<?php 

    session_start();
    require('../Auth/access.php');
    if (isset($_SESSION['user_id'])){

        if (is_superAdmin()) {
            var_dump($_SESSION['username']);
        }else {
            header('Location: ../../BE_TWF/app_Etudiant/index.php');
            exit();
        }
        // switch ($_SESSION['rol']) {
                
        //     case '2': 
        //         var_dump($_SESSION['username']);
        //     break;
        //     case '1': 
        //         header('Location: ../../BE_TWF/app_Administrator/accueil_admin.php');
        //     break;
        //     case '0': 
        //         header('Location: ../../BE_TWF/app_Etudiant/index.php');
        //     break;
        // }
            
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
        href="../app_Administrator/assets/images/favicon_twf.svg"
        type="image/x-icon"
    />
    <title>Accueil | Super Administrateur</title>

    <!-- Bootstrap core CSS -->
    <link href="../app_Etudiant/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../app_Etudiant/assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../app_Etudiant/assets/css/fontawesome.css">
    <link rel="stylesheet" href="css/accueil.css">

</head>
<body>
<div class="container">
<section class="section mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7 text-center desc">
                <h2 class="h1 mb-3">How can we help?</h2>
                <p class="mx-lg-8">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa.</p>
                <form class="d-flex flex-column flex-md-row mt-4"><input type="email" class="form-control me-sm-2 mb-2 mb-sm-0" placeholder="you@yoursite.com"> <button class="btn btn-primary flex-shrink-0" type="submit">Get Started</button></form>
            </div>
        </div>
    </div>
    <div class="right">
        <a href="../Auth/logoutAdmin.php">
        <button>Déconnexion</button>
        </a>
    </div>
</section>
<section class="section pt-0">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-question-circle"></i></div>
                        <div class="ps-3 col">
                            <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Buying and Item Support</a></h5>
                            <p class="m-0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-id-badge"></i></div>
                        <div class="ps-3 col">
                            <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Licensing</a></h5>
                            <p class="m-0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-user"></i></div>
                        <div class="ps-3 col">
                            <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Your Account</a></h5>
                            <p class="m-0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-trophy"></i></div>
                        <div class="ps-3 col">
                            <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Copyright and Trademarks</a></h5>
                            <p class="m-0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-book"></i></div>
                        <div class="ps-3 col">
                            <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Tax &amp; Compliance</a></h5>
                            <p class="m-0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body d-flex">
                        <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-check"></i></div>
                        <div class="ps-3 col">
                            <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Licensing</a></h5>
                            <p class="m-0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</body>
</html>