<script

    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsqTry_Lx1DVar-p18jpF5p-IGCgodtoU&sensor=false"></script>

  <style type="text/css">
   .tf-suggestions {
    text-decoration: underline;
} 

</style>  

<script type="text/javascript">

    

var screenname = 'listings';     

var marker = null;

var map = null;

var oTable;

var pageTitle = '<?php echo $title;?>';

var last_id = '';

 var screenname = 'listings';

    var active_tab = 'tab1';

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
      setTimeout(function() { 
            showMap();
            }, 5000);

} );

</script>





<?php

// 33,18,23,38,21,27,39,31,35,25,28,34,

$mystr = "";

if($mystr == '') $mystr = "33,18,23,38,21,27,39,31,35,25,28,34,";



?>

<script type="text/javascript">

/***********************generate columns*********************/

  $(document).ready(function() {

    	

    /* generate column list start*/

        var column_count = 0;

        var column_names = [];

    

        $.each($('#listings_row thead th'), function() {

            column_names.push($(this).clone().children().remove('span').end().text()+'|'+column_count+'|'+$(this).attr('type'))

            column_count++;

        });

        

    

        column_names.sort();

    

        var column_count = 0;

        var editable_columns = 0;



        for (column_count = 0; column_count < column_names.length; ++column_count) {

            var single_column = column_names[column_count];

            single_column = single_column.split('|')

            var column_name = single_column[0];



            var column_id	= single_column[1];

            var column_type	= single_column[2];

            var read_only_columns = new Array('2','6','8','9','10','11','41','42');

            if(column_id!=0 && column_id!=1){	

                if( $.inArray(column_id, read_only_columns) > -1 ) {

                    $('#columns_list').append("<div class='col-md-4'><div class='form-group form_group_checkbox'><input type='checkbox'" +  ' disabled="disabled" '   + "default='"+column_type +"' checked name='column_"+column_id+"' id='column_"+column_id+"' col='"+column_id+"' value='1' tabindex='33' checked><span class='lbl padding'>"+column_name+"</span></div></div>");

                } else {

                    $('#columns_list').append("<div class='col-md-4'><div class='form-group form_group_checkbox'><input type='checkbox' default='"+column_type  +"' checked name='column_"+column_id+"' id='column_"+column_id+"' col='"+column_id+"' value='1' tabindex='33'><span class='lbl padding'>"+column_name+"</span></div></div>");

                }

                editable_columns++;

            }

        }

    

        $('#total_editable_columns').html(editable_columns);

  });

	/*******************datatable js here*/

	 $(document).ready(function() {

		  /* Notification IDs */

        var notification_id = '';

        notification_id = '';

        migrated= '';

        oTable = $('#listings_row').dataTable( {

           

            "bProcessing": true,

            "sDom": 'R<>rt<ilp><"clear">',

            "aoColumnDefs": [ 

                {

                       'render': function (data, type, full, meta){

                        //check the main check box

                        $('#check_all_checkboxes').attr('checked', false);

                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';

                    },

                    "aTargets": [ 0 ]

                },

			

                //{ "bVisible": false, "aTargets": [ 44 ] },

                { "bSortable": false, "aTargets": [ 0 ] },

              

                { "bVisible" : false, "aTargets": [ <?php echo $mystr;?> ] },

			   

                

           

            ],

				"rowCallback": function( row, data ) {

				 $(row).attr("id",data.id);

				  //col first

		

	  $('td:eq(1)', row).html( '<a id="view_terminal_popup_link" href="#?w=500" rel="view_terminal_popup" listing_id="'+data.id+'"' 

	  +'landlord_id="'+data.landlord_id+'"  listing_ref="'+data.ref+'" class="popup_a" width="1100">'

	  +'<img style="margin-left:3px;" src="<?php echo base_url();?>mydata/images/terminal_icon.png?ts=10" title="Listings Terminal"></a>' );

	  

	  //set second td

	 

	   if ( data.status == 1 )

      {

	  $('td:eq(2)', row).html( '<img title="Unpublished" id="imgunpub" src="<?php echo base_url();?>mydata/images/unpublish.png">' );

	  }

	   if ( data.status == 2 )

      {

	  $('td:eq(2)', row).html( '<img title="Published" id="imgpub" src="<?php echo base_url();?>mydata/images/publish.png">' );

	  }

	   if ( data.status == 3 )

      {

	  $('td:eq(2)', row).html( '<img title="Un Approved" id="imgpub" src="<?php echo base_url();?>mydata/images/unapproved.png">' );

	  }

	  if ( data.status == 4 )

      {

	  $('td:eq(2)', nRow).html( '<img title="Draft" id="imgpub" src="<?php echo base_url();?>mydata/images/draft.png">' );

	  }

	  //end second td

	  //third td

	   if ( data.managed == 0 )

      {

	 // $('td:eq(2)', nRow).html( '<img alt="" id="imgunpub" src="images/mx.png">' );

	  $('td:eq(3)', row).html( '' );

	  }else{

	  $('td:eq(3)', row).html( '<img title="Managed property" id="imgunpub" src="<?php echo base_url();?>mydata/images/m.png">' );

	  }

	  //exclusive

	 if ( data.exclusive == 0 )

      {

	  //$('td:eq(3)', nRow).html( '<img alt="" id="imgunpub" src="images/ex.png">' );

	  $('td:eq(4)', row).html( '' );

	  }else

      {

	  $('td:eq(4)', row).html( '<img title="Exclusive Property" id="imgunpub" src="<?php echo base_url();?>mydata/images/e.png">' );

	  }

	  //share unshare

	  if ( data.shared == 0 )

      {

	 // $('td:eq(4)', nRow).html( '<img alt="" id="imgunpub" src="images/ssx.png">' );

	 $('td:eq(5)', row).html( '' );

	  }else

      {

	 // $('td:eq(4)', nRow).html( '<img alt="" id="imgunpub" src="images/ss.png">' );

	 $('td:eq(5)', row).html( '<img title="Shared Property" id="imgunpub" src="<?php echo base_url();?>mydata/images/ss.png">' );

	  }

	  return row;

        			},

             "aoColumns": [

			{ "mDataProp": "id" },

            { "mDataProp": "terminal" },

			{ "mDataProp": "status" },

			{ "mDataProp": "managed" },

			{ "mDataProp": "exclusive" },

			{ "mDataProp": "shared" },

            { "mDataProp": "ref" },

            { "mDataProp": "unit" },

            { "mDataProp": "category" },

            { "mDataProp": "region_id" },

            { "mDataProp": "area_location_id" },

			{ "mDataProp": "sub_area_location_id" },

			{ "mDataProp": "beds" },

			{ "mDataProp": "size" },

			{ "mDataProp": "price" },

            { "mDataProp": "agent_id" },

            { "mDataProp": "landlord_id" },

            { "mDataProp": "unit_type" },

            { "mDataProp": "baths" },

            { "mDataProp": "street_no" },

			{ "mDataProp": "floor_no" },

			{ "mDataProp": "dewa_no" },

			{ "mDataProp": "photos" },

			{ "mDataProp": "cheques" },

            { "mDataProp": "fitted" },

            { "mDataProp": "prop_status" },

            { "mDataProp": "source_of_listing" },

            { "mDataProp": "available_date" },

            { "mDataProp": "remind_me" },

			{ "mDataProp": "furnished" },

			{ "mDataProp": "featured" },

            { "mDataProp": "maintenance" },

            { "mDataProp": "strno" },

            { "mDataProp": "amount" },

            { "mDataProp": "tenanted" },

            { "mDataProp": "plot_size" },

			{ "mDataProp": "name" },

			{ "mDataProp": "view_id" },

            { "mDataProp": "commission" },

            { "mDataProp": "deposit" },

            { "mDataProp": "unit_size_price" },

            { "mDataProp": "dateadded" },

            { "mDataProp": "dateupdated" },

			{ "mDataProp": "user_id" },

			{ "mDataProp": "key_location" },

            { "mDataProp": "development_unit_id" },

                     

                        

            ],

         "columns": [

			{ "data": "id" },

            { "data": "terminal" },

			{ "data": "status" },

			{ "data": "managed" },

			{ "data": "exclusive" },

			{ "data": "shared" },

            { "data": "ref" },

            { "data": "unit" },

            { "data": "category" },

            { "data": "region_id" },

            { "data": "area_location_id" },

			{ "data": "sub_area_location_id" },

			{ "data": "beds" },

			{ "data": "size" },

			{ "data": "price" },

            { "data": "agent_id" },

            { "data": "landlord_id" },

            { "data": "unit_type" },

            { "data": "baths" },

            { "data": "street_no" },

			{ "data": "floor_no" },

			{ "data": "dewa_no" },

			{ "data": "photos" },

			{ "data": "cheques" },

            { "data": "fitted" },

            { "data": "prop_status" },

            { "data": "source_of_listing" },

            { "data": "available_date" },

            { "data": "remind_me" },

			{ "data": "furnished" },

			{ "data": "featured" },

            { "data": "maintenance" },

            { "data": "strno" },

            { "data": "amount" },

            { "data": "tenanted" },

            { "data": "plot_size" },

			{ "data": "name" },

			{ "data": "view_id" },

            { "data": "commission" },

            { "data": "deposit" },

            { "data": "unit_size_price" },

            { "data": "dateadded" },

            { "data": "dateupdated" },

			{ "data": "user_id" },

			{ "data": "key_location" },

            { "data": "development_unit_id" },

                     

                        

            ],

            "aaSorting" : [[ 42, 'desc' ]],

            "iDisplayLength": 25,

            "bServerSide": true,

            "sAjaxSource": config.siteUrl+"listings/datatable?type=sales&ts="+Math.round((new Date()).getTime() / 100),

            "iDisplayStart": 0,

            "sPaginationType": "full_numbers",

            'fnServerData': function (url, data, callback){ 

				 /* Add some extra data to the sender */

				data.minarea = $('#listings_row #minarea').val();

				data.maxarea = $('#listings_row #maxarea').val();

				data.minprice = $('#listings_row #minprice').val();

				data.maxprice = $('#listings_row #maxprice').val();

				data.dateaddedS = $('#listings_row #dateaddedS').val();

				data.dateupdatedS = $('#listings_row #dateupdatedS').val();

				data.dateaddedSto = $('#listings_row #dateaddedSto').val();

				data.available_dateS = $('#listings_row #available_dateS').val();

				data.status = '<?php echo $listing_type;?>';

				data.listing_agent = '<?php echo $listing_agent;?>';

				       $.each($('#as_search_form input, #as_search_form select'), function() {

                                                            var as_field_name = this.id;

                                                            var as_field_value = $('#'+as_field_name).val();

                                                           if(as_field_value!='' || as_field_value != 0){

                                                               // aoData.push( { "name": as_field_name, "value": as_field_value } );

                                                               data[as_field_name] = as_field_value;

                                                            }

                                                        });

				

				 $.ajax

              ({

                           "dataType": 'json', 

                           "type": "POST", 

                           "url": url, 

                           "data": data, 

                           "success": function(json) {

                               callback(json);

                              // updateUserStatusPanel();;

                               if(last_id > 0){

                                     // $('#listings_row #'+last_id+' td').addClass('yellowCSS');

                                }



                       }

                       });

				

				

				}

                             } );

							

		 $('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

                                                

                                                /* Code to hide/show columns START */

    

                                                /* hide the search columns */

                                                    $('#searchbox tr').find("td:nth-child("+(33+2)+")").css('display', 'none');

                            $('#column_33').attr('checked',false);

                                                    $('#searchbox tr').find("td:nth-child("+(18+2)+")").css('display', 'none');

                            $('#column_18').attr('checked',false);

                                                    $('#searchbox tr').find("td:nth-child("+(23+2)+")").css('display', 'none');

                            $('#column_23').attr('checked',false);

                                                    $('#searchbox tr').find("td:nth-child("+(38+2)+")").css('display', 'none');

                            $('#column_38').attr('checked',false);

                                                    $('#searchbox tr').find("td:nth-child("+(21+2)+")").css('display', 'none');

                            $('#column_21').attr('checked',false);

                                                    $('#searchbox tr').find("td:nth-child("+(27+2)+")").css('display', 'none');

                            $('#column_27').attr('checked',false);

                                                    $('#searchbox tr').find("td:nth-child("+(39+2)+")").css('display', 'none');

                            $('#column_39').attr('checked',false);

                                                    $('#searchbox tr').find("td:nth-child("+(31+2)+")").css('display', 'none');

                            $('#column_31').attr('checked',false);

                                                    $('#searchbox tr').find("td:nth-child("+(35+2)+")").css('display', 'none');

                            $('#column_35').attr('checked',false);

                                                    $('#searchbox tr').find("td:nth-child("+(25+2)+")").css('display', 'none');

                            $('#column_25').attr('checked',false);

                                                    $('#searchbox tr').find("td:nth-child("+(28+2)+")").css('display', 'none');

                            $('#column_28').attr('checked',false);

                                                    $('#searchbox tr').find("td:nth-child("+(34+2)+")").css('display', 'none');

                            $('#column_34').attr('checked',false);

                                               // setDatatableWidth();

                        /* hide the search columns end */

                        

						

    

                        



                        /* Code to hide/show columns END */

    

                        

                        $(document.body).on("click", "#listings_row  .sorting", function(event){                        	

                        	if($(this).attr('value') != 'undefined' && $(this).attr('id_search') != undefined){

                        		oTable.fnFilter( $(this).attr('value'), $(this).attr('id_search') );

	                            $('#'+$(this).attr('id_search')+' img').attr('src', $(this).attr('image'));

	                            $('#listings_row #1').val($(this).attr('value'));

	                            $('#listings_row #reset_filter').css('display', '');

                        	}

                        } );







              

                        

                        //advance search end

                         //archive

                        $(document.body).on("click", '#move_to_archive, #move_to_listings', function() {   

                            var action = $(this).attr('id');

                            var append_msg = '';

                            if(action=='move_to_archive'){

                                var main_id = "#listings_row";

                                var message = "archive";



                                if(1==3){

                                           append_msg = " Shared listings will not be archived.";

                                          }

                            }else if(action=='move_to_listings'){

                                var main_id = "#listings_archive_row";

                                var message = "unarchive";

                            }

                                

                                        if($(main_id+' input').is(':checked')){

                                            if(confirm("Are you sure you want to "+message+" these listings? "+append_msg)){

                                                var allVals = [];

                                                type = $(this).attr('id');

                                                

                                                $(main_id+' input[type="checkbox"]:checked').each(function() {

                                                    if($(this).attr("id") != "check_all_checkboxes") {

                                                        if(action=='move_to_archive'){

                                                            var pos = oTable.fnGetPosition($("#"+$(this).val())[0]);

                                                            var oRow = oTable.fnGetData()[pos];



                                                            if(oRow && oRow.status) {

                                                                var status = ($(oRow.status)) ? $(oRow.status).attr("title") : "";

                                                            }

                                                            else{

                                                                var status = "";

                                                            }



                                                            if (status!="Published" && 1==3){

                                                                allVals.push($(this).val());

                                                                name=$(this).attr('id');

                                                            }

                                                            else if( status == "Published" && 1==3 && 0 == 0) {

                                                                allVals.push($(this).val());

                                                                name=$(this).attr('id');

                                                            }

                                                            else if(1<3 ){

                                                                allVals.push($(this).val());

                                                                name=$(this).attr('id');

                                                            }

                                                        }

                                                        else {

                                                            allVals.push($(this).val());

                                                            name=$(this).attr('id');

                                                        }

                                                    }

                                                });

                                                

                                                if(allVals.length > 10){

                                                      alert('Sorry! You can only '+ message +' a maximum of 10 listings at a time.');

                                                      return false;

                                                    }

                                                $('#listings_row_processing').css('visibility','visible');

												

                                                $.post( '<?php echo base_url();?>listings/'+action+'/', { ids: allVals, type:$(this).attr('id') },

                                                function( data ) {

                                                    $("#myForm")[ 0 ].reset();

                                                    $('#edit').css('display', 'none');  /* This shows the update button when a filed is selected */ 

                                                    $('#new').css('display', 'inline'); /* This shows the update button when a filed is selected */ 

                                                    if(action=='move_to_archive'){

                                                        oTable.fnDeleteRow( 47 );

                                                    }else if(action=='move_to_listings'){

                                                        refresh_archive_datatable();

                                                        oTable.fnDeleteRow( 47 );

                                                    }

                                                    $('#showdata').html(data);

                                                    $('#showdata').animate({ 'color': 'red'}, "slow");

                                                    $('#listings_row_processing').css('visibility','hidden');

                                                });

                                            }

                                        }

                                        else {

                                            $('#checkbox_error').show(400);

                                        }

                                

                            

                        });

	 

	 });

</script>

<!--wrapper starts here-->



<div id="wrapper">

            <div class="container">

            

            

            <!-- Page Heading -->

            <div class="row">

                <div class="col-lg-12">

                	<div class="page_head_area"><h1><i class="fa fa-home"></i> Sales</h1></div>

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

                    <li  class="active"><a href="<?php echo site_url('listings/sales');?>">United Arab Emirates</a></li>

                   <!--  <li><a href="<?php echo site_url('listings/international-sales');?>">International</a></li> -->

                    <li><a href="<?php echo site_url('listings/locations-text-sales');?>">Location Text</a></li>

                    <li><a href="<?php echo site_url('listings/price-index-sales');?>">Sales Price Index</a></li>

                </ul>

            </div>

            

                    

            <!-- Tab content -->

            <div class="tab-content">

           

            <?php

		 $attributes = array('data-toggle' => 'validator', 'id' => 'myForm', 'role' => 'form');

	    echo form_open_multipart('listings/save', $attributes);

        ?>

            <div class="row">

            <div class="col-lg-12">

          

              <button type="button" id="new" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>New Listing</button>



            <button  style="display:none;" type="submit" id="update"  class="btn btn-lg btn-success" name="Update" value="Update Listing">

            <i class="fa fa-plus-circle"></i> Save Listing</button>

             <button  style="display:none;" type="submit" id="Save"  class="btn btn-lg btn-success" name="Save" value="Save Listing">

            <i class="fa fa-plus-circle"></i> Save Listing</button>

       

                <button  style="display:none;" type="button" id="edit" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Listing</button>

            <a href="javascript:void(0)" id="cancel" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>

            <a href="javascript:void(0)" class="btn btn-lg btn-success pull-right popup_a" id="popup_sd" rel="view_html_preview"><i class="fa fa-eye"></i> Preview Listing</a>

            

          

	                       <!-- dev work start from here 18-02-2016 -->

              <div id="top_score_wrap" class="dropdown gist-list-qdrop pull-right" style="display: none;">

              

               <div id="top_score_wrap1" class="dropdown gist-list-qdrop pull-right">

                <button class="dropdown-toggle " type="button" data-toggle="dropdown">

                <span class="caret"></span></button>

                  <ul class="dropdown-menu" aria-labelledby="tf-dropdown" style="width:300px; right: 5px; left: auto; font-size: 12px; text-align:left;height:280px;">

                                <li>

                                    <div class="tf-wrapper">

                                        <div class="overall tf-item title"><span class="tf-lbl">Overall Quality</span> <span class="quality red">Below Average</span> 

                                            <span class="value">25%</span></div>

                                        <div class="overall tf-item" id="tf-media_score"><span class="tf-lbl">Media</span> <a href="#" class="tf-suggestions" data-type="media">Suggestions<i class="icon-right-dir"></i></a> <span class="value">25%</span></div>

                                        <div class="overall tf-item" id="tf-address_score"><span class="tf-lbl">Address</span> <a href="#" class="tf-suggestions" data-type="address">Suggestions<i class="icon-right-dir"></i></a> <span class="value">55%</span></div>

                                        <div class="overall tf-item" id="tf-description_score"><span class="tf-lbl">Title & Description</span> <a href="#" class="tf-suggestions" data-type="description">Suggestions<i class="icon-right-dir"></i></a> <span class="value">25%</span></div>

                                        <div class="overall tf-item" id="tf-price_score"><span class="tf-lbl">Price</span> <a href="#" class="tf-suggestions" data-type="price">Suggestions<i class="icon-right-dir"></i></a> <span class="value">25%</span></div>

                                        <div class="overall tf-item" id="tf-beds_baths_score"><span class="tf-lbl">Additional Info</span> <a href="#" class="tf-suggestions" data-type="beds_baths">Suggestions<i class="icon-right-dir"></i></a> <span class="value">25%</span></div>

                                        <div class="overall tf-item" id="tf-facilities_score"><span class="tf-lbl">Facilities</span> <a href="#" class="tf-suggestions" data-type="facilities">Suggestions<i class="icon-right-dir"></i></a> <span class="value">25%</span></div>

                                    </div>

                                    <div class="tf-suggestions-list">

                                        <div class="tf-suggestion-item">

                                            <div class="overall tf-item title"><a href="#"class="tfs-back"><i class="icon-left-open"></i> 

                                            	<span class="tf-lbl"></span></a><span class="value"></span></div>

                                            <p class="tf-suggestion-head">Suggestions:</p>

                                            <div class="overall tf-item" id="tf-suggestion"></div>

                                        </div>

                                    </div>

                                </li>

                            </ul>

              </div>

              <span class="pull-right" data-percent="86">

                <span class="percent1" style="width: 40px; height: 40px;float: left;" id="top_overall_score"></span>

                <!-- <div id="top_overall_score" style="width: 40px; height: 40px;float: left;"></div> -->

              </span>

              <p  class="pull-right">

               Listing <br>Quality</a>

               </div>

               <!-- dev work end from here 18-02-2016 -->  

	                   

	                   

	                  

            

            </div>

            </div>

            

            

            <div class="row"><h4 class="add_new_rental"><div id="title">Add New Rentals</div></h4></div>

            

                                <!-- hidden fields -->

                                <input name="id" class="form-control" id="id" style="display:none;" value="0" readonly>

                                <input name="client_id" class="form-control" style="display:none;" id="client_id"  value="<?php echo $client_id;?>" readonly>

                                <input type="text" style="display:none;" name="property_category" id="property_category">

                                <input name="rand_key" type="text" style="display:none;" id="rand_key" readonly value="" >

                                <input name="readonly" type="text" style="display:none;" id="readonly" readonly value="" >

            

            

            

            <div class="row fadeInUp">

            <div class="col-md-3">

              <div class="form-group">

                <label>Ref</label>

                <input type="text" class="form-control input-sm" id="ref" name="ref" disabled="disabled" readonly="readonly" >

              </div>

              

              <div class="row">

              <div class="col-md-6">

                  <div class="form-group">

                    <label>Unit No.</label>

                    <input type="text" class="form-control input-sm required" id="unit" name="unit">

                  </div>

              </div>

              

              <div class="col-md-6">

                  <div class="form-group">

                    <label>Type</label>

                    <input type="text" class="form-control input-sm" id="unit_type" name="unit_type">

                     <input name="type_dummy" type="hidden" class="form-control" id="type_dummy" value="2">

                  </div>

              </div>

              </div>

              

              <div class="row">

              <div class="col-md-6">

                  <div class="form-group">

                    <label>Street No.</label>

                    <input type="text" class="form-control input-sm" id="street_no" name="street_no">

                  </div>

              </div>

              

              <div class="col-md-6">

                  <div class="form-group">

                    <label>Floor</label>

                    <input type="text" class="form-control input-sm" id="floor_no" name="floor_no" >

                  </div>

              </div>

              </div>

              

              <div class="form-group">

                    <label>Category</label>

                    <select name="category_id" id="category_id" class=" form-control required input-sm" required>

                   

                                    <option selected="" value="">Select</option>

                                     <?php foreach ($getCat as $listing):?>

                                     <option value="<?php echo $listing['id'];?>"><?php echo $listing['category'];?></option>

                                     <?php endforeach;?>

                                                                           

                                                                    </select>

              </div>

              

              <div class="form-group">

                    <label class="dropdown">Emirate                    

                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>

                    	<ul class="dropdown-menu emirate_search">

                        <h5 class="text-primary">Search Location</h5>

						<input type="text" class="form-control input-sm" id="auto_location_field" name="auto_location_field">

              			</ul>

                    </label>

                    

                    

                    

                    <select id="region_id" name="region_id" class="form-control required input-sm" required>

                  

                                    <option selected="" value="">Select</option>

											<option value="2">Abu Dhabi</option>

                                        	  <option value="4">Ajman</option>

                                        	  <option value="8">Al Ain</option>

                                        	   <option value="1">Dubai</option>

                                        	    <option value="7">Fujairah </option>

                                        	     <option value="6"> Ras Al Khaimah	 </option>

                                        	      <option value="3">Sharjah	 </option>

                                        	         <option value="5"> Umm Al Quwain </option>

                                                                        </select>

              </div>

              

              

              <div class="form-group">
                 <label>Location <a href="javascript:void(0)"  data-toggle="modal" data-target="#locationMap" id="showme_map"><i class="fa fa-map-marker"></i></a></label>
                   

                    <select class="form-control input-sm required" id="area_location_id" name="area_location_id" required>

                    <option value="" selected="selected">Select</option>

                   

                    </select>

              </div>

              <div class="form-group">

                    <label>Sub-Location</label>

                    <select class="form-control input-sm required" id="sub_area_location_id" name="sub_area_location_id" required>

                    <option value="" selected="selected">Select</option>

                  

                    </select>

              </div>

            </div>

            

            

            <div class="col-md-3">

            

            <div class="row">

            <div class="col-md-6">

            <div class="form-group">

                    <label>Beds</label>

                    <select class="form-control input-sm " id="beds" name="beds">

                

                                    <option selected="selected" value="">Select</option>

                                    <option value="0.5">Studio</option>

                                    <option value="1">1 bed</option>

                                    <option value="2">2 beds</option>

                                    <option value="3">3 beds</option>

                                    <option value="4">4 beds</option>

                                    <option value="5">5 beds</option>

                                    <option value="6">6 beds</option>

                                    <option value="7">7 beds</option>

                                    <option value="8">8 beds</option>

                                    <option value="9">9 beds</option>

                                    <option value="10">10 beds</option>

                                    <option value="11">11 beds</option>

                                    <option value="12">12 beds</option>

                                    <option value="13">13 beds</option>

                                    <option value="14">14 beds</option>

                                    <option value="15">15 beds</option>

                                    <option value="16">16 beds</option>

                                </select>

                                <select tabindex="9" style="display:none;" id="fitted" class="form-control input-sm " type="text" name="fitted">

                                    <option selected="selected" value="">Select</option>

                                    <option value="1">Semi-Fitted</option>

                                    <option value="2">Fitted Space</option>

                                    <option value="3">Shell and core</option>

                                </select>

              </div>

            </div>

            <div class="col-md-6">

            <div class="form-group">

                    <label>Baths</label>

                    <select class="form-control input-sm" id="baths" name="baths">

                  

                                    <option  value="">Select</option>

                                    <option selected="selected" value="1">1 bath</option>

                                    <option value="2">2 baths</option>

                                    <option value="3">3 baths</option>

                                    <option value="4">4 baths</option>

                                    <option value="5">5 baths</option>

                                    <option value="6">6 baths</option>

                                    <option value="7">7 baths</option>

                                    <option value="8">8 baths</option>

                                    <option value="9">9 baths</option>

                                    <option value="10">10 baths</option>

                                    <option value="11">11 baths</option>

                                    <option value="12">12 baths</option>

                                </select>

              </div>

            </div>

            </div>

            

            <div class="row">

              <div class="col-md-6">

                  <div class="form-group">

                    <label>BUA</label>

                   <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

                   data-placement="bottom" data-content="Enter the built-up area of the listing here in Sq Ft. To change the default measuring unit across all listings, request your manager to do so in the Admin > Profile page.">

                   <i class="fa fa-info-circle"></i>

                   </a>

                    <input type="text" class="form-control required input-sm" id="size" name="size">

                  </div>

              </div>

              

              <div class="col-md-6">

                  <div class="form-group">

                    <label>Plot</label>

                    <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

                   data-placement="bottom" data-content="Enter the plot size of the listing here in Sq Ft, if applicable. To change the default measuring unit across all listings, request your manager to do so in the Admin > Profile page.">

                   <i class="fa fa-info-circle"></i>

                   </a>

                    <input type="text" class="form-control input-sm" id="plot_size" name="plot_size">

                  </div>

            </div>

            </div>

            

            <div class="row">

              <div class="col-md-6">

                  <div class="form-group">

                    <label>Price(AED)</label>

                    <input type="text" class="form-control required input-sm" id="price" name="price">

                    <input type="hidden" id="listings_price_id" name="listings_price_id" value="">

                  </div>

              </div>

              

              <div class="col-md-6">

                        <div class="form-group">

                     

                            <label class="">

                               <input type="checkbox" style="margin-right: 2px;" value="0" id="price_of_application" name="price_of_application">

                                <span class="lbl padding">POA</span>

                            </label>                            

                           <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

                           data-placement="bottom" data-content="Tick this box if you would like the price for the property to be hidden. If ticked, Price on application will display on the PDF brochures and the HTML preview for this property and a zero value will be sent in the XML  feeds to the portals. Note: This will cause most portals to reject the listing as price is normally a mandatory field for most portals.">

                           <i class="fa fa-info-circle"></i>

                           </a>

                        </div>

                   

                </div>

            </div>

            

            <div class="row">

              <div class="col-md-6">

                  <div class="form-group">

                    <label>Price / sq ft <!--<a href="" data-toggle="modal" data-target="#cheques_pop"><i class="fa fa-plus-circle"></i></a>--></label>

                    <select class="form-control input-sm " id="cheques" name="cheques" style=" display:none;">

                   

                                    <option selected="" value="">Select</option>

                                    <option value="1">1 cheque</option>

                                    <option value="2">2 cheques</option>

                                    <option value="3">3 cheques</option>

                                    <option value="4">4 cheques</option>

                                    <option value="5">5 cheques</option>

                                    <option value="6">6 cheques</option>

                                    <option value="7">7 cheques</option>

                                    <option value="8">8 cheques</option>

                                    <option value="9">9 cheques</option>

                                    <option value="10">10 cheques</option>

                                    <option value="11">11 cheques</option>

                                    <option value="12">12 cheques</option>

                                </select>

                                <input type="text" tabindex="16" value="" id="unit_size_price" class="form-control" name="unit_size_price" title="This is an auto-calculated field. Ensure the price and built up area fields are populated for this field to show the price per sq ft." readonly="">

                  </div>

            </div>

            <div class="col-md-6">

                  <div class="form-group">

                    <label>Parking</label>

                    <input type="text" class="form-control input-sm" id="parking" name="parking" value="0">

                  </div>

              </div>

            </div>

            

            <div class="row">

              <div class="col-md-6">

                    <div class="form-group">

					<label>Commission</label>

                    <div class="input-group">

                      <input type="text" class="form-control input-sm" id="commission_percentage" name="commission_percentage" value="0.00">

                      <span class="input-group-addon">%</span>

                    </div>

                    </div>

              </div>

               <div class="col-md-6">

                    <div class="form-group">

                    <label>&nbsp;</label>

                    <div class="input-group">

                      <input type="text" class="form-control input-sm" id="commission" name="commission" value="0.00">

                      <span class="input-group-addon">AED</span>

                    </div>

                    </div>

              </div>

            </div>

            

            <div class="row">

              <div class="col-md-6">

                    <div class="form-group">

					<label>Deposit</label>

                    <div class="input-group">

                      <input type="text" class="form-control input-sm" id="deposit_percentage" name="deposit_percentage">

                      <span class="input-group-addon">%</span>

                    </div>

                    </div>

              </div>

               <div class="col-md-6">

                    <div class="form-group">

                   <label>&nbsp;</label>

                    <div class="input-group">

                      <input type="text" class="form-control input-sm" id="deposit" name="deposit">

                      <span class="input-group-addon">AED</span>

                    </div>

                    </div>

              </div>

            </div>

            

            <div class="form-group">

                <label>Owner  <a href="javascript:void(0)" data-toggle="modal" data-target="#owner_info"><i class="fa fa-user"></i></a></label>

                <div class="input-group">

                  <span class="input-group-addon"><a href="#" data-toggle="modal" data-target="#owner" rel='add_landlord_popup' class="popup_a"><i class="fa fa-plus-circle"></i></a></span>

                  <input type="text" class="form-control required input-sm" id="landlord_name" name="landlord_name" readonly="readonly">

                  <input value="" id="landlord_id" class="form-control ll_id_selector" style="display:none;" name="landlord_id">

                  <input value="" id="landlord_id_list" class="form-control ll_id_list_selector" style="display:none;" name="landlord_id_list">

                </div>

            </div>

            </div>

            

            <div class="col-md-3">

               <div class="form-group">

                    <label>Listing Title</label>

                    <div class="input-group">

                      <input id="name" type="text" class="form-control required input-sm"  name="name">

                      <span id="title_char_count" class="input-group-addon">0</span>

                    </div>

                </div>

                

                <div class="form-group">

                    <label>Description </label>

                    <a href="#" class="text-primary" data-toggle="modal" data-target="#other_languages">Other Languages</a>

                    <textarea class="form-control" data-toggle="modal" data-target="#description_main" id="description_demo" name="description_demo"></textarea>

                    <input type="text" hidden="" style="display:none;" id="description_count" name="description_count" value="0">

                </div>

                

               

              <div class="row">

                  <div class="col-md-6">

                      <div class="form-group">

                        <label>Furnished</label>

                        <select class="form-control input-sm " id="prop_furnish" name="prop_furnish">

                      

                                        <option selected="" value="">Select</option>

                                        <option value="1">Furnished</option>

                                        <option value="2">Unfurnished</option>

                                        <option value="3">Partly Furnished</option>

                                </select>

                      </div>

                  </div>

                  <div class="col-md-6">

                      <div class="form-group">

                        <label>View</label>

                        <input type="text" class="form-control input-sm" id="view_id" name="view_id">

                      </div>

                  </div>

              </div>

              

              <div class="row">

                  <div class="col-md-6">

                        <div class="form-group">

                        <label>Photos</label>

                        <div class="input-group">

                          <span class="input-group-addon">

                   <a class="popup_a" href="#" link="view_photo_box_link" id="view_photo_box" rel="view_photo_box" data-toggle="modal" data-target="#photos_pop" title="Add Images">

                          <!--<a href="" data-toggle="modal" data-target="#photos_pop">--><i class="fa fa-plus-circle"></i></a></span>

                          <input type="text" class="form-control input-sm" id="photos" name="photos" readonly="readonly">

                          <input type="hidden" name="floor_plans" id="floor_plans" value="0">

                    </div>

                    </div>

               </div>

               <div class="col-md-6">

                    <div class="form-group">

                        <label>Portals</label>

                        <div class="input-group">

                          <span class="input-group-addon"><a href="javascript:void(0)" data-toggle="modal" data-target="#portals"><i class="fa fa-plus-circle"></i></a></span>

                          <input type="text" class="form-control input-sm" id="portals_count" name="portals_count" readonly="readonly">

                          <input type="text" style="display:none;" value="" readonly="" name="portals_name" id="portals_name">

                          <input type="text" style="display:none;" value="" readonly="" name="portals_name_arr" id="portals_name_arr">

                    </div>

                    </div>

               </div>

               </div>

               

               <div class="row">

                  <div class="col-md-6">

                        <div class="form-group">

                        <label>Other Media</label>

                        <div class="input-group">

                          <span class="input-group-addon"><a href="javascript:void(0)" data-toggle="modal" data-target="#other_media"><i class="fa fa-plus-circle"></i></a></span>

                          <input type="text" class="form-control input-sm" id="othermedia_count" name="othermedia_count">

                    </div>

                    </div>

               </div>

               <div class="col-md-6">

                    <div class="form-group">

                        <label>Features</label>

                        <div class="input-group">

                          <span class="input-group-addon"><a href="javascript:void(0)" data-toggle="modal" data-target="#features"><i class="fa fa-plus-circle"></i></a></span>

                          <input type="hidden" class="form-control input-sm" id="features_id" name="features_id">

                          <input type="text" class="form-control input-sm" id="features_count" name="features_count" >

                          <input type="text" style="display:none;" value="" readonly="" name="area_iformation_data" id="area_iformation_data">

                    </div>

                    </div>

               </div>

               </div>

                

            </div>

            

            

            <div class="col-md-3">

                <div class="form-group">

                    <label>Date Listed</label>

                    <input type="text" class="form-control input-sm" id="dateadded" name="dateadded" readonly="readonly">

                </div>

                <div class="form-group">

                    <label>Last Updated</label>

                    <input type="text" class="form-control input-sm" id="dateupdated" name="dateupdated" readonly="readonly">

                </div>

                

                  <div class="row">

                  <div class="col-md-6">

                        <div class="form-group">

                        <label>Viewings</label>

                        <div class="input-group">

                          <span class="input-group-addon"><a class="popup_a" href="#" link="view_terminal_popup_link" id="popup-viewings" rel="view_terminal_popup" data-toggle="modal" data-target="#viewing_detail" title="Add viewings"><i class="fa fa-plus-circle"></i></a></span>

                          <input type="text" class="form-control input-sm" id="viewings_count" name="viewings_count" readonly="readonly" value="">

                        </div>

                        </div>

                  </div>

                   <div class="col-md-6">

                        <div class="form-group">

                        <label>Leads</label>

                        <div class="input-group">

                          <span class="input-group-addon">

                          <a title="View Leads" id='view_lead_popup_link' href="#" rel='view_lead_popup' data-toggle="modal" data-target="#leads_pop" class="popup_a">

                          

                          

                          <i class="fa fa-plus-circle"></i></a></span>

                          <input type="text" class="form-control input-sm" id="leads" name="leads" readonly="readonly" value="">

                        </div>

                        </div>

                  </div>

                  </div>

                  

                <div class="form-group">

                    <label>Additional Info</label>

                    <div class="input-group">

                      <span class="input-group-addon"><a href="#" id="popup-additional-info" class="popup_a" data-toggle="modal" data-target="#additional_info" title="Add more information">

                      <i class="fa fa-plus-circle"></i></a></span>

                      <input type="text" class="form-control input-sm" id="add_info" name="add_info" readonly="readonly">

                    </div>

                </div>

                

                

                <div class="form-group">

                    <label>Agent</label>

                    <select class="form-control required input-sm" id="agent_id" name="agent_id">

                  

                  

                                    

                                    

                                                                             

                                </select>

                  </div>

                  

                 <div class="form-group">

                    <label>Status</label>

                    <select class="form-control input-sm " id="status" name="status">

                  

                                    <option value="1">Unpublished</option>

                                    <option selected="selected" value="2">Published</option>

                                </select>

                 </div>

                

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label class="">

                                <input type="checkbox" tabindex="33" value="1" id="managed" name="managed">

                                <span class="lbl padding">Mangaed </span>

                            </label>

                            <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

                           data-placement="bottom" data-content="Select this option if you have the owner / landlord has signed up for Property Management on this listing with your company.">

                           <i class="fa fa-info-circle"></i>

                           </a>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label class="">

                               <input type="checkbox" tabindex="34" value="1" id="exclusive" name="exclusive">

                                <span class="lbl padding">Exclusive </span>

                            </label>

                           <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

                           data-placement="bottom" data-content="Select this option if the owner / landlord has signed an exclusive agreement on this listing with your company.">

                           <i class="fa fa-info-circle"></i>

                           </a>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label class="">

                                <input type="checkbox" tabindex="35" value="1" id="shared" name="shared">

                                <span class="lbl padding">Invite</span>

                            </label>                            

                           <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

                           data-placement="bottom" data-content="Select this option if you would like to share this listing with other companies (accepted invitations only) using Royal Home">

                           <i class="fa fa-info-circle"></i>

                           </a>

                        </div>

                   

                </div>

                <!--<div class="col-md-6">

                        <div class="form-group">

                            <label class="">

                               <input type="checkbox" style="margin-right: 2px;" value="0" id="price_of_application" name="price_of_application">

                                <span class="lbl padding">POA</span>

                            </label>                            

                           <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

                           data-placement="bottom" data-content="Tick this box if you would like the price for the property to be hidden. If ticked, Price on application will display on the PDF brochures and the HTML preview for this property and a zero value will be sent in the XML  feeds to the portals. Note: This will cause most portals to reject the listing as price is normally a mandatory field for most portals.">

                           <i class="fa fa-info-circle"></i>

                           </a>

                        </div>

                   

                </div>-->

            </div>

            

            

            

            

            </div>

            </div>

             <!-- Additional Info Modal -->

            <div class="modal fade" id="additional_info" tabindex="-1">

              <div class="modal-dialog modal-lg">

                <div class="modal-content">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Additioanl Information</h4>

                    <p>Complete additional information about property here:</p>

                  </div>

                  

                  <div class="modal-body">

                  

                    <div class="row">

                    <div class="col-md-6">

                      <div class="form-group">

                        <label>Property Status</label>

                        <select class="selectpicker  show-tick form-control input-sm " id="prop_status" name="prop_status">

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

                      <!--<div class="form-group">

                                <select name='agent_rent_sold' id='agent_rent_sold' class="form-control" style="display:none;"  >

                                    <option value="0" selected="selected">Select</option>

                                                                            <option value="1448837">

                                            Kevin  Espaldon                                         </option>

                                                                            <option value="1448804">

                                            Mahmoud Khalil                                        </option>

                                                                            <option value="1448817">

                                            Mia Feliciano                                        </option>

                                                                            <option value="1449025">

                                            Royal Home  Rent Team                                         </option>

                                                                            <option value="1449026">

                                            Royal Home  Sales Team                                         </option>

                                                                            <option value="1449028">

                                            Royal Home  Property Management                                        </option>

                                                                            <option value="1448836">

                                            Royal Home  Property                                        </option>

                                                                    </select>

                            </div>-->

                      <div class="row">

                          <div class="col-md-6">

                          <div class="form-group">

                            <label>Source of listing</label>

                            <select class="selectpicker  show-tick form-control input-sm " id="source_of_listing" name="source_of_listing">

                            

                                    <option value="" selected="selected">Select</option>

                                                                            <option value=" Not Specified" > Not Specified</option>

                                                                            <option value="7 days" >7 days</option>

                                                                            <option value="Abu Dhabi week" >Abu Dhabi week</option>

                                                                            <option value="Agent" >Agent</option>

                                                                            <option value="Agent External" >Agent External</option>

                                                                            <option value="Agent Internal" >Agent Internal</option>

                                                                            <option value="Al Ayam" >Al Ayam</option>

                                                                            <option value="Al Bayan" >Al Bayan</option>

                                                                            <option value="Al Futtaim" >Al Futtaim</option>

                                                                            <option value="Al Ittihad News paper" >Al Ittihad News paper</option>

                                                                            <option value="Al Khaleej" >Al Khaleej</option>

                                                                            <option value="Al Rai" >Al Rai</option>

                                                                            <option value="AL Watan" >AL Watan</option>

                                                                            <option value="Arab Times" >Arab Times</option>

                                                                            <option value="Asharq Al Awsat" >Asharq Al Awsat</option>

                                                                            <option value="Bank Referral" >Bank Referral</option>

                                                                            <option value="Bayut.com" >Bayut.com</option>

                                                                            <option value="Blackberry SMS" >Blackberry SMS</option>

                                                                            <option value="Business card" >Business card</option>

                                                                            <option value="Client Referral" >Client Referral</option>

                                                                            <option value="Cold call" >Cold call</option>

                                                                            <option value="Colours TV" >Colours TV</option>

                                                                            <option value="Database" >Database</option>

                                                                            <option value="Developer" >Developer</option>

                                                                            <option value="Direct call" >Direct call</option>

                                                                            <option value="Direct Client" >Direct Client</option>

                                                                            <option value="Drive around" >Drive around</option>

                                                                            <option value="Dubizzle Feature" >Dubizzle Feature</option>

                                                                            <option value="Dubizzle.com" >Dubizzle.com</option>

                                                                            <option value="Dzooom.com" >Dzooom.com</option>

                                                                            <option value="Email campaign" >Email campaign</option>

                                                                            <option value="Ertebat" >Ertebat</option>

                                                                            <option value="Exhibition Stand" >Exhibition Stand</option>

                                                                            <option value="Existing client" >Existing client</option>

                                                                            <option value="EzEstate" >EzEstate</option>

                                                                            <option value="EzHeights.com" >EzHeights.com</option>

                                                                            <option value="Facebook" >Facebook</option>

                                                                            <option value="Flyers" >Flyers</option>

                                                                            <option value="Forbes Mailer" >Forbes Mailer</option>

                                                                            <option value="Friend or Relative" >Friend or Relative</option>

                                                                            <option value="Google " >Google </option>

                                                                            <option value="Gulf Daily News" >Gulf Daily News</option>

                                                                            <option value="Gulf News" >Gulf News</option>

                                                                            <option value="Gulf News Mailer" >Gulf News Mailer</option>

                                                                            <option value="Gulf Newspaper Freehold" >Gulf Newspaper Freehold</option>

                                                                            <option value="Gulf Newspaper Residential" >Gulf Newspaper Residential</option>

                                                                            <option value="Gulf Times" >Gulf Times</option>

                                                                            <option value="Gulfnews Freehold" >Gulfnews Freehold</option>

                                                                            <option value="Gulfpropertyportal.com" >Gulfpropertyportal.com</option>

                                                                            <option value="Instagram" >Instagram</option>

                                                                            <option value="JustProperty.com" >JustProperty.com</option>

                                                                            <option value="JustRentals.com" >JustRentals.com</option>

                                                                            <option value="JUWAI" >JUWAI</option>

                                                                            <option value="Khaleej Times" >Khaleej Times</option>

                                                                            <option value="LinkedIn" >LinkedIn</option>

                                                                            <option value="Listanza" >Listanza</option>

                                                                            <option value="Luxury Estate.com" >Luxury Estate.com</option>

                                                                            <option value="Luxury Square Foot" >Luxury Square Foot</option>

                                                                            <option value="Magazine" >Magazine</option>

                                                                            <option value="Memaar TV" >Memaar TV</option>

                                                                            <option value="MoneyCamel.com" >MoneyCamel.com</option>

                                                                            <option value="National News paper" >National News paper</option>

                                                                            <option value="Newsletter" >Newsletter</option>

                                                                            <option value="Newspaper advert" >Newspaper advert</option>

                                                                            <option value="Old Landlord" >Old Landlord</option>

                                                                            <option value="Online Banners" >Online Banners</option>

                                                                            <option value="Open House" >Open House</option>

                                                                            <option value="Other" >Other</option>

                                                                            <option value="Other portal" >Other portal</option>

                                                                            <option value="Outdoor Media" >Outdoor Media</option>

                                                                            <option value="Personal Referral" >Personal Referral</option>

                                                                            <option value="Property Acquisition Department" >Property Acquisition Department</option>

                                                                            <option value="Property Finder Premium" >Property Finder Premium</option>

                                                                            <option value="Property Inc." >Property Inc.</option>

                                                                            <option value="Property Management" >Property Management</option>

                                                                            <option value="Property Trader" >Property Trader</option>

                                                                            <option value="Property Weekly" >Property Weekly</option>

                                                                            <option value="Propertyfinder.ae" >Propertyfinder.ae</option>

                                                                            <option value="Propertyonline" >Propertyonline</option>

                                                                            <option value="Propertywifi.com" >Propertywifi.com</option>

                                                                            <option value="PropSpace MLS" >PropSpace MLS</option>

                                                                            <option value="Radio" >Radio</option>

                                                                            <option value="Radio Advert" >Radio Advert</option>

                                                                            <option value="Referral within company" >Referral within company</option>

                                                                            <option value="Relocation" >Relocation</option>

                                                                            <option value="Rightmove.co.uk" >Rightmove.co.uk</option>

                                                                            <option value="Roadshow" >Roadshow</option>

                                                                            <option value="Sandcastles.ae" >Sandcastles.ae</option>

                                                                            <option value="School Communicator" >School Communicator</option>

                                                                            <option value="School Communicator" >School Communicator</option>

                                                                            <option value="Search Engine" >Search Engine</option>

                                                                            <option value="Signboard" >Signboard</option>

                                                                            <option value="SMS campaign" >SMS campaign</option>

                                                                            <option value="Social media Campaign" >Social media Campaign</option>

                                                                            <option value="Souq.com" >Souq.com</option>

                                                                            <option value="Staff Mailer" >Staff Mailer</option>

                                                                            <option value="Twitter " >Twitter </option>

                                                                            <option value="Walk-in" >Walk-in</option>

                                                                            <option value="Website" >Website</option>

                                                                            <option value="Whatpricemyhome" >Whatpricemyhome</option>

                                                                            <option value="Whatsapp" >Whatsapp</option>

                                                                            <option value="Word of Mouth" >Word of Mouth</option>

                                                                            <option value="www.propertyportal.ae" >www.propertyportal.ae</option>

                                                                            <option value="Youtube" >Youtube</option>

                                                                            <option value="Zawya Mailer" >Zawya Mailer</option>

                                                                            <option value="Zoopla" >Zoopla</option>

                                                                    </select>

                          </div>

                          </div>

                          <div class="col-md-6">

                          <div class="form-group">

                            <label>Featured</label>

                            <select class="selectpicker  show-tick form-control input-sm " id="flcheck" name="flcheck">

                              <option value="0" selected="selected">Select</option>

                                    <option value="1">Yes</option>

                                    </select>

                          </div>

                          </div>

                          <!--<select name='reffered_by_agent' id='reffered_by_agent' class="form-control" style="display:none;"  >

                                    <option value="0" selected="selected">Select</option>

                                                                            <option value="1448837">

                                            Kevin  Espaldon                                         </option>

                                                                            <option value="1448804">

                                            Mahmoud Khalil                                        </option>

                                                                            <option value="1448817">

                                            Mia Feliciano                                        </option>

                                                                            <option value="1449025">

                                            Royal Home  Rent Team                                         </option>

                                                                            <option value="1449026">

                                            Royal Home  Sales Team                                         </option>

                                                                            <option value="1449028">

                                            Royal Home  Property Management                                        </option>

                                                                            <option value="1448836">

                                            Royal Home  Property                                        </option>

                                                                    </select>-->

                      </div>

                      

                      <div class="row">

                          <div class="col-md-6">

                            <div class="form-group">

                                <label>DEWA Number</label>

                                <input type="text" class="form-control input-sm" id="dewa_no" name="dewa_no">

                                

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                                <label>STR #</label>

                                <input type="text" class="form-control input-sm" id="strno" name="strno">

                            </div>

                          </div>

                      </div>

                      

                      <div class="row">

                          <div class="col-md-6">                          

                          <div class="form-group">

                            <label>Next available</label>

                            <div class="input-group">

                            <input type="text" class="form-control input-sm datepicker"  id="available_date" name="available_date">

                            <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                            </div>

                            </div>

                          </div>

          

                         </div>

                          

                          <div class="col-md-6">

                          <div class="form-group">

                            <label>Remind</label>

                            <select class="selectpicker  show-tick form-control" id="remind_me" name="remind_me">

                            <option value="" selected>Never</option>

                                    <option value="1">1 day</option>

                                    <option value="7">1 week</option>

                                    <option value="14">2 weeks</option>

                                    <option value="30">1 month</option>

                                    <option value="60">2 months</option>

                                    <option value="90">3 months</option>

                                    <option value="120">4 months</option>

                                    <option value="180">6 months</option>

                            </select>

                          </div>

                          </div>

                      </div>

                      <h5 class="text-primary">Notes</h5>

                      <div class="form-group">

                            <label>New Notes</label>

                            <textarea class="form-control" id="notes" name="notes"></textarea>

                            <input name="leads_notes"  style="display:none;" class="form-control" id="leads_notes" value="">

                            

                      </div>

                      <div class="document_area" id="shownotes">No note found for this listing</div>

                     </div>

                     

                     <div class="col-md-6">

                        <div class="form-group">

                            <label>Key Loaction</label>

                            <input type="text" class="form-control input-sm" id="key_location" name="key_location">

                        </div>

                        <div class="form-group">

                        <label class="">

                            <input type="checkbox" name="tenanted" id="tenanted"/>

                             

                            <span class="lbl padding">Property Tenated?</span>

                        </label>

                        <textarea name="documents" style="display:none; width:300px; height:100px;"  class="form-control" id="documents"></textarea>

                        </div>

                        <div class="form-group">

                            <label>Rented at</label>

                            <input type="text" class="form-control input-sm" id="amount" name="amount">

                        </div>

                        

                        <div class="form-group">

                            <label>Rental until</label>

                            

                            <div class="input-group">

                            <input type="text" class="form-control input-sm datepicker"  id="amount_date" name="amount_date">

                            <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                            </div>

                            </div>

                            

                            

                            

                        </div>

                        

                        <div class="form-group">

                            <label>Maintenance Fee</label>

                            <input type="text" class="form-control input-sm" id="maintenance" name="maintenance">

                        </div>

                        <div class="form-group">

                            <label>Price sq/ft</label>

                           

                            <input readonly title="This is an auto-calculated field. Ensure the price and built up area fields are populated for this field to show the price per sq ft." type="text" class="form-control input-sm" name="unit_size_price_2"  id="unit_size_price_2" value="">

                        </div>

                        <h5 class="text-primary">Document</h5>

                        <div class="form-group">

                            <label>Document Name</label>

                            <input type="text" class="form-control input-sm" id="document_name" name="document_name">

                              <div style="display:none;" id="download_animation">

                                    <img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="24" height="24" />

                                </div>

                        </div>

                        <div class="form-group">

                              <input type="file" class="pull-left" id="listings_documents" name="listings_documents">

                             

                              <button class="btn btn-primary" id="buttonUpload"  onClick="return ajaxFileUpload();"><i class="fa fa-upload"></i>Upload</button>

                        </div>

                     <!--   <div class="document_area"></div>-->

                         <div class="document_area" style="border: 1px solid #D3D3D3; height: 100px; overflow-y: scroll;" id="showDocuments">

                                    No documents found for this listing</div>

                     </div>

                     

                    </div>

                      

                    

                  </div>

                  

                  <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>

                  </div>

                </div>

              </div>

            </div>

             <style>.gist-formfields .form-group {

    overflow: hidden;

}</style>

               <!-- Add Other Media Modal -->

           <div class="modal fade" id="other_media" tabindex="-1">

              <div class="modal-dialog">

                <div class="modal-content">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Add Other Media</h4>

                    <p>Paste the links to your other media here. Remember to include the full URL starting with http://</p>

                  </div>

                  

                  <div class="modal-body gist-formfields">

                      <div class="form-group">

                            <label class="col-md-3 control-label">YouTube Video Link</label>

                            <div class="col-md-9">

                              <input type="text" class="form-control" name="video_embed_code" id="video_embed_code">

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-3 control-label">360 virtual tour link</label>

                            <div class="col-md-9">

                              <input type="text" class="form-control" name="360_embed_code" id="360_embed_code">

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-3 control-label">Audio tour link</label>

                            <div class="col-md-9">

                              <input type="text" class="form-control" name="audio_embed_code" id="audio_embed_code">

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-3 control-label">Video tour link</label>

                            <div class="col-md-9">

                              <input type="text" class="form-control" name="virtual_tour_embed_code" id="virtual_tour_embed_code">

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-3 control-label">QR code link</label>

                            <div class="col-md-9">

                              <input type="text" class="form-control" name="qr_code_link" id="qr_code_link">

                            </div>

                        </div>

                        

                     <!--    <div class="form-group">

                            <label class="col-md-3 control-label">PDF broucher</label>

                            <input style="display:none;" type="text" name="pdf_brochure" id="pdf_brochure">

                            <div class="col-md-6">

                             <input id="pdf_brochure_upload"  type="file" size="10" name="pdf_brochure_upload">

                            </div>

                            <div class="col-md-3">

                           

                            <button  class="btn btn-primary" id="buttonUpload" onClick="return ajaxFileUpload_pdf();">Upload</button>

                            <span class="margin-left-10" id='pdf_download'></span>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-3 control-label">Upload Video  <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

                           data-placement="bottom" data-content="Upload video for your property it should be in mp4 format and less then 10MB.">

                           <i class="fa fa-info-circle"></i>

                           </a></label>

                           <input style="display:none;" type="text" name="video_path" id="video_path">

                            <div class="col-md-6">

                             <input id="video_path_upload"  type="file" size="10" name="video_path_upload">

                            </div>

                            <div class="col-md-3">

                          

                           <button  class="btn btn-primary" id="buttonUpload"   onClick="return ajaxFileUpload_video();">Upload</button>

                            </div>

                        </div> -->

                      <div class="clearfix"></div>

                  </div>

                  <div class="modal-footer">

                  <div style="display:none;" class="pull-left" id="download_animation_media">

                            <img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="26" height="26" />

                    </div>

                    <button type="button" id="btn-close-othermedia" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>

                  </div>

                </div>

              </div>

               <div id="preview_video_div" style="display:none;">

                <span></span>

                <a id="hide_video" style="float:right; margin: 10px 5px 0 0;" href="# show">Hide Video</a>

            </div>

            </div>
            

            

            <!-- Cheques Modal -->

            <div class="modal fade" id="cheques_pop" tabindex="-1">

              <div class="modal-dialog">

                <div class="modal-content">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Price options based on No. of Cheques</h4>

                    <p>All these price options along with the no. of cheques will be displayed on the property details page on Gistler.com. All other portals will continue to display your 1st (Default) choice.</p>

                  </div>

                  

                  <div class="modal-body">

                  <form>

                  <div class="row" id="cheque_option_1">

                  <div class="col-md-4"><h5><strong>Option 1</strong> <span class="text-success">Default</span></h5></div>

                  <div class="col-md-4">

                      <div class="form-group">

                        <input type="text" class="form-control input-sm"  name="price_1" id="price_1" placeholder="Price (AED)">

                        

                      </div>

                  </div>

                  <div class="col-md-4">

                      <div class="form-group">

                        <select class="selectpicker  show-tick form-control input-sm cheques_option" id="cheques_1" name="cheques_1">

                         <option value="" selected>Select</option>

                                            <option value="1">1 cheque</option>

                                            <option value="2">2 cheques</option>

                                            <option value="3">3 cheques</option>

                                            <option value="4">4 cheques</option>

                                            <option value="5">5 cheques</option>

                                            <option value="6">6 cheques</option>

                                            <option value="7">7 cheques</option>

                                            <option value="8">8 cheques</option>

                                            <option value="9">9 cheques</option>

                                            <option value="10">10 cheques</option>

                                            <option value="11">11 cheques</option>

                                            <option value="12">12 cheques</option>

                        </select>

                      </div>

                  </div>

                  </div>

                  <div class="row">

                  <div class="col-md-4"><h5><strong>Option 2</strong></h5></div>

                  <div class="col-md-4">

                      <div class="form-group">

                        <input type="text" class="form-control input-sm" id="price_2" name="price_2" placeholder="Price (AED)">

                      </div>

                  </div>

                  <div class="col-md-4">

                      <div class="form-group">

                        <select class="selectpicker  show-tick form-control input-sm cheques_option" id="cheques_2" name="cheques_2">

                        <option value="" selected>Select</option>

                                            <option value="1">1 cheque</option>

                                            <option value="2">2 cheques</option>

                                            <option value="3">3 cheques</option>

                                            <option value="4">4 cheques</option>

                                            <option value="5">5 cheques</option>

                                            <option value="6">6 cheques</option>

                                            <option value="7">7 cheques</option>

                                            <option value="8">8 cheques</option>

                                            <option value="9">9 cheques</option>

                                            <option value="10">10 cheques</option>

                                            <option value="11">11 cheques</option>

                                            <option value="12">12 cheques</option>

                        </select>

                      </div>

                  </div>

                  </div>

                  <div class="row">

                  <div class="col-md-4"><h5><strong>Option 3</strong></h5></div>

                  <div class="col-md-4">

                      <div class="form-group">

                        <input type="text" class="form-control input-sm" id="price_3" name="price_3" placeholder="Price (AED)">

                      </div>

                  </div>

                  <div class="col-md-4">

                      <div class="form-group">

                        <select class="selectpicker  show-tick form-control input-sm cheques_option" id="cheques_3" name="cheques_3">

                        <option value="" selected>Select</option>

                                            <option value="1">1 cheque</option>

                                            <option value="2">2 cheques</option>

                                            <option value="3">3 cheques</option>

                                            <option value="4">4 cheques</option>

                                            <option value="5">5 cheques</option>

                                            <option value="6">6 cheques</option>

                                            <option value="7">7 cheques</option>

                                            <option value="8">8 cheques</option>

                                            <option value="9">9 cheques</option>

                                            <option value="10">10 cheques</option>

                                            <option value="11">11 cheques</option>

                                            <option value="12">12 cheques</option>

                        </select>

                      </div>

                  </div>

                  </div>

                  <div class="row">

                  <div class="col-md-4"><h5><strong>Option 4</strong></h5></div>

                  <div class="col-md-4">

                      <div class="form-group">

                        <input type="text" class="form-control input-sm" id="price_4" name="price_4" placeholder="Price (AED)">

                      </div>

                  </div>

                  <div class="col-md-4">

                      <div class="form-group">

                        

                        <select class="selectpicker  show-tick form-control input-sm " id="cheques_4" name="cheques_4">

                        <option value="" selected>Select</option>

                                            <option value="1">1 cheque</option>

                                            <option value="2">2 cheques</option>

                                            <option value="3">3 cheques</option>

                                            <option value="4">4 cheques</option>

                                            <option value="5">5 cheques</option>

                                            <option value="6">6 cheques</option>

                                            <option value="7">7 cheques</option>

                                            <option value="8">8 cheques</option>

                                            <option value="9">9 cheques</option>

                                            <option value="10">10 cheques</option>

                                            <option value="11">11 cheques</option>

                                            <option value="12">12 cheques</option>

                        </select>

                      </div>

                  </div>

                  </div> 

                  </form>

                  

                  </div>

                  

                  <div class="modal-footer">

                    <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Done</button>

                  </div>

                </div>

              </div>

            </div>

            

         <?php echo  form_close();?>

            <!-- Rental Form End -->

            </div>

            <!-- uae tab content end -->    

            </div>

            </div>

            

            

            

            <div class="row fadeInUp">

            <div class="col-lg-12">

            <div class="inner_tab_nav">

                <ul class="nav nav-tabs">

                    <li class="active"><a href="<?php echo site_url('listings/sales');?>" >Current Listings</a></li>

                    <li><a href="<?php echo site_url('listings/archived-sales');?>">Archived Listings</a></li>

                    <li><a href="<?php echo site_url('listings/listings_quality');?>">Listings Quality</a></li>

                </ul>

            </div>

            

            <div class="tab-content datatable-Scrolltab">

            <div  class="tab-pane fade in active" id="current_listing">

            <div class="listing_nav">

            <div class="row">

            <div class="col-md-8">

            <ul class="list-inline listing_action_nav">

             <li><a id="publish" class="dbstatus" href="# publish"><i class="fa fa-check-circle"></i> Publish</a></li>

            <li><a id="unpublish" class="dbstatus" href="# unpublish"><i class="fa fa-times"></i> Unpublish</a></li>

            <li class="dropdown">

           

            <a href="javascript:void(0);" id="share_options" class="dropdown-toggle click" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-share-alt"></i> Share Options</a><span class="caret"></span>

              <ul class="dropdown-menu">

              

                <li id="datashare_options_default" keyAccess="true"><a href="#" data-target="#share_excel_all" data-toggle="modal" class="popup_a"><i class="fa fa-file-excel-o"></i> Download all listing(s) as Excel table</a>

                <input type="hidden" id="access" value="true">

                </li>

                

 				<li id="datashare_options" ><a href="javascript:void(0);" data-target="#share_pdf_selected" data-toggle="modal" id="checkselectedListings" onClick="return getUserAndAgentDetails();" class="popup_a"><i class="fa fa-file-excel-o"></i> Download  selected listing as PDF brochure</a></li>

                

                

                <li><a href="javascript:void(0);" rel="popup_pdf_selected" data-target="#popup_pdf_selected_popup" data-toggle="modal" class="popup_a"><i class="fa fa-file-pdf-o"></i> Download selected listing(s) as PDF table</a></li>

 				<li><a href="javascript:void(0);" id="sms_verification_popup_selected" rel="sms_verification_selected" class="popup_a" data-target="#sms_verification_selected_popup" data-toggle="modal"><i class="fa fa-file-pdf-o"></i>Download selected listing(s) as Excel table</a></li>

                

                

                 

        <li id="datashare_options"><a href="javascript:void(0);" data-target="#sendemail_pdfbroucher_popup5" data-toggle="modal" rel="popup5"  onclick="return getUserDetails()" id="checkselectedListingsEmail" class="popup_a"><i class="fa fa-file-pdf-o"></i> Email selected listing(s) as PDF brochure(s)</a></li>

                  

                  

                  

                  

                   <li id="htmlemail_link"><a href="javascript:void(0);" onclick="return getCheckErrorImage()" id="checkselectedListingsEmailhtml" data-target="#sendemail_html_popup17" data-toggle="modal" rel="popup17" class="popup_a"><i class="fa fa-file-pdf-o"></i> Email selected listing(s) as HTML email</a></li>

                 

                

                

                

              </ul>

            </li>

            <li class="dropdown"><a href="javascript:void(0);" id="savesearch_options" class="dropdown-toggle click" data-toggle="dropdown"><i class="fa fa-check"></i> Save Search</a>

              <ul class="dropdown-menu save_search" id="datasavesearch_options">

              <p>Save your search as: </p>

              <div class="form-group">

              <input type="text" class="form-control input-sm" name="savesearch_name" id="savesearch_name">

              </div>

              <!--<a href="" class="btn btn-success btn-xs">Save</a>-->

               <button id="savesearch" class="btn btn-success btn-xs" name="savesearch" value="savesearch">Save</button>

              <h5 class="text text-primary">Saved Searches</h5>

              <div id="search_list">

							                                

			  </div>

              </ul>

            </li>

            

            

            

            

            <li><a href="" data-toggle="modal" data-target="#advanced_search"><i class="fa fa-search"></i> Advanced Search</a></li>

            <li><a href="" data-toggle="modal" data-target="#bulk_update" rel="bulk_update_fields" class="popup_a click updateFields" id="bulk_update_link"><i class="fa fa-list-ul"></i> Bulk Update</a></li>

            </ul>

            </div>

            <div class="col-md-4">

            <div class="pull-right">

            <ul class="list-inline">

            <li class="dropdown" id="dataaction_options"> 

                <a href="" class="dropdown-toggle btn btn-success click" id="action_options" data-toggle="dropdown">Action <i class="fa fa-chevron-down"></i></a>

                  <ul class="dropdown-menu">

                    <li><a href="#" id='add_task_popup_link' rel='add_task_popup'class="popup_a" data-toggle="modal" data-target="#add_task_popup">Add To-Do</a></li>

                  <!--   <li><a href="#" id='add_event_popup_link' rel='add_event_popup'class="popup_a" data-toggle="modal" data-target="#add_event">Add Event</a></li>

                     <li><a href="#" id='add_lead_popup_link' rel='add_lead_popup'class="popup_a" data-toggle="modal" data-target="#add_lead_popup">Add Lead</a></li>

             

                    <li><a href="#" id='add_deal_popup_link' rel='add_deal_popup'class="popup_a" data-toggle="modal" data-target="#add_deal_popup">Add Deal</a></li>

                    <li class="divider"></li>

                    <li><a href="#" rel='popup15' class="popup_a" data-toggle="modal" data-target="#copy_listing_popup" id="copy_listing_popupid">Copy Listing</a></li> -->

                    <li class="divider"></li>

                  

                <li id="move_to_archive_div"><a id='move_to_archive' href="# x" class="action_dropdown_link" data-toggle="modal" data-target="#">Archive</a></li>

             <!--   <li id="move_to_listings_div"><a id='move_to_listings' data-toggle="modal" data-target="#" class="action_dropdown_link" href="#">Unarchive</a></li>-->

                </ul>

                </li>

            

                <li class="dropdown"> 

                <a href="" id="view_options" class="dropdown-toggle btn btn-success click" data-toggle="dropdown">Views <i class="fa fa-chevron-down"></i></a>

                  <ul class="dropdown-menu">

                    <li>

                    <a id='view_task_popup_link' href="#?w=500" rel='view_task_popup'  class="popup_a" data-toggle="modal" data-target="#view_task_popup">

	                        		<div class="dropdown-option-div">To-Do <span id='activities_stats' class="badge">(0)</span></div>

	                            </a>

                    </li>         

                   

                    <li><a id='view_event_popup_link' rel='view_event_popup' href="#" data-toggle="modal" data-target="#view_event_popup" class="popup_a"> 

                     <div class="dropdown-option-div">Events <span id='events_stats' class="badge">(0)</span></div>

                   </a>

                  </li>

                    <li><a  id='view_lead_popup_link' href="#" data-toggle="modal" data-target="#leads_pop" rel='view_lead_popup' class="popup_a"> <div class="dropdown-option-div">Leads

                     <span id='leads_stats' class="badge">(0)</span></div> </a>

                     </li>

                    <!--<li><a href="#" data-toggle="modal" data-target="#view_contract">Contracts <span class="badge">0</span></a></li>-->

                    <li><a id='view_deal_popup_link' href="#" data-toggle="modal" data-target="#view_deal_popup" rel='view_deal_popup' class="popup_a"> 

                    <div class="dropdown-option-div">Deals <span id='deals_stats' class="badge">(0)</span></div></a>

                    

                    

                    </li>

                    <!-- <li><a id='view_landlord_popup_link' href="#" data-toggle="modal" data-target="#view_owner" rel='view_landlord_popup'  class="popup_a" >

                    <div class="dropdown-option-div">Owner <span id='landlord_stats' class="badge">(0)</span></div></a>

                 </li> -->

                </ul>

                </li>

            <li>

            <a href="" class="btn btn-success margin-bottom-15" data-toggle="modal" data-target="#columns">Columns <i class="fa fa-chevron-down"></i></a></li>

            </ul>

            </div>

            </div>

            <!-- i am select something -->

            <div class="gist-selmsg collapse" id="checkbox_error">

	  			<a id="error_close" data-toggle="collapse" href="#openSelsome" aria-expanded="false" aria-controls="openSelsome" role="button" class="close-selsomething"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>

	    		<img src="<?php echo base_url(); ?>images/select.png">

			</div>

            </div>

            </div>

           

            <div class="row">

                

                <!-- datatable goes here -->

             

                <table class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer" aria-describedby="dataTables-current-listing_info" id="listings_row">

                  <thead>

                  <tr>

                    <th>

                    <label class="">

                        <input onClick="toggleChecked(this.checked)" id='check_all_checkboxes' value='' type="checkbox"/>

                        <span class="lbl"></span>

                    </label>

                    </th>

                    <th><div style="cursor:pointer;min-width: 8px;" title="Click here to sort"></div></th>

                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Status</div></th>

                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Managed</div><span>M</span></th>

                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Exclusive</div><span>E</span></th>

                    <th><div style="cursor:pointer; display:none;" title="Click here to sort">Shared</div><span>S</span></th>

                    <th><div style="cursor:pointer;min-width:50px;" title="Click here to sort">Ref</div></th>

                    <th><div style="cursor:pointer;" title="Click here to sort">Unit</div></th>

                    <th><div style="cursor:pointer;" title="Click here to sort">Category</div></th>

                    <th><div style="cursor:pointer;" title="Click here to sort">Emirate</div></th>

                    <th><div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">Location</div></th>

                    <th><div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">Sub-Location</div></th>

                    <th><div style="cursor:pointer;" title="Click here to sort">Beds</div></th>

                    <th><div style="cursor:pointer;" title="Click here to sort">BUA</div></th>

                    <th><div style="cursor:pointer;" title="Click here to sort">Price</div></th>

                    <th><div style="cursor:pointer;" title="Click here to sort">Agent</div></th>

                    <th><div style="cursor:pointer;" title="Click here to sort">Owner</div></th>

                    <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Type</div></th>

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

                    <th type="not_default"><div style="cursor:pointer; width:50px;" title="Click here to sort">Price / sq ft</div></th>

                

                    <th><div style="cursor:pointer; min-width:40px;" title="Click here to sort">Listed</div></th>

                    <th><div style="cursor:pointer; min-width:40px;" title="Click here to sort">Updated</div></th>

                    <th><div style="cursor:pointer; min-width:55px !important;" title="Click here to sort">Created By</div></th>

                    <th><div style="cursor:pointer; min-width:60px !important;" title="Click here to sort">Key Location</div></th>

                    <th><div style="cursor:pointer; min-width:60px !important;" title="Click here to sort">Developer Unit</div></th>

                    </tr>

			</thead>

             <thead id="searchbox">

                <tr  class="search_box">

                   

                     <form id="myForm2">

                    <td style="text-align:center;"><a id="reset_filter" style="display:none;" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png?ts=10" title="Reset filter"></a></td>

                    <td></td>

                    

                    <td class="dropdown">

                    <a href="#" id="1_status" class="dropdown-toggle click" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                      <input id='1' type="text" class="search_init" style="display:none;"/>

                   	    <div class="dropdown-menu emirate_search" id="data1_status">

                        <span id_search='1' value="1" class='sorting' image="<?php echo base_url();?>mydata/images/header_unpublish.png"><img src="<?php echo base_url();?>mydata/images/header_unpublish.png" title="Unpublished"></span>

                        <span id_search='1' value="2" class='sorting' image="<?php echo base_url();?>mydata/images/header_publish.png"><img src="<?php echo base_url();?>mydata/images/header_publish.png" title="Published"></span> <span id_search='1' value="3" class='sorting' image="<?php echo base_url();?>mydata/images/header_unapproved.png"><img src="<?php echo base_url();?>mydata/images/header_unapproved.png" title="Waiting Approval"></span> <span id_search='1' value="4" class='sorting' image="<?php echo base_url();?>mydata/images/header_draft.png"><img src="<?php echo base_url();?>mydata/images/header_draft.png" title="Draft"  width="16px" height="16px"></span>

              			</div>

                    </td>

                    

                    

                     <td class="dropdown">

                    <a href="#" id="2" class="dropdown-toggle click" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                     

                   	    <div class="dropdown-menu emirate_search data" id="data2">

                        <span id_search='2' value="0" image="<?php echo base_url();?>mydata/images/header_mx.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_mx.png" title="Non Managed"></span><br>

                        <span id_search='2' value="1" image="<?php echo base_url();?>mydata/images/header_m.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_m.png" title="Managed"></span>

              			</div>

                    </td>

                    

                    <td class="dropdown">

                    <a href="#" id="3" class="dropdown-toggle click" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                     

                   	    <div class="dropdown-menu emirate_search data" id="data3">

                        <span id_search='3' value="0" image="<?php echo base_url();?>mydata/images/header_ex.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_ex.png" title="Non Exclusive"></span><br>

                        <span id_search='3' value="1" image="<?php echo base_url();?>mydata/images/header_e.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_e.png" title="Exclusive"></span> 

              			</div>

                    </td>

                    <td class="dropdown">

                    <a href="#" id="4" class="dropdown-toggle click" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                     

                   	    <div class="dropdown-menu emirate_search data" id="data4">

                       <span id_search='4' value="0" image="<?php echo base_url();?>mydata/images/header_ssx.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_ssx.png" title="Not Shared"></span><br>

                        <span id_search='4' value="1" image="<?php echo base_url();?>mydata/images/header_ss.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_ss.png" title="Shared"></span> 

              			</div>

                    </td>

                    <td><input type="text" class="form-control input-sm search_init" id="5" value=" Min 3 chars"></td>

                    <td><input type="text" class="form-control input-sm search_init" id="6"></td>

                    <td>

                    <select class="form-control input-sm search_init" id="7">

                    <option value="" selected="">Select</option>

                                                                          <option value="Apartment">Apartment</option>

                                                                          <option value="Commercial Full Building">Commercial Full Building</option>

                                                                          <option value="Duplex">Duplex</option>

                                                                          <option value="Hotel">Hotel</option>

                                                                          <option value="Hotel apartment">Hotel apartment</option>

                                                                          <option value="Labour camp">Labour camp</option>

                                                                          <option value="Land Commercial">Land Commercial</option>

                                                                          <option value="Land Mixed Use">Land Mixed Use</option>

                                                                          <option value="Land Residential">Land Residential</option>

                                                                          <option value="Loft apartment">Loft apartment</option>

                                                                          <option value="Multiple Sale Units">Multiple Sale Units</option>

                                                                          <option value="Office">Office</option>

                                                                          <option value="Penthouse">Penthouse</option>

                                                                          <option value="Plot">Plot</option>

                                                                          <option value="Residential Build">Residential Build</option>

                                                                          <option value="Retail">Retail</option>

                                                                          <option value="Townhouse">Townhouse</option>

                                                                          <option value="Villa">Villa</option>

                                                                          <option value="Warehouse">Warehouse</option>

                    </select>

                    

                    

                    </td>

                    <td>

                    <select class="form-control input-sm search_init" id="8" name="8">

                    <option value="" selected>Select</option>

                            <option value="Abu Dhabi">

    Abu Dhabi                            </option>

                            <option value="Ajman">

    Ajman                            </option>

                            <option value="Al Ain ">

    Al Ain                            </option>

                            <option value="Dubai">

    Dubai                            </option>

                            <option value="Fujairah">

    Fujairah                            </option>

                            <option value="Ras Al Khaimah">

    Ras Al Khaimah                            </option>

                            <option value="Sharjah">

    Sharjah                            </option>

                            <option value="Umm Al Quwain">

    Umm Al Quwain                            </option>

                    </select>

                    </td>

                    <td><input type="text" class="form-control input-sm search_init" id="9" value=" Min 3 chars"></td>

                    <td><input type="text" class="form-control input-sm search_init" id="10"></td>

                    <td>

                    <select class="form-control input-sm search_init" id="11" name="beds">

                    <option value="0" selected>Select</option>

                        <option value="0.5">Studio</option>

                        <option value="1">1 bedroom</option>

                        <option value="2">2 bedrooms</option>

                        <option value="3">3 bedrooms</option>

                        <option value="4">4 bedrooms</option>

                        <option value="5">5 bedrooms</option>

                        <option value="6">6 bedrooms</option>

                        <option value="7">7 bedrooms</option>

                        <option value="8">8 bedrooms</option>

                        <option value="9">9 bedrooms</option>

                        <option value="10">10 bedrooms</option>

                        <option value="11">11 bedrooms</option>

                        <option value="12">12 bedrooms</option>

                        <option value="13">13 bedrooms</option>

                        <option value="14">14 bedrooms</option>

                        <option value="15">15 bedrooms</option>

                        <option value="16">16 bedrooms</option>

                    </select>

                    </td>

                    <td class="dropdown">

                    	<a id="12" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                   	    <div class="dropdown-menu emirate_search">

                        <div class="form-group">

                      	<label>Min (Sq Ft):</label>

                         <input class="form-control input-sm" name="minarea" type="text" id="minarea">

                        </div>

                        <div class="form-group">

                            <label>Max (Sq Ft):</label>

                          <input name="maxarea" type="text" id="maxarea" class="form-control input-sm">

                        </div> 

              			</div>

                    </td>

                    <td class="dropdown">

                    	<a id="13" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                   	    <div class="dropdown-menu emirate_search">

                        <div class="form-group">

                      	<label>Min (AED):</label>

                        <input class="form-control input-sm" name="minprice" type="text" id="minprice">

                        </div>

                        <div class="form-group">

                            <label>Max (AED):</label>

                            <input name="maxprice" type="text" id="maxprice" class="form-control input-sm">

                        </div> 

              			</div>

                    </td>

                    <td>

                    <select class="form-control input-sm " id='14'>

                   

                    </select> 

                    </td>

                    <td><input type="text" class="form-control input-sm search_init" id='15' value=" Min 3 chars"></td>

                    

                    

                    

                    <td><input id='16' type="text" class="form-control input-sm search_init" /></td>

                <td><input id='17' type="text" class="form-control input-sm search_init" /></td>

                <td><input id='18' type="text" class="form-control input-sm search_init" /></td>

                <td><input id='19' type="text" class="form-control input-sm search_init" /></td>

                <td><input id='20' type="text" class="form-control input-sm search_init" /></td>

                <td><input id='21' type="text" class="form-control input-sm search_init" /></td>

                <td><input id='22' type="text" class="form-control input-sm search_init" /></td>

                <td><select name="23" type="text" class="form-control input-sm search_init" id="23">

                        <option value="" selected>Select</option>

                        <option value="1">Semi-Fitted</option>

                        <option value="2">Fitted Space</option>

                        <option value="3">Shell and core</option>

                    </select></td>

                <td><select name="24" type="text" class="form-control input-sm search_init" id="24">

                        <option value="" selected="selected">Select</option>

                                                    <option value="3">Rented</option>

                                                <option value="1">Available</option>

                        <option value="7">Blocked</option>

                        <option value="5">Reserved</option>

                                                    <option value="6">Renewed</option>

                                                <option value="2">Pending</option>

                        <option value="4">Upcoming</option>

                    </select></td>

                <td><select name="25" type="text" class="form-control input-sm search_init" id="25">

                        <option value="" selected>Select</option>

                            <option value=" Not Specified" > Not Specified</option>

                            <option value="7 days" >7 days</option>

                            <option value="Abu Dhabi week" >Abu Dhabi week</option>

                            <option value="Agent" >Agent</option>

                            <option value="Agent External" >Agent External</option>

                            <option value="Agent Internal" >Agent Internal</option>

                            <option value="Al Ayam" >Al Ayam</option>

                            <option value="Al Bayan" >Al Bayan</option>

                            <option value="Al Futtaim" >Al Futtaim</option>

                            <option value="Al Ittihad News paper" >Al Ittihad News paper</option>

                            <option value="Al Khaleej" >Al Khaleej</option>

                            <option value="Al Rai" >Al Rai</option>

                            <option value="AL Watan" >AL Watan</option>

                            <option value="Arab Times" >Arab Times</option>

                            <option value="Asharq Al Awsat" >Asharq Al Awsat</option>

                            <option value="Bank Referral" >Bank Referral</option>

                            <option value="Bayut.com" >Bayut.com</option>

                            <option value="Blackberry SMS" >Blackberry SMS</option>

                            <option value="Business card" >Business card</option>

                            <option value="Client Referral" >Client Referral</option>

                            <option value="Cold call" >Cold call</option>

                            <option value="Colours TV" >Colours TV</option>

                            <option value="Database" >Database</option>

                            <option value="Developer" >Developer</option>

                            <option value="Direct call" >Direct call</option>

                            <option value="Direct Client" >Direct Client</option>

                            <option value="Drive around" >Drive around</option>

                            <option value="Dubizzle Feature" >Dubizzle Feature</option>

                            <option value="Dubizzle.com" >Dubizzle.com</option>

                            <option value="Dzooom.com" >Dzooom.com</option>

                            <option value="Email campaign" >Email campaign</option>

                            <option value="Ertebat" >Ertebat</option>

                            <option value="Exhibition Stand" >Exhibition Stand</option>

                            <option value="Existing client" >Existing client</option>

                            <option value="EzEstate" >EzEstate</option>

                            <option value="EzHeights.com" >EzHeights.com</option>

                            <option value="Facebook" >Facebook</option>

                            <option value="Flyers" >Flyers</option>

                            <option value="Forbes Mailer" >Forbes Mailer</option>

                            <option value="Friend or Relative" >Friend or Relative</option>

                            <option value="Google " >Google </option>

                            <option value="Gulf Daily News" >Gulf Daily News</option>

                            <option value="Gulf News" >Gulf News</option>

                            <option value="Gulf News Mailer" >Gulf News Mailer</option>

                            <option value="Gulf Newspaper Freehold" >Gulf Newspaper Freehold</option>

                            <option value="Gulf Newspaper Residential" >Gulf Newspaper Residential</option>

                            <option value="Gulf Times" >Gulf Times</option>

                            <option value="Gulfnews Freehold" >Gulfnews Freehold</option>

                            <option value="Gulfpropertyportal.com" >Gulfpropertyportal.com</option>

                            <option value="Instagram" >Instagram</option>

                            <option value="JustProperty.com" >JustProperty.com</option>

                            <option value="JustRentals.com" >JustRentals.com</option>

                            <option value="JUWAI" >JUWAI</option>

                            <option value="Khaleej Times" >Khaleej Times</option>

                            <option value="LinkedIn" >LinkedIn</option>

                            <option value="Listanza" >Listanza</option>

                            <option value="Luxury Estate.com" >Luxury Estate.com</option>

                            <option value="Luxury Square Foot" >Luxury Square Foot</option>

                            <option value="Magazine" >Magazine</option>

                            <option value="Memaar TV" >Memaar TV</option>

                            <option value="MoneyCamel.com" >MoneyCamel.com</option>

                            <option value="National News paper" >National News paper</option>

                            <option value="Newsletter" >Newsletter</option>

                            <option value="Newspaper advert" >Newspaper advert</option>

                            <option value="Old Landlord" >Old Landlord</option>

                            <option value="Online Banners" >Online Banners</option>

                            <option value="Open House" >Open House</option>

                            <option value="Other" >Other</option>

                            <option value="Other portal" >Other portal</option>

                            <option value="Outdoor Media" >Outdoor Media</option>

                            <option value="Personal Referral" >Personal Referral</option>

                            <option value="Property Acquisition Department" >Property Acquisition Department</option>

                            <option value="Property Finder Premium" >Property Finder Premium</option>

                            <option value="Property Inc." >Property Inc.</option>

                            <option value="Property Management" >Property Management</option>

                            <option value="Property Trader" >Property Trader</option>

                            <option value="Property Weekly" >Property Weekly</option>

                            <option value="Propertyfinder.ae" >Propertyfinder.ae</option>

                            <option value="Propertyonline" >Propertyonline</option>

                            <option value="Propertywifi.com" >Propertywifi.com</option>

                            <option value="PropSpace MLS" >PropSpace MLS</option>

                            <option value="Radio" >Radio</option>

                            <option value="Radio Advert" >Radio Advert</option>

                            <option value="Referral within company" >Referral within company</option>

                            <option value="Relocation" >Relocation</option>

                            <option value="Rightmove.co.uk" >Rightmove.co.uk</option>

                            <option value="Roadshow" >Roadshow</option>

                            <option value="Sandcastles.ae" >Sandcastles.ae</option>

                            <option value="School Communicator" >School Communicator</option>

                            <option value="School Communicator" >School Communicator</option>

                            <option value="Search Engine" >Search Engine</option>

                            <option value="Signboard" >Signboard</option>

                            <option value="SMS campaign" >SMS campaign</option>

                            <option value="Social media Campaign" >Social media Campaign</option>

                            <option value="Souq.com" >Souq.com</option>

                            <option value="Staff Mailer" >Staff Mailer</option>

                            <option value="Twitter " >Twitter </option>

                            <option value="Walk-in" >Walk-in</option>

                            <option value="Website" >Website</option>

                            <option value="Whatpricemyhome" >Whatpricemyhome</option>

                            <option value="Whatsapp" >Whatsapp</option>

                            <option value="Word of Mouth" >Word of Mouth</option>

                            <option value="www.propertyportal.ae" >www.propertyportal.ae</option>

                            <option value="Youtube" >Youtube</option>

                            <option value="Zawya Mailer" >Zawya Mailer</option>

                            <option value="Zoopla" >Zoopla</option>

                    </select></td>

                <td><input id='available_dateS' type="text" class="search_init" /></td>

                <td><select name="27" type="text" class="form-control input-sm search_init" id="27">

                        <option value="" selected>Select</option>

                        <option value="1">1 day</option>

                        <option value="7">1 week</option>

                        <option value="14">2 weeks</option>

                        <option value="30">1 month</option>

                        <option value="60">2 months</option>

                    </select></td>

                <td><select name="28" type="text" class="form-control input-sm search_init" id="28">

                        <option value="0" selected>Select</option>

                        <option value="1">Furnished</option>

                        <option value="2">Unfurnished</option>

                        <option value="3">Partly Furnished</option>

                    </select></td>

                <td><select name="29" type="text" class="form-control input-sm search_init" id="29">

                        <option value="" selected>Select</option>

                        <option value="0">No</option>

                        <option value="1">Yes</option>

                    </select></td>

                <td><input id='30' type="text" class="form-control input-sm search_init" /></td>

                <td><input id='31' type="text" class="form-control input-sm search_init" /></td>

                <td><input id='32' type="text" class="form-control input-sm search_init" /></td>

                <td><select name="33" type="text" class="form-control input-sm search_init" id="33">

                        <option value="" selected>Select</option>

                        <option value="0">No</option>

                        <option value="1">Yes</option>

                    </select></td>

                <td><input id='34' type="text" class=" form-control input-sm search_init " /></td>

                <td><input id='35' type="text" class="form-control input-sm search_init" /></td>

                <td><input id='36' type="text" class="form-control input-sm search_init" /></td>

                <td><input id='37' type="text" class="form-control input-sm search_init"/></td>

                <td><input id='38' type="text" class="form-control input-sm search_init" /></td>

                <td><input id='39' type="text" class="form-control input-sm search_init" /></td>

              

                    <td class="dropdown">

                    	<a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                   	    <div class="dropdown-menu emirate_search">

                        <div class="form-group">

                        <label>Listed From</label>

                        <div class="input-group input-daterange" id="datepicker">

                          <input type="text" class="form-control input-sm" id="dateaddedS" name="dateaddedS">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        </div>

                     	</div>

                        <div class="form-group">

                        <label>To</label>

                        <div class="input-group input-daterange" id="datepicker">

                          <input type="text" class="form-control input-sm" id="dateaddedSto" name="dateaddedSto">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        </div>

                     	</div>

              			</div>

                    </td>

                    

                    <td class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                   	    <div class="dropdown-menu emirate_search">

                        <div class="form-group">

                        <label>Updated From</label>

                        <div class="input-group input-daterange" id="datepicker">

                          <input type="text" class="form-control input-sm" id="dateupdatedS" name="dateupdatedS">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        </div>

                     	</div>

                        <div class="form-group">

                        <label>To</label>

                        <div class="input-group input-daterange" id="datepicker">

                          <input type="text" class="form-control input-sm" id="dateupdatedSto" name="dateupdatedSto">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        </div>

                     	</div>

              			</div>

                    </td>

                    <td>

                    <select class="form-control input-sm search_init" id="42">

                     <option value="" selected>Select</option>

                    </select> 

                    </td>

                    <td><input type="text" class="form-control input-sm search_init" id="43" value=" Min 3 chars" name="43"></td>

                    <td>

                    <select class="form-control input-sm " id="45" name="45">

                     <option value="" selected>Select</option>

                        <option value="1">Yes</option>

                        <option value="0">No</option>

                    </select>

                    </td>

                    </form>

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

            </div>

            </div>

            </div>

            

                    

            

            



 			</div>

            </div>

            <!-- container end -->

            

            

            </div>

            

<!-- wrapper end -->

     <!-- JS WORK -->

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

            $('#ExportToCSVALL').html('<div style="display:none;" id="downloadCSV_animation"><img src="'+mainurl+'mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div>\n\<a id="downloadCSV_div" class="popup_a" href="'+mainurl+'generate/exportCSV?type_listing=2"><img src="'+mainurl+'mydata/images/excel_big.png?ts=10" width="32" height="32">\n\<br>Download Excel</a>'); // update download button link

           

            $('#ExportToCSVALLSelected').html('<div style="display:none;" id="downloadCSV_animation"><img src="'+mainurl+'mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div>\n\<a id="downloadCSV_div_all_selected" class="popup_a" href="#"><img src="'+mainurl+'mydata/images/excel_big.png?ts=10" width="32" height="32">\n\<br>Download Selected Columns</a>'); // update download button link

          

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

                       

                   $('#ExportToPDF').html('<div style="display:none;" id="downloadPDFtables_animation"><img src="'+mainurl+'mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download PDF in progress. Please wait.</div><a id="downloadPDFtables_div" class="popup_a" href="'+mainurl+'generate/exportPDF?exportPDF='+value+'"><img src="<?php echo base_url();?>mydata/images/pdf_big.png?ts=10" width="32" height="32"><br>Download PDF</a>'); // update download button link

                    $('#email_count').text(count);

                    

                    $('#emailCSV').val(value);

                    $('#bulk_change_items_count').html(count);

                    $('#bulk_update_ids').val(value);

                    $('#ExportToCSV').html('<div style="display:none;" id="downloadCSV_animation"><img src="'+mainurl+'mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div><a id="downloadCSV_div" class="popup_a" href="'+mainurl+'generate/exportCSV?type_listing=2&exportCSV='+value+'"><img src="'+mainurl+'mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download All Columns</a>'); // update download button link

                    $('#ExportToCSVSelected').html('<div style="display:none;" id="downloadCSV_animation"><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div><a id="downloadCSV_div_selected" class="popup_a" href="#"><div id="downloadCSV_div_click"><img src="<?php echo base_url();?>mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download Selected Columns</div></a>'); // update download button link

            });

                                                    

                    $('#action_matching_leads').click(function(){

                        $("#sentFromUser1").attr('checked','checked') ;

                        $("#sentFromCompany1").attr('checked',false) ;

                    });

                }); 

    </script>

     <!-- END JS WORK  -->   


