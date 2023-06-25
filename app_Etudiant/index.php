<?php 
  // require('../API/is_auth.php');
  // is_log();
  // $session_id = uniqid();

  session_start();
  require('../Auth/access.php');
  if ($_SESSION['user_id']) {
    // $user_id = $_COOKIE['user_id'];
    // $username = $_COOKIE['username'];
    // $nom = $_COOKIE['nom'];

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
      // endforeach;
    }
      
  }else{
    header('Location: ../Auth/connexion.php');
    exit();
  }

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Bureau des Etudiants TWF</title>
    
    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    

  </head>

  <body>

  
  <!--header-->
  <div class="navbar">
      <div class="logo">
          <a href="../index.php" style="text-decoration: none;">
              <img src="assets/images/edu.png" alt="">
              <em>BUREAU DES </em> ETUDIANTS
          </a>
      </div>
      
      
      <ul class="links">
          <li class="menu" style="border-bottom: 2px solid #ffc600;"><a href="index.php">ACCUEIL</a></li>
          <li class="menu"><a href="emploi/emploi.php">EMPLOI</a></li>
          <li class="menuPerson w-25">
          <?php foreach ($users as $user):?>
              <?php 
                  if ($user -> imgProfile == "") {
                      echo("
                          <a href='profil/profil.php'  class='user-box1'  style='text-decoration: none; border: none;' class='external'>
                              <img src= 'http://localhost/BE_TWF/API/documents/profil/person.png' alt='user avatar'>
                          </a>
                      ");
                  } 
                  else {?>
                  <a href="profil/profil.php"  class="user-box1"  style="text-decoration: none; border: none;" class="external">
                      <?php echo("
                          <img src=". $user -> imgProfile ." alt=user avatar>
                      ");
                  }?>
              </a>
              <!-- <a href="../profil/profil.php"  class="user-box1"  style="text-decoration: none; border: none;" class="external">
                  <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user avatar">
              </a> -->
          <?php endforeach; ?>
          </li>

          <a href="notification.php" class=" position-relative">
              <i class="fa fa-envelope" style="font-size: 30px; color:white;" ></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                  <?php echo($taille);?>
              </span>
          </a>
      </ul>
      
      
      <div class="right">
        <a href="../Auth/deconnexion.php">
            <button>Déconnexion</button>
        </a>
      </div>
      
      <div class="toggle">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
      </div>
      
      
  </div>

  <!-- ***** Main Banner Area Start ***** -->
  <section class="section main-banner" id="top" data-section="section1" >

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            
      <div class="carousel-inner">
          <div class="carousel-item active">
              <img src="assets/images/techwomen-factory1.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
              <img src="assets/images/Banniere-site-TWF_1.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
              <img src="assets/images/TWF-012022-2_1-768x432.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
              <img src="assets/images/TWF-012022-4_1-768x432.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
              <img src="assets/images/TWF-012022-3_1-768x432.jpg" class="d-block w-100" alt="...">
          </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
  </div>

      <div class="video-overlay header-text" style="background-color: rgba(22,34,57,0.4);">
          <div class="caption">
              <h6>Connectez-vous, informez-vous</h6>
              <h2><em>Votre campus</em> en ligne</h2>
              
          </div>
      </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->


  <section class="features">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="features-post">
            <div class="features-content">
              <div class="content-show">
                <h4><i class="fa fa-pencil"></i>Evenements</h4>
              </div>
              <div class="content-hide">
                <p>Vous desirez rester à l'affût de toutes les nouveautés ? <br>Toutes les informations concernants les planning de cours de remise a niveau, TP et activites para-scloaires vous seront dévoilées </p>
                <p class="hidden-sm">Toutes les informations concernants les planning de cours de remise a niveau, TP et activites para-scloaires vous seront dévoilées.</p>
                <!--<div class="scroll-to-section"><a href="activite.php" style="text-decoration:none;">Savoir plus...</a></div>-->
            </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="features-post second-features">
            <div class="features-content">
              <div class="content-show">
                <h4><i class="fa fa-graduation-cap"></i>FellowShip</h4>
              </div>
              <div class="content-hide">
                <p>Restez connecter entre amis! <br> Cela permet de bâtir un réseau de relations au sein du campus et de voir les realisations des uns et des autres. </p>
                <p class="hidden-sm"> Cela permet de bâtir un réseau de relations au sein du campus et de voir les realisations des uns et des autres </p>
            </div>
            </div>
          </div>
        </div>
      
      </div>
    </div>
  </section>

  <section class="section why-us" data-section="section2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>TECHWOMEN FACTORY</h2>
          </div>
        </div>
        <div class="col-md-12">
          <div id='tabs'>
            <ul>
              <li><a href='#tabs-1'>Art Numerique</a></li>
              <li><a href='#tabs-2'>Data Science</a></li>
              <li><a href='#tabs-3'>Developpement Web</a></li>
            </ul>
            <section class='tabs-content'>
              <article id='tabs-1'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/images/an.jpg" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Art numerique</h4>
                    <p>L’Art numérique ou encore le Digital Art est une forme d’art visuel qui s’est développée à la fin des années 50 et englobe les différentes techniques traditionnelles telles que la peinture, la photographie, la sculpture, l’image en mouvement (l’animation) mais utilise les outils numériques : ordinateur, tablette graphique, stylet et logiciel. </p>
                  </div>
                </div>
              </article>
              <article id='tabs-2'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/images/ds.jpg" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Data sciences</h4>
                    <p>La technologie moderne a permis la création et le stockage de quantités croissantes d’informations, ce qui a fait exploser le volume de données. On estime que 90 % des données dans le monde ont été créées au cours des deux dernières années. </p>
                    <p>La science des données est un domaine interdisciplinaire qui utilise des méthodes, des processus, des algorithmes et des systèmes scientifiques pour extraire des connaissances et des idées de nombreuses données structurelles et non structurées.</p> 

                  </div>
                </div>
              </article>
              <article id='tabs-3'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/images/dw.jpg" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Developpement web</h4>
                    <p>Le développement Web est le travail impliqué dans le développement d'un site Web pour Internet ou un intranet. Le développement Web peut aller du développement d'une simple page statique de texte brut à des applications Web complexes, des entreprises électroniques et des services de réseaux sociau</p>
                  </div>
                </div>
              </article>
            </section>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section coming-soon" data-section="section3" style="background-image:url(assets/images/challeng.jpg);background-color:#172238;">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-xs-12">
          <div class="continer centerIt">
            <div>
              <h4>Participez <em>au challenge des projets</em> et soyez les leaders de votre filiere</h4>
              <div class="counter">

                <div class="days">
                  <div class="value">00</div>
                  <span>Days</span>
                </div>

                <div class="hours">
                  <div class="value">00</div>
                  <span>Hours</span>
                </div>

                <div class="minutes">
                  <div class="value">00</div>
                  <span>Minutes</span>
                </div>

                <div class="seconds">
                  <div class="value">00</div>
                  <span>Seconds</span>
                </div>

              </div>
            </div>
          </div>
        </div>
        
        <!-- Challenge des projets -->
        <div class="col-md-5">
          <div class="right-content">
            <div class="top-content">
              <!-- <h6 style="text-transform: uppercase; color:#f5a425;"> <?php echo $comingevent['titre']?><br><em><?php echo $comingevent['date']?></em> </h6> -->
              <h6 style="text-transform: uppercase; color:#f5a425;"> CHALLENGE DES PROJETS<br><em>2022-08-28</em> </h6>
            </div>
            <div class="item">
            <!-- <img src="<?php echo $comingevent['photo']?>" alt="Course #1" style="width:100%;"> -->
            <img src="assets/images/projet.jpg" alt="Course #1" style="width:100%;">
            <div class="down-content">
              <!-- <p style="color:white;text-align:justify;"><?php echo $comingevent['description']?></p> -->
              <p style="color:white;text-align:justify;">Ce challenge est organisé dans le but de valoriser les compétences acquises au cours 
              des trois mois de formation déjà écoulés, de favoriser le développement de nouvelles habiletés personnelles et interpersonnelles (ex. : habiletés de résolution de problèmes, de gestion du stress, du travail d'équipe) 
              et enfin d'initier l'apprentissage d'une saine attitude face à la victoire et la défaite; La compétition favorise la confiance en soi.</p>
              <div class="text-button-pay">
                <a href="activite.php" style="color:#f5a425; text-decoration:none;">Participer <i class="fa fa-angle-double-right"></i></a>
              </div>
            </div>
          </div>
          </div>
        </div>
        <!-- end Challenge des projets -->

      </div>
    </div>
  </section>

  <section class="section courses" data-section="section4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2 style="color:#f5a425;">TECHWOMEN FACTORY INSIGHT <br><em style="color:white;">Conçu et Réalisé par le Pôle Communication</em> </h2>
          </div>
        </div>
        <div class="owl-carousel owl-theme">
          <div class="item " >
            <img src="assets/images/journal/Capture1.PNG" alt="Course #1">
            <div class="down-content">
              <h4>Mot de Mr Abel</h4>
              <p style="text-align:justify;">Plusieurs parmi les apprenants ne croyaient pas qu’ils allaient atteindre ce niveau d’endurance dans une si courte période.
                </p>
              <div class="author-image">
                <p><b>M. Abdel MEJLAOUI </b><i>Coopérant Canadien/CAYSTI</i> </p>
              </div>
              <br>
              <div class="text-button-pay">
                <a href="assets/TWF INSIGHT No2.pdf" target="_blank">Lire plus(p2)<i class="fa fa-angle-double-right"></i></a>
              </div>
            </div>
          </div>
          <div class="item " >
            <img src="assets/images/journal/Capture2.PNG" alt="Course #1">
            <div class="down-content">
              <h4>High Commissioner of Canada to Cameroon Visits</h4>
              <p style="text-align:justify;">Canada’s High Commissioner to Cameroon, Richard Bale made a visit to the training site. </p>
              <div class="author-image">
                <p><b> Mercy FOSOH </b><i>Techwomen Fellow, Digital Art</i> </p>
              </div>
              <div class="text-button-pay">
                <a href="assets/TWF INSIGHT No2.pdf" target="_blank">Lire plus(p3)<i class="fa fa-angle-double-right"></i></a>
              </div>
            </div>
          </div>
          
          
          <div class="item">
            <img src="assets/images/journal/Capture3.PNG" alt="">
            <div class="down-content">
              <h4>COMMENT LES BOURSIERS VENUS DES AUTRES VILLES S’INTÈGRENT</h4>
              <p>Ils ont reçu l’information par les réseaux sociaux, par l’intermédiaire d’un de leurs proches, ils n’ont pas hésité à postuler et ce fut la satisfaction</p>
              <div class="author-image">
              <p><b>  Lys KAMNO et Lionel WASSOUMI</b><i>Boursiers, parcours Art Numérique</i> </p>
              </div>
              <div class="text-button-pay">
                <a href="assets/TWF INSIGHT No2.pdf" target="_blank">Lire plus(p4) <i class="fa fa-angle-double-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
    
  <section class="section video" data-section="section5" style="background-image: url(assets/images/choosing-bg.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <span>Vos difficultés sont les notres</span>
            <h4>Regarder la video pour apprendre comment <em> créer son compte prépayé UBA</em></h4>
            <p>La carte prépayée UBA Africard est une carte de débit prépayée Visa rechargeable dans toutes les agences UBA. C’est le meilleur moyen sécurisé d’effectuer des transactions financières en ligne. Véritable porte-monnaie électronique, elle est émise de façon instantanée en quelques minutes séance tenante et n’est pas liée à un compte. Elle est internationalement accepté dans tous les points d’acceptation Visa (ATM, POS & Web) dans plus de 200 pays.</p>
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>Creation de compte en ligne</h4>
            </div>
            <figure>
              <a href="assets/images/video.mp4" class="play"><img src="assets/images/uba.jpg"></a>
            </figure>
          </article>
        </div>
      </div>
    </div>
  </section>
            <hr style="height:10px; background-color:#f5a425; color:#f5a425;">
  <section class="section contact" data-section="section6" style="background-color:#172238;">
    <div class="container" >
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Conctatez l'administration</h2>
          </div>
        </div>
        <div class="col-md-6">
                    
          <form id="contact" action="" method="POST">
            <div class="row">
              <div class="col-md-6">
                  <fieldset>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Nom" required="">
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset>
                    <input name="email" type="text" class="form-control" id="email" placeholder="Email" required="">
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset>
                    <input name="bjet" type="text" class="form-control" id="name" placeholder="object" required="">
                  </fieldset>
                </div>
              <div class="col-md-12">
                <fieldset>
                  <textarea name="message" rows="6" class="form-control" id="message" placeholder="Message" required=""></textarea>
                </fieldset>
              </div>
              <div class="col-md-12">
                <fieldset>
                  <button name="envoyer" type="submit" id="form-submit" class="button">Envoyer</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
        <!-- google map -->
        <div class="col-md-6">
          <div id="map">
            <div class="mapouter"><div class="gmap_canvas">
              <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=yaounde,%20institut%20national%20de%20formation%20des%20formateurs%20et%20de%20developpement%20des%20programmes&t=k&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
              <a href="https://www.whatismyip-address.com/divi-discount/">divi discount</a>
              <br>
              <style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style>
              <a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
              <style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style>
            </div>
          </div>
        </div>
        <!-- end google map -->
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p><i class="fa fa-copyright"></i> Copyright 2022 Bureau des Etudiants  
          | Design: <a href="#" rel="sponsored" target="_parent">Techwomen Factory</a> | by Caysti</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script  src="assets/js/navbar.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .scroll-to-section').on('click', 'a', function (e) {
          if($(e.target).hasClass('external')) {
            return;
          }
          e.preventDefault();
          $('#menu').removeClass('active');
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>
</html>