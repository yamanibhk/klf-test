<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class atterrissage extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->helper("url_helper");//Load a helper
		}

		public function index(){
			$data["titre"] = "RENTAHOUSE";//the page title
			//Load the views
			$this->load->view("templates/header.php", $data);
			$this->load->view("atterrissage/index",$data);
			$this->load->view("templates/footer.php", $data);
		}
	}
?>