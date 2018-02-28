<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- script menu -->
<script type="text/javascript" async="true" src="<?=base_url();?>js/usagers/script.js"></script>
<div>
  <section id="content" class="container">
    <div class="row justify-content-center">
      <div class="col-10 col-md-6 col-xl-4">
        <div class="py-3">
          <a href="#" onclick="return false" data-toggle="modal" data-target="#nouvelle_image">
            <img class="card-img-top" src="<?=base_url();?>/images/usagers/user.svg" alt="image">
          </a>
          <!-- nom et prenom -->
          <p class="lead text-center m-0 pt-3">
            <?php
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
        <section class="form-row align-items-center">
          <!-- Prenom -->
          <div class="w-100 mb-3">
            <label class="sr-only" for="input_prenom">prénom</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text font-weight-bold">Prénom</div>
              </div>
              <input type="text" readonly="true" class="form-control text-center" id="input_prenom" value="<?=$utilisateur['Prenom']==NULL ? NULL : $utilisateur['Prenom']?>">
            </div>
          </div>
          <!-- Nom -->
          <div class="w-100 mb-3">
            <label class="sr-only" for="input_nom">Nom</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text font-weight-bold">Nom</div>
              </div>
              <input type="text" readonly="true" class="form-control text-center" id="input_nom" value="<?=$utilisateur['Nom']==NULL ? NULL : $utilisateur['Nom']?>">
            </div>
          </div>
          <!-- adresse -->
          <div class="w-100 mb-3">
            <label class="sr-only" for="input_adresse">adresse</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text font-weight-bold">Adresse</div>
              </div>
              <input type="text" readonly="true" class="form-control text-center" id="input_adresse" value="<?=$utilisateur['Adresse']==NULL ? NULL : $utilisateur['Adresse']?>">
            </div>
          </div>
          <!-- mode de paiement -->
          <div class="w-100 mb-3">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text font-weight-bold" for="input_mode_paiement">Mode paiement</label>
              </div>
              <select id="input_mode_paiement" class="custom-select" readonly="true" style="background-color: #e9ecef">
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
          <input type="hidden" id="input_nomUsager" value="<?=$utilisateur['nomUsager']?>">
          <button id="btn_sauvegarder_changements" class="w-100 mb-3 btn btn-outline-primary" style="display: none">Sauvegarder les changements</button>
          <p class="w-100 lead text-center">Membre depuis : <span><?=$utilisateur['dateCreationCompte']?></span></p>
        </section><!-- Fin du formulaire -->
      </div>
    </div>
  </section>
  <!-- Modal nouvelle image -->
  <div class="modal fade" id="nouvelle_image" tabindex="-1" role="dialog" aria-labelledby="nouvelle_image" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nouvelle_image">Choisir une nouvelle image</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- input nouvelle image -->
          <div class="input-group my-3">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="input_nouvelle_image">
              <label class="custom-file-label" for="input_nouvelle_image">Choisissez une image</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">C'est fait</button>
        </div>
      </div>
    </div>
  </div>
</div>