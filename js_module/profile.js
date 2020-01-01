$(document).ready(function(){
    
        $("input#emailsLeads, input#passwordemail, input#imap").change( function () {
            $('#profile_connect_status').val('0');
        } );
        
        //                  for port imap
                $("#port").change( function () {
                    
                     var val_port = this.value;
                     if(val_port == 'other'){
                         $('#port_extra').val('');
                         $('#port_extra').css('display','');
                         $('#port_extra').focus();
                        
                     }else{
                         $('#port_extra').val('');
                         $('#port_extra').css('display','none');
                     }
                          
                  } );
//                    END for port imap

                $("#port_extra").numeric();

                         
    
    
        $(document.body).on("click", "#TestConnection", function(event){
            $('#resultTest2').css('display', 'none');
            $('#resultTest1').css('display', 'none');
            $('#resultTest3').css('display', 'none');
//            if($('input#emailsLeads').val()!='' && $('input#passwordemail').val()!='' && $('input#imap').val()!=''){
            if(($('input#emailsLeads').val()!='' && $('input#passwordemail').val()!='' && $('input#imap').val()!=''  && $("#port").val() != 'other') || ( $('input#emailsLeads').val()!='' && $('input#passwordemail').val()!='' && $('input#imap').val()!=''  && $("#port").val() == 'other' && $("#port_extra").val() != '')  ){
//                      
                $("#download_animation_2").css('display', '');
                $.post( mainurl+'profile/test_imap1/', { emailsLeads: $('input#emailsLeads').val(), passwordemail:$('input#passwordemail').val(), imap:$('input#imap').val(), email_client_id:$('input#email_client_id').val(), port:$('#port').val() , port_extra:$('#port_extra').val()},
                function( data ) {
                    $('#profile_connect_status').val(data);
                    if( data > 0) {
                        $('#resultTest2').css('display', 'none');
                        $('#resultTest3').css('display', 'none');
                        $('#resultTest1').css('display', '');
                        $("#download_animation_2").css('display', 'none');
                        $('#profile_connect_status').val('1');
                                 
                    }
                    else if(data == 0){
                        $('#passwordemail').val("");
                        $('#imap').val("");
                        $('#passwordemail').focus();
                        $("#download_animation_2").css('display', 'none');
                        $('#resultTest3').css('display', 'none');
                        $('#resultTest1').css('display', 'none');
                        $('#resultTest2').css('display', '');
                    } 
                    else if(data == 'yes'){
                        $('#passwordemail').val("");
                        $('#imap').val("");
                        $('#passwordemail').focus();
                        $("#download_animation_2").css('display', 'none');
                        $('#resultTest1').css('display', 'none');
                        $('#resultTest2').css('display', 'none');
                        $('#resultTest3').css('display', '');
                    } 
                }
            ); 
            }else{
                alert('Please fill all the fields');
                $("#download_animation_2").css('display', 'none');
            }
                     
            setTimeout(function() {  
                $("#resultTest1, #resultTest2, #resultTest3").fadeOut('slow');
            }, 10000);
        });
        
        
        
    
                
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

    $(document).ready(function() {
        $("#pdf_thumbnail").html('<img class="padding-5" src="'+mainurl+'application/views/pictures/logos/pdf_'+$('#brochure_type option:selected').val()+'.jpg" width="90" height="127">');
        $type = $('#brochure_type option:selected').val();
        
        if($type!=1&&$type!=2&&$type!=3)
        {
            $('#pdfLabel').hide();
            $('#colorSelectorPDFInput').hide();
        }
        else{
            $('#pdfLabel').show();
            $('#colorSelectorPDFInput').show();
        }
        
        $('#brochure_type').change( function() {
            $("#pdf_thumbnail").html('<img class="padding-5" src="'+mainurl+'application/views/pictures/logos/pdf_'+$('#brochure_type option:selected').val()+'.jpg" width="90" height="127">');
            $type = $('#brochure_type option:selected').val();
            if($type!=1&&$type!=2&&$type!=3)
            {
                $('#pdfLabel').hide();
                $('#colorSelectorPDFInput').hide();
            }
            else{
                $('#pdfLabel').show();
                $('#colorSelectorPDFInput').show();
            }
        });
        
        // script for poster functionality   
        $("#poster_thumbnail").html('<img class="padding-5" src="'+mainurl+'application/views/pictures/poster_previews/poster_'+$('#poster_id option:selected').val()+'.jpg" width="90" height="127">');
        $poster_id = $('#poster_id option:selected').val(); 
        if($poster_id==0||$poster_id==1||$poster_id==3||$poster_id==4||$poster_id==5) //you cant change the colour on this poster
        {
            $('#poster_color_label').hide();
            $('#colorSelectorPosterInput').hide();
        }
        else{
            $('#poster_color_label').show();
            $('#colorSelectorPosterInput').show();
        }
        
        $('#poster_id').change( function() {
            $("#poster_thumbnail").html('<img class="padding-5" src="'+mainurl+'application/views/pictures/poster_previews/poster_'+$('#poster_id option:selected').val()+'.jpg" width="90" height="127">');
            $poster_id = $('#poster_id option:selected').val();
            
            if($poster_id==0||$poster_id==1||$poster_id==3||$poster_id==4||$poster_id==5) //you cant change the colour on this poster
            {
                $('#poster_color_label').hide();
                $('#colorSelectorPosterInput').hide();
            }
            else{
                $('#poster_color_label').show();
                $('#colorSelectorPosterInput').show();
            }
        });


        $('#colorSelectorPDF').ColorPicker({
            color: RGBtoHEX(  $('#brochure_color').val()),
            onBeforeShow: function(){
                $('#colorSelectorPDF').ColorPickerSetColor(RGBtoHEX(  $('#brochure_color').val()));
            },
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },

            onSubmit: function(hsb, hex, rgb, colpkr) {
                $(colpkr).val(rgb);
                $(colpkr).ColorPickerHide();
                $('#colorSelectorPDFInput').css('backgroundColor', '#' + hex);
                $('#brochure_color').val(rgb['r']+','+rgb["g"]+','+rgb['b']);
            }

        });
        $('#colorSelectorPreview').ColorPicker({
            color: RGBtoHEX(  $('#preview_color').val()),
            onBeforeShow: function(){
                $('#colorSelectorPreview').ColorPickerSetColor(RGBtoHEX(  $('#preview_color').val()));
            },
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },

            onSubmit: function(hsb, hex, rgb, colpkr) {
                $(colpkr).val(rgb);
                $(colpkr).ColorPickerHide();
                $('#colorSelectorPreviewInput').css('backgroundColor', '#' + hex + ' !important');
                $('#preview_color').val(rgb['r']+','+rgb["g"]+','+rgb['b']);
            }

        });
        $('#colorSelectorHTML').ColorPicker({
            color: RGBtoHEX(  $('#html_color').val()),
            onBeforeShow: function(){
                $('#colorSelectorHTML').ColorPickerSetColor(RGBtoHEX(  $('#html_color').val()));
            },
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },

            onSubmit: function(hsb, hex, rgb, colpkr) {
                $(colpkr).val(rgb);
                $(colpkr).ColorPickerHide();
                $('#colorSelectorHTMLInput').css('backgroundColor', '#' + hex + ' !important');
                $('#html_color').val(rgb['r']+','+rgb["g"]+','+rgb['b']);
            }

        });
        $('#colorSelectorPoster').ColorPicker({
            color: RGBtoHEX(  $('#poster_color').val()),
            onBeforeShow: function(){
                $('#colorSelectorPoster').ColorPickerSetColor(RGBtoHEX(  $('#poster_color').val()));
            },
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },

            onSubmit: function(hsb, hex, rgb, colpkr) {
                $(colpkr).val(rgb);
                $(colpkr).ColorPickerHide();
                $('#colorSelectorPosterInput').css('backgroundColor', '#' + hex + ' !important');
                $('#poster_color').val(rgb['r']+','+rgb["g"]+','+rgb['b']);
            }

        });
    
    });
    
    function toHex(N) {
        if (N==null) return "00";
        N=parseInt(N); if (N==0 || isNaN(N)) return "00";
        N=Math.max(0,N); N=Math.min(N,255); N=Math.round(N);
        return "0123456789ABCDEF".charAt((N-N%16)/16) + "0123456789ABCDEF".charAt(N%16);
    }

    //function called to return hex string value
    function RGBtoHEX(str)
    {	
        //check that string starts with 'rgb'
        if (str.substring(0, 3) == 'rgb') {
            var arr = str.split(",");
            var r = arr[0].replace('rgb(','').trim(), g = arr[1].trim(), b = arr[2].replace(')','').trim();
            var hex = [
                toHex(r),
                toHex(g),
                toHex(b)
            ];
            return "#" + hex.join('');				
        }
        else{
            var arr = str.split(",");
            var r = arr[0].trim(), g = arr[1].trim(), b = arr[2].trim();
            var hex = [
                toHex(r),
                toHex(g),
                toHex(b)
            ];
            return "#" + hex.join('');	
        }
    }
    
    formEnabled = true;

    /* Insert / Update function */

    $(document).ready(function() {
        $('#myForm').ajaxForm({
            beforeSubmit : function() { 
                var validate = '';
                var checkemail ='';
                var checkem ='';
                var stat ='';
                var cont='';
                var validateAPI = '';
                validate =  $("#myForm").validate({ errorClass: 'form_fields_error',  errorPlacement: function(error, element) {
                            $(element).attr({"title": error.text()});
						
                    }}).form() ;
                
                
                if( $("#Active").is(':checked') ){ 
                    
                    
                            $.ajax({
                        async: false,
                        url: mainurl+'profile/test_imap2/?emailsLeads=' + encodeURIComponent($('input#emailsLeads').val()) +'&passwordemail='+ encodeURIComponent($('input#passwordemail').val()) +'&imap='+ encodeURIComponent($('input#imap').val()) +'&email_client_id='+$('input#email_client_id').val()+'&port=' + encodeURIComponent($('#port').val())+'&port_extra=' + encodeURIComponent($('#port_extra').val()),
                        success: function(data) {
                            
                                        $('#profile_connect_status').val(data);
                                        if( data > 0) {
                                            stat = true
                                            $('#resultTest2').css('display', 'none');
                                            $('#resultTest3').css('display', 'none');
                                            $('#resultTest1').css('display', '');
                                            $("#download_animation_2").css('display', 'none');
                                            $('#profile_connect_status').val('1');

                                        }
                                        else if(data == 0){
                                            stat = false;
                                            $('#passwordemail').val("");
                                            $('#imap').val("");
                                            $('#passwordemail').focus();
                                            $("#download_animation_2").css('display', 'none');
                                            $('#resultTest3').css('display', 'none');
                                            $('#resultTest1').css('display', 'none');
                                            $('#resultTest2').css('display', '');
                                        } 
                                        else if(data == 'yes'){
                                            stat = false;
                                            $('#passwordemail').val("");
                                            $('#imap').val("");
                                            $('#passwordemail').focus();
                                            $("#download_animation_2").css('display', 'none');
                                            $('#resultTest1').css('display', 'none');
                                            $('#resultTest2').css('display', 'none');
                                            $('#resultTest3').css('display', '');
                                        } 
                                    }
                     
                    })
                  
                  
                  
                }else{
                    
                    stat = true;
                }
 
//                check the apikey

            if($('input#apiKey').val() != '' || $('input#apiKey-hid').val() != ''){
                 $.ajax({
                        async: false,
                        method: "POST",
                        data: { APIKEY : $('input#apiKey').val() },
                        url: mainurl+'profile/validateAPIKey/',
                        success: function(data) {
                            if(data == 1){
                                validateAPI =true;
                                $("#loading,#validate,#cancel-key,#wrong").css('display', 'none');
                                $("#validated,#changeKey").css('display', '');
                                $('input#apiKey').attr('readonly',true);
                            }else{
                                validateAPI =false;
                                alert("Please validate the Mandrill API Key first before saving it");
                                $('#apiKey').focus();
                            }
                            
                        }
                    });
            }else{
                validateAPI = true;
            }
                    
//                END check the apikey
                
                
                if(stat && validate && validateAPI){
                       
                   return true;
                        
               }else{
                   return false;
               } 
                    
                    
//                if(checkem == '1'){
//                    
//                    if ( validate && checkemail ) {
//                        $('.msg').css('display', 'none');
//                        return true;
//                    }else {
//                        $('.msg').css('display', '');
//                        var x=window.confirm("Sorry, connection failed in auto import lead, Are you sure you want to save the other changes ?")
//                        if (x){
//                                    
//                            if ( validate ) {
//                                $('#profile_connect_status').val('0');
//                                return true;
//                            }else {
//                                return false;
//                            }
//                                    
//                        }else{
//                            return false;
//                        }
//                               
//                             
//                             
//                    }
//          
//                }else{
//          
//                    if ( validate ) {
//                        return true;
//                    }else {
//                        return false;
//                    }
//          
//                }          
          
                            
                            
            },
            target: '#showdata',
            success: function() {
                formDataChange=false;
                $('#showdata').fadeIn("slow");
                setTimeout(function() {  
                    $('#showdata').fadeOut("slow");
                }, 5000);
            }
        });
        
        $("input, img").tooltip({

            extraClass: "tooltip",
            showURL: false

        });
    });
		  
    //end update
    $(document).ready(function() {
    
        $('.xml_email_fields').change( function() {
            if(this.value==0){
                $('.custom_email_holder').css('display', 'none');
            }else if(this.value==1){
                $('.custom_email_holder').css('display', '');
            }
        });
        
        
        
        $('.xml_phone_fields').change( function() {
            if(this.value==0){
                $('.custom_phone_holder').css('display', 'none');
            }else if(this.value==1){
                $('.custom_phone_holder').css('display', '');
            }
        });
        
        
    });