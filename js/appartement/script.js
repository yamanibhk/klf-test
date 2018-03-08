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

  //rendre les champs du formulaire de modification appartement modifiable
  $(document).on("click", ".lien", function(evt) {

    var input = $(this).parent().prev();
    var ancienne_valeur = input.val();
    input.removeAttr("readonly");
    input.removeClass("form-control-plaintext");
    input.addClass("form-control");
    input.focus();
    //Lorsque le focus est retire
    input.focusout(function(){
      input.attr("readonly", "readonly");
      input.removeClass("form-control");
      input.addClass("form-control-plaintext");
    });
  });

  //Ceci va charger le formulaire de modification d'appartement
  $(document).on("click", "button#modifierAppart", function(evt) {
    $.ajax({
      url: "modifier",
      type: "POST",
      data : {"idAppart":$(this).attr('value')},
      dataType:'json',
      success: function(result) {
        $.each(result, function(i, data) {
        var arron = data.nomArrondissement;
        var adresse = data.Adresse;
        var titre = data.titre;
        var cp = data.codePostal;
        var typeLog = data.typeLogement;
        var piece = data.nbrePiece;
        var etage = data.numEtage;
        if(data.Internet==1){
          var internet = "Oui";
        } else {
          var internet = "Non";
        }
        if(data.Television==1){
          var tele = "Oui";
        } else {
          var tele = "Non";
        }
        if(data.Climatiseur==1){
          var clim = "Oui";
        } else {
          var clim = "Non";
        }
        if(data.Meuble==1){
          var meuble = "Oui";
        } else {
          var meuble = "Non";
        }
        if(data.Adapte==1){
          var adapte = "Oui";
        } else {
          var adapte = "Non";
        }
        if(data.LaveuseSecheuse==1){
          var lavSech = "Oui";
        } else {
          var lavSech = "Non";
        }
        if(data.LaveVaisselle==1){
          var lavVaiss = "Oui";
        } else {
          var lavVaiss = "Non";
        }
        var statnmt = data.nbreStationnement;
        var desc = data.description;
        $.ajax({
          
          url: "modifierAppartement",
          type: "POST",
          
          success: function(data) {
          $("#contentAppartement").empty();
          $("#contentAppartement").append(data);
          $('#arrond').val(arron);
          $('#adresse').val(adresse);
          $('#titre').val(titre);
          $('#cp').val(cp);
          $('#typeLog').val(typeLog);
          $('#piece').val(piece);
          $('#etage').val(etage);
          $('#internet').val(internet);
          $('#tele').val(tele);
          $('#clim').val(clim);
          $('#meuble').val(meuble);
          $('#adapte').val(adapte);
          $('#lavSech').val(lavSech);
          $('#lavVaiss').val(lavVaiss);
          $('#statnmt').val(statnmt);
          $('#desc').val(desc);
          }
          
        });
      });
      }
    });
    var id = $(this).attr('value');
    //soumettre les informations de modification d'appartement au controlleur
    $(document).on("click",'button#ModifierAppartement',function(evt) { 
      validerFormulaireModification($(this).parents("#modificationForm"),id);
      console.log(id);
    });
  });


  //valider formulaire de modification appartement
  function validerFormulaireModification(formulaire,val){
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
        if(valeur.attr('id')=="cp"){
          var codePostal = $("#cp").val();
          var Exp=new RegExp(/^[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}( ){1}[0-9]{1}[a-zA-Z]{1}[0-9]{1}$/);
          var cp = Exp.test(codePostal);
          if(cp==false) {
            $("#cp").addClass('incorrect');
            $(this).find(".echec").text("Format code postal n'est pas valide");
            valide = false;
          } else {
            $("#cp").removeClass("incorrect");
            $("#cp").addClass('correct');
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
      if($('#internet').val()=="Oui") $internet='1'; else $internet='0';
      if($('#tele').val()=="Oui") $tele='1'; else $tele='0';
      if($('#clim').val()=="Oui") $climatiseur='1'; else $climatiseur='0';
      if($('#meuble').val()=="Oui") $adapte='1'; else $adapte='0';
      if($('#adapte').val()=="Oui") $meuble='1'; else $meuble='0';
      if($('#lavSech').val()=="Oui") $laveuseSecheuse='1'; else $laveuseSecheuse='0';
      if($('#lavVaiss').val()=="Oui") $laveVaisselle='1'; else $laveVaisselle='0';
      $.ajax({
        url: "valider_modification",
        type: "POST",
        data: {
          "id" : + val,
          "arrondissement": $("#arrond").val(),
          "adresse": $("#adresse").val(),
          "titre": $("#titre").val(),
          "codePostal": $("#cp").val(),
          "type": $("#typeLog").val(),
          "piece": $("#piece").val(),
          "etage": $("#etage").val(),
          "internet": $internet,
          "tele": $tele,
          "climatiseur": $climatiseur,
          "meuble": $adapte,
          "adapte": $meuble,
          "laveuseSecheuse": $laveuseSecheuse,
          "laveVaisselle": $laveVaisselle,
          "stationnement": $("#statnmt").val(),
          "description": $("#desc").val()
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
  };


  //supprimer un apppartement
  $(document).on("click", "button#supprimerAppart", function(evt) {
    var id = $(this).attr('value');
    $(document).on("click", "button#confirmSuppression", function(evt) {
      
      $.ajax({
        url: "supprimerAppartement",
        type: "POST",
        data :{
          "idAppart": + id
        },
        success: function(reponse) {
          if(reponse==true){
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
          $("#dateDispo").append("<p class='donneeExist'>" + obj.dateDebutDispo + " au " + obj.dateFinDispo+"</p>");
          });
        }
      }
    });

    //Affichage des location pour un appartement choisi
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
          $("#demo").append("<p class='donneeExist'>" + obj.DateDebutLocation  + " au " + obj.DateFinLocation+"</p>");
          });
        }
      }
    });

    //clique sur le bouton pour enregistrer une disponibilité avec le prix de location
    $(document).on("click", "button#mettreEnLocation", function(evt) {
      console.log(id);
      validerlogementAlouer($(this).parents(".formulaireAlouer"),id);
    });
  });

  //fonction de validation formulaire pour mettre un appartement disponibilte 
