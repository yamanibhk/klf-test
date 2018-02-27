<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model("Usagers_model");
    $this->load->model("Appartements_model");
    $this->load->model("Arrondissements_model");
    $this->load->helper("url_helper");
    $this->load->library('session');
    $this->load->library('modalmenus');
    $this->load->helper('date');
  }

  public function index() {
    if($this->session->userdata("nomUsager")){
      if ( !file_exists(APPPATH.'views/accueil/index.php')) {
        show_404 ();
      } else {
        //Mets les infos de l'usager dans une variable
        $data['utilisateur'] = $this->session->get_userdata();
        //Charge les menus
        $data['menus'] = $this->modalmenus->chargeMenus();
        $data['appartementsVedettes'] = $this->Appartements_model->obtenir_appartementsVedette();
					
				$succes = true;
				$arrondissement = $this->input->post("arrondissement");	
				$dateDebut=$this->input->post("dateDebut");
				$dateFin=$this->input->post("dateFin");
				$nbrPiece=$this->input->post("nbrAdulte")+$this->input->post("nbrEnfant");
				$codePostal=$this->input->post("codePostal");
				$numEtage=$this->input->post("numEtage");
				$typeLogement=$this->input->post("typeLogement");
				$nbreStatio=$this->input->post("nbreStatio");
				$internet=$this->input->post("internet");
				$television=$this->input->post("television");
				$climatiseur=$this->input->post("climatiseur");
				$adapte=$this->input->post("adapte");
				$meuble=$this->input->post("meuble");
				$lavSech=$this->input->post("lavSech");
				$lavVaiss=$this->input->post("lavVaiss");
				$intervAcc=$this->input->post("intervAcc");
				$prixMin=$this->input->post("prixMin");
				$prixMax=$this->input->post("prixMax");				
				
        $data['arrondissement'] = $this->Arrondissements_model->obtenir_arrondissement();
				$data['codePosteaux'] = $this->Arrondissements_model->obtenir_codePostal();
				$data['appartements'] = $this->Appartements_model->obtenir_appartements(
				$arrondissement,$dateDebut, $dateFin,$nbrPiece,$codePostal,   
				$numEtage,$typeLogement, $nbreStatio,$internet,$television,$climatiseur,$adapte,$meuble,
				$lavSech,$lavVaiss,$intervAcc,$prixMin,$prixMax);
        $data["titre"] = "ACCUEIL";//Le titre de la page
        $this->load->view("templates/header.php", $data);
        $this->load->view("templates/barre-rouge.php", $data);
        $this->load->view("accueil/index.php", $data);
        $this->load->view("accueil/modal.php", $data);
        $this->load->view("templates/footer.php", $data);
      }
    } else {
      header("Location: ".base_url());
    }
  }

}

