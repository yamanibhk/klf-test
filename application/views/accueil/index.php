<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($utilisateur['idRole'] < 2) {
	echo "<button>Admin</button>";
}
?>
<h1 id="page-title" class="d-flex justify-content-between px-3">
  <span><img class="logo" src="<?=base_url();?>images/global/logo.svg" alt="logo"></span>
  <?=$titre?>
  <!-- modal -->
  <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#gestionCompte">
    <?=$utilisateur['nomUsager']?>
    <i class="fas fa-bars ml-2"></i>
  </button>
</h1>