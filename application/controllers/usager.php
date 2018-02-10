<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
	class usager extends CI_Controller{

		public function __construct(){
			parent::__construct();
            $ this ->load ->model( 'model_usager' );//charger le model usager
			$this->load->helper("url_helper");//Load a helper
		}

		/*public function index(){
			$data["titre"] = "RENTAHOUSE";//titre de la page d'atterissage
			//charger les vues
			$this->load->view("templates/header.php", $data);
			$this->load->view("usager/index",$data);
			$this->load->view("templates/footer.php", $data);
		}*/
        /*
         * connexion a la plateforme du site
        */
        
        public function connexion(){
            if(isset($_POST["nomUsager"]) && isset($_POST["motdepasse"]))
            {
                if($_POST["nomUsager"]!="" && $_POST["motdepasse"]!="")
                {
                     //vérifier les données usager dans le model usager
                    $resultat = $this->model_usager->verifier_usager($_POST["nomUsager"],$_POST["motdepasse"]);
                    if($resultat)
                    {
                        echo "Connexion réussi";
                        $_SESSION["nomUsager"] = $_POST["nomUsager"];
                        //charger les vues
                        $this->load->view("templates/header.php");
                        $this->load->view("accueil/index");
                        $this->load->view("templates/footer.php");
                    }
                    else
                    {
                        //charger les vues
                        $this->load->view("templates/header.php");
                        $this->load->view("atterrissage/connexion-form");
                        $this->load->view("templates/footer.php");
                    }
                }
            }
		}
        /*
         * vérifier si l'uasager existe ou pas dans la bas de donnée
        */
        public function obtenir(){
            if(isset($_POST["nomUsager"]))
            {
                if($_POST["nomUsager"]!="")
                {
                     //vérifier l'existance d'un usager dans le model usager
                    $resultat=$this->model_usager->get_usager($_POST["nomUsager"]);
                    if($resultat)
                    {
                       echo "Le nom usager existe déja";
                    }
                   
                }
            }
        }
        
        /*
         * insertion d'un nouveau utilisateur dans la base de donnée
        */
        public function inscription(){
            if(isset($_POST["nomUsager"]) && isset($_POST["motdepasse"]) && isset($_POST["courriel"]))
            {
                if($_POST["nomUsager"]!="" && $_POST["motdepasse"]!="" && $_POST["courriel"]!="")
                {
                    //ajout d'un usager dans le model usager
                    $resultat=$this->model_usager->ajouter_usager($_POST["nomUsager"],$_POST["motdepasse"],$_POST["courriel"]);
                    if($resultat)
                    {
                        //charger les vues
                        $this->load->view("templates/header.php");
                        $this->load->view("accueil/index");
                        $this->load->view("templates/footer.php");
                    }
                    else
                    {
                        //charger les vues
                        $this->load->view("templates/header.php");
                        $this->load->view("atterrissage/inscription-form");
                        $this->load->view("templates/footer.php");
                    }
                }
                else
                {
                    //charger les vues
                    $this->load->view("templates/header.php");
                    $this->load->view("atterrissage/inscription-form");
                    $this->load->view("templates/footer.php");
                }
            }
    
        }

}
?>