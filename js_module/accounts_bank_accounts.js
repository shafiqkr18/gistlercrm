$(document).ready(function() {
    $("input").tooltip();
    $("#initial_amount").numeric();
    formDataChange=false;
    var last_id=0;
	$('#myForm_bank_account input, #myForm_bank_account select, #myForm_bank_account textarea').attr('disabled', 'disabled');
        
    $("#new_bank_account").click(function () {
    	
		$('#edit_bank_account, #update_bank_account, #new_bank_account').css('display', 'none'); 
		$('#Save_bank_account, #cancel_bank_account').css('display', 'inline'); 
		$('#myForm_bank_account input, #myForm_bank_account select, #myForm_bank_account textarea').attr('disabled', false);
		formEnabled=true;
        $("#myForm_bank_account")[ 0 ].reset();
	});
        
    $("#cancel_bank_account").click(function () {
		$('#edit_bank_account, #Save_bank_account, #update_bank_account, #cancel_bank_account').css('display', 'none'); 
		$('#new_bank_account').css('display', 'inline'); 
		$('#myForm_bank_account input, #myForm_bank_account select, #myForm_bank_account textarea').attr('disabled', 'disabled');
		formEnabled=false;
        $("#myForm_bank_account")[ 0 ].reset();
        if(last_id > 0 ){
            getSingleRow_bank(last_id);
        }
	});
        
    $("#edit_bank_account").click(function () {
		$('#edit_bank_account, #Save_bank_account, #new_bank_account, #new_bank_account').css('display', 'none'); 
		$('#update_bank_account, #cancel_bank_account').css('display', 'inline'); 
		$('#myForm_bank_account input, #myForm_bank_account select, #myForm_bank_account textarea').attr('disabled', false);
        $("#initial_amount").attr('readonly', 'readonly');
		formEnabled=true;
	});
		
	$(function() {
		$('#search_dateupdated').datepicker({
			dateFormat: 'dd-mm-yy',
			onClose: function(dateText, inst) { oTable.fnDraw(false); $('#reset_filter').css('display', ''); }
		});
	});
	
	$(function() {
	        $('#search_dateadded').datepicker({
	            dateFormat: 'dd-mm-yy',
	            onClose: function(dateText, inst) { oTable.fnDraw(false); $('#reset_filter').css('display', ''); }
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
        
	$("#reset_filter").click(function () {
	    $("#myForm2")[ 0 ].reset();
	    oTable.fnDraw(false);
	    oTable.fnFilterClear(true);
	    $('#reset_filter').css('display', 'none');
	});

	 $("body").on("click", '#listings_row tbody tr', function() {  
            if($(this).attr('id')!=''){
                if(formDataChange==true){
                    var result=confirm("You have not saved the data, all changes will be lost!");
                }
                if(result==true || formDataChange==false){
                    var id=$(this).attr('id');
                   
					getSingleRow_bank(id);
                }
            }
        });
	
	$('#myForm_bank_account').ajaxForm({
		  beforeSubmit : function() { 
		  return $("#myForm_bank_account").validate({rules: { price: { number: true, }, size: { number: true, }} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) {
		                }}).form() ;
		  },
	      target: '#showdata',
	      success: function() {
	             // fnClickAddRowBank(),
	              formDataChange=false;
	              // if($("#id").val()==0){ 
	                    // $.ajax({
	                            // async: false,
	                            // url: mainurl+'accounts/getlastBankid/',
	                            // success: function(data) {
	                                  // last_id=data;
	                            // }
	                         // });
                	// }
	              $('#cancel_bank_account').trigger('click');
	              $("#myForm_bank_account")[ 0 ].reset();
	              $('#showdata').animate({ 'color': '#49AC44'}, "slow"),
				  $('#showdata').fadeIn("slow"),
				   setTimeout(function() {  
					   $('#showdata').fadeOut("slow");
				   }, 3000);
              }
    });
	
});


function getSingleRow_bank(id){
    $('#update_bank_account, #Save_bank_account, #cancel_bank_account, #new_bank_account').css('display', 'none'); 
    $('#edit_bank_account, #new_bank_account').css('display', 'inline'); 
    $('#myForm_bank_account input, #myForm_bank_account select, #myForm_bank_account textarea').attr('disabled', 'disabled');
    
    $.getJSON(mainurl+"accounts/single_bank_account/"+id, function(json){ 
             $.each(json, function(key, val) {
                    $("#myForm_bank_account #"+key).val(val);
                    if(json.isDefault == 1){
                        $("#myForm_bank_account #isDefault").attr('checked', 'checked');
                        $("#myForm_bank_account #isDefault").val(1);
                    }
                    else{
                        $("#myForm_bank_account #isDefault").attr('checked', false);
                        $("#myForm_bank_account #isDefault").val(1);
                    }
             });
             last_id = json.id;
    }); //End json 
}

function fnClickAddRowBank() {
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
            ''
    ]);
}