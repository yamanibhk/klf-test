<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class atterrissage extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->helper("url_helper");//Load a helper
		}

		public function index(){
            //vérifier si la page existe
            if ( ! file_exists ( APPPATH . 'views/atterrissage/index.php' )) { show_404 (); } 
			$data["titre"] = "RENTAHOUSE";//titre de la page d'atterissage
			//charger les vues
			$this->load->view("templates/header.php", $data);
			$this->load->view("atterrissage/index",$data);
			$this->load->view("templates/footer.php", $data);
		}
        
    }
?>