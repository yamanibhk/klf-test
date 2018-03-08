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
		return $query->result_array();
  }
	/**
   * ajout d'apartement
   *
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


  /**
     * affichage des appartements vedettes disponibles pour location
     *
     * @return     array  toutes les données des appartements trouvées
     */
    public function obtenir_appartementsVedette(){
    $query=$this->db->query('SELECT * FROM appartement JOIN noter ON appartement.idAppart = noter.idAppart
    JOIN arrondissement ON appartement.idArrondissement = arrondissement.idArrondissement
    JOIN disponibilite ON appartement.idAppart = disponibilite.idAppart
    JOIN photo ON appartement.idAppart = photo.idAppart
    WHERE noter.Note >=4 AND appartement.proprietaire NOT IN (SELECT nomUsager FROM usager WHERE usager.estBanni=1)
    AND disponibilite.dateFinDispo >= NOW()
    group by appartement.idAppart LIMIT 20');

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
		WHERE appartement.proprietaire NOT IN (SELECT nomUsager FROM usager WHERE usager.estBanni=1) AND noter.nomUsager NOT IN (SELECT nomUsager FROM usager WHERE usager.estBanni=1)';
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
		
		
}//Fin de la classe