var screenname = 'manage_account_types';

var oTable;

 

/* Check for value change in form */

var formDataChange = false;

	$("#myForm").live('change',function (event)

	{

	   formDataChange = true;

	});

	

window.onbeforeunload = function() { 

  if (formDataChange) {

    return 'Data not saved!';

  }

};



$(document).ready(function() {

	$("input").tooltip();

	

	oTable = $('#listings_row').dataTable( {

                        "bProcessing": true,

                        "bServerSide": true,

                        "sDom": 'R<>rt<ilp><"clear">',

                        "bRegex": true,

                        "sAjaxSource": mainurl+"accounts/datatable_transaction_categories",

                        "aoColumnDefs": [ 

						{

							 'render': function (data, type, full, meta){

                        //check the main check box

                        $('#check_all_checkboxes').attr('checked', false);

                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';

                    },

							"aTargets": [ 0 ]

						},

						{ "bSortable": false, "aTargets": [ 0 ] }

                        //  {"bVisible": false, "aTargets": [1]}

					],

                        "aaSorting" : [[ 5, 'desc' ]],

                        "iDisplayStart": 0,

                        "sPaginationType": "full_numbers",

                        "oLanguage": {

                        "sSearch": "Search all columns:"

                        },

						"aoColumns": [

					{ "mDataProp": "id" },

		            { "mDataProp": "title" },

					{ "mDataProp": "transaction" },

					{"mDataProp":"parent_id"},

					{ "mDataProp": "dateadded" },

					{ "mDataProp": "dateupdated" },

					],

                        "rowCallback": function( row, data ) {

					 $(row).attr("id",data.id);

				  	return row;

				 	},

					 'fnServerData': function (url, data, callback){ 

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

    

	$('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');

	formDataChange=false;

	

    $("#edit").click(function() {

       $("#transaction").attr('disabled', 'disabled');

       $("#parent_id").attr('disabled', 'disabled');

    });

    

    $("#new").click(function() {

    	

         $("#Save").attr('disabled', 'disabled');

         $('.category-selection').css('display','block');

         $('.category-form').css('display','none');

         $("#myForm")[ 0 ].reset();

    });

    

    $("#cancel").click(function() {

         $('.category-selection').css('display','none');

         $('.category-form').css('display','block');
         //$("#Save").attr('disabled', 'disabled');
         alert('da');

    });

    

    $("#myForm input[name='category-selection']").click(function(){

        $('.category-selection').css('display','none');

        $('.category-form').css('display','block');

        if($('input:radio[name=category-selection]:checked').val() === "category"){

            //Added category title to show on form selection

            $('#category-title').html('Category Name');

            $('.parent_category').css('display','none');

        }else if($('input:radio[name=category-selection]:checked').val() === "sub-category"){

            $('#category-title').html('Sub Category Name');

            $('.parent_category').css('display','block');

        }

        if(!$("#parent_id").hasClass('form_fields_error')){

            $("#parent_id").addClass('form_fields_error');

        }

        $("#Save").removeAttr('disabled');

    });

   	

	$(function() {

		$('#due_dateS').datepicker({

			dateFormat: 'dd-mm-yy',

			onClose: function(dateText, inst) { oTable.fnDraw(false); $('#reset_filter').css('display', ''); }

		});

	});

	

	$(function() {

		$('#end_dateS').datepicker({

			dateFormat: 'dd-mm-yy',

			onClose: function(dateText, inst) { oTable.fnDraw(false); $('#reset_filter').css('display', ''); }

		});

	});

	/* End Date search */

	$("#transaction").change(function(e){

            $('#parent_id').html('');

            $('<option value>Select Parent</option>').appendTo($('#parent_id'));

            $('<option value=0>None</option>').appendTo($('#parent_id'));

            $.each(typesData[$(this).val()], function(k, v){

                $('<option></option>').val(k).text(v).appendTo($('#parent_id'));

            });

        });

		

	$("thead input").keyup( function () {

		/* Filter on the column (the index) of this element */

		oTable.fnFilter( this.value, $(this).attr('id') );

		$('#reset_filter').css('display', '');

	});

	

	$("thead select").change( function () {

		/* Filter on the column (the index) of this element */

		oTable.fnFilter( this.value, $(this).attr('id') );

		$('#reset_filter').css('display', '');

	});

	

	//reset filter and drawtable

	$("#reset_filter").click(function () {

            $("#myForm2")[ 0 ].reset();

            oTable.fnDraw(false);

            oTable.fnFilterClear(true);

            $('#reset_filter').css('display', 'none');

	});

	

	$('#myForm').ajaxForm({

			  beforeSubmit : function() { 

			  return $("#myForm").validate({errorClass: 'form_fields_error',  errorPlacement: function(error, element) {

							$('#showdata').animate({ 'color': 'red'}, "slow");

							$('#showdata').fadeIn("slow");

							$('#showdata').html('Please complete all required fields');

							setTimeout(function() {  

								$('#showdata').fadeOut("slow");

								$('#showdata').animate({ 'color': 'red'}, "slow");

						    }, 5000);

					}}).form() ;

			  },

			  target: '#showdata',

			  success: function(returnMessage) {

                  	if(returnMessage != "Unique Error"){

                       // fnClickAddRow(),

                        formDataChange=false;

                        if($("#id").val()==0){ 

	                          // $.ajax({

	                                  // async: false,

	                                  // url: mainurl+'accounts/getLastTypeId/',

	                                  // success: function(data) {

	                                     // last_id=data;

	                                  // }

	                           // });

                        }

                        $("#myForm")[ 0 ].reset(),

                        $('#showdata').html(returnMessage),

                        $('#showdata').animate({ 'color': '#49AC44'}, "slow"),

                        $('#showdata').fadeIn("slow"),

                        setTimeout(function() {  

                                 $('#showdata').fadeOut("slow");

                         }, 2000),

                        $("#cancel").click();

                      }else{

                        $('#showdata').html('');

                        alert('Another category with same name "'+$.trim($('input#title').val())+'" already exists!');

                      }

			  }

	});



});



$("body").on("click", "#listings_row tbody tr", function(event){

	if(formDataChange==false){

		$("td.yellowCSS", oTable.fnGetNodes()).removeClass('yellowCSS');

		$(event.target).parent().find("td").addClass('yellowCSS');

	}

});



$("body").on("click", "#listings_row tbody tr", function(event){ 

    if(formDataChange==true){

      	var result=confirm("You have not saved the data, all changes will be lost!");

    }

    if(result==true || formDataChange==false){

        var id=$(this).attr('id');

        getSingleRow(id);

    }

});



function fnClickAddRow() {

	$('#listings_row').dataTable().fnDraw();

}



function getSingleRow(id){	

    $('#update, #Save, #cancel').css('display', 'none');

    $('#new').css('display', 'inline');

    $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');

    animate_the_form_table_on_click();



    $.getJSON(mainurl+"accounts/singleTransaction/"+id, function(json){ 

	    $.each(json, function(key, val) {

	            $("#"+key).val(val);

	     });

     

	     $('.category-selection').css('display','none');

	     $('.category-form').css('display','block');



	     if(json.parent_id == 0){

	        $('.parent_category').css('display','none');

	        $('#category-title').html('Category Name');

	        $('#edit').html('Edit Category');

	     }else{

	        $('.parent_category').css('display','block');

	        $('#category-title').html('Sub Category Name');

	        $('#edit').html('Edit Sub Category');

	     }

     

	     var message = '';

	     var color = '#49AC44';

     

	     if(json.user_id == 0){

	        $('#edit').css('display', 'none');

	        message = "You cannot edit built-in options";

	        color = '#B20000';

	     }else{

	        $('#edit').css('display', 'inline');

	        message = "Record Selected";

	     }



	    last_id = json.id;

	

	    $('#showdata').css('color',color);

	    $('#showdata').html(message);

	    $('#showdata').fadeIn("slow");

	       setTimeout(function() {  

	               $('#showdata').fadeOut("slow");

	       }, 2000);

	    }); //End json 



	    formDataChange = false;

}

