<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsqTry_Lx1DVar-p18jpF5p-IGCgodtoU&sensor=false"></script>
   
<script type="text/javascript">
    
var screenname = 'quality_score';     
var marker = null;
var map = null;
var oTable;
var pageTitle = '<?php echo $title;?>';
var last_id = '';

    var active_tab = 'tab2';
    var migrated   ='';
    /* Datatable initilization */
    var unitTemp;
    var category_idTemp;
    var region_idTemp;
    var area_location_idTemp;
    var sub_area_location_idTemp;
    var street_noTemp;
    var migrated_rental = '';
    var migrated_sales = '';
$(document).ready( function(e) {
    showMap();
} );

$(document).ready(function(){
	
	   var oTable_quality =   $('#listings_quality_table').dataTable( {
            "bProcessing": true,
            "sDom": 'R<>rt<ilp><"clear">',
            "bFilter": true,
           "aoColumnDefs": [ 
                {
                       'render': function (data, type, full, meta){
                        //check the main check box
                        $('#check_all_checkboxes').attr('checked', false);
                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
                    },
                    "aTargets": [ 0 ]
                },
                { "bSortable": false, "aTargets": [ 0 ] }
            ],

            "aaSorting" : [[ 9, 'desc' ]],
            "iDisplayLength": 25,
            "bServerSide": true,
            "rowCallback": function( row, data ) {
				 $(row).attr("id",data.id);
				  return row;
        			},
        			 "aoColumns": [
			{ "mDataProp": "id" },
            { "mDataProp": "status" },
			{ "mDataProp": "ref" },
			{ "mDataProp": "category" },
			{ "mDataProp": "region_id" },
			{ "mDataProp": "area_location_id" },
            { "mDataProp": "sub_area_location_id" },
            { "mDataProp": "beds" },
            { "mDataProp": "agent_id" },
            { "mDataProp": "dateupdated" },
            { "mDataProp": "overall_score" },
			{ "mDataProp": "media_score" },
			{ "mDataProp": "address_score" },
			{ "mDataProp": "description_score" },
			{ "mDataProp": "price_score" },
            { "mDataProp": "beds_baths_score" },
            { "mDataProp": "facilities_score" }
            ],
            "sAjaxSource": "<?php echo base_url();?>listings/datatable_quality?type=rentals",
            "iDisplayStart": 0,
            "sPaginationType": "full_numbers",
            'fnServerData': function (url, data, callback){ 
                $.ajax
              ({
                           "dataType": 'json', 
                           "type": "POST", 
                           "url": url, 
                           "data": data, 
                           "success": function(json) {
                               callback(json);
                            

                       }
                       });

            }

        } );
	
})
</script>




<div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-home"></i> Rentals</h1></div>
                </div>
            </div>
            

            <!-- Error Message Alert -->
             <div role="alert" class="alert alert-danger alert-dismissible fade in" id="errorMsg" style="display:none;">
              <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
              <strong>Error!</strong> <span id="errortxt">here is error text</span> 
            </div> 
            
            <!-- Success Message Alert -->
             <div role="alert" class="alert alert-success alert-dismissible fade in" id="successMsg" style="display:none;">
              <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
              <strong>Success!</strong> <span id="successtxt">here is success text</span>  
            </div> 
            
            <!-- Info Message Alert -->
             <div role="alert" class="alert alert-info alert-dismissible fade in" id="infoMsg" style="display:none;">
              <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
              <strong>Info!</strong> <span id="infotxt">here is error text</span>  
            </div> 
            
            
            
            
            <div id="inner_tab">
            
            
            <div class="row">
            <div class="col-lg-12">
            <!-- Nav tabs -->
            <div class="inner_tab_nav">
                <ul class="nav nav-tabs">
                    <li  class="active"><a href="<?php echo site_url('listings/rentals');?>">United Arab Emirates</a></li>
                    <!-- <li><a href="<?php echo site_url('international-rentals');?>">International</a></li> -->
                    <li><a href="<?php echo site_url('listings/locations-text-rentals');?>">Location Text</a></li>
                    <li><a href="<?php echo site_url('listings/price-index-rentals');?>">Rental Price Index</a></li>
                </ul>
            </div>
            
                    
            <!-- Tab content -->
            
         <!-- For common use we keep entry form section as partial view to include all over as that i same -->
            
            <?php echo $formDataArchived;?>
            <!-- uae tab content end -->    
            </div>
            </div>
            
            
            
            <div class="row fadeInUp">
            <div class="col-lg-12">
            <div class="inner_tab_nav">
                <ul class="nav nav-tabs">
                    <li ><a href="<?php echo site_url('listings/rentals');?>" >Current Listings</a></li>
                    <li ><a href="<?php echo site_url('listings/archived-rentals');?>">Archived Listings</a></li>
                    <li class="active"><a href="<?php echo site_url('listings/listings_quality');?>">Listings Quality</a></li>
                    
                </ul>
            </div>
            




<!--  start listings -->
  <!-- dev work start from here 18-02-2016 -->
    <!-- High Charts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="<?php echo base_url();?>js_module/quality-score.js"></script>
    <!-- dev work end from here 18-02-2016 -->
     <script>
                $(function(){
                                        aggregate_scores = [{"title":"Overall Listing Quality","value":76},{"title":"Media","value":64},{"title":"Address","value":100},{"title":"Title & Description","value":73},{"title":"Price","value":95},{"title":"Additional Info","value":57},{"title":"Facilities","value":79}];
                                                            distribution = [0,0,1,47,21];
                                        renderDistribution(distribution);
                    if(aggregate_scores) {
                        renderQualityMeter('aggregate-score-gauge', aggregate_scores[0].value);
                    }
                });
            </script>
            <div class="tab-content">
            
            <p>The Listing Quality tab provides in-depth insights into the quality of your published listings, and recommends ways to improve them. This tool will measure multiple metrics in your listings to assign a quality score based on the listing information you have entered. A listing with a high score is more likely to deliver additional leads, and in turn more business for your company. </p>
           <!-- dev work start from here 18-02-2016 -->
            <div class="col-md-4">
              <hr>
              <h4 class="text-center">Agent Performance</h3>
              <div class="table-responsive">
                        <table class="table table-striped leader_board">
                          <thead>
                            <tr>
                              <th>Agent</th>
                              <th>No. of listings</th>
                              <th>Overall Quality(%)</th>
                            </tr>
                          </thead>
                          <tbody>
                          	<?php
                          	foreach($agent_performance as $listing){?>
                            <tr>
                              <td><?php echo $listing['agent'];?></td>
                              <td class="text-center"><?php echo $listing['cnt'];?></td>
                              <td class="text-center text-success"><p><?php echo $listing['allscore'];?>%</p></td>
                            </tr>
                            <?php
							}?>
                          </tbody> 
                        </table>
                      </div>
            </div>
            <div class="col-md-4">
              <hr>
              <h4 class="text-center">Company's Listing Quality</h3>
               <!-- <div id="container-speed" style="width: 300px; height: 200px; float: left"></div> -->
               <div id="aggregate-score-gauge" style="width: 300px; height: 200px; float: left"></div>
            </div>
            <div class="col-md-4">
              <hr>
              <h4 class="text-center">Listing Quality Distribution</h3>
              <!-- <div id="agentLeadbord" style="min-width: 280px; height: 200px; margin: 0 auto">
                
              </div> -->
              <div id="quality-distribution-graph" style="min-width: 280px; height: 200px; margin: 0 auto">
                
              </div>
            </div>
            <div class="clear"></div>
            <hr>
            <!-- dev work end from here 18-02-2016 -->
            
            <table class="table table-striped table-bordered table-hover datatables" id="listings_quality_table">
                  <thead>
                  <tr>
                    <th>
                    <label class="">
                        <input type="checkbox"/>
                        <span class="lbl"></span>
                    </label>
                    </th>
                    <th></th>
                    <th>Ref</th>
                    <th>Category</th>
                    <th>Emirate</th>
                    <th>Location</th>
                    <th>Sub-Location</th>
                    <th>Beds</th>
                    <th>Agent</th>
                    <th>Updated</th>
                    <th>Overall Quality (%)</th>
                    <th>Media Quality (%)</th>
                    <th>Address Quality (%)</th>
                    <th>Title & Desc. Quality (%)</th>
                    <th>Price Quality (%)</th>
                    <th>Additional Info Quality (%)</th>
                    <th>Facilities Quality (%)</th>

                    </tr>
                    </thead>
                    
                      <thead id="searchbox">
 
                    <tr class="highlighted search_box">
                    <td></td>
                    <td><a href=""><i class="fa fa-arrow-down"></i></a></td>
                    <td><input type="text" class="form-control input-sm" id="2"></td>
                    <td>
                    
                    <select id="3" class="search_init selectpicker  show-tick form-control input-sm"><option value="" selected="selected">Select</option><option value="1">Apartment</option><option value="2">Villa</option><option value="3">Office</option><option value="4">Retail</option><option value="5">Hotel Apartment</option><option value="6">Warehouse</option><option value="7">Land Commercial</option><option value="8">Labour Camp</option><option value="9">Residential Building</option><option value="10">Multiple Sale Units</option><option value="11">Land Residential</option><option value="12">Commercial Full Building</option><option value="13">Penthouse</option><option value="14">Duplex</option><option value="15">Loft Apartment</option><option value="16">Townhouse</option><option value="17">Hotel</option><option value="18">Land Mixed Use</option><option value="21">Compound</option><option value="24">Half Floor</option><option value="27">Full Floor</option><option value="30">Commercial Villa</option><option value="48">Bungalow</option><option value="50">Factory</option><option value="52">Staff Accommodation</option><option value="55">Multiple Rental Units</option><option value="58">Residential Full Floor</option><option value="61">Commercial Full Floor</option><option value="64">Residential Half Floor</option><option value="67">Commercial Half Floor</option></select>
                    </td>
                    <td>
                    <select class="selectpicker  show-tick form-control input-sm " id="4">
                    <option value="" selected="selected">Select</option>
                                            <option value="2">
                            Abu Dhabi                        </option>
                                            <option value="4">
                            Ajman                        </option>
                                            <option value="8">
                            Al Ain                        </option>
                                            <option value="1">
                            Dubai                        </option>
                                            <option value="7">
                            Fujairah                        </option>
                                            <option value="6">
                            Ras Al Khaimah                        </option>
                                            <option value="3">
                            Sharjah                        </option>
                                            <option value="5">
                            Umm Al Quwain                        </option>
                                    </select>
                    </td>
                    <td><input type="text" class="form-control input-sm" id="5"></td>
                    <td><input type="text" class="form-control input-sm" id="6"></td>
                    <td>
                    
                  <select id="7" class="search_init selectpicker  show-tick form-control input-sm" name="beds" type="text"><option value="" selected="selected">Select</option> <option value="0.5">Studio</option><option value="1">1 bedroom</option><option value="2">2 bedrooms</option><option value="3">3 bedrooms</option><option value="4">4 bedrooms</option><option value="5">5 bedrooms</option><option value="6">6 bedrooms</option><option value="7">7 bedrooms</option><option value="8">8 bedrooms</option><option value="9">9 bedrooms</option><option value="10">10 bedrooms</option>  <option value="11">11 beds</option>  <option value="12">12 beds</option></select>
                    </td>
                    <td>
                    <select class="selectpicker  show-tick form-control input-sm " id="8">
                   
                    
                    </select>
                    </td>
                    <td><a href=""><i class="fa fa-arrow-down"></i></a></td>
                    <td>
                    
                    <select id="10" class="search_init form-control input-sm" >
                    <option value="" selected="selected">Select</option>
                                        <option value="20">Poor</option>
                                        <option value="40">Below Average</option>
                                        <option value="60">Good</option>
                                        <option value="80">Very Good</option>
                                        <option value="100">Outstanding</option>
                                    </select>
                    </td>
                    <td>
                    <select id="11" class="search_init" style="width:100px;">
                    <option value="" selected="selected">Select</option>
                                            <option value="20">Poor</option>
                                            <option value="40">Below Average</option>
                                            <option value="60">Good</option>
                                            <option value="80">Very Good</option>
                                            <option value="100">Outstanding</option>
                                    </select>
                    </td>
                    <td>
                     <select id="12" class="search_init" style="width:100px;">
                    <option value="" selected="selected">Select</option>
                                            <option value="20">Poor</option>
                                            <option value="40">Below Average</option>
                                            <option value="60">Good</option>
                                            <option value="80">Very Good</option>
                                            <option value="100">Outstanding</option>
                                    </select>
                    </td>
                    <td>
                     <select id="13" class="search_init" style="width:100px;">
                    <option value="" selected="selected">Select</option>
                                            <option value="20">Poor</option>
                                            <option value="40">Below Average</option>
                                            <option value="60">Good</option>
                                            <option value="80">Very Good</option>
                                            <option value="100">Outstanding</option>
                                    </select>
                    </td>
                    <td>
                     <select id="14" class="search_init" style="width:100px;">
                    <option value="" selected="selected">Select</option>
                                            <option value="20">Poor</option>
                                            <option value="40">Below Average</option>
                                            <option value="60">Good</option>
                                            <option value="80">Very Good</option>
                                            <option value="100">Outstanding</option>
                                    </select>
                    </td>
                    <td>
                     <select id="15" class="search_init" style="width:100px;">
                    <option value="" selected="selected">Select</option>
                                            <option value="20">Poor</option>
                                            <option value="40">Below Average</option>
                                            <option value="60">Good</option>
                                            <option value="80">Very Good</option>
                                            <option value="100">Outstanding</option>
                                    </select>
                    </td>
                    <td>
                    <select id="16" class="search_init" style="width:100px;">
                    <option value="" selected="selected">Select</option>
                                            <option value="20">Poor</option>
                                            <option value="40">Below Average</option>
                                            <option value="60">Good</option>
                                            <option value="80">Very Good</option>
                                            <option value="100">Outstanding</option>
                                    </select>
                    </td>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
            </div>
       


		<!-- end listings   -->

            </div>
            </div>
            
                    
            
            

 			</div>
            </div>
            <!-- container end -->
            
            
            </div>
            
<!-- wrapper end -->

