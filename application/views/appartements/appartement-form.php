<section id="inscrireAppartement-form">
  <div class="form-group">       
    <label for="arrondissement">Arrondissement</label>
    <select id="arrondissement" class="form-control"></select>
  </div>
  <div class="form-group">       
    <label for="adresse">Adresse</label>
    <input type="text" class="form-control" id="adresse" aria-describedby="adresse">
    <div class="valid-feedback"></div>
    <div class="invalid-feedback"></div>
  </div>
  <div class="form-group">      
    <label for="codePostal">Code postal</label>
    <input type="text" class="form-control" id="codePostal">
    <div class="valid-feedback"></div>
    <div class="invalid-feedback"></div>
  </div>
  <div class="form-group">      
    <label for="type">Type de logement</label>
    <input type="text" class="form-control" id="type">
    <div class="valid-feedback"></div>
    <div class="invalid-feedback"></div>
  </div>
  <div class="form-group">    
    <label for="piece">Nombre de pièce</label>
    <input type="text" class="form-control" id="piece">
    <div class="valid-feedback"></div>
    <div class="invalid-feedback"></div>
  </div>
  <div class="form-group">    
    <label for="etage">Nombre d'étage'</label>
    <input type="etage" class="form-control" id="etage">
    <div class="valid-feedback"></div>
    <div class="invalid-feedback"></div>
  </div>
  <div class="form-group">
    <label for="internet">Internet</label>
    <label class="radio-inline"><input type="radio" id="internet">Oui</label>
    <label class="radio-inline"><input type="radio" id="internet">Non</label>
  </div>
  <div class="form-group">
    <label for="tele">Tèlévision</label>
    <label class="radio-inline"><input type="radio" id="tele">Oui</label>
    <label class="radio-inline"><input type="radio" id="tele">Non</label>
  </div>
  <div class="form-group">
    <label for="climatiseur">Climatiseur</label>
    <label class="radio-inline"><input type="radio" id="climatiseur">Oui</label>
    <label class="radio-inline"><input type="radio" id="climatiseur">Non</label>
  </div>
  <div class="form-group">
    <label for="adapte">Adapté</label>
    <label class="radio-inline"><input type="radio" id="adapte">Oui</label>
    <label class="radio-inline"><input type="radio" id="adapte">Non</label>
  </div>
  <div class="form-group">
    <label for="laveuseSecheuse">Laveuse / Sécheuse</label>
    <label class="radio-inline"><input type="radio" id="laveuseSecheuse">Oui</label>
    <label class="radio-inline"><input type="radio" id="laveuseSecheuse">Non</label>
  </div>
  <div class="form-group">
    <label for="laveVaisselle">Lave vaisselle</label>
    <label class="radio-inline"><input type="radio" id="laveVaisselle">Oui</label>
    <label class="radio-inline"><input type="radio" id="laveVaisselle">Non</label>
  </div>
  <div class="form-group">      
    <label for="stationnement">Nombre de stationnement</label>
    <input type="text" class="form-control" id="stationnement">
    <div class="valid-feedback"></div>
    <div class="invalid-feedback"></div>
  </div>
  <div class="form-group">
    <label for="description">Déscription</label>
    <textarea class="form-control" rows="5" id="description"></textarea>
  </div>
  <div class="d-flex flex-wrap justify-content-end">
    <button id="enregistrerAppartement-submit" class="btn btn-primary">Enregistrer</button>      
  </div>
</section>