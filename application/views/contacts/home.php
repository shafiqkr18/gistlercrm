<script>

$(document).ready(function() {

	var init_id=9000000000000007777777777770;

	var oTable = $('#owned_properties').dataTable( {

					"bProcessing": true,

					"bServerSide": true,

				//	"bRegex": true,

					 'columnDefs': [{

        // 'targets': 0,

        // 'searchable':false,

        // 'orderable':false,

        // 'className': 'dt-body-center',

        

		 	 'render': function (data, type, full, meta){

			

           //  $('#check_all_checkboxes_owner').attr('checked', false);

			// return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';

			return '<div style="text-align:center; width:22px;" id="item_action"><input type="radio" name="select_landlord" style="opacity:1;" id="checkbox_'+ data +'" value="'+ data +'"></div>';

         }

     

      }],

				

"aoColumns": [

						{ "mDataProp": "id" },

            { "mDataProp": "ref" },

						{ "mDataProp": "type" },

						{ "mDataProp": "category_id" },

						{ "mDataProp": "region_id" },

						{ "mDataProp": "area_location_id" },

						{ "mDataProp": "sub_area_location_id" },

						{ "mDataProp": "beds" },

						{ "mDataProp": "size" },

						{ "mDataProp": "price" },

						{ "mDataProp": "agent_id" },

						{ "mDataProp": "dateadded" }

            ],

						"columns": [

						{ "data": "id" },

						{ "data": "ref" },

						{ "data": "type" },

						{ "data": "category_id" },

						{ "data": "region_id" },

						{ "data": "area_location_id" },

						{ "data": "sub_area_location_id" },

						{ "data": "beds" },

						{ "data": "size" },

						{ "data": "price" },

						{ "data": "agent_id" },

						{ "data": "dateadded" }

					

						],

					"sDom": '<>rt<ilp><"clear">',

					"sAjaxSource": "<?php echo base_url();?>contacts/ownedproperties",

					"iDisplayStart": 0,

                     "bLengthChange": false,

					"sPaginationType": "full_numbers",

					"oLanguage": {

					"sSearch": "Search all columns:"

					},

					'fnServerData': function (url, data, callback) 

						{

							data.landlord_id = init_id;

							

						  $.ajax

						  ({

							'dataType': 'json',

							'type'    : 'POST',

							'url'     : url,

							'data'    : data,

							'success' : callback

							

						  });

						}

				} );

	$("#searchbox2 input").keyup( function () {

		/* Filter on the column (the index) of this element */

		oTable.fnFilter( this.value, $(this).attr('id') );

	} );

	$("#searchbox2 select").change( function () {

		/* Filter on the column (the index) of this element */

		

		oTable.fnFilter( this.value, $(this).attr('id') );

	} );

	$("#show_owner_properties_click").click(function () {

		init_id=$('#id').attr('value');

		$('#landllord_name_matchbox').text($('#name').val()+' '+$('#last_name').val());

		oTable.fnDraw();

	});

	$("#notes").keyup( function () {

		var d 		= new Date();

		var date 	= d.getDate();

		var month 	= ((d.getMonth()+1)<10?'0':'') + (d.getMonth()+1);

		var year 	= d.getFullYear();

		var hours 	= d.getHours();

		var minutes	= (d.getMinutes()<10?'0':'') + d.getMinutes();

		$('#notesx').val('Latest: '+date+'-'+month+'-'+year+' '+hours+':'+minutes);

                $("#save-notes").css('display','');



	} );



        $("#save-notes").click( function () {



            if(formDataChange == true && $('#notes').val() !=''){

                var notesVal=$('#notes').val();

                var d 		= new Date();

		var date 	= d.getDate();

		var month 	= ((d.getMonth()+1)<10?'0':'') + (d.getMonth()+1);

		var year 	= d.getFullYear();

		var hours 	= d.getHours();

		var minutes	= (d.getMinutes()<10?'0':'') + d.getMinutes();

                var latest = date+'-'+month+'-'+year+' '+hours+':'+minutes;

                $('#shownotes').prepend('<div style="border-bottom:#999 solid 1px; padding: 0px 0px 5px 0px; margin: 5px 5px 0px 5px;"><div style="display:inline-block; width:50%; padding: 3px 0 3px 0;">User: Mahmoud Khalil</div><div style="display:inline-block;  width:50%; padding: 3px 0 3px 0; text-align:right;">Date: '+latest+'</div><div style="padding:3px 0 3px 0;">Note: '+notesVal+'</div></div>');

    		$("#notes").val('');

                arr_notes.push(notesVal);

                $("#save-notes").css('display','none');

            }

        });





         //resetCSSFields();

         //setCSSFields();



         $(".address-save").click( function () {

             var box_description = '';

            if($("#po_box").val()!= ''){

               box_description += 'P.O.Box:'+ $("#po_box").val()+', \n' ;



            }

            if($("#address_line_1").val() != ''){

               box_description += toTitleCase($("#address_line_1").val()) +', \n' ;

            }

            if($("#address_line_2").val() != ''){

               box_description += toTitleCase($("#address_line_2").val())+', \n' ;

            }



            if($("#address_zip_po_box").val() != ''){

               box_description += 'Zip Code:' +$("#address_zip_po_box").val()+', \n' ;

            }

            if($("#address_city").val() != ''){

               box_description += 'City:'+toTitleCase($("#address_city").val())+', \n' ;

            }

            if($("#address_state").val() != ''){

               box_description += 'State:'+toTitleCase($("#address_state").val())+' \n' ;

            }

            if($("#address_country").val() != ''){

               box_description += 'Country:'+$("#address_country").val()+' \n' ;

            }

            $("#address").val(box_description);



         });



    $(".address2-save").click( function () {

        var box_description = '';

        if($("#address2_po_box").val()!= ''){

            box_description += 'P.O.Box:'+ $("#address2_po_box").val()+', \n' ;



        }

        if($("#address2_line_1").val() != ''){

            box_description += toTitleCase($("#address2_line_1").val()) +', \n' ;

        }

        if($("#address2_line_2").val() != ''){

            box_description += toTitleCase($("#address2_line_2").val())+', \n' ;

        }



        if($("#address2_zip_po_box").val() != ''){

            box_description += 'Zip Code:' +$("#address2_zip_po_box").val()+', \n' ;

        }

        if($("#address2_city").val() != ''){

            box_description += 'City:'+toTitleCase($("#address2_city").val())+', \n' ;

        }

        if($("#address2_state").val() != ''){

            box_description += 'State:'+toTitleCase($("#address2_state").val())+' \n' ;

        }

        if($("#address2_country").val() != ''){

            box_description += 'Country:'+$("#address2_country").val()+' \n' ;

        }

        $("#address2").val(box_description);



    });



         $(".social-add").click( function () {

                $("#facebook_text").val($("#facebook").val());

                $("#twitter_text").val($("#twitter").val());

                $("#linkedin_text").val($("#linkedin").val());

                $("#skype_text").val($("#skype").val());

         });



         $(".social-save").click( function () {

                $("#facebook").val($("#facebook_text").val());

                $("#twitter").val($("#twitter_text").val());

                $("#linkedin").val($("#linkedin_text").val());

             $("#skype").val($("#skype_text").val());

         });



         $(".save-pop").click( function () {



            if($("#phone").val() != '' || $("#c_code_phone_1_field").val() != ''){

                 $("#c_code_phone_1_p_field").val($("#c_code_phone_1_field").val());

                 $("#phone_1_p").val($("#phone").val());

                 $("#c_code_phone_1_p").val($("#c_code_phone_1").val());

            }



            if($("#mobile_no_new").val() != ''){

              $("#mobile_no_new_ccode_1_field").val($("#mobile_no_new_ccode_field").val());

              $("#mobile_1").val($("#mobile_no_new").val());

              $("#mobile_no_new_ccode_1").val($("#mobile_no_new_ccode").val());

            }



            if($("#fax").val() != '' || $("#c_code_fax_field").val() != ''){

              $("#c_code_fax_1_field").val($("#c_code_fax_field").val());

              $("#fax_1").val($("#fax").val());

              $("#c_code_fax_1").val($("#c_code_fax").val());

            }

            if($("#email").val() != ''){

                 $("#email_1").val($("#email").val());

            }





         });



         $(".phone-save").click( function () {

//             phone number 1

            $("#c_code_phone_1_field").val($("#c_code_phone_1_p_field").val());

            $("#c_code_phone_1").val($("#c_code_phone_1_p").val());

            $("#phone").val($("#phone_1_p").val());



         });



         $(".save-mob").click( function () {

                $("#mobile_no_new_ccode_field").val($("#mobile_no_new_ccode_1_field").val());

                $("#mobile_no_new_ccode").val($("#mobile_no_new_ccode_1").val());

                $("#mobile_no_new").val($("#mobile_1").val());

         });



         $(".save-fax").click( function () {

                $("#c_code_fax_field").val($("#c_code_fax_1_field").val());

                $("#c_code_fax").val($("#c_code_fax_1").val());

                $("#fax").val($("#fax_1").val());

         });

         $(".save-email").click( function () {

                $("#email").val($("#email_1").val());

         });

        $(".save-nationilty").click(function(){

            $("#nationality_new").val($("#nationality").val());

        })



        $("#nationality_new").change(function(){

            $("#nationality").val($("#nationality_new").val());

        })

    $("#native_language").change(function(){

        $("#language1").val($("#native_language").val());

    })



    $(".save-languages").click(function(){

        $("#native_language").val($("#language1").val());

    })



} );





</script>

<script>

var screenname='contacts';

/* Check for value change in form */

var formDataChange = false;

	$(document.body).on('change', "#myForm",function (event)

	{

	   formDataChange = true;

	});

window.onbeforeunload = function() {

  if (formDataChange) {

    return 'Data not saved!';

  }

}





//datatable initilization

$(document).ready(function() {

	$("#notes").keypress(function (evt) {

  var keycode = evt.charCode || evt.keyCode;

  //alert(keycode);

  if (keycode  == 34 || keycode  == 39 || keycode  == 47 || keycode  == 92 || keycode  == 13) { //Enter key's keycode

    return false;

  }

});

	$("#notesx").keypress(function (evt) {

  var keycode = evt.charCode || evt.keyCode;

  //alert(keycode);

     return false;

});







/* generate column list start*/

	var column_count = 0;

	var column_names = [];



	$.each($('#listings_row thead th'), function() {

		column_names.push($(this).text()+'|'+column_count+'|'+$(this).attr('type'))

		column_count++;

    });



	column_names.sort();



	var column_count = 0;

	var editable_columns = 0;

  var default_columns = new Array();



	for (column_count = 0; column_count < column_names.length; ++column_count) {

		var single_column = column_names[column_count];

		single_column = single_column.split('|')

		var column_name = single_column[0];

		var column_id	= single_column[1];

		var column_type	= single_column[2];

        var read_only_columns = new Array('1','2','4','5','13','17','26','27');

		if(column_id!=0 && column_id!=28 && column_id!=29 && column_id!=57 && column_id!=1){

            if( $.inArray(column_id, read_only_columns) > -1 ) {

               // $('#columns_list').append("<div class='column-selection-holder'><input type='checkbox'" +  ' disabled="disabled" '   + "default='"+column_type	+"' checked name='column_"+column_id+"' id='column_"+column_id+"' data-index='"+editable_columns+"' col='"+column_id+"' value='1' tabindex='33' checked><span>"+column_name+"</span></div>");

			   $('#columns_list').append("<div class='col-md-4'><div class='form-group form_group_checkbox'><input type='checkbox'" +  ' disabled="disabled" '   + "default='"+column_type +"' checked name='column_"+column_id+"' id='column_"+column_id+"' col='"+column_id+"' value='1' tabindex='33' checked><span class='lbl padding'>"+column_name+"</span></div></div>");

            } else {

             //   $('#columns_list').append("<div class='column-selection-holder'><input type='checkbox' default='"+column_type	+"' checked name='column_"+column_id+"' id='column_"+column_id+"' data-index='"+editable_columns+"' col='"+column_id+"' value='1' tabindex='33'><span>"+column_name+"</span></div>");

			         $('#columns_list').append("<div class='col-md-4'><div class='form-group form_group_checkbox'><input type='checkbox' default='"+column_type  +"' checked name='column_"+column_id+"' id='column_"+column_id+"' col='"+column_id+"' value='1' tabindex='33'><span class='lbl padding'>"+column_name+"</span></div></div>");

               default_columns.push(column_id);

            }

            editable_columns++;

		}

	}



  //#k reset showing columns to default

  $("#reset_columns_settings, #btn-close-managecolumns").click(function(){

    //alert(default_columns);

    $.each(default_columns, function(){

      $("#column_" + this).prop("checked", true);

    });

  });











	$('#total_editable_columns').html(editable_columns);

/* generate column list end */



	var oTable = $('#listings_row').dataTable( {

					"bProcessing": false,

					"bServerSide": true,

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

						{ "bSortable": false, "aTargets": [ 0 ] },

						{ "bVisible" : false, "aTargets": [ 28,29,7,8,9,6,20,21,19,16,15,25,22,14,23,3,10,24,12, ] }

					],

					"rowCallback": function( row, data ) {

				 $(row).attr("id",data.id);

				 

				  if ( data.auto == 1 )

					  {

					  $('td:eq(1)', row).html( '<img title="Auto Imported" id="imgunpub" src="<?php echo base_url();?>mydata/images/header_auto.png">' );

					  }else{

						   $('td:eq(1)', row).html( '');

					  }

					  return row;

        			},

				 "aoColumns": [

			{ "mDataProp": "id" },

      { "mDataProp": "auto" },

			{ "mDataProp": "ref" },

			{ "mDataProp": "gender" },

			{ "mDataProp": "name" },

			{ "mDataProp": "last_name" },

      { "mDataProp": "company" },

      { "mDataProp": "address_line_1" },

      { "mDataProp": "address_line_2" },

      { "mDataProp": "address_city" },

      { "mDataProp": "address_state" },

			{ "mDataProp": "address_country" },

			{ "mDataProp": "address_zip_po_box" },

			{ "mDataProp": "phone" },

			{ "mDataProp": "phone_2" },

      { "mDataProp": "fax" },

      { "mDataProp": "address2_zip_po_box" },

      { "mDataProp": "mobile_no_new" },

      { "mDataProp": "email" },

      { "mDataProp": "email_2" },

			{ "mDataProp": "dob" },

			{ "mDataProp": "designation" },

			{ "mDataProp": "nationality_new" },

			{ "mDataProp": "title" },

      { "mDataProp": "phone_3" },

      { "mDataProp": "assigned_to_id" },

      { "mDataProp": "dateupdated" },

      { "mDataProp": "NIL" },

      { "mDataProp": "NIL1" },

			{ "mDataProp": "phone_3" },

			{ "mDataProp": "mobile_3" },

      { "mDataProp": "fax_2" },

      { "mDataProp": "fax_3" },

      { "mDataProp": "email_3" },

      { "mDataProp": "website" },

      { "mDataProp": "facebook" },

			{ "mDataProp": "twitter" },

			{ "mDataProp": "linkedin" },

      { "mDataProp": "googleplus" },

      { "mDataProp": "instagram" },

      { "mDataProp": "wechat" },

      { "mDataProp": "skype" },

      { "mDataProp": "nationality" },

			{ "mDataProp": "nationality_1" },

			{ "mDataProp": "address2_line_1" },

      { "mDataProp": "address2_line_2" },

			{ "mDataProp": "address2_city" },

			{ "mDataProp": "address2_state" },

			{ "mDataProp": "address2_country" },

      { "mDataProp": "address2_po_box" },

			{ "mDataProp": "native_language" },

			{ "mDataProp": "second_language" },

			{ "mDataProp": "source_of_contact" },

      { "mDataProp": "source_of_contact" },

			{ "mDataProp": "contact_type" },

			{ "mDataProp": "dateadded" },

			{ "mDataProp": "created_by" }

     ],

			"columns": [

{ "data": "id" },

{ "data": "auto" },

{ "data": "ref" },

{ "data": "gender" },

{ "data": "name" },

{ "data": "last_name" },

{ "data": "company" },

{ "data": "address_line_1" },

{ "data": "address_line_2" },

{ "data": "address_city" },

{ "data": "address_state" },

{ "data": "address_country" },

{ "data": "address_zip_po_box" },

{ "data": "phone" },

{ "data": "phone_2" },

{ "data": "fax" },

{ "data": "address2_zip_po_box" },

{ "data": "mobile_no_new" },

{ "data": "email" },

{ "data": "email_2" },

{ "data": "dob" },

{ "data": "designation" },

{ "data": "nationality_new" },

{ "data": "title" },

{ "data": "phone_3" },

{ "data": "assigned_to_id" },

{ "data": "dateupdated" },

{ "data": "NIL" },

{ "data": "NIL1" },

{ "data": "phone_3" },

{ "data": "mobile_3" },

{ "data": "fax_2" },

{ "data": "fax_3" },

{ "data": "email_3" },

{ "data": "website" },

{ "data": "facebook" },

{ "data": "twitter" },

{ "data": "linkedin" },

{ "data": "googleplus" },

{ "data": "instagram" },

{ "data": "wechat" },

{ "data": "skype" },

{ "data": "nationality" },

{ "data": "nationality_1" },

{ "data": "address2_line_1" },

{ "data": "address2_line_2" },

{ "data": "address2_city" },

{ "data": "address2_state" },

{ "data": "address2_country" },

{ "data": "address2_po_box" },

{ "data": "native_language" },

{ "data": "second_language" },

{ "data": "source_of_contact" },

{ "data": "source_of_contact" },

{ "data": "contact_type" },

{ "data": "dateadded" },

{ "data": "created_by" }
],

					"aaSorting" : [[ 27, 'desc' ]],

					"bRegex": true,

					"iDisplayLength": 25,

					"sAjaxSource": config.siteUrl+"contacts/datatable",

					"iDisplayStart": 0,

					"sPaginationType": "full_numbers",

					'fnServerData': function (url, data, callback){ 

								data.dateupdated = $('#listings_row #dateupdatedS').val();

								data.dateadded = $('#listings_row #datecreatedS').val();

								data.landlord_id = '';

								data.listing_type = '<?php echo $listing_type;?>';

                   $.ajax

								  ({

									'dataType': 'json',

									'type'    : 'POST',

									 "url": url, 

                    "data": data, 

									 "success": function(json) {

                               callback(json);

                              



                       }

								  });

					}

				} );



$('.datatable-setbotclass').next().addClass('fixedpagination-bottom');



/* Code to hide/show columns START */



		/* hide the search columns */

					$('#searchbox1 tr').find("td:nth-child("+(7+2)+")").css('display', 'none');

			$('#column_7').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(8+2)+")").css('display', 'none');

			$('#column_8').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(9+2)+")").css('display', 'none');

			$('#column_9').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(6+2)+")").css('display', 'none');

			$('#column_6').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(20+2)+")").css('display', 'none');

			$('#column_20').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(21+2)+")").css('display', 'none');

			$('#column_21').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(19+2)+")").css('display', 'none');

			$('#column_19').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(16+2)+")").css('display', 'none');

			$('#column_16').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(15+2)+")").css('display', 'none');

			$('#column_15').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(25+2)+")").css('display', 'none');

			$('#column_25').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(22+2)+")").css('display', 'none');

			$('#column_22').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(14+2)+")").css('display', 'none');

			$('#column_14').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(23+2)+")").css('display', 'none');

			$('#column_23').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(3+2)+")").css('display', 'none');

			$('#column_3').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(10+2)+")").css('display', 'none');

			$('#column_10').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(24+2)+")").css('display', 'none');

			$('#column_24').attr('checked', false);

					$('#searchbox1 tr').find("td:nth-child("+(12+2)+")").css('display', 'none');

			$('#column_12').attr('checked', false);

				setDatatableWidth();

		/* hide the search columns end */

	function setDatatableWidth(){

              var TotalColumnsUnchecked = $('#columns_list input:checked').length;

              if(TotalColumnsUnchecked<10){

              		$('#listings_row').css('width', '100%');

			  }

              if(TotalColumnsUnchecked>11){

              		$('#listings_row').css('min-width', TotalColumnsUnchecked*110+'px');

              }else{

              		$('#listings_row').css('min-width', '100%');

              }

    }



	$('#total_active_columns').html($('#columns_list input:checked').length)



	function fnShowHide( iCol )

	{

		var oTable = $('#listings_row').dataTable();

		var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;



		if(bVis==true){

			$('#searchbox1 tr').find("td:nth-child("+((iCol*1)+2)+")").css('display', 'none');

		} else if(bVis==false){

			$('#searchbox1 tr').find("td:nth-child("+((iCol*1)+2)+")").css('display', '');

		}

		oTable.fnSetColumnVis( iCol, bVis ? false : true );

		setDatatableWidth();

	}





	$('#columns_list input').change( function () {

			fnShowHide( $(this).attr('col') )

			$('#total_active_columns').html($('#columns_list input:checked').length)

	});



	$(document.body).on("click", "#save_columns_settings", function(event){

		var disabled_columns_array = [];

		$('#columns_list input[type="checkbox"]:unchecked').each(function() {

			   disabled_columns_array.push($(this).attr('col'));

		});



		$.post("<?php echo base_url();?>common/save_disabled_columns/", {

			columns: disabled_columns_array,
      screenname: 'contacts',

		}, function(info) {

			$('a.close').click();

		});

	} );



	$(document.body).on("click", "#reset_columns_settings", function(event){

		$('#columns_list input[type="checkbox"]').each(function() {

			 if($(this).attr('checked')=='checked' && $(this).attr('default')=='not_default'){

				 fnShowHide( $(this).attr('col') )

				 $(this).attr('checked',false)

			 }else if($(this).attr('checked')==false && $(this).attr('default')!='not_default'){

				 fnShowHide( $(this).attr('col') )

				 $(this).attr('checked',true)

			 }

			 $('#total_active_columns').html($('#columns_list input:checked').length)

		});

	setDatatableWidth();

	} );





