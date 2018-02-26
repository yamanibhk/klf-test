<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/gestion/stylesheet.css">
<!-- script menu -->
<script type="text/javascript" src="<?=base_url();?>js/gestion/menu-gestion.js"></script>
<div class="container-fluid">
  <div class="row">
    <section id="admin_menu" class="col-md-3 col-lg-2 px-0">
      <ul class="nav flex-column">
        <li class="nav-item"><a id="usagers" class="nav-link active" href="#" onclick='return false'>Usagers</a></li>
        <li class="nav-item"><a id="statistiques" class="nav-link" href="#" onclick='return false'>Statistiques</a></li>
        <li class="nav-item"><a id="arrondissements" class="nav-link" href="#" onclick='return false'>Arrondissements</a></li>
        <li class="nav-item"><a id="moyensDePaiements" class="nav-link" href="#" onclick='return false'>Moyens de paiements</a></li>
      </ul>
    </section>
    <section id="content_panel" class="container col-md-9 col-lg-10 px-0">
    </section>
  </div>
</div>