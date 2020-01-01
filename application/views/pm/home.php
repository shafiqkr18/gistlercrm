<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>CRM - DUBAI</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    
    <!-- UI CSS -->
    <link href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
    
    <!-- UI CSS -->
    <link href="<?php echo base_url();?>css/ui.css" rel="stylesheet">
    
    <!-- left menu -->
    <link href="<?php echo base_url();?>css/left_menu.css" rel="stylesheet">

    <!-- Listing -->
    <link href="<?php echo base_url();?>css/listing.css" rel="stylesheet">
    
    <!-- Custom scroll bar -->
    <link href="<?php echo base_url();?>css/scrollbar.css" rel="stylesheet">

    <link href="<?php echo base_url();?>css/bootstrap-datetimepicker.min.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Zaheer Ahmad CSS -->
    <link href="<?php echo base_url();?>css/dev.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
    <script 
    src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js">
    </script>
    <script type="text/javascript" src="<?php echo base_url();?>js/moment.min.js"></script> 
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>

    <!-- High Charts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    

    <script src="<?php echo base_url();?>js/dev.js"></script>
    
    <!-- Left menu JavaScript -->
    <script src="<?php echo base_url();?>js/classie.js"></script>
    <!-- <script src="<?php echo base_url();?>js/gnmenu.js"></script> 
    <script>
        new gnMenu( document.getElementById( 'gn-menu' ) );
    </script>
    -->
    <script src="<?php echo base_url();?>js/bootstrap-datetimepicker.min.js"></script>

    <script src='http://fullcalendar.io/js/fullcalendar-2.4.0/lib/moment.min.js'></script>

    <!-- Left menu sub item open JavaScript -->
    <script type="text/javascript">

        
        $('#collapseExample').on('show.bs.collapse', function () {
                $("#agentparea").addClass('heightme110')
        });
        $('#collapseExample').on('hide.bs.collapse', function () {
                $("#agentparea").removeClass('heightme110')
        });
    
        
      $(document).ready(function(){
        $('#cssmenu > ul > li.sidebar_dropdown > a').click(function() {
      
        var checkElement = $(this).next();
        $('#cssmenu li.sidebar_dropdown').removeClass('active');
        $(this).closest('li.sidebar_dropdown').addClass('active'); 
      
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
          $(this).closest('li.sidebar_dropdown').removeClass('active');
          checkElement.slideUp('fast');
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
          $('#cssmenu ul ul:visible').slideUp('fast');
          checkElement.slideDown('fast');
        }
      
        if($(this).closest('li').find('ul').children().length == 0) {
          return true;
        } else {
          return false; 
        }
      });
      });
    </script>
<!-- Page Scrolling Js -->
<script src="js/page-scrolling.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
    jQuery('.fadeInUp').addClass("hidden").viewportChecker({
    classToAdd: 'visible animated fadeInUp', // Class to add to the elements when they are visible
    offset: 100    
           });   
});            
</script>


        
     <!-- Top phone popover -->
    <script>
    $(function () {
      $('[data-toggle="popover"]').popover()
    })

    </script>
</head>

<body class="dashboard">
        
        
        <div id="wrapper">
        
            <div class="container">
           		<!-- Page Heading -->
                <div class="row">
                    <div class="col-md-10">
                        <div class="page_head_area">
                        	<h1><i class="fa fa fa-home"></i> Property Management	</h1>
                        	<h3 class="gist-secondhead">Dashboard</h3>                
                        </div>
                    </div>                    
                </div>
                <div class="row">
	                <div class="col-md-9">
		              
		              </div>
		              <div class="col-md-3">
		            	
		              </div>
	              </div>
	            <div class="row fadeInUp">
	            <div id="sortable" class="ui-sortable ui-droppable">
	            	<div class="col-md-6 ">
	              
	              </div>
                <div class="col-md-6 ">
                
                </div>
            
                
	            </div>
	            </div>

            </div>
            


            </div>
            <!-- container end -->
            
            
            </div>
			<!-- wrapper end -->