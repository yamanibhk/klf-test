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
        <div class="detailLog">
          <div class="descriptionAppart">
            <h5 class="titre"><?php echo $appart->titre;?></h5>
            <p class="adresse"><?php echo $appart->Adresse;?> <?php echo $appart->codePostal;?></p>
            
            <p><?php echo $appart->description;?></p>
          </div>
          <div id="slider">
            <figure>
            <?php foreach($photos as $photo){?>
              <?php if($photo->idAppart==$appart->idAppart){?>

                <?php $chemin=$photo->Chemin;?>
                
                <img src='<?=base_url() . $chemin?>' alt>
                <div class="detaiPhoto" ><?php echo $photo->detailPhoto;?></div>

              <?php } ?>
            <?php } ?>
            </figure>
          </div>
        </div>
          <?php $i = 0; $sommeNote=0; ?>
          <?php foreach($notes as $note){?>
            <?php if($note->idAppart==$appart->idAppart){?>
              <?php $sommeNote = $sommeNote + $note->Note;?>
              <?php $i = $i + 1; ?>
            <?php } ?>
          <?php } ?>
          <?php if($i==0){ $i=1; }?>
          <?php $noteFinale = $sommeNote/$i;?>
          <div class="etoile">  
            <?php for ($j=1;$j<=$noteFinale;$j++){?>
              <i class="fas fa-star" style="color:yellow"></i>
            <?php }?>
          </div>

        <div class="row afficheDispo">
          <button class="btn btn-success " value="<?php echo $appart->idAppart;?>" id="idAppart" data-toggle="modal" data-target="#myModal2">Disponibilités</button>
          <button class="btn btn-warning" value="<?php echo $appart->idAppart;?>" id="modifierAppart">Modifier</button>
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
              <input type="radio" name="interval" id="interval-0" class="interval" checked="checked" value="1"><label for="interval-0">Oui</label>
              <input type="radio" name="interval" id="interval-1" class="interval"><label for="interval-1" value="0">Non</label>
              <div class="echec"></div>
            </div>
          </div>
          <div class="col-12">
            <button type="button" class="btn btn-warning dispo" data-toggle="collapse" data-target="#dateDispo">Disponibilités affichées</button>
            <div id="dateDispo" class="collapse">
            </div>
          </div>
          <div class="col-12">
            <button type="button" class="btn btn-info louer" data-toggle="collapse" data-target="#demo">Toutes les locations </button>
            <div id="demo" class="collapse">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="mettreEnLocation">Mettre en location</button>
          </div>
        </form>
      </div>      
      </div>      
    </div>
  </div>
</div>