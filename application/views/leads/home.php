<script type="text/javascript">



/* Datatable initilization */

$(document).ready(function() {

	/* generate column list start*/

	var column_count = 0;

	var column_names = [];

	$.each($('#listings_row thead th'), function() {

        column_names.push($(this).clone().children().remove('span').end().text()+'|'+column_count+'|'+$(this).attr('type'))

        column_count++;

	}

	);

	column_names.sort();

	var column_count = 0;

	var editable_columns = 0;

	for (column_count = 0; column_count < column_names.length; ++column_count) {

		var single_column = column_names[column_count];

		single_column = single_column.split('|')

		            var column_name = single_column[0];

		var column_id = single_column[1];

		var column_type = single_column[2];

		var read_only_columns = new Array('1', '2', '3', '4', '13', '25', '33');

		//if(column_id == 33)alert(column_name);

		if (column_id != 0 && column_id != 37 && column_id !=1 ) {

			if ($.inArray(column_id, read_only_columns) > -1) {

			//	$('#columns_list').append("<div class='column-selection-holder'><input type='checkbox'" + ' disabled="disabled" ' + "default='" + column_type + "' checked name='column_" + column_id + "' id='column_" + column_id + "' col='" + column_id + "' value='1' tabindex='33' checked><span>" + column_name + "</span></div>");

			 $('#columns_list').append("<div class='col-md-4'><div class='form-group form_group_checkbox'><input type='checkbox'" +  ' disabled="disabled" '   + "default='"+column_type +"' checked name='column_"+column_id+"' id='column_"+column_id+"' col='"+column_id+"' value='1' tabindex='33' checked><span class='lbl padding'>"+column_name+"</span></div></div>");

			} else {

				//$('#columns_list').append("<div class='column-selection-holder'><input type='checkbox' default='" + column_type + "' checked name='column_" + column_id + "' id='column_" + column_id + "' col='" + column_id + "' value='1' tabindex='33'><span>" + column_name + "</span></div>");

				 $('#columns_list').append("<div class='col-md-4'><div class='form-group form_group_checkbox'><input type='checkbox' default='"+column_type  +"' checked name='column_"+column_id+"' id='column_"+column_id+"' col='"+column_id+"' value='1' tabindex='33'><span class='lbl padding'>"+column_name+"</span></div></div>");

			}

			editable_columns++;

		}

	}

	$('#total_editable_columns').html(editable_columns);

	/* generate column list end */

	/* Notification IDs */

	var notification_id = '';

	notification_id = '';

	//$("#showRequirements").load("<?php echo base_url();?>leads/requirements/0") // this line updates the div for features

	$("#LinkToListings").load("<?php echo base_url();?>common/linktolistings") // this line updates the div for features

	var value = '';

	oTable = $('#listings_row').dataTable( {

		"bProcessing": true,

		            "sDom": 'R<>rt<ilp><"clear">',

		            "aoColumnDefs": [ {

                       'render': function (data, type, full, meta){

                        //check the main check box

                        $('#check_all_checkboxes').attr('checked', false);

                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';

                    },

                    "aTargets": [ 0 ]

                }

		, {

			"bSortable": false, "aTargets": [0]

		}

		, {

			"bVisible": false, "aTargets": [26,27,28,29,30,31,23,22,18,20,21,17,19,16,15,]

		}

		,

		/*{ 

                 "bVisible": false, "aTargets": [ 13 ] 

                 }*/

		],

			"columns": [

			{ "data": "id" },

            { "data": "auto" },

			{ "data": "ref" },

			{ "data": "type" },

			{ "data": "status" },

			{ "data": "sub_status" },

            { "data": "lead_priority" },

            { "data": "hot_lead" },

            { "data": "landlord_name" },

            { "data": "last_name" },

            { "data": "landlord_mobile" },

			{ "data": "category_id" },

			{ "data": "region_id" },

			{ "data": "area_location_id" },

			{ "data": "sub_area_location_id" },

            { "data": "unit_type" },

            { "data": "unit_no" },

            { "data": "min_beds" },

            { "data": "max_beds" },

            { "data": "min_budget" },

			{ "data": "max_budget" },

			{ "data": "min_area" },

			{ "data": "max_area" },

			{ "data": "listing_id_1_ref" },

            { "data": "source_of_lead" },

            { "data": "agent_id" },

            { "data": "agent_id_2" },

			{ "data": "agent_id_3" },

			{ "data": "agent_id_4" },

            { "data": "agent_id_5" },

            { "data": "created_by" },

			{ "data": "financial_situation" },

			{ "data": "date_of_enquiry" },

            { "data": "dateupdated" },

            { "data": "lead_by_agent" },

            { "data": "shared" },

			{"data" : "subsource_of_lead"}

			

			

                     

                        

            ],

		            "aaSorting": [[32, 'desc']],

		            "bServerSide": true,

		            "bRegex": true,

		            "sAjaxSource": config.siteUrl+"leads/datatable",

		            "iDisplayStart": 0,

		            "sPaginationType": "full_numbers",

					'fnServerData': function (url, data, callback){ 

				 /* Add some extra data to the sender */

				data.dateupdatedSto = $('#listings_row #dateupdatedSto').val();

				data.dateupdatedSfrom = $('#listings_row #dateupdatedSfrom').val();

				data.dateenquirySto = $('#listings_row #dateenquirySto').val();

				data.dateenquirySfrom = $('#listings_row #dateenquirySfrom').val();

				data.landlord_id = $('#listings_row #landlord_id').val();

				data.listings_id = '';

				data.deals_id = '';

				data.contracts_id = '';

				data.type = '<?php echo $listing_type;?>';

				

				

				       $.each($('#as_search_form input, #as_search_form select'), function() {

                                                            var as_field_name = this.id;

                                                            var as_field_value = $('#'+as_field_name).val();

                                                            if(as_field_value!=''){

                                                               // aoData.push( { "name": as_field_name, "value": as_field_value } );

															   data.as_field_name = as_field_value;

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

				

				

				},

				"rowCallback": function( row, data ) {

				 $(row).attr("id",data.id);

				 <!--type start here-->

					   if ( data.status == 1)

						  {

						   $('td:eq(3)', row).html( 'Tenant' );

						  }

					    if ( data.status == 2 )

						  {

						  $('td:eq(3)', row).html( 'Buyer' );

						  }

						   if ( data.status == 3 )

						  {

						  $('td:eq(3)', row).html( 'Landlord' );

						  }

						   if ( data.status == 4 )

						  {

						  $('td:eq(3)', row).html( 'Seller' );

						  }

							if ( data.status == 5 )

						  {

						  $('td:eq(3)', row).html( 'Landlord+Seller' );

						  }

						   if ( data.status == 6 )

						  {

						  $('td:eq(3)', row).html( 'Not Specified' );

						  }

						  <!--type ended-->

						  <!--imported-->

						  if ( data.auto == 0 )

						  {

						 	 $('td:eq(1)', row).html( '' );

						  }else

						  {

						 	 $('td:eq(1)', row).html( '<img title="auto Imported" id="imgunpub" src="<?php echo base_url();?>mydata/images/header_auto.png">' );

						  }

						  //start of status

						  if ( data.status == 1 )

						  {

						  $('td:eq(4)', row).html( 'Open' );

						  }

						  if (data.status == 2 )

						  {

						  $('td:eq(4)', row).html( 'Closed' );

						  }

						   if ( data.status == 3 )

						  {

						  $('td:eq(4)', row).html( 'Not Specified' );

						  }

						  //end of status

						  //start of sub status

						 if ( data.sub_status == 1 )

						  {

						  $('td:eq(5)', row).html( 'In progress' );

						  }

						  if ( data.sub_status ==2 )

						  {

						  $('td:eq(5)', row).html( 'Successful' );

						  }

						   if ( data.sub_status ==3 )

						  {

						  $('td:eq(5)', row).html( 'Unsuccessful' );

						  }

							 if ( data.sub_status == 4 )

						  {

						  $('td:eq(5)', row).html( 'Not yet contacted' );

						  }

						   if ( data.sub_status == 5 )

						  {

						  $('td:eq(5)', row).html( 'Called no reply' );

						  }

						   if ( data.sub_status == 6 )

						  {

						  $('td:eq(5)', row).html( 'Follow up' );

						  }

						   if ( data.sub_status == 7 )

						  {

						  $('td:eq(5)', row).html( 'Viewing arranged' );

						  }

							if (data.sub_status == 8 )

						  {

						  $('td:eq(5)', row).html( 'Not Specified' );

						  }

						   

						//end of sub status

						//hot lead

						if ( data.hot_lead == 0 )

						  {

						 	 $('td:eq(7)', row).html( '<img title="auto Imported" id="imgunpub" src="<?php echo base_url();?>mydata/images/hotleadx.png">' );

						  }else

						  {

						 	 $('td:eq(7)', row).html( '<img title="auto Imported" id="imgunpub" src="<?php echo base_url();?>mydata/images/hotlead.png">' );

						  }

						  //end hot

					return row;  

				}

		            

	}

	);

	$('.datatable-setbotclass').next().addClass('fixedpagination-bottom');

	/* Code to hide/show columns START */

	/* hide the search columns */

			            $('#searchbox1 tr').find("td:nth-child(" + (26 + 2) + ")").css('display', 'none');

		$('#column_26').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (27 + 2) + ")").css('display', 'none');

		$('#column_27').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (28 + 2) + ")").css('display', 'none');

		$('#column_28').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (29 + 2) + ")").css('display', 'none');

		$('#column_29').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (30 + 2) + ")").css('display', 'none');

		$('#column_30').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (31 + 2) + ")").css('display', 'none');

		$('#column_31').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (23 + 2) + ")").css('display', 'none');

		$('#column_23').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (22 + 2) + ")").css('display', 'none');

		$('#column_22').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (18 + 2) + ")").css('display', 'none');

		$('#column_18').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (20 + 2) + ")").css('display', 'none');

		$('#column_20').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (21 + 2) + ")").css('display', 'none');

		$('#column_21').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (17 + 2) + ")").css('display', 'none');

		$('#column_17').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (19 + 2) + ")").css('display', 'none');

		$('#column_19').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (16 + 2) + ")").css('display', 'none');

		$('#column_16').attr('checked', false);

				            $('#searchbox1 tr').find("td:nth-child(" + (15 + 2) + ")").css('display', 'none');

		$('#column_15').attr('checked', false);

			        setDatatableWidth();

	/* hide the search columns end */

	function setDatatableWidth() {

		var TotalColumnsUnchecked = $('#columns_list input:checked').length;

		if (TotalColumnsUnchecked < 15) {

			$('#listings_row').css('width', '100%');

		}

		if (TotalColumnsUnchecked > 14) {

			$('#listings_row').css('min-width', '100%');

		} else {

			$('#listings_row').css('min-width', '100%');

		}

	}

	$('#total_active_columns').html($('#columns_list input:checked').length)

	        function fnShowHide(iCol) {

		var oTable = $('#listings_row').dataTable();

		var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;

		if (bVis == true) {

			$('#searchbox1 tr').find("td:nth-child(" + ((iCol * 1) + 2) + ")").css('display', 'none');

		} else if (bVis == false) {

			$('#searchbox1 tr').find("td:nth-child(" + ((iCol * 1) + 2) + ")").css('display', '');

		}

		oTable.fnSetColumnVis(iCol, bVis ? false : true);

		setDatatableWidth();

	}

	$('#columns_list input').change(function() {

		fnShowHide($(this).attr('col'))

		            $('#total_active_columns').html($('#columns_list input:checked').length)

	}

	);

	$(document.body).on("click", "#save_columns_settings", function(event) {

		var disabled_columns_array = [];

		$('#columns_list input[type="checkbox"]:unchecked').each(function() {

			disabled_columns_array.push($(this).attr('col'));

		}

		);

		$.post("<?php echo base_url();?>common/save_disabled_columns/", {

			columns: disabled_columns_array,
            screenname: 'leads',

		}

		, function(info) {

			$('a.close').click();

		}

		);

	}

	);

	$(document.body).on("click", "#reset_columns_settings", function(event) {

		$('#columns_list input[type="checkbox"]').each(function() {

			if ($(this).prop('checked') == true && $(this).attr('default') == 'not_default') {

				fnShowHide($(this).attr('col'))

				                    $(this).attr('checked', false)

			} else if ($(this).prop('checked') == false && $(this).attr('default') != 'not_default') {

				fnShowHide($(this).attr('col'))

				                    $(this).attr('checked', 'checked')

			}

			$('#total_active_columns').html($('#columns_list input:checked').length)

		}

		);

		setDatatableWidth();

	}

	);

	/* Code to hide/show columns END */

	/* Start Date search */

	$(function() {

		//$('#dateupdatedS').datepicker( {

//			dateFormat: 'dd-mm-yy',

//			                onClose: function(dateText, inst) {

//				oTable.fnDraw(false);

//				$('#reset_filter1').css('display', '');

//			}

//		}

//		)

	}

	);

	$(function() {

		//$('#dateenquiryS').datepicker( {

//			dateFormat: 'dd-mm-yy H:i',

//			                onClose: function(dateText, inst) {

//				oTable.fnDraw(false);

//				$('#reset_filter1').css('display', '');

//			}

//		}

//		)

	}

	);

	$(function() {

		//$('#dateenquirySfrom, #dateenquirySto, #dateupdatedSfrom, #dateupdatedSto').datepicker( {

//			dateFormat: 'dd-mm-yy',

//			                showButtonPanel: true,

//			                onClose: function(dateText, inst) {

//				oTable.fnDraw(false);

//				$('#reset_filter1').css('display', '');

//			}

//		}

//		)

	}

	);

	/* End Date search */

	$(document.body).on("click", "#listings_row  .sorting", function(event) {

		if($(this).attr('value') != 'undefined' && $(this).attr('id_search') != undefined){

			oTable.fnFilter( $(this).attr('value'), $(this).attr('id_search') );

			$('#'+$(this).attr('id_search')+' img').attr('src', $(this).attr('image'));

			$('#listings_row #1').val($(this).attr('value'));

			$('#listings_row #reset_filter1').css('display', '');

		}

	});

	

	$("#searchbox1 input").focus(function() {

		if (this.id==2 || this.id==8 || this.id==9 || this.id==13 || this.id==36 ) {

			//check if it has default value, if so clear so user can input own value

			if (this.value==" Min 3 chars") {

				//alert ('value is min 3 chars, so clearing');

				$( this ).css( "color", "" );

				$( this ).css( "font-family", "" );

				$( this ).css( "font-size", "" );

				this.value="";

			}

		}

	}

	);

	$("#searchbox1 input").focusout(function() {

		// alert ('out of focus of searchbox -id:' + this.id + ' - value:'+this.value);          

		if ((this.id==2 || this.id==8 || this.id==9 || this.id==13 || this.id==36 ) && this.value=='' ) {

			//alert ('changing value');

			this.value=' Min 3 chars';

			$( this ).css( "color", "grey" );

			$( this ).css( "font-family", "arial" );

			$( this ).css( "font-size", "11px" );

		}

	}

	);

	$("#searchbox1 input").keyup(function() {

		/* Filter on the column (the index) of this element */

		if(this.value.length<3 && this.value.length>0 && (this.id==2 || this.id==8 || this.id==9 || this.id==13 || this.id==36)) {

			return false;

		}

		oTable.fnFilter(this.value, $(this).attr('id'));

		$('#reset_filter1').css('display', '');

	}

	);

	$("#searchbox1 select").change(function() {

		/* Filter on the column (the index) of this element */

		//            if(this.id == 4){

		//                

		//                //alert($('#listings_row #5 option:selected').val());

		//                //oTable.fnUpdate('', 5  , 5 );

		//                //aoData.push({"name": "sSearch_5", "value": ''});

		//            }

		oTable.fnFilter(this.value, $(this).attr('id'));

		$('#reset_filter1').css('display', '');

	}

	);

	//advance search

	$(".advance_search, #groups_toggle").change(function() {

		oTable.fnDraw();

		$('#reset_filter1').css('display', '');

	}

	);

	$(".advance_search").keyup(function() {

		oTable.fnDraw();

		$('#reset_filter1').css('display', '');

	}

	);

	$('#as_date_enq_to, #as_date_enq_from').datepicker( {

		dateFormat: 'dd-mm-yy',

		            showButtonPanel: true,

		            onClose: function(dateText, inst) {

			oTable.fnDraw(false);

			$('#reset_filter').css('display', '');

		}

	}

	)

	        //save search

	$(document.body).on("click", '#savesearch', function() {

		var searchtitle = $('#savesearch_name').val();

		if(searchtitle == '') 

		{

			alert("Please give a title to your search!");

		  return false;

		}

		$.post("<?php echo base_url();?>leads/savesearch", {

			                // '1': $('.1').val(),

			                // '2': $('.2').val(),

			                // '3': $('.3').val(),

			                // '4': $('.4').val(),

			                // '5': $('.5').val(),

			                // '6': $('.6').val(),

			                // '7': $('.7').val(),

			                // '8': $('.8').val(),

			                // '9': $('.9').val(),

			                // '10': $('.10').val(),

			                // '11': $('.11').val(),

			                // '12': $('.12').val(),

			                // '13': $('.13').val(),

			                // '14': $('.14').val(),

			                as_category_id: $('#as_category_id').val(),

			                as_beds: $('#as_beds').val(),

			                as_unit: $('#as_unit').val(),

			                as_enquired_for_referance: $('#as_enquired_for_referance').val(),

			                as_min_price: $('#as_min_price').val(),

			                as_max_price: $('#as_max_price').val(),

			                as_min_area: $('#as_min_area').val(),

			                as_max_area: $('#as_max_area').val(),

			                as_date_enq_to: $('#as_date_enq_to').val(),

			                as_date_enq_from: $('#as_date_enq_from').val(),

			                name: $('#savesearch_name').val()

		}

		,

		            function(data) {

               			 $("#search_list").append('<div id="search_entry_'+data+'"><div class="bullet inline-block"><a id="'+data+'" class="savedsearch" href="# Saved Search">'+$('#savesearch_name').val()+'</a></div><div class="inline-block pull-right"><a  id="'+data+'" class="delete_savedsearch redText" href="# Delete Search"><i class="icon-cancel-circled"></i></a></div></div>');

					}

		);

	}

	);

	$(document.body).on("click", '.savedsearch', function() {

		$id = $(this).attr('id');

		$.getJSON("<?php echo base_url();?>listings/savedsearch/" + $id, function(json) {

			$.each(json, function(key, val) {

				$('.' + key).val(val);

				if (!key.match('^(0|[1-9][0-9]*)$')) {

					$('#' + key).val(val);

				}

				//alert(val)

				if (key.match('^(0|[1-9][0-9]*)$')) {

					if(val != ' Min 3 chars'){

                    	oTable.fnFilter(val, key);

                    }

				}

			}

			);

			oTable.fnDraw();

		}

		);

		$('#reset_filter1').css('display', '');

	}

	);

	//reset filter and drawtable

	$("#reset_filter1").click(function() {

		notification_id='';

		uncheckRadio();

		value = '';

		$("#myForm2")[ 0 ].reset();

		$("#as_search_form")[0].reset();

		$("#groups_toggle").val('');

		oTable.fnDraw(false);

		oTable.fnFilterClear(true);

		$("#listings_row .click img").attr("src", "<?php echo base_url();?>mydata/images/arrow.png?ts=10");

		$('#reset_filter1').css('display', 'none');

	}

	);

	$('#listings_row_landlord').change(function() {

		////alert(value);

//		$('#listings_row_landlord input:checked').each(function() {

//			value = $(this).val();

//		}

//		);

//		//alert(value);

//		oTable.fnDraw(false);

//		$('#reset_filter1').css('display', '');

	}

	);

	//change css of selected row	

	$(document.body).on("click", "#listings_row tbody tr, .overflow", function(event) {

		//alert($(this).attr('id'))

		if (formDataChange == false) {

			$("td.yellowCSS", oTable.fnGetNodes()).removeClass("yellowCSS");

			$('#listings_row tbody #' + $(this).attr('rel')).find("td").addClass("yellowCSS");

			$(event.target).parent().find("td").addClass("yellowCSS");

		}

	});

	//function to uncheck radio buttons

	function uncheckRadio() {

		$('#listings_row_landlord input:checked').each(function() {

			value = $(this).val();

			if ($(this).val() != 'checkbox_' + value) {

				$('#listings_row_landlord input').attr('checked', false);

			}

		}

		);

		$('#new').css('display', 'none');

		$('#add_lead_landlord_name').text('');

		$('#fresh_screen_msg').text('To add a new lead, select or add a contact using the form above.');

	}

	// check box delete

	$(document.body).on("click", '.dbstatus', function() {

		if ($('#listings_row input').is(':checked')) {

			if (confirm("Are you sure you want to " + $(this).attr('id') + "?")) {

				var allVals = [];

				type = $(this).attr('id');

				$('input[type="checkbox"]:checked').each(function() {

					allVals.push($(this).val());

					name = $(this).attr('id');

				}

				);

				$.post('<?php echo base_url();?>leads/status/', {

					ids: allVals, type: $(this).attr('id')

				}

				,

				                    function(data) {

					$("#myForm")[ 0 ].reset();

					$('#edit').css('display', 'none');

					/* This shows the update button when a filed is selected */

					$('#new').css('display', 'inline');

					/* This shows the update button when a filed is selected */

					oTable.fnDeleteRow(47);

					$('#showdata').html(data);

					$('#showdata').animate( {

						'color': 'red'

					}

					, "slow");

				}

				);

			}

		} else {

			//alert('Please check atleast one entry!');

			$('#checkbox_error').show(400);

		}

	}

	);

	disable_popup();

}

);

//datatable initilization end

/* Insert / Update function */

