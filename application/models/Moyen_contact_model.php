<?php
	class Moyen_contact_model extends CI_Model{
		
		public function __construct(){
			$this->load->database();
		}

		public function obtenir_MoyenContactParEmail($nomUsager, $email)//pour trouver si un email est déja utilisé
		{
			$query = $this->db->get_where("Moyen_contact", array("" => $email));
			return $query->row_array();
		}
		public function obtenir_MoyenContactParUsager($nomUsager)//pour trouver si tout les moyens de contact d'un usager
		{
			$query = $this->db->get_where("Moyen_contact", array("" => $nomUsager));
			return $query->row_array();
		}

		public function modifier_MoyenContact($idMoyen, $moyenContact, $Details, $estMoyenPrefere){//pour modifier les données de moyens de contact par l'usager lui meme 
			//ce tableau contient toutes les nouvelles données, récupérées du formulaire de modification
			$data = array (
				"moyenContact" => $moyenContact,
				"Details" => $Details,
				"estMoyenPrefere" =>  $estMoyenPrefere,
			);
			$this->db->where('idMoyen', $idMoyen);
			$this->db->update('Moyen_contact', $data);
		
		}
		public function ajouter_MoyenContact($nomUsager, $moyenContact, $Details, $estMoyenPrefere){//ajout d'un moyen de contact pour un usager
			//ce tableau contient toutes les données récupérées du formulaire d'insertion
			$data = array (
				"nomUsager" => $nomUsager,
				"moyenContact" => $moyenContact,
				"Details" => $Details,
				"estMoyenPrefere" => $estMoyenPrefere,
						
			);
			//faire l'insertion des données du formulaire d'ajout de moyen de contact
			return $this->db->insert("Moyen_contact", $data);
		}
		
		public function supprimer_MoyenContactParId($id){//suppression d'un moyen de contact par son id
			$this->db->where('idMoyen', $id);
			$this->db->delete('Moyen_contact');
		}
		
		public function supprimer_MoyenContactParUsager($nomUsager){//suppression de tout les moyens de contact d'un usager
			$this->db->where('nomUsager', $nomUsager);
			$this->db->delete('Moyen_contact');
		}
?>