				
			<!-- début d'affichage des données des appartements -->	
			<!--MDB Cards-->
          <?php if (count($lesappartements)>0) echo"<h2 class='deux'>Locations disponibles</h2>";
					      else echo"<h2 class='deux'>Aucune Location trouvée</h2>";
					?>
            <!-- ligne de resultats responsive -->
            <div class="row" >
            	<?php 
							if (count($lesappartements)>2) $balise= "<div class='col-lg-4 col-md-6 mb-4'>";
								else if (count($lesappartements)<=2) $balise="<div class='col-lg-6 col-md-6 mb-6'>";
							  
					 		foreach($lesappartements as $appartement) {
								echo $balise;
								?>
                <!-- un resultat affiché sous forme de card -->
                    <div class="card">
											<div class="card-header">
												<!--titre de la location-->
												<h4 class="card-title align-middle mb-0"><?=preg_replace('/[^a-zA-ZáàâäãéèêëíìîïóòôöõúùûüýÿÁÀÂÄÃÉÈÊËÍÌÎÏÓÒÔÖÕÚÙÛÜÝ]/', ' ', word_limiter($appartement->titre, 5));?></h4>
											</div>
                        <!--image de la location -->
											<div class="view overlay hm-white-slight rotzoom">
												<img src="<?=base_url().$appartement->Chemin;?>" class="photoApart" alt="photo de la location">				
													<a href="#!">
															<div class="mask"></div>
													</a>
											</div>
                        <!--détails de la location-->
											<div class="card-body">
													<p class="card-text text-justify"><?=word_limiter($appartement->description, 12)?></p>
													<p class="card-text text-left"><i class="flaticon-mail text-primary"></i><?=' '.$appartement->Adresse.', '.$appartement->codePostal?></p>
													<p class="card-text  d-flex justify-content-around"><?php 
														switch ($appartement->typeLogement) {
																case "Condominium":
																		echo'<i class="flaticon-office-block text-primary" data-toggle="tooltip" data-placement="top" title="Condominium"></i>';
																		break;
																case "Appartement":
																		echo'<i class="flaticon-building text-primary" data-toggle="tooltip" data-placement="top" title="Appartement"></i>';
																		break;
																case "Maison":
																		echo'<i class="flaticon-house text-primary" data-toggle="tooltip" data-placement="top" title="Maison"></i>';
																		break;
																case "Chalet":
																		echo'<i class="flaticon-chalet text-primary" data-toggle="tooltip" data-placement="top" title="Chalet"></i>';
																		break;
																
														}  ?>
													
														<span class="text-primary align-middle mt-1"><?=$appartement->nbrePiece?> Pieces</span>
														<a href="" data-toggle="modal" data-target="#ModalMap">
															<i class="fas fa-map-marker-alt text-primary fa-lg mt-1 map" data-toggle="tooltip" data-placement="top" title="localisation géographique"></i></a>
														<!-- Modal map-->
															<div class="modal fade" id="ModalMap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header bg-light">
																			<h5 class="modal-title " id="exampleModalLabel">Géolocalisation de la location</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																			</button>
																		</div>
																		<div class="modal-body">
																			
																		</div>
																		
																	</div>
																</div>
															</div>
														
												</p>
													<a class="trois btn-sm">Détails</a>
												
											</div>
											<div class="card-footer d-flex justify-content-between">
												<div>
													<span class="text-primary h5"><?=$appartement->moyenneMontant?>$</span>
													<span class="h6"> moyenne/nuit</span>
												</div>
												<div class="mt-1">
													<?php for ($i=1;$i<=$appartement->moyenneNotes;$i++){?>
														<i class="fas fa-star mb-1" style="color:#ffba00;font-size:13px;"></i>
														<?php }
														if (is_float($appartement->moyenneNotes)) echo"<i class='fas fa-star-half mb-1' style='color:#ffba00;font-size:13px;'></i>";
													?>
												</div>
											</div>
                    </div>
                    <!--/.Card-->
                </div>
							<?php } ?>
                <!-- Grid column -->
         	</div>
			
        <!--MDB Cards-->