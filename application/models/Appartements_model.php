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
    //$query = $this->db->get_where("appartement", array("Proprietaire" => $username));
    return $query->result();
  }
  /**
   * @param arrondissement,adresse,codePostal,type,piece,etage,internet,
   * @param tele,climatiseur,adapte,laveuseSecheuse,laveVaisselle,stationnement,description, prprietaire, image, detail
   * @return confirmation d'inscription
   */
  public function enregistrer_appartement($arrondissement,$adresse,$titre,$codePostal,$type,$piece,$etage,$internet,$tele,
                  $climatiseur,$meuble,$adapte,$laveuseSecheuse,$laveVaisselle,$stationnement,$description,$proprietaire,$image,
                  $image1,$image2,$image3,$image4,$detail,$detail1,$detail2,$detail3,$detail4){
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
    $query3 = $this->db->insert('photo', array("detailPhoto" => $detail1,"Chemin" => $image1,"idAppart" => $id));
    $query4 = $this->db->insert('photo', array("detailPhoto" => $detail2,"Chemin" => $image2,"idAppart" => $id));
    $query5 = $this->db->insert('photo', array("detailPhoto" => $detail3,"Chemin" => $image3,"idAppart" => $id));
    $query6 = $this->db->insert('photo', array("detailPhoto" => $detail4,"Chemin" => $image4,"idAppart" => $id));
    if ($query1 && $query2 && $query3 && $query4 && $query5 && $query6) return true;
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
   * @return la liste des dates disponibilités déja ajoutées
   */
	public function dateDispo($id){
		$query = $this->db->query("select * from disponibilite where idAppart=" . $id . " and dateFinDispo >'" . date('Y-m-d') . "'");
    return $query->result();
	}
	
  /**
   * @param idAppart
   * @return la liste des dates locations déja ajoutées
   */
  public function dateLocation($id){
    $query = $this->db->get_where("location", array("idAppart" => $id));
    return $query->result();
  }

	/**
   * @param idAppart,$dateDebut,$dateFin
   * @return vrai ou faux si l'appartement est loué a cette date
   */
	public function verifierDateDispo($idAppart,$dateDebut,$dateFin){
		$query = $this->db->query("select * from location where idAppart ='" . $idAppart . "' and ((dateDebutLocation <='" . $dateDebut ."' and dateFinLocation >='" . $dateDebut . "')
    or (dateFinLocation >='" . $dateFin . "' and dateDebutLocation <='" . $dateFin . "'))");
    return $query->num_rows();
			 
	}

  /**
  * @param $nomUsager
  * @return toutes les locations (validées et non validées)
  */
  public function obtenir_location($nomUsager){
     $query = $this->db->query("select * from location join appartement on appartement.idAppart=location.idAppart where appartement.Proprietaire='" . $nomUsager . "'");
  return $query->result();
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
  * @return toutes les photos
  */
  public function afficherPhoto(){
   $query = $this->db->get("photo");
   if($query)
     return $query->result();
  } 

  /**
  * @return la liste des notes
  */
  public function obtenir_note(){
   $query = $this->db->get("noter");
   if($query)
     return $query->result();
  } 

  /**
  * @param id de l'ppartement
  * @return les détails d'un appartement
  */
  public function obtenir_appartementParId($id){
   $query = $this->db->query("select * from appartement join arrondissement on appartement.idArrondissement=arrondissement.idArrondissement where idAppart=" . $id);
   if($query)
     return $query->result();
  } 
  
}//Fin de la classe