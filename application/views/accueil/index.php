<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type='text/javascript' src="<?=base_url();?>js/accueil/script.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/accueil/stylesheet.css">
<div class="container-fluid col-12 ml-0 mr-0 pl-0 pr-0">
    <div class="row col-12 ml-0 mr-0 pl-0 pr-0 bg-light">
        <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3 col-centered formulaireRecherche ml-0 mr-0 mt-4 pl-2 pr-2  " style=" background-color: #2C3E50;">
            <h4>RECHERCHER</h4>
            <section id="chercherAppartement-form">
              <div class="form-group">       
                <select id="arrondissement" class="form-control champ select-sm" placeholder="arrondissement">
                        <option value="" selected disabled>Arrondissement</option>
                        <?php foreach($arrondissement as $arrond){?>
                        <option value="<?php echo $arrond["idArrondissement"];?>"><?php echo $arrond["nomArrondissement"];?></option>
                        <?php } ?>
                </select>
              </div>
              <div class="form-group row pl-3 pr-3"> 
                  <input class="form-control col-sm-6 " placeholder="Date de début" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')"  id="dateDebut" >                     
                  <input class="form-control col-sm-6 " placeholder="Date de fin" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" id="dateFin" > 
              </div>
              <div class="form-group row pl-3 pr-3"> 
                  <input type="text" class="form-control champ  col-sm-6" id="nbrAdulte" placeholder="Adultes" /> 
                  <input type="text" class="form-control champ  col-sm-6" id="nbrEnfant" placeholder="Enfants" /> 
              </div>
                <button id="enregistrerAppartement" class="btn-primary btn-lg btn-block chercher">CHERCHER</button>
                <h5 class="text-center mt-3 mb-3">Recherche avancée <i class="fas fa-caret-down"></i></h5>
            </section>
        </div>
        <div class="col-sm-9  ml-0 mr-0 mt-4 pl-8 pr-8 container-fluid">
            <div class="bg-white ml-0 mr-0 pl-2 pr-2">
                <?php foreach($appartementsVedettes as $appartementVedette){?>
                <li><?php echo $appartementVedette["Adresse"];?></li>
            <?php } ?></div>        
        </div>
    </div>
</div>
