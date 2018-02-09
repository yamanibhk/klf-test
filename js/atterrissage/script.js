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
        console.log('connexion en cours');
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
    			// $.ajax({
	      //     url: "index.php/usager/obtenir",
	      //     method: "POST",
	      //     success: function(reponse) {
	      //     	if(reponse.existe == false) {
	      //     		currentInput.addClass("is-valid");
      	// 				$(this).find(".valid-feedback").text("Ce username est parfait !");
      	// 				$(this).find(".invalid-feedback").text("");
	      //     	} else {
	      //     		currentInput.addClass("is-invalid");
      	// 				$(this).find(".invalid-feedback").text("Désolé, ce username est déjà utilisé");
      	// 				$(this).find(".valid-feedback").text("");
      	// 				formulaireEstValide = false;
	      //     	}
	      //     }
	      //   });

    			// Cette partie doit etre retiree lorsque le controleur usager sera fonctionnel
    			//On decommentera alors la partie en haut
    			if (currentInput.val() != "mathieu") {
    				currentInput.addClass("is-valid");
  					$(this).find(".valid-feedback").text("Ce username est parfait !");
  					$(this).find(".invalid-feedback").text("");
    			} else {
    				currentInput.addClass("is-invalid");
  					$(this).find(".invalid-feedback").text("Désolé, ce username est déjà utilisé");
  					$(this).find(".valid-feedback").text("");
  					formulaireEstValide = false;
    			}
    			// Cette partie (en haut) doit etre retiree lorsque le controleur usager sera fonctionnel
    			//On decommentera alors la partie en haut

    			break;

  	   	case "password":
  	   		if($("#password").val() == $("#password_confirm").val()){
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
  	   		if($("#password").val() == $("#password_confirm").val()){
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
  				if(validateEmail(currentInput.val())) {
  					currentInput.addClass("is-valid");
  					$(this).find(".valid-feedback").text("Votre e-mail est bon !");
  					$(this).find(".invalid-feedback").text("");
  				} else {
  					currentInput.addClass("is-invalid");
  					$(this).find(".invalid-feedback").text("Désolé, ce e-mail n'est pas valide");
  					$(this).find(".valid-feedback").text("");
  					formulaireEstValide = false;
  				}
  				break;
    	}
    }
  });
  if(formulaireEstValide) {
  	setTimeout(function () {
  		console.log("formulaire valide");
  		console.log("Redirection via Ajax a faire");
  	}, 1500);
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