<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function view($page) {

		if(!file_exists(APPPATH. "views/pages/" . $page . ".php")){
			//Erreur 404
			show_404();
		}
		else{
			$data["titre"] = $page;
			$this->load->view("templates/header.php", $data);
			$this->load->view("pages/" . $page);
			$this->load->view("templates/footer.php");
		}
	}
}