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
		$this->load->helper('text');
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
				$idArrondissement=""; $dateDebut=""; $dateFin="";$nbrPiece='0';$codePostal="";   
				$numEtage="";$typeLogement=""; $nbreStatio="";$internet='0';$television='0';$climatiseur='0';$adapte='0';$meuble='0';
				$lavSech='0';$lavVaiss='0';$intervAcc='0';$prixMin="";$prixMax="";
        $data['arrondissement'] = $this->Arrondissements_model->obtenir_arrondissements();
				$data['codePosteaux'] = $this->Arrondissements_model->obtenir_codePostal();
				$data['lesappartements'] = $this->Appartements_model->obtenir_appartements($idArrondissement,$dateDebut, $dateFin,$nbrPiece,$codePostal,$numEtage,$typeLogement,$nbreStatio,$internet,$television,$climatiseur,$adapte,$meuble,$lavSech,$lavVaiss,$intervAcc,$prixMin,$prixMax);
				$data["titre"] = "ACCUEIL";//Le titre de la page
        $this->load->view("templates/header.php", $data);
        $this->load->view("templates/barre-rouge.php", $data);
        $this->load->view("accueil/modal.php", $data);
        $this->load->view("templates/footer.php", $data);
				$this->load->view("accueil/index.php", $data);
				$this->load->view("accueil/listeAppartTrouve.php", $data);
				echo"</div></div></div>";
      }
    } else {
      header("Location: ".base_url());
    }
  }
	
	
	public function listeAppartTrouve() {
    if($this->session->userdata("nomUsager")){
      if ( !file_exists(APPPATH.'views/accueil/index.php')) {
        show_404 ();
      } else {
        $succes = true;
				$idArrondissement =$this->input->post("idArrondissement");	
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
				$data['lesappartements'] = $this->Appartements_model->obtenir_appartements($idArrondissement,$dateDebut, $dateFin,$nbrPiece,$codePostal,
				$numEtage,$typeLogement, $nbreStatio,$internet,$television,$climatiseur,$adapte,$meuble,$lavSech,$lavVaiss,$intervAcc,$prixMin,$prixMax);
				
				$this->load->view("accueil/listeAppartTrouve.php", $data);
				echo"</div></div></div>";
      }
    } else {
      header("Location: ".base_url());
    }
  }
	
}