<script>                 
        
        $(document).ready(function(){   
        	
        	$(document.body).on('click','#add_sub_location_text', function(){
                var sub_loc_id = $('#sub_area_location_id').val();
          
                    if(sub_loc_id == 0){
						
                        $('#sub_loc_select_msg').css('display', 'block');
                        $('#loc_success_msg').css('display', 'none');
                        $('#loc_set_msg').css('display', 'none');
                        $('#sub_loc_success_msg').css('display', 'none');
                        $('#sub_loc_set_msg').css('display', 'none');
                        $('#loc_select_msg').css('display', 'none');
                        $('#loc_set_msg').css('display', 'none');
                        $('#agent_success_msg').css('display', 'none');
                        $('#agent_select_msg').css('display', 'none');
                        $('#company_success_msg').css('display', 'none');
                        
                        
                        setTimeout(function() {
                            $('#sub_loc_select_msg').fadeOut("slow");
                        }, 3000);
                        return false;
                     } else {
                        
                        $('#sub_loc_select_msg').css('display', 'none');
                        $('#loc_success_msg').css('display', 'none');
                        $('#loc_set_msg').css('display', 'none');
                        $('#sub_loc_set_msg').css('display', 'none');
                        $('#loc_select_msg').css('display', 'none');
                        $('#loc_set_msg').css('display', 'none');
                        $('#agent_success_msg').css('display', 'none');
                        $('#agent_select_msg').css('display', 'none');
                        $('#company_success_msg').css('display', 'none');

                        setTimeout(function() {
                            $('#sub_loc_success_msg').fadeOut("slow");
                        }, 3000);
                    }
                
                    $.get(config.siteUrl+"common/validate_sub_location/" + sub_loc_id, function(json) {
                        json = $.parseJSON(json);
//                        $.each(json, function(key, val) {
//                            $("#" + key).val(val);
//                        });

                        
                        if( (json) && (json.id !== 0)){
                            var aData = '<br /><br />' + json.description;
                            $("#description").append(aData);
                            $('#sub_loc_success_msg').css('display', 'block');
                        } else {
                            $('#sub_loc_set_msg').css('display', 'block');
                            $('#sub_loc_success_msg').css('display', 'none');
                            $('#sub_loc_select_msg').css('display', 'none');
                            $('#loc_success_msg').css('display', 'none');
                            $('#loc_set_msg').css('display', 'none');
                            $('#loc_select_msg').css('display', 'none');
                            $('#loc_set_msg').css('display', 'none');
                            $('#agent_success_msg').css('display', 'none');
                            $('#agent_select_msg').css('display', 'none');
                            $('#company_success_msg').css('display', 'none');
                            setTimeout(function() {
                                $('#sub_loc_set_msg').fadeOut("slow");
                            }, 3000);
                        }
                    });
                 
                return false;
            });
            
            $(document.body).on('click', '#add_location_text', function(){
                var loc_id = $('#area_location_id').val();
                
                if(loc_id == 0){
                    $('#loc_select_msg').css('display', 'block');
                    $('#sub_loc_set_msg').css('display', 'none');
                    $('#sub_loc_success_msg').css('display', 'none');
                    $('#sub_loc_select_msg').css('display', 'none');
                    $('#loc_success_msg').css('display', 'none');
                    $('#loc_set_msg').css('display', 'none');
                    $('#agent_success_msg').css('display', 'none');
                    $('#agent_select_msg').css('display', 'none');
                    $('#company_success_msg').css('display', 'none');
                    setTimeout(function() {
                        $('#loc_select_msg').fadeOut("slow");
                    }, 3000);
                    return false;
                } else {
                   
                    $('#sub_loc_set_msg').css('display', 'none');
                    $('#sub_loc_select_msg').css('display', 'none');
                    $('#loc_success_msg').css('display', 'none');
                    $('#loc_set_msg').css('display', 'none');
                    $('#loc_select_msg').css('display', 'none');
                    $('#loc_set_msg').css('display', 'none');
                    $('#agent_success_msg').css('display', 'none');
                    $('#agent_select_msg').css('display', 'none');
                    $('#company_success_msg').css('display', 'none');
                    setTimeout(function() {
                        $('#loc_success_msg').fadeOut("slow");
                    }, 3000);
                }
                
                $.get(config.siteUrl+"common/validate_location/" + loc_id, function(json) {
                     json = $.parseJSON(json);
                      if( (json) && (json.id !== 0)){
                            var aData = '<br /><br />' + json.description;
                            $("#description").append(aData);
                             $('#loc_success_msg').css('display', 'block');
                      } else {
                            $('#loc_set_msg').css('display', 'block');
                            $('#sub_loc_set_msg').css('display', 'none');
                            $('#sub_loc_success_msg').css('display', 'none');
                            $('#sub_loc_select_msg').css('display', 'none');
                            $('#loc_success_msg').css('display', 'none');
                            $('#loc_select_msg').css('display', 'none');
                            $('#agent_success_msg').css('display', 'none');
                            $('#agent_select_msg').css('display', 'none');
                            $('#company_success_msg').css('display', 'none');
                            setTimeout(function() {
                                $('#loc_set_msg').fadeOut("slow");
                            }, 3000);
                          $('#loc_success_msg').css('display', 'none');
                      }
                });
                return false;
            });
            
            $(document.body).on('click', '#add_agent_signature', function(){
                
                var agent_id = $('#agent_id').val();
                if(agent_id == 0){
                    $('#agent_select_msg').css('display', 'block');
                    $('#sub_loc_set_msg').css('display', 'none');
                    $('#sub_loc_success_msg').css('display', 'none');
                    $('#sub_loc_select_msg').css('display', 'none');
                    $('#loc_success_msg').css('display', 'none');
                    $('#loc_set_msg').css('display', 'none');
                    $('#loc_select_msg').css('display', 'none');
                    $('#agent_success_msg').css('display', 'none');
                    $('#company_success_msg').css('display', 'none');
                    setTimeout(function() {
                        $('#agent_select_msg').fadeOut("slow");
                    }, 3000);
                    return false;
                }
                
                $.get(config.siteUrl+"common/validate_agent/" + agent_id, function(json) {
                        json = $.parseJSON(json);
                        var aData = '<br /><br />Call ' + json.first_name +  " " + json.last_name + ' ' + json.rera 
						+ ' on  +' +  json.ccode + ' ' + json.mobile_no + ' ' + ( (json.office_no) ? ' / ' + json.office_no : '') + ' or visit ' 
                                 + 'www.royalhome.ae'  + ' for further details';
                        
                        $("#description").append(aData);
                        $('#agent_success_msg').css('display', 'block');
                });
                $('#sub_loc_set_msg').css('display', 'none');
                $('#sub_loc_success_msg').css('display', 'none');
                $('#sub_loc_select_msg').css('display', 'none');
                $('#loc_success_msg').css('display', 'none');
                $('#loc_set_msg').css('display', 'none');
                $('#loc_select_msg').css('display', 'none');
                $('#loc_set_msg').css('display', 'none');
                $('#agent_select_msg').css('display', 'none');
                $('#company_success_msg').css('display', 'none');
                setTimeout(function() {
                    $('#agent_success_msg').fadeOut("slow");
                }, 3000);
                return false;
            });
            
            $(document.body).on('click', '#add_company_profile', function(){
               
                $.get(config.siteUrl+"common/validate_company_profile/", function(json) {
                        json = $.parseJSON(json);
                        var aData = '<br /><br /> Company name: ' + json.name + '<br />' + 
                                    'RERA ORN: ' + json.trade_id + ' <br />' + 
                                    'Address: ' + json.address + ' <br />' + 
                                    'Office phone no: ' + json.phone_no + '<br />' + 
                                    'Office fax no: ' + json.fax_no + '<br />' + 
                                    'Primary email: ' + json.email + '<br />' + 
                                    'Website: ' + json.web + '<br />' + 
                                    'Company Profile: ' + json.description + '<br />';
                        $("#description").append(aData);
                        $('#company_success_msg').css('display', 'block');
                
                });
                
                $('#sub_loc_set_msg').css('display', 'none');
                $('#sub_loc_success_msg').css('display', 'none');
                $('#sub_loc_select_msg').css('display', 'none');
                $('#loc_success_msg').css('display', 'none');
                $('#loc_set_msg').css('display', 'none');
                $('#loc_select_msg').css('display', 'none');
                $('#loc_set_msg').css('display', 'none');
                $('#agent_success_msg').css('display', 'none');
                $('#agent_select_msg').css('display', 'none');
                setTimeout(function() {
                    $('#company_success_msg').fadeOut("slow");
                }, 3000);
                return false;
            });
            
            $(document.body).on('click', '#description_demo', function(){
                $('#sub_loc_set_msg').css('display', 'none');
                $('#sub_loc_success_msg').css('display', 'none');
                $('#sub_loc_select_msg').css('display', 'none');
                $('#loc_success_msg').css('display', 'none');
                $('#loc_set_msg').css('display', 'none');
                $('#loc_select_msg').css('display', 'none');
                $('#agent_success_msg').css('display', 'none');
                $('#agent_select_msg').css('display', 'none');
                $('#company_success_msg').css('display', 'none');
            });


            $(document.body).on('click', '#cancel', function(){
                 $('#description_demo_new').attr("id","description_demo");
            });
            $("#languages_select").change( function () {
               var value = this.value;
               if(value==1){
                   $('#language_div_2').fadeOut("fast", function() {
                        $('#language_div_1').fadeIn("fast");
                   });
               }else if(value==2){
                  $('#language_div_1').fadeOut("fast", function() {
                        $('#language_div_2').fadeIn("fast");
                  });

               }
            } );

            $("#name").on("change keyup input",function(){
                $("#title_char_count").html($("#name").val().length);
            });

            $("#price_1").on("change keyup input", function(){
                $("#price").val($("#price_1").val());
                if($(this).val() != "") {
                    $("#price, #price_1").removeClass("has-error");
                }
                else {
                    $("#price, #price_1").addClass("has-error");
                }
            });

            $("#price").on("change keyup input", function(){

                $("#price_1").val($("#price").val());
            });

            $("#cheques").on("change", function(){
                var val = $(this).val();
                var id = $(this).attr('id');
                $("#cheques_1").val($("#cheques").val());
                var success = true;
                $(".cheques_option").not($("#cheques_1")).each(function(){
                    if(val !="" && $(this).val() == val) {
                        alert("An entry with same number of cheques already exists.");
                        $("#"+id).val("");
                        $("#cheques_1").val("");
                        success = false;
                        return false;
                    }
                    if(val == "" && $(this).val() != "") {
                        $("#cheques_1").addClass("has-error");
                        $("#cheques").addClass("has-error");
                        success = false;
                        return false;
                    }
                });
                if(success) {
                    $("#cheques_1,#cheques").removeClass("has-error");
                }
                return success;
            });


            $(".price-input").on("change keyup input", function(){
                validateCheques();
            });

            $(".cheques_option").on('change', function(e){
				
                var val = $(this).val();
                var id = $(this).attr('id');
                var selected_any = false;
                if(val == '') {
                    return true;
                }
                $(".cheques_option").not($(this)).each(function(){
                    if($(this).val() == val) {
                        alert("An entry with same number of cheques already exists.");
                        $("#"+id).val("");
                        return false;
                    }
                });
            });

            $(".cheques_option").on('change', function(e){
                validateCheques();
            });

            function validateCheques() {
                var valid = true;
                var cheques_1 = $("#cheques_1").val();
                $(".cheques_option,.price-input,#cheques").removeClass("has-error");
                if($("#price_1").val() == "") {
                    addError($("#price_1"));
                }

                var emptyCheques = $(".cheques_option").not("#cheques_1").filter(function(){
                    return ($(this).val() == "")
                });

                var emptyPrices = $(".price-input").not("#price_1").filter(function(){
                    return ($(this).val() == "")
                });

                if( (emptyCheques.length == 3 && emptyPrices.length == 3) ) {
                    return true;
                }
                if (emptyCheques.length == 0 && emptyPrices.length == 0 && cheques_1) {
                    return true;
                }

                $("#popup_price_div .form-group").not("#cheque_option_1").each(function() {
                    var $cheque = $(this).find(".cheques_option");
                    var $price = $(this).find(".price-input");
                    if($cheque.val() == "" && $price.val() != "") {
                        valid = false;
                        addError($cheque);
                    }
                    if($cheque.val() != "" && $price.val() == "") {
                        valid = false;
                        addError($price);
                    }
                });

                if((emptyCheques.length < 3 || emptyPrices.length < 3) && cheques_1 == "") {
                    valid = false;
                    $("#cheques_1,#cheques").addClass("has-error");
                }
                return valid;
            }

            window.validateCheques = validateCheques;

            function addError($el) {
                $el.addClass("has-error");
            }

            function removeError($el) {
                $el.removeClass("has-error");
            }

            $("#cheques_1").on("change", function(){
                $("#cheques").val($("#cheques_1").val());
            });


        });
        </script>
<script>
        
                
        $(document.body).on('click', '#downloadCSV_div_all_selected', function(){
                $('#sms_verification_all').css('display', 'none');
                $('#export_selected_columns_all').css('display', 'block');
                return false;
        });
       
        
        
     
        $(document).ready(function() {
      
            $('#ExportToPDFALL').html('<div style="display:none;" id="downloadPDFtables_animation"><img src="'+mainurl+'mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download PDF in progress. Please wait.</div><a id="downloadPDFtables_div" class="popup_a" href="'+mainurl+'/generate/exportPDF?exportPDF="><img src="'+mainurl+'mydata/images/pdf_big.png?ts=10" width="32" height="32"><br>Download PDF</a>'); // update download button link
            $('#ExportToCSVALL').html('<div style="display:none;" id="downloadCSV_animation"><img src="'+mainurl+'mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div>\n\
                <a id="downloadCSV_div" class="popup_a" href="'+mainurl+'generate/exportCSV?type_listing=1"><img src="'+mainurl+'mydata/images/excel_big.png?ts=10" width="32" height="32">\n\
                <br>Download Excel</a>'); // update download button link
           
            $('#ExportToCSVALLSelected').html('<div style="display:none;" id="downloadCSV_animation"><img src="'+mainurl+'mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div>\n\
                <a id="downloadCSV_div_all_selected" class="popup_a" href="#"><img src="'+mainurl+'mydata/images/excel_big.png?ts=10" width="32" height="32">\n\
                <br>Download Selected Columns</a>'); // update download button link
           
          
            $('#listings_row').change(function(){
                    var value = [];
                    var count = 0;
                    $('#listings_row input[type=checkbox]:checked').each(function() {
                        if( $(this).val() != ''){
                              value+=$(this).attr('value')+',';      
                        }
                        if($(this).attr('id') != 'check_all_checkboxes'){
                            count++;
                        }
                        
                    });
					
                    $('#emailPDF').val(value);
                    $('#exportPDF').val(value);
                    $('#emailHTML').val(value);
                    $('#exportPDFIds').val(value);
                    $('#exportPosterIds').val(value);
                    //$('#hdn_sms_ids').val(value);
                        $('#sms-iframe-agent').attr('src', 'https://crm.propspace.com/sendSMS/showSMSFormAgents/'+value);
                    $('#sms-iframe-owner').attr('src', 'https://crm.propspace.com/sendSMS/showSMSFormOwners/'+value);
    
                    $('#ExportToPDF').html('<div style="display:none;" id="downloadPDFtables_animation"><img src="'+mainurl+'mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download PDF in progress. Please wait.</div><a id="downloadPDFtables_div" class="popup_a" href="'+mainurl+'generate/exportPDF?exportPDF='+value+'"><img src="<?php echo base_url();?>mydata/images/pdf_big.png?ts=10" width="32" height="32"><br>Download PDF</a>'); // update download button link
                    $('#email_count').text(count);
                    
                    $('#emailCSV').val(value);
                    $('#bulk_change_items_count').html(count);
                    $('#bulk_update_ids').val(value);
                    $('#ExportToCSV').html('<div style="display:none;" id="downloadCSV_animation"><img src="'+mainurl+'mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div><a id="downloadCSV_div" class="popup_a" href="'+mainurl+'generate/exportCSV?exportCSV='+value+'"><img src="'+mainurl+'mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download All Columns</a>'); // update download button link
                    $('#ExportToCSVSelected').html('<div style="display:none;" id="downloadCSV_animation"><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div><a id="downloadCSV_div_selected" class="popup_a" href="#"><div id="downloadCSV_div_click"><img src="<?php echo base_url();?>mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download Selected Columns</div></a>'); // update download button link
            });
                                                    
                    $('#action_matching_leads').click(function(){
                        $("#sentFromUser1").attr('checked','checked') ;
                        $("#sentFromCompany1").attr('checked',false) ;
                    });
                }); 
    </script>
  <!-- END JS WORK -->
