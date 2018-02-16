<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model("Usagers_model");
    $this->load->helper("url_helper");
    $this->load->library('session');
    $this->load->helper('date');
  }
  public function index() {
    $data['utilisateur']=$this->session->get_userdata();
    $this->load->view("accueil/index.php", $data);
  }
}
