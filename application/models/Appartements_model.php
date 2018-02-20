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
			 						$climatiseur,$meuble,$adapte,$laveuseSecheuse,$laveVaisselle,$stationnement,$description,$proprietaire,$image,$detail){
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
		$query1 = $this->db->insert('appartement', $data);
    $id= $this->db->last_insert_id('appartement');//récuperer le dernier id appartement 
    console.log($id);
    $query2 = $this->db->insert('photo', array("detailPhoto" => $detail,"Chemin" => $image,"idAppart" => $id));
		if ($query1 && $query2) return true;
  }
	
}//Fin de la classe