$(document).ready(function() {

//        $.validator.addMethod('extra_check', function (value, element, param) {

////				return (value != 3) ;

//                                if(value != 3){

//                                    return true;

//                                }else{

//                                    return false;

//                                }

//			}

//			);

//	$.validator.addMethod('extra_check_sub', function (value, element, param) {

//                                if(value != 8){

//                                    return true;

//                                }else{

//                                    return false;

//                                }

//			}

//			);                           

	$('#myForm').ajaxForm( {

		beforeSubmit: function() {

			////                for the shared checkbox

			//                  if($("#shared").is(':checked'))

			//                    $("#shared").val() ;// checked;

			//                 else

			//                    $("#shared").val('0');

			//                

			////                end for the shared checkbox

			var lookup = '';

			var validate = '';

			var sendEmail = false;

			if ($('#landlord_id').val() == 0) {

				lookup = false;

				alert("Please select a contact to add a new lead.");

			} else {

				lookup = true;

			}

                        

                        

                            

			validate = $("#myForm").validate( {

				rules: {

                                      status: {

                                                extra_check : true

					},

                                     sub_status: {

                                                extra_check_sub:true

					}

				}

				, errorClass: 'form_fields_error', errorPlacement: function(error, element) {

					//$(element).attr({"title": error.text('asdasd')});

					$('#errorMsg').animate( {

						'color': 'red'

					}

					, "slow");

					 $('#errortxt').text('Please complete all required fields');

                       $('#errorMsg').animate({ 'color': 'red'}, "slow");

                        $('#errorMsg').fadeIn("slow");

					

					setTimeout(function() {

						 $('#errorMsg').fadeOut("slow");

                           $('#errorMsg').animate({ 'color': 'red'}, "slow");

					}

					, 5000);

					//alert('Please fill the required fields')

				}

			}

			).form();

//			$("#status, #sub_status").rules("add", {

//				required: true,

//				                    extra_check:true

//			}

//			);

//			$("#sub_status").rules("add", {

//				required: true,

//				                    extra_check_sub:true

//			}

//			);

			if (lookup && validate) {

				return true;

			} else {

				return false;

			}

		}

		,

		            target: '#errorMsg',

		            success: function() {

			//fnClickAddRow(),

			                        formDataChange = false;

			if ($("#ref").val() == '') {

				//$.ajax( {

//					async: false,

//					                        url: mainurl + 'leads/getlastid/',

//					                        success: function(data) {

//						last_id = data;

//						//alert(last_id);

//					}

//				}

//				)

			}

			$("#cancel").click(),

//	                $("#reset_filter").click(),

                                

                        $('#searchbox_popup').find('input:text').val('');

                        $('#searchbox_popup').find('select').val('');

			uncheckRadio();

			if ($('#ref').val() == '' && $('#landlord_email').val() != '') {

				setTimeout(function() {

					if (confirm("Would you like to send an e-mail to the client")) {

						$.ajax( {

							async: false,

							                                url: mainurl + 'leads/sendEmailToClient/',

							                                data:{

								landlord_id: $('#landlord_id').val(), agent_id: $('#agent_id').val(), lead_id: last_id

							}

							,

							                                success: function(data) {

								//alert(last_id);

							}

						}

						)

					}

				}

				, 1000);

			}
			// oTable.fnDraw();

//                        if($('#ref').val() == ''){

//                            $.ajax( {

//					async: false,

//					                        url: mainurl + 'leads/sendSMSToAgent/',

//					                        data:{

//						landlord_id: $('#landlord_id').val(), agent_id: $('#agent_id').val(), lead_id: last_id

//						//alert(last_id);

//					},

//                                                

//				}

//				)

//                        

//                        }

			$('#successMsg').animate( {

				'color': '#49AC44'

			}

			, "slow"),

			                        $('#successMsg').fadeIn("slow"),

			                        setTimeout(function() {

				$('#successMsg').fadeOut("slow")

			}

			, 5000);

		}

	}

	);

}

);



//end update / insert

/* Fetch single item details */

var last_id = 0;

function getSingleRow(id) {

	$("#showdata_shared").empty();

	$('#add_lead_landlord_name').hide();

	$.getJSON("<?php echo base_url();?>leads/single/" + id, function(json) {

		$.each(json, function(key, val) {

			$("#" + key).val(val);

			//$("#mobile").val(json.landlord_mobile);

		}

		);

		$("#mobile_no_new_ccode").val(json.landlord_ccode_id);

		$("#mobile_no_new_ccode_field").val(json.landlord_ccode);

		$('#emailPdfForm #lead_id').val(json.id)

		            $('#update, #Save, #cancel, #new').css('display', 'none');

		$('#edit, #new').css('display', 'inline');

		$("#showdata_shared").empty();

		$("#showdata_shared").css('display', 'none');

		$('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');

		$('#convert_to_listing_type').attr('disabled', false);

//		$('#add_lead_button').html('For ' + json.landlord_name);

		//$('#add_lead_landlord_name').show();

        $('#add_lead_landlord_name').text('Selected Contact: ' + json.landlord_name);

        $('#leadname').val(json.landlord_name);

        $('#sendto').val(json.landlord_email);

		$('#status').val(json.status);

        $('#lead_id').val(json.id);

		$("#shownotes").html('');

                $("#showleadshistory").html('');

		$("#property_req_1_data, #property_req_2_data, #property_req_3_data, #property_req_4_data, listing_id_1_ref, listing_id_2_ref, listing_id_3_ref, listing_id_4_ref").val('')

		            $("#listing_id_1, #listing_id_2, #listing_id_3, #listing_id_4, #listing_id_1_ref, #listing_id_2_ref, #listing_id_3_ref, #listing_id_4_ref").val('')

		

                if (json.property_req_1) {

			plot_requirements('[' + json.property_req_1 + ']', 1);

		}

		if (json.property_req_2) {

			plot_requirements('[' + json.property_req_2 + ']', 2);

		}

		if (json.property_req_3) {

			plot_requirements('[' + json.property_req_3 + ']', 3);

		}

		if (json.property_req_4) {

			plot_requirements('[' + json.property_req_4 + ']', 4);

		}

		if (json.type == 2) {

			$('.financial_situation_holder').css('display', '')

			                $('.financial_situation_msg').css('display', 'none');

		} else {

			$('.financial_situation_holder').css('display', 'none')

			                $('.financial_situation_msg').css('display', '');

		}

		$('#convert_to_property_req_1_data').val($('#property_req_1_data').val());

		$('#convert_to_property_req_2_data').val($('#property_req_2_data').val());

		$('#convert_to_property_req_3_data').val($('#property_req_3_data').val());

		$('#convert_to_property_req_4_data').val($('#property_req_4_data').val());

		$("#prop_req_form")[ 0 ].reset();

		$('#sub_status').val(json.sub_status);

		animate_the_form_table_on_click();

		$('#area_location_id, #sub_area_location_id').attr('disabled', 'disabled');                                                           

		formDataChange = false;

		if (json.type == 1 || json.type == 2) {

			$('#matching_prop_link').css('display', '')

			                //alert($('#matching_prop_link a').attr('id'))

		} else {

			$('#matching_prop_link').css('display', 'none')

		}

		last_id = json.id;

		//$('#add_lead_landlord_name, #add_lead_button, #fresh_screen_msg').text('');

		$('#fresh_screen_msg').text('');

		$('#title').text('Lead details for ' + json.landlord_name + ' (Enquiry ' + json.date_of_enquiry + ')');

		if(json.landlord_name =='- -') {

			$('#title').text('Lead details (Enquiry ' + json.date_of_enquiry + ')');

		}

		/* get notes */

		$("#notes, #notesx").val('');

		plot_notes('leads', '[' + json.notes + ']');

                

                /* get status history */

                $("#showleadshistory").val('');

                //getStatusHistory('leads', json.id);

                

		if (json.type == 3 || json.type == 4) {

			$('#add_to_listing_popup').css('display', '');

			if (json.type == 3) {

				$("#convert_to_listing_type[value='1']").attr('checked', 'checked');

			}

			if (json.type == 4) {

				$("#convert_to_listing_type[value='2']").attr('checked', 'checked');

			}

		} else if (json.type == 5) {

			$('#add_to_listing_popup').css('display', '');

			$("#convert_to_listing_type").attr('checked', false);

		} else {

			$('#add_to_listing_popup').css('display', 'none');

			$("#convert_to_listing_type").attr('checked', false);

		}

		if (json.agent_id !=1448804) {

			$("#agent_id").attr("disabled", "disabled");

		}

		if (json.source_of_lead == 'Other') {

			$('#source_of_lead').css('width', '80px');

			$('#other_source_of_lead').css('display', '');

		} else {

			$('#source_of_lead').css('width', '');

			$('#other_source_of_lead').css('display', 'none');

		}

		if (json.source_of_lead == 'Other') {

			$('#source_of_lead').css('width', '100px');

			$('#other_source_of_lead').css('display', '');

			$('#reffered_by_agent').css('display', 'none');

		} else if (json.source_of_lead == 'Referral within company') {

			$('#source_of_lead').css('width', '100px');

			$('#reffered_by_agent').css('display', '');

			$('#other_source_of_lead').css('display', 'none');

		} else {

			$('#source_of_lead').css('width', '');

			//$('#source_of_lead').css('width','207px');

			$('#reffered_by_agent').css('display', 'none');

			$('#other_source_of_lead').css('display', 'none');

		}

		if (json.notify == 1) {

			$("#notify").attr('checked', 'checked');

			$("#notify").val(1);

		} else {

			$("#notify").attr('checked', false);

			$("#notify").val(1);

		}

		if (json.notify_unsubscribe == 1) {

			$('#notify_unsubscribe').html("Unscubscribed")

		} else {

			$('#notify_unsubscribe').html("")

		}

		if(json.lead_by_agent==1) {

			$("#lead_by_agent").attr('checked', 'checked');

			$("#lead_by_agent").val(1);

		} else {

			$("#lead_by_agent").attr('checked', false);

			$("#lead_by_agent").val(0);

			$("#lead_by_agent_hidden").val('no');

		}

		if(json.shared==1) {

			$("#shared").attr('checked', 'checked');

			$("#shared").val(1);

		} else {

			$("#shared").attr('checked', false);

			$("#shared").val(0);

			$("#shared_hidden").val('no');

		}

        if(json.hot_lead==1) {

			$("#hot_lead").attr('checked', 'checked');

			$("#shared").val(1);

		} else {

			$("#hot_lead").attr('checked', false);

			$("#hot_lead").val(1);

		}

		$('#showdata').css('color', '#49AC44');

		$('#showdata').html('Record selected')

		            $('#showdata').fadeIn("slow");

		// for leads sharing

		    

		                   

		// End for Leads sharing   

		setTimeout(function() {

			$('#showdata').fadeOut("slow");

		}

		, 5000);

	}

	);

	//End json 

	formDataChange = false;

			            disable_popup();

		             

}

/* Fetch single item details */



//End click 

//extra stuff

$(document).ready(function() {

	/*function for showing the lead selected */

	var id_matching_list = "";

	var ref = "";

	if (id_matching_list != 0) {

		getSingleRow(id_matching_list);

		$('#listings_row tbody #' + $(this).attr('rel')).find("td").addClass("yellowCSS");

	}

	/* end function for showing the lead selected */

	$("#type").change(function() {

		if (this.value == 2) {

			$('.financial_situation_holder').css('display', '');

			$('.financial_situation_msg').css('display', 'none');

		} else {

			$('.financial_situation_holder').css('display', 'none');

			$('.financial_situation_msg').css('display', '');

		}

		if(this.value == 1 || this.value == 2) {

			$("#shared").attr('disabled', false);

		} else {

			$("#shared").attr('disabled','disabled');

			$("#shared").attr('checked',false);

			$("#shared").val(0);

			$("#shared_hidden").val('no');

		}

	}

	);

	$(document.body).on("click", '#remove_agent', function() {

		if (confirm('Are you sure you want to remove?')) {

			$('#agent_id_' + $(this).attr('agent')).val('');

		}

	}

	);

	$("#convert_to_listing, #convert_to_listing_link").click(function() {

		var type = '';

		if ($('#type').val() == 3) {

			type = $('#convert_to_listing_type:checked').val();

		}

		if ($('#type').val() == 4) {

			type = $('#convert_to_listing_type:checked').val();

		}

		if ($('#type').val() == 5) {

			if ($('#convert_to_listing_type:checked').val() == 2)

			                    type = '2'; else

			                    type = '1'

		}

		if ($('#convert_to_listing_type:checked').length == 0) {

			alert('Please select the listing type ( e.g Sales or Rental )');

		} else if ($('#convert_to_property_no:checked').length == 0) {

			alert('Please select the property requirements.');

		} else {

			$('#convert_to_sales_lead_id, #convert_to_rentals_lead_id').val($('#id').val());

			$('#convert_to_sales_json, #convert_to_rentals_json').val($('#property_req_' + $('#convert_to_property_no:checked').val()).val());

			//window.location = "https://crm.propspace.com/listings/"+type+"/?lead_id="+$('#id').val()+"&property_json="+$('#property_req_'+$('#convert_to_property_no:checked').val()).val();

			if (type == 2) {

				$("#convert_to_sales_form").submit();

			} else {

				$("#convert_to_rentals_form").submit();

			}

		}

	}

	)

	        $("#edit").click(function() {

		$("#showdata_shared").empty();

		if ($("#date_of_enquiry").val() != null) {

			$("#date_of_enquiry").attr("disabled", "disabled");

		}

				          if($("#type").val() == 1 || $("#type").val() == 2) {

			$("#shared").attr('disabled', false);

		} else {

			$("#shared").attr('disabled','disabled');

		}

	}

	);

	$("input, #groups_leads").tooltip( {

		extraClass: "tooltip",

		            showURL: false

	}

	);

	$('#myForm_landlord_search input').keydown(function(e) {

		if (e.keyCode == 13) {

			$('#search_landlord').click();

			//$('#myForm_landlord_search').submit();

		}

	}

	);

	$('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');

	$("#mobile_no, #mobile_no_new, #phone, #home_no, #mobile, #landlord_search_table #3, #landlord_search_table #4").numeric();

	$(document.body).on("click", '.delete_savedsearch', function() {

		id = $(this).attr('id');

		if (confirm('Are you sure you want to delete?')) {

			$.post("https://crm.propspace.com/listings/delete_savedsearch/", {

				id: id

			}

			,

			                function(data) {

				$('#search_entry_' + id).remove();

			}

			);

		}

	}

	);

	$("#source_of_lead").change(function() {

		if ($(this).attr('value') == 'Other') {

			$('#source_of_lead').css('width', '100px');

			$('#other_source_of_lead').css('display', '');

			$('#reffered_by_agent').css('display', 'none');

		} else if ($(this).attr('value') == 'Referral within company') {

			$('#source_of_lead').css('width', '100px');

			$('#reffered_by_agent').css('display', '');

			$('#other_source_of_lead').css('display', 'none');

		} else {

			$('#source_of_lead').css('width', '');

			//$('#source_of_lead').css('width','207px');

			$('#reffered_by_agent').css('display', 'none');

			$('#other_source_of_lead').css('display', 'none');

		}

	}

	);

	//date and time picker

	$(function() {


		            $('#movein_date').datepicker( {

							dateFormat: 'dd-mm-yy'

						}

						);

		

		//            var leads_reminder_one = $('#leads_reminder_one').attr('value', 'Set Date and Time');

		//            alert(leads_reminder_one);

		

	}

	);

	//update requirement field if any value changed in reuirments

	$(document.body).on('change', "#myForm", function(event) {

		var category = $('#category_id option:selected').text();

		var region = $('#region_id option:selected').text();

		var location = $('#area_location_id option:selected').text();

		var sub_location = $('#sub_area_location_id option:selected').text();

		var beds = $('#beds option:selected').text();

		var req_field = '';

		var comma = '';

		if (category != 'Select') {

			req_field += category;

			comma = ', ';

		}

		if (sub_location != 'Select') {

			req_field += comma + sub_location;

			comma = ', ';

		}

		if (location != 'Select') {

			req_field += comma + location;

			comma = ', ';

		}

		if (region != 'Select') {

			req_field += comma + region;

			comma = ', ';

		}

		if (beds != 'Select') {

			req_field += comma + beds;

			comma = ', ';

		}

		$('#property_requirement').val(req_field);

	}

	);

	formDataChange = false;

}

);

$(document).ready(function() {

	var this_screen_listing_id ='';

	if (this_screen_listing_id) {

		$.getJSON("<?php echo base_url();?>leads/single/" + this_screen_listing_id, function(json) {

			$.each(json, function(key, val) {

				$("#" + key).val(val);

			}

			);

		}

		);

		$('#edit').css('display', 'inline');

	}

	$("#new").click(function() {

		//hide message

		$("#add_lead_landlord_name").hide();

		$("#showdata_shared").empty();

		$("#region_id, #area_location_id, #sub_area_location_id").val('');

		$("#assigned_by_name").val('<?php echo $user_fullname;?>');

		//$('#sub_status').val('4');

		var leadsstatus = $("#status").find("option:selected").text();

		if (leadsstatus == "Open") {

			$('#sub_status').find('option').remove().end();

			var ddl = document.getElementById('sub_status');

			var option = document.createElement('option');

			option.value = ''

			                option.text = "Select"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 1

			                option.text = "In progress"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 4

			                option.text = "Not yet contacted"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 5

			                option.text = "Called no reply"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 6

			                option.text = "Follow up"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 7

			                option.text = "Viewing arranged"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 8

			                option.text = "Not Specified"

			                ddl.appendChild(option);

                        var option = document.createElement('option');

			option.value = 10

			                option.text = "Needs more info"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 11

			                option.text = "Budget differs"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 12

			                option.text = "Needs time"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 13

			                option.text = "Client to revert"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 14

			                option.text = "Interested"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 15

			                option.text = "Interested to Meet"

			                ddl.appendChild(option);

			var option = document.createElement('option');

			option.value = 16

			                option.text = "Not Interested"

			                ddl.appendChild(option);

                        var option = document.createElement('option');

			option.value = 17

			                option.text = "Look-see"

			                ddl.appendChild(option);

			$('#sub_status').val('4');

		}

				            $('#type').focus();

		//           for the shared leads checkbox

		$("#shared").attr("disabled", "disabled");

		//           end for the shared leads checkbox

	}

	);

}

);

</script>

<script>

/* Insert / Update function */

$(document).ready(function() {

    

    

     $("#mobile_no_new, #email").change( function () {

                                    if(this.id == 'mobile_no_new'){

                                       $("#email").removeClass('form_fields_error');

                                    }else{

                                       $("#mobile_no_new").removeClass('form_fields_error');

                                    }

                               });

                               

                               

                               

	$('#myForm_landlord').ajaxForm( {

		beforeSubmit: function() {

			var lookup = '';

			var validate = '';

			$.ajax( {

				 async: false,

				 url: mainurl+'contacts/lookupnew/?mobile_no_new='+$('#mobile_no_new').val()+'&email='+$('#email').val(),

				 success: function(data) {

					

                    if(data>0){

                    lookup = false;

                    alert("This contact already exist in company database.Please search it above.");

                     }

                    else{

                    lookup = true;

                    }

				 }

			}

			)

			                validate = $("#myForm_landlord").validate( {

				rules: {
					field: {
					required: true,
					email: true
					}

				}

				, errorClass: 'form_fields_error', errorPlacement: function(error, element) {

					$('#errorMsg').animate( {

						'color': 'red'

					}

					, "slow");

					 $('#errortxt').text('Please complete all required fields');
					 $('#addcontact_error').show();
					  $('#addcontact_error').text('Please complete all required fields');
					 
                                $('#errorMsg').animate({ 'color': 'red'}, "slow");

                                $('#errorMsg').fadeIn("slow");

					setTimeout(function() {

						$('#errorMsg').fadeOut("slow");
						$('#addcontact_error').fadeOut("slow");

						$('#errorMsg').animate( {

							'color': 'red'

						}

						, "slow");

					}

					, 5000);

				}

			}

			).form();

			//validate = true;

			if (lookup && validate) {

				return true;

			} else {

				return false;

			}

		}

		,

		            target: '#showdata',

		            success: function() {

			rfsh();

			$('#showdata').text("Contact saved Successfully!!");
			$('.close').trigger('click');

			$('#listings_row_landlord').next().show();

			$('#listings_row_landlord').show();

			formDataChange = false;

			$('#showdata').animate( {

				'color': '#49AC44'

			}

			, "slow"),

			                        $('#showdata').fadeIn("slow"),

			                        $("#myForm_landlord")[ 0 ].reset(),

			                        setTimeout(function() {

				$('#showdata').fadeOut("slow")

			}

			, 5000);

		}

	}

	);

}

);

function fnClickAddRowB() {

	//$('#listings_row').dataTable

	// var oTable = $$('#listings_row_landlord').dataTable();

	// Re-draw the table - you wouldn't want to do it here, but it's an example :-)

	// oTable.fnDraw();

	/*$('#listings_row_landlord').dataTable().fnAddData( [

         '',

         '',

         '',

         '',

         '',

         '',

         '',

         '',

         '',

         '',

         ] );

         */

}

//end update