<!-- popups starts here -->
<!-- Advanced Search Modal  -->

            <div class="modal fade" id="advanced_search" tabindex="-1" >
              <div class="modal-dialog">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Advanced Search</h4>
                  </div>
                  
                  <div class="modal-body click" id="dataadvancesearch_options" item="advance_search" >
                   <form id="as_search_form">
                  <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Property Status</label>
                        <select name="as_prop_status" class="advance_search form_select_fields form-control input-sm" id="as_prop_status">
                                            <option value="" selected="selected">Select</option>
                                                                                            <option value="3">Rented</option>
                                                                                        <option value="1">Available</option>
                                            <option value="7">Blocked</option>
                                            <option value="5">Reserved</option>
                                                                                            <option value="6">Renewed</option>
                                                                                        <option value="2">Pending</option>
                                            <option value="4">Upcoming</option>
                                        </select>
                        
                    </div>
                    <div class="form-group">
                      	<label>Unit Type</label>
                        <input type="text" class="form-control input-sm" id="as_unit_type" name="as_unit_type">
                    </div>
                    <div class="form-group">
                      	<label>Street No</label>
                        <input type="text" class="form-control input-sm" id="as_street_no" name="as_street_no">
                    </div>
                    <div class="form-group">
                        <label>Available From</label>
                        <div class="input-group input-daterange" id="datepicker">
                          <input type="text" class="form-control input-sm" id="as_available_date_from"     name="as_available_date_from">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                     </div>
                    <div class="form-group">
                      	<label>Min Deposit</label>
                        <input type="text" class="form-control input-sm" id="as_min_deposit" name="as_min_deposit" >
                    </div>
                    <div class="form-group">
                      	<label>Min BUA</label>
                        <input type="text" class="form-control input-sm" id="as_min_bua" name="as_min_bua">
                    </div>
                    <div class="form-group">
                      	<label>Min Price/SqFt</label>
                        <input type="text" class="form-control input-sm" id="as_min_uap" name="as_min_uap">
                    </div>
                    <div class="form-group">
                      	<label>Min Plot Size</label>
                        <input type="text" class="form-control input-sm" id="as_min_ps" name="as_min_ps">
                    </div>
                     <div class="form-group">
                        <label>Portals</label>
                       
                        <select name="as_portals_name" class="advance_search form-control input-sm " id="as_portals_name" >
                                            <option value="" selected>Select</option>
                                                                            <option value="dubizzle">dubizzle</option>
                                                                                <option value="JustRentals">JustRentals</option>
                                                                                <option value="JustProperty">JustProperty</option>
                                                                                <option value="propertyfinder">propertyfinder</option>
                                                                                <option value="bayut">bayut</option>
                                                                                <option value="GNproperty">GNproperty</option>
                                                                                <option value="Zoopla">Zoopla</option>
                                                                                <option value="rightmove">rightmove</option>
                                                                            </select>
                     </div>
                      <div class="form-group">
                        <label>Frequency</label>
                        
                        <select name="as_freq_search" type="text" class="advance_search form-control input-sm" id="as_freq_search">
                                            <option value="" selected>Select</option>
                                            <option value="1">Per Day</option>
                                            <option value="2">Per Week</option>
                                            <option value="3">Per Month</option>
                                            <option value="4" >Per Year</option>
                                        </select>
                     </div>
                     <div class="form-group">
                      	<label>Notes </label>
                        <input type="text" class="form-control input-sm" id="as_notes" name="as_notes">
                    </div>
                    <div class="form-group">
                        <label>Furnished</label>
                       
                        
                        <select name="as_prop_furnish" class="advance_search form-control input-sm" id="as_prop_furnish">
                                            <option value="0" selected>Select</option>
                                            <option value="1">Furnished</option>
                                            <option value="2">Unfurnished</option>
                                            <option value="3">Partly Furnished</option>
                                        </select>
                     </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Source</label>
                       
                        <select name="as_source_of_listing" type="text"  class="form-control input-sm" id="as_source_of_listing">
                                            <option value="" selected>Select</option>
                                            <option value="Bayut.com" >Bayut.com</option>
                                            <option value="Cold call" >Cold call</option>
                                            <option value="Website" >Company website</option>
                                            <option value="Direct call" >Direct call</option>
                                            <option value="Dubizzle.com" >Dubizzle.com</option>
                                            <option value="Email campaign" >Email campaign</option>
                                            <option value="JustProperty.com" >JustProperty.com</option>
                                            <option value="JustRentals.com" >JustRentals.com</option>
                                            <option value="Newspaper advert" >Newspaper advert</option>
                                            <option value="Other portal" >Other portal</option>
                                            <option value="Propertyfinder.ae" >Propertyfinder.ae</option>
                                            <option value="Referral within company" >Referral within company</option>
                                            <option value="SMS campaign" >SMS campaign</option>
                                            <option value="Walk-in" >Walk-in</option>
                                            <option value="Other" >Other</option>
                                        </select>
                    </div>
                    <div class="form-group">
                      	<label>Baths</label>
                        <input type="text" class="form-control input-sm" id="as_baths"       name="as_baths">
                    </div>
                    <div class="form-group">
                      	<label>Floor No</label>
                        <input type="text" class="form-control input-sm" id="as_floor_no"    name="as_floor_no">
                    </div>
                    <div class="form-group">
                        <label>Available To</label>
                        <div class="input-group input-daterange" id="datepicker">
                          <input type="text" class="form-control input-sm" id="as_available_date_to"     name="as_available_date_to">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                     </div>
                    <div class="form-group">
                      	<label>Max Deposit</label>
                        <input type="text" class="form-control input-sm" id="as_max_deposit" name="as_max_deposit">
                    </div>
                    <div class="form-group">
                      	<label>Max BUA</label>
                        <input type="text" class="form-control input-sm" id="as_max_bua" name="as_max_bua">
                    </div>
                    <div class="form-group">
                      	<label>Max Price/SqFt</label>
                        <input type="text" class="form-control input-sm" id="as_max_uap" name="as_max_uap">
                    </div>
                    <div class="form-group">
                      	<label>Max Plot Size</label>
                        <input type="text" class="form-control input-sm" id="as_max_ps" name="as_max_ps">
                    </div>
                    <div class="form-group">
                      	<label>View</label>
                        <input type="text" class="form-control input-sm" id="as_view"    name="as_view" >
                    </div>
                    <div class="form-group">
                      	<label>No Of Photos</label>
                        <input type="text" class="form-control input-sm" id="as_photos"      name="as_photos">
                    </div>
                     <div class="form-group">
                      	<label>Old Ref No </label>
                        <input type="text" class="form-control input-sm" id="as_temp_ref"    name="as_temp_ref">
                    </div>
                    
                  </div>
                  </div>
                      </form>  
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" ><i class="fa fa-close"></i> Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            
            <!-- Bulk Update Modal -->
            <div class="modal fade" id="bulk_update" tabindex="-1" >
              <div class="modal-dialog modal-sm">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Fields</h4>
                  </div>
                   
                  <div class="modal-body">
                        
                        <div class="modal-body small-popup">
        <form id ="update_bulk_form" method="POST" action="<?php echo base_url();?>listings/updateFeilds/" class="form-horizontal">
        <div id="update_bulk_form_div">
                <input name="bulk_update_ids" id="bulk_update_ids" class="ignoreField" style="display:none;" type="text" value=""/>
                <div class="form-body">
                    <div class="form-group">
                        <div class="col-md-3 form-label">
                       
                            <label id="value_label">Choose field</label>
                        </div>
                        <div class="col-md-9">
                            <div class="select-group">
                                <select name="field_name_bulk" class="form-control input-sm required ignoreField" id="field_name_bulk">
                                    <option value="" selected="selected">Select</option>
                                    <option value="unit_type">Type</option>
                                    <option value="street_no">Street No</option>
                                    <option value="floor_no">Floor</option>
                                    <option value="category_id">Category</option>
                                    <option value="location">Emirates, Location, Sub-location</option>
                                    <option value="beds">Beds</option>
                                    <option value="fitted">Fitted</option>
                                    <option value="baths">Baths</option>
                                    <option value="size">BUA</option>
                                    <option value="plot_size">Plot</option>
                                    <option value="price">Price(AED)</option>
                                                                        <option value="frequency">Frequency</option>
                                                                                                            <option value="parking">Parking</option>
                                    <option value="view_id">View</option>
                                    <option value="prop_furnish">Furnished</option>
                                    <option value="portal">Portals</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group showSetVal">
                        <div class="col-md-3 form-label" id="set_label">
                           
                        </div>
                        <div class="col-md-9" id="content_field" >
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                       <!-- <button type="text" id="update_bulk_button" class="save_button saveHEX">Update Fields</button>   -->      
                    </div>
                </div>
                
        </div>
        <div id="update_bulk_confirm_div" style="display:none;">
            <div class="margin-bottom-10">
                This will affect <span id="bulk_change_items_count" style="color:green;font-weight: bold;"> X </span> listings. <br /> Would you like to proceed?
            </div>
           
            <div class="text-center">     
                <div id='loading-btn' style='display:none;'><img src="https://crm.propspace.com/application/views/images/ajax-loader.gif" width="26" height="26" /></div>
                <button type="text" id="confirm_bulk_button" class="save_button saveHEX">Confirm</button>
                <button type="text" id="cancel_bulk_button" class="cancel_button cancelHEX">Cancel</button>
            </div>
        </div>
        <div id="update_bulk_success" style="display:none;">
            <p class="greenText">
                Updated Successfully.
            </p>
        </div>
    </form>
    </div>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="update_bulk_button"><i class="fa fa-check"></i> Update Fields</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Description Modal -->
            
            <div class="modal fade" id="description_main" tabindex="-1" >
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Description</h4>
                    <p>Please enter or edit your description for the listing</p>
                  </div>
                  
                  <div class="modal-body">
                  
                   <div class="char_count_wrapper">
                        <span>Character Count : <span id="desc_char_count">0</span></span> &nbsp;&nbsp;&nbsp; <span>Word Count : <span id="display_count">0</span></span>
                    </div>
                    <textarea name="description" cols="200" rows="60" id="description"></textarea>
                  
                  
                  
                    <button type="text" id="add_sub_location_text" class="btn btn-primary">Add sub-location text</button>
                        <button type="text" id="add_location_text" class="btn btn-success">Add location text</button>
                        <button type="text" id="add_agent_signature" class="btn btn-danger">Add agent signature</button>
                        <button type="text" id="add_company_profile" class="btn btn-warning">Add company profile</button>
                  
                  
                  <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                           data-placement="bottom" data-content=" <b>Description Enhancer</b><br /><br />  These buttons enable you to add sub-location and location text to the bottom of your property description. The text for the locations and sub-locations should be added once in the Locations Text tab on the listings screens.You can also add your own signature and company profile. This will help you increase the length of your property descriptions at the click of a button and hopefully achieve higher rankings on different property portals!  Please note clicking these buttons twice will mean the text is added twice. You can manually delete anything you add by mistake in the box above.<br /><b>Note: Detailed and accurate property descriptions help get more leads from the different portals!">
                           <i class="fa fa-info-circle"></i>
                           </a>
                            <span id="sub_loc_success_msg" class="help-block redText" style="display: none;">
                            Sub-location text added successfully.
                        </span>
                        <span id="sub_loc_select_msg" class="help-block redText" style="display: none;">
                            Please select sub-location before adding sub-location text.
                        </span>
                        <span id="sub_loc_set_msg" class="help-block redText" style="display: none;">
                            Error: No text found for this sub-location. Please add on the Locations Text tab.
                        </span>
                        <span id="loc_success_msg" class="help-block redText" style="display: none;">
                            Location text added successfully.
                        </span>
                        <span id="loc_select_msg" class="help-block redText" style="display: none;">
                            Please select location before adding location text.
                        </span>
                        <span id="loc_set_msg" class="help-block redText" style="display: none;">
                            Error: No text found for this location. Please add on the Locations Text tab.
                        </span>
                        <span id="agent_success_msg" class="help-block redText" style="display: none;">
                            Agent signature added successfully.
                        </span>
                        <span id="agent_select_msg" class="help-block redText" style="display: none;">
                            Error: No agent signature found. Please select an agent first.
                        </span>
                        <span id="company_success_msg" class="help-block redText" style="display: none;">
                            Company profile added successfully.
                        </span>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success updatedescription" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            
             <!-- Other languages Modal -->
            <div class="modal fade" id="other_languages" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Other Languages</h4>
                    <p>Please select a language to add title or description. </p>
                  </div>
                  
                  <div class="modal-body">
                
                  <div class="well form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Select Language</label>
                        <div class="col-sm-6">
                            <select class="selectpicker  show-tick form-control input-sm " id="languages_select" name="languages_select">
                          
                        <option value="1">Russian</option>
                        <option value="2">Arabic</option>
                    </select>
                        </div>
                    </div>
                  </div>
                   <input id="other_languages" name="other_languages" value="" style="display:none;">
                    <div id="language_div_1">
                    <input id="other_details_1_id" name="other_details_1_id" value="" style="display:none;">
                    <input id="other_language_1" class="other_languages" name="other_language_1" type="text" style="display:none;" value="1">
                  <h5 class="text-primary">Russian</h5>
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" class="form-control input-sm" id="other_title_1" name="other_title_1">
                        
                    </div>
                    <div class="form-group">
                        <label>Desicription:</label>
                         <textarea name="other_description_1" cols="200" rows="30" id="other_description_1"></textarea>
                    </div>

                </div>
                  
                  <div id="language_div_2" style="display:none;">
                   <input id="other_details_2_id" name="other_details_2_id" value="" style="display:none;">
                    <input id="other_language_2" class="other_languages" name="other_language_2" style="display:none;" type="text" value="2">
                  <h5 class="text-primary">Arabic</h5>
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" class="form-control input-sm" id="other_title_2" name="other_title_2" dir="rtl">
                        
                    </div>
                    <div class="form-group">
                        <label>Desicription:</label>
                         <textarea name="other_description_2" cols="200" rows="30" id="other_description_2"></textarea>
                    </div>

                </div>
                    
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            <script type="text/javascript" src="<?php echo site_url();?>js/plugins/tiny_mce/jquery.tinymce.js?ts=10"></script> 
            <script type="text/javascript">
            $(document).ready(function(){
                $('#description, #other_description_1').tinymce({
                    setup : function(ed) {
                        ed.onKeyUp.add(function(ed, l){
                            var content = $.trim(ed.getContent({format : 'text'}));
                            if(content && content.length > 0) {
                                countWords(content, 'display_count');
                            }
                            else {
                                if($("#desc_char_count").length > 0) {
                                    $("#desc_char_count").html('0');
                                    $("#display_count").html('0');
                                }
                            }
                        });

                        ed.onSetContent.add(function(ed, o) {
                            var content = $.trim(ed.getContent({format : 'text'}));
                            if(content && content.length > 0) {
                                countWords(content, 'display_count');
                            }
                            else {
                                if($("#desc_char_count").length > 0) {
                                    $("#desc_char_count").html('0');
                                    $("#display_count").html('0');
                                }
                            }
                        });

                        ed.onPaste.add(function(ed, e) {
                            setTimeout(function (){
                                var content = $.trim(ed.getContent({format : 'text'}));
                                if(content && content.length > 0) {
                                    countWords(content, 'display_count');
                                }
                                else {
                                    if($("#desc_char_count").length > 0) {
                                        $("#desc_char_count").html('0');
                                        $("#display_count").html('0');
                                    }
                                }
                            }, 200);
                        });
                    },
                    // Location of TinyMCE script
					//https://crm.propspace.com/application/views/tinymce/jscripts/tiny_mce/tiny_mce.js?ts=10
                    script_url : '<?php echo site_url();?>js/plugins/tiny_mce/tiny_mce.js',
                    // General options
                    width : "866",
                    height: "220",
                    theme : "advanced",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,bullist,numlist,spellchecker",
                    theme_advanced_buttons2 : "",
                    theme_advanced_buttons3 : "",
                    theme_advanced_buttons4 : "",
                    force_br_newlines : true,
                    force_p_newlines : false,
                    gecko_spellcheck : true,  
                    forced_root_block : '', // Needed for 3.x

                    plugins : "paste,spellchecker",
                    spellchecker_languages : "+English=en,Russian=ru",
                    // encoding : "xml",
                    // Example content CSS (should be your site CSS)
                    content_css : "<?php echo base_url();?>mydata/content.css",
            
                    //
                    apply_source_formatting : true,
            
                    // Replace values for the template plugin
                    template_replace_values : {
                        username : "Some User",
                        staffid : "991234"
                    }   
                });
                
               $('#other_description_2').tinymce({
                    // Location of TinyMCE script
                    script_url : '<?php echo site_url();?>js/plugins//tiny_mce/tiny_mce.js?ts=10',
                    // General options
                    width : "866",
                    height: "220",
                    theme : "advanced",
                    directionality: "rtl",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,bullist,numlist,spellchecker",
                    theme_advanced_buttons2 : "",
                    theme_advanced_buttons3 : "",
                    theme_advanced_buttons4 : "",
                    force_br_newlines : true,
                    force_p_newlines : false,
                    gecko_spellcheck : true,  
                    forced_root_block : '', // Needed for 3.x

                    plugins : "paste,spellchecker",
                    spellchecker_languages : "+English=en,Russian=ru",
                    // encoding : "xml",
                    // Example content CSS (should be your site CSS)
                    content_css : "<?php echo base_url();?>mydata/content.css",
            
                    //
                    apply_source_formatting : true,
            
                    // Replace values for the template plugin
                    template_replace_values : {
                        username : "Some User",
                        staffid : "991234"
                    }   
                });
                
                
                
                
               
                
            });
            
           
            
    
            function countWords(textarea_data, span_id)
            {
                var split = textarea_data.match(/\S+/g);
                if(split) {
                    count=split.length;
                    $("#"+span_id).text(count);
                    $("#desc_char_count").text(textarea_data.length);
                    $("#description_count").val(count);
                }
                else {
                    $("#"+span_id).text("0");
                    $("#desc_char_count").text((textarea_data.length  == 1 )? "0" : textarea_data.length);
                    $("#description_count").val("0");
                }
            }
            $(document.body).on("click", ".updatedescription, a.close, #fade", function(event){
                var description_demo= $.trim(convertHtmlToText($('#description').val()));
                $("#description_demo").val(description_demo);
                if(description_demo!=''){
                    var count=countWords(description_demo, 'display_count');
                }
                else{
                    $("#display_count").text('0');
                    $("#desc_char_count").text('0');
                }
            } );
        </script>
            <!-- Location Modal -->
            <div class="modal fade" id="location" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select Location</h4>
                  </div>
                  
                  <div class="modal-body">
                  <div class="row">
                  <div class="col-md-6">
                 	 <div class="form-group">
                      	<label>Latitude</label>
                       <input class="form-control" name="lat" type="text" id="lat" readonly>
                      </div>
                  </div>
                   <div class="col-md-6">
                 	 <div class="form-group">
                      	<label>Longitude</label>
                       <input class="form-control" name="lon" type="text" id="lon" readonly>
                      </div>
                  </div>
                  </div>
                  
                  <div class="row">
                  	<div class="col-lg-12">
                    <div id="map" class="gmaps" style="width:100%; height:350px;"></div>
                    </div>
                  </div>
                      
                  
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Leads Modal -->
            <div class="modal fade" id="leads_pop" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Leads</h4>
                  </div>
                  
                  <div class="modal-body">
                  <div id="view_lead_popup" class="popup_block">
                    <div id="view_lead_window">Please select a listing</div>
                </div>
                  
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            
            <!-- Viewing Modal -->
            <div class="modal fade" id="viewing_detail" tabindex="-1">
               <div id="view_terminal_window">Please select a listing</div>
            </div>
            
            <!-- Owner Info detail Modal -->
            <div class="modal fade" id="owner_info" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">View Contacts</h4>
                    <p>Owner for listing ref </p>
                  </div>
                  
                  <div class="modal-body">
                  <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-owner-info">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Country Code</th>
                                            <th>Mobile No</th>
                                            <th>Phone No</th>
                                            <th>Email</th>
                                            <th>Country Code</th>
                                            <th>Assigned To</th>
                                            <th>Listed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                    
                      
                    
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Owner Info Modal -->
            <div class="modal fade" id="owner" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Contacts</h4>
                  </div>
                  
                  <div class="modal-body">
                  
               <!--show data here-->
                     <div id="add_landlord_window">Please select a listing</div>
                    
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            
          
            
            
           
            
            <!-- Features Media Modal -->
           
            <div class="modal fade" id="features" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header feature_modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  </div>
                  
                  <div class="modal-body">
                  
                    <div id="inner_tab">
                    <div class="inner_tab_nav">
                        <ul class="nav nav-tabs">
                            <li  class="active"><a href="#features_amenities" data-toggle="tab">Features &amp; Amenities</a></li>
                            <li><a href="#area_info" data-toggle="tab">Area Information</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="features_amenities">
                        <p>Select the property features here. These will be added to PDF brochures and sent in XML feeds to the portals you advertise on.</p>
                        <script type="text/javascript">

  $(function(){
    $('#features').click(function(){

                            var value = [];
                            var count = 0;
                            $('#features input:checked').each(function() {
                                    value+='{'+this.value+'}';
                                    count++;
                            });
                            $('#features_id').val(value);
                            $('#features_count').val(count);
    });


  });    

