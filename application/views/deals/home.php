<script>

if($('#rand_key').val()<1 || $('#rand_key').val()=='')

{

$('#rand_key').val(genRandKey());

}

</script>

<script>

	

	var oTable ;

   



    $(document).ready(function() {

        

        

     $(document.body).on("change","#addendum_template",function() {  

              var value = $(this).val();

               $.ajax({

                      async: false,

                      url: mainurl + 'deals/getAddendumDescription/' + value,

                      success: function(data) {

                          $('#doc_addendum').val(data);

                      }

                  });

         });



        

        /* generate column list start*/

        var column_count = 0;

        var column_names = [];



        $.each($('#listings_row thead th'), function() {

            column_names.push($(this).text() + '|' + column_count + '|' + $(this).attr('type'))

            column_count++;

        });



        column_names.sort();



        var column_count = 0;

        var editable_columns = 0;



        for (column_count = 0; column_count < column_names.length; ++column_count) {

            var single_column = column_names[column_count];

            single_column = single_column.split('|')

            var column_name = single_column[0];

            var column_id = single_column[1];

            var column_type = single_column[2];

            var read_only_columns = new Array('1', '2', '3', '4', '16', '30');

            if (column_id != 0) {

              	   if( $.inArray(column_id, read_only_columns) > -1 ) {

                    $('#columns_list').append("<div class='col-md-4'><div class='form-group form_group_checkbox'><input type='checkbox'" +  ' disabled="disabled" '   + "default='"+column_type +"' checked name='column_"+column_id+"' id='column_"+column_id+"' col='"+column_id+"' value='1' tabindex='33' checked><span class='lbl padding'>"+column_name+"</span></div></div>");

                } else {

                    $('#columns_list').append("<div class='col-md-4'><div class='form-group form_group_checkbox'><input type='checkbox' default='"+column_type  +"' checked name='column_"+column_id+"' id='column_"+column_id+"' col='"+column_id+"' value='1' tabindex='33'><span class='lbl padding'>"+column_name+"</span></div></div>");

                }

				

				

                editable_columns++;

            }

        }



        $('#total_editable_columns').html(editable_columns);

        /* generate column list end */



    });



</script>

<?php

// 33,18,23,38,21,27,39,31,35,25,28,34,

$mystr = "";

if($mystr == '') $mystr = "11,17,19,18,21,20,26,11,29,27,13,14,12,25,22,15,24";



?>

<script type="text/javascript">

	var last_id = 0;

    var screenname = "deals";



    var formDataChange = false;



    



//datatable initilization

    $(document).ready(function() {        

        /* Notification IDs */

        var notification_id = '';

        notification_id = '';

        

        oTable = $('#listings_row').dataTable({

            "bProcessing": true,

            "sDom": 'R<>rt<ilp><"clear">',

			

            "aoColumnDefs": [

                {

                    'render': function (data, type, full, meta){

                        //check the main check box

                        $('#check_all_checkboxes').attr('checked', false);

                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';

                    },

                    "aTargets": [0]

                },

                {"bSortable": false, "aTargets": [0]},

                {"bVisible": false, "aTargets": [<?php echo $mystr;?>]}

            ],

			

			"columns": [

			{ "data": "id" },

            { "data": "ref" },

			{ "data": "type" },

			{ "data": "status" },

			{ "data": "sub_status" },

			{ "data": "tenant_buyer_name" },

            { "data": "landlord_seller_name" },

            { "data": "region_id" },

            { "data": "area_location_id" },

            { "data": "sub_area_location_id" },

            { "data": "price" },

			{ "data": "price" },

			{ "data": "deposit" },

			{ "data": "deal_date" },

			{ "data": "deal_estimated_date" },

            { "data": "renewal_date" },

            { "data": "agent_1_id" },

            { "data": "agent_1_commission" },

            { "data": "agent_2_id" },

            { "data": "agent_2_commission" },

			{ "data": "agent_3_id" },

			{ "data": "agent_3_commission" },

			{ "data": "listings_ref" },

			{ "data": "listings_beds" },

            { "data": "listings_street_no" },

            { "data": "listings_floor_no" },

            { "data": "listings_floor_no" },

            { "data": "created_by_name" },

            { "data": "listings_unit" },

			{ "data": "commission" },

			{ "data": "dateupdated" },

          

                     

                        

            ],

            "aaSorting": [[30, 'desc']],

            "bServerSide": true,

            "bRegex": true,

            "sAjaxSource": config.siteUrl+"deals/datatable?ts="+Math.round((new Date()).getTime() / 100),

            "iDisplayStart": 0,

            "sPaginationType": "full_numbers",

            "oLanguage": {

                "sSearch": "Search all columns:"

            },

			"rowCallback": function( row, data ) {

				 $(row).attr("id",data.id);

				   if ( data.status == 1 )

					      {

						  $('td:eq(3)', row).html( 'Open' );

						  }

						   if ( data.status == 2 )

					      {

						  $('td:eq(3)', row).html( 'Closed' );

						  }

						  if ( data.status == 3)

					      {

						  $('td:eq(3)', row).html( 'Not Specified' );

						  }

						  return row;

			},

            'fnServerData': function (url, data, callback){ 

                /* Add some extra data to the sender */

          		 

				data.as_listings_ref = $('#as_listings_ref').val();

				data.listings_beds = $('#as_beds').val();

				data.listings_unit = $('#as_unit').val();

				data.as_unit_type = $('#as_unit_type').val();

				data.as_street_no = $('#as_street_no').val();

				data.as_floor_no = $('#as_floor_no').val();

				data.as_created_by_name = $('#as_created_by_name').val();





                

                data.listings_id = '';

                data.landlord_id = '';

                data.leads_id = '';

                data.deal_id = '';

                data.contracts_id = '';

                data.type = '';

                data.deal_id = '';

                data.listing_type = '<?php echo $listing_type;?>';

                

                

                

                    $.ajax( {

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

                       } );

		

                

            }

        });



        /* Code to hide/show columns START */



        /* hide the search columns */

            $('#searchbox tr').find("td:nth-child(" + (17 + 2) + ")").css('display', 'none');

            $('#column_17').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (19 + 2) + ")").css('display', 'none');

            $('#column_19').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (18 + 2) + ")").css('display', 'none');

            $('#column_18').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (21 + 2) + ")").css('display', 'none');

            $('#column_21').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (20 + 2) + ")").css('display', 'none');

            $('#column_20').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (26 + 2) + ")").css('display', 'none');

            $('#column_26').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (11 + 2) + ")").css('display', 'none');

            $('#column_11').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (29 + 2) + ")").css('display', 'none');

            $('#column_29').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (27 + 2) + ")").css('display', 'none');

            $('#column_27').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (13 + 2) + ")").css('display', 'none');

            $('#column_13').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (14 + 2) + ")").css('display', 'none');

            $('#column_14').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (12 + 2) + ")").css('display', 'none');

            $('#column_12').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (25 + 2) + ")").css('display', 'none');

            $('#column_25').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (22 + 2) + ")").css('display', 'none');

            $('#column_22').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (15 + 2) + ")").css('display', 'none');

            $('#column_15').attr('checked', false);

            $('#searchbox tr').find("td:nth-child(" + (24 + 2) + ")").css('display', 'none');

            $('#column_24').attr('checked', false);

        //setDatatableWidth();

        /* hide the search columns end */

        



        $('#total_active_columns').html($('#columns_list input:checked').length)



        $(document.body).on("click", "#save_columns_settings", function(event) {

            var disabled_columns_array = [];

            $('#columns_list input[type="checkbox"]:unchecked').each(function() {

                disabled_columns_array.push($(this).attr('col'));

            });



            $.post("<?php echo base_url();?>common/save_disabled_columns/", {

            columns: disabled_columns_array,
             screenname: 'deals',

            }, function(info) {

                $('a.close').click();

            });

        });



        $(document.body).on("click", "#reset_columns_settings", function(event) {

            $('#columns_list input[type="checkbox"]').each(function() {

                if ($(this).attr('checked') == 'checked' && $(this).attr('default') == 'not_default') {

                    fnShowHide($(this).attr('col'))

                    $(this).attr('checked', false)

                } else if ($(this).attr('checked') == false && $(this).attr('default') != 'not_default') {

                    fnShowHide($(this).attr('col'))

                    $(this).attr('checked', 'checked')

                }

                $('#total_active_columns').html($('#columns_list input:checked').length)

            });

           // setDatatableWidth();

        });



        /* Code to hide/show columns END */





        $("thead input").keyup(function() {

            /* Filter on the column (the index) of this element */

            oTable.fnFilter(this.value, $(this).attr('id'));

            $('#reset_filter').css('display', '');



        });



        $("thead select").change(function() {

            /* Filter on the column (the index) of this element */

            oTable.fnFilter(this.value, $(this).attr('id'));

            $('#reset_filter').css('display', '');

        });





        $('#dateupdatedS, #dateupdatedSto, #deal_dateS, #deal_dateSto, #deal_est_dateS, #renewal_dateS').datepicker({

            dateFormat: 'yy-mm-dd',

            onClose: function(dateText, inst) {

                oTable.fnDraw(false);

                $('#reset_filter').css('display', '');

            }

        })





        //reset filter and drawtable

        $("#reset_filter").click(function() {

            notification_id = '';

            $("#myForm2")[ 0 ].reset();

            $("#as_search_form")[0].reset();

            $("#groups_toggle").val('');

            oTable.fnDraw(false);

            oTable.fnFilterClear(true);

            $('#reset_filter').css('display', 'none');



        });



        //advance search

        $(".advance_search, #groups_toggle").change(function() {

            oTable.fnDraw();

            $('#reset_filter').css('display', '');

        });



        $(".advance_search").keyup(function() {

            oTable.fnDraw();

            $('#reset_filter').css('display', '');

        });



        $('#as_deal_date').datepicker({

            dateFormat: 'dd-mm-yy',

            showButtonPanel: true,

            onClose: function(dateText, inst) {

                oTable.fnDraw(false);

                $('#reset_filter').css('display', '');

            }

        })



        $('#renewal_date').datepicker({

            dateFormat: 'dd-mm-yy',

            changeMonth: true,

            showButtonPanel: true,

            changeYear: true,

        })



