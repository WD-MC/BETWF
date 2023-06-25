<?php 

    session_start();
    if (isset($_SESSION['user_id'])){
      if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
        $username = $_SESSION['username'];
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="assets/images/favicon_twf.svg"
      type="image/x-icon"
    />
    <title>new offre | Bureau des etudiants TWF</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
      <div class="navbar-logo">
        <a href="accueil_admin.php">
          <h4>Bureau Des Etudiants TWF Admin</h1>
        </a>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_1"
              aria-controls="ddmenu_1"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22">
                  <path
                    d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                  />
                </svg>
              </span>
              <span class="text">Dashboard</span>
            </a>
            <ul id="ddmenu_1" class="collapse show dropdown-nav">
              <li>
                <a href="accueil_admin.php" > Offres d'emploies </a>
              </li>
              <li>
                <a href="new_offre.php" class="active"> Créer une offre </a>
              </li>
            </ul>
          </li>

          <span class="divider"><hr /></span>
          <li class="nav-item">
            <a href="etudiant.php">
              <span class="icon">
                <svg
                  width="22"
                  height="22"
                  viewBox="0 0 22 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M4.58333 3.66675H17.4167C17.9029 3.66675 18.3692 3.8599 18.713 4.20372C19.0568 4.54754 19.25 5.01385 19.25 5.50008V16.5001C19.25 16.9863 19.0568 17.4526 18.713 17.7964C18.3692 18.1403 17.9029 18.3334 17.4167 18.3334H4.58333C4.0971 18.3334 3.63079 18.1403 3.28697 17.7964C2.94315 17.4526 2.75 16.9863 2.75 16.5001V5.50008C2.75 5.01385 2.94315 4.54754 3.28697 4.20372C3.63079 3.8599 4.0971 3.66675 4.58333 3.66675ZM4.58333 7.33341V11.0001H10.0833V7.33341H4.58333ZM11.9167 7.33341V11.0001H17.4167V7.33341H11.9167ZM4.58333 12.8334V16.5001H10.0833V12.8334H4.58333ZM11.9167 12.8334V16.5001H17.4167V12.8334H11.9167Z"
                  />
                </svg>
              </span>
              <span class="text">Etudiants</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="postuler.php">
              <span class="icon">
                <svg
                  width="22"
                  height="22"
                  viewBox="0 0 22 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M9.16667 19.25H12.8333C12.8333 20.2584 12.0083 21.0834 11 21.0834C9.99167 21.0834 9.16667 20.2584 9.16667 19.25ZM19.25 17.4167V18.3334H2.75V17.4167L4.58333 15.5834V10.0834C4.58333 7.24171 6.41667 4.76671 9.16667 3.94171V3.66671C9.16667 2.65837 9.99167 1.83337 11 1.83337C12.0083 1.83337 12.8333 2.65837 12.8333 3.66671V3.94171C15.5833 4.76671 17.4167 7.24171 17.4167 10.0834V15.5834L19.25 17.4167ZM15.5833 10.0834C15.5833 7.51671 13.5667 5.50004 11 5.50004C8.43333 5.50004 6.41667 7.51671 6.41667 10.0834V16.5H15.5833V10.0834Z"
                  />
                </svg>
              </span>
              <span class="text">Offres Postulées</span>
            </a>
          </li>

          <span class="divider"><hr /></span>
          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_3"
              aria-controls="ddmenu_3"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg
                  width="22"
                  height="22"
                  viewBox="0 0 22 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M12.9067 14.2908L15.2808 11.9167H6.41667V10.0833H15.2808L12.9067 7.70917L14.2083 6.41667L18.7917 11L14.2083 15.5833L12.9067 14.2908ZM17.4167 2.75C17.9029 2.75 18.3692 2.94315 18.713 3.28697C19.0568 3.63079 19.25 4.0971 19.25 4.58333V8.86417L17.4167 7.03083V4.58333H4.58333V17.4167H17.4167V14.9692L19.25 13.1358V17.4167C19.25 17.9029 19.0568 18.3692 18.713 18.713C18.3692 19.0568 17.9029 19.25 17.4167 19.25H4.58333C3.56583 19.25 2.75 18.425 2.75 17.4167V4.58333C2.75 3.56583 3.56583 2.75 4.58333 2.75H17.4167Z"
                  />
                </svg>
              </span>
              <span class="text">Auth</span>
            </a>
            <ul id="ddmenu_3" class="collapse dropdown-nav">
              <li>
                <a href="../app_superAdmin/logout.php"> Déconnexion </a>
              </li>
            </ul>
          </li>

    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <!-- ========== header start ========== -->
      <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-20">
                  <button
                    id="menu-toggle"
                    class="main-btn primary-btn btn-hover"
                  >
                    <i class="lni lni-chevron-left me-2"></i> Menu
                  </button>
                </div>
                
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">
                
                <!-- profile start -->
                <div class="profile-box ml-15">
                  <button
                    class="dropdown-toggle bg-transparent border-0"
                    type="button"
                    id="profile"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <div class="profile-info">
                      <div class="info">
                        <h6><?php echo $username; ?></h6>
                        <div class="image">
                          <img
                            src="assets/images/profile/profile-image.png"
                            alt=""
                          />
                          <span class="status"></span>
                        </div>
                      </div>
                    </div>
                    <i class="lni lni-chevron-down"></i>
                  </button>
                  <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="profile"
                  >
                    <li>
                      <a href="profil.html">
                        <i class="lni lni-user"></i> Mon Profil
                      </a>
                    </li>
                    <li>
                      <a href="#0"> <i class="lni lni-exit"></i> Déconnexion </a>
                    </li>
                  </ul>
                </div>
                <!-- profile end -->
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- ========== header end ========== -->

      <!-- ========== tab components start ========== -->
      <section class="tab-components">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title mb-30">
                  <h2>Nouvelle Offre</h2>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="#0">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Créer une offre
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

          <!-- ========== form-elements-wrapper start ========== -->
          <div class="form-elements-wrapper">
            
            <form action="../API/dataManager/create.php" method="POST">
              <div class="row">
                <div class="col-lg-12">
                  <!-- input style start -->
                  <div class="card-style mb-30">
                    
                      <input type="hidden" name="action" value="newOffre">

                      <div class="input-style-1">
                        <label>Détails sur l'offre</label>
                        <input type="text" name="titreoffre"  placeholder="Titre de l'offre" required/>
                      </div>
                      <div class="input-style-2">
                        <input type="text" name="lieu" placeholder="Lieu" required/>
                        <!-- <span class="icon"> <i class="lni lni-user"></i> </span> -->
                      </div>
                      <!-- end input -->
                      <div class="input-style-2">
                        <input type="text" name="typePoste" placeholder="Type de poste" required/>
                        <!-- <span class="icon"> <i class="lni lni-user"></i> </span> -->
                      </div>
                      <!-- end input -->
                      <div class="input-style-3">
                        <input type="text" name="entreprise" placeholder="Entreprise" required/>
                        <span class="icon"><i class="lni lni-user"></i></span>
                      </div>
                      <div class="input-style-3">
                        <input type="text"  name="description" placeholder="Description" required/>
                        <span class="icon"><i class="lni lni-user"></i></span>
                      </div>
                      <div class="input-style-2">
                        <select class="form-control" name="parcours" required>
                          <option value="">Choisir un parcours</option>
                          <option value="art_numerique">Art Numérique</option>
                          <option value="developpement_web">Développement Web</option>
                          <option value="data_science">Data science</option>
                        </select>
                      </div>
                      <div class="input-style-1">
                        <label>Date limite</label>
                        <input name="date" type="date" required/>
                      </div>
                    
                    
                    <!-- end input -->
                  </div>
                  <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-lg-12">
                  <!-- ======= textarea style start ======= -->
                  <div class="card-style mb-30">
                    <h6 class="mb-25">Textarea</h6>
                    <div class="input-style-1">
                      <label>Compétences</label>
                      <textarea name="compétences" placeholder="Compétences" rows="5" required></textarea>
                    </div>
                    <div class="input-style-1">
                      <label>Message de confirmation</label>
                      <textarea name="message" placeholder="Message" rows="5" required></textarea>
                    </div>
                  </div>
                  <!-- ======= textarea style end ======= -->

                </div>
                <!-- end col -->
                <input type="submit" class=" btn btn-primary w-50 m-auto" name="submit" value="Enregistrer"/>
                <!-- <button class="btn btn-primary w-50 m-auto">Enregistrer</button> -->
              </div>
            </form>
            <!-- end row -->
          </div>
          <!-- ========== form-elements-wrapper end ========== -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== tab components end ========== -->

      <!-- ========== footer start =========== -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 order-last order-md-first">
              <div class="copyright text-center text-md-start">
                <p class="text-sm">
                  Designed and Developed by
                  <a
                  href="0#"
                  >
                    Caysti
                  </a>
                  <!-- <a
                    href="https://plainadmin.com"
                    rel="nofollow"
                    target="_blank"
                  >
                    Caysti
                  </a> -->
                </p>
              </div>
            </div>
            <!-- end col-->
            <div class="col-md-6">
              <div
                class="
                  terms
                  d-flex
                  justify-content-center justify-content-md-end
                "
              >
                <a href="#0" class="text-sm">Term & Conditions</a>
                <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
              </div>
            </div>
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </footer>
      <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/dynamic-pie-chart.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>
    <script src="assets/js/jvectormap.min.js"></script>
    <script src="assets/js/world-merc.js"></script>
    <script src="assets/js/polyfill.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
