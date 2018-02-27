window.addEventListener("load", function() {
  // Rempli par defaut avec la liste des usagers
  $.ajax({
    url: "usagers",
    method: "POST",
    success: function(reponse) {
      $("#content_panel").empty();
      $("#content_panel").append(reponse);
    }
  });

  //Ecouter les clics sur les menus de gauche
  $(document.body).on("click", "#admin_menu a", function(evt) {

    //S'assure qu'on clique sur un menu inactif (evite les requetes inutiles si menu deja charge)
    if($("#admin_menu").find("a.active").attr("id") != $(this).attr("id")) {

      //Retire la classe "active" du dernier menu actif
      $("#admin_menu").find("a.active").removeClass("active");

      //Mets le menu actif en bleu
      $(this).addClass("active");

      switch($(this).attr("id")) {
        case "usagers" :
          $.ajax({
            url: "usagers",
            method: "POST",
            success: function(reponse) {
              $("#content_panel").empty();
              $("#content_panel").append(reponse);
            }
          });
        break;

        case "statistiques" :
          $.ajax({
            url: "statistiques",
            method: "POST",
            success: function(reponse) {
              $("#content_panel").empty();
              console.log(reponse);
            }
          });
        break;

        case "arrondissements" :
          $.ajax({
            url: "voir_arrondissements",
            method: "POST",
            success: function(reponse) {
              $("#content_panel").empty();
              $("#content_panel").append(reponse);
            }
          });
        break;

        case "moyensDePaiements" :
          $.ajax({
            url: "moyensDePaiements",
            method: "POST",
            success: function(reponse) {
              $("#content_panel").empty();
              console.log(reponse);
            }
          });
        break;
      }
    } //Fin de la condition du clic sur menu inactif
  });
});