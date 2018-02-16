<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModalMenus {

  public function chargeMenus(){
    $menus = ["Accueil" => "../accueil/index",
              "Mes logements" => "../#",
              "Mes annonces" => "../#",
              "Mon compte" => "../usagers/monCompte",
              "Déconnexion" => "../usagers/deconnexion"
            ];
    return $menus;
  }
}