function validerlogementAlouer(formulaire,id){
  var valideAlouer = true;
  formulaire.children("div").each(function() {
    var valeur = $(this).find(".champ");
    if (valeur.val() == "") {
      valeur.addClass("incorrect");
      $(this).find(".echec").text("Ce champ ne peut pas être vide");
      valideAlouer = false;
    } 
  });

  if (valideAlouer){
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
    //remplacer fakepath par le vrai chemin pour chaque image
    if($("#icone").val()==""){
      var nouvChn="images\\appartement\\home.png"
    } else {
      var img = $("#icone").val();
      var rep = img.replace('C:\\','');
      var nouvChn = rep.replace(/fakepath/i, 'images\\appartement');
    }
    
    if($("#icone1").val()==""){
      var nouvChn1="images\\appartement\\home.png"
    } else {
      var img1 = $("#icone1").val();
      var rep1 = img1.replace('C:\\','');
      var nouvChn1 = rep1.replace(/fakepath/i, 'images\\appartement');
    }

    if($("#icone2").val()==""){
      var nouvChn2="images\\appartement\\home.png"
    } else {
      var img2 = $("#icone2").val();
      var rep2= img2.replace('C:\\','');
      var nouvChn2 = rep2.replace(/fakepath/i, 'images\\appartement');
    }

    if($("#icone3").val()==""){
      var nouvChn3="images\\appartement\\home.png"
    } else {
      var img3 = $("#icone3").val();
      var rep3= img3.replace('C:\\','');
      var nouvChn3 = rep3.replace(/fakepath/i, 'images\\appartement');
    }

    if($("#icone4").val()==""){
      var nouvChn4="images\\appartement\\home.png"
    } else {
      var img4 = $("#icone4").val();
      var rep4 = img4.replace('C:\\','');
      var nouvChn4 = rep4.replace(/fakepath/i, 'images\\appartement');
    }

    //si aucun champs detail n'est rempli
    if($("#detail").val()==""){
      var detail="aucune image";
    } else {
      var detail=$("#detail").val();
    }
    
    if($("#detail1").val()==""){
      var detail1="aucune image";
    } else {
      var detail1=$("#detail1").val();
    }

    if($("#detail2").val()==""){
      var detail2="aucune image";
    } else {
      var detail2=$("#detail2").val();
    }

    if($("#detail3").val()==""){
      var detail3="aucune image";
    } else {
      var detail3=$("#detail3").val();
    }

    if($("#detail4").val()==""){
      var detail4="aucune image";
    } else {
      var detail4=$("#detail4").val();
    }
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
        "image1": nouvChn1,
        "image2": nouvChn2,
        "image3": nouvChn3,
        "image4": nouvChn4,
        "detail": detail,
        "detail1": detail1,
        "detail2": detail2,
        "detail3": detail3,
        "detail4": detail4
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