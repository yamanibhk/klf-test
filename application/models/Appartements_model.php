<?php
/**
 * @file      Appartements_model.php
 * @author    Yamani & Mathieu & Leila
 * @version   1.0
 * @date      17 février 2018
 * @brief     accées et vérification et CRUD sur les données des apartements
 *
 * @details    Cette classe nous permet de faire l'ajout et supression et modification des appartement d'un utilisateur ainsi que afficher les appartement répondant qux criteres de recherche 
 */
class Appartements_model extends CI_Model {


  /**
   * contructeur
  */
  public function __construct() {
    $this->load->database();
  }

  /**
   * affichage de tout les appartement d'un utilisateur
   *
   * @param nomUsager qui est le propietaire d'appartements
   * @return Retourne la liste d'appartement..
   */
  public function obtenir_appartement($username){
    $query = $this->db->get_where("appartement", array("Proprietaire" => $username));
    //$query = $this->db->get_where("appartement", array("Proprietaire" => $username));
    return $query->result();
  }
/**  enregistrer un apartement
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
    $query7 = $this->db->insert('noter', array("Note" => 0,"nomUsager" => $proprietaire,"idAppart" => $id));
    if ($query1 && $query2 && $query3 && $query4 && $query5 && $query6 && $query7) return true;
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
     * affichage des appartements vedettes disponibles pour location
     *
     * @return     array  toutes les données des appartements trouvées
     */
    public function obtenir_appartementsVedette(){
    $query=$this->db->query('select * from (select appartement.*,photo.Chemin from appartement join photo on appartement.idAppart = photo.idAppart where appartement.proprietaire NOT IN (SELECT nomUsager FROM usager WHERE usager.estBanni=1) group by appartement.idAppart) as table1 join (select noter.idAppart as "idAppar",ROUND(avg(Note),0) as "moyenneNote" from noter group by noter.idAppart having moyenneNote>=3 ) as table2 on table1.idAppart=table2.idAppar LIMIT 20');
		
    //tableau de resultats
    return $query->result();
  }
  /**
     * affichage des appartements disponibles pour location
     *
     * @param      string  $nomUsager  nom usager
     *
     * @return     array  toutes les données de l'utilisateur précisé
     */
		
	
    public function obtenir_appartements($idArrondissement="", $dateDebut="", $dateFin="",$nbrPiece='0',$codePostal="",   
				$numEtage="",$typeLogement="", $nbreStatio="",$internet='0',$television='0',$climatiseur='0',$adapte='0',$meuble='0',
				$lavSech='0',$lavVaiss='0',$intervAcc='0',$prixMin="",$prixMax=""){	
		$t=time();
		/*if 	($dateDebut=="") 	$dateDebut=(date("Y-m-d",$t));
		if 	($dateFin=="") 	$dateFin=$dateDebut+1;*/
		$dateAujour=(date("Y-m-d",$t));
    $sql='SELECT *,avg(note) as "moyenneNotes",avg(MontantJournalier) as "moyenneMontant" FROM appartement 
		JOIN photo ON appartement.idAppart = photo.idAppart
		JOIN disponibilite ON appartement.idAppart = disponibilite.idAppart
		JOIN noter ON appartement.idAppart = noter.idAppart
		JOIN arrondissement on appartement.idArrondissement = arrondissement.idArrondissement
		WHERE appartement.proprietaire NOT IN (SELECT nomUsager FROM usager WHERE usager.estBanni=1)';
		if (!empty($idArrondissement)) $sql.=' AND appartement.idArrondissement='.$idArrondissement;
		if (!empty($codePostal)) $sql.=' AND UPPER(appartement.codePostal) LIKE "'.$codePostal.'%"';
		if (!empty($typeLogement)) $sql.=' AND appartement.typeLogement="'.$typeLogement.'"';
		if (!empty($nbrPiece) and ($nbrPiece!='0')) $sql.=' AND appartement.nbrePiece='.$nbrPiece;
		if ($numEtage!="") $sql.=' AND appartement.numEtage='.$numEtage;
		if ($internet=='1') $sql.=' AND appartement.Internet='.$internet;
		if ($television=='1') $sql.=' AND appartement.Television='.$television;
		if ($climatiseur=='1') $sql.=' AND appartement.Climatiseur='.$climatiseur;
		if ($adapte=='1') $sql.=' AND appartement.Adapte='.$adapte;
		if ($meuble=='1') $sql.=' AND appartement.Meuble='.$meuble;
		if ($lavSech=='1') $sql.=' AND appartement.LaveuseSecheuse='.$lavSech;
		if ($lavVaiss=='1') $sql.=' AND appartement.LaveVaisselle='.$lavVaiss;
		 
		if ($intervAcc!='1') {
			if (($dateDebut!="") or ($dateFin!="")){
			$sql.=' AND appartement.idAppart IN (SELECT idAppart FROM disponibilite WHERE ';
			if ($dateDebut!="") $sql.='disponibilite.dateDebutDispo ="'.$dateDebut.'"';
			if (($dateDebut!="") and ($dateFin!="")) $sql.=' AND ';
			if ($dateFin!="") $sql.='disponibilite.dateFinDispo ="'.$dateFin.'"';
			$sql.=')';
			}
			else if (($dateDebut=="") and ($dateFin=="")){$sql.=' AND appartement.idAppart IN (SELECT idAppart FROM disponibilite WHERE  disponibilite.dateFinDispo >"'.$dateAujour.'")';}
		}
		else if ($intervAcc=='1')  {
			$sql.=' AND appartement.idAppart IN (SELECT idAppart FROM disponibilite WHERE IntervallesAcceptee=1';
			if (($dateDebut!="") or ($dateFin!="")) $sql.=' AND ';
			if ($dateDebut!="") $sql.='disponibilite.dateDebutDispo <="'.$dateDebut.'"';
			if (($dateDebut!="") and ($dateFin!="")) $sql.=' AND ';
			if ($dateFin!="") $sql.='disponibilite.dateFinDispo >="'.$dateFin.'"';
			if (($dateDebut=="") and ($dateFin=="")) $sql.=' AND disponibilite.dateFinDispo >"'.$dateAujour.'"';
			$sql.=')';
		}
		if ($nbreStatio!="") $sql.=' AND appartement.nbreStationnement='.$nbreStatio;
		if ($prixMin!="") $sql.=' AND appartement.idAppart IN (SELECT idAppart FROM disponibilite WHERE disponibilite.MontantJournalier >='.$prixMin.')';
		if ($prixMax!="") $sql.=' AND appartement.idAppart IN (SELECT idAppart FROM disponibilite WHERE disponibilite.MontantJournalier <='.$prixMax.')';
		$sql.=' GROUP BY appartement.idAppart';	
		$query=$this->db->query($sql);


      //tableau de resultats
		
    return $query->result();
			
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

  /**
  * @param id de l'ppartement
  * @return supprimer l'appartement en question
  */
  public function suppression_appartementParId($id){
    $query1 = $this->db->where('idAppart', $id);
    $query2 = $this->db->delete('appartement');

    $query3 = $this->db->where('idAppart', $id);
    $query4 = $this->db->delete('photo');
   if($query1 && $query2 && $query3 && $query4)
     return true;
   else
    return false;
  } 

  /**
  * @param id de l'ppartement
  * @return modifier l'appartement en question
  */
  public function modifier_appartement($id,$arrondissement,$adresse,$titre,$codePostal,$type,$piece,$etage,$internet,$tele,$climatiseur,$meuble,
                                        $adapte,$laveuseSecheuse,$laveVaisselle,$stationnement,$description,$proprietaire){
    

    $data = array(
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
var_dump($data);
    $query1 = $this->db->where('idAppart', $id);
    $query2 = $this->db->update('appartement', $data); 

   if($query && $query2)
     return true;
   else
    return false;
  } 
  
}//Fin de la classe