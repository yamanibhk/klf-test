window.addEventListener("load", function() {
  $(document.body).on("click", "button, a", function(evt) {
    switch (evt.currentTarget.id) {
      //Ceci va charger le formulaire de l'inscription
      case "inscription":
        $.ajax({
          url: "index.php/atterrissage/inscription",
          method: "POST",
          success: function(data) {
            $("#content").empty();
            $("#content").append(data);
          }
        });
        break;

        //Ceci charge le formulaire de connexion
      case "connexion":
        $.ajax({
          url: "index.php/atterrissage/connexion",
          method: "POST",
          success: function(data) {
            $("#content").empty();
            $("#content").append(data);
          }
        });
        break;

        //Ceci est lorsqu'on soumet nos informations d'inscription au controlleur
      case "inscription-submit":
        validerInscription($(this).parents("#inscription-form"));
        break;

        //Ceci est lorsqu'on soumet nos informations de connexion au controlleur
      case "connexion-submit":
        validerConnexion($(this).parents("#connexion-form"));
        break;

        //Ceci est lorsque on clique sur annuler (remet l'accueil)
      case "cancel":
        $.ajax({
          url: "index.php/atterrissage/backToIndex",
          method: "POST",
          success: function(data) {
            $("#content").empty();
            $("#content").append(data);
          }
        });
        break;
    }
  });
});

function validerConnexion(formulaire) {
  var formulaireEstValide = true;

  //Ajoute le message d'erreur si un champ est vide
  formulaire.children(".form-group").each(function() {
    var currentInput = $(this).find("input");
    if (currentInput.val() == "") {
      currentInput.addClass("is-invalid");
      $(this).find(".invalid-feedback").text("ne peut pas être vide");
      $(this).find(".valid-feedback").text("");
      formulaireEstValide = false;
    } else {
      currentInput.removeClass("is-invalid");
    }
  });

  if (formulaireEstValide) {
    $("#username").val();
    $("#password").val();
    $.ajax({
      url: "index.php/usagers/connexion",
      method: "POST",
      data: {
        "nomUsager": $("#username").val(),
        "motDePasse": $("#password").val()
      },
      success: function(reponse) {
        if (reponse.statut == "valide") {
          window.location.replace("index.php/accueil/index");
        } else if (reponse.statut == "nonexistant") {
          formulaire.children(".form-group").each(function() {
            var currentInput = $(this).find("input");
            currentInput.addClass("is-invalid");
            $(this).find(".invalid-feedback").text("Combinaison invalide");
            $(this).find(".valid-feedback").text("");
          });
        } else if (reponse.statut == "nonValide") {
          let message = ("<p>Bonjour " + $("#username").val() + ", vous n'êtes pas encore validé, revenez plus tard.</p>");
          $.ajax({
            url: "index.php/usagers/connexion_message",
            method: "POST",
            data: {
              "message": message,
            },
            success: function(reponse) {
              $("#content").empty();
              $("#content").append(reponse);
            }
          });
        } else if (reponse.statut == "banni") {
          let message = ("<p>Bonjour " + $("#username").val() + ", vous ne pouvez vous connecter car vous êtes bani. Contactez un administrateur</p>");
          $.ajax({
            url: "index.php/usagers/connexion_message",
            method: "POST",
            data: {
              "message": message,
            },
            success: function(reponse) {
              $("#content").empty();
              $("#content").append(reponse);
            }
          });
        }
      }
    });
  }
} //Fin de la fonction valierConnexion



/**
 * Fait la validation des inputs du formulaire d'inscription et affiche les messages appropries
 *
 * @param      {DOM Element}  formulaire  le formulaire d'inscription
 */
function validerInscription(formulaire) {
  var formulaireEstValide = true;
  formulaire.children(".form-group").each(function() {
    var currentInput = $(this).find("input");
    if (currentInput.val() == "") {
      currentInput.addClass("is-invalid");
      $(this).find(".invalid-feedback").text("ne peut pas être vide");
      $(this).find(".valid-feedback").text("");
      formulaireEstValide = false;
    } else {
      currentInput.removeClass("is-invalid");
      switch (currentInput.attr("id")) {
        case "username":
          inputUsername = currentInput;
          $.ajax({
            url: "index.php/usagers/obtenir_usager",
            method: "POST",
            data: {
              "nomUsager": currentInput.val()
            },
            success: function(reponse) {
              if (reponse.existe == false) {
                inputUsername.addClass("is-valid");
                inputUsername.parent().find(".valid-feedback").text("Ce username est parfait !");
                inputUsername.parent().find(".invalid-feedback").text("");
              } else {
                inputUsername.addClass("is-invalid");
                inputUsername.parent().find(".invalid-feedback").text("Désolé, ce username est déjà utilisé");
                inputUsername.parent().find(".valid-feedback").text("");
                formulaireEstValide = false;
              }
            }
          });
          break;

        case "password":
          if ($("#password").val() == $("#password_confirm").val()) {
            currentInput.addClass("is-valid");
            $(this).find(".valid-feedback").text("Bon choix de mot de passe");
            $(this).find(".invalid-feedback").text("");
          } else {
            currentInput.addClass("is-invalid");
            $(this).find(".invalid-feedback").text("Les mots de passe ne correspondent pas");
            $(this).find(".valid-feedback").text("");
            formulaireEstValide = false;
          }
          break;

        case "password_confirm":
          if ($("#password").val() == $("#password_confirm").val()) {
            currentInput.addClass("is-valid");
            $(this).find(".valid-feedback").text("Bon choix de mot de passe");
            $(this).find(".invalid-feedback").text("");
          } else {
            currentInput.addClass("is-invalid");
            $(this).find(".invalid-feedback").text("Les mots de passe ne correspondent pas");
            $(this).find(".valid-feedback").text("");
            formulaireEstValide = false;
          }
          break;

        case "courriel":
          inputCourriel = currentInput;
          if (validateEmail(inputCourriel.val())) {
            $.ajax({
              url: "index.php/usagers/obtenir_courriel",
              method: "POST",
              data: {
                "courriel": inputCourriel.val()
              },
              success: function(reponse) {
                if (reponse.existe == false) {
                  inputCourriel.addClass("is-valid");
                  inputCourriel.parent().find(".valid-feedback").text("Votre e-mail est bon !");
                  inputCourriel.parent().find(".invalid-feedback").text("");
                } else {
                  inputCourriel.addClass("is-invalid");
                  inputCourriel.parent().find(".invalid-feedback").text("Oups, ce e-mail est déjà utilisé");
                  inputCourriel.parent().find(".valid-feedback").text("");
                  formulaireEstValide = false;
                }
              }
            });
          } else {
            inputCourriel.addClass("is-invalid");
            $(this).find(".invalid-feedback").text("Désolé, ce e-mail n'est pas valide");
            $(this).find(".valid-feedback").text("");
            formulaireEstValide = false;
          }
          break;
      }
    }
  });
  if (formulaireEstValide) {
    setTimeout(function() {
      $.ajax({
        url: "index.php/usagers/inscription",
        method: "POST",
        data: {
          "nomUsager": $("#username").val(),
          "motDePasse": $("#password").val(),
          "courriel": $("#courriel").val()
        },
        success: function(reponse) {
          $("#content").empty();
          $("#content").append(reponse);
        }
      });
    }, 500);
  }
}

/**
 * Valide une address mail
 *
 * @param      {string}  email   The email
 * @return     {bool}  Booleen true si l'email est valide et false sinon
 */
function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}