<!-- popups starts here -->

<!-- action/task windows -->

<div class="modal fade" id="add_task_popup" tabindex="-1" >

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                  <div class="modal-header">

              

               <!--      <button type="button" class="btn btn-success" data-dismiss="modal" ><i class="fa fa-check"></i> Save &amp; Close</button>

                    <span aria-hidden="true">&times;</span></button>-->

                    <h4 class="modal-title">Add New To-Do</h4>

                   <div class="popup_description">To create a new to-do for '<strong id='popup_record_reference_T'></strong>' please fill out the following form and click save button.</div>

                  </div>

                      <div id="add_task_window">Please select a listing</div>

                  

                </div>

              </div>

          </div>

 <!-- Add event Modal -->

          <div class="modal fade" id="add_event" tabindex="-1" >

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Add New Calendar Event</h4>

                  </div>

                  <form id="myForm_event_popup" action="<?php echo base_url();?>calendar/submit/" method="post">

                  <div class="modal-body">

                  

             <!--     <button type="button" class="btn btn-success" data-dismiss="modal" ><i class="fa fa-check"></i> Save &amp; Close</button>-->

                  

                  <button type="submit" id="SaveEventPopup"  class="btn btn-success" name="SaveEventPopup" value="Save Task" ><i class="fa fa-check"></i>Save & Close</button>

					<div class="showdata" id="showpopupdata"></div>

                

                  

                  <div class="row">

                  <h4 class="add_new_rental">Add New Calendar Event</h4>

                  </div>

                  

                  <div id="add_event_popup" class="popup_block">

                    <div id="add_event_window">Please select a listing</div>

                </div>

                  </div>

                  </form>

                  

                </div>

              </div>

          </div> 

          

   <!-- add lead popup -->

		<div class="modal fade" id="add_lead_popup" tabindex="-1" >

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                  <div class="modal-header">

              

               <!--      <button type="button" class="btn btn-success" data-dismiss="modal" ><i class="fa fa-check"></i> Save &amp; Close</button>

                    <span aria-hidden="true">&times;</span></button>-->

                     <h4 class="modal-title">Add New Lead</h4>

                  <p>To create a new lead for '<strong id='popup_record_reference_Lead'></strong>' please fill out the following form and click save button. </p>

                

                  </div>

                      <div id="add_lead_window">Please select a listing</div>

                  

                </div>

              </div>

          </div>      

            <!-- Add Deals Modal -->

             

          <div class="modal fade" id="add_deal_popup" tabindex="-1" >

            <div class="modal-dialog modal-lg">

              <div class="modal-content ">

                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span></button>

                  <h4 class="modal-title">Add New Deal</h4>

                  <p>To create a new deal for '<strong id='popup_record_reference_D'></strong>' please fill out the following form and click save button </p>

                  <p>* This will create a skeletal deal record. You can complete the information for this deal by navigating through the 'View Deals" options or going to Deals screen. </p>

                </div>

                

                 <div id="add_deal_window">Please select a listing</div>

              </div>

            </div>

          </div>

          

           <!-- Copy Listing Modal -->

               <!-- Copy Listing Modal -->

            <div class="modal fade" id="copy_listing_popup" tabindex="-1" >

              <div class="modal-dialog modal-sm">

                <div class="modal-content ">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Copy Listing</h4>

                  </div>

                  

                  <div class="modal-body">

                    <form id='rentals_form' name='popup_form' action="<?php echo base_url();?>listings/rentals/" method="POST">

            <input style="display:none;" id="copy_rentals_id" name="copy_rentals_id" type="text">

        </form>

        <form id='sales_form'   name='popup_form' action="<?php echo base_url();?>listings/sales/"   method="POST">

            <input style="display:none;" id="copy_sales_id"   name="copy_sales_id"   type="text">

        </form>

       

                  <div class="form-group">

                        <select class="form-control input-sm" id="copy_listing" name="copy_listing">

                       	<option value="rentals" selected>Rental</option>

           				 <option value="sales">Sales</option>

                        </select>

                   </div>

                  </div>

                  

                  <div class="modal-footer">

                    <button type="button" class="btn btn-success" value="copy_listing_button" onClick="document.forms[$('#copy_listing option:selected').val()+'_form'].submit();"><i class="fa fa-files-o"></i> Duplicate</button>

                    

                  </div>

                </div>

              </div>

            </div>

  <!-- Advanced Search Modal -->

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

                        <div class="input-group">

                            <input type="text" class="form-control input-sm datepicker"  id="as_available_date_from" name="as_available_date_from">

                            <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                            </div>

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

                        <div class="input-group">

                            <input type="text" class="form-control input-sm datepicker"  id="as_available_date_to" name="as_available_date_to">

                            <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                            </div>

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

            

                 <script type="text/javascript">

