<div class='formulaireAjout'>
<h2>Ajouter une annonce</h2>
<section id="inscrireAppartement-form">
  <div class="form-group">       
    <label for="arrondissement">Arrondissement</label>
    <select id="arrondissement" class="form-control champ">
			<option></option>
			<?php foreach($arrondissement as $arrond){?>

			<option value="<?php echo $arrond["idArrondissement"];?>"><?php echo $arrond["nomArrondissement"];?></option>

			<?php } ?>
		</select>
		<div class="echec"></div>
  </div>
  <div class="form-group">       
    <label for="adresse">Adresse</label>
    <input type="text" class="form-control champ" id="adresse" aria-describedby="adresse">
		<div class="echec"></div>
  </div>
  <div class="form-group">      
    <label for="codePostal">Code postal</label>
    <input type="text" class="form-control champ" id="codePostal">
		<div class="echec"></div>
  </div>
  <div class="form-group">      
    <label for="type">Type de logement</label>
    <input type="text" class="form-control champ" id="type">
		<div class="echec"></div>
  </div>
  <div class="form-group">    
    <label for="piece">Nombre de pièce</label>
    <input type="text" class="form-control champ" id="piece">
		<div class="echec"></div>
  </div>
  <div class="form-group">    
    <label for="etage">Nombre d'étage</label>
    <input type="etage" class="form-control champ" id="etage">
		<div class="echec"></div>
  </div>
 <div class="form-group">
    <label for="internet">Internet</label>
		<input type="radio" name="internet" class="internet champ">Oui
		<input type="radio" name="internet" class="internet champ">Non
		<div class="echec"></div>
  </div>
  <div class="form-group">
    <label for="tele">Tèlévision</label>
		<input type="radio" name="tele" class="tele champ">Oui
		<input type="radio" name="tele" class="tele champ">Non
		<div class="echec"></div>
  </div>
	<div class="form-group">
    <label for="meuble">Meublé</label>
		<input type="radio" name="meuble" class="meuble champ">Oui
		<input type="radio" name="meuble" class="meuble champ">Non
		<div class="echec"></div>
  </div>
  <div class="form-group">
    <label for="climatiseur">Climatiseur</label>
		<input type="radio" name="climatiseur" class="climatiseur champ">Oui
		<input type="radio" name="climatiseur" class="climatiseur champ">Non
		<div class="echec"></div>
  </div>
  <div class="form-group">
    <label for="adapte">Adapté</label>
		<input type="radio" name="adapte" class="adapte champ">Oui
		<input type="radio" name="adapte" class="adapte champ">Non
		<div class="echec"></div>
  </div>
  <div class="form-group">
    <label for="laveuseSecheuse">Laveuse / Sécheuse</label>
		<input type="radio" name="laveuseSecheuse" class="laveuseSecheuse champ">Oui
		<input type="radio" name="laveuseSecheuse" class="laveuseSecheuse champ">Non
		<div class="echec"></div>
  </div>
  <div class="form-group">
    <label for="laveVaisselle">Lave vaisselle</label>
		<input type="radio" name="laveVaisselle" class="laveVaisselle champ">Oui
		<input type="radio" name="laveVaisselle" class="laveVaisselle champ">Non
		<div class="echec"></div>
  </div>
  <div class="form-group">      
    <label for="stationnement">Nombre de stationnement</label>
    <input type="text" class="form-control champ" id="stationnement">
		<div class="echec"></div>
  </div>
  <div class="form-group">
    <label for="description">Déscription</label>
    <textarea class="form-control champ" rows="5" id="description"></textarea>
		<div class="echec"></div>
  </div>
  <div class="d-flex flex-wrap justify-content-end">
    <button id="enregistrerAppartement" class="btn btn-primary">Enregistrer</button>      
  </div>
</section>
</div>