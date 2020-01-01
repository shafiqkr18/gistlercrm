<script>
//$('#table_task_popup input' ).css('width','113px');
//$('#table_task_popup select').css('width','120px');
//$('#table_task_popup textarea').css('width','113px');

if(screenname=='listings'){
	$('#multi_listings_ref').css('display','none');
	$('#myForm_event_popup #listing_id').val($('#myForm').find('#id').val());
	$('#myForm_event_popup #listing_ref').val($('#myForm').find('#ref').val());
	$('#popup_record_reference_T').text($('#ref').val());
	
	$('#screen_ref_label').html('Listing Ref');
	$('#myForm_event_popup #listing_ref').css('display', '');
	
	console.log('screen name is listings...');

}
if(screenname=='leads'){
	$('#myForm_event_popup #leads_ref').val($('#myForm').find('#ref').val());
	$('#myForm_event_popup #leads_id').val($('#myForm').find('#id').val());
	$('#popup_record_reference_T').html($('#myForm').find('#ref').val());
	
	$('#screen_ref_label').html('Leads Ref');
	$('#myForm_event_popup #leads_ref').css('display', '');
	
		
	console.log('screen name is leads...');
}

if(screenname=='deals'){
	$('#myForm_event_popup #deals_ref').val($('#myForm').find('#ref').val());
	$('#myForm_event_popup #deals_id').val($('#myForm').find('#id').val());
	$('#popup_record_reference_T').html($('#myForm').find('#ref').val());
	
	$('#screen_ref_label').html('Deals Ref');
	$('#myForm_event_popup #deals_ref').css('display', '');
	
	console.log('screen name is deals...');
}

/* Insert / Update function */
		 $(document).ready(function() {
			$('#myForm_event_popup').ajaxForm({
			  beforeSubmit : function() { 
			  return $("#myForm_event_popup").validate({rules: { price: { number: true, }, size: { number: true
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
	//$('#start_date_full').datetimepicker({
//		changeMonth: true,
//        showButtonPanel: true,
//        changeYear: true,
//		dateFormat: 'yy-mm-dd',
//		showButtonPanel: true,
//		onClose: function(dateText, inst) { 
//			var split_date = dateText.split(' ');
//			 $('#start_date').val(split_date[0]);
//			 $('#start_time').val(split_date[1]); 
//		
//		    datetime = $('#start_date').val().split(' ');
//			date	 = datetime[0].split('-');
//			days     = date[2];
//			month    = date[1];
//			year     = date[0];
//			//alert(date[0]);
//			$( "#end_date_full" ).datepicker( "option", "minDate", year+'-'+month+'-'+days );
//			$( "#end_date" ).val($( "#due_date" ).val()); }
//	});
//	
//	$('#end_date_full').datetimepicker({
//		changeMonth: true,
//        showButtonPanel: true,
//        changeYear: true,
//		dateFormat: 'yy-mm-dd',
//		onClose: function(dateText, inst) { var split_date = dateText.split(' '); $('#end_date').val(split_date[0]); $('#end_time').val(split_date[1]);  }
//	});
});
		  
</script>
<div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Calendar</label>
                     
                        <select name="cal_id" class="form-control input-sm required" id="cal_id">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                       <select name="category" class="form-control input-sm" id="category"> 
			                        <option value="nil" selected>Select</option>
			                        <option value="Viewing">Viewing</option>
			                        <option value="Meeting">Meeting</option>
			                        <option value="Schedule a call">Schedule a call</option>
          						</select>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        
                        <input name="location" type="text" class="form-control input-sm" id="location" value="" tabindex="0"/>
                    </div>
                  </div>
                  
                  <div class="col-md-6"> 
                  
                    <div class="form-group">
                        <label>Title</label>
                     
                        <input name="title" type="text" class="form-control input-sm" id="title2" value="" />
                    </div>
                     
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Date</label>
                        <div class="input-group">
                        <input type="text" class="form-control input-sm datetimepicker" id="start_date_full" name="start_date_full">
                        <input name="start_date" type="text" class="form-control input-sm required" style="display: none;" 
 id="start_date" value="" placeholder="Start Date" />
										<input name="start_time" type="text" class="form-control input-sm"  style="display: none;" id="start_time"
 value="" readonly="readonly" />
                        <div class="input-group-addon">
                        <i class="fa fa-calendar-plus-o"></i>
                        </div>
                        </div>
                        
                     </div>
                    </div>
                    <div class="col-md-6">
                    
                    <div class="form-group">
                         <label>&nbsp;</label>
                         
                         <div class="input-group">
                        <input type="text" class="form-control input-sm datetimepicker" id="end_date_full" name="end_date_full">
                        <input name="end_date" type="text" class="form-control input-sm required" style="display: none;"  id="end_date" value=""  placeholder="End Date" />
						<input name="end_time" type="text" class="form-control input-sm" id="end_time" style="display: none;" value="" readonly="readonly" />
                        <div class="input-group-addon">
                        <i class="fa fa-calendar-plus-o"></i>
                        </div>
                        </div>
                         
                         
                         
                        
                     </div>
                     
                    </div>
                   </div>
                   
                   <div class="row">
                    <div class="col-md-6">
                     <div class="form-group">
                        <label>Reminder</label>
                       <input name="time" type="text" class="form-control input-sm" id="time" value="" />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>&nbsp;</label>
                     
                        <select name="time_unit" class="form-control input-sm" id="time_unit">
						            <option value="nil" selected="selected">Select</option>
						             <option value="minute">Minutes</option>
						             <option value="hour">Hours</option>
						             <option value="day">Days</option>
						             <option value="week">Weeks</option>
						          </select>
                     </div>
                    </div>
                   </div>
                  </div>
                  
                  
                  
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Description</label>
                        
                        <textarea name="description_addevent" id="description_addevent" class="form-control" ></textarea>
                    </div>
                    <div class="form-group">
                        <label>Listing Ref</label>
                        <input name="listing_id" type="text" class="form-control" id="listing_id" value="" style=" display:none;" />
       							<input name="listing_ref" type="text" class="form-control" id="listing_ref" value="" style=" display:none;" readonly="readonly" />
        
						        <input name="deals_id" type="text" class="form-control" id="deals_id" value="" style="display:none;" />
						        <input name="deals_ref" type="text" class="form-control" id="deals_ref" value="" style=" display:none;" readonly="readonly" />
        
						        <input name="leads_id" type="text" class="form-control" id="leads_id" value="" style="display:none;" />
						        <input name="leads_ref" type="text" class="form-control" id="leads_ref" value="" style=" display:none;" readonly="readonly" />
                    </div>
                  </div>
                  
                  
                  </div>