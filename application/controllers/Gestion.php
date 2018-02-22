<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model("Usagers_model");
    $this->load->helper("url_helper");
    $this->load->library('session');
    $this->load->helper('date');
    $this->load->library('modalmenus');
  }


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


  public function usagers() {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      $data['usagers'] = $this->Usagers_model->obtenir_usagers();
      $this->load->view("gestion/liste-usagers.php", $data);
    } else {
      header("Location: ".base_url());
    }
  }


  public function annonces() {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      echo "controlleur - 'charger liste des annonces'";
    } else {
      header("Location: ".base_url());
    }
  }


  public function statistiques() {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      echo "controlleur - 'charger statistiques'";
    } else {
      header("Location: ".base_url());
    }
  }


  public function arrondissements() {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      echo "controlleur - 'charger liste des arrondissements'";
    } else {
      header("Location: ".base_url());
    }
  }


  public function moyensDePaiements() {
    if($this->session->userdata("nomUsager") && $this->session->userdata("idRole") < 2) {
      echo "controlleur - 'charger liste des moyensDePaiements'";
    } else {
      header("Location: ".base_url());
    }
  }

}//Fin de la classe gestion