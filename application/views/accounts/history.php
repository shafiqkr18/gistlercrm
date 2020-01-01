
            <div id="wrapper">
            <div class="container">
            
            
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="page_head_area"><h1><i class="fa fa-file-text-o"></i> Account History</h1></div>
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
                    <li ><a href="<?php echo site_url('accounts/payment_modes');?>">Payment Modes</a></li>
                    <li class="active"><a href="<?php echo site_url('accounts/history');?>">History</a></li>
                </ul>
            </div>
            
            
            <!-- Tab content -->
            <div class="tab-content datatable-Scrolltab">
            
            <b>This feature will be added later</b>
            
            </div>
            
            
            
            
            </div>
            </div>
            
            
            
            
            
            </div>
             
            </div>
            <!-- container end -->            
            </div>
			<!-- wrapper end -->
			<div id="popup1" class="popup_block" style="display: none;">
	<div class="modal-header">
		<h4 class="modal-title">Accounts History Record</h4>
	</div>
	<div class="modal-body">
		<div>
		    <div style="display:inline-block; width:42%">Previous Entry</div>
		    <div style="display:inline-block; width:10%;"></div>
		    <div style="display:inline-block; width:42%">New Entry</div>
		</div>
		<div>
		  <div id="old_value" class="history-container">
		  </div>
		  <div style="display:inline-block; width:10%; vertical-align:middle; padding-top:70px;padding-left:4%">
		    <img src="<?php echo base_url();?>mydata/images/arrow_right_icon.png?ts=10" width="16" height="16">
		  </div>
		  <div id="new_value" class="history-container">
		  </div>
		</div>
	</div>
</div>