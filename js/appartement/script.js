window.addEventListener("load", function() {
  //Ceci va charger le formulaire d'ajout d'appartement
  $(document).on("click", "button#ajouter", function(evt) {
    $.ajax({
      url: "ajouter",
      type: "POST",
      success: function(data) {
        $("#contentAppartement").empty();
        $("#contentAppartement").append(data);
      }
    });
  });
  
  //soumettre les informations d'ajout d'appartement au controlleur
  $(document).on("click",'button#enregistrerAppartement',function() {
      validerFormulaireAjout($(this).parents("#inscrireAppartement-form"));
  });

  //soumettre les informations d'ajout d'appartement au controlleur
  $(document).on("click",'button#retourAppart',function() {
    $.ajax({
      url: "contenu_index",
      type: "POST",
      success: function(reponse) {
        $("#contentAppartement").empty();
        $("#contentAppartement").append(reponse);
      }
    });
  });

  
  //affichage des disponibilités pour un appartement choisi
  $(document).on("click", "button#idAppart", function(evt) {
    var id = $(this).attr('value');
    console.log(id);
    $.ajax({
      url: "dateDispo",
      type: "POST",
      data :{
        "idAppart":$(this).attr('value')
      },
      dateType:'json',
      success: function (data) {
        $("#dateDispo").empty();
        if(JSON.parse(data)==""){
          $("#dateDispo").html("<p class='echec'>Aucune disponibilitée ajoutée pour cet appartement</p>");
        } else {
          $.each(JSON.parse(data), function(i, obj) {
          $("#dateDispo").append(obj.dateDebutDispo + obj.dateFinDispo+"</br>");
          });
        }
        
       
      }
    });
  });

  //Affichage des location pour un appartement choisi
  $(document).on("click", "button#idAppart", function(evt) {
    var id = $(this).attr('value');
    console.log(id);
    $.ajax({
      url: "mesLocationEnregistres",
      type: "POST",
      data :{
        "idAppart":$(this).attr('value')
      },
      dateType:'json',
      success: function (data) {
        $("#demo").empty();
        if(JSON.parse(data)==""){
          $("#demo").html("<p class='echec'>Aucune location ajoutée pour cet appartement</p>");
        } else {
          $.each(JSON.parse(data), function(i, obj) {
          $("#demo").append(obj.DateDebutLocation + obj.DateFinLocation+"</br>");
          });
        }
        
       
      }
    });
  });


  //clique sur le bouton pour enregistrer une disponibilité avec le prix de location
  $(document).on("click", "button#mettreEnLocation", function(evt) {
    validerlogementAlouer($(this).parents(".formulaireAlouer"),id);
  });
    
  
    
  //afficher les demande de location en cours
  $(document).on("click",'button#validerLocation',function() {
    $.ajax({
      url: "demandeLocationEnCours",
      type: "POST",
      success: function(data) {
        $("#contentAppartement").empty();
        $("#contentAppartement").append(data);
      }
    });
  });

  //Valider une demande de location
 $(document).on("click", "button#validerDemandeLocation", function(evt) {
   var id = $(this).attr('value');
   console.log(id);
   $.ajax({
      url: "validerLocation",
      type: "POST",
      data :{"idAppart": +id},
      success: function(data) {
        $("#contentAppartement").empty();
        $("#contentAppartement").append(data);
      }
    });
  });
  
  
});


//fonction de validation formulaire pour mettre un appartement disponibilte 
function validerlogementAlouer(formulaire,id){
  var valideAlouer = true;
  console.log(id);
  formulaire.children("div").each(function() {
    var valeur = $(this).find(".champ");
    if (valeur.val() == "") {
      valeur.addClass("incorrect");
      $(this).find(".echec").text("Ce champ ne peut pas être vide");
      valideAlouer = false;
    } 
  });

  if (valideAlouer){
    console.log(id);
    $.ajax({
      url: "louerLogement",
      type: "POST",
      data :{
        "dateDebut":$('#dDebut').val(),
        "dateFin":$('#dFin').val(),
        "prix":$('#prix').val(),
        "id": id,
        "interval": $('input[name=interval]:checked').val()
      },
      success: function(data) {
        $("#contentAppartement").empty();
        $("#contentAppartement").append(data);
      }
    });
  }
}



//fonction de validation formulaire d'ajout d'une annonce
function validerFormulaireAjout(formulaire){
  var valide = true;
  //Ajoute le message d'erreur si un champ est vide
  formulaire.children("div").each(function() {
    var valeur = $(this).find(".champ");
    if (valeur.val() == "") {
      valeur.addClass("incorrect");
      $(this).find(".echec").text("Ce champ ne peut pas être vide");
      valide = false;
    } else {
      //vérifier le code postal au format H1H 1H1 ;
      if(valeur.attr('id')=="codePostal"){
        var codePostal = $("#codePostal").val();
        var Exp=new RegExp(/^[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}( ){1}[0-9]{1}[a-zA-Z]{1}[0-9]{1}$/);
        var cp = Exp.test(codePostal);
        if(cp==false) {
          $("#codePostal").addClass('incorrect');
          $(this).find(".echec").text("Format code postal n'est pas valide");
          valide = false;
        } else {
          $("#codePostal").removeClass("incorrect");
          $("#codePostal").addClass('correct');
          $(this).find(".echec").text("");
        }
      } else {
        valeur.removeClass("incorrect");
        valeur.addClass("correct");
        $(this).find(".echec").text("");
      }
    }
  });

  if(valide){
    //remplacer fakepath par le vrai chemin pour l'image
    var img = $("#icone").val();
    var rep = img.replace('C:\\','');
    var nouvChn = rep.replace(/fakepath/i, 'images\\appartement');
    $.ajax({
      url: "enregistrer",
      type: "POST",
      data: {
        "arrondissement": $("#arrondissement").val(),
        "adresse": $("#adresse").val(),
        "titre": $("#titre").val(),
        "codePostal": $("#codePostal").val(),
        "type": $("#type").val(),
        "piece": $("#piece").val(),
        "etage": $("#etage").val(),
        "internet": $('input[name=internet]:checked').val(),
        "tele": $('input[name=tele]:checked').val(),
        "climatiseur": $('input[name=climatiseur]:checked').val(),
        "meuble": $('input[name=meuble]:checked').val(),
        "adapte": $('input[name=adapte]:checked').val(),
        "laveuseSecheuse": $('input[name=laveuseSecheuse]:checked').val(),
        "laveVaisselle": $('input[name=laveVaisselle]:checked').val(),
        "stationnement": $("#stationnement").val(),
        "description": $("#description").val(),
        "image": nouvChn,
        "detail": $("#detail").val()
      },
      success: function(data) {
        if(data==false){
          $.ajax({
            url: "contenu_index",
            type: "POST",
            success: function(reponse) {
              $("#contentAppartement").empty();
              $("#contentAppartement").append(reponse);
            }
          });
        }
      }
    });
  }
}