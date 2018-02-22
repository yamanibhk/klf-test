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
    $this->db->select('*');
    $this->db->from('appartement');
    $this->db->join('noter', 'appartement.idAppart = noter.idAppart');
    $this->db->join('arrondissement', 'appartement.idArrondissement = arrondissement.idArrondissement');
    $this->db->join('disponibilite', 'appartement.idAppart = disponibilite.idAppart');
    $this->db->join('photo', 'appartement.idAppart = photo.idAppart');
    
    $this->db->where('Note >=', 4);
    $this->db->where('disponibilite.dateFinDispo >=', NOW());

    $query = $this->db->get();

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
    public function obtenir_appartements($data){
    $this->db->select('*');
    $this->db->from('appartement');
    $this->db->join('noter', 'appartement.idAppart = noter.idAppart');
    $this->db->join('arrondissement', 'appartement.idArrondissement = arrondissement.idArrondissement');
    $this->db->join('disponibilite', 'appartement.idAppart = disponibilite.idAppart');
    $this->db->join('photo', 'appartement.idAppart = photo.idAppart');
    if (!empty($data['idArrondissement'])) $this->db->where('appartement.idArrondissement', $data['idArrondissement']);
    if (!empty($data['codePostal'])) $this->db->where('codePostal', $data['codePostal']);
    if (!empty($data['typeLogement'])) $this->db->where('typeLogement', $data['typeLogement']);
    if (!empty($data['nbrePiece'])) $this->db->where('nbrePiece', $data['nbrePiece']);
    if (!empty($data['numEtage'])) {
      $signe=$data['numEtage'];
      if ($signe[0]=='>') $this->db->where('numEtage >=', $data['numEtage']);
      else  $this->db->where('numEtage <', $data['numEtage']);
    }
    if (!empty($data['Internet'])) $this->db->where('Internet', $data['Internet']);
    if (!empty($data['Television'])) $this->db->where('Television', $data['Television']);
    if (!empty($data['Climatiseur'])) $this->db->where('Climatiseur', $data['Climatiseur']);
    if (!empty($data['Adapte'])) $this->db->where('Adapte', $data['Adapte']);
    if (!empty($data['nbreStationnement'])) $this->db->where('nbreStationnement', $data['nbreStationnement']);
    if (!empty($data['Meuble'])) $this->db->where('Meuble', $data['Meuble']);
    if (!empty($data['LaveuseSecheuse'])) $this->db->where('LaveuseSecheuse', $data['LaveuseSecheuse']);
    if (!empty($data['LaveVaisselle'])) $this->db->where('LaveVaisselle', $data['LaveVaisselle']);
    if (!empty($data['Note'])) $this->db->where('Note', $data['Note']);
    /*if (!empty($data['IntervallesAcceptee'])) {
      $this->db->where('IntervallesAcceptee', $data['IntervallesAcceptee']);
      if (!empty($data['IntervallesAcceptee']))

    }
    */


    $query = $this->db->get();

      //tableau de resultats
    return $query->result_array();
  }
	
}//Fin de la classe