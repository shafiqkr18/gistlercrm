<script type="text/javascript">

function getNotesListing()
{
	 $.post(mainurl+"terminals/getNotes", { 
				id:  $('#viewing_listing_id').val()
				},
				function(data) {
				$("#viewing_notesList").html('');
				$("#viewing_notesList").html(data);
			});
}
var oTable_viewings;
//disbaled
$('#myForm_viewings input, #myForm_viewings select').attr('disabled', 'disabled');
$("#myForm_viewings a").attr('class','');
$("#terminal_listing_ref").html('');
$('#frm_general terminal_notes').attr('disabled', 'disabled');
 $("#terminal_notes").attr("disabled","disabled"); 


/* edit / new / cancel */
$("#new_viewing").click(function () {
	
	$("#myForm_viewings")[ 0 ].reset();
	$('#myForm_viewings input, #myForm_viewings select').prop("disabled", false);
	$("#myForm_viewings #save_viewing, #myForm_viewings #cancel_viewing").css('display', '');
	$("#myForm_viewings #new_viewing, #myForm_viewings #edit_viewing").css('display', 'none');
	$("#myForm_viewings #new_viewing, #myForm_viewings #edit_viewing").attr('href','#?w=500');
	$("#myForm_viewings a").attr('class','modal-link-leads');
});

$("#cancel_viewing").click(function () {
	$("#myForm_viewings")[ 0 ].reset();
	$('#myForm_viewings input, #myForm_viewings select').attr('disabled', 'disabled');
	$('#myForm_viewings input, #myForm_viewings select').removeClass('form_fields_error');
	$("#myForm_viewings #new_viewing").css('display', '');
	$("#myForm_viewings #save_viewing, #myForm_viewings #edit_viewing, #myForm_viewings #update_viewing, #myForm_viewings #cancel_viewing").css('display', 'none');
	$("#myForm_viewings a").attr('class','');
	
});

