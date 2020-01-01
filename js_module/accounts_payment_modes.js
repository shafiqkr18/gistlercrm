
var screenname = 'manage_dropdowns';
 $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
	formDataChange=false;
	
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
}
jQuery(document).ready(function() {
		$("#new").click(function() {
		    	$('#save').show();
		         $('#save').prop('disabled', false);	
		         
		         $("#myForm")[ 0 ].reset();
		    });
     });
//datatable initilization
        
jQuery(document).ready(function() {

	var oTable = $('#listings_row').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"sDom": 'R<>rt<ilp><"clear">',
					"bRegex": true,
					"sAjaxSource": mainurl+"accounts/datatable_paymentmodes",
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
					//"aaSorting" : [[ 10, 'desc' ]],
					"iDisplayStart": 0,
					"sPaginationType": "full_numbers",
					"oLanguage": {
					"sSearch": "Search all columns:"
					},
					"aoColumns": [
					{ "mDataProp": "id" },
		            { "mDataProp": "dropdown_name" },
					{ "mDataProp": "option_title" },
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
				
				} );
	/* Start Date search */					

	/* End Date search */
	

	
	 		
	$("thead input").keyup( function () {
		/* Filter on the column (the index) of this element */
		oTable.fnFilter( this.value, $(this).attr('id') );
		$('#reset_filter').css('display', '');
		
	} );
	
	$("thead select").change( function () {
		/* Filter on the column (the index) of this element */
		oTable.fnFilter( this.value, $(this).attr('id') );
		$('#reset_filter').css('display', '');
		
	} );
	
	//reset filter and drawtable
	$("#reset_filter").click(function () {
                        notification_id = '';
			sortActivities = false; 
			$("#myForm2")[ 0 ].reset();
			$('#dueactivitiesbuttonvalue').val('false');
			oTable.fnDraw(false);
                        oTable.fnFilterClear(true);
			
			$('#reset_filter').css('display', 'none');
			
	});


//change css of selected row	
	$("#listings_row tbody tr").live("click", function(event){
	if(formDataChange==false){
	  $("td.yellowCSS", oTable.fnGetNodes()).removeClass('yellowCSS');
	  $(event.target).parent().find("td").addClass('yellowCSS');
	}
	});
			
	
// check box delete

	$('.dbstatus').live("click", function() {   
		
	if($('#listings_row input').is(':checked')){
            
	 }
	 else {
	 	$('#checkbox_error').show(400);
		//alert('Please check atleast one entry!');
	 }
     });
	 
	disable_popup();
	
} );




/* Insert / Update function */
		 jQuery(document).ready(function() {
			$('#myForm').ajaxForm({
			  beforeSubmit : function() { 
			  return $("#myForm").validate({rules: { price: { number: true, }, size: { number: true, }} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) {
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
			  },
			  target: '#showdata',
			  success: function() {
				  //fnClickAddRow(),
				  formDataChange=false;
				  // if($("#id").val()==0){ 
					  // $.ajax({
						  // async: false,
						  // url: mainurl+'todo/getlastid/',
						  // success: function(data) {
						     // last_id=data;
						  // }
						// })
				  // }
				  $("#cancel").click(),
				 // $('#calendar').fullCalendar( 'refetchEvents' );
				  $('#showdata').animate({ 'color': '#49AC44'}, "slow"),
				  $('#showdata').fadeIn("slow"),
				   setTimeout(function() {  
					   $('#showdata').fadeOut("slow")
				   }, 5000);
			  }
			});
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
							
							
				 ] );
	
	
}
//end update

/* Fetch single item details */	
var last_id = '';
function getSingleRow(id){	
    $('#update, #Save, #cancel').css('display', 'none');
    $('#new').css('display', 'inline');
    $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
    animate_the_form_table_on_click();

    $.getJSON(mainurl+"accounts/singlePayment/"+id, function(json){ 
    $.each(json, function(key, val) {
            $("#"+key).val(val);
     }); 

    $('#screen_name').val($("#dropdown_name :selected").closest('optgroup').attr('label'));
    var color;
    var message;
    if(json.client_id == 0){
        $('#edit').css('display', 'none');
        message = "You cannot edit built-in options";
        color = '#B20000';
     }else{
        $('#edit').css('display', 'inline');
        message = "Record Selected";
     }
     
    $('#showdata').css('color','#49AC44');
    $('#showdata').fadeIn("slow");

    last_id = json.id;

    $('#showdata').css('color',color);
    $('#showdata').html(message)
    $('#showdata').fadeIn("slow");
       setTimeout(function() {  
               $('#showdata').fadeOut("slow");
       }, 5000);

}); //End json 
						
						formDataChange = false;
}
			
				$('#listings_row tbody tr').live("click", function() {  
				
					if(formDataChange==true){
						var result=confirm("You have not saved the data, all changes will be lost!")
					}
				
					if(result==true || formDataChange==false){
						 var id=$(this).attr('id');
						 getSingleRow(id);
					}
				}); //End click 
		
//rand actions				
jQuery(document).ready(function(){
			$("input").tooltip();
			$('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
			formDataChange=false;
			$("#size").numeric();
			$("#price").numeric();
			
			$("#price").keyup( function () {
				$('#frequency').attr('required','required');
			} );
                        
                        
                        $("#dropdown_name").change( function () {
                              var selected = $(':selected', this);
                              $('#screen_name').val(selected.closest('optgroup').attr('label'));
                              $('#screen').val(selected.closest('optgroup').attr('screen'));
                               
                        } );
				
			
});