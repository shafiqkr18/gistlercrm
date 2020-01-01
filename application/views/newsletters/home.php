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
    <link href="<?php echo base_url()?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>css/bootstrap-datetimepicker.css" rel="stylesheet">
    
    <!-- UI CSS -->
    <link href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>css/main.css" rel="stylesheet">
    
    <!-- Custom UI CSS -->
    <link href="<?php echo base_url()?>css/ui.css" rel="stylesheet">
    
    <!-- left menu -->
    <link href="<?php echo base_url()?>css/left_menu.css" rel="stylesheet">
    
    <!-- Listing -->
	<link href="<?php echo base_url()?>css/listing.css" rel="stylesheet">
    
    <!-- Data tables -->
	<link href="<?php echo base_url()?>css/dataTables.bootstrap.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="<?php echo base_url()?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Zaheer Ahmad CSS -->
    <link href="<?php echo base_url()?>css/dev.css ?=1" rel="stylesheet" type="text/css">
 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<!-- jQuery -->
    <script src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/moment.min.js"></script> 
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
  <!-- Data Tables JavaScript -->
  <script src="<?php echo base_url()?>js/plugins/dataTables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url()?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url()?>js/jquery.bootstrap.wizard.min.js"></script>      

      <script src="<?php echo site_url();?>js/bootstrap-datetimepicker.min.js"></script>
      
        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    
    <script type="text/javascript" src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
    <script>tinymce.init({ 
        selector:'#description_demo',
        menubar: false,
        resize: false,
        width : 600,
        height: 200,
        editor_selector : "mceEditor"
    });</script>    

    <!-- Left menu JavaScript -->
    <script src="<?php echo base_url()?>js/classie.js"></script>
    <!--<script src="<?php echo base_url()?>js/gnmenu.js"></script>
	<script>
		new gnMenu( document.getElementById( 'gn-menu' ) );
	</script> -->

    <script src="<?php echo base_url()?>js_module/newsletters.js"></script>

    <!-- Page Scrolling Js -->
    <script src="<?php echo base_url()?>js/page-scrolling.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.fadeInUp').addClass("hidden").viewportChecker({
            classToAdd: 'visible animated fadeInUp', // Class to add to the elements when they are visible
            offset: 100    
           });   
    });            
    </script>
    <script src="<?php echo base_url()?>js/dev.js"></script>
    
    
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
    
    <!-- Data tables -->
	<script>
    $(document).ready(function() {
    $('#dataTables-current-listing').DataTable({
      "bFilter": false,
      "dom": '<"top">rt<"bottom"iflp><"clear">'
    });
    $('#dataTables-current-listing').prev().addClass('fixedpagination-top');
    $('#dataTables-current-listing').next().addClass('fixedpagination-bottom');
    } );
    </script>
    
    
    <!-- Dropdown Search -->
	<script type="text/javascript">
        $('.dropdown-menu input, .dropdown-menu label').click(function(e) {
            e.stopPropagation();
        });

        // wizard 
        $(document).ready(function() {
    $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index+1;
        var $percent = ($current/$total) * 100;
        $('#rootwizard').find('.bar').css({width:$percent+'%'});
    }});
});
    </script>
    <script>
$("#changeTemp").on("change", function() {
    alert('ho');
    id = "related_" + $(this).val();
    $("#" + id).show().siblings().hide()
})
</script>

</head>

