
    <div class="row pl-4 pr-4 mr-0 ml-0">
				
        <div  class="col-lg-9 col-md-9 mb-4">
           <div id="carouselimages" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<?php  for ($t=0;$t<count($PhotosAppartement);$t++){ 
							if ($t<1) echo '<li data-target="#carouselimages" data-slide-to="0" class="active"></li>';
							else echo '<li data-target="#carouselimages" data-slide-to="'.$t.'"></li>';
							}
							?>
							</ol>
							<div class="carousel-inner">
								<?php  $cont=1;foreach($PhotosAppartement as $PhotoAppartement) { 
								if ($cont==1) echo'<div class="carousel-item active">';
								else echo'<div class="carousel-item">';
								
								?>
								<img class="d-block w-100" src="<?=base_url().$PhotoAppartement->Chemin;?>">
								<div class="carousel-caption d-none d-md-block">
									<h5 class="text-center"><?=$PhotoAppartement->detailPhoto?></h5>
								</div>
							</div>
							<?php $cont++;} ?>
							</div>
							<a class="carousel-control-prev" href="#carouselimages" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Précédent</span>
							</a>
							<a class="carousel-control-next" href="#carouselimages" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Suivant</span>
							</a>
					</div>
			
					<div id="details">
						<?php foreach($DetailsAppartement as $DetailAppartement) { ?>
						<h2 class="mt-3"><?=$DetailAppartement->titre ?></h2>
						<hr class="hr-primary" />
						<h2 class="mt-2">A propos de la location:</h2>
						<p class="text-justify"><?=$DetailAppartement->description ?></p>
						<hr class="hr-primary" />
						<h2 class="mt-2">Adresse:</h2>
						<p class="text-center"><?=$DetailAppartement->Adresse.", ".$DetailAppartement->codePostal ?></p>
						<hr class="hr-primary" />
						<h2 class="mt-2">Détails:</h2>
						<p class="text-center">Type de logement:<?=$DetailAppartement->typeLogement?></p>
						<p class="text-center">N° d'étage:<?=$DetailAppartement->numEtage?></p>
						<p class="text-center">Nombre de piece:<?=$DetailAppartement->nbrePiece?></p>
						<hr class="hr-primary" />
						<h2 class="mt-2">Equipement:</h2>
						<p class="text-center"><i class="fas fa-wifi fa-lg" data-toggle="tooltip" data-placement="top" title="internet wifi"></i><?php if ($DetailAppartement->Internet=="1") echo "  Oui"; else echo "  Non" ;?></p>
						<p class="text-center"><i class="fas fa-tv fa-lg" data-toggle="tooltip" data-placement="top" title="television"></i><?php if ($DetailAppartement->Television=="1") echo "  Oui"; else echo "  Non" ;?></p>
						<p class="text-center"><i class="fas fa-snowflake fa-lg" data-toggle="tooltip" data-placement="top" title="climatisation"></i><?php if ($DetailAppartement->Climatiseur=="1") echo "  Oui"; else echo "  Non" ;?></p>
						<p class="text-center"><i class="fas fa-wheelchair fa-lg" data-toggle="tooltip" data-placement="top" title="adapté pour personne en mobilité réduite"></i><?php if ($DetailAppartement->Adapte=="1") echo "  Oui"; else echo "  Non" ;?></p>
						<p class="text-center"><i class="flaticon-bed" data-toggle="tooltip" data-placement="top" title="meublé"></i><?php if ($DetailAppartement->Meuble=="1") echo "  Oui"; else echo "  Non" ;?></p>
						<p class="text-center"><i class="flaticon-washing-machine" data-toggle="tooltip" data-placement="top" title="laveuse sécheuse"></i><?php if ($DetailAppartement->LaveuseSecheuse=="1") echo "  Oui"; else echo "  Non" ;?></p>
						<p class="text-center"><i class="flaticon-dish" data-toggle="tooltip" data-placement="top" title="lave vaisselle"></i><?php if ($DetailAppartement->LaveVaisselle=="1") echo "  Oui"; else echo "  Non" ;?></p>
						
						<?php } ?>
					</div>
           
        </div>
				
				<div  class=" panneau col-lg-3 col-md-3 bg-white border border-secondary">
					<div class="text-center mt-1" id="divAjout">	
						<span class="text-primary h2 gras" id="prixMoy"><?php foreach($prixMoyen as $lePrixMoyen) echo $lePrixMoyen->PrixMoyen;?></span><span class="text-primary h2 gras">$</span>
						<span class="h6"> moyenne/nuit</span>
						<!--modal dates disponibles-->
						<button type="button" class="btn btn-outline-primary mt-2 mb-2" data-toggle="modal" data-target="#Modaldates">Dates disponibles</button>
								<div class="modal fade" id="Modaldates" tabindex="-1" role="dialog" aria-labelledby="dates disponibles" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header bg-light">
												<h5 class="modal-title " id="exampleModalLabel">Dates disponibes pour la location</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
											<?php foreach($DisponAppartement as $dateDisponAppartement) echo "<p>Du: ".$dateDisponAppartement->dateDebutDispo." au: ".$dateDisponAppartement->dateFinDispo."</p>";?> 
											</div>

										</div>
									</div>
								</div>
						<div class="form-group ml-0 mr-0 mb-0"> 
						 <input class="form-control col-sm  mt-0 mb-1 champdate" placeholder="Date d'arrivée" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')"  id="dateDebutDemande" data-toggle="tooltip" data-placement="bottom" title="date de début de location">   
							<input class="form-control col-sm  mt-0 mb-1 champdate" placeholder="Date de départ" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" id="dateFinDemande" data-toggle="tooltip" data-placement="bottom" title="date de fin de location"> 
          	</div>
						<button type="button" class="btn btn-success mt-4 mb-2 btn-xl" id="reserverAppart" value="<?=$PhotoAppartement->idAppart?>">Réserver</button>
					</div>
        </div>
    </div>
