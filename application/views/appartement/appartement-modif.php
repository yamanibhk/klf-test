<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="modificationForm">
<h2>Modifier une annonce</h2>

<section id="modifierAppartement">
<div class="form-group row">
  <label class="col-md-3">Arrondissement</label>
  <div class="col-md-3" ><input id="arrond" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierArron' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
  
</div>

<div class="form-group row">
  <label class="col-md-3">Adresse</label>
  <div class="col-md-3" ><input id="adresse" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierAdresse' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Titre</label>
  <div class="col-md-3" ><input id="titre" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierTitre' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Code postal</label>
  <div class="col-md-3" ><input id="cp" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierCp' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Type de logement</label>
  <div class="col-md-3" ><input id="typeLog" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierTypeLog' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Nombre de pièces</label>
  <div class="col-md-3" ><input id="piece" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierPiece' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Nombre d'étages</label>
  <div class="col-md-3" ><input id="etage" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierEtage' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Internet</label>
  <div class="col-md-3" ><input id="internet" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierInternet' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Télévision</label>
  <div class="col-md-3" ><input id="tele" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierTele' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Climatiseur</label>
  <div class="col-md-3" ><input id="clim" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierClim' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Meublé</label>
  <div class="col-md-3" ><input id="meuble" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierMeuble' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Adapté</label>
  <div class="col-md-3" ><input id="adapte" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierAdapte' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Laveuse/Sécheuse</label>
  <div class="col-md-3" ><input id="lavSech" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierLavSech' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Lave vaisselle</label>
  <div class="col-md-3" ><input id="lavVaiss" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></div>
  <div class="col-md-3"><a id='modifierLavVaiss' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Nombre de stationnements</label>
  <div class="col-md-3" ><input id="statnmt" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3"/></div>
  <div class="col-md-3"><a id='modifierStatnmt' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>

<div class="form-group row">
  <label class="col-md-3">Description</label>
  <div class="col-md-3" ><textarea id="desc" value="" type="text" readonly class="form-control-plaintext lead pt-0 pb-3" ></textarea></div>
  <div class="col-md-3"><a id='modifierDesc' href='#' onclick='' class='card-link lien' data-toggle='tooltip' data-placement='top'><i class='far fa-edit'></i></a></div>
</div>
<div>
  <button id="retourAppart" class="btn btn-secondary">Retrour à mes appartements</button>      
  <button id="ModifierAppartement" class="btn btn-primary">Enregistrer</button>      
</div>
</section>
</div>
