<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GISTLER CRM</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/bootstrap-datetimepicker.css" rel="stylesheet">
    
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

    <!-- Zaheer Ahmad CSS -->
    <link href="<?php echo base_url(); ?>css/dev.css ?=1" rel="stylesheet" type="text/css">
    
    <link href="<?php echo base_url(); ?>css/step_wizard.css" rel="stylesheet" type="text/css">
 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>js/jquery-1.10.2.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.js"></script>
    
    <!-- Data Tables JavaScript -->
    <script src="<?php echo base_url(); ?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- High Charts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    
    <!-- Left menu JavaScript -->
    <script src="<?php echo base_url(); ?>js/classie.js"></script>
    <script src="<?php echo base_url(); ?>js/gnmenu.js"></script>
	<script>
		new gnMenu( document.getElementById( 'gn-menu' ) );
	</script>
    
    <!-- Left menu sub item open JavaScript -->
	<script type="text/javascript">
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
    <script src="js/dev.js"></script>
    
    
    <!-- popover -->
    <script>
	$(function () {
	  $( "[data-toggle='popover']" ).popover( {container: 'body', html: 'true', trigger: 'hover'} );
	})
    </script>
    
    <!-- Tooltip -->
    <script>
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
    </script>
    

    
    
    <!-- Dropdown Search -->
	<script type="text/javascript">
        $('.dropdown-menu input, .dropdown-menu label').click(function(e) {
            e.stopPropagation();
        });
    </script>
    
    
	<script type="text/javascript" src="js/jquery.setpwizard.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // Smart Wizard 	
            $('#wizard').smartWizard();
          
          function onFinishCallback(){
            $('#wizard').smartWizard('showMessage','Finish Clicked');
          }     
            });
    </script>
    
    
    
    

</head>

