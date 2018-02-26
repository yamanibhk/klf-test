<?php
if ($erreur) {
  $message = "<p>Une erreur s'est produite</p>";
} else {
  $message = "<p>Votre annonce a bien été ajouté</p>";
}
?>
<div class="d-flex- justify-content-end">
  <?=$message?>
  <a href="#" id="cancel" class="btn btn-secondary text-white">Retourner à l'accueil</a>
</div>