//change css of selected row	

        $(document.body).on("click", "#listings_row tbody tr, .overflow", function(event) {

            if (formDataChange == false) {

                $("td.yellowCSS", oTable.fnGetNodes()).removeClass("yellowCSS");

                $('#listings_row tbody #'+$(this).attr('rel')).find("td").addClass("yellowCSS");

                $(event.target).parent().find("td").addClass("yellowCSS");

            }

        });





// check box delete



        // $(document.body).on("click", '.dbstatus', function() {



        //     if ($('#listings_row input').is(':checked')) {



        //         if (confirm("Are you sure you want to " + $(this).attr('id') + "?")) {

        //             var allVals = [];

        //             type = $(this).attr('id');

        //             $('input[type="checkbox"]:checked').each(function() {

        //                 allVals.push($(this).val());

        //                 name = $(this).attr('id');

        //             });





        //             $.post('https://crm.propspace.com/deals/status/', {ids: allVals, type: $(this).attr('id')},

        //             function(data) {



        //                 $("#myForm")[ 0 ].reset();

        //                 $('#edit').css('display', 'none'); /* This shows the update button when a filed is selected */

        //                 $('#new').css('display', 'inline'); /* This shows the update button when a filed is selected */

        //                 oTable.fnDeleteRow(47);



        //                 $('#showdata').html(data);

        //                 $('#showdata').animate({'color': 'red'}, "slow");

        //             }

        //             );

        //         }

        //     }

        //     else {

        //         $('#checkbox_error').show(400);

        //         //alert('Please check atleast one entry!');

        //     }

        // });





       

		$("#LinkToListings").load("<?php echo base_url();?>common/linktolistings") // this line updates the div for features

        disable_popup();



    });



//auto complete property details

    $(document).ready(function() {

        $('#listings_ref').autocomplete({

            source: "<?php echo base_url();?>common/autoFindListing",

            minLength: 1,

            select: function(event, ui) {

                $('#listings_id').val(ui.item.id);

                $('#listings_beds').val(ui.item.beds);

                $('#listings_name').val(ui.item.name);

                $('#listings_location').val(ui.item.area_location_id);

                $('#landlord_seller_name').val(ui.item.landlord_name);

                $('#listings_randkey').val(ui.item.rand_key);

            }

        });

    });



//auto complete landlord details





    $(document).ready(function() {

        $('#landlord_name').autocomplete({

            source: "<?php echo base_url();?>common/autoFindLandlord",

            minLength: 1,

            select: function(event, ui) {

                $('#landlord_id').val(ui.item.id);

            }

        });

    });



//auto complete tenant/user details

    $(document).ready(function() {

        $('#leads_name').autocomplete({

            source: "<?php echo base_url();?>common/autoFindLead",

            minLength: 1,

            select: function(event, ui) {

                $('#leads_id').val(ui.item.id);

            }

        });

    });



//auto complete agent details

    $(document).ready(function() {

        $('#agent_name').autocomplete({

            source: "<?php echo base_url();?>common/autoFindAgent",

            minLength: 1,

            select: function(event, ui) {

                $('#agent_id').val(ui.item.id);

            }

        });

    });



    /* Insert / Update function */

    $(document).ready(function() {



        



    });

