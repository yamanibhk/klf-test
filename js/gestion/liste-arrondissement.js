window.addEventListener("load", function() {
  $(document.body).on("click", "a", function(evt) {
    var id_arrondissement = $(this).parent().data("id_arrondissement");
    switch($(this).attr("id")){
      case "btn_modifier" :
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

          // S'il y a eu des changements
          if(input.val() != ancienne_valeur) {
            $.ajax({
              url: "../gestion/modifier_arrondissement/"+id_arrondissement,
              method: "POST",
              data : {
                "valeur" : input.val()
              },
              success: function() {
                rafraichirArrondissement();
              }
            });
          }
        });
      break

      case "btn_supprimer" :
        $(this).tooltip("dispose");
        $.ajax({
          url: "../gestion/supprimer_arrondissement/"+id_arrondissement,
          method: "POST",
          success: function() {
            rafraichirArrondissement();
          }
        });
      break

      case "btn_ajouter_arrond" :
        var input = $(this).parent().prev().find("input");
        if(input.val() == "") {
          input.addClass("is-invalid");
        } else {
          $.ajax({
            url: "../gestion/ajouter_arrondissement",
            method: "POST",
            data : {
              "valeur" : input.val()
            },
            success: function() {
              $('#nouvel_arrondissement').modal('hide');
              $('#nouvel_arrondissement').on('hidden.bs.modal', function (e) {
                rafraichirArrondissement()
              });
            }
          });
        }
      break
    }
  });

  /**
   * Rafraichi la liste des arrondissements
   */
  function rafraichirArrondissement() {
    $.ajax({
      url: "voir_arrondissements",
      method: "POST",
      success: function(reponse) {
        $("#content_panel").empty();
        $("#content_panel").append(reponse);
      }
    });
  }
});