</script>
<form id="features">
                        <div class="row">
                        <div class="col-lg-12">
                        <h5 class="text-primary">Property Features</h5>
                        </div>
                        
                        <div class="col-md-4">
                         <?php 
						
						   $ii = 0;
						   foreach ($PropertyFeaturesPop as $value) {
							  if ($ii % 3 === 0 && $ii != 0) {?>
							  </div><div class="col-md-4">
							  <?php
							  }?>
													<div class="form-group form_group_checkbox">
														<label class="">
															<input type="checkbox" id="feature_<?php echo $value['id'];?>" value="<?php echo $value['id'];?>" />
															<span class="lbl padding"><?php echo $value['title'];?></span>
														</label>
													</div>
													
												   <?php
													 $ii++;
						   }
						   ?> 
                          
                            
                        </div>
                        
                        
                        
                        </div>
                        
                        <div class="row">
                        <div class="col-lg-12">
                        <h5 class="text-primary">Property Amenities</h5>
                        </div>
                        <div class="col-md-4">
                         <?php 
						
						   $ii = 0;
						   foreach ($PropertyAmenitiesPop as $value) {
							  if ($ii % 3 === 0 && $ii != 0) {?>
							  </div><div class="col-md-4">
							  <?php
							  }?>
                            <div class="form-group form_group_checkbox">
                                <label class="">
                                  <input type="checkbox" id="feature_<?php echo $value['id'];?>" value="<?php echo $value['id'];?>" />
                                    <span class="lbl padding"><?php echo $value['title'];?></span>
                                </label>
                            </div>
                              <?php
													 $ii++;
						   }
						   ?> 
                        </div>
                        
                        </div>
                        </form>
                        </div>
                        <div class="tab-pane fade" id="area_info">
                        <p>You can specify places near by this property e.g school, hospitals, metro stations etc.</p>
                        <script type="text/javascript">
    $('body').on('change','#area_information',function (event){
        var area_information = {};   
        $("#area_information :input").each(function() {      
            if($(this).val()!=''){
                area_information[$(this).attr('name')] = $(this).val();  
            }
        });
        var json = JSON.stringify(area_information); 
        $('#area_iformation_data').val(json);
        
        //alert(json);
    });
    
    
    $("body").on('click','.add_extra_ai', function(){
       var ai_type = $(this).attr('ai_type');
       var count = $( "#ai_type_"+ai_type+" a" ).last().attr('count');
       count = (count*1) + 1;
       if($( "#ai_type_"+ai_type+" input" ).length<6){
            var html = "";
            html += '<input name="area_information_'+ai_type+'_'+count+'"  style="width:95%;" class="form-control inline-block margin-bottom-5" id="area_information_'+ai_type+'_'+count+'">';
            html += '<a href="# ai" id="ai_button_'+ai_type+'_'+count+'" ai_type="'+ai_type+'" title="Remove this entry" count="'+count+'" class="remove_extra_ai"><i class="icon-minus-circled redText"></i></a>';

            $('#extra_ai_'+ai_type).append(html);
       }else{
           alert('You cant add more then 6 fields.');
       }
    });
    
    $("body").on('click','.remove_extra_ai', function(){
       var ai_type = $(this).attr('ai_type');
       var count = $(this).attr('count');
       
       $('#area_information_'+ai_type+'_'+count).remove();
       $('#ai_button_'+ai_type+'_'+count).remove();
       $("#area_information").trigger('change');
    });
</script>

