<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class='formulaireAjout'>
<h2>Ajouter une annonce</h2>

<section id="inscrireAppartement-form">
<div class="row">
  <div class="form-group col-sm-6">       
    <label for="arrondissement">Arrondissement</label>
    <select id="arrondissement" class="form-control champ">
			<option></option>
			<?php foreach($arrondissements as $arrond){?>

			<option value="<?php echo $arrond->idArrondissement;?>"><?php echo $arrond->nomArrondissement;?></option>

			<?php } ?>
		</select>
		<div class="echec"></div>
     
    <label for="adresse">Adresse</label>
    <input type="text" class="form-control champ" id="adresse" aria-describedby="adresse">
		<div class="echec"></div>
    
    <label for="codePostal">Code postal</label>
    <input type="text" class="form-control champ" id="codePostal">
		<div class="echec"></div>
  </div>

  <div class="form-group col-sm-6">      
    <label for="type">Type de logement</label>
    <select id="type" class="form-control champ">
      <option></option>
      <option>Condominium</option>
      <option>Appartement</option>
      <option>Maison</option>
      <option>Chalet</option>
    </select>
		<div class="echec"></div>
   
    <label for="piece">Nombre de pièce</label>
    <input type="text" class="form-control champ" id="piece">
		<div class="echec"></div>
 
    <label for="etage">Nombre d'étage</label>
    <input type="etage" class="form-control champ" id="etage">
		<div class="echec"></div>
  </div>
</div>
<div class="row">
<div class="col-md-6">
  <div class="form-group row">
    <label class="col-md-3">Internet</label>
    <div class="col-md-3">
  		<input type="radio" name="internet" id="internet-0" class="internet champ" checked="checked" value="1"><label for="internet-0">Oui</label>
  		<input type="radio" name="internet" id="internet-1" class="internet champ" value="0"><label for="internet-1">Non</label>
  		<div class="echec"></div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-3" for="tele">Télévision</label>
    <div class="col-md-3">
  		<input type="radio" name="tele" id="tele-0" class="tele champ" checked="checked" value="1"><label for="tele-0">Oui</label>
  		<input type="radio" name="tele" id="tele-1" class="tele champ" value="0"><label for="tele-1">Non</label>
  		<div class="echec"></div>
    </div>
  </div>
	<div class="form-group row">
    <label class="col-md-3" for="meuble">Meublé</label>
    <div class="col-md-3">
  		<input type="radio" name="meuble" id="meuble-0" class="meuble champ" checked="checked" value="1"><label for="meuble-0">Oui</label>
  		<input type="radio" name="meuble" id="meuble-1" class="meuble champ" value="0"><label for="meuble-1">Non</label>
  		<div class="echec"></div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-3" for="climatiseur">Climatiseur</label>
    <div class="col-md-3">
  		<input type="radio" name="climatiseur" id="climatiseur-0" class="climatiseur champ" checked="checked" value="1"><label for="climatiseur-0">Oui</label>
  		<input type="radio" name="climatiseur" id="climatiseur-1" class="climatiseur champ" value="0"><label for="climatiseur-1">Non</label>
  		<div class="echec"></div>
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group row">
    <label class="col-md-4" for="adapte">Adapté</label>
    <div class="col-md-3">
  		<input type="radio" name="adapte" id="adapte-0" class="adapte champ" checked="checked" value="1"><label for="adapte-0">Oui</label>
  		<input type="radio" name="adapte" id="adapte-1" class="adapte champ" value="0"><label for="adapte-1">Non</label>
  		<div class="echec"></div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-4" for="laveuseSecheuse">Laveuse/Sécheuse</label>
    <div class="col-md-3">
  		<input type="radio" name="laveuseSecheuse" id="laveuseSecheuse-0" class="laveuseSecheuse champ" checked="checked" value="1"><label for="laveuseSecheuse-0">Oui</label>
  		<input type="radio" name="laveuseSecheuse" id="laveuseSecheuse-1" class="laveuseSecheuse champ" value="0"><label for="laveuseSecheuse-1">Non</label>
  		<div class="echec"></div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-4" for="laveVaisselle">Lave vaisselle</label>
    <div class="col-md-3">
  		<input type="radio" name="laveVaisselle" id="laveVaisselle-0" class="laveVaisselle champ" checked="checked" value="1"><label for="laveVaisselle-0">Oui</label>
  		<input type="radio" name="laveVaisselle" id="laveVaisselle-1" class="laveVaisselle champ" value="0"><label for="laveVaisselle-1">Non</label>
  		<div class="echec"></div>
    </div>
  </div>
  <div class="form-group row">      
    <label class="col-md-5" for="stationnement">Nombre de stationnement</label>
    <select class="form-control col-md-2 champ" id="stationnement">
      <option></option>
      <option>0</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
    </select>
		<div class="echec"></div>
  </div>
</div>
</div>
  <div class="form-group">
    <label for="titre">Titre</label>
    <input class="form-control champ" id="titre">
    <div class="echec"></div>
  </div>
  <div class="form-group">
    <label for="description">Déscription</label>
    <textarea class="form-control champ" rows="5" id="description"></textarea>
		<div class="echec"></div>
  </div>
  <div class="row">
    <div class="col-sm-6">
       <label for="icone">Icône du fichier (JPG, PNG ou GIF | max. 15 Ko) :</label><br />
       <input type="text" class="champ" name="detail" placeholder="Titre du fichier" id="detail" />
       <input type="file" class="champ" name="icone" id="icone" /><br />
			 <div class="echec"></div>
    </div>
    <div class="col-sm-6">
      <button id="retourAppart" class="btn btn-secondary">Retrour à mes appartements</button>      
      <button id="enregistrerAppartement" class="btn btn-primary">Enregistrer</button>      
    </div>
    
  </div>
</section>
</div>