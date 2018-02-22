window.addEventListener("load", function() {
  //Active les tooltips
  $(function () {
    $("body").tooltip({
      selector: '[data-toggle="tooltip"]'
    });
  })
});