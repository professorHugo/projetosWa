<?php
ob_start();
session_start();
error_reporting(0);

include("admin/config/conn.php");
include("admin/config/functions.php");
include('admin/PHPMailer/class.phpmailer.php');
include('admin/PHPMailer/class.smtp.php');
include("includes/header.php");
?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="<?php echo $base; ?>" />
        <meta name="keywords" content="<?php echo $keywords;?>" />
        <meta name="description" content="<?php echo $description;?>" />
        <title><?php echo $title;?></title>

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <link rel="stylesheet" href="css/pushy.css">
        <?php if ($param1 == ''): ?>
          <link rel="stylesheet" href="css/slick.css">
          <link rel="stylesheet" href="css/slick-theme.css">
        <?php endif; ?>
        <link rel="stylesheet" href="css/style.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <style media="print">
          body {
            font-size: 8px !important;
            -webkit-print-color-adjust: exact;
          }
          body * {
            font-size: 8px !important;
          }
          tr td:first-child {
            text-align: center;
          }
          tr td:nth-child(4) {
            white-space: nowrap !important;
          }
          tr td {
            /*white-space: nowrap;*/
            width: auto;
          }
          .no-print {
            display: none;
          }
          .print_logo {
            display: block !important;
            height: 100px !important;
            margin: auto !important;
            margin-bottom: 2em !important;
            max-height: 100px !important;
          }
          .print_cons {
            display: table-cell;
          }
          .consignado {
            background-color: #AAA !important;
            -webkit-print-color-adjust: exact;
          }
          h4, h1 {
            font-weight: bold;
            margin-bottom: 2.5rem;
            text-align: center;
          }
          h4 {
            font-size: 2.5em !important;
          }
          h1 {
            font-size: 5em !important;
          }
          .ficha_div {
            /*font-size: 3em !important;*/
            font-weight: bold;
            margin: auto;
            margin-bottom: 2.5rem;
            text-align: center;
            text-transform: uppercase;
          }
          .ficha_div span, .ficha_div div:first-child {
            font-size: 2.7em !important;
          }
          .opcionais {
            font-size: 2em !important;
          }
          @page { margin: 1rem; -webkit-print-color-adjust: exact; }
        </style>

        <?php if ($param1 == 'veiculos' || $param1 == 'resultado-busca'): ?>
          <link rel="stylesheet" href="css/responsive-table.css">
        <?php endif; ?>

        <style media="screen">
        @media (max-width: 768px) {
          .banner_home {
            position: relative;
            height: 70vh;
            background-size: cover;
            background-position: top left;
          }
        }
        </style>
    </head>
    <body>
      <div id="fb-root"></div>
      <script>
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.9";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <?php if ($param1 == "") {
          $banner = "banner_home";
          $data_bg = "testando";
          $data_bg_mbl = "testando";

          $banners = array();
          $banners_mbl = array();
          $bannersQuery = mysql_query("SELECT * FROM banners ORDER BY id LIMIT 0, 5");
          while ($bannerBd = mysql_fetch_assoc($bannersQuery)) {
            array_push($banners, $bannerBd['banner']);
            array_push($banners_mbl, $bannerBd['mobile']);
          }

          $data_bg = implode(",", $banners);
          $data_bg_mbl = implode(",", $banners_mbl);
        } else {
          $banner = "bg_header";
        } ?>
        <style media="screen">
          .banner_home {
            background-image: url('uploads/banners/<?=$banners[0]?>');
          }
          @media (max-width: 768px) {
            .banner_home {
              background-image: url('uploads/banners/mobile/<?=$banners_mbl[0]?>');
            }
          }
        </style>
        <div class="<?=$banner?> no-print" data-bg="<?=$data_bg?>" data-mbl="<?=$data_bg_mbl?>">
            <div class="container" style="">
                <div class="header bg_white m_top50 d_none_md">
                    <div class="row">
                        <div class="col-md-9">
                            <nav class="menu_header">
                                <a href="./"><img src="img/campovel-logo.jpg" class="img-responsive"></a>
                                <a href="./" class="trans3">Home</a>
                                <a href="/veiculos/" class="trans3">Veículos</a>
                                <a href="/atendimento/" class="trans3">Fale Conosco</a>
                            </nav>
                        </div>
                        <div class="col-md-3">
                            <div class="phone_header">
                                <img style="max-width:30px; max-height:30px; display: inline-block; float:left; margin-top: 2rem;" src="img/whatsapp-sm.png" class="img-responsive" alt="">
                                <div class="" style="float: right; margin-right: 3rem;">
                                  <div style="/*float: right; margin-right: 2rem;*/" class="phone_number_header">(15) <span>99639-9279</span></div>
                                  <div style="display: none;" class="phone_number_header">(15) <span>99819-7732</span></div>
                                  <div style="/*float: right; margin-right: 2rem;*/" class="phone_number_header">(15) <span>3202-6062</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="pushy pushy-left d_none d_block_md" data-focus="#first-link">
                    <div class="pushy-content">
                        <ul>
                            <a href="#"><img src="img/campovel-logo.jpg" alt="" class="img-responsive"></a>
                            <li>
                                <a href="" class="trans3" id="first-link">Home</a>
                            </li>
                            <li>
                                <a href="/veiculos/" class="trans3">Veículos</a>
                            </li>
                            <li>
                                <a href="/atendimento/" class="trans3">Fale Conosco</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="logo_responsive_home">
                    <div>
                    </div>
                    <a href="./"><img src="img/campovel-logo.jpg" alt="" class="img-responsive"></a>
                    <button class="menu-btn d_none d_block_md"><i class="fa fa-bars"></i></button>
                </div>
                <!-- apenas na home -->
                <?php #if ($param1 == "") { ?>
                  <div class="title_banner hidden-lg hidden-md">
                    <img style="max-width:30px; max-height:30px; display: block; float:left; margin-top: 2rem;" src="img/whatsapp-sm.png" class="img-responsive" alt="">
                    <div class="">
                      <div>(15) <span>99639-9279</span></div>
                      <div style="display: none;">(15) <span>99819-7732</span></div>
                      <div>(15) <span>3202-6062</span></div>
                    </div>
                  </div>
                <?php #} ?>
            </div>
            <?php if ($param1 == "") { ?>
              <a href="#" class="fa fa-angle-left seta_banner left trans5 hidden-xs"></a>
              <a href="#" class="fa fa-angle-right seta_banner right trans5 hidden-xs"></a>
            <?php } ?>
        </div>
        <?php include("paginas/".$include);?>

        <footer class="no-print" <?php echo ($param1 == '' ? "style='margin-top:4rem'" : '' ); ?>>
            <div class="container">
                <div class="title_facebook">
                    <h1>Facebook</h1>
                </div>
                <div class="fb-page"
                     data-href="https://www.facebook.com/Campovel/"
                     width="500"
                     data-small-header="false"
                     data-adapt-container-width="true"
                     data-hide-cover="false"
                     data-show-facepile="false"
                     style="display: flex; flex-flow: row nowrap; justify-content: center; align-items: center;">
                  <blockquote cite="https://www.facebook.com/Campovel/" class="fb-xfbml-parse-ignore">
                    <a href="https://www.facebook.com/Campovel/">Campovel Automóveis</a>
                  </blockquote>
                </div>
            </div>
            <div class="container-fluid p_relative p_t_b_50">
                <span class="bar_img top"></span>
                <div class="row m_r_0">
                    <div class="col-md-6 p_0">
                        <div class="img_google_maps">
                            <img src="img/img-footer-2.jpg" alt="" class="img-responsive">
                            <div class="mask_google_maps"></div>
                            <h1>Google <span> Maps</span></h1>
                            <div class="adress_img_maps">
                                <span>Av. Dr Afonso Vergueiro 2635 <br /> 18040-000 Sorocaba - SP - Fone</span>
                                <span class="phone_maps">(15) 3202-6062</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p_0">
                        <iframe id="maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58542.229192225466!2d-47.51080836122446!3d-23.500495586405876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c58ac59ec4c301%3A0xc62fd8ff0a2e49ea!2sCampovel!5e0!3m2!1spt-BR!2sbr!4v1491852692253" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        <script type="text/javascript">
                          var maps = document.getElementById('maps');

                          function mapsUnidadeUm() {
                            maps.setAttribute('src','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58542.229192225466!2d-47.51080836122446!3d-23.500495586405876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c58ac59ec4c301%3A0xc62fd8ff0a2e49ea!2sCampovel!5e0!3m2!1spt-BR!2sbr!4v1491852692253');
                          }

                          function mapsUnidadeDois() {
                            maps.setAttribute('src','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58542.229192225466!2d-47.51080836122446!3d-23.500495586405876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c58ac59ec4c301%3A0xc62fd8ff0a2e49ea!2sCampovel!5e0!3m2!1spt-BR!2sbr!4v1491852692253');
                          }
                        </script>
                    </div>
                </div>
                <span class="bar_img bottom"></span>
            </div>
            <div class="container" style="margin-bottom:2rem;">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <ol class="ol_adress_footer">
                            <li>
                                <div>AVENIDA DR AFONSO VERGUEIRO 2635 <span>Sorocaba -  FONE (15) 3202-6062</span></div>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="phone_header" style="
                            text-align: center;
                            display: flex;
                            flex-flow: column;
                            justify-content: center;
                            align-items: flex-end;
                        ">
                          <i class="fa fa-whatsapp"></i>
                          <div class="phone_number_header">(15) <span>99639-9279</span></div>
                          <div style="display: none;" class="phone_number_header">(15) <span>99819-7732</span></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="redes_sociais t_right m_t_30">
                            <a href="https://www.facebook.com/Campovel/" class="fa fa-facebook trans3" target="_blank"></a>
                            <a href="https://www.instagram.com/campovelautomoveis/" class="fa fa-instagram trans3" target="_blank"></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="rodape">
                <a href="" target="_blank"><img src="" alt=""></a>
            </div> -->
        </footer>
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/printthis.js"></script>
        <script src="js/main.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="js/pushy.min.js"></script>
        <?php if ($param1 == ''): ?>
        <script src="js/slick.min.js"></script>
        <?php endif; ?>
        <script type="text/javascript">
          $(".banner_home").click(function() {
            var data = $(".banner_home").data("bg").split(",");
          });

          if ($(window).width() > 768) {
            window.onload = function() {
              var data = $(".banner_home").data("bg").split(",");
              var data_mbl = $(".banner_home").data("mbl").split(",");
              var i = 0;

              var imgChange = setInterval(setImg, 7000);

              $(".left").click(function() {
                if (i <= 0) {
                  clearInterval(imgChange);
                  i = data.length - 1;
                  $(".banner_home").css("background-image", "url(uploads/banners/" + data[i] + ")");
                  imgChange = setInterval(setImg, 7000);
                } else {
                  clearInterval(imgChange);
                  i--;
                  $(".banner_home").css("background-image", "url(uploads/banners/" + data[i] + ")");
                  imgChange = setInterval(setImg, 7000);
                }
              });

              $(".right").click(function() {
                if (i >= data.length - 1) {
                  clearInterval(imgChange);
                  i = 0;
                  $(".banner_home").css("background-image", "url(uploads/banners/" + data[i] + ")");
                  imgChange = setInterval(setImg, 7000);
                } else {
                  clearInterval(imgChange);
                  i++;
                  $(".banner_home").css("background-image", "url(uploads/banners/" + data[i] + ")");
                  imgChange = setInterval(setImg, 7000);
                }
              });

              function setImg() {
                if (i >= data.length - 1) {
                  i = 0;
                  $(".banner_home").css("background-image", "url(uploads/banners/" + data[i] + ")");
                  // i++;
                } else {
                  i++;
                  $(".banner_home").css("background-image", "url(uploads/banners/" + data[i] + ")");
                }
              }
            }
          }

          if ($(window).width() <= 768) {
            window.onload = function() {
              var data = $(".banner_home").data("mbl").split(",");
              var i = 0;

              var imgChange = setInterval(setImg, 7000);

              $(".left").click(function() {
                if (i <= 0) {
                  clearInterval(imgChange);
                  i = data.length - 1;
                  $(".banner_home").css("background-image", "url(uploads/banners/mobile/" + data[i] + ")");
                  imgChange = setInterval(setImg, 7000);
                } else {
                  clearInterval(imgChange);
                  i--;
                  $(".banner_home").css("background-image", "url(uploads/banners/mobile/" + data[i] + ")");
                  imgChange = setInterval(setImg, 7000);
                }
              });

              $(".right").click(function() {
                if (i >= data.length - 1) {
                  clearInterval(imgChange);
                  i = 0;
                  $(".banner_home").css("background-image", "url(uploads/banners/mobile/" + data[i] + ")");
                  imgChange = setInterval(setImg, 7000);
                } else {
                  clearInterval(imgChange);
                  i++;
                  $(".banner_home").css("background-image", "url(uploads/banners/mobile/" + data[i] + ")");
                  imgChange = setInterval(setImg, 7000);
                }
              });

              function setImg() {
                if (i >= data.length - 1) {
                  i = 0;
                  $(".banner_home").css("background-image", "url(uploads/banners/mobile/" + data[i] + ")");
                  // i++;
                } else {
                  i++;
                  $(".banner_home").css("background-image", "url(uploads/banners/mobile/" + data[i] + ")");
                }
              }
            }
          }
        </script>

        <script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-100003522-1', 'auto');
		  ga('send', 'pageview');

		</script>

		<script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:514456,hjsv:5};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
        </script>
	</body>
</html>
