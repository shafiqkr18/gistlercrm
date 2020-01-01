<script type="text/javascript">

var typesData = {"credit":{"163":"Commission","164":"Fees"},"debit":{"178":"Commission","179":"Expenses","180":"Hardware","181":"Marketing","182":"Rent","183":"Software","184":"Staff","185":"Staff Benefits"}};
var last_id = 0;

</script>
            <div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-file-text-o"></i> Transaction Categories</h1></div>
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
                    <li><a href="<?php echo site_url('accounts/bank_accounts');?>">Bank Accounts</a></li>
                    <li class="active"><a href="<?php echo site_url('accounts/transaction_categories');?>">Transaction Categories</a></li>
                    <li><a href="<?php echo site_url('accounts/payment_modes');?>">Payment Modes</a></li>
                    <li><a href="<?php echo site_url('accounts/history');?>">History</a></li>
                </ul>
            </div>
            
            
            <!-- Tab content -->
            <div class="tab-content">
             <?php
         $attributes = array('data-toggle' => 'validator', 'id' => 'myForm', 'role' => 'form');
        echo form_open_multipart('accounts/submitTransactionCategory', $attributes);
        ?>
            <div class="row">
            <div class="col-lg-12">
            	
           <button type="button" id="new" class="btn btn-lg btn-primary add_button"><i class="fa fa-plus-circle"></i>New Category / Sub Category</button>
	              <button  style="display:none;" type="submit" id="Save"  class="btn btn-lg btn-success" name="Save" value="Save Listing">
            <i class="fa fa-plus-circle"></i> Save Category / Sub Category</button>
	              <button  style="display:none;" type="submit" id="update"  class="btn btn-lg btn-success save_button" name="Update" value="Update Listing">
            <i class="fa fa-plus-circle"></i> Save Category / Sub Category</button>
                   <button  style="display:none;" type="button" id="edit" class="btn btn-lg btn-warning edit_button"><i class="fa fa-plus-circle"></i>Edit Category</button>
             <a href="javascript:void(0)" id="cancel" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>
               <div class="showdata" id="showdata"></div>
         
         
         
            </div>
            </div>
            
            <!-- start -->
            
            <div class="row"><h4 class="add_new_rental">Add/Edit Category</h4></div>
            <div class="row">
            	<div class="col-md-12 col-lg-12 category-selection" >
				<div class="form-group">
                    <div class="col-md-3 col-xs-12 form-label">What Would you like to add ?</div>
                    <div class="col-md-9 col-xs-12">
                    		<div class="radio-list">
                    		
                    			<label>
                    				<input type="radio" name="category-selection" value="category" /> <span class="lbl padding">Category</span>
                    			</label>
	                          	<label >
	       							<input type="radio" name="category-selection" value="sub-category" /> <span class="lbl padding">Sub Category</span>
	                    		</label>
                    		</div>
                    </div>
                </div>
			</div>
            <!-- start -->
            <div class="category-form" style="display: none;">
            <div class="col-md-4">
            <div class="form-group">
                    <label>Transaction</label>
                    <input name="id" type="text" class="form_fields" id="id" value="" style="display:none;">
                 
                    <select  class="form-control input-sm  required" id="transaction" name="transaction" >
					              <option value="">Select Transaction</option>
					              <option value="credit" selected="selected">Credit</option>
					              <option value="debit">Debit</option>
					            </select>
              </div>
              </div>
              	<div class="col-md-4  parent_category">
					<div class="form-group">
	                     <label>Parent Category</label>
	                    
	                          	<select  class="form-control input-sm required" id="parent_id" name="parent_id">
			                    <option value="">Select Parent Category</option>
			                    <option value="0">None</option>
			                        			                  
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
				</div>
            
            
            <div class="col-md-4">
             <div class="form-group">
                <label>Name</label>
           
                <input name="title" type="title" class="form-control input-sm required" id="title" value="" >
              </div>
             </div>  
              
              </div>
              <!-- end -->
              
              
            </div>
           <?php echo  form_close();?>
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
                    <th>Transaction</th>
                    <th>Parent Category</th>
                    <th>Added</th>
                    <th>Updated <i class="fa fa-arrow-down"></i></th>
                    </tr>
                    </thead>
                   <thead id="searchbox" class="search_box">
                    <tr class="highlighted">
                    	<form id="myForm2">
					<td><a style="display:none;" id="reset_filter" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png" title="Reset filter"></a></td>
                    <td><input type="text" class="form-control input-sm" id="1"></td>
                    <td> 
                    <select class="form-control input-sm search_init transaction-dropdown" id="2">
                     <option value="">Select</option>
                                                        <option value="credit">Credit</option>
                                                        <option value="debit">Debit</option>
                    </select>
                    </td>
                    <td>
                    <select class="form-control input-sm search_init"  id="3">
                            <option value="">Select</option>
                            <option value="0">None</option>
                                                            
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
                    <td></td>
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
			<script src="<?php echo base_url();?>js_module/common.js"></script>
			<script src="<?php echo base_url();?>js_module/accounts_transaction_categories.js"></script>