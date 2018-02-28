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
   * @param tele,climatiseur,adapte,laveuseSecheuse,laveVaisselle,stationnement,description, prprietaire, image, detail
   * @return confirmation d'inscription
   */
  public function enregistrer_appartement($arrondissement,$adresse,$titre,$codePostal,$type,$piece,$etage,$internet,$tele,
                  $climatiseur,$meuble,$adapte,$laveuseSecheuse,$laveVaisselle,$stationnement,$description,$proprietaire,$image,$detail){
    $data = array (
      "adresse" => $adresse,
      "titre" => $titre,
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
    $id = $this->db->insert_id();
   // $id= $this->db->last_insert_id('appartement');//récuperer le dernier id appartement 
    $query2 = $this->db->insert('photo', array("detailPhoto" => $detail,"Chemin" => $image,"idAppart" => $id));
    if ($query1 && $query2) return true;
  }

  /**
   * @param idAppart,$dateDebut,$dateFin,$prix,$interval
   * @return vrai ou faux si la disponibilité est ajoutée
   */
  public function louer_monLogement($id,$dateDebut,$dateFin,$prix,$interval){
    $query = $this->db->insert("disponibilite", array("dateDebutDispo" => $dateDebut,"dateFinDispo" => $dateFin,"montantJournalier" => $prix,"IntervallesAcceptee" => $interval,"idAppart" => $id));
    if($query) return true;
  }
  
	/**
   * @param idAppart
   * @return la liste des dates déja ajoutées
   */
	public function dateDispo($id){
		$query = $this->db->query("select * from disponibilite where idAppart=" . $id . " and dateFinDispo>'" . CURDATE() . "'");
    return $query->result_array();
	}
	
	/**
   * @param idAppart,$dateDebut,$dateFin
   * @return vrai ou faux si l'appartement est loué a cette date
   */
	public function verifierDateDispo($idAppart,$dateDebut,$dateFin){
		$query = $this->db->select("select * from location where idAppart=" . $idAppart . " and dateDebutLocation<=" . $dateDebut ." or dateFinLocation>=" . $dateFin);
		/*$query = $this->db->from("location");
		$query = $this->db->where("idAppart",$idAppart);
		$query = $this->db->where("dateDebutLocation<=",$dateDebut);
		$query = $this->db->where("dateFinLocation>=",$dateFin);*/
    if($query){
			return false;
		}else{
			return true;
		}
	}

  /**
   * @param $usager
   * @return retourne les appartements qui ont des dates de disponibilités
   */
  public function obtenir_appartement_disponible($usager){
    $query = $this->db->query("select * from disponibilite join appartement on appartement.idAppart=disponibilite.idAppart where appartement.Proprietaire='" . $usager . "' group by disponibilite.idAppart ");
    //$query = $this->db->query("disponibilite", array("idAppart" => $id));
    return $query->result_array();
  }
  
/**
* @param $nomUsager
* @return toutes les locations (validées et non validées)
*/
public function obtenir_location($nomUsager){
   $query = $this->db->query("select * from location join appartement on appartement.idAppart=location.idAppart where appartement.Proprietaire='" . $nomUsager . "'");
return $query->result_array();
}
  
/**
* @param idAppart
* @return vrai ou faux si la location est validé
*/
public function valider_location($idAppart){
 $query = $this->db->query("UPDATE location SET estValide='1' WHERE idAppart='" . $idAppart . "'");
 if($query) return true;
}
  
 /**
* @param idAppart
* @return les photos liées a l'appartement
*/
public function afficherPhoto($idAppart){
 $query = $this->db->get_where("photo", array("idAppart" => $idAppart));
 if($query)
   return $query->result_array();
} 
  
}//Fin de la classe