<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Modal -->
<div class="modal fade" id="nouvel_arrondissement" tabindex="-1" role="dialog" aria-labelledby="nouvel_arrondissement" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nouvel_arrondissement">Ajouter un arrondissement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="nomArrondissement">Nom de l'arrondissement</label>
          <input type="text" class="form-control" id="nomArrondissement" aria-describedby="nomArrondissementHelp">
          <small id="nomArrondissementHelp" class="form-text text-muted">Vous pourrez toujours le modifier par la suite</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <a id="btn_ajouter_arrond" href="#" onclick="return false" class="btn btn-primary">Sauvegarder</a>
      </div>
    </div>
  </div>
</div>
<div class="d-flex flex-wrap justify-content-center pt-3 pt-md-4 pt-lg-5">
  <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#nouvel_arrondissement" aria-expanded="false" aria-controls="nouvel_arrondissement">
    Ajouter un arrondissement
  </button>
</div>
<div class="p-3 p-md-4 p-lg-5">
  <div class="row">
    <?php
    foreach ($arrondissements as $arrondissement) {
      ?>
      <div class="col-lg-6 col-xl-4 p-2">
        <div class="card">
          <div class="card-body">
            <input type="text" readonly class="form-control-plaintext lead pt-0 pb-3" value="<?=$arrondissement->nomArrondissement?>">
            <div class="actions_arrondissements" data-id_arrondissement="<?=$arrondissement->idArrondissement?>">
              <a id="btn_modifier" href="#" onclick="return false" class="card-link" data-toggle="tooltip" data-placement="top" title="Modifier"><i class="far fa-edit"></i></a>
              <?php
              if($arrondissement->nbreAppart == NULL) {
                echo "<a id='btn_supprimer' href='#' onclick='return false' class='card-link' data-toggle='tooltip' data-placement='top' title='Supprimer'><i class='far fa-trash-alt'></i></a>";
              } else {
                echo "<a class='card-link' data-toggle='tooltip' data-placement='top' title='Suppression impossible, appartements liés'><i class='far fa-trash-alt text-muted'></i></a>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <?php
    };
    ?>
  </div>
</div>