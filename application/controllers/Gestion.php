<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion extends CI_Controller {

  /**
   * Constructeur de la classe
   */
  public function __construct() {
    parent::__construct();
    $this->load->model("Usagers_model");
    $this->load->model("Arrondissements_model");
    $this->load->helper("url_helper");
    $this->load->library('session');
    $this->load->helper('date');
    $this->load->library('modalmenus');
  }


  /**
   * Foncfion par defaut du controlleur, redirige vers le panneau d'administration
   */
  public function index() {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2){
      if ( !file_exists(APPPATH.'views/gestion/index.php')) {
        show_404 ();
      } else {
        //Charge les menus
        $data['menus'] = $this->modalmenus->chargeMenus();
        $data["titre"] = "GESTION DU SITE";//Le titre de la page
        $data['utilisateur'] = $this->session->get_userdata();
        $this->load->view("templates/header.php", $data);
        $this->load->view("templates/barre-rouge.php", $data);
        $this->load->view("gestion/index.php", $data);
        $this->load->view("accueil/modal.php", $data);
        $this->load->view("templates/footer.php", $data);
      }
    } else {
      header("Location: ".base_url());
    }
  }


  /**
   * Retournera la liste des usagers sous forme de vue partielle
   */
  public function usagers() {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      //Usager actif (session)
      $data['utilisateur'] = $this->session->get_userdata();
      //Liste des usagers
      $data['usagers'] = $this->Usagers_model->obtenir_usagers();
      $this->load->view("gestion/liste-usagers.php", $data);
    } else {
      header("Location: ".base_url());
    }
  }


  /**
   * Affiche des statistique sur le site sous forme de vue partielle
   */
  public function statistiques() {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      echo "controlleur - 'charger statistiques'";
    } else {
      header("Location: ".base_url());
    }
  }


  /**
   * Affiche les arrondissement de la BD sous forme de vue partielle
   */
  public function voir_arrondissements() {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      $data['arrondissements'] = $this->Arrondissements_model->obtenir_arrondissements();
      $this->load->view("gestion/liste-arrondissements.php", $data);
    } else {
      header("Location: ".base_url());
    }
  }
  /**
   * Modifie un arrondissement de la BD
   */
  public function modifier_arrondissement($id) {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      if($this->Arrondissements_model->obtenir_arrondissement($id)){
        $this->Arrondissements_model->modifier_arrondissement($id, $this->input->post("valeur"));
      }
    } else {
      header("Location: ".base_url());
    }
  }
  /**
   * Modifie un arrondissement de la BD
   */
  public function supprimer_arrondissement($id) {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      if($this->Arrondissements_model->obtenir_arrondissement($id)){
        $this->Arrondissements_model->supprimer_arrondissement($id);
      }
    } else {
      header("Location: ".base_url());
    }
  }
  /**
   * Modifie un arrondissement de la BD
   */
  public function ajouter_arrondissement() {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      $this->Arrondissements_model->ajouter_arrondissement($this->input->post("valeur"));
    } else {
      header("Location: ".base_url());
    }
  }


  /**
   * Affiche les moyens de paiement de la bd sous forme de vue partielle
   */
  public function moyensDePaiements() {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      echo "controlleur - 'charger liste des moyensDePaiements'";
    } else {
      header("Location: ".base_url());
    }
  }

}//Fin de la classe gestion