<body class="dashboard">
  <div id="abc"></div>
      <nav class="menu push-menu-left myrentalmenu_crm">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                       <i class="fa fa-home"></i> <span>Main Menu</span>
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <div id='cssmenu'>
                        <ul>
                          <li class="active"><a href='#'> <i class="fa fa-home fa-fw"></i> <span>Dashboard</span></a></li>
                          <li class="sidebar_dropdown"><a href='#'> <i class="fa fa-list fa-fw"></i> <span>Listing</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='#'><span>Rentals</span></a></li>
                              <li class=""><a href='#'><span>Sales</span></a></li>
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-suitcase fa-fw"></i> <span>Prospects</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='#'><span>Contacts</span></a></li>
                              <li class=""><a href='#'><span>Leads</span></a></li>
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-cogs fa-fw"></i> <span>Work</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='#'><span>Deals</span></a></li>
                              <li class=""><a href='#'><span>Calendar</span></a></li>
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-sitemap fa-fw"></i> <span>Marketing</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='#'><span>Newsletters</span></a></li>
                              <li class=""><a href='#'><span>CMA</span></a></li>
                              <li class=""><a href='#'><span>SMS</span></a></li>
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-lock fa-fw"></i> <span>Administration</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='#'><span>Portals</span></a></li>
                              <li class=""><a href='#'><span>Users</span></a></li>
                              <li class=""><a href='#'><span>Profile</span></a></li>
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-bar-chart-o fa-fw"></i> <span>Analytics</span></a>
                            <ul style="display:none;">
                              <li class=""><a href='#'><span>History</span></a></li>
                              <li class=""><a href='#'><span>Reports</span></a></li>
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "> <a href='#'> <i class="fa fa-cloud fa-fw"></i> <span>Company</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='#'><span>Noticeboard</span></a></li>
                              
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "> <a href='#'> <i class="fa fa-plus fa-fw"></i> <span>More</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='#'><span>Forms</span></a></li>
                              <li class=""><a href='#'><span>FAQ</span></a></li>
                            </ul>
                          </li>
                        </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default orangesection">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <i class="fa fa-file-text"></i> <span>Reporting Menu</span>
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                    <div id='cssmenu'>
                        <ul>
                          <li class="active"><a href='report-dashboard.html'> <i class="fa fa-bar-chart fa-fw"></i> <span>Dashboard</span></a></li>
                          <li class="sidebar_dropdown"><a href='#'> <i class="fa fa-home fa-fw"></i> <span>Listings Reports</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='report-category.html'><span>By Listing Type & Category</span></a></li>
                              <li class=""><a href='report-location.html'><span>By Listing Type & Location</span></a></li>
                              <li class=""><a href='report-status.html'><span>By Status</span></a></li>
                              <li class=""><a href='report-view-listing.html'><span>Listing Viewings Report</span></a></li>
                              <li class=""><a href='report-saved-listing.html'><span>My Saved Reports</span></a></li>
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-crosshairs fa-fw"></i> <span>Leads Reports</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='report-view-leads.html'><span>Lead Viewings Report</span></a></li>
                              <li class=""><a href='report-lead-type.html'><span>By Lead Type</span></a></li>
                              <li class=""><a href='report-lead-hot.html'><span>Hot Leads</span></a></li>
                              <li class=""><a href='report-lead-source.html'><span>By Source</span></a></li>
                              <li class=""><a href='report-lead-pipeline.html'><span>Opportunity Pipeline</span></a></li>
                              <li class=""><a href='report-lead-stuck.html'><span>Stuck Opportunities</span></a></li>
                              <li class=""><a href='report-saved-lead.html'><span>My Saved Reports</span></a></li>
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-file-text fa-fw"></i> <span>Deals Reports</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='report-status-deals.html'><span>By Deal Type & Status</span></a></li>
                              <li class=""><a href='report-deals-success.html'><span>Successful Deals</span></a></li>
                              <li class=""><a href='report-saved-deals.html'><span>My Saved Reports</span></a></li>
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-group fa-fw"></i> <span>Contacts Reports</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='#'><span>My Saved Reports</span></a></li>
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-calendar-check-o fa-fw"></i> <span>To-Do Tasks Reports</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='to-do-task.html'><span>To-Do Tasks</span></a></li>
                              <li class=""><a href='report-saved.html'><span>My Saved Reports</span></a></li>
                            </ul>
                          </li>
                          <li class="sidebar_dropdown "><a href='agent-leaderboard.html'> <i class="fa fa-calendar-check-o fa-fw"></i> <span>Agent Leaderboard</span></a>
                            
                          </li>
                          <!-- <li class="sidebar_dropdown "><a href='#'> <i class="fa fa-bar-chart-o fa-fw"></i> <span>Analytics</span></a>
                            <ul style="display:none;">
                              <li class=""><a href='#'><span>History</span></a></li>
                              <li class=""><a href='#'><span>Reports</span></a></li>
                            </ul>
                          </li> -->
                          <!-- <li class="sidebar_dropdown "> <a href='#'> <i class="fa fa-cloud fa-fw"></i> <span>Company</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='#'><span>Noticeboard</span></a></li>
                              
                            </ul>
                          </li> -->
                          <!-- <li class="sidebar_dropdown "> <a href='#'> <i class="fa fa-plus fa-fw"></i> <span>More</span></a>
                            <ul style="display:none;" >
                              <li class=""><a href='#'><span>Forms</span></a></li>
                              <li class=""><a href='#'><span>FAQ</span></a></li>
                            </ul>
                          </li> -->
                        </ul>
                    </div>
                  </div>
                </div>
              </div>
    
          </div>

        </nav>
        

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container">
            <div class="navbar-header">
                <a class="logo" href="index.html">Admin</a>
            </div>
            
            <!-- Top Menu Items -->
            
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle notification" data-toggle="dropdown">
                    <i class="fa fa-lg fa-bell"></i><span class="badge">2</span><b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                   
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="expand_full"><i class="fa fa-lg fa-expand"></i></a>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="user_img"><img src="images/avatar.jpg" alt=""></span> John Smith 
                    <b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
                
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            <ul class="pull-right notification_nav">
            <li>
            <a href="#" data-trigger="hover" data-toggle="popover" data-container="body" data-placement="bottom" data-content="Call for support: +971 000 000">
            <i class="fa fa-2x fa-phone"></i>
            </a></li>
            
            <li><a href="#"><i class="fa fa-2x fa-comment"></i></a></li>
            <li><a href="#"><i class="fa fa-2x fa-question-circle"></i></a></li>
            </ul>
            
            <!-- /.navbar-collapse -->
            </div>
        </nav>
        
        
            <div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-pie-chart"></i> Report</h1></div>
                </div>
            </div>
            
            
            <!-- Smart Wizard -->
            
            <div class="report_builder">
            <h3 class="text-success">Create Custom Report</h3>    
            <div id="wizard" class="swMain">
  			<ul>
  				<li>
                <a href="#step-1">
                <span class="large">Step 1</span>
                <span class="small">Select Module</span>
                </a>
                </li>
                <li>
                <a href="#step-2">
                <span class="large">Step 2</span>
                <span class="small">Create Sub Group</span>
                </a>
                </li>
                <li>
                <a href="#step-3">
                <span class="large">Step 3</span>
                <span class="small">Select Filter</span>
                </a>
                </li>
                <li>
                <a href="#step-4">
                <span class="large">Step 4</span>
                <span class="small">Done</span>
                </a>
                </li>
  				
  			</ul>
  			<div id="step-1">
            <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                      <div class="text-center">
                      <h4 class="text-primary">Step 1: Select Module</h4>
                      <p>Select a module or group of your choice</p>
                      </div>
                         <div class="form-group">
                                <label>Select Module</label>
                                <select class="form-control input-sm ">
                                <option>Please select</option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                                <option>Ketchup</option>
                                </select>
                          </div>
                          <div class="form-group">
                                <label>Select Default Group</label>
                                <select class="form-control input-sm ">
                                <option>Please select</option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                                <option>Ketchup</option>
                                </select>
                          </div>
                        
                    </div>
                </div>
            </div>
            
  			<div id="step-2">
            
            <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                      <div class="text-center">
                      <h4 class="text-primary">Step 2: Create Sub Group</h4>
                      <p>Create sub group of your choice</p>
                      </div>
                      <h5>Grouped By</h5>
                      <p>Location</p>
                        <div class="form-inline add-sub-group">
                            <label><strong>Sub Grouped By</strong></label>
                            <button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Add sub-group</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Apply</button>
                        </div>
                    </div>
             </div>
            </div>              
                                
  			<div id="step-3">
            <div class="row">
                    <div class="col-md-12">
                      <div class="text-center">
                      <h4 class="text-primary">Step 3: Select Filter</h4>
                      <p>Add filter of your choice</p>
                      </div>
                      
                      <div class="row">
                      <div class="col-md-10 col-md-offset-1">
                      
                      <form>
                        <div class="row">
                        <div class="col-sm-2">
                          <h4>Filter</h4>
                        </div>
                        <div class="col-sm-3">
                              <select class="form-control input-sm">
                                <option>Please select</option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                                <option>Ketchup</option>
                                </select>
                        </div> 
                        <div class="col-sm-3">
                              <select class="form-control input-sm">
                                <option>Please select</option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                                <option>Ketchup</option>
                                </select>
                         </div>
                         <div class="col-sm-3">
                              <input type="text" class="form-control input-sm">
                         </div>
                         <div class="col-sm-1">
                          <a href="" class="text-danger"><i class="fa fa-2x fa-trash"></i></a>
                        </div>
                        </div>
                        </form>
                      <a href="" class="text-primary add-filter-link"><i class="fa fa-plus"></i> Add Another Filter</a>  
                      </div>
                      </div>
                      
                                              
                        <div class="row">
                         <div class="col-md-4 col-md-offset-4">
                        <a href="" class="btn btn-danger btn-block btn-lg refresh-btn"><i class="fa fa-refresh"></i> Refresh</a>
                        </div>
                        </div>
                      
                    </div>
               </div>
            </div>
            
  			<div id="step-4">
            <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                    
                       <!-- Success Message Alert -->
                        <div role="alert" class="alert alert-success alert-dismissible fade in">
                          <button aria-label="Close" data-dismiss="alert" class="close" type="button">
                          <span aria-hidden="true">×</span></button>
                          <strong>Well done!</strong> You successfully add the report.
                        </div>
                      
                      
                    </div>
                 </div>
            </div>
  		</div>
        </div>
        