/* Code to hide/show columns END */



	$('#dateupdatedS').datepicker({

		dateFormat: 'dd-mm-yy',

		onClose: function(dateText, inst) { oTable.fnDraw(false); $('#reset_filter').css('display', ''); }

	})



    $('#datecreatedS').datepicker({

        dateFormat: 'dd-mm-yy',

        onClose: function(dateText, inst) { oTable.fnDraw(false); $('#reset_filter').css('display', ''); }

    })





            $(document.body).on("click", "#listings_row .sorting", function(event){

                 oTable.fnFilter( $(this).attr('value'), $(this).attr('id_search') );

                  $('#'+$(this).attr('id_search')+' img').attr('src', $(this).attr('image'));

                  $('#listings_row #reset_filter').css('display', '');

           } );





	$("#searchbox1 input").keyup( function () {

		/* Filter on the column (the index) of this element */
    console.log(this.value+"="+$(this).attr('id'))
		oTable.fnFilter( this.value, $(this).attr('id') );

		$('#reset_filter').css('display', '');

	} );

	$("#searchbox1 select").change( function () {

		/* Filter on the column (the index) of this element */

		oTable.fnFilter( this.value, $(this).attr('id') );

		$('#reset_filter').css('display', '');

	} );

	//reset filter and drawtable

	$("#reset_filter").click(function () {

			$("#myForm2")[ 0 ].reset();

			oTable.fnDraw(false);

                        oTable.fnFilterClear(true);

                          $("#listings_row .click img").attr("src", "<?php echo base_url();?>application/views/images/arrow.png?ts=10");

			$('#reset_filter').css('display', 'none');

	});

//change css of selected row

	$(document.body).on("click", "#listings_row tbody tr, .overflow", function(event){

		//alert($(this).attr('id'));

		if(formDataChange==false){

		  $("td.yellowCSS", oTable.fnGetNodes()).removeClass("yellowCSS");

		  $('#listings_row tbody #'+$(this).attr('rel')).find("td").addClass("yellowCSS");

		  $(event.target).parent().find("td").addClass("yellowCSS");

		}

	});

// check box delete

	$(document.body).on("click", '.dbstatus', function() {

	if($('#listings_row input').is(':checked')){

		if(confirm("Are you sure you want to delete this Contact? Deleting an Contact will remove the Contact record from any properties, contracts, deals or tasks assigned to this Contact, but it wont remove any of the Contact's properties or other records.")){

			 var allVals = [];

			 type = $(this).attr('id');

			 $('input[type="checkbox"]:checked').each(function() {

			   allVals.push($(this).val());

			   name=$(this).attr('id');

			 });



						$.post( '<?php echo base_url();?>landlord/status/', { ids: allVals, type:$(this).attr('id') },

						  function( data ) {

							 $("#myForm")[ 0 ].reset();

							 $('#edit').css('display', 'none'); /* This shows the update button when a filed is selected */

						     $('#new').css('display', 'inline'); /* This shows the update button when a filed is selected */

							  oTable.fnDeleteRow( 47 );

							  $('#showdata').html(data);

							  $('#showdata').animate({ 'color': 'red'}, "slow");

						  }

					);

		}

	 }

	 else {

	 	//alert('Please select at least one entry!');

		$('#checkbox_error').show(400);

	 }

     });

	$("#EmailPDF").load("<?php echo base_url();?>leads/emailPDFtables/landlord") // this line updates the div for emailPDF

	$("#EmailCSV").load("<?php echo base_url();?>leads/emailCSV/landlord") // this line updates the div for emailCSV





   $("#mobile_no_new, #email").change( function () {

         if(this.id == 'mobile_no_new'){

            $("#email").removeClass('form_fields_error');

         }else if(this.id == 'email'){

            $("#mobile_no_new").removeClass('form_fields_error');

         }

    });



} );

/* Insert / Update function */

		 $(document).ready(function() {

			$('#myForm').ajaxForm({



			  beforeSubmit : function() {

			  var lookup	 = false;

			  var validate 	 = false;

			  var fields_set = false;



			//validate or check only new entry users

			if($('#id').val()>0)

			{

				  $.ajax({

					 async: false,

					 url: mainurl+'contacts/lookupnew/?mobile_no_new='+$('#mobile_no_new').val()+'&email='+$('#email').val(),

					 success: function(data) {

						

						if(data>0){

						lookup = false;

					   alert("This contact already exist in company database.");

						 }

						else{

						lookup = true;

						}

					 }

				   })

			}else{

				 lookup = true;

			}

			 validate =  $("#myForm").validate({rules: { email: { email:true}, mobile_no_new: {number:true}} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) {

				  $("#mobile_no_new").addClass('form_fields_error');

                    $("#email").addClass('form_fields_error');

						//$(element).attr({"title": error.text('asdasd')});

							  $('#errortxt').text('Please complete all required fields');

                                $('#errorMsg').animate({ 'color': 'red'}, "slow");

                                $('#errorMsg').fadeIn("slow");

							setTimeout(function() {

								$('#errorMsg').fadeOut("slow");

								$('#errorMsg').animate({ 'color': 'red'}, "slow");

						    }, 5000);

						//alert('Please fill the required fields')

					}}).form() ;

validate =  true;

				if(lookup && validate){

					return true;

				}

				else{

                   return false;

					}

			  },

             data:{arr_notes:window.arr_notes},

			  target: '#successtxt',

			  success: function() {

          // fnClickAddRow();

          formDataChange=false;

          if($("#ref").val()==''){

          // $.ajax({

          //						  async: false,

          //						  url: mainurl+'landlord/getlastid/',

          //						  success: function(data) {

          //							last_id=data;

          //						  }

          //						})

          }



          $("#cancel").click(),

          $('#successtxt').text('To edit or add new record please click on the edit or new button');

          $('#errorMsg').animate({ 'color': '#49AC44'}, "slow"),

          $('#errorMsg').fadeIn("slow"),

          setTimeout(function() {

            $('#errorMsg').fadeOut("slow")

          }, 5000);



          //#k: redraw table on save/update

          $("#listings_row").DataTable().draw();

			  }

			});

		  });



       



//end update

/* Fetch single item details */

var last_id = 0;

var count = 0;

function formatPhoneNumber(code, number) {

    if(!number || number == "" || number ==0) {

        return "--";

    }

    var phone = '';

    if(code && code != 0) {

        phone += '+'+code+' ';

    }

    if(number && number != 0) {

        phone += number;

    }

    return  phone || '--';

}



function getAddress(json, type) {

    var prefix = (type == "personal") ? "address_" : "address2_";

    var arrAddress = [];

    if(type == "personal") {

        if(filterValue(json.po_box)) {

            arrAddress.push("P.O Box : " + json.po_box);

        }

    }

    else{

        if(filterValue(json.address2_po_box)) {

            arrAddress.push("P.O Box : " + json.address2_po_box);

        }

    }

    if(filterValue(json[prefix+"line_1"])) {

        arrAddress.push(json[prefix+"line_1"]);

    }

    if(filterValue(json[prefix+"line_2"])) {

        arrAddress.push(json[prefix+"line_2"]);

    }

    if(filterValue(json[prefix+"city"])) {

        arrAddress.push(json[prefix+"city"]);

    }

    if(filterValue(json[prefix+"state"])) {

        arrAddress.push(json[prefix+"state"]);

    }

    if(filterValue(json[prefix+"country"])) {

        arrAddress.push(json[prefix+"country"]);

    }

    if(filterValue(json[prefix+"zip_po_box"])) {

        arrAddress.push("Zip : " + json[prefix+"zip_po_box"]);

    }





    return (arrAddress.length > 0) ? arrAddress.join(", ") : '--';

}



function filterValue(value) {

    value = $.trim(value);

    if(!value || value== "" || value ==0 || value == "0") {

        return false;

    }

    return value;

}



