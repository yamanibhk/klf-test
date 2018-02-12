<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usagers extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Usagers_model");
		$this->load->helper("url_helper");
		$this->load->library('session');
        //chargement de la librairie pour la validation du formulaire
        $this->load->library('form_validation');   
        $this->load->helper('form');
        $this->load->helper('date');
	}

  /*
   * connexion a la plateforme du site
  */
  public function connexion() {
  	$nomUsager = $this->input->post("nomUsager");
  	$motDePasse = $this->input->post("motDePasse");
      var_dump($nomUsager);
      var_dump($motDePasse);
  	if(isset($nomUsager) && isset($motDePasse)) {
  		if($nomUsager != "" && $motDePasse != "") {
        //vérifier les données usager dans le model usager
  			$resultat = $this->Usagers_model->verifier_usager($nomUsager, $motDePasse);
  			var_dump($resultat);
            if($resultat) {
  				$utilisateur = array(
		        'username'  => $nomUsager
					);
					$this->session->set_userdata($utilisateur);
          // charger les vues
  				$this->load->view("templates/header.php");
  				$this->load->view("accueil/index");
  				$this->load->view("templates/footer.php");
  			}
  			else {
          //charger les vues
  				$this->load->view("templates/header.php");
  				$this->load->view("atterrissage/connexion-form");
  				$this->load->view("templates/footer.php");
  			}
  		}
  	}
  }

  /*
   * Obtient un usager dans la base de donnees
  */
  public function obtenir() {
  	$nomUsager = $this->input->post("nomUsager");
  	if(isset($nomUsager)) {
  		if($nomUsager != "")	{
        // vérifier l'existance d'un usager dans le model usager
  			$usager = $this->Usagers_model->get_usager($nomUsager);
  			if($usager)	{
  				$reponse = ["usager" => $usager, "existe" => true];
  			} else {
  				$reponse = ["usager" => NULL, "existe" => false];
  			}
		    header('Content-Type: application/json');
		    echo json_encode($reponse);
  		}
  	}
  }

  /*
   * insertion d'un nouveau utilisateur dans la base de donnée
  */
  public function inscription() {
  	$nomUsager = $this->input->post("nomUsager");
  	$motDePasse = $this->input->post("motDePasse");
  	$courriel = $this->input->post("courriel");
  	$succes = true;
  	//S'il y a des donnees ne sont pas recues

    if(!isset($nomUsager) || !isset($motDePasse) || !isset($courriel))	{
        $succes = false;
    } else {
        //S'il y a des donnees qui sont vides
        if($nomUsager == "" || $motDePasse == "" || $courriel == "") {
            $succes = false;
        }	else {
                // ajout d'un usager dans le model usager
            $resultat = $this->Usagers_model->ajouter_usager($nomUsager, $motDePasse, $courriel);
            if(!$resultat) {
                $succes = false;
            }
        }
    }
    
  	if($succes) {
      $data["erreur"] = false;
  	} else {
      $data["erreur"] = true;
  	}
		$this->load->view("atterrissage/inscription-confirmation.php", $data);
  }

}//Fin de la classe