<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModalMenus {

  public function chargeMenus(){
    $menus = ["Accueil" => "../accueil/index",
              "Mes logements" => "../appartement/index",
              "Mon compte" => "../usagers/index",
              "Messagerie" => "../messagerie/index"
            ];
    return $menus;
  }
}