<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Gistler- CRM</title>
      <script>
         var site_url = '<?php echo site_url(); ?>';
         
         var config = {
         
                          baseUrl: "<?php echo base_url(); ?>",
         
                siteUrl: "<?php echo site_url(); ?>",
         
                          user: {
         
                              userid: "<?php echo $userid; ?>", 
         
                    username: "<?php echo $username; ?>",
         
                    accessLevel: "<?php echo $user_type; ?>",
         
                    user_access :  "<?php echo $user_type; ?>"               
         
                      }
         
                      };
         
      </script>
      <!-- Bootstrap Core CSS -->
      <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
      <!-- UI CSS -->
      <link href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
      <link href='http://fullcalendar.io/js/fullcalendar-2.4.0/fullcalendar.css' rel='stylesheet' />
      <link href='http://fullcalendar.io/js/fullcalendar-2.4.0/fullcalendar.print.css' rel='stylesheet' media='print' />
      <!-- Custom CSS -->
      <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet">
      <!-- UI CSS -->
      <link href="<?php echo base_url(); ?>css/ui.css" rel="stylesheet">
      <!-- left menu -->
      <link href="<?php echo base_url(); ?>css/left_menu.css" rel="stylesheet">
      <!-- Custom scroll bar -->
      <link href="<?php echo base_url(); ?>css/scrollbar.css" rel="stylesheet">
      <!-- Custom Fonts -->
      <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- Zaheer Ahmad CSS -->
      <link href="<?php echo base_url(); ?>css/dev.css" rel="stylesheet" type="text/css">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- jQuery -->
      <script src="<?php echo base_url(); ?>js/jquery-1.10.2.js"></script>
      <script 
         src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>js/moment.min.js"></script> 
      <!-- Bootstrap Core JavaScript -->
      <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>js/bootstrap-select.js"></script>
      <script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.min.js"></script>

    <!-- Boot box -->
    <script src="<?php echo base_url(); ?>js_module/bootbox.min.js"></script>

   </head>
   <body>
