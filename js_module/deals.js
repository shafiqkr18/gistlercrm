var screenname = 'deals';

$(document).ready(function() {

       

	//Document Ready Starts

	$(document.body).on("click", 'a.popup_doc_up[href^=#]', function() {

		

			if(formEnabled == false){

				//return false;

			}

            var dealRef = $('#ref').val();

            var typeSet = $('#type').val();



            if (!dealRef || dealRef == '') {

                alert('Please save the deal first in order to upload a document.');

                return false;

                exit();

            }



            if (typeSet == 1) {

                $('#docs_select_sale').css('display', 'none');

                $('#docs_select_rent').css('display', '');

            }

            else if (typeSet == 2) {

                $('#docs_select_rent').css('display', 'none');

                $('#docs_select_sale').css('display', '');

            }

            else {

                alert('Please select a value for deal "Type" field first in order to upload a document.');

                return false;

            }



            $('#document_name,#docs_select_rent,#docs_select_sale,#doc_signed, #deals_documents').val('');

            $('#doc_uploading,#doc_uploaded').css('display', 'none');



            var extraHeight = 0;

            var popID = $(this).attr('rel'); //Get Popup Name

            var popURL = $(this).attr('href'); //Get Popup href to define size	

            var myWidth = $(this).attr('width');



            //Pull Query & Variables from href URL

            //shafiq commented and add one line at end

            // var query = popURL.split('?');

            // var dim = query[1].split('&');

            // var popWidth = dim[0].split('=')[1]; //Gets the first query string value

            // if (myWidth != undefined) {

                // popWidth = myWidth;

            // }



popWidth = myWidth;//shafiq





            $('#' + popID).css('vertical-align', 'middle');



            //Fade in the Popup and add close button

            $('#' + popID).fadeIn().css({'width': Number(popWidth), 'min-height': extraHeight}).prepend('<a href="#" class="close"> x </a>');

            //Define margin for center alignment (vertical + horizontal) - we add 80 to the height/width to accomodate for the padding + border width defined in the css



            var popMargTop = ($('#' + popID).height() + 80) / 2;

            var popMargLeft = ($('#' + popID).width() + 80) / 2;



            //Apply Margin to Popup



            $('#' + popID).css({

                'margin-top': -popMargTop,

                'margin-left': -popMargLeft

            });



            //Close Popups and Fade Layer

            $(document.body).on('click', 'a.close, #fade, #closeandsave, .closeandsave', function() { //When clicking on the close or fade layer...\

                $('#fade , .popup_block').fadeOut(function() {

                    $('#fade, a.close').remove();

                }); //fade them both out

                return false;

            });





        });

        

        $(document.body).on("click", 'a.popup_doc[href^=#]', function() {

			if(formEnabled == false){

				return false;

			}

            

            var dealRef = $('#ref').val();

            var typeSet = $('#type').val();



            if (!dealRef || dealRef == '') {

                alert('Please save the deal first to enable documents generation.');

                exit();

            }



            if (typeSet == 1) {

                $('#docs_list_sale').css('display', 'none');

                $('#docs_list_rent').css('display', '');

            }

            else if (typeSet == 2) {

                $('#docs_list_rent').css('display', 'none');

                $('#docs_list_sale').css('display', '');

            }

            else {

                alert('Please select a value for deal "Type" field first to view the available documents.');

                return false;

            }



            $("#field_list_table").html('');

            $('#tab_1').trigger('click');



            var extraHeight = 0;

            var popID = $(this).attr('rel'); //Get Popup Name

            var popURL = $(this).attr('href'); //Get Popup href to define size	

            var myWidth = $(this).attr('width');



            //Pull Query & Variables from href URL

            var query = popURL.split('?');

            var dim = query[1].split('&');

            var popWidth = dim[0].split('=')[1]; //Gets the first query string value

            if (myWidth != undefined) {

                popWidth = myWidth;

            }



            $('#' + popID).css('vertical-align', 'middle');



            //Fade in the Popup and add close button

            $('#' + popID).fadeIn().css({'width': Number(popWidth)+100, 'min-height': extraHeight}).prepend('<a href="#" class="close"> x </a>');

            //Define margin for center alignment (vertical + horizontal) - we add 80 to the height/width to accomodate for the padding + border width defined in the css



            var popMargTop = ($('#' + popID).height() + 80) / 2;

            var popMargLeft = ($('#' + popID).width() + 80) / 2;



            //Apply Margin to Popup



            $('#' + popID).css({

                'margin-top': -popMargTop,

                'margin-left': -popMargLeft

            });



            //Close Popups and Fade Layer

            $(document.body).on('click', 'a.close, #fade, #closeandsave, .closeandsave', function() { //When clicking on the close or fade layer...\

                $('#fade , .popup_block').fadeOut(function() {

                    $('#fade, a.close').remove();

                }); //fade them both out

                return false;

            });



        });

        

        //functions for deals international

        

        jQuery('#country').change(function() {

            var value = jQuery(this).val();

            var element = $("option:selected", this);

            var currency = element.attr("rel");

            jQuery('#price_curr, #deposit_curr, #comission_curr').val(currency);

            jQuery('.CurVal').text(currency);

            

//          trigger the add info

            jQuery('#country_info').val(value);

            jQuery('#country_info').trigger('change');

            

            

        });

        jQuery('#price_curr').change(function() {

            var value = jQuery(this).val();

            jQuery('#deposit_curr, #comission_curr').val(value);

            jQuery('.CurVal').text(value);

        });

        

                /* country flag */

           jQuery('#country_info').change(function(){

            var value = jQuery(this).val()  ;



            var snum_dropdowncity ='';

            snum_dropdowncity += '<option value="" selected="selected">Select</option>';

            $.each(city_array[value], function(key, val) {

                snum_dropdowncity += '<option value="'+ key*1 +'" >'+ val +'</option>';	

            });	 

            

            jQuery('#city').html(snum_dropdowncity);

            jQuery('#city,#location_inter,#sub_location_inter').attr('disabled', false);         



        }); 

        

        //END Functions for deal international

        

        jQuery('#region_id').change(function() {

            ;

            var value = jQuery(this).val();



            var snum_dropdown = '';

            snum_dropdown += '<option value="" selected="selected">Select</option>';

            $.each(location_json_array[value], function(key, val) {

                snum_dropdown += '<option value="' + key + '" >' + val + '</option>';

            });



            jQuery('#area_location_id').html(snum_dropdown);

            jQuery('#sub_area_location_id').val('');

            jQuery('#area_location_id').attr('disabled', false);

        });

        



        jQuery('#area_location_id').change(function() {

            ;

            var value = jQuery(this).val();



            var snum_dropdown = '';

            snum_dropdown += '<option value="" selected="selected">Select</option>';

            $.each(sub_location_json_array[value], function(key, val) {

                snum_dropdown += '<option value="' + key + '" >' + val + '</option>';

            });



            jQuery('#sub_area_location_id').html(snum_dropdown);

            jQuery('#sub_area_location_id').attr('disabled', false);

        });

        

        $(document.body).on('change', "#myForm", function(event)

		{

        	formDataChange = true;

    	});



	    window.onbeforeunload = function() {

	        if (formDataChange) {

	            return 'Data not saved!';

	        }

	    }

	    

	    $("#notes").keypress(function(evt) {

            var keycode = evt.charCode || evt.keyCode;

            //alert(keycode);

            if (keycode == 34 || keycode == 39 || keycode == 47 || keycode == 92 || keycode == 13) { //Enter key's keycode

                return false;

            }

        });

        

        $(document.body).on("click", "#add_contact", function(event) {

                    var type = $(this).attr('type');

                    $.post(mainurl + "popup/add_landlord_popup/" + type, {

                        id: $('#id').val()

                    },

                    function(data) {

                        $("#link_landlord_window").html(data);

                    });

                });

                

        $('#deals_list_preview').click(function() {

            var ref = $('#listings_ref').val();

            if (!ref) {

                alert('Please select a listing first in the "Listing Ref" field above in order to preview the listing.');

                return false;

            }

            var rand_key = $('#listings_randkey').val();

            var listing_id = $('#listings_id').val();

            if (rand_key) {

                window.open(mainurl + 'preview/index/' + rand_key + '/' + client_id +'/?l_id='+listing_id);

            }

            else {

                $.getJSON(mainurl + "deals/randkey_lookup/" + ref + "/" +client_id, function(json) {

                    var rand_key = json.rand_key;

                    $.each(json, function(key, id) {

                        console.log(id);

                        if(id != ''){

                              window.open(mainurl + 'preview/index/' + rand_key + '/' +client_id +'/?l_id='+listing_id);

                        }else{

                             alert('This listing cannot be found. Please check that listing ref entered is correct.');

                        }

                    });

                    

                });

            }

        });

        

        //1 agent

        $("#agent_1_commission_percentage").keyup(function() {



            var price = $('#commission').val();

            var percentage = $(this).val();

            if (price > 0 & percentage > 0) {

                var commission = (price * percentage) / 100;

                if (isNaN(commission)) {

                    commission = 0;

                }

                $('#agent_1_commission').val(commission.toFixed(0));

            }

        });



        $("#agent_1_commission").keyup(function() {

            var price = $('#commission').val();

            var commission = $(this).val();

            if (price > 0 & commission > 0) {

                var percentage = (commission / price) * 100;

                if (isNaN(percentage) || percentage == 'Infinity') {

                    percentage = 0;

                }

                $('#agent_1_commission_percentage').val(percentage.toFixed(2));

            }

        });



        $("#commission").keyup(function() {

            var price = $('#commission').val();

            var percentage = $('#agent_1_commission_percentage').val();

            if (price > 0 & percentage > 0) {

                var commission = (price * percentage) / 100;

                if (isNaN(commission)) {

                    commission = 0;

                }

                $('#agent_1_commission').val(commission.toFixed(0));

            }



            var price = $('#commission').val();

            var commission = $('#agent_1_commission').val();

            if (price > 0 & commission > 0) {

                var percentage = (commission / price) * 100;

                if (isNaN(percentage) || percentage == 'Infinity') {

                    percentage = 0;

                }

                $('#agent_1_commission_percentage').val(percentage.toFixed(2));



            }

        });



//2 agent

        $("#agent_2_commission_percentage").keyup(function() {



            var price = $('#commission').val();

            var percentage = $(this).val();

            if (price > 0 & percentage > 0) {

                var commission = (price * percentage) / 100;

                if (isNaN(commission)) {

                    commission = 0;

                }

                $('#agent_2_commission').val(commission.toFixed(0));

            }

        });



        $("#agent_2_commission").keyup(function() {

            var price = $('#commission').val();

            var commission = $(this).val();

            if (price > 0 & commission > 0) {

                var percentage = (commission / price) * 100;

                if (isNaN(percentage) || percentage == 'Infinity') {

                    percentage = 0;

                }

                $('#agent_2_commission_percentage').val(percentage.toFixed(2));

            }

        });



        $("#commission").keyup(function() {

            var price = $('#commission').val();

            var percentage = $('#agent_2_commission_percentage').val();

            if (price > 0 & percentage > 0) {

                var commission = (price * percentage) / 100;

                if (isNaN(commission)) {

                    commission = 0;

                }

                $('#agent_2_commission').val(commission.toFixed(0));

            }



            var price = $('#commission').val();

            var commission = $('#agent_2_commission').val();

            if (price > 0 & commission > 0) {

                var percentage = (commission / price) * 100;

                if (isNaN(percentage) || percentage == 'Infinity') {

                    percentage = 0;

                }

                $('#agent_2_commission_percentage').val(percentage.toFixed(2));



            }

        });



//3 agent

        $("#agent_3_commission_percentage").keyup(function() {



            var price = $('#commission').val();

            var percentage = $(this).val();

            if (price > 0 & percentage > 0) {

                var commission = (price * percentage) / 100;

                if (isNaN(commission)) {

                    commission = 0;

                }

                $('#agent_3_commission').val(commission.toFixed(0));

            }

        });



        $("#agent_3_commission").keyup(function() {

            var price = $('#commission').val();

            var commission = $(this).val();

            if (price > 0 & commission > 0) {

                var percentage = (commission / price) * 100;

                if (isNaN(percentage) || percentage == 'Infinity') {

                    percentage = 0;

                }

                $('#agent_3_commission_percentage').val(percentage.toFixed(2));

            }

        });



        $("#commission").keyup(function() {

            var price = $('#commission').val();

            var percentage = $('#agent_3_commission_percentage').val();

            if (price > 0 & percentage > 0) {

                var commission = (price * percentage) / 100;

                if (isNaN(commission)) {

                    commission = 0;

                }

                $('#agent_3_commission').val(commission.toFixed(0));

            }



            var price = $('#commission').val();

            var commission = $('#agent_3_commission').val();

            if (price > 0 & commission > 0) {

                var percentage = (commission / price) * 100;

                if (isNaN(percentage) || percentage == 'Infinity') {

                    percentage = 0;

                }

                $('#agent_3_commission_percentage').val(percentage.toFixed(2));



            }

        });

        

        $("input, #groups_deals").tooltip();

        $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');





        // keep the button text white for asthetic purposes

        $('#gen_doc_button').css('color', '#FFF');

        $('#edit_doc_button').css('color', '#FFF');





        formDataChange = false;

        $("#price , #deposit, #commission, #doc_price, #doc_land_price, #doc_dev_price, #doc_other_price").numeric();





        $("#price").keyup(function() {

            $('#frequency').attr('required', 'required');

        });





        var open_status = '<option value="0" selected="selected">Select</option><option value="1" >Pending Completion</option><option value="5" >Pending Signature</option><option value="4" >Not Specified</option>';

        var close_status = '<option value="0" selected="selected">Select</option><option value="2" >Successful</option><option value="3" >Unsuccessful</option><option value="4" >Not Specified</option>';



        // status

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



        });



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



        });

        

        $('#columns_list input').change(function() {

            fnShowHide($(this).attr('col'));

            $('#total_active_columns').html($('#columns_list input:checked').length);

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





       // $('#dateupdatedS, #deal_dateS, #deal_est_dateS, #renewal_dateS').datepicker({

//            dateFormat: 'yy-mm-dd',

//            onClose: function(dateText, inst) {

//                oTable.fnDraw(false);

//                $('#reset_filter').css('display', '');

//            }

//        });



//change css of selected row	

        $(document.body).on("click", "#listings_row tbody tr", function(event) {

            if (formDataChange == false) {

                $("td.yellowCSS", oTable.fnGetNodes()).removeClass('yellowCSS');

                $(event.target).parent().find("td").addClass('yellowCSS');

            }

        });





// check box delete



        $(document.body).on("click", '.dbstatus', function() {



            if ($('#listings_row input').is(':checked')) {



                if (confirm("Are you sure you want to " + $(this).attr('id') + "?")) {

                    var allVals = [];

                    type = $(this).attr('id');

                    $('input[type="checkbox"]:checked').each(function() {

                        allVals.push($(this).val());

                        name = $(this).attr('id');

                    });





                    $.post(mainurl+'deals/status/', {ids: allVals, type: $(this).attr('id')},

                    function(data) {



                        $("#myForm")[ 0 ].reset();

                        $('#edit').css('display','none'); /* This shows the update button when a filed is selected */

                        $('#new').css('display', 'inline'); /* This shows the update button when a filed is selected */

                        oTable.fnDeleteRow(47);



                        $('#showdata').html(data);

                        $('#showdata').animate({'color': 'red'}, "slow");

                    }

                    );

                }

            }

            else {

                $('#checkbox_error').show(400);

                //alert('Please check atleast one entry!');

            }

        });



        //auto complete property details

        $('#listings_ref').autocomplete({

            source: mainurl+"/common/autoFindListing",

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

        

        // Form Submission

        $('#myForm').ajaxForm({

            beforeSubmit: function(arr, $form, options) {



                arr.push({name:'country', value:$('#country').val()});

                var validate = $("#myForm").validate({rules: {price: {number: true, }, size: {number: true, }}, errorClass: 'form_fields_error', errorPlacement: function(error, element) {

                        //$(element).attr({"title": error.text('asdasd')});



                       $('#errortxt').text('Please complete all required fields');

                                        $('#errorMsg').animate({ 'color': 'red'}, "slow");

                                        $('#errorMsg').fadeIn("slow");

                        setTimeout(function() {

                            $('#errorMsg').fadeOut("slow");

                            $('#errorMsg').animate({'color': 'red'}, "slow");

                        }, 5000);



                        //alert('Please fill the required fields')

                    }}).form();

                 $("#country").prop('disabled', false);

                return validate;

                

            },

            target: '#successtxt',

            success: function() {
                
                console.log("saved");


                fnClickAddRow(),

                        formDataChange = false;

                // if ($("#ref").val() == '') {

                //     $.ajax({

                //         async: false,

                //         url: mainurl + 'deals/getlastid/',

                //         success: function(data) {

                //             last_id = data;

                //         }

                //     });

                // }

                $("#cancel").click(),

                $('#successtxt').text('To edit or add new record please click on the edit or new button'),

                $('#successMsg').animate({ 'color': '#49AC44'}, "slow"),

                $('#successMsg').fadeIn("slow"),

                        setTimeout(function() {

                    $('#successtxt').fadeOut("slow");

                }, 5000);

            }

        });

        

        $("#type").change(function() {

            if ($(this).attr('value') == 2) {

                $("#landlord_seller_label").text('Seller Name');

                $("#tenant_buyer_label").text('Buyer Name');

            }

            else if ($(this).attr('value') == 1) {

                $("#landlord_seller_label").text('Landlord Name');

                $("#tenant_buyer_label").text('Tenant Name');

            }

        });

        

        $(function() {

           // $('#renewal_date, #deal_date, #deal_estimated_date').datepicker({

//                dateFormat: 'yy-mm-dd',

//                changeMonth: true,

//                showButtonPanel: true,

//                changeYear: true,

//            });

		 $('.datetimepicker').datetimepicker({

      		  format: 'YYYY-MM-DD,LT'

   			 });

   				 //Date Picker

			$('.datepicker').datetimepicker({

				format: 'YYYY-MM-DD'

			});

        });

	

	//Document Ready Ends

});



$(document.body).on("click", '#listings_row tbody tr', function() {

	

        if ($(this).attr('id') != '') {

            if (formDataChange == true) {

                var result = confirm("You have not saved the data, all changes will be lost!");

            }

            if (result == true || formDataChange == false) {

                var id = $(this).attr('id');

                getSingleRow(id);

            }

        }

});



function ajaxFileUpload()

    {





        if ($('#ref').val() == '') {

            alert('Please save the new deal entry first before adding a document to it.');

            return;

        }



        if ($('#docs_select_sale').val() == '' && $('#docs_select_rent').val() == '') {

            alert('Please select a document type.');

            return;

        }



        if ($('#doc_signed').val() == '') {

            alert('Please indicate whether the document has been signed or not.');

            return;



        }



        if ($('#deals_documents').val() == '') {

            alert('Please select a file to upload using the "Browse" button');

            return;



        }



        else {

            $('#doc_uploading').css('display', '');







            $.ajaxFileUpload

                    (

                            {

                                url: mainurl+'deals/uploadDocuments/',

                                secureuri: false,

                                fileElementId: 'deals_documents',

                                dataType: 'text',

                                data: {deal_ref: $('#ref').val(), deal_id: $('#id').val(), doc_signed: $('#doc_signed').val(), name: $('#document_name').val(), doc_sale: $('#docs_select_sale').val(), doc_rent: $('#docs_select_rent').val(), deal_type: $('#type').val()},

                                success: function(data)

                                {
                                    

                                    $('#doc_uploading').css('display', 'none');



//                                     if (typeof(data.error) != 'undefined')

//                                     {

//                                         if (data.error != '')



//                                         {

//                                             $('#doc_uploading').css('display', 'none');

//                                             alert(data.error);

//                                         } else



//                                         {

//                                             $('#doc_uploaded').css('display', '');

//                                             setTimeout(function() {

//                                                 $("#doc_uploaded").css('display', 'none')

//                                             }, 3500);



//                                             if ($('#documents').val()) {

//                                                 $('#documents').val($('#documents').val() + ',' + data.msg);



//                                             } else {

//                                                 $('#documents').val(data.msg);

//                                                 //$('#showDocuments').html('');

//                                             }



//                                             var documents = $.parseJSON('[' + data.msg + ']');

//                                             $.each(documents, function(key, id) {

//     $("#showDocuments").prepend('<table style="width:95%; border-bottom:#999 groove 1px; padding: 0px 0px 3px 0px; margin: 5px 5px 0px 5px;"><tr><td colspan="2"><a style="text-decoration:none;" href="' + documents[key].filename + '" target="_blank">' + documents[key].doc_title + ' </a></td></tr>  <tr><td> ' + documents[key].doc_name + ' </td> <td style="text-align:right; col\n\
// or:grey;">' + documents[key].dateAdd + '</td></tr></table>');



//                                             });

//                                             $('#document_name,#docs_select_rent,#docs_select_sale,#doc_signed, #deals_documents').val('');

//                                         }



//                                     }
//need design to show documents 
$('#showDocuments').html('');
data = 'uploads/deals/'$('#ref').val()+'/'+data;
 $("#showDocuments").prepend('<table style="width:95%; border-bottom:#999 groove 1px; padding: 0px 0px 3px 0px; margin: 5px 5px 0px 5px;"><tr><td colspan="2"><a style="text-decoration:none;" href="' + data + '" target="_blank">' + $('#document_name').val() + ' </a></td></tr>  <tr><td>  </td> <td style="text-align:right; col\n\
 or:grey;"></td></tr></table>');
 $('#document_name,#docs_select_rent,#docs_select_sale,#doc_signed, #deals_documents').val('');

                                },

                                error: function(data, status, e)

                                {

                                    alert(e);

                                }

                            }

                    );

            return false;

        }



    }

    

function fnShowHide(iCol){

    var oTable = $('#listings_row').dataTable();

    var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;



    if (bVis == true) {

        $('#searchbox tr').find("td:nth-child(" + ((iCol * 1) + 2) + ")").css('display', 'none');

    } else if (bVis == false) {

        $('#searchbox tr').find("td:nth-child(" + ((iCol * 1) + 2) + ")").css('display', '');

    }

    oTable.fnSetColumnVis(iCol, bVis ? false : true);

    //setDatatableWidth();

}

        

    function fnClickAddRow()

    {



        $('#listings_row').dataTable().fnDraw();

    }

        

function setDatatableWidth() {

            var TotalColumnsUnchecked = $('#columns_list input:checked').length;

            if (TotalColumnsUnchecked < 13) {

                $('#listings_row').css('min-width', '100%');

            }

            if (TotalColumnsUnchecked > 12) {

                $('#listings_row').css('min-width', '100%');

            } else {

                $('#listings_row').css('min-width', '100%');

            }

        }

        

function popitup(url) {

        var w = 1000;

        var h = 800;

        var left = (screen.width / 2) - (w / 2);

        var top = (screen.height / 2) - (h / 2);

        return window.open(url + "/" + $("#ref").val(), title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    }

function closePopupFromChild(finalRow) {

    $('.close').trigger('click');

    $("#showDocuments").prepend(finalRow);

    setTimeout(function() {

        $('#showDocuments table').first().css('background-color', '#FFFFFF');

    }, 5000);

}

function deleteThisDocument(id) {

    if (id && window.confirm("Are you sure to delete this document?\nThis will be deleted permanantly and will not be recovered?")) {

        $.get(mainurl+"doc_generate/document_delete/" + id, function(data) {

            var n = data.split("|");

            alert(n[1]);

            if (n[0]) {

                $("#table_" + id).remove();

            }

        });

    }

    return false;

}



function editDocument(doc_id) {

    popitup(mainurl+"doc_generate/document_spa_edit/" + doc_id);

    return false;

}



function deals_checkboxes(value) {

    $('#ExportToCSV_deal').html('<a class="popup_a" href="'+mainurl+'index.php/generate/exportCSVdeal?exportCSV=' + value + '"><img src="'+mainurl+'application/views/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>'); // update download button link

}

    