<body>
    
        
            <div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-file-text-o"></i> News Letter</h1></div>
                </div>
            </div>
                        
            
            <div id="inner_tab">
            
            <div class="row fadeInUp">
            <div class="col-lg-12">
            

            
            
            <!-- Tab content -->
            <div class="tab-content">
            	
            	<div class="row"><h4 class="add_new_rental">Create News Letter</h4></div>

                <div id="rootwizard">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <div class="container">
                            <ul>
                                <li><a href="#tab1" data-toggle="tab">Listing</a></li>
                                <li><a href="#tab2" data-toggle="tab">Users</a></li>
                                <li><a href="#tab3" data-toggle="tab">News Letter</a></li>
                                <li><a href="#tab4" data-toggle="tab">Send</a></li>
                            </ul>
                        </div>
                      </div>
                    </div>
                    <div id="bar" class="progress">
                        <div class="progress-bar progress-bar-striped active bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" ></div>
                    </div>
                    <ul class="pager wizard">
                            <li class="previous first" ><a href="javascript:void(0)">First</a></li>
                            <li class="previous"><a href="javascript:void(0)">Previous</a></li>
                            <li class="next last" ><a href="javascript:void(0)">Last</a></li>
                            <li class="next"><a href="javascript:void(0)">Next</a></li>
                        </ul>
                        <hr>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <div class="row">
                                
                                <div class="col-md-16" id='rgroup_listingtype'>
                                    <div class="row">
                                    <div class="col-md-2">
                                        <label><h5 class="text-primary">Listing Type</h5> </label>
                                    </div>                                  
                                    <div class="col-md-2"> 
                                        <label>
                                            <input type="radio" name="listtype" value='0' class="ListingType" checked>
                                            <span class="lbl padding">Both</span>
                                        </label>
                                     </div>
                                    <div class="col-md-2"> 
                                        <label>
                                            <input type="radio" name="listtype" value='1' class="ListingType">
                                            <span class="lbl padding">Rentals</span>
                                        </label>
                                     </div>                                     
                                     <div class="col-md-2"> 
                                        <label>
                                            <input type="radio" name="listtype" value='2' class="ListingType">
                                            <span class="lbl padding">Sales</span>
                                        </label>
                                     </div>
                                    </div>
                                </div>
                                
                            </div>
                            <hr>
                            <div class="row">

                                <div style="display:float; padding-left: 73%"> <input style="width:300px" 
                                    class="form-control input-sm search_init" type='text' id='txtSmartSearch' 
                                    placeholder="Search here"/> </div>

                                <table aria-describedby="dataTables-current-listing_info" class=
                                "table table-striped table-hover datatables datatable-setbotclass dataTable no-footer"
                                id="listings_row">
                                    <thead class="listing_headings">
                                        <tr>
                                            <th><label class=""><input id='CheckAllListings' class='CheckAll' onclick="toggleChecked()" type="checkbox" value=''>
                                            <span class="lbl"></span></label></th>
                                            <!--         <th><div style="cursor:pointer;min-width: 8px;" title="Click here to sort"></div></th>
                                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Status</div></th>
                                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Managed</div><span>M</span></th>
                                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Exclusive</div><span>E</span></th>
                                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Shared</div><span>S</span></th> -->
                                            <th>
                                                <div style="cursor:pointer;min-width:50px;" title=
                                                "Click here to sort">
                                                    Type
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer;min-width:50px;" title=
                                                "Click here to sort">
                                                    Ref
                                                </div>
                                            </th>                                            
                                            <th>
                                                <div style="cursor:pointer;" title="Click here to sort">
                                                    Unit
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer;" title="Click here to sort">
                                                    Category
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer;" title="Click here to sort">
                                                    Emirate
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer; white-space:nowrap;" title=
                                                "Click here to sort">
                                                    Location
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer; white-space:nowrap;" title=
                                                "Click here to sort">
                                                    Sub-Location
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer;" title="Click here to sort">
                                                    Beds
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer;" title="Click here to sort">
                                                    BUA
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer;" title="Click here to sort">
                                                    Price
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer;" title="Click here to sort">
                                                    Agent
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer;" title="Click here to sort">
                                                    Owner
                                                </div>
                                            </th>
                                            <!-- <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Type</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Baths</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Street</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Floor</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">DEWA</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Photos</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Cheques</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Fitted</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Property Status</div></th>
                                    <th type="not_default" style="min-width:90px !important;"><div style="cursor:pointer;" title="Click here to sort">Listing Source</div></th>
                                    <th type="not_default" style="min-width:90px !important;"><div style="cursor:pointer;" title="Click here to sort">Date Available</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Remind</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Furnished</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Featured</div></th>
                                    <th type="not_default" style="min-width:100px !important;"><div style="cursor:pointer;" title="Click here to sort">Maintanance Fee</div></th>
                                    <th type="not_default" style="min-width:70px !important;"><div style="cursor:pointer;" title="Click here to sort">STR</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Amount</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Tenanted</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Plot Size</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Name</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">View</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Commission</div></th>
                                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Deposit</div></th>
                                    <th type="not_default"><div style="cursor:pointer; width:50px;" title="Click here to sort">Price / sq ft</div></th> -->
                                            <th>
                                                <div style="cursor:pointer; min-width:40px;" title=
                                                "Click here to sort">
                                                    Listed
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer; min-width:40px;" title=
                                                "Click here to sort">
                                                    Updated
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer; min-width:55px !important;"
                                                title="Click here to sort">
                                                    Created By
                                                </div>
                                            </th>
                                            <th>
                                                <div style="cursor:pointer; min-width:60px !important;"
                                                title="Click here to sort">
                                                    Key Location
                                                </div>
                                            </th>
                                            <!-- <th><div style="cursor:pointer; min-width:60px !important;" title="Click here to sort">Developer Unit</div></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="dataTables_empty" colspan="6">Loading data from
                                            server</td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row" id='rgroup_contacttype'>
                                        <div class="col-md-2">
                                            <label><h5 class="text-primary">Contact Type</h5> </label>
                                        </div>
                                        <div class="col-md-2"> 
                                            <label>
                                                <input type="radio" value='0' class="ContactType" name="usertype" checked>
                                                <span class="lbl padding">All</span>
                                            </label>
                                         </div>                                        
                                        <div class="col-md-2"> 
                                            <label>
                                                <input type="radio" value='1' class="ContactType" name="usertype">
                                                <span class="lbl padding">Tenant</span>
                                            </label>
                                         </div>
                                        <div class="col-md-2"> 
                                            <label>
                                                <input type="radio" value='2' class="ContactType" name="usertype">
                                                <span class="lbl padding">Buyer</span>
                                            </label>
                                         </div>                                         
                                         <div class="col-md-2"> 
                                            <label>
                                                <input type="radio" value='3' class="ContactType" name="usertype">
                                                <span class="lbl padding">Landloards</span>
                                            </label>
                                         </div>
                                         <div class="col-md-2"> 
                                            <label>
                                                <input type="radio" value='4' class="ContactType" name="usertype">
                                                <span class="lbl padding">Seller</span>
                                            </label>
                                         </div>
                                         <div class="col-md-2"> 
                                            <label>
                                                <input type="radio" value='5' class="ContactType" name="usertype">
                                                <span class="lbl padding">Landlord+Seller</span>
                                            </label>
                                         </div>
                                         <div class="col-md-2"> 
                                            <label>
                                                <input type="radio" value='6' class="ContactType" name="usertype">
                                                <span class="lbl padding">Rep. of Tenant</span>
                                            </label>
                                         </div>
                                         <div class="col-md-2"> 
                                            <label>
                                                <input type="radio" value='7' class="ContactType" name="usertype">
                                                <span class="lbl padding">Other</span>
                                            </label>
                                         </div>                                         
                                    </div>
                                </div>
                            </div>      
                            <hr>
                            <div class='row'>
                                <table class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer" 
                                id="contacts_row">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="">
                                                    <input onClick="toggleChecked()" id='CheckAllContacts' class='CheckAll' value='' type="checkbox"/>
                                                    <span class="lbl"></span>
                                                </label>
                                            </th>
                                            <th style="min-width:60px !important;">Contact Type</th>
                                            <th style="min-width:60px !important;">First Name</th>
                                            <th style="min-width:60px !important;">Last Name</th>
                                            <th type="not_default" style="min-width:60px !important;">Company</th>
                                            <th type="not_default" style="min-width:60px !important;">Work Phone</th>
                                            <th style="min-width:60px !important;">Personal Mobile</th>
                                            <th style="min-width:30px !important;">Personal Email</th>
                                            <th style="min-width:60px !important;">Created Date</th>
                                            <th style="min-width:60px !important;">Created By</th>
                                            <th style="width:1px !important;"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                    <td colspan="6" class="dataTables_empty">Loading data from server</td>
                                                </tr>
                                                    
                                                    </tbody>
                                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Select Template</label>
                                        <select  class=" form-control required input-sm" name="selTemp" id="selTemp">
                                        <option value="false">Select a template</option>
                                        <option value="0">Hippo</option>
                                        <option value="1">Cat</option>
                                        <option value="2">Dog</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input style="width:600px" class="form-control input-sm search_init" type='text' id='txtEmailTitle' 
                                    placeholder="TItle"/>
                                    <br/>
                                        <label>Email Body: </label>
                                        <textarea class="mceEditor" id="description_demo" name="description_demo"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="templatebox">
                                        Template Preview:
                                        <img id='0' style="max-width: 400px" src="https://i.imgur.com/5iXoAQJ.jpg">
                                        <img id='1' style="max-width: 400px" src="https://i.imgur.com/Cjn6NfS.jpg">
                                        <img id='2' style="max-width: 400px" src="https://i.imgur.com/Kz5vQeb.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <div class="row">
                                <a id='aSendNewsletter' class="btn btn-lg btn-success pull-left" href="#"> <i class="fa fa-eye"></i>  Send News Letter</a>
                            </div>
                        </div>
                        
                        
                    </div>  
                </div>
            
            </div>
            
            
            
            
            </div>
            </div>
            
            </div>
             
            </div>
            <!-- container end -->            
            </div>
			<!-- wrapper end -->