$(document).ready(function() { 

    $('.updateFields').click( function() {

        if($('#listings_row input').is(':checked')){

            $("#listings_row tbody input:checked").length;

            if($("#listings_row tbody input:checked").length >1){

                if($("#listings_row tbody input:checked").length > 50){

                    alert("Sorry! You can only update a maximum of 50 listings at a time.");

                    return false;

                }

                $('#update_bulk_success').css("display","none");

                $('#update_bulk_confirm_div').css('display' , 'none');

                $('#update_bulk_form_div').css("display","block");

                $('#update_bulk_form :input').not('#bulk_update_ids').val('').removeAttr('checked').removeAttr('selected');

                $("#content_field, #set_label").empty();

            }else{

                alert("Select At least 2 records");

                return false;

            }

            

        }else{

            $('#checkbox_error').show(400);

            return false;

        }

        

        $('#update_bulk_button').click(function(){

            var element_2 = $("#field_name_bulk").val();

            var validate = $("#update_bulk_form").validate({ errorClass: 'form_fields_error',  errorPlacement: function(error, element) {

                }}).form() ;

            if(element_2 == 'portal' && $("#portals_count_f").val() <= 0){

                   alert("at least select one portal");

                   validate = false; 

            }

            if(validate){

                $('#update_bulk_form_div').css('display' , 'none');

                $('#update_bulk_confirm_div').css('display' , 'block');

                return false;

            }else{

                return false;

            }

                         

        });

                    

        $('#cancel_bulk_button').click(function(){

                    $('#update_bulk_confirm_div').css('display' , 'none');

                    $('#update_bulk_form_div').css('display' , 'block');

                    return false;

        });

        $('#confirm_bulk_button').click(function(){

             $("#loading-btn").css('display','inline-block');

//             $("#confirm_bulk_button").attr('disabled',true);

        });

                    

        $('#update_bulk_form').ajaxForm({

            beforeSubmit : function() { 

                return $("#update_bulk_form").validate({ errorClass: 'form_fields_error',  errorPlacement: function(error, element) {

                }}).form() ;

            },

            success: function() {

                $("#loading-btn").css('display','none');

                $("#confirm_bulk_button").attr('disabled',false);

                oTable.fnDraw(false);

                oTable.fnFilterClear(true);

                $('#update_bulk_confirm_div').fadeOut("slow");

                $('#update_bulk_success').fadeIn("slow");

                if(last_id != ''){

                    getSingleRow(last_id,'listings');

                    };

                setTimeout(function() {

                   $('#update_bulk_form')[0].reset();

                }, 5000);





            }

        });           

    });

                

});

