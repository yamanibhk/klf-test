<!-- Modal -->
<div class="modal fade" id="gestionCompte" tabindex="-1" role="dialog" aria-labelledby="gestionCompte" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gestionCompte"><?=$utilisateur['nomUsager']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="list-group-flush">
          <?php
          foreach ($menus as $nom => $href) {
            if(strtolower($nom) == strtolower($titre)) {
              echo "<a href='$href' class='list-group-item list-group-item-action active'>$nom</a>";
            } else {
              echo "<a href='$href' class='list-group-item list-group-item-action'>$nom</a>";
            }
          }
          if($utilisateur['idRole'] < 2) {
            if(strtolower($titre) == "gestion du site"){
              echo "<a href='../gestion/index' class='list-group-item list-group-item-action active'>Gestion du site</a>";
            } else {
              echo "<a href='../gestion/index' class='list-group-item list-group-item-action list-group-item-secondary'>Gestion du site</a>";
            }
          }
          ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>