<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usagers extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model("Usagers_model");
    $this->load->helper("url_helper");
    $this->load->library('session');
    //chargement de la librairie pour la validation du formulaire
    $this->load->library('form_validation');
    $this->load->helper('form');
    $this->load->helper('date');
  }

  /**
   * Affiche la page d'accueil
   */
  public function accueil() {
    // charger les vues
    $this->load->view("templates/header.php");
    $this->load->view("accueil/index");
    $this->load->view("templates/footer.php");
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
        $reponseCourriel = $this->Usagers_model->obtenir_courriel($courriel);
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
            $reponse = ["statut" => "valide"];
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
    die("on deconnecte");
  }

  /*
   * insertion d'un nouveau utilisateur dans la base de donnée
  */
  public function inscription() {
    $nomUsager = $this->input->post("nomUsager");
    $motDePasse = $this->input->post("motDePasse");
    $courriel = $this->input->post("courriel");
    $succes = true;

    //S'il y a des donnees ne sont pas recues
    if(!isset($nomUsager) || !isset($motDePasse) || !isset($courriel))  {
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

}//Fin de la classe