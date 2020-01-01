<script type="text/javascript">
var listing_ids= '';
	function selectListings() {
		if(screenname=='deals'){
			listing_ids = $('#listings_id').val(); 
		}
		else {
			listing_ids = $('#enquired_for_ref').val(); 
		}
		
		$('#linklistings_row #reset_filter').css('display', '');
		var oTable = $('#linklistings_row').dataTable();
        oTable.fnDraw();
	}
/* Datatable initilization */
$(document).ready(function() {
     $(".data img, img").click(function() {
                   
	  $('.data').slideUp(100);
		
	});
        
	
	var oTable = $('#linklistings_row').dataTable( {
					"bProcessing": true,
					"sDom": 'R<>rt<ip><"clear">',
					//"sDom": "Rlfrtip",
					"bAutoWidth" : false,
					"aoColumnDefs": [ 
						{
							 'render': function (data, type, full, meta){
		//return '<div style="text-align:center;"><input style="align:center;" type="radio" name="select_listings" id="check_box_listings" value="'+ oObj.aData['id'] +'"> </div>';
		 return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
							},
							"aTargets": [ 0 ]
						},
						{ "bSortable": false, "aTargets": [ 0 ] },
                                                { "bVisible" : false, "aTargets": [ 16,32,12,17,22,37,20,26,38,3,29,23,19,28,25,30,2,35,21,34,39,24,27,4,31,18,33,6,36,42 ] }
					],
                                        
                                         "aoColumns": [
                                        { "mDataProp": "id" },
                                        { "mDataProp": "type" },
                                        { "mDataProp": "managed" },
                                        { "mDataProp": "exclusive" },
                                        { "mDataProp": "shared" },
                                        { "mDataProp": "ref" },
                                        { "mDataProp": "unit" },
                                        { "mDataProp": "category_id" },
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
                                        
                                         ],
                                         
					"aaSorting" : [[ 41, 'desc' ]],
					"iDisplayLength": 10,
					"bServerSide": true,
					"sAjaxSource": config.siteUrl+"common/datatable_linktolistings",
					"iDisplayStart": 0,
					"sPaginationType": "full_numbers",
					"rowCallback": function( row, data ) {

						 $(row).attr("id",data.id);
						 if ( data.type == 1 )

						      {

							  $('td:eq(1)', row).html( 'Rentals' );

							  }else{
							  	 $('td:eq(1)', row).html( 'Sales' );
							  }
						},
					"fnServerData": function ( sSource, aoData, fnCallback ) {
					
					
                                        
                                        
                                                        $.ajax( {
                                                            "dataType": 'json', 
                                                            "type": "POST", 
                                                            "url": sSource, 
                                                            "data": aoData, 
                                                            "success": function(json) {
                                                                fnCallback(json);
                                                                if($('#enquired_for_ref').val()!='' && listing_ids!=''){
                                                                $('#linklistings_row input:checkbox').each(function() {
																this.checked = true;        
																	$("#myFormSearch")[ 0 ].reset();
                                                                listing_ids = '';
                                                                oTable.fnDraw(false);
                                                                oTable.fnFilterClear(true);
                                                                $('#reset_filter').css('display', 'none');                
                                                                                                });


                                                                $('#linklistings_row #reset_filter').css('display','');
                                                             }
                                                                //$('#listings_row #'+last_id+' td').addClass('yellowCSS');
                                                            }
                                                        } );
				}

	} );
        
        /* hide the search columns */
        $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(16+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(42+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(32+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(12+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(17+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(22+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(37+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(20+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(26+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(38+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(03+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(29+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(23+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(19+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(28+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(25+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(30+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(02+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(35+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(21+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(34+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(39+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(24+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(27+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(04+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(31+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(18+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(33+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(06+2)+")").css('display', 'none');
                            $('#linklistings_row #searchbox_popup tr').find("td:nth-child("+(36+2)+")").css('display', 'none');
                     
                        /* hide the search columns end */
	
	//new FixedHeader( oTable );

        /* start min and max functions*/
	$('#searchbox_popup #minprice').keyup( function() { oTable.fnDraw(); $('#11 img').attr("src", "https://crm.propspace.com/application/views/images/green-arrow.png"); $('#searchbox_popup #reset_filter').css('display', ''); } );
	$('#searchbox_popup #maxprice').keyup( function() { oTable.fnDraw(); $('#11 img').attr("src", "https://crm.propspace.com/application/views/images/green-arrow.png"); $('#searchbox_popup #reset_filter')
.css('display', ''); } );
	/* end min and max functions*/
        
        /* Start Date search */
        $(function(){           
            $('#searchbox_popup #dateaddedS_listing, #searchbox_popup #dateaddedSto_listing, #searchbox_popup #dateupdatedS_listing, #searchbox_popup #dateupdatedSto_listing').datepicker({
                dateFormat: 'dd-mm-yy',
                showButtonPanel: true,
                onClose: function(dateText, inst) { oTable.fnDraw(false); $('#linklistings_row #searchbox_popup #reset_filter').css('display', ''); }
            });
        });

        /* End Date search */
	/* End Date search */
	
	$("#linklistings_row #searchbox_popup input").keyup( function () {
		/* Filter on the column (the index) of this element */
           
		oTable.fnFilter( this.value, $(this).attr('id') );
		$('#linklistings_row #searchbox_popup #reset_filter').css('display', '');
		
	} );
	
	$("#linklistings_row #searchbox_popup select").change( function () {
		/* Filter on the column (the index) of this element */
		oTable.fnFilter( this.value, $(this).attr('id') );
		$('#linklistings_row #searchbox_popup #reset_filter').css('display', '');
		
	} );
	
	
	//reset filter and drawtable
	$("#linklistings_row #reset_filter").click(function () {
			$("#linklistings_row #myFormSearch")[ 0 ].reset();
                         $("#searchbox_popup #minarea, #searchbox_popup #maxarea, #searchbox_popup #minprice, #searchbox_popup #maxprice").val('');
                         $("#searchbox_popup #dateaddedS_listing, #searchbox_popup #dateaddedSto_listing, #searchbox_popup #dateupdatedS_listing, #searchbox_popup #dateupdatedSto_listing").val('');
			listing_ids = '';
			//oTable.fnDraw(false);
                        oTable.fnFilterClear(true);
			$('#linklistings_row #reset_filter').css('display', 'none');
			
	});


//change css of selected row	
	$(document.body).on("click", "#linklistings_row tbody tr", function(event){
	if(formDataChange==false){
	  $("td.yellowCSS", oTable.fnGetNodes()).removeClass("yellowCSS");
	  $(event.target).parent().find("td").addClass("yellowCSS");
	}
	});
	
});


      $(function(){
		 
        $('#linklistings_row').change(function(){
		
				if(screenname=='leads'){
					var value	= [];
					var count 	= 0;
					var all_ref = '';
					
					$('#linklistings_row input:checked').each(function() {
						this_value = $(this).attr('value');
						value	   +=this_value+',';
						
						$("#enquired_for_ref").val(value.substring(0,value.lastIndexOf(",")));
						count++;
						$.getJSON(config.siteUrl+"listings/getSingleRow/"+this_value+'/listings/', function(json){ 

								if($('#property_req_'+listing_popup_id).val()!=''){
									getReq = jQuery.parseJSON('['+$('#property_req_'+listing_popup_id).val()+']');
									$.each(getReq, function(id, key) {
										$('#lead_req_id').val(this.lead_req_id);
									});
								}
								
								$('#listing_id_'+listing_popup_id).val(json.id);
								$('#listing_id_'+listing_popup_id+'_ref').val(json.ref);
								
								$('#category_id').val(json.category_id);
								$('#region_id').val(json.region_id);
								
								if(json.area_location_id!=0){
									$('#region_id').trigger('change');
									$('#area_location_id').val(json.area_location_id);
								}
								if(json.sub_area_location_id!=0){
									$('#area_location_id').trigger('change');
									$('#sub_area_location_id').val(json.sub_area_location_id);
								}
							
								//$('#area_location_id').val(json.area_location_id);
								//$('#sub_area_location_id').val(json.sub_area_location_id);
								$('#min_beds').val(json.beds);
								$('#max_beds').val('0');
								$('#min_budget').val(json.price);
								$('#max_budget').val('0');
								$('#min_area').val(json.area);
								$('#max_area').val('0');
								$('#unit_type').val(json.unit_type);
                                // $('#unit_no').val(json.unit);
								
								plot_requirements_info(listing_popup_id);
								json_prop_requirments(listing_popup_id)
								
						});
						
					});
				}
				
				else if(screenname=='deals'){
					hol	=	$('#linklistings_row input:checked').val();
						
						$.getJSON(config.siteUrl+"listings/getSingleRow/"+hol+'/listings/', function(json){ 
							
							$("#listings_id").val(json.id);
							$("#listings_ref").val(json.ref);
							$("#listings_type").val(json.category_name);
							if(json.beds==0.5){
								$("#listings_beds").val('Studio');
							}else{
								$("#listings_beds").val(json.beds);
							}
							$("#listings_unit").val(json.unit);
							$("#listings_unit_type").val(json.unit_type);
							$("#listings_street_no").val(json.street_no);
							$("#listings_floor_no").val(json.floor_no);
							$("#listings_category_id").val(json.category_id);
							$("#region_id").val(json.region_id);
							if(json.area_location_id!=0){
									//$('#region_id').trigger('change');
									setTimeout(function() {
        									$('#region_id').trigger('change');
    										}, 500);
									$('select[name=area_location_id]').val(json.area_location_id);
									$('.selectpicker').selectpicker('refresh');
									
								}
								if(json.sub_area_location_id!=0){
								
									setTimeout(function() {
        									$('#area_location_id').trigger('change');
    										}, 2000);
									$('select[name=sub_area_location_id]').val(json.sub_area_location_id);
								
									 $('.selectpicker').selectpicker('refresh');
								}
							$("#type").val(json.type);
							$("#landlord_seller_name").val(json.landlord_name);
                            $("#landlord_seller_id").val(json.landlord_id);
                            if(($("#landlord_seller_id_list").length > 0)  && (typeof  json.landlord_id_list!= "undefined") ) {
                                $("#landlord_seller_id_list").val(json.landlord_id_list);
                            }
							$('#listings_randkey').val(json.rand_key);
							 
							
						}); 
				}	
				else{

						hol	=	$('#linklistings_row input:checked').val();
						$.getJSON(config.siteUrl+"listings/single/"+hol+'/listings/', function(json){ 
							
							$("#listings_id").val(json.id);
							$("#listings_ref").val(json.ref);
							$("#listings_type").val(json.category_name);
							if(json.beds==0.5){
								$("#listings_beds").val('Studio');
							}else{
								$("#listings_beds").val(json.beds);
							}
							$("#listings_location").val(json.area_location_name);
							$("#landlord_name, #listings_landlord").val(json.landlord_name);
							$("#landlord_id").val(json.landlord_id);
							$("#listings_sub_location").val(json.sub_area_location_name);
							
						 
						}); 
			}
    
      }); 
	 }); 

</script>
<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select Listing</h4>
                     <div class="popup_description">
     		Use this table to search and select the appropriate listing.
     </div>
                  </div>
                      
                  <div class="modal-body">
                  <div class="row">
                    <!-- data table come here -->
                      <table class="table table-striped table-bordered table-hover" id="linklistings_row">

          <thead align="left" class="listing_headings">
                <tr>
                    <th  align="center"></th>
            <th style="width:5px !important;"><div style="cursor:pointer;" title="Click here to sort"
>Type</div></th>
            <th style="width:5px !important;"><div style="cursor:pointer; display:none;" title="Click
 here to sort">Managed</div></th>
            <th style="width:5px !important;"><div style="cursor:pointer; display:none;" title="Click
 here to sort">Exclusive</div></th>
            <th style="width:5px !important;"><div style="cursor:pointer; display:none;" title="Click
 here to sort">Shared</div></th>
            <th width="50"><div style="cursor:pointer;min-width: 55px;" title="Click here to sort">Ref
</div></th>
            <th><div style="cursor:pointer;" title="Click here to sort">Unit</div></th>
            <th><div style="cursor:pointer;" title="Click here to sort">Category</div></th>
            <th><div style="cursor:pointer;" title="Click here to sort">Emirate</div></th>
            <th><div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">Location
</div></th>
            <th><div style="cursor:pointer; white-space:nowrap;" title="Click here to sort">Sub-Location
</div></th>
            <th><div style="cursor:pointer;" title="Click here to sort">Beds</div></th>
            <th><div style="cursor:pointer;" title="Click here to sort">BUA</div></th>
            <th><div style="cursor:pointer;" title="Click here to sort">Price</div></th>
            <th><div style="cursor:pointer;" title="Click here to sort">Agent</div></th>
            <th><div style="cursor:pointer;" title="Click here to sort">Owner</div></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Type</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Baths</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Street</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Floor</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">DEWA</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Photos</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Cheques</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Fitted</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Property Status
</div></th>
            <th type="not_default" style="min-width:90px !important;"><div style="cursor:pointer;" title
="Click here to sort">Listing Source</div></th>
            <th type="not_default" style="min-width:90px !important;"><div style="cursor:pointer;" title
="Click here to sort">Date Available</div></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Remind</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Furnished
</div></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Featured<
/div></th>
            <th type="not_default" style="min-width:100px !important;"><div style="cursor:pointer;" title
="Click here to sort">Maintanance Fee</div></th>
            <th type="not_default" style="min-width:70px !important;"><div style="cursor:pointer;" title
="Click here to sort">Street No</div></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Amount</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Tenanted<
/div></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Plot Size
</div></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Name</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">View</div
></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Commission
</div></th>
            <th type="not_default"><div style="cursor:pointer;" title="Click here to sort">Deposit</div
></th>
            <th type="not_default"><div style="cursor:pointer; width:50px;" title="Click here to sort"
>Price / sq ft</div></th>
            <th width="40"><div style="cursor:pointer; width:40px;" title="Click here to sort">Listed
</div></th>
            <th width="35"><div style="cursor:pointer; min-width:40px;" title="Click here to sort">Updated
</div></th>
            <th width="5" style="width:5px !important;"><div style="cursor:pointer;" title="Click here
 to sort"></div></th>
            </tr>
            </thead>
          <thead id="searchbox_popup">
                <tr  class="search_box">
            <form id="myFormSearch">
                <td style="text-align:center;"><a id="reset_filter" style="display:none;" href="# Reset">
                <img src="<?php echo base_url();?>mydata/images/swap.png?ts=10" title="Reset filter"></td>
                <td><select name="1" type="text" class="search_init" id="1">
                        <option value="" selected>Select</option>
                        <option value="1">Rentals</option>
                        <option value="2">Sales</option>
                    </select></td>
                <td><a id="2" class='click'><img src="<?php echo base_url();?>mydata/images/arrow.png?ts=10"></a>
                    <div class='data' id="data2" style="padding:0px 8px 0px 5px; margin:-29px -5px -5px
 -4px; background-color:#CCC;"> <span id_search='2' value="0" image="<?php echo base_url();?>mydata/images/mx.png" class='sorting'>
 <img src="<?php echo base_url();?>mydata/images/mx.png" title="Non Managed"></span><br>
                        <span id_search='2' value="1" image="<?php echo base_url();?>mydata/images/m.png?ts=10" class='sorting'>
                        <img src="<?php echo base_url();?>mydata/images/m.png"
 title="Managed"></span> </div></td>
                <td><a id="3" class='click'><img src="<?php echo base_url();?>mydata/images
/arrow.png?ts=10"></a>
                    <div class='data' id="data3" style="padding:0px 8px 0px 5px; margin:-29px -5px -5px
 -4px; background-color:#CCC;"> <span id_search='3' value="0" image="<?php echo base_url();?>mydata/images/ex.png" class='sorting'><img src="https://crm.propspace.com/application/views/images/ex
.png" title="Non Exclusive"></span><br>
                        <span id_search='3' value="1" image="https://crm.propspace.com/application/views
/images/e.png?ts=10" class='sorting'><img src="https://crm.propspace.com/application/views/images/e.png"
 title="Exclusive"></span> </div></td>
                <td><a id="4" class='click'><img src="https://crm.propspace.com/application/views/images
/arrow.png?ts=10"></a>
                    <div class='data' id="data4" style="padding:0px 8px 0px 5px; margin:-29px -5px -5px
 -4px; background-color:#CCC;"> <span id_search='4' value="0" image="<?php echo base_url();?>mydata/images/ssx.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/ssx
.png" title="Not Shared"></span><br>
                        <span id_search='4' value="1" image="<?php echo base_url();?>mydata/images/ss.png?ts=10" class='sorting'>
                        <img src="<?php echo base_url();?>mydata/images/ss
.png" title="Shared"></span> </div></td>
                <td><input id='5' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='6' type="text" class="search_init" style="height:16px;"/></td>
                <td><select id='7' class="search_init" style="width:100px;">
                        <option value="" selected>Select</option>
                            <option value="1">
    Apartment                            </option>
                            <option value="2">
    Villa                            </option>
                            <option value="3">
    Office                            </option>
                            <option value="4">
    Retail                            </option>
                            <option value="5">
    Hotel Apartment                            </option>
                            <option value="6">
    Warehouse                            </option>
                            <option value="7">
    Land Commercial                            </option>
                            <option value="8">
    Labour Camp                            </option>
                            <option value="9">
    Residential Building                            </option>
                            <option value="10">
    Multiple Sale Units                            </option>
                            <option value="11">
    Land Residential                            </option>
                            <option value="12">
    Commercial Full Building                            </option>
                            <option value="13">
    Penthouse                            </option>
                            <option value="14">
    Duplex                            </option>
                            <option value="15">
    Loft Apartment                            </option>
                            <option value="16">
    Townhouse                            </option>
                            <option value="17">
    Hotel                            </option>
                            <option value="18">
    Land Mixed Use                            </option>
                            <option value="21">
    Compound                            </option>
                            <option value="24">
    Half Floor                            </option>
                            <option value="27">
    Full Floor                            </option>
                            <option value="30">
    Commercial Villa                            </option>
                            <option value="48">
    Bungalow                            </option>
                            <option value="50">
    Factory                            </option>
                    </select></td>
                <td><select name="8" class="search_init" id='8' style="width:100px;">
                        <option value="" selected>Select</option>
                            <option value="2">
    Abu Dhabi                            </option>
                            <option value="4">
    Ajman                            </option>
                            <option value="8">
    Al Ain                            </option>
                            <option value="1">
    Dubai                            </option>
                            <option value="7">
    Fujairah                            </option>
                            <option value="6">
    Ras Al Khaimah                            </option>
                            <option value="3">
    Sharjah                            </option>
                            <option value="5">
    Umm Al Quwain                            </option>
                    </select></td>
                <td><input id='9' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='10' type="text" class="search_init" style="height:16px;"/></td>
                <td><select id="11" class="search_init" name="beds" type="text">
                        <option value="" selected>Select</option>
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
                        <option value="11">11 beds</option>
                        <option value="12">12 beds</option>
                    </select></td>
                <td>
                    </td>
                <td>
                    
                    
                
                </td>
                <td></td>
                <td><input id='15' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='16' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='17' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='18' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='19' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='20' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='21' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='22' type="text" class="search_init" style="height:16px;"/></td>
                <td><select name="23" type="text" class="search_init" id="23">
                        <option value="" selected>Select</option>
                        <option value="1">Semi-Fitted</option>
                        <option value="2">Fitted Space</option>
                        <option value="3">Shell and core</option>
                    </select></td>
                <td><select name="24" type="text" class="search_init" id="24">
                        <option value="" selected>Select</option>
                        <option value="1">Available</option>
                        <option value="2">Pending</option>
                        <option value="3">Sold/Rented</option>
                        <option value="4">Upcoming</option>
                        <option value="5">Reserved</option>
                    </select></td>
                <td><select name="25" type="text" class="search_init" id="25">
                        <option value="" selected>Select</option>
                    </select></td>
                <td><input id='available_dateS' type="text" class="search_init" style="height:16px;"
/></td>
                <td><select name="27" type="text" class="search_init" id="27">
                        <option value="" selected>Select</option>
                        <option value="1">1 day</option>
                        <option value="7">1 week</option>
                        <option value="14">2 weeks</option>
                        <option value="30">1 month</option>
                        <option value="60">2 months</option>
                    </select></td>
                <td><select name="28" type="text" class="search_init" id="28">
                        <option value="" selected>Select</option>
                        <option value="1">Furnished</option>
                        <option value="2">Unfurnished</option>
                    </select></td>
                <td><select name="29" type="text" class="search_init" id="29">
                        <option value="" selected>Select</option>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select></td>
                <td><input id='30' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='31' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='32' type="text" class="search_init" style="height:16px;"/></td>
                <td><select name="33" type="text" class="search_init" id="33">
                        <option value="" selected>Select</option>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select></td>
                <td><input id='34' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='35' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='36' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='37' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='38' type="text" class="search_init" style="height:16px;"/></td>
                <td><input id='39' type="text" class="search_init" style="height:16px;"/></td>
                <td>

                    </td>
                <td>
                   
                </td>
                <td></td>
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
                 <!-- <div class="modal-footer">
                    <button class="btn btn-success" id="btn-close-listingsearch" data-dismiss="modal">Save</button>
                  </div>-->