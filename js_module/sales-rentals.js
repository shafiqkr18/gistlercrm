// JavaScript Document

 $(document.body).on('click', "#price_of_application", function(){

             if($("#price_of_application").is(':checked')){

                 $("#price").removeClass('required form_fields_error');

             } else {

                 $("#price").attr('class', 'form-control required form_fields_error');

             }

             

         });

         

         $("#document_name").focus(function() {

                $("#document_name").val('');

         });   

         $("#document_name").focusout(function() {

             if(this.value == ''){

                 $("#document_name").val('Document Name');

             } else {

                 //$("#document_name").val();

             }

                

         });   

         

        $("#notes").keypress(function (evt) {

            var keycode = evt.charCode || evt.keyCode;

            //alert(keycode);

            if (keycode  == 34 || keycode  == 39 || keycode  == 47 || keycode  == 92 || keycode  == 13) { //Enter key's keycode

                return false;

            }

        });

        

        /******************************* Datatable Utility Function ****************************/

    

        //$('#columns_list input').change( function () {

		 $('#columns_list').on('change', 'input[type=checkbox]', function() {

            fnShowHide( $(this).attr('col') )

            $('#total_active_columns').html($('#columns_list input:checked').length)

        });

    

        $(document.body).on("click", "#save_columns_settings", function(event){

            var disabled_columns_array = [];

            $('#columns_list input[type="checkbox"]:unchecked').each(function() {

                disabled_columns_array.push($(this).attr('col'));

                });

 

                $.post(mainurl+"common/save_disabled_columns/", { 

                columns: disabled_columns_array,
                screenname: 'listings',  

            }, function(info) {

                $('a.close').click();

            });

        } );

    

        $(document.body).on("click", "#reset_columns_settings", function(event){

            $('#columns_list input[type="checkbox"]').each(function() {

                if($(this).prop('checked')==true && $(this).attr('default')=='not_default'){

                    fnShowHide( $(this).attr('col') )

                    $(this).attr('checked',false)

                }else if($(this).prop('checked')==false && $(this).attr('default')!='not_default'){

                    fnShowHide( $(this).attr('col') )

                    $(this).attr('checked','checked')

                }

                $('#total_active_columns').html($('#columns_list input:checked').length)

            });

            setDatatableWidth();

        } );

        

        $("#listings_row thead input").keyup( function () {

            /* Filter on the column (the index) of this element */

           // if(this.value.length<3 && this.value.length>0 && (this.id==5 || this.id==15 || this.id==9 || this.id==43)){

//                return false;

//            }



            oTable.fnFilter( this.value, $(this).attr('id') );

            $('#listings_row #reset_filter').css('display', '');

        } );

        

        $("#listings_row thead select").change( function () {

            /* Filter on the column (the index) of this element */

            oTable.fnFilter( this.value, $(this).attr('id') );

            $('#listings_row #reset_filter').css('display', '');

        } );

        

        $(document.body).on("click", "#show_unapproved_listings", function() {

            // oTable.fnFilter( "3", 1 );

            // $('#listings_row #reset_filter').css('display', '');

        });

                        //advance search

        $(".advance_search, #groups_toggle").change( function () {

            oTable.fnDraw();

            $('#listings_row #reset_filter').css('display', '');

        } );

        

        $(".advance_search").keyup( function () {

            oTable.fnDraw();

            $('#listings_row #reset_filter').css('display', '');

        } );

        

        $(function() {

           // $('#as_available_date').datepicker({

//                dateFormat: 'yyyy-mm-dd',

//                showButtonPanel: true,

//                onClose: function(dateText, inst) { oTable.fnDraw(false); $('#listings_row #reset_filter').css('display', ''); }

//            })

        });

    

        $(function() {

           // $('#as_available_date_from, #as_available_date_to, #available_dateS').datepicker({

//                dateFormat: 'yyyy-mm-dd',

//                showButtonPanel: true,

//                onClose: function(dateText, inst) { oTable.fnDraw(false); $('#reset_filter').css('display', ''); }

//            })

		//        for images upload popup

        $('#tabs_image').attr('image_type','');

        $('#tabs_image li a').click(function(){  

            var tab;

            if($(this).attr('tab') == 'tab1_img' || $(this).attr('tab') == 'tab3_img'){

                active_tab = 'tab1_img';

                tab = '#tab1_img';

            }else{

                active_tab = $(this).attr('tab');

                tab =  $(this).attr('href');

            }

		

            // tabs code edit

            if(active_tab =='tab2_img'){

                $('#tabs_image').attr('image_type','floor');

                $("#images_lst").css('display','none');

                $("#images_floor").css('display','');

				

            }else if(active_tab == 'tab1_img'){

                $('#tabs_image').attr('image_type','');

                $("#images_lst").css('display','');

                $("#images_floor").css('display','none');

			  

            }

            // tab code edit

            if($(this).closest('li').hasClass('inactive')){ //added to not animate when active

                $('#tabs_image li').removeClass('active');

                $('#tabs_image li').addClass('inactive');

                $(this).closest('li').removeClass('inactive');

                $(this).closest('li').addClass('active');



                $(tab).fadeIn('slow');

                return false;

            }           

        }); //end click;



//        END for image upload popup

        });

        

        $('#total_active_columns').html($('#columns_list input:checked').length);

        

         /* start min and max functions*/

        $('#listings_row #minarea').keyup( function() { oTable.fnDraw(); $('#10 img').attr("src", mainurl+"application/views/images/green-arrow.png"); $('#listings_row #reset_filter').css('display', ''); } );

        $('#listings_row #maxarea').keyup( function() { oTable.fnDraw(); $('#10 img').attr("src", mainurl+"application/views/images/green-arrow.png"); $('#listings_row #reset_filter').css('display', ''); } );

        $('#listings_row #minprice').keyup( function() { oTable.fnDraw(); $('#11 img').attr("src", mainurl+"application/views/images/green-arrow.png"); $('#listings_row #reset_filter').css('display', ''); } );

        $('#listings_row #maxprice').keyup( function() { oTable.fnDraw(); $('#11 img').attr("src", mainurl+"application/views/images/green-arrow.png"); $('#listings_row #reset_filter').css('display', ''); } );

        /* end min and max functions*/

       

       /* Start Date search */

        $(function() {

            $('#listings_row #dateaddedS, #listings_row #dateaddedSto, #listings_row #dateupdatedS, #listings_row #dateupdatedSto').datepicker({

                dateFormat: 'yyyy-mm-dd',

                showButtonPanel: true,

                onClose: function(dateText, inst) { oTable.fnDraw(false); $('#listings_row #reset_filter').css('display', ''); }

            })

        });

        /* End Date search */

        

        //reset filter and drawtable

        $("#listings_row #reset_filter").click(function () {

            notification_id = '';

            migrated = '';

            migrated_rental = 0;

            migrated_sales = 0;

            $("#listings_row #myForm2")[ 0 ].reset();

            $("#as_search_form")[0].reset();

            $("#groups_toggle").val('');

            oTable.fnDraw(false);

            oTable.fnFilterClear(true);

            $("#listings_row .click img").attr("src", mainurl+"application/views/images/arrow.png?ts=10");

            $('#listings_row #reset_filter').css('display', 'none');

        });

		

		 // Searchbox focus

        

        $("#searchbox input").focus(function() {

             if (this.id==5 || this.id==15 || this.id==9 || this.id == 43) {

                 //check if it has default value, if so clear so user can input own value

                 if (this.value==" Min 3 chars") {

                    //alert ('value is min 3 chars, so clearing');

                  $( this ).css( "color", "" );

                  $( this ).css( "font-family", "" );

                  $( this ).css( "font-size", "" );

                    

                     this.value="";

                 }

                 

             }

         });   

           

          $("#searchbox input").focusout(function() {

             // alert ('out of focus of searchbox -id:' + this.id + ' - value:'+this.value);          

              if ((this.id==5 || this.id==15 || this.id==9 || this.id==43) && this.value=='' )  {

                  //alert ('changing value');

                  this.value=' Min 3 chars';

              }

              

         });

		   //change css of selected row    

        $("body").on("click", "#listings_row tbody tr, .overflow", function(event){         

            if(formDataChange==false){

                $("td.yellowCSS", oTable.fnGetNodes()).removeClass("yellowCSS");

                $('#listings_row tbody #'+$(this).attr('rel')).find("td").addClass("yellowCSS");

                $(event.target).parent().find("td").addClass("yellowCSS");

            }

        });

        

        /* single row select */

        

        $("body").on("click", '#listings_row tbody tr', function() {  

            if($(this).attr('id')!=''){

                if(formDataChange==true){

                    var result=confirm("You have not saved the data, all changes will be lost!")

                }

                if(result==true || formDataChange==false){

                    var id=$(this).attr('id');

					getSingleRow(id,'listings');

                }

            }

        });

        

        $(document.body).on("click", '#listings_archive_row tbody tr', function() {  

            if($(this).attr('id')!=''){

                if(formDataChange==true){

                    var result=confirm("You have not saved the data, all changes will be lost!")

                }

                if(result==true || formDataChange==false){

                    var id=$(this).attr('id');

                    getSingleRow(id,'archived');

                }

            }

        });



    $(document.body).on("click", '#listings_quality_table tbody tr', function() {

        if($(this).attr('id')!=''){

            if(formDataChange==true){

                var result=confirm("You have not saved the data, all changes will be lost!")

            }

            if(result==true || formDataChange==false){

                var id=$(this).attr('id');

                getSingleRow(id,'listings');

            }

        }

    });



        $(document.body).on("click", '#buttonUpload', function() { 

            if($('#document_name').val()!=''){

                $("#download_animation").css('display', 'inline');

            }

            else

            {

                $("#download_animation").css('display', 'none');

            }

            setTimeout(function() {  

                $("#download_animation").css('display', 'none');

            }, 50000);

        });

        

        // check box delete

        $(document.body).on("click", '.dbstatus', function() {   

            if($('#listings_row input, #listings_archive_row input').is(':checked')){

                if(active_tab=="tab1")      { var table = "listings"; }

                else if(active_tab=="tab2") { var table = "archive"; }

                if(confirm("Are you sure you want to "+$(this).attr('id')+"?")){

                    var allVals = [];

                    type = $(this).attr('id');

                            if(active_tab=="tab1"){

                                 $('#listings_row input[type="checkbox"]:checked').each(function() {

                                 allVals.push($(this).val());

                                 name=$(this).attr('id');

                    });

                            }else if(active_tab=="tab2"){

                                 $('#listings_archive_row input[type="checkbox"]:checked').each(function() {

                        allVals.push($(this).val());

                        name=$(this).attr('id');

                    });

                            }

                   

        

                    $.post( mainurl + 'listings/status/', { ids: allVals, table: table, type:$(this).attr('id') },

                        function( data ) {

                                $("#myForm")[ 0 ].reset();

                                $('#edit').css('display', 'none'); /* This shows the update button when a filed is selected */ 

                                $('#new').css('display', 'inline'); /* This shows the update button when a filed is selected */ 

                                oTable.fnDeleteRow();

                                                                $("#cancel").click();

                                if(active_tab=="tab2") { 

                                    refresh_archive_datatable();

                                }

                              $('#infotxt').text(data)

                                $('#infoMsg').animate({ 'color': 'red'}, "slow");

                            });

                    }

            } else {

                $('#checkbox_error').show(400);

            }

            });

        

   

		



           function ltrim(str, chars) {

			chars = chars || "\\s";

			return str.replace(new RegExp("^[" + chars + "]+", "g"), "");

				}

        $(function () {

		//Date & Time Picker

				$('.datetimepicker').datetimepicker({

				format: 'YYYY-MM-DD,LT'

				});

				//Date Picker

				$('.datepicker').datetimepicker({

				format: 'YYYY-MM-DD'

				});

		});

            

            $(function() {

                $('#amount_date').datepicker({

                    dateFormat: 'yyyy-mm-dd',

                    changeMonth: true,

                    showButtonPanel: true,

                    changeYear: true

                });

            });

			

			 $(document.body).on('change', "#unit",function (event){

                var unitChanged = false

            });

            

            /************************************** 

             * 

             *Form Elements Change Events Listeners

             * 

             */

            

            $("#prop_status").change( function () {

                var prop_stats = $(this).attr('value');

                if(prop_stats ==2 | prop_stats ==3 | prop_stats ==4 | prop_stats ==6 | prop_stats ==7){

                    $('#status').val(1);

                } else if(prop_stats ==1) {

        

                } else {

                    $('#status').val(2);

                }

    

                if(prop_stats ==3 | prop_stats ==2 ){

                    $('#agent_rent_sold').css('display','');

                } else {

                    $('#agent_rent_sold').css('display','none');

                    $('#agent_rent_sold').val(0);

                }

    

                $('#add_info').val($('#prop_status option:selected').text());

            } );

        

            $("#source_of_listing").change( function () {

    

                if($(this).attr('value')=='Referral within company' ){

                    $('#reffered_by_agent').css('display','');

                } else {

                    $('#reffered_by_agent').css('display','none');

                    $('#reffered_by_agent').val('');

                }

    

                $('#add_info').val($('#prop_status option:selected').text());

            } );

            /*---------------Security Deposit--------------*/       

            $("#deposit_percentage").keyup( function () {

                var price      = $('#price').val();

                var percentage = $(this).val();

                var deposit    = (price * percentage)/100; 

                if(isNaN(deposit))    { deposit = 0; }

                $('#deposit').val(deposit.toFixed(2));

    

            } );    

     

            $("#deposit").keyup( function () {

    

                var price      = $('#price').val();

                var deposit    = $(this).val();

                var percentage = (deposit/price)*100; 

                if(isNaN(percentage) || percentage=='Infinity')   { percentage = 0; }

                $('#deposit_percentage').val(percentage.toFixed(2));

    

            } ); 

     

            $("#price").keyup( function () {

                var price      = $('#price').val();

                var percentage = $('#deposit_percentage').val();

                var deposit    = (price * percentage)/100; 

                if(isNaN(deposit))    { deposit = 0; }

                $('#deposit').val(deposit.toFixed(2));

    

                var price      = $('#price').val();

                var deposit    = $('#deposit').val();

                var percentage = (deposit/price)*100; 

                if(isNaN(percentage) || percentage=='Infinity') { percentage = 0; }

                $('#deposit_percentage').val(percentage.toFixed(2));

    

            });

                    /*---------------Security Deposit--------------*/       

            $("#deposit_percentage").keyup( function () {



                var price      = $('#price').val();

                var percentage = $(this).val();

                if(price>0 & percentage>0){

                    var deposit    = (price * percentage)/100; 

                    if(isNaN(deposit))    { deposit = 0; }

                    $('#deposit').val(deposit.toFixed(2));

                }

    

            } );    

     

            $("#deposit").keyup( function () {

    

                var price      = $('#price').val();

                var deposit    = $(this).val();

                if(price>0 & deposit>0){

                    var percentage = (deposit/price)*100; 

                    if(isNaN(percentage) || percentage=='Infinity')   { percentage = 0; }

                    $('#deposit_percentage').val(percentage.toFixed(2));

                }

            } ); 

     

            $("#price").keyup( function () {

  

                var price      = $('#price').val();

                var percentage = $('#deposit_percentage').val();

                if(price>0 & percentage>0){

                    var deposit    = (price * percentage)/100; 

                    if(isNaN(deposit))    { deposit = 0; }

                    $('#deposit').val(deposit.toFixed(2));

                }

    

                var price      = $('#price').val();

                var deposit    = $('#deposit').val();

                if(price>0 & deposit>0){

                    var percentage = (deposit/price)*100; 

                    if(isNaN(percentage) || percentage=='Infinity') { percentage = 0; }

                    $('#deposit_percentage').val(percentage.toFixed(2));

                }

            });

                    /*---------------Commission--------------*/

            $("#commission_percentage").keyup( function () {

    

                var price      = $('#price').val();

                var percentage = $(this).val();

                if(price>0 & percentage>0){

                    var deposit    = (price * percentage)/100; 

                    if(isNaN(deposit))    { deposit = 0; }

                    $('#commission').val(deposit.toFixed(2));

                }

            } );    

     

            $("#commission").keyup( function () {

                var price      = $('#price').val();

                var deposit    = $(this).val();

                if(price>0 & deposit>0){

                    var percentage = (deposit/price)*100; 

                    if(isNaN(percentage) || percentage=='Infinity')   { percentage = 0; }

                    $('#commission_percentage').val(percentage.toFixed(2));

                }

            } ); 

     

            $("#price").keyup( function () {

                var price      = $('#price').val();

                var percentage = $('#commission_percentage').val();

                if(price>0 & percentage>0){

                    var deposit    = (price * percentage)/100; 

                    if(isNaN(deposit))    { deposit = 0; }

                    $('#commission').val(deposit.toFixed(2));

                }

    

                var price      = $('#price').val();

                var deposit    = $('#commission').val();

                if(price>0 & deposit>0){

                    var percentage = (deposit/price)*100; 

                    if(isNaN(percentage) || percentage=='Infinity') { percentage = 0; }

                    $('#commission_percentage').val(percentage.toFixed(2));

                }

            });

     

                    /*----------------sq ft price ------------*/

            $("#price").keyup( function () {

    

                var price      = $(this).val();

                var size       = $('#size').val();

                if(price>0 & size>0){

                    var unit_price = (price/size); 

                    if(isNaN(unit_price) || unit_price=='Infinity') { unit_price = 0; }

                    $('#unit_size_price, #unit_size_price_2').val(unit_price.toFixed(2));

                }

            });

 

            $("#size").keyup( function () {

    

                var price      = $('#price').val();

                var size       = $(this).val();

                if(price>0 & size>0){

                    var unit_price = (price/size); 

                    if(isNaN(unit_price) || unit_price=='Infinity') { unit_price = 0; }

                    $('#unit_size_price, #unit_size_price_2').val(unit_price.toFixed(2));

                }

            });

			