function getSingleRow(id){

							$('#update, #Save').css('display', 'none');

                            $("#save-notes").css('display','none');

							$('#myForm input, #myForm select, #myForm textarea').attr('disabled', true);

							animate_the_form_table_on_click();

                            $.getJSON("<?php echo base_url();?>/contacts/single/"+id, function(json){



                                $("#contact_personal .mobile").html(formatPhoneNumber(json.overlappedfield, json.mobile_no_new));

                                $("#contact_work .mobile").html(formatPhoneNumber(json.overlappedfield_2, json.mobile_2));

                                $("#contact_other .mobile").html(formatPhoneNumber(json.overlappedfield_3, json.mobile_3));



                                $("#contact_personal .phone").html(formatPhoneNumber(json.c_code_phone_1_field, json.phone));

                                $("#contact_work .phone").html(formatPhoneNumber(json.c_code_phone_2_field, json.phone_2));

                                $("#contact_other .phone").html(formatPhoneNumber(json.c_code_phone_3_field, json.phone_3));





                                $("#contact_personal .fax").html(formatPhoneNumber(json.c_code_fax_field, json.fax));

                                $("#contact_work .fax").html(formatPhoneNumber(json.c_code_fax_2_field, json.fax_2));

                                $("#contact_other .fax").html(formatPhoneNumber(json.c_code_fax_3_field, json.fax_3));



                                $("#contact_personal .email_id").html( (filterValue(json.email) || '--') );

                                $("#contact_work .email_id").html( (filterValue(json.email_2) || '--') );

                                $("#contact_other .email_id").html( (filterValue(json.email_3) || '--') );



                                $("#contact_personal .address").html(getAddress(json, 'personal'));

                                $("#contact_work .address").html(getAddress(json, 'work'));



							 $.each(json, function(key, val) {



								$("#myForm #"+key).val(val);

								$("#myForm #mobile_no_new").val(json.mobile_no_new);





								$("#myForm #mobile_no_new_ccode_field").val(json.overlappedfield);



                                if(json.overlappedfield_2 != '' && json.overlappedfield_2 != '0'){

                                    $("#myForm #mobile_no_new_ccode_2_field").val(json.overlappedfield_2);

                                }

                                if(json.overlappedfield_3 != '' && json.overlappedfield_3 != '0'){

                                    $("#myForm #mobile_no_new_ccode_3_field").val(json.overlappedfield_3);

                                }

                                if(json.religion != '' && json.religion != '0'){

                                    $("#myForm #religion").val(json.religion);

                                }

                                if(val==0){

                                    $("#"+key).val("");

                                }

							 });





                               $('#edit').css('display', 'inline');

                                                        



							last_id = json.id;

							/* get stats */

							get_states(json.id)

							/* get notes */

							get_notes('contacts', json.id);



                                                        //get the documents of a listing

                                                        $("#showDocuments").html('No documents found for this contact.');

                                                        if(json.documents && (json.documents != 'null')){



                                                            $("#showDocuments").html('');

                                                            var documents = $.parseJSON('['+json.documents+']');

                                                            count = 0 ;

                                                            $.each(documents, function(key, id) {

                                                                if(id.document_name != undefined){

                                            						$("#showDocuments").append('<div id="doc_div_'+id.document_name+'"><div class="document-list-item" ><div class="inline-block" >'+id.document_name+'</div><div  class="inline-block pull-right"></div><div class="inline-block pull-right"><a href="'+id.document_link+'" target="_blank" class="item-preview" onclick="return checkDocument();" title="View"><i class="icon-eye"></i></a> <a id='+id.document_link+' name='+id.document_name+' class="delete_list item-delete" href="# S" title="Delete"><i class="icon-trash"></i></a></div></div></div>');

                                                                    count++;

                                                                }

                                                                   });



                                                            $('#documents_count').val(count);

                                                        }else{



                                                            $('#documents_count').val(0);

                                                        }

                                                         if(json.gender && json.gender !='') {

                                                                $("select#gender option[value='"+json.gender+"']").text();

                                                            }



                                                            if(json.title && json.title !='') {

                                                                if($("select#title option[value='"+json.title+"']").length > 0) {

                                                                    $("select#title option[value='"+json.title+"']").attr("selected", "selected");

                                                                }

                                                                else {

                                                                    $("select#title option:last").attr('selected','selected');

                                                                }

                                                            }

                                                            else {

                                                                $("select#title option:last").attr('selected','selected');

                                                            }





//                                                        adress box

                                                          var box_description = '';

                                                          if(json.po_box != '' && json.po_box != '0'){

                                                             box_description += 'P.O.Box:'+ json.po_box+', \n' ;



                                                          }

                                                          if(json.address_line_1 != ''){

                                                             box_description += toTitleCase(json.address_line_1) +', \n' ;

                                                          }

                                                          if(json.address_line_2 != ''){

                                                             box_description += toTitleCase(json.address_line_2)+', \n' ;

                                                          }



                                                          if(json.address_zip_po_box != ''){

                                                             box_description += 'Zip Code:' +json.address_zip_po_box+', \n' ;

                                                          }

                                                          if(json.address_city != ''){

                                                             box_description += 'City:'+toTitleCase(json.address_city)+', \n' ;

                                                          }

                                                          if(json.address_state != ''){

                                                             box_description += 'State:'+toTitleCase(json.address_state)+' \n' ;

                                                          }

                                                          if(json.address_country != ''){

                                                             box_description += 'Country:'+json.address_country+' \n' ;

                                                          }



                                                          $("#address").val(box_description);



                                                            var box_description2 = '';

                                                            if( filterValue(json.address2_po_box) ){

                                                                box_description2 += 'P.O.Box:'+ json.address2_po_box+', \n' ;



                                                            }

                                                            if( filterValue(json.address2_line_1)) {

                                                                box_description2 += toTitleCase(json.address2_line_1) +', \n' ;

                                                            }

                                                            if( filterValue(json.address2_line_2)){

                                                                box_description2 += toTitleCase(json.address2_line_2)+', \n' ;

                                                            }



                                                            if(filterValue(json.address2_zip_po_box)){

                                                                box_description2 += 'Zip Code:' +json.address2_zip_po_box+', \n' ;

                                                            }

                                                            if( filterValue(json.address2_city) ) {

                                                                box_description2 += 'City:'+toTitleCase(json.address2_city)+', \n' ;

                                                            }

                                                            if(filterValue(json.address2_state)){

                                                                box_description2 += 'State:'+toTitleCase(json.address2_state)+' \n' ;

                                                            }

                                                            if(filterValue(json.address2_country)){

                                                                box_description2 += 'Country:'+json.address2_country+' \n' ;

                                                            }



                                                            $("#address2").val(box_description2);

                                                          //console.log(box_description);

                                                          //End adress box



                                                          // Begin Nationality

                                                            if(json.nationality != ''){

                                                                $("#nationality").val(json.nationality);

                                                                $("#nationality_new").val(json.nationality);

                                                            }



                                                            if(json.native_language != ''){

                                                                $("#native_language").val(json.native_language);

                                                                $("#language1").val(json.native_language);

                                                            }



                                                            if(json.second_language != ''){

                                                                $("#second_language").val(json.second_language);

                                                            }



                                                            if(json.source_of_contact != ''){

                                                                var contactSource = (json.source_of_contact && json.source_of_contact != 0) ? json.source_of_contact : "";

                                                                $("#source_of_contact").val(contactSource);

                                                                if(json.source_of_contact == "Other") {

                                                                    $("#other_source_of_contact").val(json.other_source_of_contact);

                                                                    $("#other_source_of_contact").show();

                                                                }

                                                                else {

                                                                    $("#other_source_of_contact").val("");

                                                                    $("#other_source_of_contact").hide();

                                                                }

                                                            }



                                                            if(json.contact_type != ''){

                                                                var contactType = (json.contact_type && json.contact_type != 0) ? json.contact_type : "";

                                                                $("#contact_type").val(contactType);

                                                                if(json.contact_type == 7) {

                                                                    $("#other_contact_type").val(json.other_contact_type);

                                                                    $("#other_contact_type").show();

                                                                }

                                                                else {

                                                                    $("#other_contact_type").val("");

                                                                    $("#other_contact_type").hide();

                                                                }

                                                            }



                                                            if(json.hobbies && json.hobbies != ''){

                                                                var hobbies = json.hobbies.split(",");

                                                                for(key in hobbies) {

                                                                    $("#hobbies option[value='"+hobbies[key]+"']").attr("selected", "selected");

                                                                }

                                                            }

                                                           // $("#hobbies").multipleSelect("refresh");



                                                          // End Nationality

                                                          //Begin Email

                                                          if(json.email != ''){

                                                             $("#email_1").val(json.email);

                                                          }

                                                          if(json.email_2 != '' && json.email_2 != '0'){

                                                             $("#email_2").val(json.email_2);

                                                          }else{

                                                            $("#email_2,.email_2").val("");

                                                          }

                                                          if(json.email_3 != '' && json.email_3 != '0'  ){

                                                             $("#email_3").val(json.email_3);

                                                          }else{

                                                            $("#email_3,.email_3").val("");

                                                          }

                                                          //End Email

                                                          // Begin Fax

                                                          if(json.c_code_fax_field != ''){

                                                             $("#c_code_fax_1_field").val(json.c_code_fax_field);

                                                          }

                                                           if(json.fax != '' && json.fax !='0'){

                                                             $("#fax_1").val(json.fax);

                                                          }

                                                          if(json.c_code_fax_2_field != ''){

                                                             $("#c_code_fax_2_field").val(json.c_code_fax_2_field);

                                                             $("#c_code_fax_4_field").val(json.c_code_fax_2_field);

                                                          }

                                                          if(json.fax_2 != '' && json.fax_2 != '0'){

                                                            $("#fax_2").val(json.fax_2);

                                                            $("#fax_4").val(json.fax_2);

                                                          }else{

                                                            $("#fax_2,.fax_2").val("");

                                                            $("#fax_4,.fax_4").val("");

                                                          }

                                                          if(json.c_code_fax_3_field != ''){

                                                              $("#c_code_fax_3_field").val(json.c_code_fax_3_field);

                                                              $("#c_code_fax_5_field").val(json.c_code_fax_3_field);

                                                           }

                                                          if(json.fax_3 != '' && json.fax_3 != '0'){

                                                             $("#fax_3").val(json.fax_3);

                                                             $("#fax_5").val(json.fax_3);

                                                          }else{

                                                              $("#fax_3,.fax_3").val("");

                                                              $("#fax_5,.fax_5").val("");

                                                          }

                                                           // End Fax

                                                           // Begin Phone

                                                           if(json.c_code_phone_1 != ''){

                                                                $("#c_code_phone_1_p").val(json.c_code_phone_1);

                                                           }



                                                           if(json.c_code_phone_1_field != ''){

                                                             $("#c_code_phone_1_p_field").val(json.c_code_phone_1_field);

                                                            }

                                                            if(json.phone != '' && json.phone != '0'){

                                                             $("#phone_1_p").val(json.phone);

                                                            }

                                                            if(json.c_code_phone_2_field != ''){

                                                             $("#c_code_phone_2_field").val(json.c_code_phone_2_field);

                                                             $("#c_code_phone_4_field").val(json.c_code_phone_2_field);

                                                            }

                                                            if((json.phone_2 != '') && (json.phone_2 != 0)){

                                                             $("#phone_2").val(json.phone_2);

                                                             $("#phone_4").val(json.phone_2);

                                                            }else{

                                                             $("#phone_2,.phone_2").val("");

                                                             $("#phone_4,.phone_4").val("");

                                                            }

                                                            if(json.c_code_phone_3 != ''){

                                                             $("#c_code_phone_3_field").val(json.c_code_phone_3_field);

                                                             $("#c_code_phone_5_field").val(json.c_code_phone_3_field);

                                                            }

                                                            if(json.phone_3 != '' && json.phone_3 != '0'){

                                                             $("#phone_3").val(json.phone_3);

                                                             $("#phone_5").val(json.phone_3);

                                                            }else{

                                                             $("#phone_3,.phone_3").val("");

                                                             $("#phone_5,.phone_5").val("");

                                                            }

//

//                                                           // End Phone

//                                                           // Begin Mobile

                                                            if(json.overlappedfield != ''){

                                                             $("#mobile_no_new_ccode_field").val(json.overlappedfield);

                                                             $("#mobile_no_new_ccode_1_field").val(json.overlappedfield);

                                                            }

                                                            // if(json.mobile != ''){

                                                            //  $("#mobile_no_new").val(json.mobile);

                                                            //  $("#mobile_1").val(json.mobile);

                                                            // }

                                                            if(json.overlappedfield_2 != ''){

                                                             $("#mobile_no_new_ccode_2_field").val(json.overlappedfield_2);

                                                             $("#mobile_no_new_ccode_4_field").val(json.overlappedfield_2);

                                                            }

                                                            if(json.mobile_2 != '' && json.mobile_2 != '0'){

                                                             $("#mobile_2").val(json.mobile_2);

                                                             $("#mobile_4").val(json.mobile_2);

                                                            }else{

                                                             $("#mobile_2,.mobile_2").val("");

                                                             $("#mobile_4,.mobile_4").val("");

                                                            }

                                                            if(json.overlappedfield_3 != ''){

                                                             $("#mobile_no_new_ccode_3_field").val(json.overlappedfield_3);

                                                             $("#mobile_no_new_ccode_5_field").val(json.overlappedfield_3);

                                                            }

                                                            if(json.mobile_3 != '' && json.mobile_3 != '0'){

                                                             $("#mobile_3").val(json.mobile_3);

                                                             $("#mobile_5").val(json.mobile_3);



                                                            }else{

                                                             $("#mobile_3,.mobile_3").val("");

                                                             $("#mobile_5,.mobile_5").val("");

                                                            }





                                                           // End Mobile

                                                          // Begin Social Media

                                                          if(json.facebook != ''){

                                                             $("#facebook_text").val(json.facebook);

                                                          }

                                                            if(json.skype != ''){

                                                                $("#skype_text").val(json.skype);

                                                            }

                                                          if(json.twitter != ''){

                                                             $("#twitter_text").val(json.twitter);

                                                          }

                                                          if(json.linkedin != ''){

                                                             $("#linkedin_text").val(json.linkedin);

                                                          }

                                                          if(json.googleplus != '' && json.googleplus != '0'){

                                                             $("#googleplus").val(json.googleplus);

                                                          }

                                                          if(json.instagram != '' && json.instagram != '0'){

                                                             $("#instagram").val(json.instagram);

                                                          }

                                                          if(json.wechat != '' && json.wechat != '0'){

                                                             $("#wechat").val(json.wechat);

                                                          }

                                                          // End Social Media

                                                          resetCSSFields();



                                                          if (json.phone !='' && json.phone != '0'){

                                                                $("#ph_link1").css('display','');

                                                                $("#ph_link1").trigger('click');

                                                          }

                                                          if (json.phone_2!='' && json.phone_2 != '0'){

                                                                $("#ph_link2").css('display','');

                                                          }

                                                          if (json.phone_3 !='' && json.phone_3 != '0'){

                                                                $("#ph_link3").css('display','');

                                                          }



                                                          if(json.mobile !='' && json.mobile != '0'){

                                                                $("#mob_link1").css('display','');

                                                                 $("#mob_link1").trigger('click');

                                                          }

                                                          if(json.mobile_2 !='' && json.mobile_2 != '0'){

                                                                $("#mob_link2").css('display','');

                                                          }

                                                          if(json.mobile_3 !='' && json.mobile_3 != '0'){

                                                                $("#mob_link3").css('display','');

                                                          }

                                                          if(json.fax != '' && json.fax != '0'){

                                                             $("#fax_link1").css('display','');

                                                             $("#fax_link1").trigger('click');

                                                          }

                                                          if(json.fax_2 != ''  && json.fax_2 != '0'){

                                                             $("#fax_link2").css('display','');

                                                          }

                                                          if(json.fax_3 != '' && json.fax_3 != '0'){

                                                             $("#fax_link3").css('display','');

                                                          }

                                                          if (json.email != '' && json.email != '0'){

                                                             $("#email_link1").css('display','');

                                                             $("#email_link1").trigger('click');

                                                          }

                                                          if (json.email_2 != '' && json.email_2 != '0'){

                                                             $("#email_link2").css('display','');

                                                          }

                                                          if (json.email_3 != '' && json.email_3 != '0'){

                                                             $("#email_link3").css('display','');

                                                          }



                                                          setCSSFields();

                                                          arr_notes.length = 0; //reset the array for images

							$("#title").text('Details for Contact: ' + json.name + ' ' + json.last_name);

                                                        $("#lastupdated").text('Updated: ' + json.dateupdated);

							$('#showdata').css('color','#49AC44');

							$('#showdata').html('Record selected')

							$('#showdata').fadeIn("slow");

							   setTimeout(function() {

								   $('#showdata').fadeOut("slow");

							   }, 5000);

						}); //End json

						formDataChange = false;

												disable_popup();

						    contactViewMode();

}

//fetch single listing

$(document.body).on("click", '#listings_row tbody tr', function() {



				if($(this).attr('id')!=''){

					if(formDataChange==true){

						var result=confirm("You have not saved the data, all changes will be lost!")

					}

					if(result==true || formDataChange==false){

						var id=$(this).attr('id');

						getSingleRow(id);



                                                  if ($('#'+id).hasClass("listing_rows_email")) {

                                        $('#autoImport').css('background-color','#EFFFEA');

                                        $('#automsg').css('display','');

                                    }else if($('#'+id).hasClass("listing_rows")){

                                         $('#autoImport').css('background-color','');

                                         $('#automsg').css('display','none');

                                    }

						}

					}





}); //End click



$(document).ready(function(){

	var this_screen_listing_id='';

	if(this_screen_listing_id){

     $.getJSON("<?php echo base_url();?>contacts/single/"+this_screen_listing_id, function(json){

					 $.each(json, function(key, val) {

						$("#"+key).val(val);

					 });

				get_notes('landlord', this_screen_listing_id);

		});

	$('#edit').css('display', 'inline');

	}



   // $("#hobbies").multipleSelect({filter: true, placeholder: "Select Hobbies"});

});



$(document).ready(function(){

    $('#new').click(function(){

        $("#created_by").val('<?php echo $username; ?>');

        $("#agent_id").val(current_agent_id);

    });

});



function setSelectedCheckboxes(){

    var value = [];

    var count = 0;

    $('#listings_row input:checked').each(function() {

        value+=$(this).attr('value')+',';

    });

    $('#sms-iframe').attr('src', '<?php echo base_url();?>sendSMS/showSMSLandlordForm/'+value);

}

