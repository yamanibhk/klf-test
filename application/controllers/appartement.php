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
   * afficher les appartements de l'usager connecté
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
        $data['photos'] = $this->Appartements_model->afficherPhoto();
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
   * afficher les appartements dans le contenu de la page mes logements
   */
  public function contenu_index() {
    $usager = $this->session->get_userdata();
    //obtenir la liste des logements d'un usager
    $data['appartement'] = $this->Appartements_model->obtenir_appartement($usager['nomUsager']);
    $data['photos'] = $this->Appartements_model->afficherPhoto();
    $this->load->view("appartement/index.php",$data);
  }

  /**
   * charge le formulaire de création d'annonce dans la <div id='contentFormulaire>
   */
  public function ajouter() {
    //obtenir les arrondissements
    $data['arrondissements'] = $this->Arrondissements_model->obtenir_arrondissements();
    $this->load->view("appartement/appartement-form.php",$data);
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
    $titre = $this->input->post("titre");
    $image = $this->input->post("image");
    $detail = $this->input->post("detail");
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
       !isset($titre) ||
       !isset($description) ||
       !isset($image) ||
       !isset($detail) ||
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
         $titre == "" ||
         $description == "" ||
         $image == "" ||
         $detail == "" ||
         $proprietaire == "") {
         $succes = false;
      } else {
        // ajout d'un appartement dans la base de donnée
        $resultat = $this->Appartements_model->enregistrer_appartement($arrondissement,
                                                                       $adresse,
                                                                       $titre,
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
                                                                       $proprietaire['nomUsager'],
                                                                       $image,
                                                                       $detail);
        if(!$resultat) {
          $succes = false;
        }
      }
      if($succes) {
        $data["erreur"] = false;
        echo false;
      } else {
        $data["erreur"] = true;
        $this->load->view("appartement/message_insertion.php", $data);
      }
      
    }
  }
  /**
  * Mettre un logement en location (donner le prix et les dates de disponibilités)
  */
  public function louerLogement(){
    $succes = true;
    $id = $this->input->post("id");
    $dateDebut = $this->input->post("dateDebut");
    $dateFin = $this->input->post("dateFin");
    $prix = $this->input->post("prix");
    $interval = $this->input->post("interval");
    if(!isset($id) || !isset($dateDebut) ||  !isset($dateFin) || !isset($prix) || !isset($interval)){
      $succes = false;
    }
    else{
      if($id=="" || $dateDebut=="" ||  $dateFin=="" || $prix=="" || $interval==""){
        $succes = false;
      }
      else{
        $resultat = $this->Appartements_model->verifierDateDispo($id,$dateDebut,$dateFin);
        if($resultat>0){
            $data["erreur"] = true;
            $succes = false;
        }
        else{
            $reponse = $this->Appartements_model->louer_monLogement($id,$dateDebut,$dateFin,$prix,$interval);
            if(!$reponse) {
                $succes = false;
            }
        }
        if($succes) {
            $data["erreur"] = false;
        } else {
            $data["erreur"] = true;
        }
      } 
      $this->load->view("appartement/message_insertion.php", $data);
    }
  }
  
  /**
  * afficher les dates disponibilités ajoutées a un appartement
  */
  public function dateDispo(){
    
    $id = $this->input->post("idAppart");
    $donnees = $this->Appartements_model->dateDispo($id);
    echo json_encode($donnees);
  }

  /**
  * afficher les dates de locations ajoutées a un appartement
  */
  public function mesLocationEnregistres(){
    
    $id = $this->input->post("idAppart");
    $location = $this->Appartements_model->dateLocation($id);
    echo json_encode($location);
  }

  /**
  * Afficher la liste des locations de l'usager
  */
  public function demandeLocationEnCours(){
    $proprietaire = $this->session->get_userdata();
    $data["locations"] = $this->Appartements_model->obtenir_location($proprietaire['nomUsager']);
    $this->load->view("appartement/obtenir_location.php", $data);
  }
  
  /**
  * Afficher la liste des locations de l'usager
  */
  public function validerLocation(){
    $id = $this->input->post("idAppart");
    $reponse = $this->Appartements_model->valider_location($id);
    if($reponse){
      redirect("index.php/appartement/demandeLocationEnCours");
    }
  }
  
  /**
  * Afficher les photos d'un appartement
  */
  public function afficherPhoto(){
    $photos = $this->Appartements_model->afficherPhoto();
    return $photos;
  }
  
} //fin du controleur