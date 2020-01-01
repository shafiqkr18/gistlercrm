<script type="text/javascript">
/* Check for value change in form */
var formDataChange = false;
$("body").on('change','#myForm',function (event)
{
   formDataChange = true;
});

window.onbeforeunload = function() { 
  if (formDataChange) {
    return 'Data not saved!';
  }
}

    
var typesData = {"credit":{"163":"Commission","164":"Fees"},"debit":{"178":"Commission","179":"Expenses","180":"Hardware","181":"Marketing","182":"Rent","183":"Software","184":"Staff","185":"Staff Benefits"}};
var subTypesData = {"164":{"171":"Banking Fee","172":"DEWA Connection","173":"EJARI Registration","174":"Management Fee","176":"Mortgage Fee","177":"Referral Fee","175":"Renewal Fee"},"181":{"199":"Bayut","200":"Dubizzle","201":"Gulf News","202":"JRD Group","203":"Propertyfinder"},"179":{"190":"Business Cards","191":"DEWA","192":"DU","193":"Etisalat","194":"Office Supplies","195":"Petty Cash","196":"Trade Licence"},"163":{"168":"Buyer Commission","169":"Developer Commission","170":"External Agency Commission","165":"Landlord Commission","167":"Seller Commission","166":"Tenant Commission"},"178":{"186":"Commercial Commission","187":"Property Management Commission","188":"Rental Commission","189":"Sale Commission"},"180":{"197":"Computer","198":"Server"},"184":{"207":"Fixed Salary","208":"PRO Fee","209":"Visa Fee","210":"Visa Guarantee"},"185":{"211":"Flight Home","212":"Gratuity","213":"Phone Costs","214":"RERA Training","215":"Transport Costs","216":"Uniform"},"183":{"206":"Microsoft Office","205":"PropSpace"},"182":{"204":"Rent"}};
var last_id;
var startDate = 0;
var endDate = 0;
var username = "<?php echo $this->session->userdata('user_fullname');?>";

var selectedBankId = 0;
var oTable;
var screenname = 'accounts';
selectedBankId = 248;

var previousAgentName = '';
var previousAgentId = 0;