//end update



    /* Fetch single item details */

    var last_id = '';

    function getSingleRow(id) {



        $('#update, #Save, #cancel').css('display', 'none');

        $('#new').css('display', 'inline');



        $('#myForm input, #myForm img, #myForm select, #myForm textarea').attr('disabled', 'disabled');

        animate_the_form_table_on_click();



        // keep the buttons white (asthetic purposes)

        $('#gen_doc_button').css('color', '#FFF');

        $('#edit_doc_button').css('color', '#FFF');





        $.getJSON("<?php echo base_url();?>deals/single/" + id, function(json) {

            $.each(json, function(key, val) {

                $("#" + key).val(val);

                if (key == "deal_estimated_date" && val == "01-01-1970") {

                    $("#" + key).val('');

                }

                if (key == "renewal_date" && val == "01-01-1970") {

                    $("#" + key).val('');

                }

                

                if( key == 'type' ) {

                	$('#type').change();

                }

            });





            if (json.agent_id !=1448804 && 1 >= 3) {

                $('#edit').css('display', 'none');

            } else {

                $('#edit').css('display', 'inline');

            }





            if (json.area_location_id != 0) {

                $('#region_id').trigger('change');

                $('#area_location_id').val(json.area_location_id);

            }



            if (json.sub_area_location_id != 0) {

                $('#area_location_id').trigger('change');

                $('#sub_area_location_id').val(json.sub_area_location_id);

            }

            $('#area_location_id, #sub_area_location_id').attr('disabled', 'disabled');

            

            if (json.listings_beds !='' && json.listings_beds == 0) {

                if(json.listings_category_id == 3 || json.listings_category_id == 4 

                   || json.listings_category_id == 6 || json.listings_category_id == 7 || json.listings_category_id == 9 

                   || json.listings_category_id == 10 || json.listings_category_id == 11 || json.listings_category_id == 12){

                   $('#listings_beds').val('');

                }else {

                    $('#listings_beds').val('Studio');

                }

            }



            formDataChange = false;



            last_id = json.id;

            /* get stats */

            //get_states(json.id)

            /* get notes */

            plot_notes('deals', '[' + json.notes + ']');



            //Selectes the listings in listings popup

            //selectListings();





            //get the documents of a listing #START

            var documents_count = 0;

            

            $("#showDocuments").html('No documents found for this deal.');



            // popuplate documents section

            if (json.documentsDeals && json.documentsDeals != null) {

                var documents = $.parseJSON(json.documentsDeals);

                if(documents){

                	$("#showDocuments").html('');

                	$.each(documents, function(key, id) {

                    //alert(key +'=' + documents[key].doc_id);

	                    var appendedDocumentCode = '';

	                    appendedDocumentCode += '<table class="documents-table" id="table_' + documents[key].id + '">';

	                    appendedDocumentCode += '<tr><td colspan="2"><a style="text-decoration:none;" href="' + documents[key].filename + '" target="_blank">' + documents[key].doc_title + '</a></td></tr>';

	                    appendedDocumentCode += '<tr><td> ' + documents[key].doc_name + ' </td> <td style="text-align:right; color:grey;">' + documents[key].dateAdd + '</td></tr>';

	                    appendedDocumentCode += '<tr><td colspan="2"><div class="document-buttons">';

	                    if (documents[key].doc_id == 22 && documents[key].edit_url) {

	                        appendedDocumentCode += '<input type="image" onclick="editDocument(' + documents[key].id + ')" disabled="disabled" src="https://crm.propspace.com/application/views/images/edit.png" />';

	                    }

	                    appendedDocumentCode += '<input type="image" disabled="disabled" src="https://crm.propspace.com/application/views/images/delete.png?ts=10" onclick="return deleteThisDocument(' + documents[key].id + ')" /></div></td></tr>';

	

	                    appendedDocumentCode += '</table>';

	

	                    $("#showDocuments").append(appendedDocumentCode);

	

	                    documents_count++;

	                });

                }

            }

            //get the documents of a listing #END



            //notes count

            var notes_count = 0;

            if (json.notes && json.notes != '') {

                var notes = $.parseJSON('[' + json.notes + ']');

                $.each(notes, function(key, id) {

                    notes_count++;

                });

            }

            //notes count



            //add info



            $('#add_info').val(notes_count + ' Notes');

            //	$('#doc_count').val(documents_count);



            $('#notes').val("");





            //add info

            //$("#randomdiv").load("https://crm.propspace.com/index.php/listings/images/"+$('input#rand_key').val()) // this line updates the div for images





            $("#title").text("Deal Reference : " + json.ref);



            $('#showdata').css('color', '#49AC44');

            $('#showdata').html('Record selected')

            $('#showdata').fadeIn("slow");

            setTimeout(function() {

                $('#showdata').fadeOut("slow");

            }, 5000);



        }); //End json 



        formDataChange = false;

            disable_popup();

                

                $('#doc_frame').attr('src', '');

                $('#doc_frame').css('background-image', 'none');

                    

    }



     //End click 



    $(document).ready(function() {



        var id_matching_deal = "";

        var ref = "";



        if (id_matching_deal != 0) {

            getSingleRow(id_matching_deal);

            $('#listings_row tbody #' + $(this).attr('rel')).find("td").addClass("yellowCSS");

        }

//date and time picker

        

    });



    $(document).ready(function(){

        $('#new').click(function(){

			

            $("#created_by_name").val(config.user.username);

			$("#created_by").val(config.user.userid);

            $("#agent_id").val(config.user.userid);

        });

    });



    $(document).ready(function() {

        var this_screen_listing_id ='';

        if (this_screen_listing_id) {

            $.getJSON(mainurl+"deals/single/" + this_screen_listing_id, function(json) {

                $.each(json, function(key, val) {

                    $("#" + key).val(val);

                });

                get_notes2('deals', this_screen_listing_id);





            });

            $('#edit').css('display', 'inline');

        }



    });

</script>

   <script>

            $(document).ready(function() {



                $('#ExportToCSVALL').html('<div style="display:none;" id="downloadCSV_animation"><img src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div><a id="downloadCSV_div" class="popup_a" href="<?php echo base_url();?>/generate/exportCSVdeal?exportCSV=deals"><img src="<?php echo base_url();?>mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>'); // update download button link



                $('#listings_row').change(function() {



                    var value = [];

                    var count = 0;

                    $('#listings_row input:checked').each(function() {

                        value += $(this).attr('value') + ',';

                        count++;

                    });

                    $('#ExportToCSV_deal').html('<a class="popup_a" href="<?php echo base_url();?>/generate/exportCSVdeal?exportCSV=' + value + '"><img src="<?php echo base_url();?>mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>'); // update download button link



                });

            });

        </script>