$(document).ready(function() {

	$("#myForm_landlord_search input").keyup(function() {

		$('#reset_filter_landlord').css('display', 'inline');

	}

	);

	$(document.body).on('click', "#reset_filter_landlord", function() {

		$("#myForm_landlord_search")[ 0 ].reset();

		$(this).css('display', 'none');

		rfsh();

	}

	);

	var page_load_id = '123123123123';

	

	oTable2 = $('#listings_row_landlord').dataTable( {

		"bProcessing": true,

		            "sDom": 'R<>rt<ilp><"clear">',

		

		//"aaSorting": [[0, 'desc']],

		            "bServerSide": true,

		            "bRegex": true,

					"pageLength": 5,

		            "sAjaxSource": mainurl+"leads/datatable_landlord/?time=1447652658",

		            "iDisplayStart": 0,

		            "sPaginationType": "full_numbers",

					'columnDefs': [{

					 'targets': 0,

					 'searchable':false,

					 'orderable':false,

					  'render': function (data, type, full, meta){

			        return '<div style="text-align:center; width:22px;" id="item_action">'

					+'<input type="radio" name="select_landlord" style="opacity:1;" id="checkbox_'+ data +'" value="'+ data +'"></div>';

       				  }}],	

					"rowCallback": function( row, data ) {

				 $(row).attr("id",data.id);

        			},

					

			"columns": [

			{ "data": "id" },

            { "data": "name" },

			{ "data": "last_name" },

			{ "data": "mobile_no_new_ccode" },

			{ "data": "mobile_no_new" },

			{ "data": "phone" },

            { "data": "email" },

            { "data": "created_by" },

            { "data": "assigned_to_id" },

            { "data": "dateadded" }

			  ],


		 "fnServerData": function(url, data, callback) {
		 	/* Add some extra data to the sender */
		 		data.id        = page_load_id;
				data.sSearch_1 = $('#landlord_search_table #1').val();
				data.sSearch_2 = $('#landlord_search_table #2').val();
				data.sSearch_3 = $('#landlord_search_table #3').val();
				data.sSearch_4 = $('#landlord_search_table #4').val();
				data.sSearch_5 = $('#landlord_search_table #5').val();
				data.sSearch_6 = $('#landlord_search_table #6').val();
				

			 $.ajax({

				"dataType": 'json', 

               "type": "POST", 

               "url": url, 

               "data": data, 

               "success": function(json) {
               		page_load_id = '';
                   callback(json);

                  }

						 });

		}

	});

	$("#search_landlord").click(function() {

		if ($('#ref').val() == '') {

			$("#myForm")[ 0 ].reset();

			//reset the form first

		}
         

		if ($('#landlord_search_table #4').val().length < 7 && $.trim($('#landlord_search_table #4').val()) != "") {

			alert("Mobile No field must have at least 7 digits.");

		} else if ($('#landlord_search_table #6').val().length < 3 && $.trim($('#landlord_search_table #6').val()) != "") {

			alert("Email Address field must have at least 3 characters.");

		} else {

			dummy_id = '';

			/*$('#landlord_search_table input').each(function(index) {

                 if($(this).attr('id')!=3){

                 oTable2.fnFilter( this.value, $(this).attr('id') );

                 }

                 if($('#landlord_search_table #4').val()>0){

                 oTable2.fnFilter( $('#landlord_search_table #3').val(), 3 );

                 }

                 });*/

			var oTable2 = $('#listings_row_landlord').dataTable();

			oTable2.fnDraw();

			 

			$('#owners_datatable').show(300);

			$('#top_table').css('border-bottom', 'solid 1px #fff');

			$('#top_table').css('border-radius', '5px 5px 0 0');

			$('#owners_datatable').css('border-radius', '0px 0px 5px 5px');

			$('#listings_row_landlord_div').show();

			$('#listings_row_landlord').show();

			$('#listings_row_landlord').next().show();

		}

	}

	);

	$("#add_new_contact").click(function() {

		//alert('hello');

		var count = 1;

		var country_code = $('#myForm_landlord_search #3').val();

		$('#myForm_landlord #name').val($('#myForm_landlord_search #1').val());

		$('#myForm_landlord #last_name').val($('#myForm_landlord_search #2').val());

		$("#myForm_landlord #mobile_no_new_ccode option[value='" + country_code + "']").attr("selected", "selected");

		$("#myForm_landlord #c_code_phone_1").val("");

		//$('#myForm_landlord #3').val( $('#myForm_landlord_search #3').val() );

		$('#myForm_landlord #mobile_no_new').val($('#myForm_landlord_search #4').val());

		$('#myForm_landlord #phone').val($('#myForm_landlord_search #5').val());

		$('#myForm_landlord #email').val($('#myForm_landlord_search #6').val());

	}

	);

	$('#listings_row_landlord').change(function() {

		if ($('#ref').val() != '' && $('#type').prop('disabled') != true) {

			

			var confirm_change = confirm('Are you sure you want to change the contact detail?');

		} else {

			

			$("#myForm")[ 0 ].reset();

			//reset the form first

			confirm_change = true;

		}

		if (confirm_change) {

			var value

			                $('#listings_row_landlord input:checked').each(function() {

				value = $(this).val();

				/*if($(this).val()!='checkbox_'+value){

                     $('#listings_row_landlord inbox').attr('checked', false);

                     }*/

			}

			);

    		$("#hot_lead").attr('checked', false);

			$("#hot_lead").val(1);



			$('#landlord_id').val(value);

			//var first_name = $('#' + value).find("td:nth-child(2) div").html();

			//var last_name = $('#' + value).find("td:nth-child(3) div").html();

			var first_name  = $('#checkbox_'+value).closest("td").next().html();

			var last_name   = $('#checkbox_'+value).closest("td").next().next().html();

			var landlord_id = value;

			//alert(value);

			if (last_name == null) {

				last_name = '';

			}

			if (first_name == null) {

				first_name = '';

			}

			$('#add_lead_landlord_name').text('Selected Contact: ' + first_name + ' ' + last_name + '')

			                $('#add_lead_button').text(' For ' + first_name + ' ' + last_name);

			$('#landlord_name').val(first_name + ' ' + last_name);

			//my code,we need to save full name seperatly also

			$('#first_name').val(first_name);

			$('#last_name').val(last_name);

			//var cCodeLL = $('#' + value).find("td:nth-child(4) div").html();

			//var mobileLL = $('#' + value).find("td:nth-child(5) div").html();

			var cCodeLL = $('#checkbox_'+value).closest("td").next().next().next().html();

			var mobileLL = $('#checkbox_'+value).closest("td").next().next().next().next().html();

			if(cCodeLL=='' || cCodeLL=='0' || cCodeLL==null)

			                    cCodeLL = '';

			if(mobileLL=='' || mobileLL=='0' || mobileLL==null)

			                    mobileLL = '';

			$('#landlord_mobile').val(cCodeLL + ' ' + mobileLL);

			//$('#landlord_email').val($('#' + value).find("td:nth-child(7) div").html());

			$('#landlord_email').val($('#checkbox_'+value).closest("td").next().next().next().next().next().next().html());

			$('#new').css('display', 'block');

			$('#fresh_screen_msg').text('')

		}

		$("td.yellowCSS", oTable2.fnGetNodes()).removeClass("yellowCSS");

		$('#listings_row_landlord tbody #' + value).find("td").addClass("yellowCSS");

	}

	);

	$(document.body).on('change', "#myForm_landlord", function(event) {

		var country = $('#address_country option:selected').text();

		var city = $('#address_city').val();

		var req_field = '';

		var comma = '';

		if (city != 'Select' && city != '') {

			req_field += city;

			comma = ', ';

		}

		if (country != 'Select' && country != '') {

			req_field += comma + country;

			comma = ', ';

		}

		$('#address_detail').val(req_field);

	}

	);

	$(document.body).on('click', "#cancel", function(event) {

		uncheckRadio();

		//$('#add_lead_landlord_name, #add_lead_button').text('');

		//$('#new').css('display','none');

	}

	);

}

);

var open_status = '<option value="" selected>Select</option><option value="4">Not yet contacted</option><option value="5" >Called no reply</option><option value="6" >Follow up</option><option value="10">Needs more info</option><option value="9" >Offer Made</option><option value="7" >Viewing arranged</option><option value="17" >Look-see</option><option value="11">Budget differs</option><option value="12">Needs time</option><option value="13">Client to revert</option><option value="14">Interested</option><option value="15">Interested to Meet</option><option value="1" >In progress</option><option value="16">Not Interested</option><option value="8" >Not Specified</option>';

var close_status = '<option value="" selected>Select</option><option value="2" >Successful</option><option value="3" >Unsuccessful</option><option value="8" >Not Specified</option>';

$(document.body).on('change', "#status", function(event) {

	if ($(this).val() == 1) {

		$('#sub_status').html(open_status);

	}

	if ($(this).val() == 2) {

		$('#sub_status').html(close_status);

	}

	if ($(this).val() == '') {

		$('#sub_status').html(open_status + close_status);

	}

}

);

$(document.body).on('change', "#3", function(event) {

	if ($(this).val() == 1) {

		$('.sub_status_search').html(open_status);

	}

	if ($(this).val() == 2) {

		$('.sub_status_search').html(close_status);

	}

	if ($(this).val() == '') {

		$('.sub_status_search').html(open_status + close_status);

	}

}

);

$(document.body).on('change', "#4", function(event) {

	if ($(this).val() == 1) {

		$('.sub_status_search').html(open_status);

	}

	if ($(this).val() == 2) {

		$('.sub_status_search').html(close_status);

	}

	if ($(this).val() == '') {

		$('.sub_status_search').html(open_status + close_status);

	}

	if ($(this).val() == 3) {

		$('.sub_status_search').html(open_status + close_status);

	}

	oTable.fnFilter('', '5');

}

);

</script>

<script>

    $(document).ready(function() {

	var oTable = $('#matching_properties').dataTable( {

		"bProcessing": true,

		            "sDom": 'R<>rt<ilp><"clear">',

		            "bServerSide": true,

		            "sAjaxSource": "https://crm.propspace.com/index.php/leads/matchedproperties",

		            "iDisplayStart": 0,

		            "aoColumnDefs": [ {

                            "fnRender": function(oObj) {

                            

                                var list = getStoreData('matchingLeads');

                                if(list){

                                    if(chkListValue(list, oObj.aData[0], ',')){

                                        var checked = "checked";

                                    }else{

                                        var checked = "";

                                    }

                                }



                                return '<div style="text-align:center;"> <input type="checkbox" value="'+oObj.aData[0]+'" '+checked+'> </div>';

                            },

			    "aTargets": [0]

                            }

		, {

			"bSortable": false, "aTargets": [0]

		}

		/*{ 

                 "bVisible": false, "aTargets": [ 13 ] 

                 }*/

		],

		            "aaSorting": [[13, 'desc']],

		            "sPaginationType": "full_numbers",

		            "fnServerData": function(sSource, aoData, fnCallback) {

			/* Add some extra data to the sender */

			var type;

			if ($('#type').val() == 1) {

				type = 1;

			} else if ($('#type').val() == 2) {

				type = 2;

			} else {

				type = 0;

			}

			aoData.push( {

				"name": "property_req_1", "value": $('#property_req_1').val()

			}

			, {

				"name": "property_req_2", "value": $('#property_req_2').val()

			}

			, {

				"name": "property_req_3", "value": $('#property_req_3').val()

			}

			, {

				"name": "property_req_4", "value": $('#property_req_4').val()

			}

			, {

				"name": "type", "value": type

			}

			);

			if ($('#ref').val() != ''){



                            $.ajax( {

                                          "dataType": 'json', 

                                            "type": "POST", 

                                            "url": sSource, 

                                            "data": aoData, 

                                             "success": function(json) {

                                            fnCallback(json);

                                            var oSettings = oTable.fnSettings();

                                            var iTotalRecords = oSettings.fnRecordsTotal();

                                            $('#listings_stats').text('(' + iTotalRecords + ')');

                                            if (iTotalRecords == 0) {

                                                    $('#match_count_div').html('<div class="icon-home leads_matches leads_matches_main"> No property matches found</div>');

                                                    $('#property_count_top').val(0);

                                            } else {

                                                    $('#match_count_div').html('<a id="show_owner_properties_click" href="#?w=500" rel="show_matched_properties" class="popup_a leads_matches_main" width="1100" ><div class="icon-home leads_matches" >Found ' + iTotalRecords + ' property matches >></div>');

                                                    $('#property_count_top').val(iTotalRecords);

                                            }



                                           var checkedL = $("#matching_properties td input[type=checkbox]:checked").length;

                                           var unCheckedL = $("#matching_properties td input[type=checkbox]").length;

                                           if(checkedL==unCheckedL && checkedL!=0){

                                               $("#matching_properties #check_all_checkboxes").attr("checked","checked");

                                           }else{

                                               $("#matching_properties #check_all_checkboxes").attr("checked",false);

                                           }



                                    }

                                    } );

			}

		}

	}

	);

	$(document.body).on("click", '#listings_row tbody tr,#update', function() {

		setTimeout(function() {

			if ($('#type').val() == 1 || $('#type').val() == 2) {

				$('#match_count_div').html('<div class="icon-home leads_matches leads_matches_main">Matching properties <img style="margin-top: -1px;padding-left: 5px;float:right;" src="<?php echo base_url();?>application/views/images/loadw.gif"></div>');

				clearStoreData();

                                $('#email_count').html(0);

                                $('#listing_ids,#emailHTML').val('');

                                oTable.fnDraw();

			} else {

				$('#match_count_div').html('<div class="icon-home leads_matches leads_matches_main"> No property matches found</div>');

			}

		}

		, 1000);

	}

	);

	$("#searchbox2 input").keyup(function() {

		/* Filter on the column (the index) of this element */

		oTable.fnFilter(this.value, $(this).attr('id'));

		$('#reset_filter2').css('display', '');

	}

	);

	$("#searchbox2 select").change(function() {

		/* Filter on the column (the index) of this element */

		oTable.fnFilter(this.value, $(this).attr('id'));

		$('#reset_filter2').css('display', '');

	}

	);

	//reset filter and drawtable

	$("#reset_filter2").click(function() {

		$("#myForm3")[ 0 ].reset();

		oTable.fnDraw(false);

		oTable.fnFilterClear(true);

		$('#reset_filter2').css('display', 'none');

	}

	);

}

);

</script>

<div id="wrapper" class="leads">

            <div class="container">

            

            

            <!-- Page Heading -->

            <div class="row">

                <div class="col-lg-12">

                	<div class="page_head_area"><h1><i class="fa fa-crosshairs"></i> Leads</h1></div>

                </div>

            </div>

            <div class="showdata alert alert-success text-center" id="showdata" style="display:none;"></div>

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

             <!-- Auto Message Alert -->

             <div role="alert" class="alert alert-info alert-dismissible fade in" id="automsg" style="display:none;">

              <button aria-label="Close" data-dismiss="alert" class="close" type="button">

              <span aria-hidden="true">×</span></button>

              <strong>Info!</strong> <span id="autotxt">This lead has been auto imported from an email enquiry</span>  

            </div> 

            

            

            <div id="inner_tab">

            

            

            <div class="row">

            <div class="col-lg-12">

            <form id="myForm_landlord_search">

            <div class="tab-content content-wnotop">

              <div class="row">

              <h4 class="add_new_rental">Select or add a Contact for the new lead</h4>

              </div>

              <div class="row" id="landlord_search_table">



                <div class="col-md-2">

                  <div class="form-group">

                      <!-- <label>First Name</label> -->

                      <input type="text" id="1" class="form-control input-sm" placeholder="First Name">

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                      <!-- <label>First Name</label> -->

                      <input type="text" id="2" class="form-control input-sm" placeholder="Last Name">

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                      <!-- <label>First Name</label> -->

                     <div class="input-group">

                        <span class="input-group-btn">

                      

                        