</script>







    	<!-- wrapper start -->

            <div id="wrapper" class="leads">

            <div class="container">

            

            

            <!-- Page Heading -->

            <div class="row">

                <div class="col-lg-12">

                	<div class="page_head_area"><h1><i class="fa fa-user"></i> Contacts</h1></div>

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

            <!-- Auto Message Alert -->

             <div role="alert" class="alert alert-info alert-dismissible fade in" id="automsg" style="display:none;">

              <button aria-label="Close" data-dismiss="alert" class="close" type="button">

              <span aria-hidden="true">×</span></button>

              <strong>Info!</strong> <span id="infotxt">This contact has been auto imported from an email enquiry</span>  

            </div> 

            

            

            

            

            

            <div id="inner_tab">

            

            

            <div class="row">

            <div class="col-lg-12">

                  

            <!-- Tab content -->

            <div class="tab-content">

              <?php

		 $attributes = array('data-toggle' => 'validator', 'id' => 'myForm', 'role' => 'form');

	    echo form_open_multipart('contacts/submit', $attributes);

        ?>

              

          

              <!--buttons starts-->

              

              <button type="button" id="new" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>New Listing</button>



            <button  style="display:none;" type="submit" id="update"  class="btn btn-lg btn-success" name="Update" value="Update Listing">

            <i class="fa fa-plus-circle"></i> Save Listing</button>

             <button  style="display:none;" type="submit" id="Save"  class="btn btn-lg btn-success" name="Save" value="Save Listing">

            <i class="fa fa-plus-circle"></i> Save Listing</button>

       

                <button  style="display:none;" type="button" id="edit" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Listing</button>

            <a href="javascript:void(0)" id="cancel" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>

              <!--buttons ends-->

            

              <div class="row"><h4 class="add_new_rental">Add New Contact</h4></div>

              

               <!------------------hidden fields-->

                               <input name="id" class="form-control" id="id" type="hidden" value="0" hidden>

                                <input name="client_id" class="form-control" style="display:none;" id="client_id"  value="<?php echo $client_id;?>" readonly>

                                <input name="rand_key" type="text" style="display:none;" id="rand_key" readonly value="" >

                                 <input name="came_from" class="form-control" id="came_from" type="hidden" value="1" hidden>

                              

            

              

              

              <div class="row fadeInUp">



  	            <div class="col-md-3">



                  <h5 class="text-primary">Basic Details</h5>



                  <div class="form-group">

  	                <label>Ref</label>

  	                <input type="text" class="form-control input-sm"  disabled="disabled" readonly="readonly" id="ref" name="ref" >

  	              </div>

                  <div class="row">

                    <div class="col-md-6">

                          <div class="form-group">

                          <label>Title</label>

                          <select name="title" id="titleName" class=" form-control input-sm" >

                             <option value="Mr">Mr</option>

                                                    <option value="Mrs">Mrs</option>

                                                    <option value="Ms">Ms</option>

                                                    <option value="Miss">Miss</option>

                                                    <option value="Mx">Mx</option>

                                                    <option value="Master">Master</option>

                                                    <option value="Sir">Sir</option>

                                                    <option value="Madam">Madam</option>

                                                    <option value="Dr">Dr</option>

                                                    <option value="Prof">Prof</option>

                                                    <option value="Hon">Hon</option>

                                                    <option value="">Other</option>

                          </select>

                    </div>

                    </div>

                    <div class="col-md-6">

                      <div class="form-group">

                          <label>Gender</label>

                          <select name="gender" id="gender" class="form-control required input-sm" >

                            <option value="" selected="selected">Select</option>

                                            <option value="1">Male</option>

                                            <option value="2">Female</option>

                          </select>

                      </div>

                    </div>

                  </div>

  	              <div class="form-group">

  	                <label>First Name</label>

  	                <input type="text" class="form-control input-sm required" id="name" name="name">

  	              </div>  

                  <div class="form-group">

                    <label>Last Name</label>

                    <input type="text" class="form-control input-sm required" id="last_name" name="last_name" >

                  </div> 

                  <div class="form-group">

  	                    <label>Nationality</label>

  	                    <div class="input-group">

                            <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#nationalty_lang"><i class="fa fa-plus-circle"></i></a></span>          

                          

                            <select id="nationality_new" name="nationality_new" class="form-control required input-sm"  tabindex="1">

										<option value="" selected="selected">Select Nationality</option>

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

                

  	              <div class="form-group">

  	                    <label>Date of birth</label>

  	                  <div class="input-group">

                            <input type="text" class="form-control input-sm datepicker"  id="dob" name="dob">

                            <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                            </div>

                            </div>

                            

                            

                        

                       

  	              </div>

  	              <div class="form-group">

  	                    <label>Religion</label>

  	                  

                        <select id="religion" name="religion" class="form-control input-sm"  tabindex="1">

											<option value="" selected="selected">Select Religion</option>

											<option value="Christianity">Christianity</option>

											<option value="Islam">Islam</option>

											<option value="Secular/Nonreligious/Agnostic/Atheist">Secular/Nonreligious/Agnostic/Atheist</option>

											<option value="Hinduism">Hinduism</option>

											<option value="Chinese traditional religion">Chinese traditional religion</option>

											<option value="Buddhism">Buddhism</option>

											<option value="primal-indigenous">primal-indigenous</option>

											<option value="African Traditional & Diasporic">African Traditional & Diasporic</option>

											<option value="Sikhism">Sikhism</option>

											<option value="Juche">Juche</option>

											<option value="Judaism">Judaism</option>

											<option value="Bahai">Baha'i</option>

											<option value="Jainism">Jainism</option>

											<option value="Shinto">Shinto</option>

											<option value="Cao Dai">Cao Dai</option>

											<option value="Zoroastrianism">Zoroastrianism</option>

											<option value="Tenrikyo">Tenrikyo</option>

											<option value="Neo-Paganism">Neo-Paganism</option>

											<option value="Unitarian-Universalism">Unitarian-Universalism</option>

											<option value="Rastafarianism">Rastafarianism</option>

											<option value="Scientology">Scientology</option>

                                                                                        <option value="Russian Orthodox">Russian Orthodox</option>

                                                                                        <option value="Greek Orthodox">Greek Orthodox</option>



										</select>

  	              </div>

  	              <div class="form-group">

  	                    <label>Language</label>

  	                    <div class="input-group">

                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#langu_select"><i class="fa fa-plus-circle"></i></a></span>          

                          

                          <select id="native_language" name="native_language" class="form-control input-sm"  tabindex="1">

                                            <option value="">Select Language</option>

                                                                                            <option value="Afrikanns">Afrikanns</option>

                                                                                            <option value="Albanian">Albanian</option>

                                                                                            <option value="Arabic">Arabic</option>

                                                                                            <option value="Armenian">Armenian</option>

                                                                                            <option value="Basque">Basque</option>

                                                                                            <option value="Bengali">Bengali</option>

                                                                                            <option value="Bulgarian">Bulgarian</option>

                                                                                            <option value="Catalan">Catalan</option>

                                                                                            <option value="Cambodian">Cambodian</option>

                                                                                            <option value="Chinese">Chinese</option>

                                                                                            <option value="Croation">Croation</option>

                                                                                            <option value="Czech">Czech</option>

                                                                                            <option value="Danish">Danish</option>

                                                                                            <option value="Dutch">Dutch</option>

                                                                                            <option value="English">English</option>

                                                                                            <option value="Estonian">Estonian</option>

                                                                                            <option value="Fiji">Fiji</option>

                                                                                            <option value="Finnish">Finnish</option>

                                                                                            <option value="French">French</option>

                                                                                            <option value="Georgian">Georgian</option>

                                                                                            <option value="German">German</option>

                                                                                            <option value="Greek">Greek</option>

                                                                                            <option value="Gujarati">Gujarati</option>

                                                                                            <option value="Hebrew">Hebrew</option>

                                                                                            <option value="Hindi">Hindi</option>

                                                                                            <option value="Hungarian">Hungarian</option>

                                                                                            <option value="Icelandic">Icelandic</option>

                                                                                            <option value="Indonesian">Indonesian</option>

                                                                                            <option value="Irish">Irish</option>

                                                                                            <option value="Italian">Italian</option>

                                                                                            <option value="Japanese">Japanese</option>

                                                                                            <option value="Javanese">Javanese</option>

                                                                                            <option value="Korean">Korean</option>

                                                                                            <option value="Latin">Latin</option>

                                                                                            <option value="Latvian">Latvian</option>

                                                                                            <option value="Lithuanian">Lithuanian</option>

                                                                                            <option value="Macedonian">Macedonian</option>

                                                                                            <option value="Malay">Malay</option>

                                                                                            <option value="Malayalam">Malayalam</option>

                                                                                            <option value="Maltese">Maltese</option>

                                                                                            <option value="Maori">Maori</option>

                                                                                            <option value="Marathi">Marathi</option>

                                                                                            <option value="Mongolian">Mongolian</option>

                                                                                            <option value="Nepali">Nepali</option>

                                                                                            <option value="Norwegian">Norwegian</option>

                                                                                            <option value="Persian">Persian</option>

                                                                                            <option value="Polish">Polish</option>

                                                                                            <option value="Portuguese">Portuguese</option>

                                                                                            <option value="Punjabi">Punjabi</option>

                                                                                            <option value="Quechua">Quechua</option>

                                                                                            <option value="Romanian">Romanian</option>

                                                                                            <option value="Russian">Russian</option>

                                                                                            <option value="Samoan">Samoan</option>

                                                                                            <option value="Serbian">Serbian</option>

                                                                                            <option value="Slovak">Slovak</option>

                                                                                            <option value="Slovenian">Slovenian</option>

                                                                                            <option value="Spanish">Spanish</option>

                                                                                            <option value="Swahili">Swahili</option>

                                                                                            <option value="Swedish">Swedish</option>

                                                                                            <option value="Tamil">Tamil</option>

                                                                                            <option value="Tatar">Tatar</option>

                                                                                            <option value="Telugu">Telugu</option>

                                                                                            <option value="Thai">Thai</option>

                                                                                            <option value="Tibetan">Tibetan</option>

                                                                                            <option value="Tonga">Tonga</option>

                                                                                            <option value="Turkish">Turkish</option>

                                                                                            <option value="Ukranian">Ukranian</option>

                                                                                            <option value="Urdu">Urdu</option>

                                                                                            <option value="Uzbek">Uzbek</option>

                                                                                            <option value="Vietnamese">Vietnamese</option>

                                                                                            <option value="Welsh">Welsh</option>

                                                                                            <option value="Xhosa">Xhosa</option>

                                                                                    </select>

                        </div>

                  </div>

                  <div class="form-group">

                    <label>Hobbies</label>

                    <select class="form-control input-sm selectpicker dropup" multiple data-actions-box="true" id="hobbies" name="hobbies[]">

                      <option value="Astrology" >Astrology</option>

                                                                                    <option value="Astronomy" >Astronomy</option>

                                                                                    <option value="Badminton" >Badminton</option>

                                                                                    <option value="Baseball" >Baseball</option>

                                                                                    <option value="Basketball" >Basketball</option>

                                                                                    <option value="Bicycling" >Bicycling</option>

                                                                                    <option value="Blogging" >Blogging</option>

                                                                                    <option value="Body Building" >Body Building</option>

                                                                                    <option value="Bowling" >Bowling</option>

                                                                                    <option value="Camping" >Camping</option>

                                                                                    <option value="Cartooning" >Cartooning</option>

                                                                                    <option value="Car Racing" >Car Racing</option>

                                                                                    <option value="Casino Gambling" >Casino Gambling</option>

                                                                                    <option value="Chess" >Chess</option>

                                                                                    <option value="Collecting Antiques" >Collecting Antiques</option>

                                                                                    <option value="Collecting Artwork" >Collecting Artwork</option>

                                                                                    <option value="Collecting Music Albums" >Collecting Music Albums</option>

                                                                                    <option value="Collecting Coins" >Collecting Coins</option>

                                                                                    <option value="Collecting Stamps" >Collecting Stamps</option>

                                                                                    <option value="Cooking" >Cooking</option>

                                                                                    <option value="Crafts" >Crafts</option>

                                                                                    <option value="Crossword Puzzles" >Crossword Puzzles</option>

                                                                                    <option value="Dancing" >Dancing</option>

                                                                                    <option value="Drawing" >Drawing</option>

                                                                                    <option value="Drums" >Drums</option>

                                                                                    <option value="Fishing" >Fishing</option>

                                                                                    <option value="Football" >Football</option>

                                                                                    <option value="Gardening" >Gardening</option>

                                                                                    <option value="Golf" >Golf</option>

                                                                                    <option value="Go Karting" >Go Karting</option>

                                                                                    <option value="Guitar" >Guitar</option>

                                                                                    <option value="Horse Riding" >Horse Riding</option>

                                                                                    <option value="Hunting" >Hunting</option>

                                                                                    <option value="Internet Surfing" >Internet Surfing</option>

                                                                                    <option value="Jogging" >Jogging</option>

                                                                                    <option value="Juggling" >Juggling</option>

                                                                                    <option value="Knitting" >Knitting</option>

                                                                                    <option value="Listening to Music" >Listening to Music</option>

                                                                                    <option value="Magic" >Magic</option>

                                                                                    <option value="Painting" >Painting</option>

                                                                                    <option value="Photography" >Photography</option>

                                                                                    <option value="Piano" >Piano</option>

                                                                                    <option value="Playing Musical Instruments" >Playing Musical Instruments</option>

                                                                                    <option value="Reading" >Reading</option>

                                                                                    <option value="Running" >Running</option>

                                                                                    <option value="Sewing" >Sewing</option>

                                                                                    <option value="Shopping" >Shopping</option>

                                                                                    <option value="Sketching" >Sketching</option>

                                                                                    <option value="Soccer" >Soccer</option>

                                                                                    <option value="Socializing" >Socializing</option>

                                                                                    <option value="Swimming" >Swimming</option>

                                                                                    <option value="Tennis" >Tennis</option>

                                                                                    <option value="Travelling" >Travelling</option>

                                                                                    <option value="Trekking" >Trekking</option>

                                                                                    <option value="TV Watching" >TV Watching</option>

                                                                                    <option value="Writing" >Writing</option>

                                                                                    <option value="Yoga" >Yoga</option>

                    </select>

                  </div>



    	          </div>

  	            <div class="col-md-3">

                  

                  <h5 class="text-primary">Contact Details</h5>



                  <div class="panel panel-default gist-formsmartpanel">

                        <div class="panel-heading panel-gistab gist-contab">

                          <ul class="nav nav-tabs" role="tablist">

                            <li role="presentation" class="active"><a href="#tabpersonal" aria-controls="tabpersonal" role="tab" data-toggle="tab">Personal</a></li>

                            <li role="presentation"><a href="#tabwork" aria-controls="tabwork" role="tab" data-toggle="tab">Work</a></li>

                            <li role="presentation"><a href="#tabother" aria-controls="tabother" role="tab" data-toggle="tab">Other</a></li>

                          </ul>

                        </div>                        

                        <div class="panel-body">

                          <div class="tab-content">

                            <div role="tabpanel" class="tab-pane active" id="tabpersonal">

                            

                              <div class="gist-showmeonclick personalcontent">

                                <div class="form-group">

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

 <option value="971" selected="selected">United Arab Emirates (+971)</option> 

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

                                  <input placeholder="Mobile" type="text" class="ltrim form-control input-sm col-md-8"  id="mobile_no_new" name="mobile_no_new" required="required">

                                  

                                    <input id="mobile_1" name="mobile_1" type="text" class="ltrim form-control input-sm col-md-8" value=""  tabindex="2" style="display: none">

                                </div>

                                <div class="form-group">

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

 <option value="971" selected="selected">United Arab Emirates (+971)</option> 

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

                                <div class="form-group">

                                  <input placeholder="Email" type="text" class="form-control input-sm" id="email" name="email" required="required">

                                  <input name="email_1" type="hidden" class="form-control phone-group" id="email_1" value=""  tabindex="2">

                                </div>

                                <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon">

                                    <a data-target="#addadrress_dtl" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a>

                                    </span>

                                   <textarea placeholder="Address" class="form-control" id="address" name="address">

                                    

                                  </textarea>

                                    

                                  </div>

                                  

                                </div>

                                <div class="form-group">

                                <select name="c_code_fax" id="c_code_fax" class="form-control col-md-4 input-sm" >



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

 <option value="971" selected="selected">United Arab Emirates (+971)</option> 

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

                                  <input placeholder="Fax" type="text" class="form-control input-sm col-md-8" id="fax" name="fax">

                                   <input  name="fax_1" type="hidden" class="form-control input-sm col-md-8" id="fax_1" value=""  tabindex="2">

                                </div>

                              </div>





                            </div>

                            <div role="tabpanel" class="tab-pane" id="tabwork">



                              <div class="gist-showmeonclick workcontent">

                                <div class="form-group">

                                <select name="mobile_no_new_ccode_2" id="mobile_no_new_ccode_2" class="form-control col-md-4 input-sm" >



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

 <option value="971" selected="selected">United Arab Emirates (+971)</option> 

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

                                  <input placeholder="Mobile" type="text" class="form-control input-sm col-md-8" id="mobile_2" name="mobile_2">

                                </div>

                                <div class="form-group">

                                <select name="c_code_phone_2" id="c_code_phone_2" class="form-control col-md-4 input-sm" >



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

 <option value="971" selected="selected">United Arab Emirates (+971)</option> 

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

                                  <input placeholder="Phone" type="text" class="form-control input-sm col-md-8" id="phone_2" name="phone_2">

                                </div>

                                <div class="form-group">

                                  <input placeholder="Email" type="text" class="form-control input-sm" id="email_2" name="email_2">

                                </div>

                                <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon">

                                    <a data-target="#addadrress_dt2" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a>

                                    </span>

                                   <textarea placeholder="Address" class="form-control" id="address2" name="address2">

                                    

                                  </textarea>

                                    

                                  </div>

                                  

                                </div>

                                <div class="form-group">

                                <select name="c_code_fax_2" id="c_code_fax_2" class="form-control col-md-4 input-sm" >



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

 <option value="971" selected="selected">United Arab Emirates (+971)</option> 

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

                                  <input placeholder="Fax" type="text" class="form-control input-sm col-md-8" id="fax_2" name="fax_2">

                                </div>

                              </div>



                            </div>

                            <div role="tabpanel" class="tab-pane" id="tabother">

                              <div class="gist-showmeonclick othercontent">

                                <div class="form-group">

                                <select name="mobile_no_new_ccode_3" id="mobile_no_new_ccode_3" class="form-control input-sm col-md-4" >



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

 <option value="971" selected="selected">United Arab Emirates (+971)</option> 

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

                                  <input placeholder="Mobile" type="text" class="form-control input-sm col-md-8" id="mobile_3" name="mobile_3">

                                </div>

                                <div class="form-group">

                                <select name="c_code_phone_3" id="c_code_phone_3" class="form-control input-sm col-md-4" >



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

 <option value="971" selected="selected">United Arab Emirates (+971)</option> 

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

                                  <input placeholder="Phone" type="text" class="form-control input-sm col-md-8" id="phone_3" name="phone_3">

                                </div>

                                <div class="form-group">

                                  <input placeholder="Email" type="text" class="form-control input-sm " id="email_3" name="email_3">

                                </div>

                                <div class="form-group">

                                <select name="c_code_fax_3" id="c_code_fax_3" class="form-control input-sm col-md-4" >



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

 <option value="971" selected="selected">United Arab Emirates (+971)</option> 

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

                                  <input placeholder="Fax" type="text" class="form-control input-sm col-md-8" id="fax_3" name="fax_3">

                                </div>

                              </div>



                            </div>

                          </div>

                        </div>

                  </div>

                  <h5 class="text-primary gist-copdetail">Corporate Details</h5>



  	              <div class="form-group">

  	                    <label>Company</label>

  	                    <input type="text" class="form-control input-sm" id="company" name="company">

  	              </div>

  	              <div class="form-group">

  	                    <label>Designation</label>

  	                    <input type="text" class="form-control input-sm" id="designation" name="designation">

  	              </div>

  	              <div class="form-group">

  	                    <label>Website</label>

  	                    <input type="text" class="form-control input-sm" id="website" name="website">

  	              </div> 	              

  	              

  	            </div>

                <div class="col-md-3">

                  

                  <h5 class="text-primary">Social Media <a class="pull-right gist-addsocial" href="" data-toggle="modal" data-target="#socialmedia_box">Add/View all</a></h5>



                  <div class="form-group">

                        <label>Facebook</label>

                        <div class="input-group">

                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#owner"><i class="fa fa-link"></i></a></span>

                        <input type="text" class="form-control input-sm" id="facebook" name="facebook">

                        </div>

                  </div>

                  <div class="form-group">

                        <label>Twitter</label>

                        <div class="input-group">

                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#owner"><i class="fa fa-link"></i></a></span>

                        <input type="text" class="form-control input-sm" id="twitter" name="twitter">

                        </div>

                  </div>

                  <div class="form-group">

                        <label>Linkedin</label>

                        <div class="input-group">

                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#owner"><i class="fa fa-link"></i></a></span>

                        <input type="text" class="form-control input-sm" id="linkedin" name="linkedin">

                        </div>

                  </div>

                  <div class="form-group">

                        <label>Skype</label>

                        <div class="input-group">

                          <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#owner"><i class="fa fa-link"></i></a></span>

                        <input type="text" class="form-control input-sm" id="skype" name="skype">

                        </div>

                  </div>

                  <h5 class="text-primary gist-othdetail">Other Details</h5>

                  <div class="form-group">

                  <input name="assigned_to_id_dummy" type="text" readonly="readonly" id="assigned_to_id_dummy" style="display:none;" value="Mahmoud Khalil">

                        <label>Assigned to</label>

                        <select id="assigned_to_id" name="assigned_to_id" class=" form-control required input-sm" required>

                         

                        </select>

                  </div>

                  <div class="form-group">

                        <label>Contact source</label>

                       

                        <select name="source_of_contact" type="text"  class="form-control input-sm" id="source_of_contact" tabindex="6">

                                                                     <option value="" selected>Select</option>

                                                                     <option value=" Not Specified" > Not Specified</option><option value="7 days" >7 days</option><option value="Abu Dhabi week" >Abu Dhabi week</option><option value="Agent" >Agent</option><option value="Agent External" >Agent External</option><option value="Agent Internal" >Agent Internal</option><option value="Al Ayam" >Al Ayam</option><option value="Al Bayan" >Al Bayan</option><option value="Al Futtaim" >Al Futtaim</option><option value="Al Ittihad News paper" >Al Ittihad News paper</option><option value="Al Khaleej" >Al Khaleej</option><option value="Al Rai" >Al Rai</option><option value="AL Watan" >AL Watan</option><option value="Arab Times" >Arab Times</option><option value="Asharq Al Awsat" >Asharq Al Awsat</option><option value="Bank Referral" >Bank Referral</option><option value="Bayut.com" >Bayut.com</option><option value="Blackberry SMS" >Blackberry SMS</option><option value="Business card" >Business card</option><option value="Client Referral" >Client Referral</option><option value="Cold call" >Cold call</option><option value="Colours TV" >Colours TV</option><option value="Database" >Database</option><option value="Developer" >Developer</option><option value="Direct call" >Direct call</option><option value="Direct Client" >Direct Client</option><option value="Drive around" >Drive around</option><option value="Dubizzle Feature" >Dubizzle Feature</option><option value="Dubizzle.com" >Dubizzle.com</option><option value="Dzooom.com" >Dzooom.com</option><option value="Email campaign" >Email campaign</option><option value="Ertebat" >Ertebat</option><option value="Exhibition Stand" >Exhibition Stand</option><option value="Existing client" >Existing client</option><option value="EzEstate" >EzEstate</option><option value="EzHeights.com" >EzHeights.com</option><option value="Facebook" >Facebook</option><option value="Flyers" >Flyers</option><option value="Forbes Mailer" >Forbes Mailer</option><option value="Friend or Relative" >Friend or Relative</option><option value="Google " >Google </option><option value="Gulf Daily News" >Gulf Daily News</option><option value="Gulf News" >Gulf News</option><option value="Gulf News Mailer" >Gulf News Mailer</option><option value="Gulf Newspaper Freehold" >Gulf Newspaper Freehold</option><option value="Gulf Newspaper Residential" >Gulf Newspaper Residential</option><option value="Gulf Times" >Gulf Times</option><option value="Gulfnews Freehold" >Gulfnews Freehold</option><option value="Gulfpropertyportal.com" >Gulfpropertyportal.com</option><option value="Instagram" >Instagram</option><option value="JustProperty.com" >JustProperty.com</option><option value="JustRentals.com" >JustRentals.com</option><option value="JUWAI" >JUWAI</option><option value="Khaleej Times" >Khaleej Times</option><option value="LinkedIn" >LinkedIn</option><option value="Listanza" >Listanza</option><option value="Luxury Estate.com" >Luxury Estate.com</option><option value="Luxury Square Foot" >Luxury Square Foot</option><option value="Magazine" >Magazine</option><option value="Memaar TV" >Memaar TV</option><option value="MoneyCamel.com" >MoneyCamel.com</option><option value="National News paper" >National News paper</option><option value="Newsletter" >Newsletter</option><option value="Newspaper advert" >Newspaper advert</option><option value="Old Landlord" >Old Landlord</option><option value="Online Banners" >Online Banners</option><option value="Open House" >Open House</option><option value="Other" >Other</option><option value="Other portal" >Other portal</option><option value="Outdoor Media" >Outdoor Media</option><option value="Personal Referral" >Personal Referral</option><option value="Property Acquisition Department" >Property Acquisition Department</option><option value="Property Finder Premium" >Property Finder Premium</option><option value="Property Inc." >Property Inc.</option><option value="Property Management" >Property Management</option><option value="Property Trader" >Property Trader</option><option value="Property Weekly" >Property Weekly</option><option value="Propertyfinder.ae" >Propertyfinder.ae</option><option value="Propertyonline" >Propertyonline</option><option value="Propertywifi.com" >Propertywifi.com</option><option value="PropSpace MLS" >PropSpace MLS</option><option value="Radio" >Radio</option><option value="Radio Advert" >Radio Advert</option><option value="Referral within company" >Referral within company</option><option value="Relocation" >Relocation</option><option value="Rightmove.co.uk" >Rightmove.co.uk</option><option value="Roadshow" >Roadshow</option><option value="Sandcastles.ae" >Sandcastles.ae</option><option value="School Communicator" >School Communicator</option><option value="School Communicator" >School Communicator</option><option value="Search Engine" >Search Engine</option><option value="Signboard" >Signboard</option><option value="SMS campaign" >SMS campaign</option><option value="Social media Campaign" >Social media Campaign</option><option value="Souq.com" >Souq.com</option><option value="Staff Mailer" >Staff Mailer</option><option value="Twitter " >Twitter </option><option value="Walk-in" >Walk-in</option><option value="Website" >Website</option><option value="Whatpricemyhome" >Whatpricemyhome</option><option value="Whatsapp" >Whatsapp</option><option value="Word of Mouth" >Word of Mouth</option><option value="www.propertyportal.ae" >www.propertyportal.ae</option><option value="Youtube" >Youtube</option><option value="Zawya Mailer" >Zawya Mailer</option><option value="Zoopla" >Zoopla</option>                                                                 </select>

                               <input style="display:none;" type="text" class="form-control" name="other_source_of_contact" id="other_source_of_contact" placeholder="Specify Other Source" tabindex="6">

                  </div>

                  <div class="form-group">

                        <label>Contact Type</label>

                        <select name="contact_type" class="form-control  input-sm" id="contact_type">

                            <option value="" selected>Select</option>

                                                                 <option value="1">Tenant</option><option value="2">Buyer</option><option value="3">Landlord</option><option value="4">Seller</option><option value="5">Landlord+Seller</option><option value="6">Representative of Tenant</option><option value="7">Other</option>                                                             </select>

                                                                 <input style="display:none;" type="text" class="form-control" name="other_contact_type" id="other_contact_type" placeholder="Specify Contact Type" tabindex="6">

                  </div>

                  

                </div>



                <div class="col-md-3">

                  <h5 class="text-primary">&nbsp;</h5>

                  <div class="panel panel-default gist-formsmartpanel">

                        <div class="panel-heading panel-gistab gist-contab">

                          <ul class="nav nav-tabs" role="tablist">

                            <li role="presentation" class="active"><a href="#tabaddnote" aria-controls="tabaddnote" role="tab" data-toggle="tab">Notes</a></li>

                            <li role="presentation"><a href="#tabdocuments" aria-controls="tabdocuments" role="tab" data-toggle="tab">Documents</a></li>

                          </ul>

                        </div>                        

                        <div class="panel-body">

                          <div class="tab-content">

                            <div role="tabpanel" class="tab-pane active" id="tabaddnote">

                              <div class="form-group">

                                <input type="text" class="form-control input-sm" id="notes" name="notes" placeholder="Click Here to add your note">

                              </div>

                              <div class="form-group">

                              <!--  <textarea class="form-control">no note found</textarea>-->

                                <div style="height: 197px; overflow-y: scroll; padding:5px" id="shownotes" >No note found </div>

                              </div>

                              

                            </div>

                            <div role="tabpanel" class="tab-pane" id="tabdocuments">

                                <p>Upload documents related to this contact e.g passport copy, ID card, receipts, contracts etc</p>

                                <div class="form-group">

                                    

                                     <input name="document_name" type="text"  class="form-control input-sm" id="document_name" placeholder="Document Name">

                                      <textarea name="documents" style="display:none;"  class="form-control" id="documents"></textarea>

                                      <div style="display:none;" id="download_animation"><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="24" height="24" />

                                                                </div>

                                </div>

                                <div class="form-group">

                                 <input id="listings_documents"  type="file"  name="listings_documents" >

                                  

                            

                                  <button  class="btn btn-info pull-right" id="buttonUpload"  onClick="return ajaxFileUpload();">Upload</button>

                                </div>

                                <hr class="clear">



                                <div class="form-group">

                                  <div style="height: 100px; overflow-y: scroll;" class="form-control margin-top-10" id="showDocuments">No documents found for this contact</div>

                                </div>



                            </div>

                          </div>

                        </div>

                  </div>

                  <h5 class="text-primary gist-clstheading">&nbsp;</h5>

                  <div class="form-group">

                        <label>Created by</label>

                        <input type="text" class="form-control input-sm" readonly id="created_by" name="created_by">

                          <input type="hidden" name="agent_id" id="agent_id"/>

                  </div>

                  <div class="form-group">

                        <label>Created date</label>

                        <input type="text" class="form-control input-sm" readonly id="dateadded" name="dateadded">

                  </div>    

                </div>

  	            

  	            

              

              </div>

                 <script type="text/javascript" src="<?php echo site_url();?>js_module/ajaxfileupload.js?r=45435346"></script>

            <script type="text/javascript">



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

                            url:'<?php echo base_url();?>contacts/uploadDocuments/',

                            secureuri:false,

                            fileElementId:'listings_documents',

                            dataType: 'text',

                            data:{title: $('#document_name').val(), rand_key: $('#rand_key').val(),listing_id:$('#id').val()},

                            success: function (data)

                            {

							//	alert("sucess");

								//alert(data.msg);

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

											$("#showDocuments").append('<div id="doc_div_'+data+'"><div style="border-bottom:#999 dashed 1px; padding: 0px 0px 5px 0px; margin: 5px 5px 0px 5px;" ><div style="display:inline-block;" id="shafi_'+data+'" >'+$('#document_name').val()+'</div><div  style="display:inline-block; float:right;"></div><div  style="display:inline-block; float:right;"><a href="<?php echo base_url();?>uploads/documents/contacts/<?php echo $this->session->userdata('client_id')."/".$this->session->userdata('userid');?>/'+data+'" target="_blank">Download</a> | <a id='+data+' name='+data+' class="delete_list" href="# S"> Delete </a></div></div></div>');

                                      //  });

                            

                                        $('#document_name, #listings_documents').val('');

                                        $("#download_animation").css('display', 'none');

                                        //alert(data.msg);

                                    //}

                               // }

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





        /* delete documents */

                $(document.body).on("click", '.delete_list', function() {

                if(formDataChange == true){



                    var id		=	$(this).attr('id');

                    var name            =       $(this).attr('name');

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



                        $.get("<?php echo base_url();?>contacts/deletedocument/"+  clean_up_link(id) , function(data){



                        });

                        var last_char = newstr[newstr.length-1];

                        if(last_char==','){

                            newstr = newstr.substring(0, newstr.length - 1);

                        }

                        $('#documents').val(newstr);

                        $('#doc_div_'+name).remove();





                    }

                    }

                });

            </script>

		<!--popups start-->

         <!-- Nationalty Selection popup -->

            <div class="modal fade bs-example-modal-sm" id="nationalty_lang" tabindex="-1">

              <div class="modal-dialog modal-sm">

                <div class="modal-content ">

                

                    <div class="modal-header">

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                      <span aria-hidden="true">&times;</span></button>

                      <h4 class="modal-title">Nationality</h4>

                    </div>

                  

                    <div class="modal-body">

                        <div>

                          <div class="form-group">

                            <label>Nationality 1 </label>

                          

                            <select id="nationality" name="nationality" class="form-control input-sm"  tabindex="9">

                                        <option value="" selected="selected">Select Nationality</option>

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

                          <div class="form-group">

                            <label>Nationality 2 </label>

                         

                            <select id="nationality_1" name="nationality_1" class="form-control input-sm"  tabindex="9">

                                        <option value="" selected="selected">Select Nationality</option>

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

                    <div class="modal-footer">

                      <button class="btn btn-success" data-dismiss="modal">Save & Close</button>

                    </div>

                  </div>

                </div>

              </div>



            <!-- Langauge Selection popup -->

            <div class="modal fade bs-example-modal-sm" id="langu_select" tabindex="-1">

              <div class="modal-dialog modal-sm">

                <div class="modal-content ">

                

                    <div class="modal-header">

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                      <span aria-hidden="true">&times;</span></button>

                      <h4 class="modal-title">Languages</h4>

                    </div>

                  

                    <div class="modal-body">

                        <div>

                          <div class="form-group">

                            <label>Native Langugae </label>

                         

                            <select id="language1" name="language1" class="form-control input-sm"  tabindex="10">

                                <option value="">Select Language</option>

                                                                    <option value="Afrikanns">Afrikanns</option>

                                                                    <option value="Albanian">Albanian</option>

                                                                    <option value="Arabic">Arabic</option>

                                                                    <option value="Armenian">Armenian</option>

                                                                    <option value="Basque">Basque</option>

                                                                    <option value="Bengali">Bengali</option>

                                                                    <option value="Bulgarian">Bulgarian</option>

                                                                    <option value="Catalan">Catalan</option>

                                                                    <option value="Cambodian">Cambodian</option>

                                                                    <option value="Chinese">Chinese</option>

                                                                    <option value="Croation">Croation</option>

                                                                    <option value="Czech">Czech</option>

                                                                    <option value="Danish">Danish</option>

                                                                    <option value="Dutch">Dutch</option>

                                                                    <option value="English">English</option>

                                                                    <option value="Estonian">Estonian</option>

                                                                    <option value="Fiji">Fiji</option>

                                                                    <option value="Finnish">Finnish</option>

                                                                    <option value="French">French</option>

                                                                    <option value="Georgian">Georgian</option>

                                                                    <option value="German">German</option>

                                                                    <option value="Greek">Greek</option>

                                                                    <option value="Gujarati">Gujarati</option>

                                                                    <option value="Hebrew">Hebrew</option>

                                                                    <option value="Hindi">Hindi</option>

                                                                    <option value="Hungarian">Hungarian</option>

                                                                    <option value="Icelandic">Icelandic</option>

                                                                    <option value="Indonesian">Indonesian</option>

                                                                    <option value="Irish">Irish</option>

                                                                    <option value="Italian">Italian</option>

                                                                    <option value="Japanese">Japanese</option>

                                                                    <option value="Javanese">Javanese</option>

                                                                    <option value="Korean">Korean</option>

                                                                    <option value="Latin">Latin</option>

                                                                    <option value="Latvian">Latvian</option>

                                                                    <option value="Lithuanian">Lithuanian</option>

                                                                    <option value="Macedonian">Macedonian</option>

                                                                    <option value="Malay">Malay</option>

                                                                    <option value="Malayalam">Malayalam</option>

                                                                    <option value="Maltese">Maltese</option>

                                                                    <option value="Maori">Maori</option>

                                                                    <option value="Marathi">Marathi</option>

                                                                    <option value="Mongolian">Mongolian</option>

                                                                    <option value="Nepali">Nepali</option>

                                                                    <option value="Norwegian">Norwegian</option>

                                                                    <option value="Persian">Persian</option>

                                                                    <option value="Polish">Polish</option>

                                                                    <option value="Portuguese">Portuguese</option>

                                                                    <option value="Punjabi">Punjabi</option>

                                                                    <option value="Quechua">Quechua</option>

                                                                    <option value="Romanian">Romanian</option>

                                                                    <option value="Russian">Russian</option>

                                                                    <option value="Samoan">Samoan</option>

                                                                    <option value="Serbian">Serbian</option>

                                                                    <option value="Slovak">Slovak</option>

                                                                    <option value="Slovenian">Slovenian</option>

                                                                    <option value="Spanish">Spanish</option>

                                                                    <option value="Swahili">Swahili</option>

                                                                    <option value="Swedish">Swedish</option>

                                                                    <option value="Tamil">Tamil</option>

                                                                    <option value="Tatar">Tatar</option>

                                                                    <option value="Telugu">Telugu</option>

                                                                    <option value="Thai">Thai</option>

                                                                    <option value="Tibetan">Tibetan</option>

                                                                    <option value="Tonga">Tonga</option>

                                                                    <option value="Turkish">Turkish</option>

                                                                    <option value="Ukranian">Ukranian</option>

                                                                    <option value="Urdu">Urdu</option>

                                                                    <option value="Uzbek">Uzbek</option>

                                                                    <option value="Vietnamese">Vietnamese</option>

                                                                    <option value="Welsh">Welsh</option>

                                                                    <option value="Xhosa">Xhosa</option>

                                                            </select>

                          </div>

                          <div class="form-group">

                            <label>Second Langauge </label>

                         

                            <select id="second_language" name="second_language" class="form-control input-sm"  tabindex="10">

                                <option value="">Select Language</option>

                                                                    <option value="Afrikanns">Afrikanns</option>

                                                                    <option value="Albanian">Albanian</option>

                                                                    <option value="Arabic">Arabic</option>

                                                                    <option value="Armenian">Armenian</option>

                                                                    <option value="Basque">Basque</option>

                                                                    <option value="Bengali">Bengali</option>

                                                                    <option value="Bulgarian">Bulgarian</option>

                                                                    <option value="Catalan">Catalan</option>

                                                                    <option value="Cambodian">Cambodian</option>

                                                                    <option value="Chinese">Chinese</option>

                                                                    <option value="Croation">Croation</option>

                                                                    <option value="Czech">Czech</option>

                                                                    <option value="Danish">Danish</option>

                                                                    <option value="Dutch">Dutch</option>

                                                                    <option value="English">English</option>

                                                                    <option value="Estonian">Estonian</option>

                                                                    <option value="Fiji">Fiji</option>

                                                                    <option value="Finnish">Finnish</option>

                                                                    <option value="French">French</option>

                                                                    <option value="Georgian">Georgian</option>

                                                                    <option value="German">German</option>

                                                                    <option value="Greek">Greek</option>

                                                                    <option value="Gujarati">Gujarati</option>

                                                                    <option value="Hebrew">Hebrew</option>

                                                                    <option value="Hindi">Hindi</option>

                                                                    <option value="Hungarian">Hungarian</option>

                                                                    <option value="Icelandic">Icelandic</option>

                                                                    <option value="Indonesian">Indonesian</option>

                                                                    <option value="Irish">Irish</option>

                                                                    <option value="Italian">Italian</option>

                                                                    <option value="Japanese">Japanese</option>

                                                                    <option value="Javanese">Javanese</option>

                                                                    <option value="Korean">Korean</option>

                                                                    <option value="Latin">Latin</option>

                                                                    <option value="Latvian">Latvian</option>

                                                                    <option value="Lithuanian">Lithuanian</option>

                                                                    <option value="Macedonian">Macedonian</option>

                                                                    <option value="Malay">Malay</option>

                                                                    <option value="Malayalam">Malayalam</option>

                                                                    <option value="Maltese">Maltese</option>

                                                                    <option value="Maori">Maori</option>

                                                                    <option value="Marathi">Marathi</option>

                                                                    <option value="Mongolian">Mongolian</option>

                                                                    <option value="Nepali">Nepali</option>

                                                                    <option value="Norwegian">Norwegian</option>

                                                                    <option value="Persian">Persian</option>

                                                                    <option value="Polish">Polish</option>

                                                                    <option value="Portuguese">Portuguese</option>

                                                                    <option value="Punjabi">Punjabi</option>

                                                                    <option value="Quechua">Quechua</option>

                                                                    <option value="Romanian">Romanian</option>

                                                                    <option value="Russian">Russian</option>

                                                                    <option value="Samoan">Samoan</option>

                                                                    <option value="Serbian">Serbian</option>

                                                                    <option value="Slovak">Slovak</option>

                                                                    <option value="Slovenian">Slovenian</option>

                                                                    <option value="Spanish">Spanish</option>

                                                                    <option value="Swahili">Swahili</option>

                                                                    <option value="Swedish">Swedish</option>

                                                                    <option value="Tamil">Tamil</option>

                                                                    <option value="Tatar">Tatar</option>

                                                                    <option value="Telugu">Telugu</option>

                                                                    <option value="Thai">Thai</option>

                                                                    <option value="Tibetan">Tibetan</option>

                                                                    <option value="Tonga">Tonga</option>

                                                                    <option value="Turkish">Turkish</option>

                                                                    <option value="Ukranian">Ukranian</option>

                                                                    <option value="Urdu">Urdu</option>

                                                                    <option value="Uzbek">Uzbek</option>

                                                                    <option value="Vietnamese">Vietnamese</option>

                                                                    <option value="Welsh">Welsh</option>

                                                                    <option value="Xhosa">Xhosa</option>

                                                            </select>

                          </div>

                        </div>

                    </div>

                    <div class="modal-footer">



                      <button class="btn btn-success" data-dismiss="modal">Save & Close</button>

                    </div>

                  </div>

                </div>

              </div>

               <!-- Address modal -->

               <div class="modal fade" id="addadrress_dtl" tabindex="-1" >

              <div class="modal-dialog">

                <div class="modal-content ">

                

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Address</h4>

                  </div>

                  

                  <div class="modal-body">

                  <div class="row">

                    

                    <div class="col-md-6">

                     

                    

                      <div class="form-group">

                        <label>P.O Box</label>

                        <input type="text" class="form-control input-sm" id="po_box" name="po_box" >

                      </div>  

                      <div class="form-group">

                        <label>Address Line 1</label>

                        <input type="text" class="form-control input-sm" id="address_line_1" name="address_line_1" >

                      </div>

                      <div class="form-group">

                        <label>Address Line 2</label>

                        <input type="text" class="form-control input-sm" id="address_line_2" name="address_line_2" >

                      </div>

                      <div class="form-group">

                        <label>City</label>

                        <input type="text" class="form-control input-sm" id="address_city" name="address_city" >

                      </div>

                    </div>

                    <div class="col-md-6">

                      <div class="form-group">

                        <label>Zip Code</label>

                        <input type="text" class="form-control input-sm" id="address_zip_po_box" name="address_zip_po_box" >

                      </div>

                      <div class="form-group">

                        <label>State</label>

                        <input type="text" class="form-control input-sm" id="address_state" name="address_state" >

                      </div>

                      <div class="form-group">

                        <label>Country</label>

                       <select id="address_country" name="address_country" class="form-control input-sm"  tabindex="12">

                                    <option value="" selected="selected">Select Country</option>

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

                  <div class="modal-footer">

                    <button class="btn btn-success address-save" data-dismiss="modal">Save & Close</button>

                  </div>

                  </div>

                </div>

              </div>

              <!--address model 2-->

            <div class="modal fade" id="addadrress_dt2" tabindex="-1" >

              <div class="modal-dialog">

                <div class="modal-content ">

                

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Address</h4>

                  </div>

                  

                  <div class="modal-body">

                  <div class="row">

                    

                    <div class="col-md-6">

                     

                    

                      <div class="form-group">

                        <label>P.O Box</label>

                        <input type="text" class="form-control input-sm" id="address2_po_box" name="address2_po_box" >

                      </div>  

                      <div class="form-group">

                        <label>Address Line 1</label>

                        <input type="text" class="form-control input-sm" id="address2_line_1" name="address2_line_1" >

                      </div>

                      <div class="form-group">

                        <label>Address Line 2</label>

                        <input type="text" class="form-control input-sm" id="address2_line_2" name="address2_line_2" >

                      </div>

                      <div class="form-group">

                        <label>City</label>

                        <input type="text" class="form-control input-sm" id="address2_city" name="address2_city" >

                      </div>

                    </div>

                    <div class="col-md-6">

                      <div class="form-group">

                        <label>Zip Code</label>

                        <input type="text" class="form-control input-sm" id="address2_zip_po_box" name="address2_zip_po_box" >

                      </div>

                      <div class="form-group">

                        <label>State</label>

                        <input type="text" class="form-control input-sm" id="address2_state" name="address2_state" >

                      </div>

                      <div class="form-group">

                        <label>Country</label>

                       <select id="address2_country" name="address2_country" class="form-control input-sm"  tabindex="12">

                                    <option value="" selected="selected">Select Country</option>

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

                  <div class="modal-footer">

                    <button class="btn btn-success address2-save" data-dismiss="modal">Save & Close</button>

                  </div>

                  </div>

                </div>

              </div>

               <!-- Social Media popup -->

            <div class="modal fade bs-example-modal-lg" id="socialmedia_box" tabindex="-1">

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                

                    <div class="modal-header">

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                      <span aria-hidden="true">&times;</span></button>

                      <h4 class="modal-title">Social Media</h4>

                    </div>



                    <div class="modal-body has-form">

                         <div class="col-md-6 col-xs-12">

                            <div class="form-group">

                        		<label>Facebook</label>

                        		<div class="input-group">

                          			<span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-link"></i></a></span>

                        			<input type="text" id="facebook_text" name="facebook_text" class="form-control input-sm">

                        		</div>

                  			</div>

                  			<div class="form-group">

                        		<label>Twitter</label>

                        		<div class="input-group">

                          			<span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-link"></i></a></span>

                        			<input type="text" id="twitter_text" name="twitter_text" class="form-control input-sm">

                        		</div>

                  			</div>

                  			<div class="form-group">

                        		<label>Linkedin</label>

                        		<div class="input-group">

                          			<span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-link"></i></a></span>

                        			<input type="text" id="linkedin_text" name="linkedin_text" class="form-control input-sm">

                        		</div>

                  			</div>

                  			<div class="form-group">

                        		<label>Skype</label>

                        		<div class="input-group">

                          			<span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-link"></i></a></span>

                        			<input type="text" id="skype_text" name="skype_text" class="form-control input-sm">

                        		</div>

                  			</div>

                         </div>

                        <div class="col-md-6 col-xs-12">

                            <div class="form-group">

                        		<label>Google+</label>

                        		<div class="input-group">

                          			<span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-link"></i></a></span>

                        			<input type="text" id="googleplus" name="googleplus" class="form-control input-sm">

                        		</div>

                  			</div>

                  			<div class="form-group">

                        		<label>Instagram</label>

                        		<div class="input-group">

                          			<span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-link"></i></a></span>

                        			<input type="text" id="instagram" name="instagram" class="form-control input-sm">

                        		</div>

                  			</div>

                  			<div class="form-group">

                        		<label>WeChat</label>

                        		<div class="input-group">

                          			<span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-link"></i></a></span>

                        			<input type="text" id="wechat" name="wechat" class="form-control input-sm">

                        		</div>

                  			</div>

                        </div>

                        

                        <div class="clearfix"></div>

                            <div class="form-group">

                                <div class="row  col-md-12 col-xs-12">

                                    <div class="col-md-12 form-label-heading"><h5 class="text-primary">Add new social website</h5></div>

                                </div>

                            </div>

                            <div class="col-md-3">

                        		<div class="form-group">

	                            	<div class="input-group">

	                        			<input type="text" id="social_web" name="social_web" class="form-control input-sm">

	                        		</div>

                  				</div>

                        	</div>

                        	<div class="col-md-5">

                        		<div class="form-group">

	                        		<div class="input-group">

	                          			<span class="input-group-addon"><a data-target="#owner" data-toggle="modal" href=""><i class="fa fa-link"></i></a></span>

	                        			<input type="text" id="website_link" name="website_link" class="form-control input-sm">

	                        		</div>

                  				</div>

                        	</div>

                        	<div class="clearfix"></div>

                            

                        </div>

                  

                    

                    <div class="modal-footer">

                      <button class="btn btn-success social-save" data-dismiss="modal">Save & Close</button>

                    </div>

                  </div>

                </div>

              </div>

            <!-- </div> -->

            <?php echo  form_close();?>

            <!--  Form End -->

            </div>

            <!--  tab content end -->    

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

	            <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i> Share Options</a><span class="caret"></span>

	              <ul class="dropdown-menu">

	                <li><a href="#" data-target="#share_excel_all" data-toggle="modal" id="sms_verification_popup_all" rel="sms_verification_all" class="popup_a"><i class="fa fa-file-excel-o"></i> Download all Contacts(s) as Excel table</a></li>

	 				<li><a href="#" id="sms_verification_popup_selected" rel="sms_verification_selected" class="popup_a" data-target="#share_excel_sel" data-toggle="modal"><i class="fa fa-file-excel-o"></i>Download selected Contact(s) as Excel table</a></li>

	                

	              </ul>

	            </li>

	            

            </ul>

            </div>

            <div class="col-md-4">

                <ul class="list-inline pull-right">

     

                <li class="dropdown"> 

                <a href="" class="dropdown-toggle btn btn-success" data-toggle="dropdown">Views <i class="fa fa-chevron-down"></i></a>

                  <ul class="dropdown-menu">

                  

                    <li>

                 

                    <a href="#" data-toggle="modal" data-target="#show_owner_properties" id='show_owner_properties_click' href="#?w=500" rel='show_owner_properties' class="popup_a">Properties 

                    <span class="badge" id="listings_stats">0</span></a></li>

               

                    <li>

                   

                    <a href="#" data-toggle="modal" data-target="#view_deals" id='view_deal_popup_link' href="#?w=500" rel='view_deal_popup' class="popup_a">Deals 

                    <span class="badge" id="deals_stats">0</span></a></li>

                   

                </ul>

                </li>

                <li> <a href="" class="btn btn-success" data-toggle="modal" data-target="#columns">Columns <i class="fa fa-chevron-down"></i></a></li>

              </ul>

            </div>

            <!-- i am select something -->

            <div class="gist-selmsg collapse" id="openSelsome">

	  			<a data-toggle="collapse" href="#openSelsome" aria-expanded="false" aria-controls="openSelsome" role="button" class="close-selsomething"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>

	    		<img src="<?php echo base_url();?>images/select.png">

			</div>

            </div>

            </div>

           

            <div class="row">

                <table class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer" id="listings_row">

                  <thead>

                  <tr>

                    <th>

                    <label class="">

                       <input onClick="toggleChecked(this.checked)" id='check_all_checkboxes' value='' type="checkbox"/>

                        <span class="lbl"></span>

                    </label>

                    </th>

            <th style="width:5px !important;"><div style="cursor:pointer; display:none;" title="Click here to sort">auto</div></th>

			<th style="min-width:100px !important;">Ref</th>

            <th type="not_default" style="min-width:60px !important;">Gender</th>

			<th style="min-width:60px !important;">First Name</th>

			<th style="min-width:60px !important;">Last Name</th>

			<th type="not_default" style="min-width:60px !important;">Company</th>

            <th type="not_default" style="min-width:60px !important;">Home Address 1</th>

            <th type="not_default" style="min-width:60px !important;">Home Address 2</th>

            <th type="not_default" style="min-width:60px !important;">Home City</th>

            <th type="not_default" style="min-width:60px !important;">Home State</th>

            <th style="min-width:60px !important;">Home Country</th>

            <th type="not_default" style="min-width:60px !important;">Home Zip Code</th>

	        <th style="min-width:60px !important;">Home Phone</th>

            <th type="not_default" style="min-width:60px !important;">Work Phone</th>

            <th type="not_default" style="min-width:60px !important;">Home Fax</th>

            <th type="not_default" style="min-width:60px !important;">Home PO Box</th>

	        <th style="min-width:60px !important;">Personal Mobile</th>

	        <th style="min-width:30px !important;">Personal Email</th>

            <th type="not_default" style="min-width:60px !important;">Work Email</th>

            <th type="not_default" style="min-width:60px !important;">Date Of Birth</th>

            <th type="not_default" style="min-width:60px !important;">Designation</th>

            <th type="not_default" style="min-width:60px !important;">Nationality</th>

            <th type="not_default" style="min-width:60px !important;">Religion</th>

            <th type="not_default" style="min-width:60px !important;">Title</th>

            <th type="not_default" style="min-width:60px !important;">Work Mobile</th>



	        <th style="min-width:70px !important;">Assigned To</th>

            <th style="width:10px !important;">Updated</th>



            <th style="width:1px !important;"></th>

			 <th style="width:1px !important;"><div style="min-width:10px !important;"></div></th>

            <th style="min-width:60px !important;">Other Phone</th>

            <th style="min-width:60px !important;">Other Mobile</th>

            <th style="min-width:60px !important;">Work Fax</th>

            <th style="min-width:60px !important;">Other Fax</th>

            <th style="min-width:60px !important;">Other Email</th>

            <th style="min-width:60px !important;">Website</th>

            <th style="min-width:60px !important;">Facebook</th>

            <th style="min-width:60px !important;">Twitter</th>

            <th style="min-width:60px !important;">LinkedIn</th>

            <th style="min-width:60px !important;">Google+</th>

            <th style="min-width:60px !important;">Instagram</th>

            <th style="min-width:60px !important;">WeChat</th>

            <th style="min-width:60px !important;">Skype</th>

            <th style="min-width:60px !important;">Nationality 2</th>

            <th style="min-width:60px !important;">Company PO Box</th>

            <th style="min-width:60px !important;">Company Address 1</th>

            <th style="min-width:60px !important;">Company Address 2</th>

            <th style="min-width:60px !important;">Company City</th>

            <th style="min-width:60px !important;">Company State</th>

            <th style="min-width:60px !important;">Company Country</th>

            <th style="min-width:60px !important;">Company Zip Code</th>



            <th style="min-width:60px !important;">Native Language</th>

            <th style="min-width:60px !important;">Second Language</th>

            <th style="min-width:60px !important;">Contact Source</th>

            <th style="min-width:60px !important;">Contact Type</th>

            <th style="min-width:60px !important;">Created Date</th>

            <th style="min-width:60px !important;">Created By</th>

            <th style="width:1px !important;"></th>

                    </tr>

                    </thead>

			<thead id="searchbox1" class="search_box">

                    <tr class="highlighted">

           <form id="myForm2" action="#" method="post">

                    <td><a style="display:none;" id="reset_filter" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png?ts=10" title="Reset filter"></a></td>

                   

                    

                    <td class="dropdown">

                    <a href="" id="1" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                   	    <div class="dropdown-menu emirate_search data" id="data1">

                        <span id_search='1' value="0" image="<?php echo base_url();?>mydata/images/header_autox.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_autox.png" title="Not Imported"></span><br>

                        <span id_search='1' value="1" image="<?php echo base_url();?>mydata/images/header_auto.png" class='sorting'><img src="<?php echo base_url();?>mydata/images/header_auto.png" title="auto Imported"></span>

              			</div>

                    </td>

                    

                    

                    

                    <td><input id='2' type="text" class="form-control input-sm search_init" /></td>

                    <td>

                     <select id="3"  type="text" class="search_init">

                                                        <option value="">Select</option>

                                                        <option value="1">Male</option>

                                                        <option value="2">Female</option>

                                                    </select>

                    

                    </td>

                    <td><input id='4' type="text" class="search_init form-control input-sm" /></td>

                    <td><input id='5' type="text" class="search_init form-control input-sm" /></td>

                    <td><input id='6' type="text" class="search_init form-control input-sm" /></td>

                    <td>

                   <input id='7' type="text" class="search_init form-control input-sm" />

                    </td>

                    <td>

                   <input id='8' type="text" class="search_init form-control input-sm" />

                    </td>

                    <td><input id='9' type="text" class="search_init form-control input-sm" /></td>

                    <td><input id='10' type="text" class="search_init form-control input-sm" /></td>

                    <td>

                   <input id='11' type="text" class="search_init form-control input-sm" />

                    </td>

                     <td>

							<input id='12' type="text" class="search_init form-control input-sm" />

						</td>

                        <td>

							<input id='13' type="text" class="search_init form-control input-sm" />

						</td>

                        <td>

							<input id='14' type="text" class="search_init form-control input-sm" />

						</td>

						<td>

							<input id='15' type="text" class="search_init form-control input-sm" />

						</td>

						<td>

							<input id='16' type="text" class="search_init form-control input-sm" />

						</td>

						<td>

							<input id='17' type="text" class="search_init form-control input-sm" />

						</td>

						<td>

							<input id='18' type="text" class="search_init form-control input-sm" />

						</td>

						<td>

							<input id='19' type="text" class="search_init form-control input-sm" />

						</td>

                        <td>

                                                        <input id='20' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='21' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='22' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='23' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                    <select name="24" class="form-control 24" id="24">

                                                        <option value="">Select</option>

                                                        <option value="Mr">Mr</option>

                                                        <option value="Mrs">Mrs</option>

                                                        <option value="Ms">Ms</option>

                                                        <option value="Miss">Miss</option>

                                                        <option value="Mx">Mx</option>

                                                        <option value="Master">Master</option>

                                                        <option value="Sir">Sir</option>

                                                        <option value="Madam">Madam</option>

                                                        <option value="Dr">Dr</option>

                                                        <option value="Prof">Prof</option>

                                                        <option value="Hon">Hon</option>

                                                        <option value="0">Other</option>

                                                    </select>

                                                </td>

                                                <td>

                                                        <input id='25' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

							<select id='26' type="text" class="search_init">

								<option value="" selected>Select</option>

								                                                             

															</select>

						</td>

						<td><input name="dateupdatedS" class="search_init_date form-control input-sm" type="text" id="dateupdatedS" readonly/></td>

                        <td style="display: none;"></td>

                        <td style="display: none;"></td>

                         <td>

                                                        <input id='30' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='31' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='32' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='33' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='34' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='35' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='36' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='37' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='38' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                <td>

                                                        <input id='39' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                 <td>

                                                        <input id='40' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                 <td>

                                                        <input id='41' type="text" class="search_init form-control input-sm" />

                                                </td>

                                                 <td>

                            <input id='42' type="text" class="search_init form-control input-sm" />

                        </td>

                        <td>

                            <input id='43' type="text" class="search_init form-control input-sm" />

                        </td>

                        <td>

                            <input id='44' type="text" class="search_init form-control input-sm" />

                        </td>

                        <td>

                            <input id='45' type="text" class="search_init form-control input-sm" />

                        </td>

                        <td>

                            <input id='46' type="text" class="search_init form-control input-sm" />

                        </td>

                        <td>

                            <input id='47' type="text" class="search_init form-control input-sm" />

                        </td>

                        <td>

                            <input id='48' type="text" class="search_init form-control input-sm" />

                        </td>

                        <td>

                            <input id='49' type="text" class="search_init form-control input-sm" />

                        </td>

                        <td>

                            <input id='50' type="text" class="search_init form-control input-sm" />

                        </td>

                        <td>

                            <input id='51' type="text" class="search_init form-control input-sm" />

                        </td>

                        <td>

                            <input id='52' type="text" class="search_init form-control input-sm" />

                        </td>

                         <td>

                            <select id='53' type="text"  class="search_init 53">

                                <option value="" selected>Select</option>

                                <option value=" Not Specified" > Not Specified</option><option value="7 days" >7 days</option><option value="Abu Dhabi week" >Abu Dhabi week</option><option value="Agent" >Agent</option><option value="Agent External" >Agent External</option><option value="Agent Internal" >Agent Internal</option><option value="Al Ayam" >Al Ayam</option><option value="Al Bayan" >Al Bayan</option><option value="Al Futtaim" >Al Futtaim</option><option value="Al Ittihad News paper" >Al Ittihad News paper</option><option value="Al Khaleej" >Al Khaleej</option><option value="Al Rai" >Al Rai</option><option value="AL Watan" >AL Watan</option><option value="Arab Times" >Arab Times</option><option value="Asharq Al Awsat" >Asharq Al Awsat</option><option value="Bank Referral" >Bank Referral</option><option value="Bayut.com" >Bayut.com</option><option value="Blackberry SMS" >Blackberry SMS</option><option value="Business card" >Business card</option><option value="Client Referral" >Client Referral</option><option value="Cold call" >Cold call</option><option value="Colours TV" >Colours TV</option><option value="Database" >Database</option><option value="Developer" >Developer</option><option value="Direct call" >Direct call</option><option value="Direct Client" >Direct Client</option><option value="Drive around" >Drive around</option><option value="Dubizzle Feature" >Dubizzle Feature</option><option value="Dubizzle.com" >Dubizzle.com</option><option value="Dzooom.com" >Dzooom.com</option><option value="Email campaign" >Email campaign</option><option value="Ertebat" >Ertebat</option><option value="Exhibition Stand" >Exhibition Stand</option><option value="Existing client" >Existing client</option><option value="EzEstate" >EzEstate</option><option value="EzHeights.com" >EzHeights.com</option><option value="Facebook" >Facebook</option><option value="Flyers" >Flyers</option><option value="Forbes Mailer" >Forbes Mailer</option><option value="Friend or Relative" >Friend or Relative</option><option value="Google " >Google </option><option value="Gulf Daily News" >Gulf Daily News</option><option value="Gulf News" >Gulf News</option><option value="Gulf News Mailer" >Gulf News Mailer</option><option value="Gulf Newspaper Freehold" >Gulf Newspaper Freehold</option><option value="Gulf Newspaper Residential" >Gulf Newspaper Residential</option><option value="Gulf Times" >Gulf Times</option><option value="Gulfnews Freehold" >Gulfnews Freehold</option><option value="Gulfpropertyportal.com" >Gulfpropertyportal.com</option><option value="Instagram" >Instagram</option><option value="JustProperty.com" >JustProperty.com</option><option value="JustRentals.com" >JustRentals.com</option><option value="JUWAI" >JUWAI</option><option value="Khaleej Times" >Khaleej Times</option><option value="LinkedIn" >LinkedIn</option><option value="Listanza" >Listanza</option><option value="Luxury Estate.com" >Luxury Estate.com</option><option value="Luxury Square Foot" >Luxury Square Foot</option><option value="Magazine" >Magazine</option><option value="Memaar TV" >Memaar TV</option><option value="MoneyCamel.com" >MoneyCamel.com</option><option value="National News paper" >National News paper</option><option value="Newsletter" >Newsletter</option><option value="Newspaper advert" >Newspaper advert</option><option value="Old Landlord" >Old Landlord</option><option value="Online Banners" >Online Banners</option><option value="Open House" >Open House</option><option value="Other" >Other</option><option value="Other portal" >Other portal</option><option value="Outdoor Media" >Outdoor Media</option><option value="Personal Referral" >Personal Referral</option><option value="Property Acquisition Department" >Property Acquisition Department</option><option value="Property Finder Premium" >Property Finder Premium</option><option value="Property Inc." >Property Inc.</option><option value="Property Management" >Property Management</option><option value="Property Trader" >Property Trader</option><option value="Property Weekly" >Property Weekly</option><option value="Propertyfinder.ae" >Propertyfinder.ae</option><option value="Propertyonline" >Propertyonline</option><option value="Propertywifi.com" >Propertywifi.com</option><option value="PropSpace MLS" >PropSpace MLS</option><option value="Radio" >Radio</option><option value="Radio Advert" >Radio Advert</option><option value="Referral within company" >Referral within company</option><option value="Relocation" >Relocation</option><option value="Rightmove.co.uk" >Rightmove.co.uk</option><option value="Roadshow" >Roadshow</option><option value="Sandcastles.ae" >Sandcastles.ae</option><option value="School Communicator" >School Communicator</option><option value="School Communicator" >School Communicator</option><option value="Search Engine" >Search Engine</option><option value="Signboard" >Signboard</option><option value="SMS campaign" >SMS campaign</option><option value="Social media Campaign" >Social media Campaign</option><option value="Souq.com" >Souq.com</option><option value="Staff Mailer" >Staff Mailer</option><option value="Twitter " >Twitter </option><option value="Walk-in" >Walk-in</option><option value="Website" >Website</option><option value="Whatpricemyhome" >Whatpricemyhome</option><option value="Whatsapp" >Whatsapp</option><option value="Word of Mouth" >Word of Mouth</option><option value="www.propertyportal.ae" >www.propertyportal.ae</option><option value="Youtube" >Youtube</option><option value="Zawya Mailer" >Zawya Mailer</option><option value="Zoopla" >Zoopla</option>                            </select>

                        </td>

                        <td>

                            <select id='54' type="text"  class="search_init 54">

                                <option value="" selected>Select</option>

                                <option value="1">Tenant</option><option value="2">Buyer</option><option value="3">Landlord</option><option value="4">Seller</option><option value="5">Landlord+Seller</option><option value="6">Representative of Tenant</option><option value="7">Other</option>                            </select>

                        </td>

                        <td><input name="datecreatedS" class="search_init_date 55 form-control input-sm" type="text" id="datecreatedS" readonly/></td>

                        <td>

                            <select id='56' class="search_init 56">

                                <option selected>Select</option>

                                                       </select>

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

            </div>

            </div>

            </div>

            

                    

            

            



 			</div>

            </div>

            <!-- container end -->

            

            

            </div>

			<!-- wrapper end -->

              



           

