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

  public function modifier_usager($nomUsager, $Nom, $Prenom, $motDePasse, $Adresse, $typePaiem){//usager modifie ses données 
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
    
    public function supprimer_usager($nomUsager){//suppression d'un usager
      $this->db->where('nomUsager', $nomUsager);
      $this->db->delete('Usager');
    }
    
    public function ValiderInvalider_usager($nomUsager, $estValide){//valider invalider usager 
      //ce tableau contient toutes les nouvelles données, récupérées du formulaire de modification
      $data = array (
        "estValide" => $estValide,          
      );
      $this->db->where('nomUsager', $nomUsager);
      $this->db->update('Usager', $data);
    
    }
    
    public function BannirInbannir_usager($nomUsager, $estValide){//bannir inbannir usager 
      //ce tableau contient toutes les nouvelles données, récupérées du formulaire de modification
      $data = array (
        "estBanni" => $estBanni,          
      );
      $this->db->where('nomUsager', $nomUsager);
      $this->db->update('Usager', $data);
    
    }
    
    public function obtenir_usagersParRole($Role){//affichage de tout les usagers ayant un role précis
      $this->db->select('*');
      $this->db->from('Usager');
      $this->db->join('Role', 'Usager.idRole = Role.idRole');
      $this->db->where('Role', $Role);
      $this->db->order_by('nomUsager', 'DESC');//trie par le nomUsager
    
      $query = $this->db->get();
      
      //tableau de resultats
      return $query->result_array();
    }
    
    public function obtenir_usagersParBanniInbanni($estBanni){//affichage de tout les usagers banni ou pas banni
      $query = $this->db->get_where("Usager", array("estBanni" => $estBanni));
      
      //tableau de resultats
      return $query->result_array();
    }
    
    
    public function obtenir_usagersParValideInvalide($estValide){//affichage de tout les usagers valide ou pas valide
      $query = $this->db->get_where("Usager", array("estValide" => $estValide));
      
      //tableau de resultats
      return $query->result_array();
    }
    
    public function obtenir_usagersParTypePaiement($typePaiem){//affichage de tout les usagers ayant un type de paiement précis
      $query = $this->db->get_where("Usager", array("typePaiem" => $typePaiem));
      
      //tableau de resultats
      return $query->result_array();
    }
    
    public function obtenir_usagersParValidateur($Validateur){//affichage de tout les usagers ayant été validés par un administrateur précis
      $query = $this->db->get_where("Usager", array("Validateur" => $Validateur));
      
      //tableau de resultats
      return $query->result_array();
    }

    public function obtenir_usagers(){//affichage de tout les usagers pour l'admin ,ordre par defaut sur la clé primaire nomUsager
      $this->db->select('*, count(Appartement.idAppart) as NbreAppart, count(Location.idLocation) as NbreLocat');
      $this->db->from('Usager');
      $this->db->join('Mode_paiement', 'Usager.typePaiem = Mode_paiement.typePaiem');
      $this->db->join('Role', 'Usager.idRole = Role.idRole');
      $this->db->join('Moyen_contact', 'Usager.nomUsager = Moyen_contact.nomUsager', 'right');
      $this->db->join('Location', 'Usager.nomUsager = Location.Locataire', 'right');
      $this->db->join('Appartement', 'Usager.nomUsager = Appartement.Proprietaire', 'right');
      $this->db->group_by("Usager.nomUsager");
      switch ($this->input->post('var_Trie',true))
      {
        case "Role":
          $this->db->order_by('Role', 'DESC');//trie par le role d'utilisateur admin,membre,super admin
          break;
        case "typePaiem":
          $this->db->order_by('typePaiem', 'DESC');//trie par type de paiement choisi
          break;
        case "NbreAppart":
          $this->db->order_by('NbreAppart', 'DESC');//trie par nombre d'appartements possédés
          break;
        case "NbreLocat":
          $this->db->order_by('NbreLocat', 'DESC');//trie par nombre de locations effectuées
          break;
        case "dateCreationCompte":
          $this->db->order_by('dateCreationCompte', 'ASC');//trie par date de creation de compte ordre croissant
          break;
        default:
          $this->db->order_by('nomUsager', 'DESC');//par defaut trier sur nomUsager
      }
      
      $query = $this->db->get();
      
      //tableau de resultats
      return $query->result_array();
    }

    
    public function obtenir_usagerParNomUsager($nomUsager){//affichage de toute les informations d'un usager précis
      $this->db->select('*');
      $this->db->from('Usager');
      $this->db->join('Mode_paiement', 'Usager.typePaiem = Mode_paiement.typePaiem');
      $this->db->join('Role', 'Usager.idRole = Role.idRole');
      $this->db->join('Moyen_contact', 'Usager.nomUsager = Moyen_contact.nomUsager', 'right');
      $this->db->join('Location', 'Usager.nomUsager = Location.Locataire', 'right');
      $this->db->join('Appartement', 'Usager.nomUsager = Appartement.Proprietaire', 'right');
      $this->db->where('nomUsager', $nomUsager);
      
      $query = $this->db->get();
      
      //tableau de resultats
      return $query->result_array();
    }

}//Fin de la classe