<?php
if ($erreur) {
  $message = "<p class='ajoutEchec'>Une erreur s'est produite</p>";
} else {
  $message = "<p class='ajoutSucces'>Votre annonce a bien été ajouté</p>";
}
if($existe){
	 $message = "<p class='ajoutEchec'>Votre appartement est déja en location</p>";
}
?>
<div class="d-flex- justify-content-end">
  <?=$message?>
  <!-- <a href="#" id="cancel" class="btn btn-secondary text-white">Retourner à l'accueil</a> -->
</div>