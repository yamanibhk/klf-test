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
        $data['notes'] = $this->Appartements_model->obtenir_note();
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
    $data['notes'] = $this->Appartements_model->obtenir_note();
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
   * recupérer les données appartement a modifier
   */
  public function modifier() {
    $id = $this->input->post("idAppart");
    if(isset($id)) {
      if($id!=""){
        $appartement= $this->Appartements_model->obtenir_appartementParId($id);
        echo json_encode($appartement);
      }
    }   
  }

  /**
   * Suppression d'un appartement
   */  
  public function supprimerAppartement() {
    $id = $this->input->post("idAppart");
    if(isset($id)) {
      if($id!=""){
        $suppression= $this->Appartements_model->suppression_appartementParId($id);
        if($suppression){
          echo true;
        } else {
          echo false;
        }
      }
    }  
  }

  /**
   * charge le formulaire de modification d'appartement
   */
  public function modifierAppartement() {
    //obtenir les arrondissements
    $data['arrondissements'] = $this->Arrondissements_model->obtenir_arrondissements();
    $this->load->view("appartement/appartement-modif.php",$data);
  }

  /**
   * Valider la modification d'appartement
   */
  public function valider_modification() {
    $succes = true;
    $id = $this->input->post("id");
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
    if(
       !isset($id) ||
       !isset($arrondissement) ||
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
       !isset($description)||
       !isset($proprietaire))  {
        $succes = false;
    } else {
      //S'il y a des donnees qui sont vides
      if($id == "" || 
         $arrondissement == "" ||
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
         $proprietaire == "") {
         $succes = false;
      } else {
        // ajout d'un appartement dans la base de donnée
        $resultat = $this->Appartements_model->modifier_appartement($id, 
                                                                       $arrondissement,
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
                                                                       $proprietaire
                                                                       );
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
    $image1 = $this->input->post("image1");
    $image2 = $this->input->post("image2");
    $image3 = $this->input->post("image3");
    $image4 = $this->input->post("image4");
    $detail = $this->input->post("detail");
    $detail1 = $this->input->post("detail1");
    $detail2 = $this->input->post("detail2");
    $detail3 = $this->input->post("detail3");
    $detail4 = $this->input->post("detail4");
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
       !isset($image1) ||
       !isset($image2) ||
       !isset($image3) ||
       !isset($image4) ||
       !isset($detail) ||
       !isset($detail1) ||
       !isset($detail2) ||
       !isset($detail3) ||
       !isset($detail4) ||
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
         $image1 == "" ||
         $image2 == "" ||
         $image3 == "" ||
         $image4 == "" ||
         $detail == "" ||
         $detail1 == "" ||
         $detail2 == "" ||
         $detail3 == "" ||
         $detail4 == "" ||
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
                                                                       $image1,
                                                                       $image2,
                                                                       $image3,
                                                                       $image4,
                                                                       $detail,
                                                                       $detail1,
                                                                       $detail2,
                                                                       $detail3,
                                                                       $detail4);
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
    if(isset($id)){
      if($id!=""){
        $donnees = $this->Appartements_model->dateDispo($id);
        echo json_encode($donnees);
      }
    }
    
  }

  /**
  * afficher les dates de locations ajoutées a un appartement
  */
  public function mesLocationEnregistres(){
    
    $id = $this->input->post("idAppart");
    if(isset($id)){
      if($id!=""){
        $location = $this->Appartements_model->dateLocation($id);
        echo json_encode($location);
      }
    }  
  }

  /**
  * Afficher la liste des locations de l'usager
  */
  public function demandeLocationEnCours(){
    $proprietaire = $this->session->get_userdata();
    $data["locations"] = $this->Appartements_model->obtenir_location($proprietaire['nomUsager']);
    $data['photos'] = $this->Appartements_model->afficherPhoto();
    $this->load->view("appartement/obtenir_location.php", $data);
  }
  
  /**
  * Afficher la liste des locations de l'usager
  */
  public function validerLocation(){
    $id = $this->input->post("idAppart");
    if(isset($id)){
      if($id!=""){
        $reponse = $this->Appartements_model->valider_location($id);
        if($reponse){
          redirect("index.php/appartement/demandeLocationEnCours");
        }
      }
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