<select id="3" class="btn input-sm codeselect">



 <option value="1">USA (+1)</option> 

 <option value="213">Algeria (+213)</option> 

 <option value="376">Andorra (+376)</option> 

 <option value="244">Angola (+244)</option> 

 <option value="1264">Anguilla (+1264)</option> 

 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 

 <option value="599">Antilles (Dutch) (+599)</option> 

 <option value="54">Argentina (+54)</option> 

 <option value="374">Armenia (+374)</option> 

 <option value="297">Aruba (+297)</option> 

 <option value="247">Ascension Island (+247)</option> 

 <option value="61">Australia (+61)</option> 

 <option value="43">Austria (+43)</option> 

 <option value="994">Azerbaijan (+994)</option> 

 <option value="1242">Bahamas (+1242)</option> 

 <option value="973">Bahrain (+973)</option> 

 <option value="880">Bangladesh (+880)</option> 

 <option value="1246">Barbados (+1246)</option> 

 <option value="375">Belarus (+375)</option> 

 <option value="32">Belgium (+32)</option> 

 <option value="501">Belize (+501)</option> 

 <option value="229">Benin (+229)</option> 

 <option value="1441">Bermuda (+1441)</option> 

 <option value="975">Bhutan (+975)</option> 

 <option value="591">Bolivia (+591)</option> 

 <option value="387">Bosnia Herzegovina (+387)</option> 

 <option value="267">Botswana (+267)</option> 

 <option value="55">Brazil (+55)</option> 

 <option value="673">Brunei (+673)</option> 

 <option value="359">Bulgaria (+359)</option> 

 <option value="226">Burkina Faso (+226)</option> 

 <option value="257">Burundi (+257)</option> 

 <option value="855">Cambodia (+855)</option> 

 <option value="237">Cameroon (+237)</option> 

 <option value="1">Canada (+1)</option> 

 <option value="238">Cape Verde Islands (+238)</option> 

 <option value="1345">Cayman Islands (+1345)</option> 

 <option value="236">Central African Republic (+236)</option> 

 <option value="56">Chile (+56)</option> 

 <option value="86">China (+86)</option> 

 <option value="57">Colombia (+57)</option> 

 <option value="269">Comoros (+269)</option> 

 <option value="242">Congo (+242)</option> 

 <option value="682">Cook Islands (+682)</option> 

 <option value="506">Costa Rica (+506)</option> 

 <option value="385">Croatia (+385)</option> 

 <option value="53">Cuba (+53)</option> 

 <option value="90392">Cyprus North (+90392)</option> 

 <option value="357">Cyprus South (+357)</option> 

 <option value="42">Czech Republic (+42)</option> 

 <option value="45">Denmark (+45)</option> 

 <option value="2463">Diego Garcia (+2463)</option> 

 <option value="253">Djibouti (+253)</option> 

 <option value="1809">Dominica (+1809)</option> 

 <option value="1809">Dominican Republic (+1809)</option> 

 <option value="593">Ecuador (+593)</option> 

 <option value="20">Egypt (+20)</option> 

 <option value="353">Eire (+353)</option> 

 <option value="503">El Salvador (+503)</option> 

 <option value="240">Equatorial Guinea (+240)</option> 

 <option value="291">Eritrea (+291)</option> 

 <option value="372">Estonia (+372)</option> 

 <option value="251">Ethiopia (+251)</option> 

 <option value="500">Falkland Islands (+500)</option> 

 <option value="298">Faroe Islands (+298)</option> 

 <option value="679">Fiji (+679)</option> 

 <option value="358">Finland (+358)</option> 

 <option value="33">France (+33)</option> 

 <option value="594">French Guiana (+594)</option> 

 <option value="689">French Polynesia (+689)</option> 

 <option value="241">Gabon (+241)</option> 

 <option value="220">Gambia (+220)</option> 

 <option value="7880">Georgia (+7880)</option> 

 <option value="49">Germany (+49)</option> 

 <option value="233">Ghana (+233)</option> 

 <option value="350">Gibraltar (+350)</option> 

 <option value="30">Greece (+30)</option> 

 <option value="299">Greenland (+299)</option> 

 <option value="1473">Grenada (+1473)</option> 

 <option value="590">Guadeloupe (+590)</option> 

 <option value="671">Guam (+671)</option> 

 <option value="502">Guatemala (+502)</option> 

 <option value="224">Guinea (+224)</option> 

 <option value="245">Guinea - Bissau (+245)</option> 

 <option value="592">Guyana (+592)</option> 

 <option value="509">Haiti (+509)</option> 

 <option value="504">Honduras (+504)</option> 

 <option value="852">Hong Kong (+852)</option> 

 <option value="36">Hungary (+36)</option> 

 <option value="354">Iceland (+354)</option> 

 <option value="91">India (+91)</option> 

 <option value="62">Indonesia (+62)</option> 

 <option value="98">Iran (+98)</option> 

 <option value="964">Iraq (+964)</option> 

 <option value="972">Israel (+972)</option> 

 <option value="39">Italy (+39)</option> 

 <option value="225">Ivory Coast (+225)</option> 

 <option value="1876">Jamaica (+1876)</option> 

 <option value="81">Japan (+81)</option> 

 <option value="962">Jordan (+962)</option> 

 <option value="7">Kazakhstan (+7)</option> 

 <option value="254">Kenya (+254)</option> 

 <option value="686">Kiribati (+686)</option> 

 <option value="850">Korea North (+850)</option> 

 <option value="82">Korea South (+82)</option> 

 <option value="965">Kuwait (+965)</option> 

 <option value="996">Kyrgyzstan (+996)</option> 

 <option value="856">Laos (+856)</option> 

 <option value="371">Latvia (+371)</option> 

 <option value="961">Lebanon (+961)</option> 

 <option value="266">Lesotho (+266)</option> 

 <option value="231">Liberia (+231)</option> 

 <option value="218">Libya (+218)</option> 

 <option value="417">Liechtenstein (+417)</option> 

 <option value="370">Lithuania (+370)</option> 

 <option value="352">Luxembourg (+352)</option> 

 <option value="853">Macao (+853)</option> 

 <option value="389">Macedonia (+389)</option> 

 <option value="261">Madagascar (+261)</option> 

 <option value="265">Malawi (+265)</option> 

 <option value="60">Malaysia (+60)</option> 

 <option value="960">Maldives (+960)</option> 

 <option value="223">Mali (+223)</option> 

 <option value="356">Malta (+356)</option> 

 <option value="692">Marshall Islands (+692)</option> 

 <option value="596">Martinique (+596)</option> 

 <option value="222">Mauritania (+222)</option> 

 <option value="269">Mayotte (+269)</option> 

 <option value="52">Mexico (+52)</option> 

 <option value="691">Micronesia (+691)</option> 

 <option value="373">Moldova (+373)</option> 

 <option value="377">Monaco (+377)</option> 

 <option value="976">Mongolia (+976)</option> 

 <option value="1664">Montserrat (+1664)</option> 

 <option value="212">Morocco (+212)</option> 

 <option value="258">Mozambique (+258)</option> 

 <option value="95">Myanmar (+95)</option> 

 <option value="264">Namibia (+264)</option> 

 <option value="674">Nauru (+674)</option> 

 <option value="977">Nepal (+977)</option> 

 <option value="31">Netherlands (+31)</option> 

 <option value="687">New Caledonia (+687)</option> 

 <option value="64">New Zealand (+64)</option> 

 <option value="505">Nicaragua (+505)</option> 

 <option value="227">Niger (+227)</option> 

 <option value="234">Nigeria (+234)</option> 

 <option value="683">Niue (+683)</option> 

 <option value="672">Norfolk Islands (+672)</option> 

 <option value="670">Northern Marianas (+670)</option> 

 <option value="47">Norway (+47)</option> 

 <option value="968">Oman (+968)</option> 

 <option value="92">Pakistan (+92)</option> 

 <option value="680">Palau (+680)</option> 

 <option value="507">Panama (+507)</option> 

 <option value="675">Papua New Guinea (+675)</option> 

 <option value="595">Paraguay (+595)</option> 

 <option value="51">Peru (+51)</option> 

 <option value="63">Philippines (+63)</option> 

 <option value="48">Poland (+48)</option> 

 <option value="351">Portugal (+351)</option> 

 <option value="1787">Puerto Rico (+1787)</option> 

 <option value="974">Qatar (+974)</option> 

 <option value="262">Reunion (+262)</option> 

 <option value="40">Romania (+40)</option> 

 <option value="7">Russia (+7)</option> 

 <option value="250">Rwanda (+250)</option> 

 <option value="378">San Marino (+378)</option> 

 <option value="239">Sao Tome &amp; Principe (+239)</option> 

 <option value="966">Saudi Arabia (+966)</option> 

 <option value="221">Senegal (+221)</option> 

 <option value="381">Serbia (+381)</option> 

 <option value="248">Seychelles (+248)</option> 

 <option value="232">Sierra Leone (+232)</option> 

 <option value="65">Singapore (+65)</option> 

 <option value="421">Slovak Republic (+421)</option> 

 <option value="386">Slovenia (+386)</option> 

 <option value="677">Solomon Islands (+677)</option> 

 <option value="252">Somalia (+252)</option> 

 <option value="27">South Africa (+27)</option> 

 <option value="34">Spain (+34)</option> 

 <option value="94">Sri Lanka (+94)</option> 

 <option value="290">St. Helena (+290)</option> 

 <option value="1869">St. Kitts (+1869)</option> 

 <option value="1758">St. Lucia (+1758)</option> 

 <option value="249">Sudan (+249)</option> 

 <option value="597">Suriname (+597)</option> 

 <option value="268">Swaziland (+268)</option> 

 <option value="46">Sweden (+46)</option> 

 <option value="41">Switzerland (+41)</option> 

 <option value="963">Syria (+963)</option> 

 <option value="886">Taiwan (+886)</option> 

 <option value="7">Tajikstan (+7)</option> 

 <option value="66">Thailand (+66)</option> 

 <option value="228">Togo (+228)</option> 

 <option value="676">Tonga (+676)</option> 

 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 

 <option value="216">Tunisia (+216)</option> 

 <option value="90">Turkey (+90)</option> 

 <option value="7">Turkmenistan (+7)</option> 

 <option value="993">Turkmenistan (+993)</option> 

 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 

 <option value="688">Tuvalu (+688)</option> 

 <option value="256">Uganda (+256)</option> 

 <option value="44" >UK (+44)</option> 

 <option value="380">Ukraine (+380)</option> 

 <option value="971" selected="selected">UAE (+971)</option> 

 <option value="598">Uruguay (+598)</option> 

 <option value="1">USA (+1)</option> 

 <option value="7">Uzbekistan (+7)</option> 

 <option value="678">Vanuatu (+678)</option> 

 <option value="379">Vatican City (+379)</option> 

 <option value="58">Venezuela (+58)</option> 

 <option value="84">Vietnam (+84)</option> 

 <option value="84">Virgin Islands - British (+1284)</option> 

 <option value="84">Virgin Islands - US (+1340)</option> 

 <option value="681">Wallis &amp; Futuna (+681)</option> 

 <option value="969">Yemen (North)(+969)</option> 

 <option value="967">Yemen (South)(+967)</option> 

 <option value="381">Yugoslavia (+381)</option> 

 <option value="243">Zaire (+243)</option> 

 <option value="260">Zambia (+260)</option> 

 <option value="263">Zimbabwe (+263)</option>

  </select>

                        </span>

                         <input type="text" id="4" class="ltrim form-control input-sm" placeholder="Mobile#">

                     </div>

                      

                  </div>

                </div>

                

                <div class="col-md-2">

                  <div class="form-group">

                      <!-- <label>First Name</label> -->

                      <input type="text" id="5" class="ltrim form-control input-sm" placeholder="Phone#">

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                      <!-- <label>First Name</label> -->

                      <input type="text" id="6" class="form-control input-sm" placeholder="Email Address">

                     

                  </div>

                </div>

                <div class="col-md-1">

                 <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

                   data-placement="bottom" data-content="As an agent, searching by the contact name will not provide you with email or mobile details of contacts not belonging to you. As a manager or an admin, you will be able to see complete details of the contacts, irrespective of the ownership.">

                   <i class="fa fa-info-circle"></i>

                   </a>

                   <a style="display:none;" id="reset_filter_landlord" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap-dark.png" title="Reset filter"></a>

                  <!-- <div class="form-group">

                      <label>First Name</label>

                      <input type="text" id="" class="form-control input-sm" placeholder="Email Address">

                  </div> -->

                </div>

                

              </div>

              

            

                <button type="button" id="search_landlord" class="btn btn-lg btn-primary"><i class="fa fa-search"></i> Search Contacts</button>

                <span> &nbsp; or &nbsp; </span>

                <button type="button" data-toggle="modal" data-target="#addnew_contact" id="add_new_contact" class="btn btn-lg btn-success"><i class="fa fa-plus-circle"></i> Add New Contact</button>

              <hr>

              <div class="row"  style="display: none;" id="listings_row_landlord_div">



                <div class="col-md-12">

                <table class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer" aria-describedby="dataTables-current-listing_info" id="listings_row_landlord">

                  <thead>

                  <tr>

                   						 <th>  </th>

                                        <th>First Name</th>

                                        <th>Last Name</th>

                                        <th>Country Code</th>

                                        <th>Mobile No</th>

                                        <th>Phone No</th>

                                        <th>Email</th>

                                        <th>Created By</th>

                                        <th>Assigned To</th>

                                        <th>Date Added</th>

                                       

                                        </thead>

                                        <tbody>

                                           

                                        </tbody>

                                </table>

                </div>

              </div>

              



              

            </div>

           </form>

            <script>

            function reloadLandlordContainer() {

				$('#myForm_landlord_search').each(function() {

					this.reset();

				});

				$("#search_landlord").trigger("click");

			}

           </script>

                    

            <!-- Tab content -->

            <div class="tab-content">

             <?php

		 $attributes = array('data-toggle' => 'validator', 'id' => 'myForm', 'role' => 'form');

	    echo form_open_multipart('leads/submit', $attributes);

        ?>

    

               <!--buttons starts-->

              <div class="selectedagentarea">

              <button style="display:none;" type="button" id="new" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>Add New Lead <span id="add_lead_button"></span></button>

              <span class="form-label-heading padding-10" style="margin-left:20px; color:#03C; font-weight:bold;" id="add_lead_landlord_name"></span>

				</div>

            <button  style="display:none;" type="submit" id="update"  class="btn btn-lg btn-success" name="Update" value="Update Listing">

            <i class="fa fa-plus-circle"></i> Save Lead</button>

             <button  style="display:none;" type="submit" id="Save"  class="btn btn-lg btn-success" name="Save" value="Save Listing">

            <i class="fa fa-plus-circle"></i> Save Lead</button>

       

                <button  style="display:none;" type="button" id="edit" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Lead</button>

            <a href="javascript:void(0)" id="cancel" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>

              <!--buttons ends-->

           

              

              <p class="inline-block" id="fresh_screen_msg">To add a new lead, select or add a contact using the form above.</p>

          

           

                <!--hidden fields-->

                               <input name="id" class="form-control" id="id" type="hidden" value="0" hidden>

                                <input name="client_id" class="form-control" style="display:none;" id="client_id"  value="<?php echo $client_id;?>" readonly>

                                <input name="rand_key" type="text" style="display:none;" id="rand_key" readonly value="" >

                                 <input name="landlord_id" class="form_fields" id="landlord_id" value="" style="display:none">

                               

                      

              <div class="row">



              <div class="col-lg-12">

              

              </div>

              </div>

            

            

            <div class="row"><h4 class="add_new_rental">Add New Lead</h4></div>

            

            

            <div class="row fadeInUp">



	            <div class="col-md-3">

	              <div class="form-group">

	                <label>Ref</label>

	              

                     <input name="ref" type="text" class="form-control input-sm" id="ref"  value="" tabindex="0" disabled="disabled" readonly>

	              </div>

	              <div class="form-group">

	                <label>Enquiry Date</label>

	                <!-- <div class='input-group date datepicker' id='datetimepicker1'>

                    <input type='text' class="form-control" id="date_of_enquiry" name="date_of_enquiry" />

                    <span class="input-group-addon">

                        <span class="glyphicon glyphicon-calendar"></span>

                    </span>

                </div> -->

                 <div class="input-group">

                            <input type="text" class="form-control input-sm datepicker"  id="date_of_enquiry" name="date_of_enquiry">

                            <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                            </div>

                            </div>
                  

	              </div>  



	              <div class="form-group">

	                    <label>Lead Type</label>

	                    <select id="type" name="type" class=" form-control required input-sm" required>

	                    <option value="" selected>Select</option>

                                        <option value="1">Tenant</option>

                                        <option value="2">Buyer</option>

                                        <option value="3">Landlord</option>

                                        <option value="4">Seller</option>

                                        <option value="5">Landlord+Seller</option>

                                        <option value="6">Not Specified</option>

	                    </select>

	              </div>

	              <div class="form-group">

	                    <label>Finance</label>

                        <span class="financial_situation_holder" style="display:none;">

                                    <select name="financial_situation" type="text" class="form-control" id="financial_situation"  tabindex="3">

                                        <option value="" selected>Select</option>

                                        <option value="Cash">Cash</option>

                                        <option value="Loan (approved)">Loan (approved)</option>

                                        <option value="Loan (not approved)">Loan (not approved)</option>

                                    </select>

                                </span>

	                    <input type="text" class="financial_situation_msg form-control input-sm" id="financebuy" readonly="readonly" disabled="disabled" placeholder="Only for buyer option" >

	              </div>

	              <div class="form-group">

	                    <label>Status</label>

	                    <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

	                   data-placement="top" data-content="You can now view the history of changes made to Lead Status and Sub-status in Notes pop-up window.">

	                   <i class="fa fa-info-circle"></i>

	                   </a>

	                    <select id="status" name="status" class=" form-control required input-sm" required>

	                     <option value="1" >Open</option>

                           <option value="2" >Closed</option>

                           <option value="3" selected>Not Specified</option>

	                    </select>

	              </div>

	              <div class="form-group">

	                    <label>Sub-Status</label>

	                    <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

	                   data-placement="top" data-content="You can now view the history of changes made to Lead Status and Sub-status in Notes pop-up window.">

	                   <i class="fa fa-info-circle"></i>

	                   </a>

	                    <select name="sub_status" id="sub_status" class=" form-control required input-sm" required>

	                    <option value="4" >Not yet contacted</option>

                                        <option value="5" >Called no reply</option>

                                        <option value="6" >Follow up</option>

                                        <option value="10">Needs more info</option>

                                        <option value="9" >Offer Made</option>

                                        <option value="7" >Viewing arranged</option>

                                        <option value="17">Look-see</option>

                                        <option value="11">Budget differs</option>

                                        <option value="12">Needs time</option>

                                        <option value="13">Client to revert</option>

                                        <option value="14">Interested</option>

                                        <option value="15">Interested to Meet</option>

                                        <option value="2" >Successful</option>

                                        <option value="1" >In progress</option>

                                        <option value="3" >Unsuccessful</option>

                                        <option value="16">Not Interested</option>

                                        <option value="8" selected>Not Specified</option>

	                    </select>

	              </div>

	              <div class="form-group">

	                    <label>Priority</label>

	                    <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

	                   data-placement="top" data-content="Use this field to rate the urgency of the response time for this lead.

                                     <br>

                                     For example an urgent lead is a lead that typically needs a response ASAP.">

	                   <i class="fa fa-info-circle"></i>

	                   </a>

	                    <select name="lead_priority" id="lead_priority" class=" form-control required input-sm" required>

	                     <option value="urgent" class="redText">Urgent</option>

                                    <option value="high" >High</option>

                                    <option value="low">Low</option>

                                    <option value="normal" selected>Normal</option>

	                    </select>

	              </div>



	            </div>

	            

	            

	            <div class="col-md-3">

	              <div class="form-group">

	                    <label>Name</label>

	                    <input type="text" class="form-control input-sm" id="landlord_name" name="landlord_name">

                        <input type="hidden" id="last_name" name="last_name" value="" />

                        <input type="hidden" id="first_name" name="first_name" value="" />

	              </div>

	              <div class="form-group">

	                    <label>Mobile No</label>

	                    <input type="text" class="form-control input-sm" id="landlord_mobile" name="landlord_mobile">

	              </div>

	              <div class="form-group">

	                    <label>Email</label>

	                    <input type="text" class="form-control input-sm" id="landlord_email" name="landlord_email">

	              </div>

	              <div class="form-group">

	                    <label>Created by</label>

	                    <input type="text" class="form-control input-sm" id="assigned_by_name" name="assigned_by_name" value="<?php echo $user_fullname;?>">

	              </div>

	              <div class="form-group">

	                    <label>Agent 1</label>

	                    <div class="input-group">                  

	                    <select name="agent_id" id="agent_id" class=" form-control required input-sm" required>

	                    

	                      

	                    </select>

	                    <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#other_agentsmodal"><i class="fa fa-plus-circle"></i></a></span>

	                </div>

	                    

	              </div>

	              <div class="form-group">

	                    <label>Source</label>

	                   <select name="source_of_lead" type="text"  class="form-control input-sm required" id="source_of_lead" tabindex="11">

                                    <option value="" selected>Select</option>

                                <option value=" Not Specified" > Not Specified</option><option value="7 days" >7 days</option><option value="Abu Dhabi week" >Abu Dhabi week</option><option value="Agent" >Agent</option><option value="Agent External" >Agent External</option><option value="Agent Internal" >Agent Internal</option><option value="Al Ayam" >Al Ayam</option><option value="Al Bayan" >Al Bayan</option><option value="Al Futtaim" >Al Futtaim</option><option value="Al Ittihad News paper" >Al Ittihad News paper</option><option value="Al Khaleej" >Al Khaleej</option><option value="Al Rai" >Al Rai</option><option value="AL Watan" >AL Watan</option><option value="Arab Times" >Arab Times</option><option value="Asharq Al Awsat" >Asharq Al Awsat</option><option value="Bank Referral" >Bank Referral</option><option value="Bayut.com" >Bayut.com</option><option value="Blackberry SMS" >Blackberry SMS</option><option value="Business card" >Business card</option><option value="Client Referral" >Client Referral</option><option value="Cold call" >Cold call</option><option value="Colours TV" >Colours TV</option><option value="Database" >Database</option><option value="Developer" >Developer</option><option value="Direct call" >Direct call</option><option value="Direct Client" >Direct Client</option><option value="Drive around" >Drive around</option><option value="Dubizzle Feature" >Dubizzle Feature</option><option value="Dubizzle.com" >Dubizzle.com</option><option value="Dzooom.com" >Dzooom.com</option><option value="Email campaign" >Email campaign</option><option value="Ertebat" >Ertebat</option><option value="Exhibition Stand" >Exhibition Stand</option><option value="Existing client" >Existing client</option><option value="EzEstate" >EzEstate</option><option value="EzHeights.com" >EzHeights.com</option><option value="Facebook" >Facebook</option><option value="Flyers" >Flyers</option><option value="Forbes Mailer" >Forbes Mailer</option><option value="Friend or Relative" >Friend or Relative</option><option value="Google " >Google </option><option value="Gulf Daily News" >Gulf Daily News</option><option value="Gulf News" >Gulf News</option><option value="Gulf News Mailer" >Gulf News Mailer</option><option value="Gulf Newspaper Freehold" >Gulf Newspaper Freehold</option><option value="Gulf Newspaper Residential" >Gulf Newspaper Residential</option><option value="Gulf Times" >Gulf Times</option><option value="Gulfnews Freehold" >Gulfnews Freehold</option><option value="Gulfpropertyportal.com" >Gulfpropertyportal.com</option><option value="Instagram" >Instagram</option><option value="JustProperty.com" >JustProperty.com</option><option value="JustRentals.com" >JustRentals.com</option><option value="JUWAI" >JUWAI</option><option value="Khaleej Times" >Khaleej Times</option><option value="LinkedIn" >LinkedIn</option><option value="Listanza" >Listanza</option><option value="Luxury Estate.com" >Luxury Estate.com</option><option value="Luxury Square Foot" >Luxury Square Foot</option><option value="Magazine" >Magazine</option><option value="Memaar TV" >Memaar TV</option><option value="MoneyCamel.com" >MoneyCamel.com</option><option value="National News paper" >National News paper</option><option value="Newsletter" >Newsletter</option><option value="Newspaper advert" >Newspaper advert</option><option value="Old Landlord" >Old Landlord</option><option value="Online Banners" >Online Banners</option><option value="Open House" >Open House</option><option value="Other" >Other</option><option value="Other portal" >Other portal</option><option value="Outdoor Media" >Outdoor Media</option><option value="Personal Referral" >Personal Referral</option><option value="Property Acquisition Department" >Property Acquisition Department</option><option value="Property Finder Premium" >Property Finder Premium</option><option value="Property Inc." >Property Inc.</option><option value="Property Management" >Property Management</option><option value="Property Trader" >Property Trader</option><option value="Property Weekly" >Property Weekly</option><option value="Propertyfinder.ae" >Propertyfinder.ae</option><option value="Propertyonline" >Propertyonline</option><option value="Propertywifi.com" >Propertywifi.com</option><option value="PropSpace MLS" >PropSpace MLS</option><option value="Radio" >Radio</option><option value="Radio Advert" >Radio Advert</option><option value="Referral within company" >Referral within company</option><option value="Relocation" >Relocation</option><option value="Rightmove.co.uk" >Rightmove.co.uk</option><option value="Roadshow" >Roadshow</option><option value="Sandcastles.ae" >Sandcastles.ae</option><option value="School Communicator" >School Communicator</option><option value="School Communicator" >School Communicator</option><option value="Search Engine" >Search Engine</option><option value="Signboard" >Signboard</option><option value="SMS campaign" >SMS campaign</option><option value="Social media Campaign" >Social media Campaign</option><option value="Souq.com" >Souq.com</option><option value="Staff Mailer" >Staff Mailer</option><option value="Twitter " >Twitter </option><option value="Walk-in" >Walk-in</option><option value="Website" >Website</option><option value="Whatpricemyhome" >Whatpricemyhome</option><option value="Whatsapp" >Whatsapp</option><option value="Word of Mouth" >Word of Mouth</option><option value="www.propertyportal.ae" >www.propertyportal.ae</option><option value="Youtube" >Youtube</option><option value="Zawya Mailer" >Zawya Mailer</option><option value="Zoopla" >Zoopla</option>                                </select>

                                 <input style="display:none;" type="text" class="form-control input-sm" name="other_source_of_lead" id="other_source_of_lead" placeholder="Specify Other Source">

	              </div>

	              <div class="form-group">

	                    <label>Hot Lead</label>

	                    <div class="">

	                      <input type="checkbox" name="hot_lead" id="hot_lead" value="1"/>

	                      <span class="lbl padding"> <i class="fa fa-certificate text-dange"></i></span>

	                    </div>

	              </div>

	            </div>

	            

	            <div class="col-md-6">

	               <div class="form-group form-propreq">

	               		<h5 class="text-primary">Property Requirment

