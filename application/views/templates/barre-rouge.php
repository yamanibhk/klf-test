<?php
if($this->session->userdata("nomUsager")){
  echo "<div id='page-title' class='d-flex justify-content-between px-3'>";
} else {
  echo "<div id='page-title'>";
}
?>
  <span class="p-0 m-0 d-none d-md-block" style="width: 105.14px"><img class="logo" src="<?=base_url();?>images/global/logo.svg" alt="logo"></span>
  <h1 class="p-0 m-0 d-none d-md-block"><?=$titre?></h1>
  <small class="p-0 m-0 d-md-none"><?=$titre?></small>
  <?php
  if($this->session->userdata("nomUsager")){
  ?>
    <!-- modal trigger -->
    <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#gestionCompte">
      <?=$utilisateur['nomUsager']?>
      <i class="fas fa-bars ml-2"></i>
    </button>
  <?php
  }
  ?>
</div>
<div id="redbar_height_fix"></div>