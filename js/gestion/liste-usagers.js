window.addEventListener("load", function() {
  $(document.body).on("click", ".dropdown-menu a:not(.disabled)", function(evt) {
    let usagerConcerne = $(this).parent().data("usager");
    switch($(this).attr("id")){
      case "btn_bannir" :
        $.ajax({
          url: "../usagers/bannir",
          method: "POST",
          data : {
            "nomUsager" : usagerConcerne
          },
          success: function() {
            rafraichirUsagers();
          }
        });
      break

      case "btn_gracier" :
        $.ajax({
          url: "../usagers/gracier",
          method: "POST",
          data : {
            "nomUsager" : usagerConcerne
          },
          success: function() {
            rafraichirUsagers();
          }
        });
      break

      case "btn_valider" :
        $.ajax({
          url: "../usagers/valider",
          method: "POST",
          data : {
            "nomUsager" : usagerConcerne
          },
          success: function() {
            rafraichirUsagers();
          }
        });
      break

      case "btn_nouv_admin" :
        $.ajax({
          url: "../usagers/faire_admin",
          method: "POST",
          data : {
            "nomUsager" : usagerConcerne
          },
          success: function() {
            rafraichirUsagers();
          }
        });
      break

      case "btn_retirer_admin" :
        $.ajax({
          url: "../usagers/retirer_admin",
          method: "POST",
          data : {
            "nomUsager" : usagerConcerne
          },
          success: function() {
            rafraichirUsagers();
          }
        });
      break
    }
  });

  /**
   * Rafraichi la liste des usagers
   */
  function rafraichirUsagers() {
    $.ajax({
      url: "usagers",
      method: "POST",
      success: function(reponse) {
        $("#content_panel").empty();
        $("#content_panel").append(reponse);
      }
    });
  }
});