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
            
   //soumettre les informations d'ajout d'appartement au controlleur
  $(document).on("click", "button#chercherAppartement", function(evt) {
  validerFormulaireRecherche($(this).parents("#chercherAppartement-form"));
  });
});


//fonction de validation formulaire d'ajout d'une annonce
function validerFormulaireRecherche(formulaire){
  var valide = true;
  console.log("validation");

  //Ajoute le message d'erreur si un champ est vide
  formulaire.children("div").each(function() {
    var valeur = $(this).find(".champ");
     {
      //vérifier le code postal au format H1H 1H1 ;
      if (valeur.attr('id')=="dateDebut") {
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
			if (valeur.attr('id')=="dateFin") {
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
  });

	
	
  if(valide){
    $.ajax({
      url: "index",
      type: "POST",
      data: {
				"arrondissement":$("#arrondissement").val(),
				"dateDebut":$("#dateDebut").val(),
				"dateFin":$("#dateFin").val(),
				"nbrAdulte":$("#nbrAdulte").val(),
				"nbrEnfant":$("#nbrEnfant").val(),
				"codePostal":$("#codePostal").val(),
				"numEtage":$("#numEtage").val(),
				"typeLogement":$("#typeLogement").val(),
				"nbreStatio":$("#nbreStatio").val(),
				"internet":$("#internet").val(),
				"television":$("#television").val(),
				"climatiseur":$("#climatiseur").val(),
				"adapte":$("#adapte").val(),
				"meuble":$("#meuble").val(),
				"lavSech":$("#lavSech").val(),
				"lavVaiss":$("#lavVaiss").val(),
				"intervAcc":$("#intervAcc").val(),
				"prixMin":$("#prixMin").val(),
				"prixMax":$("#prixMax").val()
				
      }
      success: function(reponse) {
        $("#dataAppartTrouve").empty();
        $("#dataAppartTrouve").append(reponse);
      }
    });
  } 
}
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
