<?php
class Arrondissements_model extends CI_Model {


  /**
   * contructeur
  */
  public function __construct() {
    $this->load->database();
  }

  /**
   * @return Retourne la liste des arrondissements.
   */
  public function obtenir_arrondissement(){
		$query = $this->db->get("arrondissement");
		return $query->result_array();
  }
}//Fin de la classe