<?php
class Appartements_model extends CI_Model {


  /**
   * contructeur
  */
  public function __construct() {
    $this->load->database();
  }

  /**
   * @param nomUsager qui est le propietaire d'appartements
   * @return Retourne la liste d'appartement..
   */
  public function obtenir_appartement($username){
		$query = $this->db->get_where("appartement", array("Proprietaire" => $username));
		return $query->result_array();
  }
	/**
   * @param arrondissement,adresse,codePostal,type,piece,etage,internet,
	 * @param tele,climatiseur,adapte,laveuseSecheuse,laveVaisselle,stationnement,description
   * @return confirmation d'inscription
   */
  public function enregistrer_appartement($arrondissement,$adresse,$codePostal,$type,$piece,$etage,$internet,$tele,
			 						$climatiseur,$meuble,$adapte,$laveuseSecheuse,$laveVaisselle,$stationnement,$description,$proprietaire){
		$data = array (
     "adresse" => $adresse,
			"description" => $description,
      "codePostal" => $codePostal,
      "typeLogement" => $type,
      "nbrePiece" => $piece,
      "numEtage" => $etage,
      "internet" => $internet,
      "television" => $tele,
      "climatiseur" => $climatiseur,
      "adapte" => $adapte,
			"nbreStationnement" => $stationnement,
			"meuble" => $meuble,
      "laveuseSecheuse" => $laveuseSecheuse,
      "laveVaisselle" => $laveVaisselle,
			"idArrondissement" => $arrondissement,
			"proprietaire" => $proprietaire
    );
		$query = $this->db->insert('appartement', $data);
		if ($query) return true;
  }
	
}//Fin de la classe