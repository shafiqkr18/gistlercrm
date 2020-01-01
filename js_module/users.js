$(document).ready(function() {

            		$("#new").click(function () {	

					    $("#myForm")[ 0 ].reset();

	  				 if(screenname=='users'){

		

							$('#rand_key').val(genRandKey());

							var value='';

							var portalValue = [];

							var count=0;

						

						}

					$("#title").text('Add New record');

					$('#update, #edit, #new, #placeholder').css('display', 'none'); /* This shows the update button when a filed is selected */ 

					$('#Save, #cancel').css('display', 'inline'); /* This shows the update button when a filed is selected */   

					$('#myForm input, #myForm select, #myForm textarea').prop('disabled', false);;

	       

				});

				$("#cancel").click(function () {

							

					   // $("#myForm")[ 0 ].reset();

						$("#title").text('Add New record');

						$('#update, #Save, #edit, #cancel').css('display', 'none'); /* This shows the update button when a filed is selected */

						$('#new').css('display', 'inline');    

						$('#myForm input, #myForm select, #myForm textarea').prop('disabled', true);

						$('#id').val(0);

							   

						//for now keep last_id=0

						last_id=0;

						if(screenname=="users"){

						if(last_id=='' || active_tab=='tab2'){

							$("#myForm")[ 0 ].reset();

						}

						}

						if (last_id>0){

							getSingleRow(last_id);

						}

						

						arr_images.length = 0; //reset the array of images

						formEnabled=false;

						formDataChange = false;

						disable_popup();

						

					});

            });

$(document).ready(function() {



$("#send_sms").validate({

    rules: {

        "sms_mobile_no": {

            required: true,

            number: true

        },

        "sms_mobile_ccode": {

            required: true

        }

    },

    errorClass: 'form_fields_error',

    errorPlacement: function(error,element) {

        return true;

      },

    //perform an AJAX post to python script

    submitHandler: function(form) {

        var userId = $("#id").val();

        var clientId = client_id ;

        var ccode = $("#sms_mobile_ccode_field").val();

        var mobile_no = $("#sms_mobile_no").val();

        var ccode_no  = $("#sms_mobile_ccode").val(); 

        var mobile = ccode+$("#sms_mobile_no").val();

        var lookup = '';

        

        $.ajax({

                async: false,

                url: mainurl+'users/lookupnew?id=' + userId + '&mobile_no_new='+mobile_no+ '&country_code='+ccode_no,

                success: function(data) {

                           if(data !=''){

                                   lookup = false;

                                   alert(data);

                           }

                           else{

                                   lookup = true;

                           }

                }

	})



        if(!lookup){

             return false;

        }

        $.post(mainurl+'sms_verification_api/send_verification_sms?screen=users',{ user_id: userId, mobile_number: mobile },

        function(data){

            if(data == '0'){

                alert("Somthing went wrong, Please try again.");

            }else if(data == 1){

                //move to other screen

                $("#sendsms_scr").css('display','none');

                $("#verify_scr").css('display','');

                $("#rand_code").attr('disabled',false);

                $("#rand_code").focus();

                $(".code_error").html('');

            }else{

               //show a msg unable to send meesages 

            }

        }, "json");

        

    }

    

});



$("#verify_code").validate({

    rules: {

        "rand_code": {

            required: true,

            number: true,

            minlength:6,

            maxlength:6

        }

    },

    errorClass: 'form_fields_error',

    errorPlacement: function(error,element) {

        return true;

      },

    //perform an AJAX post to python script

    submitHandler: function() {

        var code     = $("#rand_code").val();

        var mobile   = $("#sms_mobile_no").val();

        var sms_ccode= $("#sms_mobile_ccode").val();

        var number_verified = $('#sms_mobile_ccode option[value='+sms_ccode+']').attr('rel')+'-'+mobile;

        $.post(mainurl+'users/save_sms_mobile/',{ rand_code: code ,sms_mobile: mobile, sms_ccode:sms_ccode },

        function(data){

            if(data.error === null){

                if(data.response === 'updated'){

                    $('#sms-box').html('<span class="sms-box-title">+'+number_verified+'<img src="'+mainurl+'application/views/images/sms-small-pending.png" width="14" \n\
height="14" style="margin:0px 5px;"><span class="sms-box-msg-red">Number Pending</span></span>');

                    $('#info-sms').css('display','none');

                    $('.Verify').html('Change');

                }

                $("#success_scr").css('display','');

                $("#verify_scr, #sendsms_scr").css('display','none');

                $(".code_error").html('');

            }else{

                if(data.error === 'user_error'){

                    // User has the same number

                    $("#success_scr").css('display','');

                    $("#verify_scr, #sendsms_scr").css('display','none');

                    $(".code_error").html('');

                }else if(data.error === 'blocked'){

                    $("#rand_code").attr('disabled',true);

                    $("#btn-success").attr('disabled',true);

                    $(".code_error").html('Please try again after '+data.response.time_left);

                }else if(data.error === 'invalid'){

                    $("#rand_code").attr('disabled',false);

                    $("#btn-success").attr('disabled',false);

                    $(".code_error").html('The code you entered is incorrect');

                    $("#rand_code").val('');

                    $("#rand_code").focus();

                }

            }

        }, "json");

    }

    

});





function isValidEmailAddress(emailAddress) {

    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);

    return pattern.test(emailAddress);

};



});

