<?php
if ($erreur) {
  $message = "<p>Une erreur s'est produite</p>";
} else {
  $message = "<h3>Bienvenu parmis nous !</h3><p>Nos membres doivent êtres validés avant de pouvoir utiliser la plateforme, vous recevrez un courriel lorsque ce sera fait</p>";
}
?>
<div>
  <?=$message?>
  <a href="#" id="cancel" class="d-block py-2 px-3 text-white">Retourner à l'accueil</a>
</div>