<a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

	                   data-placement="top" data-content="Multiple property requirements can be added against a lead. For example, when a buyer has given two different locations (e.g. Springs or Ranches) they would buy in, both areas can be recorded as seperate requirements.">

	                   <i class="fa fa-info-circle"></i>

	                   </a>

	               		</h5>

	                    

	                    

	                      <div class="row">

	                      <div class="col-md-4">

	                    <input type="hidden"   name="lead_by_agent" id="lead_by_agent_hidden" value="no" tabindex="12">

                            				<input type="checkbox" name="lead_by_agent" id="lead_by_agent" value="1" tabindex="12" >

	                      <span class="lbl padding"> Agent Referral</span>

	                      <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

	                   data-placement="top" data-content="Enter the built-up area of the listing here in Sq Ft. To change the default measuring unit across all listings, request your manager to do so in the Admin > Profile page.">

	                   <i class="fa fa-info-circle"></i>

	                   </a>

	                      </div>

	                      <div class="col-md-6">

	                     <input type="hidden"   name="shared" id="shared_hidden" value="no"  tabindex="13">

                            				<input type="checkbox" name="shared" id="shared" value="1"  tabindex="13">

	                      <span class="lbl padding"> Share this lead</span>

	                      <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

	                   data-placement="top" data-content="Select this field if you would like this lead to be shared with other external companies using PropSpace via the Invite Screen. This lead's requirements will be made available to other companies your company is already sharing with on the Invite Screen.

                                     <br><br>

                                     The name and contact details of the lead will not be visible, just the lead's requirements.

                                     <br><br>

                                     <b>Note: </b>

                                      Only buyer or tenant leads can be shared.">

	                   <i class="fa fa-info-circle"></i>

	                   </a>

	                      </div>

	                      

	                    </div>

	                    

	                </div>

	              

	             	<div class="row">

	                  <div class="col-md-8">

	                        <div class="form-group">

	                        <label>Property 1</label>

	                        <div class="input-group">

	                          <span class="input-group-addon"><a class="popup_a" id="property-1-popup" popup_id='1' rel="property_requirements_popup" href="#" data-toggle="modal" data-target="#propmanage_modal"><i class="fa fa-plus-circle"></i></a></span>

	                         

                              <input name="property_req_1" type="text" style="display:none;" class="form_fields" id="property_req_1" value="">

	                          <input name="property_req_1_data" type="text" class="form-control input-sm" id="property_req_1_data" value="" readonly tabindex="14">

	                    </div>

	                    </div>

	                  </div>

	                  <div class="col-md-4">

	                    <div class="form-group">

	                        <label>Ref</label>

	                        <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

	                   data-placement="top" data-content="If the customer has required for a specific property i.e. through a portal, you can find the property here and the details will be automatically populated.">

	                   <i class="fa fa-info-circle"></i>

	                   </a>

	                        <div class="input-group">

	                          <span class="input-group-addon"><a class="popup_a" href="#"id='ref-1-popup' rel='view_linktolistings_leads_popup' listing_popup_id="1" data-toggle="modal" data-target="#ref_modal"><i class="fa fa-plus-circle"></i></a></span>

	                          <input name="listing_id_1_ref" type="text" class="form-control input-sm" id="listing_id_1_ref" value="" readonly tabindex="15">

	                          <input name="listing_id_1" type="text" style="display:none;" class="form-control input-sm" id="listing_id_1" value="" >

	                    </div>

	                    </div>

	                  </div>

	                </div>

	                <div class="row">

	                  <div class="col-md-8">

	                        <div class="form-group">

	                        <label>Property 2</label>

	                        <div class="input-group">

	                          <span class="input-group-addon"><a class="popup_a"  rel="property_requirements_popup"  popup_id='2' id="property-2-popup"  href="#" data-toggle="modal" data-target="#propmanage_modal"><i class="fa fa-plus-circle"></i></a></span>

	                          <input name="property_req_2" type="text" style="display:none;" class="form_fields input-sm" id="property_req_2" value="">

	                           <input name="property_req_2_data" type="text" class="form-control input-sm" id="property_req_2_data" value="" readonly tabindex="16">

	                    </div>

	                    </div>

	                  </div>

	                  <div class="col-md-4">

	                    <div class="form-group">

	                        <label>Ref</label>

	                        <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

	                   data-placement="top" data-content="If the customer has required for a specific property i.e. through a portal, you can find the property here and the details will be automatically populated.">

	                   <i class="fa fa-info-circle"></i>

	                   </a>

	                        <div class="input-group">

	                          <span class="input-group-addon"><a href="" class="popup_a"  rel='view_linktolistings_leads_popup' listing_popup_id="2"  id='ref-2-popup'   data-toggle="modal" data-target="#ref_modal"><i class="fa fa-plus-circle"></i></a></span>

	                       

                              <input name="listing_id_2_ref" type="text" class="form-control input-sm" id="listing_id_2_ref" value="" tabindex="17" readonly>

	                               	 	<input name="listing_id_2" type="text" style="display:none;" class="form-control input-sm" id="listing_id_2" value="">

	                    </div>

	                    </div>

	                  </div>

	                </div>

	                <div class="row">

	                  <div class="col-md-8">

	                        <div class="form-group">

	                        <label>Property 3</label>

	                        <div class="input-group">

	                          <span class="input-group-addon"><a class="popup_a" href="" rel="property_requirements_popup"  id="property-3-popup"  popup_id='3' data-toggle="modal" data-target="#propmanage_modal"><i class="fa fa-plus-circle"></i></a></span>

	                    

                              <input name="property_req_3" type="text" style="display:none;" class="form_fields input-sm" id="property_req_3" value="">

	                                	<input name="property_req_3_data" type="text" class="form-control input-sm" id="property_req_3_data" tabindex="18" value="" readonly>

	                    </div>

	                    </div>

	                  </div>

	                  <div class="col-md-4">

	                    <div class="form-group">

	                        <label>Ref</label>

	                        <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

	                   data-placement="top" data-content="If the customer has required for a specific property i.e. through a portal, you can find the property here and the details will be automatically populated.">

	                   <i class="fa fa-info-circle"></i>

	                   </a>

	                        <div class="input-group">

	                          <span class="input-group-addon"><a class="popup_a" id='ref-3-popup' rel='view_linktolistings_leads_popup'  listing_popup_id="3" data-toggle="modal" data-target="#ref_modal"><i class="fa fa-plus-circle"></i></a></span>

	                         

                              <input name="listing_id_3_ref" type="text" class="form-control input-sm" tabindex="19" id="listing_id_3_ref" value="" readonly>

	                               	 	<input name="listing_id_3" type="text" style="display:none;" class="form-control input-sm" id="listing_id_3" value="">

	                    </div>

	                    </div>

	                  </div>

	                </div>

	                <div class="row">

	                  <div class="col-md-8">

	                        <div class="form-group">

	                        <label>Property 4</label>

	                        <div class="input-group">

	                          <span class="input-group-addon"><a class="popup_a" rel="property_requirements_popup"  id="property-4-popup"  popup_id='4' data-toggle="modal" data-target="#propmanage_modal"><i class="fa fa-plus-circle"></i></a></span>

	                         

                              <input name="property_req_4" type="text" style="display:none;" class="form_fields input-sm" id="property_req_4" value="">

	                         <input name="property_req_4_data" type="text" class="form-control input-sm" id="property_req_4_data" tabindex="20" value="" readonly>

	                    </div>

	                    </div>

	                  </div>

	                  <div class="col-md-4">

	                    <div class="form-group">

	                        <label>Ref</label>

	                        <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

	                   data-placement="top" data-content="If the customer has required for a specific property i.e. through a portal, you can find the property here and the details will be automatically populated.">

	                   <i class="fa fa-info-circle"></i>

	                   </a>

	                        <div class="input-group">

	                          <span class="input-group-addon"><a class="popup_a" id='ref-4-popup' rel='view_linktolistings_leads_popup' listing_popup_id="4" data-toggle="modal" data-target="#ref_modal"><i class="fa fa-plus-circle"></i></a></span>

	                         

                              <input name="listing_id_4_ref" type="text" class="form-control input-sm" id="listing_id_4_ref"  tabindex="21" value="" readonly>

	                          <input name="listing_id_4" type="text" style="display:none;" class="form-control input-sm" id="listing_id_4" value="">

	                    </div>

	                    </div>

	                  </div>

	                </div>

	                <div class="row">

	                  <div class="col-md-6">

	                        <div class="form-group">

	                        <label>Reminders</label>

	                        <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 

	                   data-placement="top" data-content="Use these fields to set up to 2 reminders to call your leads back. 

                                            If set, you will receive a system reminder email on the date and time 

                                            specified to remind you to call your lead back.">

	                   <i class="fa fa-info-circle"></i>

	                   </a>

                       

                       <div class="input-group">

                        <input type="text" class="form-control input-sm datetimepicker" id="leads_reminder_one" name="leads_reminder_one">

                        <div class="input-group-addon">

                        <i class="fa fa-calendar-plus-o"></i>

                        </div>

                        </div>

                       

                       

	                        

	                    </div>

	                  </div>

	                  <div class="col-md-6">

	                    <div class="form-group">

	                        <label>&nbsp;</label>

	                        

	                        <div class="input-group">

	                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#portals">2nd</a></span>

	                          <input type="text" class="form-control input-sm datetimepicker" id="leads_reminder_two" name="leads_reminder_two">

	                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#photos"><i class="fa fa-calendar-plus-o"></i></a></span>

	                    </div>

	                    </div>

	                  </div>

	                </div>

	                <div class="row">

	                  <div class="col-md-8">

	                        <div class="form-group">

	                        <label>Notes</label>

	                        

	                        <div class="input-group">

	                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#noteslshis_modal"><i class="fa fa-plus-circle"></i></a></span>

	                          <input type="text" class="form-control input-sm" id="notesx" name="notesx">



	                    </div>

	                    </div>

	                  </div>

	                  <div class="col-md-4">

	                    <div class="form-group">

	                        <label>&nbsp;</label>

	                        

	                        <!-- <div class="input-group">

	                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#portals"><i class="fa fa-plus-circle"></i></a></span>

	                          <input type="text" class="form-control input-sm">

	                    </div> -->

	                    </div>

	                  </div>

	                </div>

	               

	               

	                

	            </div>

            

            </div>



            <!-- </div> -->

            <!--popups starts from here-->

             <!-- Agent Modal -->

            <div class="modal fade" id="other_agentsmodal" tabindex="-1" >

              <div class="modal-dialog">

                <div class="modal-content ">

                

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Other Agents</h4>

                  </div>

                  

                  <div class="modal-body">

                  <div class="row">

                     <div class="col-md-10 col-md-offset-1">

                      <div class="form-group">

                        <label>Agent 2</label>

                        <div class="input-group">

                         <select name="agent_id_2" class="form-control input-sm" id="agent_id_2">

	                                  

	                                	                                </select>

                          <span class="input-group-addon">

                           <a id="remove_agent" agent="2" href="# remove"><i class="fa fa-times-circle" title="Remove agent"></i></a></span>

                        </div>

                      </div>

                      <div class="form-group">

                        <label>Agent 3</label>

                        <div class="input-group">

                         <select name="agent_id_3" class="form-control input-sm" id="agent_id_3">

                                    

                                                             </select>

                          <span class="input-group-addon">

                          <a id="remove_agent" agent="3"  href="# remove" title="Remove agent"><i title="Remove agent" class="fa fa-times-circle"></i></a></span>

                        </div>

                      </div>

                      <div class="form-group">

                        <label>Agent 4</label>

                        <div class="input-group">

                          <select name="agent_id_4" class="form-control" id="agent_id_4">

                                  

                                                           </select>

                          <span class="input-group-addon"><a id="remove_agent" agent="4" href="# remove"><i class="fa fa-times-circle" title="Remove agent"></i></a></span>

                        </div>

                      </div>

                      <div class="form-group">

                        <label>Agent 5</label>

                        <div class="input-group">

                          <select name="agent_id_5" class="form-control" id="agent_id_5">

                                    

                                                            </select>

                          <span class="input-group-addon"><a id="remove_agent" agent="5" href="# remove" ><i class="fa fa-times-circle" title="Remove agent"></i></a></span>

                        </div>

                      </div>  

                      

                      

                    </div>

                    

                  </div>

                  </div>

                  <div class="modal-footer">

                    <button class="btn btn-success" data-dismiss="modal">Save & Close</button>

                  </div>

                  </div>

                </div>

              </div>

              <!-- Notes & Lead Status History Modal -->

            <div class="modal fade" id="noteslshis_modal" tabindex="-1" >

              <div class="modal-dialog">

                <div class="modal-content ">

                

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Notes & Lead Status History</h4>

                  </div>

                  

                  <div class="modal-body">

                    <div class="inner_tab_nav">

                        <ul class="nav nav-tabs">

                          <li  class="active"><a href="#notes" data-toggle="tab">Notes</a></li>

                          <li><a href="#lshistory" data-toggle="tab">Lead Status History</a></li>

                        </ul>

                    </div>

                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="notes">

                          <div class="form-group">

                            <label>Note </label>

                            <textarea cols="2" class="form-control" id="notes" name="notes"></textarea>

                          </div>

                          <table class="table">

                            <thead>

                              <tr>

                                <th>Previous Notes</th>

                              </tr>

                            </thead>

                            <tbody>

                              <tr>

                                <td><div style="width:100%; border: 1px solid #D3D3D3; margin-bottom:10px;" id="shownotes">No note found</div></td>

                              </tr>

                            </tbody>

                          </table>

                        </div>

                        <div class="tab-pane fade in" id="lshistory">

                          <table class="table">

                            <thead>

                              <tr>

                                <th>History</th>

                              </tr>

                            </thead>

                            <tbody>

                              <tr>

                                <td><div style="height: 197px; overflow-y: scroll; padding:5px" id="showleadshistory" >No history found </div> </td>

                              </tr>

                            </tbody>

                          </table>

                        </div>

                    </div>

                  </div>

                  <div class="modal-footer">

                    <button class="btn btn-success" data-dismiss="modal">Save</button>

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

            

            <div class="tab-content datatable-Scrolltab">

            <div  class="tab-pane fade in active" id="current_listing">

            <div class="listing_nav">

            <div class="row">

            <div class="col-md-8">

            <ul class="list-inline listing_action_nav">

	            <li class="dropdown">

                

                

                

                

	            <a href="javascript:void(0);" id="share_options" class="dropdown-toggle click" data-toggle="dropdown"><i class="fa fa-share-alt"></i> Share Options</a>

                <span class="caret"></span>

	              <ul class="dropdown-menu">

	                <li id="datashare_options_default" keyAccess="true"><a href="#" data-target="#share_excel_all" data-toggle="modal" id= "sms_verification_popup_all" rel="sms_verification_all" class="popup_a"> <input type="hidden" id="access" value="true">

                    <i class="fa fa-file-excel-o"></i> Download all lead(s) as Excel table</a></li>

	 				<li><a href="#" data-target="#share_excel_selected" data-toggle="modal" id= "sms_verification_popup_all" rel="sms_verification_all" class="popup_a"><i class="fa fa-file-excel-o"></i> 

                    Download selected lead(s) as Excel table</a></li>

	                

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

            	<!--<li><a href="" data-toggle="modal" data-target="#bulk_update"><i class="fa fa-list-ul"></i> Bulk Update</a></li>-->

            </ul>

            </div>

            <div class="col-md-4">

                <ul class="list-inline pull-right">

                <li class="dropdown"> 

               <!--  <a href="" class="dropdown-toggle btn btn-success" data-toggle="dropdown">Action <i class="fa fa-chevron-down"></i></a> -->

                  <ul class="dropdown-menu">

                    <li><a href="#" data-toggle="modal" data-target="#add_todo">Add To-Do</a></li>

                    <li><a href="#" data-toggle="modal" data-target="#add_event">Add Event</a></li>

                    <li><a href="#" data-toggle="modal" data-target="#add_leads">Deal</a></li>

                    <li><a href="#" data-toggle="modal" data-target="#add_contracts">Add Listing</a></li>

                 

              

                </ul>

                </li>

            

                <li class="dropdown"> 

               <!--  <a href="" class="dropdown-toggle btn btn-success" data-toggle="dropdown">Views <i class="fa fa-chevron-down"></i></a> -->

                  <ul class="dropdown-menu">

                    <li><a href="#" data-toggle="modal" data-target="#view_todo">Matches <span class="badge">0</span></a></li>

                    <li><a href="#" data-toggle="modal" data-target="#view_event">Events <span class="badge">0</span></a></li>

                    <li><a href="#" data-toggle="modal" data-target="#view_leads">To-Do <span class="badge">0</span></a></li>

                  

                </ul>

                </li>

                <li> <a href="" class="btn btn-success" data-toggle="modal" data-target="#columns">Columns <i class="fa fa-chevron-down"></i></a></li>

              </ul>

            </div>

            <!-- i am select something -->

            <div class="gist-selmsg collapse" id="checkbox_error">

	  			<a id="error_close" data-toggle="collapse" href="#openSelsome" aria-expanded="false" aria-controls="openSelsome" role="button" class="close-selsomething"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>

	    		<img src="<?php echo base_url(); ?>images/select.png">

			</div>

            </div>

            </div>

           

            <div class="row">

            	<!-- Data table come here -->  

              <table class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer" aria-describedby="dataTables-current-listing_info" id="listings_row">

            <thead class="listing_headings">

            <th style="text-align:center;">

                <label class="">

                        <input onClick="toggleChecked(this.checked)" id='check_all_checkboxes' value='' type="checkbox"/>

                        <span class="lbl"></span>

                    </label>

                <input type="hidden" id="filter_lead_notification" name="filter_lead_notification" />

            </th>

            <th style="width:5px !important;"><div style="cursor:pointer; display:none;" title="Click here to sort">auto</div></th>

            <th style="min-width:80px !important;">Ref</th>

            <th>Type</th>

            <th>Status</th>

            <th>Sub-Status</th>

            <th>Priority</th>

            <th title="Hot Lead"><div style="cursor:pointer; display:none;">Hot Lead</div><span>Hot</span></th>

            <th>First Name</th>

            <th>Last Name</th>

            <th>Mobile</th>

            <th>Category</th>

            <th>Emirate</th>

            <th>Location</th>

            <th>Sub-Location</th>

            <th type="not_default">Unit Type</th>

            <th type="not_default">Unit No</th>

            <th type="not_default">Min Beds</th>

            <th type="not_default">Max Beds</th>

            <th type="not_default">Min Price</th>

            <th type="not_default">Max Price</th>

            <th type="not_default">Min Area</th>

            <th type="not_default">Max Area</th>

            <th type="not_default">Listing Ref</th>

            <th>Source</th>

            <th>Agent 1</th>

            <th type="not_default">Agent 2</th>

            <th type="not_default">Agent 3</th>

            <th type="not_default">Agent 4</th>

            <th type="not_default">Agent 5</th>

            <th type="not_default">Created By</th>

            <th type="not_default">Finance</th>

            <th width="80"><div>Enquiry Date</div></th>

            <th width="40"><div>Updated</div></th>

            <th type="not_default" style="width:5px !important;"><div style="cursor:pointer; display:none;">Agent Referral</div><span>A</span></th>

            <th style="width:5px !important;"><div style="cursor:pointer; display:none;">Shared Lead</div><span>S</span></th> 

            <th type="not_default">Contact Company</th>

            <th width="5"><div style="min-width:15px !important;"></div></th>

            </thead>

            <thead id="searchbox1" class="search_box">

                <tr height="40px" class="highlighted">

            <form id="myForm2">

                <td style="text-align:center;"><a style="display:none;" id="reset_filter1" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png?ts=10" title="Reset filter"></a></td>

               

               

               

               

                <td class="dropdown">

               <a href="" id="_datamouh" class="dropdown-toggle click" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                     <div class='dropdown-menu data emirate_search' id="data_datamouh" style=""> 

                        <span id_search='1' value="0" image="<?php echo base_url();?>mydata/images/header_autox.png" class='sorting'>

                        <a href=""><img src="<?php echo base_url();?>mydata/images/header_autox.png" title="Not Imported"></a></span><br>

                        <span id_search='1' value="1" image="<?php echo base_url();?>mydata/images/header_auto.png" class='sorting'>

                       <a href="">  <img src="<?php echo base_url();?>mydata/images/header_auto.png" title="auto Imported"></a></span> 

                    </div>

                    

                </td>

                    <td><input id='2' type="text" class="search_init 2 form-control input-sm"  value=" Min 3 chars"  /></td>

              <td><select id='3' type="text"  class="search_init 3 form-control input-sm">

                        <option value="" selected>Select</option>

                        <option value="1">Tenant</option>

                        <option value="2">Buyer</option>

                        <option value="3">Landlord</option>

                        <option value="4">Seller</option>

                        <option value="5">Landlord+Seller</option>

                        <option value="6">Not Specified</option>

                    </select></td>

                <td><select  id='4' type="text"  class="search_init 4 form-control input-sm">

                        <option value="" selected>Select</option>

                        <option value="1">Open</option>

                        <option value="2">Closed</option>

                        <option value="3">Not Specified</option>

                    </select></td>

                <td><select id='5' type="text"  class="search_init sub_status_search 5 form-control input-sm">

                        <option value="" selected>Select</option>

                        <option value="4" >Not yet contacted</option>

                        <option value="5" >Called no reply</option>

                        <option value="6" >Follow up</option>

                        <option value="10">Needs more info</option>

                        <option value="9" >Offer Made</option>

                        <option value="7" >Viewing arranged</option>

                        <option value="17">Look-see</option>

                        <option value="11">Budget differs</option>

                        <option value="12">Needs time</option>

                        <option value="13">Client to revert</option>

                        <option value="14">Interested</option>

                        <option value="15">Interested to Meet</option>

                        <option value="2" >Successful</option>

                        <option value="1" >In progress</option>

                        <option value="3" >Unsuccessful</option>

                        <option value="16">Not Interested</option>

                        <option value="8" >Not Specified</option>

                    </select></td>

                <td><select id='6' type="text"  class="search_init 7 form-control input-sm">

                        <option value="" selected>Select</option>

                        <option value="urgent">Urgent</option>

                        <option value="high" >High</option>

                        <option value="low" >Low</option>

                        <option value="normal" >Normal</option>

                    </select></td>

                    

                    

                    

                    

                <td class="dropdown">

                    <a href="" id="_datahot" class='dropdown-toggle click' data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                    <div class='dropdown-menu data emirate_search' id="data_datahot" >

                        <span id_search='7' value="0" class='sorting'><a href=""><img src="<?php echo base_url();?>mydata/images/hotleadx.png?ts=10" title="Not Hot Lead"></a></span> 

                        <span id_search='7' value="1" class='sorting'><a href=""><img src="<?php echo base_url();?>mydata/images/hotlead.png?ts=10" title="Hot Lead"></a></span>

                    </div>

                </td>

                <td><input id='8' type="text" class="search_init 8 form-control input-sm" value=" Min 3 chars" /></td>

                <td><input id='9' type="text" class="search_init 9 form-control input-sm"  value=" Min 3 chars" /></td>

                <td><input id='10' type="text" class="search_init 10 form-control input-sm" /></td>

                <td>

                    <select id='11' class="search_init 11 form-control input-sm"  >

                        <option selected>Select</option>

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

                                                </select>

                </td>

                <td><select id='12' class="search_init search_region_id 12 form-control input-sm" >

                        <option value="" selected>Select</option>

                                                    <option value="2">Abu Dhabi</option>

                            <option value="4">Ajman</option>

                            <option value="8">Al Ain</option>

                            <option value="1">Dubai</option>

                            <option value="7">Fujairah</option>

                            <option value="6">Ras Al Khaimah</option>

                            <option value="3">Sharjah</option>

                            <option value="5">Umm Al Quwain</option>

                    </select>

                </td>

                <td><input id='13' type="text" class="search_init 13 form-control input-sm" value=" Min 3 chars" /></td>

                <td><input id='14' type="text" class="search_init 14 form-control input-sm" /></td>

                <td><input id='15' type="text" class="search_init 15 form-control input-sm" /></td>

                <td><input id='16' type="text" class="search_init 16 form-control input-sm" /></td>

                <td><input id='17' type="text" class="search_init 17 form-control input-sm" /></td>

                <td><input id='18' type="text" class="search_init 18 form-control input-sm" /></td>

                <td><input id='19' type="text" class="search_init 19 form-control input-sm" /></td>

                <td><input id='20' type="text" class="search_init 20 form-control input-sm" /></td>

                <td><input id='21' type="text" class="search_init 21 form-control input-sm" /></td>

                <td><input id='22' type="text" class="search_init 22 form-control input-sm" /></td>

                <td><input id='23' type="text" class="search_init 23 form-control input-sm" /></td>

                <td><select id='24' type="text"  class="search_init 24 form-control input-sm">

                        <option value="" selected>Select</option>

