<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type='text/javascript' src="<?=base_url();?>js/appartement/script.js"></script>

<div class="container">
  <div id='contentAppartement'>
    <div class='position'>
      <button class="btn btn-primary" id="ajouter">Ajouter</button>
    </div>
    <ul>
    <?php foreach($appartement as $appart){?>
      <li><?php echo $appart["Adresse"];?></li>
    <?php } ?>
    </ul>
  </div>
</div>