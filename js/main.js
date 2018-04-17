$(document).ready(function() {
  $("#contact_form").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
      type : "POST",
      cache : false,
      url : $(this).attr("action"),
      data : $(this).serialize(),
      success : function(data) {
        if (data == 1) {
          $(".alert-success").delay(500).slideDown(500);
          $(".form-clean").trigger("reset");
        } else {
          $(".alert-danger").delay(500).slideDown(500);
        }
      }
    });
  });

  $("#contact_form_car").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
      type : "POST",
      cache : false,
      url : $(this).attr("action"),
      data : $(this).serialize(),
      success : function(data) {
        if (data == 1) {
          $(".alert-success").delay(500).slideDown(500);
          $(".form-clean").trigger("reset");
        } else {
          $(".alert-danger").delay(500).slideDown(500);
        }
      }
    });
  });

  $(".callModal").on("click", function() {
    console.log($(this).attr("data-id"));
    $.get("../ajax/car_data.php", { id : $(this).attr("data-id") }, function(data, status) {
      if(data == "") {
        alert("Nenhum Veículo encontrado!");
      } else {
        $("#myModal .modal-body").find('.remove').remove();
        $("#myModal .modal-body").append(data);
      }
    });
  });

  $("#printModal").on("click", function() {
    $("#modalDiv").printThis({
      debug: false,
      importCSS: true,
      importStyle: true,
      printContainer: true,
      loadCSS: "../css/print_car.css",
      pageTitle: "Ficha do Veículo - " + $("#veiculo_nome").text(),
      removeInline: false,
      printDelay: 333,
      header: null,
      formValues: true
    });
  });

  $(".slick").slick({
    arrows: true,
    autoplay: true,
    autoplaySpeed: 2000,
    centerMode: false,
    dots: false,
    infinite: true,
    speed: 1000,
    slidesToShow: 6,
    slidesToScroll: 1,
    draggable: true,
    swipeToSlide: true,
    touchMove: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          arrows: false,
          slidesToShow: 4,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          arrows: false,
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
});
