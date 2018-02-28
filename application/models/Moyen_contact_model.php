<?php
/**
 * @file      Moyen_contact_model.php
 * @author    Yamani
 * @version   1.0
 * @date      13 février 2018
 * @brief     accées et vérification et CRUD sur les données des utilisateurs
 *
 * @details    Cette classe nous permet de vérifier l'existence des email, opérations CRUD sur table moyens contacts
 */
class Moyen_contact_model extends CI_Model{

  public function __construct(){
    $this->load->database();
  }

  /**
   * obtenir le moyen de contact dont l'email et nom usager sont précis, cette fonction servira a verifier si un email existe ou non
   *
   * @param      string  $nomUsager  le nom usager
   * @param      string  $email      l'email de l'usager a verifier son existence
   *
   * @return     array  tableau de resultat contenant le moyen de contact
   */
  public function obtenir_MoyenContactParEmail($nomUsager, $email)
  {
    $query = $this->db->get_where("Moyen_contact", array("Details" => $email, "nomUsager" => $nomUsager));
    return $query->row_array();
  }

/**
   * Retourne un moyen de contact pour vérifier si l'email est déja utilisé.
   *
   * @param      string   $courriel  email de l'usager
   *
   * @return     tableau  contenant l'email de l'usager et autre données de moyen de contact.
   */
  public function obtenir_courriel($courriel){
    $query = $this->db->get_where("moyen_contact", array("Details" => $courriel));
    return $query->row_array();
  }


  /**
   * tout les moyens de contact d'un usager
   *
   * @param      string  $nomUsager  le nom usager
   *
   * @return     array  les données sur les moyens de contates de l'usager
   */
  public function obtenir_MoyenContactParUsager($nomUsager)
  {
    $query = $this->db->get_where("Moyen_contact", array("" => $nomUsager));
    return $query->row_array();
  }


  /**
   * modification d'un moyen de contact d'un usager
   *
   * @param      numeric $idMoyen          identifiant du moyen de contact
   * @param      string  $moyenContact     le type de  moyen contact ex email,tél,skype
   * @param      string  $Details          les details du moyen de contact ex salut@gmail.com ou 514 852 2971
   * @param      boolean $estMoyenPrefere  true s'il est moyen préféré et false le cas contraire
   */
  public function modifier_MoyenContact($idMoyen, $moyenContact, $Details, $estMoyenPrefere){
    //ce tableau contient toutes les nouvelles données, récupérées du formulaire de modification
    $data = array (
      "moyenContact" => $moyenContact,
      "Details" => $Details,
      "estMoyenPrefere" =>  $estMoyenPrefere,
    );
    $this->db->where('idMoyen', $idMoyen);
    $this->db->update('Moyen_contact', $data);
  }


  /**
   *  ajout d'un moyen de contact d'un usager
   *
   * @param      string  $nomUsager        le nom usager
   * @param      string  $moyenContact     le moyen contact
   * @param      string  $Details          le details
   * @param      boolean $estMoyenPrefere  si il'est moyen préféré
   *
   * @return     true si insertion moyen de contact reussie
   */
  public function ajouter_MoyenContact($nomUsager, $moyenContact, $Details, $estMoyenPrefere){
    //ce tableau contient toutes les données récupérées du formulaire d'insertion
    $data = array (
      "nomUsager" => $nomUsager,
      "moyenContact" => $moyenContact,
      "Details" => $Details,
      "estMoyenPrefere" => $estMoyenPrefere,

    );

     $query = $this->db->insert("Moyen_contact", $data);
     if ($query) return true;
  }



  /**
   * suppression d'un moyen de contact d'un usager, par id du moyen de contact
   *
   * @param      nemeric  $id      identifiant du moyen de contact
   */
  public function supprimer_MoyenContactParId($id){
    $this->db->where('idMoyen', $id);
    $this->db->delete('Moyen_contact');
  }



  /**
   * supression de tout les moyens de contact d'un usager, va servir au moment de suppression d'un usager de la BDD
   *
   * @param      string  $nomUsager  le nom usager
   */
  public function supprimer_MoyenContactParUsager($nomUsager){
    $this->db->where('nomUsager', $nomUsager);
    $this->db->delete('Moyen_contact');
  }
}