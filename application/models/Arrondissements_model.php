<?php
class Arrondissements_model extends CI_Model {
  /**
   * Constructeur
   */
  public function __construct() {
    $this->load->database();
  }

  /**
   * Obtiens tous les arrondissements
   *
   * @return     une liste d'objets representant les arrondissements
   */
  public function obtenir_arrondissements(){
    $query = $this->db->query("select table1.idArrondissement,nomArrondissement,nbreAppart
                    from (SELECT * from arrondissement) as table1
                    left join (select appartement.idArrondissement, count(idAppart) as nbreAppart
                    from appartement group by idArrondissement) as table2 on table1.idArrondissement=table2.idArrondissement
                    order by table1.idArrondissement DESC");
		return $query->result();
  }

  /**
   * Obtient un seul arrondissement
   *
   * @param      INT  $id     L'identifiant
   *
   * @return     Object  un object representant l'arrondissement
   */
  public function obtenir_arrondissement($id) {
    $query = $this->db->get_where("arrondissement", array("idArrondissement" => $id));
    return $query->row();
  }

  /**
   * Modifiera un arrondissement
   *
   * @param      INT  $id      L'identifiant
   * @param      STRING  $valeur  La nouvelle valeur pour l'arrondissement
   */
  public function modifier_arrondissement($id, $valeur) {
    $data = array (
      "nomArrondissement" => $valeur,
    );
    $this->db->where('idArrondissement', $id);
    $this->db->update('arrondissement', $data);
  }

  /**
   * Ajoute un arrondissement
   *
   * @param      STRING  $valeur  Le nom de l'arrondissement
   */
  public function ajouter_arrondissement($valeur) {
    $data = array(
      "nomArrondissement" => $valeur
    );
    $this->db->insert('arrondissement',  $data);
  }

  /**
   * Supprime un arrondissement
   *
   * @param      INT  $id     L'identifiant
   */
  public function supprimer_arrondissement($id) {
    $this->db->where('idArrondissement', $id);
    $this->db->delete('arrondissement');
  }
}//Fin de la classe