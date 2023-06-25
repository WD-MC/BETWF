
<?php
    // fichier qui permet de traiter les demandes qui seront reçu via l'url 
    require_once("dataManager/read.php");

    try{
        if(!empty($_GET['demande'])){
            //decompose l'url et recupere la demande a traite
            $url = explode("/", filter_var($_GET['demande'],FILTER_SANITIZE_URL));
            
            //verifie si la demande est celle souhaitee
            switch ($url[0]) {
                
                case 'offres': 
                    
                    if (empty($url[1])) {
                        getOffre();
                    }else {
                        getOffreByValeur($url[1]);
                    }
                break;
                case 'etudiants': 
                    if (empty($url[1])) {
                        getEtudiant();
                    }else {
                        getEtudiantById($url[1]);
                    }
                break;
                case 'souscriptions':
                    if (empty($url[1])) {
                        getSouscription();
                    }else {
                        getSouscriptionByID($url[1]);
                    }
                break;
                case 'notifications':
                    getNotificationByID($url[1]);
                break;    
                default:
                    throw new Exception("La demande n'est pas valide verifier l'url");
                    
                break;
            }
        }else {
            throw new Exception("Probleme de recuperation de donnees");
            
        }
    } catch (Exception $e) {
        $erreur = [
            "message" => $e->getMessage(),
            "code" => $e->getCode()
        ];
        print_r($erreur);
    }
        