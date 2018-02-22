<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type='text/javascript' src="<?=base_url();?>js/accueil/script.js"></script>
<div class="container col-12 ml-0 mr-0 pl-0 pr-0">
    <div class="row col-12 ml-0 mr-0 pl-0 pr-0 bg-light">
        <div class="col-sm-3 formulaireRecherche ml-0 mr-0 mt-4 pl-2 pr-2 rounded-right " style=" background-color: #2C3E50;">
          
            <h4>RECHERCHER</h4>
            <section id="chercherAppartement-form">
              <div class="form-group">       
                
                <select id="arrondissement" class="form-control champ select-sm" placeholder="arrondissement">
                        <option value="" selected disabled>arrondissement</option>
                        <?php foreach($arrondissement as $arrond){?>

                        <option value="<?php echo $arrond["idArrondissement"];?>"><?php echo $arrond["nomArrondissement"];?></option>

                        <?php } ?>
                    </select>
                   
              </div>
              <div class="form-group">       
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              </div>
              <div class="form-group">       
                
                <input type="text" class="form-control champ input-lg" id="adresse" placeholder="adresse">
              </div>
              
              <div class="d-flex flex-wrap justify-content-end">
                <button id="enregistrerAppartement" class="btn btn-primary">Enregistrer</button>      
              </div>
            </section>
                    
        
        </div>
        <div class="col-sm-9  ml-0 mr-0 mt-4 pl-8 pr-8">
            <div class="bg-white ml-0 mr-0 pl-2 pr-2">
                <?php foreach($appartementsVedettes as $appartementVedette){?>
                <li><?php echo $appartementVedette["Adresse"];?></li>

            <?php } ?></div>
        
        
        </div>
    </div>
</div>
