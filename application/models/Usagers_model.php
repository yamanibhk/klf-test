<?php
/**
 * @file      Usagers_model.php
 * @author    Yamani & Mathieu & Leila
 * @version   1.0
 * @date      13 février 2018
 * @brief     accées et vérification et CRUD sur les données des utilisateurs
 *
 * @details   Cette classe nous permet de vérifier l'existence des utilisateurs,
 *            accès aux données des utilisateurs selon des parametres choisis,
 *            opérations CRUD sur table utilisateur.
 */
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
   * @param      string   $username  nom usager
   *
   * @return     tableau  d'usager.
   */
  public function obtenir_usager($username) {
    $query = $this->db->get_where("usager", array("nomUsager" => $username));
    return $query->row_array();
  }
  /**
   * inscrire un nouveau utilisateur dans la base de donnée
   *
   * @param      string   $nomUsager   le nom usager
   * @param      string   $motDePasse  le mot de passe
   * @param      string   $courriel    le courriel
   *
   * @return     boolean  signifiant que l'usager a été ajouté
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
   * @param      string   $nomUsager   le nom usager
   * @param      string   $motDePasse  le mot de passe
   *
   * @return     boolean  signifant que l'usager existe dans la table
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
  /**
   * modification données de l'utilisateur dans la base de donnée
   *
   * @param      string  $nomUsager   le nom usager
   * @param      string  $Nom         le nom
   * @param      string  $Prenom      le prenom
   * @param      string  $motDePasse  le mot de passe
   * @param      string  $Adresse     l'adresse
   * @param      string  $typePaiem   le type de paiement
   */
  public function modifier_usager($nomUsager, $Nom, $Prenom, $motDePasse, $Adresse, $typePaiem) {
    //ce tableau contient toutes les nouvelles données, récupérées du formulaire de modification
    $data = array (
      "Nom" => $Nom,
      "Prenom" => $Prenom,
      "motDePasse" =>  password_hash($motDePasse, PASSWORD_DEFAULT),
      "Adresse" => $Adresse,
      "typePaiem" => $typePaiem,
    );
    $this->db->where('nomUsager', $nomUsager);
    $this->db->update('Usager', $data);
  }
  /**
   * suppression d'un utilisateur
   *
   * @param     string  $nomUsager  le nom usager
   */
  public function supprimer_usager($nomUsager) {
    $this->db->where('nomUsager', $nomUsager);
    $this->db->delete('Usager');
  }
  /**
   * changer le status d'un utilisateur de valide a invalide et le contraire
   *
   * @param      string  $nomUsager  le nom usager
   * @param      boolean  $estValide  si a true valide si a false invalide
   */
  public function changeStatusValide_usager($nomUsager, $estValide) {
    //ce tableau contient toutes les nouvelles données, récupérées du formulaire de modification
    $data = array (
      "estValide" => $estValide,
    );
    $this->db->where('nomUsager', $nomUsager);
    $this->db->update('Usager', $data);
  }
  /**
   * bannir un usager ou ne pas le bannir
   *
   * @param      string  $nomUsager  le nom usager
   * @param      boolean  $estBanni   si a true utilisateur banni si a false il est pas banni
   */
  public function BannirInbannir_usager($nomUsager, $estBanni) {
    //ce tableau contient toutes les nouvelles données, récupérées du formulaire de modification
    $data = array (
      "estBanni" => $estBanni,
    );
    $this->db->where('nomUsager', $nomUsager);
    $this->db->update('Usager', $data);
  }
  /**
   * affichage des utilisateur ayant un roe précis
   *
   * @param      string  $Role   le role choisis
   *
   * @return     array  les données des utilisateurs ayant le role choisi
   */
  public function obtenir_usagersParRole($Role) {
    $this->db->select('*');
    $this->db->from('Usager');
    $this->db->join('Role', 'Usager.idRole = Role.idRole');
    $this->db->where('Role', $Role);
    $this->db->order_by('nomUsager', 'DESC');//trie par le nomUsager
    $query = $this->db->get();
    //tableau de resultats
    return $query->result_array();
  }
  /**
   * affichage de tout les usagers banni ou pas banni
   *
   * @param      boolean  $estBanni  si a true utilisateur banni si a false il est pas banni
   *
   * @return     array  les données des utilisateurs bannis ou pas bannis selon le choix
   */
  public function obtenir_usagersParBanniInbanni($estBanni) {
    $query = $this->db->get_where("Usager", array("estBanni" => $estBanni));
    return $query->result_array();
  }
  /**
   * affichage de tout les usagers valides ou pas valides
   *
   * @param      boolean  $estValide  si a true utilisateur valide si a false il est pas valide
   *
   * @return     array  les données des utilisateurs valides ou pas valides selon le choix
   */
  public function obtenir_usagersParValideInvalide($estValide) {
    $query = $this->db->get_where("Usager", array("estValide" => $estValide));
    return $query->result_array();
  }
  /**
   * affichage de tous les utilisateurs ayant un mode de paiement choisi
   *
   * @param      string  $typePaiem  le type de paiement
   *
   * @return     array  les données des utilisateurs
   */
  public function obtenir_usagersParTypePaiement($typePaiem) {
    $query = $this->db->get_where("Usager", array("typePaiem" => $typePaiem));
    return $query->result_array();
  }
  /**
   * affichage de tout les usagers ayant été validés par un administrateur précis
   *
   * @param      string  $Validateur  l'administrateur validateur
   *
   * @return     array  les données des utilisateurs
   */
  public function obtenir_usagersParValidateur($Validateur) {
    $query = $this->db->get_where("Usager", array("Validateur" => $Validateur));
    return $query->result_array();
  }
  /**
   * affichage de toutes les données des utilisateurs pour l'administrateur, ordre par defaut sur la clé primaire nomUsager
   *
   * @return     array  toutes les données de tous les utilisateurs
   */
  public function obtenir_usagers() {
    $query = $this->db->query("select * from (select Usager.*, moyen_contact.Details, moyen_contact.estMoyenPrefere from Usager
                    join Role on Usager.idRole = Role.idRole
                    right join Moyen_contact on Usager.nomUsager = Moyen_contact.nomUsager) as table1
                    left join (select count(idAppart) as 'NbreAppart',Proprietaire from Appartement group by Proprietaire) as table2 on table1.nomUsager=table2.Proprietaire
                    left join (select count(idLocation) as 'NbreLocat', Locataire from location group by Locataire) as table3 on table1.nomUsager=table3.Locataire
                    group by table1.nomUsager
                    order by table1.idRole ASC");
    $usagers = array();
    foreach ($query->result() as $usager) {
      $usagers[] = $usager;
    }
    return $usagers;
  }
}//Fin de la classe