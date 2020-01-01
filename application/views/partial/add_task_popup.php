<script>
//$('#table_task_popup input' ).css('width','113px');
//$('#table_task_popup select').css('width','120px');
//$('#table_task_popup textarea').css('width','113px');

if(screenname=='listings'){
$('#multi_listings_ref').css('display','none');
$('#myForm_task_popup #listings_id').val($('#myForm').find('#id').val());
$('#myForm_task_popup #listings_ref').val($('#myForm').find('#ref').val());
$('#myForm_task_popup #listings_type').val($('#myForm').find('#category_id option:selected').text());
if($('#myForm').find('#beds option:selected').text()=='Select'){
	$('#myForm_task_popup #listings_beds').val('0');
}else{
	$('#myForm_task_popup #listings_beds').val($('#myForm').find('#beds option:selected').text());
}
$('#myForm_task_popup #listings_location').val($('#myForm').find('#area_location_id option:selected').text());
$('#myForm_task_popup #lead_ref').val($('#myForm').find('#landlord_id option:selected').text());
$('#popup_record_reference_T').text($('#ref').val());

console.log('screen name is listings...');

}
if(screenname=='leads'){
$('#add_deal_window').html('');
$('#myForm_task_popup #lead_ref').val($('#myForm').find('#ref').val());
$('#myForm_task_popup #lead_id').val($('#myForm').find('#id').val());
$('#popup_record_reference_T').html($('#myForm').find('#ref').val());

var listing_id  ='';
var listing_ref ='';
$('#myForm_task_popup #listings_id').val(listing_id  = $('#myForm').find('#enquired_for_ref').val());
$('#myForm_task_popup #listings_ref').val(listing_ref = $('#myForm').find('#enquired_for_referance').val());

if(listing_id==''){
	 	$('#multi_listings_ref').css('display','none');
}


if(listing_id){
		if(listing_id.indexOf(',') == -1){
			//alert('No comma');
			$('#multi_listings_ref').css('display', 'none');
			
			lead_single(listing_id)
			
		}else{
			//alert('Found');
			$('#listings_ref').css('display', 'none');
			var element  = listing_ref.split(",");
			var element2 = listing_id .split(",");
			var count = 0;
				jQuery.each(element2, function(i, val) {
					if(val!=' '){
						$.getJSON("<?php echo base_url();?>listings/single/"+val, function(json){ 
							$('#multi_listings_ref').append('<option value="'+json.id+'">'+json.ref+'</option>');
						});
					}
					count++;
			});
		}
		
	}
	
console.log('screen name is leads...');
}

$(document).ready(function() {
	$("#multi_listings_ref").change( function () {
		//alert();
		$('#listings_id').val($(this).attr('value'));
		lead_single($(this).attr('value'))
		
	});
});


function lead_single(id){
	
	$.getJSON("<?php echo base_url();?>listings/lead_single/"+id, function(json){ 
				$.each(json, function(key, val) {
					$("#"+key).val(val);
				});
	 });
	 
}

/* Insert / Update function */
		 $(document).ready(function() {
			$('#myForm_task_popup').ajaxForm({
			  beforeSubmit : function() { 
			  return $("#myForm_task_popup").validate({rules: { price: { number: true, }, size: { number: true
, }} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) {
						//$(element).attr({"title": error.text('asdasd')});
							
							$('#showpopupdata').animate({ 'color': 'red'}, "slow");
							$('#showpopupdata').fadeIn("slow");
							$('#showpopupdata').html('Please complete all required fields');
							setTimeout(function() {  
								$('#showpopupdata').fadeOut("slow");
								$('#showpopupdata').animate({ 'color': 'red'}, "slow");
						    }, 5000);
							
						//alert('Please fill the required fields')
					}}).form() ;
			  },
			  target: '#showpopupdata',
			  success: function() {
				 
				  SaveAndClode();
				  $('#showpopupdata').animate({ 'color': '#49AC44'}, "slow");
				  $('#showpopupdata').fadeIn("slow");
				   
			  }
			});
		  });

