<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Films extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			$this->load->model("Films_model");//Give us access to a variable $this->Films_model
			$this->load->model("Realisateurs_model");//Give us access to a variable $this->Realisateurs_model
			$this->load->helper("url_helper");//Load a helper
		}

		public function index(){
			$data["titre"] = "Liste des films";//the page title
			$data["films"] = $this->Films_model->get_movies();

			//Load the views
			$this->load->view("templates/header.php", $data);
			$this->load->view("films/index",$data);
			$this->load->view("templates/footer.php", $data);
		}

		public function view($id){
			$data["titre"] = "Détails du film";//the page title
			$data["film"] = $this->Films_model->get_film($id);

			//Load the views
			$this->load->view("templates/header.php", $data);
			$this->load->view("films/view", $data);
			$this->load->view("templates/footer.php", $data);
		}

		public function create(){
			
			//deal with the insert form
			
			//Load the form functionnality
			$this->load->helper("form");
			$this->load->library("form_validation");

			$data["titre"] = "Insert a movie";//The title for the page
			$data["realisateur"] = $this->Realisateurs_model->get_realisateurs();	//The data for display the moviemaker
			
			/////////////////////
			// Validation rules//
			/////////////////////
			//Set the style of the error message (the tags used to wrap up the messages)
			$this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");

			$this->form_validation->set_rules("title", "Title", "trim|is_unique[films.titre]|required|callback__title_check");
			$this->form_validation->set_rules("description", "Description", 'trim|required', array('required' => 'You must provide a description.') );

			//If theres an error when running the validation
			if($this->form_validation->run() === FALSE){
				$this->load->view("templates/header.php", $data);
				$this->load->view("films/create", $data);
				$this->load->view("templates/footer.php");
			}
			else{
				//Insert the movie
				$this->Films_model->set_film();
				$this->index();
			}
		}

		//The underscore is used so that you can't write the method name in the URL directly
		public function _title_check($t){
			$t = strtolower($t);
			if($t == "test" || $t == "film"){
				$this->form_validation->set_message("_title_check", "The field {field} can't have this value");
				return false;
			}
			else{
				return true;
			}
		}
	

	}
?>