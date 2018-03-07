<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="modificationForm">
<h2>Modifier une annonce</h2>

<section id="modifierAppartement">
<div class="form-group row">
  <label class="col-md-3">Arrondissement</label>
<!--   <input class="col-md-3"  id="arrond" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" >
 -->  <select id="arrond" value="" class="form-control-plaintext champ col-md-3">
      <option></option>
      <?php foreach($arrondissements as $arrond){?>

      <option value="<?php echo $arrond->idArrondissement;?>"><?php echo $arrond->nomArrondissement;?></option>

      <?php } ?>
    </select>
  <div class="col-md-3"><a id='modifierArron'  href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Adresse</label>
  <input class="col-md-3" id="adresse" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierAdresse' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Titre</label>
  <input class="col-md-3" id="titre" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierTitre' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Code postal</label>
  <input class="col-md-3" id="cp" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierCp' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Type de logement</label>
  <input class="col-md-3" id="typeLog" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierTypeLog' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Nombre de pièces</label>
  <input class="col-md-3" id="piece" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierPiece' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Nombre d'étages</label>
  <input class="col-md-3" id="etage" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierEtage' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Internet</label>
  <input class="col-md-3" id="internet" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierInternet' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Télévision</label>
  <input class="col-md-3" id="tele" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierTele' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Climatiseur</label>
  <input class="col-md-3" id="clim" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierClim' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Meublé</label>
  <input class="col-md-3" id="meuble" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierMeuble' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Adapté</label>
  <input class="col-md-3" id="adapte" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierAdapte' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Laveuse/Sécheuse</label>
  <input class="col-md-3" id="lavSech" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierLavSech' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Lave vaisselle</label>
  <input class="col-md-3" id="lavVaiss" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" >
  <div class="col-md-3"><a id='modifierLavVaiss' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Nombre de stationnements</label>
  <input class="col-md-3" id="statnmt" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ"/>
  <div class="col-md-3"><a id='modifierStatnmt' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Description</label>
  <textarea class="col-md-3" id="desc" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3 champ" ></textarea>
  <div class="col-md-3"><a id='modifierDesc' href='#' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  <div class="echec"></div>
</div>
<div>
  <button id="retourAppart" class="btn btn-secondary">Retrour à mes appartements</button>      
  <button id="ModifierAppartement" class="btn btn-primary">Enregistrer</button>      
</div>
</section>
</div>