<option value=" Not Specified" > Not Specified</option><option value="7 days" >7 days</option><option value="Abu Dhabi week" >Abu Dhabi week</option><option value="Agent" >Agent</option><option value="Agent External" >Agent External</option><option value="Agent Internal" >Agent Internal</option><option value="Al Ayam" >Al Ayam</option><option value="Al Bayan" >Al Bayan</option><option value="Al Futtaim" >Al Futtaim</option><option value="Al Ittihad News paper" >Al Ittihad News paper</option><option value="Al Khaleej" >Al Khaleej</option><option value="Al Rai" >Al Rai</option><option value="AL Watan" >AL Watan</option><option value="Arab Times" >Arab Times</option><option value="Asharq Al Awsat" >Asharq Al Awsat</option><option value="Bank Referral" >Bank Referral</option><option value="Bayut.com" >Bayut.com</option><option value="Blackberry SMS" >Blackberry SMS</option><option value="Business card" >Business card</option><option value="Client Referral" >Client Referral</option><option value="Cold call" >Cold call</option><option value="Colours TV" >Colours TV</option><option value="Database" >Database</option><option value="Developer" >Developer</option><option value="Direct call" >Direct call</option><option value="Direct Client" >Direct Client</option><option value="Drive around" >Drive around</option><option value="Dubizzle Feature" >Dubizzle Feature</option><option value="Dubizzle.com" >Dubizzle.com</option><option value="Dzooom.com" >Dzooom.com</option><option value="Email campaign" >Email campaign</option><option value="Ertebat" >Ertebat</option><option value="Exhibition Stand" >Exhibition Stand</option><option value="Existing client" >Existing client</option><option value="EzEstate" >EzEstate</option><option value="EzHeights.com" >EzHeights.com</option><option value="Facebook" >Facebook</option><option value="Flyers" >Flyers</option><option value="Forbes Mailer" >Forbes Mailer</option><option value="Friend or Relative" >Friend or Relative</option><option value="Google " >Google </option><option value="Gulf Daily News" >Gulf Daily News</option><option value="Gulf News" >Gulf News</option><option value="Gulf News Mailer" >Gulf News Mailer</option><option value="Gulf Newspaper Freehold" >Gulf Newspaper Freehold</option><option value="Gulf Newspaper Residential" >Gulf Newspaper Residential</option><option value="Gulf Times" >Gulf Times</option><option value="Gulfnews Freehold" >Gulfnews Freehold</option><option value="Gulfpropertyportal.com" >Gulfpropertyportal.com</option><option value="Instagram" >Instagram</option><option value="JustProperty.com" >JustProperty.com</option><option value="JustRentals.com" >JustRentals.com</option><option value="JUWAI" >JUWAI</option><option value="Khaleej Times" >Khaleej Times</option><option value="LinkedIn" >LinkedIn</option><option value="Listanza" >Listanza</option><option value="Luxury Estate.com" >Luxury Estate.com</option><option value="Luxury Square Foot" >Luxury Square Foot</option><option value="Magazine" >Magazine</option><option value="Memaar TV" >Memaar TV</option><option value="MoneyCamel.com" >MoneyCamel.com</option><option value="National News paper" >National News paper</option><option value="Newsletter" >Newsletter</option><option value="Newspaper advert" >Newspaper advert</option><option value="Old Landlord" >Old Landlord</option><option value="Online Banners" >Online Banners</option><option value="Open House" >Open House</option><option value="Other" >Other</option><option value="Other portal" >Other portal</option><option value="Outdoor Media" >Outdoor Media</option><option value="Personal Referral" >Personal Referral</option><option value="Property Acquisition Department" >Property Acquisition Department</option><option value="Property Finder Premium" >Property Finder Premium</option><option value="Property Inc." >Property Inc.</option><option value="Property Management" >Property Management</option><option value="Property Trader" >Property Trader</option><option value="Property Weekly" >Property Weekly</option><option value="Propertyfinder.ae" >Propertyfinder.ae</option><option value="Propertyonline" >Propertyonline</option><option value="Propertywifi.com" >Propertywifi.com</option><option value="PropSpace MLS" >PropSpace MLS</option><option value="Radio" >Radio</option><option value="Radio Advert" >Radio Advert</option><option value="Referral within company" >Referral within company</option><option value="Relocation" >Relocation</option><option value="Rightmove.co.uk" >Rightmove.co.uk</option><option value="Roadshow" >Roadshow</option><option value="Sandcastles.ae" >Sandcastles.ae</option><option value="School Communicator" >School Communicator</option><option value="School Communicator" >School Communicator</option><option value="Search Engine" >Search Engine</option><option value="Signboard" >Signboard</option><option value="SMS campaign" >SMS campaign</option><option value="Social media Campaign" >Social media Campaign</option><option value="Souq.com" >Souq.com</option><option value="Staff Mailer" >Staff Mailer</option><option value="Twitter " >Twitter </option><option value="Walk-in" >Walk-in</option><option value="Website" >Website</option><option value="Whatpricemyhome" >Whatpricemyhome</option><option value="Whatsapp" >Whatsapp</option><option value="Word of Mouth" >Word of Mouth</option><option value="www.propertyportal.ae" >www.propertyportal.ae</option><option value="Youtube" >Youtube</option><option value="Zawya Mailer" >Zawya Mailer</option><option value="Zoopla" >Zoopla</option>                    </select></td>

                <td><select id='25' class="search_init 25 form-control input-sm">

                                           </select></td>

                 <td><select id='26' class="search_init 26 form-control input-sm">

                    </select></td>

                 <td><select id='27' class="search_init 27 form-control input-sm">

                   </select></td>

                <td><select id='28' class="search_init 28 form-control input-sm">

                   </select></td>

                <td><select id='29' class="search_init 29 form-control input-sm">

                     </select></td> 

                <td><select id='30' class="search_init 30 form-control input-sm">

                     </select></td>                               

                <td><select id='31' class="search_init 31 form-control input-sm"> 

                        <option value="" selected>Select</option>

                        <option value="Cash">Cash</option>

                        <option value="Loan (approved)">Loan (approved)</option>

                        <option value="Loan (not approved)">Loan (not approved)</option>

                    </select>

                </td>

                

                

               

                    

                

                 <td class="dropdown">

                <a href="" id="_date_1" class="dropdown-toggle click" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-arrow-down"></i></a>

                   	    <div class="dropdown-menu emirate_search">

                        <div class="form-group">

                        <label>Listed From</label>

                        

                        <div class="input-group">

                            <input type="text" class="form-control input-sm datepicker" id="dateenquirySfrom" name="dateenquirySfrom">

                            <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                            </div>

                            </div>

                        

                       </div>

                        <div class="form-group">

                        <label>To</label>

                        

                        <div class="input-group">

                            <input type="text" class="form-control input-sm datepicker" id="dateenquirySto" name="dateenquirySto">

                            <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                            </div>

                            </div>

                       

                     	</div>

              			</div>

                        </td>

                        

                        

                <td class="dropdown">

                 <a href="" id="_date_2" class="dropdown-toggle click" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                   	    <div class="dropdown-menu data emirate_search">

                        <div class="form-group">

                        <label>Updated From</label>

                        <div class="input-group">

                            <input type="text" class="form-control input-sm datepicker" id="dateupdatedSfrom" name="dateupdatedSfrom">

                            <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                            </div>

                            </div>

                       </div>

                        <div class="form-group">

                        <label>To</label>

                        

                        <div class="input-group">

                            <input type="text" class="form-control input-sm datepicker" id="dateupdatedSto" name="dateupdatedSto">

                            <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                            </div>

                            </div>

                        

                        

                     	</div>

              			</div>

                  </td>

                  

                   

                  

                  

               <td class="dropdown">

                    <a id="34" class='dropdown-toggle click' href="" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                    <div class='dropdown-menu data emirate_search' id="data34" > <span id_search='34' value="0" image="<?php echo base_url();?>mydata/images/header_ax.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_ax.png" title="Without Agent Referral"></span><br>

                    <span id_search='34' value="1" image="<?php echo base_url();?>mydata/images/header_a.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_a.png" title="Agent Referral"></span> </div>

                </td>

                

                <td class="dropdown"><a id="35" class='dropdown-toggle click' href="" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                    <div class='dropdown-menu data emirate_search' id="data35" > <span id_search='35' value="0" image="<?php echo base_url();?>mydata/images/ssx.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_ssx.png" title="Not a shared lead"></span><br>

                   <span id_search='35' value="1" image="<?php echo base_url();?>mydata/images/ss.png?ts=10" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_ss.png" title="Shared lead"></span> </div></td> 

                   <td><input class="search_init form-control input-sm" id='36' value=" Min 3 chars" /></td>

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

            </div>

            </div>

            </div>

            

                    

            

            



 			</div>

            </div>

            <!-- container end -->

            

            

            </div>

 <script type="text/javascript" src="<?php echo site_url();?>js_module/common.js?ts=11234"></script> 

<script type="text/javascript" src="<?php echo site_url();?>js_module/leads.js?ts=11234"></script>  

<script type="text/javascript">

 function json_prop_requirments(popup_id) {

	var json_data = '';



	json_data = '{"lead_req_id":"' + $('#lead_req_id').val() + '","lead_id":"' + $('#id').val() + '","category_id":"' + $('#category_id').val() + '","region_id":"' + $('#region_id').val() + '","area_location_id":"' + $('#area_location_id').val() + '","area_location_id":"' + $('#area_location_id').val() + '","sub_area_location_id":"' + $('#sub_area_location_id').val() + '","min_beds":"' + $('#min_beds').val() + '","max_beds":"' + $('#max_beds').val() + '","min_budget":"' + $('#min_budget').val() + '","max_budget":"' + $('#max_budget').val() + '","min_area":"' + $('#min_area').val() + '","max_area":"' + $('#max_area').val() + '","unit_type":"' + $('#unit_type').val() + '","unit_no":"' + $('#unit_no').val() + '","listing_id_' + popup_id + '_ref":"' + $('#listing_id_' + popup_id + '_ref').val() + '","listing_id_' + popup_id + '":"' + $('#listing_id_' + popup_id).val() + '"}';

	$('#property_req_' + popup_id).val(json_data);

}



function plot_requirements(property_requirements, popup_id) {

//       alert(property_requirements);

	var getReq = jQuery.parseJSON(property_requirements);

	if(getReq != undefined){

		$.each(getReq, function(id, key) {

//                    alert(this.lead_req_id+'-'+this.category_id+'-'+this.region_id+'-'+this.area_location_id+"-"+this.sub_area_location_id);

			$('#lead_req_id').val(this.lead_req_id);

			$('#category_id').val(this.category_id);

			$('#region_id').val(this.region_id);

			if (this.area_location_id != 0 || this.region_id != 0) {

				$('#region_id').trigger('change');

				$('#area_location_id').val(this.area_location_id);

			}else{

                            $('#area_location_id').val(this.area_location_id);

                        }

			if (this.sub_area_location_id != 0 || this.area_location_id != 0) {

				$('#area_location_id').trigger('change');

                                

				$('#sub_area_location_id').val(this.sub_area_location_id);

			}else{

                            $('#sub_area_location_id').val(this.sub_area_location_id);

                        }

                        

			$('#min_beds').val(this.min_beds);

			$('#max_beds').val(this.max_beds);

			

			if(this.min_beds == ""){

				$('#min_beds').val(0);

			}

			if(this.max_beds == ""){

				$('#max_beds').val(0);

			}



			$('#min_budget').val(this.min_budget);

			$('#max_budget').val(this.max_budget);

			$('#min_area').val(this.min_area);

			$('#max_area').val(this.max_area);

			$('#unit_type').val(this.unit_type);

			$('#unit_no').val(this.unit_no);

			if (popup_id == 1) {

				$('#listing_id_1').val(this.listing_id_1);

				$('#listing_id_1_ref').val(this.listing_id_1_ref);

			}

			if (popup_id == 2) {

				$('#listing_id_2').val(this.listing_id_2);

				$('#listing_id_2_ref').val(this.listing_id_2_ref);

			}

			if (popup_id == 3) {

				$('#listing_id_3').val(this.listing_id_3);

				$('#listing_id_3_ref').val(this.listing_id_3_ref);

			}

			if (popup_id == 4) {

				$('#listing_id_4').val(this.listing_id_4);

				$('#listing_id_4_ref').val(this.listing_id_4_ref);

			}

			plot_requirements_info(popup_id);

		});

	}

}

function plot_requirements_info(popup_id) {

	var prop_req_data = '';

	if ($('#type').val() != 0) {

		prop_req_data = prop_req_data + $("#myForm #type option[value='" + $('#myForm #type').val() + "']").text();

	}

	if ($('#category_id').val() != 0) {

		prop_req_data = prop_req_data + ', ' + $("#category_id option[value='" + $('#category_id').val() + "']").text();

	}

	var minBed = $('#min_beds').val();

	var maxBed = $('#max_beds').val();

	

	if((minBed == null) || (minBed == 0)){

		minBed = '';

	}

	

	if((maxBed == null) || (maxBed == 0) ){

		maxBed = '';

	}



	if (minBed != '' & maxBed != '' ) {

		prop_req_data = prop_req_data + ', ' + minBed + '-' + maxBed + ' beds';

	}

	if (minBed >= 1 & maxBed == '') {

		prop_req_data = prop_req_data + ', Min ' + minBed + ' bed(s)';

	}

	if (minBed == '' & maxBed >= 1) {

		prop_req_data = prop_req_data + ', Max ' + maxBed + ' beds';

	}

	if ($('#unit_type').val() != '') {

		prop_req_data = prop_req_data + ', ' + 'Type: ' + $('#unit_type').val();

	}

	if ($('#unit_no').val() != '') {

		prop_req_data = prop_req_data + ', ' + 'Unit: ' + $('#unit_no').val();

	}

        

//        alert(prop_req_data);

	if ($('#sub_area_location_id').val() != 0) {

		prop_req_data = prop_req_data + ', ' + $("#sub_area_location_id option[value='" + $('#sub_area_location_id').val() + "']").text();

	}

	if ($('#area_location_id').val() != 0) {

		prop_req_data = prop_req_data + ', ' + $("#area_location_id option[value='" + $('#area_location_id').val() + "']").text();

	}

	if ($('#region_id').val() != 0) {

		prop_req_data = prop_req_data + ', ' + $("#region_id option[value='" + $('#region_id').val() + "']").text();

	}

	var minPrice = $('#min_budget').val();

	var maxPrice = $('#max_budget').val();

	if (minPrice >= 1 & maxPrice >= 1) {

		prop_req_data = prop_req_data + ', ' + 'Price: ' + minPrice + ' - ' + maxPrice;

	}

	if (minPrice >= 1 & maxPrice < 1) {

		prop_req_data = prop_req_data + ', ' + 'Min price: ' + minPrice;

	}

	if (minPrice < 1 & maxPrice >= 1) {

		prop_req_data = prop_req_data + ', ' + 'Max price: ' + maxPrice;

	}

	var minArea = $('#min_area').val();

	var maxArea = $('#max_areat').val();

	if (minArea >= 1 & maxArea >= 1) {

		prop_req_data = prop_req_data + ', ' + 'Size: ' + minArea + ' - ' + maxArea;

	}

	if (minArea >= 1 & maxArea < 1) {

		prop_req_data = prop_req_data + ', ' + 'Min size: ' + minArea;

	}

	if (minArea < 1 & maxArea >= 1) {

		prop_req_data = prop_req_data + ', ' + 'Max Size: ' + maxArea;

	}

	

	prop_req_data = prop_req_data.split(',');

	prop_req_data = cleanArray(prop_req_data);



	prop_req_data = prop_req_data.join(',');

	$('#property_req_' + popup_id + '_data').val(prop_req_data);

}



function cleanArray(actual){

  var newArray = new Array();

  for(var i = 0; i<actual.length; i++){

      if (actual[i] && actual[i] != " "){

        newArray.push(actual[i]);

    }

  }

  return newArray;

}

//added to remove ref. if save button clicked

$(document.body).on('click', "#propertypopup-closeandsave", function() {

	if(property_requirements_popup_id) {

		var ref_return = $('#listing_id_' + property_requirements_popup_id + ', #listing_id_' + property_requirements_popup_id + '_ref').val();



		if (ref_return != '') {

			if (confirm("Saving the modified property requirements will remove the listing reference number")) {

				$('#listing_id_' + property_requirements_popup_id + ', #listing_id_' + property_requirements_popup_id + '_ref').val('');

			} else {

				return false;

			}

		}

	}



	var req_form_value_changed = false;

	$("#prop_req_form select").each(function() {

		if ($(this).val() != '' || $(this).val() != 0) {

			req_form_value_changed = true;

		}

	}

	);



	if (req_form_value_changed == true) {

		plot_requirements_info(property_requirements_popup_id);

		json_prop_requirments(property_requirements_popup_id);

	} else {

		$('#property_req_' + property_requirements_popup_id + '_data').val('');

		$('#property_req_' + property_requirements_popup_id).val('');

	}

	

	$('a.close').click();

}

);



$(document.body).on("click", '.req_popup', function() {

	var req_form_value_changed = false;

}

);



$(".ltrim").blur(function() {

	

	var str = $(this).val();

	$(this).val((ltrim(str, "0")));

}

);

function ltrim(str, chars) {

	chars = chars || "\\s";

	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");

}

</script>

<script>

    function setSelectedCheckboxes() {

        var cVal = '';

        var cVal_lead = '';

        $('#listings_row input:checked').each(function() {

            if($(this).attr('shared_f') != 1){

                 cVal_lead += $(this).attr('value') + ',';

            }

                 cVal += $(this).attr('value') + ',';

        });

        $('#sms-iframe-agent').attr('src', '<?php echo base_url();?>sendSMS/showSMSLeadsFormAgents/' + cVal );

        $('#sms-iframe-lead').attr('src', '<?php echo base_url();?>sendSMS/showSMSLeadsFormLeads/' + cVal_lead);

    }

    $(document).ready(function() {

        $('#listings_row_landlord').next().hide();

        $('#listings_row_landlord').hide();

    

    });

</script>   

    <!-- Property Managment Modal -->

            <div class="modal fade" id="propmanage_modal" tabindex="-1" >

              <div class="modal-dialog">

                <div class="modal-content ">

                 <form id="prop_req_form">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Property Requirements</h4>

                    <div class="popup_description"> Please populate the property requirements using the fields below. </div>

                  </div>

                  

                  <div class="modal-body">

                  <div class="row">

                    <div class="col-md-6">

                      <div class="form-group">

                        <label>Category</label>

                       

                            <input name="lead_req_id" style='display:none; width:60px;' type="text" class="form_fields" id="lead_req_id" value="">

    						<select name="category_id" class="form-control required input-sm" id="category_id" tabindex="2">

		                        <option value="0" selected>Select</option>

		                        		                            <option id="Apartment2" rel="Apartment, " value="1">Apartment</option>

										                            <option id="Villa2" rel="Villa, " value="2">Villa</option>

										                            <option id="Office2" rel="Office, " value="3">Office</option>

										                            <option id="Retail2" rel="Retail, " value="4">Retail</option>

										                            <option id="Hotel Apartment2" rel="Hotel Apartment, " value="5">Hotel Apartment</option>

										                            <option id="Warehouse2" rel="Warehouse, " value="6">Warehouse</option>

										                            <option id="Land Commercial2" rel="Land Commercial, " value="7">Land Commercial</option>

										                            <option id="Labour Camp2" rel="Labour Camp, " value="8">Labour Camp</option>

										                            <option id="Residential Building2" rel="Residential Building, " value="9">Residential Building</option>

										                            <option id="Multiple Sale Units2" rel="Multiple Sale Units, " value="10">Multiple Sale Units</option>

										                            <option id="Land Residential2" rel="Land Residential, " value="11">Land Residential</option>

										                            <option id="Commercial Full Building2" rel="Commercial Full Building, " value="12">Commercial Full Building</option>

										                            <option id="Penthouse2" rel="Penthouse, " value="13">Penthouse</option>

										                            <option id="Duplex2" rel="Duplex, " value="14">Duplex</option>

										                            <option id="Loft Apartment2" rel="Loft Apartment, " value="15">Loft Apartment</option>

										                            <option id="Townhouse2" rel="Townhouse, " value="16">Townhouse</option>

										                            <option id="Hotel2" rel="Hotel, " value="17">Hotel</option>

										                            <option id="Land Mixed Use2" rel="Land Mixed Use, " value="18">Land Mixed Use</option>

										                            <option id="Compound2" rel="Compound, " value="21">Compound</option>

										                            <option id="Half Floor2" rel="Half Floor, " value="24">Half Floor</option>

										                            <option id="Full Floor2" rel="Full Floor, " value="27">Full Floor</option>

										                            <option id="Commercial Villa2" rel="Commercial Villa, " value="30">Commercial Villa</option>

										                            <option id="Bungalow2" rel="Bungalow, " value="48">Bungalow</option>

										                            <option id="Factory2" rel="Factory, " value="50">Factory</option>

								                    		</select>

                      </div> 

                      <div class="form-group">

                        <label>Emirate</label>

                      

                            <select required="" name="region_id" class="form-control required input-sm" id="region_id" tabindex="7">

	                        	<option value="0" selected>Select</option>

		                        	                            	<option value="2">Abu Dhabi</option>

									                            	<option value="4">Ajman</option>

									                            	<option value="8">Al Ain</option>

									                            	<option value="1">Dubai</option>

									                            	<option value="7">Fujairah</option>

									                            	<option value="6">Ras Al Khaimah</option>

									                            	<option value="3">Sharjah</option>

									                            	<option value="5">Umm Al Quwain</option>

									                    	</select>

                      </div> 

                      <div class="form-group">

                        <label>Location</label>

                      <select name="area_location_id" class="form-control input-sm required" id="area_location_id" tabindex="8">

                            	                 <option value="0" selected>Select</option>

                        	</select>

                      </div> 

                      <div class="form-group">

                        <label>Sub-location</label>

                        

                            <select name="sub_area_location_id" class="form-control required input-sm" id="sub_area_location_id" tabindex="9">

                        		<option value="0" selected>Select</option>

                    		</select>

                      </div> 

                      

                    </div>

                    <div class="col-md-6">

                      <div class="row">

                        <div class="col-md-6">

                          <div class="form-group">

                                <label>Min Beds</label>

                               

                                <select id="min_beds" name="min_beds" class="form-control input-sm"  tabindex="11" type="text">

		                        <option selected="" value="0">Select</option>

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

                    		</select>

                          </div>

                        </div>

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>Max Beds</label>

                          <select id="max_beds" name="max_beds" class="form-control input-sm"  type="text" tabindex="12">

		                        <option selected="" value="0">Select</option>

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

                    		</select>

                           </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Min Price</label>

                              <input type="text" id="min_budget" name="min_budget" class="form-control required input-sm">

                            </div>

                        </div>

                        

                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Max Price</label>

                              <input type="text" id="max_budget" name="max_budget" class="form-control input-sm">

                            </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Min Area</label>

                              <input type="text" name="min_area" id="min_area" class="form-control required input-sm">

                            </div>

                        </div>

                        

                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Max Area</label>

                              <input type="text" id="max_area" name="max_area" class="form-control input-sm">

                            </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Unit Type</label>

                              <input type="text" id="unit_type" name="unit_type" class="form-control required input-sm">

                            </div>

                        </div>

                        

                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Unit</label>

                              <input type="text" id="unit_no" name="unit_no" class="form-control input-sm">

                            </div>

                        </div>

                      </div>

                    </div>

                  </div>

                  </div>

                  <div class="modal-footer">

                    <button class="btn btn-success" id="propertypopup-closeandsave" data-dismiss="modal">Save</button>

                  </div>

              

                  </form>

                  </div>

                </div>

              </div> 

              

          



            <!-- Ref Modal -->

            <div class="modal fade" id="ref_modal" tabindex="-1" >

              <div class="modal-dialog">

                <div class="modal-content ">

                 <div id="view_linktolistings_leads_popup" class="popup_block" >

    					<div id="LinkToListings">Data Table</div>

					</div>

                  

               </div>

                </div>

              </div>

              

                    

 <!-- Add Contact Modal -->

            <div class="modal fade" id="addnew_contact" tabindex="-1" >

              <div class="modal-dialog">

                <div class="modal-content ">

                 <form id="myForm_landlord" action="<?php echo base_url();?>contacts/submit" method="post"  >

                 <input name="Save" id="Save" value="1" style="display:none">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Add a New Contact</h4>

                  </div>

                  

                  <div class="modal-body">

		              <div class="row">

		              <div class="col-md-10 col-md-offset-1">

		                  <div class="form-group">

		  	                <label>First Name</label>

		  	                <input type="text" class="form-control input-sm" id="name" name="name" required="required" >

		  	              </div>  

		                  <div class="form-group">

		                    <label>Last Name</label>

		                    <input type="text" class="form-control input-sm" id="last_name" name="last_name" >

		                  </div>

		                  <div class="form-group">

		                    <label>Mobile</label>

		                    <div class="input-group col-md-12">

