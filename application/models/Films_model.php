<?php
	class Films_model extends CI_Model{
		
		public function __construct(){
			$this->load->database();
		}

		public function get_movies(){
			$query = $this->db->get("films");
			
			//This return an array of results
			return $query->result_array();
		}

		public function get_film($id){
			$query = $this->db->get_where("films", array("id" => $id));
			return $query->row_array();//Return an associative array for a simple row of results
		}

		public function set_film(){
			//This array contain all the post value from the form
			$data = array (
				"titre" => $this->input->post("title"),
				"description" => $this->input->post("description"),
				"idRealisateur" => $this->input->post("idRealisateur")
			);
			//Do the insertion of the movie with the data
			return $this->db->insert("films", $data);
		}
	}
?>