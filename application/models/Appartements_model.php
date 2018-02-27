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
    WHERE noter.Note >=4
    AND disponibilite.dateFinDispo >= NOW()
    group by appartement.idAppart');

    //tableau de resultats
    return $query->result_array();
  }
  /**
     * affichage des appartements disponibles pour location
     *
     * @param      string  $nomUsager  nom usager
     *
     * @return     array  toutes les données de l'utilisateur précisé
     */
		
    public function obtenir_appartements($arrondissement="", $dateDebut="01/01/1900", $dateFin="01/01/3000",$nbrPiece=0,$codePostal="",   
				$numEtage="",$typeLogement="", $nbreStatio="",$internet=0,$television=0,$climatiseur=0,$adapte=0,$meuble=0,
				$lavSech=0,$lavVaiss=0,$intervAcc=0,$prixMin="",$prixMax=""){	
						
    $this->db->select('*');
    $this->db->from('appartement');
    $this->db->join('noter', 'appartement.idAppart = noter.idAppart');
    $this->db->join('arrondissement', 'appartement.idArrondissement = arrondissement.idArrondissement');
    $this->db->join('disponibilite', 'appartement.idAppart = disponibilite.idAppart');
    $this->db->join('photo', 'appartement.idAppart = photo.idAppart');
    if (!empty($idArrondissement)) $this->db->where('appartement.idArrondissement', $idArrondissement);
    if (!empty($codePostal)) $this->db->where('codePostal', substr($codePostal,0,2));
    if (!empty($typeLogement)) $this->db->where('typeLogement', $typeLogement);
    if (!empty($nbrePiece) and ($nbrePiece!=0) $this->db->where('nbrePiece', $nbrePiece);
    if (!empty($numEtage)) $this->db->where('numEtage <=', $numEtage);
    if (!empty($Internet)) $this->db->where('Internet', $Internet);
    if (!empty($Television)) $this->db->where('Television', $Television);
    if (!empty($Climatiseur)) $this->db->where('Climatiseur', $Climatiseur);
    if (!empty($Adapte)) $this->db->where('Adapte', $Adapte);
    if (!empty($nbreStationnement)) $this->db->where('nbreStationnement', $nbreStationnement);
    if (!empty($Meuble)) $this->db->where('Meuble', $Meuble);
    if (!empty($LaveuseSecheuse)) $this->db->where('LaveuseSecheuse', $LaveuseSecheuse);
    if (!empty($LaveVaisselle)) $this->db->where('LaveVaisselle', $LaveVaisselle);
    if (!empty($prixMin)) $this->db->where('MontantJournalier >=', $prixMin);
    if (!empty($prixMax)) $this->db->where('MontantJournalier <=', $prixMax);
		if (!empty($IntervallesAcceptee)) 
			{
					$this->db->where('IntervallesAcceptee', $IntervallesAcceptee);
					if ($IntervallesAcceptee==1) {
						if (!empty($dateDebut)) $this->db->where('dateDebutDispo <=', $dateDebut);
    				if (!empty($dateFin)) $this->db->where('dateFinDispo >=', $dateFin);
					}	
					else  {
							if (!empty($dateDebut)) $this->db->where('dateDebutDispo', $dateDebut);
    					if (!empty($dateFin)) $this->db->where('dateFinDispo', $dateFin);
					}
			}
		else {
						if (!empty($dateDebut)) $this->db->where('dateDebutDispo', $dateDebut);
    				if (!empty($dateFin)) $this->db->where('dateFinDispo', $dateFin);
					}
   	$query = $this->db->get();

      //tableau de resultats
    return $query->result_array();
    }
		
		
}//Fin de la classe