//datatable initilization
$(document).ready(function() {
        
        $('#ExportToCSVALL').html('<div style="display:none;" id="downloadCSV_animation"><img src="<?php base_url();?>mydata/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div><a id="downloadCSV_div" class="popup_a" href="https://crm.propspace.com/accounts/exportCSV?exportCSV=accounts&bankId='+ selectedBankId +'"><img src="https://crm.propspace.com/application/views/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>'); // update download button link

        $('#listings_row').change(function(){
            var value = [];
            var count = 0;
            $('#listings_row input:checked').each(function() {
                    value+=$(this).attr('value')+',';
                    count++;
            });
            $('#ExportToCSVSelected').html('<a class="popup_a"href="<?php echo base_url();?>accounts/exportCSV?bankId='+ selectedBankId +'&exportCSV='+value+'"><img src="<?php base_url();?>mydata/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>'); 	
        });
        
         /* generate column list start*/
        var column_count = 0;
        var column_names = [];
	
        $.each($('#listings_row thead th'), function() {
            column_names.push($(this).text()+'|'+column_count+'|'+$(this).attr('type'))
            column_count++;
        });
	
        column_names.sort();
	
        var column_count = 0;
        var editable_columns = 0;

        for (column_count = 0; column_count < column_names.length; ++column_count) {
            var single_column = column_names[column_count];
            single_column = single_column.split('|')
            var column_name = single_column[0];
            var column_id	= single_column[1];
            var column_type	= single_column[2];
            var read_only_columns = new Array('1','2','3','8','13','14');
            if(column_id!=0 && column_id!=44){	
                 if( $.inArray(column_id, read_only_columns) > -1 ) {
                    $('#columns_list').append("<div class='col-md-4'><div class='form-group form_group_checkbox'><input type='checkbox'" +  ' disabled="disabled" '   + "default='"+column_type +"' checked name='column_"+column_id+"' id='column_"+column_id+"' col='"+column_id+"' value='1' tabindex='33' checked><span class='lbl padding'>"+column_name+"</span></div></div>");
                } else {
                    $('#columns_list').append("<div class='col-md-4'><div class='form-group form_group_checkbox'><input type='checkbox' default='"+column_type  +"' checked name='column_"+column_id+"' id='column_"+column_id+"' col='"+column_id+"' value='1' tabindex='33'><span class='lbl padding'>"+column_name+"</span></div></div>");
                }
                editable_columns++;
            }
        }
	
        $('#total_editable_columns').html(editable_columns);
        /* generate column list end */
         
	 oTable = $('#listings_row').dataTable( {
		"bProcessing": true,
					"bServerSide": true,
					"sDom": 'R<>rt<ilp><"clear">',
					"bRegex": true,
					"sAjaxSource": config.siteUrl+"accounts/datatable_balancesheet",
					"aoColumnDefs": [ 
						{
							 'render': function (data, type, full, meta){
                        //check the main check box
                        $('#check_all_checkboxes').attr('checked', false);
                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
                    },
							"aTargets": [ 0 ]
						},
						{ "bSortable": false, "aTargets": [ 0 ] },
                         {"bVisible": false, "aTargets": [10,11,]}
					],
					"aaSorting" : [[ 14, 'desc' ]],
					"iDisplayStart": 0,
					"iDisplayLength": 25,
					"sPaginationType": "full_numbers",
                                        "bAutoWidth": false,
					"oLanguage": {
					"sSearch": "Search all columns:"
					},
					
					"aoColumns": [
					{ "mDataProp": "id" },
		            { "mDataProp": "ref" },
					{ "mDataProp": "transaction" },
					{"mDataProp":"status"},
					{ "mDataProp": "type" },
					{ "mDataProp": "sub_type" },
					{ "mDataProp": "internal_ref" },
					{ "mDataProp": "payment_mode" },
					{"mDataProp":"amount"},
					{ "mDataProp": "agent_id" },
					{ "mDataProp": "deal_ref" },
					{"mDataProp":"created_by_name"},
					{ "mDataProp": "receipt_no" },
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
                                
        /* Code to hide/show columns START */
	
                                                /* hide the search columns */
                                                    $('#searchbox tr').find("td:nth-child("+(10+2)+")").css('display', 'none');
                            $('#column_10').attr('checked', false);
                                                    $('#searchbox tr').find("td:nth-child("+(11+2)+")").css('display', 'none');
                            $('#column_11').attr('checked', false);
                                                setDatatableWidth();
                        /* hide the search columns end */
                        
                        $('#total_active_columns').html($('#columns_list input:checked').length)
	
} );


</script>
            <div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-file-text-o"></i> Balance Sheet</h1></div>
                </div>
            </div>
                        
            
            <div id="inner_tab">
            
            <div class="row fadeInUp">
            <div class="col-lg-12">
            <!-- Nav tabs -->
            <div class="inner_tab_nav">
                <ul class="nav nav-tabs">
                    <li ><a href="<?php echo site_url('accounts');?>">Dashboard</a></li>
                    <li class="active"><a href="<?php echo site_url('accounts/balance_sheet');?>">Balance Sheet</a></li>
                    <li><a href="<?php echo site_url('accounts/bank_accounts');?>">Bank Accounts</a></li>
                    <li><a href="<?php echo site_url('accounts/transaction_categories');?>">Transaction Categories</a></li>
                    <li><a href="<?php echo site_url('accounts/payment_modes');?>">Payment Modes</a></li>
                    <li><a href="<?php echo site_url('accounts/history');?>">History</a></li>
                </ul>
            </div>
            
            
            <!-- Tab content -->
            
            <div class="tab-content">
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                    <label>Select Bank Account</label>
                
                    <select name="bankName" class="form-control input-sm" id="bankName">
						        <option value="">Select Bank</option>
						         <option value="248"  selected = "selected"  >NBD - #0123456</option>
						        </select>
              </div>
            </div>
            </div>
            </div>
            
            
            <div class="tab-content">
              <?php
		 $attributes = array('data-toggle' => 'validator', 'id' => 'myForm', 'role' => 'form');
	    echo form_open_multipart('accounts/save_balancesheet', $attributes);
        ?>
            <div class="row">
            <div class="col-lg-12">
            <button type="button" id="new" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>New Listing</button>

            <button  style="display:none;" type="submit" id="update"  class="btn btn-lg btn-success" name="Update" value="Update Listing">
            <i class="fa fa-plus-circle"></i> Save Listing</button>
             <button  style="display:none;" type="submit" id="Save"  class="btn btn-lg btn-success" name="Save" value="Save Listing">
            <i class="fa fa-plus-circle"></i> Save Listing</button>
       
                <button  style="display:none;" type="button" id="edit" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Listing</button>
            <a href="javascript:void(0)" id="cancel" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>
             <div class="showdata" id="showdata"></div>
            </div>
            </div>
            
            <div class="row"><h4 class="add_new_rental">Add New Record</h4></div>
            <div class="row">
            
            <div class="col-md-3">
              <div class="form-group">
                <label>Ref</label>
                <input type="text" class="form-control input-sm" id="ref" name="ref" readonly="readonly">
                
                 	<input name="bank_id" type="text" style="display: none; "class="form-control" id="bank_id" value="" />
				    <input name="id" type="text" style="display: none; "class="form-control" id="id" value="0" />
					<input name="deal_id" type="text" style="display: none; "class="form-control" id="deal_id" value="0" />
					               
                
                
              </div>
              <div class="form-group">
                    <label>Transaction</label>
                  
                     <select name="transaction" class="form-control input-sm  required" id="transaction" tabindex="10">
				                        <option value="">Select</option>
				                    <option value="credit">Credit</option>
				                    <option value="debit">Debit</option>
				                    </select> 
              </div>
              <div class="form-group">
                    <label>Status</label>
                  <select name="status" class="form-control input-sm  required" id="status" tabindex="11">
				                        <option value="">Select</option>
				                        				                        <option value="1">Received</option>
				                        				                        <option value="2">Banked</option>
				                        				                        <option value="3">Cleared</option>
				                        				                        <option value="4">Pending</option>
				                        				                        <option value="5">Paid</option>
				                                            				</select>   
              </div>
              <div class="form-group">
                    <label>Payment Method</label>
                    	<select name="payment_mode" class="form-control input-sm required" id="payment_mode" tabindex="16">
				                        <option value="">Select</option>
				                        				                        <option value="20">Cash</option>
				                        				                        <option value="22">Cheque</option>
				                        				                        <option value="21">Credit Card</option>
				                        				                    </select> 
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                    <label>Category</label>
                   
                    <select name="type" class="form-control input-sm required" id="type" tabindex="12">
					                  <option value="">Select</option>
					                  					                      <option value="163">Commission</option>
					                  					                      <option value="178">Commission</option>
					                  					                      <option value="179">Expenses</option>
					                  					                      <option value="164">Fees</option>
					                  					                      <option value="180">Hardware</option>
					                  					                      <option value="181">Marketing</option>
					                  					                      <option value="182">Rent</option>
					                  					                      <option value="183">Software</option>
					                  					                      <option value="184">Staff</option>
					                  					                      <option value="185">Staff Benefits</option>
					                  					                </select>    
              </div>
              <div class="form-group">
                    <label>Sub Category</label>
                   	<select name="sub_type" class="form-control input-sm " id="sub_type" tabindex="13">
				                        <option value="">Select</option>
				                        				                        <option value="171">Banking Fee</option>
				                        				                        <option value="199">Bayut</option>
				                        				                        <option value="190">Business Cards</option>
				                        				                        <option value="168">Buyer Commission</option>
				                        				                        <option value="186">Commercial Commission</option>
				                        				                        <option value="197">Computer</option>
				                        				                        <option value="169">Developer Commission</option>
				                        				                        <option value="191">DEWA</option>
				                        				                        <option value="172">DEWA Connection</option>
				                        				                        <option value="192">DU</option>
				                        				                        <option value="200">Dubizzle</option>
				                        				                        <option value="173">EJARI Registration</option>
				                        				                        <option value="193">Etisalat</option>
				                        				                        <option value="170">External Agency Commission</option>
				                        				                        <option value="207">Fixed Salary</option>
				                        				                        <option value="211">Flight Home</option>
				                        				                        <option value="212">Gratuity</option>
				                        				                        <option value="201">Gulf News</option>
				                        				                        <option value="202">JRD Group</option>
				                        				                        <option value="165">Landlord Commission</option>
				                        				                        <option value="174">Management Fee</option>
				                        				                        <option value="206">Microsoft Office</option>
				                        				                        <option value="176">Mortgage Fee</option>
				                        				                        <option value="194">Office Supplies</option>
				                        				                        <option value="195">Petty Cash</option>
				                        				                        <option value="213">Phone Costs</option>
				                        				                        <option value="208">PRO Fee</option>
				                        				                        <option value="187">Property Management Commission</option>
				                        				                        <option value="203">Propertyfinder</option>
				                        				                        <option value="205">PropSpace</option>
				                        				                        <option value="177">Referral Fee</option>
				                        				                        <option value="175">Renewal Fee</option>
				                        				                        <option value="204">Rent</option>
				                        				                        <option value="188">Rental Commission</option>
				                        				                        <option value="214">RERA Training</option>
				                        				                        <option value="189">Sale Commission</option>
				                        				                        <option value="167">Seller Commission</option>
				                        				                        <option value="198">Server</option>
				                        				                        <option value="166">Tenant Commission</option>
				                        				                        <option value="196">Trade Licence</option>
				                        				                        <option value="215">Transport Costs</option>
				                        				                        <option value="216">Uniform</option>
				                        				                        <option value="209">Visa Fee</option>
				                        				                        <option value="210">Visa Guarantee</option>
				                        				                    </select>   
              </div>
              <div class="form-group">
                <label>Internal Ref</label>
              
                	<input name="internal_ref" type="text" class="form-control input-sm" id="internal_ref" value="" tabindex="16"/>  
              </div>
              <div class="form-group">
                <label>From / To</label>
                
                	<input name="agent_id" type="text" style="display:none;" class="form_fields" id="agent_id" value="">
                    <input name="auto_name_field" type="text" class="form-control input-sm" id="auto_name_field" value=""  tabindex="14">  
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                <label>Receipt No</label>
             
                <input name="receipt_no" type="text" class="form-control input-sm" id="receipt_no" value="" tabindex="18"/>
              </div>
              
               <div class="form-group">
                <label>Deal Ref</label>
                <div class="input-group">
                  <span class="input-group-addon">
                  	<a id='view_deal_popup_link' href="#" data-toggle="modal" data-target="#view_deal_popup" rel='view_deal_popup' class="popup_a" title="Select Deal Reference">
                  	<!-- <a href="#?w=800" rel="popup1" class="popup_a " id="popup-deal-ref" title="Select Deal Reference"> -->
                                           <i class="fa fa-plus-circle"></i>
                                        </a></span>
                  
                  <input name="deal_ref" type="text" class="form-control input-sm" id="deal_ref" value="" />
                </div>
                </div>
              
              <div class="form-group">
                <label>Created By</label>
                
                <input name="created_by_name" type="text" class="form-control input-sm" readonly id="created_by_name" value="">
              </div>
              <div class="form-group">
                <label>Amount</label>
                
                <input name="amount" type="text" class="form-control input-sm required" id="amount" value=""  tabindex="17">
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                <label>Date Added</label>
                
                <input name="dateadded" type="text" class="form-control input-sm" id="dateadded" value="" readonly />
              </div>
              <div class="form-group">
                <label>Date Updated</label>
               	<input name="dateupdated" type="text" class="form-control input-sm" id="dateupdated" value="" readonly>
              </div>
              
               <div class="form-group">
                <label>Notes</label>
                <div class="input-group">
                
                    <span class="input-group-addon"><a href="" rel="popup2" id="popup-notes" title="Add Notes to the entry" class="popup_a" data-toggle="modal" data-target="#noteslshis_modal"><i class="fa fa-plus-circle"></i></a></span>
                                        
                                        
                                        
                  <input name="notesx" cols="20" rows="1" class="form-control input-sm" id="notesx" readonly="true" />
                  
                </div>
                </div>
            </div>
            
            </div>
           
            <?php echo  form_close();?>
            </div>
            
            
            
           
            
            
            
            
            
            
            
            
            <div class="col-md-12">
                <p class="text-right"><strong>Running Blanace:</strong> <span id="account_current_balance" class="account_current_balance"> AED 0</span></p>
            </div>
            <div class="clear"></div>
            <div class="tab-content datatable-Scrolltab">
            <div class="row">
                <div class="col-md-2">

                <div class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i> Share Options</a><span class="caret"></span>
                        <ul class="dropdown-menu">
                            <li>
                            	<a href="#?w=500" rel="popupexcel" class="popup_a"><i class="fa fa-file-excel-o"></i>Download selected transaction(s) as Excel table</a>
                            	</li>
             				<li>
             					<a href="#?w=500" rel="popup23" class="popup_a"><i class="fa fa-file-excel-o"></i>Download all transaction(s) as Excel table</a>
             					</li>
                           
                        </ul>
                </div>

                </div>           
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group" id="">
                          <input type="text" id="datepcikrange" class="form-control input-sm">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-1">
                <a href="" class="btn btn-success" data-toggle="modal" data-target="#columns">Columns <i class="fa fa-chevron-down"></i></a> 
                 
                </div>
            
            </div>

                <div class="row">   
                    <table class="table table-striped table-hover datatables" id="listings_row">
                  <thead>
                  <tr>
                    <th>
                    <label class="">
                       <input onClick="toggleChecked(this.checked)" id='check_all_checkboxes' type="checkbox">
                        <span class="lbl"></span>
                    </label>
                    </th>
                   
                      <th>Ref</th>
                    <th>Transaction</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th type="not_default">Internal Ref</th>
                    <th>Payment Mode</th>
                    <th>Amount</th>
                    <th>From /To</th>
                    <th type="not_default">Deal Ref</th>
            		<th>Created By</th>
                    <th type="not_default">Receipt No</th>
                    <th>Date Added</th>
                    <th>Date Updated</th>
                    </tr>
                   </thead>
                    <thead id="searchbox" class="search_box">
                    <tr class="highlighted">
                    	 <form id="myForm2">
                    <td><a style="display:none;" id="reset_filter" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png" title="Reset filter"></a></td>
                    <td><input type="text" class="form-control input-sm" id="1"></td>
                    <td>
                 
                    <select class="search_init transaction-dropdown form-control input-sm"  id="2">
                            <option value="">Select</option>
                                                        <option value="credit">Credit</option>
                                                        <option value="debit">Debit</option>
                                                    </select>
                    </td>
                    <td>
                     <select class="search_init form-control input-sm"  id="3">
                            <option value="">Select</option>
                                                        <option value="1">Received</option>
                                                        <option value="2">Banked</option>
                                                        <option value="3">Cleared</option>
                                                        <option value="4">Pending</option>
                                                        <option value="5">Paid</option>
                                                    </select>
                    </td>
                    <td>
                   <select class="search_init"  id="4">
                            <option value="">Select</option>
                                                        <option value="163">Commission</option>
                                                        <option value="178">Commission</option>
                                                        <option value="179">Expenses</option>
                                                        <option value="164">Fees</option>
                                                        <option value="180">Hardware</option>
                                                        <option value="181">Marketing</option>
                                                        <option value="182">Rent</option>
                                                        <option value="183">Software</option>
                                                        <option value="184">Staff</option>
                                                        <option value="185">Staff Benefits</option>
                                                    </select>
                    </td>
                    <td>
                     <select class="search_init"  id="5">
                            <option value="">Select</option>
                                                        <option value="171">Banking Fee</option>
                                                        <option value="199">Bayut</option>
                                                        <option value="190">Business Cards</option>
                                                        <option value="168">Buyer Commission</option>
                                                        <option value="186">Commercial Commission</option>
                                                        <option value="197">Computer</option>
                                                        <option value="169">Developer Commission</option>
                                                        <option value="191">DEWA</option>
                                                        <option value="172">DEWA Connection</option>
                                                        <option value="192">DU</option>
                                                        <option value="200">Dubizzle</option>
                                                        <option value="173">EJARI Registration</option>
                                                        <option value="193">Etisalat</option>
                                                        <option value="170">External Agency Commission</option>
                                                        <option value="207">Fixed Salary</option>
                                                        <option value="211">Flight Home</option>
                                                        <option value="212">Gratuity</option>
                                                        <option value="201">Gulf News</option>
                                                        <option value="202">JRD Group</option>
                                                        <option value="165">Landlord Commission</option>
                                                        <option value="174">Management Fee</option>
                                                        <option value="206">Microsoft Office</option>
                                                        <option value="176">Mortgage Fee</option>
                                                        <option value="194">Office Supplies</option>
                                                        <option value="195">Petty Cash</option>
                                                        <option value="213">Phone Costs</option>
                                                        <option value="208">PRO Fee</option>
                                                        <option value="187">Property Management Commission</option>
                                                        <option value="203">Propertyfinder</option>
                                                        <option value="205">PropSpace</option>
                                                        <option value="177">Referral Fee</option>
                                                        <option value="175">Renewal Fee</option>
                                                        <option value="204">Rent</option>
                                                        <option value="188">Rental Commission</option>
                                                        <option value="214">RERA Training</option>
                                                        <option value="189">Sale Commission</option>
                                                        <option value="167">Seller Commission</option>
                                                        <option value="198">Server</option>
                                                        <option value="166">Tenant Commission</option>
                                                        <option value="196">Trade Licence</option>
                                                        <option value="215">Transport Costs</option>
                                                        <option value="216">Uniform</option>
                                                        <option value="209">Visa Fee</option>
                                                        <option value="210">Visa Guarantee</option>
                                                    </select>
                    </td>
                    <td><input type="text" class="form-control input-sm search_init" id="6"></td>
                    <td>
                     <select class="form-control input-sm search_init"  id="7">
                            <option value="">Select</option>
                                                        <option value="20">Cash</option>
                                                        <option value="22">Cheque</option>
                                                        <option value="21">Credit Card</option>
                                                    </select>
                    </td>
                    <td><input type="text" class="form-control input-sm" id="8"></td>
                    <td>
                        
                    </td>
                    <td>
                                
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                       
                    </td>
                    <td>
                       
                    </td>
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
             
            </div>
            <!-- container end -->            
            </div>
			<!-- wrapper end -->
			<script type="text/javascript" src="<?php echo site_url();?>js_module/common.js?ts=11234"></script> 
			<script type="text/javascript" src="<?php echo site_url();?>js_module/accounts-balancesheet.js?ts=987654321"></script> 
			
			
			
			 <!-- start -->
            
             <div class="modal fade" id="noteslshis_modal" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Notes</h4>
                    <!-- <p> </p> -->
                  </div>
                  
                  <div class="modal-body">
                  
                    <div class="row">
                      <div class="col-md-6">
                        <div class="modal-form">
            		<div class="form-group">
            			<div class="col-md-3 form-label">
            				Note
            			</div>
            			<div class="col-md-9">
            				<textarea name="notes" rows="4" class="form-control" id="notes" value=""></textarea>
            			</div>
            		</div>
            		<div class="form-group">
            			<div class="col-md-3 form-label">
            				Previous Notes
            			</div>
            			<div class="col-md-9">
            				<div style="width:100%; border: 1px solid #D3D3D3; margin-bottom:10px;" id="shownotes">No note found</div>
            			</div>
            		</div>
            	</div>
                       
                      </div>
                     
                      
                    </div>
                    
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" id="btn-close-notes" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Save &amp; Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end -->
			
            <!-- <div id="popup1" class="popup_block">
    <div class="modal-body" style="min-height: 250px !important;">
           <div id="leads_viewing_html"></div>
    </div>
 
</div> -->

<div class="modal fade" id="view_deal_popup" tabindex="-1" >
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                 <div id="view_deal_window">Please select a listing</div>
                  
                  </div>
                </div>
              </div>


              <!-- Columns Modal -->
            <div class="modal fade" id="columns" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Manage Columns</h4>
                  </div>
                  
                  <div class="modal-body">
                  <div class="row" id="columns_list">
                  <!--show columns check boxes here-->
                  
                  </div>
                  <div><span id="total_active_columns" style="font-weight:bold;">0</span> out of <span id="total_editable_columns" style="font-weight:bold;"></span> columns are selected</div>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="save_columns_settings"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-primary" id="reset_columns_settings"><i class="fa fa-refresh"></i> Reset</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                  </div>
                </div>
              </div>
            </div> 