<h2 class="titreLocation">Liste des locations</h2>
<?php if(!$locations){?>
  <p class="aucuneLocation">Vous n'avez aucune location pour cet appartement</p>
<?php } else {?>
<?php foreach($locations as $location){?>
  <div class="detailAppart">
    <div class="detailLog row">
      <div class="descriptionAppart col-md-6">
        <h5 class="titre">Locataire : <?php echo $location->Locataire;?></h5>
        <p>Date de la demande : <?php echo $location->DateDemandeLocation;?></p>
        <p>Location du : <?php echo $location->DateDebutLocation;?> au <?php echo $location->DateFinLocation;?></p>
        <p>Prix de location : <?php echo $location->MontantPaye;?>$</p>
        <p>Adresse : <?php echo $location->Adresse;?> <?php echo $location->codePostal;?></p>
        
      </div>
      <div id="slider">
        <figure>
        <?php foreach($photos as $photo){?>
          <?php if($photo->idAppart==$location->idAppart){?>
            <?php $chemin=$photo->Chemin;?>
            <img src='<?=base_url() . $chemin?>' alt>
            <div class="detaiPhoto" ><?php echo $photo->detailPhoto;?></div>
          <?php } ?>
        <?php } ?>
        </figure>
      </div>
    </div>
    <?php if($location->estValide==1){?>
      <p class="locationValide">Validé <i class="fa fa-check-circle" style="color:green"></i></p>
    <?php } else {?>
    <div class="row btnValider">
      <p class="locationNonValide"><i class="fas fa-times"></i> Non validée</p>
      <button class="btn btn-success" id="validerDemandeLocation" value="<?php echo $location->idAppart;?>">Valider</button>
    </div>
    <?php } ?>
  </div>
<?php } }?>
<div class="">
  <button id="retourAppart" class="btn btn-secondary">Retour à mes appartements</button>      
</div>