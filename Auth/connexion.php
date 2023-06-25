<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <!-- Bootstrap core CSS -->
    <link href="../app_Etudiant/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../app_Etudiant/assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../app_Etudiant/assets/fonts/font-awesome.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="css/auth.css">

</head>
<body  style="background-color: #eee;">
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <div>
                                    <a href="../app_Etudiant/index.html"><i class="fa fa-arrow-left" ></i></a>
                                </div>

                                <div class="text-center">
                                    <img src="../app_Administrator/assets/images/favicon_twf.svg"style="width: 185px;" alt="logo">
                                </div>
                                
                                <h3>Connectez-vous</h3>
                                
                                <?php
                                    session_start();
                                    if (isset($_SESSION['error_message'])) {
                                        echo '<div id = "message" class="alert alert-danger">'.$_SESSION['error_message'].'</div>';
                                        unset($_SESSION['error_message']);
                                    }
                                ?>

                                <form action="../API/dataManager/create.php" method="POST" >

                                    <input type="hidden" name="action" value="connexion">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example11">Nom d'utilisateur</label>
                                        <input type="text" id="form2Example11" name="username" class="form-control" required/>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example22">Password</label>
                                        <input type="password" id="form2Example22" name="password" class="form-control" required/>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <!-- <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">Connexion</button> -->
                                        <input type="submit" class=" btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" name="submit" value="Connexion"/>
                                        <a class="text-muted" href="#!">Mot de passe oublié?</a>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Vous n'avez pas de compte?</p>
                                        <button type="button" class="btn btn-outline-danger">
                                            <a href="inscription.php" style="text-decoration:none; color:black" >Créer un compte</a>
                                        </button>
                                    </div>
                                    

                                </form>

                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">Techwomen Factory</h4>
                                <p class="twf">Est un programme initié par CAYSTI dont la promotrice est Madame Arielle KITIO.
                                    Financé par les Affaires mondiales du Canada et CUSO internationale.<br/>
                                    Il vise à créer une industrie locale qui forme, autonomise et emploie les jeunes femmes dans le domaine de la créativité numérique
                                    pour une croissance économique soutenue, durable et des emplois décents pour toutes.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
    </section>

    <script>
        setTimeout(function() {
            document.getElementById("message").style.display = "none";
        }, 3000);
    </script>
</body>
</html>