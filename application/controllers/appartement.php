<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Appartements extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model("Appartements_model");
    $this->load->helper("url_helper");
    $this->load->library('session');
    $this->load->helper('date');
  }

  /**
   * Charge le contenu a afficher dans <div id="content"> lors d'une connexion
   */
  public function ajouter_appartement() {
    $this->load->view("appartements/appartement-form.php");
  }
  public function enregistrer(){

  }

}
?>