<select name="mobile_no_new_ccode" id="mobile_no_new_ccode" class="form-control col-md-4 input-sm" >



 <option value="1">USA (+1)</option> 

 <option value="213">Algeria (+213)</option> 

 <option value="376">Andorra (+376)</option> 

 <option value="244">Angola (+244)</option> 

 <option value="1264">Anguilla (+1264)</option> 

 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 

 <option value="599">Antilles (Dutch) (+599)</option> 

 <option value="54">Argentina (+54)</option> 

 <option value="374">Armenia (+374)</option> 

 <option value="297">Aruba (+297)</option> 

 <option value="247">Ascension Island (+247)</option> 

 <option value="61">Australia (+61)</option> 

 <option value="43">Austria (+43)</option> 

 <option value="994">Azerbaijan (+994)</option> 

 <option value="1242">Bahamas (+1242)</option> 

 <option value="973">Bahrain (+973)</option> 

 <option value="880">Bangladesh (+880)</option> 

 <option value="1246">Barbados (+1246)</option> 

 <option value="375">Belarus (+375)</option> 

 <option value="32">Belgium (+32)</option> 

 <option value="501">Belize (+501)</option> 

 <option value="229">Benin (+229)</option> 

 <option value="1441">Bermuda (+1441)</option> 

 <option value="975">Bhutan (+975)</option> 

 <option value="591">Bolivia (+591)</option> 

 <option value="387">Bosnia Herzegovina (+387)</option> 

 <option value="267">Botswana (+267)</option> 

 <option value="55">Brazil (+55)</option> 

 <option value="673">Brunei (+673)</option> 

 <option value="359">Bulgaria (+359)</option> 

 <option value="226">Burkina Faso (+226)</option> 

 <option value="257">Burundi (+257)</option> 

 <option value="855">Cambodia (+855)</option> 

 <option value="237">Cameroon (+237)</option> 

 <option value="1">Canada (+1)</option> 

 <option value="238">Cape Verde Islands (+238)</option> 

 <option value="1345">Cayman Islands (+1345)</option> 

 <option value="236">Central African Republic (+236)</option> 

 <option value="56">Chile (+56)</option> 

 <option value="86">China (+86)</option> 

 <option value="57">Colombia (+57)</option> 

 <option value="269">Comoros (+269)</option> 

 <option value="242">Congo (+242)</option> 

 <option value="682">Cook Islands (+682)</option> 

 <option value="506">Costa Rica (+506)</option> 

 <option value="385">Croatia (+385)</option> 

 <option value="53">Cuba (+53)</option> 

 <option value="90392">Cyprus North (+90392)</option> 

 <option value="357">Cyprus South (+357)</option> 

 <option value="42">Czech Republic (+42)</option> 

 <option value="45">Denmark (+45)</option> 

 <option value="2463">Diego Garcia (+2463)</option> 

 <option value="253">Djibouti (+253)</option> 

 <option value="1809">Dominica (+1809)</option> 

 <option value="1809">Dominican Republic (+1809)</option> 

 <option value="593">Ecuador (+593)</option> 

 <option value="20">Egypt (+20)</option> 

 <option value="353">Eire (+353)</option> 

 <option value="503">El Salvador (+503)</option> 

 <option value="240">Equatorial Guinea (+240)</option> 

 <option value="291">Eritrea (+291)</option> 

 <option value="372">Estonia (+372)</option> 

 <option value="251">Ethiopia (+251)</option> 

 <option value="500">Falkland Islands (+500)</option> 

 <option value="298">Faroe Islands (+298)</option> 

 <option value="679">Fiji (+679)</option> 

 <option value="358">Finland (+358)</option> 

 <option value="33">France (+33)</option> 

 <option value="594">French Guiana (+594)</option> 

 <option value="689">French Polynesia (+689)</option> 

 <option value="241">Gabon (+241)</option> 

 <option value="220">Gambia (+220)</option> 

 <option value="7880">Georgia (+7880)</option> 

 <option value="49">Germany (+49)</option> 

 <option value="233">Ghana (+233)</option> 

 <option value="350">Gibraltar (+350)</option> 

 <option value="30">Greece (+30)</option> 

 <option value="299">Greenland (+299)</option> 

 <option value="1473">Grenada (+1473)</option> 

 <option value="590">Guadeloupe (+590)</option> 

 <option value="671">Guam (+671)</option> 

 <option value="502">Guatemala (+502)</option> 

 <option value="224">Guinea (+224)</option> 

 <option value="245">Guinea - Bissau (+245)</option> 

 <option value="592">Guyana (+592)</option> 

 <option value="509">Haiti (+509)</option> 

 <option value="504">Honduras (+504)</option> 

 <option value="852">Hong Kong (+852)</option> 

 <option value="36">Hungary (+36)</option> 

 <option value="354">Iceland (+354)</option> 

 <option value="91">India (+91)</option> 

 <option value="62">Indonesia (+62)</option> 

 <option value="98">Iran (+98)</option> 

 <option value="964">Iraq (+964)</option> 

 <option value="972">Israel (+972)</option> 

 <option value="39">Italy (+39)</option> 

 <option value="225">Ivory Coast (+225)</option> 

 <option value="1876">Jamaica (+1876)</option> 

 <option value="81">Japan (+81)</option> 

 <option value="962">Jordan (+962)</option> 

 <option value="7">Kazakhstan (+7)</option> 

 <option value="254">Kenya (+254)</option> 

 <option value="686">Kiribati (+686)</option> 

 <option value="850">Korea North (+850)</option> 

 <option value="82">Korea South (+82)</option> 

 <option value="965">Kuwait (+965)</option> 

 <option value="996">Kyrgyzstan (+996)</option> 

 <option value="856">Laos (+856)</option> 

 <option value="371">Latvia (+371)</option> 

 <option value="961">Lebanon (+961)</option> 

 <option value="266">Lesotho (+266)</option> 

 <option value="231">Liberia (+231)</option> 

 <option value="218">Libya (+218)</option> 

 <option value="417">Liechtenstein (+417)</option> 

 <option value="370">Lithuania (+370)</option> 

 <option value="352">Luxembourg (+352)</option> 

 <option value="853">Macao (+853)</option> 

 <option value="389">Macedonia (+389)</option> 

 <option value="261">Madagascar (+261)</option> 

 <option value="265">Malawi (+265)</option> 

 <option value="60">Malaysia (+60)</option> 

 <option value="960">Maldives (+960)</option> 

 <option value="223">Mali (+223)</option> 

 <option value="356">Malta (+356)</option> 

 <option value="692">Marshall Islands (+692)</option> 

 <option value="596">Martinique (+596)</option> 

 <option value="222">Mauritania (+222)</option> 

 <option value="269">Mayotte (+269)</option> 

 <option value="52">Mexico (+52)</option> 

 <option value="691">Micronesia (+691)</option> 

 <option value="373">Moldova (+373)</option> 

 <option value="377">Monaco (+377)</option> 

 <option value="976">Mongolia (+976)</option> 

 <option value="1664">Montserrat (+1664)</option> 

 <option value="212">Morocco (+212)</option> 

 <option value="258">Mozambique (+258)</option> 

 <option value="95">Myanmar (+95)</option> 

 <option value="264">Namibia (+264)</option> 

 <option value="674">Nauru (+674)</option> 

 <option value="977">Nepal (+977)</option> 

 <option value="31">Netherlands (+31)</option> 

 <option value="687">New Caledonia (+687)</option> 

 <option value="64">New Zealand (+64)</option> 

 <option value="505">Nicaragua (+505)</option> 

 <option value="227">Niger (+227)</option> 

 <option value="234">Nigeria (+234)</option> 

 <option value="683">Niue (+683)</option> 

 <option value="672">Norfolk Islands (+672)</option> 

 <option value="670">Northern Marianas (+670)</option> 

 <option value="47">Norway (+47)</option> 

 <option value="968">Oman (+968)</option> 

 <option value="92">Pakistan (+92)</option> 

 <option value="680">Palau (+680)</option> 

 <option value="507">Panama (+507)</option> 

 <option value="675">Papua New Guinea (+675)</option> 

 <option value="595">Paraguay (+595)</option> 

 <option value="51">Peru (+51)</option> 

 <option value="63">Philippines (+63)</option> 

 <option value="48">Poland (+48)</option> 

 <option value="351">Portugal (+351)</option> 

 <option value="1787">Puerto Rico (+1787)</option> 

 <option value="974">Qatar (+974)</option> 

 <option value="262">Reunion (+262)</option> 

 <option value="40">Romania (+40)</option> 

 <option value="7">Russia (+7)</option> 

 <option value="250">Rwanda (+250)</option> 

 <option value="378">San Marino (+378)</option> 

 <option value="239">Sao Tome &amp; Principe (+239)</option> 



 <option value="966">Saudi Arabia (+966)</option> 

 <option value="221">Senegal (+221)</option> 

 <option value="381">Serbia (+381)</option> 

 <option value="248">Seychelles (+248)</option> 

 <option value="232">Sierra Leone (+232)</option> 

 <option value="65">Singapore (+65)</option> 

 <option value="421">Slovak Republic (+421)</option> 

 <option value="386">Slovenia (+386)</option> 

 <option value="677">Solomon Islands (+677)</option> 

 <option value="252">Somalia (+252)</option> 

 <option value="27">South Africa (+27)</option> 

 <option value="34">Spain (+34)</option> 

 <option value="94">Sri Lanka (+94)</option> 

 <option value="290">St. Helena (+290)</option> 

 <option value="1869">St. Kitts (+1869)</option> 

 <option value="1758">St. Lucia (+1758)</option> 

 <option value="249">Sudan (+249)</option> 

 <option value="597">Suriname (+597)</option> 

 <option value="268">Swaziland (+268)</option> 

 <option value="46">Sweden (+46)</option> 

 <option value="41">Switzerland (+41)</option> 

 <option value="963">Syria (+963)</option> 

 <option value="886">Taiwan (+886)</option> 

 <option value="7">Tajikstan (+7)</option> 

 <option value="66">Thailand (+66)</option> 

 <option value="228">Togo (+228)</option> 

 <option value="676">Tonga (+676)</option> 

 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 

 <option value="216">Tunisia (+216)</option> 

 <option value="90">Turkey (+90)</option> 

 <option value="7">Turkmenistan (+7)</option> 

 <option value="993">Turkmenistan (+993)</option> 

 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 

 <option value="688">Tuvalu (+688)</option> 

 <option value="256">Uganda (+256)</option> 

 <option value="44" >UK (+44)</option> 

 <option value="380">Ukraine (+380)</option> 

 <option value="971" selected="selected">UAE(+971)</option> 

 <option value="598">Uruguay (+598)</option> 

 <option value="1">USA (+1)</option> 

 <option value="7">Uzbekistan (+7)</option> 

 <option value="678">Vanuatu (+678)</option> 

 <option value="379">Vatican City (+379)</option> 

 <option value="58">Venezuela (+58)</option> 

 <option value="84">Vietnam (+84)</option> 

 <option value="84">Virgin Islands - British (+1284)</option> 

 <option value="84">Virgin Islands - US (+1340)</option> 

 <option value="681">Wallis &amp; Futuna (+681)</option> 

 <option value="969">Yemen (North)(+969)</option> 

 <option value="967">Yemen (South)(+967)</option> 

 <option value="381">Yugoslavia (+381)</option> 

 <option value="243">Zaire (+243)</option> 

 <option value="260">Zambia (+260)</option> 

 <option value="263">Zimbabwe (+263)</option>

  </select>

                          

                          <input placeholder="Mobile" type="text" class="ltrim form-control input-sm col-md-8" id="mobile_no_new" name="mobile_no_new" required="required">

                        </div>

		                  </div>

		                  <div class="form-group">

		                    <label>Phone</label>

		                    <div class="input-group col-md-12">

