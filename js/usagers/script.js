window.addEventListener("load", function() {
  //Retire le readonly des input lorsqu'on clique dessus
  $(document.body).on("focus", "input", function(evt) {
    var input = $(this);
    input.attr("readonly", false);
    input.on("focusout", function(){
      input.attr("readonly", true);
    });
  });

  //Affiche le bouton de sauvegarde des changemens lorsqu'ils ont lieux
  $(document.body).on("change", "input, select", function(evt) {
    var input = $(this);
    $("#btn_sauvegarder_changements").show("slow");
  });

  $('#change_form').on('submit', function(e) {
    e.preventDefault();
    // var fd = new FormData(document.querySelector("#change_form"));
    $.ajax({
      url:"../usagers/modifier_infos",
      method:"POST",
      data: new FormData(document.querySelector("#change_form")),
      contentType: false,
      cache: false,
      processData:false,
      success:function(reponse) {
        console.log(reponse);
        if(reponse == true) {
          window.location.href = "index";
        }
      }
    });
  });


  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#profile_image').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#input_nouvelle_image").change(function() {
    readURL(this);
    //Fait disparaitre les controles lorsqu'une nouvelle image est ajoutee
    $("#controles_changer_image").fadeOut("fast");
    window.setTimeout(function(){
      var image = $('#profile_image');
      var cropper = image.cropper({
        aspectRatio: 1 / 1,
        crop: function(e) {
          $("input[name=posX]").val(e.x);
          $("input[name=posY]").val(e.y);
          $("input[name=width]").val(e.width);
          $("input[name=height]").val(e.height);
        }
      });
    }, 100);
  });
});