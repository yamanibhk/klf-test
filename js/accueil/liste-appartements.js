window.addEventListener("load", function() {
$(document).on("click", "#RechAv", function(evt) {
	 if ($("#RechAvi").hasClass("fa-angle-double-down" ))	{
		 	 $("#RechAvi").removeClass('fa-angle-double-down');
			 $("#RechAvi").addClass('fa-angle-double-up');
	 }
	 else{
		 	 $("#RechAvi").removeClass('fa-angle-double-up');
			 $("#RechAvi").addClass('fa-angle-double-down');
	 }
  }); 
	 
 $(document).on("click", "#RechAvi", function(evt) {
	 if ($("#RechAvi").hasClass("fa-angle-double-down" ))	{
		 	 $(this).removeClass('fa-angle-double-down');
			 $(this).addClass('fa-angle-double-up');
	 }
	 else{
		 	 $(this).removeClass('fa-angle-double-up');
			 $(this).addClass('fa-angle-double-down');
	 }
  });   
            
   //soumettre les informations de recherche d'appartement au controlleur
  $(document).on("click", "button#chercherAppartement", function(evt) {
  validerFormulaireRecherche($(this).parents("#chercherAppartement-form"));
  });
  
  //partie pour afficher la page détaillée d'une location
  $(document).on("click", "button#details", function(evt) {
    $.ajax({
		url: "AppartTrouve",
		type: "POST",
		data: {"idAppart":$(this).val()},
		success: function(reponse) {	
			$("#detailAppartTrouve").empty();
			$("#detailAppartTrouve").append(reponse);
		
		}
    })
  });
  
  
    //partie pour ajouter une demande de location dans la base de donnée
  $(document).on("click", "button#reserverAppart", function(evt) {
    validerFormulaireDemandeLocation($(this).parents("#divAjout"));
  });
  
  
});

//fonction de validation formulaire de recherche d'appartement
function validerFormulaireRecherche(formulaire){
  var valide = true;
  

  //Ajoute le message d'erreur si un champ est vide
  formulaire.children("div").each(function() {
    var valeur = $(this).find(".champ");
     
      //vérifier le code postal au format H1H 1H1 ;
    if (valeur.attr('id')=="dateDebut") {
		if (valeur.val()!="") {
			var valide = true;
			var dateDebut = $("#dateDebut").val();
			var Exp=new RegExp(/^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[\/]\d{4}$/);
			var dd = Exp.test(dateDebut);
			if(dd==false) {
			  $("#dateDebut").val('');
			  valide = false;
			} else {
						if (ValidDate(dateDebut)) valide = true; else valide=false;
			}
		}
	
    } 
	if (valeur.attr('id')=="dateFin") {
		if (valeur.val()!=""){
			var valide = true;
			var dateFin = $("#dateFin").val();
			var Exp=new RegExp(/^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[\/]\d{4}$/);
			var df = Exp.test(dateFin);
			if(df==false) {
			  $("#dateFin").val('');
			  valide = false;
			} else {
			  if (ValidDate(dateFin)) valide = true; else valide=false;
			}
		}
    } 
    
  })
if (valide){
    $.ajax({
      url: "listeAppartTrouve",
      type: "POST",
      data: {
				"idArrondissement":$("#idArrondissement").val(),
				"dateDebut":$("#dateDebut").val(),
				"dateFin":$("#dateFin").val(),
				"nbrAdulte":$("#nbrAdulte").val(),
				"nbrEnfant":$("#nbrEnfant").val(),
				"codePostal":$("#codePostal").val(),
				"numEtage":$("#numEtage").val(),
				"typeLogement":$("#typeLogement").val(),
				"nbreStatio":$("#nbreStatio").val(),
				"internet":$('input[id="internet"]:checked').val(),
				"television":$('input[id="television"]:checked').val(),
				"climatiseur":$('input[id="climatiseur"]:checked').val(),
				"adapte":$('input[id="adapte"]:checked').val(),
				"meuble":$('input[id="meuble"]:checked').val(),
				"lavSech":$('input[id="lavSech"]:checked').val(),
				"lavVaiss":$('input[id="lavVaiss"]:checked').val(),
				"intervAcc":$('input[id="intervAcc"]:checked').val(),
				"prixMin":$('input[id="prixMin"]').val(),
				"prixMax":$('input[id="prixMax"]').val()
      },
      success: function(reponse) {
				
        $("#dataAppartTrouve").empty();
        $("#dataAppartTrouve").append(reponse);
		
		}
      })
    }
  
}


//fonction de validation formulaire de demande de location
function validerFormulaireDemandeLocation(formulaire){
  var valide = true;
  
/*
  //Ajouter le message d'erreur si un champ est vide
  formulaire.children("div").each(function() {
    var valeur = $(this).find(".champdate");
     
      //vérifier le code postal au format H1H 1H1 ;
    if (valeur.attr('id')=="dateDebutDemande") {
		if (valeur.val()!="") {
			var valide = true;
			var dateDebut = $("#dateDebutDemande").val();
			var Exp=new RegExp(/^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[\/]\d{4}$/);
			var dd = Exp.test(dateDebut);
			if(dd==false) {
			  $("#dateDebutDemande").val('');
			  valide = false;
			} else {
						if (ValidDate(dateDebutDemande)) valide = true; else valide=false;
			}
		}
	
    } 
	if (valeur.attr('id')=="dateFinDemande") {
		if (valeur.val()!=""){
			var valide = true;
			var dateFin = $("#dateFinDemande").val();
			var Exp=new RegExp(/^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[\/]\d{4}$/);
			var df = Exp.test(dateFin);
			if(df==false) {
			  $("#dateFinDemande").val('');
			  valide = false;
			} else {
			  if (ValidDate(dateFin)) valide = true; else valide=false;
			}
		}
    } 
    
  })*/
  console.log(valide);
if (valide){
	
    $.ajax({
      url: "enregistrerDemande",
      type: "POST",
      data: {
				"dateDebutLocation":$("#dateDebutDemande").val(),
				"dateFinLocation":$("#dateFinDemande").val(),
				"idAppart":$("#reserverAppart").val()
      },
	  
      success: function(reponse) {
				
        $("#dataAppartTrouve").empty();
        $("#dataAppartTrouve").append(reponse);
		
		
		}
      })
    }
  
}

/*valider pour etre juste selon année 365 ou 364*/
function ValidDate(day) {
  var bitsDays = day.split('-');
  var yDays = bitsDays[2], 
  mDays  = bitsDays[1],
  dDays = bitsDays[0];
  var daysInMonth = [31,28,31,30,31,30,31,31,30,31,30,31];
  if (yDays % 400 === 0 || (yDays % 100 !== 0 && yDays % 4 === 0)) {
    daysInMonth[1] = 29;
  }
  return dDays <= daysInMonth[--mDays];
}
