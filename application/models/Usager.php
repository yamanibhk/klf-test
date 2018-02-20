<?php
/**
* @file Usager.php
* @author Yamani Bouharkat & Leila Salhi
* @version v1.0
* @date 19/02/2018
* @brief page  de la classe usager
* @details cette classe pour les usagers, elle contiendra leurs data
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Usager {
  public $nomUsager;
  public $Nom;
  public $Prenom;
  public $motDePasse;
  public $Adresse;
  public $estBanni;
  public $estValide;
  public $idRole;
  public $typePaiem;
  public $Validateur;
  public $dateCreationCompte;


  public function __construct($nomUsager = "", $Nom = "", $Prenom = "", $motDePasse = "",
  $Adresse = "", $estBanni = "", $estValide = "", $idRole = "", $typePaiem = "", $Validateur = "",  $dateCreationCompte = "")
  {
    $this->nomUsager = $nomUsager;
    $this->Nom = $Nom;
    $this->Prenom = $Prenom;
    $this->motDePasse = $motDePasse;
    $this->Adresse = $Adresse;
    $this->estBanni = $estBanni;
    $this->estValide = $estValide;
    $this->idRole = $idRole;
    $this->typePaiem = $typePaiem;
    $this->Validateur = $Validateur;
    $this->dateCreationCompte = $dateCreationCompte;
  }
}