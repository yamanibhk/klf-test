<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class appartement extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model("Appartements_model");
    $this->load->model("Arrondissements_model");
    $this->load->helper("url_helper");
    $this->load->library('session');
    $this->load->library('modalmenus');
    $this->load->helper('date');
  }

  /**
   * afficher les appartement d'un usager
   */
    public function index() {
    if($this->session->userdata("nomUsager")) {
      if ( !file_exists(APPPATH.'views/accueil/index.php')) {
        show_404 ();
      } else {
        $data['menus'] = $this->modalmenus->chargeMenus();
        //Le titre de la page
        $data["titre"] = "MES LOGEMENTS";
        $data['utilisateur'] = $this->session->get_userdata();
        //obtenir la liste des logements d'un usager
        $data['appartement'] = $this->Appartements_model->obtenir_appartement($data['utilisateur']['nomUsager']);
        $this->load->view("templates/header.php", $data);
        $this->load->view("templates/barre-rouge.php", $data);
        $this->load->view("appartement/index.php", $data);
        $this->load->view("templates/modalmenus.php", $data);
        $this->load->view("templates/footer.php", $data);
      }
    } else {
      header("Location: index.php/atterrissage/index");
    }
  }

  /**
   * charge le formulaire de création d'annonce dans la <div id='contentFormulaire>
   */
  public function ajouter() {
    //obtenir les arrondissements
    $data['arrondissement'] = $this->Arrondissements_model->obtenir_arrondissement();
    $this->load->view("appartement/appartement-form.php");
  }

  /**
   * enregistrer les données saisies dans le formulaire d'ajout d'une nouvelle annonce
   */
  public function enregistrer() {
    $succes = true;
    $arrondissement = $this->input->post("arrondissement");
    $adresse = $this->input->post("adresse");
    $codePostal = $this->input->post("codePostal");
    $type = $this->input->post("type");
    $piece = $this->input->post("piece");
    $etage = $this->input->post("etage");
    $internet = $this->input->post("internet");
    $tele = $this->input->post("tele");
    $climatiseur = $this->input->post("climatiseur");
    $meuble = $this->input->post("meuble");
    $adapte = $this->input->post("adapte");
    $laveuseSecheuse = $this->input->post("laveuseSecheuse");
    $laveVaisselle = $this->input->post("laveVaisselle");
    $stationnement = $this->input->post("stationnement");
    $description = $this->input->post("description");
    $proprietaire = $this->session->get_userdata();
    //S'il y a des donnees ne sont pas recues
    if(!isset($arrondissement) ||
       !isset($adresse) ||
       !isset($codePostal) ||
       !isset($type) ||
       !isset($piece) ||
       !isset($etage) ||
       !isset($internet) ||
       !isset($tele) ||
       !isset($climatiseur) ||
       !isset($meuble) ||
       !isset($adapte) ||
       !isset($laveuseSecheuse) ||
       !isset($laveVaisselle) ||
       !isset($stationnement) ||
       !isset($description) ||
       !isset($proprietaire))  {
        $succes = false;
    } else {
      //S'il y a des donnees qui sont vides
      if($arrondissement == "" ||
         $adresse == "" ||
         $codePostal == "" ||
         $type == "" ||
         $piece == "" ||
         $etage == "" ||
         $internet == "" ||
         $tele == "" ||
         $climatiseur == "" ||
         $adapte == "" ||
         $meuble == "" ||
         $laveuseSecheuse == "" ||
         $laveVaisselle == "" ||
         $stationnement == "" ||
         $description == "" ||
         $proprietaire == "") {
          $succes = false;
      } else {
        // ajout d'un appartement dans la base de donnée
        $resultat = $this->Appartements_model->enregistrer_appartement($arrondissement,
                                                                       $adresse,
                                                                       $codePostal,
                                                                       $type,
                                                                       $piece,
                                                                       $etage,
                                                                       $internet,
                                                                       $tele,
                                                                       $climatiseur,
                                                                       $meuble,
                                                                       $adapte,
                                                                       $laveuseSecheuse,
                                                                       $laveVaisselle,
                                                                       $stationnement,
                                                                       $description,
                                                                       $proprietaire['nomUsager']);
        if(!$resultat) {
          $succes = false;
        }
      }
      if($succes) {
        $data["erreur"] = false;

      } else {
        $data["erreur"] = true;
      }
      $this->load->view("appartement/message_insertion.php", $data);
    }
  }
} //fin du controleur

