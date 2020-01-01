<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
      <?php echo $title; ?>
    </title>
    <script type="text/javascript">
      var arr_images = [];
      var arr_notes = [];
      var mainurl = "<?php echo site_url(); ?>";
      var admid = "<?php echo $userid; ?>";
      var config = {
        baseUrl: "<?php echo base_url(); ?>",
        siteUrl: "<?php echo site_url(); ?>",
        user: {
          userid: "<?php echo $userid; ?>",
          username: "<?php echo $username; ?>",
          accessLevel: "<?php echo $user_type; ?>",
          user_access: "<?php echo $user_type; ?>"
        }
      };

    </script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/bootstrap-select.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- UI CSS -->
    <link href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet">

    <!-- Custom UI CSS -->
    <link href="<?php echo base_url(); ?>css/ui.css" rel="stylesheet">

    <!-- left menu -->
    <link href="<?php echo base_url(); ?>css/left_menu.css" rel="stylesheet">

    <!-- Listing -->
    <link href="<?php echo base_url(); ?>css/listing.css" rel="stylesheet">

    <!-- Data tables -->
    <link href="<?php echo base_url(); ?>css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- dev user1 -->
    <link href="<?php echo base_url(); ?>css/dev.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/moment.min.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-select.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.min.js"></script>

    <!-- Data Tables JavaScript -->
    <script src="<?php echo base_url(); ?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.validate.js?ts=1384257869"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.form.js?ts=1384257869"></script>
    <script src="<?php echo base_url(); ?>js_module/jquery.numeric.js"></script>
    <!-- dev work start from here 18-02-2016 -->
    <script src="<?php echo base_url(); ?>js/jquery.easypiechart.min.js"></script>
    <!-- dev work end from here 18-02-2016 -->

    <!-- High Charts -->
   <!--  <script src="https://code.highcharts.com/highcharts.js"></script> -->

    <script src="<?php echo site_url();?>js/bootstrap-datetimepicker.min.js"></script>

    <!-- Boot box -->
    <script src="<?php echo base_url(); ?>js_module/bootbox.min.js"></script>

    <!-- Left menu JavaScript -->
    <script src="<?php echo base_url(); ?>js/classie.js"></script>
    <?php /*?>
      <script src="<?php echo base_url(); ?>js/gnmenu.js"></script>
      <?php */?>
        <script>
          //my comments for time being
          // new gnMenu( document.getElementById( 'gn-menu' ) );

        </script>

        <!-- Left menu sub item open JavaScript -->
        <script type="text/javascript">
          $(document).ready(function() {
            $('#cssmenu > ul > li.sidebar_dropdown > a').click(function() {

              var checkElement = $(this).next();
              $('#cssmenu li.sidebar_dropdown').removeClass('active');
              $(this).closest('li.sidebar_dropdown').addClass('active');

              if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                $(this).closest('li.sidebar_dropdown').removeClass('active');
                checkElement.slideUp('fast');
              }
              if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                $('#cssmenu ul ul:visible').slideUp('fast');
                checkElement.slideDown('fast');
              }

              if ($(this).closest('li').find('ul').children().length == 0) {
                return true;
              } else {
                return false;
              }
            });
          });

        </script>


        <!-- Page Scrolling Js -->
        <script src="<?php echo base_url(); ?>js/page-scrolling.js"></script>
        <script type="text/javascript">
          jQuery(document).ready(function() {
            jQuery('.fadeInUp').addClass("hidden").viewportChecker({
              classToAdd: 'visible animated fadeInUp', // Class to add to the elements when they are visible
              offset: 100
            });
          });

        </script>
        <script src="<?php echo base_url(); ?>js/dev.js"></script>


        <!-- popover -->
        <script>
          $(function() {
            $("[data-toggle='popover']").popover({
              container: 'body',
              html: 'true',
              trigger: 'hover'
            });
          })

        </script>



        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


        <!-- Tooltip -->
        <script>
          $(function() {
            $('[data-toggle="tooltip"]').tooltip()
          })
          $(function() {
            $('.daterangepicker').daterangepicker();
          });

          $(function() {
            $('#datepcikrange').daterangepicker();
          });

        </script>


        <!-- Dropdown Search -->
        <script type="text/javascript">
          $(document).ready(function() {
            $('.dropdown-menu input, .dropdown-menu label').click(function(e) {
              e.stopPropagation();
            });
          })

        </script>

    <style type="text/css">
    .gist-leasetabs .panel-body {
    max-height: 300px;
    min-height: 305px;
    margin-bottom: 0;
    padding-bottom: 0;
    }

    .panel.panel-default.gist-formsmartpanel.gist-leasetabs {
    margin-bottom: 0;
    height: 350px;
    }

    </style>


  </head>

  <body>