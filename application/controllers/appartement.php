<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class appartement extends CI_Controller {

  public function __construct() {
    parent::__construct();
    //$this->load->model("Appartements_model");
    $this->load->helper("url_helper");
    $this->load->library('session');
    $this->load->helper('date');
  }

  /**
   * Charge le contenu a afficher dans <div id="content"> lors d'une connexion
   */
  public function ajouter() {
    $data["titre"] = "Ajouter une annonce";//mettre un titre a la page ajout
    //Load the views
    $this->load->view("templates/header.php", $data);
    $this->load->view("accueil/appartement-form.php",$data);
    $this->load->view("templates/footer.php", $data);
    
  }
  public function enregistrer(){

  }

}
?>