$("#edit_viewing").click(function () {
	$('#myForm_viewings input, #myForm_viewings select').attr('disabled', '');
	$("#myForm_viewings #update_viewing, #myForm_viewings #cancel_viewing").css('display', '');
	$("#myForm_viewings #new_viewing, #myForm_viewings #edit_viewing").css('display', 'none');
	$("#myForm_viewings a").attr('class','modal-link-leads');
});
$(function() {
 $('.datepicker').datetimepicker({
format: 'yy-mm-dd'
});
	
	$("input, .info ,img").tooltip({
				extraClass: "tooltip",
				showURL: false, 
	});
	//get agents
 $.getJSON(config.siteUrl+'common/getAgents', function(data){
  //check for agents
  if(config.user.user_access==3)
  {
     var len = data.length;
    for (var i = 0; i< len; i++) {
	
	   if(admid == data[i].id)
	{
        html = '<option selected="" value="' + data[i].id + '">' + data[i].name + '</option>';
   }else{
        html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
		}
    }
  }else{
    var html = "<option  value=''>Select Agent</option>";
    var len = data.length;
    for (var i = 0; i< len; i++) {
	html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
	
    }
}
	$('#viewing_agent_id').append(html);
	$('#viewing_req_agent_id').append(html);

	$('.selectpicker').selectpicker('refresh');
});

//viewing leads popup
			$("#span_view_lead").click(function () {
		
			$.post(mainurl+"terminals/view_lead_popup", { 
				id:  $('#viewing_listing_id').val()
				},
				function(data) {
				$("#view_lead_viewings").html(data);
			});
			})
});
/* update ccode */
jQuery(document).ready(function() {
			$('#myForm_viewings').ajaxForm({
			//alert($("#id").val());
			  beforeSubmit : function() { 
			  return $("#myForm_viewings").validate({rules: { price: { number: true, }, size: { number: true, }} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) {
						 	
					}}).form() ;
			  },
			  target: '#showdata',
			  success: function() {
			
				//  fnClickAddRow(),
				  formDataChange=false;
				//  if($("#id").val()==0){ 
//					  $.ajax({
//						  async: false,
//						  url: 'viewing_lastid.php',
//						  success: function(data) {
//						  //alert(data);
//						  last_id=data;
//						 // $('#id').val(last_id);
//						  }
//						})
//				  }

				  $("#cancel_viewing").click(),
				  $('#showdata').animate({ 'color': '#49AC44'}, "slow"),
				  $('#showdata').fadeIn("slow"),
				   setTimeout(function() {  
					   $('#showdata').fadeOut("slow")
				   }, 5000);
			  }
			});
		  });
		  $(document).ready(function() {
	 		oTable_viewings = $('#dataTables-viewing_rentals').dataTable({
		 "bProcessing": true,
            "bServerSide": true,
            "sDom": 'R<>rt<ilp><"clear">',
			"pageLength": 5,
                  'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
		 'render': function (data, type, full, meta){
		return '<div id="item_action"><input type="radio" name="select_landlord" style="opacity:1;" id="checkbox_'+ data +'" value="'+ data +'"></div>';
         }
      }],

			
		"columns": [
			{ "data": "id" },
			{ "data": "starttime" },{ "data": "viewing_agent_id" },
			{ "data": "viewing_landlord"},{ "data": "viewing_lead_ref" },{ "data": "viewing_status" },{ "data": "viewing_req_agent_id" },{ "data": "viewing_notes" }
			],
		"bServerSide": true,
		 "sAjaxSource": config.siteUrl+"terminals/datatable_viewing/",
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "iDisplayStart ":0,
              
       
                'fnServerData': function(sSource, aoData, fnCallback)
            {
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
              });
			
            }
	});

		  });
		  $(function(){
			  
			 getNotesListing();
			  
			  
	
		$("#save_notes").click(function() {
	
	 var parameters = $("#frm_general").serialize();
var form = $("#frm_general");
    $.post('<?php echo base_url() ?>index.php/terminals/save_notes', parameters, function(data) {
        if (data.status == true) {
            //show success message
			$('#cancel_notes').click();
			$('.error', form).remove(); 
			$("#msg_sucess").show();
			getNotesListing();
            setTimeout(function() { $("#msg_sucess").hide(); }, 5000);
        }else{
			$('.error', form).remove(); 
            $.each(data.errors, function(key, val) {
                $('[name="'+ key +'"]', form).after(val);
				
            })
        }
    }, "json");
});
});
</script>
<div class="modal-dialog modal-lg">

                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Listing Terminal</h4>
                    <p>View or add viewings, notes and other important information about this listing </p>
                  </div>
                  
                  <div class="modal-body">
                  
                  <div class="pull-right">
                       <span class="text-success"><strong>Listings Ref:</strong> <span id='terminal_listing_ref'></span></span>
                       <span class="text-success"><strong>Total Viewings:</strong> <span id='terminal_viewing_count'></span></span>
                   </div>
                  
                  <div id="inner_tab">
                    <div class="inner_tab_nav">
                        <ul class="nav nav-tabs">
                            <li  class="active"><a href="#viewing_viewing" data-toggle="tab">Viewing</a></li>
                            <li><a href="#notes_terminal" data-toggle="tab">Notes</a></li>
                            <li><a href="#viewing_contact_history" data-toggle="tab">Contact History</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="viewing_viewing">
                        <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-viewing_rentals">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Date and Time</th>
                                            <th>Agent </th>
                                            <th>Client</th>
                                            <th>Lead Ref</th>
                                            <th>Status </th>
                                            <th>Viewing pack user</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                    </tbody>
                                </table>
                            </div> 
                                                   
                        <h4 class="add_new_rental">Add New Viewing</h4>
              <form id="myForm_viewings" action="<?php echo site_url();?>terminals/save_viewing" method="post">
                        <input type="hidden" id="viewing_landlord_id" name="viewing_landlord_id" value="<?php echo $v_landlord_id;?>" />
						<input type="hidden" id="viewing_listing_ref" name="viewing_listing_ref" value="<?php echo $v_ref;?>" />
						<input type="hidden" id="viewing_listing_id" name="viewing_listing_id" value="<?php echo $v_idd;?>" />
                       <!-- <a href="" class="btn btn-primary margin-bottom-15"><i class="fa fa-plus-circle"></i> New Viewing</a>-->
                      <!-- btn btn-success-->
              <button type="submit" id="update_viewing"  class="btn btn-primary margin-bottom-15" name="Update" value="Update Viewing" style="display:none;">Update Viewing</button>
              <button type="submit" id="save_viewing"  class="btn btn-primary margin-bottom-15" name="Save" value="Save Listing" style="display:none;">Save Viewing</button>
              <button type="button" id="cancel_viewing"  class="btn btn-primary margin-bottom-15" name="Cancel" style="display:none;">Cancel</button>
              <button type="button" id="new_viewing" class="btn btn-primary margin-bottom-15" ><i class="fa fa-plus-circle"></i>New Viewing</button>
              <button type="button" id="edit_viewing" class="btn btn-primary margin-bottom-15" style="display:none;" >Edit Viewing</button>
                       
                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Next available</label>
                                <div class="input-group">
                                <input type="text" class="form-control input-sm datepicker" id="starttime" name="starttime">
                                <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </div>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control input-sm" id="viewing_status" name="viewing_status">
                                <option value="1" selecetd>Scheduled</option>
              					<option value="2">Cancelled</option>
             					 <option value="3">Successful</option>
             					 <option value="4">Unsuccessful</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Agent</label>
                                <select class="form-control input-sm" id="viewing_agent_id" name="viewing_agent_id">
                              
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Notes</label>
                                <input type="text" class="form-control" id="viewing_notes" name="viewing_notes">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                 <label>Lead Ref</label>
                                 <div class="input-group"> 
                                 <span class="input-group-addon" id="span_view_lead">
                                  <a title="Select Leads" id='viewing_leads_link' link="viewing_leads_link" href="#" rel='viewing_leads_popup' data-toggle="modal" data-target="#viewing_leads_pop" class="popup_a">
                                  <i class="fa fa-plus-circle"></i>
                                  </a>
                                  </span>
                                  <input type="text" class="form-control input-sm" id="viewing_lead_ref" name="viewing_lead_ref" readonly="readonly">
                                  <input style="display:none;" name="viewing_lead_id" type="text" class="form_fields" id="viewing_lead_id"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Request Viewing Pack</label>
                                <select class="form-control input-sm" id="viewing_req_agent_id" name="viewing_req_agent_id">
                              
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Client Name</label>
                                <input type="text" class="form-control" id="viewing_landlord" name="viewing_landlord">
                            </div>
                        </div>
                        
                        
                        </div>
                        </form>
                        </div>
                        <div class="tab-pane fade" id="notes_terminal">
                        
                        <div class="row" id="viewing_notesList">
                        
                        </div>
                        
                                                
                        
                        <h4 class="add_new_rental">Add New Notes</h4>
                        <div id="msg_sucess" style="display:none;" class="add_new_rental">Notes saved sucessfully</div>
                        <form id="frm_general">
                        <input type="hidden" id="notes_listing_id" name="notes_listing_id" value="<?php echo $v_idd;?>" />
                        <button type="button" id="new_notes"  class="btn btn-primary margin-bottom-15"><i class="fa fa-plus-circle"></i> New Notes</button>
                           <button type="button" id="save_notes"  class="btn btn-primary margin-bottom-15" name="SaveNotes" value="Save Notes" style="display:none;">Save Notes</button>
              				<button type="button" id="cancel_notes"  class="btn btn-primary margin-bottom-15" name="Cancel" style="display:none;">Cancel</button>
          
                          <div class="form-group">
                            <label>Add Notes</label>
                            <textarea class="form-control" id="terminal_notes" name="terminal_notes"></textarea>
                            </div>
                            </form>
                        </div>
                        
                        <div class="tab-pane fade" id="viewing_contact_history">
                        <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-contact-history">
                                    <thead>
                                        <tr>
                                            <th>Date and Time</th>
                                            <th>Agent </th>
                                            <th>Contact Name</th>
                                            <th>Type</th>
                                            <th>Notes </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">                                            
                                            <td>Faizan</td>
                                            <td>Joseph</td>
                                            <td>+971</td>
                                            <td>6767676767</td>
                                            <td>--</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="add_new_rental">Add New Contact History</h4>
                            <a href="" class="btn btn-primary margin-bottom-15"><i class="fa fa-plus-circle"></i> New Contact History</a>
                            
                            <div class="row">
                            <div class="col-md-2">
                            <div class="form-group">
                                <label>Typr</label>
                                <select class="form-control input-sm">
                                <option>Please select</option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                                <option>Ketchup</option>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label>Mode</label>
                                <select class="form-control input-sm">
                                <option>Please select</option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                                <option>Ketchup</option>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control">
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control">
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label>Notes</label>
                                <input type="text" class="form-control">
                            </div>
                            </div>
                            
                        </div>
                            
                                
                        </div>
                        
                    </div>
                    </div>
                  
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i>  Close</button>
                  </div>
                </div>
              </div>
              <script>
			  $("#new_notes").click(function () {
	
	$("#frm_general")[ 0 ].reset();
	$('#terminal_notes').prop("disabled", false);
	$("#frm_general #save_notes, #frm_general #cancel_notes").css('display', '');
	$("#frm_general #new_notes").css('display', 'none');
	//$("#frm_general #new_viewing, #myForm_viewings #edit_viewing").attr('href','#?w=500');
	//$("#myForm_viewings a").attr('class','modal-link-leads');
});

$("#cancel_notes").click(function () {
	$("#frm_general")[ 0 ].reset();
	$('#terminal_notes').attr('disabled', 'disabled');
	//$('#myForm_viewings input, #myForm_viewings select').removeClass('form_fields_error');
	$("#frm_general #new_notes").css('display', '');
	$("#frm_general #save_notes, #frm_general #edit_viewing, #frm_general #update_viewing, #frm_general #cancel_notes").css('display', 'none');
	//$("#myForm_viewings a").attr('class','');
	
});
			  </script>
               <!--viewing  Leads Modal -->
            <div class="modal fade" id="viewing_leads_pop" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Leads-Viewings</h4>
                  </div>
                  
                  <div class="modal-body">
                  <div id="view_lead_popup" class="popup_block">
                    <div id="view_lead_viewings">Please select a listing</div>
                </div>
                  
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>