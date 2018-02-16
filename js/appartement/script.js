window.addEventListener("load", function() {
  $(document.body).on("click","button", function(evt) {
    switch (evt.currentTarget.id) {
      //Ceci va charger le formulaire d'ajout d'appartement
      case "ajouter-submit":
        $.ajax({
          url: "index.php/appartement/ajouter",
          method: "POST",
          success: function(data) {
            //$("#content").empty();
           // $("#content").append(data);
            console.log("formulaire ajouter annonce");
          }
        });
        break;

        //Ceci est lorsqu'on soumet nos informations d'ajout d'appartement au controlleur
      /*case "enregistrerAppartement-submit":
        validerInscription($(this).parents("#inscrireAppartement-form"));
        break;*/
    }
  });
});

