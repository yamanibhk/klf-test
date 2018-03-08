<?php
if ($erreur) {
  $message = "<p class='ajoutEchec'>Votre appartement est déja en location pour cette disponibilité</p>";
} else {
  $message = "<p class='ajoutSucces'>Votre annonce a bien été ajouté</p>";
}
?>
<div class="d-flex- justify-content-end">
  <?=$message?>
  <button id="retourAppart" class="btn btn-secondary text-white">Retourner à l'accueil</button>
</div>