function setDatatableWidth(){

    var TotalColumnsUnchecked = $('#columns_list input:checked').length;

    if(TotalColumnsUnchecked<18){

        $('#listings_row').css('width', '100%');}

    if(TotalColumnsUnchecked>17){

        $('#listings_row').css('min-width', '100%'); 

    }else{

        $('#listings_row').css('min-width', '100%');

    }

}



function fnShowHide( iCol ){

    var oTable = $('#listings_row').dataTable();

    //new $.fn.dataTable.FixedHeader( oTable );

    var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;



    if(bVis==true){

		

        $('#searchbox tr').find("td:nth-child("+((iCol*1)+2)+")").css('display', 'none');

    } else if(bVis==false){

		

        $('#searchbox tr').find("td:nth-child("+((iCol*1)+2)+")").css('display', '');

    }

    oTable.fnSetColumnVis( iCol, bVis ? false : true );

    setDatatableWidth();

}



function fnShowHideStatusColumn( showOrHide , iCol ){

    var oTable = $('#listings_row').dataTable();

    //new $.fn.dataTable.FixedHeader( oTable );

    var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;

    if(showOrHide==false){

        $('#searchbox tr').find("td:nth-child("+((iCol*1)+2)+")").css('display', 'none');

    } else if(showOrHide==true){

        $('#searchbox tr').find("td:nth-child("+((iCol*1)+2)+")").css('display', '');

    }

    oTable.fnSetColumnVis( iCol, showOrHide );

    setDatatableWidth();

}





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

                    '',

                    '',

                    '',

                    '',

                    '',

                    ] );

}		

			

  function update_media_count(){

    var othermedia_count=0;

    if($('#video_embed_code').val())        { othermedia_count= othermedia_count+1; }

    if($('#360_embed_code').val())      { othermedia_count= othermedia_count+1; }

    if($('#audio_embed_code').val())        { othermedia_count= othermedia_count+1; }

    if($('#virtual_tour_embed_code').val())     { othermedia_count= othermedia_count+1; }

    if($('#qr_code_link').val())        { othermedia_count= othermedia_count+1; }

    if($('#pdf_brochure').val())        { othermedia_count= othermedia_count+1; }

    if($('#video_path').val())          { othermedia_count= othermedia_count+1; }

    $('#othermedia_count').val(othermedia_count);

}



