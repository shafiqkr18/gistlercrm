<script>var screenname = 'bank_accounts';</script>
<script type="text/javascript">

/* Check for value change in form */

var formDataChange = false;
$('body').on("change", "#myForm_bank_account" , function() {
   formDataChange = true;
});
	
window.onbeforeunload = function() { 
  if (formDataChange) {
    return 'Data not saved!';
  }
}
var last_id = 0;
var screenname = 'accounts_settings';
var oTable;

$(document).ready(function() {
		oTable = $('#listings_row').dataTable( {
			
			"bProcessing": true,
	                "bServerSide": true,
	                "sDom": 'R<>rt<ilp><"clear">',
	                "bRegex": true,
	                "sAjaxSource": mainurl+"accounts/datatableBankAccounts",
	               "aoColumnDefs": [ 
						{
							 'render': function (data, type, full, meta){
                        //check the main check box
                        $('#check_all_checkboxes').attr('checked', false);
                        return '<div style="text-align:center;"><input style="align:center;" type="checkbox" value="' + data + '">  <span class="lbl"></span></div>';
                    },
							"aTargets": [ 0 ]
						},
						 //{ "bSortable": false, "aTargets": [0,2,3,4,5] },
	                    // { "bSearchable": false, "aTargets": [2,3,4,5] }
					],
	                "aaSorting" : [[ 8, 'desc' ]],
	                "iDisplayStart": 0,
	                "sPaginationType": "full_numbers",
	                "oLanguage": {
	                "sSearch": "Search all columns:"
	                },
	                "aoColumns": [
					{ "mDataProp": "id" },
		            { "mDataProp": "name" },
					{ "mDataProp": "account_no" },
					{"mDataProp":"branch_name"},
					{ "mDataProp": "swift_code" },
					{ "mDataProp": "iban_no" },
					{ "mDataProp": "initial_amount" },
					{ "mDataProp": "currency_id" },
					{"mDataProp":"dateadded"},
					{ "mDataProp": "dateupdated" },
					{ "mDataProp": "isDefault" },
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
	});

</script>
<div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-file-text-o"></i> Bank Account</h1></div>
                </div>
            </div>
                        
            
            <div id="inner_tab">
            
            <div class="row fadeInUp">
            <div class="col-lg-12">
            <!-- Nav tabs -->
            <div class="inner_tab_nav">
                <ul class="nav nav-tabs">
                   <li ><a href="<?php echo site_url('accounts');?>">Dashboard</a></li>
                    <li ><a href="<?php echo site_url('accounts/balance_sheet');?>">Balance Sheet</a></li>
                    <li class="active"><a href="<?php echo site_url('accounts/bank_accounts');?>">Bank Accounts</a></li>
                    <li><a href="<?php echo site_url('accounts/transaction_categories');?>">Transaction Categories</a></li>
                    <li><a href="<?php echo site_url('accounts/payment_modes');?>">Payment Modes</a></li>
                    <li><a href="<?php echo site_url('accounts/history');?>">History</a></li>
                </ul>
            </div>
            
            
            <!-- Tab content -->
            <div class="tab-content">
             <?php
		 $attributes = array('data-toggle' => 'validator', 'id' => 'myForm_bank_account', 'role' => 'form');
	    echo form_open_multipart('accounts/submitBankAccount', $attributes);
        ?>
            <div class="row">
            <div class="col-lg-12">
         <button type="button" id="new_bank_account" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>New Bank Account</button>

            <button  style="display:none;" type="submit" id="update_bank_account"  class="btn btn-lg btn-success" name="Update" value="Update Listing">
            <i class="fa fa-plus-circle"></i> Update Bank Account</button>
             <button  style="display:none;" type="submit" id="Save_bank_account"  class="btn btn-lg btn-success" name="Save" value="Save Listing">
            <i class="fa fa-plus-circle"></i> Save Bank Account</button>
            <button  style="display:none;" type="button" id="edit_bank_account" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Bank Account</button>
            <a href="javascript:void(0)" id="cancel_bank_account" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>
             <div class="showdata" id="showdata"></div>
           </div>
            </div>
            
            <div class="row"><h4 class="add_new_rental">Add New Bank Account</h4></div>
            <div class="row">
            
            <div class="col-md-3">
              <div class="form-group">
                <label>Name</label>
             
                	<input name="id" type="text" style="display: none;"  id="id" value="0">
            		<input name="name" type="text" id="name" value="" class="form-control input-sm required" tabindex="9" required="required">
              </div>
               <div class="form-group">
                <label>Initial Balance</label>
                <input name="initial_amount" type="text" id="initial_amount" value="" class="form-control input-sm required" style="" tabindex="13" required="required"/>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Account #</label>
                <input name="account_no" type="text" id="account_no" value="" class="form-control input-sm required" tabindex="9" required="required">
              </div>
               <div class="form-group">
                <label>IBAN #</label>
              	<input name="iban_no" type="text" id="iban_no" value="" class="form-control input-sm" style="" tabindex="13" required="required"/>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Branch</label>
               <input name="branch_name" type="text" id="branch_name" value="" class="form-control input-sm" style="" tabindex="11" required="required" />
              </div>
               <div class="form-group">
                <label>Currency</label>
                   	<select name="currency_id" class="form-control input-sm required" id="currency_id " tabindex="14">
				                    <option value="">Select Currency</option>
				                    				                        <option value="3" selected="selected">AED</option>
				                    				                        <option value="6">USD</option>
				                    				                 </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Swift</label>
               	<input name="swift_code" type="text" id="swift_code" value="" class="form-control input-sm" style="" tabindex="12" required="required" />
              </div>
               <div class="form-group">
                <label class="">
                       <input type="checkbox" name="isDefault" id="isDefault" value="1" tabindex="35" />
                        <span class="lbl padding">Default  <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                           data-placement="bottom" 
                           data-content="Select this check box if you would like this bank to be default. One bank account needs to be set as default to access Balance Sheet.">
                           <i class="fa fa-info-circle"></i>
                           </a></span>
                    </label>
              </div>
            </div>
            
            
              
              
            </div>
            </form>
            </div>
            
            
            
            <div class="datatable-Scrolltab">
            <table class="table table-striped table-hover datatables" id="listings_row">
                  <thead>
                  <tr>
                    <th>
                    <label class="">
                        <input type="checkbox"/>
                        <span class="lbl"></span>
                    </label>
                    </th>
                    <th>Name</th>
                    <th>Account No</th>
                    <th>Branch Name</th>
                    <th>Swift Code</th>
                    <th>IBAN No</th>
                    <th>Initial Account</th>
                    <th>Currency</th>
                    <th>Added</th>
                    <th>Updated</th>
                    <th>Default</th>
                    </tr>
                    </thead>
                    <thead id="searchbox" class="search_box">
                   <tr class="highlighted">
                   <form id="myForm2">
					<td><a style="display:none;" id="reset_filter" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png" title="Reset filter"></a></td>
                    <td><input type="text" class="form-control input-sm search_init" id="1"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                    
                    <select name="currency_id" class="form-control input-sm  search_init " id="6">
	                  <option value="">Select Currency</option>
	                  	                      <option value="3">AED</option>
	                  	                      <option value="6">USD</option>
	                  	                </select>
                    </td>
                    <td>
                   <div class="input-group">
					<input type="text" class="form-control input-sm datepicker">
					<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
					</div>
					</div>
                    </td>
                    <td>
                    <div class="input-group">
						<input type="text" class="form-control input-sm datepicker">
						<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
						</div>
						</div>
                    </td>
                    <td></td>
                     </form>
                    </tr>
                    </thead>
                    
                    <tbody>
                    <tr>
                   
                    </tr>
                    </tbody>
             </table>
            </div>
            
            
            </div>
            </div>
            
            
            
            
            
            </div>
             
            </div>
            <!-- container end -->            
            </div>
			<!-- wrapper end -->
				
			<script type="text/javascript" src="<?php echo site_url();?>js_module/accounts_bank_accounts.js?ts=987654321"></script> 
			
            