<form id="area_information">
                        <div class="form-group" id="ai_type_1">
                            <label>Schools</label>
                            <div class="input-group">                              
                              <input type="text" class="form-control input-sm" name="area_information_1_1" id="area_information_1_1">
                              <span class="input-group-addon"><a href="# ai" ai_type="1" title="Add another entry for 'Schools'" count="1" class="add_extra_ai"><i class="fa fa-plus-circle"></i></a></span>
                            </div>
                            <div id="extra_ai_1" class="gist-othextrafields">
                
            </div>
                        </div>
                        
                        
                        
                        <div class="form-group" id="ai_type_2">
                            <label>Metros</label>
                            <div class="input-group">                              
                              <input type="text" class="form-control input-sm" name="area_information_2_1" id="area_information_2_1">
                              <span class="input-group-addon"><a href="# ai" ai_type="2" title="Add another entry for 'Metros'" count="1" class="add_extra_ai"><i class="fa fa-plus-circle"></i></a></span>
                            </div>
                             <div id="extra_ai_2" class="gist-othextrafields">
                
            </div>
                        </div>
                        
                        
                        <div class="form-group" id="ai_type_3">
                            <label>Medical Centers</label>
                            <div class="input-group">                              
                              <input type="text" class="form-control input-sm" name="area_information_3_1" id="area_information_3_1">
        <span class="input-group-addon"><a href="# ai" ai_type="3" title="Add another entry for 'Medical Centers'" count="1" class="add_extra_ai"><i class="fa fa-plus-circle"></i></a></span>
                            </div>
                            <div id="extra_ai_3"> </div>
                        </div>
                        
               
                        <div class="form-group"  id="ai_type_4">
                            <label>Shopping Malls</label>
                            <div class="input-group">                              
                              <input type="text" class="form-control input-sm" name="area_information_4_1" id="area_information_4_1" >
                              <span class="input-group-addon"><a href="# ai" ai_type="4" title="Add another entry for 'Shopping Malls'" count="1" class="add_extra_ai"><i class="fa fa-plus-circle"></i></a></span>
                            </div>
                            <div id="extra_ai_4">
                
            </div>
                        </div>
                        
                        
                        <div class="form-group" id="ai_type_5">
                            <label>Mosques</label>
                            <div class="input-group">                              
                              <input type="text" class="form-control input-sm"  name="area_information_5_1" id="area_information_5_1" >
                              <span class="input-group-addon"><a href="# ai" ai_type="5" title="Add another entry for 'Mosques'" count="1" class="add_extra_ai"><i class="fa fa-plus-circle"></i></a></span>
                            </div>
                             <div id="extra_ai_5">
                
            </div>
                        </div>
                        
                        
                        
                        <div class="form-group" id="ai_type_6">
                            <label>Beaches</label>
                            <div class="input-group">                              
                              <input type="text" class="form-control input-sm" name="area_information_6_1" id="area_information_6_1">
                              <span class="input-group-addon"><a href="# ai" ai_type="6" title="Add another entry for 'Beaches'" count="1" class="add_extra_ai"><i class="fa fa-plus-circle"></i></a></span>
                            </div>
                            <div id="extra_ai_6">
                
            </div>
                        </div>
                        
                        
                        <div class="form-group" id="ai_type_7">
                            <label>Supermarkets</label>
                            <div class="input-group">                              
                              <input type="text" class="form-control input-sm"  name="area_information_7_1" id="area_information_7_1">
                              <span class="input-group-addon"><a href="# ai" ai_type="7" title="Add another entry for 'Supermarkets'" count="1" class="add_extra_ai"><i class="fa fa-plus-circle"></i></a></span>
                            </div>
                            <div id="extra_ai_7">
                			 </div>
                        </div>
                        
                        
                        <div class="form-group" id="ai_type_8">
                            <label>Park</label>
                            <div class="input-group">                              
                              <input type="text" class="form-control input-sm" name="area_information_8_1" id="area_information_8_1">
                              <span class="input-group-addon"><a href="# ai" ai_type="8" title="Add another entry for 'Park'" count="1" class="add_extra_ai"><i class="fa fa-plus-circle"></i></a></span>
                            </div>
                            <div id="extra_ai_8">
                
            </div>
                        </div>
                        
                        
                         <a style="display: none;" id="add_ai" href="# 1">Add AI</a>
                        
                        
       </form>                 
                        </div>
                    </div>
                    </div>
                  
                  </div>
                   <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            
            
            <!-- Photos  Modal -->
            <div class="modal fade" id="photos_pop" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Images <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Add images for your listing here. The ideal file size for printing brochures and uploading to portals is 450px wide by 350px tall (landscape orientation). The ideal file size is less than 300kb per photo. Larger sizes are fine, but this may cause slow upload depending on your internet connection speed.">
                           <i class="fa fa-info-circle"></i>
                           </a></h4>
                  </div>
                  
                  <div class="modal-body">
                  
                    <div id="inner_tab">
                    <div class="inner_tab_nav">
                        <ul class="nav nav-tabs">
                            <li  class="active"><a href="#photo" data-toggle="tab">Photos</a></li>
                            <li><a href="#floor_plan" data-toggle="tab">Floor Plan</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="photo">
                            <div class="col-md-12">
                               <span><i class="fa fa-upload"></i> Selct images to upload</span>
                                <input type="file" class="fileUpload btn btn-primary upload" id="file_upload" name="file_upload" />
                                <a href="#" class="pull-right"><i class="fa fa-trash"></i> Delete all images</a>
                             
                            </div>
                           
                                  <!--show photos here-->
                                <div id="showimages">No images found</div>
                        </div>
                        
                        <div class="tab-pane fade" id="floor_plan">
                            <div class="fileUpload btn btn-primary">
                                <span><i class="fa fa-upload"></i> Selct images to upload</span>
                                <input type="file" class="upload" />
                            </div>
                            <a href="" class="pull-right"><i class="fa fa-trash"></i> Delete all images</a>
                            <div class="row">
                                <div class="col-md-2">
                                <div class="thumbnail">
                                <img src="images/user_thumb.jpg" alt="" class="img-responsive">
                                </div>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Delete</a>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Edit Title</a>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Watermark</span>
                                        </label>
                                    </div>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Contact Image</span>
                                        </label>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                <div class="thumbnail">
                                <img src="images/user_thumb.jpg" alt="" class="img-responsive">
                                </div>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Delete</a>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Edit Title</a>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Watermark</span>
                                        </label>
                                    </div>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Contact Image</span>
                                        </label>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                <div class="thumbnail">
                                <img src="images/user_thumb.jpg" alt="" class="img-responsive">
                                </div>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Delete</a>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Edit Title</a>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Watermark</span>
                                        </label>
                                    </div>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Contact Image</span>
                                        </label>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                <div class="thumbnail">
                                <img src="images/user_thumb.jpg" alt="" class="img-responsive">
                                </div>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Delete</a>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Edit Title</a>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Watermark</span>
                                        </label>
                                    </div>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Contact Image</span>
                                        </label>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                <div class="thumbnail">
                                <img src="images/user_thumb.jpg" alt="" class="img-responsive">
                                </div>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Delete</a>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Edit Title</a>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Watermark</span>
                                        </label>
                                    </div>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Contact Image</span>
                                        </label>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                <div class="thumbnail">
                                <img src="images/user_thumb.jpg" alt="" class="img-responsive">
                                </div>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Delete</a>
                                 <a href="" class="btn btn-default btn-xs margin-bottom-15">Edit Title</a>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Watermark</span>
                                        </label>
                                    </div>
                                    <div class="form-group form_group_checkbox">
                                        <label class="">
                                            <input type="checkbox"/>
                                            <span class="lbl padding">Contact Image</span>
                                        </label>
                                  </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    </div>
                  
                    
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            
            
         
            
            
            <!-- Portals Modal -->
            <div class="modal fade" id="portals" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select Portals</h4>
                    <p>By default all portals are selected. Please select which portal you wish to remove the listing from. This will de-activate the listing from the XML feed for that particular portal. Please note you need to contact each portal separately to setup individual accounts with each portal.</p>
                  </div>
                  <script type="text/javascript">

      $(function(){
        $('#portals input').click(function(){
				
				var value = [];
                var portalValue = [];
				var count = 0;
				$('#portals #global_portals input:checked').each(function() {
					value+='{'+this.value+'}';
					count++;
				});
                                $('#portals #crm_portals input:checked').each(function() {
                                    portalValue.push(this.value);
                                    count++;
				});
				
				$('#portals_name').val(value);
                 $('#portals_name_arr').val(JSON.stringify(portalValue));
				$('#portals_count').val(count);
        });
        

      });    
    
    </script>
                  <form id="portals">
                  	<div id="global_portals">
                  		<div class="modal-body">
                    <div class="form-group">
                        <label class="">
                            <input type="checkbox" value="dubizzle" id="portal_dubizzle"/>
                            <span class="lbl padding">Dubizzle</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="">
                            <input type="checkbox" value="JustRentals" id="portal_JustRentals"/>
                            <span class="lbl padding">JustRentals</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="">
                            <input type="checkbox" value="JustProperty" id="portal_JustProperty"/>
                            <span class="lbl padding">JustProperty</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="">
                            <input type="checkbox" value="propertyfinder" id="portal_propertyfinder"/>
                            <span class="lbl padding">Propertyfinder</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="">
                            <input type="checkbox" value="bayut" id="portal_bayut"/>
                            <span class="lbl padding">Bayut</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="">
                            <input type="checkbox" value="GNproperty" id="portal_GNproperty"/>
                            <span class="lbl padding">GNproperty</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="">
                            <input type="checkbox" value="Zoopla" id="portal_Zoopla"/>
                            <span class="lbl padding">Zoopla</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="">
                            <input type="checkbox" value="rightmove" id="portal_rightmove"/>
                            <span class="lbl padding">Rightmove</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="">
                            <input type="checkbox" class="own_portal" value="feed_<?php echo $this->session->userdata('client_id');?>" id="portal_feed_<?php echo $this->session->userdata('client_id');?>"/>
                            <span class="lbl padding">Own Website</span>
                        </label>
                    </div>
                  </div>
                 	 </div>
                  </form>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save and Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            
            
    
            <!-- Columns Modal -->
            <div class="modal fade" id="columns" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Manage Columns</h4>
                  </div>
                  
                  <div class="modal-body">
                  <div class="row" id="columns_list">
                  <!--show columns check boxes here-->
                  
                  </div>
                  <div><span id="total_active_columns" style="font-weight:bold;">0</span> out of <span id="total_editable_columns" style="font-weight:bold;"></span> columns are selected</div>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="save_columns_settings"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-primary" id="reset_columns_settings"><i class="fa fa-refresh"></i> Reset</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                  </div>
                </div>
              </div>
            </div> 
            
             <!-- Share Option Modal -->
            <div class="modal fade" id="share_excel_all" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Download Excel</h4>
                    <p>To download all listings as excel,Please click the icon. </p>
                  </div>
                  
                  <div class="modal-body">
                  
                     <div align="center" id="ExportToCSVALL"></div>
                    
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
			<div class="modal fade" id="share_pdf_selected" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Download PDF Brochure</h4>
                    <p>Would you like to download the PDF brochure with your details or with the details of the listing agent? </p>
                  </div>
                  
                  <div class="modal-body">
                   <div id='exportPDF_div'>
    <form id="exportPdfForm" name="exportPdfForm" method="post" action="<?php echo base_url();?>generate/PDFbrochure?export=yes">
<input type="text" name="shareType" id="shareType" value="exportPDF" hidden>
<input type="hidden" name="listtype" id="listtype" value="1" />
<input type="hidden" name="listrand" id="listrand" value="" />
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="">
                               <input id="my_details" name="agent_details" type="radio"  value="0">
                                <span class="lbl padding">My Details</span>
                            </label>                            
                        </div>
                        <h5 class="text-primary"><label style="font-weight:bold; color: #0F4B87;" id="myName" name ="myName"></label></h5>
                        <p><label  id="myTitle" name ="myTitle"></label></p>
                        <p><label  id="myMobile" name ="myMobile"></label></p>
                        <p><a href="mailto:someone@example.com"><label  id="myEmail" name ="myEmail"></label></a></p>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="">
                                <input id="ag_details" name="agent_details" type="radio" value="1">
                                <span class="lbl padding">Listing agents details</span>
                            </label>                            
                        </div>
                        <h5 class="text-primary"><label style="font-weight:bold; color: #0F4B87;" id="agentName" name ="agentName"></label></h5>
                        <p><label  id="agentTitle" name ="agentTitle"></label></p>
                        <p><label  id="agentMobile" name ="agentMobile"></label></p>
                        <p><a href="mailto:someone@example.com"><label id="agentEmail" name ="agentEmail"></label></a></p>
                      </div>
                        <div class="col-md-12">
                        <label style="font-weight:bold; color: #0F4B87;" id="listingTitle" name="listingTitle" ></label>
                        <input type="hidden" name="exportPDFIds" id="exportPDFIds" value="0">
                      </div>
                      <div class="col-md-12">
                      
                        <button type="submit" class="btn btn-info btn-lg" name="download_button" id="download_button" onclick="setRandVal();" value="Download" > <i class="fa fa-file-pdf-o"></i>
 Download Now</button>
                      </div>
                    </div>
                    <script>
                    function setRandVal()
                    {
                    $('#listrand').val($('#rand_key').val());
					
                    }
                    </script>
                    </form>
</div>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="modal fade" id="popup_pdf_selected_popup" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Download Excel</h4>
                    <p>To download all listings as excel,Please click the icon. </p>
                  </div>
                  
                  <div class="modal-body">
                  
                      <div id="popup_pdf_selected" class="popup_block">
    					<div align="center" id="ExportToPDF">Please search first & select listings</div>
						</div>
                    
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            
           <div class="modal fade" id="sms_verification_selected_popup" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Download Excel</h4>
                    <p>To download all listings as excel,Please click the icon. </p>
                  </div>
                  
                  <div class="modal-body">
                  
                     <!--<div id="sms_verification_selected" class="popup_block">
    <div id="export_selected_popup" style="display:none">
        <div align="center" id="ExportToCSV">Please search first</div>
        <div align="center" id="ExportToCSVSelected">Please search first</div>
    </div>
    <div id="sms_verification_selected_window"></div>
</div>-->
					<div id="popup_pdf_selected">
    					<div align="center" id="ExportToCSV">Please search first & select listings</div>
						</div>
                    
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
           
           <!--email pdf-->
			<div class="modal fade" id="sendemail_pdfbroucher_popup5" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Email Brochures</h4>
                    <p>Send a pdf brochure for your selected listing here. Complete the fields below and click the send email button. </p>
                  </div>
                  
                  <div class="modal-body">
                  <script type="text/javascript">
    //send email

    $(document).ready(function() {
        $('#emailPdfForm').ajaxForm({
            beforeSubmit: function() {
                var sending = $("#emailPdfForm").validate(
                { 
                    rules: {
                        sendto: {email:true},
                        subject:{required:true}
                    },
                    messages: {
                        sendto:"Enter a valid Email",
                        subject:"Please enter a subject"
                    }
                }).form() ;
						
                if(sending==true){
                    $('#progressPDF_div').css('display','block');
                    $('#sendPDF_div').hide(1000);
                    $('#emailsentPDF').css('display','none');
                }
					
                return sending;
				
            },
            success: function() {
                $('#progressPDF_div').css('display','none');
                $('#sendPDF_div').show(1000);
                $('#emailsentPDF').css('display','block');
                setTimeout(function() {  
                	$('#emailsentPDF').fadeOut("slow");
                }, 3000);
            }
        });
    });
		  
    //end send email    
