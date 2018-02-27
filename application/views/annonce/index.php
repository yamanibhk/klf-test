<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type='text/javascript' src="<?=base_url();?>js/appartement/script.js"></script>
<link rel="stylesheet" href="<?=base_url();?>css/appartement/stylesheet.css">

<div class="container">
  <?php foreach($annonces as $annonce){?>
    <?php echo $annonce["Adresse"];?> <?php echo $annonce["codePostal"];?></br>

  <?php } ?>
</div>