//date and time picker
$(function() {
	    $('.datetimepicker').datetimepicker({
      		  format: 'YYYY-MM-DD hh:mm:ss'
   			 });
   				 //Date Picker
			$('.datepicker').datetimepicker({
				format: 'YYYY-MM-DD'
			});
//	$('#due_date').datepicker({
//		changeMonth: true,
//        showButtonPanel: true,
//        changeYear: true,
//		dateFormat: 'yyyy-mm-dd'
//	});
//	$('#end_date').datepicker({
//		changeMonth: true,
//        showButtonPanel: true,
//        changeYear: true,
//		dateFormat: 'yyyy-mm-dd'
//	});
//	
});
		  
</script>
<form id="myForm_task_popup" action="<?php echo base_url();?>listings/todosubmit" method="post">
<div class="modal-body">
                  <button type="submit" id="SaveTaskPopup"  class="btn btn-success" name="SaveTaskPopup" value="Save Task"><i class="fa fa-check"></i>Save & Close</button>
                  
               
				<div class="showdata" id="showpopupdata"></div>
                  
                
                  <div class="row">
                  <div class="col-md-6">
                  
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control input-sm" required id="title" name="title">
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Ref</label>
                        <input name="id" class="form_fields form-control" id="id" value="0" style="display:none;">
                        <input type="text" class="form-control input-sm" name="ref" id="ref">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Date Added</label>
                        <input type="text" class="form-control input-sm datepicker" id="dateadded" name="dateadded" disabled>
                    </div>
                    </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-md-6">
                    
                    <div class="form-group">
                        <label>Priority</label>
                        
                       <select name="priority" class="form-control input-sm" id="priority">
						            <option value="" selected>Select</option>
						            <option style="background-color: #BEF5B8;" value="3">Low</option>
						            <option style="background-color: #C4CAFF;" value="2">Medium</option>
						            <option style="background-color: #F7BBBC;" value="1">High</option>
						        </select>
                     </div>
                    </div>
                    
                    
                    
                    <div class="col-md-6">
                    
                    <div class="form-group">
                        <label>Due Date</label>
                        
                     <div class="input-group">
                    <input type="text" class="form-control input-sm datetimepicker" id="due_date" name="due_date">
                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                    </div>
                    </div>
                        
                        
                     </div>

                    </div>
                    </div>
                  </div>
                  
                  
                  <div class="col-md-6">
                  
                   <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Created by</label>
                        <input type="text" class="form-control input-sm" id="assigned_by" name="assigned_by" readonly="readonly" disabled="disabled" value="<?php echo $this->session->userdata('username'); ?>">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Notes</label>
                        <input type="text" class="form-control input-sm" id="notes" name="notes">
                    </div>
                    </div>
                   </div>
                   
                   <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Assigned To</label>
                      <select name="assigned_to_id" class="form-control input-sm" id="assigned_to_id_addtask">
							            
							            							         </select>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Listing Ref</label>
                     
                        <input type="text" id="listings_id" class="form-control form_fields_readonly" style="display
:none;" value="" name="listings_id" alt="" />
          						<input type="text" id="listings_ref" class="form-control input-sm" value
="" name="listings_ref" readonly="readonly" />
                    </div>
                    </div>
                   </div>
                   
                   <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="status2">
							            <option value="1" selected>Not yet started</option>
							            <option value="2">In Progress</option>
							            <option value="3">Completed</option>
							        </select>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Lead Ref</label>
                      <input type="text" id="lead_id" style="display:none;" class="form-control form_fields_readonly"
 value="" name="lead_id" alt=""  >
	    						<input type="text" id="lead_ref" class="form-control form_fields_readonly" value="" name="lead_ref"
 alt="" readonly="readonly">
                    </div>
                    </div>
                   </div>
                  </div>
                  </div>
                  
                  
                  </div></form>