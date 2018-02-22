window.addEventListener("load", function() {
  $(document).on("click", "button#ajouter", function(evt) {
    //Ceci va charger le formulaire d'ajout d'appartement
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
  $(document).on("click", "button#enregistrerAppartement", function(evt) {
    console.log("formulaire ajouter annonce");
    validerFormulaireAjout($(this).parents("#inscrireAppartement-form"));
  });
});


//fonction de validation formulaire d'ajout d'une annonce
function validerFormulaireAjout(formulaire){
  var valide = true;
  console.log("validation");

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
        var valide = true;
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
          valide = true;
        }
      } else {
        valeur.removeClass("incorrect");
        valeur.addClass("correct");
        $(this).find(".echec").text("");
        valide = true;
      }
    }
  });

  if(valide){
    $.ajax({
      url: "enregistrer",
      type: "POST",
      data: {
        "arrondissement": $("#arrondissement").val(),
        "adresse": $("#adresse").val(),
        "codePostal": $("#codePostal").val(),
        "type": $("#type").val(),
        "piece": $("#piece").val(),
        "etage": $("#etage").val(),
        "internet": $(".internet").val(),
        "tele": $(".tele").val(),
        "climatiseur": $(".climatiseur").val(),
        "meuble": $(".meuble").val(),
        "adapte": $(".adapte").val(),
        "laveuseSecheuse": $(".laveuseSecheuse").val(),
        "laveVaisselle": $(".laveVaisselle").val(),
        "stationnement": $("#stationnement").val(),
        "description": $("#description").val()
      },
      success: function(reponse) {
        $("#contentAppartement").empty();
        $("#contentAppartement").append(reponse);
      }
    });
  }
}