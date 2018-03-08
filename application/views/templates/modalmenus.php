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
          // si l'usager actif est administrtateur
          if($utilisateur['idRole'] < 2) {
            // si l'usager la page sur laquelle on est est la page de gestion
            if(strtolower($titre) == "gestion du site"){
              echo "<a href='../gestion/index' class='list-group-item list-group-item-action active'>Gestion du site</a>";
            // Sinon, elle sera affichée avec le texte en bleu
            } else {
              echo "<a href='../gestion/index' class='list-group-item list-group-item-action'><span class='text-primary'>Gestion du site</span></a>";
            }
          }
          ?>
        </div>
      </div>
      <div class="modal-footer">
        <a class="text-secondary p-2" href="<?=base_url().'index.php/usagers/deconnexion'?>">Déconnexion</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>