</script>

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

                <div id='loading-btn' style='display:none;'><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="26" height="26" /></div>

                <button type="text" id="confirm_bulk_button" class="btn btn-success"><i class="fa fa-check"></i>Confirm</button>

                <button type="text" id="cancel_bulk_button" class="btn  btn-default"><i class="fa fa-times"></i>Cancel</button>

     

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

            <div class="modal fade" id="locationMap" tabindex="-1">

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

               html += '<div class="form-group" id="area_divv_'+ai_type+'_'+count+'"><div class="input-group"><input name="area_information_'+ai_type+'_'+count+'"  class="form-control input-sm" id="area_information_'+ai_type+'_'+count+'">';

            html += ' <span class="input-group-addon"><a href="# ai" id="ai_button_'+ai_type+'_'+count+'" ai_type="'+ai_type+'" title="Remove this entry" count="'+count+'" class="text-danger remove_extra_ai"><i class="icon-minus-circled fa fa-trash"></i></a></span> </div> </div>';



            $('#extra_ai_'+ai_type).append(html);

       }else{

           alert('You cant add more then 6 fields.');

       }

    });

    

    $("body").on('click','.remove_extra_ai', function(){

       var ai_type = $(this).attr('ai_type');

       var count = $(this).attr('count');

        $('#area_divv_'+ai_type+'_'+count).remove();

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

                            <div id="extra_ai_1">

                

            </div>

                        </div>

                        

                        

                        

                        <div class="form-group" id="ai_type_2">

                            <label>Metros</label>

                            <div class="input-group">                              

                              <input type="text" class="form-control input-sm" name="area_information_2_1" id="area_information_2_1">

                              <span class="input-group-addon"><a href="# ai" ai_type="2" title="Add another entry for 'Metros'" count="1" class="add_extra_ai"><i class="fa fa-plus-circle"></i></a></span>

                            </div>

                             <div id="extra_ai_2">

                

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

                         <ul class="nav nav-tabs" id="tabs_image" image_type=''>

                            <li  class="active" id="tab_n1"><a href="#photo" data-toggle="tab" tab="tab1_img"    id="photos">Photos</a></li>

                            <li class="inactive" id="tab_n2"><a href="#floor_plan" data-toggle="tab" tab="tab2_img" id="floor">Floor Plan</a></li>

                        </ul>

                    </div>

                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="photo">

                            <div class="col-md-12" style=" margin-bottom:20px;">

                               <!-- Dev work start 021116 start -->

                               <!-- <span><i class="fa fa-upload"></i> Selct images to upload</span> -->

                               <!-- Dev work start 021116 end -->

                                <input type="file" class="fileUpload" id="file_upload" name="file_upload" />

                                <a href="#" class="pull-right"><!-- <i class="fa fa-trash"></i> Delete all images --></a>

                             

                            </div>
                             <hr>
                           

                                  <!--show photos here-->

                                <div id="showimages">No images found</div>

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

              <!-- view popup window -->

            <div class="modal fade" id="view_task_popup" tabindex="-1" >

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                 <div id="view_task_window">Please select a listing</div>

                  

                  </div>

                </div>

              </div>

              

              <div class="modal fade" id="view_event_popup" tabindex="-1" >

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                 <div id="view_event_window">Please select a listing</div>

                  

                  </div>

                </div>

              </div>

              

              <div class="modal fade" id="view_deal_popup" tabindex="-1" >

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                 <div id="view_deal_window">Please select a listing</div>

                  

                  </div>

                </div>

              </div>

              

              
              <!-- end view -->
       

            <!-- popups ends here -->



<script type="text/javascript" src="<?php echo site_url();?>js_module/common.js?ts=11234"></script> 

<script type="text/javascript" src="<?php echo site_url();?>js_module/sales-rentals.js?ts=11234"></script>

<script src="<?php echo site_url();?>uploadifive/jquery.uploadifive.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo site_url();?>js_module/ajaxfileupload.js?r=2.1.6"></script>

<script type="text/javascript" src="<?php echo site_url();?>js_module/upload_api.js?ts=1258"></script>

 <!-- dev work start from here 18-02-2016 -->

    <!-- High Charts -->

    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script src="https://code.highcharts.com/highcharts-more.js"></script>

    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

    <script src="<?php echo base_url();?>js_module/quality-score.js"></script>

    <!-- dev work end from here 18-02-2016 -->

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

                            $.post("<?php echo base_url();?>listings/delete_savedsearch/", { 

                                id:   id

                            },

                            function(data) {

                         

                                $('#search_entry_'+id).remove();

                            });

                        }

                    });

					

});		

 $(document).ready(function(){

                    var this_screen_listing_id='<?php echo $copy_sales_id;?>';

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

		 var lookup   = true;

          var validate     = true;

            // bind 'myForm' and provide a simple callback function 

			 $('#myForm').ajaxForm({

				

				 beforeSubmit : function() {

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

                                            alert('The listing could not be saved, Please ensure all required values are set ('+unset_fields+'). If this is incorrect, email at support@gistler.com');

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

                                                                       // var documents = $.parseJSON('['+json.documents+']');

                                                                        //console.log(documents);

                                                                       $.each(json.documents, function(key, id) {

                                                                        	if(id){

                                            									//$("#showDocuments").append('<div id="doc_div_'+id.document_name+'"><div class="document-list-item" ><div class="inline-block" >'+id.document_name+'</div><div  class="inline-block pull-right"></div><div class="inline-block pull-right"><a href="'+id.document_link+'" target="_blank" class="item-preview" title="View"><i class="icon-eye"></i></a> <a id='+id.document_link+' name='+id.document_name+' class="delete_list item-delete" href="# S" title="Delete"><i class="icon-trash"></i></a></div></div></div>');

																					var ran = $('rand_key').val();

$("#showDocuments").append('<div id="doc_div_'+id.document_name+'">'+id.document_name+'</div><a href="'+id.document_link+'" target="_blank" class="item-preview" title="View"><i class="icon-eye"></i></a> <a id='+id.document_link+' name='+id.document_name+' class="delete_list item-delete" href="# S" title="Delete"><i class="icon-trash"></i></a>');



$("#showDocuments").append('<div id="doc_div_'+id.document_name+'"><div style="border-bottom:#999 dashed 1px; padding: 0px 0px 5px 0px; margin: 5px 5px 0px 5px;" ><div style="display:inline-block;" id="shafi_'+id.document_name+'" >'+id.document_name+'</div><div  style="display:inline-block; float:right;"></div><div  style="display:inline-block; float:right;"><a href="'+id.document_link+'" target="_blank">Download</a> | <a id='+id.document_link+' name='+id.document_link+' class="delete_list" href="# S"> Delete </a></div></div></div>');

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

                                                                       // setTimeout($('#area_location_id').trigger('change'), 200);

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

                                                                       new QualityScore().renderSolidGauge(json);

                                                                    }

                                                                    else {

                                                                       $("#top_score_wrap").hide();

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

					//check for id and rand key

					

					if ($('input#rand_key').val()<1 || $('input#rand_key').val()=='' || $('input#id').val()<1 || $('input#id').val() == '') { 

					 alert('Please save listing first then add document!');

					 return false;

					}

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

                            url:'<?php echo base_url();?>listings/uploadDocuments/',

                            secureuri:false,

                            fileElementId:'listings_documents',

                            dataType: 'text',

                            data:{title: $('#document_name').val(), rand_key: $('#rand_key').val(),listing_id:$('#id').val()},

                            success: function (data)

                            {

								

                               // if(typeof(data.error) != 'undefined')

//                                {

//                                    if(data.error != '')

//                                    {

//                                        alert(data.error);

//                                    }else

//                                    {

//                                        if($('#documents').val()){

//                                

//                                            $('#documents').val($('#documents').val()+','+data.msg);

//                                

//                                

//                                        }else{

//                                            $('#documents').val(data.msg);

//                                

//                                            $('#showDocuments').html('');

//                                        }

                                       // var documents = $.parseJSON('['+data.msg+']');

                                      //  $.each(documents, function(key, id) {

                                           // $("#showDocuments").append('<div id="doc_div_'+id.document_name+'"><div class="document-list-item" ><div class="inline-block" >'+id.document_name+'</div><div  class="inline-block pull-right"></div><div class="inline-block pull-right"><a href="'+id.document_link+'" target="_blank" class="item-preview" title="View"><i class="icon-eye"></i></a> <a id='+id.document_link+' name='+id.document_name+' class="delete_list item-delete" href="# S" title="Delete"><i class="icon-trash"></i></a></div></div></div>');

											$("#showDocuments").append('<div id="doc_div_'+data+'"><div style="border-bottom:#999 dashed 1px; padding: 0px 0px 5px 0px; margin: 5px 5px 0px 5px;" ><div style="display:inline-block;" id="shafi_'+data+'" >'+$('#document_name').val()+'</div><div  style="display:inline-block; float:right;"></div><div  style="display:inline-block; float:right;"><a href="<?php echo base_url();?>uploads/documents/listings/<?php echo $this->session->userdata('client_id')."/".$this->session->userdata('userid');?>/'+data+'" target="_blank">Download</a> | <a id='+data+' name='+data+' class="delete_list" href="# S"> Delete </a></div></div></div>');

                                      //  });

                            

                                        $('#document_name, #listings_documents').val('');

                                        $("#download_animation").css('display', 'none');

                                        //alert(data.msg);

                                    //}

                               // }

                            },

                            error: function (data, status, e)

                            {

								//alert("shafiq");

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

                        url:'<?php echo base_url();?>listings/uploadPDF/',

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

                        url:'<?php echo base_url();?>listings/uploadVideo/',

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

										//$('#preview_video_div span').html('<embed style="width:500px; height: 300px;" src="<?php echo base_url();?>application/views/videos/'+id.video_link+'" type="video/mp4">');



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

                       

                       $.post("<?php echo base_url();?>listings/deleteVideo/", { 

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

                       

                       $.post("<?php echo base_url();?>listings/deletePDF/", { 

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

        

                        $.get("<?php echo base_url();?>listings/deletedocument/"+clean_up_link(id) , function(data){

                    

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