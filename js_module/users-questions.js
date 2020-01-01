// JavaScript Document

var formDataChange = false;



    $(document.body).on('change', "#myForm_question",function (event)



    {



        formDataChange = true;



    });

    window.onbeforeunload = function() { 



        if (formDataChange) {



            return 'Data not saved!';



        }



    }





$(document).ready(function() {

    

        

           /* desabled select options for questions */

           

                        $("#question1").change(function(){          

                         var value = $(this).val();

                         if (value === '') return;

                         var bb = $('#question2').val() ;

                         var cc = $('#question3').val() ;





                       $("#question2 option").attr("disabled", false); 

                       $("#question2 option[value='" + value + "'],#question2 option[value='" + cc + "'] ").attr("disabled","disabled");

                       $("#question2 option[value='']").attr("disabled", false);



                       $("#question3 option").attr("disabled", false); 

                       $("#question3 option[value='" + value + "'], #question3 option[value='" + bb + "']").attr("disabled","disabled");

                       $("#question3 option[value='']").attr("disabled", false);



                     });





                     $("#question2").change(function(){          

                         var value = $(this).val();

                         if (value === '') return;

                         var bb = $('#question1').val() ;

                         var cc = $('#question3').val() ;

                            

                       $("#question3 option").attr("disabled", false); 

                       $("#question3 option[value='" + value + "'], #question3 option[value='" + bb + "']").attr("disabled","disabled");

                       $("#question3 option[value='']").attr("disabled", false);

                       

                        $("#question1 option").attr("disabled", false); 

                       $("#question1 option[value='" + value + "'], #question1 option[value='" + cc + "']").attr("disabled","disabled");

                       $("#question1 option[value='']").attr("disabled", false);



                     });



                     $("#question3").change(function(){          

                         var value = $(this).val();

                         if (value === '') return;

                         var bb = $('#question1').val() ;

                         var cc = $('#question2').val() ;





                       $("#question1 option").attr("disabled", false); 

                       $("#question1 option[value='" + value + "'],#question1 option[value='" + cc + "'] ").attr("disabled","disabled");

                       $("#question1 option[value='']").attr("disabled", false);



                       $("#question2 option").attr("disabled", false); 

                       $("#question2 option[value='" + value + "'], #question2 option[value='" + bb + "']").attr("disabled","disabled");

                       $("#question2 option[value='']").attr("disabled", false);



                     });

           

           /* end desabled options for questions */

                            

    

    

    

    

    

    

    

    $('#myForm_question input, #myForm_question select').attr('disabled', 'disabled');

	 formEnabled=true;

    $('#edit_question').click(function () {

        

        

        $("#question1 option").attr("disabled", false); 

        $("#question2 option").attr("disabled", false); 

        $("#question3 option").attr("disabled", false); 

        formEnabled=true;

                $('#ansr_1, #ansr_2, #ansr_3, #question1, #question2, #question3').attr('disabled', false);

                $('#edit_question').css('display', 'none');

                $('#Save_question,#cancel_question').css('display', 'inline');

                $("#myForm_question").validate({rules: { price: { number: true, }, size: { number: true, }} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) { }}).form() ;

		

                

               

            });

            

     	$("#cancel_question").click(function () {

            

	       

		$("#title").text('Edit Your Questions');

		$('#Save_question, #cancel_question').css('display', 'none'); /* This shows the update button when a filed is selected */

		$('#edit_question').css('display', 'inline');    

		$('#myForm_question input, #myForm_question select').attr('disabled', 'disabled');

                 $( "#ansr_1, #ansr_2, #ansr_3" ).removeClass().addClass( "form-control required" ); 

                 $( "#question1, #question2, #question3" ).removeClass().addClass( "form-control  required" );

                formEnabled=false;

                

                 $("#myForm_question")[ 0 ].reset();

                 

	}); 

        

        

        $(document.body).on("click", "#myForm_question", function(event){

	if(formEnabled==false){

	   $('#showdata').css('color','red');

	   $('#showdata').html('To edit you security questions please click on the edit or new button');

	   $('#showdata').fadeIn("slow");

	   setTimeout(function() {  

		   $('#showdata').fadeOut("slow");

	   }, 5000);

	}

});

         

         

         

         

         

              $('#myForm_question').ajaxForm({

      

            beforeSubmit: function() {

                var validate = false;

                var duplicate =false;

                
                alert("In Progress!"); return false;
              

                /* code to check duplicate user END*/



			



                validate =  $("#myForm_question").validate({rules: { price: { number: true }, size: { number: true }} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) {



                        //$(element).attr({"title": error.text('asdasd')});



							



                        $('#showdata').animate({ 'color': 'red'}, "slow");



                        $('#showdata').fadeIn("slow");



                        $('#showdata').html('Please complete all required fields');



                        setTimeout(function() {  



                            $('#showdata').fadeOut("slow");



                            $('#showdata').animate({ 'color': 'red'}, "slow");



                        }, 5000);



							



                        //alert('Please fill the required fields')



                    }}).form() ;

                    

                    

                    

                                if (validate) {

                                    

                                 

                                          if(( $('#ansr_1').val() == $('#ansr_2').val() ) || ( $('#ansr_1').val() == $('#ansr_3').val() ) || ( $('#ansr_2').val() == $('#ansr_3').val() ) ){

                                                  alert("The answers cannot be the same.");

                                            if( $('#ansr_1').val() == $('#ansr_2').val()  ||  $('#ansr_2').val() == $('#ansr_1').val()  ){

                                                     $( "#ansr_1" ).focus();

                                                    $( "#ansr_1" ).removeClass().addClass( "form-control form_fields_error" );

                                                    $( "#ansr_2" ).removeClass().addClass( "form-control form_fields_error" );

                                            }else if($('#ansr_1').val() == $('#ansr_3').val()  || $('#ansr_3').val() == $('#ansr_1').val() ){

                                                  $( "#ansr_1" ).focus();

                                                    $( "#ansr_1" ).removeClass().addClass( "form-control form_fields_error" );

                                                    $( "#ansr_3" ).removeClass().addClass( "form-control form_fields_error" );

                                            }else if($('#ansr_2').val() == $('#ansr_3').val() || $('#ansr_3').val() == $('#ansr_2').val()){

                                                    $( "#ansr_2" ).focus();

                                                    $( "#ansr_2" ).removeClass().addClass( "form-control form_fields_error" );

                                                    $( "#ansr_3" ).removeClass().addClass( "form-control form_fields_error" );

                                            }else if($('#ansr_1').val() == $('#ansr_2').val() == $('#ansr_3').val() ){

                                                    $( "#ansr_3" ).focus();

                                                    $( "#ansr_1" ).removeClass().addClass( "form-control form_fields_error" );

                                                    $( "#ansr_2" ).removeClass().addClass( "form-control form_fields_error" );

                                                    $( "#ansr_3" ).removeClass().addClass( "form-control form_fields_error" );

                                                    

                                               

                                            }

                                            

                                            

                                            

                                   

                                          return false;

                                         

                                    }else{

                                        

                                         if( ( $('#ansr_1').val().length < 3 ) || ( $('#ansr_2').val().length < 3 ) || ( $('#ansr_3').val().length < 3 )  ){

                                                   alert("Answer should be atleast 3 characters.");

                                                        if( $('#ansr_1').val().length <3){

                                                              $( "#ansr_1" ).focus();

                                                        }else if( $('#ansr_2').val().length <3 ){

                                                              $( "#ansr_2" ).focus();

                                                        }else if( $('#ansr_3').val().length <3 ){

                                                              $( "#ansr_3" ).focus();

                                                        }

                                                 return false;

                                                 

                                            }else{

                                                return true;

                                            }

                                        

                                        

                                         

                                    }

                                    

                                  

                                   

                                  }else {

                                     

                                    return false;

                                    

                                        }

                                        

                                        

                            

                                    },

                                     target: '#showdata',

                                    success: function() {

//                        

                                             formDataChange=false;

                                             $("#question1 option").attr("disabled", false); 

                                             $("#question2 option").attr("disabled", false); 

                                             $("#question3 option").attr("disabled", false); 

                                               $("#cancel_question").click(),

                                                    $('#showdata').animate({ 'color': '#49AC44'}, "slow"),



                                                    $('#showdata').fadeIn("slow"),



                                                    setTimeout(function() {  



                                                        $('#showdata').fadeOut("slow")



                                                    }, 5000);

                                    }

                                });





            

    /* Datatable initilization */

});

	

