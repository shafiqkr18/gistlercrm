<script type="text/javascript">

var oTable;
var pageTitle = '<?php echo $title;?>';
var last_id = '';
var screenname = 'activities';
 
/* Check for value change in form */
var formDataChange = false;
	$(document.body).on('change', "#myForm",function (event)
	{
	   formDataChange = true;
	});
	
window.onbeforeunload = function() { 
  if (formDataChange) {
    return 'Data not saved!';
  }
}

/* Notification IDs */
var notification_id = '';
notification_id = '';
        
var sortActivities = false;
//datatable initilization
        
jQuery(document).ready(function() {
        $("#notes").keypress(function (evt) {
                var keycode = evt.charCode || evt.keyCode;
                //alert(keycode);
                if (keycode  == 34 || keycode  == 39 || keycode  == 47 || keycode  == 92 || keycode  == 13) { //Enter key's keycode
                    return false;
                }
        });
 
  var oTable = $('#listings_row').dataTable( {
		 	   "bProcessing": true,
            "bServerSide": true,
            "sDom": 'R<>rt<ilp><"clear">',
			
            "aoColumnDefs": [ 
                {
                  'render': function (data, type, full, meta){
          			 $('#check_all_checkboxes').attr('checked', false);
                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
                 },
			   "aTargets": [ 0 ]
                },
                { "bSortable": false, "aTargets": [ 0 ] }
             
            ],
			 "aoColumns": [
			
			{ "mDataProp": "id" },{ "mDataProp": "ref" },{ "mDataProp": "title" },{ "mDataProp": "status" },
			{ "mDataProp": "priority" },{ "mDataProp": "due_date" },{ "mDataProp": "assigned_by" },{ "mDataProp": "assigned_to_id" },{ "mDataProp": "notes" },{ "mDataProp": "dateadded" }
			
			],
            "aaSorting" : [[ 0, 'desc' ]],
            "bRegex": true,
            "sAjaxSource": "<?php echo base_url();?>index.php/todo/datatable",
            "iDisplayStart": 0,
            "sPaginationType": "full_numbers",
            "oLanguage": {
                "sSearch": "Search all columns:"
            },
           	'fnServerData': function (url, data, callback){ 
								/* Add some extra data to the sender */
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
					},
					"rowCallback": function( row, data ) {
						 $(row).attr("id",data.id);
						 return row;
					}
        
		 } );
		 
 });
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
				  fnClickAddRow(),
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
				  $('#calendar').fullCalendar( 'refetchEvents' );
				  $('#showdata').animate({ 'color': '#49AC44'}, "slow"),
				  $('#showdata').fadeIn("slow"),
				   setTimeout(function() {  
					   $('#showdata').fadeOut("slow")
				   }, 5000);
			  }
			});
		  });
 </script>
  <script type="text/javascript" src="<?php echo site_url();?>js_module/common.js?ts=11234"></script> 
  <div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-check"></i> To-do List</h1></div>
                </div>
            </div>
            

            <div id="inner_tab">
            
            
            <div class="row">
            <div class="col-lg-12">
            <!-- Nav tabs -->
            <div class="inner_tab_nav">
                <ul class="nav nav-tabs">
                <li  ><a href="<?php echo base_url();?>calendar">My Calendar</a></li>
                    <li class="active"><a href="<?php echo base_url();?>todo">To-Do List</a></li>
                </ul>
            </div>
            
                    
            <!-- Tab content -->
            <div class="tab-content">
           
            	<!-- <form id="myForm" action="<?php echo base_url();?>todo/todosubmit" method="post"  role="form"> -->
            		   <?php
						 $attributes = array('data-toggle' => 'validator', 'id' => 'myForm', 'role' => 'form');
					    echo form_open_multipart('todo/todosubmit', $attributes);
				        ?>
              <div class="row">

	              <div class="col-lg-12">
	                  <button type="button" id="new" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>New To-do</button>
	                  <button  style="display:none;" type="submit" id="Save"  class="btn btn-lg btn-success" name="Save" value="Save Listing">
	                  <i class="fa fa-plus-circle"></i> Save To-do</button>
	                    <button  style="display:none;" type="submit" id="update"  class="btn btn-lg btn-success" name="Update" value="Update Listing">
           				 <i class="fa fa-plus-circle"></i> Save To-do</button>
	                 <button  style="display:none;" type="button" id="edit" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit To-do</button>
	                 <a href="javascript:void(0)" id="cancel" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>
	                 
	              <div class="showdata" id="showdata"></div>
	                 
	                 
	                 
	              </div>

              </div>
            
            
            	<div class="row"><h4 class="add_new_rental">Add New To-Do</h4></div>
            
            
            <div class="row fadeInUp">
              
		          <div class="col-md-3">		            
		            <div class="form-group">
		              <label>Title</label>
		              <input type="text" class="form-control input-sm" id="title" name="title" >
		            </div>
		            <div class="form-group">
		              <label>Ref</label>
		              <input name="id" class="form-control" id="id" value="0" style="width:50px; display:none;">
          			  <input name="ref" type="text" class="form-control input-sm" id="ref" value="" tabindex="0" readonly>
          			  <input type="hidden" name="screenname" id="screenname" value="calendar_todo" />
		            </div>		            
		            <div class="form-group">
		                <label>Priority</label>
		                <select name="priority" class="form-control input-sm required" id="priority" required>
						            <option value="" selected="selected">Select</option>
						            <option style="background-color: #BEF5B8;" value="3">Low</option>
						            <option style="background-color: #C4CAFF;" value="2">Medium</option>
						            <option style="background-color: #F7BBBC;" value="1">High</option>
						        </select>
		              
		            </div>		            
		          </div>

		          <div class="col-md-3">		            
		            <div class="form-group">
		              <label>Date Added</label>
		             <input name="dateadded" type="text" value='<?php echo date('Y-m-d H:i:s');?>'  class="form-control input-sm" id="dateadded" disabled='disabled'>
		            </div>
		            <div class="form-group">
                    	<label>Due Date</label>
	                    <div class="input-group">
	                        <input type="text" class="form-control input-sm datepicker" id="due_date" name="due_date"> 
	                        <div class="input-group-addon">
	                            <i class="fa fa-calendar"></i>
	                        </div>
	                    </div>
	                </div>		            
		            <div class="form-group">
		                <label>Status</label>
		               <select name="status" class="form-control input-sm" id="status" required>
						            <option value="1" selected="selected">Not yet started</option>
						            <option value="2">In Progress</option>
						            <option value="3">Completed</option>
						        </select>
		            </div>		            
		          </div>

		          <div class="col-md-3">		            
		            <div class="form-group">
		              <label>Created by</label>
		        		<input type="hidden" id="assigned_by" name="assigned_by" value="<?php echo $this->session->userdata('userid');?>" />
		              <input name="assigned_by_name" type="text" class="form-control input-sm" id="assigned_by_name" readonly="readonly" disabled="disabled" value="<?php echo $this->session->userdata('username');?>" />
		            </div>
		            <div class="form-group">
		                <label>Assign to</label>
		                <select name="assigned_to_id" id="assigned_to_id" class="form-control required input-sm" required>
		                 
		                </select>
		            </div>	
		            <div class="form-group">
		              <label>Lead Ref</label>
		              <input name="lead_ref" type="text" class="form-control input-sm" id="lead_ref" value="" tabindex="0" readonly >
          			 <input name="lead_id" type="text" id="lead_id" value="" style="display:none;">
		            </div>		            
		          </div>

		          <div class="col-md-3">		            
		            <div class="form-group">
		              <label>Listing Ref</label>
		             
		              
		              <input name="listings_ref" type="text" class="form-control input-sm" id="listings_ref" value="" tabindex="0" readonly>
           				<input name="listings_id" type="text" id="listings_id" value="" style="display:none;">	
		            </div>
		            <div class="form-group">
		              <label>Notes</label>
		              <div class="input-group">
                    <span class="input-group-addon"><a data-target="#notespopup" data-toggle="modal" href=""><i class="fa fa-plus-circle"></i></a></span>
                    <textarea rows="2" style="height: 100px !important;" class="form-control" id="notesx" name="notesx"></textarea>
                   </div>
		            </div>		            
		            		            
		          </div>
                        
            </div>
				
				  <!-- View Notes Modal -->
          <div class="modal fade" id="notespopup" tabindex="-1" >
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Notes</h4>
                  </div>
                  
                  <div class="modal-body">
                       <div class="row">
                          <div class="form-group">
                              <label class="col-md-2 control-label">Note</label>
                              <div class="col-md-10">
                                <textarea class="form-control" id="notes" name="notes"></textarea>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group">
                              <label class="col-md-2 control-label">Previous Comments</label>
                              <div class="col-md-10">
                              
                                <table class="table table-striped">
                                  <tbody>
                                    <tr>
                                      <td></td>
                                      <td>	<div style="width:100%; border:  #D3D3D3;" id="shownotes">No note found</div></td>
                                    </tr>
                                   
                                  </tbody>
                                </table>
                              </div>
                          </div>
                      </div>

                  </div>
                  <div class="modal-footer">
                    <button id="btn-close-notes" data-dismiss="modal" class="btn btn-success" type="button"><i class="fa fa-check"></i> Save and Close</button>
                  </div>
                </div>
              </div>
            </div>
				
				
            </form>
            <!-- Rental Form End -->
            </div>
            <!-- uae tab content end -->    
            </div>
            </div>
            
            
            
            <div class="row fadeInUp">
	            <div class="col-lg-12">	            
		            <div class="tab-content datatable-Scrolltab">
		           	
            <div class="row">
                <table class="table table-striped table-hover datatables" id="listings_row">
                  <thead>
                  <tr>
                    <th>
                  <!--  <label class="">
                        <input type="checkbox"/>
                        <span class="lbl"></span>
                    </label>-->
                    </th>
                    
                    <th>Reference</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Due Date</th>
                    <th>Created By</th>
                    <th>Assigned To</th>
                    <th>Notes</th>
                    <th>Added Date</th>
                   
                    </tr>

                    
                    </thead>
                     <thead id="searchbox" class="search_box">
            <tr>
            <form id="myForm2">
            	<td style="text-align:center;"><a style="display:none;" id="reset_filter" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png?ts=10" title="Reset filter"></a></td>
                <td><input  id='1' type="text" class="search_init form-control input-sm" /></td>
                <td><input  id='2' type="text" class="search_init form-control input-sm" /></td>
                <td><select id='3' class="search_init form-control input-sm" ><option value="" selected="selected">Select</option> <option value="1">Not yet started</option><option value="2">In Progress</option>
                	<option value="3">Complete</option></select></td>
                <td><select id='4' class="search_init form-control input-sm" ><option value="" selected="selected">Select</option>
                	<option style="background-color: #BEF5B8;" value="3">Low</option><option style="background-color: #C4CAFF;" value="2">Medium</option>
                	<option style="background-color: #F7BBBC;" value="1">High</option></select></td>
                <td>
		
	    
	    </td>
             
                <td>
                  <select id='6' class="search_init form-control input-sm">
                    <option value="" selected="selected">Select</option>
                     
                                      </select>
                </td>
                <td>
                  <select id='7' class="search_init form-control input-sm">
                    <option value="" selected="selected">Select</option>
                                     
                                      </select>
                </td>
                <td></td>
                 <td>
		
		
	    
	    </td>
             </form>
            </tr>
        </thead>
                    
                    
                    <tbody>
                    
                    
                    </tbody>
                </table>
              </div>
		            </div>
	            </div>
            </div>
            
                    
            
            

 			</div>
            </div>
            <!-- container end -->
            
            
            </div>
			<!-- wrapper end -->