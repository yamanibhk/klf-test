<?php
	class Realisateurs_model extends CI_Model{
		
		public function __construct(){
			$this->load->database();
		}
		
		public function get_realisateurs(){
			$query = $this->db->get("realisateurs");
			
			//This return an array of results
			return $query->result_array();
		}
	}
?>