</script>
                    <div class="modal-body has-form">
	<div id='sendPDF_div' class="margin-left-10">
	    <form id="emailPdfForm" name="emailPdfForm" method="post" class="form-horizontal" action="<?php echo base_url();?>generate/emailPDF?international=">
	        <input type="text" name="shareType" id="shareType" value="emailPDF" hidden>
	        <div class="row popup_description"><!--Send a pdf brochure for your selected listing here. Complete the fields below and click the send email button.--></div>
	            <div class="form-group">
            <div class="col-md-3 col-xs-12 form-label">Email To</div>
            <div class="col-md-9 col-xs-12">
              <input type="text" name="sendto" id="sendto" value="" class="required form-control"/>
          </div>
      </div>
      <div class="form-group">
        <div class="col-md-3 col-xs-12 form-label">CC</div>
            <div class="col-md-9 col-xs-12">
                <input type="text" name="ccto" id="ccto" value="" class=" form-control"/>
            </div>
     </div>
     <div class="form-group">
        <div class="col-md-3 col-xs-12 form-label">Email From</div>
            <div class="col-md-9 col-xs-12 one-row">
                
                 <label class="">
                               <input name="sentfrom" id="sentfromUser3"  checked="checked" value="mahmoud.k@royalhome.ae" type="radio"  >
                                <span class="lbl padding">mahmoud.k@royalhome.ae</span>
                            </label> <br />
                 <label class="">
                               <input id="sentFromCompany3" name="sentfrom" type="radio"  value="property@royalhome.ae">
                                <span class="lbl padding">property@royalhome.ae</span>
                            </label>    
                
                
            </div>
    </div>
    <div class="form-group">
        <div class="col-md-3 col-xs-12 form-label">Subject</div>
            <div class="col-md-9 col-xs-12">
                  <input type="text" name="subject" id="subject" value="Requested Property Files" class="required form-control"/>
            </div>
    </div>
   	<div class="form-group">
	                <div class="col-md-3 col-xs-12 form-label">Attachment(s)</div>
	                <div class="col-md-9 col-xs-12"><label id="email_count">0</label>
	                	</div>
	</div>
    <div class="form-group">
        <div class="col-md-3 col-xs-12 form-label">Show Signature</div>
            <div class="col-md-9 col-xs-12">
                
                  <label class="">
                                <input type="checkbox" name="show_signature" id="show_signature">
                                <span class="lbl padding"> </span>
                            </label>
            </div>
    </div>
    <div class="form-group">
        <div class="col-md-3 col-xs-12 form-label">Message</div>
        <div class="col-md-9 col-xs-12">
        	<input style="display:none;" name="emailPDF" id="emailPDF" alt="">
            <textarea name="message" id="message" cols="30" rows="5" class=" form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
		<div class="col-md-12 col-xs-12 form-label-heading">  Would you like to send the PDF brochure with your details or with the details of the listing agent?</b></div>
	</div>
	<div class="form-group">
	</div>
    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="">
                               <input id="my_details2" name="agent_details2" type="radio"  value="0">
                                <span class="lbl padding">My Details</span>
                            </label>                            
                        </div>
                        <h5 class="text-primary"><label style="font-weight:bold; color: #0F4B87;" id="myName2" name ="myName2"></label></h5>
                        <p><label  id="myTitle2" name ="myTitle2"></label></p>
                        <p><label  id="myMobile2" name ="myMobile2"></label></p>
                        <p><a href="mailto:someone@example.com"><label  id="myEmail2" name ="myEmail2"></label></a></p>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="">
                                <input id="ag_details2" name="agent_details2" type="radio" value="1">
                                <span class="lbl padding">Listing agents details</span>
                            </label>                            

                        </div>
                        <h5 class="text-primary"><label style="font-weight:bold; color: #0F4B87;" id="agentName2" name ="agentName2"></label></h5>
                        <p><label  id="agentTitle2" name ="agentTitle2"></label></p>
                        <p><label  id="agentMobile2" name ="agentMobile2"></label></p>
                        <p><a href="mailto:someone@example.com"><label id="agentEmail2" name ="agentEmail2"></label></a></p>
                      </div>
                        
                      
                    </div>
       
    	
        	
    	
	</div>
	<div id='progressPDF_div' style='display:none;' class="text-center">
	    <div><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="48" height="48" /></div>
	    <div>Sending email, please do not close the window.</div>
	</div>
</div>
					
                    
                  </div>
                  
                  <div class="modal-footer">
	<div id="emailsentPDF" class="greenText pull-left margin-top-10" style="display:none;">Email sent Successfully</div>
    <button type="submit" name="button" id="button" value="Send" class="btn btn-success" >Send email</button>
</div>
</form>
                </div>
              </div>
            </div>       
            
            <!--email html-->
            <div class="modal fade" id="sendemail_html_popup17" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Email HTML</h4>
                    <p>You can email properties as an HTML format. The preview of the e-mail is shown on the right. </p>
                  </div>
                  
                  <div class="modal-body">
                  <script type="text/javascript">
    //send email

    $(document).ready(function() {
        $('#emailHTMLForm').ajaxForm({
            beforeSubmit: function() {
                 
                var sending = $("#emailHTMLForm").validate(
                { 
                    rules: {
                        sendto: {email:true},
                        subject:{required:true}
                    },
                    messages: {
                        sendto:"Enter a valid Email",
                        subject:"Please enter a subject"
                    }
                }).form() ;
						
                if(sending==true){
                    $('#sendHTML_div_html').hide(500);
                    $('#progressHTML_div_email').css('display','block');
                    $('#emailsentHTMLSuccess').css('display','none');
                }
					
                return sending;
					
                $('#emailsentHTMLSuccess').text('Please wait...');
            },
            success: function() {
                $('#progressHTML_div_email').css('display','none');
                $('#html_after_send').css('display','block');
                

            }
        });
    });
		  
    //end send email    
</script>
                    <div class="modal-body has-form">
	<div id='sendHTML_div_html' class="margin-left-10">
	    <form id="emailHTMLForm" name="emailHTMLForm" method="post" class="form-horizontal" action="<?php echo base_url();?>generate/emailHTML?email=yes&international=">
	       
	        <div class="row popup_description"><!--Send a pdf brochure for your selected listing here. Complete the fields below and click the send email button.--></div>
	            <div class="form-group">
            <div class="col-md-3 col-xs-12 form-label">Email To</div>
            <div class="col-md-9 col-xs-12">
              <input type="text" name="sendto" id="sendto" value="" class="required form-control"/>
          </div>
      </div>
      <div class="form-group">
        <div class="col-md-3 col-xs-12 form-label">CC</div>
            <div class="col-md-9 col-xs-12">
                <input type="text" name="ccto" id="ccto" value="" class=" form-control"/>
            </div>
     </div>
     <div class="form-group">
        <div class="col-md-3 col-xs-12 form-label">Email From</div>
            <div class="col-md-9 col-xs-12 one-row">
                
                 <label class="">
                               <input name="sentfrom" id="sentfromUser3"  checked="checked" value="mahmoud.k@royalhome.ae" type="radio"  >
                                <span class="lbl padding">mahmoud.k@royalhome.ae</span>
                            </label> <br />
                 <label class="">
                               <input id="sentFromCompany3" name="sentfrom" type="radio"  value="property@royalhome.ae">
                                <span class="lbl padding">property@royalhome.ae</span>
                            </label>    
                
                
            </div>
    </div>
    <div class="form-group">
        <div class="col-md-3 col-xs-12 form-label">Subject</div>
            <div class="col-md-9 col-xs-12">
                  <input type="text" name="subject" id="subject" value="Requested Property Files" class="required form-control"/>
            </div>
    </div>
   	
    <div class="form-group">
        <div class="col-md-3 col-xs-12 form-label">Show Signature</div>
            <div class="col-md-9 col-xs-12">
                
                  <label class="">
                                <input type="checkbox" name="show_signature" id="show_signature">
                                <span class="lbl padding"> </span>
                            </label>
            </div>
    </div>
    <div class="form-group">
        <div class="col-md-3 col-xs-12 form-label">Message</div>
        <div class="col-md-9 col-xs-12">
        	<input style="display:none;" name="emailHTML" id="emailHTML" alt="" type="text">
                        <input style="display:none;" name="sendEMAIL" id="sendEMAIL" value="1" alt="" type="text">
                        <input style="display:none;" name="msg1" id="msg1"  alt="" type="text">
	            <textarea name="message" id="message" cols="30" rows="5" class=" form-control"></textarea>
        </div>
    </div>
    
       
    	
        	
    	
	</div>
	<div id='progressHTML_div_email' style='display:none;' class="text-center">
	    <div><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="48" height="48" /></div>
	    <div>Sending email, please do not close the window.</div>
	</div>
</div>
					
                    
                  </div>
                  
                  <div class="modal-footer" id="html_modal_footer">
	<div id="emailsentHTMLSuccess" class="greenText pull-left margin-top-10" style="display:none;">Email sent Successfully</div>
    <button type="submit" name="button" id="button" value="Send" class="btn btn-success" >Send email</button>
</div>
</form>
                </div>
              </div>
            </div>
                 
            <!--end share pop option model-->

<script>
    $(document).ready(function(){
         $('#sms_verification_popup_all_1, #sms_verification_popup_all_2').click(function(){
            $("#export_all_popup").css("display","none");
            $("#sms_verification_window").css("display","");
        });
    
         $('#sms_verification_popup_selected').click(function(){
            $("#export_selected_popup").css("display","none");
            $("#sms_verification_selected_window").css("display","");
        });
        
        $('#sms_pdf_verification_popup_all').click(function(){
            $("#pdf_export_all").css("display","none");
            $("#sms_pdf_verification_window").css("display","");
        });
        
        $('#sms_pdf_verification_popup_selected').click(function(){
            $("#pdf_export_selected").css("display","none");
            $("#sms_pdf_verification_selected_window").css("display","");
        });
    });
</script>
<script type="text/javascript" src="<?php echo site_url();?>js_module/common.js?ts=11234"></script> 
<script type="text/javascript" src="<?php echo site_url();?>js_module/sales-rentals.js?ts=11234"></script>
<script src="<?php echo site_url();?>uploadifive/jquery.uploadifive.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo site_url();?>js_module/ajaxfileupload.js?r=2.1.6"></script>
<script type="text/javascript" src="<?php echo site_url();?>js_module/upload_api.js?ts=1258"></script>
<script>
$(document).ready(function() { 

					 $(".info, #groupss").tooltip({
                            extraClass: "tooltip",
                              showURL: false 
                               });
                               $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
                                 formDataChange=false;
                                  $("#size, #price, #plot_size, #baths, #mobile, #phone, #price_1, #price_2, #price_3, #price_4").numeric();
                                    $("#price").keyup( function () {
                                        $('#frequency').attr('required','required');
                                    } );
            
                                disable_popup();
								 $("#new").click(function () {
                            $('#status').val('2');
                            $("#status option[value=3]").remove();
                             });
                    /* calucte the other media count */
                    $('#video_embed_code, #360_embed_code, #audio_embed_code, #virtual_tour_embed_code, #qr_code_link').keyup( function () {
                update_media_count();
                    }); 
					 $("#edit").click(function () {
                                             
//                     dibaled beds for 'Hotel apartment' and 'Land Commercial'           
                       if($('#category_id').val() == '7' || $('#category_id').val() == '9' || $('#category_id').val() == '10' || $('#category_id').val() == '11'){
                            $('#beds').attr('disabled',true);    
                            }
                             
                    });
                  $("#new").click(function () {
                    	// IE Issue
						
                    	if($('#agent_id').hasClass('has-error')){
							$('#agent_id').val(current_agent_id);
							$('#agent_id').selectpicker('val', current_agent_id);
                    		$('#agent_id').removeClass('has-error');
							//$('.selectpicker').selectpicker('refresh');
                    	}
						$('#agent_id').val(current_agent_id);
                    	$('#floor_plans').val("0");

                        $("#top_score_wrap").hide();
                       // $("#area_information")[ 0 ].reset();
                        $('div[id^="extra_ai_"]').html("");
                        $("#display_count").text('0');
                        $("#desc_char_count").html('0');
                        $("#title_char_count").html('0');
                        $("#listings_price_id").val('');
                        $("#price").addClass("required form_fields_error");
                        $('#cheques').removeClass("required form_fields_error");
						 $("#cheques").prop("disabled", false);  
                    });
					
					
					
	   
	     $(document.body).on("click", '.delete_savedsearch', function() { 
                        id=$(this).attr('id');
                        if(confirm('Are you sure you want to delete?')){
                            $.post("https://crm.propspace.com/listings/delete_savedsearch/", { 
                                id:   id
                            },
                            function(data) {
                         
                                $('#search_entry_'+id).remove();
                            });
                        }
                    });
					
});		
 $(document).ready(function(){
                    var this_screen_listing_id='';
                    if(this_screen_listing_id){
                        getSingleRow(this_screen_listing_id,'listings');
                        $('#edit').css('display', 'inline');
                    }
                });			
