<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Messagerie extends CI_Controller {

  /**
   * contructeur de la classe
   */
  public function __construct() {
    parent::__construct();
    $this->load->model("messageries_model");
    $this->load->library('modalmenus');
    $this->load->helper("url_helper");
    $this->load->library('session');
    $this->load->helper('date');
  }

  /**
   * Charge la page de messagerie
   */
  public function index() {
    if($this->session->userdata("nomUsager")){
      if ( !file_exists(APPPATH.'views/accueil/index.php')) {
        show_404 ();
      } else {
        //Mets les infos de l'usager dans une variable
        $data['utilisateur'] = $this->session->get_userdata();
        //Charge les menus
        $data['menus'] = $this->modalmenus->chargeMenus();

        $data["titre"] = "MESSAGERIE";//Le titre de la page
        $this->load->view("templates/header.php", $data);
        $this->load->view("templates/barre-rouge.php", $data);
        $this->load->view("messagerie/index.php", $data);
        $this->load->view("templates/modalmenus.php", $data);
        $this->load->view("templates/footer.php", $data);
      }
    } else {
      header("Location: ".base_url());
    }
  }
}//Fin de la classe