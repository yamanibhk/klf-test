<?php
/**
 * @file      Mode_paiement_model.php
 * @author    Mathieu
 * @version   1.0
 * @date      28 février 2018
 * @brief     accées et vérification et CRUD sur les moyens de paiements
 */
class Mode_paiement_model extends CI_Model{

  public function __construct(){
    $this->load->database();
  }

  /**
   * Obtiens tous les modes de paiements de la BD
   *
   * @return     Array d'objets  Retourne un tableau d'objets representant les modes de paiements
   */
  public function obtenir_tous(){
    $query = $this->db->get("mode_paiement");
    return $query->result();
  }
}//Fin du modele