<script type="text/javascript" src="<?php echo site_url();?>js_module/common.js?ts=11234"></script> 

<script type="text/javascript" src="<?php echo site_url();?>js_module/contacts.js?ts=11234"></script>



      <script>

    $(document).ready(function(){

         $('#sms_verification_popup_all').click(function(){

            $("#export_all_popup").css("display","none");

            $("#sms_verification_window").css("display","");

        });



        $('#sms_pdf_verification_popup_selected').click(function(){

            $("#pdf_export_selected").css("display","none");

            $("#sms_pdf_verification_selected_window").css("display","");

        });



         $('#sms_verification_popup_selected').click(function(){

            $("#export_selected_popup").css("display","none");

            $("#sms_verification_selected_window").css("display","");

        });

    });

</script>

<script>

	function landlord_checkboxes(value){

		$('#ExportToCSV').html('<a class="popup_a" href="<?php echo base_url();?>generate/generate_landlord/exportCSV?exportCSV='+value+'"><img src="<?php echo base_url();?>mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>'); // update download button link

	}

	</script>

	<script>





      $(document).ready(function() {



           $('#ExportToPDFALL').html('<div style="display:none;" id="downloadPDFtables_animation"><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download PDF in progress. Please wait.</div><a id="downloadPDFtables_div" class="popup_a" href="<?php echo base_url();?>generate/generate_landlord/exportPDF?exportPDF=landlord"><img src="<?php echo base_url();?>mydata/images/pdf_big.png?ts=10" width="32" height="32"><br>Download PDF</a>'); // update download button link

	   $('#ExportToCSVALL').html('<div style="display:none;" id="downloadCSV_animation"><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div><a id="downloadCSV_div" class="popup_a" href="<?php echo base_url();?>generate/generate_landlord/exportCSV?exportCSV=landlord"><img src="<?php echo base_url();?>mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>'); // update download button link



        $('#listings_row').change(function(){

				var value = [];

				var count = 0;

				$('#listings_row input:checked').each(function() {

					value+=$(this).attr('value')+',';

					count++;

				});

					$('#emailPDF').val(value);

					$('#exportPDF').val(value);

					$('#ExportToPDF').html('<a class="popup_a" href="<?php echo base_url();?>generate/generate_landlord/exportPDF?exportPDF='+value+'"><img src="<?php echo base_url();?>mydata/images/pdf_big.png?ts=10" width="32" height="32"><br>Download PDF</a>'); // update download button link

					$('#email_count').text(count);

					$('#emailCSV').val(value);

					$('#ExportToCSV').html('<a class="popup_a" href="<?php echo base_url();?>generate/generate_landlord/exportCSV?exportCSV='+value+'"><img src="<?php echo base_url();?>mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>'); // update download button link

										//$('#sms-iframe').attr('src', '<?php echo base_url();?>sendSMS/showSMSLandlordForm/'+value);

					        });

      });

	</script>

        <!-- Share Option Modal -->

            <div class="modal fade" id="share_excel_all" tabindex="-1">

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Download Excel</h4>

                    <p>To download selected listings as excel,Please click the icon. </p>

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

            

            <div class="modal fade" id="share_excel_sel" tabindex="-1">

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Download Excel</h4>

                    <p>To download all listings as excel,Please click the icon. </p>

                  </div>

                  

                  <div class="modal-body">

                  

                     <div align="center" id="ExportToCSV">

            Please select listing(s) first

	   </div>

                    

                  </div>

                  

                  <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>

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

                  <div class="row" id="columns_list"></div>

                   <div><span id="total_active_columns" style="font-weight:bold;">0</span> out of <span id="total_editable_columns" style="font-weight:bold;"></span> columns are selected</div>

                   </div>

                  

                  <div class="modal-footer">

                    <button type="button" id="save_columns_settings" class="btn btn-success" data-dismiss="modal"><i class="fa fa-save"></i> Save</button>

                    <button type="button" class="btn btn-primary"  id="reset_columns_settings"><i class="fa fa-refresh"></i> Reset</button>

                    <button type="button" class="btn btn-default" id="btn-close-managecolumns" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>

                  </div>

                </div>

              </div>

            </div> 

            

              <!-- View properties Modal -->

            <div class="modal fade" id="show_owner_properties" tabindex="-1" >

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Owned Properties</h4>

                  </div>

                  

                  <div class="modal-body">

                  <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover" id="owned_properties">

                            <thead>

             <tr>

             <th></th>

            <th>Reference</th>

			<th>Type</th>

			<th>Category</th>

			<th>Region</th>

			<th>Main-Location</th>

			<th>Sub-Location</th>

			<th>Beds</th>

			<th>Sqt Ft</th>

			<th>Price</th>

			<th>Agent</th>

			<th>Listed</th>

           

			 </tr>

                            </thead>

                            <thead id="searchbox2" class="search_box">

		<tr>

			 <th></th>

            

				<td>

					<input id='1' type="text" class="search_init"/>

				</td>

				<td>

					<select id='2' type="text" class="search_init" >

						<option value="" selected>Select</option>

						<option value="1" >Rental</option>

						<option value="2" >Sales</option>

					</select>

				</td>

				<td>

					<select id='3' class="search_init">

						<option value="" selected>Select</option>

												<option value="1"> Apartment </option>

												<option value="2"> Villa </option>

												<option value="3"> Office </option>

												<option value="4"> Retail </option>

												<option value="5"> Hotel Apartment </option>

												<option value="6"> Warehouse </option>

												<option value="7"> Land Commercial </option>

												<option value="8"> Labour Camp </option>

												<option value="9"> Residential Building </option>

												<option value="10"> Multiple Sale Units </option>

												<option value="11"> Land Residential </option>

												<option value="12"> Commercial Full Building </option>

												<option value="13"> Penthouse </option>

												<option value="14"> Duplex </option>

												<option value="15"> Loft Apartment </option>

												<option value="16"> Townhouse </option>

												<option value="17"> Hotel </option>

												<option value="18"> Land Mixed Use </option>

												<option value="21"> Compound </option>

												<option value="24"> Half Floor </option>

												<option value="27"> Full Floor </option>

												<option value="30"> Commercial Villa </option>

												<option value="48"> Bungalow </option>

												<option value="50"> Factory </option>

											</select>

				</td>

				<td>

					<select id='4' class="search_init">

						<option value="" selected>Select</option>

												<option value="2"> Abu Dhabi </option>

												<option value="4"> Ajman </option>

												<option value="8"> Al Ain </option>

												<option value="1"> Dubai </option>

												<option value="7"> Fujairah </option>

												<option value="6"> Ras Al Khaimah </option>

												<option value="3"> Sharjah </option>

												<option value="5"> Umm Al Quwain </option>

											</select>

				</td>

				<td>

					<input type="text" id="5" class="search_init" />

				</td>

				<td>

					<input type="text" id="6" class="search_init" />

				</td>

				<td>

					<input id='7' type="text" class="search_init" />

				</td>

				<td>

					<input id='8' type="text" class="search_init"/>

				</td>

				<td>

					<input id='9' type="text" class="search_init" />

				</td>

				<td>

					<input id='10' type="text" class="search_init" />

				</td>

				<td>

					<input id='11' type="text" class="search_init" />

				</td>

				

             

			

		</tr>

		</thead>

                            <tbody>

			

                            </tbody>

                        </table>

                     </div>

                    </div>

                  </div>

                </div>

              </div>

              

                <!-- View Deals Modal -->

            <div class="modal fade" id="view_deals" tabindex="-1" >

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Deals</h4>

                  </div>

                  

                  <div class="modal-body">

                  <div id="view_deal_popup" class="popup_block">

		<div id="view_deal_window">

			Please select a listings

		</div>

	</div>

                    </div>

                  </div>

                </div>

              </div>

              <script>

            $(document).ready(function(){

                $(".ltrim").numeric();

            });

            $(".ltrim").blur(function() {

                var str = $(this).val();

                $(this).val((ltrim(str, "0")));

            });

            function ltrim(str, chars) {

                chars = chars || "\\s";

                return str.replace(new RegExp("^[" + chars + "]+", "g"), "");

            }

