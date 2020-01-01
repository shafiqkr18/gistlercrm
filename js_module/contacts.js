// JavaScript Document
//extra
$(document).ready(function(){
	$('#rand_key').val(genRandKey());
			$("input").tooltip();
			$('#myForm input, #myForm select, #myForm textarea').attr('disabled', true);
			formDataChange=false;
			disable_popup();
			$("#mobile,#mobile_2,#mobile_3 #phone,#phone_3,#phone_2,#fax,#fax_1, #fax_2, #fax_3").numeric();
			$("#company").keyup( function () {
			} );

                     
});
function contactEditMode() {
    $("#contact_info .tab-pane .empty_contact").addClass('hidden');
    $("#contact_info .tab-pane .contact_view").addClass('hidden');
    $("#contact_info .tab-pane .contact_edit").removeClass('hidden');
    $("#contact_info .secondary-tabs a:first").tab("show");
    
}

function contactViewMode() {
    $("#contact_info .tab-pane .empty_contact").addClass('hidden');
    $("#contact_info .tab-pane .contact_view").removeClass('hidden');
    $("#contact_info .tab-pane .contact_edit").addClass('hidden');
    
}

function contactEmptyMode() {
    $("#contact_info .tab-pane .empty_contact").removeClass('hidden');
    $("#contact_info .tab-pane .contact_view").addClass('hidden');
    $("#contact_info .tab-pane .contact_edit").addClass('hidden');
    
}

$(document).ready(function () {
	   $("#size, #price, #plot_size, #baths, #mobile, #phone, #price_1, #price_2, #price_3, #price_4,#mobile_no_new").numeric();
	$('#sms_table').click(function() {
		if($('#listings_row input:checked').length == 0){
			$('#checkbox_error').show(400);
			return false;
		}else{
			$("#smsLink").trigger('click');
		}
	});


$("#edit").click(function(){
    contactEditMode();
    formDataChange = true;
    $(".hideInputs").attr('disabled','disabled');
   // $("#hobbies").multipleSelect('enable');
//    jQuery('#mobile_no_new_ccode_2,#mobile_2,#mobile_no_new_ccode_3,#mobile_3,#c_code_fax_2,#fax_2,#c_code_fax_3,#fax_3,#c_code_phone_2, #phone_2,#c_code_phone_3, #phone_3,#email_2,#email_3').attr('disabled',true);
});

$("#new").click(function(){
$("#hobbies").attr('disabled',false).selectpicker('refresh');
    contactEditMode();
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
   // $("#hobbies").multipleSelect('enable');
    //$("#hobbies").multipleSelect('uncheckAll');
});

    $("#cancel").click(function(){
        if($("#mobile_no_new").val()) {
            contactViewMode();
        }
        else {
            contactEmptyMode();
        }
        if(!$("#ref").val()) {
           // $("#hobbies").multipleSelect('uncheckAll');
        }
       // $("#hobbies").multipleSelect('disable');
       // $("#hobbies").multipleSelect('close');
        formDataChange = false;
    })

    $("#contact_type").change(function(){
        if($(this).val() == "7") {
            $("#other_contact_type").show();
        }
        else {
            $("#other_contact_type").hide();
        }
    })

    $("#source_of_contact").change(function(){
        if($(this).val() == "Other") {
            $("#other_source_of_contact").show();
        }
        else {
            $("#other_source_of_contact").hide();
        }
    })

});

	function fnClickAddRow() {
	$('#listings_row').dataTable().fnAddData( [
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
							'',
                                                        '', '',
                                                        '',
        '',
        '',
        '',
        '',
        '',
        '','','','','','','','',''
	] );

}
 function toTitleCase(str) {
	 if(str){
            return str.replace(/(?:^|\s)\w/g, function(match) {
                return match.toUpperCase();
            });
	       }
        }
$(document).ready(function () {

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
		
});