<?php
class Usagers_model extends CI_Model {

	/**
	 * contructeur
	 */
	public function __construct() {
		$this->load->database();
	}

	/**
	 * Retourne un usager.
	 *
	 * @return     class  l'usager.
	 */
	public function get_usager($username){
		$query = $this->db->get_where("usager", array("nomUsager" => $username));
		return $query->row_array();//Return an associative array for a simple row of results
	}

	/**
	 * a completer
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function ajouter_usager($nomUsager, $motDePasse, $courriel){
		return true;
	}

}//Fin de la classe