<!-- End SmartWizard Content -->
                         
             
            <div class="row">
            <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive report-builder-table-color">
              <table class="table table-striped datatables table-bordered table-hover">
              <thead>
                <tr>
                <th></th>
                <th>Location</th>
                <th>Number of Leads <i class="fa fa-arrow-down"></i></th>
                <th>Distribution of Leads</th>
                </tr>
                </thead>
                
                <tbody>
                <tr>
                <td align="center"><span class="green"></span></td>
                <td>jumerira tower</td>
                <td>7</td>
                <td>100.00%</td>
                </tr>
                <tr>
                <td align="center"><span class="blue"></span></td>
                <td>jumerira tower</td>
                <td>7</td>
                <td>100.00%</td>
                </tr>
                <tr>
                <td align="center"><span class="orange"></span></td>
                <td>jumerira tower</td>
                <td>7</td>
                <td>100.00%</td>
                </tr>
                <tr>
                <td align="center"><span class="purple"></span></td>
                <td>jumerira tower</td>
                <td>7</td>
                <td>100.00%</td>
                </tr>
                <tr>
                <td align="center"><span class="cyan"></span></td>
                <td>jumerira tower</td>
                <td>7</td>
                <td>100.00%</td>
                </tr>

                </tbody>
                </table>
            </div>
            </div>
            </div>
            
            
            
            <div class="row text-center">
            <div class="col-md-6 col-md-offset-3">
            <h4>Distributions of Leads</h4>
            
              <div id="piechartview" class="tab-pane active" role="tabpanel">
                              <div id="piechart1" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                            </div>
            
            </div>
            </div>
             
             
                
              
            </div>
            <!-- container end -->            
            </div>
			<!-- wrapper end -->
            
            
           
            
            <div class="footer">
            <p class="copyright_txt text-center">© Gistler 2015 www.gistler.com. All rights reserved.</p>
            </div>
            


</body>
</html>
