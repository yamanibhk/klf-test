
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