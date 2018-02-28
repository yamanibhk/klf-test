<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usagers extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model("Usagers_model");
    $this->load->model("Moyen_contact_model");
    $this->load->model("Mode_paiement_model");
    $this->load->library('modalmenus');
    $this->load->helper("url_helper");
    $this->load->library('session');
    $this->load->helper('date');
  }

  /**
   * Charge la page d'un profil d'utilisateur
   */
  public function index() {
    if($this->session->userdata("nomUsager")){
      if ( !file_exists(APPPATH.'views/usagers/index.php')) {
        show_404 ();
      } else {
        //Mets les infos de l'usager dans une variable
        $data['utilisateur'] = $this->Usagers_model->obtenir_usager($this->session->userdata("nomUsager"));
        $data['mode_paiements'] = $this->Mode_paiement_model->obtenir_tous();
        //Charge les menus
        $data['menus'] = $this->modalmenus->chargeMenus();
        $data["titre"] = "MON COMPTE";//Le titre de la page
        $this->load->view("templates/header.php", $data);
        $this->load->view("templates/barre-rouge.php", $data);
        $this->load->view("usagers/index.php", $data);
        $this->load->view("templates/modalmenus.php", $data);
        $this->load->view("templates/footer.php", $data);
      }
    } else {
      header("Location: ".base_url());
    }
  }

  public function modifier_infos() {
    if($this->session->userdata("nomUsager")){
      $valide = true;

      $nomUsager = strtolower($this->input->post("nomUsager"));
      $prenom = strtolower($this->input->post("prenom"));
      $nom = strtolower($this->input->post("nom"));
      $adresse = strtolower($this->input->post("adresse"));
      $mode_paiement = strtolower($this->input->post("mode_paiement"));
      $cheminPhoto = strtolower($this->input->post("cheminPhoto"));

      //Si l'usager qu'on tente de modifier n'est pas l'utilisateur actif
      if($nomUsager != strtolower($this->session->userdata("nomUsager"))) {
        $valide = false;
      } else {
        if($this->Usagers_model->modifier_usager($nomUsager, $nom, $prenom, $adresse, $mode_paiement, $cheminPhoto)){
          echo true;
        } else {
          echo false;
        }
      }
    } else {
      header("Location: ".base_url());
    }
  }

  /*
   * Obtient un usager dans la base de donnees
  */
  public function obtenir_usager() {
    $nomUsager = $this->input->post("nomUsager");
    if(isset($nomUsager)) {
      if($nomUsager != "") {
        // vérifier l'existance d'un usager dans le model usager
        $usager = $this->Usagers_model->obtenir_usager($nomUsager);
        if($usager) {
          $reponse = ["existe" => true];
        } else {
          $reponse = ["existe" => false];
        }
        header('Content-Type: application/json');
        echo json_encode($reponse);
      }
    }
  }

  /*
   * Obtient un courriel dans la base de donnees
  */
  public function obtenir_courriel() {
    $courriel = $this->input->post("courriel");
    if(isset($courriel)) {
      if($courriel != "") {
        // vérifier l'existance d'un courriel dans la bd
        $reponseCourriel = $this->Moyen_contact_model->obtenir_courriel($courriel);
        if($reponseCourriel) {
          $reponse = ["existe" => true];
        } else {
          $reponse = ["existe" => false];
        }
        header('Content-Type: application/json');
        echo json_encode($reponse);
      }
    }
  }

  /*
   * connexion a la plateforme du site
  */
  public function connexion() {
    $nomUsager = $this->input->post("nomUsager");
    $motDePasse = $this->input->post("motDePasse");
    $succes = true;
    if(!isset($nomUsager) || !isset($motDePasse)) {
      $succes = false;
    } else {
      if($nomUsager == "" || $motDePasse == "") {
        $succes = false;
      } else {
        //vérifier les données usager dans le model usager
        $resultat = $this->Usagers_model->verifier_connexion($nomUsager, $motDePasse);
        //Si l'usager existe
        if($resultat['existe']) {
          //On verifi s'il est bani
          if ($resultat['estBanni'] == true) {
            $reponse = ["statut" => "banni"];
            //S'il existe, mais qu'ill est n'est pas valide, on retourne false en indiquant pourquoi
          } elseif ($resultat['estValide'] == false) {
            $reponse = ["statut" => "nonValide"];
            //S'il existe, mais qu'ill est n'est pas valide, on retourne false en indiquant pourquoi
          } else {
            $utilisateur = $this->Usagers_model->obtenir_usager($nomUsager);
            //Cree la session avec un username
            $this->session->set_userdata($utilisateur);
            $reponse = ["statut" => "valide", "idRole" => $utilisateur["idRole"]];
          }
          //S'il existe, mais qu'il est bani, on retourne false en indiquant pourquoi
        } else {
          $reponse = ["statut" => "nonexistant"];
        }
      }
    }
    header('Content-Type: application/json');
    if($succes){
      echo json_encode($reponse);
    } else {
      echo false;
    }
  }

  /**
   * Affiche un message personnalise si un usager n'est pas valide ou s'il est banni
   */
  public function connexion_message () {
    $message = $this->input->post("message");
    if(isset($message) && strlen($message) > 0) {
      $data["message"] = $message;
      $this->load->view("atterrissage/connexion-error.php", $data);
    }
  }

  /**
   * Detruit la session et renvoie a l'atterrissage
   */
  public function deconnexion () {
    $this->session->sess_destroy();
    redirect();
  }
  /*
   * insertion d'un nouveau utilisateur dans la base de donnée
  */
  public function inscription() {
    $succes = true;
    $nomUsager = $this->input->post('nomUsager');
    $motDePasse = $this->input->post('motDePasse');
    $courriel = $this->input->post('courriel');

    //S'il y a des donnees ne sont pas recues
    if(!isset($nomUsager) || !isset($motDePasse) || !isset($courriel)) {
      $succes = false;
    } else {
      //S'il y a des donnees qui sont vides
      if($nomUsager == "" || $motDePasse == "" || $courriel == "") {
        $succes = false;
      } else {
        // ajout d'un usager dans le model usager
        $resultat = $this->Usagers_model->ajouter_usager($nomUsager, $motDePasse, $courriel);
        if(!$resultat) {
          $succes = false;
        }
      }
    }
    if($succes) {
      $data["erreur"] = false;
      /*
      $this->load->library('email');
      $this->email->from('s.leila94@gmail.com', 'Leila');
      $this->email->to($courriel);
      $this->email->subject("Email de validation");
      $this->email->message("Merci pour votre inscription, votre compte sera bientôt validé par l'administrateur.");
      $this->email->send();
      */
    } else {
      $data["erreur"] = true;
    }
    $this->load->view("atterrissage/inscription-confirmation.php", $data);
  }

  /**
   * Sert a bannir un usager du site web
   *
   * @param      string  $nomUsager  Le nom de l'usager
   */
  public function bannir() {
    $usagerABannir = $this->Usagers_model->obtenir_usager($this->input->post('nomUsager'));
    //Si l'usager existe dans la BD
    if($usagerABannir) {
      $peutBannir = true;
      //Si l'usager dans la session ne serait pas admin
      if($this->session->userdata("idRole") > 1) {
        $peutBannir = false;
        //Si l'usager dans la session est un admin et que la personne a bannir est aussi un admin
      } else if ($this->session->userdata("idRole") == 1 && $usagerABannir["idRole"] == 1) {
        $peutBannir = false;
      }
      if($peutBannir) {
        $this->Usagers_model->BannirInbannir_usager($usagerABannir['nomUsager'], 1);
      }
    }
  }

  /**
   * Sert a bannir un usager du site web
   *
   * @param      string  $nomUsager  Le nom de l'usager
   */
  public function gracier() {
    $usagerAGracier = $this->Usagers_model->obtenir_usager($this->input->post('nomUsager'));
    //Si l'usager existe dans la BD
    if($usagerAGracier) {
      $peutGracier = true;
      //Si l'usager dans la session ne serait pas admin
      if($this->session->userdata("idRole") > 1) {
        $peutGracier = false;
        //Si l'usager dans la session est un admin et que la personne a gracier est aussi un admin
      } else if ($this->session->userdata("idRole") == 2 && $usagerAGracier["idRole"] == 2) {
        $peutGracier = false;
      }
      if($peutGracier) {
        $this->Usagers_model->BannirInbannir_usager($usagerAGracier['nomUsager'], 0);
      }
    }
  }

  /**
   * Sert a valider un usager du site web
   *
   * @param      string  $nomUsager  Le nom de l'usager
   */
  public function valider() {
    $usagerAValider = $this->Usagers_model->obtenir_usager($this->input->post('nomUsager'));
    //Si l'usager existe dans la BD
    if($usagerAValider) {
      $peutValider = true;
      //Si l'usager dans la session ne serait pas admin
      if($this->session->userdata("idRole") > 1) {
        $peutValider = false;
      }
      if($peutValider) {
        $this->Usagers_model->changeStatusValide_usager($usagerAValider['nomUsager'], 1);
      }
    }
  }

  /**
   * Sert a rendre un usager administrateur
   *
   * @param      string  $nomUsager  Le nom de l'usager
   */
  public function faire_admin() {
    $usagerAFaireAdmin = $this->Usagers_model->obtenir_usager($this->input->post('nomUsager'));
    //Si l'usager existe dans la BD
    if($usagerAFaireAdmin) {
      //Si l'usager dans la session est super-admin
      if($this->session->userdata("idRole") == 0) {
        $this->Usagers_model->changeIdRole($usagerAFaireAdmin['nomUsager'], 1);
      }
    }
  }

   /**
   * Sert a retirer le role d'administrateur d'un usager
   *
   * @param      string  $nomUsager  Le nom de l'usager
   */
  public function retirer_admin() {
    $usagerAFaireAdmin = $this->Usagers_model->obtenir_usager($this->input->post('nomUsager'));
    //Si l'usager existe dans la BD
    if($usagerAFaireAdmin) {
      //Si l'usager dans la session est super-admin
      if($this->session->userdata("idRole") == 0) {
        $this->Usagers_model->changeIdRole($usagerAFaireAdmin['nomUsager'], 2);
      }
    }
  }
}//Fin de la classe