<script>
//$('#table_deal_popup input' )          .css('width','113px');
//$('#table_deal_popup select')          .css('width','120px');

//$('#listings_id').val($('#prop_status option:selected').text());
if(screenname=='listings'){
$('#multi_listings_ref').css('display','none');
$('#myForm_deal_popup #listings_id').val($('#myForm').find('#id').val());
$('#myForm_deal_popup #listings_ref').val($('#myForm').find('#ref').val());
$('#myForm_deal_popup #listings_randkey').val($('#myForm').find('#rand_key').val());
$('#myForm_deal_popup #listings_type').val($('#myForm').find('#category_id option:selected').text());
$('#myForm_deal_popup #listings_category_id').val($('#myForm').find('#category_id option:selected').val());
$('#myForm_deal_popup #listings_unit').val($('#myForm').find('#unit').val());
$('#myForm_deal_popup #listings_unit_type').val($('#myForm').find('#unit_type').val());
$('#myForm_deal_popup #listings_street_no').val($('#myForm').find('#street_no').val());
$('#myForm_deal_popup #listings_floor_no').val($('#myForm').find('#floor_no').val());



if($('#myForm').find('#beds option:selected').text()=='Select'){
	$('#myForm_deal_popup #listings_beds').val('0');
	$('#myForm_deal_popup #listings_beds_text').val('0');
}else{
	$('#myForm_deal_popup #listings_beds_text').val($('#myForm').find('#beds option:selected').text());
	$('#myForm_deal_popup #listings_beds').val($('#myForm').find('#beds option:selected').val());
}

$('#myForm_deal_popup #listings_region_id').val($('#myForm').find('#region_id option:selected').text());
$('#myForm_deal_popup #listings_location').val($('#myForm').find('#area_location_id option:selected').text());
$('#myForm_deal_popup #listings_sub_location').val($('#myForm').find('#sub_area_location_id option:selected').text());

$('#myForm_deal_popup #listings_region_id_val').val($('#myForm').find('#region_id option:selected').val());
$('#myForm_deal_popup #listings_location_val').val($('#myForm').find('#area_location_id option:selected').val());
$('#myForm_deal_popup #listings_sublocation_val').val($('#myForm').find('#sub_area_location_id option:selected').val());


$('#myForm_deal_popup #listings_landlord_name').val($('#myForm').find('#landlord_name').val());
$('#myForm_deal_popup #listings_landlord_id').val($('#myForm').find('#landlord_id').val());
$('#popup_record_reference_D').text($('#myForm').find('#ref').val());
}
if(screenname=='leads'){
$('#add_task_window').html('');
$('#myForm_deal_popup #leads_id')         	  .val($('#myForm').find('#id').val());
$('#myForm_deal_popup #leads_ref')         	  .val($('#myForm').find('#ref').val());
var listing_id  ='';
var listing_ref ='';
$('#myForm_deal_popup #listings_id')          .val(listing_id  = $('#myForm').find('#enquired_for_ref').val());
$('#myForm_deal_popup #listings_ref')         .val(listing_ref = $('#myForm').find('#enquired_for_referance').val());
$('#popup_record_reference_d')			  	  .html($('#myForm').find('#ref').val());

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
}

