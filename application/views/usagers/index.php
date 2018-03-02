<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.1.6/cropper.min.css"/>
<!-- script menu -->
<script type="text/javascript" async="true" src="<?=base_url();?>js/usagers/script.js"></script>
<div>
  <div id="content" class="container">
    <div class="row justify-content-center">
      <div class="col-10 col-md-6 col-xl-4">
        <div class="py-3">
          <?php
          // photo du profil
          if($utilisateur['cheminPhoto'] != NULL) {
            echo '<img id="profile_image" class="card-img-top" src="'.base_url().'/images/usagers/'.$utilisateur['cheminPhoto'].'"/>';
          } else {
            echo '<img id="profile_image" class="card-img-top" src="'.base_url().'/images/usagers/user.svg"/>';
          }
          ?>
          <!-- nom et prenom -->
          <p class="lead text-center m-0 pt-3">
            <?php
            // var_dump("<pre>", $utilisateur, "</pre>");
            if($utilisateur['Prenom'] != NULL && $utilisateur['Nom'] != NULL) {
              echo $utilisateur['Prenom']." ".$utilisateur['Nom'];
            }
            ?>
          </p>
          <!-- statut -->
          <p class="text-center m-0">
            <?php
            //Type d'usager, admin, superadmin ou usager
            if($utilisateur['idRole'] > 1) {
              echo "<span class='badge badge-pill badge-secondary'>Membre</span>";
            } else {
              if($utilisateur['idRole'] == 1) {
                echo "<span class='badge badge-pill badge-success'>Administrateur</span>";
              } else {
                echo "<span class='badge badge-pill badge-success'>Super-administrateur</span>";
              }
            }
            ?>
          </p>
        </div>
        <form id="change_form" class="form-row align-items-center">
          <section id="controles_changer_image" class="w-100 mb-3">
            <a id="btn_nouvelle_image" class="d-block text-center py-2" href="#" onclick="return false" data-toggle="collapse" data-target="#nouvelle_image">Changer l'image</a>
            <div class="collapse" id="nouvelle_image">
              <div class="input-group mb-2">
                <div class="custom-file">
                  <input type='file' id="input_nouvelle_image" name="image" class="custom-file-input"/>
                  <input type="hidden" name="posX">
                  <input type="hidden" name="posY">
                  <input type="hidden" name="width">
                  <input type="hidden" name="height">
                  <label class="custom-file-label" for="input_nouvelle_image">Choisissez une image</label>
                </div>
              </div>
            </div>
          </section>
          <!-- Prenom -->
          <div class="w-100 mb-3">
            <label class="sr-only" for="input_prenom">prénom</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text font-weight-bold">Prénom</div>
              </div>
              <input type="text" readonly="true" class="form-control text-center" name="input_prenom" value="<?=$utilisateur['Prenom']==NULL ? NULL : $utilisateur['Prenom']?>">
            </div>
          </div>
          <!-- Nom -->
          <div class="w-100 mb-3">
            <label class="sr-only" for="input_nom">Nom</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text font-weight-bold">Nom</div>
              </div>
              <input type="text" readonly="true" class="form-control text-center" name="input_nom" value="<?=$utilisateur['Nom']==NULL ? NULL : $utilisateur['Nom']?>">
            </div>
          </div>
          <!-- adresse -->
          <div class="w-100 mb-3">
            <label class="sr-only" for="input_adresse">adresse</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text font-weight-bold">Adresse</div>
              </div>
              <input type="text" readonly="true" class="form-control text-center" name="input_adresse" value="<?=$utilisateur['Adresse']==NULL ? NULL : $utilisateur['Adresse']?>">
            </div>
          </div>
          <!-- mode de paiement -->
          <div class="w-100 mb-3">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text font-weight-bold" for="input_mode_paiement">Mode paiement</label>
              </div>
              <select name="input_mode_paiement" class="custom-select" readonly="true" style="background-color: #e9ecef">
                <?php
                foreach ($mode_paiements as $mode) {
                  if(strtolower($mode->typePaiem) == strtolower($utilisateur['typePaiem'])) {
                    echo "<option value='".strtolower($mode->typePaiem)."' selected>".strtolower($mode->typePaiem)."</option>";
                  } else {
                    echo "<option value='".strtolower($mode->typePaiem)."'>".strtolower($mode->typePaiem)."</option>";
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <input type="hidden" name="input_nomUsager" value="<?=$utilisateur['nomUsager']?>">
          <button id="btn_sauvegarder_changements" class="w-100 mb-3 btn btn-outline-primary" style="display: none">Sauvegarder les changements</button>
          <p class="w-100 lead text-center">Membre depuis : <span><?=$utilisateur['dateCreationCompte']?></span></p>
        </form><!-- Fin du formulaire -->
      </div>
    </div>
  </section>
</div>