window.addEventListener("load", function() {
  //L'input pour changer l'image du profil
  $(document.body).on("change", "#input_nouvelle_image", function(evt) {
    var input = $(this);
    var path = $(this).val();
    var filename = path.replace(/^.*\\/, "");
    if(filename != "") {
      input.next().text(filename);
    } else {
      input.next().text("Choisissez une image");
    }
  });

  //Retire le readonly des input lorsqu'on clique dessus
  $(document.body).on("focus", "input[id^='input_']", function(evt) {
    var input = $(this);
    input.attr("readonly", false);
    input.on("focusout", function(){
      input.attr("readonly", true);
    });
  });

  $(document.body).on("change", "input, select", function(evt) {
    var input = $(this);
    $("#btn_sauvegarder_changements").show("slow");
  });

  $(document.body).on("click", "#btn_sauvegarder_changements", function(evt) {
    var input = $(this);
    $.ajax({
      url: "../usagers/modifier_infos",
      method: "POST",
      data : {
        "nomUsager" : $("#input_nomUsager").val(),
        "prenom" : $("#input_prenom").val(),
        "nom" : $("#input_nom").val(),
        "adresse" : $("#input_adresse").val(),
        "mode_paiement" : $("#input_mode_paiement").val(),
        "cheminPhoto" : $("#input_nouvelle_image").val().replace(/^.*\\/, "")
      },
      success: function(reponse) {
        if(reponse == true) {
          window.location.href = "index";
        } else {
          // window.location.href = "http://stackoverflow.com";
        }
      }
    });
  });
});