function setCoordinates(id){


     $.ajax({

         type:  'POST',

         url:   mainurl+'common/getcoordinates/'+id,

         success:function(r) {
            r = r.replace(/\"/g, "")
             var cord = r.split("|");


           
             if(cord[0]!='' || cord[1]!=''){

                 if(marker) {

                     marker.setMap(null);   

                 }

                 pointB = new google.maps.LatLng(cord[0],cord[1]);

                 marker = new google.maps.Marker({

                      position: pointB,

                      map: map,

                      title: 'My point',

                      draggable: true,

                 });

                 

                 marker.setMap(map)

                 map.setCenter(pointB, 15);

                 //set the coordinates of the location or sublocation

                 $('#lat, #lat_f').attr('value',cord[0]);

                 $('#lon, #lon_f').attr('value',cord[1]);

                 

                 google.maps.event.addListener(marker, 'dragend', function(event) {

                    placeMarker(event.latLng, map);

                });

        

             }else{

                 //if no coordinates for location and sublocation use the coordinates of the emirate

                 setEmirate($('#region_id').val());

             }

         }

     });

}



function showMap( ) {



    var m = $("#map")[0];

    if(m) {

        map = new google.maps.Map(m, {

            center: new google.maps.LatLng(25.007385745840264, 54.987945556640625),

            zoom: 13,

            mapTypeId: google.maps.MapTypeId.ROADMAP

            }

        );



        google.maps.event.addListener(map, 'click', function(event) {

            placeMarker(event.latLng, map);

        });
          var lastCenter= map.getCenter(); 
          google.maps.event.addListenerOnce(map, "bounds_changed", function() {
            google.maps.event.trigger(map, "resize");
             map.setCenter(lastCenter);
            
          });
         
        map.setCenter(lastCenter);
        

    }



}







function marklisting(lat,lon) {

 //alert(lat+'-'+lon);

     if( ! map ) {

        return ;

     }

     

     zoom=15;

     if(lat=='' || lon==''){

         lat=25.154607869668236;

         lon=54.882888793945314;

         zoom=11;

     }

     

     if(marker) {

         marker.setMap(null);   

     }

     

    pointB = new google.maps.LatLng(lat,lon);

    marker = new google.maps.Marker({

          position: pointB,

          map: map,

          title: 'My point',

          draggable: true,

         });

    

    marker.setMap(map);

    map.setCenter(marker.getPosition());

    map.setZoom(zoom);

    google.maps.event.addListener(marker, 'dragend', function(event) {

        placeMarker(event.latLng, map);

    });

}



function resizemap() { 

    google.maps.event.trigger(map, 'resize');

}



 



function setEmirate(id){ 

    //set the coordinates if emirate is changed

    //region id is triggered by js to differentiate between js trigger and user trigger

    if($('#category_id').prop('disabled')==false) {

        $('#lat, #lat_f').val(emirate_coordinates[id][0]);

        $('#lon, #lon_f').val(emirate_coordinates[id][1]);

        marklisting(emirate_coordinates[id][0],emirate_coordinates[id][1]);

    }

}

////map visual location







function placeMarker(location, map) {

    if (marker) {

      marker.setPosition(location);

    } else {

     marker = new google.maps.Marker({

          position: location,

          map: map,

          title: 'My point',

          draggable: true,

         });

     }



    marker.setMap(map);

    var point = map.getCenter();

    $('#lon').attr('value',marker.getPosition().lng());

    $('#lat').attr('value',marker.getPosition().lat());

    

    google.maps.event.addListener(marker, 'dragend', function(event) {

        placeMarker(event.latLng, map);

    });

} 



function setSelectedCheckboxes(){

    var cVal = '';

    var count = 0;

    $('#listings_row input:checked').each(function() {

        

        cVal+=$(this).attr('value')+',';

        if($(this).attr('id') != 'check_all_checkboxes'){

            count++;

        }

        

    });

    $('#sms-iframe-agent').attr('src', mainurl+'sendSMS/showSMSFormAgents/'+cVal);

    $('#sms-iframe-owner').attr('src',  mainurl+'sendSMS/showSMSFormOwners/'+cVal);

    $('#email_count').text(count);

}

$( document ).on( 'change', '#region_id_f', function () {

    var value = $(this).val() ;

    var snum_dropdown ='';

    snum_dropdown += '<option value="" selected="selected">Select</option>';

    $.each(location_json_array[value], function(key, val) {

        snum_dropdown += '<option value="'+ key*1 +'" >'+ val +'</option>'; 

    });

    console.log(location_json_array);

    $('#area_location_id_f').html(snum_dropdown);

    $('#sub_area_location_id_f').val('');

    $('#area_location_id_f').attr('disabled',false);

    

    setEmirate(value);



}); 





$( document ).on( 'change', '#area_location_id_f', function () {

    var value = $(this).val() ;				

    var snum_dropdown ='';

    snum_dropdown += '<option value="0" selected="selected">Select</option>';



    if (sub_location_json_array[value]) {

        $.each(sub_location_json_array[value], function(key, val) {

            snum_dropdown += '<option value="'+ key*1 +'" >'+ val +'</option>'; 

        });

    }

    $('#sub_area_location_id_f').html(snum_dropdown);

    $('#sub_area_location_id_f').attr('disabled',false);

    //if the location is changed set the coordinates of the new location

    //area_location_id is triggered by js to differentiate between js trigger and user trigger

    setCoordinates(value);

}); 

$( document ).on( 'change', '#sub_area_location_id_f', function () {

    var value = jQuery(this).val() ;

    //if the sublocation is changed set the coordinates of the new sublocation

    setCoordinates(value);      

});



       /* ************* *******************************

             *  

             * Button Actions Save / Update / Edit 

             *

             * ***********************************************/

            

            $("#update, #Save").click(function () {

                    if($("#price_of_application").is(':checked')){

                        $("#price_of_application").attr('value', '1');

                         //$("#price").removeClass('valid');

                    } 

                                    

                    tinyMCE.triggerSave() ;

                    descFlag = true;

                

                    var OtherLanguages = [];

                    $('.other_languages').each(function() {

                        var value = this.value;

                        if($('#other_title_'+value).val()!='' || $('#other_description_'+value).val()!=''){

                            OtherLanguages.push(value);

                        }

                    });

                            //alert(OtherLanguages);

                    $('#other_languages').val(OtherLanguages);

            });

			

			function plot_area_information(data){

            /* code for area information START */

    $("#area_information")[ 0 ].reset();

    $('div[id^="extra_ai_"]').html("");

    if(data){

        var area_information = $.parseJSON(data);

        $.each(area_information, function(key, value) {

            if($('#area_information #'+key).length>0){

                $('#area_information #'+key).val(value);

            }else{

                var split_data = key.split("_");



                var html = "";

                html += '<input name="area_information_'+split_data[2]+'_'+split_data[3]+'"  style="width:95%;" class="form_fields" id="area_information_'+split_data[2]+'_'+split_data[3]+'">';

                html += '<a href="# ai" id="ai_button_'+split_data[2]+'_'+split_data[3]+'" ai_type="'+split_data[2]+'" count="'+split_data[3]+'" class="remove_extra_ai"><img src='+mainurl+'"application/views/images/minus_e.png"></a>';



                $('#extra_ai_'+split_data[2]).append(html);

                $('#area_information #'+key).val(value);

            }

        });  



    }

    /* code for area information END */

				}



			function setSelectedCheckboxes(){

				var cVal = '';

				var count = 0;

				$('#listings_row input:checked').each(function() {

					

					cVal+=$(this).attr('value')+',';

					if($(this).attr('id') != 'check_all_checkboxes'){

						count++;

					}

					

				});

				$('#sms-iframe-agent').attr('src', mainurl+'sendSMS/showSMSFormAgents/'+cVal);

				$('#sms-iframe-owner').attr('src',  mainurl+'sendSMS/showSMSFormOwners/'+cVal);

				$('#email_count').text(count);

			}

			

	 /* ************* ****************

             *  Popups / Download Actions

             */

            

            $(document.body).on('click', '#downloadCSV_div_click', function(){

                    $('#popup8').css('display', 'none');

                    $('#export_selected_columns').css('display', 'block');

                    return false;

            });

            

            $(document.body).on('click', '#generate_selected_cols', function(){

                var selected_array = [];

                $(".selected_cols:checked").each(function() {

                    selected_array.push(this.value);

                });

                var allselectedlistings = $('#exportPDFIds').val();

                var allselectedlistings  = allselectedlistings.replace(/^,|,$/g,'');

                if(allselectedlistings && selected_array){

                      window.location = mainurl+"generate/exportCSVSelectedColumns?ids="+allselectedlistings+"&selectedArray=" + selected_array;

                }

             });  

                 

            $(document.body).on('click', '#generate_selected_cols_all', function(){

                    var selected_array = [];

                    $(".selected_cols_all:checked").each(function() {

                        selected_array.push(this.value);

                    });

                    var allselectedlistings = '';

                    if(selected_array){

                        window.location = mainurl+"generate/exportCSVSelectedColumns?ids="+allselectedlistings+"&selectedArray=" + selected_array;

                    }

             });

             

             $(document.body).on("click", '#downloadPDFtables_div', function() {  

                $("#downloadPDFtables_div").css('display', 'none');

                $("#downloadPDFtables_animation").css('display', 'inline');

            

                setTimeout(function() {  

                    $("#downloadPDFtables_div").css('display', 'inline');

                    $("#downloadPDFtables_animation").css('display', 'none');

                }, 3000);

            });

        

            $(document.body).on("click", '#downloadCSV_div', function() {  

                $("#downloadCSV_div").css('display', 'none');

                $("#downloadCSV_animation").css('display', 'inline');

            

                setTimeout(function() {  

                    $("#downloadCSV_div").css('display', 'inline');

                    $("#downloadCSV_animation").css('display', 'none');

                }, 3000);

            });

        

            $(document.body).on("click", '#downloadPDF_div', function() {  

                $("#downloadPDF_div").css('display', 'none');

                $("#downloadPDF_animation").css('display', 'inline');

            

                setTimeout(function() {  

                    $("#downloadPDF_div").css('display', 'inline');

                    $("#downloadPDF_animation").css('display', 'none');

                }, 5000);

            });		

			

function getUserAndAgentDetails(){

    //for export PDF, we only get the first pdf

    var wid=$('#exportPDFIds').val();

    var idArray=wid.split(",");

	if(idArray[0] < 1) { 

	$('body').trigger('click');

	$('#checkbox_error').show(400); 

	return false;

	}

    $("#my_details").attr('checked','checked')    

    $.getJSON(mainurl+"listings/getUserAndAgentDetails/"+ idArray[0], function(json){ 



        $.each(json, function(key, val) {

            $("#"+key).text(val);

        });

    });

}



function getUserDetails(){

    $("#my_details2").attr('checked','checked');

    var wid=$('#exportPDFIds').val();

	 var idArray=wid.split(",");

	if(idArray[0] < 1) { 

	$('body').trigger('click');

	$('#checkbox_error').show(400); 

	return false;

	}

    $.getJSON(mainurl+"listings/getUserDetails/"+idArray[0], function(json){ 

        $.each(json, function(key, val) {

            $("#"+key+"2").text(val);

        });

    });

}

 function getCheckErrorImage()

 {

	  var wid=$('#exportPDFIds').val();

	 var idArray=wid.split(",");

	if(idArray[0] < 1) { 

	$('body').trigger('click');

	$('#checkbox_error').show(400); 

	return false;

	}

 }

function getUserAndAgentDetailsPoster(){

    //for export PDF, we only get the first pdf

    var wid=$('#exportPosterIds').val();

    var idArray=wid.split(",");

    $("#my_details3").attr('checked','checked')    

    $.getJSON(mainurl+"generate/getUserAndAgentDetails/"+ idArray[0], function(json){ 

    

        $.each(json, function(key, val) {

            $("#"+key+"3").text(val);

        });

    });

}



$(function() {

	$('#checkselectedListings, #checkselectedListingsEmail, #checkselectedListingsEmailhtml').on('click', function(e) {

 

				  var wid=$('#exportPDFIds').val();

					var idArray=wid.split(",");

				  if(idArray[0] < 1) {

					e.stopPropagation();

				  }  

		});

		

		 //Save Search

        $(document.body).on("click", '#savesearch', function() { 

		var searchtitle = $('#savesearch_name').val();

		if(searchtitle == '') 

		{

			alert("Please give a title to your search!");

		  return false;

		}

            //alert($('#savesearch_name').val())

            $.post(mainurl+"listings/savesearch", { 

                1:                      $('#1').val(),

                4:                      $('#4').val(),

                5:                      $('#5').val(),

                6:                      $('#6').val(),

                32:                     $('#32').val(),

                7:                      $('#7').val(),

                8:                      $('#8').val(),

                9:                      $('#9').val(),

                10:                     $('#10').val(),

                minprice:               $('#minprice').val(),

                maxprice:               $('#maxprice').val(),

                minarea :               $('#minarea') .val(),

                maxarea :               $('#maxarea') .val(),

                13:                     $('#13').val(),

                14:                     $('#14').val(),  

                dateupdatedS:           $('#dateupdatedS').val(),

                dateupdatedSto:         $('#dateupdatedSto').val(),

                dateaddedS:             $('#dateaddedS').val(),

                dateaddedSto:           $('#dateaddedSto').val(),

                as_prop_status:         $('#as_prop_status').val(),

                as_source_of_listing:   $('#as_source_of_listing').val(),

                as_unit_type:           $('#as_unit_type').val(),

                as_min_bua:             $('#as_min_bua').val(),

                as_max_bua:             $('#as_max_bua').val(),

                as_min_deposit:         $('#as_min_deposit').val(),

                as_max_deposit:         $('#as_max_deposit').val(),

                as_baths:               $('#as_baths').val(),

                as_view:                $('#as_view').val(),

                as_available_date_from: $('#as_available_date_from').val(),

                as_available_date_to:   $('#as_available_date_to').val(),

                as_floor_no:            $('#as_floor_no').val(),

                as_street_no:           $('#as_street_no').val(),

                as_min_uap:             $('#as_min_uap').val(),

                as_max_uap:             $('#as_max_uap').val(),

                as_min_ps:              $('#as_min_ps').val(),

                as_max_ps:              $('#as_max_ps').val(),

                as_portals_name:        $('#as_portals_name').val(),

                as_freq_search:         $('#as_freq_search').val(),

                as_floor_no:            $('#as_floor_no').val(),

                as_photos:              $('#as_photos').val(),

                as_notes:               $('#as_notes').val(),

                as_temp_ref:            $('#as_temp_ref').val(),

                name:                   $('#savesearch_name').val(),

                as_prop_furnish:        $('#as_prop_furnish').val(),

                as_strno:               $('#strno').val(),

                flcheck:                $('#flcheck').val()

            },

            function(data) {

                $("#search_list").append('<div id="search_entry_'+data+'"><div class="inline-block"><a id="'+data+'" class="savedsearch" href="# Saved Search">'+$('#savesearch_name').val()+'</a></div><div class="inline-block pull-right"><a  id="'+data+'" class="delete_savedsearch redText" href="# Delete Search"><i class="fa fa-times-circle"></i></a></div></div>');

            });

        });

        

        $(document.body).on("click", '.savedsearch', function() {

            $id=$(this).attr('id');

            $.getJSON(mainurl+"listings/savedsearch/"+$id, function(json){ 

                $.each(json, function(key, val) {

                    $('#'+key).val(val);

                    if(key.match('^(0|[1-9][0-9]*)$')){

                        if(val != ' Min 3 chars'){

                            oTable.fnFilter(val, key);

                        }

                    }

                });

                oTable.fnDraw();

            });

            $('#listings_row #reset_filter').css('display', '');

        });

                        //change css of selected row    

        $("body").on("click", "#listings_row tbody tr, .overflow", function(event){         

            if(formDataChange==false){

                $("td.yellowCSS", oTable.fnGetNodes()).removeClass("yellowCSS");

                $('#listings_row tbody #'+$(this).attr('rel')).find("td").addClass("yellowCSS");

                $(event.target).parent().find("td").addClass("yellowCSS");

            }

        });

});



//for Bulk Updates



$("#field_name_bulk").change( function () {

/* Filter on the column (the index) of this element */

    var val = this.value;

    if(val != ''){

            if(val =='beds' || val =='fitted' || val == 'baths' || val == 'category_id' || val == 'prop_furnish' || val == 'frequency' || val == 'cheques'){

                var $options = $("#"+val+" > option").clone();

                $("#content_field").empty().append('<select type="text" class="form-control required" name="'+ val +'_f" id="'+ val +'_f"/></select>'); 

                $('#'+val+'_f').append($options);

            }else if(val == 'portal'){



            $("#content_field").empty().append('<div class="input-group"><span class="input-group-addon"><a rel="#portals_viewings_select_popup" href="# popup" class="modal-link-portals">\n\
<i class="icon-plus-circled"></i></a></span>\n\<input name="portals_count_f" type="text" class="form-control" id="portals_count_f" readonly>\n\<input id="portals_name_f" name="portals_name_f" type="text" readonly value="" style="display:none;">\n\
 <input id="portals_name_arr_f" name="portals_name_arr_f" type="text" readonly value="" style="display:none;"></div>'); 

            }else if(val == 'location'){

                var $options = $("#region_id > option").clone();

                $("#content_field").empty().append('<select type="text" name="region_id_f" class="form-control required" id="region_id_f" style="margin: 5px 0px !important;" /></select>\n\
<select type="text" name="area_location_id_f" class="form-control required" id="area_location_id_f" style="margin: 5px 0px !important;" disabled="disabled" ><option value="" selected="selected">Select</option></select>\n\
<select type="text" name="sub_area_location_id_f" class="form-control" id="sub_area_location_id_f" style="margin: 5px 0px !important;" disabled="disabled" ><option value="" selected="selected">Select</option></select>\n\
 <input id="lat_f" name="lat_f" type="text" readonly value="" style="display:none;"><input id="lon_f" name="lon_f" type="text" readonly value="" style="display:none;">'); 

                $('#region_id_f').append($options);

            }else{

                $("#content_field").empty().append('<input type="text" class="form-control bulk-f required" name="'+ val +'_f" id="'+ val +'_f"/>');

            }

            $("#set_label").empty().append('<span id="value_label">Set Value</span>');   

            $('#update_bulk_form :input').not('.ignoreField').val('').removeAttr('checked').removeAttr('selected');

            if(val == "size" || val == "price" || val == "plot_size"){

                $(".bulk-f").numeric();

            }

            $('.showSetVal').css('display',''); 

    }else{

       $('.showSetVal').css('display','none'); 

     }

} );