<select name="c_code_phone_1" id="c_code_phone_1" class="form-control col-md-4 input-sm" >



 <option value="1">USA (+1)</option> 

 <option value="213">Algeria (+213)</option> 

 <option value="376">Andorra (+376)</option> 

 <option value="244">Angola (+244)</option> 

 <option value="1264">Anguilla (+1264)</option> 

 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 

 <option value="599">Antilles (Dutch) (+599)</option> 

 <option value="54">Argentina (+54)</option> 

 <option value="374">Armenia (+374)</option> 

 <option value="297">Aruba (+297)</option> 

 <option value="247">Ascension Island (+247)</option> 

 <option value="61">Australia (+61)</option> 

 <option value="43">Austria (+43)</option> 

 <option value="994">Azerbaijan (+994)</option> 

 <option value="1242">Bahamas (+1242)</option> 

 <option value="973">Bahrain (+973)</option> 

 <option value="880">Bangladesh (+880)</option> 

 <option value="1246">Barbados (+1246)</option> 

 <option value="375">Belarus (+375)</option> 

 <option value="32">Belgium (+32)</option> 

 <option value="501">Belize (+501)</option> 

 <option value="229">Benin (+229)</option> 

 <option value="1441">Bermuda (+1441)</option> 

 <option value="975">Bhutan (+975)</option> 

 <option value="591">Bolivia (+591)</option> 

 <option value="387">Bosnia Herzegovina (+387)</option> 

 <option value="267">Botswana (+267)</option> 

 <option value="55">Brazil (+55)</option> 

 <option value="673">Brunei (+673)</option> 

 <option value="359">Bulgaria (+359)</option> 

 <option value="226">Burkina Faso (+226)</option> 

 <option value="257">Burundi (+257)</option> 

 <option value="855">Cambodia (+855)</option> 

 <option value="237">Cameroon (+237)</option> 

 <option value="1">Canada (+1)</option> 

 <option value="238">Cape Verde Islands (+238)</option> 

 <option value="1345">Cayman Islands (+1345)</option> 

 <option value="236">Central African Republic (+236)</option> 

 <option value="56">Chile (+56)</option> 

 <option value="86">China (+86)</option> 

 <option value="57">Colombia (+57)</option> 

 <option value="269">Comoros (+269)</option> 

 <option value="242">Congo (+242)</option> 

 <option value="682">Cook Islands (+682)</option> 

 <option value="506">Costa Rica (+506)</option> 

 <option value="385">Croatia (+385)</option> 

 <option value="53">Cuba (+53)</option> 

 <option value="90392">Cyprus North (+90392)</option> 

 <option value="357">Cyprus South (+357)</option> 

 <option value="42">Czech Republic (+42)</option> 

 <option value="45">Denmark (+45)</option> 

 <option value="2463">Diego Garcia (+2463)</option> 

 <option value="253">Djibouti (+253)</option> 

 <option value="1809">Dominica (+1809)</option> 

 <option value="1809">Dominican Republic (+1809)</option> 

 <option value="593">Ecuador (+593)</option> 

 <option value="20">Egypt (+20)</option> 

 <option value="353">Eire (+353)</option> 

 <option value="503">El Salvador (+503)</option> 

 <option value="240">Equatorial Guinea (+240)</option> 

 <option value="291">Eritrea (+291)</option> 

 <option value="372">Estonia (+372)</option> 

 <option value="251">Ethiopia (+251)</option> 

 <option value="500">Falkland Islands (+500)</option> 

 <option value="298">Faroe Islands (+298)</option> 

 <option value="679">Fiji (+679)</option> 

 <option value="358">Finland (+358)</option> 

 <option value="33">France (+33)</option> 

 <option value="594">French Guiana (+594)</option> 

 <option value="689">French Polynesia (+689)</option> 

 <option value="241">Gabon (+241)</option> 

 <option value="220">Gambia (+220)</option> 

 <option value="7880">Georgia (+7880)</option> 

 <option value="49">Germany (+49)</option> 

 <option value="233">Ghana (+233)</option> 

 <option value="350">Gibraltar (+350)</option> 

 <option value="30">Greece (+30)</option> 

 <option value="299">Greenland (+299)</option> 

 <option value="1473">Grenada (+1473)</option> 

 <option value="590">Guadeloupe (+590)</option> 

 <option value="671">Guam (+671)</option> 

 <option value="502">Guatemala (+502)</option> 

 <option value="224">Guinea (+224)</option> 

 <option value="245">Guinea - Bissau (+245)</option> 

 <option value="592">Guyana (+592)</option> 

 <option value="509">Haiti (+509)</option> 

 <option value="504">Honduras (+504)</option> 

 <option value="852">Hong Kong (+852)</option> 

 <option value="36">Hungary (+36)</option> 

 <option value="354">Iceland (+354)</option> 

 <option value="91">India (+91)</option> 

 <option value="62">Indonesia (+62)</option> 

 <option value="98">Iran (+98)</option> 

 <option value="964">Iraq (+964)</option> 

 <option value="972">Israel (+972)</option> 

 <option value="39">Italy (+39)</option> 

 <option value="225">Ivory Coast (+225)</option> 

 <option value="1876">Jamaica (+1876)</option> 

 <option value="81">Japan (+81)</option> 

 <option value="962">Jordan (+962)</option> 

 <option value="7">Kazakhstan (+7)</option> 

 <option value="254">Kenya (+254)</option> 

 <option value="686">Kiribati (+686)</option> 

 <option value="850">Korea North (+850)</option> 

 <option value="82">Korea South (+82)</option> 

 <option value="965">Kuwait (+965)</option> 

 <option value="996">Kyrgyzstan (+996)</option> 

 <option value="856">Laos (+856)</option> 

 <option value="371">Latvia (+371)</option> 

 <option value="961">Lebanon (+961)</option> 

 <option value="266">Lesotho (+266)</option> 

 <option value="231">Liberia (+231)</option> 

 <option value="218">Libya (+218)</option> 

 <option value="417">Liechtenstein (+417)</option> 

 <option value="370">Lithuania (+370)</option> 

 <option value="352">Luxembourg (+352)</option> 

 <option value="853">Macao (+853)</option> 

 <option value="389">Macedonia (+389)</option> 

 <option value="261">Madagascar (+261)</option> 

 <option value="265">Malawi (+265)</option> 

 <option value="60">Malaysia (+60)</option> 

 <option value="960">Maldives (+960)</option> 

 <option value="223">Mali (+223)</option> 

 <option value="356">Malta (+356)</option> 

 <option value="692">Marshall Islands (+692)</option> 

 <option value="596">Martinique (+596)</option> 

 <option value="222">Mauritania (+222)</option> 

 <option value="269">Mayotte (+269)</option> 

 <option value="52">Mexico (+52)</option> 

 <option value="691">Micronesia (+691)</option> 

 <option value="373">Moldova (+373)</option> 

 <option value="377">Monaco (+377)</option> 

 <option value="976">Mongolia (+976)</option> 

 <option value="1664">Montserrat (+1664)</option> 

 <option value="212">Morocco (+212)</option> 

 <option value="258">Mozambique (+258)</option> 

 <option value="95">Myanmar (+95)</option> 

 <option value="264">Namibia (+264)</option> 

 <option value="674">Nauru (+674)</option> 

 <option value="977">Nepal (+977)</option> 

 <option value="31">Netherlands (+31)</option> 

 <option value="687">New Caledonia (+687)</option> 

 <option value="64">New Zealand (+64)</option> 

 <option value="505">Nicaragua (+505)</option> 

 <option value="227">Niger (+227)</option> 

 <option value="234">Nigeria (+234)</option> 

 <option value="683">Niue (+683)</option> 

 <option value="672">Norfolk Islands (+672)</option> 

 <option value="670">Northern Marianas (+670)</option> 

 <option value="47">Norway (+47)</option> 

 <option value="968">Oman (+968)</option> 

 <option value="92">Pakistan (+92)</option> 

 <option value="680">Palau (+680)</option> 

 <option value="507">Panama (+507)</option> 

 <option value="675">Papua New Guinea (+675)</option> 

 <option value="595">Paraguay (+595)</option> 

 <option value="51">Peru (+51)</option> 

 <option value="63">Philippines (+63)</option> 

 <option value="48">Poland (+48)</option> 

 <option value="351">Portugal (+351)</option> 

 <option value="1787">Puerto Rico (+1787)</option> 

 <option value="974">Qatar (+974)</option> 

 <option value="262">Reunion (+262)</option> 

 <option value="40">Romania (+40)</option> 

 <option value="7">Russia (+7)</option> 

 <option value="250">Rwanda (+250)</option> 

 <option value="378">San Marino (+378)</option> 

 <option value="239">Sao Tome &amp; Principe (+239)</option> 



 <option value="966">Saudi Arabia (+966)</option> 

 <option value="221">Senegal (+221)</option> 

 <option value="381">Serbia (+381)</option> 

 <option value="248">Seychelles (+248)</option> 

 <option value="232">Sierra Leone (+232)</option> 

 <option value="65">Singapore (+65)</option> 

 <option value="421">Slovak Republic (+421)</option> 

 <option value="386">Slovenia (+386)</option> 

 <option value="677">Solomon Islands (+677)</option> 

 <option value="252">Somalia (+252)</option> 

 <option value="27">South Africa (+27)</option> 

 <option value="34">Spain (+34)</option> 

 <option value="94">Sri Lanka (+94)</option> 

 <option value="290">St. Helena (+290)</option> 

 <option value="1869">St. Kitts (+1869)</option> 

 <option value="1758">St. Lucia (+1758)</option> 

 <option value="249">Sudan (+249)</option> 

 <option value="597">Suriname (+597)</option> 

 <option value="268">Swaziland (+268)</option> 

 <option value="46">Sweden (+46)</option> 

 <option value="41">Switzerland (+41)</option> 

 <option value="963">Syria (+963)</option> 

 <option value="886">Taiwan (+886)</option> 

 <option value="7">Tajikstan (+7)</option> 

 <option value="66">Thailand (+66)</option> 

 <option value="228">Togo (+228)</option> 

 <option value="676">Tonga (+676)</option> 

 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 

 <option value="216">Tunisia (+216)</option> 

 <option value="90">Turkey (+90)</option> 

 <option value="7">Turkmenistan (+7)</option> 

 <option value="993">Turkmenistan (+993)</option> 

 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 

 <option value="688">Tuvalu (+688)</option> 

 <option value="256">Uganda (+256)</option> 

 <option value="44" >UK (+44)</option> 

 <option value="380">Ukraine (+380)</option> 

 <option value="971" selected="selected">UAE(+971)</option> 

 <option value="598">Uruguay (+598)</option> 

 <option value="1">USA (+1)</option> 

 <option value="7">Uzbekistan (+7)</option> 

 <option value="678">Vanuatu (+678)</option> 

 <option value="379">Vatican City (+379)</option> 

 <option value="58">Venezuela (+58)</option> 

 <option value="84">Vietnam (+84)</option> 

 <option value="84">Virgin Islands - British (+1284)</option> 

 <option value="84">Virgin Islands - US (+1340)</option> 

 <option value="681">Wallis &amp; Futuna (+681)</option> 

 <option value="969">Yemen (North)(+969)</option> 

 <option value="967">Yemen (South)(+967)</option> 

 <option value="381">Yugoslavia (+381)</option> 

 <option value="243">Zaire (+243)</option> 

 <option value="260">Zambia (+260)</option> 

 <option value="263">Zimbabwe (+263)</option>

  </select>

                          <input placeholder="Phone" type="text" class="ltrim form-control input-sm col-md-8" id="phone" name="phone">

                        </div>

		                  </div>

		                  <div class="form-group">

		                    <label>Email</label>

		                    <input type="text" class="form-control input-sm" id="email" name="email" required="required" >

		                  </div>

                          <div class="form-group">

		                    <label>Contact type</label>

		                    <div class="input-group col-md-12">

                         <select name="contact_type" class="form-control  input-sm required" id="contact_type">

                            <option value="" selected>Select</option>

                             <option value="1">Tenant</option>

                             <option value="2">Buyer</option>

                             <option value="3">Landlord</option>

                             <option value="4">Seller</option>

                             <option value="5">Landlord+Seller</option>

                             <option value="6">Representative of Tenant</option>

                             <option value="7">Other</option> 

                             </select>

                        </div>

		                  </div>

                          <div class="form-group">

		                    <label>Assign to</label>

		                    <div class="input-group col-md-12">

                         <select name="assigned_to_id" class="form-control  input-sm" id="assigned_to_id">

                           

                              </select>

                        </div>

		                  </div>

		                </div>

		               	<div class="col-md-10 col-md-offset-1">

		                	<a id="pop-addmoreinfo" class="text-info" role="button" 

		                	   data-toggle="collapse" href="#showmore_address" 

		                	   aria-expanded="false" aria-controls="showmore_address">

		                		+ Add address details

		                	</a>

		                <div class="collapse" id="showmore_address">

		                  <div class="form-group">

		  	                <label>P.O Box</label>

		  	                <input type="text" class="form-control input-sm" id="po_box" name="po_box" >

		  	              </div>  

		                  <div class="form-group">

		                    <label>Address 1</label>

		                    <input type="text" class="form-control input-sm" id="address_line_1" name="address_line_1" >

		                  </div>

		                  <div class="form-group">

		                    <label>Address 2</label>

		                    <input type="text" class="form-control input-sm" id="address_line_2" name="address_line_2" >

		                  </div>

		                  <div class="form-group">

		                    <label>City</label>

		                    <input type="text" class="form-control input-sm" id="address_city" name="address_city" >

		                  </div>

		                  <div class="form-group">

		                    <label>Zip</label>

		                    <input type="text" class="form-control input-sm" id="address_zip_po_box" name="address_zip_po_box" >

		                  </div>

		                  <div class="form-group">

		                    <label>State</label>

		                    <input type="text" class="form-control input-sm" id="address_state" name="address_state" >

		                  </div>

		                  <div class="form-group">

		                    <label>Country</label>

		                   <select id="address_country" name="address_country"  class="form-control" tabindex=10>

                                        <option value="" selected="selected">Select</option>

                                        <option value="Afghanistan">Afghanistan</option>

                                        <option value="Albania">Albania</option>

                                        <option value="Algeria">Algeria</option>

                                        <option value="American Samoa">American Samoa</option>

                                        <option value="Andorra">Andorra</option>

                                        <option value="Angola">Angola</option>

                                        <option value="Anguilla">Anguilla</option>

                                        <option value="Antarctica">Antarctica</option>

                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>

                                        <option value="Argentina">Argentina</option>

                                        <option value="Armenia">Armenia</option>

                                        <option value="Aruba">Aruba</option>

                                        <option value="Australia">Australia</option>

                                        <option value="Austria">Austria</option>

                                        <option value="Azerbaijan">Azerbaijan</option>

                                        <option value="Bahamas">Bahamas</option>

                                        <option value="Bahrain">Bahrain</option>

                                        <option value="Bangladesh">Bangladesh</option>

                                        <option value="Barbados">Barbados</option>

                                        <option value="Belarus">Belarus</option>

                                        <option value="Belgium">Belgium</option>

                                        <option value="Belize">Belize</option>

                                        <option value="Benin">Benin</option>

                                        <option value="Bermuda">Bermuda</option>

                                        <option value="Bhutan">Bhutan</option>

                                        <option value="Bolivia">Bolivia</option>

                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>

                                        <option value="Botswana">Botswana</option>

                                        <option value="Bouvet Island">Bouvet Island</option>

                                        <option value="Brazil">Brazil</option>

                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>

                                        <option value="Brunei Darussalam">Brunei Darussalam</option>

                                        <option value="Bulgaria">Bulgaria</option>

                                        <option value="Burkina Faso">Burkina Faso</option>

                                        <option value="Burundi">Burundi</option>

                                        <option value="Cambodia">Cambodia</option>

                                        <option value="Cameroon">Cameroon</option>

                                        <option value="Canada">Canada</option>

                                        <option value="Cape Verde">Cape Verde</option>

                                        <option value="Cayman Islands">Cayman Islands</option>

                                        <option value="Central African Republic">Central African Republic</option>

                                        <option value="Chad">Chad</option>

                                        <option value="Chile">Chile</option>

                                        <option value="China">China</option>

                                        <option value="Christmas Island">Christmas Island</option>

                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>

                                        <option value="Colombia">Colombia</option>

                                        <option value="Comoros">Comoros</option>

                                        <option value="Congo">Congo</option>

                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>

                                        <option value="Cook Islands">Cook Islands</option>

                                        <option value="Costa Rica">Costa Rica</option>

                                        <option value="Cote D'ivoire">Cote D'ivoire</option>

                                        <option value="Croatia">Croatia</option>

                                        <option value="Cuba">Cuba</option>

                                        <option value="Cyprus">Cyprus</option>

                                        <option value="Czech Republic">Czech Republic</option>

                                        <option value="Denmark">Denmark</option>

                                        <option value="Djibouti">Djibouti</option>

                                        <option value="Dominica">Dominica</option>

                                        <option value="Dominican Republic">Dominican Republic</option>

                                        <option value="Ecuador">Ecuador</option>

                                        <option value="Egypt">Egypt</option>

                                        <option value="El Salvador">El Salvador</option>

                                        <option value="Equatorial Guinea">Equatorial Guinea</option>

                                        <option value="Eritrea">Eritrea</option>

                                        <option value="Estonia">Estonia</option>

                                        <option value="Ethiopia">Ethiopia</option>

                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>

                                        <option value="Faroe Islands">Faroe Islands</option>

                                        <option value="Fiji">Fiji</option>

                                        <option value="Finland">Finland</option>

                                        <option value="France">France</option>

                                        <option value="French Guiana">French Guiana</option>

                                        <option value="French Polynesia">French Polynesia</option>

                                        <option value="French Southern Territories">French Southern Territories</option>

                                        <option value="Gabon">Gabon</option>

                                        <option value="Gambia">Gambia</option>

                                        <option value="Georgia">Georgia</option>

                                        <option value="Germany">Germany</option>

                                        <option value="Ghana">Ghana</option>

                                        <option value="Gibraltar">Gibraltar</option>

                                        <option value="Greece">Greece</option>

                                        <option value="Greenland">Greenland</option>

                                        <option value="Grenada">Grenada</option>

                                        <option value="Guadeloupe">Guadeloupe</option>

                                        <option value="Guam">Guam</option>

                                        <option value="Guatemala">Guatemala</option>

                                        <option value="Guinea">Guinea</option>

                                        <option value="Guinea-bissau">Guinea-bissau</option>

                                        <option value="Guyana">Guyana</option>

                                        <option value="Haiti">Haiti</option>

                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>

                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>

                                        <option value="Honduras">Honduras</option>

                                        <option value="Hong Kong">Hong Kong</option>

                                        <option value="Hungary">Hungary</option>

                                        <option value="Iceland">Iceland</option>

                                        <option value="India">India</option>

                                        <option value="Indonesia">Indonesia</option>

                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>

                                        <option value="Iraq">Iraq</option>

                                        <option value="Ireland">Ireland</option>

                                        <option value="Israel">Israel</option>

                                        <option value="Italy">Italy</option>

                                        <option value="Jamaica">Jamaica</option>

                                        <option value="Japan">Japan</option>

                                        <option value="Jordan">Jordan</option>

                                        <option value="Kazakhstan">Kazakhstan</option>

                                        <option value="Kenya">Kenya</option>

                                        <option value="Kiribati">Kiribati</option>

                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>

                                        <option value="Korea, Republic of">Korea, Republic of</option>

                                        <option value="Kuwait">Kuwait</option>

                                        <option value="Kyrgyzstan">Kyrgyzstan</option>

                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>

                                        <option value="Latvia">Latvia</option>

                                        <option value="Lebanon">Lebanon</option>

                                        <option value="Lesotho">Lesotho</option>

                                        <option value="Liberia">Liberia</option>

                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>

                                        <option value="Liechtenstein">Liechtenstein</option>

                                        <option value="Lithuania">Lithuania</option>

                                        <option value="Luxembourg">Luxembourg</option>

                                        <option value="Macao">Macao</option>

                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>

                                        <option value="Madagascar">Madagascar</option>

                                        <option value="Malawi">Malawi</option>

                                        <option value="Malaysia">Malaysia</option>

                                        <option value="Maldives">Maldives</option>

                                        <option value="Mali">Mali</option>

                                        <option value="Malta">Malta</option>

                                        <option value="Marshall Islands">Marshall Islands</option>

                                        <option value="Martinique">Martinique</option>

                                        <option value="Mauritania">Mauritania</option>

                                        <option value="Mauritius">Mauritius</option>

                                        <option value="Mayotte">Mayotte</option>

                                        <option value="Mexico">Mexico</option>

                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>

                                        <option value="Moldova, Republic of">Moldova, Republic of</option>

                                        <option value="Monaco">Monaco</option>

                                        <option value="Mongolia">Mongolia</option>

                                        <option value="Montserrat">Montserrat</option>

                                        <option value="Morocco">Morocco</option>

                                        <option value="Mozambique">Mozambique</option>

                                        <option value="Myanmar">Myanmar</option>

                                        <option value="Namibia">Namibia</option>

                                        <option value="Nauru">Nauru</option>

                                        <option value="Nepal">Nepal</option>

                                        <option value="Netherlands">Netherlands</option>

                                        <option value="Netherlands Antilles">Netherlands Antilles</option>

                                        <option value="New Caledonia">New Caledonia</option>

                                        <option value="New Zealand">New Zealand</option>

                                        <option value="Nicaragua">Nicaragua</option>

                                        <option value="Niger">Niger</option>

                                        <option value="Nigeria">Nigeria</option>

                                        <option value="Niue">Niue</option>

                                        <option value="Norfolk Island">Norfolk Island</option>

                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>

                                        <option value="Norway">Norway</option>

                                        <option value="Oman">Oman</option>

                                        <option value="Pakistan">Pakistan</option>

                                        <option value="Palau">Palau</option>

                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>

                                        <option value="Panama">Panama</option>

                                        <option value="Papua New Guinea">Papua New Guinea</option>

                                        <option value="Paraguay">Paraguay</option>

                                        <option value="Peru">Peru</option>

                                        <option value="Philippines">Philippines</option>

                                        <option value="Pitcairn">Pitcairn</option>

                                        <option value="Poland">Poland</option>

                                        <option value="Portugal">Portugal</option>

                                        <option value="Puerto Rico">Puerto Rico</option>

                                        <option value="Qatar">Qatar</option>

                                        <option value="Reunion">Reunion</option>

                                        <option value="Romania">Romania</option>

                                        <option value="Russian Federation">Russian Federation</option>

                                        <option value="Rwanda">Rwanda</option>

                                        <option value="Saint Helena">Saint Helena</option>

                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>

                                        <option value="Saint Lucia">Saint Lucia</option>

                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>

                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>

                                        <option value="Samoa">Samoa</option>

                                        <option value="San Marino">San Marino</option>

                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>

                                        <option value="Saudi Arabia">Saudi Arabia</option>

                                        <option value="Senegal">Senegal</option>

                                        <option value="Serbia and Montenegro">Serbia and Montenegro</option>

                                        <option value="Seychelles">Seychelles</option>

                                        <option value="Sierra Leone">Sierra Leone</option>

                                        <option value="Singapore">Singapore</option>

                                        <option value="Slovakia">Slovakia</option>

                                        <option value="Slovenia">Slovenia</option>

                                        <option value="Solomon Islands">Solomon Islands</option>

                                        <option value="Somalia">Somalia</option>

                                        <option value="South Africa">South Africa</option>

                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>

                                        <option value="Spain">Spain</option>

                                        <option value="Sri Lanka">Sri Lanka</option>

                                        <option value="Sudan">Sudan</option>

                                        <option value="Suriname">Suriname</option>

                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>

                                        <option value="Swaziland">Swaziland</option>

                                        <option value="Sweden">Sweden</option>

                                        <option value="Switzerland">Switzerland</option>

                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>

                                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>

                                        <option value="Tajikistan">Tajikistan</option>

                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>

                                        <option value="Thailand">Thailand</option>

                                        <option value="Timor-leste">Timor-leste</option>

                                        <option value="Togo">Togo</option>

                                        <option value="Tokelau">Tokelau</option>

                                        <option value="Tonga">Tonga</option>

                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>

                                        <option value="Tunisia">Tunisia</option>

                                        <option value="Turkey">Turkey</option>

                                        <option value="Turkmenistan">Turkmenistan</option>

                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>

                                        <option value="Tuvalu">Tuvalu</option>

                                        <option value="Uganda">Uganda</option>

                                        <option value="Ukraine">Ukraine</option>

                                        <option value="United Arab Emirates">United Arab Emirates</option>

                                        <option value="United Kingdom">United Kingdom</option>

                                        <option value="United States">United States</option>

                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>

                                        <option value="Uruguay">Uruguay</option>

                                        <option value="Uzbekistan">Uzbekistan</option>

                                        <option value="Vanuatu">Vanuatu</option>

                                        <option value="Venezuela">Venezuela</option>

                                        <option value="Viet Nam">Viet Nam</option>

                                        <option value="Virgin Islands, British">Virgin Islands, British</option>

                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>

                                        <option value="Wallis and Futuna">Wallis and Futuna</option>

                                        <option value="Western Sahara">Western Sahara</option>

                                        <option value="Yemen">Yemen</option>

                                        <option value="Zambia">Zambia</option>

                                        <option value="Zimbabwe">Zimbabwe</option>

                                    </select>

		                  </div>

		                </div>

		                </div>

		              </div>

                  </div>

                  <div class="modal-footer">

<div style="display:none;" class="alert alert-danger text-center" id="addcontact_error">Please fill all fields!</div>
                  	<button type="submit" id="saveNewContact" class="btn btn-success">Save</button>

                  </div>

                  </form>

                  </div>

                </div>

              </div>



              <script type="text/javascript">

              $(document).ready(function() {

              $('#showmore_address').on('shown.bs.collapse', function () {

              // do something…

              $('#pop-addmoreinfo').html('- Hide address details');

              })

              $('#showmore_address').on('hidden.bs.collapse', function () {

              // do something…

              $('#pop-addmoreinfo').html('+ Add address details');

              })

              });



              </script>

     <!-- END JS WORK -->


<!-- popups starts here -->

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

                        <label>Prop Type</label>

                        <select name="as_category_id" class="advance_search form-control input-sm" id="as_category_id" >

                                            <option value="" selected>Select</option>

                                                                                                <option id="Apartment" rel="Apartment, " value="1">

                                                Apartment                                                </option>

                                                <option id="Villa" rel="Villa, " value="2">

                                                Villa                                                </option>

                                                <option id="Office" rel="Office, " value="3">

                                                Office                                                </option>

                                                <option id="Retail" rel="Retail, " value="4">

                                                Retail                                                </option>

                                                <option id="Hotel Apartment" rel="Hotel Apartment, " value="5">

                                                Hotel Apartment                                                </option>

                                                <option id="Warehouse" rel="Warehouse, " value="6">

                                                Warehouse                                                </option>

                                                <option id="Land Commercial" rel="Land Commercial, " value="7">

                                                Land Commercial                                                </option>

                                                <option id="Labour Camp" rel="Labour Camp, " value="8">

                                                Labour Camp                                                </option>

                                                <option id="Residential Building" rel="Residential Building, " value="9">

                                                Residential Building                                                </option>

                                                <option id="Multiple Sale Units" rel="Multiple Sale Units, " value="10">

                                                Multiple Sale Units                                                </option>

                                                <option id="Land Residential" rel="Land Residential, " value="11">

                                                Land Residential                                                </option>

                                                <option id="Commercial Full Building" rel="Commercial Full Building, " value="12">

                                                Commercial Full Building                                                </option>

                                                <option id="Penthouse" rel="Penthouse, " value="13">

                                                Penthouse                                                </option>

                                                <option id="Duplex" rel="Duplex, " value="14">

                                                Duplex                                                </option>

                                                <option id="Loft Apartment" rel="Loft Apartment, " value="15">

                                                Loft Apartment                                                </option>

                                                <option id="Townhouse" rel="Townhouse, " value="16">

                                                Townhouse                                                </option>

                                                <option id="Hotel" rel="Hotel, " value="17">

                                                Hotel                                                </option>

                                                <option id="Land Mixed Use" rel="Land Mixed Use, " value="18">

                                                Land Mixed Use                                                </option>

                                                <option id="Compound" rel="Compound, " value="21">

                                                Compound                                                </option>

                                                <option id="Half Floor" rel="Half Floor, " value="24">

                                                Half Floor                                                </option>

                                                <option id="Full Floor" rel="Full Floor, " value="27">

                                                Full Floor                                                </option>

                                                <option id="Commercial Villa" rel="Commercial Villa, " value="30">

                                                Commercial Villa                                                </option>

                                                <option id="Bungalow" rel="Bungalow, " value="48">

                                                Bungalow                                                </option>

                                                <option id="Factory" rel="Factory, " value="50">

                                                Factory                                                </option>

                                        </select>

                        

                    </div>

                    

                    <div class="form-group">

                      	<label>Min Beds</label>

                       <select class="advance_search form-control input-sm"  id="as_min_beds" name="as_min_beds" type="text" >

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

                                        </select>

                    </div>

                    

                    <div class="form-group">

                      	<label>Min Price</label>

                        <input type="text" id="as_min_price" name="as_min_price" class="form-control input-sm" value="" >

                       

                    </div>

                    

                    <div class="form-group">

                      	<label>Min Area</label>

                       <input type="text" id="as_min_area" name="as_min_area" class="advance_search form-control input-sm" value="" >

                    </div>

                   

                     

                      

                     <div class="form-group">

                      	<label>Date Enq From </label>

                        <div class="input-group">

                        <input type="text" class="form-control input-sm datepicker" id="as_date_enq_from"     name="as_date_enq_from">

                        <div class="input-group-addon">

                        <i class="fa fa-calendar"></i>

                        </div>

                        </div>

                       

                    </div>

                    <div class="form-group">

                        <label>Unit</label>

                       

                        <input title="" type="text" id="as_unit" name="as_unit" class="advance_search form-control input-sm" value="" >

                    </div>

                    <div class="form-group">

                      	<label>Finance</label>

                         <select name="as_financial_situation" type="text" class="advance_search form-control input-sm" id="as_financial_situation" >

                                            <option value="" selected>Select</option>

                                            <option value="Cash">Cash</option>

                                            <option value="Loan (approved)">Loan (approved)</option>

                                            <option value="Loan (not approved)">Loan (not approved)</option>

                                        </select>

                    </div>

                  </div>

                  

                  <div class="col-md-6">

                  <div class="form-group">

                      	<label>Listing Ref</label>

                   

                        <input type="text" id="as_enquired_for_referance" name="as_enquired_for_referance" class="advance_search form-control input-sm" value="">

                    </div>

                    <div class="form-group">

                        <label>Max Beds</label>

                        <select class="advance_search form-control input-sm"  id="as_max_beds" name="as_max_beds" type="text"  >

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

                                        </select>

                     </div>

                     <div class="form-group">

                      	<label>Max Price</label>

                       <input type="text" id="as_max_price" name="as_max_price" class="advance_search form-control input-sm" value="" >

                    </div>

                     <div class="form-group">

                      	<label>Max Area</label>

                       <input type="text" id="as_max_area" name="as_max_area" class="advance_search form-control input-sm" value="" >

                    </div>

                    <div class="form-group">

                      	<label>Date Enq To </label>

                        <div class="input-group">

                        <input type="text" class="form-control input-sm datepicker" id="as_date_enq_to"     name="as_date_enq_to">

                        <div class="input-group-addon">

                        <i class="fa fa-calendar"></i>

                        </div>

                        </div>

                       

                    </div>

                    

                    <div class="form-group">

                      	<label>Created By</label>

                        <select id="as_created_by" name="as_created_by" type="text"  class="advance_search form-control input-sm">

                                           

                                                                                                

                                        </select>

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

            

            <div class="modal fade" id="share_excel_selected" tabindex="-1">

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Download Excel</h4>

                    <p>To download selected listings as excel,Please click the icon to start download. </p>

                  </div>

                  

                  <div class="modal-body">

                  

                     <div align="center" id="ExportTonewCSV">Please select any listing(s)</div>

                    

                  </div>

                  

                  <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>

                  </div>

                </div>

              </div>

            </div>

            <script>

                function leads_checkboxes(value) {

	$('#ExportTonewCSV').html('<a class="popup_a" href="<?php echo base_url();?>generate/exportnewCSV?exportCSV=' + value + '"><img src="<?php echo base_url();?>mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>');

}

</script> 

<script>

    $(document).ready(function() {

	$('#ExportToCSVALL').html('<div style="display:none;" id="downloadCSV_animation"><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div><a id="downloadCSV_div" class="popup_a" href="<?php echo base_url();?>generate/exportnewCSV?exportCSV=leads"><img src="<?php echo base_url();?>mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>');

	// update download button link

	$('#listings_row').change(function() {

		var value = [];

		var value_lead = [];

		var count = 0;

		$('#listings_row input:checked').each(function() {

			if($(this).attr('shared_f') != 1) {

				value_lead += $(this).attr('value') + ',';

			}

			value += $(this).attr('value') + ',';

			count++;

		}

		);

		

		$('#ExportTonewCSV').html('<a class="popup_a" href="<?php echo base_url();?>generate/exportnewCSV?exportCSV=' + value + '"><img src="<?php echo base_url();?>mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>');

				//$('#sms-iframe-agent').attr('src', 'https://crm.propspace.com/sendSMS/showSMSLeadsFormAgents/' + value);

		//$('#sms-iframe-lead').attr('src', 'https://crm.propspace.com/sendSMS/showSMSLeadsFormLeads/' + value_lead);

			}

	);

	$('#match_count_div').click(function() {

		//$('#matching_properties input').attr('checked', false);

		//$('#email_count').html(0);

	}

	);

      

        

  

}

);



</script>

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

                   <div id="columns_list"></div>

	   					 <div style="margin: 10px 0 3px 10px;"><span id="total_active_columns" style="font-weight:bold;">0</span> out of <span id="total_editable_columns" style="font-weight:bold;"></span> columns are selected</div>

                  </div>

                  

                  <div class="modal-footer">

                    <button type="button" class="btn btn-success" id="save_columns_settings"><i class="fa fa-save"></i> Save</button>

                    <button type="button" class="btn btn-primary" id="reset_columns_settings"><i class="fa fa-refresh"></i> Reset</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal" id="listing-closeandsave"><i class="fa fa-close"></i> Cancel</button>

                  </div>

                </div>

              </div>

            </div> 

            <script>

    function setSelectedCheckboxes() {

        var cVal = '';

        var cVal_lead = '';

        $('#listings_row input:checked').each(function() {

            if($(this).attr('shared_f') != 1){

                 cVal_lead += $(this).attr('value') + ',';

            }

                 cVal += $(this).attr('value') + ',';

        });

        //$('#sms-iframe-agent').attr('src', 'https://crm.propspace.com/sendSMS/showSMSLeadsFormAgents/' + cVal );

       // $('#sms-iframe-lead').attr('src', 'https://crm.propspace.com/sendSMS/showSMSLeadsFormLeads/' + cVal_lead);

    }

    $(document).ready(function() {

        $('#listings_row_landlord').next().hide();

        $('#listings_row_landlord').hide();

    

    });

</script>