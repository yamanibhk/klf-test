<h4 class="titreLocation">Liste des locations</h4>
<?php foreach($locations as $location){?>
  <div class="detailAppart">
    <h5>Locataire : <?php echo $location["Locataire"];?></h5>
    <p>Date de la demande : <?php echo $location["DateDemandeLocation"];?></p>
    <p>Location du : <?php echo $location["DateDebutLocation"];?> au <?php echo $location["DateFinLocation"];?></p>
    <p>Prix de location : <?php echo $location["MontantPaye"];?>$</p>
    <p>Adresse : <?php echo $location["Adresse"];?> <?php echo $location["codePostal"];?></p>
    <?php if($location["estValide"]==1){?>
      <p class="locationValide"><i class="fas fa-check"></i> Validée</p>
    <?php } else {?>
    <div class="row btnValider">
      <p class="locationNonValide"><i class="fas fa-times"></i> Non validée</p>
      <button class="btn btn-success" id="validerDemandeLocation" value="<?php echo $location['idAppart'];?>">Valider</button>
    </div>
    <?php } ?>
  </div>
<?php } ?>