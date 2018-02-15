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
  * @return     array  l'usager.
  */
  public function obtenir_usager($username){
    $query = $this->db->get_where("usager", array("nomUsager" => $username));
    return $query->row_array();
  }

  /**
  * Retourne un email.
  *
  * @return    array le email.
  */
  public function obtenir_courriel($courriel){
    $query = $this->db->get_where("moyen_contact", array("Details" => $courriel));
    return $query->row_array();
  }

  /**
  * inscrire un nouveau utilisateur dans la base de donnée
  *
  * @return     boolean  ( description_of_the_return_value )
  */
  public function ajouter_usager($nomUsager, $motDePasse, $courriel){
    $data_username = array(
      'nomUsager' => $nomUsager,
      'motDePasse' => password_hash($motDePasse, PASSWORD_DEFAULT),
      'Nom' => NULL,
      'Prenom' => NULL,
      'Adresse' => NULL,
      'estBanni' => false,
      'estValide' => false,
      'Validateur' => NULL,
      'idRole' => '2',
      'typePaiem' => 'payPal'
    );
    $data_courriel = array(
      'nomUsager' => $nomUsager,
      'moyenContact'    => "courriel",
      'Details'    => $courriel
    );
    $this->db->set('dateCreationCompte', 'NOW()', FALSE);
    //faire l'insertion d'utilisateur dans la table usager
    $query1 = $this->db->insert("usager", $data_username);
    $query2 = $this->db->insert("moyen_contact", $data_courriel);
    if($query1 && $query2){
      return true;
    }
  }

  /**
  * vérifier si l'utilisateur est deja inscrit dans la base de donnée
  *
  * @return     array  l'usager
  */
  public function verifier_connexion($nomUsager, $motDePasse) {
    $query = $this->db->get_where("usager", array("nomUsager" => $nomUsager));
    $reponse = array();
    if($query->num_rows() > 0) {
      $usager = $query->row();
      //vérifier si le mot de passe est exacte
      if (password_verify($motDePasse, $usager->motDePasse)) {
        $reponse["existe"] = true;
        $reponse["estValide"] = $usager->estValide;
        $reponse["estBanni"] = $usager->estBanni;
      } else {
        $reponse["existe"] = false;
      }
    } else {
      $reponse["existe"] = false;
    }
    return $reponse;
  }

}//Fin de la classe