<div id="wrapper">

            <div class="container">

            

            

            <!-- Page Heading -->

            <div class="row">

                <div class="col-lg-12">

                	<div class="page_head_area"><h1><i class="fa fa-file-text-o"></i> Deals</h1></div>

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

                    <li  class="active"><a href="<?php echo site_url('deals');?>">Deals</a></li>

                    <li><a href="<?php echo site_url('commingsoon');?>">Deals International</a></li>

                    <!-- <li><a href="addendum_template.html">Addendum Template</a></li> -->

                </ul>

            </div>

            

            

            <!-- Tab content -->

            <div class="tab-content ">

            <?php

		 $attributes = array('data-toggle' => 'validator', 'id' => 'myForm', 'role' => 'form');

	    echo form_open_multipart('deals/submit', $attributes);

        ?>

            <div class="row">

            <div class="col-lg-12">

           

            <button type="button" id="new" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>New Deal</button>

			 <button  style="display:none;" type="submit" id="update"  class="btn btn-lg btn-success" name="Update" value="Update Listing">

            <i class="fa fa-plus-circle"></i> Save Deal</button>

             <button  style="display:none;" type="submit" id="Save"  class="btn btn-lg btn-success" name="Save" value="Save Listing">

            <i class="fa fa-plus-circle"></i> Save Deal</button>

       

                <button  style="display:none;" type="button" id="edit" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Deal</button>

            <a href="javascript:void(0)" id="cancel" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>

           

                

            </div>

            </div>

            

            

            <h4 id="title" class="add_new_rental">Add New Deals</h4>

            

               <!--hidden fields-->

                                <input name="id" class="form-control" id="id" style="display:none;" value="0" readonly>

                                <input name="client_id" class="form-control" style="display:none;" id="client_id"  value="<?php echo $client_id;?>" readonly>

                                <input name="rand_key" type="text" style="display:none;" id="rand_key" readonly value="" >

                              

            

            

            <div class="row fadeInUp">

            <div class="col-md-3">

              <div class="form-group">

                <label>Reference</label>

                <input type="text" class="form-control input-sm" id="ref" name="ref" readonly="readonly">

              </div>

              <div class="form-group">

                    <label>Type</label>

                    <select class=" form-control input-sm required" id="type" name="type" required>

                    <option value="" selected>Select</option>

                                            <option value="1">Rental</option>

                                            <option value="2">Sales</option>

                                            <option value="3">Not Specified</option>

                    </select>

              </div>

              <div class="form-group">

                    <label><span id="tenant_buyer_label">Buyer Name</span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><a id='popup-view-multi-landlord' rel='add_view_multi_landlord_popup' class="popup_a" type="1" data-toggle="modal" data-target="#buyer_name"><i class="fa fa-plus-circle"></i></a></span>

                      <input name="tenant_buyer_name" type="text" class="form-control input-sm required" id="tenant_buyer_name" tabindex="2" required>

								<input name="tenant_buyer_id" type="text" class="form_fields ll_id_selector" id="tenant_buyer_id"  style="display: none">

                                <input name="tenant_buyer_id_list" class="form_fields ll_id_list_selector" id="tenant_buyer_id_list" type="text" style="display: none">

              </div>

              </div>

              <div class="form-group">

                    <label><span id="landlord_seller_label">Seller Name</span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><a id='popup-seller-name' rel='add_view_multi_landlord_popup'  class="popup_a" type="2" data-toggle="modal" data-target="#buyer_name"><i class="fa fa-plus-circle"></i></a></span>

                      <input name="landlord_seller_name" type="text" class="form-control input-sm required" id="landlord_seller_name" tabindex="3" required>

									<input name="landlord_seller_id" type="text" class="form-control ll_id_selector" id="landlord_seller_id"  style="display: none">

                                <input name="landlord_seller_id_list" type="text" class="form-control ll_id_list_selector" id="landlord_seller_id_list"  style="display: none">

              </div>

              </div>

              

              <div class="form-group">

                    <label>Status</label>

                    <select class=" form-control input-sm required" id="status" name="status" required>

                   <option value="1">Open</option>

                                            <option value="2">Closed</option>

                                            <option value="3" selected>Not Specified</option>

                    </select>

              </div>

              <div class="form-group">

                    <label>Sub Status</label>

                    <select class=" form-control input-sm " id="sub_status" name="sub_status" required>

                    <option value="0" >Select</option>

                                    <option value="1" >Pending Completion</option>

                                    <option value="5" >Pending Signature</option>

                                    <option value="2" >Successful</option>

                                    <option value="3" >Unsuccessful</option>

                                    <option value="4" selected>Not Specified</option>

                    </select>

              </div>

               <div class="form-group">

                <label>Created By</label>

             <input name="created_by_name" type="text" class="form-control input-sm" readonly id="created_by_name" value="<?php echo $this->session->userdata('username');?>" tabindex="9">

                <input name="created_by" type="hidden" id="created_by" value="<?php echo $this->session->userdata('userid');?>" tabindex="9">

                             <input type="hidden" name="agent_id" id="agent_id"/>

              </div>

                          

              

            </div>

            

            

            <div class="col-md-3">

            

                <div class="form-group">

                    <label>Price</label>

                    <div class="input-group">

                      <input type="text" class="form-control input-sm" id="price" name="price" required>

                      <span class="input-group-addon">AED</span>

                    </div>

                </div>

                

                <div class="form-group">

                    <label>Deposit</label>

                    <div class="input-group">

                      <input type="text" class="form-control input-sm" id="deposit" name="deposit" required>

                      <span class="input-group-addon">AED</span>

                    </div>

                </div>

                

                <div class="form-group">

                    <label>Commision</label>

                    <div class="input-group">

                      <input type="text" class="form-control input-sm" id="commission" name="commission" required>

                      <span class="input-group-addon">AED</span>

                    </div>

                </div>

                  <div class="form-group">

                    <label>Deal Date</label>

                    <div class="input-group date">

                        <input type="text" class="form-control input-sm datepicker" id="deal_date" name="deal_date" required>

                        <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                        </div>

                    </div>

                </div>

                

                <div class="form-group">

                    <label>Deal Est Date</label>

                    <div class="input-group date">

                        <input type="text" class="form-control input-sm datepicker" id="deal_estimated_date" name="deal_estimated_date" required>

                        <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                        </div>

                    </div>

                </div>

                

                

                <div class="form-group">

                    <label>Listing Ref</label>

                    <div class="input-group">

                      <span class="input-group-addon"><a id='popup-listing-ref' href="#?w=500" rel='view_linktolistings_leads_popup' class="popup_a" data-toggle="modal" data-target="#listing_ref_popup"><i class="fa fa-plus-circle"></i></a></span>

                      <input name="listings_ref" type="text" class="form-control input-sm" id="listings_ref"  value="" tabindex="7" required>

                    

                      <span class="input-group-addon"><a title="Preview listing" data-toggle="modal" data-target="#"> <span id="deals_list_preview" listid="">

                      <i class="fa fa-eye"></i></span></a></span>

                      <input name="listings_id" type="hidden" class="form_fields" id="listings_id" value="" hidden>

                                <input name="listings_randkey" type="hidden" class="form_fields" id="listings_randkey" value="" hidden>

                 </div>

                 </div>

                 <div class="form-group">

                     <label>Unit No.</label>

                     <input type="text" class="form-control input-sm" id="listings_unit" name="listings_unit" required>

             	 </div>

            </div>

            

            <div class="col-md-3">

                  <div class="form-group">

                        <label>Agent 1</label>

                        <select class=" form-control input-sm " id="agent_1_id" name="agent_1_id" required>

                       

                        </select>

                  </div>

               <div class="row">

                  <div class="col-md-6">

                     <div class="form-group">

                        <label>Commission</label>

                        <div class="input-group">

                          <input type="text" class="form-control input-sm" id="agent_1_commission_percentage" name="agent_1_commission_percentage" required>

                          <span class="input-group-addon">%</span>

                     </div>

                     </div>

                  </div>

                  <div class="col-md-6">

                  <div class="form-group">

                        <label>&nbsp;</label>

                        <div class="input-group">

                          <input type="text" class="form-control input-sm" id="agent_1_commission" name="agent_1_commission" required>

                          <span class="input-group-addon">AED</span>

                   </div>

                   </div>

                   </div>

              </div>

              <div class="form-group">

                    <label>Agent 2</label>

                    <select class=" form-control input-sm " id="agent_2_id" name="agent_2_id">

                

                    </select>

               </div>

               <div class="row">

                  <div class="col-md-6">

                     <div class="form-group">

                        <label>Commission</label>

                        <div class="input-group">

                          <input type="text" class="form-control input-sm" id="agent_2_commission_percentage" name="agent_2_commission_percentage">

                          <span class="input-group-addon">%</span>

                     </div>

                     </div>

                  </div>

                  <div class="col-md-6">

                  <div class="form-group">

                        <label>&nbsp;</label>

                        <div class="input-group">

                          <input type="text" class="form-control input-sm" id="agent_2_commission" name="agent_2_commission">

                          <span class="input-group-addon">AED</span>

                   </div>

                   </div>

                    </div>

              </div>

             <div class="form-group">

                    <label>Agent 3</label>

                    <select class=" form-control input-sm " id="agent_3_id" name="agent_3_id">

                   

                    </select>

               </div>

               <div class="row">

                  <div class="col-md-6">

                     <div class="form-group">

                        <label>Commission</label>

                        <div class="input-group">

                          <input type="text" class="form-control input-sm" id="agent_3_commission_percentage" name="agent_3_commission_percentage">

                          <span class="input-group-addon">%</span>

                     </div>

                     </div>

                  </div>

                  <div class="col-md-6">

                  <div class="form-group">

                        <label>&nbsp;</label>

                        <div class="input-group">

                          <input type="text" class="form-control input-sm" id="agent_3_commission" name="agent_3_commission">

                          <span class="input-group-addon">AED</span>

                   </div>

                   </div>

                   </div>

              </div>

              <div class="form-group">

                    <label>Additional Info</label>

                    <div class="input-group">

                      <span class="input-group-addon"><a id="popup-additional-info" title="Add additional info" rel="popup4" class="popup_a" data-toggle="modal" data-target="#additional_info_pop"><i class="fa fa-plus-circle"></i></a></span>

                      <input type="text" class="form-control input-sm" id="add_info" name="add_info">

              </div>

              </div>

                

            </div>

            

            

            

            <div class="col-md-3">

            <h5 class="text-primary">Documents </h5>

            <!-- <a href="" data-toggle="modal" data-target="#createdoc_modal" class="btn btn-primary margin-bottom-15"><i class="fa fa-file-text-o"></i> Generate</a> -->

            <a id="popup-upload-documents" href="#" rel="popupDocUpload" data-toggle="modal" data-target="#uploaddoc_modal" class="btn btn-success margin-bottom-15 popup_doc_up"><i class="fa fa-upload"></i> Upload</a>

            <div class="document_area"></div>

            </div>

            </div>

            

            

              <!-- Additional Info Modal -->

            <div class="modal fade" id="additional_info_pop" tabindex="-1">

              <div class="modal-dialog modal-lg">

                <div class="modal-content">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Add New Deal</h4>

                    <p>Complete additional information about the deal here:</p>

                  </div>

                  

                  <div class="modal-body">

                  

                    <div class="row">

                    <div class="col-md-6">

                      <h5 class="text-primary">Notes</h5>

                      <div class="form-group">

                            <label>Notes</label>

                          

                             <input name="notes" cols="20" rows="4" class="form-control input-sm" id="notes" value="">

                      </div>

                      <div class="form-group">

                            <label>Previous Notes</label>

                            

                             <div id="shownotes" class="document_area">No note found for this listing</div>

                      </div>

                     </div>

                     

                     <div class="col-md-6">

                     	<div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Beds</label>

                                <input type="text" class="form-control input-sm" id="listings_beds" name="listings_beds">

                             </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Type</label>

                                <input type="text" class="form-control input-sm" id="listings_unit_type" name="listings_unit_type">

                             </div>

                        </div>

                        </div>

                        <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Street No </label>

                                <input type="text" class="form-control input-sm" id="listings_street_no" name="listings_street_no">

                             </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Floor</label>

                                <input type="text" class="form-control input-sm" id="listings_floor_no" name="listings_floor_no">

                             </div>

                        </div>

                        </div>

                        <div class="form-group">

                        <label> Tenancy Renewal Date</label>

                        <div class="input-group">

                          <input type="text" class="form-control input-sm datepicker" id="renewal_date" name="renewal_date">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        </div>

                     	</div>

                        <div class="form-group">

                                <label>Set Reminder </label>

                            

                                <select name="remind_before" class=" form-control input-sm" id="remind_before" tabindex="22">

	                                            <option value="0">Never</option>

	                                            <option value="1">1 Day Before</option>

	                                            <option value="7">1 Week Before</option>

	                                            <option value="30">1 Month Before</option>

	                                            <option value="60">2 Months Before</option>

	                                            <option value="90">3 Months Before</option>

                                                    <option value="120">4 Months Before</option>

	                                            <option value="180">6 Months Before</option>

                                        </select>

                         </div>

                         <div class="form-group">

                                <label>Category </label>

                               <select name="listings_category_id" class=" form-control input-sm" id="listings_category_id">

                                            <option value="" selected>Select</option>

                                                                                            <option value="1">

    											Apartment                                                </option>

											                                                <option value="2">

    											Villa                                                </option>

											                                                <option value="3">

    											Office                                                </option>

											                                                <option value="4">

    											Retail                                                </option>

											                                                <option value="5">

    											Hotel Apartment                                                </option>

											                                                <option value="6">

    											Warehouse                                                </option>

											                                                <option value="7">

    											Land Commercial                                                </option>

											                                                <option value="8">

    											Labour Camp                                                </option>

											                                                <option value="9">

    											Residential Building                                                </option>

											                                                <option value="10">

    											Multiple Sale Units                                                </option>

											                                                <option value="11">

    											Land Residential                                                </option>

											                                                <option value="12">

    											Commercial Full Building                                                </option>

											                                                <option value="13">

    											Penthouse                                                </option>

											                                                <option value="14">

    											Duplex                                                </option>

											                                                <option value="15">

    											Loft Apartment                                                </option>

											                                                <option value="16">

    											Townhouse                                                </option>

											                                                <option value="17">

    											Hotel                                                </option>

											                                                <option value="18">

    											Land Mixed Use                                                </option>

											                                                <option value="21">

    											Compound                                                </option>

											                                                <option value="24">

    											Half Floor                                                </option>

											                                                <option value="27">

    											Full Floor                                                </option>

											                                                <option value="30">

    											Commercial Villa                                                </option>

											                                                <option value="48">

    											Bungalow                                                </option>

											                                                <option value="50">

    											Factory                                                </option>

											                                        </select>

                         </div>

                         <div class="form-group">

                                <label>Emirate</label>

                                <!--<div class="dropdown">

                                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>

                                    <ul class="dropdown-menu emirate_search">

                                    <h5 class="text-primary">Search Location</h5>

                                    <input type="text" class="form-control input-sm" id="">

                                    </ul>

                                </div>-->

                               

                              <select name="region_id" class="form-control input-sm" id="region_id" tabindex="14">

	                                            <option value="" selected>Select</option>

	                                            	                                                <option value="2">

	    												Abu Dhabi	                                                </option>

													                                                <option value="4">

	    												Ajman	                                                </option>

													                                                <option value="8">

	    												Al Ain	                                                </option>

													                                                <option value="1">

	    												Dubai	                                                </option>

													                                                <option value="7">

	    												Fujairah	                                                </option>

													                                                <option value="6">

	    												Ras Al Khaimah	                                                </option>

													                                                <option value="3">

	    												Sharjah	                                                </option>

													                                                <option value="5">

	    												Umm Al Quwain	                                                </option>

												                                        </select>

                         </div>

                         <div class="form-group">

                                <label>Location </label>

                             

                               <select name="area_location_id" class=" form-control input-sm" id="area_location_id" tabindex="15">

	                                            <option value="" selected>Select</option>

                                        </select>

                         </div>

                         <div class="form-group">

                                <label>Sub Location</label>

                               <select name="sub_area_location_id" class=" form-control input-sm" id="sub_area_location_id" tabindex="16">

	                                            <option value="" selected>Select</option>

                                        </select>

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

            

            

           <?php echo  form_close();?>

            



            <!-- Deals Form End -->

            </div>

            </div>

            </div>

            

            

            

            <div class="tab-content fadeInUp">

            <div class="row">

            <div class="col-md-8">

            <ul class="list-inline listing_action_nav">

            <li class="dropdown">

            <a href="javascript:void(0);" id="share_options" class="dropdown-toggle click" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-share-alt"></i> Share Options</a><span class="caret"></span>

              <ul class="dropdown-menu">

               <li id="datashare_options_default" keyAccess="true"><a href="#" data-target="#share_excel_all" data-toggle="modal" class="popup_a"><i class="fa fa-file-excel-o"></i> Download all listing(s) as Excel table</a>

                <input type="hidden" id="access" value="true">

                </li>

                <li><a href="javascript:void(0);" id="sms_verification_popup_selected" rel="sms_verification_selected" class="popup_a" data-target="#sms_verification_selected_popup" data-toggle="modal"><i class="fa fa-file-excel-o"></i>Download selected listing(s) as Excel table</a></li>

              </ul>

            </li>

            

            <li><a href="" data-toggle="modal" data-target="#advanced_search"><i class="fa fa-search"></i> Advanced Search</a></li>

            

            </ul>

            </div>

            <div class="col-md-4">

	            <ul class="list-inline pull-right">

                <li class="dropdown"> 

               <!--  <a href="" class="dropdown-toggle btn btn-success" data-toggle="dropdown">Action <i class="fa fa-chevron-down"></i></a> -->

                  <ul class="dropdown-menu">

                    <li><a href="#" data-toggle="modal" data-target="#add_todo">Add To-Do</a></li>

                    <li><a href="#" data-toggle="modal" data-target="#add_event">Add Events</a></li>

                    <li><a href="#" data-toggle="modal" data-target="#add_leads">Add Leads</a></li>

                    <li><a href="#" data-toggle="modal" data-target="#add_contracts">Add Contracts</a></li>

                    <li><a href="#" data-toggle="modal" data-target="#add_deals">Add Deals</a></li>

                    <li class="divider"></li>

                    <li><a href="#" data-toggle="modal" data-target="#copy_listing">Copy Listing</a></li>

                    <li class="divider"></li>

                    <li><a href="#" data-toggle="modal" data-target="#">Archive</a></li>

                </ul>

                </li>

            

                <li class="dropdown"> 

               <!--  <a href="" class="dropdown-toggle btn btn-success" data-toggle="dropdown">Views <i class="fa fa-chevron-down"></i></a> -->

                  <ul class="dropdown-menu">

                    <li><a href="#" data-toggle="modal" data-target="#view_todo">To-Do <span class="badge">0</span></a></li>

                    <li><a href="#" data-toggle="modal" data-target="#view_event">Events <span class="badge">0</span></a></li>

                    <li><a href="#" data-toggle="modal" data-target="#view_leads">Leads <span class="badge">0</span></a></li>

                    <li><a href="#" data-toggle="modal" data-target="#view_contract">Contracts <span class="badge">0</span></a></li>

                    <li><a href="#" data-toggle="modal" data-target="#view_deals">Deals <span class="badge">0</span></a></li>

                    <li><a href="#" data-toggle="modal" data-target="#view_owner">Owner <span class="badge">1</span></a></li>

                </ul>

                </li>

                <li> <a href="" class="btn btn-success" data-toggle="modal" data-target="#columns">Columns <i class="fa fa-chevron-down"></i></a></li>

              </ul>

            </div>

            </div>



            <!-- data table come here -->

              <table class="table table-striped table-hover datatables datatable-setbotclass dataTable no-footer" aria-describedby="dataTables-current-listing_info" id="listings_row">

                  <thead>

                <tr>

                    <th>

                    <label class="">

                        <input onClick="toggleChecked(this.checked)" id='check_all_checkboxes' value='' type="checkbox"/>

                        <span class="lbl"></span>

                    </label>

                    </th>

                <th width="80">Reference</th>

                <th>Type</th>

                <th>Status</th>

                <th width="100">Sub Status</th>

                <th>Buyer/Tenant</th>

                <th>Seller/Landlord</th>

                <th>Emirate</th>

                <th>Location</th>

                <th>Sub-Location</th>

                <th>Price</th>

                <th type="not_default">Cheques</th>

                <th type="not_default">Deposit</th>

                <th type="not_default">Deal Date</th>

                <th type="not_default">Deal Est Date</th>

                <th type="not_default">Renewal Date</th>

                <th>Agent 1</th>

                <th type="not_default">Agent 1 Commission</th>

                <th type="not_default">Agent 2</th>

                <th type="not_default">Agent 2 Commission</th>

                <th type="not_default">Agent 3</th>

                <th type="not_default">Agent 3 Commission</th>

                <th type="not_default">Listing Ref</th>

                <th type="not_default">Beds</th>

                <th type="not_default">Street No</th>

                <th type="not_default">Floor No</th>

                <th type="not_default">Category</th>

                <th type="not_default">Created By</th>

                <th type="not_default">Listing Unit</th>

                <th type="not_default">Commission</th>

                <th width="50" >Updated</th>

                </thead>

                <thead id="searchbox">

                <tr  class="search_box">

                   

                     <form id="myForm2">

                    <td style="text-align:center;"><a style="display:none;" id="reset_filter" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png?ts=10" title="Reset filter"></a></td>

                    <td><input id='1' type="text" class="search_init form-control input-sm" /></td>

                    <td><select id='2' type="text" class="search_init form-control input-sm">

                            <option value="" selected>Select</option>

                            <option value="1">Rental</option>

                            <option value="2">Sales</option>

                            <option value="3">Not Specified</option>

                        </select></td>

                    <td><select id='3' type="text" class="search_init form-control input-sm">

                            <option value="" selected>Select</option>

                            <option value="1">Open</option>

                            <option value="2">Closed</option>

                            <option value="3">Not Specified</option>

                        </select></td>

                    <td><select id='4' type="text" class="search_init form-control input-sm">

                            <option value="" selected>Select</option>

                            <option value="1" >Pending Completion</option>

                            <option value="5" >Pending Signature</option>

                            <option value="2" >Successful</option>

                            <option value="3" >Unsuccessful</option>

                            <option value="4" >Not Specified</option>

                        </select></td>

                    <td><input id='5' type="text" class="search_init form-control input-sm" /></td>

                    <td><input id='6' type="text" class="search_init form-control input-sm" /></td>

                    <td><select id='7' class="search_init form-control input-sm search_region_id 8" style="width:100px;">

                            <option value="" selected>Select</option>

                                                            <option value="2">

    Abu Dhabi                                </option>

                                                            <option value="4">

    Ajman                                </option>

                                                            <option value="8">

    Al Ain                                </option>

                                                            <option value="1">

    Dubai                                </option>

                                                            <option value="7">

    Fujairah                                </option>

                                                            <option value="6">

    Ras Al Khaimah                                </option>

                                                            <option value="3">

    Sharjah                                </option>

                                                            <option value="5">

    Umm Al Quwain                                </option>

                                                    </select></td>

                    <td id="SchainLoc">

                    <input id='8' type="text" class="search_init form-control input-sm" />

                    </td>

                    <td id="SchainSubLoc">

                    <input id='9' type="text" class="search_init form-control input-sm" />

                    </td>

                    <td><input id='10' type="text" class="search_init form-control input-sm" /></td>

                    <td><input id='11' type="text" class="search_init form-control input-sm" /></td>

                    <td><input id='12' type="text" class="search_init form-control input-sm" /></td>

                 

                    

                    <td><a id="_date_deal" class='click'><img src="https://crm.propspace.com/application/views/images/arrow.png?ts=10"></a>

                    <div class='data box_filtr' id="data_date_deal"> 

                        <b>Deal Date </b> From :

                        <input id='deal_dateS' name='deal_dateS' type="text" class="search_init_date"  style="width:95px !important;" readonly />

                        To :

                        <input id='deal_dateSto' name='deal_dateSto' type="text" class="search_init_date"  style="width:95px !important;" readonly />

                        <img src="https://crm.propspace.com/application/views/images/up.png?ts=10" style="cursor:pointer;" title="Close"> </div></td>

                        

                        

                    <td><input id='deal_est_dateS' type="text" class="search_init form-control input-sm" /></td>

                    <td><input id='renewal_dateS' type="text" class="search_init form-control input-sm" /></td>

                    <td><select id='16' type="text" class="search_init form-control input-sm">

                            <option value="" selected>Select</option>

                                                            

                        </select></td>

                    <td><input id='17' type="text" class="search_init form-control input-sm" /></td>

                    <td><select id='18' type="text" class="search_init form-control input-sm">

                            <option value="" selected>Select</option>

                                                         

                        </select></td>

                    <td><input id='19' type="text" class="search_init form-control input-sm" /></td>

                    <td><select id='20' type="text" class="search_init form-control input-sm">

                            <option value="" selected>Select</option>

                                                            

                        </select></td>

                    <td><input id='21' type="text" class="search_init form-control input-sm" /></td>

                    <td><input id='22' type="text" class="search_init form-control input-sm" /></td>

                    <td><input id='23' type="text" class="search_init form-control input-sm" /></td>

                    <td><input id='24' type="text" class="search_init form-control input-sm" /></td>

                    <td><input id='25' type="text" class="search_init form-control input-sm" /></td>

                    <td><select id='26' type="text" class="search_init form-control input-sm" style="width:100px;">

                            <option value="" selected>Select</option>

                                                            <option value="1">

    Apartment                                </option>

                                                            <option value="2">

    Villa                                </option>

                                                            <option value="3">

    Office                                </option>

                                                            <option value="4">

    Retail                                </option>

                                                            <option value="5">

    Hotel Apartment                                </option>

                                                            <option value="6">

    Warehouse                                </option>

                                                            <option value="7">

    Land Commercial                                </option>

                                                            <option value="8">

    Labour Camp                                </option>

                                                            <option value="9">

    Residential Building                                </option>

                                                            <option value="10">

    Multiple Sale Units                                </option>

                                                            <option value="11">

    Land Residential                                </option>

                                                            <option value="12">

    Commercial Full Building                                </option>

                                                            <option value="13">

    Penthouse                                </option>

                                                            <option value="14">

    Duplex                                </option>

                                                            <option value="15">

    Loft Apartment                                </option>

                                                            <option value="16">

    Townhouse                                </option>

                                                            <option value="17">

    Hotel                                </option>

                                                            <option value="18">

    Land Mixed Use                                </option>

                                                            <option value="21">

    Compound                                </option>

                                                            <option value="24">

    Half Floor                                </option>

                                                            <option value="27">

    Full Floor                                </option>

                                                            <option value="30">

    Commercial Villa                                </option>

                                                            <option value="48">

    Bungalow                                </option>

                                                            <option value="50">

    Factory                                </option>

                                                    </select></td>

                    <td><select id='27' type="text" class="search_init">

                            <option value="" selected>Select</option>

                                                         

                        </select></td>

                    <td><input id='28' type="text" class="search_init" /></td>

                     <td><input id='29' type="text" class="search_init" /></td>

                   <td class="dropdown">

                    

                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-arrow-down"></i></a>

                   	    <div class="dropdown-menu emirate_search">

                        <div class="form-group">

                        <label>Listed From</label>

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

            <!-- container end -->            

            </div>

            

            	<!-- wrapper end -->

                

                

             <!-- Advanced Search Modal -->

            <div class="modal fade" id="advanced_search" tabindex="-1" >

              <div class="modal-dialog" id="dataadvancesearch_options">

              <form id="as_search_form">

                <div class="modal-content ">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Advanced Search</h4>

                  </div>

                  

                  <div class="modal-body" >

                  <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      	<label>Listing Ref</label>

                        <input type="text" class="advance_search form-control input-sm" id="as_listings_ref" name="as_listings_ref">

                    </div>

                    <div class="form-group">

                        <label>Bedrooms</label>

                        <select class="advance_search form-control input-sm " id="as_beds" name="as_beds">

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

                      	<label>Unit</label>

                        <input type="text" class="advance_search form-control input-sm" id="as_unit" name="as_unit">

                    </div>

                     <div class="form-group">

                      	<label>Street No</label>

                        <input type="text" class="advance_search form-control input-sm" id="as_street_no" name="as_street_no">

                    </div>

                    



                  </div>

                  

                  <div class="col-md-6">

                    <div class="form-group">

                        <label>Created By</label>

                        <select class=" form-control input-sm advance_search" id="as_created_by_name" name="as_created_by_name">

                        

                        </select>

                    </div>

                    <div class="form-group">

                      	<label>Unit Type</label>

                        <input type="text" class="advance_search form-control input-sm" id="as_unit_type" name="as_unit_type">

                    </div>

                    <div class="form-group">

                      	<label>Floor No</label>

                        <input type="text" class="advance_search form-control input-sm" id="as_floor_no" name="as_floor_no">

                    </div>

                    

                    <div class="form-group">

                        <label>Deal Date</label>

                        <div class="input-group input-daterange" id="datepicker">

                          <input type="text" class="advance_search form-control input-sm" id="as_deal_date" name="as_deal_date">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        </div>

                     </div>

                    

                    

                    

                  </div>

                  </div>

                        

                  </div>

                  

                  <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>

                  </div>

                </div>

                </form>

              </div>

            </div>

            

            

           <!-- Listing Ref Modal -->

           <div class="modal fade" id="listing_ref_popup" tabindex="-1">

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                  <div id="view_linktolistings_leads_popup" class="popup_block" >

    					<div id="LinkToListings">Data Table</div>

					</div>

                  

                  <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>

                  </div>

                </div>

              </div>

            </div> 

            

        

            

            

            <!-- Buyer Name Modal -->

            <div class="modal fade" id="buyer_name" tabindex="-1">

              <div class="modal-dialog modal-lg">

                <div class="modal-content ">

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Contacts</h4>

                  </div>

                  

                  <div class="modal-body">

                  

                 

                   <div id="add_view_multi_landlord_window">Please select a record</div>   

                    

                  </div>

                  

                  <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>

                  </div>

                </div>

              </div>

            </div>

            

             <!--Manage Columns Modal -->

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

                    <button type="button" id="save_columns_settings" class="save_button btn btn-success"><i class="fa fa-save"></i> Save</button>

                    <button type="button" id="reset_columns_settings" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button>

                    <button type="button" id="btn-close-managecolumns" class="cancel_button btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>

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

    					 <div align="center" id="ExportToCSV_deal">Please select record(s)</div>

						</div>

                    

                  </div>

                  

                  <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>

                  </div>

                </div>

              </div>

            </div>

            

            

               <!-- Upload Document Modal -->

            <div class="modal fade" id="uploaddoc_modal" tabindex="-1" >

              <div class="modal-dialog">

                <div class="modal-content ">

                

                  <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Deals Document Upload</h4>

                    <p>You can upload your documents related to your deals here!</p>

                  </div>

                  

                  <div class="modal-body">

                    <div class="form-group">

                        <label>Document Type</label>

                       

                       <select id='docs_select_rent' name='document_up_type'  class='form-control input-sm' style='display:none;'>

                       	<option value=''>Please select</option>

                       	<option value='Invoice'>Invoice</option>

                       	<option value='Receipt'>Receipt</option>

                       	<option value='Tenancy Contract'>Tenancy Contract</option>

                       	<option value='Passport Copy'>Passport Copy</option>

                       	<option value='Title Deed'>Title Deed</option>

                       	<option value='MOU'>MOU</option> 

                       	<option value='Other'>Other</option>  

                       	</select><select id='docs_select_sale' name='document_up_type' class='form-control input-sm' style='display:none;'>

                       		<option value=''>Please select</option>

                       		<option value='Invoice'>Invoice</option>

                       		<option value='Receipt'>Receipt</option>

                       		<option value='Passport Copy'>Passport Copy</option>

                       		<option value='Title Deed'>Title Deed</option>

                       		<option value='MOU'>MOU</option>

                       		 <option value='Other'>Other</option> 

                       		  </select>

                    </div>

                    <div class="form-group">

                        <label>Signed</label>

                       <select id='doc_signed' name='doc_signed'  class='form-control input-sm'>

                                    <option value=''>Please select</option>

                                    <option value='Un-signed'>Un-signed</option>

                                    <option value='Incomplete signatories'>Incomplete signatories</option>

                                    <option value='Signed by all'>Signed by all</option>

                                </select>

                    </div>

                    <div class="form-group">

                        <label>Document Name (optional)</label>

                        <input name="document_name" type="text" class="form-control input-sm" id="document_name" />

                    </div>

                    <div class="form-group">

                        <label>File</label>

                        <input type="file" class="" id="deals_documents" name="deals_documents">

                    </div>
                    <div class="form-group">

                         <div class="row  col-md-12 col-xs-12">
                        <div class="documents-div-box" id="showDocuments"><!-- No documents found for this listing --></div>
                    </div>

                    </div>

                  </div>



                  <div class="modal-footer">

                  	 <div class="pull-right" id="documents_upload_progress">

                                	<img id='doc_uploading' src='<?php echo base_url();?>mydata/images/ajax-loader.gif' height='30px' style='display:none;' />

                                	<img id='doc_uploaded' src='<?php echo base_url();?>mydata/images/blue-tick.png' height='30px' style='display:none;' />

                                </div>

                    <button  class="btn btn-success" type="button" id="buttonUpload" onClick="return ajaxFileUpload();"><i class="fa fa-cloud-upload"></i> Upload</button>

                  </div>

                </div>

              </div>

            </div>

            

            

     <script type="text/javascript" src="<?php echo site_url();?>js_module/common.js?ts=11234"></script> 

      <script type="text/javascript" src="<?php echo base_url();?>/js_module/ajaxfileupload.js"></script>

<script type="text/javascript" src="<?php echo site_url();?>js_module/deals.js?ts=11234"></script>          