</script>

<script>

    $(document).ready(function() {

    $('.baseUrl').click( function() {

        var urlName = $('#'+$(this).attr('type')).val() ;

        if(urlName == ''){

            return false;

        }else{

            var linkURL = $(this).attr('href') + '/' +  $('#'+$(this).attr('type')).val();

            window.open(linkURL, '_blank');

            return false;

        }

    });

});





function checkDocument(){

        if(formDataChange == false){

                return false;

        }

};



function resetCSSFields(){

    if ($("#c_code_phone_1_field").val() =='' || $("#phone").val() ==''){

             $("#ph_link1").css('display','none')

         }

         if ($("#c_code_phone_2_field").val() =='' || $("#phone_2").val() ==''){

             $("#ph_link2").css('display','none')

         }

         if ($("#c_code_phone_3_field").val() =='' || $("#phone_3").val() ==''){

             $("#ph_link3").css('display','none')

         }



         if ($("#mobile_no_new_ccode_field").val() =='' || $("#mobile_no_new").val() ==''){

             $("#mob_link1").css('display','none')

         }

         if ($("#mobile_no_new_ccode_2_field").val() =='' || $("#mobile_2").val() ==''){

             $("#mob_link2").css('display','none')

         }

         if ($("#mobile_no_new_ccode_3_field").val() =='' || $("#mobile_3").val() ==''){

             $("#mob_link3").css('display','none')

         }



         if ($("#c_code_fax_field").val() =='' || $("#fax").val() ==''){

             $("#fax_link1").css('display','none')

         }

         if ($("#c_code_fax_2_field").val() =='' || $("#fax_2").val() ==''){

             $("#fax_link2").css('display','none')

         }

         if ($("#c_code_fax_3_field").val() =='' || $("#fax_3").val() ==''){

             $("#fax_link3").css('display','none')

         }



        if ($("#email").val() ==''){

             $("#email_link1").css('display','none')

         }

         if ($("#email_2").val() ==''){

             $("#email_link2").css('display','none')

         }

         if ($("#email_3").val() ==''){

             $("#email_link3").css('display','none')

         }



};





