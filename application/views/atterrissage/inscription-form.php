<section id="inscription-form">
  <div class="form-group">
    <label for="username">Choisissez votre username</label>
    <input type="text" class="form-control" name="nomUsager" id="username" aria-describedby="username" placeholder="Unique, il ne pourra être changé">
    <div class="valid-feedback"></div>
    <div class="invalid-feedback"></div>
  </div>
  <div class="form-group">
    <label for="password">Votre mot de passe</label>
    <input type="password" class="form-control" id="password" name="motDePasse">
    <div class="valid-feedback"></div>
    <div class="invalid-feedback"></div>
    </div>
  <div class="form-group">
    <label for="password_confirm">Confirmez le mot de passe</label>
    <input type="password" class="form-control" id="password_confirm">
    <div class="valid-feedback"></div>
    <div class="invalid-feedback"></div>
  </div>
  <div class="form-group">
    <label for="courriel">Indiquez votre courriel</label>
    <input type="mail" class="form-control" id="courriel" name="courriel">
    <div class="valid-feedback"></div>
    <div class="invalid-feedback"></div>
  </div>
  <div class="d-flex flex-wrap justify-content-end">
    <a href="#" id="cancel" class="d-block py-2 px-3 text-white">Annuler</a>
    <button id="inscription-submit" class="btn btn-primary">M'inscrire</button>
  </div>
</section>