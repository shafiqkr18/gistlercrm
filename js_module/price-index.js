$(document).ready(function() {

    $(".box_1").remove();

    $(".msginfo-box").css('display', '');



    $("#type_price_index").val( type);

    jQuery('#stid').change(function() {

        var value = jQuery(this).val();

        var snum_dropdown = '';



        snum_dropdown += '<option value="" selected="selected">Select Location</option>';

        $.each(location_json_array[value], function(key, val) {

            snum_dropdown += '<option value="' + key * 1 + '" >' + val + '</option>';

        });



        jQuery('#locid').html(snum_dropdown);

        jQuery('#snum_id').val('');

    });



    jQuery('#locid').change(function() {

        var value         = jQuery(this).val();

        var snum_dropdown = '';



        snum_dropdown += '<option value="" selected="selected">Select Sub-Location</option>';



        if (sub_location_json_array[value]) {

            $.each(sub_location_json_array[value], function(key, val) {

                snum_dropdown += '<option value="' + key * 1 + '" >' + val + '</option>';

            });

        }



        jQuery('#snum_id').html(snum_dropdown);

        //if the location is changed set the coordinates of the new location

        //area_location_id is triggered by js to differentiate between js trigger and user trigger	

    });



    jQuery('#snum_id').change(function() {

        var value = jQuery(this).val();
      
          
          try {
              oTable.fnFilter(value, 3);
            } catch (e) {

            }


    });



    var array_inputs = {

        'stid': '1',

        'locid': '2',

        'snum_id': '3',

        'cid': '4',

        'beds': '5'

    };

    var oTable = $('#listings_row').dataTable({

        "bSortClasses": false,

        "bProcessing": true,

        "sDom": 'R<>rt<ilp><"clear">',

        // "fnDrawCallback": function(oSettings) {

            // if (search_done == true) {

//             	

                // var id = '';

                // if ($("#listings_row tbody tr:first").attr('id') != undefined) {

                    // id = $("#listings_row tbody tr:first").attr('id');

                    // $('#listings_row #' + id + ' td').addClass('yellowCSS');

                    // getSingleRow(id, title);

                // } else {

                    // $(".box_1").remove();

                    // $(".msginfo-box").css("display", "");

                    // $(".msginfo-box").html("<span style='color:red'> Invalid search criteria / Market Price not found</span>");

                // }

            // }

        // },

         "aoColumnDefs": [ 

                {

                       'render': function (data, type, full, meta){

                        //check the main check box

                        $('#check_all_checkboxes').attr('checked', false);

                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';

                    },

                    "aTargets": [ 0 ]

                },

			{

                "bSortable": false,

                "aTargets": [0, 6]

            }, 

           

            ],

       

        "aoColumns": [{

                "mDataProp": "id"

            }, {

                "mDataProp": "stid"

            }, {

                "mDataProp": "locid"

            }, {

                "mDataProp": "snum_id"

            }, {

                "mDataProp": "cid"

            }, {

                "mDataProp": "beds"

            }, {

                "mDataProp": "price_index"

            },



        ],



        "aaSorting": [

            [2, 'asc'],

            [3, 'asc']

        ],

        "iDisplayLength": 25,

        "bServerSide": true,

        "sAjaxSource": config.baseUrl + "listings/datatable_price_index?type="+ type +"&ts=" + Math.round((new Date()).getTime() / 1000),

        "iDisplayStart": 0,

        "sPaginationType": "full_numbers",

        "rowCallback": function( row, data ) {

				 $(row).attr("id",data.id);

				  return row;

				 },

         'fnServerData': function (url, data, callback){ 

            if (search_done == true) {

            	

                $.each($('#priceIndexForm select'), function() {

                    var as_field_name1 = this.id;

                    var as_field_name = this.id;

                   // alert(as_field_name1+'--'+$('#'+as_field_name).val());

                    as_field_name = array_inputs[as_field_name];

                    var as_field_value = $('#' + as_field_name1).val();



                    if ((as_field_name == '2' || as_field_name == '3') && (($('#' + as_field_name1).val() != '0') || ($('#' + as_field_name1).val() != ''))) {



                        if (((as_field_name == '3') || (as_field_name == '2')) && ($('#' + as_field_name1).val() === '')) {

                            as_field_value = "";

                        } else {

                            //  alert(as_field_name+'---- val not null ');

                            as_field_value = $('#' + as_field_name1 + ' option:selected').text();

                        }



                    }

                	console.log(as_field_value);

                    if (as_field_value != '' && as_field_value != ' Min 3 chars' && as_field_value != 0) {

                        //  alert("name sSearch_"+as_field_name+"value"+ as_field_value);

                        var dt = "sSearch_" + as_field_name;

                        data.dt = as_field_value;

                    }



                });

            }

             $.ajax

              ({

                           "dataType": 'json', 

                           "type": "POST", 

                           "url": url, 

                           "data": data, 

                           "success": function(json) {

                           

                               callback(json);

                            



                       }

                       });



        }



    });







    $(document.body).on("click", "#listings_row  .sorting", function(event) {

        oTable.fnFilter($(this).attr('value'), $(this).attr('id_search'));

        $('#' + $(this).attr('id_search') + ' img').attr('src', $(this).attr('image'));

        $('#listings_row #1').val($(this).attr('value'));

        $('#listings_row #reset_filter').css('display', '');

    });







    $("#searchbox input").focus(function() {

        if (this.id == 2) {

            //check if it has default value, if so clear so user can input own value

            if (this.value == " Min 3 chars") {

                //alert ('value is min 3 chars, so clearing');

                $(this).css("color", "");

                $(this).css("font-family", "");

                $(this).css("font-size", "");



                this.value = "";

            }



        }

    });





    $("#searchbox input").focusout(function() {

        // alert ('out of focus of searchbox -id:' + this.id + ' - value:'+this.value);          

        if ((this.id == 2) && this.value == '') {

            //alert ('changing value');

            this.value = ' Min 3 chars';

            $(this).css("color", "grey");

            $(this).css("font-family", "arial");

            $(this).css("font-size", "11px");

        }



    });

    $("#listings_row thead input").keyup(function() {

        $("#priceIndexForm")[0].reset();

        $(".box_1").remove();

        $(".msginfo-box").css('display', '');

        search_done = false;

        /* Filter on the column (the index) of this element */

        if (this.value.length < 3 && this.value.length > 0 && (this.id == 2)) {

            return false;

        }



        oTable.fnFilter(this.value, $(this).attr('id'));

        $('#listings_row #reset_filter').css('display', '');

    });



    $("#listings_row thead select").change(function() {

        $("#priceIndexForm")[0].reset();

        $(".box_1").remove();

        $(".msginfo-box").css('display', '');

        search_done = false;

        /* Filter on the column (the index) of this element */

        oTable.fnFilter(this.value, $(this).attr('id'));

        $('#listings_row #reset_filter').css('display', '');

    });





    $("#reset_filter").click(function() {

        $("#myForm2")[0].reset();

        $("#priceIndexForm")[0].reset();

        oTable.fnDraw(false);

        oTable.fnFilterClear(true);

        $("#listings_row .click img").attr("src", config.baseUrl + "mydata/images/arrow.png?ts=10");

        $('#reset_filter').css('display', 'none');

        $(".box_1").remove();

        $(".msginfo-box").css('display', '');

        $(".msginfo-box").html("Price Index Information will be displayed here");

        search_done = false;

    });

    //change css of selected row	

    $(document.body).on("click", "#listings_row tbody tr, .overflow", function(event) {

        //alert($(this).attr('id'));



        $("td.yellowCSS", oTable.fnGetNodes()).removeClass("yellowCSS");

        $('#listings_row tbody #'+$(this).attr('rel')).find("td").addClass("yellowCSS");

        $(event.target).parent().find("td").addClass("yellowCSS");

        $('.sorting_1').css('background-color', '');



    });



    $(document.body).on("click", '#listings_row tbody tr', function() {

        if ($(this).attr('id') != '') {

            var id = $(this).attr('id');

            getSingleRow(id, title);

        }

    }); //End click

    //end search functions



    var last_id = '';

    var count = 0;



    function getSingleRow(id, type) {

        search_done = false;

        var ts = Math.round((new Date()).getTime() / 1000);



        if (type == undefined) {

            type = 'Rent';

        }



        $.getJSON(config.baseUrl + "listings/single_priceindex/" + id + "/" + type + "/?ts=" + ts, function(json) {

            $(".box_1").remove();

            $.each(json, function(key, val) {

                $("#" + key).val(val);

            });



            // if json has a location value and a region value, we need to get the list of locations for the region and pre-select the list to the returned value location value

            if (json.locid != 0 && json.stid != '') {

                $('#stid').trigger('change');

                $('#locid').val(json.locid);

            }

            if (json.snum_id != 0 || json.locid != 0) {

                $('#locid').trigger('change');

                $('#snum_id').val(json.snum_id);



            }



            //                for the box element 

            var bed = '';

            var category = '';

            var loc = '';

            var subloc = '';

            var priceIndexwithoutSubLoc = '';

            var priceIndexwithSubLoc = '';

            var msg1 = '';

            var msg2 = '';

           

            if (($("#beds").val() == '0.5') || ($("#beds").val() == '0')) {

                bed = ' studio';

            } else if ($("#beds").val() == '1') {

                bed = parseInt($("#beds").val()) + ' bedroom';

            } else {

                bed = parseInt($("#beds").val()) + ' bedroom';

            }



            category = $("#cid option[value='" + json.cid + "']").text();

            loc = $("#locid option[value='" + json.locid + "']").text();



            priceIndexwithoutSubLoc = 'The Price Index for a ' + bed + ' ' + category.toLowerCase() + ' in ' + loc + ' is';



            if (json.locid != 0) {

                msg2 = '<div class="box_1 form-group" style="margin-top: 2%;"><p class="msginfo-box1">' + priceIndexwithoutSubLoc + '</p><span class="result-box btn btn-success btn-block"> AED <span>' + json.final_low_loc + ' <span>to</span> AED ' + json.final_high_loc + ' </span></span></div>';



            }

            //                END for the box element





            if (json.snum_id != 0) {

                subloc = $("#snum_id option[value='" + json.snum_id + "']").text();

                priceIndexwithSubLoc = 'The Price Index for a ' + bed + ' ' + category.toLowerCase() + ' in ' + subloc + ' is';

                msg1 = '<div class="box_1 form-group" style="margin-top: 1%;"><p class="msginfo-box1">' + priceIndexwithSubLoc + '</p><span class="result-box btn btn-success btn-block"> AED <span>' + json.final_low + ' <span>to</span> AED ' + json.final_high + ' </span></span></div>';

            } else {

                msg2 = '<div class="box_1 form-group" style="margin-top: 2%;"><p class="msginfo-box1">' + priceIndexwithoutSubLoc + '</p><span class="result-box btn btn-success btn-block"> AED <span>' + json.final_low + ' <span>to</span> AED ' + json.final_high + ' </span></span></div>';

            }



            $(".msginfo-box").css('display', 'none');

            $('.section-two').append(msg1 + ' ' + msg2);



        });

        //End json

    }



    $("#get_priceIndex").click(function() {

        search_done = true;

        //alert($("#snum_id").val())
       // oTable.fnFilter($("#snum_id").val(), '3');

        $("#myForm2")[0].reset();



        var validate = false;



        validate = $("#priceIndexForm").validate({

            rules: {

                price: {

                    number: true

                },

                size: {

                    number: true

                }

            },

            errorClass: 'form_fields_error',

            errorPlacement: function(error, element) {},

            submitHandler: function() {

                //submit the form

                return false; //don't let the page refresh on submit.

            }

        }).form();

        if (validate) {

        	

            oTable.fnFilterClear(true);

            oTable.fnDraw();

            $('#reset_filter').css('display', '');



        } else {

            return false;



        }



    })

});