$(document).ready(function() {
//get agents
agentsOnDemand('agent_id_deal');
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
			$('#myForm_deal_popup').ajaxForm({
			  beforeSubmit : function() { 
			  return $("#myForm_deal_popup").validate({rules: { price: { number: true, }, size: { number: true, }} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) {
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
	$('.datepicker').datetimepicker({
				format: 'YYYY-MM-DD'
			});;
});


//auto complete landlord details
/*$(document).ready(function () {
    $('#landlord_name').autocomplete({
        source: "http://crm.propspace.com/index.php/contracts/autoFindLandlord",
        minLength: 0,
        select: function (event, ui) {
            $('#landlord_id').val(ui.item.id);
        }
    }).focus(function(){
        $(this).val('');
        $(this).keydown();
    });
});*/

//auto complete tenant/user details
$(document).ready(function () {
    $('#leads_ref').autocomplete({
        source: "<?php echo base_url();?>contacts/autoFindLead",
        minLength: 0,
        select: function (event, ui) {
			//alert(ui.item.id);
            $('#leads_id').val(ui.item.id);
        }
    }).focus(function(){
        $(this).val('');
        $(this).keydown();
    });;
});




		  
</script>
<form id="myForm_deal_popup" action="<?php echo base_url();?>listings/adddealsubmit" method="post">
<div class="modal-body">
                 
                   <!--hidden variable-->
                 
                <input type="hidden" id="listings_id" name="listings_id" value="" />
                <input type="hidden" id="listings_randkey" name="listings_randkey" value="" />
                <input type="hidden" id="listings_category_id" name="listings_category_id" value="" />
                <input type="hidden" id="listings_unit" name="listings_unit" value="" />
                <input type="hidden" id="listings_unit_type" name="listings_unit_type" value="" />
                <input type="hidden" id="listings_street_no" name="listings_street_no" value="" />
                <input type="hidden" id="listings_floor_no" name="listings_floor_no" value="" />
               
               
                 
               
               <!-- /*end hidden variable*/-->
                 
                 
                <button type="submit" id="SaveDealPopup" name="SaveDealPopup" class="btn btn-success" value="Save Deal" ><i class="fa fa-check"></i> Save &amp; Close</button>
                <div class="showdata" id="showpopupdata"></div>
                <div class="row">
                <h4 class="add_new_rental">Add New Deal</h4>
                </div>
                
                <div class="row">
                
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Ref</label>
                      <input type="text" class="form-control input-sm" readonly id="ref" name="ref">
                  </div>
                  <div class="form-group">
                      <label>Type</label>
                      <select class="form-control input-sm" id="type" name="type">
                        <option value="" selected>Select</option>
                        <option value="1">Rental</option>
                        <option value="2">Sales</option>
                      </select>
                   </div>
                   <div class="form-group">
                      <label>Lead Ref</label>
                    
                      <input name="leads_ref" type="text" class="form-control input-sm" id="leads_ref">
         				 <input name="leads_id" type="hidden" class="form_fields" id="leads_id" >
                  </div>
                  <div class="form-group">
                      <label>Owner</label>
                      
                        <input name="listings_landlord_name" type="text" class="form-control input-sm" id="listings_landlord_name" readonly="readonly">
         				 <input name="listings_landlord_id" type="hidden" class="form-control input-sm" id="listings_landlord_id">
                  </div>
                  <div class="form-group">
                      <label>Agent</label>
                    <select name="agent_id" class="form-control input-sm" id="agent_id_deal" >
                      </select>
                  
                  </div>
                  <div class="form-group">
                      <label>Listing Ref</label>
                  
                         <input name="listings_ref" type="text" class="form-control input-sm required" id="listings_ref" value="" readonly="readonly">
                          <select name="multi_listings_ref" type="text"  class="form-control input-sm required" id="multi_listings_ref" style="display:none;">
                            <option value="" selected="selected">Select</option>
                          </select>
                  </div>
                  <div class="form-group">
                      <label>Category</label>
                  <input name="listings_type" type="text" class="form-control input-sm" id="listings_type" value="" readonly>
                  </div>
                </div>
                
                
                
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Beds</label>
                      <input name="listings_beds_text" type="text" class="form-control input-sm" id="listings_beds_text" value="" readonly>
                  <input name="listings_beds" type="hidden" class="form-control input-sm" id="listings_beds" value="" >
                  </div>
                  <div class="form-group">
                      <label>Emirate</label>
                      <input type="text" class="form-control input-sm" id="listings_region_id" name="listings_region_id" readonly>
                      <input type="hidden" class="form-control input-sm" id="listings_region_id_val" name="listings_region_id_val">
                  </div>
                  <div class="form-group">
                      <label>Location</label>
                      <input type="text" class="form-control input-sm" id="listings_location" name="listings_location" readonly>
                       <input type="hidden" class="form-control input-sm" id="listings_location_val" name="listings_location_val">
                  </div>
                  <div class="form-group">
                      <label>Sub Location</label>
                      <input type="text" class="form-control input-sm" id="listings_sublocation" name="listings_sublocation" readonly>
                       <input type="hidden" class="form-control input-sm" id="listings_sublocation_val" name="listings_sublocation_val">
                  </div>
                  <div class="form-group">
                      <label>Price (AED)</label>
                      <input type="text" class="form-control input-sm" id="listings_price" name="listings_price">
                  </div>
                  <div class="form-group">
                      <label>Deposit (AED)</label>
                      <input type="text" class="form-control input-sm" id="listings_deposit" name="listings_deposit">
                  </div>
                  <div class="form-group">
                      <label>Commission (AED)</label>
                      <input type="text" class="form-control input-sm" id="listings_commission" name="listings_commission">
                  </div>
                </div>
                
                <div class="col-md-4">
                
                <div class="form-group">
                      <label>Cheques</label>
                      <select class="form-control input-sm" id="listings_cheques" name="listings_cheques">
                      <option value="" selected>Select</option>
            <option value="1">1  &nbsp;&nbsp;Cheque</option>
            <option value="2">2  &nbsp;&nbsp;Cheques</option>
            <option value="3">3  &nbsp;&nbsp;Cheques</option>
            <option value="4">4  &nbsp;&nbsp;Cheques</option>
            <option value="5">5  &nbsp;&nbsp;Cheques</option>
            <option value="6">6  &nbsp;&nbsp;Cheques</option>
            <option value="7">7  &nbsp;&nbsp;Cheques</option>
            <option value="8">8  &nbsp;&nbsp;Cheques</option>
            <option value="9">9  &nbsp;&nbsp;Cheques</option>
            <option value="10">10 Cheques</option>
            <option value="11">11 Cheques</option>
            <option value="12">12 Cheques</option>
            </select>
                </div>
                <div class="form-group">
                       <label>Deal Date</label>
                      <div class="input-group">
                        <input type="text" class="form-control input-sm datepicker" id="rent_start_date" name="rent_start_date">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        </div>
                 </div>
                 <div class="form-group">
                      <label>Notes</label>
                      <input type="text" class="form-control input-sm" id="notes" name="notes">
                  </div>
                   <div class="form-group">
                      <label>Status</label>
                    
                     <select name="status" type="text"  class="form-control input-sm required" id="status" >
            <option value="" selected>Select</option>
            <option value="1">In Progress</option>
            <option value="2">Closed</option>
          </select>
                 </div>
                 <div class="form-group">
                      <label>Sub-Status</label>
                   
                      <select  id="sub_status" class="form-control input-sm" type="text" name="sub_status">
                      <option value="">Select</option>
                      <option value="1">Pending</option>
                      <option value="2">Successful</option>
                      <option value="3">Unsuccessful</option>
                      <option selected="" value="4">Not Specified</option>
                    </select>
                 </div>
                
                </div>
                
                
                </div>
                </div>
</form>                