<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModalMenus {

  public function chargeMenus(){
    $menus = ["Accueil" => "../accueil/index",
              "Mes logements" => "../appartement/mesLogements",
              "Mes annonces" => "../#",
              "Mon compte" => "../usagers/monCompte",
              "Déconnexion" => "../usagers/deconnexion"
            ];
    return $menus;
  }
}