<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type='text/javascript' src="<?=base_url();?>js/appartement/script.js"></script>
<link rel="stylesheet" href="<?=base_url();?>css/appartement/stylesheet.css">

<div class="container">
  <div id='contentAppartement'>
    <div class='d-flex flex-wrap justify-content-end position'>
      <button class="btn btn-primary" id="ajouter">Ajouter</button>
      <button class="btn btn-info" id="validerLocation">Mes locations</button>
    </div>
    <?php foreach($appartement as $appart){?>
    <div class="detailAppart">
      <h5><?php echo $appart["titre"];?></h5>
      <?php echo $appart["Adresse"];?>
      <?php echo $appart["codePostal"];?>
      <p><?php echo $appart["description"];?></p>
      <div id="imageAfficher"></div>
        <script>
          window.addEventListener("load", function() {
          var id = <?php echo $appart['idAppart'];?>;
          $.ajax({
            url: "afficherPhoto",
            type: "POST",
            data :{"idAppart": +id},
            dataType:'json',
            success: function(photos) {
              for(photo in photos) {
                $("#imageAfficher").append("<img src='photo[\"Chemin\"]' height='42' width='42'> photo[\"detailPhoto\"]");
              }
            }
            });
          });
        </script>
        
      <div class="row">
    <!--      <p><a href="#" value="<?php //echo $appart['idAppart'];?>" id="idAppart" data-toggle="modal" data-target="#myModal2">Mettre en location</a></p><br>-->
          <button class="btn btn-success" value="<?php echo $appart['idAppart'];?>" id="idAppart" data-toggle="modal" data-target="#myModal2">Disponibilités</button>
          
      </div>
    </div>
    <?php } ?>
  </div>
<!--  modal ajout disponibilite-->
  <div class="formulaireAlouer modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter une disponibilité</h5>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"> 
          <div class="form-group row">
            <label class="col-sm-4" for="dDebut">Date début:</label>
            <input type="date" class="col-sm-6 champ" id="dDebut"/>
            <div class="echec"></div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4" for="dFin">Date fin:</label>
            <input type="date" class="col-sm-6 champ" id="dFin"/>
            <div class="echec"></div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4" for="prix">Tarif journalier:</label>
            <input type="text" class="col-sm-6 champ" id="prix"/>
            <div class="echec"></div>
          </div>
          <div class="form-group row">
            <label class="col-4">Interval accepté</label>
            <div class="col-6">
              <input type="radio" name="interval" id="interval-0" class="interval" checked="checked" ><label for="interval-0">Oui</label>
              <input type="radio" name="interval" id="interval-1" class="interval"><label for="interval-1">Non</label>
              <div class="echec"></div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-4">Disponibilités</label>
            <div class="col-6" id='dateDispo'></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-info" data-dismiss="modal" id="mettreEnLocation">Mettre en location</button>
          </div>
        </form>
      </div>      
      </div>      
    </div>
  </div>
</div>