<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tienda</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Vuejs -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Sedgwick+Ave" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <!--<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">


  <!-- Libraries CSS Files -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/venobox/venobox.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <!-- Nivo Slider Theme -->

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Responsive Stylesheet File -->
  <link href="css/responsive.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: eBusiness
    Theme URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

 <!-- <div id="preloader"></div>

  <!-- Start Bottom Header -->
  <div class="header-bg page-area">
    <div class="home-overly"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top:13px">
          <div class="slider-content text-center">
            <div class="header-bottom">
              <div class="layer2 wow zoomIn" data-wow-duration="1s" data-wow-delay=".4s">
                <h1 class="title2" style="font-family: 'Sedgwick Ave', cursive;font-color:#B1F1B2">¿Seguridad?</h1>
              </div>
              <div class="layer3 wow zoomInUp" data-wow-duration="2s" data-wow-delay="1s">
                <h2 style="font-family: 'Sedgwick Ave', cursive;" class="title3">Tenemos lo que buscas</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Header -->

  <!-- Vuejs Are -->
  <div class="container-fluid" style="padding-top:20px;" id="app">
      <router-view> </router-view>
  </div>

  <div class="clearfix"></div>

  <!-- Start Footer bottom Area -->
  <footer>
    <div class="footer-area">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              <div class="footer-head">
                <img src="img/domotica_logo.png" width="700px" height="1100px">
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="footer-area-bottom">
      <div class="container">
      </div>
    </div>
  </footer>


  <!-- JavaScript Libraries -->
  <script src="lib/wow/wow.min.js"></script>

  <script src="{{ asset('js/app.js') }}"> </script>
  <script src="js/main.js"></script>
</body>

</html>
