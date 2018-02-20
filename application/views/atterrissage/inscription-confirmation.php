<?php
if ($erreur) {
  $message = "<p>Une erreur s'est produite</p>";
} else {
  $message = "<h3>Bienvenu parmi nous !</h3><p>Nos membres doivent êtres validés avant de pouvoir utiliser la plateforme, vous recevrez un courriel lorsque ce sera fait</p>";
}
?>
<div class="d-flex- justify-content-end">
  <?=$message?>
  <a href="#" id="cancel" class="btn btn-secondary text-white">Retourner à l'accueil</a>
</div>