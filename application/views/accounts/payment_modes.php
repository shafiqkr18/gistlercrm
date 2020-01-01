
            <div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-file-text-o"></i> Manage Payment Modes</h1></div>
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
                    <li ><a href="<?php echo site_url('accounts/bank_accounts');?>">Bank Accounts</a></li>
                    <li><a href="<?php echo site_url('accounts/transaction_categories');?>">Transaction Categories</a></li>
                    <li class="active"><a href="<?php echo site_url('accounts/payment_modes');?>">Payment Modes</a></li>
                    <li><a href="<?php echo site_url('accounts/history');?>">History</a></li>
                </ul>
            </div>
            
            
            <!-- Tab content -->
            <div class="tab-content">
                <?php
		 $attributes = array('data-toggle' => 'validator', 'id' => 'myForm', 'role' => 'form');
	    echo form_open_multipart('accounts/submitPayment_modes', $attributes);
        ?>
            <div class="row">
            <div class="col-lg-12">
          
           <button type="button" id="new" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>New Dropdown Option</button>

            <button  style="display:none;" type="submit" id="update"  class="btn btn-lg btn-success" name="Update" value="Update Listing">
            <i class="fa fa-plus-circle"></i> Save Dropdown Option</button>
             <button  style="display:none;" type="submit" id="save"  class="btn btn-lg btn-success" name="Save" value="Save Listing">
            <i class="fa fa-plus-circle"></i> Save Dropdown Option</button>
            <button  style="display:none;" type="button" id="edit" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit Dropdown Option</button>
            <a href="javascript:void(0)" id="cancel" class="btn btn-lg btn-default"  style="display:none;"><i class="fa fa-times"></i> Cancel</a>
             <div class="showdata" id="showdata"></div>
          
          
          
            </div>
            </div>
            
            <div class="row"><h4 class="add_new_rental">Add/Edit Dropdown Option</h4></div>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                    <label>Dropdown</label>
                    <input name="id" type="text" class="form_fields" id="id" value="" style="display:none;">
                 
                    <select  class="form-control input-sm required" id="dropdown_name" name="dropdown_name">
						          	     <option value="">Select</option>
						<!--              <optgroup screen="listings" label="Listings (Rentals/Sales)">
						                <option value="categories">Categories</option>
						              </optgroup>-->
						              <optgroup screen="accounts" label="Accounts">
						                <option value="payment_mode">Payment Mode</option>
						              </optgroup>
						          </select>
              </div>
            </div>
            
            <div class="col-md-6" style="display: none;">
				<div class="form-group">
        			<div class="row  col-md-12 col-xs-12">
                            <div class="col-md-3 col-xs-12 form-label">Screen</div>
                            <div class="col-md-9 col-xs-12">
                               	 <input name="screen_name" type="text" class="form-control" id="screen_name" value="" readonly>
           						 <input name="screen" type="text" class="form-control" id="screen" value="" style="display:none;">
                            </div>
                     </div>
                </div>
			</div>
            
            <div class="col-md-6">
             <div class="form-group">
                <label>Title</label>
           
                <input name="option_title" type="text" class="form-control input-sm required" id="option_title" value="">
              </div>
             </div>  
              
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
                    <th>Dropdown</th>
                    <th>Title</th>
                    <th>Added</th>
                    <th>Updated</th>
                    </tr>
                     </thead>
                    <thead id="searchbox" class="search_box">
                    <tr class="highlighted">
                    <form id="myForm2">
					<td><a style="display:none;" id="reset_filter" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png" title="Reset filter"></a></td>
                    <td><input type="text" class="form-control input-sm" id="1"></td>
                    <td><input type="text" class="form-control input-sm" id="2"></td>
                    <td><input type="text" class="form-control input-sm" id="3"></td>
                    <td><input type="text" class="form-control input-sm" id="4"></td>
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
            <!-- container end -->            
            </div>
			<!-- wrapper end -->

			
			<script type="text/javascript" src="<?php echo site_url();?>js_module/common.js?ts=11234"></script> 
			<script type="text/javascript" src="<?php echo site_url();?>js_module/accounts_payment_modes.js"></script> 