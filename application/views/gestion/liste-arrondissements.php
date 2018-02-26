<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="p-3 p-md-4 p-lg-5">
  <div class="row">
    <section class="container">
      <ul class="list-group">
      <?php
      foreach ($arrondissements as $arrondissement) {
        ?>
        <li class='list-group-item' id='arrondissement_<?=$arrondissement['idArrondissement']?>'><?=$arrondissement['nomArrondissement']?></li>
        <?php
      };
      ?>
      </ul>
    </section>
  </div>
</div>