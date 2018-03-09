<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/accueil/stylesheet.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/accueil/fonts/font/flaticon.css">
<script type='text/javascript' src="<?=base_url();?>js/accueil/liste-appartements.js"></script>

<!--source https://bootsnipp.com/snippets/aMnXx-->
<script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script>
<script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
<link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
<link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
<link rel="canonical" href="https://codepen.io/linux/pen/QgMoQa?limit=all&page=5&q=box" />

<div class="container-fluid ml-0 mr-0 pl-0 pr-0 " id="detailAppartTrouve">
<!-- debut du menu de recherche -->
<div class="container-fluid col-12 ml-0 mr-0 pl-0 pr-0">
  <div class="row col-12 ml-0 mr-0 pl-0 pr-0 ">
		<!-- ceci est le menu de recherche-->
    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 col-xs-3 col-centered formulaireRecherche ml-0 pl-2 pr-2"  style=" background-color:#2C3E50;">
      <p class="text-center">RECHERCHER</p>
        <section id="chercherAppartement-form">
          <div class="form-group ml-0 mr-0  mt-0 mb-1" data-toggle="tooltip" data-placement="top" title="l'arrondissement ou se trouve l'appartement">       
            <select id="idArrondissement" class="form-control champ col-sm mt-0 mb-0">
							<option value="" selected>Tous les Arrondissements</option>
							<?php foreach($arrondissement as $arrond){?>
							<option value="<?=$arrond->idArrondissement;?>"><?=$arrond->nomArrondissement;?></option>
							<?php } ?>
            </select>
          </div>
          <div class="form-group ml-0 mr-0 mb-0"> 
						 <input class="form-control col-sm  mt-0 mb-1 champ" placeholder="Date de début" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')"  id="dateDebut" data-toggle="tooltip" data-placement="bottom" title="date de début de location">     <input class="form-control col-sm  mt-0 mb-1 champ" placeholder="Date de fin" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" id="dateFin" data-toggle="tooltip" data-placement="bottom" title="date de fin de location"> 
          </div>
          <div class="form-group ml-0 mr-0 mb-0"> 
            <input type="number" class="form-control champ  col-sm  mt-0 mb-1" id="nbrAdulte" placeholder="Adultes" data-toggle="tooltip" data-placement="top" title="nombre de personnes adultes"/> 
            <input type="number" class="form-control champ  col-sm  mt-0 mb-1" id="nbrEnfant" placeholder="Enfants" data-toggle="tooltip" data-placement="top" title="nombre de personnes enfants" /> 
          </div>
          
					<div class="downup form-group row col-sm  mt-2 mb-2 ml-0 mr-0 d-flex justify-content-center" data-toggle="tooltip" data-placement="top" title="cliquer ici pour plus d'options de recherche">
						 <span class=" mb-0 text-center rech" data-toggle="collapse" data-target="#promesse" id="RechAv">Recherche avancée&nbsp;</span>
						 <i class="fas fa-angle-double-down mt-1 rech" data-toggle="collapse" data-target="#promesse" id="RechAvi"></i>
					</div>
          <div id="promesse" class="collapse">
                  <div class="form-group row ml-0 mr-0 mb-0">
                    <select id="codePostal" class="form-control champ col-sm-6  mt-0 mb-1" data-toggle="tooltip" data-placement="top" title="choisissez la localisation de l'appartement par code postal">
                      <option value="" selected>Code postal</option>
                      <?php foreach($codePosteaux as $codePostal){?>
                      <option value="<?php echo $codePostal["codePostal"];?>"><?php echo $codePostal["codePostal"];?></option>
                      <?php } ?>
                    </select>
										<input type="number" class="form-control champ  col-sm-6  mt-0 mb-1" id="numEtage" placeholder="N°étage" min=0 data-toggle="tooltip" data-placement="top" title="numéro d'étage de l'appartement" /> 
                  </div>
                  <div class="form-group row ml-0 mr-0 mb-0">       
                    <select id="typeLogement" class="form-control champ col-sm-6  mt-0 mb-1" data-toggle="tooltip" data-placement="top" title="choisissez le type de logement">
                      <option value="" selected>Type</option>
                      <option value="Condominium">Condominium</option>
                      <option value="Appartement">Appartement</option>
                      <option value="Maison">Maison</option>
                      <option value="Chalet">Chalet</option>    
                    </select>
										<input type="number" class="form-control champ  col-sm-6  mt-0 mb-1" id="nbreStatio" placeholder="stationnement" min=0 max=10 data-toggle="tooltip" data-placement="top" title="Nombre de place de stationnement"/>
                  </div>
							<!--bloc des options disponibles dans l'appartement-->
									<div class="form-group row ml-0 mr-0 mt-2 mb-1 d-flex justify-content-around">
											<div >
												<input type="checkbox" class="control-input rech champ" id="internet" value="1"/>
												<label class="control-label rech" for="internet"><i class="fas fa-wifi fa-lg" data-toggle="tooltip" data-placement="top" title="internet wifi"></i></label>
											</div>
											<div>
												<input type="checkbox" class="control-input rech champ" id="television" value="1"/>
												<label class="control-label rech" for="television"><i class="fas fa-tv fa-lg" data-toggle="tooltip" data-placement="top" title="télévision"></i></label>
											</div>
											<div>
												<input type="checkbox" class="control-input rech champ" id="climatiseur" value="1"/>
												<label class="control-label rech" for="climatiseur"><i class="fas fa-snowflake fa-lg" data-toggle="tooltip" data-placement="top" title="climatisation"></i></label>											
											</div>
											<div>
												<input type="checkbox" class="control-input rech champ" id="adapte" value="1"/>
												<label class="control-label rech" for="adapte"><i class="fas fa-wheelchair fa-lg" data-toggle="tooltip" data-placement="top" title="adapté pour personne en mobilité réduite"></i></label>
											</div>
									</div>
									<div class="form-group row ml-0 mr-0 mt-1 mb-0 d-flex justify-content-around">
											<div>
												<input type="checkbox" class="control-input rech champ" id="meuble" value="1"/>
												<label class="control-label rech" for="meuble"><i class="flaticon-bed" data-toggle="tooltip" data-placement="top" title="meublé"></i></label>
											</div>
											<div>
												<input type="checkbox" class="control-input rech champ" id="lavSech" value="1"/>
												<label class="control-label rech" for="lavSech"><i class="flaticon-washing-machine" data-toggle="tooltip" data-placement="top" title="laveuse sécheuse"></i></label>
											</div>
											<div>
												<input type="checkbox" class="control-input rech champ" id="lavVaiss" value="1"/>
												<label class="control-label rech" for="lavVaiss"><i class="flaticon-dish" data-toggle="tooltip" data-placement="top" title="lave vaisselle"></i></label>											
											</div>
											<div>
												<input type="checkbox" class="control-input rech champ" id="intervAcc" value="1"/>
												<label class="control-label rech" for="intervAcc"><i class="flaticon-deadline" data-toggle="tooltip" data-placement="top" title="dates fixes"></i></label>
											</div>
									</div>
									<div class="form-group row ml-0 mr-0 mb-0">
                    <input type="number" class="form-control champ  col-sm-6  mt-0 mb-1" id="prixMin" placeholder="min" min=0 data-toggle="tooltip" data-placement="top" title="prix minimum de location par jour" /> 
										<input type="number" class="form-control champ  col-sm-6  mt-0 mb-1" id="prixMax" placeholder="max" min=0 data-toggle="tooltip" data-placement="top" title="prix maximum de location par jour" /> 
                  </div>
						</div> <!-- fin de collapse -->
						<button id="chercherAppartement" class="btn-primary btn-block chercher">CHERCHER</button>    
        </section>
    </div>
		
		<!--affichage des appartements en vedette-->
		
			<div class="imgcontainer container">
				<h2 class="deux">Locations en vedette</h2>
			<?php foreach($appartementsVedettes as $appartementVedette){?>
				<button id="details" value="<?=$appartementVedette->idAppart?>" class="bg-white border-0">
				<div class="item tm1 text-center align-middle">
					<img class="imag" src="<?=base_url().$appartementVedette->Chemin;?>" alt="appartement en vedette">
					<p ><?=preg_replace('/[^a-zA-ZáàâäãéèêëíìîïóòôöõúùûüýÿÁÀÂÄÃÉÈÊËÍÌÎÏÓÒÔÖÕÚÙÛÜÝ]/', ' ', word_limiter($appartementVedette->titre, 3));?><br>
					<span>
					<?php for ($i=1;$i<=$appartementVedette->moyenneNote;$i++){?>
					<i class="fas fa-star" style="color:yellow"></i>
					<?php }?></span></p>
				</div>
				</button>
			<?php } ?>				
			</div>
		
		<div class=" imgcontainer container mt-4 dataAppartTrouvePos" id="dataAppartTrouve">
			<!-- début d'affichage des données des appartements -->
    
       
<!--</div> 
</div>-->