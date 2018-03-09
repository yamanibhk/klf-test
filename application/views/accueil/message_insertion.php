<?php
if ($erreur) {
  $message = "<p class='ajoutEchec'>cet appartement est déja réservé pour ces dates</p>";
} else {
  $message = "<p class='ajoutSucces'>Votre réservation a bien été faite</p>";
}
?>
<div class="d-flex- justify-content-end">
  <?=$message?>
  <button id="retourAppart" class="btn btn-secondary text-white">Retourner à l'accueil</button>
</div>