</script>
<script>
 /* Locations Dropdown Functions */
                    $(document).ready(function() {                        
				    jQuery('#region_id').change(function(){
			            var value = jQuery(this).val() ;
			            var snum_dropdown ='';
			            snum_dropdown += '<option value="" selected="selected">Select</option>';
			            $.each(location_json_array[value], function(key, val) {
			                snum_dropdown += '<option value="'+ key*1 +'" >'+ val +'</option>'; 
			            });
			             
			            jQuery('#area_location_id').html(snum_dropdown);
			            jQuery('#sub_area_location_id').val('');
			            jQuery('#area_location_id').attr('disabled',false);
						$('.selectpicker').selectpicker('refresh');
			            
			            //set region
			            //if emirate is changed set coordinates of the emirate      
			            setEmirate(value);
			        }); 
    
				    jQuery('#area_location_id').change(function(){
				        var value = jQuery(this).val() ;				
				        var snum_dropdown ='';
				        snum_dropdown += '<option value="0" selected="selected">Select</option>';
				    
				        if (sub_location_json_array[value]) {
				            $.each(sub_location_json_array[value], function(key, val) {
				                snum_dropdown += '<option value="'+ key*1 +'" >'+ val +'</option>'; 
				            });
				        }
				        jQuery('#sub_area_location_id').html(snum_dropdown);
				        jQuery('#sub_area_location_id').attr('disabled',false);
						$('.selectpicker').selectpicker('refresh');
				    	//if the location is changed set the coordinates of the new location
				        //area_location_id is triggered by js to differentiate between js trigger and user trigger
				        if($('#category_id').prop('disabled')==false) {
				            setCoordinates(value);
				        }
				    }); 
        
			        jQuery('#sub_area_location_id').change(function(){
			            var value = jQuery(this).val() ;
						$('.selectpicker').selectpicker('refresh');
			            //if the sublocation is changed set the coordinates of the new sublocation
			            setCoordinates(value);      
			        });

                    });
	
		 
		  /* Insert / Update function */
		   // wait for the DOM to be loaded 
        $(document).ready(function() { 
		 function validatePriceOptions() {
                        if($(".cheques_option, .price-input").hasClass("form_fields_error")){
                            return false;
                        }
                        return true;
                    }
		var lookup   = '';
        var validate     = '';
            // bind 'myForm' and provide a simple callback function 
			 $('#myForm').ajaxForm({
				
				 beforeSubmit : function() {
					 
					 //check for look up either this is already exist or not
					   var priceCheck = validateCheques();
                                if(!priceCheck) {
                                    $('#popup-prices').trigger("click");
                                    return false;
                                }
                                if($('#ref').val()=='' || unitTemp!=$("#unit").val() || category_idTemp!=$("#category_id").val() || region_idTemp!=$("#region_id").val() || area_location_idTemp!=$("#area_location_id").val() || sub_area_location_idTemp!=$("#sub_area_location_id").val() || street_noTemp!=$("#street_no").val()){
                                    var lookup   = '';
                                    var validate     = '';
                                    $.ajax({
                                        async: false,
                                        url: mainurl+'listings/lookup/?cat='+$('#category_id').val()+'&region_id='+$('#region_id').val()+'&loc='+$('#area_location_id').val()+'&subloc='+$('#sub_area_location_id').val()+'&unit='+$('#unit').val()+'&street_no='+$('#street_no').val()+'&type='+$('#type_dummy').val(),
                                        success: function(data) {
                                            if(data>0){
                                                lookup = false;
                                                alert('Another listing with same Unit No, Category, Location and Type found in your company database.')
                                            }
                                            else{
                                                lookup = true;
                                            }
                                        }
                                    })
                                }else{
                                    lookup = true;
                                }
					 
					 
					 
                             validate =  $("#myForm").validate({rules: { price: { number: true }, size: { number: true },
							     category_id: {
									  required: true
									},
									region_id: {
									  required: true
									}

							 
							 } , errorClass: 'form_fields_error', 
							  errorPlacement: function(error, element) {
                                     console.log(element.attr('id'));
									 if(element.attr('id') == "category_id")
									 {
										// error.insertAfter(element);
									 }
                                         $('#errortxt').text('Please complete all required fields');
                                        $('#errorMsg').animate({ 'color': 'red'}, "slow");
                                        $('#errorMsg').fadeIn("slow");
                                   
                                        setTimeout(function() {  
                                            $('#errorMsg').fadeOut("slow");
                                            $('#errorMsg').animate({ 'color': 'red'}, "slow");
                                        }, 5000);
                                        //alert('Please fill the required fields')
									
                                    
                                    }}).form() ;
									
									
									
									 if(lookup && validate ){
                                                            return true;
														
														 
                                                        } else {
															
                                                            return false;
                                                        }
											 },
							  						data:{images_ids:window.arr_images},
                                                    target: '#successtxt',
                                                    async: false,
                                                    success: function(data) {
														

                                                        if(data=='e01'){
                    
                                                            var unset_fields = '';
                                                            var comma = '';
                                                            if($('#region_id').val()==''){
                                                                unset_fields = comma+"Emirate";
                                                                comma = ', '
                                                            }
                                                            if($('#area_location_id').val()==''){
                                                                unset_fields = comma+"Location";
                                                                comma = ', '
                                                            }
                                                            if($('#price').val()==''){
                                                                unset_fields = comma+"Price";
                                                                comma = ', '
                                                            }
                                                            if($('#unit').val()==''){
                                                                unset_fields = comma+"Unit";
                                                                comma = ', '
                                                            }
                                                            if($('#agent_id').val()==''){
                                                                unset_fields = comma+"Agent";
                                                                comma = ', '
                                                            }
                                            alert('The listing could not be saved, Please ensure all required values are set ('+unset_fields+'). If this is incorrect, email at support@propspace.com');
                                                        }else{
                                                            if(screenname == 'quality_score') {
                                                                fnRefreshDatatabe('listings_quality_table');
                                                            }
                                                            else {
                                                                fnRefreshDatatabe('listings_row');
                                                            }
                                                            formDataChange=false,
                                                            descFlag=false;
                                                            if($('#ref').val()==''){ 
                                                                $.ajax({
                                                                    async: false,
                                                                     url: mainurl+'common/getlastid/rentals',
                                                                    success: function(data) {
                                                                        last_id=data;
                                                                    }
                                                                });
                                                            }
                                                            $("#cancel").click(),
															$('#successtxt').text('To edit or add new record please click on the edit or new button'),
                                                            $('#successMsg').animate({ 'color': '#49AC44'}, "slow"),
                                                            $('#successMsg').fadeIn("slow"),
                                                            setTimeout(function() {  
                                                                $('#successMsg').fadeOut("slow")
                                                            }, 5000);
                                                        }
                                                    
														
														}
			});						
			
      });	
	     
											/* Fetch single item details */
                                            var last_id = '';
                                            function getSingleRow(id,type, callback){
                                                var ts = Math.round((new Date()).getTime() / 1000);
                                                
                                                if(type==undefined){
                                                    type = 'listings';
                                                }
                                                $('#Save, #cancel, #update').css('display', 'none'); 
                                                $('#view_matching_leads_link').css('display', 'inline-block'); 
                                                $('#new').css('display', 'inline');
                                                $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');     
                                                $("#shownotes, #showDocuments").html('');
                                                $("#showimages").html('Loading...');
                                                $("#photos").val(0);
                                                $("#myForm")[ 0 ].reset();
                                                
                                                $('#tabs_image').attr('image_type','');
                                                $("#images_lst").css('display','');
                                                $("#images_floor").css('display','none');
                                                $('#tab_n1').removeClass('inactive');
                                                $('#tab_n1').addClass('active');
                                                $('#tab_n2').removeClass('active');
                                                $('#tab_n2').addClass('inactive');

                                                arr_images.length = 0; //reset the array for images
                                                $.getJSON(mainurl+"listings/getSingleRow/"+id+"/"+type+"/?ts="+ts, function(json){
                                                    if(callback) {
                                                            callback(json);
                                                        }
                                                    $.each(json, function(key, val) {
                                                        if(key == 'list_portals') {
                                                            $("#portals_name_arr").val(val);
                                                        }
                                                        $("#"+key).val(val);
                                                    });
                                                    if(json.name && json.name != "") {
                                                        $("#title_char_count").html(json.name.length);
                                                    }
                                                    else {
                                                        $("#title_char_count").html("0");
                                                    }

                      
                                            $('#edit, #copy_listing_span').css('display', 'none');
                                            $('#sharingdata').text('You cannot edit this listing. This listing belongs to another user.');
                                            $('#sharingdata').css('display', '');
                                            <!-- SID CHANGE $('#edit').css('display', 'inline'); -->
                                                                                                
                            
                                       if(0 == 0 && (1==2 || 1==1 ||  json.agent_id == 1448804) ){
                                           $('.sms_owner_link').show();
                                       } else {
                                           $('.sms_owner_link').hide();
                                       }                            
                                                                    /* set last id to select row on upldate/insert*/
            
                                                                    last_id = json.id;
                
                     
                                                                    /* get notes function */
                                                                    $("#notes, #notesx, #leads_notes").val('');
                                                                    if(json.notes!=''){
                                                                        plot_notes('listings', '['+json.notes+']');
                                                                    }
                                                                    
                                                                    unitTemp = json.unit;
                                                                    category_idTemp = json.category_id;
                                                                    region_idTemp = json.region_id;
                                                                    area_location_idTemp = json.area_location_id;
                                                                    sub_area_location_idTemp = json.sub_area_location_id;
                                                                    street_noTemp = json.street_no;
                     
                                                                    $('#prop_furnish').val(json.furnished);
                                                                    $('#flcheck').val(json.featured);
                            
                                                                    $('#strno').val(json.strno);
                                                                    //add the ID to copy submit forms
                                                                    $('#copy_rentals_id').val(json.id);
                                                                    $('#copy_sales_id').val(json.id);
                                                                    /* hide buttons for external listings */
                                                                    
                                                                      if(json.category_id==3 || json.category_id==4 || json.category_id==6 || json.category_id==12){    
                                                                        $("#fitted, #fitted_label").css('display', '');
                                                                        $("#beds, #beds_label").css('display', 'none');
                                                                    }else{
                                                                        $("#fitted, #fitted_label").css('display', 'none');
                                                                        $("#beds, #beds_label").css('display', '');
                                                                    }
                            
                                                                    if(type=="archived"){
                                                                        $('#edit, #new').css('display', 'none');
                                                                        $('#sharingdata').text('You cannot edit this archived listing. To edit it, click Actions - Unarchive to move the listing to the Current Listings tab.');
                                                                        $('#sharingdata').css('display', '');
                                                                    }
                                                                    if(type!="archived" && 1<=2 && true){
                                                                        $('#edit, #new, #add_options_div, #view_options_div, #copy_listing_span').css('display', '');
                                                                        $('#sharingdata').css('display', 'none');
                                                                    }
                            
                                                                    /* % age calculation */
                                                                    if(json.deposit>0 & json.price>0){
                                                                        var depost_percenatge = (json.deposit/json.price)*100;
                                                                        $('#deposit_percentage').val(depost_percenatge.toFixed(2));
                                                                    }
                                                                    else{
                                                                        $('#deposit_percentage').val('0');
                                                                    }
                                                                    if(json.client_id==1743){
                                                                        if(json.commission>0 & json.price>0){
                                                                            var commission_percentage = (json.commission/json.price)*100;
                                                                            $('#commission_percentage').val(commission_percentage.toFixed(2));
                                                                        }else{
                                                                            $('#commission_percentage').val('0');
                                                                        }
                                                                    }
                                                                    var unit_size_price = json.price/json.size ;
                                                                    $('#unit_size_price, #unit_size_price_2').val(unit_size_price.toFixed(2));
                                                                    /* end */
                                                                    if(json.managed==1){
                                                                        $("#managed").attr('checked', 'checked');
                                                                        $("#managed").val(1);}
                                                                    else{
                                                                        $("#managed").attr('checked',false);
                                                                        $("#managed").val(1);}
                                                                    if(json.exclusive==1){
                                                                        $("#exclusive").attr('checked', 'checked');
                                                                        $("#exclusive").val(1);}
                                                                    else{
                                                                        $("#exclusive").attr('checked',false);
                                                                        $("#exclusive").val(1);}
                                                                    if(json.tenanted==1){
                                                                        $("#tenanted").attr('checked', 'checked');
                                                                        $("#tenanted").val(1);}
                                                                    else{
                                                                        $("#tenanted").attr('checked',false);
                                                                        $("#tenanted").val(1);}
                                
                                                                    if(json.price_of_application==1){
                                                                        $("#price_of_application").attr('checked', 'checked');
                                                                        $("#price_of_application").val(1);}
                                                                    else{
                                                                        $("#price_of_application").attr('checked',false);
                                                                        $("#price_of_application").val(1);}
                                                                    
                                                                    if(json.shared==1){
                                                                        $("#shared").attr('checked', 'checked');
                                                                        $("#shared").val(1);}
                                                                    else{
                                                                        $("#shared").attr('checked',false);
                                                                        $("#shared").val(1);}
                                                                    
                                        
                            
                                                                   
                                                                    /*update the additional info field */
                                                                    $("#add_info").val($("#prop_status option[value='"+json.prop_status+"']").text());
                                                                    //no of features & portals
                                                                    if(json.agent_rent_sold!=0){
                                                                        $('#agent_rent_sold').css('display','');
                                                                    }else{
                                                                        $('#agent_rent_sold').css('display','none');
                                                                    }
                                                                    if(json.reffered_by_agent!=0){
                                                                        $('#reffered_by_agent').css('display','');
                                                                    } else {
                                                                        $('#reffered_by_agent').css('display','none');
                                                                    }
            
                                                                    // get descrition
                                                                    var description_demo= $.trim(convertHtmlToText(json.description));
                                                                    $("#description_demo").val(description_demo);
                                                                    if(description_demo!=''){
                                                                        var count=countWords(description_demo, 'display_count');
                                                                    }
                                                                    else{
                                                                        $("#display_count").text('0');
                                                                        $("#desc_char_count").html('0');
                                                                    }
                                                                    // show title on bar
                                                                    var beds = '';
                                                                    if(json.beds!=0) {   beds=' '+json.beds+'-bedroom ' }
                                                                    $("#title").text('Unit : '+json.ref+' '+beds+' '+$('#category_id option:selected').text()+ ' AED '+json.price.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") )
                                                                    $('#gistler-ref').text("Gistler reference ID: " +json.id);
                                                                    // break up features and portals
                                                                    //features
                                                                    if(json.features_id==''){
                                                                        $("#features_count").val(0);
                                                                        $("#features input").attr("checked", false);
                                                                    }else{
                                                                        $("#features input").attr("checked", false);
                                                                        var features_ids = json.features_id.split('}{');
                                                                        var values = '';
                                                                        $.each(features_ids, function(id, key){
                                                                            values = key.replace("{", "");
                                                                            values = values.replace("}", "");
                                                                            $('#features #feature_'+values).attr('checked', 'checked');
                                                                        })
                                                                        $("#features_count").val((json.features_id.split('}{')).length);
                                                                    }
                                                                    //portals
                                                                    if(json.portals_name=='' && json.list_portals ==null){
                                                                        $("#portals_count").val(0);
                                                                        $("#portals input").attr("checked", false);
                                                                    }
                                                                    else if(json.portals_name=='' && json.list_portals !=null){
                                                                        if(json.list_portals.length == 0){
                                                                            $("#portals_count").val(0);
                                                                            $("#portals input").attr("checked", false);
                                                                        }
                                                                        else {
                                                                            $("#portals_count").val(json.list_portals.length);
                                                                            $("#portals input").attr("checked", false);
                                                                            $.each(json.list_portals, function(id, value) {
                                                                                $("#prtl_"+value).attr("checked", true);
                                                                            })
                                                                        }
                                                                    }else{
                                                                        $("#portals input").attr("checked", false);
                                                                        var portals_names = json.portals_name.split('}{');
                                                                        var values = '';
                                                                        var count_portals = 0;
                                                                        var arr_portals = [];
                                                                        $.each(portals_names, function(id, key){
                                                                            values = key.replace("{", "");
                                                                            values = values.replace("}", "");
                                                                            $('#portals #global_portals #portal_'+values).attr('checked', 'checked');
                                                                            $('#portals #global_portals #portal_feed_'+values).attr('checked', 'checked');
                                                                            if(($('#portals #global_portals #portal_'+values).length > 0 || $('#portals #global_portals #portal_feed_'+values).length > 0)
                                                                                    && (arr_portals.indexOf(values) < 0) ) {
                                                                                count_portals++;
                                                                                arr_portals.push(values);
                                                                            }
                                                                        });
                                                                       
                                                                        var portal_crm = json.list_portals;
                                                                        if(json.list_portals && json.list_portals.length){
                                                                               $.each(portal_crm, function(key, val){
                                                                                $('#portals #crm_portals #prtl_'+val).attr('checked', 'checked');
                                                                             });
                                                                             $("#portals_count").val(parseInt(count_portals) + parseInt(json.list_portals.length));
                                                                        }else{
                                                                            $("#portals_count").val(parseInt(count_portals));
                                                                            }
                                                                     
                                                                        
                                                                    }
                                                                    /* mouhcine update */
                                                                    if(json.status==3){
                                                                        $("#status option[value=3]").remove();
                                                                        $('#status').append('<option value = "3" selected>Pending Approval</option>');
                                                                                                                                                    $("#status option[value=4]").remove();
                                                                            $('#status').append('<option value = "4"> Draft</option>');
                                                                            
                                                                                                                                                
                                                                    }else{ 
                                                                        $("#status option[value=3]").remove();
                                                                        $("#status option[value=4]").remove();
                                                                    }

                                                                    $("#price_1").val(json.price);
                                                                    $("#cheques_1").val(json.cheques);
                                                                    if(json.listings_price_id) {
                                                                        $("#listings_price_id").val(json.listings_price_id);
                                                                    }
                                                                    else {
                                                                        $("#listings_price_id").val("");
                                                                    }
                                                                    if(json.status==1){
                                                                        $("#status option[value=1]").remove();
                                                                        $("#status option[value=2]").remove();
                                                                        $("#status option[value=4]").remove();
                                                                        $('#status').append('<option value="1" id="approval_option" selected>unpublished</option>');
                                                                        $('#status').append('<option value="2"  >published</option>');
                                                                    }
                                                        
                                                                    if(json.status==2){
                                                                        $("#status option[value=2]").remove();
                                                                        $("#status option[value=1]").remove();
                                                                        $("#status option[value=4]").remove();
                                                                        $('#status').append('<option value="2" id="approval_option" selected>published</option>');
                                                                        $('#status').append('<option value="1"  >unpublished</option>');
                                                                    }
                                                        
                                                                    if(json.status==4){
                                                                        $("#status option[value=4]").remove();
                                                                        $('#status').append('<option value="4" id="approval_option" selected>Draft</option>');
                                                                                                                                                    $("#status option[value=3]").remove();
                                                                            $('#status').append('<option value = "3" >Pending Approval</option>');
                                                                            
                                                                                                                                            }else{
                                                                        
                                                                                                                                                
                                                                    }
                        
                                                                    /*end mouhcine*/
                            
                            
                            
                                                                    if(json.pdf_brochure!=''){
                                                                    	
                                                                        $('#pdf_download').html('<a target="_blank" class="margin-right-10 btn btn-sm blue prevHEX only-icon" href="'+json.pdf_brochure+'"></a><a id="delete_pdf" class="btn btn-sm red deleteHEX only-icon" href="# show"></a>');
                                                                    }else{
                                                                        $('#pdf_download').html('');
                                                                    }
                                                                    
                                                                    if(json.video_path!=''){
                                                                        $('#view_video, #delete_video').css('display','');
                                                                        $('#view_video').attr('href', json.video_path);
                                                                    }else{
                                                                        $('#view_video, #delete_video').css('display','none');
                                                                    }
                                                                    
                                                                    /* get the maps coordinates */
                                                                    marklisting(json.lat,json.lon);
                                                                    
                                                                    /* calucte the other media count */
                                                                    update_media_count();
                                                                    
                                                                    //get the documents of a listing
                                                                    $("#showDocuments").html('No documents found for this listing.');   
                                                                    if(json.documents){
                                                                        $("#showDocuments").html('');
                                                                        var documents = $.parseJSON('['+json.documents+']');
                                                                        //console.log(documents);
                                                                        $.each(documents, function(key, id) {
                                                                        	if(id){
                                            									$("#showDocuments").append('<div id="doc_div_'+id.document_name+'"><div class="document-list-item" ><div class="inline-block" >'+id.document_name+'</div><div  class="inline-block pull-right"></div><div class="inline-block pull-right"><a href="'+id.document_link+'" target="_blank" class="item-preview" title="View"><i class="icon-eye"></i></a> <a id='+id.document_link+' name='+id.document_name+' class="delete_list item-delete" href="# S" title="Delete"><i class="icon-trash"></i></a></div></div></div>');
                                                                        	}
                                                                        });  
                                
                                                                    }

                                                                    if(json.num_floorplans) {
                                                                        $("#floor_plans").val(json.num_floorplans);
                                                                    }
                                                                    else {
                                                                        $("#floor_plans").val("0");
                                                                    }
                                                                    
                                                                    
                                                                    plot_area_information(json.area_iformation_data);
                                                                    $('#showdata').css('color','#49AC44');
                                                                    $('#showdata').html('Record selected');
                                                                    $('#showdata').fadeIn("slow");
                                                                    setTimeout(function() {  
                                                                        $('#showdata').fadeOut("slow");
                                                                    }, 5000);
                               
        
                    
                    
                                                                    // if json has a location value and a region value, we need to get the list of locations for the region and pre-select the list to the returned value location value
                                                                    if(json.area_location_id!=0 && json.region_id!=''){             
                                                                        $('#region_id').trigger('change');          
                                                                        $('#area_location_id').val(json.area_location_id);
                                                                        formDataChange = false;
                                                                        checkDisLoc();
                                                                    }
                                                                    if(json.sub_area_location_id!=0 || json.area_location_id!=0){
                                                                        $('#area_location_id').trigger('change');
                                                                        //setTimeout($('#area_location_id').trigger('change'), 200);
																		setTimeout(function() {
        																	$('#area_location_id').trigger('change');
    																	}, 200);
                                                                        $('#sub_area_location_id').val(json.sub_area_location_id);
                                                                        // trigger area location change and set sub_loc value to json value - we call this through a function which can run on a loop if the trigger for the location list hasn't changed yet (i.e. taking some time) so we have to wait  and try again
                                                                        $('#area_location_id, #sub_area_location_id').attr('disabled', 'disabled');
                                                                        formDataChange = false;
                                                                    }
                                                                    clearStoreData();
                                                                    formDataChange = false;
                                                                    window.listing_item = json;
                                                                    if(type != "archived") {
                                                                     //   new QualityScore().renderSolidGauge(json);
                                                                    }
                                                                    else {
                                                                      //  $("#top_score_wrap").hide();
                                                                    }
                                                                }); //End json 
                                                                formDataChange = false;
                                                                                                                disable_popup();
                                                            if(type=='archived'){
                                                                enable_popup();
                                                                $("#notes").attr('disabled',false);
                                                                formEnabled = true;
                                                            }else{
                                                                formEnabled = false;
                                                            }
                                                                                                                formDataChange = false;
                                                    }
                                                                                                        
                                                    function checkDisLoc (){
                                                        if ( $('#area_location_id').is(':enabled'))  {
                                                            //alert('trying to disable loc');
                                                            $('#area_location_id, #sub_area_location_id').attr('disabled', 'disabled');
                                                            formDataChange = false;
                                                        }
                                                        else {
                                                            setTimeout(checkDisLoc(), 200); // check again in 200 milli seconds
                                                        }
    
                                                    }
                                                    function setSubLocID() {
                                                        if ( $('#area_location_id').val!='')  {
                                                            $('#area_location_id').trigger('change');
                                                            $('#sub_area_location_id').val(json.sub_area_location_id);
                                                            $('#area_location_id, #sub_area_location_id').attr('disabled', 'disabled');
                                                            formDataChange = false;
                                                        }
    
                                                        else {
                                                            setTimeout(setSubLocID(), 200); // check again in 200 milli seconds
                                                        }
    
                                                    }
        
                                                    
                                                    //End click 	
</script>
<script type="text/javascript">
                // $('#view_video').click(function(e) {
                	// e.preventDefault();
                    // $('#other_media_div').slideUp('500', function() {
                        // $('#preview_video_div').slideDown('500');
                        // $('#preview_video_div').css('display','');
                    // });
                // });
                
                // $('#hide_video, .closevideo').click(function() {
                    // $('#preview_video_div').slideUp('500', function() {
                        // $('#other_media_div').slideDown('500');
                        // $('#preview_video_div').css('display','none');
                    // });
                // });
                function ajaxFileUpload()
                {
                    if($('#document_name').val()!=''){
                        $("#loading")
                        .ajaxStart(function(){
                            $(this).show();
                        })
                        .ajaxComplete(function(){
                            $(this).hide();
                        });
                        $.ajaxFileUpload
                        ( 
                        {
                            url:'https://crm.propspace.com/listings/uploadDocuments/',
                            secureuri:false,
                            fileElementId:'listings_documents',
                            dataType: 'json',
                            data:{name: $('#document_name').val(), rand_key: $('#rand_key').val()},
                            success: function (data, status)
                            {
                                if(typeof(data.error) != 'undefined')
                                {
                                    if(data.error != '')
                                    {
                                        alert(data.error);
                                    }else
                                    {
                                        if($('#documents').val()){
                                
                                            $('#documents').val($('#documents').val()+','+data.msg);
                                
                                
                                        }else{
                                            $('#documents').val(data.msg);
                                
                                            $('#showDocuments').html('');
                                        }
                                        var documents = $.parseJSON('['+data.msg+']');
                                        $.each(documents, function(key, id) {
                                            $("#showDocuments").append('<div id="doc_div_'+id.document_name+'"><div class="document-list-item" ><div class="inline-block" >'+id.document_name+'</div><div  class="inline-block pull-right"></div><div class="inline-block pull-right"><a href="'+id.document_link+'" target="_blank" class="item-preview" title="View"><i class="icon-eye"></i></a> <a id='+id.document_link+' name='+id.document_name+' class="delete_list item-delete" href="# S" title="Delete"><i class="icon-trash"></i></a></div></div></div>');
                                        });
                            
                                        $('#document_name, #listings_documents').val('');
                                        $("#download_animation").css('display', 'none');
                                        //alert(data.msg);
                                    }
                                }
                            },
                            error: function (data, status, e)
                            {
                                alert(e);
                            }
                        }
                    )
                        return false;
                    }
                    else
                    {
                        alert('Please enter a proper title for a document.');
                        $("#download_animation").css('display', 'none');
                        return false;
        
                    }
                }
    /* upload pdf brochure */
                function ajaxFileUpload_pdf()
                {
                    $("#download_animation_media").css('display', '');
                    $("#loading")
                    .ajaxStart(function(){
                        $(this).show();
                    })
                    .ajaxComplete(function(){
                        $(this).hide();
                    });
                    $.ajaxFileUpload
                    ( 
                    {
                        url:'https://crm.propspace.com/listings/uploadPDF/',
                        secureuri:false,
                        fileElementId:'pdf_brochure_upload',
                        dataType: 'json',
                        data:{rand_key: $('#rand_key').val()},
                        success: function (data, status)
                        {   $("#download_animation_media").css('display', 'none');
                            if(typeof(data.error) != 'undefined')
                            {
                                if(data.error != '')
                                {
                                    alert(data.error);
                                }else
                                {
                                    var brochure = $.parseJSON('['+data.msg+']');
                                    $.each(brochure, function(key, id) {
                                        $('#pdf_brochure').val(id.pdf_brochure_link);
                                        $('#pdf_download').html('<a target="_blank" class="margin-right-10 btn btn-sm blue prevHEX only-icon" href="'+id.pdf_brochure_link+'"></a><a id="delete_pdf" class="btn btn-sm red deleteHEX only-icon" href="# show"></a>');
                                        update_media_count();
                                    });
                            
                                    $('#pdf_brochure_upload').val('');
                                }
                            }
                        },
                        error: function (data, status, e)
                        {
                            alert(e);
                            
                        }
                    }
                )
                    return false;
                }
                
                
                /* upload video */
                function ajaxFileUpload_video()
                {
                    $('#view_video, #delete_video').css('display','none');
                    $('#download_animation_media').css('display','');
                    $("#loading")
                    .ajaxStart(function(){
                        $(this).show();
                    })
                    .ajaxComplete(function(){
                        $(this).hide();
                    });
                    $.ajaxFileUpload
                    ( 
                    {
                        url:'https://crm.propspace.com/listings/uploadVideo/',
                        secureuri:false,
                        fileElementId:'video_path_upload',
                        dataType: 'json',
                        data:{rand_key: $('#rand_key').val()},
                        success: function (data, status)
                        {   $("#download_animation_media").css('display', 'none');
                            if(typeof(data.error) != 'undefined')
                            {
                                if(data.error != '')
                                {
                                    alert(data.error);
                                }else
                                {
                                    var brochure = $.parseJSON('['+data.msg+']');
                                    $.each(brochure, function(key, id) {
                                        $('#video_path').val(id.video_link);
                                        $('#view_video, #delete_video').css('display','');
                                        $('#view_video').attr('href', id.video_link);
										//$('#preview_video_div span').html('<embed style="width:500px; height: 300px;" src="https://crm.propspace.com/application/views/videos/'+id.video_link+'" type="video/mp4">');

                                        var video_block = $('#preview_video_div video');
                                        video_block.load();
                                        update_media_count();
                                    });
                            
                                    $('#video_path_upload').val('');
                                    
                                    //alert(data.msg);
                                }
                            }
                        },
                        error: function (data, status, e)
                        {
                            alert(e);
                        }
                    }
                )
                    return false;
                }
    
    /* delete video */
                $(document.body).on("click", '#delete_video', function() { 
                    if(confirm('Are you sure you want to delete?')){
                       
                       $.post("https://crm.propspace.com/listings/deleteVideo/", { 
                                    name: $('#video_path').val(),
                                    id: $('#id').val()
                            }, function(info) {
                                $('#view_video, #delete_video').css('display','none');
                                $('#video_path').val('');
                                update_media_count();
                            }
                        );
                    }
                });
                
        /* delete PDF */
                $(document.body).on("click", '#delete_pdf', function() { 
                    if(confirm('Are you sure you want to delete?')){
                       
                       $.post("https://crm.propspace.com/listings/deletePDF/", { 
                                    name: $('#pdf_brochure').val(),
                                    id: $('#id').val()
                            }, function(info) {
                                $('#pdf_download').html('');
                                $('#pdf_brochure').val('');
                                update_media_count();
                            }
                        );
                    }
                });
                
        /* delete documents */      
                $(document.body).on("click", '.delete_list', function() { 
                    var id      =   $(this).attr('id');
                    var name    =   $(this).attr('name');
                    //alert(id);
                    if(confirm('Are you sure you want to delete?')){
                        var po=clean_up_link(id);
                        var newstr ='';
        
                        var jsonp = $("#documents").val();
                        var myArray = jsonp.split('},');
                        // display the result in myDiv
                        for(var i=0;i<myArray.length;i++){
        
                            var str=myArray[i];
                            if(str.indexOf(po) > 0)
                            {
                
                            }
                            else
                            {
                                if(i<(myArray.length-1)){
                                    var append = '},';
                                }else{
                                    var append = '';
                                }
                                newstr += myArray[i] + append;
                                //alert(newstr)
                            }
                        }
    
                        $('#documents').val('');
        
                        $.get("https://crm.propspace.com/listings/deletedocument/"+clean_up_link(id) , function(data){
                    
                        });
        
                        var last_char = newstr[newstr.length-1];
                        if(last_char==','){
                            newstr = newstr.substring(0, newstr.length - 1);
                        }
                        $('#documents').val(newstr);
                        $('#doc_div_'+name).remove();
        
        
                    }
                    
                    
                });
                
          
            </script>
            