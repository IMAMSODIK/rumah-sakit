<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="icon" href="{{ asset('assets/assets/images/favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/icon/feather/css/feather.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">

    <style>
        body{
            background-color: #457b9d;
        }

        .sample-header {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            background-image: url("https://dvbsinc.com/wp-content/uploads/2021/03/Workshops-Header-Background.png");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        .sample-header::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0.3;
        }
        .sample-header-section {
            position: relative;
            padding: 10%;
            color: white;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
            font-family: "Montserrat", sans-serif;
        }
        h1 {
            font-weight: 500;
        }
        h2 {
            font-weight: 400;
        }

        .sample-section-wrap {
            position: relative;
            background-color: #457b9d;
        }
        .sample-section {
            position: relative;
            margin-left: auto;
            margin-right: auto;
            padding: 40px;
        }

        .card {
            background-color: #1d3557;
            border: none;
            transition: transform 0.5s, box-shadow 0.5s, opacity 0.5s;
            transform: perspective(1000px) rotateY(0deg) scale(1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            opacity: 1;
        }

        .card:hover {
            transform: perspective(1000px) rotateY(0deg) scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            opacity: 0.9;
        }

    </style>
  </head>
  <body>

    <div class="sample-header">
        <div class="sample-header-section text-center">
            <h1>INFORMASI MONITORING PASIEN IGD RSUPD Dr. SARDJITO</h1>
            <h2 id="tanggal"></h2>
        </div>
    </div>

    <div class="sample-section-wrap">
        <div class="sample-section">
          <div class="row">

          </div>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/popper.js/dist/umd/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/modernizr/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/modernizr/feature-detects/css-scrollbars.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/chart.js/dist/Chart.js') }}"></script>
    <script src="{{ asset('assets/assets/pages/widget/amchart/amcharts.js') }}"></script>
    <script src="{{ asset('assets/assets/pages/widget/amchart/serial.js') }}"></script>
    <script src="{{ asset('assets/assets/pages/widget/amchart/light.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('assets/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('assets/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/assets/js/vartical-layout.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/pages/dashboard/analytic-dashboard.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/assets/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('pages/monitor.js') }}"></script>

    <script>
        function parallax_height() {
  var scroll_top = $(this).scrollTop();
  var sample_section_top = $(".sample-section").offset().top;
  var header_height = $(".sample-header-section").outerHeight();
  $(".sample-section").css({ "margin-top": header_height });
  $(".sample-header").css({ height: header_height - scroll_top });
}
parallax_height();
$(window).scroll(function() {
  parallax_height();
});
$(window).resize(function() {
  parallax_height();
});
    </script>

  </body>
</html>