function setCSSFields(){



    $("#ph_link1").click( function () {

            $("#ph_link1").removeClass('contact-hollow-circle');

            $("#ph_link1").addClass('contact-circle');

            $("#ph_link2,#ph_link3").addClass('contact-hollow-circle');

            document.getElementById('phlist1').style.display = "block";

            document.getElementById('phlist2').style.display = "none";

            document.getElementById('phlist3').style.display = "none";



         });

         $("#ph_link2").click( function () {

             $("#ph_link2").removeClass('contact-hollow-circle');

             $("#ph_link2").addClass('contact-circle');

             $("#ph_link1,#ph_link3").addClass('contact-hollow-circle');

             document.getElementById('phlist1').style.display = "none";

             document.getElementById('phlist2').style.display = "block";

             document.getElementById('phlist3').style.display = "none";

         });

         $("#ph_link3").click( function () {

             $("#ph_link3").removeClass('contact-hollow-circle');

              $("#ph_link3").addClass('contact-circle');

              $("#ph_link1,#ph_link2").addClass('contact-hollow-circle');

              document.getElementById('phlist1').style.display = "none";

              document.getElementById('phlist2').style.display = "none";

              document.getElementById('phlist3').style.display = "block";

         });

         // Mobile

          $("#mob_link1").click( function () {

              $("#mob_link1").removeClass('contact-hollow-circle');

              $("#mob_link1").addClass('contact-circle');

              $("#mob_link2,#mob_link3").addClass('contact-hollow-circle');

              document.getElementById('moblist1').style.display = "block";

              document.getElementById('moblist2').style.display = "none";

              document.getElementById('moblist3').style.display = "none";



         });

         $("#mob_link2").click( function () {

              $("#mob_link2").removeClass('contact-hollow-circle');

              $("#mob_link2").addClass('contact-circle');

              $("#mob_link1,#mob_link3").addClass('contact-hollow-circle');

              document.getElementById('moblist1').style.display = "none";

              document.getElementById('moblist2').style.display = "block";

              document.getElementById('moblist3').style.display = "none";

         });

         $("#mob_link3").click( function () {

             $("#mob_link3").removeClass('contact-hollow-circle');

             $("#mob_link3").addClass('contact-circle');

             $("#mob_link1,#mob_link2").addClass('contact-hollow-circle');

              document.getElementById('moblist1').style.display = "none";

              document.getElementById('moblist2').style.display = "none";

              document.getElementById('moblist3').style.display = "block";

         });

         // Fax

         $("#fax_link1").click( function () {

             $("#fax_link1").removeClass('contact-hollow-circle');

             $("#fax_link1").addClass('contact-circle');

             $("#fax_link2,#fax_link3").addClass('contact-hollow-circle');

                document.getElementById('faxlist1').style.display = "block";

                document.getElementById('faxlist2').style.display = "none";

                document.getElementById('faxlist3').style.display = "none";



         });

         $("#fax_link2").click( function () {

             $("#fax_link2").removeClass('contact-hollow-circle');

             $("#fax_link2").addClass('contact-circle');

             $("#fax_link1,#fax_link3").addClass('contact-hollow-circle');

              document.getElementById('faxlist1').style.display = "none";

              document.getElementById('faxlist2').style.display = "block";

              document.getElementById('faxlist3').style.display = "none";

         });

         $("#fax_link3").click( function () {

             $("#fax_link3").removeClass('contact-hollow-circle');

             $("#fax_link3").addClass('contact-circle');

             $("#fax_link1,#fax_link2").addClass('contact-hollow-circle');

              document.getElementById('faxlist1').style.display = "none";

              document.getElementById('faxlist2').style.display = "none";

              document.getElementById('faxlist3').style.display = "block";

         });



         // Email



         $("#email_link1").click( function () {

             $("#email_link1").removeClass('contact-hollow-circle');

             $("#email_link1").addClass('contact-circle');

             $("#email_link2,#email_link3").addClass('contact-hollow-circle');

                document.getElementById('email_list1').style.display = "block";

                document.getElementById('email_list2').style.display = "none";

                document.getElementById('email_list3').style.display = "none";

         });

         $("#email_link2").click( function () {

              $("#email_link2").removeClass('contact-hollow-circle');

             $("#email_link2").addClass('contact-circle');

             $("#email_link1,#email_link3").addClass('contact-hollow-circle');

              document.getElementById('email_list1').style.display = "none";

              document.getElementById('email_list2').style.display = "block";

              document.getElementById('email_list3').style.display = "none";

         });

         $("#email_link3").click( function () {

             $("#email_link3").removeClass('contact-hollow-circle');

             $("#email_link3").addClass('contact-circle');

             $("#email_link1,#email_link2").addClass('contact-hollow-circle');

              document.getElementById('email_list1').style.display = "none";

              document.getElementById('email_list2').style.display = "none";

              document.getElementById('email_list3').style.display = "block";

         });



};



</script>